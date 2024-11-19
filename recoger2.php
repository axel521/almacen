
<?php

$nombre= $_POST['nombre'];
$Edad= $_POST['Edad'];
$Fecha=$_POST['Fecha'];
$VIP= $_POST['VIP'];
$Provincia= $_POST['Provincia'];
$direccion= $_POST['direccion'];

include 'db.php';

try {
    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO compania (nombre, Edad, Fecha, VIP, Provincia, direccion) VALUES (?, ?, ?, ?, ?, ?)");

    // Enlazar parámetros
    $stmt->execute([$nombre, $Edad, $Fecha, $VIP, $Provincia, $direccion]);

    echo "correcto";
    header(header: "location: welcome.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>