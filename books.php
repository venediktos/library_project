<?php include "db.php" ?>
<?php
session_start();
// Fetch all books from the database
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Book Page</title>
</head>
<body class = "d-flex flex-column min-vh-100" style="background-image: url('/library_project/includes/library_image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
    <?php include("includes\header.php");?>

    <div class = "d-flex justify-content-center container mt-5 py-5">
        <div class="container">
            <?php
            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Display book details
                    echo '<div class="book text-center mb-4">';
                    echo '<h2><a class="link-dark text-decoration-none" style="background-color: white" href="book_page.php?book_id=' . $row['book_id'] . '">' . $row['title'] . '</a></h2>';
                    echo '<p>' . $row['author'] . '</p>';
                    echo '<a href="book_page.php?book_id=' . $row["book_id"] . '">';
                    echo '<img src="' . $row['img'] . '" alt="book image" width="258" height="387">';
                    echo '</a>';
                    // Show message if no copies are available
                    if ($row['available_copies'] === 0) {
                        echo '<p style="color:red">No copies left</p>';
                    }
                    echo '</div>';
                    echo '<hr>';
                }
            }
            ?>
        </div>
    </div>
    <?php include("includes/footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
