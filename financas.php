<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Finanças</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.finance-container {
    width: 100%;
    max-width: 900px;
    animation: fadeIn 0.6s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.header {
    text-align: center;
    margin-bottom: 30px;
    color: white;
}

.header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    margin-bottom: 10px;
}

.header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.card-custom {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
    animation: slideUp 0.6s ease-out 0.2s both;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-wrapper {
    padding: 0;
}

.finance-table {
    margin: 0;
    width: 100%;
}

.finance-table thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.finance-table thead th {
    color: white;
    font-weight: 600;
    font-size: 1rem;
    padding: 20px 15px;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.finance-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e9ecef;
}

.finance-table tbody tr:last-child {
    border-bottom: none;
}

.finance-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.finance-table td {
    padding: 25px 15px;
    vertical-align: middle;
    font-size: 1rem;
}

.label-cell {
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
}

.label-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
}

.icon-receber {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.icon-pagar {
    background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
}

.icon-disponivel {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.value-cell {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2c3e50;
    font-family: 'Courier New', monospace;
}

.value-cell::before {
    content: '€ ';
    font-size: 1rem;
    opacity: 0.7;
    margin-right: 4px;
}

.btn-edit-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-edit-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    color: white;
}

.btn-edit-custom:active {
    transform: translateY(0);
}

/* Modal personalizado */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px 20px 0 0;
    padding: 20px 25px;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modal-body {
    padding: 30px 25px;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-save {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    width: 100%;
    margin-top: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(17, 153, 142, 0.4);
    background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
}

/* Responsivo */
@media (max-width: 768px) {
    .header h1 {
        font-size: 2rem;
    }
    
    .finance-table td {
        padding: 20px 10px;
        font-size: 0.9rem;
    }
    
    .value-cell {
        font-size: 1.2rem;
    }
    
    .label-cell {
        font-size: 0.9rem;
    }
    
    .label-icon {
        width: 38px;
        height: 38px;
        font-size: 1.1rem;
    }
    
    .btn-edit-custom {
        padding: 8px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .finance-table thead th:first-child,
    .finance-table tbody td:first-child {
        width: 45%;
    }
    
    .finance-table thead th:nth-child(2),
    .finance-table tbody td:nth-child(2) {
        width: 30%;
    }
    
    .finance-table thead th:nth-child(3),
    .finance-table tbody td:nth-child(3) {
        width: 25%;
    }
}
</style>
</head>
<body>

<div class="finance-container">
    <div class="header">
        <h1><i class="bi bi-wallet2"></i> Finanças</h1>
        <p>Gestão Financeira - Puro Encanto</p>
    </div>

    <div class="card-custom">
        <div class="table-wrapper">
            <table class="table finance-table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="label-cell">
                                <div class="label-icon icon-receber">
                                    <i class="bi bi-arrow-down-circle-fill"></i>
                                </div>
                                <span>Total a Receber</span>
                            </div>
                        </td>
                        <td class="value-cell" id="valor-receber">0,00</td>
                        <td class="text-center">
                            <button class="btn btn-edit-custom btn-sm" onclick="editarValor('receber', 'Total a Receber')">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-cell">
                                <div class="label-icon icon-pagar">
                                    <i class="bi bi-arrow-up-circle-fill"></i>
                                </div>
                                <span>Total a Pagar</span>
                            </div>
                        </td>
                        <td class="value-cell" id="valor-pagar">0,00</td>
                        <td class="text-center">
                            <button class="btn btn-edit-custom btn-sm" onclick="editarValor('pagar', 'Total a Pagar')">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-cell">
                                <div class="label-icon icon-disponivel">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <span>Disponibilidades</span>
                            </div>
                        </td>
                        <td class="value-cell" id="valor-disponivel">0,00</td>
                        <td class="text-center">
                            <button class="btn btn-edit-custom btn-sm" onclick="editarValor('disponivel', 'Disponibilidades')">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">
                    <i class="bi bi-pencil-square"></i> Editar Valor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" onsubmit="salvarValor(event)">
                    <input type="hidden" id="campoAtual">
                    <div class="mb-3">
                        <label for="novoValor" class="form-label" id="valorLabel">
                            <i class="bi bi-cash-stack"></i> Novo Valor
                        </label>
                        <input type="number" step="0.01" class="form-control" id="novoValor" required placeholder="0,00">
                    </div>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle-fill"></i> Guardar Alterações
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Valores simulados (substitua pela integração real com PHP)
const valores = {
    receber: 15000.50,
    pagar: 8500.75,
    disponivel: 22300.00
};

// Atualizar valores na tabela
function atualizarTabela() {
    document.getElementById('valor-receber').textContent = formatarValor(valores.receber);
    document.getElementById('valor-pagar').textContent = formatarValor(valores.pagar);
    document.getElementById('valor-disponivel').textContent = formatarValor(valores.disponivel);
}

// Formatar valor para exibição
function formatarValor(valor) {
    return valor.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

let editModal;
let campoEditando;

// Inicializar modal
document.addEventListener('DOMContentLoaded', function() {
    editModal = new bootstrap.Modal(document.getElementById('editModal'));
    atualizarTabela();
});

// Abrir modal de edição
function editarValor(campo, label) {
    campoEditando = campo;
    document.getElementById('campoAtual').value = campo;
    document.getElementById('valorLabel').innerHTML = `<i class="bi bi-cash-stack"></i> ${label}`;
    document.getElementById('editModalLabel').innerHTML = `<i class="bi bi-pencil-square"></i> Editar ${label}`;
    document.getElementById('novoValor').value = valores[campo].toFixed(2);
    editModal.show();
}

// Salvar valor editado
function salvarValor(event) {
    event.preventDefault();
    const campo = document.getElementById('campoAtual').value;
    const novoValor = parseFloat(document.getElementById('novoValor').value);
    
    if (!isNaN(novoValor) && novoValor >= 0) {
        valores[campo] = novoValor;
        atualizarTabela();
        editModal.hide();
        
        // Aqui você integraria com o PHP para salvar no banco de dados
        // Por exemplo, usando fetch() ou XMLHttpRequest
        console.log(`Valor atualizado: ${campo} = ${novoValor}`);
    }
}
</script>

</body>
</html>