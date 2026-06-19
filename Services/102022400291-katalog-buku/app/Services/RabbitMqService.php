<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RabbitMqService
{
    public static function publish()
             {
        $tokenResponse = Http::asForm()->post(
            'https://iae-sso.virtualfri.id/api/v1/auth/token',
            [
                'api_key' => 'KEY-MHS-301',
                'nim' =>  '102022400291'
            ]
        );

        if (!$tokenResponse->successful()) {
            dd(
                'Gagal mendapatkan token',
                $tokenResponse->status(),
                $tokenResponse->body()
            );
        }

        $token = $tokenResponse->json('token');

        $response = Http::withToken($token)
            ->post(
                'https://iae-sso.virtualfri.id/api/v1/messages/publish',
                [
                    'exchange' => 'iae.central.exchange',
                    'message' => [
                        'event'   => 'book.created',
                        'nim'     => '102022400291',
                        'team'    => 'TEAM-05',
                        'service' => 'catalog-book'
                    ]
                ]
            );  

        dd(
            $response->status(),
            $response->body()
        );
    }
}