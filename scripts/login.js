$(document).ready(function() {
    
    $('#btn_login').click(function() {
        makeLogin();
    });
    
    $('.logininput').keypress(function (e) {
        if (e.which == 13) {
            makeLogin();
            return false;
        }
    });
    
    
    function makeLogin() {
        var login = $('#login_field').val();
        var password = $('#password_field').val();
        
        if (login == null || login == '' || password == null || password == '') {
            $('#result_answer').text('Por favor, preencha os campos antes de continuar!');
            return;
        }
        
        $('#result_answer').text('');
        
        $.ajax({
            url: 'api/login_request.php',
            method: 'post',
            data: 'login=' + login + '&password=' + password  
        }).then(function(response) {
            if (response == 'success_adm')
            window.location.href = 'attendance_hist.php';

            if (response == 'success_atd')
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