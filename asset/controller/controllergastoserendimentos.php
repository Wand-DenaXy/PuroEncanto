<?php

include_once '../model/modelrendimentosegatos.php';

$func = new Gastos();

if ($_POST['op'] == 1) {
    $resp = $func->registaGastos(
        $_POST['descricao'],
        $_POST['valor'],
        $_POST['data']
    );
    echo $resp;
}
elseif ($_POST['op'] == 2) 
{
    $resp = $func->getListaGastos();
    echo $resp;
}
elseif ($_POST['op'] == 3) {
    $resp = $func->removerGastos($_POST['ID_Gasto']);
    echo $resp;

}
elseif ($_POST['op'] == 4) 
{
    $resp = $func->getListaRendimentos();
    echo $resp;
}
if ($_POST['op'] == 5) {
    $resp = $func->registaRendimentos(
        $_POST['descricao'],
        $_POST['valor'],
        $_POST['data']
    );
    echo $resp;
}
elseif ($_POST['op'] == 6) {
    $resp = $func->removerRendimentos($_POST['ID_Rendimento']);
    echo $resp;

}
elseif ($_POST['op'] == 7) 
{
    $resp = $func->getListaResumo();
    echo $resp;
}
elseif ($_POST['op'] == 8) 
{
    $resp = $func->getSelectGastos();
    echo $resp;
}
elseif ($_POST['op'] == 9) 
{
    $resp = $func->getSelectRendimentos();
    echo $resp;
}
elseif ($_POST['op'] == 10) 
{
    $resp = $func->registaResumo(
        $_POST['descricaoResumo'],
        $_POST['selectRendimentos'],
        $_POST['selectGastos']
    );
    echo $resp;
}
elseif ($_POST['op'] == 11) {
    $resp = $func->RemoverResumo($_POST['ID_Finaceiro']);
    echo $resp;
}
 elseif ($_POST['op'] == 12) {
    $resp = $func->getDadosGastos($_POST['ID_Gasto']);
    echo $resp;

}elseif ($_POST['op'] == 13) {
    $resp = $func->guardaEditGastos(
        $_POST['descricaoGastosEdit'], 
        $_POST['ValorGastosEdit'],      
        $_POST['dataGatosEdit'],   
        $_POST['ID_Gasto']            
    );
    echo $resp;
}
 elseif ($_POST['op'] == 14) {
    $resp = $func->getDadosRendimentos($_POST['ID_Rendimento']);
    echo $resp;

}elseif ($_POST['op'] == 15) {
    $resp = $func->guardaEditRendimento(
        $_POST['descricaoRendimentoEdit'], 
        $_POST['ValorRendimentoEdit'],      
        $_POST['dataRendimentoEdit'],   
        $_POST['ID_Rendimento']            
    );
    echo $resp;
}
 elseif ($_POST['op'] == 17) {
    $resp = $func->getDadosResumo($_POST['ID_Finaceiro']);
    echo $resp;

}elseif ($_POST['op'] == 16) {
    $resp = $func->guardaEditResumo(
        $_POST['descricaoResumoEdit'],   
        $_POST['ID_Finaceiro']            
    );
    echo $resp;
}
elseif ($_POST['op'] == 19) {
    $resp = $func->getRedimentosGrafico();
    echo $resp;
}
elseif ($_POST['op'] == 18) {
    $resp = $func->getGastosGrafico();
    echo $resp;
}
?>