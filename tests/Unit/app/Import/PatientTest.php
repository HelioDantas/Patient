<?php

namespace Tests\Unit\app\Import;

use App\Dto\AddressDto;
use App\Dto\PatientDto;
use App\Import\PatientImport;
use PHPUnit\Framework\TestCase;

class PatientTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
       $import = $this->getMockBuilder(PatientImport::class)
        ->disableOriginalConstructor()
        ->onlyMethods(['toArray'])
        ->getMock();
        
        $row = [
            "matheys dsd",
            "dfdfd",
            "eliene",
            "15-02-1996",
            "69493392163",
            "180299277490007",
            "21210620",
            "rua d",
            8,
            "",
            "taquara",
            "rio de janeiro",
            "rio de janeiro",
        ];
        $import->method('toArray')->willReturn([$row]);

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
        
        $patientsDto = collect();

        $patientsDto->push($patientDto);

        $result = $import->get();

        $this->assertEquals($patientsDto, $result);
    }
}
