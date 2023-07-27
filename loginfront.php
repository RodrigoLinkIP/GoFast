<?php
session_start();

require("db.php");
require_once("logingofasttest.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/stylelogin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<!-- Agrega los enlaces de SweetAlert -->
	<!-- link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" -->
	<!-- script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		body {
			background-image: url(https://assets.volvo.com/is/image/VolvoInformationTechnologyAB/1860x1050-Volvo-9900-Landscape-2018?wid=1024);
			background-position: center;
			background-size: 100%;
			background-color: none;
		}

		.bg {
			background-image: url(photos/gofastlogo.png);
			background-position: center center;
			background-color: #033666 !important;
		}
		.btn-primary{
			color: #033666;
			background-color: white;
			border-color: #033666;
		}
		.btn-primary:hover{
			background-color: #033666;
			border-color: #033666;
		}
		.a:hover{
			color: #033666;
		}
	</style>

<script>
       var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
    document.write("<style>body{background-color: #033666; background-image: none;}</style>")
}

    </script>
</head>



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
	<div class="container w-75 bg-primary mt-5 rounded shadow">
		<div class="row align-items-stretch">
			<div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
			</div>
			<div class="col bg-white p-5 rounded-end">
				<div class="text-end">
				</div>
				<div style="display: flex;">
    <h2>Login</h2>
    <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="30" width="30" alt="Home" loading="lazy" />
          </a>
    </div>
	

				<!--LOGIN-->

				<form action="loginfront.php" method="post">
					<div class="mb-4">
						<label for="email" class="form-label" required>Username</label>
						<input type="text" class="form-control" name="logger">
					</div>
					<label for="password" class="form-label" required>Password</label>
					<div class="mb-4" style="width: fit-content; display: flex; align-items: center;">
						<input type="password" class="form-control" name="pwd" id="pwd">
						<i class="far fa-eye" id="togglePassword"></i>
					</div>
					<div class="d-grid">
						<button type="submit" name="subs" value="Iniciar" class="btn btn-primary">Log In</button>
						<?php if (!empty($errores)) : ?>
							<div class="error">
								<ul>
									<?php echo $errores; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>

					<div class="my-3">
						<span>Don't have an account? <a class="a" href="registergf.php">Register now</a></span><br>
						<span>Forgot your password? <a class="a" href="passchange.php">Change it now!</a></span><br>
						<span>Go back to <a class="a" href="index.php">the main page.</a></span>
						<span><a href="#"></a></span>
					</div>
				</form>

				<!--LOGIN-->

			</div>
		</div>
	</div>

	<script src="js/bootstrap.bundle.min.js.map"></script>
</body>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#pwd');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
  $(function() {
        $('#pwd').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});
</script>

</html>