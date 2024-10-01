<?php

$conn = mysqli_connect("localhost", "root", "", "library");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
}