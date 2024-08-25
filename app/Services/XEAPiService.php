<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CustomApiService
{
    protected $apiId;
    protected $apiKey;

    public function __construct()
    {
        $this->apiId = config('employee416047647');
        $this->apiKey = config('4bm6gsia1rldf3qaknil8c3nis');
    }

    public function authenticate()
    {
        $response = Http::withHeaders([
            'X-API-ID' => $this->apiId,
            'X-API-KEY' => $this->apiKey,
        ])->get('https://xecdapi.xe.com/v1/currencies');

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
