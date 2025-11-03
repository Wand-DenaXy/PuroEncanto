<?php
session_start();
require_once 'asset/model/connection2.php';

$idCliente = $_SESSION['cliente_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $idCliente) {
    $idEvento = intval($_POST['id']);

    $check = $conn->prepare("SELECT ID_Evento FROM Eventos WHERE ID_Evento = ? AND ID_Cliente = ?");
    $check->bind_param("ii", $idEvento, $idCliente);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows === 0){
        echo json_encode(["flag" => false, "msg" => "Não podes cancelar este evento!"]);
        exit;
    }
    $check->close();


    $sqlServicos = "DELETE FROM eventos_servicos WHERE ID_Evento = ?";
    $stmtServicos = $conn->prepare($sqlServicos);
    $stmtServicos->bind_param("i", $idEvento);
    $stmtServicos->execute();
    $stmtServicos->close();

    $sql = "DELETE FROM Eventos WHERE ID_Evento = ? AND ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $idEvento, $idCliente);

    if ($stmt->execute()) {
        echo json_encode(["flag" => true, "msg" => "Evento removido com sucesso!"]);
    } else {
        echo json_encode(["flag" => false, "msg" => "Erro ao remover evento."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["flag" => false, "msg" => "Pedido inválido."]);
}
?>
