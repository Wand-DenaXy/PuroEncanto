<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "puroencanto";

// Criar ligação
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar ligação
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT Mes, Rendimentos, Gastos 
        FROM ResumoFinanceiro 
        WHERE Ano = 2025 
        ORDER BY Mes";
$result = $conn->query($sql);

$meses = [];
$rendimentos = [];
$gastos = [];

while ($row = $result->fetch_assoc()) {
    $meses[] = date("M", mktime(0, 0, 0, $row['Mes'], 1));
    $rendimentos[] = (float)$row['Rendimentos'];
    $gastos[] = (float)$row['Gastos'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById("chart-line").getContext("2d");
new Chart(ctx, {
    type: "line",
    data: {
        labels: <?php echo json_encode($meses); ?>,
        datasets: [
            {
                label: "Gastos",
                borderColor: "#cb0c9f",
                data: <?php echo json_encode($gastos); ?>,
                fill: false
            },
            {
                label: "Rendimentos",
                borderColor: "#3A416F",
                data: <?php echo json_encode($rendimentos); ?>,
                fill: false
            }
        ]
    }
});
</script>
<?php

$sql = "SELECT descricao, total_vendas FROM VendasServicos";
$result = $conn->query($sql);

$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['descricao'];
    $values[] = (float)$row['total_vendas'];
}
?>

<div class="card p-3" style="height: 450px; width: 750px;">
    <h6>Serviços - Total de vendas</h6>
    <div style="height: 300px;">
        <canvas id="chartjs-dashboard-pie"></canvas>
    </div>
</div>

<script>
var ctxPie = document.getElementById("chartjs-dashboard-pie").getContext("2d");
new Chart(ctxPie, {
    type: "pie",
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            data: <?php echo json_encode($values); ?>,
            backgroundColor: ["#0d6efd", "#ffc107", "#dc3545", "#198754", "#6f42c1"],
            borderWidth: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: true }
        }
    }
});
</script>
  die("Connection failed: " . $conn->connect_error);
}

