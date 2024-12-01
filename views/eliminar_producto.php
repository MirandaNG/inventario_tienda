<?php
include '../config/conexion.php';

$id = $_GET['id'];

$query = "DELETE FROM productos WHERE prod_id = $id";
if ($conexion->query($query)) {
    header('Location: productos.php');
} else {
    echo "Error al eliminar producto: " . $conexion->error;
}
?>
