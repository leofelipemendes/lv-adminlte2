<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoContaCreateRequest;
use App\Http\Requests\TipoContaUpdateRequest;
use App\Repositories\TipoContaRepository;
use App\Validators\TipoContaValidator;

/**
 * Class TipoContasController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoContasController extends Controller
{
    /**
     * @var TipoContaRepository
     */
    protected $repository;

    /**
     * @var TipoContaValidator
     */
    protected $validator;

    /**
     * TipoContasController constructor.
     *
     * @param TipoContaRepository $repository
     * @param TipoContaValidator $validator
     */
    public function __construct(TipoContaRepository $repository, TipoContaValidator $validator)
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
        $tipoContas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoContas,
            ]);
        }

        return view('tipoContas.index', compact('tipoContas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoContaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoContaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoContum = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoConta created.',
                'data'    => $tipoContum->toArray(),
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
        $tipoContum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoContum,
            ]);
        }

        return view('tipoContas.show', compact('tipoContum'));
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
        $tipoContum = $this->repository->find($id);

        return view('tipoContas.edit', compact('tipoContum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoContaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoContaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoContum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoConta updated.',
                'data'    => $tipoContum->toArray(),
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
                'message' => 'TipoConta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoConta deleted.');
    }
}
