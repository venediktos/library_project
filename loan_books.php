<?php
include "db.php";
session_start();

// Redirect to login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Search for user by ID
    if (isset($_POST["user_id"])) {
        $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $row1 = mysqli_fetch_assoc($result);

        if ($row1) {
            $_SESSION['user_data'] = $row1;
            $user_id_borrowed = $row1['user_id'];
        } else {
            $_SESSION['user_data'] = "No users found";
        }
    }

    // Search for user by username
    if (isset($_POST["username_id"])) {
        $username_id = mysqli_real_escape_string($conn, $_POST["username_id"]);
        $query = "SELECT * FROM users WHERE username LIKE '%$username_id%'";
        $result = mysqli_query($conn, $query);
        $row1 = mysqli_fetch_assoc($result);

        if ($row1) {
            $_SESSION['user_data'] = $row1;
            $user_id_borrowed = $row1['user_id'];
        }else {
            $_SESSION['user_data'] = "No users found";
        }
    }

    // Search for book by ID
    if (isset($_POST["book_id"])) {
        $book_id = mysqli_real_escape_string($conn, $_POST["book_id"]);
        $query = "SELECT * FROM books WHERE book_id = '$book_id'";
        $result = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result);

        if ($row2) {
            $_SESSION['book_data'] = $row2;
            $book_id_borrowed = $row2['book_id'];
        } else {
            $_SESSION['book_data'] = "No books found";
        }
    }
    // Search for book by title
    if (isset($_POST["book_name"])) {
        $book_name = mysqli_real_escape_string($conn, $_POST["book_name"]);
        $query = "SELECT * FROM books WHERE title LIKE '%$book_name%'";
        $result = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result);

        if ($row2) {
            $_SESSION['book_data'] = $row2;
            $book_id_borrowed = $row2['book_id'];
        } else {
            $_SESSION['book_data'] = "No books found";
        }
    }
    // Finalize the loan process
    if (isset($_POST["finalize"])){
        if ((isset($_SESSION['user_data']) && isset($_SESSION['book_data']))) {
            if ($_SESSION['book_data']['available_copies'] > 0){
                $time_now = date("Y-m-d H:i:s");
                $return_date = date("Y-m-d H:i:s", strtotime($time_now) + (14 * 24 * 60 * 60));

                $book_id_borrowed = $_SESSION['book_data']['book_id'];
                $user_id_borrowed = $_SESSION['user_data']['user_id'];

                // Insert loan record into database
                $query = "INSERT INTO borrowed(book_id, user_id, borrow_date, return_date, completed) VALUES ('$book_id_borrowed', '$user_id_borrowed', '$time_now', '$return_date', 'false')";
                $result = mysqli_query($conn, $query);

                // Update user's loaned books count and available copies of the book
                $loaned_books_query = "UPDATE users SET loaned_books = loaned_books + 1 WHERE user_id = '$user_id_borrowed'";
                mysqli_query($conn, $loaned_books_query);
                $available_copies_query = "UPDATE books SET available_copies = available_copies - 1 WHERE book_id = '$book_id_borrowed'";
                mysqli_query($conn, $available_copies_query);

                if ($result) {
                    // Clear session data
                    unset($_SESSION['book_data']);
                    unset($_SESSION['user_data']);
                    // Show success modal
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let myModal = new bootstrap.Modal(document.getElementById('actionModal'), {
                                backdrop: 'static',
                                keyboard: false
                            });
                            myModal.show();
                        });
                    </script>";
                } else {
                    echo "Error in finalizing the loan.";
                }
            }else {
                echo "There are no available copies.";
            }
        }else{
            echo "Book ID or User ID is not set.";
            }
        }
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
    <title>Admin Page</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include("includes/header.php"); ?>
