<?php

namespace App\Traits;

trait HttpResponses
{
    protected function httpSuccess($data, $message = null, $code = 200)
    {
        return response()->json(
            [
                "status" => "Request success",
                "message" => $message,
                "data" => $data
            ],
            $code
        );
    }
    protected function httpFaliure($data, $message = null, $code )
    {
        return response()->json(
            [
                "status" => "Request faliure",
                "message" => $message,
                // "data" => $data
            ],
            $code
        );
    }
}
