$(document).ready(function() {
    
    $('#btn_login').click(function() {
        var login = $('#login_field').val();
        var password = $('#password_field').val();
        
        if (login != null && login != '' && password != null && password != '')
        {
            $.ajax({
                url: 'api/login.php',
                method: 'post',
                data: 'login=' + login + '&password=' + password  
            }).then(function(response) {
                if (response == 'success')
                window.location.href = 'index.php';
                
                if (response == 'success_first')
                window.location.href = 'change_password.php';
                
                if (response == 'login error') {
                    $('#result_answer').text('Usuário ou senha incorretos');
                    $('#password_field').text('');
                    $('#password_field').focus();
                }
                
                if (response == 'tries error')
                $('#result_answer').text('Você fez tentativas demais, por favor, espere antes de tentar novamente');
            });
        }
    });
    
});