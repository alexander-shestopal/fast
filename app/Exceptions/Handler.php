<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

        /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $e
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        $statusCode = $this->getExceptionStatusCode($e);
        if (($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) && $request->wantsJson()) {
            return $this->handleModelNotFoundExceptionWithJson();
        } elseif 
        ($e instanceof ValidationException) {
            return $this->handleValidationException($e, $statusCode);
        }

        return parent::render($request, $e);
    }


    public function handleModelNotFoundExceptionWithJson(): JsonResponse
    {
        return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function handleValidationException($exception, $statusCode): JsonResponse
    {
        return response()->json(['message' => $exception->errors()], $statusCode);
    }

    
    public function getExceptionStatusCode($exception): int
    {
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } elseif (property_exists($exception, 'status') && $exception->status) {
            $statusCode = $exception->status;
        }
        return $statusCode;
    }
}
