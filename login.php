<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Puro Encanto</title>
<link rel="stylesheet" href="css/modern-auth.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

</style>
</head>
<body>

<div class="auth-container">
    <div class="auth-background">
        <div class="gradient-overlay"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>

    <div class="auth-card login-card">
        <div class="auth-header">
            <div class="logo">
                <img src="images/logos/PURO ENCANTO LOGO.png" alt="Puro Encanto Logo">
            </div>
            <h1>Bem-vindo de Volta</h1>
            <p>Entre na sua conta para continuar</p>
        </div>

        <form class="auth-form" id="loginForm">
            <div class="input-group">
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <input type="email" id="email" placeholder="seu@email.com" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" id="password" placeholder="Introduza a sua password" required>
                <label>Password</label>
                <button type="button" class="toggle-password" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <div class="form-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="rememberMe">
                    <span class="checkmark"></span>
                    <span class="checkbox-label">Lembrar-me</span>
                </label>
                <a href="#" class="forgot-password">Esqueceu a password?</a>
            </div>

            <button type="button" id="btnLogin" class="btn-primary">
                <span>Entrar</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="social-login">
                <button type="button" class="btn-social btn-google">
                    <i class="fab fa-google"></i>
                    <span>Continuar com Google</span>
                </button>
            </div>
        </form>

        <div class="auth-footer">
            <p>Não tem conta? <a href="registo.html" class="link-primary">Registe-se aqui</a></p>
        </div>
    </div>
</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = event.currentTarget.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

$(document).ready(function(){
    // Animação dos inputs
    $('.auth-form input').on('focus', function(){
        $(this).closest('.input-group').addClass('focused');
    }).on('blur', function(){
        if(!$(this).val()) {
            $(this).closest('.input-group').removeClass('focused');
        }
    });

    // Verificar se tem valores ao carregar (autofill)
    setTimeout(function(){
        $('.auth-form input').each(function(){
            if($(this).val()) {
                $(this).closest('.input-group').addClass('focused');
            }
        });
    }, 100);

    // Login
    $('#btnLogin').on('click', function(){
        const btn = $(this);
        const email = $('#email').val().trim();
        const password = $('#password').val();

        if(!email || !password){
            Swal.fire({
                icon: 'warning',
                title: 'Campos Vazios',
                text: 'Por favor, preencha todos os campos!',
                confirmButtonColor: '#d1ae79',
                background: '#4b2e12',
                color: '#e6d7c3'
            });
            return;
        }

        // Validação básica de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email)){
            Swal.fire({
                icon: 'error',
                title: 'Email Inválido',
                text: 'Por favor, introduza um email válido!',
                confirmButtonColor: '#d1ae79',
                background: '#4b2e12',
                color: '#e6d7c3'
            });
            return;
        }

        btn.addClass('loading').prop('disabled', true);
        btn.find('span').text('A entrar...');

        $.ajax({
            url: 'asset/controller/controllerLogin.php',
            type: 'POST',
            dataType: 'json',
            data: { op: 2, email: email, password: password },
            success: function(res){
                btn.removeClass('loading').prop('disabled', false);
                btn.find('span').text('Entrar');

                if(res.flag){
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Efetuado!',
                        text: res.msg,
                        confirmButtonColor: '#d1ae79',
                        background: '#4b2e12',
                        color: '#e6d7c3',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => window.location.href = 'index.php');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de Autenticação',
                        text: res.msg,
                        confirmButtonColor: '#d1ae79',
                        background: '#4b2e12',
                        color: '#e6d7c3'
                    });
                }
            },
            error: function(xhr){
                btn.removeClass('loading').prop('disabled', false);
                btn.find('span').text('Entrar');
                
                Swal.fire({
                    icon: 'error',
                    title: 'Erro no Servidor',
                    text: 'Ocorreu um erro. Tente novamente mais tarde.',
                    confirmButtonColor: '#d1ae79',
                    background: '#4b2e12',
                    color: '#e6d7c3'
                });
            }
        });
    });

    // Enter para submeter
    $('.auth-form input').on('keypress', function(e){
        if(e.which === 13) {
            $('#btnLogin').click();
        }
    });

    // Forgot password
    $('.forgot-password').on('click', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Recuperar Password',
            text: 'Introduza o seu email:',
            input: 'email',
            inputPlaceholder: 'seu@email.com',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d1ae79',
            cancelButtonColor: '#64748b',
            background: '#4b2e12',
            color: '#e6d7c3'
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Email Enviado!',
                    text: 'Verifique a sua caixa de entrada.',
                    confirmButtonColor: '#d1ae79',
                    background: '#4b2e12',
                    color: '#e6d7c3'
                });
            }
        });
    });

    // Social login (exemplo)
    $('.btn-google').on('click', function(){
        Swal.fire({
            icon: 'info',
            title: 'Em Breve',
            text: 'Login com Google em desenvolvimento.',
            confirmButtonColor: '#d1ae79',
            background: '#4b2e12',
            color: '#e6d7c3'
        });
    });
});
</script>

</body>
</html>