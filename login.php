<?php include "includes\header.php"; ?>
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
        $error = "Failed to login: Username is incorrect";
    } else{
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["logged_in"] = true;
            header("Location: account.php");
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
    <title>Login Page</title>
</head>
<body>
<h2 class = "d-flex justify-content-center"> Login Page </h2> <br>
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
            <input type = "submit" class="btn btn-primary" id = "login"  value = "Login"><br><br>
            <?php if(!empty($error)) {
                echo " <span style = 'color:red'> $error<br> </span>";
            }?>
        </div>
    </div>
</form>

</body>
</html>


