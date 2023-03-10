<?php

namespace Tests\Unit\app\Dto;

use App\Dto\AddressDto;
use App\Dto\PatientDto;
use PHPUnit\Framework\TestCase;

class PatientDtoTest extends TestCase
{
    public function testCreatePatientDto()
    {
        $address = new AddressDto(
            '12345-678',
            'Rua Teste',
            123,
            'Apto 456',
            'Bairro Teste',
            'SP',
            'São Paulo'
        );

        $patient = new PatientDto(
            'Fulano de Tal',
            'Maria de Tal',
            '123456789012345',
            '123.456.789-01',
            '1990-01-01',
            'https://example.com/photo.jpg',
            $address
        );

        $this->assertEquals('Fulano de Tal', $patient->full_name);
        $this->assertEquals('Maria de Tal', $patient->mom_full_name);
        $this->assertEquals('123456789012345', $patient->cns);
        $this->assertEquals('123.456.789-01', $patient->cpf);
        $this->assertEquals('1990-01-01', $patient->birthday);
        $this->assertEquals('https://example.com/photo.jpg', $patient->photo_url);

        $this->assertInstanceOf(AddressDto::class, $patient->address);
        $this->assertEquals('12345-678', $patient->address->zip_code);
        $this->assertEquals('Rua Teste', $patient->address->street);
        $this->assertEquals(123, $patient->address->number);
        $this->assertEquals('Apto 456', $patient->address->complement);
        $this->assertEquals('Bairro Teste', $patient->address->neighborhood);
        $this->assertEquals('SP', $patient->address->state);
        $this->assertEquals('São Paulo', $patient->address->city);
    }

    public function testToArray()
    {
        $address = new AddressDto(
            '12345-678',
            'Rua Teste',
            123,
            'Apto 456',
            'Bairro Teste',
            'SP',
            'São Paulo'
        );

        $patientDto = new PatientDto(
            'Fulano de Tal',
            'Maria de Tal',
            '1234567890123456',
            '12345678901',
            '1990-01-01',
            'http://example.com/photo.jpg',
            $address
        );

        $array = $patientDto->toArray();

        $this->assertIsArray($array);
        $this->assertEquals('Fulano de Tal', $array['full_name']);
        $this->assertEquals('Maria de Tal', $array['mom_full_name']);
        $this->assertEquals('1234567890123456', $array['cns']);
        $this->assertEquals('12345678901', $array['cpf']);
        $this->assertEquals('1990-01-01', $array['birthday']);
        $this->assertEquals('http://example.com/photo.jpg', $array['photo_url']);
        $this->assertEquals($address, $array['address']);
    }

    public function testArrayAccess()
    {
        $address = new AddressDto(
            '12345-678',
            'Rua Teste',
            123,
            'Apto 456',
            'Bairro Teste',
            'SP',
            'São Paulo'
        );

        $patientDto = new PatientDto(
            'Fulano de Tal',
            'Maria de Tal',
            '1234567890123456',
            '12345678901',
            '1990-01-01',
            'http://example.com/photo.jpg',
            $address
        );

        $this->assertEquals('Fulano de Tal', $patientDto['full_name']);
        $this->assertEquals('Maria de Tal', $patientDto['mom_full_name']);
        $this->assertEquals('1234567890123456', $patientDto['cns']);
        $this->assertEquals('12345678901', $patientDto['cpf']);
        $this->assertEquals('1990-01-01', $patientDto['birthday']);
        $this->assertEquals('http://example.com/photo.jpg', $patientDto['photo_url']);
        $this->assertEquals($address, $patientDto['address']);
    }
}
