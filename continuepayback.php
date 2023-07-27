<?php

require("db.php");
require_once("continuepay.php");

if (isset($_POST['subs']) && !empty($_POST['subs'])) {
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pay = $_POST['pay'];
    session_start();
    $_SESSION['charge'] = $pay;

    $errores = '';

    if (empty($uname)) {
        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    } elseif (empty($name)) {
        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    } elseif (empty($email)) {
        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    } elseif (empty($pay)) {
        $errores .= "<p><script>swal.fire({
            title: 'This fields are empty',
            text: 'Empty fields',
            icon: 'warning',
            button: 'Close',
    });</script></p>";
    }

    if ($errores == '') {
        $errores .= "<p><script>swal.fire({
            title: 'Continue',
            text: 'Deploying the payment buttons',
            icon: 'success',
            }).then(function() {
                window.location = 'paypal_test.php';
                });</script></p>";


        /*$sql = "UPDATE usuario SET money = '$pay'";
        $data = pg_query($conn, $sql);
        $row = pg_fetch_array($data);
        $result = pg_num_rows($data);
        if ($result) {
            $errores .= "<p><script>swal.fire({
                title: 'Continue',
                text: 'Deploying the payment buttons',
                icon: 'success',
                }).then(function() {
                    window.location = 'paypal_test.php';
                    });</script></p>";
        }else {
            $errores .= "<p><script>swal.fire({
                title: 'Payment unsuccessful!',
                icon: 'error',
                showConfirmButton: false,
                }).then(function() {
                    window.location = 'continuepay.php';
                    });</script></p>";
        }*/
    }

    /*if ($errores == '') {
        $sql = "SELECT * FROM usuario WHERE barcode = '" . $barcode . "'";
            $data = pg_query($conn, $sql);
            $row = pg_fetch_array($data);
            $code_check = pg_num_rows($data);
            if ($code_check > 0) {
                $unamettt = $row['username'];
                $balance = $row['money'];
                $amount = 0.30;
                if ($balance >= 1) {
                $sumval = $balance - $amount;
                $sql_up = "UPDATE usuario SET money = '$sumval' WHERE barcode = '" . $barcode . "'";
                $result = pg_query($conn, $sql_up);
                if ($result) {
                    $sqlroute = "SELECT * FROM routes WHERE rname = '". $tryroute ."'";
                    $arezu = pg_query($conn, $sqlroute);
                    $rower = pg_fetch_array($arezu);
                    $routecheck = pg_num_rows($arezu);
                    if ($routecheck > 0) {
                        $receiver = $rower['rowner'];
                        $currentDateTime = new DateTime('now');
                        $currentDate = $currentDateTime->format('Y-m-d h:m');
                        $sqlin = "INSERT INTO payment (sender, route, receiver, amount, issuetime) VALUES('$unamettt', '$tryroute', '$receiver', '$amount', '$currentDate')";
                    $ret = pg_query($conn, $sqlin);
                    if ($ret) {
                        $errores .= "<p><script>swal.fire({
                            title: 'Payment complete',
                            text: 'Successfully paid " . $receiver . "',
                            icon: 'success',
                            }).then(function() {
                                window.location = 'continuepay.php';
                                });</script></p>";
                    } else {
                        $errores .= "<p><script>swal.fire({
                            title: 'Payment unsuccessful!',
                            icon: 'error',
                            showConfirmButton: false,
                            }).then(function() {
                                window.location = 'mapaprueba.php';
                                });</script></p>";
                    }
                    } else {
                        $errores .= "<p><script>swal.fire({
                            title: 'Route not found',
                            icon: 'error',
                            }).then(function() {
                                window.location = 'mapaprueba.php';
                                });</script></p>";
                    }
                } else {
                    $errores .= "<p><script>swal.fire({
                        title: 'Unknown error',
                        icon: 'error',
                        }).then(function() {
                            window.location = 'mapaprueba.php';
                            });</script></p>";
                }
                } else {
                    $errores .= "<p><script>swal.fire({
                        title: 'Not enough money',
                        icon: 'error',
                        }).then(function() {
                            window.location = 'mapaprueba.php';
                            });</script></p>";
                }
            } else {
                $errores .= "<p><script>swal.fire({
                title: 'This UNIQUE ID does not exist',
                icon: 'error',
                }).then(function() {
                    window.location = 'mapaprueba.php';
                    });</script></p>";
            }
    }*/
}
