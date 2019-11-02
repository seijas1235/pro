
$('.loader').removeClass('is-active');

var hoteles_table = $('#hoteles-table').DataTable({
    "ajax": APP_URL+"/hoteles/getJson",
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

    "columns": [ 
    {
        "title": "Nombre hotel",
        "data": "nombre",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    
    {
        "title": "Pais",
        "data": "pais",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    
  
    {
        "title": "Acciones",
        "orderable": false,
        "width" : "20%",
        "render": function(data, type, full, meta) {

        return "<div id='" + full.id + "' class='text-center'>" + 
        "<div class='float-left col-lg-4'>" + 
        "<a href='#' class='edit-Hotel' data-toggle='modal' data-target='#modalUpdateHotel' data-id='"+full.id+"' data-pais_id='"+full.pais_id+"' data-nombre='"+full.nombre+"' data-descripcion='"+full.descripcion+"' >" + 
        "<i class='fa fa-btn fa-edit' title='Editar Hotel'></i>" + 
        "</a>" + "</div>" + 
        "<div class='float-right col-lg-4'>" + 
        "<a href='/hoteles/"+full.id+"/delete' class='remove-Hotel'"+ "data-method='get'"+ ">" + 
        "<i class='fa fa-trash-alt' title='eliminar Hotel'></i>" + 
        "</a>" + "</div>";          
            
        },
        "responsivePriority": 5
    }]

});

$(document).on('click', 'a.remove-Hotel', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var confirmacion =0;
    console.log($this);
    alertify.confirm('eliminar Hotel', 'Esta seguro de eliminar Esta Hotel', 
        function(){
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                hoteles_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Hotel Desactivado con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});