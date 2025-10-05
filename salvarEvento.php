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

// Verifica se cliente está logado
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

$response['debug']['POST'] = $_POST;

// 1️⃣ Verificar se cliente existe
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

// 2️⃣ Verificar campos obrigatórios
if (!$nome || !$data || !$hora || !$idTipoEvento || !$idPacote) {
    $response['msg'] = "Campos obrigatórios em falta.";
    echo json_encode($response);
    exit;
}

// 3️⃣ Verificar se data/hora já têm evento
$stmtCheck = $conn->prepare("SELECT COUNT(*) as cnt FROM eventos WHERE Data = ? AND hora = ?");
$stmtCheck->bind_param("ss", $data, $hora);
$stmtCheck->execute();
$rowCheck = $stmtCheck->get_result()->fetch_assoc();
$stmtCheck->close();

if ($rowCheck['cnt'] > 0) {
    $response['msg'] = "Já existe um evento nesse horário!";
    echo json_encode($response);
    exit;
}

// 4️⃣ Buscar preço do pacote
$stmtPacote = $conn->prepare("SELECT preco FROM pacotesconvidados WHERE ID_Pacote = ?");
$stmtPacote->bind_param("i", $idPacote);
$stmtPacote->execute();
$resPacote = $stmtPacote->get_result()->fetch_assoc();
$stmtPacote->close();
$precoPacote = $resPacote['preco'] ?? 0;

// 5️⃣ Calcular preço dos serviços selecionados
$precoServicos = 0;
if(is_array($servicos)){
    foreach($servicos as $s){
        $idServico = intval($s);
        $stmtServ = $conn->prepare("SELECT preco FROM servicos WHERE ID_Servico = ?");
        $stmtServ->bind_param("i", $idServico);
        $stmtServ->execute();
        $resServ = $stmtServ->get_result()->fetch_assoc();
        $stmtServ->close();
        $precoServicos += $resServ['preco'] ?? 0;
    }
}

// 6️⃣ Preço total
$precoTotal = $precoPacote + $precoServicos;
$response['debug']['precoPacote'] = $precoPacote;
$response['debug']['precoServicos'] = $precoServicos;
$response['debug']['precoTotal'] = $precoTotal;

// 7️⃣ Inserir evento
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
    $response['msg'] = "Erro no execute: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response, JSON_PRETTY_PRINT);
