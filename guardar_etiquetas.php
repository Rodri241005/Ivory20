<?php
$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb"; 

// Conectar a la base de datos
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Fallo en la conexión: " . $conn->connect_error]);
    exit;
}

// Leer datos del POST
$data = json_decode(file_get_contents("php://input"), true);
$idImagen = $data["idImagen"];
$etiquetas = $data["etiquetas"];

// Insertar etiquetas
$stmt = $conn->prepare("INSERT INTO etiquetas (id_imagen, etiqueta) VALUES (?, ?)");

foreach ($etiquetas as $etiqueta) {
    $stmt->bind_param("is", $idImagen, $etiqueta);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(["success" => true]);
