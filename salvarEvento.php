<?php
session_start();
require_once 'asset/model/connection2.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

$response = [
    'flag' => false,
    'msg' => '',
    'debug' => []
];

if (!isset($_SESSION['cliente_id'])) {
    $response['msg'] = 'Erro: cliente não está logado.';
    echo json_encode($response);
    exit;
}

$idCliente = $_SESSION['cliente_id'];
$nome = $_POST['nome'] ?? '';
$idTipoEvento = $_POST['id_tipoevento'] ?? null;
$idPacote = $_POST['id_pacote'] ?? null;
$data = $_POST['data'] ?? '';
$hora = $_POST['hora'] ?? '';
$estado = "Pendente";
$servicos = $_POST['servicos'] ?? [];

if ($hora) {
    $hora = date('H:i:s', strtotime($hora));
}

if (!$nome || !$data || !$hora || !$idTipoEvento || !$idPacote) {
    $response['msg'] = "Campos obrigatórios em falta.";
    echo json_encode($response);
    exit;
}

$stmtCheckCliente = $conn->prepare("SELECT COUNT(*) as cnt FROM clientes WHERE ID_Cliente = ?");
$stmtCheckCliente->bind_param("i", $idCliente);
$stmtCheckCliente->execute();
$res = $stmtCheckCliente->get_result()->fetch_assoc();
$stmtCheckCliente->close();

if ($res['cnt'] == 0) {
    $response['msg'] = "Cliente com ID $idCliente não existe!";
    echo json_encode($response);
    exit;
}

$stmtCheck = $conn->prepare("
    SELECT ID_Evento 
    FROM eventos 
    WHERE ID_Cliente = ? 
      AND Nome = ? 
      AND Data = ? 
      AND hora = ?
");
$stmtCheck->bind_param("isss", $idCliente, $nome, $data, $hora);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    $row = $resultCheck->fetch_assoc();
    $response['flag'] = true;
    $response['msg'] = "Evento já existia, a redirecionar...";
    $response['id'] = $row['ID_Evento'];
    echo json_encode($response);
    exit;
}
$stmtCheck->close();

$stmtPacote = $conn->prepare("SELECT preco FROM pacotesconvidados WHERE ID_Pacote = ?");
$stmtPacote->bind_param("i", $idPacote);
$stmtPacote->execute();
$resPacote = $stmtPacote->get_result()->fetch_assoc();
$stmtPacote->close();
$precoPacote = floatval($resPacote['preco'] ?? 0);

$precoServicos = 0;
if (is_array($servicos)) {
    foreach ($servicos as $s) {
        $idServico = intval($s);
        $stmtServ = $conn->prepare("SELECT preco FROM servicos WHERE ID_Servico = ?");
        $stmtServ->bind_param("i", $idServico);
        $stmtServ->execute();
        $resServ = $stmtServ->get_result()->fetch_assoc();
        $stmtServ->close();
        $precoServicos += floatval($resServ['preco'] ?? 0);
    }
}

$precoTotal = $precoPacote + $precoServicos;

$stmt = $conn->prepare("
    INSERT INTO eventos 
    (ID_Cliente, Nome, Data, hora, estado, ID_TipoEvento, ID_Pacote, PrecoTotal)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("issssiid", $idCliente, $nome, $data, $hora, $estado, $idTipoEvento, $idPacote, $precoTotal);

if ($stmt->execute()) {
    $response['flag'] = true;
    $response['msg'] = "Evento criado com sucesso!";
    $response['id'] = $stmt->insert_id;
} else {
    $response['msg'] = "Erro ao criar evento: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response, JSON_PRETTY_PRINT);