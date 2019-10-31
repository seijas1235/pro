<!-- Modal -->
<div class="modal fade" id="modalPublicidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  {!! Form::open(['id' => 'PublicidadForm', 'files' => true ]) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Habitación</h4>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-sm-6">
                  {!! Form::label("descripcion","Titulo de publicidad:") !!}
                  <input type="text" name="descripcion" id="descripcion" placeholder="Ingrese Titulo de publicidad" class="form-control" value="{{old('nombre_Publicidad')}}">
                </div>
              </div>
              <br>

              <br>
              <div class="row">
                  {!! Form::file('file') !!}
              </div>
              <br>
              <input type="hidden" name="_token" id="tokenPublicidad" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonPublicidadModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>


@push('scripts')

@endpush