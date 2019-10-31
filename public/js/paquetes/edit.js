var validator = $("#PaqueteUpdateForm").validate({
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
	}
});

$('#modalUpdatePaquete').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');
	var precio_paquete = button.data('precio_paquete');
	var hotel_id = button.data('hotel_id');
	var descripcion = button.data('descripcion');
	var aerolinea_id = button.data('aerolinea_id');
	
	var modal = $(this);
	modal.find(".modal-body input[name='id']").val(id);
	modal.find(".modal-body input[name='precio_paquete']").val(precio_paquete);
	modal.find(".modal-body input[name='hotel_id']").val(hotel_id);
	modal.find(".modal-body input[name='descripcion']").val(descripcion);
	modal.find(".modal-body input[name='aerolinea_id']").val(aerolinea_id);

	cargarSelectHoteles(hotel_id);
	cargarSelectAerolinea(aerolinea_id);
 }); 

function BorrarFormularioUpdate() {
    $("#PaqueteUpdateForm :input").each(function () {
        $(this).val('');
	});
};

$("#ButtonPaqueteModalUpdate").click(function(event) {
	event.preventDefault();
	if ($('#PaqueteUpdateForm').valid()) {
		
		updateModal();
	} else {
		validator.focusInvalid();
	}
});

function updateModal(button) {
	$('.loader').addClass('is-active');
	var formData = $("#PaqueteUpdateForm").serialize();
	var id = $("input[name='id']").val();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "PUT",
		headers: {'X-CSRF-TOKEN': $('#tokenPaqueteEdit').val()},
		url: urlActual+"/"+id +"/update",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioUpdate();
			$('#modalUpdatePaquete').modal("hide");
			Paquetes_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Paquete Editado con Éxito!!');
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.email != null) {
				$("#PaqueteUpdateForm input[name='email'] ").after("<label class='error' id='ErrorNombreedit'>"+errors.email+"</label>");
			}
			else{
				$("#ErrorNombreedit").remove();
			}
		}
		
	});
}

if(window.location.hash === '#edit')
       {
         $('#modalUpdatePaquete').modal('show');
       }
    
       $('#modalUpdatePaquete').on('hide.bs.modal', function(){
          window.location.hash = '#';
		  $("label.error").remove();
		  BorrarFormularioUpdate();
       });
    
       $('#modalUpdatePaquete').on('shown.bs.modal', function(){
          window.location.hash = '#edit';
    
	   }); 
	   

	
