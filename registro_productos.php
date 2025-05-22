<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $costo = $_POST["costo"] ?? 0;
    $precio = $_POST["precio"];
    $existencias = $_POST["existencias"];
    $unidad = $_POST["unidad"];
    $departamento = $_POST["departamento"];

    if (!empty($clave) && !empty($departamento) && !empty($nombre) && 
        !empty($existencias) && !empty($precio) && !empty($unidad)) {

        $conexion = new mysqli("localhost", "freddy", "*Pineda51*", "proyecto");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql = "INSERT INTO productos (clave, departamento, nombre, existencias, costo, precio, unidad)
                VALUES ('$clave','$departamento', '$nombre', '$existencias', '$costo', '$precio', '$unidad')";

        if ($conexion->query($sql) === TRUE) {
            echo "Datos guardados correctamente.";
        
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }		

        $conexion->close();
        } else {
        echo "<p style='color: red;'>Por favor, completa todos los campos.</p>";
    }

} else {
    header("Location: registro_productos.html");
    exit();
}
?>