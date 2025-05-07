<?php
header("Content-Type: application/json");

$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";

$data = json_decode(file_get_contents("php://input"), true);


if ($data === null || !isset($data['Usuario']) || !isset($data['Contraseña'])) {
    echo json_encode(array("success" => false, "message" => "Faltan parámetros"));
    exit;
}

$usuario = $data['Usuario'];  // Usuario
$contraseña = $data['Contraseña'];  // Contraseña

// Validar si los parámetros no están vacíos
if (empty($usuario) || empty($contraseña)) {
    echo json_encode(array("success" => false, "message" => "Faltan parámetros"));
    exit;
}

// Conectar a la base de datos
$conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo json_encode(array("success" => false, "message" => "Error de conexión: " . $conn->connect_error));
    exit;
}

// Consulta SQL para verificar el usuario
$sql = "SELECT * FROM user WHERE Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario); // Solo necesitamos el 'Usuario' para la búsqueda
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuario encontrado, ahora verificar la contraseña
    $row = $result->fetch_assoc();
    if (password_verify($contraseña, $row['Contraseña'])) { // Verificar la contraseña cifrada
        $response = array("success" => true, "message" => "Login exitoso");
    } else {
        // Contraseña incorrecta
        $response = array("success" => false, "message" => "Usuario o contraseña incorrectos");
    }
} else {
    // Usuario no encontrado
    $response = array("success" => false, "message" => "Usuario o contraseña incorrectos");
}

// Enviar la respuesta
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

