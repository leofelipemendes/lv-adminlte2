<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContasBancariaCreateRequest;
use App\Http\Requests\ContasBancariaUpdateRequest;
use App\Repositories\ContasBancariaRepository;
use App\Validators\ContasBancariaValidator;

/**
 * Class ContasBancariasController.
 *
 * @package namespace App\Http\Controllers;
 */
class ContasBancariasController extends Controller
{
    /**
     * @var ContasBancariaRepository
     */
    protected $repository;

    /**
     * @var ContasBancariaValidator
     */
    protected $validator;

    /**
     * ContasBancariasController constructor.
     *
     * @param ContasBancariaRepository $repository
     * @param ContasBancariaValidator $validator
     */
    public function __construct(ContasBancariaRepository $repository, ContasBancariaValidator $validator)
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
        $contasBancarias = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contasBancarias,
            ]);
        }
        
        return view('contasBancarias.index',[
            'contasBancarias' => $contasBancarias,
            'page_title' => 'ContasBancarias',
            'page_description' => 'Lista de Contas Bancárias'
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContasBancariaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ContasBancariaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contasBancarium = $this->repository->create($request->all());

            $response = [
                'message' => 'ContasBancaria created.',
                'data'    => $contasBancarium->toArray(),
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
        $contasBancarium = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contasBancarium,
            ]);
        }

        return view('contasBancarias.show', compact('contasBancarium'));
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
        $contasBancarium = $this->repository->find($id);

        return view('contasBancarias.edit', compact('contasBancarium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContasBancariaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ContasBancariaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contasBancarium = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ContasBancaria updated.',
                'data'    => $contasBancarium->toArray(),
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
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'ContasBancaria deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ContasBancaria deleted.');
    }
}
