<?php

namespace App\Exceptions;

use App\Http\Controllers\Api\V1\ApiController;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
//        $this->reportable(function (Throwable $e) {
//            //
//        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiController::error(code: 404, message: "path not found");
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiController::error(code: 403, message: "access denied");
            }
        });

        $this->renderable(function (ServiceUnavailableHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiController::error(code: 503, message: "server side problem");
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return ApiController::error(code: 406, message: $e->errors());
            }
        });

        $this->renderable(function (UnprocessableEntityHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiController::error(code: 422, message: "database insertion failed");
            }
        });
    }
}
