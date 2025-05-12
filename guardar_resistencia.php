<?php

$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";


$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$value = isset($_POST['value']) ? $_POST['value'] : null;
$unit = isset($_POST['unit']) ? $_POST['unit'] : null;
$timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : null;
$indicator = isset($_POST['indicator']) ? $_POST['indicator'] : null;

if ($value !== null && $unit !== null && $timestamp !== null && $indicator !== null) {
    $stmt = $conn->prepare("INSERT INTO recistencia (value, unit, timestamp, indicator) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $value, $unit, $timestamp, $indicator);

    if ($stmt->execute()) {
        echo "Éxito";
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan parámetros";
}

$conn->close();
?>
