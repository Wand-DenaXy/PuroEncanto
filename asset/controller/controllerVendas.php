<?php
include_once '../model/modelVendas.php';

$func = new Vendas();

if ($_POST['op'] == 3) {
    $resp = $func->getServicoUsados();
    echo $resp;
}
if ($_POST['op'] == 8) {
    $resp = $func->GraficoServicoUtilizadoAbril();
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

?>