<?php

include_once '../model/modelFornecedores.php';

$func = new Fornecedores1();

if ($_POST['op'] == 1) {
    $resp = $func->registaFornecedores(
        $_POST['nome'],
        $_POST['contacto'],
        $_POST['email'],
        $_POST['nif'],
        $_POST['morada']
    );
    echo $resp;

} elseif ($_POST['op'] == 2) {
    $resp = $func->getListaFornecedores();
    echo $resp;

} elseif ($_POST['op'] == 3) {
    $resp = $func->removerFornecedores($_POST['ID_Fornecedor']);
    echo $resp;

} elseif ($_POST['op'] == 4) {
    $resp = $func->getDadosFornecedores($_POST['ID_Fornecedor']);
    echo $resp;

} elseif ($_POST['op'] == 5) {
    $resp = $func->guardaEditFornecedores(
        $_POST['numFornecedor'], 
        $_POST['nome'],
        $_POST['contacto'],
        $_POST['email'],
        $_POST['nif'],
        $_POST['morada'],
        $_POST['numOld']
    );
    echo $resp;
}

?>