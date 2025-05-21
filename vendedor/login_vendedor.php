<?php
session_start();
include '../components/connect.php';

$message = [];

if (isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_OBJ);

    if ($usuario && $usuario->role === 'vendedor' && password_verify($password, $usuario->password)) {
        $_SESSION['vendedor_id'] = $usuario->id;
        $_SESSION['rol'] = $usuario->role;
        $_SESSION['nombre'] = $usuario->name;

        header('Location: home.php');
        exit;
    } else {
        $message[] = "Correo o contraseña incorrectos, o no eres vendedor.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Login Vendedor</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php
if (!empty($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
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
