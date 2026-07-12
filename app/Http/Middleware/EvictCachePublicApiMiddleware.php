<?php

namespace App\Http\Middleware;

use App\Enum\AppConstant;
use Closure;
use Illuminate\Http\Request;

class EvictCachePublicApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Api Get thì cho chạy tiếp, k xử lý
        if ($request->method() === 'GET') {
            return $next($request);
        }

        // Thực thi request thật
        $response = $next($request);

        // Evict forget cache
        evictCacheDataFrontEnd();

        return $response;
    }

}
