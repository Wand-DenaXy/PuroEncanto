


<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "puroencanto";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erro na ligação: " . $conn->connect_error);
}

$sql = "SELECT Mes, Rendimentos, Gastos 
        FROM ResumoFinanceiro 
        WHERE Ano = 2025 
        ORDER BY Mes";
$result = $conn->query($sql);

$meses = [];
$rendimentos = [];
$gastos = [];

while($row = $result->fetch_assoc()) {
    $meses[] = date("M", mktime(0, 0, 0, $row['Mes'], 1));
    $rendimentos[] = (float)$row['Rendimentos'];
    $gastos[] = (float)$row['Gastos'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puro Encanto - Dashboard</title>
    <link rel="stylesheet" href="asset/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="asset/js/lib/datatables.js">
</head>
<body>

<div class="sidebar">
    <div class="logo">Puro Encanto</div>
    <a href="dashboard.php"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="funcionario.html"><i class="bi bi-people"></i> Funcionário</a>
    <a href="#"><i class="bi bi-journal"></i> Balancete</a>
    <a href="#"><i class="bi bi-box-arrow-in-right"></i>Perfil</a>
</div>

<div class="content">

<div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Signups</h6>
                <h4>153</h4>
                <canvas id="chart1" height="80"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Novos Visitantes</h6>
                <h4>34</h4>
                <canvas id="chart2" height="80"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Monthly Total Order</h6>
                <h4>71,503</h4>
                <canvas id="chart3" height="80"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Revenue This Year</h6>
                <h4>9,503</h4>
                <canvas id="chart4" height="80"></canvas>
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-md-9">
            <div class="card p-3 h-100">
            <h5>Importar Dados (CSV)</h5>
            <input type="file" class="form-control mb-3">
            <button class="btn btn-success">Importar Sessões</button>
        </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3" >
                <h6>Visitantes Online</h6>
                <h4 id="visitantesOnline">0</h4>
            </div>
            <div class="card p-3">
                <h6>Total de Visitantes</h6>
                <h4 id="totalVisitantes">0</h4>
            </div>
        </div>
        
<br>
    <br>
   <div class="row mb-4">
    <br>
    <div class="col-md-6">
        <br>
        <div class="card p-3 h-100">
            <div class="card draggable">
                <div class="card-header pb-0">
                    <h6>Gastos vs Rendimentos</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">Detalhes</span> de 2025
                    </p>
                </div>
                <div class="card-body p-3">
                    <div style="height: 350px;">
                        <canvas id="chart-line" class="chart-canvas chart-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico Total de vendas de serviços -->
    <div class="col-md-6">
        <br>
    <div class="card">
        <div class="card-body">
          
    
            <?php include 'contador.php'; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    const meses = <?php echo json_encode($meses); ?>;
    const gastos = <?php echo json_encode($gastos); ?>;
    const rendimentos = <?php echo json_encode($rendimentos); ?>;

    const ctxLine = document.getElementById("chart-line").getContext("2d");
    new Chart(ctxLine, {
        type: "line",
        data: {
            labels: meses,
            datasets: [
                {
                    label: "Gastos",
                    borderColor: "#cb0c9f",
                    backgroundColor: "rgba(203,12,159,0.2)",
                    data: gastos,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: "Rendimentos",
                    borderColor: "#3A416F",
                    backgroundColor: "rgba(20,23,39,0.2)",
                    data: rendimentos,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true }
            },
            interaction: {
                intersect: false,
                mode: "index"
            }
        }
    });
</script>

<script>
function atualizarVisitantes() {
    fetch('visitantes.php')
        .then(res => res.json())
        .then(data => {
            document.getElementById('visitantesOnline').textContent = data.online;
            document.getElementById('totalVisitantes').textContent = data.total;
        });
}

setInterval(atualizarVisitantes, 5000);
atualizarVisitantes();
</script>

<script>
    const ctx1 = document.getElementById('chart1').getContext('2d');
    new Chart(ctx1, { type: 'bar', data: { labels: ['', '', '', '', '', '', ''], datasets: [{ data: [5,6,4,7,8,5,4], backgroundColor: '#4e73df' }] }, options: { plugins: { legend: { display: false }}, scales: { x: { display: false }, y: { display: false }}} });

    const ctx2 = document.getElementById('chart2').getContext('2d');
    new Chart(ctx2, { type: 'line', data: { labels: ['', '', '', '', '', '', ''], datasets: [{ data: [3,4,3,5,6,4,3], borderColor: '#f6c23e', backgroundColor: 'transparent' }, { data: [2,3,4,4,5,3,4], borderColor: '#36b9cc', backgroundColor: 'transparent' }] }, options: { plugins: { legend: { display: false }}, scales: { x: { display: false }, y: { display: false }}} });

    const ctx3 = document.getElementById('chart3').getContext('2d');
    new Chart(ctx3, { type: 'line', data: { labels: ['', '', '', '', '', '', ''], datasets: [{ data: [4,6,5,7,5,6,4], backgroundColor: 'rgba(78,115,223,0.5)', borderColor: '#4e73df', fill: true }] }, options: { plugins: { legend: { display: false }}, scales: { x: { display: false }, y: { display: false }}} });

    const ctx4 = document.getElementById('chart4').getContext('2d');
    new Chart(ctx4, { type: 'line', data: { labels: ['', '', '', '', '', '', ''], datasets: [{ data: [2,3,2,4,3,4,2], backgroundColor: 'rgba(28,200,138,0.3)', borderColor: '#1cc88a', fill: true }] }, options: { plugins: { legend: { display: false }}, scales: { x: { display: false }, y: { display: false }}} });
</script>

</body>
</html>
