<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRoute
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('local')){
            $log = [
              'URI' => $request->getUri(),
              'METHOD' => $request->getMethod(),
              'REQUEST_BODY' => $request->getContent()
            ];

            Log::info(json_encode($log));
            /*
            Log::emergency($message);
            Log::alert($message);
            Log::critical($message);
            Log::error($message);
            Log::warning($message);
            Log::notice($message);
            Log::info($message);
            Log::debug($message);
             */
        }

        return $response;
    }
}
