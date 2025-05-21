<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=shop_db', 'root', '');
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
