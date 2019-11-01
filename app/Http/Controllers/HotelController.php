<?php

namespace App\Http\Controllers;

use App\hotel;
use App\Pais;
use App\rutas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Validator;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $paises=Pais::get();
        return view('admin.hoteles.index',compact('paises'));
    }
    
    public function store(Request $request)
    {       
       $data = $request->all();
       
       if ($archivo=$request->file('file')) {
           $image=$archivo->getClientOriginalName();
           $archivo->move('images/hotel',$image);
           $data['imagen']='/images/hotel/'.$image;
        } 
      // dd($data);
       hotel::create($data);                  

       return Response::json(['success' => 'Éxito']);
        
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(hotel $hotel, Request $request)
    {
        $image=$hotel->imagen;
        $hotel->nombre= $request->nombre;
        $hotel->imagen= $image;
        $hotel->pais_id = $request->pais_id;
        $hotel->descripcion= $request->descripcion;
        
        $hotel->save();

    
        return Response::json(['success' => 'Éxito']);
        
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(hotel $hotel, Request $request)
    {
       
        $hotel->delete();
        return Response::json(['success' => 'Éxito']);
        
    }
    
    public function cargarSelect()
	{
        $result = Pais::get();

		return Response::json( $result );		
    }	
    public function getJson(Request $params)
    {

            $query = "SELECT h.imagen as imagen, h.nombre as nombre, h.descripcion as descripcion, p.nombre as pais, h.id as id,p.id as pais_id FROM hotel h
            INNER JOIN  pais p on h.pais_id=p.id
            WHERE h.estado=1";
              
        $result = DB::select($query);
        $api_Result['data'] = $result;

        return Response::json( $api_Result );
       
    }
}
