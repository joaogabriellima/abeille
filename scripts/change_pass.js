$(document).ready(function() {
    
    $('#btn_change').click(function() {
        var oldPassword = $('#password').val();
        var new_password = $('#new_password').val();
        var repeat_pasword = $('#new_password').val();
        
        if (oldPassword != null && oldPassword != ''
        && new_password != null && new_password != ''
        && repeat_pasword != null && repeat_pasword != '') {
            
            if (new_password != repeat_pasword) {
                $('#result_answer').text('As novas senhas não coincidem');
                return;
            }
            
            if (new_password == oldPassword) {
                $('#result_answer').text('A nova senha não pode ser igual a antiga');
                return;
            }

            $.ajax({
                url: 'api/change_pass.php',
                method: 'post',
                data: 'oldpass=' + oldPassword + '&newpass=' + new_password + '&repeat_pass=' + repeat_pasword 
            }).then(function(response) {
                if (response == 'success')
                window.location.href = 'index.php';
                
                if (response == 'wrong_password')
                $('#result_answer').text('A senha atual informada não coincide com a senha atual real!');
            });
            
        }
    });
    
});