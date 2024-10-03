<?php include "db.php" ?>
<?php
session_start();
if (isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
    $query = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);




}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php echo $row['title']; ?></title>
</head>
<body>
<?php include("includes\header.php");?>
<div class = "d-flex justify-content-center">
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
                echo '<p class = "d-flex justify-content-center" style="font-size: 25px"><b>Description</b></p>';
                echo '<p class = "d-flex justify-content-center" style = "max-width:458px"> ' . $row['description'] . '</p>';
            }
            }
        echo '</div>';
        echo '<br><br>';
        ?>
</div>

</body>
</html>
