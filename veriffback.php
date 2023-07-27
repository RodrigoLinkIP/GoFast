<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("db.php");
require_once("verif.php");

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $code = $_POST['code'];

    $errores = '';

    if (empty($code)) {

        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
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
            $status = 2;
            $names = $row['name'];
            $sql_up = "UPDATE usuario SET status = '$status', token = null WHERE token = '" . $code . "'";
            $result = pg_query($conn, $sql_up);
            if ($result) {

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
                $mail->Body = "Greetings, " . $names . ", thanks for creating an account for the GoFast service, we are glad to have you as a customer! We'll keep you updated on anything we do!";

                $mail->addAddress($email);

                $mail->isHTML(true);

                $mail->send();*/


                $errores .= "<p><script>swal.fire({
                    title: 'Email verified!',
                    icon: 'success',
                    showConfirmButton: false,
                    }).then(setTimeout(function(){window.location = 'logingofasttest.php';}, 1400));</script></p>";
            } else {
                $errores .= "<p><script>swal.fire({
                    title: 'Unknown error',
                    icon: 'error',
                    });</script></p>";
            }
        } else {
            $errores .= "<p><script>swal.fire({
            title: 'This code does not exist',
            icon: 'error',
            });</script></p>";
        }
    }
}
