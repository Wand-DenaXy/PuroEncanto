<?php
$sql = "SELECT Mes, Rendimentos, Gastos 
        FROM ResumoFinanceiro 
        WHERE Ano = 2025 
        ORDER BY Mes";
$result = $conn->query($sql);

$meses = [];
$rendimentos = [];
$gastos = [];

while($row = $result->fetch_assoc()) {
    // Converte número do mês para abreviação
    $meses[] = date("M", mktime(0, 0, 0, $row['Mes'], 1));
    $rendimentos[] = (float)$row['Rendimentos'];
    $gastos[] = (float)$row['Gastos'];
}
?>
<script>
const ctx = document.getElementById("chart-line").getContext("2d");
new Chart(ctx, {
    type: "line",
    data: {
        labels: <?php echo json_encode($meses); ?>,
        datasets: [{
                label: "Gastos",
                borderColor: "#cb0c9f",
                data: <?php echo json_encode($gastos); ?>,
                fill: false
            },
            {
                label: "Rendimentos",
                borderColor: "#3A416F",
                data: <?php echo json_encode($rendimentos); ?>,
                fill: false
            }
        ]
    }
});
</script>