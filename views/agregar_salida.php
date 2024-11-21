<?php
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];

    // Comprobar si hay suficiente stock del producto antes de hacer la salida
    $query_stock = "SELECT prod_stock FROM productos WHERE prod_id = '$producto_id'";
    $resultado_stock = $conexion->query($query_stock);
    $producto = $resultado_stock->fetch_assoc();

    // Si hay suficiente stock, proceder con la salida
    if ($producto['prod_stock'] >= $cantidad) {
        // Insertar la salida en la base de datos
        $query = "INSERT INTO salidas (prod_id, sal_cantidad, sal_fecha, sal_motivo) VALUES ('$producto_id', '$cantidad', '$fecha', '$motivo')";
        if ($conexion->query($query) === TRUE) {
            // Restar la cantidad de stock del producto
            $query_update_stock = "UPDATE productos SET prod_stock = prod_stock - $cantidad WHERE prod_id = '$producto_id'";
            $conexion->query($query_update_stock);

            // Redirigir con mensaje de éxito
            header("Location: salidas.php?success=Salida agregada correctamente y stock actualizado");
        } else {
            // Si hay error al agregar la salida
            header("Location: salidas.php?error=Error al agregar la salida");
        }
    } else {
        // Si no hay suficiente stock
        header("Location: salidas.php?error=No hay suficiente stock para realizar la salida");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Agregar Salida</title>
</head>
<body>
    <div class="container">
        <h2>Agregar Salida</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="producto_id" id="producto_id" class="form-control" required>
                    <?php
                    // Obtener todos los productos para mostrarlos en el dropdown
                    $productos = $conexion->query("SELECT * FROM productos");
                    while ($producto = $productos->fetch_assoc()) {
                        echo "<option value='" . $producto['prod_id'] . "'>" . $producto['prod_nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <textarea name="motivo" id="motivo" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
