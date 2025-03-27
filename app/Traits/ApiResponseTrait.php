<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function successResponse($message, $data = [], $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'result' => $data
        ], $status);
    }

    public function errorResponse($message, $error = null, $status = 500)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $error
        ], $status);
    }
}
