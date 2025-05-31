<?php
include '../components/connect.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
   header('location: admin_login.php');
   exit;
}

$mensaje = '';

// Procesar cambios de estado
if (isset($_GET['accion'], $_GET['id'])) {
   $accion = $_GET['accion'];
   $id = intval($_GET['id']);

   if (in_array($accion, ['aceptado', 'rechazado'])) {
      $update = $conn->prepare("UPDATE donaciones SET estado = ? WHERE id = ?");
      $update->execute([$accion, $id]);
      $mensaje = "Estado actualizado a '$accion' correctamente.";
   }
}

// Obtener donaciones
$donaciones = $conn->query("SELECT * FROM donaciones ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Donaciones - Admin | TechForAll</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
      body {
         background: #1a1a2e;
         color: white;
         font-family: 'Poppins', sans-serif;
         margin: 0;
         padding: 0;
      }
      .contenedor {
         max-width: 1000px;
         margin: 4rem auto;
         padding: 2rem;
         background: #2a2a40;
         border-radius: 1rem;
         box-shadow: 0 0 20px rgba(0,0,0,0.5);
      }
      h1 {
         text-align: center;
         color: #a26bff;
         margin-bottom: 2rem;
      }
      .mensaje {
         background: #28a745;
         color: white;
         padding: 1rem;
         border-radius: 5px;
         margin-bottom: 1rem;
         text-align: center;
      }
      .donacion {
         background:rgb(247, 247, 255);
         margin-bottom: 1.5rem;
         padding: 1.5rem;
         border-radius: 0.7rem;
         border-left: 5px solid #a26bff;
      }
      .donacion h3 {
         margin: 0 0 0.5rem;
         color:rgb(109, 53, 251);
      }
      .donacion p {
         margin: 0.3rem 0;
         color: grey;
      }
      .imagen-previa {
         margin-top: 0.5rem;
         max-width: 200px;
         border-radius: 0.5rem;
      }
      .acciones a {
         display: inline-block;
         margin-right: 1rem;
         padding: 0.5rem 1rem;
         border-radius: 0.5rem;
         text-decoration: none;
         font-weight: bold;
         background: #444;
         color: #fff;
         transition: 0.3s;
      }
      .acciones a:hover {
         background: #a26bff;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="contenedor">
   <h1>Donaciones Recibidas</h1>

   <?php if ($mensaje): ?>
      <div class="mensaje"><?= htmlspecialchars($mensaje) ?></div>
   <?php endif; ?>

   <?php if (count($donaciones) > 0): ?>
      <?php foreach ($donaciones as $donacion): ?>
         <div class="donacion">
            <h3><?= htmlspecialchars($donacion['nombre']) ?> (<?= htmlspecialchars($donacion['tipo']) ?>)</h3>
            <p><strong>Email:</strong> <?= htmlspecialchars($donacion['email']) ?></p>
            <p><strong>Mensaje:</strong> <?= nl2br(htmlspecialchars($donacion['mensaje'])) ?></p>
            <p><strong>Estado:</strong> <?= htmlspecialchars($donacion['estado']) ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($donacion['fecha']) ?></p>
            <?php if ($donacion['imagen']): ?>
               <img src="../uploaded_donaciones/<?= htmlspecialchars($donacion['imagen']) ?>" alt="Imagen Donada" class="imagen-previa">
            <?php endif; ?>
            <div class="acciones">
               <a href="?id=<?= $donacion['id'] ?>&accion=aceptado">Aceptar</a>
               <a href="?id=<?= $donacion['id'] ?>&accion=rechazado">Rechazar</a>
            </div>
         </div>
      <?php endforeach; ?>
   <?php else: ?>
      <p style="text-align:center;">No hay donaciones registradas aún.</p>
   <?php endif; ?>
</section>

</body>
</html>
