<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los productos
$sql = "SELECT clave, departamento, nombre, existencias, costo, precio, unidad FROM productos";
$resultado = $conexion->query($sql);

// Crear objeto XML
$xml = new SimpleXMLElement('<productos/>');

while ($row = $resultado->fetch_assoc()) {
    $producto = $xml->addChild('producto');
    $producto->addChild('clave', htmlspecialchars($row['clave']));
    $producto->addChild('departamento', htmlspecialchars($row['departamento']));
    $producto->addChild('nombre', htmlspecialchars($row['nombre']));
    $producto->addChild('existencias', $row['existencias']);
    $producto->addChild('costo', $row['costo']);
    $producto->addChild('precio', $row['precio']);
    $producto->addChild('unidad', htmlspecialchars($row['unidad']));
}

// Descargar como archivo
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="productos.xml"');
echo $xml->asXML();
exit;
?>
