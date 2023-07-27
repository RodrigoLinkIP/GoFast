<?php
require("db.php");
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: logingofasttest.php");
  exit();
} else if (isset($_SESSION['usuario'])) {
    $checker = $_SESSION['usuario'];
    $sql = "SELECT * FROM usuario WHERE username = '". $checker ."'";
    $data = pg_query($conn, $sql);
    $row = pg_fetch_array($data);
            $code_check = pg_num_rows($data);
            if ($code_check > 0) {
                    if ($row['idpermiso'] == 1) {
                        header("Location: crudadmin.php");
                    } else if ($row['idpermiso'] == 2) {
                        header("Location: employercrud.php");
                    } else if ($row['idpermiso'] == 3) {
                        header("Location: mapaprueba.php");
                    } else if ($row['idpermiso'] == 4) {
                        header("Location: drivercrud.php");
                } else {
                    echo "Seems odd";
                }
            } else {
               echo "DB isnt working it seems";
            }

} else {
    echo "how?";
}

?>