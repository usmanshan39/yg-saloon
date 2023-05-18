<?php

$servername = "localhost";
$username = "root";
$password = "testtest";
$database = "ygSaloon";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

?>
