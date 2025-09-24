<?php
session_start();
require_once 'asset/model/connection2.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['ID_Cliente'];
    $nome = $_POST['nome'];
    $email = $_POST['Email'];
    $nif = $_POST['nif'];
    $iban = $_POST['IBAN'];

    $sql = "UPDATE Clientes SET nome = ?, Email = ?, nif = ?, IBAN = ? WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $nif, $iban, $id);

    if ($stmt->execute()) {
        header("Location: perfil.php?success=1");
        exit();
    } else {
        echo "Erro ao atualizar perfil: " . $conn->error;
    }
}
