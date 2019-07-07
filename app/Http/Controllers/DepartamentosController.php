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
        $deptos = Departamento::all();
        return view('departamentos.index', [
            'deptos' => $deptos,
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
                ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required'            
        ]);
        $deptos = new Departamento([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao')    
        ]);
        $deptos->save();
        
        return redirect()->route('depto_index')->with('success', 'Stock has been added');
    }
    
    public function create() {
        
        return view('departamentos.departamentos',[
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
        ]);
    }
    
    public function edit($id) {
        
        $deptos = Departamento::find($id);
        //dd($deptos);
        return view('departamentos.departamentos',[
            'deptos' => $deptos,
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
        ]);
    }
    
    public function update(Request $request,$id) 
    {
        $deptos = Departamento::find($id);
        
        $deptos->nome = $request->nome;
        $deptos->descricao = $request->descricao;
        $deptos->update();
        
       return redirect()->route('depto_index')->with('success', 'Stock has been added');
    }

}
