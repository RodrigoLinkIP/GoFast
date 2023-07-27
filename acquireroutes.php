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

$ownername = $_SESSION['usuario'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "select * from routes where id=" . $id;
    $result2 = pg_query($conn, $sql2);
    $row2 = pg_fetch_assoc($result2);
    $owncheck = $row2['rowner'];
     if (pg_num_rows($result2) > 0 and $owncheck == NULL) {
            $routename = $row2['rname'];
            $sqldel = "update routes set rowner = '$ownername' where id =" . $id;
            $resultdel = pg_query($conn, $sqldel);
            if ($resultdel) {
                $errores .= "<script>Swal.fire({
                    title: 'You are now the owner of this route',
                    icon: 'success',
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
    }else if($owncheck != NULL) {
        $errores .= "<script>Swal.fire({
            title: 'This route is already owned!',
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