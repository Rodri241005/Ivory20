<?php
$conexion = new mysqli("rodrigorrg", "db4free.net", "36197540", "ivorydb");

if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

// Recibir los datos desde el POST
$voltaje = $_POST['voltaje'];
$corriente = $_POST['corriente'];
$resistencia = $_POST['resistencia'];
$frecuencia = $_POST['frecuencia'];
$amplitud = $_POST['amplitud'];
$voltaje_ac = $_POST['voltaje_ac'];
$corriente_ac = $_POST['corriente_ac'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO mediciones (voltaje, corriente, resistencia, frecuencia, amplitud, voltaje_ac, corriente_ac, fecha) 
        VALUES ('$voltaje', '$corriente', '$resistencia', '$frecuencia', '$amplitud', '$voltaje_ac', '$corriente_ac', NOW())";

if ($conexion->query($sql) === TRUE) {
    echo "Datos guardados";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>
