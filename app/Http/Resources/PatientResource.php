<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'mom_full_name' => $this->mom_full_name,
            'cns' => $this->cns,
            'cpf' => $this->cpf,
            'birthday' => $this->birthday,
            'address' => new AddressResource($this->address),
        ];
    }
}
