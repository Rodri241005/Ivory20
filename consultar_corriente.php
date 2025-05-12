<?php
header("Content-Type: application/json");
$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";


$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión: " . $conn->connect_error]);
    exit();
}


$query = "SELECT corriente, corriente_ac FROM mediciones ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    echo json_encode([
        'corriente' => floatval($row['corriente']),
        'corrienteAC' => floatval($row['corrienteAC'])
    ]);
} else {
    echo json_encode([
        'error' => 'No se encontraron datos'
    ]);
}

// Cerrar conexión
mysqli_close($conexion);
?>
