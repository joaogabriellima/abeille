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
                else
                $('#result_answer').text('Falha ao autenticar as credenciais');
            });
        }
    });
    
});