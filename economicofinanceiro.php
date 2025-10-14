<?php
require_once 'asset/model/connection2.php';

// Função para obter valor de uma descrição específica
function getValor($conn, $descricao) {
    $sql = "SELECT valor FROM econ_financeiro WHERE descricao = '$descricao' AND ano = 2025";
    $res = $conn->query($sql);
    if ($row = $res->fetch_assoc()) return $row['valor'];
    return 0;
}

// Buscar valores do PDF
$ativoTangiveis      = getValor($conn, 'Ativos fixos tangíveis');
$ativoIntangiveis    = getValor($conn, 'Ativos intangíveis');
$inventarios         = getValor($conn, 'Inventários');
$estadoPublicos      = getValor($conn, 'Estado e outros entes públicos');
$diferimentos        = getValor($conn, 'Diferimentos');
$caixaDepositos      = getValor($conn, 'Caixa e depósitos bancários');
$capitalRealizado    = getValor($conn, 'Capital realizado');
$resultadoLiquido    = getValor($conn, 'Resultado líquido do período');
$outrasContasPagar   = getValor($conn, 'Outras contas a pagar');

$totalAtivoNaoCorrente = $ativoTangiveis + $ativoIntangiveis;
$totalAtivoCorrente = $inventarios + $estadoPublicos + $diferimentos + $caixaDepositos;
$totalAtivo = $totalAtivoNaoCorrente + $totalAtivoCorrente;
$totalCapitalProprio = $capitalRealizado + $resultadoLiquido;
$totalPassivo = $outrasContasPagar;
$totalCapitalProprioPassivo = $totalCapitalProprio + $totalPassivo;


$lg = getValor($conn, 'Liquidez Geral');
$lr = getValor($conn, 'Liquidez Reduzida');
$li = getValor($conn, 'Liquidez Imediata');

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Económico-Financeiro</title>
    <link rel="stylesheet" href="asset/css/dashboard.css">
    <link rel="stylesheet" href="asset/css/lib/bootstrap.css">
    <style>
        h2 { margin-top: 30px; }
        table { width: 80%; background: white; margin-bottom: 20px; }
        th, td { padding: 8px; }
        th { background-color: #f2f2f2; }
        .total-row { font-weight: bold; background-color: #f9f9f9; }
    </style>
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

    <div class="content" style="margin-left:250px; padding: 20px;">
        <h1>Económico-Financeiro - 2025</h1>

        <!-- ================= Ativo ================= -->

        <table class="table table-bordered">
            <tr><td>Ativos fixos tangíveis</td><td><?= number_format($ativoTangiveis, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Ativos intangíveis</td><td><?= number_format($ativoIntangiveis, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>SOMA</strong></td><td><?= number_format($totalAtivoNaoCorrente, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Inventários</td><td><?= number_format($inventarios, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Estado e outros entes públicos</td><td><?= number_format($estadoPublicos, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Diferimentos</td><td><?= number_format($diferimentos, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Caixa e depósitos bancários</td><td><?= number_format($caixaDepositos, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>SOMA</strong></td><td><?= number_format($totalAtivoCorrente, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>TOTAL DO ATIVO</strong></td><td><?= number_format($totalAtivo, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Capital realizado</td><td><?= number_format($capitalRealizado, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Resultado líquido do período</td><td><?= number_format($resultadoLiquido, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>TOTAL DO CAPITAL PRÓPRIO</strong></td><td><?= number_format($totalCapitalProprio, 2, ',', ' ') ?> €</td></tr>
            <tr><td>Outras contas a pagar</td><td><?= number_format($outrasContasPagar, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>TOTAL DO PASSIVO</strong></td><td><?= number_format($totalPassivo, 2, ',', ' ') ?> €</td></tr>
            <tr class="total-row"><td><strong>TOTAL DO CAPITAL PRÓPRIO E DO PASSIVO</strong></td><td><?= number_format($totalCapitalProprioPassivo, 2, ',', ' ') ?> €</td></tr>
        </table>

        <!-- ================= Rácios ================= -->
        <h2>Rácios de Liquidez</h2>
        <table class="table table-bordered">
            <tr><td>Liquidez Geral = Ativo Corrente / Passivo Corrente</td><td><?= number_format($lg, 6, ',', ' ') ?></td></tr>
            <tr><td>Liquidez Reduzida = (Ativo Corrente - Inventários) / Passivo Corrente</td><td><?= number_format($lr, 6, ',', ' ') ?></td></tr>
            <tr><td>Liquidez Imediata = Disponibilidades / Passivo Corrente</td><td><?= number_format($li, 6, ',', ' ') ?></td></tr>
        </table>
    </div>
</body>
</html>
