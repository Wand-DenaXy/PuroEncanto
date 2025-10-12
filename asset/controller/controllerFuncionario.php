<?php

include_once '../model/modelFuncionario.php';

$func = new Funcionario();

if ($_POST['op'] == 1) {
    $resp = $func->registaFuncionario(
        $_POST['nome'],
        $_POST['telefone'],
        $_POST['valor'],
        $_POST['NIF'],
        $_POST['ID_TipoColaboradores']
    );
    echo $resp;

} elseif ($_POST['op'] == 2) {
    $resp = $func->getListaFuncionario();
    echo $resp;

} elseif ($_POST['op'] == 3) {
    $resp = $func->removerFuncionario($_POST['ID_Colaboradores']);
    echo $resp;

}
 elseif ($_POST['op'] == 4) {
    $resp = $func->getDadosFuncionario($_POST['ID_Colaboradores']);
    echo $resp;

}elseif ($_POST['op'] == 5) {
    $resp = $func->guardaEditFuncionario(
        $_POST['nomeEdit'],
        $_POST['telefoneEdit'],
        $_POST['salarioEdit'],
        $_POST['nifEdit'],
        $_POST['ID_Colaboradores'],
        $_POST['ID_TipoColaboradoresEdit']
    );
    echo $resp;
}
elseif ($_POST['op'] == 6) {
    $resp = $func->PagarSalarioFuncionario($_POST['ID_Colaboradores']);
    echo $resp;
}



    
?>