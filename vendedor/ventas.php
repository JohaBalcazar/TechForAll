<?php
session_start();

// Asegurarse que el vendedor esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_vendedor.php");
    exit();
}

include '../components/connect.php';
$vendedor_id = $_SESSION['user_id'];

// Obtener la fecha actual
$fecha_inicio_mes = date('Y-m-01'); // Primer día del mes
$fecha_hoy = date('Y-m-d'); // Hoy

// Consultar las ventas del mes actual para este vendedor
$sql = "
    SELECT 
        SUM(oi.price * oi.quantity) AS total_ventas,
        COUNT(DISTINCT o.id) AS total_pedidos
    FROM order_items oi
    INNER JOIN products p ON oi.product_id = p.id
    INNER JOIN orders o ON oi.order_id = o.id
    WHERE p.vendedor_id = ?
      AND o.placed_on BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);
$stmt->execute([$vendedor_id, $fecha_inicio_mes, $fecha_hoy]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$total_ventas = $resultado['total_ventas'] ?? 0;
$total_pedidos = $resultado['total_pedidos'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas del Mes</title>
     <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include '../components/vendedor_header.php'; ?>

    <div class="contenedor">
        <h2>Ventas del Mes</h2>

        <p><strong>Total de pedidos:</strong> <?= $total_pedidos ?></p>
        <p><strong>Total vendido:</strong> $<?= number_format($total_ventas, 2) ?></p>
    </div>
</body>
</html>
