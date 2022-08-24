<?php
defined('BASEPATH') or exit('No direct script access allowed');


if (!function_exists('response_custom')) {
    function response_custom($success = false, $message = "", $data = "")
    {
        $response = array(
            "success"        => $success,
            "message"       => $message,
            "data"            => $data
        );

        return $response;
    }
}

if (!function_exists('response_not_found')) {
    function response_not_found()
    {
        return response_custom(false, "Data not found");
    }
}

if (!function_exists('response_error')) {
    function response_error($message = "", $data = "")
    {
        return response_custom(false, $message, $data);
    }
}

if (!function_exists('response_success')) {
    function response_success($message = "", $data = "")
    {
        return response_custom(true, $message, $data);
    }
}
