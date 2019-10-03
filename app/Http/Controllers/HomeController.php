<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
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
