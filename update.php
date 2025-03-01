<?php

include( 'connection.php' );
$con = connection();

$usuario_id = $_GET[ 'usuario_id' ];

$sql = "SELECT * FROM usuarios WHERE usuario_id = '$usuario_id'";
$query = mysqli_query( $con, $sql );
$row = mysqli_fetch_array( $query );

mysqli_close( $con );

?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<link rel = 'stylesheet' href = 'CSS/styles.css'>
<title>Editar usuarios</title>
</head>
<body>
<div class = 'users-form'>
<form action = 'editar_usuario.php' method = 'POST'>
<h1>Editar Usuario</h1>

<input type = 'hidden' name = 'id' value = "<?=$row['usuario_id'] ?>">
<label for = 'name'>Nombre:</label>
<input type = 'text' name = 'name' placeholder = 'Nombre' value = "<?= $row['usuario_nombre'] ?>">
<label for = 'lastname'>Apellido:</label>
<input type = 'text' name = 'lastname' placeholder = 'Apellido' value = "<?= $row['usuario_apellido'] ?>">

<label for = 'tipo-documento'>Selecciona el tipo de documento:</label>
<select id = 'tipo-documento' name = 'tipo_documento' required>
    <option value = 'cc' <?= ($row['usuario_tipodoc'] == 'cc') ? 'selected' : '' ?>>Cédula de Ciudadanía</option>
    <option value = 'ti' <?= ($row['usuario_tipodoc'] == 'ti') ? 'selected' : '' ?>>Tarjeta de Identidad</option>
    <option value = 'ce' <?= ($row['usuario_tipodoc'] == 'ce') ? 'selected' : '' ?>>Cédula de Extranjería</option>
    <option value = 'pasaporte' <?= ($row['usuario_tipodoc'] == 'pasaporte') ? 'selected' : '' ?>>Pasaporte</option>
</select>

<label for = 'document'>Numero Documento:</label>
<input type = 'text' name = 'document' placeholder = 'Numero de documento' value = "<?= $row['usuario_numdoc'] ?>">
<label for = 'city'>Ciudad:</label>
<input type = 'text' name = 'city' placeholder = 'Ciudad' value = "<?= $row['usuario_ciudad'] ?>">
<label for = 'address'>Direccion:</label>
<input type = 'text' name = 'address' placeholder = 'Dirección' value = "<?= $row['usuario_direccion'] ?>">
<label for = 'phone'>Telefono:</label>
<input type = 'text' name = 'phone' placeholder = 'Telefono' value = "<?= $row['usuario_telefono'] ?>">
<label for = 'email'>Correo:</label>
<input type = 'email' name = 'email' placeholder = 'Correo' value = "<?= $row['usuario_email'] ?>">

<input type = 'submit' value = 'Actualizar informacion'>
<button type="button" onclick="window.location.href='index.php'" class="btn-back">Regresar</button>

</form>

</div>

</body>
</html>