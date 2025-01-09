<?php
    $host = '127.0.0.1';
    $username = 'root';
    $password_db = '';
    $database = 'TastyBites';
    
    $conn = mysqli_connect($host, $username, $password_db, $database);

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>
