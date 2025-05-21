<?php
include '../components/connect.php';

session_start();

// Verificar sesión del vendedor
if (!isset($_SESSION['vendedor_id'])) {
    header('location:login_vendedor.php');
    exit;
}

$vendedor_id = $_SESSION['vendedor_id'];

// Consultar pedidos que contengan productos de este vendedor
$select_pedidos = $conn->prepare("
    SELECT 
        oi.id AS item_id,
        o.id AS order_id,
        o.placed_on,
        o.payment_status,
        u.name AS cliente,
        p.name AS product_name,
        oi.quantity,
        oi.price
    FROM order_items oi
    JOIN orders o ON oi.order_id = o.id
    JOIN products p ON oi.product_id = p.id
    JOIN users u ON o.user_id = u.id
    WHERE p.vendedor_id = ?
    ORDER BY o.placed_on DESC
");
$select_pedidos->execute([$vendedor_id]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos | TechForAll</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .pedidos-container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        .pedido {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .pedido h3 {
            margin: 0 0 10px;
        }

        .pedido span {
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<?php include  '../vendedor/vendedor_header.php'; ?> 

<div class="pedidos-container">
    <h2>Mis Pedidos</h2>

    <?php if ($select_pedidos->rowCount() > 0): ?>
        <?php while ($pedido = $select_pedidos->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="pedido">
                <h3>Pedido #<?= $pedido['order_id']; ?></h3>
                <span><strong>Producto:</strong> <?= $pedido['product_name']; ?></span>
                <span><strong>Cantidad:</strong> <?= $pedido['quantity']; ?></span>
                <span><strong>Precio unitario:</strong> $<?= $pedido['price']; ?></span>
                <span><strong>Cliente:</strong> <?= $pedido['cliente']; ?></span>
                <span><strong>Fecha:</strong> <?= $pedido['placed_on']; ?></span>
                <span><strong>Estado de pago:</strong> <?= $pedido['payment_status']; ?></span>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tienes pedidos aún.</p>
    <?php endif; ?>
</div>

</body>
</html>
