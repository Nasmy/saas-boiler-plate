<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * success response method.
     *
     * @param $data
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }


    /**
     * return error response.
     *
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($message, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => null,
            'code' => $code
        ], $code);
    }

}