<div class="container mt-5 py-5 ">
    <div class="row">
        <div class="col text-center">
            <div class="card">
                <div class="card-header">
                    <h1><b>User Identification</b></h1>
                </div>
                <div class="card-body">
                    <!-- Search for user by ID -->
                    <form method="post" action="loan_books.php">
                        <div class="col-6 mx-auto">
                            <label for="user_id"><b>Search User by ID</b></label>
                            <input class="form-control" type="text" id="user_id" name="user_id" placeholder="User ID" style="text-align: center" required>
                            <button class="btn btn-dark" type="submit">Search User ID</button><br><br>
                        </div>
                    </form>

                    <!-- Search for user by username -->
                    <form method="post" action="loan_books.php">
                        <div class="col-6 mx-auto">
                            <label for="username_id"><b>Search User by Username</b></label>
                            <input class="form-control" type="text" id="username_id" name="username_id" placeholder="Username" style="text-align: center" required>
                            <button class="btn btn-dark" type="submit">Search Username</button><br><br>
                        </div>
                    </form>

                    <!-- Display user search results -->
                    <?php
                    if (isset($_SESSION['user_data'])) {
                        if (is_array($_SESSION['user_data'])) {
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item"><?php echo '<b>User ID:</b> ' . $_SESSION['user_data']['user_id']; ?></li>
                                <li class="list-group-item"><?php echo '<b>Username:</b> ' . $_SESSION['user_data']['username']; ?></li>
                                <li class="list-group-item"><?php echo '<b>First Name:</b> ' . $_SESSION['user_data']['first_name']; ?></li>
                                <li class="list-group-item"><?php echo '<b>Last Name:</b> ' . $_SESSION['user_data']['last_name']; ?></li>
                                <li class="list-group-item"><?php echo '<b>Email:</b> ' . $_SESSION['user_data']['email']; ?></li>
                            </ul>
                            <?php
                        } else {
                            echo $_SESSION['user_data']; //No users found
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col text-center">
            <div class="card">
                <div class="card-header">
                    <h1><b>Book Identification</b></h1>
                </div>
                <div class="card-body">

                    <!-- Search for book by ID -->
                    <form method="post" action="loan_books.php">
                        <div class = "col-6 mx-auto">
                            <label for="book_id"><b>Search Book by ID</b></label>
                            <input class="form-control" type="text" id="book_id" name="book_id" placeholder="Book ID" style="text-align: center" required>
                            <button class = "btn btn-dark" type="submit">Search Book ID</button><br><br>
                        </div>
                    </form>

                    <!-- Search for book by Title -->
                    <form method="post" action="loan_books.php">
                        <div class = "col-6 mx-auto">
                            <label for="book_name"><b>Search Book by Name</b></label>
                            <input class="form-control" type="text" id="book_name" name="book_name" placeholder="Book Title" style="text-align: center" required>
                            <button class = "btn btn-dark" type="submit">Search Book Name</button><br><br>
                        </div>
                    </form>

                    <!-- Display book search results -->
                    <?php
                    if (isset($_SESSION['book_data'])) {
                        if (is_array($_SESSION['book_data'])) {?>
                        <ul class="list-group">
                            <li class="list-group-item "><?php echo '<b>Book ID:</b> ' . $_SESSION['book_data']['book_id']; ?></li>
                            <li class="list-group-item "><?php echo '<b>Title:</b> ' . $_SESSION['book_data']['title']; ?></li>
                            <li class="list-group-item "><?php echo '<b>Author:</b> ' . $_SESSION['book_data']['author']; ?></li>
                            <li class="list-group-item "><?php echo '<b>Publication Year:</b> ' . $_SESSION['book_data']['published_year']; ?></li>
                            <li class="list-group-item "><?php echo '<b>Available Copies:</b> ' . $_SESSION['book_data']['available_copies']; ?></li>
                        </ul>
                        <?php } else {
                            echo $_SESSION['book_data']; //No books found
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center"
         <label for ="finalize">

        <?php if ((isset($_SESSION['book_data']))&&(isset($_SESSION['user_data']))){
                if(is_array($_SESSION['user_data'])&&(is_array($_SESSION['book_data']))) {
                    if($_SESSION['book_data']['available_copies'] > 0) {
                        if($_SESSION['user_data']['loaned_books']<5) {?>


                            <br><form method="post" action="loan_books.php">

                                <button class = "btn btn-dark" type="submit" id = "finalize" name = "finalize">Finalize</button>
                            </form>
                 <?php } else {
                            echo 'The user has loaned too many books';
                        }
                    } else {
                            echo 'No available copies';
                    }
                }
        } ?>
         </label>
    </div>
</div>

<!-- Modal for loan finalization confirmation -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Loan Finalized</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                The loan has been successfully finalized. What would you like to do next?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.href='admin.php';">Add Another Loan</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='loans.php';">View All Loans</button>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>