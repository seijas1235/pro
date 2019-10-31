var validator = $("#PublicidadUpdateForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {

		descripcion:{
			required:true
		},


	},
	messages: {

		descripcion:{
			required:"Por favor, una descripción"
		},

	}
});

$('#modalUpdatePublicidad').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');

	var descripcion = button.data('descripcion');

	
	var modal = $(this);
	modal.find(".modal-body input[name='id']").val(id);

	modal.find(".modal-body input[name='descripcion']").val(descripcion);

 }); 

function BorrarFormularioUpdate() {
    $("#PublicidadUpdateForm :input").each(function () {
        $(this).val('');
	});
};

$("#ButtonPublicidadModalUpdate").click(function(event) {
	event.preventDefault();
	if ($('#PublicidadUpdateForm').valid()) {
		
		updateModal();
	} else {
		validator.focusInvalid();
	}
});

function updateModal(button) {
	$('.loader').addClass('is-active');
	var formData = $("#PublicidadUpdateForm").serialize();
	var id = $("input[name='id']").val();
	var urlActual = $("input[name='urlActual']").val();
	$.ajax({
		type: "PUT",
		headers: {'X-CSRF-TOKEN': $('#tokenPublicidadEdit').val()},
		url: urlActual+"/"+id +"/update",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioUpdate();
			$('#modalUpdatePublicidad').modal("hide");
			publicidad_table.ajax.reload();
			alertify.set('notifier','position', 'top-center');
			alertify.success('Publicidad Editado con Éxito!!');
		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.email != null) {
				$("#PublicidadUpdateForm input[name='email'] ").after("<label class='error' id='ErrorNombreedit'>"+errors.email+"</label>");
			}
			else{
				$("#ErrorNombreedit").remove();
			}
		}
		
	});
}

if(window.location.hash === '#edit')
       {
         $('#modalUpdatePublicidad').modal('show');
       }
    
       $('#modalUpdatePublicidad').on('hide.bs.modal', function(){
          window.location.hash = '#';
		  $("label.error").remove();
		  BorrarFormularioUpdate();
       });
    
       $('#modalUpdatePublicidad').on('shown.bs.modal', function(){
          window.location.hash = '#edit';
    
	   }); 
	   

	
