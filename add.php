<?php

include('config/db_connect.php');
include('models/Writer.php');
include('models/Book.php');

$title = $writer = $year = $genre = $published_in = '';

$errors = [
    'title' => '', 'writer' => '', 'year' => '',
    'genre' => '', 'published_in' => ''
];

if (isset($_POST['add'])) {

    if (empty($_POST['title'])) {
        $errors['title'] = 'Book title is required!';
    } else {
        $title = $_POST['title'];
    }

    include('ajax/writers.php');
    if (empty($_POST['writer'])) {
        $errors['writer'] = 'Writer is required!';
    } else {
        $writer = $_POST['writer'];
        if (!in_array($writer, $writers)) {
            $errors['writer'] = 'No such writer exists!';
            $writer = '';
        }
    }

    if (empty($_POST['year'])) {
        $errors['year'] = 'Year of publishing is required!';
    } else {
        $yearStr = $_POST['year'];
        if (strlen($yearStr) != 4 || intval($yearStr) == 1) {
            $errors['year'] = 'Wrong input for year!';
        } else {
            $year = intval($yearStr);
            if ($year < 1301 || $year > date("Y")) {
                $errors['year'] = 'Wrong input for year!';
            }
        }
    }

    if (empty($_POST['genre'])) {
        $errors['genre'] = 'Book genre is required!';
    } else {
        $genre = $_POST['genre'];
    }

    include('ajax/countries.php');
    if (empty($_POST['published_in'])) {
        $errors['published_in'] = 'Country of publishing is required!';
    } else {
        $published_in = $_POST['published_in'];
        if (!in_array($published_in, $countries)) {
            $errors['published_in'] = 'No such country exists!';
            $published_in = '';
        }
    }


    if (!array_filter($errors)) {
        $writerid = returnWriterId($_POST['writer']);
        $title = $_POST['title'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $published_in = $_POST['published_in'];


        $newBook = new Book(
            null,
            $writerid,
            $title,
            $year,
            $genre,
            $published_in,
            null
        );

        $newBook->createBook();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container">
    <h4 class="center">Submit a book</h4>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="title">Book title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="writer">Writer:</label>
        <input type="text" name="writer" value="<?php echo htmlspecialchars($writer) ?>" onkeyup="suggestWriter(this.value)">
        <div class="red-text"><?php echo $errors['writer']; ?></div>
        <p><span id="writerSuggest"></span></p>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>" onkeyup="suggestGenre(this.value)">
        <div class="red-text"><?php echo $errors['genre']; ?></div>
        <p><span id="genreSuggest"></span></p>

        <label for="year">Year:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year) ?>">
        <div class="red-text"><?php echo $errors['year']; ?></div>

        <label for="published_in">Published in:</label>
        <input type="text" name="published_in" value="<?php echo htmlspecialchars($published_in) ?>" onkeyup="suggestPublished(this.value)">
        <div class="red-text"><?php echo $errors['published_in']; ?></div>
        <p><span id="publishedSuggest"></span></p>

        <div class="center">
            <input type="submit" name="add" value="Submit a book" class="btn green darken-2 z-depth-0">
        </div>
    </form>

</section>

<?php include('templates/footer.php'); ?>

<script>
    function suggestWriter(str = "") {
        if (str.length == 0) {
            document.getElementById("writerSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("writerSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/writers.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestGenre(str = "") {
        if (str.length == 0) {
            document.getElementById("genreSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("genreSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/genres.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestPublished(str = "") {
        if (str.length == 0) {
            document.getElementById("publishedSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("publishedSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/countries.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>