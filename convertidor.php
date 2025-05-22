<?php
$csvFile = "Productos.csv";
$xmlFile = "Productos.xml";

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $headers = fgetcsv($handle); // leer encabezados
    $xml = new SimpleXMLElement('<productos/>');

    while (($data = fgetcsv($handle)) !== FALSE) {
        $producto = $xml->addChild('producto');
        foreach ($headers as $i => $campo) {
            $producto->addChild($campo, htmlspecialchars($data[$i]));
        }
    }

    fclose($handle);
    $xml->asXML($xmlFile);
    echo "✅ Archivo XML generado como <strong>$xmlFile</strong>";
} else {
    echo "❌ No se pudo abrir el archivo CSV.";
}
?>
