<?php
include('conexion.php');

$sql = "SELECT * FROM citas ORDER BY fecha, hora";
$res = $conn->query($sql);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Listado de citas - VetCare</title>
  <link rel="stylesheet" href="styles.css"> <!-- Usa el CSS global -->
</head>
<body>
  <header>
    <h1>Citas registradas</h1>
  </header>
  <main>
    <?php if (!$res) { ?>
      <p class="no-data">❌ Error en la consulta: <?= $conn->error ?></p>
    <?php exit; } ?>

    <?php if ($res->num_rows == 0) { ?>
      <p class="no-data">⚠️ No hay citas registradas.</p>
    <?php } else { ?>
      <table>
        <tr>
          <th>Cliente</th>
          <th>Email</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Motivo</th>
        </tr>
        <?php while($row = $res->fetch_assoc()) { ?>
        <tr>
          <td><?= htmlspecialchars($row['nombre_cliente'] ?? '—') ?></td>
          <td><?= htmlspecialchars($row['email'] ?? '—') ?></td>
          <td><?= htmlspecialchars($row['fecha'] ?? '—') ?></td>
          <td><?= htmlspecialchars($row['hora'] ?? '—') ?></td>
          <td><?= htmlspecialchars($row['motivo'] ?? '—') ?></td>
        </tr>
        <?php } ?>
      </table>
    <?php } ?>

    <a href="citas.html" class="btn">➕ Agendar nueva cita</a>
  </main>
</body>
</html>
