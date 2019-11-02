<?php

namespace App\Http\Controllers;

use App\Boletos;
use App\Habitacion;
use App\Pais;
use App\rutas;
use App\vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Validator;


class apiController extends Controller
{
   

    public function cargarPais(){
        $paises=DB::table('pais')
        ->select('id','nombre')->get();
        
        
        return Response::json( $paises );	 
    }
    public function obtenervuelos($pais1,$pais2,$fecha){
        /**/
            $query = " SELECT v.id, v.no_vuelo as no_vuelo, v.precio as precio, v.fecha_salida as fecha_salida, a.nombre as aerolinea, p1.nombre as origen, p2.nombre as destino  FROM vuelos v
            INNER JOIN aerolinea a on v.aerolinea_id=a.id
            INNER JOIN pais p1 on v.pais1_id=p1.id
            INNER JOIN pais p2 on v.pais2_id=p2.id
            
            WHERE  v.pais1_id='".$pais1."' AND v.pais2_id='".$pais2."' AND v.fecha_salida = '".$fecha."' AND v.estado = 1 ";
              
        $vuelos = DB::select($query);

        return Response::json( $vuelos );
    }
    public function reservar_boleto(Request $request){
        $request->cantidad;
        
        $vuelo=vuelo::find($request->vuelo_id);
        $numero2=DB::table('boletos')
        ->select('aciento_numero')
        ->where('vuelo_id',$request->vuelo_id)
        ->orderBy('id','desc')
        ->limit(1)
        ->get();
        $contador = count($numero2);
        if ($contador == 0)
        {
            $numero=0;
        }
       else{
           $numero=$numero2[0]->aciento_numero;
       }
       $ocupado=$vuelo->ocupado;
      if ($vuelo->acientos >= $ocupado+$request->cantidad) {
            for ($i=1; $i <=$request->cantidad ; $i++) { 
                
                $data['aciento_numero']=$numero+$i;
                $data['vuelo_id']=$request->vuelo_id;
                $data['user_id']=$request->user_id;
                $data['numero']=$vuelo->no_vuelo.'-'.$data['aciento_numero'];
                Boletos::create($data);

                $vuelo->ocupado=$ocupado+$i;
                $vuelo->save();
                
            }
            return response('Clompra de Boletos Efectuada con Exito');
      }
      else
      {
        return response('Lo sentimos No Tenemos Suficientes Acientos disponibles');
      }
        
       

       
   
       
    }
    public function gethabitacion($pais,$entrada,$salida){
        
        $query="SELECT * from hotel ho where ho.id not in (
            Select ha.id from habitaciones h
            INNER JOIN hotel ha on h.hotel_id=ha.id
            INNER JOIN pais p on ha.pais_id=p.id
            where  ha.pais_id=18 and (h.fecha_entrada BETWEEN '".$entrada."'  AND DATE_SUB('".$salida."', INTERVAL 1 DAY)) and (h.fecha_salida  BETWEEN DATE_ADD('".$entrada."', INTERVAL 1 DAY)  AND '".$salida."')
            ) and ho.pais_id='".$pais."'";
        $habitaciones = DB::select($query);
        return Response::json($habitaciones);
    }

    public function reservar_hotel(Request $request){
        
        $habitacion=Habitacion::find($request->hotel);
        $habitacion->fecha_entrada=$request->entrada;
        $habitacion->fecha_salida=$request->salida;
        $habitacion->user_id=$request->user_id;
        return Response::json(['success' => 'Éxito']);
    }
    
    public function cargarPublicidad(){
        $publicidad=DB::table('publicidad')
        ->select('descripcion','imagen')->get();
        
        
        return Response::json( $publicidad );	 
    }
    public function cargarPaquetes(){
        $publicidad=DB::table('paquetes')
        ->select('precio_paquete','id','descripcion','imagen')->get();
        
        
        return Response::json( $publicidad );	 
    }
    public function cargarPaquete($id){
        $publicidad=DB::table('paquetes')
        ->select('paquetes.precio_paquete as precio','paquetes.id','paquetes.descripcion as descripcion','paquetes.imagen as imagen_paquete','hotel.nombre as hotel','aerolinea.nombre as aerolinea','hotel.imagen as imagen_hotel')
        ->leftJoin('hotel','paquetes.hotel_id','=','hotel.id')
        ->leftJoin('aerolinea','paquetes.aerolinea_id','=','aerolinea.id')
        ->where('paquetes.id',$id)->get();
        
        
        return Response::json( $publicidad );	 
    }
    public function comprarpaquete($request){
        return Response::json($request);
    }
    public function reserva($user_id){

            $reservas="SELECT b.numero as numero, b.aciento_numero as aciento,p1.nombre as origen, p2.nombre as destino,v.fecha_salida as fechas FROM boletos b
            inner join vuelos v on b.vuelo_id=v.id
            inner join pais p1 on v.pais1_id=p1.id
            inner join pais p2 on v.pais2_id=p2.id
            WHERE b.user_id=".$user_id;
            $result=DB::select($reservas);
  
         $api_Result['data'] = $result;

        return Response::json( $api_Result );
    }
}
