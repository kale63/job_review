<?php

$host = 'localhost';
$dbname = 'marketzone';
$username = 'root';
$password = '';

$my_sqli = new mysqli($host, $username, $password, $dbname);

if ($my_sqli->connect_errno) {
    die("Connection error: " . $my_sqli->connect_error);
}

return $my_sqli;