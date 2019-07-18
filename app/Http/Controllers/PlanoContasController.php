<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlanoContaCreateRequest;
use App\Http\Requests\PlanoContaUpdateRequest;
use App\Repositories\PlanoContaRepository;
use App\Validators\PlanoContaValidator;

/**
 * Class PlanoContasController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlanoContasController extends Controller
{
    /**
     * @var PlanoContaRepository
     */
    protected $repository;

    /**
     * @var PlanoContaValidator
     */
    protected $validator;

    /**
     * PlanoContasController constructor.
     *
     * @param PlanoContaRepository $repository
     * @param PlanoContaValidator $validator
     */
    public function __construct(PlanoContaRepository $repository, PlanoContaValidator $validator)
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
        $planoContas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planoContas,
            ]);
        }

        
        return view('planoContas.index', [
            'planocontas' => $planoContas,
            'page_title' => 'Centro de Custo',
            'page_description' => 'Lista de centro custo'
        ]);
    }
    
    
    
    public function create() {
        
        return view('planoContas.planocontas',[
            'page_title' => 'Plano de Contas',
            'page_description' => 'Lista de Plano de Contas'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanoContaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanoContaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $planoContum = $this->repository->create($request->all());

            $response = [
                'message' => 'PlanoConta created.',
                'data'    => $planoContum->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
        $planoContum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planoContum,
            ]);
        }

        return view('planoContas.show', compact('planoContum'));
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
        $planoContas = $this->repository->find($id);

        return view('planoContas.edit', compact('planoContas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanoContaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanoContaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $planoContum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PlanoConta updated.',
                'data'    => $planoContum->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
                'message' => 'PlanoConta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('ccusto_index')->with('success', 'Centro de Custo Deleted!');
    }
}
