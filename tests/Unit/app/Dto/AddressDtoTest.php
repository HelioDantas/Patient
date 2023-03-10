<?php

namespace Tests\Unit\app\Dto;

use App\Dto\AddressDto;
use PHPUnit\Framework\TestCase;

class AddressDtoTest extends TestCase
{
    public function testToArray()
    {
        $address = new AddressDto(
            '12345678',
            'Rua Teste',
            123,
            'Apto 456',
            'Bairro Teste',
            'SP',
            'São Paulo'
        );

        $this->assertEquals([
            'zip_code' => '12345678',
            'street' => 'Rua Teste',
            'number' => 123,
            'complement' => 'Apto 456',
            'neighborhood' => 'Bairro Teste',
            'state' => 'SP',
            'city' => 'São Paulo'
        ], $address->toArray());
    }

    public function testArrayAccess()
    {
        $address = new AddressDto(
            '12345678',
            'Rua Teste',
            123,
            'Apto 456',
            'Bairro Teste',
            'SP',
            'São Paulo'
        );

        $this->assertEquals('12345678', $address['zip_code']);
        $this->assertEquals('Rua Teste', $address['street']);
        $this->assertEquals(123, $address['number']);
        $this->assertEquals('Apto 456', $address['complement']);
        $this->assertEquals('Bairro Teste', $address['neighborhood']);
        $this->assertEquals('SP', $address['state']);
        $this->assertEquals('São Paulo', $address['city']);
    }
}
