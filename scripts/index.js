$(document).ready(function() {
   
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