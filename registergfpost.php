<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("db.php");
require_once("registergf.php");

if (isset($_POST['sub']) && !empty($_POST['sub'])) {

    $names = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['pass'];
    $password2 = $_POST['pass2'];
    $sha512 = hash_init('sha512');
    hash_update($sha512,$password);
    $hashpwd = hash_final($sha512);
    $status = 1;
    $idpermiso = 3;
    $token = rand(10000, 99999);
    $uniqueid = rand(1000, 9999);
    $barcode = intval("2023".strval($uniqueid));
    $balance = 1.0;

    /*$name = filter_var($_POST['names'], FILTER_SANITIZE_STRING);
    $emailcr = $_POST['emailcr'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $sha512 = hash_init('sha512');
    hash_update($sha512,$pwd);
    $hashpwd = hash_final($sha512);
    $rol = 0;
    $token = rand(10000000, 100000000);*/

    $errores = '';

    if (empty($names) or empty($email) or empty($password) or empty($password2)) {

        $errores .= "<p><script>swal.fire({
            title: 'EMPTY',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";

    } else {
        $sql = "SELECT * FROM usuario WHERE email = '" . $email . "'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $sign_check = pg_num_rows($data);

        if ($row['email'] == $email) {
            $errores .= "<p><script>swal.fire({
            title: 'This email has already been registered.',
            imageUrl: 'https://static.vecteezy.com/system/resources/thumbnails/002/205/854/small/email-icon-free-vector.jpg',
            });</script></p>";
        }

        $sql = "SELECT * FROM usuario WHERE username = '" . $username . "'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $sign_check = pg_num_rows($data);

        if ($row['username'] == $username) {
            $errores .= "<p><script>swal.fire({
            title: 'This username is already in use by another account.',
            imageUrl: 'https://static.vecteezy.com/system/resources/thumbnails/002/205/854/small/email-icon-free-vector.jpg',
            });</script></p>";
        }

        if ($password != $password2) {

            $errores .= "<p><script>swal.fire({
            title: 'Passwords do not match',
            icon: 'warning',
        });</script></p>";
        }
    }

    if ($errores == '') {
        $sqlin = "INSERT INTO usuario (name, username, email, pass, images, phone, status, idpermiso, token, barcode, money) VALUES('$names', '$username', '$email', '$hashpwd', 'user_icon.png', '$phone', $status, $idpermiso, $token, $barcode, $balance)";
        $ret = pg_query($conn, $sqlin);
        if ($ret) {


            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gofastsv2022@gmail.com';
            $mail->Password = 'ujushrnpaakoncce';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('gofastsv2022@gmail.com');

            $mail->Subject = "Confirm email";
            $mail->Body = "Greetings, " . $names . ", this is your verification token: " . $token . ", use it to activate your GoFast account to start using our services! Do not share your verification key with anybody!";

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->send();

            $errores .= "<p><script>swal.fire({
                title: 'Successfully created user!',
                text: 'Taking you to the verification page...',
                icon: 'success',
                showConfirmButton: false,
            }).then(setTimeout(function(){window.location = 'verif.php';}, 1400));</script></p>";
          
        } else {

            $errores .= "<p><script>swal.fire({
            title: 'An error occured!',
            text: 'Please try again later...',
            icon: 'error',
        });</script></p>";
        }
    }
}
