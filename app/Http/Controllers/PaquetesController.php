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
use App\aerolinea;
use App\paquete;

class PaquetesController extends Controller
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
        $aerolineas = aerolinea::where('estado', 1)->get();
        return view ("admin.paquetes.index",compact( 'hoteles','aerolineas'));
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
            $archivo->move('images/paquetes',$image);
            $data['imagen']='/images/paquetes/'.$image;
         } 
  
       paquete::create($data);                  

      

       return Response::json(['success' => 'Éxito']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(paquete $paquete, Request $request)
    {
        $image=$paquete->imagen;
        $paquete->descripcion= $request->descripcion;
        $paquete->precio_paquete= $request->precio_paquete;
        $paquete->aerolinea_id= $request->aerolinea_id;
        $paquete->hotel_id= $request->hotel_id;
        $paquete->imagen=$image;
        $paquete->save();

        return Response::json(['success' => 'Éxito']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(paquete $paquete, Request $request)
    {
        $paquete->delete();
        return Response::json(['success' => 'Éxito']);
        
    }
    
    public function getJson(Request $params)
    {

        $query = 'SELECT p.imagen as imagen,  p.id as id,p.descripcion as descripcion,p.hotel_id as hotel_id,p.aerolinea_id as aerolinea_id, h.nombre as hotel,a.nombre as aerolinea, p.precio_paquete  as precio,pa.nombre as pais from paquetes p
        INNER JOIN hotel h on p.hotel_id=h.id
        INNER JOIN aerolinea a on p.aerolinea_id=a.id
        INNER JOIN pais pa on h.pais_id=pa.id';

        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
    }
    public function cargarSelect()
	{
        $result = hotel::get();

		return Response::json( $result );		
    }
    public function cargarAerolinea()
	{
        $result = aerolinea::get();

		return Response::json( $result );		
    }
}
