<?php
require_once('db.php');
/*include('eliminar.php');*/
include('add2.php');
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
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<body class="hold-transition sidebar-mini sidebar-closed sidebar-collapse">
  <div class="wrapper" id="load-products">

    <?php require_once('navbar.php'); ?>
    <?php require_once('aside.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>GoFast</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcum-item"><a href="redirgal.php">Home</a></li>
                <li class="breadcrumb-item active">GoFast</li>
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
                <div class="card-header">
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
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="pass" class="form-control" id="InputPassword" placeholder="Enter Password" value="" required>
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
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="tel" maxlength="8" pattern="[0-9]{8}" name="phone" class="form-control" id="InputPhone" placeholder="XXXX-XXXX" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Choose Image</label>
                      <input type="file" name="image" class="form-control" id="InputImage" value="">
                    </div>
                    <div class="form-group mb-0">

                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Save</button>
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
                            <td><img src="<?php echo $upload_dir . $row['images'] ?>" height="40"></td>
                            <td>
                              <?php echo $row['username'] ?>
                            </td>
                            <td>
                              <?php echo $row['name'] ?>
                            </td>
                            <td>
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
                                echo $row['token'];
                              } ?>
                            </td>
                            <td>
                              <?php if ($row['status'] == 0) {
                                echo "Inactive";
                              } else if ($row['status'] == 1) {
                                echo "Unverified";
                              } else if ($row['status'] == 2) {
                                echo "Verified";
                              } ?>
                            </td>
                            </td>
                            <td class="text-center">
                              <a href="update.php?idusuario=<?php echo $row['idusuario'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                              <a class="btn btn-danger" href="delete.php?id=<?php echo $row['idusuario']; ?>"><i class="fa fa-trash-alt"></i></a>
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
  <script src="plugins/jquery/jquery.min.js"></script>
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
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
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

    var InputPhone = document.getElementById('InputPhone');
    InputPhone.addEventListener('input', function(evt) {
      this.setCustomValidity('');
    });
    InputPhone.addEventListener('invalid', function(evt) {
      // Required
      if (this.validity.valueMissing) {
        this.setCustomValidity('Please fill in the phone field');
      }
    });

    var InputImage = document.getElementById('InputImage');
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
      else if (this.value.indexOf(".", this.value.indexOf("@")) < 0) {
        mensaje = "Make sure you put the . of .com correctly.";
      } else if (this.value.indexOf("com", this.value.indexOf(".")) < 0) {
        mensaje = "The email must contain .com after the @.";
      }

      // mostrar/resetear mensaje (el mensaje se resetea poniendolo a "")
      this.setCustomValidity(mensaje);
    }

    var InputEmail = document.querySelector("#InputEmail");

    // cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
    InputEmail.addEventListener("invalid", comprobarNombre);
    InputEmail.addEventListener("input", comprobarNombre);
  </script>

<script type="text/javascript">
											$(document).ready(function(){
												fetch();

												$(document).on('click', '.delete_product', function(){
													var id = $(this).data('id');

													swal.fire({
														title: 'Are you sure?',
														text: "You won't be able to revert this!",
														icon: 'warning',
														showCancelButton: true,
														confirmButtonColor: '#3085d6',
														cancelButtonColor: '#d33',
														confirmButtonText: 'Yes, delete it!',
													}).then((result) => {
														if (result.value){
															$.ajax({
																url: 'api.php?action=delete',
																type: 'POST',
																data: 'id='+id,
																dataType: 'json'
															})
															.done(function(response){
																swal.fire('Deleted!', response.message, response.status);
																fetch();
															})
															.fail(function(){
																swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
															});
														}

													})

												});
											});

											function fetch(){
												$.ajax({
													method: 'POST',
													url: 'api.php',
													dataType: 'json',
													success: function(response){
														$('#tbody').html(response);
													}
												});
											}
										</script>

</body>

</html>