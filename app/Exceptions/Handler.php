<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException || ($exception instanceof HttpException && $exception->getStatusCode() === 403)) {
            return response()->file(public_path('403.jpg'), [
                'Content-Type' => 'image/jpeg'
            ]);
        }

        return parent::render($request, $exception);
    }
}
