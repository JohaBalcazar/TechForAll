<?php
session_start();
@include '../components/connect.php';

// Verificar si el vendedor está logueado
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: login_vendedor.php");
    exit;
}

$vendedor_id = $_SESSION['vendedor_id'];

// Obtener los productos del vendedor
$query = $conn->prepare("SELECT * FROM products  WHERE vendedor_id = ?");
$query->execute([$vendedor_id]);
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Productos</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
</head>

<?php if (isset($_GET['mensaje'])): ?>
    <div class="mensaje-exito"><?= htmlspecialchars($_GET['mensaje']); ?></div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="mensaje-error"><?= htmlspecialchars($_GET['error']); ?></div>
<?php endif; ?>


<body>

<?php include 'vendedor_header.php'; ?>

<section class="productos-lista">
    <h1>Mis Productos</h1>

    <?php if (count($productos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre']); ?></td>
                        <td><?= htmlspecialchars($producto['precio']); ?> Gs</td>
                        <td>
                            <a href="editar_productos.php?id=<?= $producto['id']; ?>">Editar</a>
                            <a href="eliminar_producto.php?id=<?= $producto['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tienes productos añadidos aún.</p>
    <?php endif; ?>
</section>

</body>
</html>
