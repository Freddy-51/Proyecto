<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener la clave del producto
$clave = $_POST['clave'] ?? '';

if ($clave !== '') {
    $clave = $conexion->real_escape_string($clave);

    // Buscar el producto en la base de datos
    $sql = "SELECT id_producto, clave, nombre, precio FROM productos WHERE clave = '$clave' LIMIT 1";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();

        // Guardar el producto en una "venta actual" dentro de la sesión
        $_SESSION['venta'][] = $producto;

        // Redirigir de regreso al punto de venta
        header("Location: principal.php");
        exit;
    } else {
        // Si no se encontró el producto
        $_SESSION['error'] = "Producto no encontrado.";
        header("Location: principal.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Debe ingresar una clave.";
    header("Location: principal.php");
    exit;
}

$conexion->close();
?>
