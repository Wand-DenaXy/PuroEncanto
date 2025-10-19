<?php

session_start();

require_once 'asset/model/connection2.php';

class EconomicoFinanceiro {
    private $conn;
    public $ano;
    
    public function __construct($conn, $ano = 2025) {
        $this->conn = $conn;
        $this->ano = $ano;
    }
    

    private function getDadosBalanco() {
        $stmt = $this->conn->prepare("SELECT * FROM econ_financeiro WHERE ano = ?");
        $stmt->bind_param("i", $this->ano);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $dados = [];
        while ($row = $result->fetch_assoc()) {
            $dados[$row['descricao']] = floatval($row['valor']);
        }
        return $dados;
    }
    

    private function getValor($dados, $descricao) {
        return isset($dados[$descricao]) ? $dados[$descricao] : 0;
    }
    
    public function calcularBalanco() {
        $dados = $this->getDadosBalanco();

        $ativoTangiveis = $this->getValor($dados, 'Ativos fixos tangíveis');
        $ativoIntangiveis = $this->getValor($dados, 'Ativos intangíveis');
        $inventarios = $this->getValor($dados, 'Inventários');
        $estadoPublicos = $this->getValor($dados, 'Estado e outros entes públicos');
        $diferimentos = $this->getValor($dados, 'Diferimentos');
        $caixaDepositos = $this->getValor($dados, 'Caixa e depósitos bancários');
        
        $capitalRealizado = $this->getValor($dados, 'Capital realizado');
        $resultadoLiquido = $this->getValor($dados, 'Resultado líquido do período');
        $outrasContasPagar = $this->getValor($dados, 'Outras contas a pagar');
        
        $totalAtivoNaoCorrente = $ativoTangiveis + $ativoIntangiveis;
        $totalAtivoCorrente = $inventarios + $estadoPublicos + $diferimentos + $caixaDepositos;
        $totalAtivo = $totalAtivoNaoCorrente + $totalAtivoCorrente;
        $totalCapitalProprio = $capitalRealizado + $resultadoLiquido;
        $totalPassivo = $outrasContasPagar;
        $totalCapitalProprioPassivo = $totalCapitalProprio + $totalPassivo;
        
        return [
            'ativo_tangiveis' => $ativoTangiveis,
            'ativo_intangiveis' => $ativoIntangiveis,
            'inventarios' => $inventarios,
            'estado_publicos' => $estadoPublicos,
            'diferimentos' => $diferimentos,
            'caixa_depositos' => $caixaDepositos,
            'capital_realizado' => $capitalRealizado,
            'resultado_liquido' => $resultadoLiquido,
            'outras_contas_pagar' => $outrasContasPagar,
            'total_ativo_nao_corrente' => $totalAtivoNaoCorrente,
            'total_ativo_corrente' => $totalAtivoCorrente,
            'total_ativo' => $totalAtivo,
            'total_capital_proprio' => $totalCapitalProprio,
            'total_passivo' => $totalPassivo,
            'total_capital_proprio_passivo' => $totalCapitalProprioPassivo
        ];
    }
    
    /**
     * Calcular rácios de liquidez
     */
    public function calcularRacios($balanco) {
        $passivoCorrente = $balanco['total_passivo'];
        
        // Evitar divisão por zero
        if ($passivoCorrente == 0) {
            return [
                'liquidez_geral' => 0,
                'liquidez_reduzida' => 0,
                'liquidez_imediata' => 0
            ];
        }
        
        return [
            'liquidez_geral' => $balanco['total_ativo_corrente'] / $passivoCorrente,
            'liquidez_reduzida' => ($balanco['total_ativo_corrente'] - $balanco['inventarios']) / $passivoCorrente,
            'liquidez_imediata' => $balanco['caixa_depositos'] / $passivoCorrente
        ];
    }
    
    /**
     * Obter demonstração de resultados
     */
    public function getDemonstracaoResultados() {
        $stmt = $this->conn->prepare("SELECT * FROM demonstracao_resultados WHERE ano = ? ORDER BY ordem");
        $stmt->bind_param("i", $this->ano);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $dados = [];
        while ($row = $result->fetch_assoc()) {
            $dados[] = [
                'descricao' => $row['descricao'],
                'valor' => floatval($row['valor']),
                'tipo' => $row['tipo']
            ];
        }
        return $dados;
    }
}

// Função auxiliar para formatar valores monetários
function formatarMoeda($valor) {
    return number_format($valor, 2, ',', ' ') . ' €';
}

function formatarRacio($valor) {
    return number_format($valor, 6, ',', ' ');
}

