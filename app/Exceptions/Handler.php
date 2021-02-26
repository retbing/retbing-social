<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
     * Resolves the given error and responses with json
     *
     * @return ResponseFactory::json
     */
    public static function responseWithJson($e, $message = null, $code = null, $status = 500)
    {
        return response()->json([
            'error' => $message  ? $message : $e->getMessage() ,
            'code' => $code ? $code :  $e->getCode()
          ], $status);
    }
}