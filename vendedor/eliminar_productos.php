<?php
session_start();
@include '../components/connect.php';

// Verificar si el vendedor está logueado
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: login_vendedor.php");
    exit;
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $vendedor_id = $_SESSION['vendedor_id'];

    // Verificar si el producto pertenece al vendedor
    $query = $conn->prepare("SELECT * FROM productos WHERE id = ? AND vendedor_id = ?");
    $query->execute([$producto_id, $vendedor_id]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        // Eliminar el producto
        $delete_query = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $delete_query->execute([$producto_id]);

        // Redirigir al panel del vendedor con un mensaje de éxito
        header("Location: mis_productos.php?mensaje=Producto eliminado exitosamente");
        exit;
    } else {
        // Si el producto no pertenece al vendedor, mostrar un error
        header("Location: mis_productos.php?error=Producto no encontrado o no autorizado");
        exit;
    }
} else {
    // Si no se pasa el ID del producto, redirigir al panel del vendedor
    header("Location: mis_productos.php");
    exit;
}
