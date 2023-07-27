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

$ownernamere = $_SESSION['usuario'];

if (isset($_GET['idusuario2'])) {
    $idre = $_GET['idusuario2'];
    $sqlre = "select * from usuario where idusuario=" . $idre;
    $resultre = pg_query($conn, $sqlre);
    $rowre = pg_fetch_assoc($resultre);
    $ownercheckre = $rowre['employerboss'];
     if (pg_num_rows($resultre) > 0 and $ownercheckre == $ownernamere) {
            $sqldelre = "update usuario set employerboss = NULL where idusuario =" . $idre;
            $resultdelre = pg_query($conn, $sqldelre);
            if ($resultdelre) {
                $errores .= "<script>Swal.fire({
                    title: 'This user is no longer a part of your company',
                    icon: 'info',
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
    }else if($ownercheckre != $ownernamere) {
        $errores .= "<script>Swal.fire({
            title: 'This user is not a part of your company',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'employercrud_hireemploy.php';
              });
          </script>";
    } else {
        $errores .= "<script>Swal.fire({
            title: 'This user does not exist',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'employercrud_hireemploy.php';
              });
          </script>";
    }

} 

?>