<?php
include_once('registergofastpost.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Register now </title>
  <link rel="stylesheet" href="css/styleregister.css">
  <!-- Agrega los enlaces de SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
	<script type="module">
	import sweetalert2 from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/+esm'
	</script>
  <style>

body{
  background: #40CFFF;
  background: linear-gradient(to right, #0000FF, #40CFFF);
}
.bg{
  background-image: url(photos/gofastlogo.png);
  background-position: center center;
}
</style>
</head>

<!--REGISTRO-->

<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="registergofastpost.php" method="post">
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
        <input type="text" name="phone" placeholder="Phone" id="numberphone" required>
      </div>
      <div class="input-box">
        <input type="password" name="pass" placeholder="Password" id="pass1" required>
      </div>
      <div class="input-box">
        <input type="password" name="pass2" placeholder="Repeat Password" id="repeatpass" required>
      </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="conditions" name="conditions" value="1" required>
        <label class="form-check-label" for="conditions">Accept terms & conditions</label>
    </div>
    
      <div class="input-box button">
        <input type="Submit" name="Submit" value="Send">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="logingofast.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
<script>
var names = document.getElementById('names');
names.addEventListener('input', function (evt) {
      this.setCustomValidity('');
    });
    names.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the user field');
      }
    });

    var user = document.getElementById('user');
    user.addEventListener('input', function (evt) {
      this.setCustomValidity('');
    });
    user.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the password field');
      }
    });

    var conditions = document.getElementById('conditions');
    conditions.addEventListener('input', function (evt) {
      this.setCustomValidity('');
    });
    conditions.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the names field');
      }
    });

    var numberphone = document.getElementById('numberphone');
    numberphone.addEventListener('change', function (evt) {
      this.setCustomValidity('');
    });
    numberphone.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the status field');
      }
    });

    var pass1 = document.getElementById('pass1');
    pass1.addEventListener('input', function (evt) {
      this.setCustomValidity('');
    });
    pass1.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the phone field');
      }
    });

    var repeatpass = document.getElementById('repeatpass');
    repeatpass.addEventListener('input', function (evt) {
      this.setCustomValidity('');
    });
    repeatpass.addEventListener('invalid', function (evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the image field');
      }
    });

    function comprobarNombre(valor, campo) {

      var mensaje = "";

      // comprobar los posibles errores
      if (this.value == "") {
        mensaje = "The email cannot be empty";
      } else if (this.value.indexOf("@") < 0) {
        mensaje = "The email must contain an @";
      } else if (this.value.indexOf(".", this.value.indexOf("@")) < 0) {
        mensaje = "Make sure you put the . of .com correctly.";
      } else if (this.value.indexOf("com", this.value.indexOf(".")) < 0) {
        mensaje = "The email must contain .com after the @.";
      }

      // mostrar/resetear mensaje (el mensaje se resetea poniendolo a "")
      this.setCustomValidity(mensaje);
    }

    var Email = document.querySelector("#Email");

    // cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
    Email.addEventListener("invalid", comprobarNombre);
    Email.addEventListener("input", comprobarNombre);
    </script>
</html>