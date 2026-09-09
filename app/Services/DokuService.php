<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DokuService
{
    protected string $clientId;
    protected string $secretKey;
    protected string $baseUrl;
    protected string $targetPath = '/checkout/v1/payment';

    public function __construct()
    {
        $this->clientId = config('services.doku.client_id');
        $this->secretKey = config('services.doku.secret_key');
        $this->baseUrl = config('services.doku.is_production')
            ? 'https://api.doku.com'
            : 'https://sandbox.doku.com';
    }

    public function createCheckout(array $payload)
    {
        $requestId = (string) Str::uuid();
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');

        $bodyJson = json_encode($payload);
        $digest = base64_encode(hash('sha256', $bodyJson, true));

        // PENTING: Request-Target WAJIB path relatif (/checkout/v1/payment)
        $rawSignature = "Client-Id:" . $this->clientId . "\n"
            . "Request-Id:" . $requestId . "\n"
            . "Request-Timestamp:" . $timestamp . "\n"
            . "Request-Target:" . $this->targetPath . "\n"
            . "Digest:" . $digest;

        $signature = base64_encode(hash_hmac('sha256', $rawSignature, $this->secretKey, true));

        $response = Http::withHeaders([
            'Client-Id' => $this->clientId,
            'Request-Id' => $requestId,
            'Request-Timestamp' => $timestamp,
            'Signature' => 'HMACSHA256=' . $signature,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . $this->targetPath, $payload);

        if ($response->failed()) {
            dd('DOKU Checkout Error', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
        }

        return $response->json();
    }
}
