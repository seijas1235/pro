var validator = $("#HabitacionUpdateForm").validate({
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

$('#modalUpdateHabitacion').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');
	var nombre_habitacion = button.data('nombre_habitacion');
	var hotel_id = button.data('hotel_id');
	var descripcion = button.data('descripcion');
	var precio = button.data('precio');
	
	var modal = $(this);
	modal.find(".modal-body input[name='id']").val(id);
	modal.find(".modal-body input[name='nombre_habitacion']").val(nombre_habitacion);
	modal.find(".modal-body input[name='hotel_id']").val(hotel_id);
	modal.find(".modal-body input[name='descripcion']").val(descripcion);
	modal.find(".modal-body input[name='precio']").val(precio);

	cargarSelectHoteles(hotel_id);
 }); 

function BorrarFormularioUpdate() {
    $("#HabitacionUpdateForm :input").each(function () {
        $(this).val('');
	});
};

$("#ButtonHabitacionModalUpdate").click(function(event) {
	event.preventDefault();
	if ($('#HabitacionUpdateForm').valid()) {
		
		updateModal();
	} else {
		validator.focusInvalid();
	}
});

function updateModal(button) {
	$('.loader').addClass('is-active');
	var formData = $("#HabitacionUpdateForm").serialize();
	var id = $("input[name='id']").val();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "PUT",
		headers: {'X-CSRF-TOKEN': $('#tokenHabitacionEdit').val()},
		url: urlActual+"/"+id +"/update",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioUpdate();
			$('#modalUpdateHabitacion').modal("hide");
			habitaciones_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Habitacion Editado con Éxito!!');
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.email != null) {
				$("#HabitacionUpdateForm input[name='email'] ").after("<label class='error' id='ErrorNombreedit'>"+errors.email+"</label>");
			}
			else{
				$("#ErrorNombreedit").remove();
			}
		}
		
	});
}

if(window.location.hash === '#edit')
       {
         $('#modalUpdateHabitacion').modal('show');
       }
    
       $('#modalUpdateHabitacion').on('hide.bs.modal', function(){
          window.location.hash = '#';
		  $("label.error").remove();
		  BorrarFormularioUpdate();
       });
    
       $('#modalUpdateHabitacion').on('shown.bs.modal', function(){
          window.location.hash = '#edit';
    
	   }); 
	   

	
