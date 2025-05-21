<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../components/connect.php';
?>

<style>
    .vendedor-header {
        background: linear-gradient(90deg, #1f1f2e, #2a2a40);
        color: white;
        padding: 20px 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }

    .vendedor-header .contenedor {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .vendedor-header h2 {
        margin: 0 0 15px 0;
        font-size: 2.5rem;
        font-weight: 600;
        color: #4623e3;
    }

    .vendedor-header .navbar {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
    }

    .vendedor-header .navbar a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.2rem;
        transition: color 0.3s;
        display: flex;
        align-items: center;
    }

    .vendedor-header .navbar a i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    .vendedor-header .navbar a:hover {
        color: #a26bff;
        text-decoration: underline;
    }
</style>

<header class="vendedor-header">
    <div class="contenedor">
        <h2>Panel del Vendedor</h2>
        <nav class="navbar">
            <a href="vendedor_panel.php"><i class="fas fa-home"></i> Inicio</a>
            <a href="agregar_productos.php"><i class="fas fa-plus-circle"></i> Agregar Producto</a>
            <a href="mis_productos.php"><i class="fas fa-boxes"></i> Mis Productos</a>
            <a href="editar_productos.php"><i class="fas fa-edit"></i> Editar Producto</a>
            <a href="eliminar_productos.php"><i class="fas fa-trash-alt"></i> Eliminar Producto</a>
            <a href="perfil_vendedor.php"><i class="fas fa-user-circle"></i> Mi Perfil</a>
            <a href="../vendedor/home.php"><i class="fas fa-globe"></i> Home Web</a>
            <a href="logout.php" onclick="return confirm('¿Cerrar sesión?');"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </nav>
    </div>
</header>
