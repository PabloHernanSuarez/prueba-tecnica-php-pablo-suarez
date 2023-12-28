<?php

declare(strict_types=1);

namespace App\Kernel;

class Response
{
    public static function httpResponse(int $code, string $message)
    {
        http_response_code($code);
        echo $message;
    }
}