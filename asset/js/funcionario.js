function registaFuncionario(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", $('#nomeFuncionario').val());
    dados.append("telefone", $('#contactoFuncionario').val());
    dados.append("valor", $('#salarioFuncionario').val());
    dados.append("NIF", $('#NIFFuncionario').val());
    dados.append("ID_TipoColaboradores", $('#ID_TipoColaboradores').val());

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
            alerta("Colaborador",obj.msg,"success");
            getListaFuncionario();
        }else{
            alerta2(obj.msg,"error");
            alerta("Colaborador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaFuncionario(){
    
    if ( $.fn.DataTable.isDataTable('#listagemFuncionario') ) {
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
    dados.append("ID_Colaboradores", id);

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
function PagarSalarioFuncionario(id){

    let dados = new FormData();
    dados.append("op", 6);
    dados.append("ID_Colaboradores", id);

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
function getDadosFuncionario(ID_Colaboradores){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("ID_Colaboradores", ID_Colaboradores);

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
        $('#numFuncionarioEdit').val(obj.ID_Colaboradores);
        $('#nomeEdit').val(obj.nome);
        $('#telefoneEdit').val(obj.telefone);
        $('#salarioEdit').val(obj.valor);
        $('#nifEdit').val(obj.NIF);
        $('#ID_TipoColaboradoresEdit').val(obj.ID_TipoColaboradores);
        $('#formEditFornecedores').modal('show');
       $('#btnGuardar').attr("onclick","guardaEditFuncionario("+obj.ID_Colaboradores+")") 
        
       $('#formEditFuncionario').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditFuncionario(ID_Colaboradores) {
    let dados = new FormData();
    dados.append("op", 5);
    dados.append("numFuncionarioEdit", $('#numFuncionarioEdit').val());
    dados.append("nomeEdit", $('#nomeEdit').val());
    dados.append("telefoneEdit", $('#telefoneEdit').val());
    dados.append("salarioEdit", $('#salarioEdit').val());
    dados.append("nifEdit", $('#nifEdit').val());
    dados.append("ID_TipoColaboradoresEdit", $('#ID_TipoColaboradoresEdit').val());
    dados.append("ID_Colaboradores", ID_Colaboradores);

    $.ajax({
        url: "asset/controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditFuncionario').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta("Fornecedor", obj.msg, "success");
            alerta2(obj.msg,"success");
            getListaFuncionario();
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
$(function() {
    getListaFuncionario();
});