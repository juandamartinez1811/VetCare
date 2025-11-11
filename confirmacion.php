<?php
$nombre = $_GET['nombre_cliente'];
$correo = $_GET['email'];
$mascota = $_GET['mascota'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$motivo = $_GET['motivo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de Cita - VetCare Solutions</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <img src="logo.jpg" alt="VetCare Logo" class="logo">
    <h1>VetCare Solutions</h1>
  </header>

  <section>
    <h2>✅ Cita Agendada Exitosamente</h2>
    <p><strong>Nombre del dueño:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($correo) ?></p>
    <p><strong>Mascota:</strong> <?= htmlspecialchars($mascota) ?></p>
    <p><strong>Fecha:</strong> <?= htmlspecialchars($fecha) ?></p>
    <p><strong>Hora:</strong> <?= htmlspecialchars($hora) ?></p>
    <p><strong>Motivo:</strong> <?= htmlspecialchars($motivo) ?></p>

    <a href="index.html">Volver al inicio</a>
  </section>

  <footer>
    <p>&copy; 2025 VetCare Solutions. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
