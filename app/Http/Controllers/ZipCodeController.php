<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZipCodeController extends Controller
{

    public function find(string $code)
    {
        $response = Http::get("https://viacep.com.br/ws/{$code}/json/");
        return $response;
    }
}
