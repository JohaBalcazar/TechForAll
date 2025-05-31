<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_vendedor.php");
    exit();
}

include '../components/connect.php';
$vendedor_id = $_SESSION['user_id'];

$fecha_inicio_mes = date('Y-m-01');
$fecha_hoy = date('Y-m-d');

// Totales
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

// Detalles
$detalle_stmt = $conn->prepare("
    SELECT p.name AS producto, oi.quantity, oi.price, (oi.quantity * oi.price) AS total, o.placed_on
    FROM order_items oi
    INNER JOIN products p ON oi.product_id = p.id
    INNER JOIN orders o ON oi.order_id = o.id
    WHERE p.vendedor_id = ? AND o.placed_on BETWEEN ? AND ?
    ORDER BY o.placed_on DESC
");
$detalle_stmt->execute([$vendedor_id, $fecha_inicio_mes, $fecha_hoy]);
$ventas = $detalle_stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <style>
        body {
            background-color: #0b0b13;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .contenedor {
            max-width: 1200px;
            margin: auto;
            padding: 4rem 2rem;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #a26bff;
        }

        .resumen {
            text-align: center;
            font-size: 1.4rem;
            margin-bottom: 3rem;
            color: #ccc;
        }

        .ventas-tabla {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        .ventas-tabla th, .ventas-tabla td {
            padding: 1rem;
            text-align: center;
        }

        .ventas-tabla th {
            background-color: #1a1a2e;
            color: #ffb347;
        }

        .ventas-tabla td {
            background-color: rgba(255, 255, 255, 0.05);
            color: #eee;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .ventas-tabla tr:last-child td {
            border-bottom: none;
        }

        .ventas-tabla td span {
            font-weight: bold;
        }

        .empty-message {
            text-align: center;
            font-size: 1.3rem;
            margin-top: 2rem;
            color: #999;
        }
    </style>
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<div class="contenedor">
    <h2>📈 Ventas del Mes</h2>

    <div class="resumen">
        <p><strong>Total de pedidos:</strong> <?= $total_pedidos ?></p>
        <p><strong>Total vendido:</strong> Gs. <?= number_format($total_ventas, 0, ',', '.') ?></p>
    </div>

    <?php if (!empty($ventas)): ?>
        <table class="ventas-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= htmlspecialchars($venta['producto']) ?></td>
                        <td><?= (int)$venta['quantity'] ?></td>
                        <td>Gs. <?= number_format($venta['price'], 0, ',', '.') ?></td>
                        <td><span>Gs. <?= number_format($venta['total'], 0, ',', '.') ?></span></td>
                        <td><?= $venta['placed_on'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty-message">No se han registrado ventas este mes.</p>
    <?php endif; ?>
</div>

</body>
</html>
