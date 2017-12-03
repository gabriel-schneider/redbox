<?php 

namespace Reservas;

class LoggedUser
{
    public $bag;

    public function __construct()
    {
        $bag = self::getBag();
        if ($bag->count() == 0) {
            $bag->id = -1;
            $bag->displayName = 'Visitante';
            $bag->accountType = \User::TYPE_GUEST;
            $bag->email = 'guest@guest.com';
            $bag->password = '';
        }
        $this->bag = $bag;
    }

    public static function getBag()
    {
        return new \Phalcon\Session\Bag('user');
    }

    public function updateBag()
    {
        $user = self::getModel();
        $bag = self::getBag();
        $bag->displayName = $user->displayName;
        $bag->email = $user->email;
    }

    public static function getModel()
    {
        return \User::findFirst(self::getBag()->id);
    }

    public static function isValid()
    {
        return (self::getBag()->count() > 0);
    }

    public function __invoke()
    {
        return self::getBag()->id;
    }

    public function isGuest()
    {
        return ($this->bag->accountType == \User::TYPE_GUEST);
    }

    public function isAdmin()
    {
        return ($this->bag->accountType == \User::TYPE_ADMIN);
    }
}
