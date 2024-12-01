<?php
    include '../config/conexion.php';

    // Consulta para obtener las órdenes de compra con su total calculado
    $query = "
    SELECT 
        ordenes.orden_id,
        proveedores.prov_nombre,
        ordenes.orden_fecha,
        ordenes.orden_estado,
        SUM(detalles_pedido.det_pedo_cantidad * detalles_pedido.det_pedo_costo_unitario) AS orden_total
    FROM ordenes
    JOIN proveedores ON ordenes.prov_id = proveedores.prov_id
    JOIN detalles_pedido ON ordenes.orden_id = detalles_pedido.pedo_id
    GROUP BY ordenes.orden_id
    ORDER BY ordenes.orden_fecha DESC
    ";
    $result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Órdenes de Compra</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Gestión de Órdenes de Compra</h2>

                <!-- Botón para agregar orden -->
                <div class="mb-3">
                    <a href="agregar_orden.php" class="btn btn-primary">Agregar Orden</a>
                </div>

                <!-- Tabla de órdenes de compra -->
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prov_nombre'] . "</td>";
                                    echo "<td>" . $row['orden_fecha'] . "</td>";
                                    echo "<td>" . $row['orden_estado'] . "</td>";
                                    echo "<td>$" . number_format($row['orden_total'], 2) . "</td>";
                                    echo "<td>";
                                    echo "<a href='ver_orden.php?id=" . $row['orden_id'] . "' class='btn btn-sm btn-info me-1'>Ver</a>";
                                    echo "<a href='editar_orden.php?id=" . $row['orden_id'] . "' class='btn btn-sm btn-warning me-1'>Editar</a>";
                                    echo "<a href='eliminar_orden.php?id=" . $row['orden_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de eliminar esta orden?');\">Eliminar</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay órdenes de compra registradas</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
