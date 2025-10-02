<?php

include_once '../model/modelHomePage.php';
session_start();
$func = new Homepage();

if ($_POST['op'] == 1) {
    $resp = $func->getDadosTipoPerfil($_SESSION['cliente_id'],$_SESSION['tpUser']);
    echo $resp;
}
?>