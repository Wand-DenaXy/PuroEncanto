function getDadosTipoPerfil()
{
    let dados = new FormData();
    dados.append("op", 1);

    $.ajax({
    url: "asset/controller/controllerHomePage.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {
         $('#PerfilTipo').html(msg);
             console.log(1);
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
$(function() {
    getDadosTipoPerfil();
});