<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturamos los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $producto = $_POST['producto'] ?? '';
    $motivo = $_POST['motivo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    if ($nombre && $email && $numero && $producto && $motivo) {
        try {
            // Insertamos en la tabla postulaciones_donacion
           $stmt = $conn->prepare("INSERT INTO postulaciones (nombre, email, numero, producto, motivo, mensaje) VALUES (?, ?, ?, ?, ?, ?)");

            $stmt->execute([$nombre, $email, $numero, $producto, $motivo, $mensaje]);

            echo "<script>alert('¡Gracias por postular tu comunidad!'); window.location.href='donar.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error al registrar: " . $e->getMessage() . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Por favor, completá todos los campos obligatorios.'); window.history.back();</script>";
    }
} else {
    header('Location: donar.php');
    exit;
}
?>
