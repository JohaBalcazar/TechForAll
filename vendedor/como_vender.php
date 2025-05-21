<?php
session_start();
if (!isset($_SESSION['vendedor_id']) || $_SESSION['rol'] !== 'vendedor') {
    header('Location: login_vendedor.php');
    exit;
}
?>
<?php include '../components/vendedor_nav.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Cómo vender? - TechForAll</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(135deg, #0b0b13, #1a1a2e);
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
        }

        .hero-como-vender {
    padding: 4rem 2rem;
   
    }

    .contenido-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .texto-banner {
        flex: 1.2;
        min-width: 300px;
        padding-right: 2rem;
        color: white;
        text-align: left;
    }

    .texto-banner h1 {
        font-size: 5rem;
        color:rgb(105, 19, 234);
        margin-bottom: 1rem;
    }

    .texto-banner p {
        font-size: 1.8rem;
        color: #ccc;
        max-width: 800px;
    }

    .imagen-banner {
        flex: 1;
        min-width: 300px;
        text-align: center;
    }

    .imagen-banner img {
        width: 100%;
        max-width: 450px;
        height: auto;
        object-fit: contain;
        border-radius: 1rem;
        transition: transform 0.3s ease;
    }


 
    @media (max-width: 768px) {
        .contenido-banner {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .texto-banner {
            text-align: center;
        }
    }


        .pasos {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            margin: 4rem auto;
            max-width: 1200px;
            padding: 0 2rem;
        }

        .paso {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 1rem;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .paso:hover {
            transform: translateY(-5px);
        }

        .paso img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .paso h3 {
            color: #a26bff;
            margin-bottom: 0.5rem;
        }

        .paso p {
            color: #ccc;
            font-size: 1.2rem;
        }

        .acceso-panel {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255,255,255,0.02);
        }

        .acceso-panel h2 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .acceso-panel p {
            font-size: 1.4rem;
            color: #ccc;
            margin-bottom: 2rem;
        }

        .btn-panel {
            background: #a26bff;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 0.6rem;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.4rem;
            transition: 0.3s ease;
        }

        .btn-panel:hover {
            background: #6c63ff;
        }

        @media (max-width: 768px) {
            .pasos {
                flex-direction: column;
                align-items: center;
            }
        }
        
        .info-vender {
   
    padding: 4rem 2rem;
    }

    .contenedor-info {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .bloque-info {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .bloque-info:hover {
        transform: translateY(-5px);
    }

    .bloque-info h3 {
        color: #a26bff;
        font-size: 1.6rem;
        margin-bottom: 1rem;
    }

    .bloque-info i {
        margin-right: 0.5rem;
    }

    .bloque-info p {
        font-size: 1.2rem;
        color: #ddd;
    }

  
    </style>
</head>
<body>

<section class="hero-como-vender">
    <div class="contenido-banner">
        <div class="texto-banner">
            <h1>¿Cómo vender en TechForAll?</h1>
            <p>En TechForAll, te damos las herramientas necesarias para convertirte en un vendedor responsable y exitoso. ¿Tenés dispositivos que ya no usás? ¿Querés darles una segunda vida y ganar dinero con propósito? Esta es tu oportunidad.Formá parte de una comunidad que apuesta por el consumo consciente, la tecnología accesible y la reducción de residuos electrónicos. Desde tu panel de vendedor podés publicar productos en minutos: subí imágenes, escribí una buena descripción, definí tu precio... ¡y listo! Miles de personas estarán viendo tus productos.Cada venta no solo genera ingresos, también genera impacto. Sumate a la transformación digital responsable y vendé con nosotros en TechForAll.</p>
        </div>
        <div class="imagen-banner">
            <img src="../images/ven.png" alt="Guía para vender en TechForAll">
        </div>
    </div>
</section>

<section class="pasos">
    <div class="paso">
        <img src="../images/cap0.png" alt="Panel">
        <h3>1. Ingresá al Panel</h3>
        <p>Accedé a tu panel desde el menú superior y gestioná tus productos.</p>
    </div>
    <div class="paso">
        <img src="../images/cap1.png" alt="Agregar producto">
        <h3>2. Agregá un Producto</h3>
        <p>Completá el formulario con nombre, precio, categoría, descripción e imágenes.</p>
    </div>
    <div class="paso">
        <img src="../images/cap2.png" alt="Activar">
        <h3>3. Activá la Visibilidad</h3>
        <p>Hacé clic en publicar. Tu producto será visible para miles de compradores.</p>
    </div>
</section>

<section class="acceso-panel">
    <h2>¡Comenzá ahora!</h2>
    <p>Ingresá al panel y publicá tu primer producto reacondicionado con impacto social.</p>
    <a href="vendedor_panel.php" class="btn-panel">Ir al Panel</a>
</section>

<section class="info-vender">
    <div class="contenedor-info">
        <div class="bloque-info">
            <h3><i class="fas fa-laptop-code"></i> Dispositivos que Podés Vender</h3>
            <p>Permitimos la venta de laptops, PCs, Teclados, Mouse, Monitores y otros dispositivos tecnológicos. Todos deben estar funcionando o reacondicionados.</p>
        </div>
        <div class="bloque-info">
            <h3><i class="fas fa-check-circle"></i> Estados Aceptados</h3>
            <p>Aceptamos productos nuevos, reacondicionados, con detalles estéticos leves o usados pero funcionales. Cada estado debe especificarse con claridad en la publicación.</p>
        </div>
        <div class="bloque-info">
            <h3><i class="fas fa-credit-card"></i> Métodos de Pago</h3>
            <p>Recibimos pagos mediante tarjeta de crédito, débito, pago contra entrega, transferencias bancarias y billeteras digitales. Todo a través de plataformas seguras.</p>
        </div>
        <div class="bloque-info">
            <h3><i class="fas fa-shipping-fast"></i> Procesamiento y Compras</h3>
            <p>Una vez realizada la compra, recibirás una notificación para organizar el envío o la entrega. Nosotros acompañamos el proceso para garantizar la seguridad.</p>
        </div>
    </div>
</section>


<?php include '../components/footer.php'; ?>
</body>
</html>
