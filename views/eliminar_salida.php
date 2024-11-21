<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM salidas WHERE sal_id = '$id'";
    if ($conexion->query($query) === TRUE) {
        header("Location: salidas.php?success=Salida eliminada correctamente");
    } else {
        header("Location: salidas.php?error=Error al eliminar la salida");
    }
}
?>
