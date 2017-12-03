<?php

use Phalcon\Mvc\Model\Message as Message;

class Book extends \Phalcon\Mvc\Model
{
    public $id;
    public $itemId;
    public $userId;
    public $datetimeStart;
    public $datetimeEnd;

    public function initialize()
    {
        $this->setSource('book');

        $this->belongsTo(
            'itemId',
            'Item',
            'id'
        );

        $this->belongsTo(
            'userId',
            'User',
            'id'
        );
    }

    public function columnMap()
    {
        return [
            'id' => 'id',
            'item_id' => 'itemId',
            'user_id' => 'userId',
            'datetime_start' => 'datetimeStart',
            'datetime_end' => 'datetimeEnd'
        ];
    }

    public function afterFetch()
    {
        $this->datetimeStart = new \DateTime($this->datetimeStart);
        $this->datetimeEnd = new \DateTime($this->datetimeEnd);
    }

    public function beforeSave()
    {
        $this->datetimeStart = $this->datetimeStart->format("Y-m-d H:i:s");
        $this->datetimeEnd = $this->datetimeEnd->format("Y-m-d H:i:s");
    }

    public function afterSave()
    {
        $this->datetimeStart = new \DateTime($this->datetimeStart);
        $this->datetimeEnd = new \DateTime($this->datetimeEnd);
    }

    public function isActive()
    {
        $now = new \DateTime();
        return ($this->datetimeStart <= $now && $this->datetimeEnd > $now);
    }

    public function isOld()
    {
        $now = new \DateTime();
        return ($this->datetimeEnd < $now);
    }

    public function canDelete()
    {
        return (!$this->isActive() && !$this->isOld());
    }

    public function canBook($token, $userId, $datetimeStart, $datetimeEnd)
    {
        $item = Item::findFirstByToken($token);

        if ($item->maxBookTotal == -1) {
            $item->maxBookTotal = 9999;
        }

        if ($item->maxBookPerUser == -1) {
            $item->maxBookPerUser = 9999;
        }

        if ($item) {
            $books = Book::query()
            ->where('datetimeStart < ?1')
            ->andWhere('datetimeEnd > ?2')
            ->andWhere('itemId = ?3')
            ->bind([
                1 => $datetimeEnd->format('Y-m-d H:i:s'),
                2 => $datetimeStart->format('Y-m-d H:i:s'),
                3 => $item->id
            ])->execute();
            
            $now = new \DateTime();
            if ($books->count() < $item->maxBookTotal) {
                $userBooks = Book::query()
                ->where('datetimeEnd > ?1')
                ->andWhere('userId = ?2')
                ->bind([
                    1 => $now->format('Y-m-d H:i:s'),
                    2 => $userId
                ])->execute();

                if ($userBooks->count() < $item->maxBookPerUser) {
                    return true;
                } else {
                    $this->appendMessage(new Message('Usuário excedeu o limite de reservas para este item!'));
                }
            } else {
                $this->appendMessage(new Message('O número máximo de reservas para esse item foi atingido!'));
            }
        }

        return false;
    }
}
