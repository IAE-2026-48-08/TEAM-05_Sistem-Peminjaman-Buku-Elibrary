<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MemberService
{
    public static function getStatus($memberId)
    {
        return Http::withHeaders([
            'X-IAE-KEY' => '102022400180'
        ])->get(
            "http://127.0.0.1:8001/api/v1/members/{$memberId}/status"
        )->json();
    }
}