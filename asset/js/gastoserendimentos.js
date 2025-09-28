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
function getDadosGastos(ID_Gasto){


    let dados = new FormData();
    dados.append("op", 12);
    dados.append("ID_Gasto", ID_Gasto);

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
        $('#numGastosEdit').val(obj.ID_Gasto);
        $('#descricaoGastosEdit').val(obj.descricao);
        $('#ValorGastosEdit').val(obj.Valor);
        $('#dataGatosEdit').val(obj.Data);
        $('#formEditGastos').modal('show');
       $('#btnGuardar').attr("onclick","guardaEditGastos("+obj.ID_Gasto+")") 
        
       $('#formEditGastos').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    }); 
}
function guardaEditRendimento(ID_Rendimento) {
    let dados = new FormData();
    dados.append("op", 15);
    dados.append("descricaoRendimentoEdit", $('#descricaoRendimentoEdit').val());
    dados.append("ValorRendimentoEdit", $('#ValorRendimentoEdit').val());
    dados.append("dataRendimentoEdit", $('#dataRendimentoEdit').val());
    dados.append("ID_Rendimento", ID_Rendimento);

    $.ajax({
        url: "asset/controller/controllergastoserendimentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditRendimento').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Rendimento", obj.msg, "success");
            alerta2(obj.msg,"success");
            getListaRendimentos();
        } else {
            alerta2(obj.msg,"error");
            alerta("Rendimento", obj.msg, "error");
        }
        console.log(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function getDadosRendimentos(ID_Rendimento){


    let dados = new FormData();
    dados.append("op", 14);
    dados.append("ID_Rendimento", ID_Rendimento);

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
        $('#numRendimentoEdit').val(obj.ID_Rendimento);
        $('#descricaoRendimentoEdit').val(obj.descricao);
        $('#ValorRendimentoEdit').val(obj.Valor);
        $('#dataRendimentoEdit').val(obj.Data);
        $('#formEditRendimento').modal('show');
    $('#btnGuardar1').attr("onclick","guardaEditRendimento("+obj.ID_Rendimento+")") 
        
    $('#formEditRendimento').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    }); 
}
function guardaEditResumo(ID_Finaceiro) {
    let dados = new FormData();
    dados.append("op", 16);
    dados.append("descricaoResumoEdit", $('#descricaoResumoEdit').val());
    dados.append("ID_Finaceiro", ID_Finaceiro);

    $.ajax({
        url: "asset/controller/controllergastoserendimentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditResumo').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Resumo", obj.msg, "success");
            alerta2(obj.msg,"success");
            getListaResumo();
        } else {
            alerta2(obj.msg,"error");
            alerta("Resumo", obj.msg, "error");
        }
        console.log(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
function getDadosResumo(ID_Finaceiro){


    let dados = new FormData();
    dados.append("op", 17);
    dados.append("ID_Finaceiro", ID_Finaceiro);

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
        $('#numResumoEdit').val(obj.ID_Finaceiro);
        $('#descricaoResumoEdit').val(obj.descricao);
        $('#ID_Gastos').val(obj.ID_Gasto);
        $('#ID_Rendimentos').val(obj.ID_Rendimento);
        $('#formEditResumo').modal('show');
        $('#btnGuarda99').attr("onclick","guardaEditResumo("+obj.ID_Finaceiro+")") 
        
    $('#formEditResumo').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    }); 
}
function guardaEditGastos(ID_Gasto) {
    let dados = new FormData();
    dados.append("op", 13);
    dados.append("descricaoGastosEdit", $('#descricaoGastosEdit').val());
    dados.append("ValorGastosEdit", $('#ValorGastosEdit').val());
    dados.append("dataGatosEdit", $('#dataGatosEdit').val());
    dados.append("ID_Gasto", ID_Gasto);

    $.ajax({
        url: "asset/controller/controllergastoserendimentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditGastos').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Gastos", obj.msg, "success");
            alerta2(obj.msg,"success");
            getListaGastos();
            myModal.hide();
        } else {
            alerta2(obj.msg,"error");
            alerta("Gastos", obj.msg, "error");
        }
        console.log(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
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
    getListaRendimentos();
    getListaGastos();
    getListaResumo();
    getSelectGastos();
    getSelectRendimentos();
    Timer();
});