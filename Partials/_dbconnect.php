<?php
//Script to connect to the dtabase
    $severname = "localhost";
    $username = "root";
    $password = "";
    $database = "code talk";
    $conn = mysqli_connect($severname,$username,$password,$database);
    if(!$conn)
    {
        die("Please, Try after sometime.");
    }
?>