<?php
include '../components/connect.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$vendedor_id = $_SESSION['vendedor_id'] ?? '';

if (!$vendedor_id) {
   header('Location: login_vendedor.php');
   exit;
}

// Obtener perfil del vendedor
$fetch_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$fetch_profile->execute([$vendedor_id]);

if ($fetch_profile->rowCount() > 0) {
   $profile = $fetch_profile->fetch(PDO::FETCH_ASSOC);
} else {
   die('<h2 style="color:red;text-align:center;margin-top:2rem;">¡Perfil no encontrado!</h2>');
}

// Procesar formulario
if (isset($_POST['submit'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

   // Actualizar nombre
   $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
   $update_name->execute([$name, $vendedor_id]);

   // Contraseña
   $empty_pass = sha1('');
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $new_pass = sha1($_POST['new_pass']);
   $confirm_pass = sha1($_POST['confirm_pass']);

   if ($old_pass == $empty_pass) {
      $mensaje = '⚠️ Por favor, ingresa tu contraseña actual.';
   } elseif ($old_pass != $prev_pass) {
      $mensaje = '❌ La contraseña actual es incorrecta.';
   } elseif ($new_pass != $confirm_pass) {
      $mensaje = '❌ La nueva contraseña no coincide.';
   } else {
      if ($new_pass != $empty_pass) {
         $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass->execute([$confirm_pass, $vendedor_id]);
         $mensaje = '✅ Contraseña actualizada correctamente.';
      } else {
         $mensaje = '⚠️ La nueva contraseña no puede estar vacía.';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Mi Perfil - TechForAll</title>
   <link rel="stylesheet" href="../css/vendedor_style.css">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
   <style>
      body {
         background: linear-gradient(135deg, #0b0b13, #1a1a2e);
         font-family: 'Poppins', sans-serif;
         color: white;
         margin: 0;
         padding-bottom: 4rem;
      }

      .form-container {
         max-width: 500px;
         margin: 4rem auto;
         padding: 2rem;
         background: rgba(255,255,255,0.05);
         border-radius: 1rem;
         border: 1px solid rgba(255,255,255,0.1);
         box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      }

      .form-container h3 {
         text-align: center;
         margin-bottom: 2rem;
         color: #a26bff;
         font-size: 2rem;
      }

      .form-container .box {
         width: 100%;
         padding: 1rem;
         border-radius: 0.5rem;
         margin-bottom: 1rem;
         border: 1px solid #ccc;
         background: rgba(255, 255, 255, 0.1);
         color: white;
         font-size: 1rem;
      }

      .form-container .box:focus {
         border-color: #a26bff;
         outline: none;
      }

      .form-container .btn {
         width: 100%;
         padding: 1rem;
         background: #a26bff;
         border: none;
         color: white;
         font-weight: bold;
         border-radius: 0.5rem;
         cursor: pointer;
         font-size: 1.2rem;
         transition: 0.3s ease;
      }

      .form-container .btn:hover {
         background: #6c63ff;
      }

      .mensaje {
         text-align: center;
         margin-bottom: 1.5rem;
         font-weight: bold;
         color: #ffb347;
         background-color: rgba(255, 255, 255, 0.05);
         padding: 1rem;
         border-radius: 0.5rem;
      }
   </style>
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Mi Perfil</h3>

      <?php if (isset($mensaje)): ?>
         <div class="mensaje"><?= $mensaje ?></div>
      <?php endif; ?>

      <input type="hidden" name="prev_pass" value="<?= $profile['password']; ?>">
      <input type="text" name="name" value="<?= htmlspecialchars($profile['name']); ?>" required placeholder="Tu nombre" class="box">
      <input type="password" name="old_pass" placeholder="Contraseña actual" class="box">
      <input type="password" name="new_pass" placeholder="Nueva contraseña" class="box">
      <input type="password" name="confirm_pass" placeholder="Confirmar nueva contraseña" class="box">
      <input type="submit" value="Actualizar perfil" name="submit" class="btn">
   </form>
</section>

</body>
</html>
