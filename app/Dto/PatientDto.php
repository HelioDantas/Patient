<?php

namespace App\Dto;

readonly class PatientDto extends Dto
{
    public function __construct(
        public string $full_name,
        public string $mom_full_name,
        public string $cns,
        public string $cpf,
        public string $birthday,
        public string $photo_url,
        public AddressDto $address,
    ) { }    
}
