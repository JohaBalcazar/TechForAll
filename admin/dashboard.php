<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
}

$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard Admin - TechForAll</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">

   <style>
      body {
         background: #0b0b13;
         font-family: 'Poppins', sans-serif;
         color: white;
      }

      .dashboard {
         padding: 3rem 2rem;
         max-width: 1200px;
         margin: auto;
      }

      .heading {
         text-align: center;
         font-size: 2.5rem;
         color: #a26bff;
         margin-bottom: 3rem;
      }

      .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 2rem;
      }

      .box {
         background: rgba(255, 255, 255, 0.05);
         padding: 2rem;
         border-radius: 1rem;
         border: 1px solid rgba(255, 255, 255, 0.1);
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s ease;
         text-align: center;
      }

      .box:hover {
         transform: translateY(-5px);
         box-shadow: 0 8px 30px rgba(162, 107, 255, 0.2);
      }

      .box h3 {
         font-size: 2rem;
         color: #ffb347;
         margin-bottom: 0.5rem;
      }

      .box p {
         color: #ccc;
         font-size: 1.3rem;
         margin-bottom: 1rem;
      }

      .btn {
         background: #a26bff;
         color: white;
         padding: 0.7rem 1.5rem;
         border-radius: 5px;
         text-decoration: none;
         font-weight: bold;
         display: inline-block;
         transition: background 0.3s ease;
      }

      .btn:hover {
         background: #6c63ff;
      }

      .section-titulo {
         text-align: center;
         font-size: 2rem;
         margin: 4rem 0 2rem;
         color: #ffb347;
      }

      .registro-card {
         background: rgba(255, 255, 255, 0.05);
         border: 1px solid rgba(255, 255, 255, 0.1);
         margin: 1rem auto;
         padding: 1.5rem;
         border-radius: 1rem;
         max-width: 800px;
         box-shadow: 0 0 15px rgba(0,0,0,0.3);
         color: white;
      }

      .registro-card h3 {
         margin: 0;
         color: #4CAF50;
         font-size: 1.5rem;
      }

      .registro-card p {
         color: #ccc;
         margin: 0.5rem 0;
      }

   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">
   <h1 class="heading">📊 Panel de Control</h1>

   <div class="box-container">
      <div class="box">
         <h3>Bienvenido</h3>
         <p><?= htmlspecialchars($fetch_profile['name']); ?></p>
         <a href="update_profile.php" class="btn">Actualizar Perfil</a>
      </div>

      <div class="box">
         <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
            $total_pendings += $fetch_pendings['total_price'];
         }
         ?>
         <h3>Gs. <?= number_format($total_pendings, 0, ',', '.') ?></h3>
         <p>Pagos pendientes</p>
         <a href="placed_orders.php" class="btn">Ver Pedidos</a>
      </div>

      <div class="box">
         <?php
         $select_post = $conn->prepare("SELECT COUNT(*) FROM `postulaciones`");
         $select_post->execute();
         $total_postulaciones = $select_post->fetchColumn();
         ?>
         <h3><?= $total_postulaciones ?></h3>
         <p>Postulaciones recibidas</p>
         <a href="postulaciones.php" class="btn">Ver postulaciones</a>
      </div>

      <div class="box">
         <?php
         $select_donaciones = $conn->prepare("SELECT COUNT(*) FROM `donaciones`");
         $select_donaciones->execute();
         $total_donaciones = $select_donaciones->fetchColumn();
         ?>
         <h3><?= $total_donaciones ?></h3>
         <p>Donaciones</p>
         <a href="donaciones.php" class="btn">Ver donaciones</a>
      </div>

      <div class="box">
         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Pedidos realizados</p>
         <a href="placed_orders.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Productos publicados</p>
         <a href="products.php" class="btn">Ver productos</a>
      </div>

      <div class="box">
         <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $number_of_users = $select_users->rowCount();
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Usuarios registrados</p>
         <a href="users_accounts.php" class="btn">Ver usuarios</a>
      </div>

      <div class="box">
         <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Mensajes nuevos</p>
         <a href="messages.php" class="btn">Ver mensajes</a>
      </div>
   </div>
</section>

</body>
</html>
