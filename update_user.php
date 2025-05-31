<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   header('Location: user_login.php');
   exit;
}

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   // Cambio de contraseña
   $prev_hash = $fetch_profile['password'];
   $old_pass = $_POST['old_pass'];
   $new_pass = $_POST['new_pass'];
   $cpass = $_POST['cpass'];

   if (!empty($old_pass) || !empty($new_pass) || !empty($cpass)) {
      if (!password_verify($old_pass, $prev_hash)) {
         $message[] = 'La contraseña anterior no coincide.';
      } elseif ($new_pass !== $cpass) {
         $message[] = 'La nueva contraseña no coincide.';
      } else {
         $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
         $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass->execute([$new_hash, $user_id]);
         $message[] = 'Contraseña actualizada exitosamente.';
      }
   }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Actualizar usuario</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Actualizar perfil</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
      <input type="text" name="name" required placeholder="Nombre" maxlength="20" class="box" value="<?= $fetch_profile['name']; ?>">
      <input type="email" name="email" required placeholder="Correo electrónico" maxlength="50" class="box" value="<?= $fetch_profile['email']; ?>">
      <input type="password" name="old_pass" placeholder="Contraseña anterior" maxlength="20" class="box">
      <input type="password" name="new_pass" placeholder="Nueva contraseña" maxlength="20" class="box">
      <input type="password" name="cpass" placeholder="Confirmar nueva contraseña" maxlength="20" class="box">
      <input type="submit" value="Actualizar ahora" class="btn" name="submit">
   </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
