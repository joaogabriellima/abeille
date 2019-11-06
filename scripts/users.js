$(document).ready(function() {
    
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#phone').mask('(00) 00000-0000');
    $('#cpf_edit').mask('000.000.000-00', {reverse: true});
    $('#phone_edit').mask('(00) 00000-0000');
    
    $('#addFunc').click(function() {
        $('#full_name').val('');
        $('#login').val('');
        $('#cpf').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#password').val('@abeille199');
        $('#picture').val('');
        $('#imgPreview').attr('src', '');
        $('#saveUser').attr('data-id', '');
        
        $('#usersModal').modal('show');
    });
    
    $('#showpass').click(function() {
        var inputPassword = $('#password');
        
        if (inputPassword.attr('type') == 'password') {
            inputPassword.attr('type', 'text');
            return;
        }
        
        inputPassword.attr('type', 'password');
    });
    
    $('#saveUser').click(function(e) {
        if (!validateAllFields())
        return;
        
        var id = $(this).attr('data-id');
        
        if (id != null && id != '') {
            UpdateUser(id);
            return;
        }
        
        InsertUser();
    });
    
    function InsertUser() {
        var param = CreateObject();
        $.ajax({
            url: 'api/insert_user.php',
            method: 'post',
            data: param
        }).done(function(response) {
            CleanAndClose();
            if (typeof response === 'string' && response.indexOf('error') >= 0) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Um usuário já está cadastrado com esses dados!',
                    type: 'error',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    location.reload();
                });
                return;
            }
            
            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário inserido com sucesso',
                type: 'success',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
            
        }).catch(function(error) {
            Swal.fire({
                title: 'Erro!',
                text: 'Um erro ocorreu ao inserir o usuário',
                type: 'error',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
        });
    }
    
    function UpdateUser() {
        
        var param = CreateEditObject();
        
        $.ajax({
            url: 'api/update_user.php',
            method: 'post',
            data: param
        }).done(function(response) {
            CleanAndClose();                
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
    
    $('.deleteUserButton').click(function(e) {
        e.preventDefault();      
        var id = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Aviso',
            text: 'Você realmente quer excluir esse usuário? Essa é uma ação irreversível',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                DeleteUser(id);
                return;
            }
        });
    });
    
    function DeleteUser(id) {
        $.ajax({
            url: 'api/delete_user.php',
            method: 'post',
            data: 'userid=' + id
        }).done(success => {
            Swal.fire({
                title: 'Sucesso!',
                text: 'Usuário excluído com sucesso',
                type: 'success',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
        }).catch(error => {
            Swal.fire({
                title: 'Erro!',
                text: 'Um erro ocorreu ao excluir o usuário!',
                type: 'error',
                confirmButtonText: 'Ok'
            }).then(result => {
                location.reload();
            });
        });
    }
    
    function validateAllFields() {
        var name = $('#full_name').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var permission = $('#permission').val();
        var cpf = $('#cpf').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var picture = $('#imgPreview').attr('src');
        
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
        var picture = $('#imgPreview').attr('src');
        
        var objeto = 'full_name='  + name +
        '&login='  + login +
        '&password='  + password +
        '&permission='  + permission +
        '&cpf='  + cpf +
        '&phone='  + phone +
        '&email='  + email +
        '&picture=' + picture;
        
        return objeto;
    }
    
    function CreateEditObject() {
        var login = $('#login').val();
        var password = $('#password').val();
        var permission = $('#permission').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var picture = $('#imgPreview').attr('src');
        var id = $('#saveUser').attr('data-id');
        
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
        
        
        var objeto = 'login='  + login +
        '&password='  + password +
        '&permission='  + permission +
        '&phone='  + phone +
        '&email='  + email +
        '&picture=' + picture +
        '&id=' + id;
        
        return objeto;
    }
    
    function CleanAndClose() {
        $('#full_name').val('');
        $('#login').val('');
        $('#cpf').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#password').val('@abeille199');
        $('#picture').val('');
        $('#imgPreview').attr('src', '');
        
        $('#usersModal').modal('hide');
    }
    
    $('#picture').on('change', function() {
        var file    = document.getElementById('picture').files[0];
        var reader  = new FileReader();
        
        reader.addEventListener("load", function () {
            $('#imgPreview').attr('src',reader.result);
        }, false);
        
        if (file) {
            reader.readAsDataURL(file);
        }
    });
    
    function OpenEditModal(user) {
        $('#full_name').prop('readonly', true);
        $('#cpf').prop('readonly', true);

        $('#full_name').val(user.full_name);
        $('#password').val(user.password);
        $('#permission').val(user.permission);
        $('#cpf').val(user.cpf);
        $('#phone').val(user.phone);
        $('#email').val(user.email);
        $('#picture').attr('file', 'anon.jpg');

        // var image = user.picture.replace(' ', '+');
        // $('#imgPreview').attr('src', image);
        
        $('#imgPreview').attr('src', user.picture);
        $('#saveUser').attr('data-id', user.id);
        
        $('#usersModal').modal('show');
    }
    
});