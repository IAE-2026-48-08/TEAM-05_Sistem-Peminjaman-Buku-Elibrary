<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Membership Service API",
 *     version="1.0.0",
 *     description="API Documentation for Service Keanggotaan IAE-T2"
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local Development Server"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="ApiKeyAuth",
 *     type="apiKey",
 *     in="header",
 *     name="X-IAE-KEY"
 * )
 */
class SwaggerController extends Controller
{
    // kosong, hanya untuk anotasi swagger
}