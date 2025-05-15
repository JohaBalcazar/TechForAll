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
    <link rel="stylesheet" href="../css/vendedor_style.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="contenedor">
    <h1>Centro de Soporte</h1>
    <p>Si tienes dudas, revisa las preguntas frecuentes o contáctanos:</p>
    <ul>
        <li>📩 Email: soporte@techforall.com</li>
        <li>📞 Teléfono: (0991) 123 456</li>
        <li>💬 Chat en vivo: 08:00 - 18:00 hs</li>
    </ul>
</section>

</body>
</html>
