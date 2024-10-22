<?php include "db.php" ?>
<?php include "functions.php"?>
<?php
session_start();
if (isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
    $row = find_book($conn, $book_id); // Fetch book details
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])){
    $book_id = $_POST['book_id'];

    // Create wishlist cookie if it doesn't exist
    if (!isset($_COOKIE['wishlist'])){
        setcookie('wishlist', json_encode(array($book_id)), time() + 60 * 60 * 24 * 30 * 12 * 2, "/");

    } else {
        // Add or remove book from wishlist
        $wishlist = json_decode($_COOKIE['wishlist'], true);

        if (!in_array($book_id, $wishlist)){
            array_push($wishlist, $book_id); // Add book to wishlist
            setcookie('wishlist', json_encode($wishlist), time() + 60 * 60 * 24 * 30 * 12 * 2, "/");

        } else{
            unset($wishlist[array_search($book_id, $wishlist)]);
            setcookie('wishlist', json_encode($wishlist), time() + 60 * 60 * 24 * 30 * 12 * 2, "/"); // Remove book from wishlist
        }
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();

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
<body style="background-image: url('/library_project/includes/library_image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
<div class="container text-center mt-5 py-5">

    <div class="book">
        <?php
        echo '<h1>' . $row['title'] . '</h1>';
        echo '<p>' . $row['author'] . '</p>';

        echo '<a>';
        echo '<img src="' . $row['img'] . '" alt="book image" width="258" height="387">';
        echo '</a><br>';

        if ($row['available_copies'] === 0) {
            echo '<p style="color:red">No copies left</p>';
        } else {
            echo '<p style="color:green">Available copies: ' . $row['available_copies'] . '</p><br>';
            if ($row['description'] != NULL) {
                echo '<p style="font-size: 25px;"><b>Description</b></p><hr>';
                echo '<p class="mx-auto" style="max-width:458px; background-color: white;">' . $row['description'] . '</p><br>';
            }
        }
        ?>
        <form method="post" action="">
            <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
            <?php if (isset($_COOKIE['wishlist'])){
                $wishListCheck = json_decode($_COOKIE['wishlist'], true);
                // Display "Add to Wishlist" or "Remove from Wishlist" based on cookie
                if (!in_array($row['book_id'], $wishListCheck)){?>
                    <button type="submit" class="btn btn-dark">Add to Wishlist</button>
                <?php } else {?>
                    <button type="submit" class="btn btn-dark">Remove from Wishlist</button>
                <?php }

             } else { ?>
                    <button type="submit" class="btn btn-dark">Add to Wishlist</button>
                <?php }?>

        </form>
    </div>
    <br><br>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php include("includes/footer.php");?>
</body>
</html>
