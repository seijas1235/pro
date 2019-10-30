var validator = $("#AerolineaForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		nombre:{
			required:true
		},

	},
	messages: {
	
		nombre:{
			required:"Por favor, ingrese el nombre de la Aerolinea"
		},

	}
});
function BorrarFormularioAerolinea() {
    $("#AerolineaForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonAerolineaModal").click(function(event) {
	event.preventDefault();
	if ($('#AerolineaForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	var formData = $("#AerolineaForm").serialize();

	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenAerolinea').val()},
		url: "aerolineas/save",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioAerolinea();
			$('#modalAerolinea').modal("hide");
			window.location.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Aerolinea Creada con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#AerolineaForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalAerolinea').modal('show');
	}

	$('#modalAerolinea').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioAerolinea();
	});

	$('#modalRuta').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 