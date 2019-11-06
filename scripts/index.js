$(document).ready(function() {
   
    GetPendent();

    function GetPendent() {
        $.ajax({
            url: 'api/get_pendent_attendances.php',
            method: 'get'
        }).done(function(response) {
            $('.pendent').html('No momento existe(m) <b><u>' + response + '</b></u> atendimento(s) pendente(s)');
        }).catch(function(error) {
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao coletar os atendimentos pendentes',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }



    $('#start_attendance').click(function(e) {
        e.preventDefault();

        StartAttendance();
    });

    function StartAttendance() {
        $.ajax({
            url: 'api/start_attendance.php',
            method: 'post',
        }).done(result => {
            window.location.href = 'attendance.php';
        }).catch(error => {
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao iniciar um atendimento: \r\n\r\n' + error.responseJSON.error.msg,
                type: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }

    $('#finish_attendance').click(function(e) {
        e.preventDefault();

        FinishAttendance();
    });

    function FinishAttendance() {
        $.ajax({
            url: 'api/finish_attendance.php',
            method: 'post',
        }).done(result => {
            window.location.href = 'index.php';
        }).catch(error => {
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao finalizar o atendimento: \r\n\r\n' + error.responseJSON.error.msg,
                type: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }
    
});