<?php
include 'conect.php';

$limite_tempo = date("Y-m-d H:i:s", strtotime("-5 minutes"));

$online = $conn->query("SELECT COUNT(*) as total FROM visitantes WHERE ultima_atividade >= '$limite_tempo'")->fetch_assoc()['total'];

$total = $conn->query("SELECT COUNT(*) as total FROM visitantes")->fetch_assoc()['total'];

echo json_encode([
    "online" => $online,
    "total" => $total
]);
?>
