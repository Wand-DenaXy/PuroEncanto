<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/PuroEncanto_Temp-Main/asset/model/modelLogin.php');

$log = new Login();

if (isset($_POST['op']) && $_POST['op'] == 1) {
    $resp = $log->registaUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['tpUser']);
    echo $resp;

} elseif (isset($_POST['op']) && $_POST['op'] == 2) {
    $resp = $log->login($_POST['email'], $_POST['password']);
    echo $resp;

} elseif ((isset($_POST['op']) && $_POST['op'] == 3) || (isset($_GET['op']) && $_GET['op'] == 3)) {
    $resp = $log->logout();
    header("Location: ../../index.php");
    exit;

} elseif (isset($_POST['op']) && $_POST['op'] == 4) {
    $resp = $log->getTiposUser();
    echo $resp;
}
?>
