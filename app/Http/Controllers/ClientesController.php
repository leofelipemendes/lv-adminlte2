<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClienteCreateRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Repositories\ClienteRepository;
use App\Validators\ClienteValidator;
use \App\Entities\Estado;
use \App\Entities\Municipio;

/**
 * Class ClientesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClientesController extends Controller
{
    /**
     * @var ClienteRepository
     */
    protected $repository;

    /**
     * @var ClienteValidator
     */
    protected $validator;

    /**
     * ClientesController constructor.
     *
     * @param ClienteRepository $repository
     * @param ClienteValidator $validator
     */
    public function __construct(ClienteRepository $repository, ClienteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $clientes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $clientes,
            ]);
        }
        return view('clientes.index',[
            'clientes' => $clientes,
            'page_title' => 'Clientes',
            'page_description' => 'Lista de clientes'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClienteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClienteCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cliente = $this->repository->create($request->all());

            $response = [
                'message' => 'Cliente criado.',
                'data'    => $cliente->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('cliente_index')->with('success', $response['message']);
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cliente,
            ]);
        }

        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = $this->repository->find($id);
        $estados = Estado::pluck('descricao','id');
        $municipios = Municipio::pluck('nome','id');
        return view('clientes.clientes',[
            'clientes' => $clientes,
            'page_title' => 'Cliente',
            'page_description' => 'Lista de clientes',
            'estados' => $estados,
            'municipios' => $municipios
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClienteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClienteUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cliente = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cliente updated.',
                'data'    => $cliente->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('cliente_index')->with('success', $response['message']);
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Cliente deleted.',
                'deleted' => $deleted,
            ]);
        }
        
        return redirect()->route('cliente_index')->with('success', 'Deleted!');
    }
    
    public function create() {
        
        $estados = Estado::pluck('descricao','id');
        return view('clientes.clientes',[
            'page_title' => 'Cliente',
            'page_description' => 'Lista de clientes',
            'estados' => $estados
        ]);
    }
    
    
}
