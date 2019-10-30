<?php

namespace App\Http\Controllers;

use App\aerolinea;
use App\Pais;
use App\vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Validator;
class vueloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $paises=Pais::get();
        $aerolineas=aerolinea::where('estado',1)->get();
        return view('admin.vuelos.index',compact('paises','aerolineas'));
    }
    
    public function store(Request $request)
    {       
       
        $data = $request->all();
       
        vuelo::create($data);                  

       return Response::json(['success' => 'Éxito']);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(vuelo $vuelo, Request $request)
    {
        
        $vuelo->pais2_id= $request->pais2_id;
        $vuelo->precio= $request->precio;
        $vuelo->no_vuelo= $request->no_vuelo;
        $vuelo->aerolinea_id= $request->aerolinea_id;
        $vuelo->fecha_salida= $request->fecha_salida;
        $vuelo->pais1_id= $request->pais1_id;
        $vuelo->acientos= $request->acientos;

        $vuelo->save();

        return Response::json(['success' => 'Éxito']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(vuelo $vuelo, Request $request)
    {
       
         $vuelo->delete();
           return Response::json(['success' => 'Éxito']);
        
    }
    
    public function cargarSelect()
	{
        $result = Pais::get();

		return Response::json( $result );		
    }
    public function getJson(Request $params)
    {

            $query = "SELECT v.id as id,v.no_vuelo as vuelo, v.acientos as acientos, v.precio as precio, v.fecha_salida as fecha, p1.nombre as origen, p2.nombre as destino, a.nombre as aerolinea, p1.id as pais1_id, p2.id as pais2_id, a.id as aerolinea_id FROM vuelos v
            INNER JOIN pais p1 on v.pais1_id = p1.id
            INNER JOIN pais p2 on v.pais2_id=p2.id
            INNER JOIN aerolinea a on v.aerolinea_id=a.id
            where v.estado=1";
              
        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
       
    }
    public function cargaraerolinea()
	{
        $result = aerolinea::where('estado',1)->get();

		return Response::json( $result );		
    }

}

