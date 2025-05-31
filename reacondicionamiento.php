<?php
include 'components/connect.php';
session_start();
$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reacondicionamiento</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         background: #0c0c14;
         color: #fff;
         font-family: 'Poppins', sans-serif;
         margin: 0;
      }

      .carousel-container img {
         width: 100%;
         height: auto;
         max-height: 450px;
         object-fit: cover;
         display: block;
      }

      .info-section {
         padding: 4rem 2rem;
         text-align: center;
         background: #0c0c14;
      }

      .info-section h2 {
         font-size: 2.8rem;
         margin-bottom: 1.5rem;
         color: #a88fc9;
         font-weight: bold;
      }

      .info-section p {
         max-width: 900px;
         margin: 0 auto;
         font-size: 1.6rem;
         line-height: 1.9;
         color: #ddd;
      }

      .steps {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         gap: 2.5rem;
         padding: 4rem 2rem;
         background: #0e0e18;
      }

      .step {
         background: linear-gradient(145deg, #231f39, #2e2849);
         padding: 2rem;
         border-radius: 1.2rem;
         box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
         width: 280px;
         text-align: center;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .step:hover {
         transform: translateY(-6px);
         box-shadow: 0 15px 35px rgba(170, 140, 250, 0.4);
      }

      .step img {
         width: 80px;
         margin-bottom: 1rem;
      }

      .step h3 {
         color: #e4d9ff;
         font-size: 1.6rem;
         margin-bottom: 0.7rem;
      }

      .step p {
         font-size: 1.2rem;
         color: #cfcfcf;
      }

      .reacondicionar-btn {
         margin: 4rem auto;
         text-align: center;
      }

      .reacondicionar-btn a {
         display: inline-block;
         background: #8f5aff;
         color: #fff;
         padding: 1rem 2rem;
         font-size: 1.3rem;
         border-radius: 0.6rem;
         text-decoration: none;
         transition: background 0.3s ease;
      }

      .reacondicionar-btn a:hover {
         background: #6f3eff;
      }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="carousel-container">
   <img src="images/rea1.png" alt="Banner Reacondicionamiento">
</div>

<section class="info-section">
   <h2>¿Qué es el reacondicionamiento en TechForAll?</h2>
   <p>
      Es el proceso mediante el cual recuperamos, reparamos y optimizamos dispositivos tecnológicos para extender su vida útil.
      Así ayudamos a reducir el desperdicio electrónico y facilitamos el acceso a la tecnología.
   </p>
</section>

<section class="steps">
   <div class="step">
      <img src="images/hm1.png" alt="Recepción">
      <h3>Recepción del dispositivo</h3>
      <p>Recibimos equipos de donaciones o ventas. Revisamos el estado general y su funcionalidad.</p>
   </div>
   <div class="step">
      <img src="images/iconn2.png" alt="Diagnóstico">
      <h3>Diagnóstico técnico</h3>
      <p>Un técnico realiza pruebas para identificar fallas y componentes a reemplazar.</p>
   </div>
   <div class="step">
      <img src="images/iconn3.png" alt="Reparación">
      <h3>Reparación y limpieza</h3>
      <p>Se reemplazan piezas necesarias, se instala software, y se deja listo para su nuevo uso.</p>
   </div>
   <div class="step">
      <img src="images/iconn4.png" alt="Entrega">
      <h3>Entrega responsable</h3>
      <p>El dispositivo reacondicionado se ofrece en la plataforma o se dona a comunidades vulnerables.</p>
   </div>
</section>

<div class="reacondicionar-btn">
   <a href="contact.php">Solicitar reacondicionamiento</a>
</div>

<?php include 'components/footer.php'; ?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
