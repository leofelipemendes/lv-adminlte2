<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartamentosController extends Controller
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
        return view('departamentos.departamentos');
    }
    
    public function teste(Request $request) 
    {
        dd($request->all());        
    }
}
