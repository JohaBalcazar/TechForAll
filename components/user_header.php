<?php
if (!isset($conn)) {
   include __DIR__ . '/connect.php';
}
if (!isset($_SESSION)) session_start();

$user_id = $_SESSION['user_id'] ?? ($_SESSION['vendedor_id'] ?? ($_SESSION['admin_id'] ?? ''));
?>

<?php if(isset($message)){ foreach($message as $msg){ ?>
   <div class="message">
      <span><?= $msg; ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
<?php }} ?>

<header class="header">
   <section class="flex">

      <a href="/projectdone/home.php" class="logo">TechForAll<span>.Com</span></a>

      <nav class="navbar">
         <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'vendedor'): ?>
            <a href="/projectdone/home_vendedor.php">Inicio vendedor</a>
            <a href="/projectdone/vendedor/vendedor_panel.php">Panel</a>
            <a href="/projectdone/vendedor/mis_productos.php">Mis productos</a>
         <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <a href="/projectdone/admin/dashboard.php">Admin</a>
         <?php else: ?>
            <a href="/projectdone/home.php">Inicio</a>
            <a href="/projectdone/about.php">Acerca de</a>
            <a href="/projectdone/orders.php">Pedidos</a>
            <a href="/projectdone/shop.php">Compra ahora</a>
            <a href="/projectdone/vender.php">Vender</a>
            <a href="/projectdone/donar.php">Donar</a>
         <?php endif; ?>
      </nav>

      <div class="icons">
         <?php
         $total_wishlist_counts = 0;
         $total_cart_counts = 0;
         if ($user_id) {
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         }
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="/projectdone/search_page.php"><i class="fas fa-search"></i>Buscar</a>
         <a href="/projectdone/wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="/projectdone/cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         if ($user_id) {
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p><?= htmlspecialchars($fetch_profile["name"]); ?></p>
            <a href="/projectdone/update_user.php" class="btn">Actualizar Perfil</a>
            <a href="/projectdone/components/user_logout.php" class="delete-btn" onclick="return confirm('¿Cerrar sesión del sitio?');">Cerrar sesión</a>
         <?php
            }
         } else {
         ?>
            <p>¡Por favor, inicia sesión o regístrate!</p>
            <div class="flex-btn">
               <a href="/projectdone/user_register.php" class="option-btn">Registro</a>
               <a href="/projectdone/user_login.php" class="option-btn">Acceso</a>
            </div>
         <?php } ?>
      </div>

   </section>
</header>
