<!-- Modal -->
<div class="modal fade" id="modalUpdateAerolinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="POST" id="AerolineaUpdateForm">
            {{ method_field('put') }}
    
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Editar Vuelo </h4>
                </div>
                <div class="modal-body">
                  
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::label("no_vuelo","no. vuelo:") !!}
                            {!! Form::text( "no_vuelo" , null , ['class' => 'form-control' , 'placeholder' => 'no. vuelo']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label("aerolinea_id","Aerolinea:") !!}
                            <select class="form-control" name="aerolinea_id" id="aerolinea2_id">
                            </select>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                        
                        <div class="col-sm-6">
                          {!! Form::label("acientos","no. acientos:") !!}
                          {!! Form::number( "acientos" , null , ['class' => 'form-control' , 'placeholder' => 'no. acientos']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label("pais1_id","Pais Origen:") !!}
                            <select class="form-control" name="pais1_id" id="pais12_id">
                            </select>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                        
                          <div class="col-sm-6">
                              {!! Form::label("pais2_id","Pais destino:") !!}
                              <select class="form-control" name="pais2_id" id="pais22_id">
                              </select>
                            </div>
                        <div class="col-sm-6">
                            {!! Form::label("fecha_salida","fecha salida:") !!}
                            {!! Form::date( "fecha_salida" , null , ['class' => 'form-control' , 'placeholder' => 'fecha salida']) !!}
                          </div>
                        
                      </div>
                      <br>
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::label("precio","Precio:") !!}
                                {!! Form::number( "precio" , null , ['class' => 'form-control' , 'placeholder' => 'Precio']) !!}
                              </div>
                      </div>
                      <br>
        
                  <br>
                  <div class="row">

                  <input type="hidden" name="_token" id="tokenAerolineaEdit" value="{{ csrf_token() }}">
                  <input type="hidden" name="id">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id="ButtonAerolineaModalUpdate" >Actualizar</button>
                </div>
              </div>
            </div>
          </div>
      </form>
  </div>

  @push('scripts')
    <script>

      function cargarSelectTipoAerolinea(s_pais2_id){
      $('#pais22_id').empty();
      $("#pais22_id").append('<option value="" selected>Seleccione pais destino </option>');
      var pais2_id = s_pais2_id;
      $.ajax({
        type: "GET",
        url: "{{route('paisv.cargar')}}", 
        dataType: "json",
        success: function(data){
          $.each(data,function(key, registro) {
            if(registro.id == pais2_id){
            $("#pais22_id").append('<option value='+registro.id+' selected>'+registro.nombre+'</option>');
            
            }else{
            $("#pais22_id").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
            }	
            
          });
      
        },
        error: function(data) {
          alert('error');
        }
        });
      }


      function cargarSelectNiveles(s_pais1_id){
			$('#pais12_id').empty();
			$("#pais12_id").append('<option value="" selected>Seleccione Pais Origen</option>');
			var pais1_id = s_pais1_id;
			$.ajax({
				type: "GET",
				url: "{{route('paisv.cargar')}}", 
				dataType: "json",
				success: function(data){
					$.each(data,function(key, registro) {
						if(registro.id == pais1_id){
						$("#pais12_id").append('<option value='+registro.id+' selected>'+registro.nombre+'</option>');
						
						}else{
						$("#pais12_id").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
						}		
					});
			
				},
				error: function(data) {
					alert('error');
				}
				});
      }
    
      function cargarSelectAerolinea(s_aerolinea_id){
			$('#aerolinea2_id').empty();
			$("#aerolinea2_id").append('<option value="" selected>Seleccione Pais Origen</option>');
			var aerolinea_id = s_aerolinea_id;
			$.ajax({
				type: "GET",
				url: "{{route('aerolinea.cargar')}}", 
				dataType: "json",
				success: function(data){
					$.each(data,function(key, registro) {
						if(registro.id == aerolinea_id){
						$("#aerolinea2_id").append('<option value='+registro.id+' selected>'+registro.nombre+'</option>');
						
						}else{
						$("#aerolinea2_id").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
						}		
					});
			
				},
				error: function(data) {
					alert('error');
				}
				});
      }
    </script>    
  @endpush