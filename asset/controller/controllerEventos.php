<?php

include_once '../model/modelEvento.php';

$func = new Eventos();

if ($_POST['op'] == 3) {
    echo $func->listarSessoesJSON($_POST['ID_Evento']);
}
if ($_POST['op'] == 2) {
    echo $func->listarEventos();
}
if ($_POST['op'] == 1) {
    echo $func->getTiposEventos();
}
if ($_POST['op'] == 5) {
    $resp = $func->removerEventos($_POST['ID_Evento']);
    echo $resp;
}
?>