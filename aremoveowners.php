<?php
require_once('db.php');
require_once('employercrud_accroutes.php');

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

if (isset($_GET['id2'])) {
    $idre = $_GET['id2'];
    $sqlre = "select * from routes where id=" . $idre;
    $resultre = pg_query($conn, $sqlre);
    $rowre = pg_fetch_assoc($resultre);
    $ownercheckre = $rowre['rowner'];
     if (pg_num_rows($resultre) > 0 and $ownercheckre == $ownernamere) {
            $routenamere = $rowre['rname'];
            $sqldelre = "update routes set rowner = NULL where id =" . $idre;
            $resultdelre = pg_query($conn, $sqldelre);
            if ($resultdelre) {
                $errores .= "<script>Swal.fire({
                    title: 'You are no longer the owner of this route',
                    icon: 'info',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'employercrud_accroutes.php';
                      });
                  </script>";
            } else {
                $errores .= "<script>Swal.fire({
                    title: 'Something went wrong',
                    icon: 'error',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'employercrud_accroutes.php';
                      });
                  </script>";
            }
    }else if($ownercheckre != $ownernamere) {
        $errores .= "<script>Swal.fire({
            title: 'You are not the owner of this route',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'employercrud_accroutes.php';
              });
          </script>";
    } else {
        $errores .= "<script>Swal.fire({
            title: 'This is not a valid route!',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'employercrud_accroutes.php';
              });
          </script>";
    }

} 

?>