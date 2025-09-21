<?php

include_once '../model/modelEvento.php';

$func = new Eventos();

if ($_POST['op'] == 3) {
    header('Content-Type: application/json; charset=utf-8');
    echo $func->listarSessoesJSON($_POST['ID_Evento']);
    exit;
}
 elseif ($_POST['op'] == 10) {
    echo $func->criarSessao(
        $_POST['ID_Evento'],
        $_POST['ID_Cliente'],
        $_POST['data'],
        $_POST['hora'],
        $_POST['estado']
    );
}
if ($_POST['op'] == 2) {
    echo $func->listarEventos();
}
if ($_POST['op'] == 1) {
    echo $func->getTiposEventos();
}
?>