<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class ViaCepService
{
    public function __construct() {}

    public function find(string $zipCode): string|array
    {
        return $this->getCachedAddress($zipCode) ?? $this->getAddress($zipCode);
    }

    private function getCachedAddress(string $zipCode): string|array|null
    {
        return Cache::store('redis')->get($zipCode);
    }

    private function setAddressCache(string $key, string|array $value): void 
    {
        Cache::store('redis')->put($key, $value, 6000);
    }

    private function getAddress(string $zipCode): string
    {
        $response = Http::get("https://viacep.com.br/ws/{$zipCode}/json");
        if ($response->failed()) {
            $response->throw();
        }

        $address = $response->json();
        $this->setAddressCache($zipCode, $address);
        return $address;
    }
}
