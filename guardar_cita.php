<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_cliente'];
    $correo = $_POST['email'];
    $mascota = $_POST['mascota'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Usar sentencia preparada (más seguro)
    $stmt = $conn->prepare("INSERT INTO citas (nombre_cliente, email, mascota, fecha, hora, motivo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $correo, $mascota, $fecha, $hora, $motivo);

    if ($stmt->execute()) {
        header("Location: confirmacion.php?nombre_cliente=$nombre&email=$correo&mascota=$mascota&fecha=$fecha&hora=$hora&motivo=$motivo");
        exit();
    } else {
        echo "❌ Error al guardar la cita: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
