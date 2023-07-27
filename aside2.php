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
    <span class="brand-text font-weight-light">GoFast</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!--<div class="image">
          <img src="" class="img-circle elevation-2" alt="User Image">
        </div>-->
      <div class="info">
        <a href="userinfo.php" class="d-block"><?php echo $_SESSION['usuario']; ?></a>
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
              Employeer Module
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a class="nav-link">
                <a href="employercrud.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Routes</p>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <a href="employercrud_payments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments made to you</p>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <a href="employercrud_accroutes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Acquire Routes</p>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <a href="employercrud_hireemploy.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hire Employees</p>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <a href="mapaprueba.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Go to Map</p>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <a href="employercrud_user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Employees</p>
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