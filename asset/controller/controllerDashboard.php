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
if ($_POST['op'] == 6) {
    $resp = $func->GraficoServicoDashboard();
    echo $resp;
}
if ($_POST['op'] == 7) {
    $resp = $func->GraficoDiferencaDashboard();
    echo $resp;
}
if ($_POST['op'] == 8) {
    $resp = $func->GraficoServicoUtilizadoAbril();
    echo $resp;
}
if ($_POST['op'] == 9) {
    $resp = $func->getGastosDashboard();
    echo $resp;
}
if ($_POST['op'] == 10) {
    $resp = $func->GraficoServicoUtilizadoMaio();
    echo $resp;
}
if ($_POST['op'] == 11) {
    $resp = $func->GraficoServicoUtilizadoJunho();
    echo $resp;
}
if ($_POST['op'] == 12) {
    $resp = $func->getRedimentosDashboard();
    echo $resp;
}
if ($_POST['op'] == 13) {
    $resp = $func->getDividasReceber();
    echo $resp;
}
if ($_POST['op'] == 14) {
    $resp = $func->pagarDividasReceber($_POST['ID_Divida']);
    echo $resp;
}
if ($_POST['op'] == 15) {
    $resp = $func->recusarDividasReceber($_POST['ID_Divida']);
    echo $resp;
}
if ($_POST['op'] == 16) {
    $resp = $func->GraficoTotalAtivoDashboard();
    echo $resp;
}



?>