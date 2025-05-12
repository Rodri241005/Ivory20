<?php
$host = "db4free.net";
$user = "rodrigorrg";
$password = "36197540";
$database = "ivorydb";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltajeDC = $_POST['VoltajeDC'];
    $voltajeAC = $_POST['VoltajeAC'];
    $resistencia = $_POST['Ohm'];
    
    $sql1 = "INSERT INTO voltaje (VoltajeDC, VoltajeAC) VALUES ('$voltajeDC', '$voltajeAC')";
    $sql2 = "INSERT INTO resistencia (Ohm) VALUES ('$resistencia')";
    
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
