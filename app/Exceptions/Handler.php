<?php

namespace App\Exceptions;

use Redirect;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tmdb\Exception\TmdbApiException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Tmdb\Exception\TmdbApiException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function render($request, Exception $exception)
    {
        // Manage The Movie Database errors
        if ($exception instanceof TmdbApiException) {
            $status = 500;

            switch ($exception->getCode()) {
                case TmdbApiException::STATUS_ENTRY_NOT_FOUND:
                case TmdbApiException::STATUS_RESOURCE_NOT_FOUND:
                    $status = 404;
                    break;
            }

            $errors = ['error' => $exception->getMessage()];

            if (($request->ajax() && ! $request->pjax()) || $request->wantsJson()) {
                return new JsonResponse($errors, $status);
            }

            $exception = new HttpException($status, $exception->getMessage(), $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
