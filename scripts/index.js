$(document).ready(function() {
   
    GetPendent();

    function GetPendent() {
        CreateModal();
        $.ajax({
            url: 'api/get_pendent_attendances.php',
            method: 'get'
        }).done(function(response) {
            $('body').loadingModal('destroy');
            $('.pendent').html('No momento existe(m) <b><u>' + response + '</b></u> atendimento(s) pendente(s)');
        }).catch(function(error) {
            $('body').loadingModal('destroy');
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao pesquisar atendimentos!',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }

    function CreateModal() {
        $('body').loadingModal({
            position: 'auto',
            text: 'Carregando...',
            color: '#fff',
            opacity: '0.7',
            backgroundColor: 'rgb(0,0,0)',
            animation: 'doubleBounce'
          });
    }


    $('#start_attendance').click(function(e) {
        e.preventDefault();

        StartAttendance();
    });

    function StartAttendance() {
        CreateModal();
        $.ajax({
            url: 'api/start_attendance.php',
            method: 'post',
        }).done(result => {
            $('body').loadingModal('destroy');
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
        CreateModal();
        $.ajax({
            url: 'api/finish_attendance.php',
            method: 'post',
        }).done(result => {
            $('body').loadingModal('destroy');
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