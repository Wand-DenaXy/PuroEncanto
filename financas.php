<?php
include 'asset/model/connection2.php';

$sql = "SELECT ID_Financa, TotalReceber, TotalPagar, Disponibilidades FROM financas WHERE ID_Financa = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idFinanca = $row['ID_Financa'];
    $totalReceber = number_format($row['TotalReceber'], 2, ',', '.');
    $totalPagar = number_format($row['TotalPagar'], 2, ',', '.');
    $disponibilidades = number_format($row['Disponibilidades'], 2, ',', '.');
} else {
    $idFinanca = 1;
    $totalReceber = $totalPagar = $disponibilidades = "0,00";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Finanças</title>

<link rel="stylesheet" href="asset/css/funcionario.css">
<link rel="stylesheet" href="asset/css/lib/datatables.css">
<link rel="stylesheet" href="asset/css/lib/bootstrap.css">

<script src="asset/js/lib/jquery.js"></script>
<script src="asset/js/lib/bootstrap.js"></script>
<script src="asset/js/lib/datatables.js"></script>
<script src="asset/js/lib/sweatalert.js"></script>

<style>
html, body {
    height: 100%;
    margin: 0;
}

.table-container {
    display: flex;
    flex-direction: column;
    justify-content: center;  /* verticalmente */
    align-items: center;      /* horizontalmente */
    width: 90%;               /* ocupa 90% da largura da página */
    max-width: 1200px;        /* máximo de largura */
    margin: 0 auto;           /* centro horizontal */
    padding: 40px;
    min-height: 80vh;         /* ocupa grande parte da altura da página */
    box-sizing: border-box;
}

@media (max-width: 768px) {
    .table-container {
        margin-left: 0;
        width: 100%;
        padding: 20px;
    }
}

/* DataTable wrapper para esticar tabela */
#financasTable_wrapper {
    width: 100% !important;

    max-width: 1200px;
    margin: 0 auto;
}
#financasTable {
    width: 100% !important;
    font-size: 1.2rem;
    border-radius: 10px;
}


#financasTable th, 
#financasTable td {
    padding: 20px 24px;
    font-size: 1.1rem;
}

#financasTable th:nth-child(1),
#financasTable td:nth-child(1) { width: 45%; }
#financasTable th:nth-child(2),
#financasTable td:nth-child(2) { width: 35%; }
#financasTable th:nth-child(3),
#financasTable td:nth-child(3) { width: 20%; }

@media (max-width: 1200px) {
    #financasTable_wrapper { max-width: 95%; }
}

@media (max-width: 768px) {
    #financasTable th, #financasTable td { font-size: 1rem; padding: 16px; }
}
</style>
</head>
<body>

<div class="sidebar">
    <a href="index.php" style="background-color: transparent;border-left: none;">
        <div class="logo"><img src="images/logos/PURO ENCANTO LOGO.png" alt="">
            <p class="logotitulo">Puro Encanto</p>
        </div>
    </a>
    <a href="dashboard.php"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="gastoserendimentos.html"><i class="bi bi-people"></i> Gastos e Rendimentos</a>
    <a href="servicosadmin.html"><i class="bi bi-grid"></i> Vendas</a>
    <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
    <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
    <a href="funcionario.html"><i class="bi bi-people"></i> Funcionário</a>
    <a href="calendario.html"><i class="bi bi-people"></i> Calendário</a>
    <a href="economicofinanceiro.php"><i class="bi bi-people"></i> Económico-Financeiro</a>
    <a href="financas.html" class="active"><i class="bi bi-people"></i> Finanças</a>
    <a href="perfilAdmin.php"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="table-container">
    <div class="table-header text-center">
        <h2><strong>Finanças</strong></h2>
        <br>
    </div>

    <table id="financasTable" class="table table-bordered table-striped align-middle text-center shadow-sm">
        <thead class="table-dark">
            <tr>
                <th></th>
                <th>Valor (€)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total a Receber</td>
                <td class="valor"><?= $totalReceber ?></td>
                <td>
                    <button class="btn btn-primary btn-sm btn-edit"
                            data-id="<?= $idFinanca ?>"
                            data-field="TotalReceber"
                            data-label="Total a Receber"
                            data-value="<?= str_replace('.', '', str_replace(',', '.', $totalReceber)) ?>">
                        Editar
                    </button>
                </td>
            </tr>
            <tr>
                <td>Total a Pagar</td>
                <td class="valor"><?= $totalPagar ?></td>
                <td>
                    <button class="btn btn-primary btn-sm btn-edit"
                            data-id="<?= $idFinanca ?>"
                            data-field="TotalPagar"
                            data-label="Total a Pagar"
                            data-value="<?= str_replace('.', '', str_replace(',', '.', $totalPagar)) ?>">
                        Editar
                    </button>
                </td>
            </tr>
            <tr>
                <td>Disponibilidades</td>
                <td class="valor"><?= $disponibilidades ?></td>
                <td>
                    <button class="btn btn-primary btn-sm btn-edit"
                            data-id="<?= $idFinanca ?>"
                            data-field="Disponibilidades"
                            data-label="Disponibilidades"
                            data-value="<?= str_replace('.', '', str_replace(',', '.', $disponibilidades)) ?>">
                        Editar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal de edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Valor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="financaId" name="id">
          <input type="hidden" id="field" name="field">
          <div class="mb-3">
            <label for="valor" id="valorLabel" class="form-label">Novo Valor</label>
            <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Guardar Alterações</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#financasTable').DataTable({
        paging: false,
        searching: false,
        info: false
    });

    let editModal = new bootstrap.Modal(document.getElementById('editModal'));
    let selectedButton = null;

    $('#financasTable tbody').on('click', '.btn-edit', function() {
        selectedButton = $(this);
        $('#financaId').val($(this).data('id'));
        $('#field').val($(this).data('field'));
        $('#valor').val($(this).data('value'));
        $('#valorLabel').text('Editar ' + $(this).data('label'));
        $('#editModalLabel').text('Editar ' + $(this).data('label'));
        editModal.show();
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#financaId').val();
        const field = $('#field').val();
        const valor = $('#valor').val();

        $.ajax({
            url: 'update_financa.php',
            type: 'POST',
            data: { id: id, field: field, valor: valor },
            success: function(response) {
                if (response.trim() === "success") {
                    selectedButton.closest('tr').find('.valor').text(
                        parseFloat(valor).toFixed(2).replace('.', ',')
                    );
                    selectedButton.data('value', valor);
                    editModal.hide();
                } else {
                    alert("Erro: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert('Erro na requisição: ' + error);
            }
        });
    });
});
</script>
<script>
        
        function atualizarHora() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString('pt-PT');
            const elemento = document.getElementById('time');
            if (elemento) {
                elemento.textContent = hora;
            }
        }
        
        atualizarHora();
        setInterval(atualizarHora, 1000);
    </script>
</body>
</html>
