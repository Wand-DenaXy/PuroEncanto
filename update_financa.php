<?php
include 'asset/model/connection2.php';

if (isset($_POST['id'], $_POST['field'], $_POST['valor'])) {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $valor = floatval($_POST['valor']);

    // proteger apenas campos válidos
    $allowed = ['TotalReceber', 'TotalPagar', 'Disponibilidades'];
    if (!in_array($field, $allowed)) {
        echo "Campo inválido";
        exit;
    }

    $stmt = $conn->prepare("UPDATE financas SET $field = ? WHERE ID_Financa = ?");
    $stmt->bind_param("di", $valor, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Erro ao atualizar";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Dados em falta";
}
