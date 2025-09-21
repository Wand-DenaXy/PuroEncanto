<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/login.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="logo">
            <img src="images/logos/PURO ENCANTO LOGO.png" width="150px" alt="Logo">
        </div>
        <h2>Inicie Sessão</h2>
        <p class="subtitle">Entre com a sua conta</p>

        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" placeholder="Email">
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" placeholder="Password">
        </div>

        <button id="btnLogin" class="btn">Entrar</button>

        <p class="footer">Não tens conta? <a href="registo.html">Regista-te aqui</a></p>
    </div>
</div>

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
            url: 'asset/controller/controllerLogin.php',
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
