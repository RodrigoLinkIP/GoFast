<?php
require_once('db.php');
$upload_dir = 'photos/';
//Consulta para obtener la infromacion con el ID

/*$sql = "select * from usuario where idusuario = 1";
$data = pg_query($conn, $sql);*/

if (!isset($_GET['idusuario'])) {
    $idusuario = $_GET['idusuario'];
    $sql = "select * from usuario where idusuario=$idusuario";
    $result = pg_query($conn, $sql);
    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
    } else {
        $errorMsg = 'Could not Find Any Record';
    }

?>

<!DOCTYPE html>
<html>

<head>
    <!------ Include the above in your HEAD tag ---------->
    <title>User Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10">
                <h1>Editing user data</h1>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                <form class="form" action="" method="post" enctype="multipart/form-data">
                    <?php
                    $sql = "select * from usuario where idusuario = $idusuario";
                    $result = pg_query($conn, $sql);
                    if (pg_num_rows($result)) {
                        while ($row = pg_fetch_assoc($result)) {
                    ?>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h4>ID</h4>
                                    </label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="id" title="your id" value="<?php echo $row['idusuario']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h4>Username</h4>
                                    </label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="username" title="enter your username if any." value="<?php echo $row['nombre_usuario']; ?>">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h4>First name</h4>
                                    </label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="first name" title="enter your first name if any." value="<?php echo $row['nombres']; ?>">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h4>Last name</h4>
                                    </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="last name" title="enter your last name if any." value="<?php echo $row['apellidos']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="phone">
                                        <h4>Phone</h4>
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="enter mobile phone" title="enter your phone number if any." value="<?php echo $row['phone']; ?>">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="enter your email" title="enter your email." value="<?php echo $row['email']; ?>">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>Image</h4>
                                    </label>
                                    <br />
                                    <img src="<?php echo $upload_dir . $row['imagenes']; ?>" class="avatar img-circle img-thumbnail">
                                    <input type="file" class="text-center center-block file-upload" name="imagenes" value="<?php echo $upload_dir . $row['imagenes']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="Submit" value="Submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                </div>
                            </div>
                    <?php
                        }
                    }
                }
                    ?>
                </form>
            </div><!--/tab-pane-->
        </div><!--/tab-pane-->
    </div><!--/tab-content-->


    </div><!--/row-->
</body>

</html>