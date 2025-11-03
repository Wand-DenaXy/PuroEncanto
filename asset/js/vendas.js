    function GraficoServico() {
        $.ajax({
            url: "asset/controller/controllerVendas.php",
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
                                label: 'Trimestral',
                                data: response.dados2  , 
                                backgroundColor: 'rgb(163, 117, 66)',
                                borderColor: 'rgba(0, 0, 0, 1), 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                            title: {
                                display: true,
                                text: 'Serviço que mais rendeu',
                                color: 'black',
                                font: {
                                    size: 18
                                }
                            },
                              legend: {
                                labels: {
                                    color: 'black'
                                }
                            }
                        },
                        
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                },
                                x: {
                                ticks: {
                                    color: 'black'
                                },
                                 grid: {
                                    color: 'black'
                                }
                            },
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
            url: "asset/controller/controllerVendas.php",
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
                                backgroundColor: 'rgb(163, 117, 66)',
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                                plugins: {
                        title: {
                            display: true,
                            text: 'Serviços mais utilizados', 
                            color: 'black',
                            font: {
                                size: 18
                            }
                        },

                    },
                            scales: {
                                x: {
                                ticks: {
                                    color: 'black'
                                },
                                 grid: {
                                    color: 'black'
                                }

                            },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        color: 'black',
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
function GraficoServicoUtilizadoMaio() {
        $.ajax({
            url: "asset/controller/controllerVendas.php",
            type: "POST",
            data: { op: 10 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoUtilizado2').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Serviços Utilizados',
                                data: response.dados2, 
                                backgroundColor: 'rgb(163, 117, 66)',
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                                plugins: {
                        title: {
                            display: true,
                            text: 'Serviços mais utilizados', 
                            color: 'black',
                            font: {
                                size: 18
                            }
                        },

                    },
                            scales: {
                                x: {
                                ticks: {
                                    color: 'black'
                                },
                                 grid: {
                            color: 'black'
                                }

                            },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        color: 'black',
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
function GraficoServicoUtilizadoJunho() {
        $.ajax({
            url: "asset/controller/controllerVendas.php",
            type: "POST",
            data: { op: 11 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoUtilizado3').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Serviços Utilizados',
                                data: response.dados2, 
                                backgroundColor: 'rgb(163, 117, 66)',
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                                plugins: {
                        title: {
                            display: true,
                            text: 'Serviços mais utilizados', 
                            color: 'black',
                            font: {
                                size: 18
                            }
                        },

                    },
                            scales: {
                                x: {
                                ticks: {
                                    color: 'black'
                                },
                                 grid: {
                                    color: 'black'
                                }

                            },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        color: 'black',
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
$(function() {
     function atualizarHora() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const elemento = document.getElementById('time');
            if (elemento) {
                elemento.textContent = now.toLocaleDateString('pt-PT', options);
            }
        }
        
        atualizarHora();

    setInterval(atualizarHora, 60000);
    setTimeout(GraficoServico, 600);     
    setTimeout(GraficoServicoUtilizadoAbril, 800); 
    setTimeout(GraficoServicoUtilizadoMaio, 800); 
    setTimeout(GraficoServicoUtilizadoJunho, 900);  
});