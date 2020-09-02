<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\ExceptionTrait;
use Symfony\Component\HttpFoundation\Response;
class Handler extends ExceptionHandler
{
    use ExceptionTrait;
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // return parent::render($request, $exception);
        if ($request->expectsJson()){
           return response([
            'error' => true,
            'message' => 'Something went Wrong',
            'data' => $this->apiException($request,$exception),
            
        ], Response::HTTP_OK);
    }     
    // if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
    //     return response()->json(['User have not permission for this page access.']);
    // }
 
    // return parent::render($request, $exception);
    } 

        
}
