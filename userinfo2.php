<?php
require_once('vendor/autoload.php');
require_once('db.php');

use Picqer\Barcode\BarcodeGeneratorHTML;
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

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


<!DOCTYPE html>
<html>

<head>
    <!------ Include the above in your HEAD tag ---------->
    <title><?php echo $_SESSION['usuario'] ?>'s information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Poner y quitar readonly script-->
    <script>
        function activar() {
            document.getElementById('image').disabled = false;
            document.getElementById('username').disabled = false;
            document.getElementById('firstname').disabled = false;
            document.getElementById('lastname').disabled = false;
            document.getElementById('phone').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('barcode').disabled = false;
        }

        function desactivar() {
            document.getElementById('image').disabled = false;
            document.getElementById('username').disabled = true;
            document.getElementById('firstname').disabled = false;
            document.getElementById('lastname').disabled = false;
            document.getElementById('phone').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('barcode').disabled = false;
        }
    </script>
</head>


<hr>

<body>
    <div class="container bootstrap snippet">
        <div class="row">

        <section>

					<style type="text/css">
						.gflagen {

							display: inline-block;

							width: 16px;

							height: 16px;

							background-repeat: no-repeat;

							background-image: url(//gtranslate.net/flags/16.png);

						}

						body>.skiptranslate {
							display: none;
						}


						.gflag {
							display: inline-block;

							background-image: url(//gtranslate.net/flags/16a.png);

						}




						#google_translate_element2 {

							display: none;

						}
					</style>

					<a href="#" onclick="doGTranslate('en'); return false;" title="English" class="gflagen"></a>
					<a href="#" onclick="doGTranslate('es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Spanish" /></a>
					<a href="#" onclick="doGTranslate('de');return false;" title="German" class="gflag:hover nturl" style="background-position:-300px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="German" /></a>

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

            <div class="col-sm-10">
                <h1><?php echo $_SESSION['usuario'] ?>'s info</h1>
            </div>
        </div>
        <?php
        $sql = "select * from usuario where username = '". $unamet ."'";
        $result = pg_query($conn, $sql);
        if (pg_num_rows($result)) {
            while ($row = pg_fetch_assoc($result)) {
        ?>
                <div class="row">
                    <div class="col-sm-3"><!--left col-->


                        <div class="text-center">
                            <img src="<?php echo $upload_dir . $row['images']; ?>" width="250" height="250" class="avatar img-circle img-thumbnail">
                        </div>
                        </hr><br>
                    </div><!--/col-3-->
                    <div class="col-sm-9">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                        </ul>


                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <hr>
                                <form class="form" method="post" id="registrationForm">
                                    <div class="form-group">
                                            <input type="text" class="form-control" name="idusuario" id="idusuario" placeholder="idusuario" title="idusuario" value="<?php echo $row['idusuario']; ?>"  style="display: none;">
                                        
                                    </div>

                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="first_name">
                                                <h4>Username</h4>
                                            </label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="username" title="enter your username if any." value="<?php echo $row['username']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="first_name">
                                                <h4>First and last names</h4>
                                            </label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="first name" title="enter your first name if any." value="<?php echo $row['name']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="phone">
                                                <h4>Phone</h4>
                                            </label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="enter mobile phone" title="enter your phone number if any." value="<?php echo $row['phone']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="email">
                                                <h4>Email</h4>
                                            </label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="enter your email" title="enter your email." value="<?php echo $row['email']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="email">
                                                <h4>Barcode</h4>
                                            </label>
                                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $row['barcode']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="email">
                                                <h4>Barcode Image</h4>
                                            </label>
                                            <?php
                                            $codigoBarras = $row["barcode"];

                                            // Crear una instancia del generador de códigos de barras HTML
                                            $generator = new BarcodeGeneratorHTML();

                                            // Generar el código de barras en formato HTML
                                            $codigoBarrasHtml = $generator->getBarcode($codigoBarras, BarcodeGeneratorHTML::TYPE_CODE_128);
                                            ?>
                                            <?php echo $codigoBarrasHtml; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="email">
                                                <h2><a href="redirgal.php">Go back</a></h2>
                                            </label>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <div class="col-xs-12">
                                            <br>
                                            <a name="Submit" href="update_userinfo.php?idusuario=</*?php echo $row['idusuario']*/>" class="btn btn-lg btn-success"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                        </div>
                                    </div>-->
                            <?php
                        }
                    }
                            ?>
                                </form>

                                <hr>

                            </div><!--/tab-pane-->
                            </form>
                        </div><!--/tab-pane-->
                    </div><!--/tab-content-->

                </div><!--/col-9-->
    </div><!--/row-->
</body>

</html>