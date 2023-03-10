<?php

namespace App\Http\Controllers;

use App\Dto\AddressDto;
use App\Dto\PatientDto;
use App\Http\Requests\FindPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Import\PatientImport;
use App\Jobs\ProcessPatients;
use App\Repository\PatientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $input = $request->all();

        $addressDto = new AddressDto(
            $input['address']['zip_code'],
            $input['address']['street'],
            $input['address']['number'],
            $input['address']['complement'] ?? '',
            $input['address']['neighborhood'],
            $input['address']['state'],
            $input['address']['city'],
        );

        $patientDto = new PatientDto(
            $input['full_name'],
            $input['mom_full_name'],
            $input['cns'],
            $input['cpf'],
            $input['birthday'],
            $input['photo_url'],
            $addressDto,
        );

        $patient = $this->repository->create($patientDto);

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

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json($validator->errors(), 400);
        }

        $file = $request->file('file');

        $import = new PatientImport($file);

        $patientsDto = $import->get();

        ProcessPatients::dispatch($patientsDto);
    }

    public function index2()
    {
        return view('welcome');
    }
}
