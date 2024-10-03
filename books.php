<?php include "db.php" ?>
<?php
session_start();

$query = "SELECT * FROM books ORDER BY `book_id` DESC";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Book Page</title>
</head>
<body>
    <?php include("includes\header.php");?>
    <h2 class = "d-flex justify-content-center"> Books Page </h2> <br><br>
    <div class = "d-flex justify-content-center">
        <div class=”align-self-center”>
            <?php
            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class = "book">';
                    echo '<h3><a class="link-dark text-decoration-none"  href="book_page.php?book_id=' . $row['book_id'] . '">' . $row['title'] . '</a></h3>';
                        echo '<p>' . $row['author'] . '</p>';
                        echo '<a href="book_page.php?book_id=' . $row['book_id'] . '">';
                        echo '<img src="' . $row['img'] . '" alt="book image" width="258" height="387">';
                        echo '</a>';
                        if ($row['available_copies'] === 0){
                            echo '<p style = "color:red">No copies left</p>';
                        }
                    echo '</div>';
                    echo '<br><br><hr>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
