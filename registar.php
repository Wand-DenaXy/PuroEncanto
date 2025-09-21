<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');

require 'asset/model/connection2.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if(!$data){
    echo json_encode(['flag'=>false,'msg'=>'Dados inválidos']);
    exit;
}

$nome = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$nif = trim($data['nif'] ?? '');
$iban = trim($data['iban'] ?? '');
$password = $data['password'] ?? '';
$tipo = isset($data['tipo']) ? (int)$data['tipo'] : 1;

if(!$nome || !$email || !$nif || !$iban || !$password || !$tipo){
    echo json_encode(['flag'=>false,'msg'=>'Preencha todos os campos obrigatórios!']);
    exit;
}

// Verifica email duplicado
$stmt = $conn->prepare("SELECT ID_Cliente FROM Clientes WHERE Email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0){
    $stmt->close();
    echo json_encode(['flag'=>false,'msg'=>'Email já registado!']);
    exit;
}
$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO Clientes (nome, Email, nif, Password, IBAN, ID_TipoUtilizador)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $nome, $email, $nif, $hashedPassword, $iban, $tipo);

if($stmt->execute()){
    session_start();
    $_SESSION['cliente_id'] = $stmt->insert_id;
    $_SESSION['cliente_nome'] = $nome;
    $_SESSION['cliente_email'] = $email;
    $_SESSION['tpUser'] = $tipo;

    echo json_encode(['flag'=>true,'msg'=>'Conta criada com sucesso!']);
} else {
    echo json_encode(['flag'=>false,'msg'=>'Erro ao criar conta: '.$stmt->error]);
}

$stmt->close();
$conn->close();
?>
