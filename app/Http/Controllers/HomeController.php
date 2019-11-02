<?php

namespace App\Http\Controllers;

use App\Pais;
use App\rutas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role=Auth::user()->roles[0]->name;
        if ($role=='Administrador' || $role=='super-admin') {
            return view('home');
        }
        else{
            return view('denegado');
        }
    }
    public function pago()
    {
        return view('admin.pago');
    }
    public function publicidad()
    {
        return view('admin.publicidad');
    }
    public function compra()
    {
        return view('admin.compra');
    }
    
}
