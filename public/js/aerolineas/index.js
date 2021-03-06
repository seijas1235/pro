
$('.loader').removeClass('is-active');

var aerolineas_table = $('#aerolineas-table').DataTable({
    "ajax": APP_URL+"/aerolineas/getJson",
    "responsive": true,
    "processing": true,
    "info": true,
    "showNEntries": true,
    "dom": 'Bfrtip',

    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
    ],

    "buttons": [
    'pageLength',
    'excelHtml5',
    'csvHtml5'
    ],

    "paging": true,
    "language": {
        "sdecimal":        ".",
        "sthousands":      ",",
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
    },
    "order": [0, 'asc'],

    "columns": [ {
        "title": "No.",
        "data": "id",
        "width" : "15%",
        "responsivePriority": 1,
        "render": function( data, type, full, meta ) {
            return (data);},
    }, 
    {
        "title": "Nombre",
        "data": "nombre",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "Fecha Creación",
        "data": "fecha",
        "width" : "15%",
        "responsivePriority": 3,
        "render": function( data, type, full, meta ) {
            return (data);},
    },   
    {
        "title": "Acciones",
        "orderable": false,
        "width" : "20%",
        "render": function(data, type, full, meta) {

        return "<div id='" + full.id + "' class='text-center'>" + 
        "<div class='float-left col-lg-6'>" + 
        "<a href='#' class='edit-Aerolinea' data-toggle='modal' data-target='#modalUpdateAerolinea' data-id='"+full.id+"'  data-nombre='"+full.nombre+"' >" + 
        "<i class='fa fa-btn fa-edit' title='Editar Aerolinea'></i>" + 
        "</a>" + "</div>" + 
        "<div class='float-right col-lg-6'>" + 
        "<a href='/aerolineas/"+full.id+"/delete' class='remove-Aerolinea'"+ "data-method='get'"+ ">" + 
        "<i class='fa fa-trash-alt' title='eliminar Aerolinea'></i>" + 
        "</a>" + "</div>";          
            
        },
        "responsivePriority": 5
    }]

});

$(document).on('click', 'a.remove-Aerolinea', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var confirmacion =0;
    console.log($this);
    alertify.confirm('eliminar Aerolinea', 'Esta seguro de eliminar Esta Aerolinea', 
        function(){
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                aerolineas_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Aerolinea Desactivado con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});