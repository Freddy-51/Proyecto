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
            text-align: center;
            color: #1c3e74;
        }
        img {
            border-radius: 5px;
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
</body>
</html>
