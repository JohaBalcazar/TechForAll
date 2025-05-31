<?php
include '../components/connect.php';
session_start();

$message = [];

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $message[] = '¡Este correo ya está registrado!';
    } elseif ($pass !== $cpass) {
        $message[] = '¡Las contraseñas no coinciden!';
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'vendedor')");
        $stmt->execute([$name, $email, $hashed_pass]);

        $_SESSION['vendedor_id'] = $conn->lastInsertId();
        $_SESSION['rol'] = 'vendedor';
        $_SESSION['nombre'] = $name;

        header('Location: vendedor_panel.php');
        exit;
    }
}
?>

<!-- Formulario HTML -->
<?php if (!empty($message)) {
    foreach ($message as $msg) {
        echo '<div class="message"><span>' . htmlspecialchars($msg) . '</span></div>';
    }
} ?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="submit" name="submit" value="Registrarse como Vendedor">
</form>
