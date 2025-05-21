<?php
session_start();
if (!isset($_SESSION['vendedor_id']) || $_SESSION['rol'] !== 'vendedor') {
    header('Location: login_vendedor.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Soporte - TechForAll</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b0b13, #1a1a2e);
            color: white;
        }

        .support-header {
            text-align: center;
            padding: 4rem 2rem 2rem;
        }

        .support-header h1 {
            font-size: 4rem;
            color:rgb(105, 71, 255);
            margin-bottom: 1rem;
        }

        .support-header p {
            font-size: 1.8rem;
            color: #ccc;
            max-width: 700px;
            margin: auto;
        }

        .contact-section {
            max-width: 1000px;
            margin: 3rem auto;
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }

        .contact-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 1rem;
            padding: 2rem;
            flex: 1 1 280px;
            text-align: center;
            transition: 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 179, 71, 0.2);
        }

        .contact-card i {
            font-size: 2.5rem;
            color:rgba(255, 123, 0, 0.52);
            margin-bottom: 1rem;
        }

        .contact-card h3 {
            font-size: 1.9rem;
            color: #a26bff;
            margin-bottom: 0.5rem;
        }

        .contact-card p {
            font-size: 1.5rem;
            color: #ddd;
        }

        @media(max-width: 768px) {
            .contact-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>

<?php include '../components/vendedor_nav.php'; ?>

<section class="support-header">
    <h1>Centro de Soporte</h1>
    <p>
        ¿Tenés algún problema con la plataforma, una duda sobre tus publicaciones o necesitas ayuda con un proceso?  
        Nuestro equipo de asistencia está listo para ayudarte. Contactanos a través de los siguientes medios:
    </p>
</section>

<section class="contact-section">
    <div class="contact-card">
        <i class="fas fa-envelope"></i>
        <h3>Email</h3>
        <p>Envíanos un correo a<br><strong>soporte@techforall.com</strong><br>y te responderemos en menos de 24 hs.</p>
    </div>

    <div class="contact-card">
        <i class="fas fa-phone-alt"></i>
        <h3>Teléfono</h3>
        <p>Podés llamarnos al<br><strong>(0991) 123 456</strong><br>de lunes a viernes, de 08:00 a 18:00 hs.</p>
    </div>

    <div class="contact-card">
        <i class="fas fa-comments"></i>
        <h3>Chat en WhatsApp</h3>
        <p>Nuestro chat está disponible las 24 horas.<br><strong>0983 321 456</strong><br> Escribinos cuando lo necesites y te responderemos con la mayor rapidez.</p>
    </div>
</section>

<?php include '../components/footer.php'; ?>
</body>
</html>
