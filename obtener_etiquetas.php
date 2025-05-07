<?php
header("Content-Type: application/json");

$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$result = $conn->query("SELECT id_imagen, etiqueta FROM etiquetas");

$etiquetas = array();
while ($row = $result->fetch_assoc()) {
    $etiquetas[] = $row;
}

echo json_encode($etiquetas);
$conn->close();


