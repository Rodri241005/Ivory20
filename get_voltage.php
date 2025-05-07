<?php
$host = "db4free.net";
$user = "rodrigorrg"; 
$password = "36197540"; 
$database = "ivorydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Fallo en la conexión a la base de datos"]));
}

$type = isset($_GET['type']) ? $_GET['type'] : "CD";

$sql = "SELECT voltage FROM voltage_measurements WHERE type = '$type' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["voltage" => $row["voltage"]]);
} else {
    echo json_encode(["error" => "No hay datos"]);
}

$conn->close();
?>

