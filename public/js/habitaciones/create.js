var validator = $("#HabitacionForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		nombre_habitacion:{
			required: true,
		},
		hotel_id:{
			required:true
		},
		
		precio:{
			required:true
		},
		descripcion:{
			required:true
		},
		file:{
			required:true
		}

	},
	messages: {
		nombre_habitacion: {
			required: "Por favor, ingrese nombre/número de habitación "
		},
		hotel_id:{
			required:"Por favor, seleccione un hotel"
		},
		
		precio:{
			required:"Por favor, ingrese el precio"
		},
		descripcion:{
			required:"Por favor, una descripción"
		},
		file:{
			required:'debe seleccionar una imagen de habitación'
		}
	}
});
function BorrarFormularioHabitacion() {
    $("#HabitacionForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonHabitacionModal").click(function(event) {
	event.preventDefault();
	if ($('#HabitacionForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	let data = new FormData($('#HabitacionForm')[0]);
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenHabitacion').val()},
		url: urlActual+"/save",
		data: data,
		dataType: "json",
		contentType: false,
    	processData: false,
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioHabitacion();
			$('#modalHabitacion').modal("hide");
			habitaciones_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Habitación Creada con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#HabitacionForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalHabitacion').modal('show');
	}

	$('#modalHabitacion').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioHabitacion();
	});

	$('#modalHabitacion').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 