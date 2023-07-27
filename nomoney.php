<?php
include_once('nomoneyback.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title> Register now </title>
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

<!--REGISTRO-->

<body>
    <div class="wrapper">
        <h2>REMOVE money</h2>
        <div class="text">
            <a>Select the UNIQUE ID to remove money from.</a>
        </div>
        <form action="nomoney.php" method="post">
            <div class="input-box">
                <input type="number" name="code" placeholder="ID" id="code" required>
            </div>

            <div class="input-box button">
                <input type="Submit" name="subs" value="Substract!">
                <?php if (!empty($errores)) : ?>
                    <div class="error">
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text">
                <h3>Already have an account? <a href="logingofasttest.php">Login now!</a></h3>
                <h3>Forgot your password? <a href="passchange.php">Change it now!</a></h3>
            </div>
        </form>
    </div>
</body>

</html>