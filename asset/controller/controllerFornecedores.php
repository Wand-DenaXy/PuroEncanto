<?php

require_once '../model/modelFornecedores.php';

$func = new Fornecedores();

if($_POST['op'] == 1){
    $resp = $func -> registaFornecedores(
        $_POST['numJogador'],
        $_POST['nome'],
        $_POST['idade'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['clube'],
        $_FILES
    );
    echo ($resp);

}else if($_POST['op'] == 2){
    $resp = $func -> getListaFornecedores();
    echo($resp);

}else if($_POST['op'] == 3){
    $resp = $func -> removerFornecedores($_POST['num']);
    echo($resp);

}else if($_POST['op'] == 4){
    $resp = $func -> getDadosFornecedores($_POST['num']);
    echo($resp);

}else if($_POST['op'] == 5){
    $resp = $func -> guardaEditFornecedores(
        $_POST['numJogador'],
        $_POST['nome'],
        $_POST['idade'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['clube'],
        $_POST['numOld'],
        $_FILES
    );
    echo ($resp);

}
?>