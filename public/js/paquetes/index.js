
$('.loader').removeClass('is-active');

var paquetes_table = $('#paquetes-table').DataTable({
    "ajax": APP_URL+"/paquetes/getJson",
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
    "order": [0, 'desc'],

    "columns": [ {
        "title": "No.",
        "data": "id",
        "width" : "15%",
        "responsivePriority": 1,
        "render": function( data, type, full, meta ) {
            return (data);},
    }, 
    {
        "title": "Titulo",
        "data": "descripcion",
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
        "title": "Pais",
        "data": "pais",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "Hotel",
        "data": "hotel",
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
        "<div class='float-left col-lg-4'>" + 
        "<a href='#' class='edit-Paquete' data-toggle='modal' data-target='#modalUpdatePaquete' data-id='"+full.id+"' data-precio_paquete='"+full.precio+"' data-hotel_id='"+full.hotel_id+"' data-aerolinea_id='"+full.aerolinea_id+"' data-descripcion='"+full.descripcion+"'  >" + 
        "<i class='fa fa-btn fa-edit' title='Editar Paquete'></i>" + 
        "</a>" + "</div>" + 
        "<div class='float-right col-lg-4'>" + 
        "<a href='/paquetes/"+full.id+"/delete' class='remove-Paquete'"+ "data-method='get'"+ ">"+ 
        "<i class='fa fa-trash-alt' title='eliminar Paquete'></i>" + 
        "</a>" + "</div>"  + 
        "<div class='float-left col-lg-4'>" + 
        "<a href='#' class='mostar-image' data-toggle='modal' data-target='#ModalImagen' data-imagen='"+full.imagen+"'>" + 
        "<i class='fa fa-images' title='Mostrar imagen'></i>" + 
        "</a>" + "</div>";          
            
        },
        "responsivePriority": 5
    }]

});
//Confirmar Contraseña para borrar
$("#btnConfirmarAccion").click(function(event) {
    event.preventDefault();
	if ($('#ConfirmarAccionForm').valid()) {
		
		confirmarAccion();
	} else {
		validator.focusInvalid();
	}
});

$(document).on('click', 'a.remove-Paquete', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var confirmacion =0;
    console.log($this);
    alertify.confirm('eliminar Paquete', 'Esta seguro de eliminar Esta Paquete', 
        function(){
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                paquetes_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Paquete Desactivado con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});