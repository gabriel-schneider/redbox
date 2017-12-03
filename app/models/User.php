<?php

use Phalcon\Validation\Validator\Uniqueness;

class User extends \Phalcon\Mvc\Model
{
    const TYPE_GUEST = 0;
    const TYPE_NORMAL = 1;
    const TYPE_ADMIN = 2;

    public $id;
    public $email;
    public $password;
    public $displayName;
    public $accountType;

    public function initialize()
    {
        $this->setSource('user');
        $this->hasMany('id', 'Book', 'userId');
        $this->hasManyToMany(
            "id",
            "Book",
            "userId", "itemId", 
            "Item",
            "id"
        );
        $this->keepSnapshots(true);
    }

    public function columnMap()
    {
        return [
            'id' => 'id',
            'email' => 'email',
            'password' => 'password',
            'display_name' => 'displayName',
            'account_type' => 'accountType'
        ];
    }

    public function validation()
    {
        $validator = new \Phalcon\Validation();

        $validator->add('email', new Uniqueness([
                'message' => 'E-mail já está em uso!'
            ])
        );

        return $this->validate($validator);
    }

    public function beforeCreate()
    {
        $this->hashPassword($this->password);
    }

    public function beforeUpdate()
    {
        if ($this->hasChanged('password')) {
            $this->hashPassword($this->password);
        }
    }

    protected function hashPassword($password)
    {
        $this->password = $this->getDi()->get('security')->hash($password);
    }

    public function getAccountTypeString()
    {
        switch ($this->accountType) {
            case self::TYPE_GUEST: return "Visitante";
            case self::TYPE_NORMAL: return "Usuário";
            case self::TYPE_ADMIN: return "Administrador";
        }
    }
}
