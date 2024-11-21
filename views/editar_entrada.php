<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $entrada = $conexion->query("SELECT * FROM entradas WHERE entra_id = '$id'")->fetch_assoc();

    if (!$entrada) {
        header("Location: entradas.php?error=Entrada no encontrada");
        exit();
    }

    $producto_id = $entrada['prod_id'];  // Obtener el ID del producto de la entrada
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];

    // Obtener la cantidad original de la entrada
    $cantidad_original = $entrada['entra_cantidad'];

    // Verificar si la cantidad se ha modificado
    if ($cantidad !== $cantidad_original) {
        // Revertir el stock anterior (restar la cantidad original)
        $query_revertir_stock = "UPDATE productos SET prod_stock = prod_stock - $cantidad_original WHERE prod_id = '$producto_id'";
        $conexion->query($query_revertir_stock);

        // Actualizar el stock con la nueva cantidad (sumar la nueva cantidad)
        $query_actualizar_stock = "UPDATE productos SET prod_stock = prod_stock + $cantidad WHERE prod_id = '$producto_id'";
        $conexion->query($query_actualizar_stock);
    }

    // Actualizar la entrada en la base de datos
    $query = "UPDATE entradas SET entra_cantidad = '$cantidad', entra_fecha = '$fecha' WHERE entra_id = '$id'";
    if ($conexion->query($query) === TRUE) {
        header("Location: entradas.php?success=Entrada actualizada correctamente");
    } else {
        header("Location: entradas.php?error=Error al actualizar la entrada");
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
    <title>Editar Entrada</title>
</head>
<body>
    <div class="container">
        <h2>Editar Entrada</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $entrada['entra_cantidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $entrada['entra_fecha']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
