<?php
include_once '../model/modelperfilAdmin.php';
session_start();

$func = new Perfil();
    if ($_POST['op'] == 1) {
        $func->getDadosPerfil($_SESSION['cliente_id']);
    }
    if ($_POST['op'] == 2) {
        $func->TituloPerfil($_SESSION['cliente_id']);
    }
elseif ($_POST['op'] == 3) {
    $resp = $func->getDadosPerfilEdit($_POST['ID_Cliente']);
    echo $resp;

}elseif ($_POST['op'] == 4) {
    $resp = $func->guardaEditPerfil(
        $_POST['nomeEdit'],
        $_POST['emailEdit'],
        $_POST['NIFEdit'],
        $_POST['passwordEdit'],
        $_POST['IBANEdit'],
        $_POST['ID_Cliente']
    );
    echo $resp;
}
?>