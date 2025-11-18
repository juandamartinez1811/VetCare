<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_cliente'];
    $correo = $_POST['email'];
    $mascota = $_POST['mascota'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Guardado en MySQL
    $stmt = $conn->prepare("INSERT INTO citas (nombre_cliente, email, mascota, fecha, hora, motivo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $correo, $mascota, $fecha, $hora, $motivo);

    if ($stmt->execute()) {

        // Datos para enviar a Node.js
        $cita = [
            "nombre_cliente" => $nombre,
            "email" => $correo,
            "mascota" => $mascota,
            "fecha" => $fecha,
            "hora" => $hora,
            "motivo" => $motivo
        ];

        // Enviar POST al servidor Node.js
        $jsonData = json_encode($cita);
        $url = "http://localhost:3000/guardar-cita";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        // 🔥 Redirige enviando los datos por GET
        header("Location: confirmacion.php?nombre_cliente=$nombre&email=$correo&mascota=$mascota&fecha=$fecha&hora=$hora&motivo=$motivo");
        exit();

    } else {
        echo "❌ Error al guardar la cita: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
