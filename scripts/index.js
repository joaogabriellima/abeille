$(document).ready(function() {
    
    
    $('#showpass').click(function() {
        var inputPassword = $('#password');
        
        if (inputPassword.attr('type') == 'password') {
            inputPassword.attr('type', 'text');
            return;
        }
        
        inputPassword.attr('type', 'password');
    });
    
    
    $('#insertUser').click(function(e) {
        e.preventDefault();
        var param = CreateObject();

        $.ajax({
            url: 'api/insert_client.php',
            method: 'post',
            data: param
        }).then(function(response) {
            var a = response;
        }).catch(function(error) {
            var a = error;
        });
    });
    
    function CreateObject() {
        var name = $('#full_name').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var permission = $('#permission').val();
        var cpf = $('#cpf').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var picture = $('#picture').val();
        
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
    
});