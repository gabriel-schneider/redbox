<?php

use Phalcon\Mvc\Controller;

class SetupController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
        $this->assets->addCss('static/css/views/setup.css');
    }

    public function beforeExecuteRoute() {
        if ($this->config->get('setup', false) == true) {
            $this->response->redirect('');
            return false;
        }
    }

    public function welcomeAction()
    {
        //
    }

    public function databaseAction()
    {
        $this->view->host = $this->config->get('host');
        $this->view->dbname = $this->config->get('dbname');
        $this->view->username = $this->config->get('username');
        $this->view->password = $this->config->get('password');
        $this->view->port = $this->config->get('port');

        if ($this->request->isPost()) {
            $configFilePath = APP_PATH . '/config/config.php';
            $config = [
                'host' => $this->request->getPost('host'),
                'dbname' => $this->request->getPost('dbname'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'port' => $this->request->getPost('port'),
            ];
            file_put_contents($configFilePath, '<?php return ' . var_export($config, true) . ';');
            return $this->response->redirect('setup/install');
        }
    }

    public function installAction()
    {
        try {
            $this->db;
            $this->view->success = true;
        } catch (\Exception $e) {
            $this->flashSession->error('Não foi possível conectar ao banco de dados!');
            return $this->response->redirect('setup/database');
        }
        
        if ($this->request->isPost()) {
            $this->db->query("DROP TABLE IF EXISTS `book`");
            $this->db->query("DROP TABLE IF EXISTS `item`");
            $this->db->query("DROP TABLE IF EXISTS `user`");
            
            $this->db->query("CREATE TABLE `user` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `email` varchar(100) NOT NULL,
                `password` varchar(255) NOT NULL,
                `display_name` varchar(100) NOT NULL,
                `account_type` int(11) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
            ");

            $this->db->query("CREATE TABLE `item` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(100) NOT NULL,
                `description` varchar(255) DEFAULT '',
                `image` varchar(100) DEFAULT NULL,
                `book_max_total` int(11) DEFAULT '0',
                `token` varchar(100) DEFAULT NULL,
                `book_max_user` int(11) DEFAULT '0',
                `deleted` tinyint(1) DEFAULT '0',
                `visibility` tinyint(1) DEFAULT '1',
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
            ");

            $this->db->query("CREATE TABLE `book` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `item_id` int(11) NOT NULL,
                `user_id` int(11) NOT NULL,
                `datetime_start` datetime NOT NULL,
                `datetime_end` datetime NOT NULL,
                PRIMARY KEY (`id`),
                KEY `book_user_FK` (`user_id`),
                KEY `book_item_FK` (`item_id`),
                CONSTRAINT `book_item_FK` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
                CONSTRAINT `book_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
            ");

            $this->flashSession->success('Estruturas criadas com sucesso!');
            return $this->response->redirect('setup/admin-user');
        }
    }

    public function adminUserAction()
    {
        $user = new User();

        if ($this->request->isPost()) {
            $user->displayName = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            $user->password = $this->request->getPost('password');
            $user->accountType = User::TYPE_ADMIN;
            if ($user->create()) {
                $this->config->setup = 1;
                $configFilePath = APP_PATH . '/config/config.php';
                file_put_contents($configFilePath, '<?php return ' . var_export($this->config->toArray(), true) . ';');
                return $this->response->redirect('');
            }
        }

        $this->view->user = $user;
    }
}
