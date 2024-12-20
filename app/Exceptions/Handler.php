<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        };

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'page note found',
            ], Response::HTTP_NOT_FOUND);
        };

        // if ($e instanceof InternalErrorException) {
        //     return response()->json([
        //         'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
        //         'error' => 'loi 500',
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // };

        return parent::render($request, $e);
    }
}
