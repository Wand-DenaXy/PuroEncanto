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
    :root {
        --primary-color: #4e73df;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --sidebar-width: 260px;
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
        background: linear-gradient(180deg, #96662f 0%, #b46f1f 100%);
        overflow-y: auto;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .logo {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-left-color: white;
    }

    .sidebar a.active {
        background: rgba(255, 255, 255, 0.15);
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
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
        font-size: 14px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: auto;
    }

    .content {
        margin-left: var(--sidebar-width);
        padding: 30px;
        min-height: 100vh;
    }

    .page-header {
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .page-header h2 {
        color: #5a5c69;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .profile-header {
        text-align: center;
        padding-bottom: 30px;
        border-bottom: 2px solid #f8f9fc;
        margin-bottom: 30px;
    }



    .profile-name {
        font-size: 26px;
        font-weight: 700;
        color: #5a5c69;
        margin-bottom: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .info-card {
        background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .info-card.email {
        border-left-color: var(--info-color);
    }

    .info-card.nif {
        border-left-color: var(--warning-color);
    }

    .info-card.iban {
        border-left-color: var(--success-color);
    }

    .info-label {
        font-size: 12px;
        color: #858796;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 600;
        color: #5a5c69;
        word-break: break-all;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        padding-top: 30px;
        border-top: 2px solid #f8f9fc;
    }

    .btn-edit {
        background-color: #b68f5c;
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-edit:hover {
        background-color: #a37542;
        transform: translateY(-2px);
    }

    .btn-logout {
        background: var(--danger-color);
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 74, 59, 0.4);
    }

    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 20px 25px;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-title {
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-footer {
        padding: 20px 25px;
        border-top: 2px solid #f8f9fc;
    }

    .form-label {
        font-weight: 600;
        color: #5a5c69;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #d1d3e2;
        padding: 10px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btinfoperfil2 {
        background: var(--success-color);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btinfoperfil2:hover {
        transform: translateY(-2px);
        background: var(--success-color);
        box-shadow: 0 5px 15px rgba(28, 200, 138, 0.4);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #858796;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .status-badge {
        display: inline-block;
        background: var(--success-color);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 10px;
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

        .page-header h2 {
            font-size: 22px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }
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

    .profile-section {
        animation: fadeIn 0.5s ease-out;
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
        <a href="calendario.html">
            <i class="bi bi-calendar3"></i> Calendário
        </a>
        <a href="economicofinanceiro.php">
            <i class="bi bi-graph-up-arrow"></i> Económico-Financeiro
        </a>
        <a href="financas.php">
            <i class="bi bi-wallet2"></i> Finanças
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
                <div class=" profile-name" id="perfilAdmin"></div>
                <div class="profile-role">Administrador</div>
                <div class="status-badge">
                    <i class="bi bi-check-circle-fill"></i> Ativo
                </div>
            </div>

            <div class="profile-body"></div>

            <div class="action-buttons">
                <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#formEditPerfil" <i
                    class="bi bi-pencil-square"></i>
                    Editar Perfil
                </button>
                <button class="btn-logout" onclick="logout()">
                    <i class="bi bi-box-arrow-right"></i>
                    Fazer Logout
                </button>
            </div>
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
                    <form class="row g-3">
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

                    <button type="button" class="btinfoperfil2">
                        <i class="bi bi-check-circle"></i> Guardar Alterações
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
            weekday: ' long',
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