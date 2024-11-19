
<?php

$nombre= $_POST['nombre'];
$Provincia= $_POST['Provincia'];

include 'conexion2.php';
$consulta = $conexion2 -> query("SELECT nombre, Provincia FROM compania WHERE Provincia='Madrid'");

echo "correcto";
?>