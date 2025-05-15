
<?php
if (!isset($_SESSION)) session_start();
?>

<header class="header">
  <section class="flex">
    <a href="../vendedor/home.php" class="logo">TechForAll<span>.Com</span></a>
    <nav class="navbar">
      <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'vendedor'): ?>
        <a href="../vendedor/vendedor_panel.php">Panel Vendedor</a>
        <a href="../vendedor/mis_productos.php">Mis Productos</a>
      <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <a href="../admin/dashboard.php">Dashboard</a>
      <?php else: ?>
        <a href="home.php">Inicio</a>
        <a href="shop.php">Tienda</a>
        <a href="wishlist.php">Favoritos</a>
        <a href="cart.php">Carrito</a>
      <?php endif; ?>
      <a href="logout.php">Cerrar sesión</a>
    </nav>
  </section>
</header>