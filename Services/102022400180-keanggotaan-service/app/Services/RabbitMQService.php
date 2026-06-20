<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RabbitMQService
{
    private string $baseUrl = 'https://iae-sso.virtualfri.id';
    private string $exchange = 'iae.central.exchange';

    public function publish(string $routingKey, array $payload, string $bearerToken): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearerToken,
                'Content-Type'  => 'application/json',
            ])->post("{$this->baseUrl}/api/v1/messages/publish", [
                'exchange'    => $this->exchange,
                'routing_key' => $routingKey,
                'payload'     => $payload,
            ]);

            return $response->successful();

        } catch (\Exception $e) {
            \Log::error('RabbitMQ error: ' . $e->getMessage());
            return false;
        }
    }
}