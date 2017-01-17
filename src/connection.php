<?php
$servername = 'localhost';
$username = 'root';
$password = 'CodersLab';
$basename = 'Simple-shop';

$connection = new mysqli($servername, $username, $password, $basename);

$connection->query('SET NAMES utf8');
$connection->query('SET CHARACTER_SET utf8_unicode_ci');

if($connection->connect_error) {
    die("Connection failed: $connection->connect_error");
}