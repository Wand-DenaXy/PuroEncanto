<?php
require_once 'asset/model/connection2.php';

$meses = [];
$rendimentos = [];
$gastos = [];

$sqlFornecedores = "SELECT COUNT(*) AS totalFornecedores FROM Fornecedores";
$resultFornecedores = $conn->query($sqlFornecedores);
$totalFornecedores = 0;
if ($row = $resultFornecedores->fetch_assoc()) {
    $totalFornecedores = $row['totalFornecedores'];
}

$sqlGastos = "SELECT SUM(gastos.valor) AS Gastos FROM gastos";
$resultGastos = $conn->query($sqlGastos);
$totalGastos = 0;
if ($row = $resultGastos->fetch_assoc()) {
    $totalGastos = $row['Gastos'] ?? 0;
}

$sqlRendimentos = "SELECT SUM(Rendimento.valor) AS Rendimento FROM Rendimento";
$resultRendimentos = $conn->query($sqlRendimentos);
$totalRendimentos = 0;
if ($row = $resultRendimentos->fetch_assoc()) {
    $totalRendimentos = $row['Rendimento'] ?? 0;
}

$sqlTotalAtivo = "SELECT * FROM TotalAtivo ORDER BY data DESC LIMIT 1";
$resultTotalAtivo = $conn->query($sqlTotalAtivo);
$totalTotalAtivo = 0;
if ($row = $resultTotalAtivo->fetch_assoc()) {
    $totalTotalAtivo = $row['valor'] ?? 0;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <script src="asset/js/lib/jquery.js"></script>
    <script src="asset/js/lib/bootstrap.js"></script>
    <script src="asset/js/lib/datatables.js"></script>
    <script src="asset/js/lib/select2.js"></script>
    <script src="asset/js/lib/sweatalert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fc;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #4e73df 0%, #224abe 100%);
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .logotitulo {
            color: white;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }

        .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: white;
            font-weight: 600;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .time {
            padding: 20px;
            color: rgba(255,255,255,0.7);
            text-align: center;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header h2 {
            color: #5a5c69;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
        }

        .stat-card.success::before { background: var(--success-color); }
        .stat-card.danger::before { background: var(--danger-color); }
        .stat-card.warning::before { background: var(--warning-color); }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-header h6 {
            color: #858796;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-card.primary .stat-icon { background: rgba(78,115,223,0.1); color: var(--primary-color); }
        .stat-card.success .stat-icon { background: rgba(28,200,138,0.1); color: var(--success-color); }
        .stat-card.danger .stat-icon { background: rgba(231,74,59,0.1); color: var(--danger-color); }
        .stat-card.warning .stat-icon { background: rgba(246,194,62,0.1); color: var(--warning-color); }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #5a5c69;
            margin-bottom: 10px;
        }

        .stat-card.success .stat-value { color: var(--success-color); }
        .stat-card.danger .stat-value { color: var(--danger-color); }
        .stat-card.warning .stat-value { color: var(--warning-color); }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h5 {
            color: #5a5c69;
            font-weight: 700;
            margin: 0;
        }

        .btn-group .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-group .btn:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .btn-group .btn:last-child {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .table-card h5 {
            color: #5a5c69;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fc;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid #e3e6f0;
            color: #858796;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #5a5c69;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fc;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-sm:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .content {
                margin-left: 0;
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(78,115,223,.3);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="index.php" style="background-color: transparent;border-left: none;">
            <div class="logo">
                <img src="images/logos/PURO ENCANTO LOGO.png" alt="Puro Encanto">
                <p class="logotitulo">Puro Encanto</p>
            </div>
        </a>
        <a href="dashboard.php" class="active">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="gastoserendimentos.html">
            <i class="bi bi-cash-stack"></i> Gastos e Rendimentos
        </a>
        <a href="servicosadmin.html">
            <i class="bi bi-cart-fill"></i> Vendas
        </a>
        <a href="fornecedores.html">
            <i class="bi bi-truck"></i> Fornecedores
        </a>
        <a href="clientes.html">
            <i class="bi bi-people-fill"></i> Clientes
        </a>
        <a href="funcionario.html">
            <i class="bi bi-person-badge-fill"></i> Funcionários
        </a>
        <a href="calendario.html">
            <i class="bi bi-calendar3"></i> Calendário
        </a>
        <a href="economicofinanceiro.php">
            <i class="bi bi-graph-up-arrow"></i> Económico-Financeiro
        </a>
        <a href="financas.php">
            <i class="bi bi-wallet2"></i> Finanças
        </a>
        <a href="perfilAdmin.php">
            <i class="bi bi-person-circle"></i> Perfil
        </a>
        <div class="time" id="time"></div>
    </div>

    <div class="content">
        <div class="header">
            <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
        </div>

        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-header">
                    <h6>Total Ativo</h6>
                    <div class="stat-icon">
                        <i class="bi bi-bank"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($totalTotalAtivo, 2, ',', '.'); ?>€</div>
                <canvas id="TotalAtivo" height="60"></canvas>
            </div>

            <div class="stat-card success">
                <div class="stat-header">
                    <h6>Rendimentos</h6>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($totalRendimentos, 2, ',', '.'); ?>€</div>
                <canvas id="TotalRendimentosGrafico" height="60"></canvas>
            </div>

            <div class="stat-card danger">
                <div class="stat-header">
                    <h6>Gastos</h6>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($totalGastos, 2, ',', '.'); ?>€</div>
                <canvas id="TotalGastosGrafico" height="60"></canvas>
            </div>

            <div class="stat-card warning">
                <div class="stat-header">
                    <h6>Receita</h6>
                    <div class="stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($saldo, 2, ',', '.'); ?>€</div>
                <canvas id="TotalLucro" height="60"></canvas>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-header">
                <h5>Análise Financeira</h5>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary active" id="btnGrafico1">
                        <i class="bi bi-pie-chart-fill"></i> Balancete
                    </button>
                    <button class="btn btn-outline-primary" id="btnGrafico2">
                        <i class="bi bi-bar-chart-fill"></i> Serviços Mais Utilizados
                    </button>
                </div>
            </div>
            <div id="graficoBalancete">
                <canvas id="graficoBalanceteDonut" height="300"></canvas>
            </div>
            <div id="graficoVendidos" style="display: none;">
                <canvas id="GraficoSomaServico" height="300"></canvas>
            </div>
        </div>

        <div class="table-card">
            <h5><i class="bi bi-exclamation-triangle-fill text-danger"></i> Dívidas a Pagar</h5>
            <table class="table table-striped table-hover" id="tblPagar">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Estado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="listagemPagar">
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="loading-spinner"></div> Carregando...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <h5><i class="bi bi-cash-coin text-success"></i> Dívidas a Receber</h5>
            <table class="table table-striped table-hover" id="tblReceber">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Estado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="listagemReceber">
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="loading-spinner"></div> Carregando...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="asset/js/dashboard.js"></script>
    <script>
        // Atualizar relógio
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('time').textContent = now.toLocaleDateString('pt-PT', options);
        }
        
        updateTime();
        setInterval(updateTime, 60000);

        // Alternar entre gráficos
        $('#btnGrafico1').click(function() {
            $(this).addClass('active').removeClass('btn-outline-primary').addClass('btn-primary');
            $('#btnGrafico2').removeClass('active').removeClass('btn-primary').addClass('btn-outline-primary');
            $('#graficoBalancete').show();
            $('#graficoVendidos').hide();
        });

        $('#btnGrafico2').click(function() {
            $(this).addClass('active').removeClass('btn-outline-primary').addClass('btn-primary');
            $('#btnGrafico1').removeClass('active').removeClass('btn-primary').addClass('btn-outline-primary');
            $('#graficoBalancete').hide();
            $('#graficoVendidos').show();
        });

        // Carregar dashboard ao iniciar
        $(document).ready(function() {
            carregarDashboard();
        });
    </script>
</body>
</html>