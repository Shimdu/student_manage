<?php

// Start sessions 
session_start();

// If the session variable is not set, redirect to login.php
if (!isset($_SESSION['login_user'])) {
    header('location: ../index.php');
}
$username = $_SESSION['login_user'];
?>