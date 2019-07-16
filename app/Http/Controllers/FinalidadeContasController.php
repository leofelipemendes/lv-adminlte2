<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FinalidadeContaCreateRequest;
use App\Http\Requests\FinalidadeContaUpdateRequest;
use App\Repositories\FinalidadeContaRepository;
use App\Validators\FinalidadeContaValidator;

/**
 * Class FinalidadeContasController.
 *
 * @package namespace App\Http\Controllers;
 */
class FinalidadeContasController extends Controller
{
    /**
     * @var FinalidadeContaRepository
     */
    protected $repository;

    /**
     * @var FinalidadeContaValidator
     */
    protected $validator;

    /**
     * FinalidadeContasController constructor.
     *
     * @param FinalidadeContaRepository $repository
     * @param FinalidadeContaValidator $validator
     */
    public function __construct(FinalidadeContaRepository $repository, FinalidadeContaValidator $validator)
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
        $finalidadeContas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $finalidadeContas,
            ]);
        }

        return view('finalidadeContas.index', compact('finalidadeContas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FinalidadeContaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FinalidadeContaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $finalidadeContum = $this->repository->create($request->all());

            $response = [
                'message' => 'FinalidadeConta created.',
                'data'    => $finalidadeContum->toArray(),
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
        $finalidadeContum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $finalidadeContum,
            ]);
        }

        return view('finalidadeContas.show', compact('finalidadeContum'));
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
        $finalidadeContum = $this->repository->find($id);

        return view('finalidadeContas.edit', compact('finalidadeContum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FinalidadeContaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FinalidadeContaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $finalidadeContum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'FinalidadeConta updated.',
                'data'    => $finalidadeContum->toArray(),
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
                'message' => 'FinalidadeConta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FinalidadeConta deleted.');
    }
}
