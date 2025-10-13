<?php
include 'asset/model/connection2.php';

$sql = "SELECT ID_Financa, TotalReceber, TotalPagar, Disponibilidades FROM financas WHERE ID_Financa = 1";
$result = $conn->query($sql);

$financas = [];
if ($result->num_rows > 0) {
    $financas = $result->fetch_assoc();
} else {
    $financas = [
        'ID_Financa' => 1,
        'TotalReceber' => 0,
        'TotalPagar' => 0,
        'Disponibilidades' => 0
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Dashboard</title>

<link rel="stylesheet" href="asset/css/lib/bootstrap.css">
<link rel="stylesheet" href="asset/css/lib/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="asset/css/dashboard.css">

<script src="asset/js/lib/jquery.js"></script>
<script src="asset/js/lib/bootstrap.js"></script>
<script src="asset/js/lib/jquery.dataTables.min.js"></script>
<script src="asset/js/lib/dataTables.bootstrap5.min.js"></script>

<style>
.table-container {
    margin-left: 220px;
    padding: 40px;
}
@media (max-width:768px){
    .table-container{
        margin-left:0;
        padding:20px;
    }
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
    <a href="dashboard.php" class="active"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="gastoserendimentos.html"><i class="bi bi-people"></i> Gastos e Rendimentos</a>
    <a href="servicosadmin.html"><i class="bi bi-grid"></i> Vendas</a>
    <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
    <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
    <a href="funcionario.html"><i class="bi bi-people"></i> Funcionário</a>
    <a href="calendario.html"><i class="bi bi-people"></i> Calendário</a>
    <a href="#"><i class="bi bi-people"></i> Económico-Financeiro</a>
    <a href="financas.html"><i class="bi bi-people"></i> Finanças</a>
    <a href="perfilAdmin.php"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="table-container">
    <h2 class="mb-4">Resumo Financeiro</h2>
    <table id="financasTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Descrição</th>
                <th>Valor (€)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total a Receber</strong></td>
                <td class="valor"><?= number_format($financas['TotalReceber'], 2, ',', '.') ?></td>
                <td><button class="btn btn-primary btn-edit" data-id="<?= $financas['ID_Financa'] ?>" data-field="TotalReceber" data-value="<?= $financas['TotalReceber'] ?>">Editar</button></td>
            </tr>
            <tr>
                <td><strong>Total a Pagar</strong></td>
                <td class="valor"><?= number_format($financas['TotalPagar'], 2, ',', '.') ?></td>
                <td><button class="btn btn-primary btn-edit" data-id="<?= $financas['ID_Financa'] ?>" data-field="TotalPagar" data-value="<?= $financas['TotalPagar'] ?>">Editar</button></td>
            </tr>
            <tr>
                <td><strong>Disponibilidades</strong></td>
                <td class="valor"><?= number_format($financas['Disponibilidades'], 2, ',', '.') ?></td>
                <td><button class="btn btn-primary btn-edit" data-id="<?= $financas['ID_Financa'] ?>" data-field="Disponibilidades" data-value="<?= $financas['Disponibilidades'] ?>">Editar</button></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Valor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="financaId">
                <input type="hidden" name="field" id="field">
                <div class="mb-3">
                    <label for="valor" class="form-label">Valor (€)</label>
                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#financasTable').DataTable({
        paging: false,
        searching: false,
        info: false
    });

    var editModal = new bootstrap.Modal(document.getElementById('editModal'));

    $('.btn-edit').on('click', function() {
        $('#financaId').val($(this).data('id'));
        $('#field').val($(this).data('field'));
        $('#valor').val($(this).data('value'));
        editModal.show();
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        var id = $('#financaId').val();
        var field = $('#field').val();
        var valor = $('#valor').val();

        $.ajax({
            url: 'update_financa.php',
            type: 'POST',
            data: { id: id, field: field, valor: valor },
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert('Erro ao atualizar o valor!');
            }
        });
    });
});
</script>

</body>
</html>
