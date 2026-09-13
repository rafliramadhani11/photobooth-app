<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            : 'https://api-sandbox.doku.com';
    }

    public function createCheckout(array $payload)
    {
        $requestId = (string) Str::uuid();
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');

        $bodyJson = json_encode($payload);
        $digest = base64_encode(hash('sha256', $bodyJson, true));

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
        ])->withBody($bodyJson, 'application/json')
            ->post($this->baseUrl . $this->targetPath);

        if ($response->failed()) {
            Log::error('DOKU Checkout Error', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            throw new \RuntimeException('Gagal membuat checkout DOKU: ' . ($response->json('error.message') ?? 'unknown error'));
        }

        return $response->json();
    }
}
