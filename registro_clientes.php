<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO clientes (nombre, email, telefono, direccion)
            VALUES ('$nombre', '$email', '$telefono', '$direccion')";

    if ($conexion->query($sql) === TRUE) {
        echo "✅ Cliente registrado correctamente.";
    } else {
        echo "❌ Error al guardar en la base de datos: " . $conexion->error;
    }

    $conexion->close();
}
?>