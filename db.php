<?php
$host = "localhost";
$port = "5432";
$dbname = "gofast2";
$user = "postgres";
$password = "info2023";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Error: No se pudo conectar a la base de datos.";
    exit;
}else{
    //echo "Conectado";
}

?>
