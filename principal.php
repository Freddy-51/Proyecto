<?php
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$empleados = [];
$result = $conexion->query("SELECT id_empleado, nombre FROM empleados");
if ($result && $result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $empleados[] = $fila;
    }
}

// Empleado activo (puede venir por GET o POST)
$empleado_activo = $_GET['empleado'] ?? '';
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Punto de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #ffffff;
        }

        h1 {
            text-align: center;
            color: #dd0000;
            margin: 20px 0;
        }

        .barra-superior {
            display: flex;
            align-items: center;
            gap: 40px;              /* Separación entre clave y empleado */
        }

        .agregar-producto,
        .empleado {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .agregar-producto label,
        .empleado label {
            font-size: 20px;
            color: #1c3e74;
        }

        .agregar-producto input,
        .empleado select {
            padding: 8px;
            font-size: 18px;
            border: 1px solid #ccc;
            background-color: rgb(242, 255, 254);
            border-radius: 5px;
            width: 180px;
        }
        .btn-enter {
            background-color: #1c3e74;
            color: white;
            font-size: 16px;
            padding: 9px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 42px; /* para alinear con el input */
        }

        .btn-enter:hover {
            background-color: #2ca4a8;
        }




        .container {
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }

        /* Punto de venta (lado izquierdo) */
        .punto-venta {
            flex: 1;
            background-color: #ecfffd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgb(0, 0, 0);
            max-width: 76%;
        }

        .punto-venta h2 {
            color: #1c3e74;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 7px;
            border: 1px solid #000000;
            text-align: center;
        }
        th {
            background-color:rgba(76, 175, 79, 0.822);
            color: white;
        }

        .total {
            text-align: right;
            margin-top: 30px;
            font-size: 18px;
        }

        .punto-venta button {
            margin-top: 250px;
            padding: 10px 20px;
            background-color: #45a049;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .punto-venta button:hover {
            background-color: #2ca4a8;
        }

        /* Menú de botones (lado derecho) */
        .principal {
            width: 180px;
            text-align: center;
            padding: 20px;
            margin-top: 40px;         /* un valor positivo */

        }

        .principal button {
            display: block;
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #1c3e74;
            color: white;
            border: none;
            border-radius: 8px;
        }

        .principal button:hover {
            background-color: #2ca4a8;
        }
    </style>
</head>

<body>

    <h1>ABARROTES DOÑA LUZ</h1>

        
    <div class="barra-superior">

    <div class="empleado">
        <form method="GET" action="">
            <label for="empleado">Empleado activo:</label>
            <select name="empleado" onchange="this.form.submit()">
                <option value="">-- Selecciona un empleado --</option>
                <?php foreach ($empleados as $emp): ?>
                    <option value="<?php echo $emp['id_empleado']; ?>"
                        <?php echo ($empleado_activo == $emp['id_empleado']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($emp['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <div class="agregar-producto">
        <form method="POST" action="agregar_venta.php" class="form-agregar-producto" style="display: flex; align-items: center; gap: 10px;">
            <label for="clave">Clave:</label>
            <input type="text" id="clave" name="clave" required autocomplete="off">

            <button type="submit" class="btn-enter">Enter</button>
        </form>
    </div>
</div>





    <div class="container">
        <!-- Área de punto de venta -->
        <div class="punto-venta">
            
            <table>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="lista-productos">
                    <!-- Productos se agregarán aquí dinámicamente -->
                    <tr>
                        <td>Ejemplo</td>
                        <td>Ejemplo</td>
                        <td>$15.00</td>
                        <td>2</td>
                        <td>$30.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                <strong>Total:</strong> $<span id="total">30.00</span>
            </div>

            <button>Finalizar Venta</button>
        </div>

        <!-- Menú de navegación -->
        <div class="principal">
            <form action="registro_productos.html">
                <button type="submit">Productos</button>
            </form>

            <form action="principal.php">
                <button type="submit">Detalles de Ventas</button>
            </form>

            <form action="registro_empleados.html">
                <button type="submit">Empleados</button>
            </form>

            <form action="registro_proveedores.html">
                <button type="submit">Proveedores</button>
            </form>

            <form action="registro_clientes.html">
                <button type="submit">Clientes</button>
            </form>
            
        </div>

    </div>

</body>

</html>
