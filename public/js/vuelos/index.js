
$('.loader').removeClass('is-active');

var vuelos_table = $('#vuelos-table').DataTable({
    "ajax": APP_URL+"/vuelos/getJson",
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
        "title": "no. vuelo",
        "data": "vuelo",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "aerolinea",
        "data": "aerolinea",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "Pais origen",
        "data": "origen",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "Pais destino",
        "data": "destino",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "fecha salida",
        "data": "fecha",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    { 
        "title": "Precio",
        "data": "precio",
        "responsivePriority": 5,
        "render": function( data, type, full, meta ) {
        return ("Q."+parseFloat(Math.round(data * 100) / 100).toFixed(2));
    }},
  
    {
        "title": "Acciones",
        "orderable": false,
        "width" : "20%",
        "render": function(data, type, full, meta) {

        return "<div id='" + full.id + "' class='text-center'>" + 
        "<div class='float-left col-lg-6'>" + 
        "<a href='#' class='edit-Aerolinea' data-toggle='modal' data-target='#modalUpdateAerolinea' data-id='"+full.id+"' data-no_vuelo='"+full.vuelo+"' data-pais1_id='"+full.pais1_id+"' data-pais2_id='"+full.pais2_id+"' data-precio='"+full.precio+"' data-acientos='"+full.acientos+"' data-aerolinea_id='"+full.aerolinea_id+"' data-fecha='"+full.fecha+"' >" + 
        "<i class='fa fa-btn fa-edit' title='Editar Vuelo'></i>" + 
        "</a>" + "</div>" + 
        "<div class='float-right col-lg-6'>" + 
        "<a href='/vuelos/"+full.id+"/delete' class='remove-Aerolinea'"+ "data-method='get'"+ ">" + 
        "<i class='fa fa-thumbs-down' title='Desactivar Vuelo'></i>" + 
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
    alertify.confirm('Desactivar Vuelo', 'Esta seguro de desactivar Este Vuelo', 
        function(){
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                vuelos_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Vuelo Desactivado con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});