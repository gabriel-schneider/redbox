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
        $this->maxBookTotal = 0;
        $this->maxBookPerUser = 0;
        $this->visibility = 1;
        $this->deleted = 0;
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

    public function beforeSave()
    {
        $this->maxBookTotal = max($this->maxBookTotal, 0);
        $this->maxBookPerUser = max($this->maxBookPerUser, 0);
    }

    public function isVisible()
    {
        return ($this->visibility == true);
    }

    public function getImage()
    {
        $filePath = IMAGES_PATH . '/item/';
        return file_exists($filePath . $this->image) ? $filePath . $this->image : $filePath . 'no-image.png';
    }

    public function getImageUrl()
    {
        return $this->getDi()->get('url')->get(str_replace(BASE_PATH, '', $this->getImage()));
    }
}
