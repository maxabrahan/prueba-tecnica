<?php

require 'vendor/autoload.php';
require 'connection.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Arial');
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

// Construcción del HTML solo con la tabla
$html = "<html><head><style>
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid black; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
</style></head><body>";
$html .= "<h2>Usuarios Registrados</h2>";
$html .= "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Documento</th>
                    <th>Numero de Documento</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>";

while ($row = mysqli_fetch_assoc($query)) {
    $html .= "<tr>
                <td>{$row['usuario_id']}</td>
                <td>{$row['usuario_nombre']}</td>
                <td>{$row['usuario_apellido']}</td>
                <td>{$row['usuario_tipodoc']}</td>
                <td>{$row['usuario_numdoc']}</td>
                <td>{$row['usuario_ciudad']}</td>
                <td>{$row['usuario_direccion']}</td>
                <td>{$row['usuario_telefono']}</td>
                <td>{$row['usuario_email']}</td>
              </tr>";
}

$html .= "</tbody></table></body></html>";

mysqli_close($con);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream("usuarios.pdf", ["Attachment" => false]);

?>
