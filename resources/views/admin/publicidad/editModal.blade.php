<!-- Modal -->
<div class="modal fade" id="modalUpdatePublicidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="POST" id="PublicidadUpdateForm">
            {{ method_field('put') }}
    
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Editar Publicidad</h4>
                </div>
                <div class="modal-body">
                  
                 <div class="row">
                   
                  
                    <div class="col-sm-6">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" placeholder="Ingrese Descripción" class="form-control" value="{{old('descripcion')}}">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    
                  <br>
    
                  <input type="hidden" name="_token" id="tokenPublicidadEdit" value="{{ csrf_token() }}">
                  <input type="hidden" name="id">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id="ButtonPublicidadModalUpdate" >Actualizar</button>
                </div>
              </div>
            </div>
          </div>
      </form>
  </div>

  @push('scripts')
    <script>

function cargarSelectHoteles(s_hotel_id){
      $('#hotel2_id').empty();
      $("#hotel2_id").append('<option value="" selected disabled>Seleccione Hotel </option>');
      var hotel_id = s_hotel_id;
      $.ajax({
        type: "GET",
        url: "{{route('hotelp.cargar')}}", 
        dataType: "json",
        success: function(data){
          $.each(data,function(key, registro) {
            if(registro.id == hotel_id){
            $("#hotel2_id").append('<option value='+registro.id+' selected>'+registro.nombre+'</option>');
            
            }else{
            $("#hotel2_id").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
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