<?php
session_start();
include '../components/connect.php';

if (!isset($_SESSION['vendedor_id'])) {
    header('Location: login_vendedor.php');
    exit;
}

$vendedor_id = $_SESSION['vendedor_id'];

if (!isset($_GET['id'])) {
    header('Location: mis_productos.php');
    exit;
}

$producto_id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM products WHERE id = ? AND vendedor_id = ?");
$query->execute([$producto_id, $vendedor_id]);
$producto = $query->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    echo "<p style='color:red;text-align:center;'>Producto no encontrado o no tienes permiso para editarlo.</p>";
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

    $new_image = $_FILES['image_01']['name'];
    $new_image_tmp = $_FILES['image_01']['tmp_name'];

    if (!empty($new_image)) {
        $image_name = time() . '_' . $new_image;
        move_uploaded_file($new_image_tmp, '../uploaded_img/' . $image_name);
    } else {
        $image_name = $producto['image_01'];
    }

    $update = $conn->prepare("UPDATE products SET name = ?, price = ?, details = ?, image_01 = ? WHERE id = ? AND vendedor_id = ?");
    $update->execute([$name, $price, $details, $image_name, $producto_id, $vendedor_id]);

    $mensaje = "✅ Producto actualizado correctamente.";

    $query->execute([$producto_id, $vendedor_id]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
     <link rel="stylesheet" href="../css/vendedor_style.css">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0b0b13, #1a1a2e);
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .formulario-editar {
            max-width: 600px;
            margin: 4rem auto;
            background: rgba(255,255,255,0.05);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .formulario-editar h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #a26bff;
        }

        .formulario-editar label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }

        .formulario-editar input[type="text"],
        .formulario-editar input[type="number"],
        .formulario-editar input[type="file"],
        .formulario-editar textarea {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            background: #fff;
            color: #000;
            font-size: 1rem;
        }

        .formulario-editar textarea {
            resize: vertical;
        }

        .formulario-editar input[type="submit"] {
            margin-top: 2rem;
            width: 100%;
            background: #a26bff;
            color: white;
            border: none;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 0.6rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .formulario-editar input[type="submit"]:hover {
            background: #6c63ff;
        }

        .formulario-editar .mensaje {
            text-align: center;
            margin-bottom: 1rem;
            background-color: #28a745;
            color: white;
            padding: 0.8rem;
            border-radius: 0.5rem;
            font-weight: bold;
        }

        .formulario-editar img {
            margin-top: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="formulario-editar">
    <h1>Editar producto</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje"><?= $mensaje; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nombre del producto</label>
        <input type="text" name="name" value="<?= htmlspecialchars($producto['name']); ?>" required>

        <label>Precio</label>
        <input type="number" name="price" value="<?= $producto['price']; ?>" required>

        <label>Descripción</label>
        <textarea name="details" required rows="5"><?= htmlspecialchars($producto['details']); ?></textarea>

        <label>Imagen actual:</label><br>
        <img src="../uploaded_img/<?= htmlspecialchars($producto['image_01']); ?>" width="150"><br><br>

        <label>Subir nueva imagen (opcional)</label>
        <input type="file" name="image_01" accept="image/*">

        <input type="submit" value="Actualizar producto">
    </form>
</section>

</body>
</html>
