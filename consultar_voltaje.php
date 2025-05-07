<?php
header("Content-Type: application/json");


$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";



$conn = new mysqli($host, $usuario, $contrasena, $base_datos);


if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión: " . $conn->connect_error]);
    exit();
}


$sql = "SELECT voltaje, voltaje_ac FROM mediciones ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Verificar resultados
if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();

    
    $voltajeCD = isset($fila["voltaje"]) ? floatval($fila["voltaje"]) : 0.0;
    $voltajeAC = isset($fila["voltaje_ac"]) ? floatval($fila["voltaje_ac"]) : 0.0;

    echo json_encode([
        "voltajeCD" => $voltajeCD,
        "voltajeCA" => $voltajeAC
    ]);
} else {
    echo json_encode(["error" => "No se encontraron datos"]);
}

$conn->close();
?>
