
<?php include "db.php"?>
<?php include "functions.php"?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $error = "";
    if (!$username||!$email||!$password||!$confirm_password) {
        $error = "All fields are required";
    }else {
        if ($password !== $confirm_password) {
            $error = 'Password did not match';
        } else {
            if (user_exists($conn, $username)) {
                $error = 'Username already exists';
            } else {
                if (email_exists($conn, $email)) {
                    $error = 'Email already exists';
                } else {
                    $result = create_account($conn, $username,  $password, $email);
                    if ($result) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $username;
                        header('Location: account.php');
                    } else {
                        $error = "Signup Failed";
                    }
                }
            }
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
    <title>Signup Page</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include "includes\header.php"; ?>
    <h1 class = "d-flex justify-content-center"> Signup Page </h1>
    <form method = "post" action = "signup.php">
        <div class = "d-flex justify-content-center mt-5 py-5">
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
                <div class = "form-group">
                    <label for = "confirm_password">Password
                        <input type = "password" class = "form-control" name = "confirm_password" placeholder = "Confirm Password">
                    </label><br><br>
                </div>
                <div class = "form-group">
                    <label for = "email">Email
                        <input type = "email" class = "form-control" name = "email" placeholder = "Enter your email">
                    </label><br><br>
                </div>
                <input type = "submit" class="btn btn-primary" id = "login" value = "Create Account"><br><br>
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

