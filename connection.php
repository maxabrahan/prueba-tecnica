
<?php
function connection() {
    $host = "localhost"; // Servidor de base de datos
    $user = "root";      // Usuario de la base de datos
    $pass = "";          // Contraseña (en XAMPP suele estar vacía)
    $db = "crud"; // Nombre de la base de datos

    // Conexión con MySQL
    $con = mysqli_connect($host, $user, $pass, $db);

  

    return $con;
}
?>


