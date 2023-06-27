<?php

$servername = "localhost";

$username = "root";
$password = "testtest";
$database = "ygSaloon";

// $username = "sahaame_salon_user";
// $password = "testtest123";
// $database = "sahaame_ygSalon";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
