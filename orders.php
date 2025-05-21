<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pedidos</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Estilos globales -->
   <link rel="stylesheet" href="css/style.css">
<style> 
:root {
   --lila: rgb(135, 68, 223);
   --gris-claro: #f5f5f7;
   --blanco: #ffffff;
   --negro: #111111;
   --sombra: rgba(0, 0, 0, 0.08);
}

body {
   background-color: var(--gris-claro) !important;
   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
   color: var(--negro) !important;
}

.orders {
   padding: 3rem 2rem !important;
   max-width: 1200px !important;
   margin: auto !important;
}

.heading {
   text-align: center !important;
   font-size: 2.8rem !important;
   color: var(--lila) !important;
   margin-bottom: 3rem !important;
   font-weight: 700 !important;
}

.box-container {
   display: grid !important;
   grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
   gap: 2rem !important;
}



.box:hover {
   transform: translateY(-5px) !important;
   box-shadow: 0 12px 24px var(--sombra) !important;
}

.box p {
   margin: 0.8rem 0 !important;
   font-size: 1.1rem !important;
   line-height: 1.6 !important;
}

.box p strong {
   color: var(--lila) !important;
   display: block !important;
   font-weight: 600 !important;
   margin-bottom: 0.2rem !important;
}

.box p span {
   color: var(--negro) !important;
   font-weight: 500 !important;
}

.estado {
   display: inline-block !important;
   padding: 0.4rem 1rem !important;
   border-radius: 5px !important;
   font-weight: bold !important;
   text-transform: capitalize !important;
   font-size: 1rem !important;
   margin-top: 0.5rem !important;
}

.pendiente {
   background-color:rgb(255, 9, 9) !important;
   color: #c00 !important;
}

.completado {
   background-color:rgb(120, 255, 30) !important;
   color: #080 !important;
}

.empty {
   text-align: center !important;
   font-size: 1.3rem !important;
   color: #666 !important;
   margin-top: 3rem !important;
}
</style>


</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Pedidos realizados</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Por favor inicia sesión para ver tus pedidos.</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p><strong>Fecha:</strong> <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p><strong>Nombre:</strong> <span><?= $fetch_orders['name']; ?></span></p>
      <p><strong>Correo:</strong> <span><?= $fetch_orders['email']; ?></span></p>
      <p><strong>Teléfono:</strong> <span><?= $fetch_orders['number']; ?></span></p>
      <p><strong>Dirección:</strong> <span><?= $fetch_orders['address']; ?></span></p>
      <p><strong>Método de pago:</strong> <span><?= $fetch_orders['method']; ?></span></p>
      <p><strong>Productos:</strong> <span><?= $fetch_orders['total_products']; ?></span></p>
      <p><strong>Total:</strong> <span>Gs. <?= $fetch_orders['total_price']; ?></span></p>
      <p><strong>Estado de pago:</strong> 
         <span class="estado <?= $fetch_orders['payment_status'] == 'pendiente' ? 'pendiente' : 'completado' ?>">
            <?= $fetch_orders['payment_status']; ?>
         </span>
      </p>
   </div>
   <?php
            }
         }else{
            echo '<p class="empty">¡Aún no hay pedidos realizados!</p>';
         }
      }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>
