<?php

class User
{
    private $conn;

    // Initialize database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Check if a user exists by username
    public function userExists($username)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result) > 0;
    }

    // Check if a user exists by email
    public function emailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result) > 0;
    }

    // Create a new user with hashed password
    public function createUser($username,  $password, $email, $first_name, $last_name){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password, first_name, last_name, loaned_books) VALUES ('$username', '$email', '$password', '$first_name', '$last_name', 0)";
        return mysqli_query($this->conn, $query);
    }
}