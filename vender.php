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
      $message[] = '¡El email ya está registrado!';
   } elseif ($pass !== $cpass) {
      $message[] = '¡La confirmación no coincide!';
   } else {
      $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
      $rol = 'vendedor';

      $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password, role) VALUES (?, ?, ?, ?)");
      $insert_user->execute([$name, $email, $hashed_pass, $rol]);

      $user_id = $conn->lastInsertId();
      $stmt_vendedor = $conn->prepare("INSERT INTO `vendedores` (user_id) VALUES (?)");
      $stmt_vendedor->execute([$user_id]);

      $_SESSION['vendedor_id'] = $user_id;
      $_SESSION['rol'] = 'vendedor';
      $_SESSION['nombre'] = $name;

      // Redirige al home para mostrar vista pública con acceso al menú vendedor
      header("Location: home.php");
      exit;
   }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Vender en TechForAll</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
      .info-section { padding: 2rem; background: #f9f9f9; text-align: center; }
      .info-section h2 { margin-bottom: 1rem; font-size: 2rem; }
      .benefits { display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; }
      .benefit-box { max-width: 300px; background: white; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
      .register-btn { margin: 2rem auto; display: block; padding: 1rem 2rem; background: #0d6efd; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; }
      .register-form-container { display: none; padding: 2rem; background: #fff; border-top: 2px solid #0d6efd; text-align: center; }
      .register-form-container.active { display: block; }
      .form-container form { max-width: 400px; margin: auto; }
      .box { width: 100%; padding: 10px; margin: 10px 0; }
      .btn { padding: 10px 20px; background-color: #0d6efd; color: white; border: none; border-radius: 5px; cursor: pointer; }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<?php if (isset($message)) {
   foreach ($message as $msg) {
      echo "<div class='message'><span>$msg</span></div>";
   }
} ?>

<section class="info-section">
   <h2>¿Por qué vender en TechForAll?</h2>
   <div class="benefits">
      <div class="benefit-box">
         <h3>Alcance amplio</h3>
         <p>Llega a miles de compradores interesados en productos electrónicos reacondicionados.</p>
      </div>
      <div class="benefit-box">
         <h3>Apoyo técnico</h3>
         <p>Acceso a técnicos certificados para reacondicionar tus productos.</p>
      </div>
      <div class="benefit-box">
         <h3>Plataforma segura</h3>
         <p>Pagos protegidos y comisiones claras para tu tranquilidad.</p>
      </div>
   </div>
   <button class="register-btn" onclick="document.querySelector('.register-form-container').classList.toggle('active')">
      Registrarse como vendedor
   </button>
</section>

<section class="register-form-container form-container">
   <form action="" method="post">
      <h3>Regístrate como vendedor</h3>
      <input type="text" name="name" required placeholder="Nombre de usuario" maxlength="20" class="box">
      <input type="email" name="email" required placeholder="Correo electrónico" maxlength="50" class="box">
      <input type="password" name="pass" required placeholder="Contraseña" maxlength="20" class="box">
      <input type="password" name="cpass" required placeholder="Confirmar contraseña" maxlength="20" class="box">
      <input type="submit" value="Registrarme ahora" class="btn" name="submit">
      <p>¿Ya tienes una cuenta?</p>
      <a href="login_vendedor.php" class="btn">Iniciar sesión</a>
   </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>