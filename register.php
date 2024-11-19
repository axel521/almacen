<?php
include 'db.php'; // Asegúrate de que el archivo db.php esté correctamente configurado
session_start();

// Mostrar errores para debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']); // Sanitize input
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Cifra la contraseña

    // Consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $conn->prepare($sql);

    try {
        if ($stmt->execute(['username' => $username, 'password' => $password])) {
            $message = "<p>Registro exitoso.</p><p><a href='login.php'>Iniciar sesión</a></p>";
        } else {
            $message = "Error al registrar.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage(); // Mostrar error si la consulta falla
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(descarga.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        form {
            background-color: white;
            border: 2px solid #ccc;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: greenyellow;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: blue;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            color: green;
        }
    </style>
</head>
<body>
    <form action="index.php" method="POST"> <!-- Cambié 'register.php' por 'index.php' -->
        <h2>Registro de usuario</h2>
        <label for="username">Nombre:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Registrarse</button>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
            