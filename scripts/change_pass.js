$(document).ready(function() {
    
    $('#btn_change').click(function() {
        var oldPassword = $('#password').val();
        var new_password = $('#new_password').val();
        var repeat_pasword = $('#new_password').val();
        
        if (oldPassword != null && oldPassword != ''
        && new_password != null && new_password != ''
        && repeat_pasword != null && repeat_pasword != '') {
            
            if (new_password != repeat_pasword) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'As novas senhas não coincidem!',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
                return;
            }
            
            if (new_password == oldPassword) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'A nova senha não pode ser igual a antiga!',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
                return;
            }
            
            $.ajax({
                url: 'api/change_pass.php',
                method: 'post',
                data: 'oldpass=' + oldPassword + '&newpass=' + new_password + '&repeat_pass=' + repeat_pasword 
            }).done(function(response) {
                if (typeof response === 'string')
                {
                    if (response == "wrong_password") {
                        Swal.fire({
                            title: 'Erro!',
                            text: 'A senha atual informada não corresponde a senha atual real!',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }

                    if (response == "1") {
                        window.location.href = "attendance_hist.php";
                        return;
                    }

                    window.location.href = "index.php";
                }
            }).catch(function(error) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao alterar a senha',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
            });
            
        }
    });
    
});