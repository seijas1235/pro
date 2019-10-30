var validator = $("#HotelForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		file:{ required: true},
		pais_id:{
			required:true
		},
		descripcion:{
			required:true
		},
		nombre:{
			required:true
		},

	},
	messages: {
	
		pais_id:{
			required:"Por favor, seleccione el primer pais"
		},
		descripcion:{
			required:"Por favor, ingrese una descripcion del hotel"
		},
		nombre:{
			required:"Por favor, ingrese el nombre del hotel"
		},
		file:{
			required:"debe seleccionar la imagen del Hotel"
		}

	}
});
function BorrarFormularioHotel() {
    $("#HotelForm :input").each(function () {
        $(this).val('');
	});
	$('#roles').val('');
	$('#roles').change();
};

$("#ButtonHotelModal").click(function(event) {
	event.preventDefault();
	if ($('#HotelForm').valid()) {

		saveModal();
	} else {
		validator.focusInvalid();
	}
});

function saveModal(button) {
	$('.loader').addClass('is-active');	
	let data = new FormData($('#HotelForm')[0]);
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenHotel').val()},
		url: urlActual+"/save",
		data: data,
		dataType: "json",
		contentType: false,
    	processData: false,
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioHotel();
			$('#modalHotel').modal("hide");
			hoteles_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Hotel Creado con Éxito!!');
			
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#HotelForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}
		
	});
}

if(window.location.hash === '#create')
	{
		$('#modalHotel').modal('show');
	}

	$('#modalHotel').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioHotel();
	});

	$('#modalRuta').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	}); 