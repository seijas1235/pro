<?php

namespace App\Http\Controllers;

use App\aerolinea;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Validator;

class AerolineaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('admin.aerolineas.index');
    }
    
    public function store(Request $request)
    {       
       $data = $request->all();

       aerolinea::create($data);                  

       return Response::json(['success' => 'Éxito']);
        
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(aerolinea $aerolinea, Request $request)
    {

        $aerolinea->nombre= $request->nombre;
        $aerolinea->save();

    
        return Response::json(['success' => 'Éxito']);
        
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(aerolinea $aerolinea, Request $request)
    {
       
        
            $aerolinea->estado = 0;
            $aerolinea->save();
           return Response::json(['success' => 'Éxito']);
        
    }
	
    public function getJson(Request $params)
    {

            $query = "SELECT id,nombre as nombre, created_at as fecha FROM aerolinea 
            WHERE estado=1";
              
        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
       
    }
}
