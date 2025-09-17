function GraficoDiferencaDashboard() {
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
                            label: 'Diferença dos Rendimentos e Gastos',
                            data: response.dados2,
                            backgroundColor: 'rgba(78,115,223,0.5)',
                            borderColor: '#4e73df',
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
                                                                                plugins: {
                            title: {
                                display: true,
                                text: 'Serviços mais utilizados - Abril',
                                color: 'white',
                                font: {
                                    size: 18
                                }
                            },
                              legend: {
                                labels: {
                                    color: 'white'
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
                                    grid: {
                                color: 'white'
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
                                                    plugins: {
                            title: {
                                display: true,
                                text: 'Serviços mais utilizados - Maio',
                                color: 'white',
                                font: {
                                    size: 18
                                }
                            },
                              legend: {
                                labels: {
                                    color: 'white'
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
                                    grid: {
                                color: 'white'
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
                                label: 'Mês de Junho',
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
                                text: 'Serviços mais utilizados - Junho',
                                color: 'white',
                                font: {
                                    size: 18
                                }
                            },
                              legend: {
                                labels: {
                                    color: 'white'
                                }
                            }
                        },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: Math.max(...response.dados2) * 1.1,
                                    ticks: {
                                        callback: value => value + " €"
                                    }
                                },
                                x: {
                                    grid: {
                                color: 'white'
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
                                 grid: {
                                    color: 'white'
                                }

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
function GraficoServicoUtilizadoMaio() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
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
                            text: 'Serviços mais utilizados - Maio', 
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
                                 grid: {
                            color: 'white'
                                }

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
function GraficoServicoUtilizadoJunho() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
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
                            text: 'Serviços mais utilizados - Junho', 
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
                                 grid: {
                                    color: 'white'
                                }

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
function getGastosDashboard()
{
        $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 9 },
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
                            label: 'Gastos',
                            data: response.dados2, 
                            backgroundColor: 'rgba(231,74,59,0.5)',
                            borderColor: '#e74a3b',
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
function getRedimentosDashboard()
{
        $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 12 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx3 = document.getElementById('chart2').getContext('2d');
                new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Redimentos',
                            data: response.dados2, 
                            backgroundColor: 'rgba(28,200,138,0.5)',
                            borderColor: '#1cc88a',
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
function getRedimentosDashboard()
{
        $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 12 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx3 = document.getElementById('chart2').getContext('2d');
                new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Redimentos',
                            data: response.dados2, 
                            backgroundColor: 'rgba(28,200,138,0.5)',
                            borderColor: '#1cc88a',
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
function getDividasReceber(){
    
    if ( $.fn.DataTable.isDataTable('#listagemPagar') ) {
        $('#listagemPagar').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 13);


    $.ajax({
    url: "asset/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemPagar').html(msg);
        $('#tblPagar').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function pagarDividasReceber(id){

    let dados = new FormData();
    dados.append("op", 14);
    dados.append("ID_Divida", id);

    $.ajax({
    url: "asset/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Divida Recebida!",obj.msg,"success");
            getDividasReceber();    
        }else{
            alerta("Divida",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function recusarDividasReceber(id)
{

    let dados = new FormData();
    dados.append("op", 15);
    dados.append("ID_Divida", id);

    $.ajax({
    url: "asset/controller/controllerDashboard.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Divida Recusada!",obj.msg,"success");
            getDividasReceber();    
        }else{
            alerta("Divida",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });


}
function GraficoTotalAtivoDashboard() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 16 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx3 = document.getElementById('chart1').getContext('2d');
                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'TotalAtivo',
                            data: response.dados2,
                            backgroundColor: 'rgba(233, 116, 81, 0.6)',
                            borderColor: '#8B4513',
                            borderWidth: 2
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

function Timer()
{
     function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        document.getElementById('time').textContent = timeString;
    }

    setInterval(updateTime, 1000);
}
function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}
function carregarDashboard() {         
    setTimeout(GraficoServico, 100);   // prioridade 1
    setTimeout(GraficoTotalAtivoDashboard, 200);
    setTimeout(GraficoDiferencaDashboard, 200);   // prioridade 2
    setTimeout(getGastosDashboard, 400);          // prioridade 3
    setTimeout(getRedimentosDashboard, 600);      // prioridade 4
    setTimeout(getDividasReceber, 800); 
    setTimeout(GraficoServicoDashboard, 900);             // prioridade 5
}
$(function() {
    // GraficoServico();
    // getServicosDashboard();
    // GraficoServicoUtilizadoAbril();
    // getGastosDashboard();
    // getRedimentosDashboard();
    // Timer();
    // getDividasReceber();
    // getTotalAtivoDashboard();
});
