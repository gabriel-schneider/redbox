<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;

class ItemController extends BaseController
{
    protected function getItemImagesDirectory()
    {
        return IMAGES_PATH . '/item/';
    }

    public function addAction()
    {
        if (!$this->loggedUser->isAdmin()) {
            return $this->response->redirect('');
        }

        $item = new Item();
        $form = new ItemForm($item);

        if ($this->request->isPost()) {
            $form->bind($_POST, $item);
            if ($item->create()) {
                if ($this->request->hasFiles() == true) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $file->moveTo($this->getItemImagesDirectory() . $item->token . '.' . $file->getExtension());
                        $item->image = $item->token . '.' . $file->getExtension();
                        $item->save();
                    }
                }
                $this->response->redirect('item/book/' . $item->token);
            } else {
                foreach ($item->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }
        }

        $this->view->submitValue = 'Adicionar';
        $this->view->form = $form;
    }

    public function editAction($token)
    {
        if (!$this->loggedUser->isAdmin()) {
            return $this->response->redirect('');
        }

        $item = Item::findFirstByToken($token);

        if (!$item) {
            return $this->response->redirect('404');
        }

        $form = new ItemForm($item);

        if ($this->request->isPost()) {
            $form->bind($_POST, $item);
            if ($item->save()) {
                if ($this->request->hasFiles(true)) {
                    unlink($item->getImage());
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $file->moveTo($this->getItemImagesDirectory() . $item->token . '.' . $file->getExtension());
                        $item->image = $item->token . '.' . $file->getExtension();
                        $item->save();
                    }
                }
                $this->response->redirect('item/book/' . $item->token);
            } else {
                foreach ($item->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }
        }

        $this->view->submitValue = 'Salvar';
        $this->view->form = $form;
        $this->view->pick('item/add');
    }

    public function deleteAction($token)
    {
        $item = Item::findFirstByToken($token);
        if ($item) {
            $item->deleted = true;
            if ($item->save()) {
                $this->flashSession->success('Item removido com sucesso!');
            } else {
                foreach ($item->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }
            $this->response->redirect('');
        } else {
            $this->view->pick('book/notfound');
        }
    }

    public function bookAction($token)
    {
        //@TODO: fix this
        $this->assets->addCss('static/css/views/item/book.css');
        $item = Item::findFirstByToken($token);

        $datetimeStart = $datetimeEnd = new DateTime();

        if ($item) {
            if ((!$item->isVisible() && !$this->loggedUser->isAdmin()) || $item->deleted) {
                $this->view->pick('book/notfound');
                return true;
            }

            if ($this->request->isPost()) {
                $datetimeStart = new \DateTime($this->request->getPost('datetime-start'));
                $datetimeEnd = new \DateTime($this->request->getPost('datetime-end'));

                $book = new Book();
            
                if ($book->canBook($token, $this->loggedUser->getBag()->id, $datetimeStart, $datetimeEnd)) {
                    $book->itemId = $item->id;
                    $book->userId = $this->loggedUser::getBag()->id;
                    $book->datetimeStart = $datetimeStart;
                    $book->datetimeEnd = $datetimeEnd;
                    
                    if ($book->create()) {
                        $this->flashSession->success('Item reservado com sucesso!');
                        $this->response->redirect('user/history');
                        return false;
                    }
                }

                foreach ($book->getMessages() as $message) {
                    $this->flashSession->notice($message);
                }
            }

            $this->view->datetimeStart = $datetimeStart->format("Y-m-d H:i");
            $this->view->datetimeEnd = $datetimeEnd->format("Y-m-d H:i");

            $this->view->item = $item;
        } else {
            $this->view->pick('book/notfound');
        }
    }

    public function unbookAction($bookId)
    {
        $book = Book::findFirst($bookId);

        if ($book && $book->isFromLoggedUser() && $book->canDelete()) {
            if ($book->delete()) {
                $this->flashSession->success('Reserva cancelada com sucesso!');
                $this->response->redirect('history');
                return false;
            }

            foreach ($book->getMessages() as $message) {
                $this->flashSession->error($message);
            }
        }

        $this->flashSession->error('Não foi possível cancelar a reserva solicitada...');
    }

    public function searchAction()
    {
        $search = $this->request->getQuery('q', 'string');
        $page = $this->request->getQuery('page', 'int', 1);

        $showHidden = $this->loggedUser->isAdmin();

        //$this->request->getQuery('hidden', 'int', 0)

        $this->view->search = $search;
        
        $itemsQuery = \Item::query()
        ->where('title LIKE ?1')
        ->orWhere('description LIKE ?2')
        ->andWhere('deleted = 0')
        ->orderBy('title')
        ->bind([
            1 => '%' . $search . '%',
            2 => '%' . $search . '%',
        ]);

        if (!$this->loggedUser->isAdmin()) {
            $itemsQuery->andWhere('visibility = 1');
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model([
            'data' => $itemsQuery->execute(),
            'limit' => 5,
            'page' => $page
        ]);

        $this->view->hidden = $showHidden;
        $this->view->page = $paginator->getPaginate();
    }

    public function hideAction($token)
    {
        $this->setItemVisibility($token, false);
        $this->dispatcher->forward([
            'action' => 'book'
        ]);
    }

    public function showAction($token)
    {
        $this->setItemVisibility($token, true);
        $this->dispatcher->forward([
            'action' => 'book'
        ]);
    }

    private function setItemVisibility($token, $visibility)
    {
        $item = Item::findFirstByToken($token);
        if ($item && ($item->isVisible() != $visibility)) {
            $item->visibility = $visibility;
            if (!$item->save()) {
                foreach ($item->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }
        }
    }
}
