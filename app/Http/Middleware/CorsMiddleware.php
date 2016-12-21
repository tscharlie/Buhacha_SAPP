<?php

namespace App\Http\Middleware;

class CorsMiddleware {

    public function handle($request, \Closure $next) {
        $response = $next($request);
        $response->header('Access-Control-Allow-Methods', 'OPTIONS, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Origin', isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*');

        if ($request->isMethod('OPTIONS')) {
            return response('{"method":"OPTIONS"}', 200);
        }
        
        return $response;
    }

}
