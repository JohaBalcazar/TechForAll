<?php
include 'components/connect.php';

$nombre = $_POST['nombre_donante'];
$tipo = $_POST['tipo_donacion'];
$fecha = $_POST['fecha'];

$query = "INSERT INTO donaciones (nombre_donante, tipo_donacion, fecha)
          VALUES ('$nombre', '$tipo', '$fecha')";

if (mysqli_query($conexion, $query)) {
    echo "Donación guardada con éxito.";
    // podés redirigir a otra página si querés
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>
