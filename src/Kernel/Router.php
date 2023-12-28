<?php

declare(strict_types = 1);

namespace App\Kernel;

class Router 
{
    private static array $getRoutes;
    private static array $postRoutes;

    public static function get(string $url, array $callback)
    {
        self::$getRoutes[$url] = $callback;
    }

    public static function post(string $url, array $callback)
    {
        self::$postRoutes[$url] = $callback;
    }

    public static function register(string $fileName)
    {
        include_once(__DIR__.'/../Http/'.$fileName);
    }

    public function resolve(Request $request)
    {
        $callback = null;

        if (strtoupper($request->getMethod()) == 'GET') {
            $callback = self::$getRoutes[$request->getUrl()];
        }
        elseif (strtoupper($request->getMethod()) == 'POST') {
            $callback = self::$postRoutes[$request->getUrl()];
        }

        if (is_null($callback)) {
            Response::httpResponse(404, "Página no encontrada");
            die();
        }
        
        call_user_func($callback, $request);
    }
}