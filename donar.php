<?php 
include 'components/connect.php';
session_start();
$user_id = $_SESSION['user_id'] ?? null;
include 'components/user_header.php';

$mensaje_exito = '';
if (isset($_GET['exito']) && $_GET['exito'] == 1) {
   $mensaje_exito = '¡Gracias por tu donación! Verificaremos la información y nos pondremos en contacto contigo pronto.';
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Doná Tecnología - TechForAll</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/donar.css">
   <style>
      .oculto { display: none; }
      .form-section { animation: fadeIn 0.6s ease; }
      @keyframes fadeIn {
         from { opacity: 0; transform: translateY(20px); }
         to { opacity: 1; transform: translateY(0); }
      }
   </style>
</head>
<body>

<section class="about">
   <div class="row">
      <div class="image">
         <img src="images/donar.png" alt="Donar Tecnología">
      </div>
      <div class="content">
         <h3>Un pequeño gesto, un gran impacto</h3>
         <p>En <strong>TechForAll</strong>, transformamos tus dispositivos en oportunidades. Cada computadora o dispositivo tecnológico que ya no usás puede marcar la diferencia en una escuela, un colegio o un centro comunitario. 🌍💻</p>
         <ul>
            <li>● Reacondicionamos con amor y dedicación.</li>
            <li>● Apoyamos a instituciones educativas y sociales.</li>
            <li>● Ayudamos al planeta evitando residuos electrónicos.</li>
         </ul>
         <a href="#form-donacion" class="boton">Donar tecnología</a>
         <button id="btn-postulacion" class="boton secundario">Registrar mi comunidad</button>
      </div>
   </div>
</section>
<?php if (!empty($mensaje_exito)): ?>
   <div style="background-color: #d4edda; color:rgb(67, 178, 93); padding: 15px; border-radius: 5px; margin: 20px auto; width: 90%; max-width: 700px; text-align: center; border: 1px solid #c3e6cb;">
      <?= $mensaje_exito ?>
   </div>
<?php endif; ?>

<section id="form-donacion" class="form-section">
   <h2>Formulario de Donación</h2>
   <form class="formulario" action="procesar_donacion.php" method="post" enctype="multipart/form-data">
      <label for="nombre">Nombre y Apellido:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required>

      <label for="tipo">¿Qué deseas donar?</label>
      <select id="tipo" name="tipo" required>
         <option value="">Selecciona un tipo</option>
         <option value="Notebook">Notebook</option>
         <option value="PC">PC</option>
         <option value="Tablet">Tablet</option>
         <option value="Impresora">Impresora</option>
         <option value="Otro">Otro</option>
      </select>

      <label for="mensaje">Mensaje adicional:</label>
      <textarea id="mensaje" name="mensaje" rows="4"></textarea>

      <label for="imagen">Foto del producto (obligatorio):</label>
      <input type="file" name="imagen" id="imagen" accept="image/*" required>

      <button type="submit" class="boton">Enviar Donación</button>
   </form>
</section>

<section id="form-postulacion" class="form-section oculto">
   <h2>Postula tu Comunidad</h2>
   <form class="formulario" action="procesar_postulacion.php" method="post">
      <label for="nombre">Nombre completo:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required>

      <label for="numero">Teléfono de contacto:</label>
      <input type="text" id="numero" name="numero" required>

      <label for="producto">¿Qué tipo de tecnología necesitan?</label>
      <input type="text" id="producto" name="producto" required>

      <label for="motivo">¿Por qué necesitan los equipos?</label>
      <textarea id="motivo" name="motivo" rows="4" required></textarea>

      <label for="mensaje">Mensaje adicional (opcional):</label>
      <textarea id="mensaje" name="mensaje" rows="4"></textarea>

      <button type="submit" class="boton">Registrar a mi comunidad</button>
   </form>
</section>

<section class="historias">
   <h2>Historias que Inspiran</h2>
   <div class="grid">
      <div class="card">
         <img src="images/escuela.png" alt="Escuela rural conectada">
         <p><strong>Escuela República del Paraguay</strong><br>Recibieron 10 laptops que hoy utilizan en clases de informática.</p>
      </div>
      <div class="card">
         <img src="images/comunidad.png" alt="Comedor con tecnología">
         <p><strong>Comunidad Sol naciente</strong><br>Instalamos PCs recicladas para tareas escolares y talleres, recibieron teclados, mouse y todos los accesorios.</p>
      </div>
      <div class="card">
         <img src="images/colegio.png" alt="Centro comunitario">
         <p><strong>Colegio Virgen del Rosario</strong><br>Gracias a tu donación, hoy cuentan con Notebooks y acceso digital.</p>
      </div>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script>
   document.getElementById("btn-postulacion").addEventListener("click", function () {
      const form = document.getElementById("form-postulacion");
      form.classList.toggle("oculto");
      form.scrollIntoView({ behavior: "smooth" });
   });
</script>
</body>
</html>
