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
    $query = $conn->prepare("SELECT * FROM products WHERE id = ? AND vendedor_id = ?");
    $query->execute([$producto_id, $vendedor_id]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        // Eliminar imágenes asociadas (opcional)
        if (!empty($producto['image_01'])) {
            $ruta = '../uploaded_img/' . $producto['image_01'];
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }

        // Eliminar el producto
        $delete_query = $conn->prepare("DELETE FROM products WHERE id = ?");
        $delete_query->execute([$producto_id]);

        // Redirigir con mensaje de éxito
        header("Location: mis_productos.php?mensaje=Producto eliminado exitosamente");
        exit;
    } else {
        // Producto no pertenece al vendedor
        header("Location: mis_productos.php?error=Producto no encontrado o no autorizado");
        exit;
    }
} else {
    // Si no se pasa el ID
    header("Location: mis_productos.php");
    exit;
}
