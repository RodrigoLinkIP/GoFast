<?php
require_once('db.php');
require_once('crudadmin.php');
$upload_dir = 'photos/';

session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
} else if (!isset($_SESSION['admin'])) {
  header("Location: redirgal.php");
  exit();
}

if (isset($_GET['idusuario'])) {
    $id = $_GET['idusuario'];
    $sql = "select * from usuario where idusuario=" . $id;
    $result = pg_query($conn, $sql);
     if (pg_num_rows($result) > 0) {
        /*$errores .= "<script>Swal.fire({
            title: 'Warning!',
            text: 'You are about to permanently delete a record. Proceed?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed',
            cancelButtonText: 'No, go back!'
        }).then((result) => {
            if (result.isCancelled) 
            {(setTimeout(function(){window.location = 'crudadmin.php';}, 0))}
          });
            </script>";*/
            $row = pg_fetch_assoc($result);
            $checku = $row['username'];
            if ($_SESSION['usuario'] == $checku) {
                $errores .= "<script>Swal.fire({
                    title: 'You can not delete your own account',
                    icon: 'info',
                    confirmButtonText: 'Sorry!'
                    }).then(function() {
                      window.location = 'crudadmin.php';
                      });
                  </script>";
            } else {
                $image = $row['images'];
                if ($image != 'user_icon.png') {
                    unlink($upload_dir . $image);
                }
            $sqldel = "delete from usuario where idusuario=" . $id;
            $resultdel = pg_query($conn, $sqldel);
            if ($resultdel) {
                $errores .= "<script>Swal.fire({
                    title: 'Successfully deleted',
                    icon: 'success',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'crudadmin.php';
                      });
                  </script>";
            } else {
                $errores .= "<script>Swal.fire({
                    title: 'Was not able to delete',
                    icon: 'error',
                    confirmButtonText: 'Accept'
                    }).then(function() {
                      window.location = 'crudadmin.php';
                      });
                  </script>";
            }
            }
    }else{
        $errores .= "<script>Swal.fire({
            title: 'This user does not exist',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'crudadmin.php';
              });
          </script>";
    }

} 

?>