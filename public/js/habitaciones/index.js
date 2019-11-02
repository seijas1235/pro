
$('.loader').removeClass('is-active');

var habitaciones_table = $('#habitaciones-table').DataTable({
    "ajax": APP_URL+"/habitaciones/getJson",
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

    "columns": [     
    {
        "title": "Habitación nombre",
        "data": "habitacion",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "ubicación",
        "data": "pais",
        "width" : "20%",
        "responsivePriority": 2,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
    {
        "title": "nombre Hotel",
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
        "<a href='#' class='edit-habitacion' data-toggle='modal' data-target='#modalUpdateHabitacion' data-id='"+full.id+"' data-nombre_habitacion='"+full.habitacion+"' data-nivel_id='"+full.nivel_id+"' data-tipo_id='"+full.tipo_id+"' data-descripcion='"+full.descripcion+"' data-precio='"+full.precio+"' >" + 
        "<i class='fa fa-btn fa-edit' title='Editar Habitación'></i>" + 
        "</a>" + "</div>" + 
        "<div class='float-right col-lg-4'>" + 
        "<a href='/habitaciones/"+full.id+"/delete' class='remove-Habitacion'"+ "data-method='get'"+ ">"+ 
        "<i class='fa fa-trash-alt' title='eliminar Habitación'></i>" + 
        "</a>" + "</div>" ;          
            
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

$(document).on('click', 'a.remove-Habitacion', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var confirmacion =0;
    console.log($this);
    alertify.confirm('eliminar habitacion', 'Esta seguro de eliminar Esta habitacion', 
        function(){
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                habitaciones_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Habitacion Desactivada con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});