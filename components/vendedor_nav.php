<?php
if (!isset($conn)) {
   include __DIR__ . '/connect.php';
}
if (!isset($_SESSION)) session_start();

$vendedor_id = $_SESSION['vendedor_id'] ?? '';
?>

<header class="header">

   <section class="flex">

      <a href="/projectdone/vendedor/home.php" class="logo">TechForAll<span>.Com</span></a>

      <nav class="navbar">
         <a href="/projectdone/vendedor/home.php">Inicio vendedor</a>
         <a href="/projectdone/vendedor/como_vender.php">¿Cómo vender?</a>
         <a href="/projectdone/vendedor/tips.php">Tips de ventas</a>
         <a href="/projectdone/vendedor/soporte.php">Soporte</a>
         <a href="/projectdone/vendedor/vendedor_panel.php">Panel</a>
         <a href="/projectdone/components/user_logout.php" onclick="return confirm('¿Cerrar sesión?');">Cerrar sesión</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="/projectdone/search_page.php"><i class="fas fa-search"></i></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         if ($vendedor_id) {
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$vendedor_id]);
            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p><?= htmlspecialchars($fetch_profile['name']); ?></p>
            <a href="/projectdone/update_user.php" class="btn">Actualizar Perfil</a>
            <a href="/projectdone/components/user_logout.php" class="delete-btn" onclick="return confirm('¿Cerrar sesión del sitio?');">Cerrar sesión</a>
         <?php
            }
         } else {
         ?>
            <p>¡Por favor, inicia sesión!</p>
            <div class="flex-btn">
               <a href="/projectdone/login_vendedor.php" class="option-btn">Acceder</a>
            </div>
         <?php } ?>
      </div>

   </section>

</header>

<style>
.header {
   background-color: #333;
   padding: 15px 20px;
   color: white;
}

.header .flex {
   display: flex;
   justify-content: space-between;
   align-items: center;
   flex-wrap: wrap;
}

.header .logo {
   font-size: 2rem;
   font-weight: bold;
   color: #fff;
   text-decoration: none;
}

.header .navbar a {
   margin-left: 15px;
   color: #fff;
   text-decoration: none;
   font-weight: bold;
}

.header .navbar a:hover {
   color: #0d6efd;
}

.header .icons {
   display: flex;
   align-items: center;
}

.header .icons a,
.header .icons div {
   margin-left: 10px;
   font-size: 1.2rem;
   color: white;
   cursor: pointer;
}

.profile {
   margin-top: 10px;
   color: white;
}

.profile .btn,
.profile .option-btn,
.profile .delete-btn {
   margin: 5px 0;
   display: inline-block;
   background: #0d6efd;
   color: white;
   padding: 0.5rem 1rem;
   text-decoration: none;
   border-radius: 5px;
}

.profile .delete-btn {
   background: #e74c3c;
}
</style>
