var validator = $("#PaqueteForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		aerolinea_id:{
			required: true,
		},
		hotel_id:{
			required:true
		},
		
		precio_paquete:{
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
		aerolinea_id: {
			required: "Por favor, seleccione una aerolinea "
		},
		hotel_id:{
			required:"Por favor, seleccione un hotel"
		},
		
		precio_paquete:{
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
function BorrarFormularioPaquete() {
    $("#PaqueteForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonPaqueteModal").click(function(event) {
	event.preventDefault();
	if ($('#PaqueteForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	let data = new FormData($('#PaqueteForm')[0]);
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenPaquete').val()},
		url: urlActual+"/save",
		data: data,
		dataType: "json",
		contentType: false,
    	processData: false,
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioPaquete();
			$('#modalPaquete').modal("hide");
			paquetes_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Habitación Creada con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#PaqueteForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalPaquete').modal('show');
	}

	$('#modalPaquete').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioPaquete();
	});

	$('#modalPaquete').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 