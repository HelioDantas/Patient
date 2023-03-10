<?php

namespace App\Dto;

readonly class AddressDto extends Dto
{
    public function __construct(
        public string $zip_code,
        public string $street,
        public int $number,
        public string $complement,
        public string $neighborhood,
        public string $state,
        public string $city,
    ) { }    
}
