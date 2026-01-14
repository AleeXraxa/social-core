<?php
session_start();
    include '../config/db.php';

    if(!isset($_SESSION['user_id']) ){
        header('location: ../auth/login.php');
        exit();
    }

?>