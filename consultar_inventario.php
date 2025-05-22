<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Variables para el formulario
$filtro = $_GET['filtro'] ?? '';
$valor = $_GET['valor'] ?? '';
$busqueda_enviada = isset($_GET['filtro']) && isset($_GET['valor']) && $_GET['valor'] !== '';

// Armar condición WHERE si se hizo búsqueda
$where = "";
if ($busqueda_enviada) {
    $filtro_db = $conexion->real_escape_string($filtro);
    $valor_db = $conexion->real_escape_string($valor);

    if ($filtro_db == 'fecha_actualizacion') {
        $where = "WHERE $filtro_db = '$valor_db'";
    } else {
        $where = "WHERE $filtro_db LIKE '%$valor_db%'";
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
            background-color:rgb(76, 175, 79);
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
<form method="GET" action="" style="text-align: center; margin: 20px 0;">
    <select name="filtro" required>
        <option value="" <?php echo !$busqueda_enviada ? 'selected' : ''; ?>>-- Buscar por --</option>
        <option value="clave" <?php echo ($filtro === 'clave' && $busqueda_enviada) ? 'selected' : ''; ?>>Clave</option>
        <option value="nombre" <?php echo ($filtro === 'nombre' && $busqueda_enviada) ? 'selected' : ''; ?>>Nombre</option>
        <option value="departamento" <?php echo ($filtro === 'departamento' && $busqueda_enviada) ? 'selected' : ''; ?>>Departamento</option>  
    </select>

    <input type="text" name="valor" value="<?php echo htmlspecialchars($valor); ?>" placeholder="Escribe el valor a buscar" required>

    <input type="submit" value="Buscar">
    
    <a href="consultar_inventario.php">
		<button type="button">Recargar</button>
		</a>

    <a href="principal.php">
		<button type="button">Principal</button>
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
