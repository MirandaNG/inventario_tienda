<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la información de la entrada antes de eliminarla
    $query_entrada = "SELECT * FROM entradas WHERE entra_id = '$id'";
    $resultado_entrada = $conexion->query($query_entrada);

    if ($resultado_entrada->num_rows > 0) {
        $entrada = $resultado_entrada->fetch_assoc();
        $prod_id = $entrada['prod_id'];
        $cantidad = $entrada['entra_cantidad'];

        // Actualizar el stock del producto (restar la cantidad eliminada)
        $query_update_stock = "UPDATE productos SET prod_stock = prod_stock - $cantidad WHERE prod_id = '$prod_id'";
        $conexion->query($query_update_stock);

        // Eliminar la entrada
        $query_delete = "DELETE FROM entradas WHERE entra_id = '$id'";
        if ($conexion->query($query_delete) === TRUE) {
            header("Location: entradas.php?success=Entrada eliminada correctamente y stock actualizado");
        } else {
            header("Location: entradas.php?error=Error al eliminar la entrada");
        }
    } else {
        header("Location: entradas.php?error=Entrada no encontrada");
    }
}
?>
