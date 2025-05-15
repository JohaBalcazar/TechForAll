<?php
session_start();
if (!isset($_SESSION['vendedor_id'])) {
    header('Location: login_vendedor.php');
    exit;
}

@include '../components/connect.php';

if (!isset($_GET['id'])) {
    header('Location: mis_productos.php');
    exit;
}

$producto_id = $_GET['id'];
$vendedor_id = $_SESSION['vendedor_id'];

// Obtener datos actuales del producto
$query = $conn->prepare("SELECT * FROM productos WHERE id = ? AND vendedor_id = ?");
$query->execute([$producto_id, $vendedor_id]);
$producto = $query->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    echo "Producto no encontrado o no tienes permisos para editarlo.";
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    // Imagen nueva opcional
    $nueva_imagen = $_FILES['imagen']['name'];
    if (!empty($nueva_imagen)) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($imagen_tmp, '../uploaded_img/' . $nueva_imagen);
    } else {
        $nueva_imagen = $producto['imagen'];
    }

    $update = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, categoria = ?, descripcion = ?, imagen = ? WHERE id = ? AND vendedor_id = ?");
    $update->execute([$nombre, $precio, $categoria, $descripcion, $nueva_imagen, $producto_id, $vendedor_id]);

    $mensaje = "Producto actualizado con éxito.";
    // Opcional: recargar datos actualizados
    $query->execute([$producto_id, $vendedor_id]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="formulario-editar">
    <h1>Editar producto</h1>

    <?php if (!empty($mensaje)): ?>
        <p class="mensaje"><?= $mensaje; ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" value="<?= $producto['nombre']; ?>" required>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio']; ?>" required>
        <input type="text" name="categoria" value="<?= $producto['categoria']; ?>" required>
        <textarea name="descripcion" required><?= $producto['descripcion']; ?></textarea>
        <p>Imagen actual: <img src="../uploaded_img/<?= $producto['imagen']; ?>" width="100"></p>
        <input type="file" name="imagen" accept="image/*">
        <input type="submit" value="Actualizar producto" class="btn">
    </form>
</section>

</body>
</html>
