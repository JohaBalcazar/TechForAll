<?php
session_start();
include 'components/connect.php';

$message = [];

if (isset($_POST['submit'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $pass = $_POST['pass'];
   $cpass = $_POST['cpass'];

   $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
   $select_user->execute([$email]);

   if ($select_user->rowCount() > 0) {
      $message[] = '¡El email ya está registrado!';
   } elseif ($pass !== $cpass) {
      $message[] = '¡La confirmación no coincide!';
   } else {
      $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
      $rol = 'vendedor';

      $insert_user = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
      $insert_user->execute([$name, $email, $hashed_pass, $rol]);

      $user_id = $conn->lastInsertId();
      $stmt_vendedor = $conn->prepare("INSERT INTO vendedores (user_id) VALUES (?)");
      $stmt_vendedor->execute([$user_id]);

      $_SESSION['vendedor_id'] = $user_id;
      $_SESSION['rol'] = 'vendedor';
      $_SESSION['nombre'] = $name;

      header("Location: vendedor/home.php");
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      :root {
         --main-color: #a26bff;
         --accent-color: #4a3aff;
         --bg-color: #0b0b13;
         --dark-blue: #1a1a2e;
         --text-color: #fff;
         --light-color: #ccc;
         --box-bg: rgba(255,255,255,0.05);
         --box-border: rgba(255,255,255,0.1);
         --radius: 1rem;
      }

      body {
         background: linear-gradient(135deg, var(--bg-color), var(--dark-blue));
         color: var(--text-color);
         font-family: 'Poppins', sans-serif;
         margin: 0;
         padding: 0;
      }

      .info-section {
         padding: 4rem 2rem;
         text-align: center;
         max-width: 1200px;
         margin: auto;
      }

      .info-section h2 {
         font-size: 3.5rem;
         margin-bottom: 2rem;
         color: var(--main-color);
      }

      .info-section p {
         font-size: 1.6rem;
         max-width: 800px;
         margin: 0 auto 3rem;
         color: var(--light-color);
         line-height: 1.8;
      }

      .benefits {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         gap: 2rem;
         margin-bottom: 3rem;
      }

      .benefit-box {
         background: var(--box-bg);
         border: 1px solid var(--box-border);
         padding: 2rem;
         border-radius: var(--radius);
         max-width: 300px;
         text-align: left;
         color: var(--text-color);
      }

      .benefit-box h3 {
         color: var(--accent-color);
         font-size: 2rem;
         margin-bottom: 1rem;
      }

      .benefit-box p {
         font-size: 1.4rem;
         line-height: 1.6;
      }

      .register-btn {
         background: linear-gradient(to right, var(--main-color), var(--accent-color));
         padding: 1.5rem 3rem;
         color: white;
         font-size: 1.6rem;
         border-radius: 0.8rem;
         border: none;
         cursor: pointer;
         transition: 0.3s;
      }

      .register-btn:hover {
         background: var(--accent-color);
      }

      .register-form-container {
         display: none;
         max-width: 500px;
         margin: 3rem auto;
         padding: 3rem;
         background: var(--box-bg);
         border: 1px solid var(--box-border);
         border-radius: var(--radius);
      }

      .register-form-container.active {
         display: block;
      }

      .register-form-container h3 {
         font-size: 2.4rem;
         color: var(--main-color);
         margin-bottom: 2rem;
      }

      .register-form-container .box {
         width: 100%;
         padding: 1.2rem;
         margin-bottom: 1.5rem;
         border: none;
         border-radius: 0.5rem;
         font-size: 1.5rem;
         background: rgba(255,255,255,0.1);
         color: white;
      }

      .register-form-container .btn {
         background: var(--main-color);
         color: white;
         border: none;
         padding: 1rem 2rem;
         border-radius: .5rem;
         font-size: 1.6rem;
         cursor: pointer;
         transition: 0.3s;
      }

      .register-form-container .btn:hover {
         background: var(--accent-color);
      }

      .info-image {
         text-align: center;
         margin: 3rem 0;
      }

      .info-image img {
         width: 100%;
         max-width: 500px;
         border-radius: var(--radius);
         box-shadow: 0 0 30px rgba(162, 107, 255, 0.2);
      }

      .message {
         background: rgba(255, 0, 0, 0.1);
         border: 1px solid #ff6b6b;
         padding: 1rem;
         color: #ff6b6b;
         text-align: center;
         margin: 2rem auto;
         max-width: 500px;
         border-radius: .5rem;
      }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<?php if (!empty($message)): ?>
   <?php foreach ($message as $msg): ?>
      <div class="message"><span><?= $msg ?></span></div>
   <?php endforeach; ?>
<?php endif; ?>

<section class="info-section">
   <h2>¿Por qué vender en TechForAll?</h2>
   <p>TechForAll es la plataforma ideal para quienes quieren darle una nueva vida a sus dispositivos tecnológicos. Vendé productos reacondicionados de manera rápida, segura y con impacto social positivo.</p>

   <div class="benefits">
      <div class="benefit-box">
         <h3>Alcance nacional</h3>
         <p>Conectamos vendedores con cientos de compradores en todo el país.</p>
      </div>
      <div class="benefit-box">
         <h3>Soporte técnico</h3>
         <p>Reacondicioná tus dispositivos con el apoyo de técnicos certificados.</p>
      </div>
      <div class="benefit-box">
         <h3>Pagos seguros</h3>
         <p>Transacciones protegidas con plataformas de pago integradas y transparentes.</p>
      </div>
   </div>

   <div class="info-image">
      <img src="images/vender.png" alt="TechForAll Vender">
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
