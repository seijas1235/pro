var validator = $("#PublicidadForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {

		descripcion:{
			required:true
		},
		file:{
			required:true
		}

	},
	messages: {

		descripcion:{
			required:"Por favor, una descripción"
		},
		file:{
			required:'debe seleccionar una imagen de la Publicidad'
		}
	}
});
function BorrarFormularioPublicidad() {
    $("#PublicidadForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonPublicidadModal").click(function(event) {
	event.preventDefault();
	if ($('#PublicidadForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	let data = new FormData($('#PublicidadForm')[0]);
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenPublicidad').val()},
		url: "publicidad/save",
		data: data,
		dataType: "json",
		contentType: false,
    	processData: false,
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioPublicidad();
			$('#modalPublicidad').modal("hide");
			publicidad_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Habitación Creada con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#PublicidadForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalPublicidad').modal('show');
	}

	$('#modalPublicidad').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioPublicidad();
	});

	$('#modalPublicidad').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 