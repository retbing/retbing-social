<?php

namespace App\Exceptions;

use Error;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;
use Throwable;

class Handler extends ExceptionHandler
{
    public const UNKNOWN_EXCEPTION = 'unknown-exception';
    public const USER_NOT_FOUND = 'user-not-found';
    public const EMAIL_EXISTS = 'email-exists';
    public const TOKEN_NOT_FOUND = 'token-not-found';
    public const INVALID_CREDENTIALS = 'invalid-credentials';
    public const QUERY_EXCEPTON = 'query-exception';
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
    public static function responseWithJson(Exception|Error $e, string $id = self::UNKNOWN_EXCEPTION, int $status = 500)
    {
        return response()->json([
            'error'=> [
                'id' => $id,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ],
          ], $status);
    }
}