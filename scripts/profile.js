$(document).ready(function() {
    
    $('#profile_cpf').mask('000.000.000-00', {reverse: true});
    $('#profile_phone').mask('(00) 00000-0000');
    $('#profile_cpf_edit').mask('000.000.000-00', {reverse: true});
    $('#profile_phone_edit').mask('(00) 00000-0000');
    
    $('#profile_showpass').click(function() {
        var inputPassword = $('#profile_password');
        
        if (inputPassword.attr('type') == 'password') {
            inputPassword.attr('type', 'text');
            return;
        }
        
        inputPassword.attr('type', 'password');
    });
    
    $('#profile').click(function(e) {
        e.preventDefault();
        
        var id = $(this).attr('data-id');
        
        $.ajax({
            url: 'api/getUserData.php',
            method: 'post',
            data: 'id=' + id
        }).then(function(response) {
            response = JSON.parse(response);
            OpenEditModal(response);
        });
    });

    $('#profile_saveUser').click(function(e) {
        if (!validateAllFields())
        return;
        
        var id = $(this).attr('data-id');
        
        UpdateUser(id);
    });
    
    $('#profile_picture').on('change', function() {
        var file    = document.getElementById('picture').files[0];
        var reader  = new FileReader();
        
        reader.addEventListener("load", function () {
            $('#profile_imgPreview').attr('src',reader.result);
        }, false);
        
        if (file) {
            reader.readAsDataURL(file);
        }
    });

    function validateAllFields() {
        var name = $('#profile_full_name').val();
        var login = $('#profile_login').val();
        var password = $('#profile_password').val();
        var cpf = $('#profile_cpf').val();
        var phone = $('#profile_phone').val();
        var email = $('#profile_email').val();
        var picture = $('#profile_imgPreview').attr('src');
        
        if (name == '' || name == null)
        return false;
        
        if (login == '' || login == null)
        return false;
        
        if (password == '' || password == null)
        return false;
        
        if (cpf == '' || cpf == null)
        return false;
        
        if (phone == '' || phone == null)
        return false;
        
        if (email == '' || email == null)
        return false;
        
        if (picture == '' || picture == null)
        return false;
        
        return true;
    }
    
    function UpdateUser() {
        
        var param = CreateEditObject();
        
        $.ajax({
            url: 'api/update_user.php',
            method: 'post',
            data: param
        }).done(function(response) {
            $('#profileModal').modal('hide');        
            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário atualizado com sucesso',
                type: 'success',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
            
        }).catch(function(error) {
            Swal.fire({
                title: 'Erro!',
                text: 'Um erro ocorreu ao atualizar o usuário',
                type: 'error',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
        });   
    }

    function CreateEditObject() {
        var name = $('#profile_full_name').val();
        var login = $('#profile_login').val();
        var password = $('#profile_password').val();
        var cpf = $('#profile_cpf').val();
        var phone = $('#profile_phone').val();
        var email = $('#profile_email').val();
        var picture = $('#profile_imgPreview').attr('src');
        var id = $('#profile_saveUser').attr('data-id');
        
        if (id == null) {
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu uma falha ao editar o usuário',
                type: 'error',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
            return;
        }
        
        
        var objeto = 'full_name='  + name +
        '&login='  + login +
        '&password='  + password +
        '&cpf='  + cpf +
        '&phone='  + phone +
        '&email='  + email +
        '&picture=' + picture +
        '&id=' + id;
        
        return objeto;
    }
    
    function OpenEditModal(user) {
        $('#profile_full_name').prop('readonly', true);
        $('#profile_cpf').prop('readonly', true);

        $('#profile_full_name').val(user.full_name);
        $('#profile_login').val(user.login);
        $('#profile_password').val(user.password);
        $('#profile_permission').val(user.permission);
        $('#profile_cpf').val(user.cpf);
        $('#profile_phone').val(user.phone);
        $('#profile_email').val(user.email);
        $('#profile_picture').val('');
        $('#profile_picture').attr('file', 'anon.jpg');
        $('#profile_imgPreview').attr('src', user.picture);
        
        $('#profile_saveUser').attr('data-id', user.id);
        
        $('#profileModal').modal('show');
    }
});