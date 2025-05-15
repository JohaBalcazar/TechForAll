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
</head>
<body>

<?php include '../components/vendedor_nav.php'; ?>

<section class="bienvenida">
    <h1>¡Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?>!</h1>
    <p>Gracias por formar parte de TechForAll como vendedor. Aquí encontrarás recursos y herramientas para crecer como vendedor.</p>
</section>

<section class="info-vendedor">
    <div class="contenedor-bloques">
        <div class="bloque">
            <h2>🔧 ¿Cómo vender en TechForAll?</h2>
            <p>Consulta nuestra guía paso a paso para comenzar a publicar tus productos y recibir pedidos.</p>
            <a href="como_vender.php" class="btn">Guía para vender</a>
        </div>

        <div class="bloque">
            <h2>📈 Tips de ventas</h2>
            <p>Consejos útiles para destacar tus publicaciones, optimizar precios y mejorar la presentación de tus productos.</p>
            <a href="tips.php" class="btn">Ver tips</a>
        </div>

        <div class="bloque">
            <h2>💬 Soporte y consultas</h2>
            <p>¿Tienes dudas o necesitas ayuda? Accede a preguntas frecuentes o contacta a nuestro equipo de soporte.</p>
            <a href="soporte.php" class="btn">Ir al soporte</a>
        </div>

        <div class="bloque">
            <h2>🎁 Donaciones y beneficios</h2>
            <p>Explora cómo puedes donar productos y formar parte de nuestras iniciativas sociales como vendedor.</p>
            <a href="../donar.php" class="btn">Ir a Donar</a>
        </div>

        <div class="bloque">
            <h2>🛒 Cómo gestionar productos</h2>
            <p>Aprende a agregar, editar o eliminar productos fácilmente desde tu panel de control.</p>
            <a href="vendedor_panel.php" class="btn">Acceder al Panel</a>
        </div>

        <div class="bloque">
            <h2>📊 Reportes de ventas</h2>
            <p>Revisa el historial de ventas, ingresos mensuales y tus productos más vendidos.</p>
            <a href="ventas_recientes.php" class="btn">Ver Reportes</a>
        </div>
    </div>
</section>

<section class="acceso-panel">
    <h2>¿Quieres gestionar tus productos?</h2>
    <p>Desde aquí puedes ingresar directamente al panel de vendedor.</p>
    <a href="vendedor_panel.php" class="btn">Ingresar al Panel</a>
</section>

</body>
</html>

<style>
.bienvenida, .info-vendedor, .acceso-panel {
    padding: 2rem;
    text-align: center;
    background: #f7f7f7;
}

.contenedor-bloques {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    padding-top: 2rem;
}

.bloque {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.bloque h2 {
    margin-bottom: 1rem;
    color: #333;
}

.bloque p {
    font-size: 1.4rem;
    color: #666;
    margin-bottom: 1rem;
}

.btn {
    display: inline-block;
    background-color: #2980b9;
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.4rem;
}

.btn:hover {
    background-color: #1f6392;
}
</style>
