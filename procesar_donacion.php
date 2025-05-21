<?php
include 'components/connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    // Procesar imagen
    $imagen = '';
    if (!empty($_FILES['imagen']['name'])) {
        $carpeta = 'uploaded_donaciones/';
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $nombreImagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaImagen = $carpeta . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            $imagen = $rutaImagen;
        } else {
            // Si falla la subida, puedes manejar el error como quieras
            // Por ejemplo redirigir con error
            header("Location: donar.php?error=upload");
            exit;
        }
    } else {
        // Si no hay imagen obligatoria, también puedes manejar error
        header("Location: donar.php?error=noimage");
        exit;
    }

    try {
        // Cambié 'producto' por 'tipo', cambia aquí si tu columna tiene otro nombre
        $stmt = $conn->prepare("INSERT INTO donaciones (nombre, email, tipo, mensaje, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $tipo, $mensaje, $imagen]);

        // Redirigir con éxito
        header("Location: donar.php?exito=1");
        exit;
    } catch (PDOException $e) {
        // En caso de error en la BD, puedes mostrarlo o redirigir con error
        // echo "Error en la base de datos: " . $e->getMessage();
        header("Location: donar.php?error=db");
        exit;
    }
} else {
    header("Location: donar.php");
    exit;
}
?>
