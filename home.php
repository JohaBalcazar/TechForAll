<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'components/connect.php';

$user_id = $_SESSION['user_id'] ?? '';
include 'components/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechForAll</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- HERO PRINCIPAL -->
<section class="hero-techforall">
  <div class="hero-container">
    <div class="hero-texto">
      <h1><span class="highlight">TechForAll: </span>Conectando personas con TECNOLOGÍA </h1>
      <p>Comprá, vendé o doná dispositivos tecnológicos reacondicionados y sé parte de una comunidad comprometida con la sustentabilidad y la inclusión digital. Juntos transformamos vidas, ofreciendo acceso responsable a la tecnología para quienes más lo necesitan, generando un impacto social positivo y reduciendo el desperdicio electrónico</p>
      <div class="hero-botones">
        <a href="shop.php" class="btn-hero primary">Comprar</a>
        <a href="vender.php" class="btn-hero secondary">Vender</a>
      </div>
    </div>
    <div class="hero-imagen">
      <img src="images/hmm1.png" alt="TechForAll Ilustración">
    </div>
  </div>
</section>

<!-- CARRUSEL DE PRODUCTOS -->
<section class="home-products">
   <h1 class="heading">Últimos productos</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id DESC LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <form action="" method="post" class="swiper-slide slide">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
         <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="flex">
            <div class="price">GS.<?= $fetch_product['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1">
         </div>
         <input type="submit" value="Agregar al Carrito" class="btn" name="add_to_cart">
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">¡Aún no se han añadido productos!</p>';
         }
      ?>

      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>

<!-- CATEGORÍAS -->
<section class="categoria-modern">
  <h2 class="section-title">Categorías de productos</h2>
  <div class="categoria-grid">
    <div class="card">
      <img src="images/icon-1.png" alt="Notebook" />
      <h3>Notebook</h3>
    </div>
    <div class="card">
      <img src="images/icon-2.png" alt="Monitores" />
      <h3>Monitores</h3>
    </div>
    <div class="card">
      <img src="images/icon-3.png" alt="Teclados" />
      <h3>Teclados</h3>
    </div>
    <div class="card">
      <img src="images/icon-4.png" alt="Mouse" />
      <h3>Mouse</h3>
    </div>
    <div class="card">
      <img src="images/icon-5.png" alt="PC" />
      <h3>PC</h3>
    </div>
  </div>
</section>
<!-- SECCIÓN DE REACONDICIONAMIENTO -->
<section class="reacondicionamiento-section" style="padding: 4rem 2rem; background: rgba(255, 255, 255, 0.03); text-align: left;">
  <div style="max-width: 1200px; margin: auto; display: flex; align-items: center; flex-wrap: wrap; gap: 3rem;">

    <div style="flex: 1 1 500px;">
      <h2 style="font-size: 3.2rem; color: rgb(132, 71, 254); margin-bottom: 1rem;">
        SOPORTE Y <br> REACONDICIONAMIENTO </br>
      </h2>
      <p style="max-width: 800px; font-size: 1.7rem; color: #ffffff;">
        En <strong>TechForAll</strong> reacondicionamos tecnología para darle una segunda vida. Nuestro equipo técnico se encarga de revisar, reparar y optimizar equipos para que vuelvan a funcionar como nuevos. 
        <br><br>Ayudanos a reducir el desperdicio electrónico y llevar la tecnología a más personas.
      </p>

      <div style="margin-top: 2.5rem; display: flex; gap: 2rem; flex-wrap: wrap;">
        <div style="flex: 1 1 180px; background: rgba(201, 220, 242, 0.8); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.3); color: rgba(36, 34, 34, 0.79);">
          <i class="fas fa-tools" style="font-size: 2.2rem; color: rgb(113, 13, 253);"></i>
          <h3 style="margin-top: 0.8rem; font-size: 1.2rem;">Revisión técnica</h3>
        </div>
        <div style="flex: 1 1 180px; background: rgba(201, 220, 242, 0.8); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.3); color: rgba(36, 34, 34, 0.79)">
          <i class="fas fa-recycle" style="font-size: 2.2rem; color: rgb(167, 110, 40);"></i>
          <h3 style="margin-top: 0.8rem; font-size: 1.2rem;">Reacondicionamiento</h3>
        </div>
        <div style="flex: 1 1 180px; background: rgba(201, 220, 242, 0.8); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.3); color: rgba(36, 34, 34, 0.79)">
          <i class="fas fa-hand-holding-heart" style="font-size: 2.2rem; color: rgb(87, 62, 232);"></i>
          <h3 style="margin-top: 0.8rem; font-size: 1.2rem;">Impacto social</h3>
        </div>
      </div>

      <a href="reacondicionamiento.php" class="btn-hero primary" style="margin-top: 2.5rem; padding: 0.8rem 2rem; font-size: 1.2rem; background-color:rgba(181, 113, 241, 0.82); color: white; border-radius: 0.5rem; display: inline-block;">
        Ver más 
      </a>
    </div>

   
    <div style="flex: 1 1 400px; text-align: center;">
      <img src="images/ast.png" alt="Reacondicionamiento TechForAll" style="max-width: 100%; border-radius: 1rem; box-shadow: 0 0 20px rgba(0,0,0,0.4);">
    </div>
    
  </div>
</section>



<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
});
new Swiper(".category-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   breakpoints: {
      0: { slidesPerView: 2 },
      650: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      1024: { slidesPerView: 5 },
   }
});
new Swiper(".products-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   breakpoints: {
      550: { slidesPerView: 2 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
   }
});
</script>

</body>
</html>




