<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar condición
$where = "";

// Verificar si hay búsqueda
if (!empty($_GET['filtro']) && !empty($_GET['valor'])) {
    $filtro = $conexion->real_escape_string($_GET['filtro']);
    $valor = $conexion->real_escape_string($_GET['valor']);

    if ($filtro == 'fecha_actualizacion') {
        $where = "WHERE $filtro = '$valor'";
    } else {
        $where = "WHERE $filtro LIKE '%$valor%'";
    }
}

// Consulta para obtener productos
$sql = "SELECT id_producto, clave, nombre, precio, costo, 
        existencias, departamento, unidad, fecha_actualizacion 
        FROM productos $where ORDER BY id_producto ASC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>INVENTARIO</title>
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
            background-color: #1c3e74;
            color: white;
        }
        h1 {
            text-align: center;
            color: #1c3e74;
        }
    </style>
</head>
<body>
    <h1>Inventario</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="inventario.php" style="text-align: center; margin: 20px 0;">
        <select name="filtro" required>
            <option value="">-- Buscar por --</option>
            <option value="clave" <?php if ($_GET['filtro'] ?? '' === 'clave') echo 'selected'; ?>>Clave</option>
            <option value="nombre" <?php if ($_GET['filtro'] ?? '' === 'nombre') echo 'selected'; ?>>Nombre</option>
            <option value="departamento" <?php if ($_GET['filtro'] ?? '' === 'departamento') echo 'selected'; ?>>Departamento</option>
            <option value="fecha_actualizacion" <?php if ($_GET['filtro'] ?? '' === 'fecha_actualizacion') echo 'selected'; ?>>Fecha</option>
        </select>

        <input type="text" name="valor" placeholder="Escribe el valor a buscar" value="<?php echo $_GET['valor'] ?? ''; ?>" required>
        <input type="submit" value="Buscar">
        <a href="inventario.php">
			<button type="button">Recargar</button>
		</a>
    </form>

    



    <table>
        <tr>
            <th>ID</th>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Costo</th>
            <th>Precio</th>
            <th>Existencias</th>
            <th>Departamento</th>
            <th>Unidad</th>
            <th>Actualizado</th>
        </tr>

        <?php
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["clave"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>$" . $row["costo"] . "</td>";
                echo "<td>$" . $row["precio"] . "</td>";
                echo "<td>" . $row["existencias"] . "</td>";
                echo "<td>" . $row["departamento"] . "</td>";
                echo "<td>" . $row["unidad"] . "</td>";
                echo "<td>" . $row["fecha_actualizacion"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay productos registrados.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>

</body>
</html>
