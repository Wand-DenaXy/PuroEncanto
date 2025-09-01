<?php

include_once '../model/modelFornecedores.php';

$func = new Fornecedores1();

if ($_POST['op'] == 1) {
    $resp = $func->registaFornecedores(
        $_POST['descricao'],
        $_POST['contacto'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['nif'],
        $_POST['total_debito']
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

}elseif ($_POST['op'] == 5) {
    $resp = $func->guardaEditFornecedores(
        $_POST['descricaoEdit'],
        $_POST['contactoEdit'],
        $_POST['emailEdit'],
        $_POST['moradaEdit'],
        $_POST['nifEdit'],
        $_POST['total_debitoEdit'],
        $_POST['ID_Fornecedor']
    );
    echo $resp;
}
?>