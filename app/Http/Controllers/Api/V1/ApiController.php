<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public static function success(int $code=200,mixed $data=[],mixed $message=null): JsonResponse
    {
        return response()->json(
            [
                'status' => 'ok',
                'data' => $data,
                'message' => $message,
                'code' => $code
            ],
            $code
        );
    }
    public static function error(int $code=404,mixed $data=[],mixed $message=null): JsonResponse
    {
        return response()->json(
            [
                'status' => 'error',
                'data' => $data,
                'message' => $message,
                'code' => $code,
            ],
            $code
        );
    }
}
