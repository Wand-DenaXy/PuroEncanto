function registaFuncionario(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("descricao", $('#descricao').val());
    dados.append("contacto", $('#contacto').val());
    dados.append("email", $('#email').val());
    dados.append("morada", $('#morada').val());
    dados.append("nif", $('#nif').val());
    dados.append("total_debito", $('#total_debito').val());

    $.ajax({
    url: "asset/controller/controllerFuncionario.php",
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
            alerta("Funcionario",obj.msg,"success");
            getListaFuncionario();
        }else{
            alerta2(obj.msg,"error");
            alerta("Funcionario",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaFuncionario(){
    
    if ( $.fn.DataTable.isDataTable('#tblFuncionario') ) {
        $('#listagemFuncionario').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
    url: "asset/controller/controllerFuncionario.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemFuncionario').html(msg);
        $('#tblFuncionario').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerFuncionario(id){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("ID_Funcionario", id);

    $.ajax({
    url: "asset/controller/controllerFuncionario.php",
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
            getListaFuncionario();    
        }else{
            alerta("Funcinario",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
$(function() {
    getListaFuncionario();
});