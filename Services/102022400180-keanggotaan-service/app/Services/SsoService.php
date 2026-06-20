<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Illuminate\Support\Facades\Http;

class SsoService
{
    private string $ssoUrl = 'https://iae-sso.virtualfri.id';
    private string $apiKey = 'KEY-MHS-257';

    public function getM2MToken(): string
    {
    $response = Http::post("{$this->ssoUrl}/api/v1/auth/token", [
        'api_key' => $this->apiKey,
        'nim'     => '102022400180',
    ]);

    return $response->json('token');
    }

    public function getUserToken(string $email, string $password): string
    {
        $response = Http::post("{$this->ssoUrl}/api/v1/auth/token", [
            'email'    => $email,
            'password' => $password,
        ]);

        return $response->json('token');
    }

    public function getPublicKeys(): array
    {
        $response = Http::get("{$this->ssoUrl}/api/v1/auth/jwks");
        return $response->json();
    }

    public function verifyAndDecodeToken(string $token): object
    {
        $jwks = $this->getPublicKeys();
        $keys = JWK::parseKeySet($jwks);

        return JWT::decode($token, $keys);
    }

    public function mapRoleToLocal(string $ssoRole): string
    {
        $roleMap = [
            'admin'  => 'administrator',
            'member' => 'member',
            'guest'  => 'guest',
        ];

        return $roleMap[$ssoRole] ?? 'member';
    }
}