<?php

include_once '../model/modelEvento.php';

$func = new Eventos();

if ($_POST['op'] == 3) {
    echo $func->listarSessoesJSON($_POST['ID_Evento']);
}
 elseif ($_POST['op'] == 10) {
    echo $func->criarSessao(
        $_POST['Evento_id'],
        $_POST['ID_Cliente'],
        $_POST['nome'],
        $_POST['hora'],
        $_POST['estado'],
        $_POST['Data'],
        $_POST['ID_TipoEvento'],
        $_POST['ID_Pacote']
    );
}
if ($_POST['op'] == 2) {
    echo $func->listarEventos();
}
if ($_POST['op'] == 1) {
    echo $func->getTiposEventos();
}
?>