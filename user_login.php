<?php 
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   // Si ya hay sesión activa, redirigir según el rol
   if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'vendedor') {
      header('Location: vendedor_panel.php');
   } else {
      header('Location: home.php');
   }
   exit;
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $pass = sha1($_POST['pass']); // ¡OJO! sha1 no es lo más seguro, pero usaremos tu base actual
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);

   if($select_user->rowCount() > 0){
      $row = $select_user->fetch(PDO::FETCH_ASSOC);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['rol'] = $row['rol']; // ← guardamos el rol del usuario

      // Redireccionar según el rol
      if ($row['rol'] === 'vendedor') {
         header('Location: vendedor_panel.php');
      } else {
         header('Location: home.php');
      }
      exit;
   }else{
      $message[] = '¡Correo o contraseña incorrectos!';
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
