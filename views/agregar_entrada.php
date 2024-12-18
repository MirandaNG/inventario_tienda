<?php
// Iniciar sesión
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];

    // Iniciar una transacción para asegurar consistencia
    $conexion->begin_transaction();

    try {
        // Consulta para insertar la nueva entrada en la base de datos
        $query_entrada = "INSERT INTO entradas (prod_id, entra_cantidad, entra_fecha) VALUES ('$producto_id', '$cantidad', '$fecha')";
        if (!$conexion->query($query_entrada)) {
            throw new Exception("Error al registrar la entrada: " . $conexion->error);
        }

        // Consulta para actualizar el inventario (sumar la cantidad al stock actual)
        $query_actualizar_stock = "UPDATE productos SET prod_stock = prod_stock + $cantidad WHERE prod_id = '$producto_id'";
        if (!$conexion->query($query_actualizar_stock)) {
            throw new Exception("Error al actualizar el inventario: " . $conexion->error);
        }

        // Si ambas consultas son exitosas, confirmar la transacción
        $conexion->commit();
        // Almacenar el mensaje de éxito en la sesión
        $_SESSION['mensaje'] = 'Entrada agregada correctamente y stock actualizado';
        $_SESSION['mensaje_tipo'] = 'success';  // Tipo de mensaje: éxito
    } catch (Exception $e) {
        // Si ocurre un error, deshacer la transacción
        $conexion->rollback();
        // Almacenar el mensaje de error en la sesión
        $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
        $_SESSION['mensaje_tipo'] = 'danger';  // Tipo de mensaje: error
    }

    // Redirigir a la página de entradas después de agregar la entrada
    header("Location: entradas.php");
    exit();
}

// Obtener los productos para el dropdown
$productos_query = "SELECT * FROM productos";
$productos_result = $conexion->query($productos_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Agregar Entrada</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Agregar Nueva Entrada</h2>

                <!-- Mostrar mensaje de éxito o error -->
                <?php
                    if (isset($_SESSION['mensaje'])) {
                        $tipo = $_SESSION['mensaje_tipo'] ?? 'info';  // Si no se ha definido el tipo, usa 'info'
                        echo "<div class='alert alert-$tipo' role='alert'>" . $_SESSION['mensaje'] . "</div>";
                        // Limpiar mensaje después de mostrarlo
                        unset($_SESSION['mensaje']);
                        unset($_SESSION['mensaje_tipo']);
                    }
                ?>

                <!-- Formulario de agregar entrada -->
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select class="form-control" id="producto_id" name="producto_id" required>
                            <option value="">Selecciona un producto</option>
                            <?php while ($row = $productos_result->fetch_assoc()) { ?>
                                <option value="<?php echo $row['prod_id']; ?>"><?php echo $row['prod_nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Entrada</button>
                    <a href="entradas.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
