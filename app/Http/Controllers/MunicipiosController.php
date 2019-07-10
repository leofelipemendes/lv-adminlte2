<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MunicipioCreateRequest;
use App\Http\Requests\MunicipioUpdateRequest;
use App\Repositories\MunicipioRepository;
use App\Validators\MunicipioValidator;

/**
 * Class MunicipiosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MunicipiosController extends Controller
{
    /**
     * @var MunicipioRepository
     */
    protected $repository;

    /**
     * @var MunicipioValidator
     */
    protected $validator;

    /**
     * MunicipiosController constructor.
     *
     * @param MunicipioRepository $repository
     * @param MunicipioValidator $validator
     */
    public function __construct(MunicipioRepository $repository, MunicipioValidator $validator)
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
        $municipios = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $municipios,
            ]);
        }

        return view('municipios.index', compact('municipios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MunicipioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MunicipioCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $municipio = $this->repository->create($request->all());

            $response = [
                'message' => 'Municipio created.',
                'data'    => $municipio->toArray(),
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
        $municipio = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $municipio,
            ]);
        }

        return view('municipios.show', compact('municipio'));
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
        $municipio = $this->repository->find($id);

        return view('municipios.edit', compact('municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MunicipioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MunicipioUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $municipio = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Municipio updated.',
                'data'    => $municipio->toArray(),
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
                'message' => 'Municipio deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Municipio deleted.');
    }
}
