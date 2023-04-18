<?php

namespace App\Traits;

trait HttpResponses {
   protected function success($data, $message, $code=200)
    {
        return response()->json([
            "status" => 'Request was successful',
            "data" => $data,
            "message" => $message
        ], $code);
    }

    protected function error($data, $message=null, $code)
    {
        return response()->json([
            "status" => 'There was an error processing your request',
            "data" => $data,
            "message" => $message
        ], $code);
    }
}
