let chartRendimentos = null;
let chartGastos = null;
function formatarValoresComEuro(valores) {
    return valores.map(value => '€' + parseFloat(value));
}
function GraficoDiferencaDashboard() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 7 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx4 = document.getElementById('TotalLucro').getContext('2d');
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


function GraficoServicoDashboard() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 6 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            if (response.flag) {
                const ctx = document.getElementById('graficoBalanceteDonut').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Total dos Serviços mais pedidos',
                            data: response.dados2,
                            backgroundColor: [
                                '#FF6347', '#4682B4', '#32CD32', '#FF4500', '#8A2BE2', '#FFD700', '#DC143C',
                                '#FF8C00', '#00BFFF', '#FF1493', '#20B2AA', '#D2691E', '#ADFF2F', '#A52A2A', '#7FFF00',
                                '#B22222', '#9932CC', '#FF69B4', '#4B0082', '#FA8072'
                            ],
                            borderColor: [
                                '#FF6347', '#4682B4', '#32CD32', '#FF4500', '#8A2BE2', '#FFD700', '#DC143C',
                                '#FF8C00', '#00BFFF', '#FF1493', '#20B2AA', '#D2691E', '#ADFF2F', '#A52A2A', '#7FFF00',
                                '#B22222', '#9932CC', '#FF69B4', '#4B0082', '#FA8072'
                            ], 
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    usePointStyle: true,
                                    padding: 10,
                                }
                            },
                            tooltip: {
                                enabled: true 
                            }
                        },
                        animation: {
                            animateScale: true, 
                            animateRotate: true 
                        },
                        layout: {
                            padding: {
                                right: 50
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
    function GraficoServicoDashboardSoma() {
        $.ajax({
            url: "asset/controller/controllerDashboard.php",
            type: "POST",
            data: { op: 20 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('GraficoSomaServico').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'A Soma de Tudos os Serviços Vendidos',
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
                                text: 'A Soma de Tudos os Serviços Vendidos',
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

function BotoesGraficoDashboard()
{
            $("#btnGrafico1").click(function() {
                $("#graficoBalancete").show();
                $("#graficoVendidos").hide();

                $("#btnGrafico1").addClass("active");
                $("#btnGrafico2").removeClass("active");
            });
            $("#btnGrafico2").click(function() {
                $("#graficoVendidos").show();
                $("#graficoBalancete").hide();

                $("#btnGrafico2").addClass("active");
                $("#btnGrafico1").removeClass("active");
            });
}



function getGastosDashboard() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 9 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            
            if (response.flag) {
                if (chartGastos) {
                    chartGastos.destroy();
                }

                const ctx3 = document.getElementById('TotalGastosGrafico').getContext('2d');
                chartGastos = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Gastos',
                            data: response.dados2, 
                            backgroundColor: 'rgba(231,74,59,0.5)',
                            borderColor: '#e74a3b',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
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
function getRedimentosDashboard() {
    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        type: "POST",
        data: { op: 12 },
        dataType: "json",
        success: function(response) {
            console.log("Resposta AJAX:", response);
            
            if (response.flag) {
                if (chartRendimentos) {
                    chartRendimentos.destroy();
                }

                const ctx3 = document.getElementById('TotalRendimentosGrafico').getContext('2d');
                chartRendimentos = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: response.dados1,
                        datasets: [{
                            label: 'Rendimentos',
                            data: response.dados2, 
                            backgroundColor: 'rgba(28,200,138,0.5)',
                            borderColor: '#1cc88a',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
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
function getDividasPagar(){
    
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
function pagarDividasPagar(id){

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
            alerta("Divida Aceita!",obj.msg,"success");
            getDividasPagar();
            getGastosDashboard();  
            GraficoDiferencaDashboard();  
        }else{
            alerta("Divida",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function getDividasReceber(){
    
    if ( $.fn.DataTable.isDataTable('#listagemReceber') ) {
        $('#listagemReceber').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 17);


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

        $('#listagemReceber').html(msg);
        $('#tblReceber').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function recusarDividasReceber(id)
{

    let dados = new FormData();
    dados.append("op", 18);
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


function pagarDividasReceber(id){
    let dados = new FormData();
    dados.append("op", 19);
    dados.append("ID_Evento", id);

    $.ajax({
        url: "asset/controller/controllerDashboard.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Divida Aceita!", obj.msg, "success");
            getDividasReceber();
            getRedimentosDashboard();
        } else {
            alerta("Divida", obj.msg, "error");    
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function recusarDividasPagar2(id)
{

    let dados = new FormData();
    dados.append("op", 21);
    dados.append("ID_Evento", id);

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
            getDividasPagar();    
        }else{
            alerta("Divida",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });


}
function recusarDividasPagar(id)
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
                const ctx3 = document.getElementById('TotalAtivo').getContext('2d');
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
    setTimeout(BotoesGraficoDashboard, 100); 
    setTimeout(GraficoServicoDashboardSoma, 150); 
    setTimeout(GraficoTotalAtivoDashboard, 200);
    setTimeout(GraficoDiferencaDashboard, 200);   
    setTimeout(getGastosDashboard, 400);         
    setTimeout(getRedimentosDashboard, 600);     
    setTimeout(getDividasReceber, 800); 
    setTimeout(getDividasPagar, 800); 
    setTimeout(GraficoServicoDashboard, 900);    
}
