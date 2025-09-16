function registaUser(){
    const nome = $('#username').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const contacto = $('#contacto').val();
    const tipo = $('#tpUser').val();

    if(!nome || !email || !password || !tipo){
        Swal.fire('Erro', 'Preencha todos os campos obrigatórios!', 'error');
        return;
    }

    $.ajax({
        url: 'registar.php',
        type: 'POST',
        data: JSON.stringify({nome, email, password, contacto, tipo}),
        contentType: 'application/json',
        success: function(response){
            if(response.status === 'success'){
                Swal.fire('Sucesso', response.msg, 'success').then(() => {
                    window.location.href = 'index.php';
                });
            } else {
                Swal.fire('Erro', response.msg, 'error');
            }
        }
    });
}

function getTipos(){
    $.ajax({
        url: 'getTipos.php', // Este ficheiro retorna todos os tipos da tabela TipoUtilizador
        type: 'GET',
        success: function(response){
            const tipos = JSON.parse(response);
            tipos.forEach(tipo => {
                $('#tpUser').append(`<option value="${tipo.ID_TipoUtilizador}">${tipo.Nome}</option>`);
            });
        }
    });
}
