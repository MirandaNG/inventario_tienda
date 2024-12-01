<?php
    include '../config/conexion.php'; 

    // Consulta para obtener las salidas
    $query = "
    SELECT salidas.sal_id, productos.prod_nombre, salidas.sal_cantidad, salidas.sal_fecha, salidas.sal_motivo
    FROM salidas
    JOIN productos ON salidas.prod_id = productos.prod_id
    ORDER BY salidas.sal_fecha ASC
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
    <title>Salidas</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Gestión de Salidas</h2>

                <!-- Botón para agregar salida -->
                <div class="mb-3">
                    <a href="agregar_salida.php" class="btn btn-agregar">Agregar Salida</a>
                </div>

                <!-- Tabla de salidas -->
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Motivo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prod_nombre'] . "</td>";
                                    echo "<td>" . $row['sal_cantidad'] . "</td>";
                                    echo "<td>" . $row['sal_fecha'] . "</td>";
                                    echo "<td>" . $row['sal_motivo'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='editar_salida.php?id=" . $row['sal_id'] . "' class='btn btn-sm btn-warning me-1'>Editar</a>";
                                    echo "<a href='eliminar_salida.php?id=" . $row['sal_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de eliminar esta salida?');\">Eliminar</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay salidas registradas</td></tr>";
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
