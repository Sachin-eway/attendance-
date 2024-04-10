<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function jsonResponse($status, $message, $data = null, $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['result'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    public function success($message, $data = null): JsonResponse
    {
        return $this->jsonResponse('success', $message, $data);
    }

    public function error($message): JsonResponse
    {
        return $this->jsonResponse('error', $message, null, 500);
    }

    public function validation($message): JsonResponse
    {
        return $this->jsonResponse('error', $message, null, 422);
    }
}