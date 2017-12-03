<?php

use \Phalcon\Mvc\Controller;

class BookController extends BaseController
{
    public function detailAction($token)
    {
        $this->assets->addCss('static/css/views/book/detail.css');
        $item = Item::findFirstByToken($token);

        $datetimeStart = $datetimeEnd = new DateTime();

        if ($item) {
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
                        $this->response->redirect('history');
                        return false;
                    }
                }

                foreach ($book->getMessages() as $message) {
                    $this->flashSession->notice($message);
                }
                
                //$this->flashSession->error('Não é possível reservar o item para esta data e/ou horário!');
            }

            $this->view->datetimeStart = $datetimeStart->format("Y-m-d H:i");
            $this->view->datetimeEnd = $datetimeEnd->format("Y-m-d H:i");

            $this->view->item = $item;
        } else {
            $this->view->pick('book/notfound');
        }
    }

    public function cancelAction($bookId)
    {
        $book = Book::findFirst($bookId);


        // @TODO: check if book is old and is not active
        if ($book && $book->userId == $this->loggedUser::getBag()->id) {
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
}
