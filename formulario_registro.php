<?php
// Mostrar errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
require 'config.php';

// Mensaje de respuesta
$mensaje = "";

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"], $_POST["password"], $_POST["email"])) {

        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];

        try {
            $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $password, $email]);
            $mensaje = "✅ Usuario registrado correctamente.";
        } catch (PDOException $e) {
            $mensaje = "❌ Error: " . $e->getMessage();
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
  <title>Formulario de Registro</title>
</head>
<body>
  <h2>Registro de Usuario</h2>

  <?php if (!empty($mensaje)) echo "<p><strong>$mensaje</strong></p>"; ?>

  <form method="POST" action="">
    <label for="username">Nombre de usuario:</label><br>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" name="password" id="password" required><br><br>

    <label for="email">Correo electrónico:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <input type="submit" value="Registrarse">
  </form>
</body>
</html>

