<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta
$sql = "SELECT id_cliente, nombre, email, telefono, direccion FROM clientes ORDER BY id_cliente ASC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CLIENTES</title>
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
            margin-left: 300px;
            color: #1c3e74;
        }
        img {
            border-radius: 5px;
        }

        .principal {
			margin-top: -165px;         /* Desplazamineto vertical */
			padding-left: 678px;        /* Desplazamineto horizontal */
            display: flex;              /*Para ponerlos en horizoltal*/
            text-align: center;
            text-decoration: none;
        }

		
		.principal button {
			width: 150px;                /* Largo */
			padding: 15px;             /* Ancho del boton*/
            margin-right: 20px;     /* Espacio entre botones */
            font-size: 16px;			/**Tamaño de la letra*/
			cursor: pointer;			/*Forma cursor*/
			background-color: #1c3e74;  /* Color de fondo */
			color: white;                   /* Color de texto */
        	border: none;                   /* Sin borde */
			border-radius: 8px;          /* Bordes redondeados */
		}
        
        .boton-modificar {
            background-color: rgb(255, 0, 0) !important;
            color: white !important;
        }

            
    </style>
</head>
<body>
    <h1>Clientes</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Teléfono</th>
            <th>Direccion</th>
        </tr>

        <?php
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_cliente"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["direccion"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay productos registrados.</td></tr>";
        }
        $conexion->close();
        ?>
    </table>

    <div class="principal">
        <a href="registro_clientes.html">
			<button type="button">Registro</button>
		</a>
        <a href="modificar.html">
            <button type="button" class="boton-modificar">Modificar</button>
         </a>

        <a href="principal.html">
        	<button type="button">Volver al inicio</button>
        </a>
	</div>
</body>
</html>