// Processar dados
$econ = new EconomicoFinanceiro($conn);
$balanco = $econ->calcularBalanco();
$racios = $econ->calcularRacios($balanco);
$demonstracao = $econ->getDemonstracaoResultados();

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Económico-Financeiro - Puro Encanto</title>
    <link rel="stylesheet" href="asset/css/dashboard.css">
    <link rel="stylesheet" href="asset/css/lib/bootstrap.css">

    <link rel="stylesheet" href="asset/css/lib/datatables.css">
    <link rel="stylesheet" href="asset/css/lib/select2.css">
    <link rel="stylesheet" href="asset/css/lib/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <script src="asset/js/lib/jquery.js"></script>
    <script src="asset/js/lib/bootstrap.js"></script>
    <script src="asset/js/lib/datatables.js"></script>
    <script src="asset/js/lib/select2.js"></script>
    <script src="asset/js/lib/sweatalert.js"></script>
    <style>
        .content-wrapper {
            margin-left: 250px;
            padding: 30px;
            background-color: #f5f5f5;
            min-height: 100vh;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }
        
        @media (max-width: 1200px) {
            .two-columns {
                grid-template-columns: 1fr;
            }
        }
        
        .page-title {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .table-custom {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }
        
        .table-custom th,
        .table-custom td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .table-custom th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .table-custom tr:hover {
            background-color: #f8f9fa;
        }
        
        .total-row {
            font-weight: 600;
            background-color: #e9ecef;
            border-top: 2px solid #dee2e6;
        }
        
        .grand-total-row {
            font-weight: 700;
            background-color: #d1d8dd;
            font-size: 1.05em;
        }
        
        .section-title {
            color: #495057;
            margin: 30px 0 15px 0;
            font-size: 22px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 8px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            border-left: 4px solid #0c5460;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        @media print {
            .sidebar { display: none; }
            .content-wrapper { margin-left: 0; }
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
        <a href="dashboard.php">
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
        <a href="calendario.html" >
            <i class="bi bi-calendar3"></i> Calendário
        </a>
        <a href="economicofinanceiro.php" class="active">
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

    <div class="content-wrapper">
        <h1 class="page-title">Económico-Financeiro - <?= $econ->ano ?></h1>
        
        <div class="two-columns">
            <!-- BALANÇO -->
            <div class="card">
                <h2 class="section-title">Balanço</h2>
                
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><strong>ATIVO NÃO CORRENTE</strong></td>
                        </tr>
                        <tr>
                            <td>Ativos fixos tangíveis</td>
                            <td class="text-right"><?= formatarMoeda($balanco['ativo_tangiveis']) ?></td>
                        </tr>
                        <tr>
                            <td>Ativos intangíveis</td>
                            <td class="text-right"><?= formatarMoeda($balanco['ativo_intangiveis']) ?></td>
                        </tr>
                        <tr class="total-row">
                            <td>Total do Ativo Não Corrente</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_ativo_nao_corrente']) ?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><strong>ATIVO CORRENTE</strong></td>
                        </tr>
                        <tr>
                            <td>Inventários</td>
                            <td class="text-right"><?= formatarMoeda($balanco['inventarios']) ?></td>
                        </tr>
                        <tr>
                            <td>Estado e outros entes públicos</td>
                            <td class="text-right"><?= formatarMoeda($balanco['estado_publicos']) ?></td>
                        </tr>
                        <tr>
                            <td>Diferimentos</td>
                            <td class="text-right"><?= formatarMoeda($balanco['diferimentos']) ?></td>
                        </tr>
                        <tr>
                            <td>Caixa e depósitos bancários</td>
                            <td class="text-right"><?= formatarMoeda($balanco['caixa_depositos']) ?></td>
                        </tr>
                        <tr class="total-row">
                            <td>Total do Ativo Corrente</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_ativo_corrente']) ?></td>
                        </tr>
                        
                        <tr class="grand-total-row">
                            <td>TOTAL DO ATIVO</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_ativo']) ?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><strong>CAPITAL PRÓPRIO</strong></td>
                        </tr>
                        <tr>
                            <td>Capital realizado</td>
                            <td class="text-right"><?= formatarMoeda($balanco['capital_realizado']) ?></td>
                        </tr>
                        <tr>
                            <td>Resultado líquido do período</td>
                            <td class="text-right"><?= formatarMoeda($balanco['resultado_liquido']) ?></td>
                        </tr>
                        <tr class="total-row">
                            <td>Total do Capital Próprio</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_capital_proprio']) ?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><strong>PASSIVO</strong></td>
                        </tr>
                        <tr>
                            <td>Outras contas a pagar</td>
                            <td class="text-right"><?= formatarMoeda($balanco['outras_contas_pagar']) ?></td>
                        </tr>
                        <tr class="total-row">
                            <td>Total do Passivo</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_passivo']) ?></td>
                        </tr>
                        
                        <tr class="grand-total-row">
                            <td>TOTAL DO CAPITAL PRÓPRIO E DO PASSIVO</td>
                            <td class="text-right"><?= formatarMoeda($balanco['total_capital_proprio_passivo']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- DEMONSTRAÇÃO DE RESULTADOS -->
            <div class="card">
                <h2 class="section-title">Rendimentos e Gastos</h2>
                
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th class="text-right">2025</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demonstracao as $item): ?>
                            <tr class="<?= $item['tipo'] === 'subtotal' ? 'total-row' : ($item['tipo'] === 'total' ? 'grand-total-row' : '') ?>">
                                <td><?= htmlspecialchars($item['descricao']) ?></td>
                                <td class="text-right"><?= formatarMoeda($item['valor']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <h2 class="section-title">Rácios de Liquidez</h2>
            
            <div class="alert-info">
                <strong>Nota:</strong> Os rácios de liquidez medem a capacidade da empresa para cumprir as suas obrigações de curto prazo.
            </div>
            
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Rácio</th>
                        <th class="text-right">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Liquidez Geral<br><small class="text-muted">Ativo Corrente / Passivo Corrente</small></td>
                        <td class="text-right"><?= formatarRacio($racios['liquidez_geral']) ?></td>
                    </tr>
                    <tr>
                        <td>Liquidez Reduzida<br><small class="text-muted">(Ativo Corrente - Inventários) / Passivo Corrente</small></td>
                        <td class="text-right"><?= formatarRacio($racios['liquidez_reduzida']) ?></td>
                    </tr>
                    <tr>
                        <td>Liquidez Imediata<br><small class="text-muted">Disponibilidades / Passivo Corrente</small></td>
                        <td class="text-right"><?= formatarRacio($racios['liquidez_imediata']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    < <script>
 function atualizarHora() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const elemento = document.getElementById('time');
            if (elemento) {
                elemento.textContent = now.toLocaleDateString('pt-PT', options);
            }
        }
        
        atualizarHora();
        setInterval(atualizarHora, 60000);
    </script>
</body>
</html>