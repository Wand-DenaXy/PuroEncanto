<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/login.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h2>Login</h2>

<input type="email" id="email" placeholder="Email"><br><br>
<input type="password" id="password" placeholder="Password"><br><br>

<button id="btnLogin" type="button">Entrar</button>
<p>Não tens conta? <a href="registo.html">Regista-te aqui</a></p>

<script>
$(document).ready(function(){
    $('#btnLogin').on('click', function(){
        const email = $('#email').val().trim();
        const password = $('#password').val();

        if(!email || !password){
            Swal.fire('Erro', 'Preencha todos os campos!', 'error');
            return;
        }

        $.ajax({
            url: 'controllerLogin.php',
            type: 'POST',
            dataType: 'json',
            data: { op: 2, email: email, password: password },
            success: function(res){
                if(res.flag){
                    Swal.fire({
                        icon: 'success',
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => window.location.href = 'index.php');
                } else {
                    Swal.fire('Erro', res.msg, 'error');
                }
            },
            error: function(xhr){
                Swal.fire('Erro', 'Erro no servidor: '+xhr.responseText, 'error');
            }
        });
    });
});
</script>
</body>
</html>
