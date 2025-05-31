<?php
session_start();
include '../components/connect.php';

// Validación de sesión
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: login_vendedor.php");
    exit;
}

$vendedor_id = $_SESSION['vendedor_id'];

$productos = [];
try {
    $query = $conn->prepare("SELECT * FROM products WHERE vendedor_id = ?");
    $query->execute([$vendedor_id]);
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error al obtener productos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Productos</title>
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0b0b13, #1a1a2e);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
        }

        .productos-lista {
            max-width: 1000px;
            margin: auto;
            padding: 4rem 2rem;
        }

        .productos-lista h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
            color: #a26bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        th {
            background: #1f1f2e;
            color: #ffb347;
        }

        td {
            color: #ddd;
        }

        td a {
            color: #a26bff;
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            color: #ffb347;
        }

        .mensaje-exito, .mensaje-error {
            text-align: center;
            padding: 1rem 2rem;
            margin: 1rem auto;
            max-width: 600px;
            border-radius: 0.5rem;
            font-size: 1.4rem;
        }

        .mensaje-exito {
            background: #28a745;
            color: white;
        }

        .mensaje-error {
            background: #dc3545;
            color: white;
        }

        .no-productos {
            text-align: center;
            font-size: 1.6rem;
            color: #ccc;
            margin-top: 3rem;
            padding: 2rem;
            background: rgba(255,255,255,0.03);
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }

        .no-productos i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #a26bff;
        }
    </style>
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="productos-lista">
    <h1>Mis Productos</h1>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="mensaje-exito"><?= htmlspecialchars($_GET['mensaje']); ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="mensaje-error"><?= htmlspecialchars($_GET['error']); ?></div>
    <?php elseif (isset($error)): ?>
        <div class="mensaje-error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (!empty($productos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['name']); ?></td>
                        <td><?= number_format($producto['price'], 0, ',', '.'); ?> Gs</td>
                        <td>
                            <a href="editar_productos.php?id=<?= $producto['id']; ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a href="eliminar_productos.php?id=<?= $producto['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-productos">
            <i class="fas fa-box-open"></i>
            <p>No tienes productos añadidos aún.</p>
        </div>
    <?php endif; ?>
</section>

</body>
</html>
