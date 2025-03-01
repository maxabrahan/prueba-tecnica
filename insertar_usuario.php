<?php

include("connection.php");
$con = connection();

$usuario_id = null;
$usuario_nombre = $_POST['name'];
$usuario_apellido = $_POST['lastname'];
$usuario_tipodoc = $_POST['tipo_documento'];
$usuario_numdoc = $_POST['document'];
$usuario_ciudad = $_POST['city'];
$usuario_direccion = $_POST['address'];
$usuario_telefono = $_POST['phone'];
$usuario_email = $_POST['email'];

$sql = "INSERT INTO usuarios VALUES ('$usuario_id', '$usuario_nombre', '$usuario_apellido', '$usuario_tipodoc', '$usuario_numdoc', '$usuario_ciudad', '$usuario_direccion', '$usuario_telefono', '$usuario_email')";
$query = mysqli_query($con, $sql);

// Cerrar la conexión a la base de datos
mysqli_close($con);

if($query){
    Header ("Location: index.php");
};


?>