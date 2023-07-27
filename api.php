<?php
include('db.php');
include_once('crudadmin2.php');

$action = 'fetch';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'fetch') {
    $output = '';
    $sql = "SELECT * FROM usuario order by idusuario desc";
    $query = pg_query($conn,$sql);
    $cnt = 1;
    while ($row = pg_fetch_assoc($result)) {
        $output .= "
											<tr>
											<td><button class='btn btn-sm btn-danger delete_product' data-id='" . $row['idusuario'] . "'>Delete</button></td>
											</tr>
											";
        $cnt = $cnt + 1;
    }

    echo json_encode($output);
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $output = array();
    $sql = "DELETE FROM usuario WHERE idusuario = '$id'";
    if (pg_query($conn,$sql)) {
        $output['status'] = 'success';
        $output['message'] = 'Member deleted successfully';
    } else {
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the member';
    }

    echo json_encode($output);
}
