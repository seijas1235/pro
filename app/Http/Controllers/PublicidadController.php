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
use App\Publicidad;

class PublicidadController extends Controller
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
  
        return view ("admin.publicidad.index");
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
            $archivo->move('images/publicidad',$image);
            $data['imagen']='/images/publicidad/'.$image;
         } 
  
       Publicidad::create($data);                  

      

       return Response::json(['success' => 'Éxito']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Publicidad $publicidad, Request $request)
    {
        
        $image=$publicidad->imagen;
        $publicidad->descripcion= $request->descripcion;
        $publicidad->imagen=$image;
        $publicidad->save();

        return Response::json(['success' => 'Éxito']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicidad $publicidad, Request $request)
    {
        $publicidad->delete();
        return Response::json(['success' => 'Éxito']);
        
    }
    
    public function getJson(Request $params)
    {

        $query = 'SELECT * from publicidad';

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
