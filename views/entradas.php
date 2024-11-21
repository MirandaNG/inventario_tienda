<?php
    include '../config/conexion.php'; 

    // Consulta para obtener las entradas
    $query = "
    SELECT entradas.entra_id, productos.prod_nombre, entradas.entra_cantidad, entradas.entra_fecha 
    FROM entradas
    JOIN productos ON entradas.prod_id = productos.prod_id
    ORDER BY entradas.entra_fecha ASC
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
    <title>Entradas</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Gestión de Entradas</h2>

                <!-- Botón para agregar entrada -->
                <div class="mb-3">
                    <a href="agregar_entrada.php" class="btn btn-primary">Agregar Entrada</a>
                </div>

                <!-- Tabla de entradas -->
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prod_nombre'] . "</td>";
                                    echo "<td>" . $row['entra_cantidad'] . "</td>";
                                    echo "<td>" . $row['entra_fecha'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='editar_entrada.php?id=" . $row['entra_id'] . "' class='btn btn-sm btn-warning me-1'>Editar</a>";
                                    echo "<a href='eliminar_entrada.php?id=" . $row['entra_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de eliminar esta entrada?');\">Eliminar</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay entradas registradas</td></tr>";
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
