<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Habitacion;
use Validator;

use App\Events\ActualizacionBitacora;
use App\hotel;

class HabitacionesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $hoteles = hotel::where('estado', 1)->get();
        return view ("admin.habitaciones.index",compact( 'hoteles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $nuevos_datos = array(
            'nombre_habitacion' => $request->nombre_habitacion,
            'tipo_id' => $request->tipo_id,
            'precio' => $request->precio,
            'nivel_id' => $request->nivel_id,
            'descripcion' => $request->descripcion,
        );
        $json = json_encode($nuevos_datos);

        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        $habitacion = Habitacion::create($data);                  

        event(new ActualizacionBitacora(Auth::user()->id,'Creación','',$json,'habitacion'));

       return Response::json(['success' => 'Éxito']);
    }

    public function nombreDisponible()
    {
        $dato = Input::get("nombre_habitacion");
        $query = Habitacion::where("nombre_habitacion",$dato)
                        ->where('estado', 1)->get();
        $contador = count($query);
        if ($contador == 0)
        {
            return 'false';
        }
        else
        {
            return 'true';
        }
    }

    public function nombreDisponibleEdit()
    {
        $dato = Input::get("nombre_habitacion");
        $id = Input::get('id');
        
        $query = Habitacion::where("nombre_habitacion",$dato)
                        ->where('estado', 1)
                        ->where('id','!=', $id)->get();
        $contador = count($query);

        if ($contador == 0)
        {
            return 'false';
        }
        else
        {
            return 'true';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Habitacion $habitacion, Request $request)
    {
        $nuevos_datos = array(
            'nombre_habitacion' => $request->nombre_habitacion,
            'tipo_id' => $request->tipo_id,
            'precio' => $request->precio,
            'nivel_id' => $request->nivel_id,
            'descripcion' => $request->descripcion,
        );
        $json = json_encode($nuevos_datos);
 
         event(new ActualizacionBitacora(Auth::user()->id,'Edición',$habitacion, $json,'habitaciones'));

        $habitacion->nombre_habitacion= $request->nombre_habitacion;
        $habitacion->tipo_id= $request->tipo_id;
        $habitacion->precio= $request->precio;
        $habitacion->nivel_id= $request->nivel_id;
        $habitacion->descripcion= $request->descripcion;
        $habitacion->save();

        return Response::json(['success' => 'Éxito']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion, Request $request)
    {
        $password_usuario = Auth::user()->password;

        $data = $request->all();

        $errors = Validator::make($data,[
            'password_actual' => ['required'],
        ]);

         if($errors->fails())
         {
            return  Response::json($errors->errors(), 422);
         }

         if(password_verify($data['password_actual'],$password_usuario))
         {
            $habitaciona=$habitacion;
            $habitacion->estado = 0;
            $habitacion->save();
            event(new ActualizacionBitacora(Auth::user()->id,'Inactivación',$habitacion,$habitacion,'Habitaciones'));

            return Response::json(['success' => 'Éxito']);

         }

         else{
            return  Response::json(['password_actual' => 'La contraseña no coincide'], 422);
         }

       
        
    }
    
    public function getJson(Request $params)
    {

        $query = 'SELECT H.id as id,H.nombre_habitacion as habitacion, H.precio as precio, ho.nombre as hotel, H.descripcion as descripcion,p.nombre as pais
        FROM habitaciones H      
        INNER JOIN hotel ho on H.hotel_id = ho.id
        INNER JOIN pais p on ho.pais_id=p.id';

        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
    }
}
