<?php
require_once('db.php');
require_once('employercrud_hireemploy.php');

session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
} else if (!isset($_SESSION['empl'])) {
  header("Location: redirgal.php");
  exit();
}

$ownername = $_SESSION['usuario'];

if (isset($_GET['idusuario'])) {
    $id2 = $_GET['idusuario'];
    $sql2 = "select * from usuario where idusuario=" . $id2;
    $result2 = pg_query($conn, $sql2);
    $row2 = pg_fetch_assoc($result2);
    $empcheck = $row2['employerboss'];
     if (pg_num_rows($result2) > 0 and $empcheck == NULL and $row2['idpermiso'] == 4) {
            $sqldel = "update usuario set employerboss = '$ownername' where idusuario =" . $id2;
            $resultdel = pg_query($conn, $sqldel);
            if ($resultdel) {
                $errores .= "<script>Swal.fire({
                    title: 'You are now the employer of this driver',
                    icon: 'success',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'employercrud_hireemploy.php';
                      });
                  </script>";
            } else {
                $errores .= "<script>Swal.fire({
                    title: 'Something went wrong',
                    icon: 'error',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'employercrud_hireemploy.php';
                      });
                  </script>";
            }
    }else if($empcheck != NULL) {
        $errores .= "<script>Swal.fire({
            title: 'This driver is already hired!',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'employercrud_hireemploy.php';
              });
          </script>";
    } else {
      $errores .= "<script>Swal.fire({
        title: 'This is not a driver!',
        icon: 'error',
        confirmButtonText: 'Accept'
        }).then(function() {
          window.location = 'employercrud_hireemploy.php';
          });
      </script>";
    }

} 

?>