<?php
include_once('continuepayback.php');
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redireccionar al formulario de login
    header("Location: index.php");
    exit();
}

?><?php
    require_once('db.php');
    $upload_dir = 'photos/';

    $unamet = $_SESSION['usuario'];
    ?>
<?php
if (isset($_GET["var"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["var"];
    if ($phpVar1 == 421) {
        $phpVar1 = '42-A';
    }

    if ($phpVar1 == 422) {
        $phpVar1 = '42-B';
    }

    if ($phpVar1 == 423) {
        $phpVar1 = '42-C';
    }

    if ($phpVar1 == 1011) {
        $phpVar1 = '101-A';
    }

    if ($phpVar1 == 10112) {
        $phpVar1 = '101A-2';
    }

    if ($phpVar1 == 10121) {
        $phpVar1 = '101B-1';
    }

    if ($phpVar1 == 10122) {
        $phpVar1 = '101B-2';
    }

    if ($phpVar1 == 1013) {
        $phpVar1 = '101-D';
    }

    $routename = "Route " . strval($phpVar1);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script>
    var barcode = "";
    var interval;
    document.addEventListener('keydown', function(evt) {
        if (interval)
            clearInterval(interval);
        if (evt.code == 'Enter') {
            if (barcode)
                handleBarcode(barcode);
            barcode = '';
            return;
        }
        if (evt.code != 'Shift')
            barcode += evt.key;
        interval = setInterval(() => barcode = '', 20);
    });

    function handleBarcode(scanned_barcode) {
        document.querySelector('#last-barcode').value = scanned_barcode;
    }
</script>

<!--REGISTRO-->

<body>
    <style>
        .img {
            border-radius: 5px;
        }
    </style>
    <section>
        <style type="text/css">
            #goog-gt-tt {
                display: none !important;
            }

            .goog-te-banner-frame {
                display: none !important;
            }

            .goog-te-menu-value:hover {
                text-decoration: none !important;
            }

            body {
                top: 0 !important;
            }

            #google_translate_element2 {
                display: none !important;
            }

            body>.skiptranslate {
                display: none;
            }
        </style>
        <div id="google_translate_element2"></div>
        <script type="text/javascript">
            function googleTranslateElementInit2() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    autoDisplay: false
                }, 'google_translate_element2');
            }

            function doGTranslate(lang) {
                var teCombo = document.querySelector('.goog-te-combo');
                if (teCombo) {
                    teCombo.value = lang;
                    if (document.createEvent) {
                        var event = document.createEvent('HTMLEvents');
                        event.initEvent('change', true, true);
                        teCombo.dispatchEvent(event);
                    } else {
                        teCombo.fireEvent('onchange');
                    }
                }
            }
        </script>
        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    </section>
    <div class="wrapper">
        <div style="display: flex;">
            <h2>Paying for a bus on <?php echo $routename ?></h2>
            <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="30" width="30" alt="Home" loading="lazy" />
            </a>
            <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="30" width="30" alt="Home" loading="lazy" />
            </a>
        </div>
        <?php
        $sql = "select * from usuario where username = '" . $unamet . "'";
        $result = pg_query($conn, $sql);
        if (pg_num_rows($result)) {
            while ($row = pg_fetch_assoc($result)) {
                $thisuname = $row['username'];
                $rname = $row['name'];
                $e_mail = $row['email'];
            }
        }
        ?>
        <form action="continuepay.php" method="post">
            <div class="input-box">
                <input type="text" name="uname" placeholder="Username" id="uname" value="<?php echo $thisuname ?>" readonly>
            </div>
            <div class="input-box">
                <input type="text" name="name" placeholder="Name and last names" id="name" value="<?php echo $rname ?>" readonly>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="E-mail" id="email" value="<?php echo $e_mail ?>" readonly>
            </div>
            <div class="input-box">
                <input type="text" name="pay" placeholder="The amount will be" id="pay">
            </div>

            <div class="input-box button">
                <input type="Submit" name="subs" value="Continue with the pay">
                <?php if (!empty($errores)) : ?>
                    <div class="error">
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text">
                <h3><a href="mapaprueba.php">Go Back</a></h3>
            </div>
        </form>
    </div>
</body>

</html>