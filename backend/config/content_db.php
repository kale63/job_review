<?php

$host = "localhost";
$dbname = "content_db";
$username = "root";
$password = "";

$my_sqli = new mysqli(hostname: $host, username: $username, password: $password, database: $dbname);

if ($my_sqli->connect_errno) {
    die("Connection error: " . $my_sqli->connect_error);
}

return $my_sqli;