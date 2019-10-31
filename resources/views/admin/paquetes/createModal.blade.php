<!-- Modal -->
<div class="modal fade" id="modalPaquete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  {!! Form::open(['id' => 'PaqueteForm', 'files' => true ]) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Habitación</h4>
            </div>
            <div class="modal-body">

              <div class="row">
                
                <div class="col-sm-6">
                  {!! Form::label("hotel_id","hotel :") !!}
                  <select class="form-control" name="hotel_id" id="hotel_id">
                    <option value="">Selecciona hotel</option>
                    @foreach ($hoteles as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-6">
                  {!! Form::label("aerolinea_id","aerolinea :") !!}
                  <select class="form-control" name="aerolinea_id" id="aerolinea_id">
                    <option value="">Selecciona aerolinea</option>
                    @foreach ($aerolineas as $aerolinea)
                    <option value="{{$aerolinea->id}}">{{$aerolinea->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>
                <div class="row">

                <div class="col-sm-6">
                  {!! Form::label("precio_paquete","Precio:") !!}
                  {!! Form::number( "precio_paquete" , null , ['class' => 'form-control' , 'placeholder' => 'Precio']) !!}
                </div>
                <div class="col-sm-6">
                  {!! Form::label("descripcion","Titulo:") !!}
                  {!! Form::text( "descripcion" , null , ['class' => 'form-control' , 'placeholder' => 'Ingrese la descripción']) !!}
                </div>
              </div>
              <br>
              <div class="row">
                  {!! Form::file('file') !!}
              </div>
              <br>
              <input type="hidden" name="_token" id="tokenPaquete" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonPaqueteModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>


@push('scripts')

@endpush