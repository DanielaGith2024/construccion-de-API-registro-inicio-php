<?php
session_start();
require 'config.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['usuario'] = $user['username'];
            $mensaje = "✅ Autenticación exitosa. ¡Bienvenido, {$user['username']}!";
        } else {
            $mensaje = "❌ Usuario o contraseña incorrectos.";
        }
    } else {
        $mensaje = "⚠️ Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
</head>
<body>
  <h2>Iniciar Sesión</h2>

  <?php if (!empty($mensaje)) echo "<p><strong>$mensaje</strong></p>"; ?>

  <form method="POST" action="">
    <label for="username">Usuario:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Iniciar sesión">
  </form>
</body>
</html>
