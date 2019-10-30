var validator = $("#VueloForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		pais1_id:{
			required:true
		},
		pais2_id:{
			required:true
		},
		aerolinea_id:{
			required:true
		},
		no_vuelo:{
			required:true
		},
		acientos:{
			required:true
		},
		precio:{
			required:true
		},

	},
	messages: {
	
		pais1_id:{
			required:"Por favor, seleccione el pais de origen"
		},
		pais2_id:{
			required:"Por favor, seleccione el pais de destino"
		},
		aerolinea_id:{
			required:"Por favor, seleccione la aerolinea"
		},
		no_vuelo:{
			required:"Por favor, ingrese el numero de vuelo"
		},
		acientos:{
			required:"Por favor, ingrese el numero de acientos del vuelo"
		},
		precio:{
			required:"Por favor, ingrese el precio"
		},

	}
});
function BorrarFormularioVuelo() {
    $("#VueloForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonVueloModal").click(function(event) {
	event.preventDefault();
	if ($('#VueloForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	var formData = $("#VueloForm").serialize();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenVuelo').val()},
		url: urlActual+"/save",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioVuelo();
			$('#modalVuelo').modal("hide");
			vuelos_table.ajax.reload();
			location.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Habitación Creada con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#VueloForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalVuelo').modal('show');
	}

	$('#modalVuelo').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioVuelo();
	});

	$('#modalVuelo').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 