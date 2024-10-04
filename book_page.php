<?php include "db.php" ?>
<?php include "functions.php"?>
<?php
session_start();
if (isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
    $row = find_book($conn, $book_id);
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php include("includes\header.php");?>
    <title><?php echo $row['title'];?></title>
</head>
<body style="background-image: url('/untitled/includes/library_image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
    <div class = "d-flex justify-content-center mt-5 py-5">
            <?php
            echo '<div class = "book">';
                echo '<h1 class = "d-flex justify-content-center">' . $row['title'] . '</h1>';
                echo '<p class = "d-flex justify-content-center">' . $row['author'] . '</p>';

                echo '<a class = "d-flex justify-content-center">';
                echo '<img src="' . $row['img'] . '" alt="book image" width = 258 height = 387>';
                echo '</a><br>';

                if ($row['available_copies'] === 0){
                    echo '<p style = "color:red">No copies left</p>';
                }else{
                    echo '<p class = "d-flex justify-content-center" style = "color:green">Available copies: ' . $row['available_copies'] . '</p><br>';
                if ($row['description'] != NULL){
                    echo '<p class = "d-flex justify-content-center" style="font-size: 25px; background-color: white;"><b>Description</b></p><hr>';
                    echo '<p class = "d-flex justify-content-center" style = "max-width:458px; background-color: white;" > ' . $row['description'] . '</p><br>';
                }
                }
                echo '<button type="button" class="btn btn-dark ">Add to Wishlist</button>';
            echo '</div>';
            echo '<br><br>';
            ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include("includes/footer.php");?>
</body>
</html>
