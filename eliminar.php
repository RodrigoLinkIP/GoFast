<?php
require_once('db.php');
require_once('crudadmin2.php');

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
        header('location:crudadmin2.php');
      }
    }
  }
?>