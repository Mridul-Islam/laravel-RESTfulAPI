<?php

namespace App\Exceptions;

use App\Traits\ApiResponsor;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ApiResponsor;

    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // my own methods
    public function render($request, Throwable $e)
    {
        if($e instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($e, $request);
        }
        if($e instanceof ModelNotFoundException){
            $modelName = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("Nothing is found for the {$modelName} model", 404);
        }
        if($e instanceof AuthenticationException){
            return $this->unauthenticated($request, $e);
        }
        if($e instanceof AuthorizationException){
            return $this->errorResponse($e->getMessage(), 403);
        }
        if($e instanceof NotFoundHttpException){
            return $this->errorResponse('The specified URL is not found', 404);
        }
        if($e instanceof MethodNotAllowedHttpException){
            return $this->errorResponse('The specified method is invalid for a request.', 405);
        }
        if($e instanceof HttpException){
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }
        if(config('app.debug')){
            return parent::render($request, $e);
        }
        return $this->errorResponse('unexpected exception, Try again.', 500);
    }

    //Method to return json result for validation error
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors, 422);
    }

    //Method to return json result for unauthenticated error
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('unauthenticated', 401);
    }


}//End of class
