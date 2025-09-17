function registaClientes(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", $('#nomeCliente').val());
    dados.append("email", $('#EmailCliente').val());
    dados.append("nif", $('#nifCliente').val());
    dados.append("password", $('#passwordCliente').val());
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
            getListaClientes();
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
            alerta2(obj.msg,"success");
            getListaClientes();    
        }else{
            alerta("Clientes",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosClientes(ID_Cliente){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("ID_Cliente", ID_Cliente);

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
        $('#numClienteEdit').val(obj.ID_Cliente);
        $('#nomeClienteEdit').val(obj.nome);
        $('#EmailClienteEdit').val(obj.Email);
        $('#nifClienteEdit').val(obj.nif);
        $('#IBANClienteEdit').val(obj.IBAN);
        $('#formEditClientes').modal('show');
       $('#btnGuardar').attr("onclick","guardaEditClientes("+obj.ID_Cliente+")") 
        
       $('#formEditClientes').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditClientes(ID_Cliente) {
    let dados = new FormData();
    dados.append("op", 5);
    dados.append("numClienteEdit", $('#numClienteEdit').val());
    dados.append("nomeClienteEdit", $('#nomeClienteEdit').val());
    dados.append("EmailClienteEdit", $('#EmailClienteEdit').val());
    dados.append("nifClienteEdit", $('#nifClienteEdit').val());
    dados.append("IBANClienteEdit", $('#IBANClienteEdit').val());
    dados.append("ID_Cliente", ID_Cliente);

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
    $('#formEditClientes').modal('hide');
        
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta2(obj.msg,"success");
            getListaClientes();
            myModal.hide();
        } else {
            alerta("Clientes", obj.msg, "error");
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
$(function() {
    Timer();
    getListaClientes();
});

