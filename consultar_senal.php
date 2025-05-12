<?php

header("Content-Type: application/json"); 

$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";


$conn = new mysqli($host, $user, $password, $database);

// Verificar si hay error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la señal
$sql = "SELECT * FROM senales WHERE id = 1";  // Asumiendo que tienes una tabla `senales`
// Ajusta el `id` o condiciones según tu estructura de base de datos
$result = $conn->query($sql);

// Verificar si la consulta devolvió algún resultado
if ($result->num_rows > 0) {
    // Obtener los datos de la señal
    $row = $result->fetch_assoc();

    // Preparar la respuesta en formato JSON
    $respuesta = array(
        "voltaje" => $row["voltaje"],
        "voltaje_pico" => $row["voltaje_pico"],
        "voltaje_pico_pico" => $row["voltaje_pico_pico"],
        "amplitud" => $row["amplitud"],
        "frecuencia" => $row["frecuencia"],
        "ancho_banda" => $row["ancho_banda"],
        "tipo_onda" => $row["tipo_onda"]
    );

    // Convertir la respuesta a JSON y enviarla
    echo json_encode($respuesta);
} else {
    // En caso de no encontrar datos
    echo json_encode(array("mensaje" => "No se encontraron datos"));
}

// Cerrar la conexión
$conn->close();
?>

