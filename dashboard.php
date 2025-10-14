<?php


require_once 'asset/model/connection2.php';


$meses = [];
$rendimentos = [];
$gastos = [];

$sqlFornecedores = "SELECT COUNT(*) AS totalFornecedores FROM Fornecedores";
$resultFornecedores = $conn->query($sqlFornecedores);

if ($row = $resultFornecedores->fetch_assoc()) {
$totalFornecedores = $row['totalFornecedores'];
}

$sqlGastos = "SELECT SUM(gastos.valor) As Gastos from gastos;";
$resultGastos = $conn->query($sqlGastos);

if ($row = $resultGastos->fetch_assoc()) {
$totalGastos = $row['Gastos'];
}

$sqlRendimentos = "SELECT SUM(Rendimento.valor) As Rendimento from Rendimento;";
$resultRendimentos = $conn->query($sqlRendimentos);

if ($row = $resultRendimentos->fetch_assoc()) {
$totalRendimentos = $row['Rendimento'];
}

$sqlTotalAtivo = "SELECT * FROM TotalAtivo ORDER BY data DESC LIMIT 1";
$resultTotalAtivo = $conn->query($sqlTotalAtivo);

if ($row = $resultTotalAtivo->fetch_assoc()) {
    $totalTotalAtivo = $row['valor'];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="asset/js/lib/datatables.js">
</head>

<body>

    <div class="sidebar">
        <a href="index.php" style="background-color: transparent;border-left: none;">
            <div class="logo"><img src="images/logos/PURO ENCANTO LOGO.png" alt="">
                <p class="logotitulo">Puro Encanto</p>
            </div>
        </a>
        <a href="dashboard.php" class="active"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="gastoserendimentos.html"><i class="bi bi-people"></i> Gastos e Rendimentos</a>
        <a href="servicosadmin.html"><i class="bi bi-grid"></i>Vendas</a>
        <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
        <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
        <a href="funcionario.html"><i class="bi bi-people"></i> Funcionario</a>
        <a href="calendario.html"><i class="bi bi-people"></i> Calendario</a>
         <a href="economicofinanceiro.php"><i class="bi bi-people"></i> Económico-Financeiro </a>
          <a href="financas.php"><i class="bi bi-people"></i> Finanças</a>
        <a href="perfilAdmin.php"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>

        <div class="time" id="time"></div>
    </div>
    <div class="content">


        <div class="content">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Total Ativo</h6>
                        <h4 class="TotalAtivoCor"><?php echo $totalTotalAtivo; ?>€</h4>
                        <canvas id="TotalAtivo" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Redimentos</h6>
                        <h4 class="TotalRendimentosCor"><?php echo $totalRendimentos; ?>€</h4>
                        <canvas id="TotalRendimentosGrafico" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Gastos</h6>
                        <h4 class="TotalGastosCor"><?php echo $totalGastos; ?>€</h4>
                        <canvas id="TotalGastosGrafico" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Receita</h6>
                        <h4 class="TotalReceitaCor"><?php echo $saldo; ?>€</h4>
                         <canvas id="TotalLucro" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="navbar navbar-expand-lg navbar-light bg-light" id="acordionID">
                            <div class="btn-group" role="group" aria-label="Botões de gráficos">
                                <button class="btn btn-outline-primary active" id="btnGrafico1"
                                    data-bs-toggle="button">Balancete</button>
                                <button class="btn btn-outline-primary" id="btnGrafico2" data-bs-toggle="button">Serviço
                                    Mais
                                    Utilizados</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div id="graficoBalancete">
                                        <h5>Balancete</h5>
                                        <canvas id="graficoBalanceteDonut"></canvas>
                                    </div>
                                    <div id="graficoVendidos" style="display: none;">
                                        <h5>Serviços mais vendidos
                                        </h5>
                                        <canvas id="GraficoSomaServico"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div>

                <div class=" container mt-1">
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
                                        <th scope="col">Data</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Aceitar</th>
                                        <th scope="col">Recusar</th>
                                    </tr>
                                </thead>
                                <tbody id="listagemReceber">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script src="asset/js/graficos.js"></script>
            <script src="asset/js/dashboard.js"></script>
            <script>
            $(document).ready(function() {
                carregarDashboard();
            });
            </script>
</body>

</html>