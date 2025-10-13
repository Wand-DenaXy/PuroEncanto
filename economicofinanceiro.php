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
        <a href="dashboard.php" ><i class="bi bi-grid"></i> Dashboard</a>
        <a href="gastoserendimentos.html"><i class="bi bi-people"></i> Gastos e Rendimentos</a>
        <a href="servicosadmin.html"><i class="bi bi-grid"></i>Vendas</a>
        <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
        <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
        <a href="funcionario.html"><i class="bi bi-people"></i> Funcionario</a>
        <a href="calendario.html"><i class="bi bi-people"></i> Calendario</a>
         <a href="economicofinanceiro.php" class="active"><i class="bi bi-people"></i> Económico-Financeiro </a>
          <a href="financas.php"><i class="bi bi-people"></i> Finanças</a>
        <a href="perfilAdmin.php"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>

        <div class="time" id="time"></div>
    </div>
    </body>
</html>