<?php include "includes\header.php"; ?>
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
                    password_hash($password, PASSWORD_DEFAULT);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                    $result = mysqli_query($conn, $query);
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
    if(!empty($error)){
        echo $error;
    }
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Signup Page</title>
</head>
<body>
    <h1 class = "d-flex justify-content-center"> Signup Page </h1>
    <form method = "post" action = "signup.php">
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
                <input type = "submit" class="btn btn-primary" id = "login" value = "Create Account">
            </div>
        </div>
    </form>
</body>
</html>

