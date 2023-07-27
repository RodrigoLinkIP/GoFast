<?php
require_once('db.php');
require_once('crudadmin2.php');
$upload_dir = 'photos/';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $password = hash("sha512", "$pass");
  $names = $_POST['names'];
  $status = $_POST['status'];
  $permission = $_POST['permission'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $token = rand(10000, 99999);
  $uniqueid = rand(1000, 9999);
  $barcode = intval("2023" . strval($uniqueid));

  $errores = '';

  $imgName = $_FILES['image']['name'];
  $imgTmp = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];

  $query_repeat = "SELECT * FROM usuario WHERE username = '$username' OR email = '$email'";
  $resultado = pg_query($conn, $query_repeat);

  if (pg_num_rows($resultado) > 0) {
    $errores .= "<script>Swal.fire({
      title: 'Oops...',
      icon: 'error',
      text: 'The user or the email address is already registered'
      }).then(function() {
      window.location = 'crudadmin.php';
      });
      </script>";
  } else {
    $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

    $allowExt = array('.jpeg', '.jpg', '.png');

    $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

    if (in_array($imgExt, $allowExt)) {

      if ($imgSize < 5000000) {
        move_uploaded_file($imgTmp, $upload_dir . $userPic);
      } else {
        $errorMsg = 'Image too large';
      }
    } else {
      $errores .= "<script>Swal.fire({
      title: 'Select an image with a valid format',
      icon: 'error',
      text: '.jpeg, .png, .gif, .jpg'
      }).then(function() {
        window.location = 'crudadmin.php';
        });
    </script>";
    }
    $sql = "INSERT INTO usuario (name, username, email, pass, images, phone, status, idpermiso, barcode, token)
              VALUES ('$names', '$username', '$email', '$password', '$userPic', '$phone', '$status', '$permission', '$barcode', '$token')";
    $result = pg_query($conn, $sql);
    if ($result) {
      $errores .= "<script>Swal.fire({
        title: 'Successful registration',
        icon: 'success',
        confirmButtonText: 'Accept'
        }).then(function() {
        window.location = 'crudadmin.php';
        });
        </script>";
    } else {
      $errores .= "<script>Swal.fire({
        title: 'Oops...',
        icon: 'error',
        text: 'Error to be registered!'
        }).then(function() {
        window.location = 'crudadmin.php';
        });
        </script>";
    }
  }
}
