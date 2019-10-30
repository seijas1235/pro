var validator = $("#HotelUpdateForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		
		pais_id:{
			required:true
		},
		pais2_id:{
			required:true
		},
		descripcion:{
			required:true
		},
		

	},
	messages: {
		
		pais_id:{
			required:"Por favor, seleccione un nivel"
		},
		pais2_id:{
			required:"Por favor, seleccione un tipo de habitación"
		},
		descripcion:{
			required:"Por favor, ingrese el descripcion"
		},
		
	}
});

$('#modalUpdateHotel').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');
	var nombre=button.data('nombre');
	var pais_id = button.data('pais_id');
	var descripcion = button.data('descripcion');
	var modal = $(this);
	modal.find(".modal-body input[name='nombre']").val(nombre);
	modal.find(".modal-body input[name='id']").val(id);
	modal.find(".modal-body input[name='pais_id']").val(pais_id);
	modal.find(".modal-body input[name='descripcion']").val(descripcion);

	cargarSelectTipoHotel(pais_id);

 }); 
 function BorrarFormularioUpdate() {
    $("#HotelUpdateForm :input").each(function () {
        $(this).val('');
	});
};

$("#ButtonHotelModalUpdate").click(function(event) {
	event.preventDefault();
	if ($('#HotelUpdateForm').valid()) {
		
		updateModal();
	} else {
		validator.focusInvalid();
	}
});

function updateModal(button) {
	$('.loader').addClass('is-active');
	var formData = $("#HotelUpdateForm").serialize();
	var id = $("input[name='id']").val();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "PUT",
		headers: {'X-CSRF-TOKEN': $('#tokenHotelEdit').val()},
		url: urlActual+"/"+id +"/update",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioUpdate();
			$('#modalUpdateHotel').modal("hide");
			window.location.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Hotel Editado con Éxito!!');
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.email != null) {
				$("#HotelUpdateForm input[name='email'] ").after("<label class='error' id='ErrorNombreedit'>"+errors.email+"</label>");
			}
			else{
				$("#ErrorNombreedit").remove();
			}
		}
		
	});
}

if(window.location.hash === '#edit')
       {
         $('#modalUpdateHotel').modal('show');
       }
    
       $('#modalUpdateHotel').on('hide.bs.modal', function(){
          window.location.hash = '#';
		  $("label.error").remove();
		  BorrarFormularioUpdate();
       });
    
       $('#modalUpdateHotel').on('shown.bs.modal', function(){
          window.location.hash = '#edit';
    
	   }); 
	   


	
