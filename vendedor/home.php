<?php
session_start();

if (!isset($_SESSION['vendedor_id']) || $_SESSION['rol'] !== 'vendedor') {
    header('Location: login_vendedor.php');
    exit;
}

include '../components/connect.php';
$vendedor_id = $_SESSION['vendedor_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio Vendedor - TechForAll</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(135deg, #0b0b13, #1a1a2e);
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        .hero-techforall {
            padding: 4rem 2rem 2rem;
        }

        .hero-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .hero-texto {
            flex: 1 1 50%;
        }

        .hero-texto h1 {
            font-size: 5rem;
            color:rgb(91, 7, 194);
            margin-bottom: 1rem;
        }

        .hero-texto p {
            font-size: 2.4rem;
            color: #ccc;
            margin-bottom: 2rem;
        }

        .btn-hero {
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 0.6rem;
            font-size: 1.4rem;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s ease;
            margin-right: 1rem;
        }

        .btn-hero.primary {
            background:rgb(86, 4, 227);
            color: white;
        }

        .btn-hero.primary:hover {
            background: #6c63ff;
        }

        .btn-hero.secondary {
            background: transparent;
            color: #a26bff;
            border: 2px solid #a26bff;
        }

        .btn-hero.secondary:hover {
            background: #a26bff;
            color: white;
        }

        .hero-imagen {
            flex: 1 1 40%;
            text-align: center;
        }

        .hero-imagen img {
            max-width: 100%;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .seccion-video, .top-productos, .testimonios {
        padding: 4rem 2rem;
        background: rgba(255,255,255,0.02);
        text-align: center;
        }

        .seccion-video h2, .top-productos h2, .testimonios h2 {
        font-size: 3.0rem;
        color: #a26bff;
        margin-bottom: 1rem;
        }

        .seccion-video p {
        color: #ccc;
        margin-bottom: 2rem;
        }

        .video-responsive {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        .video-responsive iframe {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        }

        .productos-grid, .testimonios-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
        }

        .producto, .testimonio {
        background: rgba(255,255,255,0.05);
        padding: 2rem;
        border-radius: 1rem;
        border: 1px solid rgba(255,255,255,0.1);
        width: 300px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        color: white;
        }

        .producto img, .testimonio img {
        width: 100%;
        max-height: 200px;
        object-fit: contain;
        border-radius: 0.8rem;
        margin-bottom: 1rem;
        }

        .testimonio blockquote {
        font-style: italic;
        color: #ccc;
        margin-bottom: 1rem;
        }

        .testimonio p {
        font-weight: bold;
        color: #ffd700;
        }

    </style>
</head>
<body>

<?php include '../components/vendedor_nav.php'; ?>

<section class="hero-techforall">
  <div class="hero-container">
    <div class="hero-texto">
      <h1>¡BIENVENIDO/A, <?= htmlspecialchars($_SESSION['nombre']); ?>!</h1>
      <p>Gracias por formar parte de TechForAll como vendedor. Aquí encontrarás recursos y herramientas para crecer como vendedor. Estas listo para esta experiencia?</p>
      <div class="hero-botones">
        <a href="como_vender.php" class="btn-hero primary">¿Cómo vender?</a>
        <a href="tips.php" class="btn-hero secondary">Tips de ventas</a>
      </div>
    </div>
    <div class="hero-imagen">
      <img src="../images/VENDEDORP.png" alt="TechForAll Ilustración">
    </div>
  </div>
</section>



<!-- Top productos vendidos -->
<section class="top-productos">
  <h2>🔥 Top productos más vendidos</h2>
  <div class="productos-grid">
    <div class="producto">
      <img src="../images/hm4.png" alt="Notebook">
      <h3>Notebooks</h3>
      <p>Producto estrella, marcas preferidas, HP - ASUS - ACER.</p>
    </div>
    <div class="producto">
      <img src="../images/hm7.png" alt="Pc">
      <h3>PC de escritorio</h3>
      <p>Ideales para gammers, oficinas.</p>
    </div>
    <div class="producto">
      <img src="../images/hm8.png" alt="Monitor">
      <h3>Monitores</h3>
      <p>Medidas y resoluciones estandar y de alta calidad.</p>
    </div>
  </div>
</section>

<!-- Video explicativo -->
<section class="seccion-video">
  <div class="contenedor-video">
    <h2>¿Cómo funciona TechForAll?</h2>
    <p>Aprendé que es un ecommerce, como vender y aprovechar al maximo.</p>
    <div class="video-responsive">
      <iframe src="https://www.youtube.com/embed/SECEAv8n04A" title="Cómo vender en TechForAll" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- Testimonios -->
<section class="testimonios">
  <h2>Lo que dicen nuestros vendedores</h2>
  <div class="testimonios-grid">
    <div class="testimonio">
      <img src="../images/pic-2.png" alt="Marta G.">
      <blockquote>"Desde que vendo en TechForAll, duplico mis ingresos mensuales. ¡Gracias por esta plataforma!"</blockquote>
      <p>— Mario G., Asunción</p>
    </div>
    <div class="testimonio">
      <img src="../images/pic-1.png" alt="Carlos T.">
      <blockquote>"Me encanta cómo se reacondicionan los equipos. El impacto social es real."</blockquote>
      <p>— Julia T., San Lorenzo</p>
    </div>
    <div class="testimonio">
      <img src="../images/pic-4.png" alt="Lucía R.">
      <blockquote>"Vender en TechForAll es rápido, seguro y muy profesional."</blockquote>
      <p>— Lucas R., Lambaré</p>
    </div>
  </div>
</section>

<?php include '../components/footer.php'; ?>

</body>
</html>
