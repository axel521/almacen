<html>
	<html>
	<head>
		<title>Ejercicio 70</title>
		<meta charset="UTF-8" />
		<style>
			th{
				border : 5px solid gray;
				background : blue;
                text-shadow: black;  
                width: 10%;
			}
	    </style>
	</head>
	<body>
	<?php
		include 'conexion2.php'; 
		$consulta = $conexion2 -> query("SELECT * FROM `compania` ORDER BY `compania`.`nombre` ASC") or die ("Ha fallado la conexión");
			while ( $registro = $consulta -> fetch_assoc() ) {
				echo '<table>'.
				"<th>nombre</th>
				 <th>Edad</th>
				 <th>Fecha</th>
				 <th>VIP</th>
				 <th>Provincia</th>
				 <th>direccion</th>".

				"<tr>".
				"<td>".$registro['nombre']."</td>".
				"<td>".$registro['Edad']."</td>".
				"<td>".$registro['Fecha']."</td>".
				"<td>".$registro['VIP']."</td>".
				"<td>".$registro['Provincia']."</td>".
				"<td>".$registro['direccion']."</td>".
			    "</tr>".
			    "</table>";
               }
			    $conexion2=null;
	?>

	<br>

	</body>
	</html>