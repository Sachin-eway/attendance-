<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;

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
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        return response()->json(['status'=>'error' , 'message'=> $e->getMessage()=='Route [login] not defined.' ? 'authentication failed' : $e->getMessage()],500);
    }

    /**
     * Get the status code from the exception.
     *
     * @param  \Throwable  $e
     * @return int
     */
    private function getStatusCode(Throwable $e): int
    {
        if ($this->isHttpException($e)) {
            return $e->getStatusCode();
        }

        return 500;
    }
}

