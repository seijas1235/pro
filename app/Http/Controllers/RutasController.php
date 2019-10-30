<?php

namespace App\Http\Controllers;

use App\Pais;
use App\rutas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Validator;

class RutasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $paises=Pais::get();
        return view('admin.rutas.index',compact('paises'));
    }
    public function getJson(Request $params)
    {

            $query = "SELECT r.id as id, r.pais1_id as pais1_id, r.pais2_id as pais2_id, r.precio as precio, p1.nombre as pais1, p2.nombre as pais2 FROM rutas r
            INNER JOIN pais p1 on r.pais1_id=p1.id
            INNER JOIN pais p2 on r.pais2_id=p2.id
            WHERE r.estado=1";
              
        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
       
    }
    public function store(Request $request)
    {       
       
        $data = $request->all();
       
        rutas::create($data);                  

       return Response::json(['success' => 'Éxito']);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(rutas $ruta, Request $request)
    {
        
        $ruta->pais2_id= $request->pais2_id;
        $ruta->precio= $request->precio;
        $ruta->pais1_id= $request->pais1_id;

        $ruta->save();

        return Response::json(['success' => 'Éxito']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(rutas $ruta, Request $request)
    {
       
        
            $ruta->estado = 0;
            $ruta->save();
           return Response::json(['success' => 'Éxito']);
        
    }
    
    public function cargarSelect()
	{
        $result = Pais::get();

		return Response::json( $result );		
    }	

}
