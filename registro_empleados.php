<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    $nombre_foto = "";  // Valor por defecto si no hay imagen

    // Si hay archivo y no hay error
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $nombre_foto = "empleado_" . date("Ymd_His") . "." . $ext;
        $ruta_destino = "fotos_empleados/" . $nombre_foto;

        if (!is_dir("fotos_empleados")) {
            mkdir("fotos_empleados", 0755, true);
        }

        // Si falla la carga, no se asigna nombre de imagen
        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino)) {
            $nombre_foto = "";  // Limpia si falla
        }
    }

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Escapar variables por seguridad
    $nombre = $conexion->real_escape_string($nombre);
    $email = $conexion->real_escape_string($email);
    $direccion = $conexion->real_escape_string($direccion);
    $telefono = $conexion->real_escape_string($telefono);
    $nombre_foto = $conexion->real_escape_string($nombre_foto);

    // Insertar con o sin foto
    $sql = "INSERT INTO empleados (nombre, email, direccion, telefono, foto)
            VALUES ('$nombre', '$email', '$direccion', '$telefono', '$nombre_foto')";

    if ($conexion->query($sql) === TRUE) {
        echo "✅ Empleado registrado correctamente.";
    } else {
        echo "❌ Error al guardar en la base de datos: " . $conexion->error;
    }

    $conexion->close();
}
?>