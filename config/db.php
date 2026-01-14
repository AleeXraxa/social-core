<?php
    $host = 'Localhost';
    $username = 'root';
    $pass = "";
    $db = 'social-core';

    $conn = mysqli_connect($host,$username,$pass,$db);

    if($conn-> connect_error){
        die("Connection Failed:" . $conn->connect_error);
    }
    

?>