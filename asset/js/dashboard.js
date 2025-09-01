function getFornecedoresTop() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 7 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx4 = document.getElementById('chart4').getContext('2d');
                new Chart(ctx4, {
                    type: 'line',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Fornecedores',
                            data: response.dados2,
                            backgroundColor: 'rgba(28,200,138,0.3)',
                            borderColor: '#1cc88a',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: { display: false },
                                grid: { display: false }
                            },
                            y: {
                                ticks: { display: false },
                                grid: { display: false }
                            }
                        }
                    }
                });
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro AJAX:", error);
        }
    });
}

    function GraficoServico() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 3 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoRendimentos').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Mês de Abril',
                                data: response.dados2  , 
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                }
                            }
                        }
                    });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
    }
        function GraficoServicoMaio() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 4 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoRendimentos2').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Mês de Maio',
                                data: response.dados2, 
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                }
                            }
                        }
                    });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
    }
    function GraficoServicoJunho() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 5 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoRendimentos3').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Mês de Maio',
                                data: response.dados2, 
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                }
                            }
                        }
                    });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
    }
    function GraficoServicoDashboard() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 6 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoRendimentos4').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Total do Serviços Pagos',
                                data: response.dados2, 
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                
                                y: {
                                    beginAtZero: true,
                                    
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                }
                            }
                        }
                    });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
    }
function GraficoServicoUtilizadoAbril() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 8 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoUtilizado').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Serviços Utilizados',
                                data: response.dados2, 
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                                plugins: {
                        title: {
                            display: true,
                            text: 'Serviços mais utilizados - Abril', 
                            color: 'white',
                            font: {
                                size: 18
                            }
                        },

                    },
                            scales: {
                                x: {
                                ticks: {
                                    color: 'white'
                                },

                            },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        color: 'white',
                                        callback: value => value + ""
                                    }
                                }
                            }
                        }
                    });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
    }
function getClientesDashboard()
{
            $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 6 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx3 = document.getElementById('chart3').getContext('2d');
                    new Chart(ctx3, {
                        type: 'line',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Clientes',
                                data: response.dados2, 
                                backgroundColor: 'rgba(78,115,223,0.5)',
                                borderColor: '#4e73df',
                                fill: true
                            }]
                        },
                        options: {
                                        plugins: {
                                            legend: {
                                                display: false
                                            }
                                        },
                                        scales: {
                                            x: {
                                                display: false
                                            },
                                            y: {
                                                display: false
                                            }
                                        }
                                    }
                                });
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", error);
            }
        });
}

$(function() {
    GraficoServico();
    getServicosDashboard();
    GraficoServicoUtilizadoAbril();
    getClientesDashboard();
});
