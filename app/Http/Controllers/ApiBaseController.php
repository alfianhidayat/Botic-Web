<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    function baseResponse($isError, $message, $data)
    {
        return [
            "error" => $isError,
            "message" => $message,
            "data" => $data
        ];
    }
}
