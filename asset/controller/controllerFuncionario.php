<?php

include_once '../model/modelFuncionario.php';

$func = new Funcionario();

if ($_POST['op'] == 1) {
    $resp = $func->registaFuncionario(
        $_POST['descricao'],
        $_POST['contacto'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['nif'],
        $_POST['total_debito']
    );
    echo $resp;

} elseif ($_POST['op'] == 2) {
    $resp = $func->getListaFuncionario();
    echo $resp;

} elseif ($_POST['op'] == 3) {
    $resp = $func->removerFuncionario($_POST['ID_Funcionario']);
    echo $resp;

}
?>