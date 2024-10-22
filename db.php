<?php
// Establish connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "library");
// Check if connection failed and display an error message
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
}