<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\File;

class ItemForm extends Form
{
    public function initialize()
    {
        $this->add(
            new Text('title')
        );

        $this->add(
            new TextArea('description')
        );

        $this->add(
            new Numeric('maxBookTotal')
        );

        $this->add(
            new Numeric('maxBookPerUser')
        );

        $this->add(
            new Select(
                "visibility",
                [
                    1 => "Visível",
                    0 => "Escondido",
                ]
            )
        );

        $this->add(
            new File("image")
        );
    }
}
