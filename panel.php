<?php
    include '../config/conexion.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Sistema Web de Inventarios</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- BARRA LATERAL -->
            <div class="col-md-2 sidebar p-3">
                <h3>MENU</h3>
                <ul class="list-group list-group-flush">
                    <a href="panel.php" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="entradas.php" class="list-group-item list-group-item-action">Entradas</a>
                    <a href="salidas.php" class="list-group-item list-group-item-action">Salidas</a>
                    <a href="productos.php" class="list-group-item list-group-item-action">Productos</a>
                    <a href="proveedores.php" class="list-group-item list-group-item-action">Proveedores</a>
                    <a href="ordenes.php" class="list-group-item list-group-item-action">Órdenes de Compra</a>
                </ul>
            </div>
            <!-- CONTENIDO PRINCIPAL -->
            <div class="col-md-9">
                <div class="container mt-4">
                    <h1>Inventario</h1>
                    <p>Bienvenido al sistema de administración de inventarios.</p>

                    <!-- Tarjetas del Dashboard -->
                    <div class="row">
                        <!-- Card para Entradas -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-entradas">
                                <a href="entradas.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="assets\images\entradas.png" alt="Entradas" class="me-3">
                                    <span class="h5">Entradas</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Salidas -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-salidas">
                                <a href="salidas.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="assets\images\salidas.png" alt="Salidas" class="me-3">
                                    <span class="h5">Salidas</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Productos -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-productos">
                                <a href="productos.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="assets\images\products.png" alt="Productos" class="me-3">
                                    <span class="h5">Productos</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card para Proveedores -->
                        <div class="col-sm-3 mb-3">
                            <div class="card shadow border-0 card-proveedores">
                                <a href="proveedores.php" class="card-body d-flex align-items-center justify-content-start text-decoration-none">
                                    <img src="assets\images\proveedores.png" alt="Proveedores" class="me-3">
                                    <span class="h5">Proveedores</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>