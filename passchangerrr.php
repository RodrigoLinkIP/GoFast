<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("db.php");
require_once("passchangerrrback.php");

session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['opent'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: passchange.php");
  exit();
}

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $pwd = $_POST['pass1'];
    $pwd2 = $_POST['pass2'];
    $sha512 = hash_init('sha512');
    hash_update($sha512, $pwd);
    $hashpwd = hash_final($sha512);

    $token_check = $_SESSION['opent'];

    $errores = '';

    /*if (empty($pass1)) {

        $errores .= "<p><script>swal.fire({
            title: 'The email field is empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }*/

    if ($pwd != $pwd2) {

        $errores .= "<p><script>swal.fire({
        title: 'Passwords do not match',
        icon: 'warning',
    });</script></p>";
    }

    if ($errores == '') {

        $sql = "SELECT * FROM usuario WHERE token = '" . $token_check . "'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $code_check = pg_num_rows($data);
        if ($code_check > 0) {
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
                $sql_up = "UPDATE usuario SET pass = '". $hashpwd ."' WHERE token = '" . $token_check . "'";
                $result = pg_query($conn, $sql_up);
                if ($result) {

                    //$newtoken = rand(100000, 999999);

                    $sql_new = "UPDATE usuario SET token = null WHERE token = '" . $token_check . "'";
                    $result2 = pg_query($conn, $sql_new);

                    /*$mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'gofastsv2022@gmail.com';
                    $mail->Password = 'ujushrnpaakoncce';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('gofastsv2022@gmail.com');

                    $mail->Subject = "Welcome to GoFast!";
                    $mail->Body = "Greetings, this is your password change token: " . $newtoken . ", use it to activate your GoFast account to start using our services! Do not share your verification key with anybody!";

                    $mail->addAddress($email);

                    $mail->isHTML(true);

                    $mail->send();*/

                    session_destroy();

                    $errores .= "<p><script>swal.fire({
                    title: 'Successfully changed password!',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'passchangerrr.php';}, 1400));</script></p>";
                } else {
                    $errores .= "<p><script>swal.fire({
                    title: 'Unknown error',
                    icon: 'error',
                    });</script></p>";
                }
            }
        } else {
            $errores .= "<p><script>swal.fire({
            title: 'SOMETHING WENT SOMEHOW WRONG',
            text: 'DO PANIC',
            icon: 'error',
            });</script></p>";
        }
    }
}