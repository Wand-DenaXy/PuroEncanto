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
                <div class="stat-value" id="totalAtivoNum"></div>
                <canvas id="TotalAtivo" height="60"></canvas>
            </div>

            <div class="stat-card success">
                <div class="stat-header">
                    <h6>Rendimentos</h6>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-value" id="totalRendimentos"></div>
                <canvas id="TotalRendimentosGrafico" height="60"></canvas>
            </div>

            <div class="stat-card danger">
                <div class="stat-header">
                    <h6>Gastos</h6>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-value" id="TotalGastos"></div>
                <canvas id="TotalGastosGrafico" height="60"></canvas>
            </div>

            <div class="stat-card warning">
                <div class="stat-header">
                    <h6>Receita</h6>
                    <div class="stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                </div>
                <div class="stat-value" id="totalReceita"></div>
                <canvas id="TotalLucro" height="60"></canvas>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-header">
                <h5>Análise Financeira</h5>
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-info active" id="btnGrafico1">
                        <i class="bi bi-pie-chart-fill"></i> Balancete
                    </button>
                    <button class="btn btn-outline-info" id="btnGrafico2">
                        <i class="bi bi-bar-chart-fill"></i> Serviços Mais Utilizados
                    </button>
                </div>
            </div>
            <div id="graficoBalancete">
                <canvas id="graficoBalanceteDonut" height="50"></canvas>
            </div>
            <div id="graficoVendidos" style="display: none;">
                <canvas id="GraficoSomaServico" height="130"></canvas>
            </div>
        </div>

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
</body>

</html>