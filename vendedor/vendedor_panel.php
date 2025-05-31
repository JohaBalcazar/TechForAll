
<?php
include '../components/connect.php';
session_start();

$vendedor_id = $_SESSION['vendedor_id'] ?? null;

if (!$vendedor_id || $_SESSION['rol'] !== 'vendedor') {
    header('Location: ../login_vendedor.php');
    exit;
}

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$vendedor_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Ventas del mes actual
$total_mes = 0;
$ventas_mes = $conn->prepare("SELECT total_price FROM `orders` WHERE user_id IN (SELECT user_id FROM products WHERE vendedor_id = ?) AND MONTH(placed_on) = MONTH(CURRENT_DATE())");
$ventas_mes->execute([$vendedor_id]);
while ($venta = $ventas_mes->fetch(PDO::FETCH_ASSOC)) {
   $total_mes += $venta['total_price'];
}

// Total productos del vendedor
$select_products = $conn->prepare("SELECT COUNT(*) FROM `products` WHERE vendedor_id = ?");
$select_products->execute([$vendedor_id]);
$total_products = $select_products->fetchColumn();

// Total pedidos recibidos (de sus productos)
$select_pedidos = $conn->prepare("SELECT COUNT(*) FROM `orders` WHERE total_products LIKE CONCAT('%vendedor_id:', ?, '%')");
$select_pedidos->execute([$vendedor_id]);
$total_pedidos = $select_pedidos->fetchColumn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vendedor Panel</title>
   <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="dashboard">
   <h1 class="heading">Dashboard Vendedor</h1>

   <div class="box-container">
      <div class="box">
         <h3>Bienvenido/a</h3>
         <p><?= htmlspecialchars($fetch_profile['name']); ?></p>
         <a href="perfil_vendedor.php" class="btn">Actualizar Perfil</a>
      </div>

      <div class="box">
         <h3><?= $total_products; ?></h3>
         <p>Productos publicados</p>
         <a href="mis_productos.php" class="btn">Ver productos</a>
      </div>

      <div class="box">
         <h3><?= $total_pedidos; ?></h3>
         <p>Pedidos recibidos</p>
         <a href="pedidos.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
         <h3>Gs. <?= $total_mes; ?></h3>
         <p>Ventas este mes</p>
         <a href="ventas.php" class="btn">Ver ventas</a>

      </div>

      <div class="box">
         <p>¿Quieres agregar productos?</p>
         <a href="agregar_productos.php" class="btn">Agregar producto</a>

      </div>
   </div>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>