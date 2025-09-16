<?php
require 'connection.php';

$data = json_decode(file_get_contents('php://input'), true);

if(!$data){
    echo json_encode(['status' => 'error', 'msg' => 'Dados inválidos!']);
    exit;
}

$nome = trim($data['nome']);
$email = trim($data['email']);
$password = trim($data['password']);
$contacto = trim($data['contacto'] ?? '');
$tipo = trim($data['tipo']);

if(!$nome || !$email || !$password || !$tipo){
    echo json_encode(['status' => 'error', 'msg' => 'Preencha todos os campos obrigatórios!']);
    exit;
}


$stmt = $conn->prepare("SELECT ID_Utilizador FROM utilizador WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$stmt->store_result();
if($stmt->num_rows > 0){
    $stmt->close();
    echo json_encode(['status' => 'error', 'msg' => 'Email já registado!']);
    exit;
}
$stmt->close();


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO utilizador (Nome, Email, Password, Contacto, ID_TipoUtilizador) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $nome, $email, $hashedPassword, $contacto, $tipo);

if($stmt->execute()){
    echo json_encode(['status' => 'success', 'msg' => 'Conta criada com sucesso!']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Erro ao criar conta.']);
}

$stmt->close();
$conn->close();
?>
