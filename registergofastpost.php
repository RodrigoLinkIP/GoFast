<?php
require_once("db.php");

if (isset($_POST['Submit'])) {
  $names = filter_var(strtolower($_POST['name']));
  $username = filter_var(strtolower($_POST['username']));
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['pass'];
  $password2 = $_POST['pass2'];
  $pass = hash("sha512", "$password");
  $pass2 = hash("sha512", "$password2");


  /*if (empty($names)) {
    echo '<script>
            Swal.fire({
             title: "Empty fields",
            icon: "error",
            text: "Please note that you have not left any fields empty.",
            confirmButtonText: "Accept"
            });
          </script>';
  } elseif (empty($username)) {
    echo '<script>
            Swal.fire({
              title: "Empty fields",
              icon: "error",
              text: "Please note that you have not left any fields empty.",
              confirmButtonText: "Accept"
            });
          </script>';
  } elseif (empty($email)) {
    echo '<script>
      Swal.fire({
       title: "Empty fields",
      icon: "error",
      text: "Please note that you have not left any fields empty.",
      confirmButtonText: "Accept"
      });
    </script>';
  } elseif (empty($password)) {
    echo '<script>
      Swal.fire({
       title: "Empty fields",
      icon: "error",
      text: "Please note that you have not left any fields empty.",
      confirmButtonText: "Accept"
      });
    </script>';
  } elseif (empty($password2)) {
    echo '<script>
      Swal.fire({
       title: "Empty fields",
      icon: "error",
      text: "Please note that you have not left any fields empty.",
      confirmButtonText: "Accept"
      });
    </script>';
  } elseif ($pass != $pass2) {
    echo '<script>
      Swal.fire({
       title: "Empty fields",
      icon: "error",
      text: "Please note that you have not left any fields empty.",
      confirmButtonText: "Accept"
      });
    </script>';
  } elseif (isset($_POST['conditions']) && $_POST['conditions'] == '1'){
   echo '<script>
    Swal.fire({
     title: "Empty fields",
    icon: "error",
    text: "Please note that you have not left any fields empty.",
    confirmButtonText: "Accept"
    });
  </script>';
  } else {
    $query = "SELECT * FROM usuario WHERE username = '$username' AND email = '$email'";
    $resultado = pg_query($conn, $query);
    session_start();
    if (pg_num_rows($resultado) > 0) {
      echo '<script>
  Swal.fire({
   title: "The e-mail address is already registered",
  icon: "error",
  text: "",
  confirmButtonText: "Accept"
  });
</script>';
    } else {*/
      $sql = "INSERT INTO usuario (name, username, email, pass, images, phone, status, idpermiso)
                            VALUES ('$names', '$username', '$email', '$pass', 'user_icon.png', '$phone', '1', '3')";
            $result = pg_query($conn, $sql);

            if ($result) {
                $rowsAffected = pg_affected_rows($result);
                if ($rowsAffected > 0) {
                    $successMsg = 'New record added successfully';
                    header('Location: logingofast.php');
                    exit;
                } else {
                    $errorMsg = 'Error adding record';
                }
            } else {
                $errorMsg = 'Error executing query: ' . pg_last_error($conn);
            }
    }
  //}
//}
