<?php

namespace App\Traits;

trait Response
{
    public function successResponse($result = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'result' => $result,
        ], $code);
    }

    public function errorResponse($message = 'Error', $code = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}