<?php
// Ruta del servidor Node.js
$apiUrl = "http://localhost:3000/estadisticas";

// Obtener datos desde Node.js
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// A) CITAS POR DÍA
$porDiaLabels = array_column($data["porDia"], "_id");
$porDiaValues = array_column($data["porDia"], "total");

// B) CITAS POR MES
$porMesLabels = array_column($data["porMes"], "_id");
$porMesValues = array_column($data["porMes"], "total");

// C) MOTIVOS
$motivoLabels = array_column($data["motivos"], "_id");
$motivoValues = array_column($data["motivos"], "total");

// D) MASCOTAS
$mascotaLabels = array_column($data["mascotas"], "_id");
$mascotaValues = array_column($data["mascotas"], "total");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>📊 Estadísticas VetCare</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: #0d1117;
    color: white;
    font-family: Arial;
    padding: 20px;
}
h1, h2 {
    text-align: center;
}
.card {
    background: #161b22;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 0 10px #000;
}
canvas {
    background: #fff;
    border-radius: 10px;
    padding: 10px;
}
.btn {
    background: #238636;
    padding: 10px 20px;
    color: white;
    border-radius: 8px;
    display: inline-block;
    text-decoration: none;
    margin-bottom: 20px;
}
.btn:hover {
    background: #2ea043;
}
</style>

</head>
<body>

<a href="index.html" class="btn">⬅ Volver</a>

<h1>📊 Estadísticas del Sistema de Citas – VetCare</h1>

<!-- A) CITAS POR DÍA -->
<div class="card">
    <h2>A) Citas por Día</h2>
    <canvas id="graficoDia"></canvas>
</div>

<!-- B) CITAS POR MES -->
<div class="card">
    <h2>B) Citas por Mes</h2>
    <canvas id="graficoMes"></canvas>
</div>

<!-- C) MOTIVOS -->
<div class="card">
    <h2>C) Citas por Motivo</h2>
    <canvas id="graficoMotivo"></canvas>
</div>

<!-- D) MASCOTAS -->
<div class="card">
    <h2>D) Citas por Mascota</h2>
    <canvas id="graficoMascota"></canvas>
</div>

<script>
const porDiaLabels = <?php echo json_encode($porDiaLabels); ?>;
const porDiaValues = <?php echo json_encode($porDiaValues); ?>;

const porMesLabels = <?php echo json_encode($porMesLabels); ?>;
const porMesValues = <?php echo json_encode($porMesValues); ?>;

const motivoLabels = <?php echo json_encode($motivoLabels); ?>;
const motivoValues = <?php echo json_encode($motivoValues); ?>;

const mascotaLabels = <?php echo json_encode($mascotaLabels); ?>;
const mascotaValues = <?php echo json_encode($mascotaValues); ?>;


// -----------------------------------------------------
// A) GRAFICO POR DÍA
// -----------------------------------------------------
new Chart(document.getElementById('graficoDia'), {
    type: 'line',
    data: {
        labels: porDiaLabels,
        datasets: [{
            label: 'Citas por Día',
            data: porDiaValues,
            borderColor: 'cyan',
            backgroundColor: 'rgba(0,255,255,0.2)',
            borderWidth: 2
        }]
    }
});

// -----------------------------------------------------
// B) GRAFICO POR MES
// -----------------------------------------------------
new Chart(document.getElementById('graficoMes'), {
    type: 'bar',
    data: {
        labels: porMesLabels,
        datasets: [{
            label: 'Citas por Mes',
            data: porMesValues,
            backgroundColor: 'rgba(0,123,255,0.6)',
            borderWidth: 2
        }]
    }
});

// -----------------------------------------------------
// C) MOTIVOS
// -----------------------------------------------------
new Chart(document.getElementById('graficoMotivo'), {
    type: 'pie',
    data: {
        labels: motivoLabels,
        datasets: [{
            data: motivoValues
        }]
    }
});

// -----------------------------------------------------
// D) MASCOTAS
// -----------------------------------------------------
new Chart(document.getElementById('graficoMascota'), {
    type: 'doughnut',
    data: {
        labels: mascotaLabels,
        datasets: [{
            data: mascotaValues
        }]
    }
});
</script>

</body>
</html>
