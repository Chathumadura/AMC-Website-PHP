<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // <-- Put your MySQL password here if you have set one
    $db = "amc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
?>
