<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use App\Exceptions\ApiException;

use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Auth\Access\AuthorizationException as ActionAuthorizationException;


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
        $this->reportable(function (Throwable $e) {
            // Log everything, including 500s
            Log::error($e);
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*') || $request->expectsJson()) {

            if ($exception instanceof ApiException) {
                return ApiResponse::error($exception->getMessage(), $exception->getStatusCode());
            }

            // API exception handling
            if ($exception instanceof ValidationException) {
                return ApiResponse::error(
                    'Validation failed',
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    $exception->errors()
                );
            }

            // NotFoundHttpException for API endpoints
            if ($exception instanceof NotFoundHttpException) {
                return ApiResponse::error('API endpoint not found', Response::HTTP_NOT_FOUND);
            }

            // Authentication exception
            if ($exception instanceof AuthenticationException) {
                return ApiResponse::error('Unauthenticated', Response::HTTP_UNAUTHORIZED);
            }

            if ($exception instanceof ActionAuthorizationException) {
                return ApiResponse::error($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
            }

            // Other exceptions
            $status = Response::HTTP_INTERNAL_SERVER_ERROR; // Default to 500
            if ($exception instanceof HttpExceptionInterface) {
                $status = $exception->getStatusCode();
            }

            return ApiResponse::error(
                $exception->getMessage() ?: 'Server Error',
                $status
            );
        }

        // If the request does not expect JSON, use the default exception handler
        return parent::render($request, $exception);
    }
}
