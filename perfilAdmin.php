<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puro Encanto - Perfil</title>

    <link rel="stylesheet" href="asset/css/perfil.css">
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
        <a href="calendario.html">
            <i class="bi bi-calendar3"></i> Calendário
        </a>
        <a href="economicofinanceiro.php">
            <i class="bi bi-graph-up-arrow"></i> Económico-Financeiro
        </a>
    
        <a href="perfilAdmin.php" class="active">
            <i class="bi bi-person-circle"></i> Perfil
        </a>
        <div class="time" id="time"></div>
    </div>

    <div class="content">
        <div class="page-header">
            <h2>
                <i class="bi bi-person-circle"></i>
                O Meu Perfil
            </h2>
        </div>

        <div class="profile-section">
            <div class="profile-header" style="font-size: x-large;">
                <div class="profile-name" id="perfilAdmin"></div>
                <div class="profile-role">Administrador</div>
                <div class="status-badge">
                    <i class="bi bi-check-circle-fill"></i> Ativo
                </div>
            </div>

            <div class="profile-body"></div>

            <div class="action-buttons" id="buttonsEdit"></div>
        </div>
    </div>

    <div class="modal fade" id="formEditPerfil" tabindex="-1" aria-labelledby="PerfilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PerfilModalLabel">
                        <i class="bi bi-pencil-square"></i>
                        Editar Perfil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="formPerfil">
                        <div class="col-md-12">
                            <label for="nomeEdit" class="form-label">
                                <i class="bi bi-person-fill"></i> Nome
                            </label>
                            <input type="text" class="form-control" id="nomeEdit" placeholder="Digite o seu nome">
                        </div>

                        <div class="col-md-6">
                            <label for="emailEdit" class="form-label">
                                <i class="bi bi-envelope-fill"></i> Email
                            </label>
                            <input type="email" class="form-control" id="emailEdit" placeholder="seu.email@exemplo.com">
                        </div>

                        <div class="col-md-6">
                            <label for="NIFEdit" class="form-label">
                                <i class="bi bi-hash"></i> NIF
                            </label>
                            <input type="text" class="form-control" id="NIFEdit" placeholder="000000000">
                        </div>

                        <div class="col-md-12">
                            <label for="IBANEdit" class="form-label">
                                <i class="bi bi-bank"></i> IBAN
                            </label>
                            <input type="text" class="form-control" id="IBANEdit"
                                placeholder="PT50 0000 0000 0000 0000 0000 0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Fechar
                    </button>

                    <button type="button" class="btinfoperfil2" id="btnGuardar">
                        <i class="bi bi-check-circle"></i> 
                        <span>Guardar Alterações</span>
                        <span class="loading-spinner" id="spinner">
                            <i class="bi bi-arrow-repeat"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/js/perfilAdmin.js"></script>
    <script>
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