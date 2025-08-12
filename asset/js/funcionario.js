function registaFornecedores(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", $('#nome').val());
    dados.append("contacto", $('#contacto').val());
    dados.append("email", $('#email').val());
    dados.append("nif", $('#nif').val());
    dados.append("morada", $('#morada').val());

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
            alerta("Fornecedores",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaFornecedores(){
    
    if ( $.fn.DataTable.isDataTable('#listagemFuncionarios') ) {
        $('#listagemFuncionarios').DataTable().destroy();
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

        $('#listagemFuncionarios').html(msg);
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
            alerta("Fornecedores",obj.msg,"success");
            getListaFornecedores();    
        }else{
            alerta("Fornecedores",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosFornecedores(id){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("id", id);

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
        $('#nomeEdit').val(obj.nome);    
        $('#nmFornecedor').html(obj.nome);  
        $('#contactoEdit').val(obj.contacto);
        $('#telefoneEdit').val(obj.telefone);
        $('#emailEdit').val(obj.email);
        $('#nifEdit').val(obj.nif);
        $('#moradaEdit').val(obj.morada);

       $('#btnGuardar').attr("onclick","guardaEditFornecedor("+obj.id+")") 
        
       $('#formEditFornecedor').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditFornecedores(id) {
    let dados = new FormData();
    dados.append("op", 5);
    dados.append("ID_Fornecedor", $('#numFornecedorEdit').val());
    dados.append("nome", $('#nomeEdit').val());
    dados.append("contacto", $('#contactoEdit').val());
    dados.append("email", $('#emailEdit').val());
    dados.append("nif", $('#nifEdit').val());
    dados.append("morada", $('#moradaEdit').val());
    dados.append("id", id);
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
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Fornecedor", obj.msg, "success");
            getListaFornecedores();
            $('#formEditFornecedores').modal('hide');
        } else {
            alerta("Fornecedor", obj.msg, "error");
        }
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
    getListaFornecedores();
});

