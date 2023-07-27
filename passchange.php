<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("db.php");
require_once("passchangefront.php");

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $email = $_POST['email'];

    $errores = '';

    if (empty($email)) {

        $errores .= "<p><script>swal.fire({
            title: 'The email field is empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }

    if ($errores == '') {

        $sql = "SELECT * FROM usuario WHERE email = '" . $email . "'";
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
                $sql_up = "UPDATE usuario SET token = null WHERE email = '" . $email . "'";
                $result = pg_query($conn, $sql_up);
                if ($result) {

                    $newtoken = rand(100000, 999999);

                    $sql_new = "UPDATE usuario SET token = '$newtoken' WHERE email = '" . $email . "'";
                    $result2 = pg_query($conn, $sql_new);

                    $mail = new PHPMailer(true);

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

                    $mail->send();


                    $errores .= "<p><script>swal.fire({
                    title: 'Email sent!',
                    icon: 'success',
                    showConfirmButton: false,
                    });</script></p>";
                } else {
                    $errores .= "<p><script>swal.fire({
                    title: 'Unknown error',
                    icon: 'error',
                    });</script></p>";
                }
            }
        } else {
            $errores .= "<p><script>swal.fire({
            title: 'This email address does not exist',
            icon: 'error',
            });</script></p>";
        }
    }
}

if (isset($_POST['sub2']) && !empty($_POST['sub2'])) {
    $code = $_POST['code'];

    $errores = '';

    if (empty($code)) {

        $errores .= "<p><script>swal.fire({
            title: 'The token field is empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }

    $codelen = strlen($code);
    if ($codelen < 6) {
        $errores .= "<p><script>swal.fire({
            title: 'That is not a password change token!',
            text: 'Must be 6 characters long!',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }

    if ($errores == '') {

        $sql = "SELECT * FROM usuario WHERE token = '" . $code . "'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $code_check = pg_num_rows($data);
        if ($code_check > 0) {
            //$sql_up = "UPDATE usuario SET token = null WHERE token = '" . $code . "'";
            //$result = pg_query($conn, $sql_up);
            if ($data) {

                /*$newtoken = rand(100000, 999999);

                $sql_new = "UPDATE usuario SET token = '$newtoken' WHERE email = '" . $email . "'";
                $result2 = pg_query($conn, $sql_new);

                $mail = new PHPMailer(true);

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

                session_start();
                $_SESSION['opent'] = $code;
                $errores .= "<p><script>swal.fire({
                    title: 'Token found!',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'passchangerrr.php';}, 1400));</script></p>";
            } else {
                $errores .= "<p><script>swal.fire({
                    title: 'Unknown error',
                    icon: 'error',
                    });</script></p>";
            }
        } else {
            $errores .= "<p><script>swal.fire({
            title: 'No such token.',
            icon: 'error',
            });</script></p>";
        }
    }
}
