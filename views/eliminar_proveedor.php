<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM proveedores WHERE prov_id = '$id'";
    if ($conexion->query($query) === TRUE) {
        header("Location: proveedores.php?success=Proveedor eliminado correctamente");
    } else {
        header("Location: proveedores.php?error=Error al eliminar proveedor");
    }
} else {
    header("Location: proveedores.php?error=ID de proveedor no especificado");
}
?>
