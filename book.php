<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $bookid = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "SELECT * FROM book WHERE id='$bookid'";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    $query = "SELECT * FROM writer WHERE id={$book['writerid']}";
    $result = mysqli_query($conn, $query);
    $writer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if (isset($_POST['delete'])) {
    $playerid = mysqli_real_escape_string($conn, $_POST['playerid']);
    $writerid = mysqli_real_escape_string($conn, $_POST['writerid']);

    $query = "DELETE FROM book WHERE id = $bookid AND writerid = $writerid";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($book == null) : ?>

    <h1 class="center">There is no such book in database!</h1>
    <div class="center">
        <a href="index.php" class="btn center green darken-2">Return</a>
    </div>

<?php else : ?>

    <div class="container center">
        <div class="card z-depth-0 radius-card" style="padding-bottom: 30px;">
            <img src="<?php echo $writer['img']; ?>" alt="icon" class="icon-card">
            <h3><?php echo $book['title']; ?></h3>
            <h4>Author: <?php echo $writer['name']; ?></h4>
            <h4>Genre: <?php echo $book['genre']; ?></h4>
            <h5>Published in <?php echo $book['year']; ?> in <?php echo $book['published_in']; ?></h5>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="padding-top:20px">
                <input type="hidden" name="playerid" value="<?php echo $playerid; ?>">
                <input type="hidden" name="writerid" value="<?php echo $team['id']; ?>">
                <input type="submit" name="delete" value="delete" class="btn center green darken-2">
            </form>

        </div>
    </div>

<?php endif; ?>

<?php include('templates/footer.php'); ?>

</html>