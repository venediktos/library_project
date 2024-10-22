<?php
include "db.php";
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Query to retrieve all loans from the database
$query = "SELECT b.borrow_id, b.borrow_date, b.return_date, u.username, bk.title, b.completed, b.completed_date 
          FROM borrowed b
          JOIN users u ON b.user_id = u.user_id
          JOIN books bk ON b.book_id = bk.book_id
          ORDER BY b.borrow_date ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>All Loans</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include("includes/header.php"); ?>

<div class="container mt-5 py-5">
    <h1 class="text-center">All Loans</h1>
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-dark">
        <tr>
            <th>Borrow ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                                echo "<td>{$row['borrow_id']}</td>";
                                echo "<td>{$row['username']}</td>";
                                echo "<td>{$row['title']}</td>";
                                echo "<td>{$row['borrow_date']}</td>";
                                echo "<td>{$row['return_date']}</td>";
                                if ($row['completed'] == 0) {
                                    echo "<td>Not Completed</td>";
                                } else {
                                    echo "<td>Completed: {$row['completed_date']}</td>";
                                }
                                echo "<td>
                                    <a href='manage_loans.php?borrow_id={$row['borrow_id']}' class='btn btn-success'>Manage</a>
                                </td>
                              </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No loans found</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Button to add a new loan -->
    <div class="text-center mt-4">
        <a href="loan_books.php" class="btn btn-dark">Add New Loan</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>