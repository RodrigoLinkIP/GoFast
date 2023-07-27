<?php
if (isset($_GET["var"])) {
    // asignar w1 y w2 a dos variables
    $phpVar1 = $_GET["var"];
 
    // mostrar $phpVar1 y $phpVar2
    echo "<p>Parameters: " . $phpVar1 . "</p>";
} else {
    echo "<p>No parameters</p>";
}