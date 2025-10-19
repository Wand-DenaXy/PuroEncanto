function getDadosPerfil()
{
    let dados = new FormData();
    dados.append("op", 1);

    $.ajax({
    url: "asset/controller/controllerperfilAdmin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {
         $('.profile-body').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function getButtonEdit()
{
    let dados = new FormData();
    dados.append("op", 10);

    $.ajax({
    url: "asset/controller/controllerperfilAdmin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {
         $('#buttonEdit').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function TituloPerfil()
{
    let dados = new FormData();
    dados.append("op", 2);

    $.ajax({
    url: "asset/controller/controllerperfilAdmin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {
         $('#perfilAdmin').html(msg);
         
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
function getDadosPerfilEdit(ID_Cliente){


    let dados = new FormData();
    dados.append("op", 3);
    dados.append("ID_Cliente", ID_Cliente);

    $.ajax({
    url: "asset/controller/controllerperfilAdmin.php",
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
        $('#emailEdit').val(obj.Email);
        $('#NIFEdit').val(obj.nif);
        $('#passwordEdit').val(obj.Password);
        $('#IBANEdit').val(obj.IBAN);
        $('#formEditFornecedores').modal('show');
       $('#btnGuardar').attr("onclick","guardaEditPerfil("+obj.ID_Cliente+")") 
        
       $('#formEditPerfil').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditPerfil(ID_Cliente) {
    let dados = new FormData();
    dados.append("op", 4);
    dados.append("nomeEdit", $('#nomeEdit').val());
    dados.append("emailEdit", $('#emailEdit').val());
    dados.append("NIFEdit", $('#NIFEdit').val());
    dados.append("passwordEdit", $('#passwordEdit').val());
    dados.append("IBANEdit", $('#IBANEdit').val());
    dados.append("ID_Cliente", ID_Cliente);

    $.ajax({
        url: "asset/controller/controllerperfilAdmin.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
    $('#formEditPerfil').modal('hide');
    getDadosPerfil();
    TituloPerfil();
        let obj = JSON.parse(msg);
        if(obj.flag) {
            alerta2(obj.msg,"success");
            myModal.hide();
        } else {
            alerta("Perfil", obj.msg, "error");
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
$(function() {
    TituloPerfil();
    getDadosPerfil();
});
