<?php
session_start(); // Inicia sesión
include 'db.php'; // Conexión a la base de datos

$message = "";
$user = null;  // Inicializar la variable $user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']); // Sanitize input
    $password = $_POST['password']; // La contraseña no debe estar cifrada en el login

    // Verifica si el usuario existe en la base de datos
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user

    // Verifica si la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Si la contraseña es correcta, guarda el nombre de usuario en la sesión
        $_SESSION['username'] = $user['username'];

        // Redirige al usuario a una página de bienvenida (o panel de usuario)
        header("Location: welcome.php");
        exit(); // Asegúrate de que el script se detenga aquí
    } else {
        // Si el usuario o la contraseña son incorrectos
        $message = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(entrada-3.jpg);
            background-repeat: repeat;
            background-size: cover;
        }
        form {
            background-color: white;
            border: 2px solid #ccc;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
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
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: blue;
            color: white;
        }
        .message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <label for="username">Nombre:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Entrar</button>

        <!-- Mostrar mensajes de error -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
