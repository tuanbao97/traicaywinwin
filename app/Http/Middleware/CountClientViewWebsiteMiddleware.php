<?php

namespace App\Http\Middleware;

use App\Enum\AppConstant;
use App\Enum\SettingEnum;
use App\Repository\SettingRepository;
use App\Service\SettingService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CountClientViewWebsiteMiddleware
{
    // Inject beans
    private SettingService $settingService;
    private SettingRepository $settingRepository;
    
    public function __construct(SettingService $settingService, SettingRepository $settingRepository) {
        $this->settingService = $settingService;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Chỉ cho phép response đi qua, không xử lý gì ở đây
        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     * Method này chạy SAU KHI response đã trả về client, không ảnh hưởng performance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     */
    public function terminate(Request $request, Response $response): void
    {
        // Kiểm tra cookie skip: chỉ cần tồn tại key và có giá trị là đủ để bỏ qua
        $cookieValue = $request->cookie(AppConstant::COOKIE_SKIP_COUNT_VIEW_WEBSITE);
        $rawCookieHeader = $request->headers->get('cookie');
        if (!is_null($cookieValue) && $cookieValue !== '') {
            return;
        }
        // Fallback: kiểm tra trực tiếp trong header Cookie (bất kỳ giá trị nào)
        if (is_string($rawCookieHeader)) {
            $pattern = '/(?:^|;\s*)' . preg_quote(AppConstant::COOKIE_SKIP_COUNT_VIEW_WEBSITE, '/') . '=([^;]+)/';
            if (preg_match($pattern, $rawCookieHeader, $m)) {
                if (trim($m[1]) !== '') {
                    return;
                }
            }
        }
        
        Log::info('🚀 COUNT VIEW EXECUTION CONTINUES');
        // Phần View-Today (khởi tạo trước để lưu history)
        $today = Carbon::now()->format('Y_m_d');
        $keyToday = sprintf(SettingEnum::SETTING_COUNT_VIEW_DAY->value, $today);
        $settingViewToday = $this->settingService->getOrNewSetting($keyToday);
        $valueToday = $settingViewToday->VALUE;
        $valueToday = is_null($valueToday) ? 0 : (int) $valueToday;

        // Lấy IP (ưu tiên IP thật từ proxy/cloudflare)
        $ip = $request->ip();
        if ($request->header('CF-Connecting-IP')) {
            $ip = $request->header('CF-Connecting-IP'); // Cloudflare
        } elseif ($request->header('X-Forwarded-For')) {
            $ip = explode(',', $request->header('X-Forwarded-For'))[0]; // Proxy
        } elseif ($request->header('X-Real-IP')) {
            $ip = $request->header('X-Real-IP'); // Nginx
        }

        // Detect IP version
        $ipVersion = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? 'IPv4' : 
                    (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? 'IPv6' : 'Unknown');

        // Get Geolocation từ IP
        $geolocation = $this->getGeolocation($ip);

        // Detect bot/crawler từ User Agent
        $userAgent = $request->userAgent() ?? '';
        $isBot = preg_match('/bot|crawler|spider|facebook|facebot/i', $userAgent);
        $botType = 'Human';
        
        if ($isBot) {
            if (preg_match('/facebot|facebook/i', $userAgent)) {
                $botType = 'FacebookBot';
            } elseif (preg_match('/googlebot/i', $userAgent)) {
                $botType = 'GoogleBot';
            } else {
                $botType = 'OtherBot';
            }
        }

        // Detect Device Type (Mobile, Tablet, Desktop)
        $deviceType = 'Desktop';
        if (preg_match('/mobile|android|iphone|ipod|blackberry|windows phone/i', $userAgent)) {
            $deviceType = 'Mobile';
        } elseif (preg_match('/tablet|ipad|playbook|silk/i', $userAgent)) {
            $deviceType = 'Tablet';
        }

        // Detect Operating System
        $os = 'Unknown';
        if (preg_match('/windows nt 10/i', $userAgent)) {
            $os = 'Windows 10/11';
        } elseif (preg_match('/windows nt 6.3/i', $userAgent)) {
            $os = 'Windows 8.1';
        } elseif (preg_match('/windows nt 6.2/i', $userAgent)) {
            $os = 'Windows 8';
        } elseif (preg_match('/windows nt 6.1/i', $userAgent)) {
            $os = 'Windows 7';
        } elseif (preg_match('/windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/iphone/i', $userAgent)) {
            $os = 'iOS';
        } elseif (preg_match('/ipad/i', $userAgent)) {
            $os = 'iPadOS';
        } elseif (preg_match('/android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $os = 'Linux';
        }

        // Detect Browser
        $browser = 'Unknown';
        if (preg_match('/edg\//i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/chrome/i', $userAgent) && !preg_match('/edg|coc_coc/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/coc_coc/i', $userAgent)) {
            $browser = 'Cốc Cốc';
        } elseif (preg_match('/firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/opera|opr\//i', $userAgent)) {
            $browser = 'Opera';
        } elseif (preg_match('/msie|trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        }

        // Tạo entry mới cho request hiện tại
        $currentEntry = [
            'currentTime' => Carbon::now()->format('Y-m-d H:i:s'),
            'ip' => trim($ip),
            'ipVersion' => $ipVersion,
            'country' => $geolocation['country'],
            'countryCode' => $geolocation['countryCode'],
            'region' => $geolocation['region'],
            'regionName' => $geolocation['regionName'],
            'city' => $geolocation['city'],
            'timezone' => $geolocation['timezone'],
            'isp' => $geolocation['isp'],
            'deviceType' => $deviceType,
            'os' => $os,
            'browser' => $browser,
            'url' => $request->fullUrl(),
            'userAgent' => $userAgent,
            'botType' => $botType
        ];

        // Lấy lịch sử IP từ ATTR1 (tất cả request - dạng JSON array)
        $ipHistory = [];
        if (!empty($settingViewToday->ATTR1)) {
            $decoded = json_decode($settingViewToday->ATTR1, true);
            if (is_array($decoded)) {
                $ipHistory = $decoded;
            }
        }

        // Thêm entry mới vào mảng tất cả request
        $ipHistory[] = $currentEntry;

        // Lấy lịch sử IP từ ATTR2 (chỉ request từ Việt Nam - dạng JSON array)
        $ipHistoryVN = [];
        if (!empty($settingViewToday->ATTR2)) {
            $decoded = json_decode($settingViewToday->ATTR2, true);
            if (is_array($decoded)) {
                $ipHistoryVN = $decoded;
            }
        }

        // Nếu là Việt Nam (VN) VÀ Human (không phải bot), thêm vào ATTR2
        if ($geolocation['countryCode'] === 'VN' && $botType === 'Human') {
            $ipHistoryVN[] = $currentEntry;
        }

        // Log thông tin
        Log::info('Client Request Info', [
            'currentTime' => $currentEntry['currentTime'],
            'today' => $today,
            'keyToday' => $keyToday,
            'ip' => $currentEntry['ip'],
            'ipVersion' => $currentEntry['ipVersion'],
            'country' => $currentEntry['country'],
            'city' => $currentEntry['city'],
            'isp' => $currentEntry['isp'],
            'deviceType' => $currentEntry['deviceType'],
            'os' => $currentEntry['os'],
            'browser' => $currentEntry['browser'],
            'botType' => $currentEntry['botType'],
            'url' => $currentEntry['url'],
            'totalRequests' => count($ipHistory),
            'totalRequestsVN' => count($ipHistoryVN)
        ]);

        // Cập nhật lượt xem và lưu lịch sử IP
        // VALUE: Chỉ đếm lượt xem từ Việt Nam VÀ Human (không phải bot)
        if ($geolocation['countryCode'] === 'VN' && $botType === 'Human') {
            $settingViewToday->VALUE = ($valueToday + 1);
        } else {
            $settingViewToday->VALUE = $valueToday; // Giữ nguyên nếu không đủ điều kiện
        }
        
        $settingViewToday->NAME = sprintf(SettingEnum::SETTING_COUNT_VIEW_DAY->description(), $today);
        $settingViewToday->DESCRIPTION = sprintf(SettingEnum::SETTING_COUNT_VIEW_DAY->description(), $today);
        $settingViewToday->UNIT = SettingEnum::SETTING_COUNT_VIEW_DAY->unit();
        $settingViewToday->TYPE = SettingEnum::SETTING_COUNT_VIEW_DAY->type();
        
        // ATTR1: Tất cả request (global)
        $settingViewToday->ATTR1 = json_encode($ipHistory, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        // ATTR2: Chỉ request từ Việt Nam
        $settingViewToday->ATTR2 = json_encode($ipHistoryVN, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        $settingViewToday->save();

        // Cập nhật Total View (chỉ đếm Việt Nam VÀ Human)
        if ($geolocation['countryCode'] === 'VN' && $botType === 'Human') {
            $settingCountTotalView = $this->settingRepository->getSettingDetail(SettingEnum::SETTING_COUNT_TOTAL_VIEW->value);
            if (!is_null($settingCountTotalView)) {
                $value = $settingCountTotalView->VALUE;
                $value = is_null($value) ? 0 : (int) $value;

                // Thêm 1 lượt xem (chỉ từ VN và Human)
                $settingCountTotalView->VALUE = ($value + 1);
                $this->settingRepository->save($settingCountTotalView->toArray(), 'CODE');
            }
        }
    }

    /**
     * Lấy thông tin Geolocation từ IP address
     * Sử dụng API miễn phí: ip-api.com
     * Limit: 45 requests/minute
     * Timeout: 60s (1 phút) - Rất dài, đảm bảo lấy được data trong mọi trường hợp
     * An toàn vì chạy trong terminate() - background, không ảnh hưởng user
     */
    private function getGeolocation(string $ip): array
    {
        // Default values
        $defaultGeo = [
            'country' => 'Unknown',
            'countryCode' => 'XX',
            'region' => 'Unknown',
            'regionName' => 'Unknown',
            'city' => 'Unknown',
            'timezone' => 'UTC',
            'isp' => 'Unknown'
        ];

        // Bỏ qua localhost/private IP
        if (in_array($ip, ['127.0.0.1', '::1']) || 
            filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return array_merge($defaultGeo, [
                'country' => 'Local',
                'city' => 'Localhost',
                'isp' => 'Local Network'
            ]);
        }

        try {
            // API endpoint với các fields cần thiết
            $url = "http://ip-api.com/json/{$ip}?fields=status,message,country,countryCode,region,regionName,city,timezone,isp";
            
            // Tạo context với timeout rất dài (vì chạy background, không ảnh hưởng user)
            $context = stream_context_create([
                'http' => [
                    'timeout' => 60, // 60 seconds (1 phút) - đảm bảo lấy được data trong mọi trường hợp
                    'ignore_errors' => true,
                    'method' => 'GET',
                    'header' => 'User-Agent: Mozilla/5.0 (compatible; GeolocationBot/1.0)'
                ]
            ]);

            // Gọi API
            $response = @file_get_contents($url, false, $context);
            
            if ($response === false) {
                Log::warning('Geolocation API timeout', ['ip' => $ip]);
                return $defaultGeo;
            }

            $data = json_decode($response, true);

            // Kiểm tra response có hợp lệ không
            if (isset($data['status']) && $data['status'] === 'success') {
                return [
                    'country' => $data['country'] ?? 'Unknown',
                    'countryCode' => $data['countryCode'] ?? 'XX',
                    'region' => $data['region'] ?? 'Unknown',
                    'regionName' => $data['regionName'] ?? 'Unknown',
                    'city' => $data['city'] ?? 'Unknown',
                    'timezone' => $data['timezone'] ?? 'UTC',
                    'isp' => $data['isp'] ?? 'Unknown'
                ];
            } else {
                Log::warning('Geolocation API failed', [
                    'ip' => $ip,
                    'status' => $data['status'] ?? 'unknown',
                    'message' => $data['message'] ?? 'No message'
                ]);
                return $defaultGeo;
            }
        } catch (\Exception $e) {
            Log::error('Geolocation exception', [
                'ip' => $ip,
                'error' => $e->getMessage()
            ]);
            return $defaultGeo;
        }
    }

}

