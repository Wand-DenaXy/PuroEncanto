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
        <div class="logo"><img src="images/logos/PURO ENCANTO LOGO.png" alt="">
            <p class="logotitulo">Puro Encanto</p>
        </div>
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
                <h2 id="nomePerfil"></h2>
                <p id="perfilAdmin">Admin Puro Encanto</p>
            </div>
            <div class="profile-body">
                <div class=" text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                        <i class="bi bi-pencil"></i> Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Perfil -->
    <div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="updatePerfil.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarPerfilModalLabel">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="ID_Cliente" value="<?= $idCliente ?>">

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control"
                                value="<?= htmlspecialchars($cliente['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="Email" class="form-control"
                                value="<?= htmlspecialchars($cliente['Email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIF</label>
                            <input type="text" name="nif" class="form-control"
                                value="<?= htmlspecialchars($cliente['nif']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">IBAN</label>
                            <input type="text" name="IBAN" class="form-control"
                                value="<?= htmlspecialchars($cliente['IBAN']) ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="asset/js/perfilAdmin.js"></script>
</body>

</html>