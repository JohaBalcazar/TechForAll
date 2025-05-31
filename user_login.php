<?php 
include 'components/connect.php';
session_start();

if (isset($_POST['submit'])) {
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $pass = $_POST['pass'];

   $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
   $select_user->execute([$email]);
   $user = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($user && password_verify($pass, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['rol'] = $user['role'];

      if ($user['role'] === 'vendedor') {
         header('Location: /projectdone/vendedor/home.php');
      } elseif ($user['role'] === 'admin') {
         header('Location: /projectdone/admin/dashboard.php');
      } else {
         header('Location: /projectdone/home.php');
      }
      exit;
   } else {
      $message[] = 'Correo o contraseña incorrectos.';
   }
}
?> 




<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Iniciar sesión</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Iniciar sesión ahora</h3>

      <?php
         if (!empty($message)) {
            foreach ($message as $msg) {
               echo '<div class="message">'.$msg.'</div>';
            }
         }
      ?>

      <input type="email" name="email" required placeholder="Ingresa tu correo electrónico" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Ingresa tu contraseña" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Ingresar" class="btn" name="submit">
      <p>¿No tienes una cuenta?</p>
      <a href="user_register.php" class="option-btn">Regístrate ahora.</a>
   </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
