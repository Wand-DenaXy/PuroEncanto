<?php
session_start();
require_once 'asset/model/connection2.php';

$idCliente = $_SESSION['cliente_id'] ?? null;
$cliente = null;

if ($idCliente) {
    $sql = "SELECT nome, Email, nif, IBAN FROM Clientes WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Perfil</title>
<link rel="stylesheet" href="asset/css/calendario.css">
<link rel="stylesheet" href="asset/css/lib/bootstrap.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="asset/js/lib/jquery.js"></script>
<script src="asset/js/lib/bootstrap.js"></script>

<style>
    .mb-4 {
        text-align: center;
      }  
    body {
        background-color: #f8f9fa;
    }
    .profile-card {
        max-width: 600px;
        margin: 50px auto;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background: white;
        overflow: hidden;
    }
    .profile-header {
        background: linear-gradient(135deg, #ffbf77ff, #723300ff);
        color: white;
        padding: 30px;
        text-align: center;
    }
    .profile-header h2 {
        margin: 0;
        font-weight: bold;
    }
    .profile-body {
        padding: 30px;
    }
    .profile-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .profile-item i {
        font-size: 1.5rem;
        color: #ad680dff;
        margin-right: 15px;
    }
    .profile-item p {
        margin: 0;
        font-size: 1rem;
    }
</style>
</head>
<body>
<div class="sidebar">
    <div class="logo"><a href="index.php"><img src="images/logos/PURO ENCANTO LOGO.png" alt=""></a>
        <p class="logotitulo">Puro Encanto</p>
    </div>
    <a href="dashboardCliente.php"><i class="bi bi-calendar-event"></i> Criar Evento</a>
    <a href="perfil.php" class="active"><i class="bi bi-person-circle"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="content" style="margin-left:250px; padding:20px;">
    <h2 class="mb-4">O meu Perfil</h2>

    <?php if ($cliente): ?>
        <div class="profile-card">
            <div class="profile-header">
                <h2><?= htmlspecialchars($cliente['nome']) ?></h2>
                <p>Cliente Puro Encanto</p>
            </div>
            <div class="profile-body">
                <div class="profile-item">
                    <i class="bi bi-envelope"></i>
                    <p><strong>Email:</strong> <?= htmlspecialchars($cliente['Email']) ?></p>
                </div>
                <div class="profile-item">
                    <i class="bi bi-credit-card-2-front"></i>
                    <p><strong>NIF:</strong> <?= htmlspecialchars($cliente['nif']) ?></p>
                </div>
                <div class="profile-item">
                    <i class="bi bi-bank"></i>
                    <p><strong>IBAN:</strong> <?= htmlspecialchars($cliente['IBAN']) ?></p>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                        <i class="bi bi-pencil"></i> Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Não foi possível carregar os dados do perfil.</p>
    <?php endif; ?>
</div>

<!-- Modal Editar Perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
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
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($cliente['Email']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">NIF</label>
            <input type="text" name="nif" class="form-control" value="<?= htmlspecialchars($cliente['nif']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">IBAN</label>
            <input type="text" name="IBAN" class="form-control" value="<?= htmlspecialchars($cliente['IBAN']) ?>" required>
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

</body>
</html>
