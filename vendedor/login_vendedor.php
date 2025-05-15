<?php
include '../components/connect.php';
session_start();

if (isset($_POST['submit'])) {
   $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE email = :correo";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':correo', $correo);
   $stmt->execute();
   $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

   if ($usuario && password_verify($password, $usuario['password'])) {
      $_SESSION['nombre'] = $usuario['name'];
      $_SESSION['rol'] = $usuario['role'];

      if ($usuario['role'] === 'vendedor') {
         $_SESSION['vendedor_id'] = $usuario['id'];
         header('Location: vendedor_panel.php');
         exit;
      } elseif ($usuario['role'] === 'admin') {
         $_SESSION['admin_id'] = $usuario['id'];
         header('Location: ../admin/dashboard.php');
         exit;
      } else {
         $_SESSION['user_id'] = $usuario['id'];
         header('Location: ../home.php');
         exit;
      }
   } else {
      $message[] = 'Correo o contraseña incorrectos.';
   }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Vendedor</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<section class="form-container">
   <form action="" method="post">
      <h3>Iniciar sesión como vendedor</h3>
      <p>Accede con el correo y contraseña que usaste al registrarte como vendedor.</p>
      <input type="email" name="correo" required placeholder="Correo electrónico" class="box">
      <input type="password" name="password" required placeholder="Contraseña" class="box">
      <input type="submit" value="Ingresar" class="btn" name="submit">
   </form>
</section>

</body>
</html>
