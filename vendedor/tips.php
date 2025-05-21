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
    <title>Tips de Venta - TechForAll</title>
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

        .tips-header {
            text-align: center;
            padding: 5rem 2rem 3rem;
        }

        .tips-header h1 {
            font-size: 3rem;
            color: #a26bff;
        }

        .tips-section {
            max-width: 1200px;
            margin: auto;
            padding: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .tip-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 1rem;
            padding: 2rem;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(162, 107, 255, 0.2);
        }

        .tip-card img {
        width: auto;
        height: 260px;
        max-width: 100%;
        object-fit: cover;
        border-radius: 0.7rem;
        margin: 0 auto 1rem;
        display: block;
        }

        .tip-card h3 {
            color: #ffb347;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .tip-card p {
            color: #ccc;
            font-size: 1.2rem;
        }

        .extra-section {
            background: rgba(255,255,255,0.02);
            padding: 4rem 2rem;
            text-align: center;
            margin-top: 4rem;
        }

        .extra-section h2 {
            font-size: 2.2rem;
            color: #ffd700;
            margin-bottom: 1rem;
        }

        .extra-section p {
            max-width: 800px;
            margin: auto;
            font-size: 1.4rem;
            color: #ccc;
            margin-bottom: 2rem;
        }

        .btn-panel {
            background: #a26bff;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 0.6rem;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-panel:hover {
            background: #6c63ff;
        }

        @media(max-width: 768px) {
            .tip-card img {
                height: 120px;
            }
        }
        .tips-horizontal {
    max-width: 1200px;
    margin: 3rem auto;
    padding: 2rem;
    display: flex;
    flex-direction: row;
    gap: 2rem;
    justify-content: center;
    flex-wrap: wrap;
}

    </style>
</head>
<body>

    <?php include '../components/vendedor_nav.php'; ?>
    <section class="tips-header">
        <h1>Tips de ventas efectivas</h1>
    </section>
    <section class="tips-section">
        <div class="tip-card">
            <img src="../images/t1.png" alt="Foto real del producto">
            <h3>Usa fotos reales y de calidad</h3>
            <p>Las imágenes claras y atractivas generan mayor confianza y atraen más compradores.</p>
        </div>
        <div class="tip-card">
            <img src="../images/t2.png" alt="Descripción precisa">
            <h3>Descripciones detalladas</h3>
            <p>Incluí marca, estado, especificaciones y cualquier detalle relevante. Sé honesto.</p>
        </div>
        <div class="tip-card">
            <img src="../images/t3.png" alt="Precio competitivo">
            <h3>Precio justo</h3>
            <p>Compará precios en el mercado y ofrece un valor razonable según el estado del producto.</p>
        </div>
    </section>

    <section class="tips-horizontal">
        <div class="tip-card">
            <img src="../images/t5.png" alt="Atención rápida">
            <h3>Responde rápido</h3>
            <p>Una buena atención y respuesta rápida puede asegurar la venta frente a otros vendedores.</p>
        </div>
        <div class="tip-card">
            <img src="../images/t4.png" alt="Opiniones positivas">
            <h3>Reputación</h3>
            <p>Cumplí con los tiempos de entrega y calidad para recibir valoraciones positivas.</p>
        </div>
    </section>

    <?php include '../components/footer.php'; ?>

</body>
</html>
