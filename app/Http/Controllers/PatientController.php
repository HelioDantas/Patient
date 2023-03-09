<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Repository\PatientRepository;

class PatientController extends Controller
{

    public function __construct(
        private readonly PatientRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(FindPatientRequest $request)
    {
        return PatientResource::collection($this->repository->paginate($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = $this->repository->create($request);
        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return (new PatientResource($this->repository->findOrFail($id)));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, int $id)
    {
        $patient = $this->repository->update($request, $id);
        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
