<?php
require 'conect.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT CONCAT(Mes, '/', Ano) AS periodo, Rendimentos, Gastos FROM ResumoFinanceiro ORDER BY Ano, Mes");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$rendimentos = [];
$gastos = [];

foreach ($data as $row) {
    $labels[] = $row['periodo'];
    $rendimentos[] = (float)$row['Rendimentos'];
    $gastos[] = (float)$row['Gastos'];
}

echo json_encode([
    'labels' => $labels,
    'rendimentos' => $rendimentos,
    'gastos' => $gastos
], JSON_NUMERIC_CHECK);
?>
