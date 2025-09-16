<?php
require 'connection.php';

$result = $conn->query("SELECT ID_TipoUtilizador, Tipo FROM TipoUtilizador");
$tipos = [];
while($row = $result->fetch_assoc()){
    $tipos[] = $row;
}

echo json_encode($tipos);
$conn->close();
?>

