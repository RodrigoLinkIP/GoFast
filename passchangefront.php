<?php
include_once('passchange.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title> Password Changer </title>
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
		.a:hover{
			color: #033666 !important;
		}
    </style>
</head>

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
            <div id="google_translate_element2"></div><script type="text/javascript">
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
    <h2>Password changer</h2>
    <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
    </div>
        <div class="text">
            <a>Input the e-mail address linked to your account below, we'll send you a token, put that on the second text-box.</a>
        </div>
        <form action="passchangefront.php" method="post">
            <div class="input-box">
                <input type="email" name="email" placeholder="Email address" id="email">
            </div>

            <div class="input-box button">
                <input class="btn-primary" type="Submit" name="subs" value="Send me a code!">
                <?php if (!empty($errores)) : ?>
                    <div class="error">
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <input type="number" name="code" placeholder="Verification code" id="code" min="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="6">
            </div>

            <div class="input-box button">
                <input class="btn-primary" type="Submit" name="sub2" value="Change password!">
                <?php if (!empty($errores)) : ?>
                    <div class="error">
                        <ul>
                            <?php echo $errores; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text">
                <h3>Already have an account? <a class="a" href="logingofasttest.php">Login now!</a></h3>
            </div>
        </form>
    </div>
</body>

</html>