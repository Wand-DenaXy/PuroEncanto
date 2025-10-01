<?php
session_start();
require_once 'asset/model/connection2.php';

$idCliente = $_SESSION['cliente_id'] ?? null;
$nome = $_POST['nome'] ?? '';
$data = $_POST['data'] ?? '';
$hora = $_POST['hora'] ?? '';


$flag = false;
$msg  = "Erro ao guardar evento!";

if($idCliente && $nome && $data && $hora){
    $stmtCheck = $conn->prepare("SELECT COUNT(*) as cnt FROM Eventos WHERE Data = ? AND hora = ?");
    $stmtCheck->bind_param("ss", $data, $hora);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $rowCheck = $resultCheck->fetch_assoc();

    if($rowCheck['cnt'] > 0){
        echo json_encode(['flag'=>false, 'msg'=>'Já existe um evento marcado nesse horário!']);
        exit;
    }
    $stmtCheck->close();

    $estado = "Pendente"; 
    $stmt = $conn->prepare("INSERT INTO Eventos (ID_Cliente, Nome, Data, hora, estado) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $idCliente, $nome, $data, $hora, $estado);
    if($stmt->execute()){
        $flag = true;
        $msg  = "Evento criado com sucesso!";
        $idEvento = $stmt->insert_id;
    }
    $stmt->close();
}

$conn->close();
echo json_encode(['flag'=>$flag,'msg'=>$msg,'id'=>$idEvento ?? 0]);
