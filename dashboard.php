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
$sqlFornecedores = "SELECT COUNT(*) AS totalFornecedores FROM Fornecedores";
$resultFornecedores = $conn->query($sqlFornecedores);

if ($row = $resultFornecedores->fetch_assoc()) {
$totalFornecedores = $row['totalFornecedores'];
}
$sqlClientes = "SELECT COUNT(*) AS totalClientes FROM Clientes;";
$resultClientes = $conn->query($sqlClientes);

if ($row = $resultClientes->fetch_assoc()) {
$totalClientes = $row['totalClientes'];
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
    <link rel="stylesheet" href="asset/css/lib/datatables.css">
    <link rel="stylesheet" href="asset/css/lib/select2.css">
    <link rel="stylesheet" href="asset/css/lib/bootstrap.css">


    <script src="asset/js/lib/jquery.js"></script>
    <script src="asset/js/lib/bootstrap.js"></script>
    <script src="asset/js/lib/datatables.js"></script>
    <script src="asset/js/lib/select2.js"></script>
    <script src="asset/js/lib/sweatalert.js"></script>
    <link rel="stylesheet" href="asset/js/lib/datatables.js">
</head>

<body>

    <div class="sidebar">
        <div class="logo"><img src="images/logos/PURO ENCANTO LOGO.png" alt="">
            <p class="logotitulo">Puro Encanto</p>
        </div>
        <a href="dashboard.php" class="active"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="servicosadmin.html"><i class="bi bi-grid"></i>Serviços</a>
        <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
        <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
        <a href="#"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>
    </div>
    <div class="content">


        <div class="content">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Equipamentos</h6>
                        <h4>153</h4>
                        <canvas id="chart1" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Gastos vs Rendimentos</h6>
                        <h4><br></h4>
                        <canvas id="chart2" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Clientes</h6>
                        <h4><?php echo $totalClientes; ?></h4>
                        <canvas id="chart3" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Fornecedores</h6>
                        <h4><?php echo $totalFornecedores; ?></h4>
                        <canvas id="chart4" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="grafico4">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="graficoRendimentos4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            
            <!-- <div class="col-md-6">
                <br>
                <div class="card">
                    <div class="card-body">


                        <?php include 'contador.php'; ?>
                    </div>
                </div>
            </div>
        </div> -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
        const ctx1 = document.getElementById('chart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['', '', '', '', '', '', ''],
                datasets: [{
                    data: [5, 6, 4, 7, 8, 5, 4],
                    backgroundColor: '#4e73df'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        display: false
                    }
                }
            }
        });


        const meses = <?php echo json_encode($meses); ?>;
        const gastos = <?php echo json_encode($gastos); ?>;
        const rendimentos = <?php echo json_encode($rendimentos); ?>;
        const ctx2 = document.getElementById('chart2').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    data: gastos,
                    borderColor: '#f6c23e',
                    backgroundColor: 'transparent'
                }, {
                    data: rendimentos,
                    borderColor: '#36b9cc',
                    backgroundColor: 'transparent'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        display: false
                    }
                }
            }
        });
        </script>
        <script src="asset/js/graficos.js"></script>
        <script src="asset/js/dashboard.js"></script>
        <script>
        $(document).ready(function() {
            GraficoServico();
            GraficoServicoDashboard();
            getFornecedoresTop();
            getClientesDashboard();
        });
        </script>
</body>

</html>