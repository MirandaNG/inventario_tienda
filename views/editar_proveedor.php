<?php
include '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $proveedor = $conexion->query("SELECT * FROM proveedores WHERE prov_id = '$id'")->fetch_assoc();

    if (!$proveedor) {
        header("Location: proveedores.php?error=Proveedor no encontrado");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $query = "UPDATE proveedores SET 
              prov_nombre = '$nombre', 
              prov_contacto = '$contacto', 
              prov_telefono = '$telefono', 
              prov_email = '$email' 
              WHERE prov_id = '$id'";
    if ($conexion->query($query) === TRUE) {
        header("Location: proveedores.php?success=Proveedor actualizado correctamente");
    } else {
        header("Location: proveedores.php?error=Error al actualizar proveedor");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Editar Proveedor</title>
</head>
<body>
    <div class="container">
        <h2>Editar Proveedor</h2>
        <form action="" method="POST">
            <!-- Producto (No editable) -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" class="form-control" value="<?php echo $proveedor['prov_nombre']; ?>" disabled>
                <input type="hidden" name="nombre" value="<?php echo $proveedor['prov_id']; ?>">
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Persona de Contacto</label>
                <input type="text" name="contacto" id="contacto" class="form-control" value="<?php echo $proveedor['prov_contacto']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $proveedor['prov_telefono']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $proveedor['prov_email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="proveedores.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
