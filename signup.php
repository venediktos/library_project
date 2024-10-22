
<?php include "db.php"?>

<?php include "classes.php"?>
<?php
session_start();

// Prevent access to the signup page if the user is already logged in
if (!isset($_SESSION['account_created'])) {
    if ((isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) ||
        (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)) {
        header("location:index.php"); // Redirect to index if logged in
        exit();
    }
}
// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $error = "";

    $user = new User($conn); // Create User object

    if (!$username || !$email || !$password || !$confirm_password) {
        $error = "All fields are required"; // Check for empty fields
    } else {
        if ($password !== $confirm_password) {
            $error = 'Password did not match'; // Check for matching passwords
        } else {
            if (strlen($password) < 6) {
                $error = 'Password has to be at least 6 characters long'; // Validate password length
            } else{
                if ($user->userExists($username)) {
                    $error = 'An account with this Username already exists'; // Check if username exists
                } else {
                    if ($user->emailExists($email)) {
                        $error = 'An account with this Email already exists'; // Check if email exists
                    } else {
                        $alphabetic = True; // Flag for alphabetic check
                        $names = explode(" ", $first_name); // Lenience for multiuple names
                        for ($i = 0; $i < sizeof($names); $i++) {
                            if (!(ctype_alpha($names[$i]))) {
                                $alphabetic = False;
                                break;
                                }
                        }
                        if ($alphabetic === False){
                            $error = 'First name must consist of letters only';

                        } else {
                            // Alphabetic is true since we got here
                            $names = explode(" ", $last_name);
                            for ($i = 0; $i < sizeof($names); $i++) {
                                if (!(ctype_alpha($names[$i]))) {
                                    $alphabetic = False;
                                    break;
                                }
                            }
                            if ($alphabetic === False) {
                                $error = 'Last name must consist of letters only';
                            } else {
                                // Create user account
                                $result = $user->createUser($username, $password, $email, $first_name, $last_name);
                                if ($result) {
                                    // Set session variables
                                    $_SESSION['account_created'] = true;
                                    $_SESSION['logged_in'] = true;
                                    $_SESSION['username'] = $username;
                                    header('Location: signup.php'); // Redirect to signup page
                                    exit();
                                } else {
                                    $error = "Signup Failed";
                                }
                            }
                        }
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
            <div class="align-self-center">
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
                    <label for = "first_name">First Name
                        <input type = "text" class = "form-control" name = "first_name" placeholder = "Enter First Name">
                    </label><br><br>
                </div>
                <div class = "form-group">
                    <label for = "last_name">Last Name
                        <input type = "text" class = "form-control" name = "last_name" placeholder = "Enter Last Name">
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

    <!-- Modal for account creation confirmation -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Account Created</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your account has been successfully created.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php");?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_SESSION['account_created']) && $_SESSION['account_created'] == 'true') { ?>
            let myModal = new bootstrap.Modal(document.getElementById('signupModal'), {
                backdrop: 'static',
                keyboard: false
            });

            myModal.show(); // Show modal
            <?php unset($_SESSION['account_created']); ?>
            document.getElementById('signupModal').addEventListener('hidden.bs.modal', function () {
                window.location.href = 'account.php'; // Redirect after closing modal
            });
            <?php } ?>
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

