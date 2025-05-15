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
    <title>Tips de Venta - TechForAll</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="contenedor">
    <h1>Tips de ventas efectivas</h1>
    <ul>
        <li>📸 Usa fotos reales y de buena calidad.</li>
        <li>📝 Describe claramente el estado y características del producto.</li>
        <li>💰 Coloca precios competitivos.</li>
        <li>🕐 Responde rápido a consultas.</li>
        <li>⭐ Consigue buenas valoraciones cumpliendo con los envíos.</li>
    </ul>
</section>

</body>
</html>
