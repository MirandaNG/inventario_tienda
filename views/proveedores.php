<?php
    include '../config/conexion.php';

    // Consulta para obtener los proveedores
    $query = "SELECT * FROM proveedores ORDER BY prov_nombre ASC";
    $result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Gestión de Proveedores</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Gestión de Proveedores</h2>

                <!-- Botón para agregar proveedor -->
                <div class="mb-3">
                    <a href="agregar_proveedor.php" class="btn btn-agregar">Agregar Proveedor</a>
                </div>

                <!-- Tabla de proveedores -->
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prov_nombre'] . "</td>";
                                    echo "<td>" . $row['prov_contacto'] . "</td>";
                                    echo "<td>" . $row['prov_telefono'] . "</td>";
                                    echo "<td>" . $row['prov_email'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='editar_proveedor.php?id=" . $row['prov_id'] . "' class='btn btn-sm btn-warning me-1'>Editar</a>";
                                    echo "<a href='eliminar_proveedor.php?id=" . $row['prov_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de eliminar este proveedor?');\">Eliminar</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay proveedores registrados</td></tr>";
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
