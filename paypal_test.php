<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redireccionar al formulario de login
    header("Location: index.php");
    exit();
} elseif (!isset($_SESSION['charge'])) {
    // Si no ha iniciado sesión, redireccionar al formulario de login
    header("Location: continuepay.php");
    exit();
}
?><?php
    $unamet = $_SESSION['usuario'];
    $paypal = $_SESSION['charge'];

    require_once('db.php');
    $upload_dir = 'photos/';
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.paypal.com/sdk/js?client-id=ASO8Wwi2ef90m3SaSm3rkgFy3dCFF7Tkajz97_n3V3O-L0uJFRVepji-rmyV8LtNjzsxttSCpN6YUjoi&currency=USD"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title> Payment for <?php echo $routename ?></title>
    <link rel="stylesheet" href="css/styleverif.css">
    <!-- Agrega los enlaces de SweetAlert -->
    <!-- link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" -->
    <!-- script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url(https://assets.volvo.com/is/image/VolvoInformationTechnologyAB/1860x1050-Volvo-9900-Landscape-2018?wid=1024);
            background-position: center center;
            background-size: 100%;
        }

        .bg {
            background-image: url(photos/gofastlogo.png);
            background-position: center center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="row">
            <?php
            $sql = "select * from usuario where username = '" . $unamet . "'";
            $result = pg_query($conn, $sql);
            if (pg_num_rows($result)) {
                while ($row = pg_fetch_assoc($result)) {
                    $thisuname = $row['username'];
                    $rname = $row['name'];
                    $e_mail = $row['email'];
                    $paypal = $paypal;;
                }
            }
            ?>
            <div class="col-6">
                <div class="input-box">
                    <input type="text" name="uname" value="<?php echo $thisuname ?>" readonly>
                </div>
                <div class="input-box">
                    <input type="text" name="rname" value="<?php echo $rname ?>" readonly>
                </div>
                <div class="input-box">
                    <input type="text" name="e_mail" value="<?php echo $e_mail ?>" readonly>
                </div>
                <div class="input-box">
                    <input type="text" name="pay" value="<?php echo $paypal ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>

    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'rect',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $paypal ?>
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                swal.fire({
                    title: 'Thank you for choosing us',
                    text: 'Recharge performed',
                    icon: 'success',
                }).then(function() {
                    window.location = 'mapaprueba.php';
                });
                console.log(data);
                <?php
                $qwerty = "SELECT * FROM usuario WHERE username = '" . $unamet . "'";
                $data = pg_query($conn, $sql);
                $row = pg_fetch_array($data);
                $code_check = pg_num_rows($data);
                if ($code_check > 0) {
                    $sumval = $row['money'] + floatval($paypal);
                    $sql_up = "UPDATE usuario SET money = '$sumval' WHERE username = '" . $unamet . "'";
                    $result = pg_query($conn, $sql_up);
                }
                ?>
            },
            onCancel: function(data) {
                swal.fire({
                    title: 'Cancell',
                    text: 'Cancell',
                    icon: 'error',
                }).then(function() {
                    window.location = 'paypal_test.php';
                });
                console.log(data);
            },
            onError: function(data) {
                swal.fire({
                    title: 'Fatal Error',
                    text: 'Transaction error',
                    icon: 'error',
                }).then(function() {
                    window.location = 'paypal_test.php';
                });
                console.log(data);
            }
        }).render('#paypal-button-container')
    </script>
    <?php
    session_destroy($_SESSION['charge']);
    exit;
    ?>
</body>

</html>