<?php

namespace App\Import;

use App\Dto\AddressDto;
use App\Dto\PatientDto;

class PatientImport extends Import
{
    public function get()
    {
        $rows = $this->toArray(false);
        $patientsDto = collect();

        foreach($rows as $row) {
            $addressDto = new AddressDto(
                $row[6],
                $row[7],
                $row[8],
                $row[9],
                $row[10],
                $row[11],
                $row[12],
            );

            $patientDto = new PatientDto(
                full_name: $row[0],
                photo_url: $row[1],
                mom_full_name: $row[2],
                birthday: implode('-', array_reverse(explode('-', $row[3]))),
                cpf: $row[4],
                cns: $row[5],
                address: $addressDto,
            );
            $patientsDto->push($patientDto);
        }

        return $patientsDto;
    }
    
}
