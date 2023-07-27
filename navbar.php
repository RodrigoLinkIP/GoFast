<?php
require_once('db.php');
$upload_dir = 'photos/';
?>

<style>
  .navbar {
      background-color: #033666 !important;
    }

    .img {
      border-radius: 5px;
    }

    .nav-link {
      padding: 0.25rem !important;
    }

    .navbar-nav li {
      display: flex !important;
      padding-left: 3px !important;
      padding-right: 3px !important;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
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

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
  <a class="nav-link d-flex align-items-center" href="userinfo.php" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <?php
            $unamet = $_SESSION['usuario'];
            $sql = "select * from usuario where username = '" . $unamet . "'";
            $result = pg_query($conn, $sql);
            if (pg_num_rows($result)) {
              while ($row = pg_fetch_assoc($result)) {
            ?>
                <img style="background-color: white;" src="<?php echo $upload_dir . $row['images']; ?>" class="rounded-circle" height="50" width="50" alt="<?php echo $row['username']; ?>'s Profile" title="<?php echo $row['username']; ?>'s Profile" loading="lazy" />
            <?php
              }
            }
            ?>
          </a>
    </li>
    <li>
    <a class="nav-link d-flex align-items-center" href="redirgal.php" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" src="https://icon-library.com/images/white-home-icon-png/white-home-icon-png-21.jpg" height="50" alt="Home" loading="lazy" />
          </a>
    </li>
    <li>
    <a class="nav-link d-flex align-items-center" onclick="ByeByeAl()" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" src="https://icon-library.com/images/logout-icon-png/logout-icon-png-13.jpg" height="50" alt="Log Out" loading="lazy" />
          </a>
    </li>
    <li>
    <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="50" width="50" alt="Home" loading="lazy" />
          </a>
    </li>
    <li>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="50" width="50" alt="Home" loading="lazy" />
          </a>
    </li>
  </ul>
  <script>
                                function ByeByeAl() {
                                  Swal.fire({
            title: 'Leaving so soon?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, goodbye!',
            cancelButtonText: 'Not yet!'
        }).then((result) => {
            if (result.isConfirmed) 
            {(setTimeout(function(){window.location = 'closesession.php';}, 0))}
          });
                                }
                              </script>
</nav>