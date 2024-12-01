<?php
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prod_nombre = $_POST['prod_nombre'];
    $prod_categoria = $_POST['prod_categoria'];
    $prod_talla = $_POST['prod_talla'];
    $prod_color = $_POST['prod_color'];
    $prod_temporada = $_POST['prod_temporada'];
    $prod_precio = $_POST['prod_precio'];
    $prod_stock = $_POST['prod_stock'];

    $query = "INSERT INTO productos (prod_nombre, prod_categoria, prod_talla, prod_color, prod_temporada, prod_precio, prod_stock) 
              VALUES ('$prod_nombre', '$prod_categoria', '$prod_talla', '$prod_color', '$prod_temporada', '$prod_precio', '$prod_stock')";
    if ($conexion->query($query)) {
        header('Location: productos.php');
    } else {
        echo "Error al agregar producto: " . $conexion->error;
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
    <title>Agregar Producto</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <?php include 'sidebar.php'; ?>
            
            <!-- Contenido principal -->
            <div class="col-md-7 main-content">
                <h2>Agregar Producto</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="prod_nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="prod_nombre" name="prod_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_categoria" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="prod_categoria" name="prod_categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_talla" class="form-label">Talla</label>
                        <input type="text" class="form-control" id="prod_talla" name="prod_talla" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="prod_color" name="prod_color" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_temporada" class="form-label">Temporada</label>
                        <input type="text" class="form-control" id="prod_temporada" name="prod_temporada" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="prod_precio" name="prod_precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="prod_stock" class="form-label">Stock Inicial</label>
                        <input type="number" class="form-control" id="prod_stock" name="prod_stock" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a href="productos.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
