<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<header class="vendedor-header">
    <div class="contenedor">
        <h2>Panel del Vendedor</h2>
        <nav class="navbar">
            <a href="vendedor_panel.php">Inicio</a>
            <a href="agregar_productos.php">Agregar Producto</a>
            <a href="mis_productos.php">Mis Productos</a>
            <a href="logout.php" onclick="return confirm('¿Cerrar sesión?');">Cerrar sesión</a>
        </nav>
    </div>
</header>

<style>
.vendedor-header {
    background: #333;
    color: white;
    padding: 10px 20px;
}

.vendedor-header .contenedor {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.vendedor-header h2 {
    margin: 0;
}

.vendedor-header .navbar a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
    font-weight: bold;
}

.vendedor-header .navbar a:hover {
    text-decoration: underline;
}
</style>
