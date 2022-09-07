<?php

    //Database configuration
    $dbhost ='localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'images';

    //Create database connection
    $db = new mysqli($dbhost, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Connection failed: ".$db->connect_error);
    }
?>