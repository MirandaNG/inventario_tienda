<?php
    include '../config/conexion.php'; 
    
    // Consulta para el producto con mínimo stock
    $query_min_stock = "SELECT prod_nombre, prod_stock FROM productos ORDER BY prod_stock ASC LIMIT 1";
    $result_min_stock = $conexion->query($query_min_stock);
    $min_stock = $result_min_stock->fetch_assoc();

    // Consulta para el producto con máximo stock
    $query_max_stock = "SELECT prod_nombre, prod_stock FROM productos ORDER BY prod_stock DESC LIMIT 1";
    $result_max_stock = $conexion->query($query_max_stock);
    $max_stock = $result_max_stock->fetch_assoc();

    // Consulta para obtener la cantidad de productos por temporada
    $query = "SELECT prod_temporada, COUNT(*) AS cantidad FROM productos GROUP BY prod_temporada";
    $result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Sistema Web de Inventarios</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- BARRA LATERAL -->
            <?php include 'sidebar.php'; ?>
            
            <!-- CONTENIDO PRINCIPAL -->
            <div class="col-md-9 main-content">
                <div class="container mt-4">
                    <h1>Inventario</h1>
                    <p>Bienvenido al sistema de administración de inventarios.</p>

                    <!-- Tarjetas del Dashboard -->
                    <div class="row">
                        <!-- Card para Entradas -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-entradas">
                                <a href="entradas.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="..\assets\images\entradas.png" alt="Entradas" class="me-3 img-fluid" width="40">
                                    <span class="h5">Entradas</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Salidas -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-salidas">
                                <a href="salidas.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="..\assets\images\salidas.png" alt="Salidas" class="me-3 img-fluid" width="40">
                                    <span class="h5">Salidas</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Productos -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-productos">
                                <a href="productos.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="..\assets\images\products.png" alt="Productos" class="me-3 img-fluid" width="40">
                                    <span class="h5">Productos</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Proveedores -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-proveedores">
                                <a href="proveedores.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="..\assets\images\proveedores.png" alt="Proveedores" class="me-3 img-fluid" width="40"">
                                    <span class="h5">Proveedores</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="inventory-summary position-fixed p-3 shadow rounded">
                <h5 class="text-center mb-3">Resumen de Inventario</h5>

                <div class="d-flex justify-content-between">
                    <!-- Sección: Productos con stock mínimo/máximo -->
                    <div class="me-3">
                        <!-- Producto con stock mínimo -->
                        <div class="mb-3">
                            <strong>Stock Mínimo:</strong>
                            <div class="d-flex align-items-center mt-1">
                                <div class="alert-icon bg-danger me-2"></div>
                                <span><?php echo isset($min_stock) ? $min_stock['prod_nombre'] . " (" . $min_stock['prod_stock'] . ")" : "No disponible"; ?></span>
                            </div>
                        </div>

                        <!-- Producto con stock máximo -->
                        <div class="mb-3">
                            <strong>Stock Máximo:</strong>
                            <div class="d-flex align-items-center mt-1">
                                <div class="alert-icon bg-warning me-2"></div>
                                <span><?php echo isset($max_stock) ? $max_stock['prod_nombre'] . " (" . $max_stock['prod_stock'] . ")" : "No disponible"; ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Productos por temporada -->
                    <div>
                        <strong>Productos por Temporada:</strong>
                        <ul class="list-group mt-2">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li class='list-group-item text-light'>";
                                    echo "<strong>" . $row['prod_temporada'] . "</strong>: " . $row['cantidad'] . " productos";
                                    echo "</li>";
                                }
                            } else {
                                echo "<li class='list-group-item text-light'>No hay productos registrados por temporada.</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>