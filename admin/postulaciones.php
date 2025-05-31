<?php
include '../components/connect.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Procesar actualización de estado
if (isset($_POST['postulacion_id'], $_POST['nuevo_estado'])) {
    $postulacion_id = $_POST['postulacion_id'];
    $nuevo_estado = $_POST['nuevo_estado'];

    $update = $conn->prepare("UPDATE postulaciones SET estado = ? WHERE id = ?");
    $update->execute([$nuevo_estado, $postulacion_id]);
}

// Obtener postulaciones
$stmt = $conn->prepare("SELECT * FROM postulaciones_donacion ORDER BY fecha DESC");
$stmt->execute();
$postulaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Postulaciones - Admin</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0b0b13;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
        }
        .postulaciones-container {
            max-width: 1200px;
            margin: auto;
            padding: 4rem 2rem;
        }

        h1 {
            text-align: center;
            margin-bottom: 3rem;
            color:rgb(95, 71, 255);
        }

        .postulacion {
            background: rgb(255, 255, 255);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-left: 5px solid #6c63ff;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .postulacion p {
            margin: 0.4rem 0;
            color: grey;
        }

        .postulacion strong {
            color:rgb(67, 66, 71);
        }

        form.estado-form {
            margin-top: 1rem;
        }

        select, button {
            padding: 0.5rem 1rem;
            margin-right: 1rem;
            font-weight: bold;
            border-radius: 6px;
            border: none;
        }

        select {
            background: #1a1a2e;
            color: white;
        }

        button {
            background:rgb(40, 33, 52);
            color: white;
            cursor: pointer;
        }

        button:hover {
            background:rgb(143, 138, 250);
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="postulaciones-container">
    <h1>Postulaciones de Comunidades</h1>

    <?php if (count($postulaciones) > 0): ?>
        <?php foreach ($postulaciones as $post): ?>
         <div class="postulacion">
    <p><strong>Nombre:</strong> <?= htmlspecialchars($post['nombre']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($post['email']) ?></p>
    <p><strong>Teléfono:</strong> <?= htmlspecialchars($post['numero']) ?></p>
    <p><strong>Tecnología requerida:</strong> <?= htmlspecialchars($post['producto']) ?></p>
    <p><strong>Motivo:</strong> <?= htmlspecialchars($post['motivo']) ?></p>
    <p><strong>Mensaje adicional:</strong> <?= htmlspecialchars($post['mensaje']) ?></p>
    <p><strong>Fecha:</strong> <?= htmlspecialchars($post['fecha']) ?></p>

    <?php $estado = $post['estado'] ?? 'pendiente'; ?>
    <p><strong>Estado actual:</strong> <span style="color: rgb(26, 11, 195);"><?= htmlspecialchars($estado) ?></span></p>

    <form method="post" class="estado-form">
        <!-- CAMPO OCULTO PARA IDENTIFICAR LA POSTULACIÓN -->
        <input type="hidden" name="postulacion_id" value="<?= $post['id'] ?>">

        <select name="nuevo_estado">
            <option value="pendiente" <?= $estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="aceptado" <?= $estado == 'aceptado' ? 'selected' : '' ?>>Aceptado</option>
            <option value="rechazado" <?= $estado == 'rechazado' ? 'selected' : '' ?>>Rechazado</option>
        </select>

        <button type="submit">Actualizar estado</button>
    </form>
</div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center; font-size: 1.4rem; color:#aaa;">No hay postulaciones registradas aún.</p>
    <?php endif; ?>
</section>

</body>
</html>
