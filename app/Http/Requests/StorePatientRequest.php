<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'birthday' => 'required|date',
            'full_name' => 'required|string',
            'mom_full_name' => 'required',
            'cns' => 'required|unique:patients',
            'cpf' => 'required|unique:patients|size:11|cpf',
            'photo_url' => 'required|string',
            'address.zip_code' => 'required',
            'address.street' => 'required',
            'address.number' => 'required|numeric',
            'address.complement' => 'nullable',
            'address.neighborhood' => 'required',
            'address.state' => 'required',
            'address.city' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors(),
        'status' => true
        ], 422));
    }
}
