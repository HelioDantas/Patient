<?php

namespace App\Http\Controllers;

use App\Service\ZipCodeService;

class ZipCodeController extends Controller
{

    public function __construct(
        private readonly ZipCodeService $service
    ) {}

    public function find(string $code)
    {
        return $this->service->find($code);
    }
}
