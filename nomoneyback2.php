<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("db.php");
require_once("nomoney2.php");

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $barcode = $_POST['last-barcode'];

    $errores = '';

    if (empty($barcode)) {

        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }
    if ($errores == '') {

        if ($errores == '') {

            $sql = "SELECT * FROM usuario WHERE barcode = '" . $barcode . "'";
            $data = pg_query($conn, $sql);
            $row = pg_fetch_array($data);
            $code_check = pg_num_rows($data);
            if ($code_check > 0) {
                $sumval = $row['money'] - 0.30;
                $sql_up = "UPDATE usuario SET money = '$sumval' WHERE barcode = '" . $barcode . "'";
                $result = pg_query($conn, $sql_up);
                if ($result) {
    
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
                    $mail->Body = "Greetings, this is your verification token: " . $newtoken . ", use it to activate your GoFast account to start using our services! Do not share your verification key with anybody!";
    
                    $mail->addAddress($email);
    
                    $mail->isHTML(true);
    
                    $mail->send();*/
    
    
                    $errores .= "<p><script>swal.fire({
                        title: 'Removed money!',
                        icon: 'success',
                        showConfirmButton: false,
                        });</script></p>";
                } else {
                    $errores .= "<p><script>swal.fire({
                        title: 'Unknown error',
                        icon: 'error',
                        });</script></p>";
                }
            } else {
                $errores .= "<p><script>swal.fire({
                title: 'This UNIQUE ID does not exist',
                icon: 'error',
                });</script></p>";
            }
        }
    }
}