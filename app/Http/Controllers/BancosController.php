<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BancoCreateRequest;
use App\Http\Requests\BancoUpdateRequest;
use App\Repositories\BancoRepository;
use App\Validators\BancoValidator;

/**
 * Class BancosController.
 *
 * @package namespace App\Http\Controllers;
 */
class BancosController extends Controller
{
    /**
     * @var BancoRepository
     */
    protected $repository;

    /**
     * @var BancoValidator
     */
    protected $validator;

    /**
     * BancosController constructor.
     *
     * @param BancoRepository $repository
     * @param BancoValidator $validator
     */
    public function __construct(BancoRepository $repository, BancoValidator $validator)
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
        $bancos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bancos,
            ]);
        }

        return view('bancos.index', [
            'bancos' => $bancos,
            'page_title' => 'Bancos',
            'page_description' => 'Lista de Bancos'
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BancoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BancoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $banco = $this->repository->create($request->all());

            $response = [
                'message' => 'Banco created.',
                'data'    => $banco->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('bancos_index')->with('success', $response['message']);
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
        $banco = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $banco,
            ]);
        }

        return view('bancos.show', compact('banco'));
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
        $bancos = $this->repository->find($id);
        
        return view('bancos.bancos', [
            'bancos' => $bancos,
            'page_title' => 'Bancos',
            'page_description' => 'Lista de Bancos'
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BancoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BancoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $banco = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Banco updated.',
                'data'    => $banco->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('bancos_index')->with('success', $response['message']);
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
                'message' => 'Banco deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('bancos_index')->with('success', 'Deleted!');
    }
    
    public function create() {
        
        return view('bancos.bancos',[
            'page_title' => 'Bancos',
            'page_description' => 'Lista de Bancos'
        ]);
    }
}
