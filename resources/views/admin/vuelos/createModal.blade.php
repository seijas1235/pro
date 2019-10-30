<!-- Modal -->
<div class="modal fade" id="modalVuelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open( array( 'id' => 'VueloForm' ) ) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Vuelo</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                    {!! Form::label("no_vuelo","no. vuelo:") !!}
                    {!! Form::text( "no_vuelo" , null , ['class' => 'form-control' , 'placeholder' => 'no. vuelo']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label("aerolinea_id","Aerolinea :") !!}
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
                  {!! Form::label("acientos","no. acientos:") !!}
                  {!! Form::number( "acientos" , null , ['class' => 'form-control' , 'placeholder' => 'no. acientos']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label("pais1_id","pais de origen :") !!}
                    <select class="form-control" name="pais1_id" id="pais1_id">
                      <option value="">Selecciona pais de origen</option>
                      @foreach ($paises as $pais)
                      <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <br>
              <div class="row">
                
                <div class="col-sm-6">
                  {!! Form::label("pais2_id","pais destino :") !!}
                  <select class="form-control" name="pais2_id" id="pais2_id">
                    <option value="">Selecciona pais destino </option>
                    @foreach ($paises as $pais)
                    <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                    @endforeach
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

              <input type="hidden" name="_token" id="tokenVuelo" value="{{ csrf_token() }}">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonVueloModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>
