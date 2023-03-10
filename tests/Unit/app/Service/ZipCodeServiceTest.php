<?php

namespace Tests\Unit\app\Service;

use App\Service\ZipCodeService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class ZipCodeServiceTest extends TestCase
{
    public function testFind()
    {
        $mockResponse = [
            'cep' => '21210680',
            'logradouro' => 'Rua B',
            'bairro' => 'Bairro Penha',
            'localidade' => 'Rio de Janeiro',
            'uf' => 'UF',
        ];
        Http::fake([
            'https://viacep.com.br/ws/*' => Http::response($mockResponse),
        ]);

        Redis::shouldReceive('get')->andReturn(null);
        Redis::shouldReceive('set');

        $service = new ZipCodeService();

        $result = $service->find('21210680');
        $this->assertEquals($mockResponse, $result);
    }

    public function testFindWhenFindRedis()
    {
        $mockResponse = [
            'cep' => '21210680',
            'logradouro' => 'Rua B',
            'bairro' => 'Bairro Penha',
            'localidade' => 'Rio de Janeiro',
            'uf' => 'UF',
        ];

        Redis::shouldReceive('get')->andReturn($mockResponse);

        $service = new ZipCodeService();

        $result = $service->find('21210680');
        $this->assertEquals($mockResponse, $result);
    }
}
