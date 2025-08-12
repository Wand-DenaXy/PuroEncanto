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
        $('#nomeEdit').val(obj.nome);    
        $('#nmClube').html(obj.nome);  
        $('#anoFundacaoEdit').val(obj.anoF);
        $('#telefoneEdit').val(obj.telefone);
        $('#emailEdit').val(obj.email);
        $('#localidadeEdit').val(obj.localidade);
        $('#logoAtual').attr('src', obj.logo);

       $('#btnGuardar').attr("onclick","guardaEditClube("+obj.id+")") 
        
       $('#formEditClube').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditFornecedores(id){

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("nome", $('#nomeEdit').val());
    dados.append("anoFundacao", $('#anoFundacaoEdit').val());
    dados.append("telefone", $('#telefoneEdit').val());
    dados.append("email", $('#emailEdit').val());
    dados.append("localidade", $('#localidadeEdit').val());
    dados.append("logotipo", $('#logotipoEdit').prop('files')[0]);
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
        if(obj.flag){
            alerta("Clube",obj.msg,"success");
            getListaFornecedores();
            $('#formEditClube').modal('hide')    
        }else{
            alerta("Clube",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
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

