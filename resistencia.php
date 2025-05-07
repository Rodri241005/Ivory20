<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    die(json_encode(["error" => "No se recibieron datos"]));
}

$campo = key($data);
$valor = $data[$campo];

// Aseguramos que la columna enviada sea válida
$columnas_validas = ["Ohm", "Live"];
if (!in_array($campo, $columnas_validas)) {
    die(json_encode(["error" => "Columna inválida"]));
}

$sql = "INSERT INTO resistencia ($campo) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $valor); // "d" significa double/float

if ($stmt->execute()) {
    echo json_encode(["success" => "Dato guardado correctamente"]);
} else {
    echo json_encode(["error" => "Error al guardar los datos"]);
}

$stmt->close();
$conn->close();
?>

