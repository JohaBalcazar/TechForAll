<?php
include '../components/connect.php';
session_start();

$vendedor_id = $_SESSION['vendedor_id'] ?? null;
if (!$vendedor_id || $_SESSION['rol'] !== 'vendedor') {
    header('Location: ../login_vendedor.php');
    exit;
}

if (isset($_POST['add_product'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../uploaded_img/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../uploaded_img/' . $image_03;

    $check_name = $conn->prepare("SELECT * FROM products WHERE name = ? AND vendedor_id = ?");
    $check_name->execute([$name, $vendedor_id]);

    if ($check_name->rowCount() > 0) {
        $message[] = '¡El nombre del producto ya existe!';
    } else {
        $insert_product = $conn->prepare("INSERT INTO products (name, details, price, image_01, image_02, image_03, vendedor_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_product->execute([$name, $details, $price, $image_01, $image_02, $image_03, $vendedor_id]);

        move_uploaded_file($image_tmp_name_01, $image_folder_01);
        move_uploaded_file($image_tmp_name_02, $image_folder_02);
        move_uploaded_file($image_tmp_name_03, $image_folder_03);

        $message[] = '¡Producto agregado correctamente!';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar producto</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/vendedor_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include 'vendedor_header.php'; ?>

<section class="add-products">
    <h1 class="heading">Agregar Productos</h1>

   <form action="" method="post" enctype="multipart/form-data">
    <div class="flex">
        <div class="inputBox">
            <span>Nombre del producto</span>
            <input type="text" class="box" required maxlength="100" name="name" placeholder="Ejemplo: Mouse inalámbrico">
        </div>
        <div class="inputBox">
            <span>Precio</span>
            <input type="number" min="0" class="box" required max="9999999999" name="price" placeholder="Ejemplo: 2.000.000">
        </div>
        <div class="inputBox">
            <span>Imagen 01</span>
            <input type="file" name="image_01" accept="image/*" class="box" required>
        </div>
        <div class="inputBox">
            <span>Imagen 02</span>
            <input type="file" name="image_02" accept="image/*" class="box" required>
        </div>
        <div class="inputBox">
            <span>Imagen 03</span>
            <input type="file" name="image_03" accept="image/*" class="box" required>
        </div>
        <div class="inputBox">
            <span>Descripción</span>
            <textarea name="details" class="box" required maxlength="500" cols="30" rows="10" placeholder="Describe las características y detalles del producto"></textarea>
        </div>
    </div>

    <input type="submit" value="Agregar Producto" class="btn" name="add_product">
</form>

</section>

<script src="../js/admin_script.js"></script>
</body>
<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '<div class="message"><span>' . $msg . '</span></div>';
   }
}
?>
</html>
