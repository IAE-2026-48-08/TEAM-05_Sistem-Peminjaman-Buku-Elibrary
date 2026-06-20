<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Member;
use App\Services\SsoService;
use Illuminate\Http\Request;

class SsoController extends Controller
{
    protected SsoService $ssoService;

    public function __construct(SsoService $ssoService)
    {
        $this->ssoService = $ssoService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            // Ambil token dari SSO
            $token = $this->ssoService->getUserToken(
                $request->email,
                $request->password
            );

            if (!$token) {
                return ApiResponse::error('SSO authentication failed', null, 401);
            }

            // Decode dan verifikasi JWT
            $payload = $this->ssoService->verifyAndDecodeToken($token);

            // Upsert member berdasarkan SSO data
            $member = Member::updateOrCreate(
                ['sso_id' => $payload->sub],
                [
                    'name'   => $payload->profile->name ?? $payload->sub,
                    'email'  => $payload->profile->email ?? $payload->sub,
                    'status' => 'active',
                    'role'   => 'member',
                ]
            );

            return ApiResponse::success([
                'token'  => $token,
                'member' => $member,
                'role'   => 'member',
            ], 'SSO login successful');

        } catch (\Exception $e) {
            return ApiResponse::error('SSO error: ' . $e->getMessage(), null, 500);
        }
    }

    public function verify(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponse::error('Token not provided', null, 401);
        }

        try {
            $payload = $this->ssoService->verifyAndDecodeToken($token);

            return ApiResponse::success([
                'valid'   => true,
                'sub'     => $payload->sub,
                'name'    => $payload->profile->name ?? null,
                'email'   => $payload->profile->email ?? null,
                'role'    => 'member',
            ], 'Token is valid');

        } catch (\Exception $e) {
            return ApiResponse::error('Invalid token: ' . $e->getMessage(), null, 401);
        }
    }
}