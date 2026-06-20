<?php

namespace App\Http\Responses;

/**
 * @OA\Schema()
 */
class ApiResponse
{
    public static function success($data = null, $message = 'Data retrieved successfully', $meta = null, $code = 200)
    {
        $response = [
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ];

        if ($meta) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $code);
    }

    public static function error($message = 'Something went wrong', $errors = null, $code = 400)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}