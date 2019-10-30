var validator = $("#AerolineaUpdateForm").validate({
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
			required:"Por favor, ingrese el nombre"
		},
		
	}
});

$('#modalUpdateAerolinea').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');

	var nombre = button.data('nombre');
	var modal = $(this);
	modal.find(".modal-body input[name='id']").val(id);

	modal.find(".modal-body input[name='nombre']").val(nombre);

 }); 

function BorrarFormularioUpdate() {
    $("#AerolineaUpdateForm :input").each(function () {
        $(this).val('');
	});
};

$("#ButtonAerolineaModalUpdate").click(function(event) {
	event.preventDefault();
	if ($('#AerolineaUpdateForm').valid()) {
		
		updateModal();
	} else {
		validator.focusInvalid();
	}
});

function updateModal(button) {
	$('.loader').addClass('is-active');
	var formData = $("#AerolineaUpdateForm").serialize();
	var id = $("input[name='id']").val();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "PUT",
		headers: {'X-CSRF-TOKEN': $('#tokenAerolineaEdit').val()},
		url: urlActual+"/"+id +"/update",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioUpdate();
			$('#modalUpdateAerolinea').modal("hide");
			window.location.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Aerolinea Editado con Éxito!!');
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.email != null) {
				$("#AerolineaUpdateForm input[name='email'] ").after("<label class='error' id='ErrorNombreedit'>"+errors.email+"</label>");
			}
			else{
				$("#ErrorNombreedit").remove();
			}
		}
		
	});
}

if(window.location.hash === '#edit')
       {
         $('#modalUpdateAerolinea').modal('show');
       }
    
       $('#modalUpdateAerolinea').on('hide.bs.modal', function(){
          window.location.hash = '#';
		  $("label.error").remove();
		  BorrarFormularioUpdate();
       });
    
       $('#modalUpdateAerolinea').on('shown.bs.modal', function(){
          window.location.hash = '#edit';
    
	   }); 
	   

	
