<?php
require_once('db.php');
$upload_dir = 'photos/';
require_once('userinfo.php');

require_once('vendor/autoload.php');

use Picqer\Barcode\BarcodeGeneratorHTML;
/*session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
}*/

if (isset($_GET['idusuario'])) {
    $id = $_GET['idusuario'];
    $sql2 = "select * from usuario where idusuario=" . $id;
    $result2 = pg_query($conn, $sql2);
    if (pg_num_rows($result2) > 0) {
        $row2 = pg_fetch_assoc($result2);
        $oldimg = $row2['images'];
    } else {
        $errores .= "<script>Swal.fire({
            title: 'This user does not exist',
            icon: 'error',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'userinfo.php';
              });
          </script>";
    }
}

if (isset($_POST['submit'])) {
    $id = $_POST['idusuario'];
    /*$username = trim($_POST['username']);
    $pass = $_POST['pass'];
    $password = hash("sha512", "$pass");
    $names = $_POST['names'];
    $status = $_POST['status'];
    $permission = $_POST['permission'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];*/
    $errores = '';

    $imgName = $_FILES['image']['name'];
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if ($imgName != '') {
      $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
    $allowExt = array('jpeg', 'jpg', 'png');
    $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

    if (in_array($imgExt, $allowExt)) {

        if ($imgSize < 5000000) {
          if ($oldimg != 'user_icon.png') {
            unlink($upload_dir . $oldimg);
        }
          move_uploaded_file($imgTmp, $upload_dir.$userPic);
        } else {
          $errores .= "<script>Swal.fire({
            title: 'File is too heavy.',
            icon: 'error',
            }).then(function() {
              window.location = 'userinfo.php';
              });
          </script>";
        }
      } else if($imgName != '') {
        $errores .= "<script>Swal.fire({
          title: '" . $imgName . " is not a valid image, please select an image with a valid format',
        icon: 'error',
        text: '.jpeg, .png, .jpg'
        }).then(function() {
          window.location = 'userinfo.php';
          });
      </script>";
      }
    } else if($imgName == '') {
        $errores .= "<script>Swal.fire({
            title: 'To update your image, you should upload a new one!',
            icon: 'info',
            confirmButtonText: 'Accept'
            }).then(function() {
              window.location = 'userinfo.php';
              });
          </script>"; 
    }

      if (!empty($userPic) and $errores == '') {
        $sqlup = "update usuario set images = '$userPic' where idusuario =" . $id;
    $resultup = pg_query($conn, $sqlup);
    if ($resultup) {
        $errores .= "<script>Swal.fire({
                title: 'Successful update',
                icon: 'success',
                confirmButtonText: 'Accept'
                }).then(function() {
                  window.location = 'userinfo.php';
                  });
              </script>";
    } else {
        $errores .= "<script>Swal.fire({
                title: 'Oops...',
                icon: 'error',
                text: 'Error while updating',
                confirmButtonText: 'Accept'
                }).then(function() {
                    window.location = 'userinfo.php';
                    });
              </script>";
    }
      } /*else if($errores == '' and $imgName == '') {
        $errores .= "<script>Swal.fire({
                title: 'To update your image, you should upload a new one!',
                icon: 'info',
                confirmButtonText: 'Accept'
                }).then(function() {
                  window.location = 'userinfo.php';
                  });
              </script>";
      }*/
}


?>