<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class ZipCodeService
{
    private const KEY = 'zipcode';

    public function find(string $code)
    {
        $address = Redis::get(self::KEY . $code);
        if ($address) {
            return $address;
        }
        $response = Http::get("https://viacep.com.br/ws/{$code}/json/");
        Redis::set(self::KEY . $code, json_encode($response->json()));
        return $response->json();
    }
}
