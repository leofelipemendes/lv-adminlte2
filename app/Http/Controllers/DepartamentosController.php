<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DepartamentoRepository;
use App\Validators\DepartamentoValidator;

class DepartamentosController extends Controller {

    /**
     * @var DepartamentoRepository
     */
    protected $repository;

    /**
     * @var DepartamentoValidator
     */
    protected $validator;

    /**
     * DepartsController constructor.
     *
     * @param DepartamentoRepository $repository
     * @param DepartamentoValidator $validator
     */
    public function __construct(DepartamentoRepository $repository, DepartamentoValidator $validator) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $deptos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $departs,
            ]);
        }
        
        return view('departamentos.index', [
            'deptos' => $deptos,
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
                ]);
    }

    public function store(Request $request) {
        
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $deptos = $this->repository->create($request->all());

            $response = [
                'message' => 'Departamento adicionado.',
                'data'    => $deptos->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('depto_index')->with('success', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        
        
        
    }
    
    public function create() {
        
        return view('departamentos.departamentos',[
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
        ]);
    }
    
    public function edit($id) {
        $deptos = $this->repository->find($id);

        return view('departamentos.departamentos',[
            'deptos' => $deptos,
            'page_title' => 'Departamentos',
            'page_description' => 'Lista de departamentos'
        ]);
    }
    
    public function update(Request $request,$id) 
    {
        
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $deptos = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Departamento atualizado',
                'data'    => $deptos->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            
            return redirect()->route('depto_index')->with('success', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
       
    }
    
    public function disable($id) {
        
        $deptos = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Depart deleted.',
                'deleted' => $deleted,
            ]);
        }
        
        return redirect()->route('depto_index')->with('success', 'Deleted!');
    }

}
