<?php

class Writer
{
    public $id;
    public $name;
    public $birth;
    public $death;
    public $nationality;
    public $img;

    public function __construct(
        $id,
        $name,
        $birth,
        $death,
        $nationality,
        $img
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->birth = $birth;
        $this->death = $death;
        $this->nationality = $nationality;
        $this->img = $img;
    }
}

function returnWriterId($writer)
{
    switch ($writer) {
        case 'Fyodor Dostoevsky':
            return 1;
            break;
        case 'J. D. Salinger':
            return 2;
            break;
        case 'Franz Kafka':
            return 3;
            break;
        case 'George Orwell':
            return 4;
            break;
        case 'Mikhail Bulgakov':
            return 5;
            break;
        case 'Charles Bukowski':
            return 6;
            break;
        case 'Edgar Allan Poe':
            return 7;
            break;
    }
}
