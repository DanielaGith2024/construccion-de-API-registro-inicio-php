
# 🛡️ Sistema de Registro e Inicio de Sesión en PHP

Este proyecto es una aplicación web básica que permite a los usuarios **registrarse** e **iniciar sesión** utilizando PHP y MySQL.

---

## ✅ Requisitos

- ✅ PHP 8.0 o superior  
- ✅ MySQL o MariaDB  
- ✅ Servidor local (recomendado: [Laragon](https://laragon.org/), XAMPP, etc.)  
- ✅ Navegador web  
- ✅ Cliente de base de datos (opcional): [HeidiSQL](https://www.heidisql.com/) o [phpMyAdmin](https://www.phpmyadmin.net/)  

---

## ⚙️ Instalación y Configuración

### 1. Clona el repositorio

```bash
git clone https://github.com/tu-usuario/tu-repo.git
```

> Asegúrate de colocar los archivos en el directorio raíz de tu servidor local, por ejemplo: `C:\laragon\www\auth_api_php`

---

### 2. Crea la base de datos

Abre **HeidiSQL**, **phpMyAdmin** u otro cliente, y ejecuta:

```sql
CREATE DATABASE auth_db;
USE auth_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

---

### 3. Configura la conexión en `config.php`

Edita el archivo `config.php` con los datos de tu base de datos:

```php
<?php
$host = "localhost";
$dbname = "auth_db";
$user = "root";
$pass = "dani.MySql.123"; // Cambia por tu contraseña real

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
```

---

## 🚀 Uso del Sistema

### 📝 Registro de usuario

1. Abre en tu navegador:  
   [http://localhost/auth_api_php/formulario_registro.php](http://localhost/auth_api_php/formulario_registro.php)

2. Llena los datos y haz clic en **Registrarse**

---

### 🔐 Inicio de sesión

1. Abre en tu navegador:  
   [http://localhost/auth_api_php/formulario_login.php](http://localhost/auth_api_php/formulario_login.php)

2. Ingresa tu nombre de usuario y contraseña registrados.

---

## 👥 Desarrollado por

- 👨‍💻 Daniel Alejandro Vargas Uzuriaga  
- 👩‍💻 Daniela López Chica  
- 👨‍💻 Jonathan Cardona Calderón  
- 👩‍💻 Luz Eleidis Baldovino González  

🎓 Programa: **Tecnólogo en Análisis y Desarrollo de Software**  
📘 Ficha Técnica: **2977435**
