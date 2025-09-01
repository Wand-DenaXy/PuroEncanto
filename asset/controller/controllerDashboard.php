<?php
include_once '../model/modelDashboard.php';

$func = new Dashboard();


if ($_POST['op'] == 2) {
    $resp = $func->getFornecedoresDebito();
    echo $resp;
}
if ($_POST['op'] == 3) {
    $resp = $func->getServicoUsados();
    echo $resp;
}
if ($_POST['op'] == 4) {
    $resp = $func->getServicoUsadosMaio();
    echo $resp;
}
if ($_POST['op'] == 5) {
    $resp = $func->getServicoUsadosJunho();
    echo $resp;
}
if ($_POST['op'] == 6) {
    $resp = $func->GraficoServicoDashboard();
    echo $resp;
}
if ($_POST['op'] == 7) {
    $resp = $func->getFornecedoresTop();
    echo $resp;
}
if ($_POST['op'] == 8) {
    $resp = $func->GraficoServicoUtilizadoAbril();
    echo $resp;
}
if ($_POST['op'] == 9) {
    $resp = $func->getClientesDashboard();
    echo $resp;
}
?>