<?php

include("connection.php");
$con = connection();

$usuario_id = $_GET['usuario_id'];

$sql = "DELETE FROM usuarios WHERE usuario_id = '$usuario_id'";
$query = mysqli_query($con, $sql);

mysqli_close($con);

if($query){
    Header ("Location: index.php");
};


?>