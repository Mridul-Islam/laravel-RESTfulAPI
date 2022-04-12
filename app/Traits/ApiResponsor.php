<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponsor {

    // function for receive and return data
    private function successResponse($data, $code){
        return response()->json($data, $code);
    }

    // function for return the error message
    protected function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    // Show all collection
    protected function showAll(Collection $collection, $code = 200){
        return $this->successResponse(['data' => $collection], $code);
    }

    // Show a specific data
    protected function showOne(Model $model, $code = 200){
        return $this->successResponse(['data' => $model], $code);
    }

    protected function showMessage($message, $code = 200){
        return $this->successResponse(['data' => $message], $code);
    }



}// End of trait
