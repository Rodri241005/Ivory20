<?php
$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"];
$code = $data["code"];

$pdo = new PDO("mysql:host=localhost;dbname=ivory", "root", "");
$stmt = $pdo->prepare("SELECT * FROM verification_codes WHERE email = ? AND code = ? AND expiration > NOW()");
$stmt->execute([$email, $code]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => true, "message" => "Código verificado correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Código incorrecto o expirado"]);
}
