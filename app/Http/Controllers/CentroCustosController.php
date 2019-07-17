<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CentroCustoCreateRequest;
use App\Http\Requests\CentroCustoUpdateRequest;
use App\Repositories\CentroCustoRepository;
use App\Validators\CentroCustoValidator;

/**
 * Class CentroCustosController.
 *
 * @package namespace App\Http\Controllers;
 */
class CentroCustosController extends Controller
{
    /**
     * @var CentroCustoRepository
     */
    protected $repository;

    /**
     * @var CentroCustoValidator
     */
    protected $validator;

    /**
     * CentroCustosController constructor.
     *
     * @param CentroCustoRepository $repository
     * @param CentroCustoValidator $validator
     */
    public function __construct(CentroCustoRepository $repository, CentroCustoValidator $validator)
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
        $centroCustos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $centroCustos,
            ]);
        }

        return view('centroCustos.index', [
            'centrocustos' => $centroCustos,
            'page_title' => 'Centro de Custo',
            'page_description' => 'Lista de centro custo'
                ]);
    }
    
    
    public function create() {
        
        return view('centroCustos.centrocustos',[
            'page_title' => 'Centro de Custo',
            'page_description' => 'Lista de centro de custo'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CentroCustoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CentroCustoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $centroCusto = $this->repository->create($request->all());

            $response = [
                'message' => 'Centro de Custo created.',
                'data'    => $centroCusto->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('ccusto_index')->with('success', $response['message']);
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
        $centroCusto = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $centroCusto,
            ]);
        }

        return view('centroCustos.show', compact('centroCusto'));
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
        $centroCustos = $this->repository->find($id);

        
        return view('centroCustos.centrocustos',[
            'centrocustos' => $centroCustos,
            'page_title' => 'Centro de Custo',
            'page_description' => 'Lista de centro de custo'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CentroCustoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CentroCustoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $centroCusto = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CentroCusto updated.',
                'data'    => $centroCusto->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('ccusto_index')->with('success', $response['message']);
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
                'message' => 'Centro de Custo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('ccusto_index')->with('success', 'Centro de Custo Deleted!');
    }
}
