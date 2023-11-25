<?php

namespace App\Exceptions;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedByPathException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Traits\ApiResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

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
            return false;
        });

    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            return $this->sendError($e->getMessage(), 401);
        }

        return parent::render($request, $e);
    }
}