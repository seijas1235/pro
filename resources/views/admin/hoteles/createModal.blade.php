<!-- Modal -->
<div class="modal fade" id="modalHotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open(['id' => 'HotelForm', 'files' => true ]) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Hotel</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                {!! Form::file('file') !!}
              </div>
              <br>
              <div class="row">
                <div class="form-group col-sm-6 {{ $errors->has('nombre') ? 'has-error': '' }}">
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre" placeholder="Ingrese Nombre" class="form-control" value="{{old('name')}}">
                  {!! $errors->first('nombre', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="col-sm-6">
                  {!! Form::label("pais_id","pais :") !!}
                  <select class="form-control" name="pais_id" id="pais_id">
                    <option value="">Selecciona pais</option>
                    @foreach ($paises as $pais)
                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>
                <div class="row">

              </div>
              <br>


              <input type="hidden" name="_token" id="tokenHotel" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonHotelModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>
