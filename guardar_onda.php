<?php

$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Conexión fallida"]));
}

$voltaje_pico = $_POST['voltaje_pico'];
$voltaje_pico_pico = $_POST['voltaje_pico_pico'];
$amplitud = $_POST['amplitud'];
$frecuencia = $_POST['frecuencia'];
$ancho_banda = $_POST['ancho_banda'];
$division_voltaje = $_POST['division_voltaje'];
$division_tiempo = $_POST['division_tiempo'];
$nota = $_POST['nota'];

$sql = "INSERT INTO medicion_senal (voltaje_pico, voltaje_pico_pico, amplitud, frecuencia, ancho_banda, division_voltaje, division_tiempo, nota) 
        VALUES ('$voltaje_pico', '$voltaje_pico_pico', '$amplitud', '$frecuencia', '$ancho_banda', '$division_voltaje', '$division_tiempo', '$nota')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Datos guardados"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al guardar"]);
}

$conn->close();
?>
