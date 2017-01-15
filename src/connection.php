<?php

$servername = 'localhost';
$userName = 'root';
$password = 'CodersLab';
$dbname = 'Simple-shop';

$connection = new mysqli($servername, $userName, $password, $dbname);

if($connection->connect_error){
    die("Connection to database $dbname failed: $connection->connect_error");
}

echo "Connection to database $dbname successful!<br>";