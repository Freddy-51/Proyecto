<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["archivo_xml"]) && $_FILES["archivo_xml"]["error"] == 0) {
        $ruta_temporal = $_FILES["archivo_xml"]["tmp_name"];

        // Cargar el XML
        $xml = simplexml_load_file($ruta_temporal) or die("❌ No se pudo cargar el archivo XML.");

        $conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");
        if ($conexion->connect_error) {
            die("❌ Error de conexión: " . $conexion->connect_error);
        }

        $insertados = 0;
        $fecha_actual = date("Y-m-d");

        foreach ($xml->producto as $producto) {
            $clave = $conexion->real_escape_string((string)$producto->clave);
            $departamento = $conexion->real_escape_string((string)$producto->departamento);
            $nombre = $conexion->real_escape_string((string)$producto->nombre);
            $existencias = (int)$producto->existencias;
            $costo = (float)$producto->costo;
            $precio = (float)$producto->precio;
            $unidad = $conexion->real_escape_string((string)$producto->unidad);

            $sql = "INSERT INTO productos (clave, departamento, nombre, existencias, costo, precio, unidad, fecha_actualizacion)
                    VALUES ('$clave', '$departamento', '$nombre', $existencias, $costo, $precio, '$unidad', '$fecha_actual')";

            if ($conexion->query($sql) === TRUE) {
                $insertados++;
            } else {
                echo "❌ Error con clave $clave: " . $conexion->error . "<br>";
            }
        }

        $conexion->close();
        echo "✅ Productos insertados: $insertados";
    } else {
        echo "❌ Error al subir el archivo.";
    }
} else {
    echo "⚠️ Acceso inválido.";
}
?>
