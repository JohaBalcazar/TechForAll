<?php
include 'components/connect.php';
session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = 'vendedor';

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $rol]);

    $_SESSION['vendedor_id'] = $conn->lastInsertId();
    $_SESSION['rol'] = 'vendedor';
    $_SESSION['nombre'] = $name;

    header('Location: vendedor/vendedor_panel.php');
    exit;
}
?>

<!-- Formulario HTML -->
<form method="POST" action="">
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="submit" name="submit" value="Registrarse como Vendedor">
</form>
