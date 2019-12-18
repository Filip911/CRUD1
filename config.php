<?php 

    $server = 'localhost';
    $uname = 'root';
    $pwd = '';


    $conn = new mysqli('localhost', 'root', '');

    if($conn->connect_error) {
        die("Not able to connect to Database!" . $conn->connect_error);
    } else {
       echo 'Successfully connected ' . $conn->host_info; 
    }