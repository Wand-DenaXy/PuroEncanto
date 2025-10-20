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
    :root {
        --primary-brown: #8B7355;
        --dark-brown: #6B5744;
        --light-brown: #A89480;
        --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --card-shadow-hover: 0 10px 20px -5px rgb(0 0 0 / 0.15);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #f5f5f5;
        min-height: 100vh;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: white;
        padding: 2rem 0;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        z-index: 1000;
        border-right: 1px solid #e5e5e5;
    }

    .logo {
        text-align: center;
        padding: 0 1.5rem 2rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .logo img {
        width: 80px;
        height: 80px;
        border-radius: 15px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.2);
    }

    .logotitulo {
        color: var(--primary-brown);
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        color: #666;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
    }

    .sidebar a:hover {
        background: rgba(139, 115, 85, 0.08);
        color: var(--primary-brown);
    }

    .sidebar a.active {
        background: rgba(139, 115, 85, 0.1);
        color: var(--primary-brown);
        border-left: 4px solid var(--primary-brown);
    }

    .sidebar a i {
        margin-right: 1rem;
        font-size: 1.2rem;
    }

    .time {
        position: absolute;
        bottom: 2rem;
        left: 0;
        right: 0;
        text-align: center;
        color: #999;
        font-size: 0.875rem;
    }

    .content {
        margin-left: 280px;
        padding: 2rem;
        min-height: 100vh;
    }

    .header-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
        text-align: center;
    }

    .header-section h2 {
        color: var(--dark-brown);
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 2rem;
    }

    .header-section p {
        color: #666;
        margin: 0;
        font-size: 1rem;
    }

    .profile-card {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        border: 1px solid #f0f0f0;
        transition: all 0.3s;
    }

    .profile-card:hover {
        box-shadow: var(--card-shadow-hover);
    }

    .profile-header {
        background: linear-gradient(135deg, var(--light-brown), var(--primary-brown));
        color: white;
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .profile-avatar i {
        font-size: 4rem;
        color: var(--primary-brown);
    }

    .profile-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
    }

    .profile-header p {
        margin: 0.5rem 0 0;
        opacity: 0.95;
        font-size: 1.05rem;
    }

    .profile-body {
        padding: 2rem;
    }

    .profile-items-grid {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .profile-item {
        background: #fafafa;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s;
    }

    .profile-item:hover {
        background: white;
        border-color: var(--light-brown);
        transform: translateX(5px);
        box-shadow: var(--card-shadow);
    }

    .profile-item-icon {
        width: 50px;
        height: 50px;
        background: rgba(139, 115, 85, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-item-icon i {
        font-size: 1.5rem;
        color: var(--primary-brown);
    }

    .profile-item-content {
        flex: 1;
    }

    .profile-item-label {
        font-size: 0.875rem;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .profile-item-value {
        font-size: 1rem;
        color: var(--dark-brown);
        font-weight: 500;
        margin: 0;
    }

    .btn-edit-profile {
        background: var(--primary-brown);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .btn-edit-profile:hover {
        background: var(--dark-brown);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(139, 115, 85, 0.3);
    }

    .btn-edit-profile i {
        font-size: 1.1rem;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: var(--primary-brown);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem 2rem;
        border: none;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #e5e5e5;
        padding: 0.75rem;
        transition: all 0.3s;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
        outline: none;
    }

    .modal-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid #e5e5e5;
    }

    .btn-secondary {
        background: #e5e5e5;
        color: #666;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background: #d4d4d4;
        color: #333;
    }

    .btn-success {
        background: var(--primary-brown);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-success:hover {
        background: var(--dark-brown);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.3);
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 1.5rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .alert-warning {
        background: rgba(251, 191, 36, 0.1);
        color: #d97706;
        border-left: 4px solid #fbbf24;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }
        
        .content {
            margin-left: 0;
            padding: 1rem;
        }

        .profile-card {
            margin: 1rem;
        }

        .profile-header {
            padding: 2rem 1rem;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .header-section h2 {
            font-size: 1.5rem;
        }

        .profile-item {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <a href="index.php"><img src="images/logos/PURO ENCANTO LOGO.png" alt="Puro Encanto"></a>
        <p class="logotitulo">Puro Encanto</p>
    </div>
    <a href="dashboardCliente.php"><i class="bi bi-calendar-event"></i> Criar Evento</a>
    <a href="perfil.php" class="active"><i class="bi bi-person-circle"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="content">
    <div class="header-section">
        <h2>O Meu Perfil</h2>
        <p>Gerencie suas informações pessoais</p>
    </div>

    <?php if ($cliente): ?>
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <h2><?= htmlspecialchars($cliente['nome']) ?></h2>
                <p>Cliente Puro Encanto</p>
            </div>
            <div class="profile-body">
                <div class="profile-items-grid">
                    <div class="profile-item">
                        <div class="profile-item-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="profile-item-content">
                            <div class="profile-item-label">Email</div>
                            <div class="profile-item-value"><?= htmlspecialchars($cliente['Email']) ?></div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-item-icon">
                            <i class="bi bi-credit-card-2-front-fill"></i>
                        </div>
                        <div class="profile-item-content">
                            <div class="profile-item-label">NIF</div>
                            <div class="profile-item-value"><?= htmlspecialchars($cliente['nif']) ?></div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-item-icon">
                            <i class="bi bi-bank"></i>
                        </div>
                        <div class="profile-item-content">
                            <div class="profile-item-label">IBAN</div>
                            <div class="profile-item-value"><?= htmlspecialchars($cliente['IBAN']) ?></div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                        <i class="bi bi-pencil-fill"></i> Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-triangle"></i> Não foi possível carregar os dados do perfil.
        </div>
    <?php endif; ?>
</div>

<!-- Modal Editar Perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
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
          <button type="submit" class="btn btn-success">Guardar Alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>