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


    <script src="asset/js/lib/jquery.js"></script>
    <script src="asset/js/lib/bootstrap.js"></script>
    <script src="asset/js/lib/datatables.js"></script>
    <script src="asset/js/lib/select2.js"></script>
    <script src="asset/js/lib/sweatalert.js"></script>

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
        <a href="servicosadmin.html"><i class="bi bi-grid"></i>Vendas</a>
        <a href="fornecedores.html"><i class="bi bi-people"></i> Fornecedores</a>
        <a href="clientes.html"><i class="bi bi-people"></i> Clientes</a>
        <a href="funcionario.html"><i class="bi bi-people"></i> Funcionario</a>
        <a href="calendario.html"><i class="bi bi-people"></i> Calendario</a>
        <a href="perfilAdmin.php" class="active"><i class="bi bi-box-arrow-in-right"></i> Perfil</a>

        <div class="time" id="time"></div>
    </div>

    <div class="content" style="margin-left:250px; padding:20px;">
        <h2 class="mb-4">O meu Perfil</h2>


        <div class="profile-card">
            <div class="profile-header">
                <p id="perfilAdmin"></p>
            </div>
            <div class="profile-body">
            </div>
        </div>
    </div>

    <div class="modal fade" id="formEditPerfil" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="PerfilModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card">
                            <h5 class="card-header">Perfil</h5>
                            <div class="card-body">
                                <h5 class="card-title">Editar Perfil</h5>
                                <form class="row g-6">
                                    <div>
                                        <div class="col-md-6">
                                            <label for="nomeEdit" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nomeEdit">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="emailEdit" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="emailEdit">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="NIFEdit" class="form-label">NIF</label>
                                            <input type="text" class="form-control" id="NIFEdit">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="IBANEdit" class="form-label">IBAN</label>
                                            <input type="text" class="form-control" id="IBANEdit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        style="padding: 12px;border-radius: 10px;font-size: 16px;font-weight: bold;">Fechar</button>
                    <button type="button" class='btinfoperfil2' id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="asset/js/perfilAdmin.js"></script>
</body>

</html>