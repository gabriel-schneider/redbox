<?php

class ItemController extends BaseController
{
    public function addAction()
    {
    }

    public function editAction($token)
    {
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

        $showHidden = $this->request->getQuery('hidden', 'int', 0) && $this->loggedUser->isAdmin();

        $this->view->search = $search;
        
        $itemsQuery = \Item::query()
        ->where('title LIKE ?1')
        ->orWhere('description LIKE ?2')
        ->andWhere('visibility = ?3')
        ->andWhere('deleted = 0')
        ->orderBy('title')
        ->bind([
            1 => '%' . $search . '%',
            2 => '%' . $search . '%',
            3 => !$showHidden,
        ])->execute();

        $paginator = new \Phalcon\Paginator\Adapter\Model([
            'data' => $itemsQuery,
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
