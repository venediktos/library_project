
<?php include "db.php" ?>
<?php session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: account.php');
    exit;
}

?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $error = "";

    if (mysqli_num_rows($result) === 0) {
        $error = "Login failed: Incorrect username";
    } else{
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["logged_in"] = true;
            header("Location: account.php");
        } else {
            $error = "Login failed: Incorrect password";
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
    <title>Login Page</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include "includes\header.php"; ?>

<h2 class = "text-center  mt-5 py-5">User Login</h2> <br>
<form method = "post" action = "login.php">
    <div class = "d-flex justify-content-center">
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
            <input type = "submit" class="btn btn-dark" id = "login"  value = "Login"><br><br>
            <?php if(!empty($error)) {
                echo " <span class ='text-center' style = 'color:red'> $error<br> </span>";
            }?>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php include("includes/footer.php");?>
</body>
</html>


