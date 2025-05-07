<?php
header("Content-Type: application/json"); 

$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";    

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (
    !isset($_POST['tipo']) || 
    !isset($_POST['valor']) || 
    !isset($_POST['unidad']) || 
    !isset($_POST['indicador']) || 
    !isset($_POST['id_imagen'])
) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan datos en la solicitud."]);
    exit;
}

$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$unidad = $_POST['unidad'];
$indicador = $_POST['indicador'];
$id_imagen = $_POST['id_imagen'];

$sql = "INSERT INTO intensidad (tipo, valor, unidad, indicador, id_imagen) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssi", $tipo, $valor, $unidad, $indicador, $id_imagen);

if ($stmt->execute()) {
    $idInsertado = $stmt->insert_id;
    echo json_encode([
        "status" => "ok",
        "mensaje" => "Medición guardada correctamente.",
        "id" => $idInsertado
    ]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al guardar: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
