<?php

require 'connection.php';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="usuarios.xls"');

echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo de Documento</th>
        <th>Numero de Documento</th>
        <th>Ciudad</th>
        <th>Dirección</th>
        <th>Telefono</th>
        <th>Correo</th>
      </tr>";

$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td> {$row['usuario_id']}</td>";
    echo "<td>{$row['usuario_nombre']}</td>";
    echo "<td>{$row['usuario_apellido']}</td>";
    echo "<td>{$row['usuario_tipodoc']}</td>";
    echo "<td>{$row['usuario_numdoc']}</td>";
    echo "<td>{$row['usuario_ciudad']}</td>";
    echo "<td>{$row['usuario_direccion']}</td>";
    echo "<td>{$row['usuario_telefono']}</td>";
    echo "<td>{$row['usuario_email']}</td>";
    echo "</tr>";
}

mysqli_close($con);

echo "</table>";
?>