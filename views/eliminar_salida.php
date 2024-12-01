<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la información de la salida antes de eliminarla
    $query_salida = "SELECT * FROM salidas WHERE sal_id = '$id'";
    $resultado_salida = $conexion->query($query_salida);

    if ($resultado_salida->num_rows > 0) {
        $salida = $resultado_salida->fetch_assoc();
        $prod_id = $salida['prod_id'];
        $cantidad = $salida['sal_cantidad'];

        // Actualizar el stock del producto (sumar la cantidad eliminada)
        $query_update_stock = "UPDATE productos SET prod_stock = prod_stock + $cantidad WHERE prod_id = '$prod_id'";
        $conexion->query($query_update_stock);

        // Eliminar la salida
        $query_delete = "DELETE FROM salidas WHERE sal_id = '$id'";
        if ($conexion->query($query_delete) === TRUE) {
            header("Location: salidas.php?success=Salida eliminada correctamente y stock actualizado");
        } else {
            header("Location: salidas.php?error=Error al eliminar la salida");
        }
    } else {
        header("Location: salidas.php?error=Salida no encontrada");
    }
}
?>

