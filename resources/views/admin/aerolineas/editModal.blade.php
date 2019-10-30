<!-- Modal -->
<div class="modal fade" id="modalUpdateAerolinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="POST" id="AerolineaUpdateForm">
      {{ method_field('put') }}

    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar Aerolinea </h4>
          </div>
          <div class="modal-body">
               <br>
              <div class="row">
              
              <div class="col-sm-6">
                {!! Form::label("nombre","Nombre:") !!}
                <input type="text" name="nombre" placeholder="Ingrese Nombre" class="form-control" value="{{old('nombre')}}">
              </div>
            </div>
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
</script>    
@endpush