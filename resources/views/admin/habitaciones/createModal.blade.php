<!-- Modal -->
<div class="modal fade" id="modalHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  {!! Form::open(['id' => 'HabitacionForm', 'files' => true ]) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Habitación</h4>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-sm-6">
                  {!! Form::label("nombre_habitacion","Nombre de Habitación:") !!}
                  <input type="text" name="nombre_habitacion" id="nombre_habitacion" placeholder="Ingrese Nombre de Habitación" class="form-control" value="{{old('nombre_habitacion')}}">
                </div>
                <div class="col-sm-6">
                  {!! Form::label("hotel_id","hotel :") !!}
                  <select class="form-control" name="hotel_id" id="hotel_id">
                    <option value="">Selecciona hotel</option>
                    @foreach ($hoteles as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>
                <div class="row">

                <div class="col-sm-6">
                  {!! Form::label("precio","Precio:") !!}
                  {!! Form::number( "precio" , null , ['class' => 'form-control' , 'placeholder' => 'Precio']) !!}
                </div>
                <div class="col-sm-6">
                  {!! Form::label("descripcion","Descripción:") !!}
                  {!! Form::text( "descripcion" , null , ['class' => 'form-control' , 'placeholder' => 'Ingrese la descripción']) !!}
                </div>
              </div>
              <br>
              <div class="row">
                  {!! Form::file('file') !!}
              </div>
              <br>
              <input type="hidden" name="_token" id="tokenHabitacion" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonHabitacionModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>


@push('scripts')

@endpush