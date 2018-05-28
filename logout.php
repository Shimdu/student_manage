<?php

// Start sessions 
session_start();

// Destory the session and redirect to login.php
if (session_destroy()) {
    header('location: index.php');
}

?>