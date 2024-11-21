<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM entradas WHERE entra_id = '$id'";
    if ($conexion->query($query) === TRUE) {
        header("Location: entradas.php?success=Entrada eliminada correctamente");
    } else {
        header("Location: entradas.php?error=Error al eliminar la entrada");
    }
}
?>