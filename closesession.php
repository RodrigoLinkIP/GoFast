<?php
session_start();
session_destroy();
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
} else {
    header('Location: index.php');
}

?>