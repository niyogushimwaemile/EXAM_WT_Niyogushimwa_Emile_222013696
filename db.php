<?php
    // Establishing database connection
    $con = mysqli_connect("localhost", "root", "", "subscription box service");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>