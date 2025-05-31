<?php
include 'components/connect.php';
session_start();

if (isset($_POST['submit'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $pass = $_POST['pass'];
   $cpass = $_POST['cpass'];

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);

   if ($select_user->rowCount() > 0) {
      $message[] = '¡El correo electrónico ya está registrado!';
   } elseif ($pass !== $cpass) {
      $message[] = '¡Confirmación de contraseña incorrecta!';
   } else {
      $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
      $insert_user = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'comprador')");
      $insert_user->execute([$name, $email, $hashed_pass]);

      $message[] = '¡Registro exitoso! Inicia sesión.';
   }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Regístrese ahora.</h3>
      <input type="text" name="name" required placeholder="Ingresa tu nombre de usuario" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="Ingresa tu correo electrónico" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Ingresa tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirma tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Regístrate ahora" class="btn" name="submit">
      <p>¿Ya tienes una cuenta?</p>
      <a href="user_login.php" class="option-btn">Iniciar sesión ahora.</a>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>