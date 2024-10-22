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

function find_book($conn, $book_id){
    $query = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function create_account($conn, $username, $password, $email){
    password_hash($password, PASSWORD_DEFAULT);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    return mysqli_query($conn, $query);
}

