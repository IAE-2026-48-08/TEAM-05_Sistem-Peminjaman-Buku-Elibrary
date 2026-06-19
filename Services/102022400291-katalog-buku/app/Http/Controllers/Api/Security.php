<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: "ApiKeyAuth",
    type: "apiKey",
    name: "X-IAE-KEY",
    in: "header"
)]
class Security
{
}