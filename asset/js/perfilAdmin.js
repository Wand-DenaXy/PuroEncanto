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
$(function() {
    getDadosPerfil();
});
