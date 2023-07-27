<?php
include_once('registergfpost.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <title> Register now </title>
  <link rel="stylesheet" href="css/styleregister.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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
    .a:hover{
			color: #033666 !important;
    }

    .bg {
      background-image: url(photos/gofastlogo.png);
      background-position: center center;
    }
  </style>

  <!--===============================================================================================-->

  <!-- jQuery -->

  <script src="js/jquery.min.js"></script>

  <!--===============================================================================================-->

  <!-- Select2 -->

  <script src="js/select2.full.min.js"></script>

  <!--===============================================================================================-->

  <!-- InputMask -->

  <script src="js/jquery.inputmask.min.js"></script>

  <!--===============================================================================================-->

  <!-- Page specific script -->

  <script>
    $(function() {

      $('[data-mask]').inputmask()

    })
  </script>

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
    <h2>Registration</h2>
    <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
    </div>
    <form action="registergf.php" method="post">
      <div class="input-box">
        <input type="text" name="name" placeholder="Name and Last Name" id="names" required>
      </div>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" id="user" required>
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" id="Email" required>
      </div>
      <div class="input-box">
      <input type="text" name="phone" data-inputmask='"mask": "+503 9999-9999"' data-mask required id="phone" placeholder="+503 ____-____">
        <!--input type="tel" maxlength="8" pattern="[0-9]{8}" name="phone" placeholder="Phone XXXXXXXX" id="numberphone" required-->
      </div>
      <div class="input-box" style="width: fit-content; display: flex; align-items: center;">
        <input type="password" name="pass" placeholder="Password" id="pass1" minlength="4" required>
        <i class="far fa-eye" id="togglePassword"></i>
      </div>
      <div class="input-box" style="width: fit-content; display: flex; align-items: center;">
        <input type="password" name="pass2" placeholder="Repeat Password" id="repeatpass" minlength="4" required>
        <i class="far fa-eye" id="togglePassword2"></i>
      </div>
     
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="conditions" name="conditions" value="1" required>
        <label class="form-check-label" for="conditions">Accept our terms & conditions</label>
      </div>

      <div class="input-box button">
        <input type="Submit" onclick="strong()" name="sub" value="Create account">
        <?php if (!empty($errores)) : ?>
          <div class="error">
            <ul>
              <?php echo $errores; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
      <div class="text">
        <h3>Already have an account? <a class="a" href="logingofasttest.php">Login now</a></h3>
        <h3>Forgot your password? <a class="a" href="passchange.php">Change it now!</a></h3>
        <h3>Go back to <a class="a" href="index.php">the main page.</a></h3>
      </div>
    </form>
  </div>
</body>
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#pass1');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
  $(function() {
        $('#pass1').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});

const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#repeatpass');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
  $(function() {
        $('#repeatpass').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});

  var names = document.getElementById('names');
  names.addEventListener('input', function(evt) {
    this.setCustomValidity('');
  });
  names.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('Please fill in the names field');
    }
  });

  var user = document.getElementById('user');
  user.addEventListener('input', function(evt) {
    this.setCustomValidity('');
  });
  user.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('Please fill the username field');
    }
  });

  var conditions = document.getElementById('conditions');
  conditions.addEventListener('input', function(evt) {
    this.setCustomValidity('');
  });
  conditions.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('You must accept terms and conditions.');
    }
  });

  var numberphone = document.getElementById('numberphone');
  numberphone.addEventListener('change', function(evt) {
    this.setCustomValidity('');
  });
  numberphone.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('Please fill in the phone number field');
    }
  });

  var pass1 = document.getElementById('pass1');
  pass1.addEventListener('input', function(evt) {
    this.setCustomValidity('');
  });
  pass1.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('Please fill in the password field');
    }
  });

  var repeatpass = document.getElementById('repeatpass');
  repeatpass.addEventListener('input', function(evt) {
    this.setCustomValidity('');
  });
  repeatpass.addEventListener('invalid', function(evt) {
    // Required
    if (this.validity.valueMissing) {
      this.setCustomValidity('Please confirm your password');
    }
  });

  function comprobarNombre(valor, campo) {

    var mensaje = "";

    // comprobar los posibles errores
    if (this.value == "") {
      mensaje = "The email cannot be empty";
    } else if (this.value.indexOf("@") < 0) {
      mensaje = "The email must contain an @";
    } /*else if (this.value.indexOf(".", this.value.indexOf("@")) < 0) {
      mensaje = "Make sure you put the . of .com correctly.";
    } else if (this.value.indexOf("com", this.value.indexOf(".")) < 0) {
      mensaje = "The email must contain .com after the @.";
    }*/

    // mostrar/resetear mensaje (el mensaje se resetea poniendolo a "")
    this.setCustomValidity(mensaje);
  }

  var Email = document.querySelector("#Email");

  // cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
  Email.addEventListener("invalid", comprobarNombre);
  Email.addEventListener("input", comprobarNombre);
</script>

</html>