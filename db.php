<?php
$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
