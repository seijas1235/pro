<!-- Modal -->
<div class="modal fade" id="ModalImagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open(['id' => 'HotelForm', 'files' => true ]) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Hotel</h4>
            </div>
            <div class="modal-body">
            <div class="row" id="imagenm">

            </div>
              <input type="hidden" name="_token" id="tokenHotel" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>
      @push('scripts')
    <script>

      $('#ModalImagen').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var imagen = button.data('imagen');
        $("#imagenm").append("<img src='"+imagen+"' alt='' width='450' height='450'  />");        
      });
      $('#ModalImagen').on('hide.bs.modal', function(){
					window.location.hash = '#';
          $('#imagenm').html('');
				});
</script> 
@endpush