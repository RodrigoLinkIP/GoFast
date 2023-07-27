<?php
require_once('db.php');
$upload_dir = 'photos/';
require_once('vendor/autoload.php');

use Picqer\Barcode\BarcodeGeneratorHTML;
/*session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
}*/

if (isset($_GET['idusuario'])) {
    $id = $_GET['idusuario'];
    $sql = "select * from usuario where idusuario=" . $id;
    $result = pg_query($conn, $sql);
    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
    } else {
        $errorMsg = 'No se encontro nada';
    }
}

if (isset($_POST['submit'])) {
    $id = $_POST['idusuario'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $password = hash("sha512", "$pass");
    $names = $_POST['names'];
    $status = $_POST['status'];
    $permission = $_POST['permission'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $errores = '';

    $sql = "update usuario set name = '$names', username = '$username', email = '$email', phone = '$phone', status = '$status', idpermiso = '$permission' where idusuario =" . $id;
    $result = pg_query($conn, $sql);
    if ($result) {
        $errores .= "<script>Swal.fire({
                title: 'Success update',
                icon: 'success',
                confirmButtonText: 'Accept'
                }).then(function() {
                  window.location = 'employercrud.php';
                  });
              </script>";
    } else {
        $errores .= "<script>Swal.fire({
                title: 'Oppss...',
                icon: 'error',
                text: 'Error while updating',
                confirmButtonText: 'Accept'
                }).then(function() {
                    window.location = 'update2.php';
                    });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once('navbar.php'); ?>
        <?php require_once('aside2.php'); ?>

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
                                <li class="breadcrumb-item"><a href="cruduser.php">Home</a></li>
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
                                <form id="" action="update2.php" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" name="idusuario" class="form-control" id="idusuario" placeholder="" value="<?php echo $row['idusuario']; ?>" style="display: none;" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" name="username" class="form-control" id="InputUser" placeholder="" value="<?php echo $row['username']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Names</label>
                                            <input type="text" name="names" class="form-control" id="InputNames" placeholder="" value="<?php echo $row['name'] ?>" required>
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
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" class="form-control" id="InputEmail" placeholder="" value="<?php echo $row['email'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <input type="number" name="phone" class="form-control" id="InputPhone" placeholder="" value="<?php echo $row['phone'] ?>" required>
                                        </div>
                                        <div class="form-group mb-0">

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Modify</button>
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
                                    <h3 class="card-title">Drivers</h3>
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
                                                <th>Status</th>
                                                <th>Codebar</th>
                                                <th>Codebar Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "select * from usuario where idpermiso = 4";
                                            $result = pg_query($conn, $sql);
                                            if (pg_num_rows($result)) {
                                                while ($row = pg_fetch_assoc($result)) {
                                            ?>
                                                    <tr>
                                                        <td><img src="<?php echo $upload_dir . $row['images'] ?>" height="40">
                                                        </td>
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
                                                        <?php
                                                        $sql = "SELECT * FROM permiso where idpermiso = 4";
                                                        $consulta = pg_query($conn, $sql);
                                                        while ($row2 = pg_fetch_assoc($consulta)) {
                                                        ?>
                                                            <td>
                                                                <?php echo $row2['nombre_permiso'] ?>
                                                            </td>
                                                        <?php } ?>
                                                        <td>
                                                            <?php echo $row['barcode'] ?>
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
                                                <th>Status</th>
                                                <th>Codebar</th>
                                                <th>Codebar Image</th>
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

        var InputEmail = document.querySelector("#InputEmail");

        // cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
        InputEmail.addEventListener("invalid", comprobarNombre);
        InputEmail.addEventListener("input", comprobarNombre);
    </script>
</body>

</html>