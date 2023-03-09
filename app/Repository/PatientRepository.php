<?php

namespace App\Repository;

use App\Http\Requests\FindPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

class PatientRepository
{
    public function create(StorePatientRequest | UpdatePatientRequest $request)
    {
        $patient = Patient::create($request->all());
        $address = $request->only('address')['address'];
        $patient->address()->create($address);
        $patient->refresh();
        return $patient;
    }

    public function findOrFail(int $id)
    {
        return Patient::findOrFail($id);
    }

    public function destroy(int $id)
    {
        $patient = Patient::findOrFail($id);

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
        return Patient::where($queries)->paginate()->appends($request->all());
    }
}
