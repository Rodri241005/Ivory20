<?php
header("Content-Type: application/json");
$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Error de conexión a la base de datos"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$fullName = $data["fullName"];
$email = $data["email"];
$username = $data["username"];
$password = password_hash($data["password"], PASSWORD_DEFAULT);

// Verificar si el usuario ya existe
$checkQuery = $conn->prepare("SELECT Usuario FROM user WHERE Usuario = ?");
$checkQuery->bind_param("s", $username);
$checkQuery->execute();
$checkQuery->store_result();

if ($checkQuery->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "El nombre de usuario ya está en uso"]);
    exit();
}

// Insertar nuevo usuario
$query = $conn->prepare("INSERT INTO user (Nombre, Correo, Usuario, Contraseña) VALUES (?, ?, ?, ?)");
$query->bind_param("ssss", $fullName, $email, $username, $password);

if ($query->execute()) {
    echo json_encode(["success" => true, "message" => "Registro exitoso"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al registrar usuario"]);
}

$conn->close();
?>
