<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FornecedorCreateRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Repositories\FornecedorRepository;
use App\Validators\FornecedorValidator;
use App\Entities\Estado;

/**
 * Class FornecedoresController.
 *
 * @package namespace App\Http\Controllers;
 */
class FornecedoresController extends Controller
{
    /**
     * @var FornecedorRepository
     */
    protected $repository;

    /**
     * @var FornecedorValidator
     */
    protected $validator;

    /**
     * FornecedoresController constructor.
     *
     * @param FornecedorRepository $repository
     * @param FornecedorValidator $validator
     */
    public function __construct(FornecedorRepository $repository, FornecedorValidator $validator)
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
        $fornecedores = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $fornecedores,
            ]);
        }

        return view('fornecedores.index',[
            'fornecedores' => $fornecedores,
            'page_title' => 'Fornecedores',
            'page_description' => 'Lista de fornecedores'
        ]);
    }
    
    public function create() {
        $estados = Estado::pluck('descricao','id');
        return view('fornecedores.fornecedores',[
            'page_title' => 'Fornecedores',
            'page_description' => 'Lista de fornecedores',
            'estados' => $estados
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FornecedorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FornecedorCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $fornecedor = $this->repository->create($request->all());

            $response = [
                'message' => 'Fornecedor created.',
                'data'    => $fornecedor->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('fornecedor_index')->with('success', $response['message']);
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
        $fornecedor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $fornecedor,
            ]);
        }

        return view('fornecedores.show', compact('fornecedor'));
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
        $fornecedores = $this->repository->find($id);

        return view('fornecedores.fornecedores', compact('fornecedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FornecedorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FornecedorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $fornecedores = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Fornecedor updated.',
                'data'    => $fornecedores->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('fornecedor_index')->with('success', $response['message']);
        } catch (ValidatorException $e) {
            dd($e->getMessageBag());
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
                'message' => 'Fornecedor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('fornecedor_index')->with('success', 'Deleted!');
    }
    
}
