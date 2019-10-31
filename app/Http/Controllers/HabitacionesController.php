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
        
        $data = $request->all();
        if ($archivo=$request->file('file')) {
            $image=$archivo->getClientOriginalName();
            $archivo->move('images/habitacion',$image);
            $data['imagen']='/images/habitacion/'.$image;
         } 
    
        $habitacion = Habitacion::create($data);                  

      

       return Response::json(['success' => 'Éxito']);
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
        $image=$habitacion->imagen;
        $habitacion->nombre_habitacion= $request->nombre_habitacion;
        $habitacion->precio= $request->precio;
        $habitacion->hotel_id= $request->hotel_id;
        $habitacion->descripcion= $request->descripcion;
        $habitacion->imagen=$image;
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
        $habitacion->delete();
        return Response::json(['success' => 'Éxito']);
        
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
    public function cargarSelect()
	{
        $result = hotel::get();

		return Response::json( $result );		
    }
}
