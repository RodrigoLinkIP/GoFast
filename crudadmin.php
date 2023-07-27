<?php
require_once('db.php');
include('add.php');
include('delete.php');
require_once('vendor/autoload.php');

use Picqer\Barcode\BarcodeGeneratorHTML;

$upload_dir = 'photos/';
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
} else if (!isset($_SESSION['admin'])) {
  header("Location: redirgal.php");
  exit();
}
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "select * from usuario where idusuario = " . $id;
  $result = pg_query($conn, $sql);
  if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $image = $row['images'];
    unlink($upload_dir . $image);
    $sql = "delete from usuario where idusuario=" . $id;
    if (pg_query($conn, $sql)) {
      header('location:crudadmin.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweet Alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
  <script type="module">
    import sweetalert2 from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/+esm'
  </script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

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

<body class="hold-transition sidebar-mini sidebar-closed sidebar-collapse">
  <div class="wrapper">

    <?php require_once('navbar.php'); ?>
    <?php require_once('aside.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="notranslate">GoFast</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="redirgal.php">Home</a></li>
                <li class="breadcrumb-item active notranslate">GoFast</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header" style="background-color: #033666;">
                  <h3 class="card-title">Manage User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="" action="add.php" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username" class="form-control" id="InputUser" placeholder="Enter Username" value="" required>
                    </div>
                    <label for="exampleInputEmail1">Password</label>
                    <div class="form-group" style="width: fit-content; display: flex; align-items: center;">
                      <input type="password" name="pass" class="form-control" id="InputPassword" placeholder="Enter Password" minlength="4" value="" required>
                      <i class="far fa-eye" style="cursor: pointer;" id="togglePassword"></i>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Names</label>
                      <input type="text" name="names" class="form-control" id="InputNames" placeholder="Enter Names" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="status" class="form-control" id="SelectStatus" required>
                        <option value="2">Verified</option>
                        <option value="1">Unverified</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Permission</label>
                      <select name="permission" class="form-control" id="SelectPermission" required>
                        <i class="far fa-calendar-alt"></i>
                        <option select disabled>Select Permission</option>
                        <?php
                        $sql = "SELECT * FROM permiso";
                        $consulta = pg_query($conn, $sql);

                        while ($fila = pg_fetch_array($consulta)) {
                          echo "<option value='" . $fila['idpermiso'] . "'>" . $fila['nombre_permiso'] . "</option>";
                        }
                        ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter email" value="" required>
                    </div>
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" name="phone" class="form-control" id="phone" data-inputmask='"mask": "+503 9999-9999"' placeholder="+503 ____-____" data-mask required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Choose Image</label>
                      <input type="file" name="image" class="form-control" id="image" value="">
                    </div>
                    <div class="form-group mb-0">

                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" style="background-color: #033666;">Submit</button>
                  </div>

                  <?php if (!empty($errores)) : ?>
                    <div class="error">
                      <ul>
                        <?php echo $errores; ?>
                      </ul>
                    </div>
                  <?php endif; ?>

                </form>
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Names</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Balance</th>
                        <th>Employed By</th>
                        <th>Codebar</th>
                        <th>Code</th>
                        <th>Active Tokens</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "select * from usuario";
                      $result = pg_query($conn, $sql);
                      if (pg_num_rows($result)) {
                        while ($row = pg_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td><img src="<?php echo $upload_dir . $row['images'] ?>" height="50" width="50"></td>
                            <td class="notranslate">
                              <?php echo $row['username'] ?>
                            </td>
                            <td class="notranslate">
                              <?php echo $row['name'] ?>
                            </td>
                            <td class="notranslate">
                              <?php echo $row['email'] ?>
                            </td>
                            <td>
                              <?php echo $row['phone'] ?>
                            </td>
                            <td>
                              <?php if ($row['idpermiso'] == 1) {
                                echo "Administrator";
                              } else if ($row['idpermiso'] == 2) {
                                echo "Employer";
                              } else if ($row['idpermiso'] == 3) {
                                echo "User";
                              } else if ($row['idpermiso'] == 4) {
                                echo "Driver";
                              } ?>
                            </td>

                            <td>
                              <?php echo "$" . strval($row['money']) ?>
                            </td>

                            <td class="notranslate">
                            <?php if ($row['idpermiso'] != 4) {
                                echo "This user is not a driver";
                              } else if ($row['employerboss'] == NULL and $row['idpermiso'] == 4) {
                                echo "This user hasn't been hired yet";
                              } else if ($row['employerboss'] != NULL and $row['idpermiso'] == 4) {
                                echo $row['employerboss'];
                              } ?>
                            </td>
                            <?php
                            $codigoBarras = $row["barcode"];

                            // Crear una instancia del generador de códigos de barras HTML
                            $generator = new BarcodeGeneratorHTML();

                            // Generar el código de barras en formato HTML
                            $codigoBarrasHtml = $generator->getBarcode($codigoBarras, BarcodeGeneratorHTML::TYPE_CODE_128);
                            ?>
                            <td>
                              <?php echo $codigoBarrasHtml; ?>
                            <td>
                              <?php echo $row['barcode'] ?>
                            </td>
                            <td>
                              <?php if ($row['token'] == null) {
                                echo "None";
                              } else {
                                echo "A token is active";
                              } ?>
                            </td>
                            <td>
                              <?php if ($row['status'] == 0) {
                                echo "Innactive";
                              } else if ($row['status'] == 1) {
                                echo "Unverified";
                              } else if ($row['status'] == 2) {
                                echo "Verified";
                              } ?>
                            </td>
                            </td>
                            <td class="text-center">
                              <a href="update.php?idusuario=<?php echo $row['idusuario'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                              <a href="pdfcarnet copy.php?idusuario=<?php echo $row['idusuario'] ?>" class="btn btn-info"><i class="fa fa-id-card"></i></a>
                              <a class="btn btn-danger" onclick="destroyReg()"><i class="fa fa-trash-alt"></i></a>
                              <script>
                                function destroyReg() {
                                  Swal.fire({
            title: 'Warning!',
            text: "You're about to permanently delete this record. Proceed?",
            iconHtml: "<img src='<?php echo $upload_dir . $row['images'] ?>' class='rounded-circle' height='100' width='100'>",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed',
            cancelButtonText: 'No, go back!'
        }).then((result) => {
            if (result.isConfirmed) 
            {(setTimeout(function(){window.location = 'delete.php?idusuario=<?php echo $row['idusuario']; ?>';}, 0))}
          });
                                }
                              </script>
                              </a>

                            </td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Names</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Balance</th>
                        <th>Employed By</th>
                        <th>Codebar</th>
                        <th>Code</th>
                        <th>Active Tokens</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!--script src="plugins/jquery/jquery.min.js"></script-->
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
  <script type="module">
    import sweetalert2 from "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/+esm"
  </script>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#InputPassword');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
     $(function() {
        $('#InputPassword').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});

    var InputUser = document.getElementById('InputUser');
    InputUser.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputUser.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the user field');
      }
    });

    var InputPassword = document.getElementById('InputPassword');
    InputPassword.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputPassword.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the password field');
      }
    });

    var InputNames = document.getElementById('InputNames');
    InputNames.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputNames.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the names field');
      }
    });

    var SelectStatus = document.getElementById('SelectStatus');
    SelectStatus.addEventListener('change', function(evt) {
      this.setCustomValidity('');
    });
    SelectStatus.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill the status field');
      }
    });

    var SelectPermission = document.getElementById('SelectPermission');
    SelectPermission.addEventListener('change', function(evt) {
      this.setCustomValidity('');
    });
    SelectPermission.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the permission field');
      }
    });

    var InputPhone = document.getElementById('phone');
    InputPhone.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputPhone.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the phone field');
      }
    });

    var InputImage = document.getElementById('image');
    InputImage.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputImage.addEventListener('invalid', function(evt) {
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
      }
      /*else if (this.value.indexOf("ñ") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("á") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Á") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("é") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("É") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("í") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Í") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ó") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ó") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ú") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ú") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ä") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ä") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ë") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ë") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ï") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ï") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ö") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ö") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("Ü") < 0) {
              mensaje = "The email not must contain an special character";
            }else if (this.value.indexOf("ü") < 0) {
              mensaje = "The email not must contain an special character";
            } */
      /*else if (this.value.indexOf(".", this.value.indexOf("@")) < 0) {
        mensaje = "Make sure you put the . of .com correctly.";
      } else if (this.value.indexOf("com", this.value.indexOf(".")) < 0) {
        mensaje = "The email must contain .com after the @.";
      }*/

      // mostrar/resetear mensaje (el mensaje se resetea poniendolo a "")
      this.setCustomValidity(mensaje);
    }

    var InputEmail = document.querySelector("#InputEmail");

    // cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
    InputEmail.addEventListener("invalid", comprobarNombre);
    InputEmail.addEventListener("input", comprobarNombre);
  </script>


</body>

</html>