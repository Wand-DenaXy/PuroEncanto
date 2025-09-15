function registaGastos(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("descricao", $('#descricaoGasto').val());
    dados.append("valor", $('#valorGasto').val());
    dados.append("data", $('#dataGasto').val());

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Gastos",obj.msg,"success");
            getListaGastos();
        }else{
            alerta("Gastos",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function getListaGastos(){
    
    if ( $.fn.DataTable.isDataTable('#listagemGastos') ) {
        $('#listagemGastos').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemGastos').html(msg);
        $('#tblGastos').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function removerGastos(id){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("ID_Gasto", id);

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Gastos",obj.msg,"success");
            getListaGastos();    
        }else{
            alerta("Gastos",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function registaRendimentos(){

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("descricao", $('#descricaoRendimento').val());
    dados.append("valor", $('#valorRendimento').val());
    dados.append("data", $('#dataRendimento').val());

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Rendimento",obj.msg,"success");
            getListaRendimentos();
        }else{
            alerta("Rendimento",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function getSelectGastos() {
    $.ajax({
        url: "asset/controller/controllergastoserendimentos.php",
        method: "POST",
        data: { op: 8 },
        dataType: "json"
    })
    .done(function(response) {
        if (response.flag) {
            let $select = $('#selectGastos');
            $select.append('<option value="-1">-- Selecione um gasto --</option>');
            
            $.each(response.dados, function(index, row) {
                $select.append('<option value="' + row.ID_Gasto + '">' + row.descricao + '</option>');
            });
            getListaGastos();
        } else {
            alerta("Gastos Select", response.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function getSelectRendimentos() {
    $.ajax({
        url: "asset/controller/controllergastoserendimentos.php",
        method: "POST",
        data: { op: 9 },
        dataType: "json"
    })
    .done(function(response) {
        if (response.flag) {
            let $select = $('#selectRendimentos');
            $select.append('<option value="-1">-- Selecione um Rendimento --</option>');
            
            $.each(response.dados, function(index, row) {
                getListaRendimentos();
                $select.append('<option value="' + row.ID_Rendimento + '">' + row.descricao + '</option>');
            });
        } else {
            alerta("Gastos Select", response.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function getListaRendimentos(){
    
    if ( $.fn.DataTable.isDataTable('#listagemRendimentos') ) {
        $('#listagemRendimentos').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 4);


    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemRendimentos').html(msg);
        $('#tblRendimentos').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
});
}
function getListaResumo(){
    
    if ( $.fn.DataTable.isDataTable('#listagemResumo') ) {
        $('#listagemResumo').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 7);


    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemResumo').html(msg);
        $('#tblResumo').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
});
}
function removerRendimentos(id){

    let dados = new FormData();
    dados.append("op", 6);
    dados.append("ID_Rendimento", id);

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Rendimento",obj.msg,"success");
            getListaRendimentos();    
        }else{
            alerta("Rendimento",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function RemoverResumo(id){

    let dados = new FormData();
    dados.append("op", 11);
    dados.append("ID_Finaceiro", id);

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Resumo Finaceiro",obj.msg,"success");
            getListaResumo();    
        }else{
            alerta("Resumo Finaceiro",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function registaResumo(){
    let dados = new FormData();
    dados.append("op", 10);
    dados.append("descricaoResumo", $('#descricaoResumo').val());
    dados.append("selectRendimentos", $('#selectRendimentos').val());
    dados.append("selectGastos", $('#selectGastos').val());

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Resumo Finaceiro",obj.msg,"success");
            getListaResumo();
        }else{
            alerta("Resumo Finaceiro",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
function GraficoDiferencaDashboard(){

    let dados = new FormData();
    dados.append("op", 12);
    dados.append("descricao", $('#descricao').val());
    dados.append("selectRendimentos", $('#selectRendimentos').val());
    dados.append("selectGastos", $('#selectGastos').val());

    $.ajax({
    url: "asset/controller/controllergastoserendimentos.php",
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
            alerta("Resumo Finaceiro",obj.msg,"success");
            getListaGastos();
        }else{
            alerta("Resumo Finaceiro",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}
$(function() {
    getListaRendimentos();
    getListaGastos();
    getListaResumo();
    getSelectGastos();
    getSelectRendimentos();
});