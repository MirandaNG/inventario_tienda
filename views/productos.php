<?php
// Iniciar sesión
session_start();
include '../config/conexion.php';

// Obtener los productos para la tabla
$productos_query = "SELECT * FROM productos ORDER BY prod_id ASC";
$productos_result = $conexion->query($productos_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Gestión de Productos</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-9 main-content">
                <h2>Gestión de Productos</h2>

                <!-- Mostrar mensaje de éxito o error -->
                <?php
                    if (isset($_SESSION['mensaje'])) {
                        $tipo = $_SESSION['mensaje_tipo'] ?? 'info'; // Por defecto, tipo 'info'
                        echo "<div class='alert alert-$tipo' role='alert'>" . $_SESSION['mensaje'] . "</div>";
                        unset($_SESSION['mensaje']);
                        unset($_SESSION['mensaje_tipo']);
                    }
                ?>

                <!-- Botón para agregar producto -->
                <div class="mb-3">
                    <a href="agregar_producto.php" class="btn btn-primary">Agregar Producto</a>
                </div>

                <!-- Tabla de productos -->
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Temporada</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($productos_result->num_rows > 0) {
                                while ($producto = $productos_result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $producto['prod_nombre']; ?></td>
                                        <td><?php echo $producto['prod_categoria']; ?></td>
                                        <td><?php echo $producto['prod_talla']; ?></td>
                                        <td><?php echo $producto['prod_color']; ?></td>
                                        <td><?php echo $producto['prod_temporada']; ?></td>
                                        <td>$<?php echo number_format($producto['prod_precio'], 2); ?></td>
                                        <td><?php echo $producto['prod_stock']; ?></td>
                                        <td>
                                            <a href="editar_producto.php?id=<?php echo $producto['prod_id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="eliminar_producto.php?id=<?php echo $producto['prod_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="9" class="text-center">No hay productos registrados</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
