<?php
session_start();
include '../components/connect.php';

$message = [];

if (isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] === 'vendedor' && password_verify($password, $user['password'])) {
        $_SESSION['vendedor_id'] = $user['id'];
        $_SESSION['rol'] = $user['role'];
        $_SESSION['nombre'] = $user['name'];

        header('Location: /projectdone/vendedor/home.php');
        exit;
    } else {
        $message[] = 'Correo o contraseña incorrectos o no eres vendedor.';
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Login Vendedor</title>
   <link rel="stylesheet" href="../css/vendedor_style.css">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<?php
if (!empty($message)) {
   foreach ($message as $msg) {
      echo '<div class="message"><span>' . $msg . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
   }
}
?>

<section class="form-container">
   <form action="" method="post">
      <h3>Iniciar sesión como vendedor</h3>
      <input type="email" name="correo" required placeholder="Correo electrónico" class="box">
      <input type="password" name="password" required placeholder="Contraseña" class="box">
      <input type="submit" value="Ingresar" class="btn">
   </form>
</section>

</body>
</html>
