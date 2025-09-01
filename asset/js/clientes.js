function registaClientes(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", $('#nomeCliente').val());
    dados.append("nif", $('#nifCliente').val());
    dados.append("morada", $('#moradaCliente').val());
    dados.append("IBAN", $('#IBANCliente').val());

    $.ajax({
    url: "asset/controller/controllerClientes.php",
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
            alerta("Clientes",obj.msg,"success");
            getListaFornecedores();
        }else{
            alerta("Clientes",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaClientes(){
    
    if ( $.fn.DataTable.isDataTable('#listagemClientes') ) {
        $('#listagemClientes').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
    url: "asset/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemClientes').html(msg);
        $('#tblClientes ').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerClientes(id){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("ID_Cliente", id);

    $.ajax({
    url: "asset/controller/controllerClientes.php",
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
            alerta("Clientes",obj.msg,"success");
            getListaFornecedores();    
        }else{
            alerta("Clientes",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosClientes(id){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("id", id);

    $.ajax({
    url: "asset/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        $('#numFornecedorEdit').val(obj.ID_Cliente);
        $('#nomeEdit').val(obj.nome);    
        $('#nmFornecedor').html(obj.nif);  
        $('#contactoEdit').val(obj.morada);
        $('#telefoneEdit').val(obj.IBAN);

       $('#btnGuardar').attr("onclick","guardaEditFornecedor("+obj.id+")") 
        
       $('#formEditFornecedor').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditClientes(id) {
    let dados = new FormData();
    dados.append("op", 5);
    dados.append("numFornecedorEdit", $('#numFornecedorEdit').val());
    dados.append("descricaoEdit", $('#descricaoEdit').val());
    dados.append("contactoEdit", $('#contactoEdit').val());
    dados.append("emailEdit", $('#emailEdit').val());
    dados.append("moradaEdit", $('#moradaEdit').val());
    dados.append("nifEdit", $('#nifEdit').val());
    dados.append("total_debitoEdit", $('#total_debitoEdit').val());
    dados.append("id", id);

    $.ajax({
        url: "asset/controller/controllerClientes.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        var myModal = new bootstrap.Modal(document.getElementById('formEditFornecedores'));
        myModal.show();
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Fornecedor", obj.msg, "success");
            getListaFornecedores();
            myModal.hide();
        } else {
            alerta("Fornecedor", obj.msg, "error");
        }
        console.log(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
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


$(function() {
    getListaClientes();
});

