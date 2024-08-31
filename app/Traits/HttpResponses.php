<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isInstanceOf;

trait HttpResponses
{
    protected function httpSuccess($data, $message = null, $code = 200)
    {
        if (is_countable($data) && $data instanceof JsonResource) {
            $meta = [
                'total' => $data->total(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ];
        } else {
            $meta = [];
        }
        return response()->json(
            [
                "status" => "Request success",
                "message" => $message,
                "data" => $data,
                "meta" => $meta
            ],
            $code
        );
    }
    protected function httpFaliure($data, $message = null, $code)
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
