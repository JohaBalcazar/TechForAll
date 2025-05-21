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
<section class="hero-techforall">
  <div class="hero-container">
    <div class="hero-texto">
      <h1><span class="highlight">TechForAll</span>: TECNOLOGÍA AL ALCANCE DE TODOS</h1>
      <p>Comprá, vendé o doná dispositivos tecnológicos reacondicionados y sé parte de una comunidad comprometida con la sustentabilidad y la inclusión digital. Juntos transformamos vidas, ofreciendo acceso responsable a la tecnología para quienes más lo necesitan, generando un impacto social positivo y reduciendo el desperdicio electrónico</p>
      <div class="hero-botones">
        <a href="shop.php" class="btn-hero primary">Comprar</a>
        <a href="vender.php" class="btn-hero secondary">Vender</a>
      </div>
    </div>
    <div class="hero-imagen">
      <img src="images/pat.png" alt="TechForAll Ilustración">
    </div>
  </div>
</section>


         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>
</div>
<section class="categoria-modern">
  <h2 class="section-title">Comprar por categoría</h2>
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
