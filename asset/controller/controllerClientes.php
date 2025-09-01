<?php

include_once '../model/modelClientes.php';

$func = new Clientes();

if ($_POST['op'] == 1) {
    $resp = $func->registaClientes(
        $_POST['nome'],
        $_POST['nif'],
        $_POST['morada'],
        $_POST['IBAN'],
    );
    echo $resp;

} elseif ($_POST['op'] == 2) {
    $resp = $func->getListaClientes();
    echo $resp;

} elseif ($_POST['op'] == 3) {
    $resp = $func->removerClientes($_POST['ID_Cliente']);
    echo $resp;

} elseif ($_POST['op'] == 4) {
    $resp = $func->getDadosClientes($_POST['ID_Cliente']);
    echo $resp;

}elseif ($_POST['op'] == 5) {
    $resp = $func->guardaEditClientes(
        $_POST['numFornecedorEdit'],
        $_POST['descricaoEdit'],
        $_POST['contactoEdit'],
        $_POST['emailEdit'],
        $_POST['moradaEdit'],
        $_POST['nifEdit'],
        $_POST['total_debitoEdit']
    );
    echo $resp;
}

?>