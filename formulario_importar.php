<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Productos desde XML</title>
</head>
<body>
    <h2>Selecciona un archivo XML para importar productos</h2>
    <form action="importar_productos.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="archivo_xml" accept=".xml" required>
        <br><br>
        <input type="submit" value="Importar">
    </form>
</body>
</html>