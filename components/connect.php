<?php

$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,      // Para lanzar excepciones en errores
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Para que fetch() devuelva arrays asociativos
        PDO::ATTR_EMULATE_PREPARES => false,              // Para preparar sentencias nativas
    ]);
} catch (PDOException $e) {
    // Aquí puedes personalizar el mensaje o registrar el error
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
