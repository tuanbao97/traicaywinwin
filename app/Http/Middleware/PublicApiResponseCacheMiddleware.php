<?php

namespace App\Http\Middleware;

use App\Enum\AppConstant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicApiResponseCacheMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();
        $routePrefix = $route ? $route->getPrefix() : null;

        // Chỉ cache GET và prefix phải là api/public
        if ($request->method() !== 'GET' || $routePrefix !== AppConstant::PREFIX_API['API_PUBLIC']) {
            return $next($request);
        }

        // Lấy query string, loại bỏ tham số '_'
        $query = $request->query();
        unset($query['_']);
        ksort($query); // Sắp xếp lại query param theo key
        $rawKey = $request->path() . '?' . http_build_query($query);
        $cacheKey = AppConstant::CACHE_PREFIX_DATA_UI_FRONTEND . md5($rawKey);

        // Nếu đã có cache trả về luôn
        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        // Thực thi request thật
        $response = $next($request);

        // Nếu response thành công (2xx)
        if ($response->isSuccessful()) {
            // Lấy nội dung response (string JSON)
            $data = $response->getContent();

            // Lưu cache 24 tiếng (dưới dạng mảng)
            Cache::put($cacheKey, json_decode($data, true), now()->addHours(24));

            // Luôn lưu tag key là AppConstant::CACHE_TAG_DATA_UI_FRONTEND
            $tagKeyList = Cache::get(AppConstant::CACHE_TAG_DATA_UI_FRONTEND, []);
            if (!in_array($cacheKey, $tagKeyList)) {
                $tagKeyList[] = $cacheKey;
                Cache::put(AppConstant::CACHE_TAG_DATA_UI_FRONTEND, $tagKeyList, now()->addHours(24));
            }
        }

        return $response;
    }


}
