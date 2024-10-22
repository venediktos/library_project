
<?php include "db.php" ?>
<?php session_start();

// Redirect if admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: loans.php');
    exit;
}

?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //SQL Injection Prevention
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Query admin by username
    $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $error = "";

    if (mysqli_num_rows($result) === 0) {
        $error = "Failed to login: Username is incorrect";
    } else{
        $row = mysqli_fetch_assoc($result);
        // Check password match
        if ($password === $row["password"]) {
            $_SESSION["username"] = $username;
            $_SESSION["admin_logged_in"] = true;
            header("Location: loans.php");
        } else {
            $error = "Failed to login: Password is incorrect";
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
    <title>Admin Login Page</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include "includes\header.php"; ?>
<h2 class = "d-flex justify-content-center mt-5 py-5">Admin Login Page </h2> <br>
<form method = "post" action = "admin_login.php">
    <div class = "d-flex justify-content-center ">
        <div class=”align-self-center”>
            <div class = "form-group">
                <label for = "username">Username
                    <input type = "text" class = "form-control" name = "username" placeholder = "Enter Username">
                </label><br><br>
            </div>
            <div class = "form-group">
                <label for = "password">Password
                    <input type = "password" class = "form-control" name = "password" placeholder = "Enter Password">
                </label><br><br>
            </div>
            <input type = "submit" class="btn btn-primary" id = "login"  value = "Login"><br><br>
            <?php if(!empty($error)) {
                echo " <span style = 'color:red'> $error<br> </span>";
            }?>
        </div>
    </div>
</form>
<?php include("includes/footer.php");?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>