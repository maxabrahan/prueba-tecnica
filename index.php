<?php

include( 'connection.php' );

$con = connection();

$sql = 'SELECT * FROM usuarios';
$query = mysqli_query( $con, $sql );

// Verificar si la consulta SQL fue exitosa
if ( !$query ) {
    die( 'Error en la consulta: ' . mysqli_error( $con ) );
}

?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<link rel = 'stylesheet' href = 'css/styles.css'>
<title>Document</title>
</head>
<body>
<div class = 'users-form'>
<form action = 'insertar_usuario.php' method = 'POST'>
<h1>Crear Usuario</h1>

<label for = 'name'>Nombre:</label>
<input type = 'text' name = 'name' placeholder = 'Nombre'>
<label for = 'lastname'>Apellido:</label>
<input type = 'text' name = 'lastname' placeholder = 'Apellido'>

<label for = 'tipo-documento'>Tipo Documento:</label>
<select id = 'tipo-documento' name = 'tipo_documento' required>
<option value = 'cc'>Cédula de Ciudadanía</option>
<option value = 'ti'>Tarjeta de Identidad</option>
<option value = 'ce'>Cédula de Extranjería</option>
<option value = 'pasaporte'>Pasaporte</option>
</select>

<label for = 'document'>Numero Documento:</label>
<input type = 'text' name = 'document' placeholder = 'Numero de documento'>
<label for = 'city'>Ciudad:</label>
<input type = 'text' name = 'city' placeholder = 'Ciudad'>
<label for = 'address'>Direccion:</label>
<input type = 'text' name = 'address' placeholder = 'Dirección'>
<label for = 'phone'>Telefono:</label>
<input type = 'text' name = 'phone' placeholder = 'Telefono'>
<label for = 'email'>Correo:</label>
<input type = 'email' name = 'email' placeholder = 'Correo'>

<input type = 'submit' value = 'Crear Usuario'>

</form>

</div>

<div class = 'users-table'>

<h2>Usuarios Registrados</h2>
<button  class="btn-export" onclick = "window.location.href='export_pdf.php'">Exportar a PDF</button>
<button class="btn-export btn-export-xls" onclick = "window.location.href='export_excel.php'">Exportar a Excel</button>

<div class="table-table">
<table>
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
<th colspan="2">Opciones</th>
</tr>
</thead>
<tbody>
<?php  while( $row = mysqli_fetch_array( $query ) ): ?>
<tr>
<th> <?= $row[ 'usuario_id' ] ?></th>
<th> <?= $row[ 'usuario_nombre' ] ?> </th>
<th> <?= $row[ 'usuario_apellido' ] ?></th>
<th> <?= $row[ 'usuario_tipodoc' ] ?></th>
<th> <?= $row[ 'usuario_numdoc' ] ?></th>
<th> <?= $row[ 'usuario_ciudad' ] ?></th>
<th> <?= $row[ 'usuario_direccion' ] ?></th>
<th> <?= $row[ 'usuario_telefono' ] ?></th>
<th> <?= $row[ 'usuario_email' ] ?></th>

<th colspan="2"><a href = "update.php?usuario_id=<?=$row['usuario_id'] ?>" class = 'users-table--edit'>Editar</a>
<a href = "delete_user.php?usuario_id=<?=$row['usuario_id']?>" class = 'users-table--delete'>Eliminar</a></th>
</tr>

<?php endwhile;
?>
</tbody>
</table>
</div>

</div>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($con);
?>