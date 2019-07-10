<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EstadoCreateRequest;
use App\Http\Requests\EstadoUpdateRequest;
use App\Repositories\EstadoRepository;
use App\Validators\EstadoValidator;

/**
 * Class EstadosController.
 *
 * @package namespace App\Http\Controllers;
 */
class EstadosController extends Controller
{
    /**
     * @var EstadoRepository
     */
    protected $repository;

    /**
     * @var EstadoValidator
     */
    protected $validator;

    /**
     * EstadosController constructor.
     *
     * @param EstadoRepository $repository
     * @param EstadoValidator $validator
     */
    public function __construct(EstadoRepository $repository, EstadoValidator $validator)
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
        $estados = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $estados,
            ]);
        }

        return view('estados.index', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstadoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EstadoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $estado = $this->repository->create($request->all());

            $response = [
                'message' => 'Estado created.',
                'data'    => $estado->toArray(),
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
        $estado = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $estado,
            ]);
        }

        return view('estados.show', compact('estado'));
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
        $estado = $this->repository->find($id);

        return view('estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EstadoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EstadoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $estado = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Estado updated.',
                'data'    => $estado->toArray(),
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
                'message' => 'Estado deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Estado deleted.');
    }
}
