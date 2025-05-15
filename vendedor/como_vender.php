<?php
session_start();
if (!isset($_SESSION['vendedor_id']) || $_SESSION['rol'] !== 'vendedor') {
    header('Location: login_vendedor.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Cómo vender? - TechForAll</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="contenedor">
    <h1>¿Cómo vender en TechForAll?</h1>
    <p>Publica productos desde tu panel, añade fotos, detalles, precios y activa la visibilidad para compradores.</p>
    <ul>
        <li>Ve a tu <strong>panel de vendedor</strong>.</li>
        <li>Haz clic en “Agregar producto”.</li>
        <li>Completa los campos requeridos.</li>
        <li>Guarda y revisa en tu lista.</li>
    </ul>
    <a href="vendedor_panel.php" class="btn">Ir al Panel</a>
</section>

</body>
</html>
