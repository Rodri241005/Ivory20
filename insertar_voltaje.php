<?php
header("Content-Type: application/json"); 

$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";


$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$tipo = $_POST['tipo'];         
$valor = $_POST['valor'];      
$unidad = $_POST['unidad'];    
$indicador = $_POST['indicador']; 


$sql = "INSERT INTO voltajes (tipo, valor, unidad, indicador) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sdss", $tipo, $valor, $unidad, $indicador);

if ($stmt->execute()) {
    echo "Medición guardada correctamente.";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
