<?php

namespace App\Repository;

use App\Dto\PatientDto;
use App\Http\Requests\FindPatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

readonly class PatientRepository
{   
    public function __construct(
        private Patient $model
    ) { }

    public function create(PatientDto $input)
    {
        $patient = $this->model->create($input->toArray());
        $patient->address()->create($input->address->toArray());
        $patient->refresh();
        return $patient;
    }

    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy(int $id)
    {
        $patient = $this->model->findOrFail($id);

        $patient->address()->delete();

        return $patient->delete();
    }

    public function update(UpdatePatientRequest $request, $id)
    {
        $patient = $this->findOrFail($id);

        $patient->update($request->all());
        $address = $request->only('address')['address'];
        $patient->address()->update($address);
        $patient->refresh();
        return $patient;
    }

    public function paginate(FindPatientRequest $request)
    {
        $validated = $request->only(['cpf', 'full_name']);

        $queries = [];
        foreach($validated as $key => $value) {
            $queries[] = [$key, 'like', "%$value%"];
        }
        return $this->model->where($queries)->paginate()->appends($request->all());
    }
}
