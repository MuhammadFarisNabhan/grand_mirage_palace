<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grand_mirage_palace";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>