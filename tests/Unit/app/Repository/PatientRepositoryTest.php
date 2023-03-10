<?php 

namespace Tests\Unit\app\Repository;

use App\Repository\PatientRepository;
use App\Models\Patient;
use App\Dto\PatientDto;
use App\Dto\AddressDto;
use Tests\TestCase;

class PatientRepositoryTest extends TestCase
{
    public function testCreate()
    {
        $patientRepository = new PatientRepository(new Patient());
        
        $addressDto = new AddressDto(
            '12345-678',
            'Rua A',
            123,
            'Apto 101',
            'Bairro X',
            'Estado Z',
            'Cidade Y'
        );
        
        $patientDto = new PatientDto(
            'João da Silva',
            'Maria da Silva',
            '1234567890123456',
            '12345678901',
            '1990-01-01',
            'http://example.com/photo.jpg',
            $addressDto
        );
        
        $patient = $patientRepository->create($patientDto);
        
        $this->assertEquals('João da Silva', $patient->full_name);
        $this->assertEquals('Maria da Silva', $patient->mom_full_name);
        $this->assertEquals('1234567890123456', $patient->cns);
        $this->assertEquals('12345678901', $patient->cpf);
        $this->assertEquals('1990-01-01', $patient->birthday);
        $this->assertEquals('http://example.com/photo.jpg', $patient->photo_url);
    }

    public function testFindOrFail()
    {
        $patient = Patient::factory()->create();
        $patientRepository = new PatientRepository(new Patient());

        $patientResult = $patientRepository->findOrFail($patient->id);
        
        $this->assertEquals($patient->full_name, $patientResult->full_name);
    }

    public function testDestroy()
    {
        $patient = Patient::factory()->create();
        $patientRepository = new PatientRepository(new Patient());
        
        $this->assertTrue($patientRepository->destroy($patient->id));
    }
}
