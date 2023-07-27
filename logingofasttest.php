<?php
require("db.php");
require_once("loginfront.php");

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $logger = trim($_POST['logger']);
    $pwd = ($_POST['pwd']);
    $sha512 = hash_init('sha512');
    hash_update($sha512, $pwd);
    $hashpwd = hash_final($sha512);

    $errores = '';

    if (empty($logger) or empty($pwd)) {

        $errores .= "<p><script>swal.fire({
            title: 'You left some empty fields!',
            text: 'You should check that before sending.',
            icon: 'warning',
            button: 'Got it!',
    });</script></p>";
    }

    if ($errores == '') {

        $sql = "SELECT * FROM usuario WHERE username = '" . $logger . "' and pass ='" . $hashpwd . "'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $login_check = pg_num_rows($data);
        $name = $row['nombre'];
        if ($login_check > 0) {
            if ($row['status'] != 2) {
                $errores .= "<p><script>swal.fire({
                    title: 'Your e-mail is not verified yet!',
                    text: 'You must verify your e-mail address in order to access the site. If your account is not verified, it will be deleted in 24 hours.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00E331',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Take me to verification page'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {(setTimeout(function(){window.location = 'verif.php';}, 0))}
                  })</script></p>";

            } else {

                if ($row['idpermiso'] == 3) { //usuario
                    session_start();
                    $_SESSION['usuario'] = $logger;
                    $errores .= "<p><script>swal.fire({
                title: 'Login success!',
                text: 'Welcome back, " . $logger . "',
                icon: 'success',
                showConfirmButton: false,
                }).then(setTimeout(function(){window.location = 'mapaprueba.php';}, 1400));</script></p>";
                } else if ($row['idpermiso'] == 1) { //admin
                    session_start();
                    $_SESSION['usuario'] = $logger;
                    $_SESSION['admin'] = "AdminConf";
                    $errores .= "<p><script>swal.fire({
                    title: 'Login success!',
                    text: 'Welcome back, " . $logger . "',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'crudadmin.php';}, 1400));</script></p>";
                } else if ($row['idpermiso'] == 4) { //conductor
                    session_start();
                    $_SESSION['usuario'] = $logger;
                    $_SESSION['driver'] = "Blade";
                    $errores .= "<p><script>swal.fire({
                    title: 'Login success!',
                    text: 'Welcome back, " . $logger . "',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'drivercrud.php';}, 1400));</script></p>";
                } else if ($row['idpermiso'] == 2) { //empleador
                    session_start();
                    $_SESSION['usuario'] = $logger;
                    $_SESSION['empl'] = "Employer";
                    $errores .= "<p><script>swal.fire({
                    title: 'Login success!',
                    text: 'Welcome back, " . $logger . "',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'employercrud.php';}, 1400));</script></p>";
                }
            }
        } else {
            $errores .= "<p><script>swal.fire({
            title: 'User not found!',
            text: 'Check your details!',
            icon: 'error',
            button: 'Got it!',
            });</script></p>";
        }
    }
}
?>