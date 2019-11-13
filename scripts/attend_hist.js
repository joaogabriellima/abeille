$(document).ready(function() {

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

    SearchAll();

    function SearchAll() {
        CreateModal();
        $.ajax({
            url: 'api/attend_hist_request.php',
            method: 'get',
        }).done(function(response) {
            response = JSON.parse(response);

            var source = [];
            
            if (response) {
                response.forEach(function(e) {
                    var row = ParseRow(e);
                    source.push(row);
                });
            }
            
            $('#table-attendance-hist').DataTable({
                data: source,
                columns: [
                    { title: "Número", sortable: true },
                    { title: "Atendente", sortable: true },
                    { title: "Status", sortable: true },
                    { title: "Nota", sortable: true },
                    { title: "Início", sortable: true },
                    { title: "Fim", sortable: true },
                    { title: "Tempo Total", sortable: true }
                ],
                width: '100%',
                height: '100%',
                autoWidth: false,
                paging: true,
                lengthChange: false,
                destroy: true,
                language: {
                    "emptyTable": "Não há dados disponíveis",
                    "zeroRecords": "Não há dados disponíveis",
                    "info": "Exibindo página <b>_PAGE_</b> de <b>_PAGES_</b> - _MAX_ resultado(s)",
                    "infoEmpty": "Não há dados disponíveis",
                    "infoFiltered": "(filtrado de <b>_MAX_</b> itens no total)",
                    "search": "Pesquisar: ",
                    'searchPlaceholder': 'Insira o texto aqui',
                    "lengthMenu": "_MENU_ Resultados",
                    "oPaginate": {
                        "sFirst": "Primeira",
                        "sPrevious": "Anterior",
                        "sNext": "Próxima",
                        "sLast": "Última"
                    },
                    buttons: {
                        copyTitle: 'Copiar Registros',
                        copySuccess: {
                            _: 'Copiados %d registros',
                            1: 'Copiado 1 registro'
                        }
                    }
                },
                order: [[1, 'asc']]
            });

            $('body').loadingModal('destroy');
        })
        .catch(function(error) {
            $('body').loadingModal('destroy');
            Swal.fire({
                title: 'Erro!',
                text: 'Um erro ocorreu ao pesquisar os atendimentos',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }
    

    function ParseRow(e) {
        return [
            e.queue_number,
            e.full_name,
            e.name,
            e.rate ? e.rate : 'Não Avaliado',
            moment(e.start_time).format('DD/MM/YYYY HH:mm'),
            moment(e.end_time).format('DD/MM/YYYY HH:mm'),
            e.total_time ? (e.total_time /60).toFixed(2) + ' minutos' : '-'
        ];
    }

});