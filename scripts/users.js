$(document).ready(function() {
    
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#phone').mask('(00) 00000-0000');
    $('#cpf_edit').mask('000.000.000-00', {reverse: true});
    $('#phone_edit').mask('(00) 00000-0000');
    
    $('#showpass').click(function() {
        var inputPassword = $('#password');
        
        if (inputPassword.attr('type') == 'password') {
            inputPassword.attr('type', 'text');
            return;
        }
        
        inputPassword.attr('type', 'password');
    });
    
    $('#showpassedit').click(function() {
        var inputPassword = $('#password_edit');
        
        if (inputPassword.attr('type') == 'password') {
            inputPassword.attr('type', 'text');
            return;
        }
        
        inputPassword.attr('type', 'password');
    });


    $('#saveUser').click(function(e) {
        if (!validateAllFields())
        return;
        
        var param = CreateObject();
        
        $.ajax({
            url: 'api/insert_user.php',
            method: 'post',
            data: param
        }).then(function(response) {
            CleanAndClose();
            if (response.indexOf('error') >= 0) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Um usuário já está cadastrado com esses dados!',
                    type: 'error',
                    confirmButtonText: 'Ok'
                })
                return;
            }
            
            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário inserido com sucesso',
                type: 'success',
                confirmButtonText: 'Ok'
            })
            
        }).catch(function(error) {
            var a = error;
        });
    });
    
    $('#saveEditedUser').click(function(e) {
        if (!validateAllEditFields())
        return;
        
        var param = CreateEditObject();
        
        $.ajax({
            url: 'api/edit_user.php',
            method: 'post',
            data: param
        }).then(function(response) {
            CleanAndClose();
            if (response.indexOf('error') >= 0) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao editar o usuário!',
                    type: 'error',
                    confirmButtonText: 'Ok'
                })
                return;
            }
            
            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário editado com sucesso',
                type: 'success',
                confirmButtonText: 'Ok'
            })
            
        }).catch(function(error) {
            var a = error;
        });
    });


    $('.editUserButton').click(function(e) {
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
    
    function validateAllFields() {
        var name = $('#full_name').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var permission = $('#permission').val();
        var cpf = $('#cpf').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var picture = $('#picture').val();
        
        if (name == '' || name == null)
        return false;
        
        if (login == '' || login == null)
        return false;
        
        if (password == '' || password == null)
        return false;
        
        if (permission == '' || permission == null)
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
    

    function validateAllEditFields() {
        var name = $('#full_name_edit').val();
        var login = $('#login_edit').val();
        var password = $('#password_edit').val();
        var permission = $('#permission_edit').val();
        var cpf = $('#cpf_edit').val();
        var phone = $('#phone_edit').val();
        var email = $('#email_edit').val();
        var picture = $('#picture_edit').val();
        
        if (name == '' || name == null)
        return false;
        
        if (login == '' || login == null)
        return false;
        
        if (password == '' || password == null)
        return false;
        
        if (permission == '' || permission == null)
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

    function CreateObject() {
        var name = $('#full_name').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var permission = $('#permission').val();
        var cpf = $('#cpf').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        
        var objeto = 'full_name='  + name +
        '&login='  + login +
        '&password='  + password +
        '&permission='  + permission +
        '&cpf='  + cpf +
        '&phone='  + phone +
        '&email='  + email;
        
        return objeto;
    }
    
    function CreateEditObject() {
        var name = $('#full_name_edit').val();
        var login = $('#login_edit').val();
        var password = $('#password_edit').val();
        var permission = $('#permission_edit').val();
        var cpf = $('#cpf_edit').val();
        var phone = $('#phone_edit').val();
        var email = $('#email_edit').val();
        var picture = $('#insertImgPreview').attr('src');
        
        var objeto = 'full_name='  + name +
        '&login='  + login +
        '&password='  + password +
        '&permission='  + permission +
        '&cpf='  + cpf +
        '&phone='  + phone +
        '&email='  + email +
        '&picture='  + picture;
        
        return objeto;
    }
    
    function CleanAndClose() {
        $('#full_name').val('');
        $('#login').val('');
        $('#cpf').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#picture').val('');
        $('#insertImgPreview').attr('src', '');
        
        $('#usersModal').modal('hide');
    }

    $('#picture').on('change', function() {
        var file    = document.getElementById('picture').files[0];
        var reader  = new FileReader();
      
        reader.addEventListener("load", function () {
            $('#insertImgPreview').attr('src',reader.result);
        }, false);
      
        if (file) {
          reader.readAsDataURL(file);
        }
    });

    function OpenEditModal(user) {
        $('#full_name_edit').val(user.full_name);
        $('#login_edit').val(user.login);
        $('#password_edit').val(user.password);
        $('#permission_edit').val(user.permission);
        $('#cpf_edit').val(user.cpf);
        $('#phone_edit').val(user.phone);
        $('#email_edit').val(user.email);
        $('#picture_edit').val(user.picture);

        $('#editUserModal').modal('show');
    }
    
});