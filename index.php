<?php

include('config/db_connect.php');

$query = "SELECT * FROM writer ORDER BY name ASC";
$result = mysqli_query($conn, $query);
$writers = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container">
    <div class="row">
        <?php foreach ($writers as $writer) : ?>
            <div class="col s12 m6 l4 xl3">
                <div class="card z-depth-0 radius-card">
                    <img src="<?php echo $writer['img']; ?>" alt="writer" class="icon-card">
                    <div class="card-content center">
                        <h5><?php echo htmlspecialchars($writer['name']); ?></h5>
                    </div>
                    <div class="card-action right-align radius-card">
                        <a href="writer.php?id=<?php echo $writer['id']; ?>" class="green-text text-darken-2">
                            More Info
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include('templates/footer.php'); ?>

</html>