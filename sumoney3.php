<?php
include_once('sumoneyback3.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title> Add money </title>
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

<script>
    var barcode = "";
    var interval;
    document.addEventListener('keydown', function(evt){
        if(interval)
            clearInterval(interval);
        if (evt.code == 'Enter') {
            if (barcode)
                handleBarcode(barcode);
            barcode = '';
            return;
        }
        if(evt.code != 'Shift')
            barcode += evt.key;
        interval = setInterval(() => barcode = '', 20);
    });

    function handleBarcode(scanned_barcode){
        document.querySelector('#last-barcode').value = scanned_barcode;
    }
</script>

<!--REGISTRO-->

<body>
    <div class="wrapper">
        <h2>Add money</h2>
        <div class="text">
            <a>Select the UNIQUE ID to add money too.</a>
        </div>
        <form action="sumoney3.php" method="post">
            <div class="input-box">
                <input type="text" name="last-barcode" placeholder="Verification code" id="last-barcode" value="">
            </div>

            <div class="input-box button">
                <input type="Submit" name="subs" value="Verify my address!">
                <?php if (!empty($errores)) : ?>
                    <div class="error">
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text">
                <h3><a href="redirgal.php">Go Back</a></h3>
            </div>
        </form>
    </div>
</body>

</html>