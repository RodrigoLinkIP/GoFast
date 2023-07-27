<?php
require_once('db.php');
$upload_dir = 'photos/';
/*session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
  // Si no ha iniciado sesión, redireccionar al formulario de login
  header("Location: index.php");
  exit();
}*/
?>

<style>
  .sidebar {
      background-color: #022547 !important;
    }
    .main-sidebar {
      background-color: #022547 !important;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
    <img src="photos/gofastlogo.png" alt="GoFastLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light notranslate">GoFast</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php 
        $username = $_SESSION['usuario'];
        $sql = "SELECT images FROM usuario WHERE username = $username";
        $resultado = pg_query($conn, $sql);
        if (pg_num_rows($resultado)) {
          while ($row = pg_fetch_assoc($resultado)) {
      ?>
      <div class="image">
          <img src="<?php echo $upload_dir . $row['images'] ?>" class="img-circle elevation-2" height="40">
      </div>
      <?php
          }
        }
      ?>
      <div class="info">
        <a href="userinfo.php" class="d-block notranslate"><?php echo $_SESSION['usuario']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Administrator Module
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a class="nav-link">
                <a href="crudadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <a href="crudadmin_routes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Routes</p>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <a href="crudadmin_payment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Transactions</p>
                </a>
            </li>
            <!--li class="nav-item">
              <a class="nav-link">
                <a href="carnet copy.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Code</p>
                </a>
            </li-->
            <li class="nav-item">
              <a class="nav-link">
                <a href="mapaprueba.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Go to Map</p>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <a href="sumoney2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Money to Users</p>
                </a>
            </li>
          </ul>
        </li>
      </ul>


    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>