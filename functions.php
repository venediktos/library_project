<?php

function user_exists($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function email_exists($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}