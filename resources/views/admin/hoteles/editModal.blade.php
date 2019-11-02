<!-- Modal -->
<div class="modal fade" id="modalUpdateHotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="POST" id="HotelUpdateForm">
            {{ method_field('put') }}
    
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Editar Hotel</h4>
                </div>
                <div class="modal-body">
                  
                  <div class="row">
                    <div class="form-group col-sm-6 {{ $errors->has('nombre') ? 'has-error': '' }}">
                      <label for="nombre">Nombre:</label>
                      <input type="text" name="nombre" placeholder="Ingrese Nombre" class="form-control" value="{{old('name')}}">
                      {!! $errors->first('nombre', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="col-sm-6">
                      {!! Form::label("pais_id","pais :") !!}
                      <select class="form-control" name="pais_id" id="pais2_id">
                      </select>
                    </div>
                  </div>
                  <br>
                    <div class="row">
 
                  </div>

                  <br>
                  <div class="row">

                  <input type="hidden" name="_token" id="tokenHotelEdit" value="{{ csrf_token() }}">
                  <input type="hidden" name="id">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id="ButtonHotelModalUpdate" >Actualizar</button>
                </div>
              </div>
            </div>
          </div>
      </form>
  </div>

  @push('scripts')
    <script>

      function cargarSelectTipoHotel(s_pais2_id){
      $('#pais2_id').empty();
      $("#pais2_id").append('<option value="" selected>Seleccione pais destino </option>');
      var pais2_id = s_pais2_id;
      $.ajax({
        type: "GET",
        url: "{{route('paisv.cargar')}}", 
        dataType: "json",
        success: function(data){
          $.each(data,function(key, registro) {
            if(registro.id == pais2_id){
            $("#pais2_id").append('<option value='+registro.id+' selected>'+registro.nombre+'</option>');
            
            }else{
            $("#pais2_id").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
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