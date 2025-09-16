<?php


require_once 'asset/model/connection2.php';


$meses = [];
$rendimentos = [];
$gastos = [];

//
$sqlFornecedores = "SELECT COUNT(*) AS totalFornecedores FROM Fornecedores";
$resultFornecedores = $conn->query($sqlFornecedores);

if ($row = $resultFornecedores->fetch_assoc()) {
$totalFornecedores = $row['totalFornecedores'];
}
//Gastos
$sqlGastos = "SELECT SUM(gastos.valor) As Gastos from gastos;";
$resultGastos = $conn->query($sqlGastos);

if ($row = $resultGastos->fetch_assoc()) {
$totalGastos = $row['Gastos'];
}
//Rendimentos
$sqlRendimentos = "SELECT SUM(Rendimento.valor) As Rendimento from Rendimento;";
$resultRendimentos = $conn->query($sqlRendimentos);

if ($row = $resultRendimentos->fetch_assoc()) {
$totalRendimentos = $row['Rendimento'];
}
$saldo = $totalRendimentos - $totalGastos;
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
        <a href="gastoserendimentos.html"><i class="bi bi-people"></i> Gastos e Rendimentos</a>
        <a href="servicosadmin.html"><i class="bi bi-grid"></i>Vendas</a>
        <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
        <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
        <a href="#"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>

         <div class="time" id="time"></div>
    </div>
    <div class="content">


        <div class="content">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Total Ativo</h6>
                        <h4>153</h4>
                        <canvas id="chart1" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Redimentos</h6>
                        <h4><?php echo $totalRendimentos; ?></h4>
                        <canvas id="chart2" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Gastos</h6>
                        <h4><?php echo -$totalGastos; ?></h4>
                        <canvas id="chart3" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Receita</h6>
                        <h4><?php echo $saldo; ?></h4>
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
        <div>

                <div class="container mt-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Dividas a Pagar</h5>
                                <table class="table table-striped" id="tblPagar">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Pagar</th>
                                            <th scope="col">Recusar</th>
                                            <th scope="col">Informações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listagemPagar">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                        <div class="container mt-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Dividas a Receber</h5>

                                <table class="table table-striped" id="tblReceber">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Receber</th>
                                            <th scope="col">Recusar</th>
                                            <th scope="col">Informações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listagemReceber">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
        </div>

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
        </script>
        <script src="asset/js/graficos.js"></script>
        <script src="asset/js/dashboard.js"></script>
        <script>
        $(document).ready(function() {
            GraficoServico();
            GraficoServicoDashboard();
            GraficoDiferencaDashboard();
            getGastosDashboard();
            getRedimentosDashboard();
            getDividasReceber();
        });
        </script>
</body>

</html>