<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
    $_SESSION = array();
    session_destroy();
    header('Location: login.php');
    exit();
}elseif (isset($_SESSION['username']) && $_SESSION['admin_logged_in'] === true){
    $_SESSION = array();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}else{
    header("Location: index.php");
    exit();
}