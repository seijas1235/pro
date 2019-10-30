var validator = $("#AerolineaUpdateForm").validate({
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

$('#modalUpdateAerolinea').on('shown.bs.modal', function(event){
	var button = $(event.relatedTarget);
	var id = button.data('id');
	var pais2_id = button.data('pais2_id');
	var pais1_id = button.data('pais1_id');
	var precio = button.data('precio');
	var aerolinea_id = button.data('aerolinea_id');
	var no_vuelo = button.data('no_vuelo');
	var acientos = button.data('acientos');
	var fecha_salida = button.data('fecha');
	
	console.log(pais1_id,pais2_id);
	var modal = $(this);
	modal.find(".modal-body input[name='id']").val(id);
	modal.find(".modal-body input[name='pais2_id']").val(pais2_id);
	modal.find(".modal-body input[name='pais1_id']").val(pais1_id);
	modal.find(".modal-body input[name='aerolinea_id']").val(aerolinea_id);
	modal.find(".modal-body input[name='no_vuelo']").val(no_vuelo);
	modal.find(".modal-body input[name='acientos']").val(acientos);
	modal.find(".modal-body input[name='precio']").val(precio);
	modal.find(".modal-body input[name='fecha_salida']").val(fecha_salida);

	cargarSelectTipoAerolinea(pais2_id);
	cargarSelectNiveles(pais1_id);
	cargarSelectAerolinea(aerolinea_id);
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
			vuelos_table.ajax.reload();
			location.reload();
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
	   

	
