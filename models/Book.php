<?php

class Book
{
    public $id;
    public $writerid;
    public $title;
    public $year;
    public $genre;
    public $published_in;

    public function __construct(
        $id,
        $writerid,
        $title,
        $year,
        $genre,
        $published_in
    ) {
        $this->id = $id;
        $this->writerid = $writerid;
        $this->title = $title;
        $this->year = $year;
        $this->genre = $genre;
        $this->published_in = $published_in;
    }

    public function createBook()
    {
        $host = 'localhost';
        $user = 'admin';
        $password = 'admin';
        $database = 'library';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO book(writerid, title, year, genre, published_in)
        VALUES('$this->writerid', '$this->title', '$this->year', '$this->genre',
            '$this->published_in')";

        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
