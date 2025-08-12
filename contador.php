<?php
include 'connection.php'; 

$ip = $_SERVER['REMOTE_ADDR'];
$agora = date("Y-m-d H:i:s");

$sql = $conn->prepare("SELECT * FROM visitantes WHERE ip = ?");
$sql->bind_param("s", $ip);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $conn->query("UPDATE visitantes SET ultima_atividade = '$agora', total_visitas = total_visitas + 1 WHERE ip = '$ip'");
} else {
    $conn->query("INSERT INTO visitantes (ip, ultima_atividade, total_visitas) VALUES ('$ip', '$agora', 1)");
}

$conn->close();
?>