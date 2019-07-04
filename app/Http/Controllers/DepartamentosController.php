<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Departamento;

class DepartamentosController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('departamentos.departamentos');
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required'            
        ]);
        $deptos = new Departamento([
            'nome' => 'required',
            'descricao' => 'required'            
        ]);
        $deptos->save();
        
        return redirect()->route('depto')->with('success', 'Stock has been added');
    }

}
