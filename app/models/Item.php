<?php

class Item extends \Phalcon\Mvc\Model
{
    public $id;
    public $title;
    public $description;
    public $image;
    public $maxBookTotal;
    public $maxBookPerUser;
    public $token;
    public $deleted;
    public $visibility;

    public function initialize()
    {
        $this->setSource('item');
        $this->hasMany('id', 'Book', 'itemId');
    }

    public function columnMap()
    {
        return [
            'id' => 'id',
            'title' => 'title',
            'description' => 'description',
            'image' => 'image',
            'book_max_total' => 'maxBookTotal',
            'book_max_user' => 'maxBookPerUser',
            'token' => 'token',
            'deleted' => 'deleted',
            'visibility' => 'visibility'
        ];
    }

    public function beforeCreate()
    {
        $random = new \Phalcon\Security\Random();

        do {
            $this->token = $random->base58(10);
        } while (self::findFirstByToken($this->token));
    }

    public function isVisible()
    {
        return ($this->visibility == true);
    }
    

    // public static function canBook($token, $datetimeStart, $datetimeEnd)
    // {
    //     $item = self::findFirstByToken($token);

    //     if ($item->getRelated('book')->count() >= $item->maxBookTotal) {
    //         return false;
    //     }

    //     if ($item) {
    //         $books = Book::query()
    //         ->where('datetimeStart < ?1')
    //         ->andWhere('datetimeEnd > ?2')
    //         ->andWhere('itemId = ?3')
    //         ->bind([
    //             1 => date("Y-m-d H:i:s", $datetimeEnd),
    //             2 => date("Y-m-d H:i:s", $datetimeStart),
    //             3 => $item->id
    //         ])->execute();
    //         return ($books->count() <= 0);
    //     }

    //     return false;otal
    // }

    // public function validation()
    // {
    //     $validator = new \Phalcon\Validation();

    //     $validator->add('email', new Uniqueness([
    //             'message' => 'E-mail já está em uso!'
    //         ])
    //     );

    //     return $this->validate($validator);
    // }
}
