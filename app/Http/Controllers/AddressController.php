<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ViaCepService;

class AddressController extends Controller
{
    public function __construct(private ViaCepService $addressService) {}

    public function findAddress(string $zipCode): Response
    {
        return new Response(
            $this->addressService->find($zipCode),
            Response::HTTP_OK
        );
    }
}
