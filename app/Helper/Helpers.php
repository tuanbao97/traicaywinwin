<?php

use App\Enum\AppConstant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

    /* Evict forget tag keys data UI-FRONTEND */
    if (!function_exists('evictCacheDataFrontEnd')) {
        function evictCacheDataFrontEnd() {
            $cacheTagDataUI = Cache::get(AppConstant::CACHE_TAG_DATA_UI_FRONTEND, []);
            if (is_array($cacheTagDataUI)) {
                foreach ($cacheTagDataUI as $tagKey) {
                    Cache::forget($tagKey);
                }
            }
            DB::table('cache')->where('key', 'like', AppConstant::CACHE_PREFIX_DATA_UI_FRONTEND . '_%')->delete();
            Cache::forget(AppConstant::CACHE_TAG_DATA_UI_FRONTEND);
        }
    }

    /* Chuyển đổi string kiểu camelCase sang SNAKE_CASE_UPPER */
    if (!function_exists('camelToSnakeUpper')) {
        function camelToSnakeUpper($string)
        {
            // Chuyển từ camelCase sang snake_case
            $snake = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));

            // Chuyển snake_case thành in hoa
            return strtoupper($snake);
        }
    }

    /* Chuyển đổi String sang kiểu SLUG. VD: Xin chào tôi năm nay 96 tuổi => xin-chao-toi-nam-nay-96-tuoi */
    if (!function_exists('convertStrToSlug')) {
        function convertStrToSlug($string)
        {
            // Chuyển chuỗi sang mã UTF-8 để đảm bảo xử lý đúng các ký tự có dấu
            $string = mb_convert_encoding($string, 'UTF-8', 'auto');

            // Mảng các ký tự có dấu
            $vietnameseChars = array(
                'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
                'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
                'ì','í','ị','ỉ','ĩ',
                'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
                'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
                'ỳ','ý','ỵ','ỷ','ỹ',
                'đ', // Đây là ký tự "đ"
                'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă','Ằ','Ắ','Ặ','Ẳ','Ẵ',
                'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
                'Ì','Í','Ị','Ỉ','Ĩ',
                'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ','Ờ','Ớ','Ợ','Ở','Ỡ',
                'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
                'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
                'Đ' // Đây là ký tự "Đ"
            );

            // Mảng các ký tự không dấu tương ứng
            $nonVietnameseChars = array(
                'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
                'e','e','e','e','e','e','e','e','e','e','e',
                'i','i','i','i','i',
                'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
                'u','u','u','u','u','u','u','u','u','u','u',
                'y','y','y','y','y',
                'd', // Ký tự "đ" được thay thế bằng "d"
                'A','A','A','A','A','A','A','A','A','A','A','A','A','A','A','A','A',
                'E','E','E','E','E','E','E','E','E','E','E',
                'I','I','I','I','I',
                'O','O','O','O','O','O','O','O','O','O','O','O','O','O','O','O','O',
                'U','U','U','U','U','U','U','U','U','U','U',
                'Y','Y','Y','Y','Y',
                'D' // Ký tự "Đ" được thay thế bằng "D"
            );

            // Thay thế các ký tự có dấu thành không dấu
            $string = str_replace($vietnameseChars, $nonVietnameseChars, $string);

            // Loại bỏ các ký tự không phải chữ cái, số hoặc khoảng trắng
            $string = preg_replace('/[^A-Za-z0-9\s]/', '', $string);

            // Thay thế khoảng trắng bằng dấu gạch ngang (-)
            $string = preg_replace('/\s+/', '-', trim($string));

            // Chuyển về chữ thường một cách an toàn với ký tự đa byte
            return mb_strtolower($string, 'UTF-8');
        }
    }

    if (!function_exists('convertImagePathsToAbsolute')) {
        function convertMediaPathsToAbsolute(?string $html = null) {
            if (is_null($html)) return null;
            
            $doc = new \DOMDocument();
            libxml_use_internal_errors(true); // Bỏ qua warning HTML5

            $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

            // Xử lý thẻ <img>
            $images = $doc->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                if ($src && !preg_match('/^https?:\/\//', $src)) {
                    $img->setAttribute('src', asset($src));
                }
            }

            // Xử lý thẻ <video>
            $videos = $doc->getElementsByTagName('video');
            foreach ($videos as $video) {
                $src = $video->getAttribute('src');
                if ($src && !preg_match('/^https?:\/\//', $src)) {
                    $video->setAttribute('src', asset($src));
                }

                $poster = $video->getAttribute('poster');
                if ($poster && !preg_match('/^https?:\/\//', $poster)) {
                    $video->setAttribute('poster', asset($poster));
                    $newStyle = 'object-fit: cover; width: 100%; max-width: 650px; height: auto; display: block;margin: auto;';
                    $video->setAttribute('style', $newStyle);
                }
            }

            // Xử lý thẻ <source> (nằm trong video/audio)
            $sources = $doc->getElementsByTagName('source');
            foreach ($sources as $source) {
                $src = $source->getAttribute('src');
                if ($src && !preg_match('/^https?:\/\//', $src)) {
                    $source->setAttribute('src', asset($src));
                }
            }

            $body = $doc->getElementsByTagName('body')->item(0);
            if ($body) {
                $inner = '';
                foreach ($body->childNodes as $child) {
                    $inner .= $doc->saveHTML($child);
                }
                return $inner;
            }

            return $doc->saveHTML();
        }
    }

    if (!function_exists('normalizeStorefrontRichHtml')) {
        /**
         * Chuẩn hóa HTML dán từ Facebook/editor: emoji img → unicode, bỏ <br> thừa sau emoji.
         */
        function normalizeStorefrontRichHtml(?string $html = null): ?string
        {
            if ($html === null || $html === '') {
                return $html;
            }

            if (preg_match('/<body[^>]*>(.*)<\/body>/is', $html, $m)) {
                $html = $m[1];
            }

            $html = preg_replace_callback(
                '/<img\b([^>]*)>/iu',
                static function (array $m): string {
                    $tag = $m[0];
                    $attrs = $m[1];
                    $width = preg_match('/\bwidth\s*=\s*["\']?(\d+)/i', $attrs, $w) ? (int) $w[1] : 0;
                    $height = preg_match('/\bheight\s*=\s*["\']?(\d+)/i', $attrs, $h) ? (int) $h[1] : 0;
                    $isEmoji = (bool) preg_match('/emoji\.php|\/emoji\//i', $tag)
                        || ($width > 0 && $width <= 32)
                        || ($height > 0 && $height <= 32);

                    if (! $isEmoji) {
                        return $tag;
                    }

                    if (preg_match('/\balt\s*=\s*["\']([^"\']*)["\']/u', $attrs, $alt)) {
                        return html_entity_decode($alt[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    }

                    return '';
                },
                $html
            );

            // FB thường chèn <br><br> ngay sau emoji → tách câu / xuống dòng lệch
            $html = preg_replace(
                '/([\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}\x{FE0F}\x{200D}]+)(?:\s*<br\s*\/?\s*>)+/u',
                '$1',
                $html
            );

            $html = preg_replace('/<span[^>]*>\s*<\/span>/iu', '', $html);

            return $html;
        }
    }

    if (!function_exists('storefrontProductCategoryUrl')) {
        function storefrontProductCategoryUrl(int $categoryId, ?string $name = null): string
        {
            if ($categoryId <= 0) {
                return url('/search') . '?type=product';
            }

            if ($name === null || $name === '') {
                try {
                    $name = (string) DB::table('category_p')
                        ->where('ID', $categoryId)
                        ->where('STATUS', AppConstant::STATUS_USING)
                        ->value('NAME');
                } catch (\Throwable) {
                    $name = 'danh-muc';
                }
            }

            $slug = convertStrToSlug($name ?: 'danh-muc');

            return url('/search') . '?type=product&danh-muc=' . rawurlencode($slug . '-' . $categoryId);
        }
    }

    if (!function_exists('storefrontProductCategoryUrlMap')) {
        /**
         * @return array<string, string>
         */
        function storefrontProductCategoryUrlMap(): array
        {
            static $map = null;
            if (is_array($map)) {
                return $map;
            }

            $map = [];
            try {
                $rows = DB::table('category_p')
                    ->where('STATUS', AppConstant::STATUS_USING)
                    ->where('IS_ACTIVE', true)
                    ->get(['ID', 'NAME', 'ATTR1']);

                foreach ($rows as $row) {
                    $title = (string) $row->NAME;
                    $external = trim((string) ($row->ATTR1 ?? ''));
                    if ($external !== '' && str_starts_with($external, 'http')) {
                        $map[$title] = $external;
                        continue;
                    }

                    $map[$title] = storefrontProductCategoryUrl((int) $row->ID, $title);
                }
            } catch (\Throwable) {
                $map = [];
            }

            return $map;
        }
    }

    if (!function_exists('storefrontGioQuaPriceRanges')) {
        /**
         * Khoảng giá liên tục cho tab/menu Giỏ trái cây (hardcode UI).
         * Mỗi khoảng: >= min và < max (max = null → không giới hạn trên).
         *
         * @return array<int, array{label: string, min: int, max: int|null}>
         */
        function storefrontGioQuaPriceRanges(): array
        {
            return [
                ['label' => 'Giỏ trái cây nhập khẩu 350k', 'min' => 350000, 'max' => 500000],
                ['label' => 'Giỏ trái cây nhập khẩu 500k', 'min' => 500000, 'max' => 550000],
                ['label' => 'Giỏ trái cây nhập khẩu 550k-700k', 'min' => 550000, 'max' => 750000],
                ['label' => 'Giỏ trái cây nhập khẩu 750k-900k', 'min' => 750000, 'max' => 900000],
                ['label' => 'Giỏ trái cây nhập khẩu > 900k', 'min' => 900000, 'max' => null],
            ];
        }
    }

    if (!function_exists('storefrontGioQuaPriceSearchUrl')) {
        function storefrontGioQuaPriceSearchUrl(int $min, ?int $max = null): string
        {
            $url = storefrontProductCategoryUrl(1004, 'Giỏ quà trái cây');
            $url .= '&gia_tu=' . $min;
            if ($max !== null) {
                $url .= '&gia_den=' . $max;
            }

            return $url;
        }
    }

    if (!function_exists('storefrontGioQuaPriceUrlMap')) {
        /**
         * @return array<string, string>
         */
        function storefrontGioQuaPriceUrlMap(): array
        {
            $map = [];
            foreach (storefrontGioQuaPriceRanges() as $range) {
                $map[$range['label']] = storefrontGioQuaPriceSearchUrl(
                    (int) $range['min'],
                    $range['max'] !== null ? (int) $range['max'] : null
                );
            }

            return $map;
        }
    }

    /**
     * Chuẩn hóa UPD_DT → timestamp dùng cho ?upd_time= (cache bust ảnh).
     */
    if (!function_exists('storefrontImageUpdTime')) {
        function storefrontImageUpdTime(mixed $updDt): ?string
        {
            if ($updDt === null || $updDt === '') {
                return null;
            }

            if (is_numeric($updDt)) {
                return (string) (int) $updDt;
            }

            $raw = trim((string) $updDt);
            $ts = strtotime($raw);
            if ($ts !== false) {
                return (string) $ts;
            }

            $digits = preg_replace('/\D+/', '', $raw);

            return $digits !== '' ? $digits : null;
        }
    }

    /**
     * URL ảnh storefront + ?upd_time= từ UPD_DT (bust cache khi BE lưu).
     */
    if (!function_exists('storefrontImageUrl')) {
        function storefrontImageUrl(?string $path, mixed $updDt = null): string
        {
            if ($path === null || $path === '') {
                return '';
            }

            $path = str_replace('\\', '/', $path);
            if (preg_match('#^https?://#i', $path)) {
                $url = $path;
            } else {
                $url = asset(ltrim($path, '/'));
            }

            $bust = storefrontImageUpdTime($updDt);
            if ($bust === null) {
                return $url;
            }

            return $url . (str_contains($url, '?') ? '&' : '?') . 'upd_time=' . rawurlencode($bust);
        }
    }

    /**
     * Thông tin cửa hàng (SETTING_WEB) cho storefront — footer, liên hệ, v.v.
     *
     * @return array{
     *   storeName: string,
     *   email: string,
     *   taxCode: string,
     *   workingHours: string,
     *   description: string,
     *   address: string,
     *   mapUrl: string,
     *   zaloUrl: string,
     *   zaloPageUrl: string,
     *   messengerUrl: string,
     *   facebookUrl: string,
     *   websiteUrl: string,
     *   tiktokUrl: string,
     *   youtubeUrl: string,
     *   commitmentText: string,
     *   hotline: ?array{display: string, tel: string, raw: string, owner: string},
     *   hotlines: list<array{display: string, tel: string, raw: string, owner: string}>
     * }
     */
    if (!function_exists('wwWebContact')) {
        function wwWebContact(): array
        {
            static $cached = null;
            if ($cached !== null) {
                return $cached;
            }

            $rows = \App\Models\Setting::query()
                ->where('TYPE', 'SETTING_WEB')
                ->where('IS_ACTIVE', true)
                ->where('STATUS', \App\Enum\AppConstant::STATUS_USING)
                ->orderBy('ORDER')
                ->get(['CODE', 'NAME', 'VALUE', 'ORDER']);

            $val = static function (string $code) use ($rows): string {
                $item = $rows->first(static fn ($r) => strtoupper((string) $r->CODE) === strtoupper($code));
                return $item && $item->VALUE !== null ? trim((string) $item->VALUE) : '';
            };

            $formatPhone = static function (string $phone): string {
                $digits = preg_replace('/\D+/', '', $phone) ?? '';
                if (strlen($digits) <= 7) {
                    return $digits;
                }
                return substr($digits, 0, 4) . ' ' . substr($digits, 4, 3) . ' ' . substr($digits, 7);
            };

            $hotlines = $rows
                ->filter(static function ($r) {
                    return str_starts_with((string) $r->CODE, 'SETTING_HOTLINE')
                        && filled($r->VALUE);
                })
                ->sortBy(static fn ($r) => $r->ORDER === null ? 9999 : (int) $r->ORDER)
                ->values()
                ->map(static function ($r) use ($formatPhone) {
                    $parts = explode('|', (string) $r->VALUE);
                    if (count($parts) < 2) {
                        return null;
                    }
                    $raw = preg_replace('/\D+/', '', $parts[1]) ?? '';
                    if ($raw === '') {
                        return null;
                    }
                    return [
                        'display' => $formatPhone($raw),
                        'tel' => 'tel:' . $raw,
                        'raw' => $raw,
                        'owner' => $parts[2] ?? '',
                        'type' => $parts[0] ?? '',
                    ];
                })
                ->filter()
                ->values()
                ->all();

            $cached = [
                'storeName' => $val('SETTING_TEN_CUA_HANG') ?: 'Win Win Trái Cây Nhập Khẩu',
                'email' => $val('SETTING_EMAIL'),
                'taxCode' => $val('SETTING_MA_SO_THUE'),
                'workingHours' => $val('SETTING_THOI_GIAN_LAM_VIEC'),
                'description' => $val('SETTING_MO_TA_CUA_HANG'),
                'address' => $val('SETTING_DIA_CHI_CUA_HANG'),
                'mapUrl' => $val('SETTING_DUONG_DAN_GG_MAP_CUA_HANG'),
                'zaloUrl' => $val('SETTING_DUONG_DAN_SO_ZALO_CUA_HANG'),
                'zaloPageUrl' => $val('SETTING_DUONG_DAN_PAGE_ZALO_CUA_HANG'),
                'messengerUrl' => $val('SETTING_DUONG_DAN_FACEBOOK_MESSENGER_CUA_HANG'),
                'facebookUrl' => $val('SETTING_DUONG_DAN_PAGE_FACEBOOK_CUA_HANG'),
                'websiteUrl' => $val('SETTING_DUONG_DAN_TRANG_WEBSITE_CUA_HANG'),
                'tiktokUrl' => $val('SETTING_DUONG_DAN_TIKTOK_CUA_HANG'),
                'youtubeUrl' => $val('SETTING_DUONG_DAN_YOUTUBE_CUA_HANG'),
                'commitmentText' => $val('SETTING_CAM_KET_BAN_HANG_ONLY_TEXT'),
                'hotline' => $hotlines[0] ?? null,
                'hotlines' => $hotlines,
            ];

            return $cached;
        }
    }

?>
