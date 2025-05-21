<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta
$sql = "SELECT id_empleado, nombre, email, direccion, telefono, foto FROM empleados ORDER BY id_empleado ASC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados</title>
    <style>
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 100px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #999;
            text-align: left;
        }
        th {
            background-color:rgb(76, 175, 79);
            color: white;
        }
        h1 {
            margin-left: 280px;
            color: #1c3e74;
        }
        img {
            border-radius: 5px;
        }

        .principal {
			margin-top: -315px;         /* un valor positivo */
			padding-left: 675px;
            display: flex;              /*Para ponerlos en horizoltal*/
		}
		
		.principal button {
			display: flex; 				/*Para que se acomoden uno debajo del otro*/
			width: 150px;                /* Largo */
			padding: 15px;             /* Ancho del boton*/
            margin-right: 20px;     /* Espacio entre botones */
            font-size: 16px;			/**Tamaño de la letra*/
			cursor: pointer;			/*Forma cursor*/
			background-color: #1c3e74;
			color: white;
			border: none;
			border-radius: 8px;          
			text-align: center;            /* Opcional: alinea texto dentro del botón a la izquierda */
		}
        .principal a {
    		text-decoration: none;
		}
        
    </style>
</head>
<body>
    <h1>Empleados</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Foto</th>
        </tr>

        <?php
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_empleado"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["direccion"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                if (!empty($row["foto"])) {
                    echo "<td><img src='fotos_empleados/" . $row["foto"] . "' width='80'></td>";
                } else {
                    echo "<td>Sin foto</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay empleados registrados.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>

    <div class="principal">
        <a href="principal.html">
        	<button type="button">Volver al inicio</button>
        </a>

        <a href="registro_empleados.html">
			<button type="button">Registro</button>
		</a>

		<a href="modificar.html">
			<button type="button">Modificar</button>
		</a>
	</div>
</body>
</html>
