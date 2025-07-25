<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';
$email = $data['email'] ?? '';

if (!$username || !$password || !$email) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos obligatorios"]);
    exit;
}

try {
    // Verificar si ya existe el usuario o el correo
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute([
        ':username' => $username,
        ':email' => $email
    ]);

    if ($stmt->rowCount() > 0) {
        http_response_code(400);
        echo json_encode(["error" => "El usuario o correo ya está registrado"]);
        exit;
    }

    // Insertar usuario nuevo
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password,
        ':email' => $email
    ]);

    http_response_code(201);
    echo json_encode(["message" => "Usuario registrado exitosamente"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
}
