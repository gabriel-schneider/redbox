<?php

class UserController extends BaseController
{
    public function signinAction()
    {
        if ($this->request->isPost()) {
            $user = User::findFirstByEmail($this->request->getPost('email'));

            if ($user) {
                if ($this->security->checkHash($this->request->getPost('password'), $user->password)) {
                    $bag = new \Phalcon\Session\Bag('user');
                    $bag->id = $user->id;
                    $bag->displayName = $user->displayName;
                    $bag->email = $user->email;
                    $bag->accountType = $user->accountType;

                    $this->flashSession->success('Bem-vindo ' . $user->displayName . '!');
                    return $this->response->redirect('');
                }
            }

            $this->flashSession->error('E-mail ou senha incorretos!');
        }
    }

    public function signupAction()
    {
        if ($this->request->isPost()) {
            $user = new User();

            $user->displayName = $this->request->getPost('display-name');
            $user->email = $this->request->getPost('email');
            $user->password = $this->request->getPost('password');
            $user->accountType = User::TYPE_NORMAL;
            if ($user->create()) {
                $this->flashSession->success('Usuário criado com sucesso!');
                return $this->response->redirect('');
            } else {
                foreach ($user->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }
        }
    }

    public function signoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('');
    }

    public function accountAction()
    {
        if (!\Reservas\LoggedUser::isValid()) {
            $this->response->redirect('signin');
            return false;
        }

        $user = \Reservas\LoggedUser::getModel();

        if ($user) {
            if ($this->request->isPost()) {
                $user->displayName = $this->request->getPost('display-name');
                $user->email = $this->request->getPost('email');

                $messages = [];

                if ($this->request->hasPost('password') && !empty($this->request->getPost('password'))) {
                    $validator = new \Phalcon\Validation();
                    $validator->add('password', new \Phalcon\Validation\Validator\Confirmation([
                        'message' => 'Senha não é igual ao de confirmação!',
                        'with' => 'password-confirm'
                    ]));
    
                    $messages = $validator->validate($_POST);
                    if (count($messages)) {
                        foreach ($messages as $message) {
                            $this->flashSession->error($message);
                        }
                    } else {
                        $user->password = $this->request->getPost('password');
                    }
                }

                if (count($messages) === 0 && $user->save()) {
                    $this->flashSession->success("Dados salvos com sucesso!");
                    $this->loggedUser->updateBag();
                    $this->response->redirect('');
                    return false;
                } else {
                    foreach ($user->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                }
            }
        
            $this->view->user = $user;
        }
    }

    public function historyAction()
    {
        if (!$this->loggedUser->isValid()) {
            $this->response->redirect('signin');
            return false;
        }

        $user = $this->loggedUser->getModel();
        
        if ($user) {
            $page = $this->request->getQuery('page', 'int', 1);
    
            $books = $user->getRelated('Book', ['order' => 'datetimeStart DESC']);

            $paginator = new \Phalcon\Paginator\Adapter\Model([
                'data' => $books,
                'limit' => 5,
                'page' => $page
            ]);
    
            $this->view->page = $paginator->getPaginate();
        }
    }
}
