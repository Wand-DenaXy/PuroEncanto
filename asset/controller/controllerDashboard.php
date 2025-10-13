<?php
include_once '../model/modelDashboard.php';

$func = new Dashboard();

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
    $resp = $func->getDividasPagar();
    echo $resp;
}
if ($_POST['op'] == 14) {
    $resp = $func->pagarDividasPagar($_POST['ID_Divida']);
    echo $resp;
}
if ($_POST['op'] == 15) {
    $resp = $func->recusarDividasPagar($_POST['ID_Divida']);
    echo $resp;
}
if ($_POST['op'] == 16) {
    $resp = $func->GraficoTotalAtivoDashboard();
    echo $resp;
}
if ($_POST['op'] == 17) {
    $resp = $func->getDividasReceber();
    echo $resp;
}
if ($_POST['op'] == 18) {
    $resp = $func->recusarDividasReceber($_POST['ID_Evento']);
    echo $resp;
}
if ($_POST['op'] == 19) {
    $resp = $func->pagarDividasReceber($_POST['ID_Evento']);
    echo $resp;
}
if ($_POST['op'] == 20) {
    $resp = $func->GraficoServicoDashboardSoma();
    echo $resp;
}
if ($_POST['op'] == 21) {
    $resp = $func->recusarDividasPagar2($_POST['ID_Evento']);
    echo $resp;
}
?>