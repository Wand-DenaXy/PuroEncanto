function registaFornecedores(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("descricao", $('#descricao').val());
    dados.append("contacto", $('#contacto').val());
    dados.append("email", $('#email').val());
    dados.append("morada", $('#morada').val());
    dados.append("nif", $('#nif').val());
    dados.append("total_debito", $('#total_debito').val());

    $.ajax({
    url: "asset/controller/controllerFornecedores.php",
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
            alerta("Fornecedores",obj.msg,"success");
            getListaFornecedores();
        }else{
            alerta2(obj.msg,"error");
            alerta("Fornecedores",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaFornecedores(){
    
    if ( $.fn.DataTable.isDataTable('#listagemFornecedores') ) {
        $('#listagemFornecedores').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
    url: "asset/controller/controllerFornecedores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemFornecedores').html(msg);
        $('#tblFornecedores').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerFornecedores(id){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("ID_Fornecedor", id);

    $.ajax({
    url: "asset/controller/controllerFornecedores.php",
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
            alerta2(obj.msg,"success");
            getListaFornecedores();    
        }else{
            alerta("Fornecedores",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosFornecedores(ID_Fornecedor){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("ID_Fornecedor", ID_Fornecedor);

    $.ajax({
    url: "asset/controller/controllerFornecedores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        $('#numFornecedorEdit').val(obj.ID_Fornecedor);
        $('#descricaoEdit').val(obj.descricao);
        $('#contactoEdit').val(obj.contacto);
        $('#emailEdit').val(obj.email);
        $('#moradaEdit').val(obj.morada);
        $('#nifEdit').val(obj.nif);
        $('#total_debitoEdit').val(obj.total_debito);
        $('#formEditFornecedores').modal('show');
       $('#btnGuardar').attr("onclick","guardaEditFornecedores("+obj.ID_Fornecedor+")") 
        
       $('#formEditFornecedor').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditFornecedores(ID_Fornecedor) {
    let dados = new FormData();
    dados.append("op", 5);
    dados.append("numFornecedorEdit", $('#numFornecedorEdit').val());
    dados.append("descricaoEdit", $('#descricaoEdit').val());
    dados.append("contactoEdit", $('#contactoEdit').val());
    dados.append("emailEdit", $('#emailEdit').val());
    dados.append("moradaEdit", $('#moradaEdit').val());
    dados.append("nifEdit", $('#nifEdit').val());
    dados.append("total_debitoEdit", $('#total_debitoEdit').val());
    dados.append("ID_Fornecedor", ID_Fornecedor);

    $.ajax({
        url: "asset/controller/controllerFornecedores.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditFornecedores').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Fornecedor", obj.msg, "success");
            alerta2(obj.msg,"success");
            getListaFornecedores();
            myModal.hide();
        } else {
            alerta2(obj.msg,"error");
            alerta("Fornecedor", obj.msg, "error");
        }
        console.log(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function getFornecedoresAbril() {
        $.ajax({
            url: "asset/controller/controllerFornecedores.php",
            type: "POST",
            data: { op: 6 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoFornecedores').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Fornecedores do Mes de Abril',
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
function getFornecedoresMaio() {
        $.ajax({
            url: "asset/controller/controllerFornecedores.php",
            type: "POST",
            data: { op: 7 },
            dataType: "json",
            success: function(response) {
                console.log("Resposta AJAX:", response);
                if (response.flag) {
                    const ctx = document.getElementById('graficoFornecedores2').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dados1,
                            datasets: [{
                                label: 'Fornecedores do Mes de Abril',
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

function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}
function alerta2(msg,icon)
{
  let customClass = '';
  if (icon === 'success') {
    customClass = 'toast-success';
  } else if (icon === 'error') {
    customClass = 'toast-error';
  }
  const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
      customClass: {
      popup: 'custom-toast'
    },
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: icon,
  title: msg
});
}
$(function() {
    getListaFornecedores();
});

