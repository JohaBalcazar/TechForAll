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
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sobre Nosotros</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/nosotros.png" alt="">
      </div>

      <div class="content">
         <h3>"Tecnología reacondicionada con propósito"</h3>
         <p>Conectamos personas, reducimos el desperdicio electrónico y promovemos el acceso a dispositivos de calidad a precios justos. Comprá, vendé o doná con impacto social.</p>

         <p>¿Qué es TechForAll? </p> <p>TechForAll es una plataforma paraguaya de e-commerce dedicada a la compra, venta, reacondicionamiento y donación de productos tecnológicos. </a> Promovemos el acceso equitativo a la tecnología y fomentamos la economía circular mediante procesos responsables y sustentables.</p>
         <a href="contact.php" class="btn">Contactar con nosotros</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">Reseñas de clientes.</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="">
         <p>Compré una notebook reacondicionada y llegó en excelentes condiciones. La web es clara, rápida y me dio confianza desde el primer momento. ¡Recomendada!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> <a href="https://www.facebook.com/profile.php?id=100083292714419" target="_blank">Ana M., Asunción</a></h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="">
         <p>Vendí mi notebook en TechForAll en solo unos pasos. El proceso fue simple y transparente. Me encanta que ayuden al medio ambiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3><a href="https://www.facebook.com/profile.php?id=100075602340579" target="_blank">Luis R., San Lorenzo</a></h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>Me gusta mucho el enfoque social de la plataforma. Navegar por la web fue muy fácil, y encontré buenos precios en productos confiables</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3><a href="https://www.facebook.com/kaushalsah135790" target="_blank">Valeria G.,Lambare</a></h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>Excelente atención y productos como nuevos. TechForAll se convirtió en mi sitio favorito para comprar tecnología a buen precio</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3><a href="https://www.facebook.com/fuccheekta.moh.1" target="_blank">Carlos D., Capiatá</a></h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-5.png" alt="">
         <p>La plataforma es muy fácil de usar. Pude donar una notebook que ya no usaba y supe que la aprovecharon en una escuela. ¡Increíble iniciativa!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3><a href="https://www.facebook.com/ranjitchaudhary159" target="_blank">Ezequiel F., Fernando de la Mora</a></h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-6.png" alt="">
         <p>TechForAll no solo vende, también crea conciencia. Me encanta saber que mi compra ayuda a reducir residuos electrónicos."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3><a href="https://www.facebook.com/pra.x.nil"  target="_blank">Julia S.,Asunción</a></h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>