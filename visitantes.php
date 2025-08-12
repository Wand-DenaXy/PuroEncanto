<?php
include 'connection.php';

$ip = $_SERVER['REMOTE_ADDR'];


$stmt = $conn->prepare("SELECT id FROM visitas WHERE ip = ?");
$stmt->bind_param("s", $ip);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $stmt = $conn->prepare("UPDATE visitas SET ultima_atividade = NOW() WHERE ip = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
} else {

    $stmt = $conn->prepare("INSERT INTO visitas (ip) VALUES (?)");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
}


$online_result = $conn->query("SELECT COUNT(*) AS total FROM visitas WHERE ultima_atividade > (NOW() - INTERVAL 5 MINUTE)");
$online = $online_result->fetch_assoc()['total'];


$total_result = $conn->query("SELECT COUNT(*) AS total FROM visitas");
$total = $total_result->fetch_assoc()['total'];

echo json_encode([
    'online' => $online,
    'total' => $total
]);

$conn->close();
?>
