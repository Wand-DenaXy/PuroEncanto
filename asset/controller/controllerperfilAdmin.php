<?php
include_once '../model/modelperfilAdmin.php';
session_start();

$func = new Perfil();
    if ($_POST['op'] == 1) {
        $func->getDadosPerfil($_SESSION['ID_Cliente']);
    }
?>