<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $writerid = mysqli_real_escape_string($conn, $_GET['id']);
}

$query = "SELECT * FROM writer WHERE id = $writerid";
$result = mysqli_query($conn, $query);
$writer = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$query = "SELECT * FROM book WHERE writerid='$writerid'";
$result = mysqli_query($conn, $query);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($writer == null) : ?>

    <h1 class="center">There is no writer with that ID!</h1>
    <div class="center">
        <a href="index.php" class="btn center green darken-2">Return</a>
    </div>

<?php else : ?>

    <h1 class="center"><?php echo $writer['name']; ?></h1>
    <img class="writer" src="<?php echo $writer['img']; ?>" alt="">
    <h5 class="center"><?php echo $writer['birth']; ?>-<?php echo $writer['death']; ?></h5>
    <h5 class="center" style="padding-bottom: 100px;">Writer from <?php echo $writer['nationality']; ?></h5>

    <?php if ($books == null) { ?>

        <h6 class="center">No books in database! </h6>

    <?php } else {; ?>

        <div class="container">
            <h5 class="center">Books in database:</h5>
            <div class="row">
                <?php foreach ($books as $book) : ?>
                    <div class="col s12 m6 l4 xl3">
                        <div class="card z-depth-0 radius-card">
                            <img src="<?php echo $writer['img']; ?>" alt="icon" class="icon-card">
                            <div class="card-content center">
                                <h5><?php echo htmlspecialchars($book['title']); ?></h5>
                            </div>
                            <div class="card-action right-align radius-card">
                                <a href="book.php?id=<?php echo $book['id']; ?>" class="green-text text-darken-2">
                                    More Info
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php }; ?>

<?php endif; ?>

<?php include('templates/footer.php'); ?>

</html>