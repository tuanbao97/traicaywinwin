<?php

namespace App\Http\Controllers;

use App\Enum\AppConstant;
use App\Service\CategoryNService;
use App\Service\NewsService;
use App\Service\ProductService;
use App\Service\VideoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ThemeStorefrontController extends Controller
{
    private const SESSION_KEY = 'theme_storefront_cart';

    public function __construct(
        private ProductService $productService,
        private NewsService $newsService,
        private CategoryNService $categoryNService,
        private VideoService $videoService,
    ) {}

    /**
     * Biến thể flash sale trên trang chủ (UI-FRONTEND/index) — dùng khi thêm giỏ không gửi kèm metadata.
     *
     * @var array<int, array{title: string, handle: string, price: int, image: string}>
     */
    private const VARIANT_CATALOG = [
        127890663 => [
            'title' => 'Bỉm Goldgi Eco Dán L56',
            'handle' => 'bim-goldgi-eco-dan-l56-9-14kg',
            'price' => 440000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890654 => [
            'title' => 'Bỉm Goldgi+ X5 (Tã dán)',
            'handle' => 'bim-goldgi-x5-dan',
            'price' => 590000,
            'image' => 'thumb/large/100/531/894/products/d-l-56-845x1024-c24ae3e9aa1945b68465f24bd5cc4c66.png?v=1730192671777',
        ],
        127890639 => [
            'title' => 'Sữa Meiji nội địa Nhật Bản số 9, 800g (1 - 3 tuổi)',
            'handle' => 'sua-meiji-noi-dia-so-9-1-3-tuoi',
            'price' => 790000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890638 => [
            'title' => 'Sữa Meiji nội địa Nhật Bản số 0, 800g (0 -  1 tuổi)',
            'handle' => 'sua-meiji-noi-dia-nhat-ban-so-0-800g-0-1-tuoi',
            'price' => 990000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890635 => [
            'title' => 'Sữa Meiji nội địa Nhật Bản dạng thanh số 0, (0 - 1 tuổi)',
            'handle' => 'sua-meiji-noi-dia-nhat-ban-dang-thanh-so-0-0-1-tuoi',
            'price' => 48000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890630 => [
            'title' => 'Sữa Meiji Kids Formula 900g (3 - 10 tuổi)',
            'handle' => 'sua-meiji-kids-formula-900g-3-10-tuoi',
            'price' => 1090000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890622 => [
            'title' => 'Sữa Meiji nhập khẩu số 9 lon 800g (1-3 tuổi)',
            'handle' => 'sua-meiji-nhap-khau-so-1-800g-1-3-tuoi',
            'price' => 950000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
        127890619 => [
            'title' => 'Sữa Nan Nga số 1 Optipro (0-6 tháng)',
            'handle' => 'sua-nan-nga-so-1-optipro-0-6-thang',
            'price' => 980000,
            'image' => 'thumb/large/100/531/894/products/26c387112ec8b14e5ae1b6b5d59a7a54-e11c3e563b564df49e695288e26740f4.jpg?v=1730192671777',
        ],
    ];

    public function cartAdd(Request $request): \Illuminate\Http\JsonResponse
    {
        $variantId = (int) ($request->input('variantId')
            ?? $request->input('VariantId')
            ?? $request->input('id'));
        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($variantId <= 0) {
            return response()->json(['message' => 'Thiếu mã biến thể'], 422);
        }

        $meta = self::VARIANT_CATALOG[$variantId] ?? null;
        $title = $request->input('product_title', $meta['title'] ?? 'Sản phẩm');
        $handle = $request->input('product_handle', $meta['handle'] ?? '');
        $price = (int) $request->input('price', $meta['price'] ?? 0);
        $imageRel = $request->input('image', $meta['image'] ?? '');
        $categoryId = (int) ($request->input('category_id')
            ?? $request->input('product_category_id')
            ?? 0);
        if ($categoryId <= 0) {
            $categoryId = $this->resolveProductCategoryId($variantId);
        }

        $items = array_values($this->getCartLines());
        $existingIndex = null;
        foreach ($items as $k => $line) {
            if ((int) $line['variant_id'] === $variantId) {
                $existingIndex = $k;
                break;
            }
        }

        if ($existingIndex !== null) {
            $existing = $items[$existingIndex];
            unset($items[$existingIndex]);
            $items = array_values($items);

            $existing['quantity'] = (int) ($existing['quantity'] ?? 0) + $quantity;
            $existing['line_price'] = $existing['quantity'] * (int) ($existing['price'] ?? 0);
            if ($categoryId > 0) {
                $existing['category_id'] = $categoryId;
            }
            $items[] = $existing;
        } else {
            $items[] = [
                'variant_id' => $variantId,
                'title' => $title,
                'variant_title' => $request->input('variant_title', 'Mặc định'),
                'quantity' => $quantity,
                'price' => $price,
                'line_price' => $price * $quantity,
                'image' => $imageRel,
                'handle' => $handle,
                'category_id' => $categoryId,
            ];
        }

        session([self::SESSION_KEY => array_values($items)]);

        $detailHandle = trim((string) $handle);
        if ($detailHandle === '') {
            $detailHandle = 'sp-'.$variantId;
        } elseif (! preg_match('/-\d+$/', $detailHandle)) {
            $detailHandle .= '-'.$variantId;
        }
        $url = url('san-pham/chi-tiet/'.ltrim($detailHandle, '/'));

        $line = collect($items)->firstWhere('variant_id', $variantId);

        return response()->json([
            'variant_id' => $variantId,
            'title' => is_array($line) ? ($line['title'] ?? $title) : $title,
            'variant_title' => is_array($line) ? ($line['variant_title'] ?? 'Mặc định') : 'Mặc định',
            'url' => $url,
            'item_count' => $this->totalQuantity($items),
        ]);
    }

    public function cartChange(Request $request): Response
    {
        $line = max(1, (int) $request->query('line', 0));
        $quantity = (int) $request->query('quantity', 0);
        $items = array_values($this->getCartLines());

        $index = $line - 1;
        if (! isset($items[$index])) {
            return response('', 404);
        }

        if ($quantity <= 0) {
            array_splice($items, $index, 1);
        } else {
            $items[$index]['quantity'] = $quantity;
            $items[$index]['line_price'] = $quantity * (int) $items[$index]['price'];
        }

        session([self::SESSION_KEY => $items]);

        return response('', 200);
    }

    public function cartUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true]);
    }

    public function cartClear(): \Illuminate\Http\JsonResponse
    {
        session()->forget(self::SESSION_KEY);

        return response()->json(['success' => true]);
    }

    public function cartPage(Request $request): BinaryFileResponse|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
    {
        if ($request->query('view') === 'data') {
            $items = $this->getCartLines();

            return response()->view('theme.cart-data', [
                'items' => $items,
                'totalQuantity' => $this->totalQuantity($items),
                'totalPrice' => $this->totalPrice($items),
                'appUrl' => rtrim(url('/'), '/'),
            ]);
        }

        return view('UI-FRONTEND.cart.index', [
            'productId' => 0,
        ]);
    }

    public function checkoutPage(): View
    {
        $items = $this->getCartLines();

        return view('UI-FRONTEND.thanh-toan.index', [
            'productId' => 0,
            'items' => $items,
            'totalQuantity' => $this->totalQuantity($items),
            'totalPrice' => $this->totalPrice($items),
            'appUrl' => rtrim(url('/'), '/'),
        ]);
    }

    public function cartRecommendations(Request $request): \Illuminate\Http\JsonResponse
    {
        $items = array_values($this->getCartLines());
        if ($items === []) {
            return response()->json([
                'success' => true,
                'products' => [],
            ]);
        }

        $cartProductIds = [];
        $categoryIds = [];
        $itemsChanged = false;

        foreach ($items as $index => $line) {
            $productId = (int) ($line['variant_id'] ?? 0);
            if ($productId > 0) {
                $cartProductIds[] = $productId;
            }

            $categoryId = (int) ($line['category_id'] ?? 0);
            if ($categoryId <= 0 && $productId > 0) {
                $categoryId = $this->resolveProductCategoryId($productId);
                if ($categoryId > 0) {
                    $items[$index]['category_id'] = $categoryId;
                    $itemsChanged = true;
                }
            }

            if ($categoryId > 0) {
                $categoryIds[] = $categoryId;
            }
        }

        if ($itemsChanged) {
            session([self::SESSION_KEY => $items]);
        }

        $categoryIds = array_values(array_unique($categoryIds));
        $cartProductIds = array_values(array_unique($cartProductIds));
        if ($categoryIds === []) {
            return response()->json([
                'success' => true,
                'products' => [],
            ]);
        }

        $limit = max(1, min(12, (int) $request->query('limit', 8)));
        $listRequest = Request::create('/', 'GET', [
            'PAGE' => 1,
            'PER_PAGE' => $limit,
            'BO_LOC' => 'moi-den-cu',
            'TRANG_THAI_HOAT_DONG' => true,
            'IS_API_PUBLIC' => true,
            'DANH_MUC_SAN_PHAM_ID' => $categoryIds,
            'NOT_IN_ID' => $cartProductIds,
        ]);

        $response = $this->productService->getListSanPham($listRequest);
        $body = json_decode($response->getContent(), true);
        $products = $body['DATAS']['PRODUCT']['DATA'] ?? [];

        if ($cartProductIds !== []) {
            $products = array_values(array_filter($products, static function (array $product) use ($cartProductIds): bool {
                return ! in_array((int) ($product['ID'] ?? 0), $cartProductIds, true);
            }));
        }

        return response()->json([
            'success' => true,
            'products' => array_slice($products, 0, $limit),
            'category_ids' => $categoryIds,
            'excluded_ids' => $cartProductIds,
        ]);
    }

    public function search(Request $request): View|Response
    {
        $query = trim((string) ($request->query('query', $request->query('q', ''))));
        $categoryId = $this->parseProductCategoryId($request);
        $page = max(1, (int) $request->query('PAGE', 1));
        $view = (string) $request->query('view', '');
        $perPage = $view === 'quick-search' ? 8 : 20;

        $boLoc = (string) $request->query('bo_loc', 'default');
        if (! in_array($boLoc, AppConstant::DANH_SACH_BO_LOC_TIM_KIEM, true)) {
            $boLoc = 'default';
        }

        $priceFilterOptions = $this->productPriceFilterOptions();
        $selectedPriceFilterIds = $this->parseSelectedPriceFilterIds($request);
        $mucGia = $this->buildMucGiaFromFilterIds($selectedPriceFilterIds, $priceFilterOptions);

        $giaTu = $request->query('gia_tu');
        $giaDen = $request->query('gia_den');
        $giaTuVal = is_numeric($giaTu) ? (int) $giaTu : null;
        $giaDenVal = is_numeric($giaDen) ? (int) $giaDen : null;
        if ($giaTuVal !== null || $giaDenVal !== null) {
            $range = [];
            if ($giaTuVal !== null && $giaTuVal >= 0) {
                $range['MIN_VALUE'] = $giaTuVal;
            }
            if ($giaDenVal !== null && $giaDenVal > 0) {
                $range['MAX_VALUE'] = $giaDenVal;
            }
            if ($range !== []) {
                $mucGia[] = $range;
            }
        }

        $productHot = filter_var($request->query('PRODUCT_HOT', false), FILTER_VALIDATE_BOOLEAN);
        $productVip = filter_var($request->query('PRODUCT_VIP', false), FILTER_VALIDATE_BOOLEAN);

        $result = $this->searchProducts(
            $query,
            $categoryId > 0 ? [$categoryId] : [],
            $page,
            $perPage,
            $boLoc,
            $mucGia,
            false,
            $productHot,
            $productVip
        );
        $appUrl = rtrim(url('/'), '/');
        $categoryName = $categoryId > 0 ? $this->resolveCategoryName($categoryId) : '';
        $categoryKey = $categoryId > 0 ? $this->buildProductCategoryKey($categoryId) : '';
        if ($productVip && $categoryName === '' && $query === '') {
            $categoryName = 'Chớp thời cơ. Giá như mơ!';
        } elseif ($productHot && $categoryName === '' && $query === '') {
            $categoryName = 'Sản phẩm nổi bật';
        }

        if ($view === 'quick-search') {
            return response()->view('UI-FRONTEND.tim-kiem.partials.quick-search-results', [
                'query' => $query,
                'products' => $result['products'],
                'total' => $result['total'],
                'appUrl' => $appUrl,
                'categoryId' => $categoryId,
                'categoryKey' => $categoryKey,
            ]);
        }

        return view('UI-FRONTEND.tim-kiem.ket-qua', [
            'query' => $query,
            'categoryId' => $categoryId,
            'categoryKey' => $categoryKey,
            'categoryName' => $categoryName,
            'boLoc' => $boLoc,
            'priceFilterOptions' => $priceFilterOptions,
            'selectedPriceFilterIds' => $selectedPriceFilterIds,
            'giaTu' => $giaTuVal,
            'giaDen' => $giaDenVal,
            'page' => $page,
            'products' => $result['products'],
            'total' => $result['total'],
            'perPage' => $perPage,
            'totalPages' => $result['totalPages'],
            'appUrl' => $appUrl,
            'productId' => 0,
            'listAll' => false,
            'productHot' => $productHot,
            'productVip' => $productVip,
            'pageBasePath' => '/search',
        ]);
    }

    public function allProducts(Request $request): View
    {
        $page = max(1, (int) $request->query('PAGE', 1));
        $perPage = 20;

        $boLoc = (string) $request->query('bo_loc', 'default');
        if (! in_array($boLoc, AppConstant::DANH_SACH_BO_LOC_TIM_KIEM, true)) {
            $boLoc = 'default';
        }

        $priceFilterOptions = $this->productPriceFilterOptions();
        $selectedPriceFilterIds = $this->parseSelectedPriceFilterIds($request);
        $mucGia = $this->buildMucGiaFromFilterIds($selectedPriceFilterIds, $priceFilterOptions);

        $giaTu = $request->query('gia_tu');
        $giaDen = $request->query('gia_den');
        $giaTuVal = is_numeric($giaTu) ? (int) $giaTu : null;
        $giaDenVal = is_numeric($giaDen) ? (int) $giaDen : null;
        if ($giaTuVal !== null || $giaDenVal !== null) {
            $range = [];
            if ($giaTuVal !== null && $giaTuVal >= 0) {
                $range['MIN_VALUE'] = $giaTuVal;
            }
            if ($giaDenVal !== null && $giaDenVal > 0) {
                $range['MAX_VALUE'] = $giaDenVal;
            }
            if ($range !== []) {
                $mucGia[] = $range;
            }
        }

        $result = $this->searchProducts(
            '',
            [],
            $page,
            $perPage,
            $boLoc,
            $mucGia,
            true
        );

        return view('UI-FRONTEND.san-pham.tat-ca', [
            'query' => '',
            'categoryId' => 0,
            'categoryKey' => '',
            'categoryName' => 'Tất cả sản phẩm',
            'boLoc' => $boLoc,
            'priceFilterOptions' => $priceFilterOptions,
            'selectedPriceFilterIds' => $selectedPriceFilterIds,
            'giaTu' => $giaTuVal,
            'giaDen' => $giaDenVal,
            'page' => $page,
            'products' => $result['products'],
            'total' => $result['total'],
            'perPage' => $perPage,
            'totalPages' => $result['totalPages'],
            'appUrl' => rtrim(url('/'), '/'),
            'productId' => 0,
            'listAll' => true,
            'pageBasePath' => '/tat-ca-san-pham',
        ]);
    }

    /**
     * @param  array<int, int>  $categoryIds
     * @param  array<int, array{MIN_VALUE?: int|float|null, MAX_VALUE?: int|float|null}>  $mucGia
     * @return array{products: array<int, array<string, mixed>>, total: int, totalPages: int}
     */
    private function searchProducts(
        string $query,
        array $categoryIds,
        int $page,
        int $perPage,
        string $boLoc = 'default',
        array $mucGia = [],
        bool $listAll = false,
        bool $productHot = false,
        bool $productVip = false
    ): array {
        // Cho phép xem danh sách theo danh mục / tất cả / flash sale mà không cần từ khóa
        if ($query === '' && $categoryIds === [] && ! $listAll && ! $productHot && ! $productVip) {
            return ['products' => [], 'total' => 0, 'totalPages' => 0];
        }

        $params = [
            'PAGE' => $page,
            'PER_PAGE' => $perPage,
            'BO_LOC' => $boLoc,
            'TRANG_THAI_HOAT_DONG' => true,
            'IS_API_PUBLIC' => true,
        ];
        if ($query !== '') {
            $params['TU_KHOA'] = $query;
        }
        if ($categoryIds !== []) {
            $params['DANH_MUC_SAN_PHAM_ID'] = $categoryIds;
        }
        if ($mucGia !== []) {
            $params['MUC_GIA'] = $mucGia;
        }
        if ($productHot) {
            $params['PRODUCT_HOT'] = true;
        }
        if ($productVip) {
            $params['PRODUCT_VIP'] = true;
        }

        $listRequest = Request::create('/', 'GET', $params);
        $response = $this->productService->getListSanPham($listRequest);
        $body = json_decode($response->getContent(), true);
        $pagination = $body['DATAS']['PRODUCT'] ?? [];

        return [
            'products' => $pagination['DATA'] ?? [],
            'total' => (int) ($pagination['TOTAL_ITEM'] ?? 0),
            'totalPages' => (int) ($pagination['TOTAL_PAGE'] ?? 0),
        ];
    }

    private function resolveCategoryName(int $categoryId): string
    {
        try {
            $category = \App\Models\CategoryP::query()
                ->where('ID', $categoryId)
                ->where('STATUS', 'USING')
                ->first();

            return (string) ($category->NAME ?? '');
        } catch (Throwable) {
            return '';
        }
    }

    public function productDetail(Request $request, string $productKey): View|Response
    {
        $parts = explode('-', $productKey);
        $productId = (int) end($parts);

        if ($productId <= 0) {
            abort(404);
        }

        $slug = count($parts) > 1
            ? implode('-', array_slice($parts, 0, -1))
            : $productKey;

        if ($request->query('view') === 'quickview') {
            return $this->productQuickViewFragment($productId, $slug);
        }

        return view('UI-FRONTEND.san-pham.chi-tiet', [
            'productId' => $productId,
            'productSlug' => $slug,
            'productKey' => $productKey,
        ]);
    }

    public function newsList(Request $request): View
    {
        $categoryId = $this->parseCategoryIdFromKey($request->query('danh-muc'));
        $page = max(1, (int) $request->query('PAGE', 1));
        $perPage = 12;

        $result = $this->fetchNewsList($page, $perPage, $categoryId);
        $hotNews = $this->fetchNewsList(1, 5, null, true);

        return view('UI-FRONTEND.tin-tuc.index', [
            'productId' => 0,
            'newsList' => $result['items'],
            'total' => $result['total'],
            'totalPages' => $result['totalPages'],
            'page' => $page,
            'perPage' => $perPage,
            'categoryId' => $categoryId,
            'hotNews' => $hotNews['items'],
            'categories' => $this->fetchNewsCategoryTree(),
            'appUrl' => rtrim(url('/'), '/'),
        ]);
    }

    public function videoList(Request $request): View
    {
        $page = max(1, (int) $request->query('PAGE', 1));
        $perPage = 12;
        $result = $this->fetchVideoList($page, $perPage);

        return view('UI-FRONTEND.video.index', [
            'productId' => 0,
            'videoList' => $result['items'],
            'total' => $result['total'],
            'totalPages' => $result['totalPages'],
            'page' => $page,
            'perPage' => $perPage,
            'appUrl' => rtrim(url('/'), '/'),
        ]);
    }

    public function newsDetail(Request $request, string $newsKey): View
    {
        $parts = explode('-', $newsKey);
        $newsId = (int) end($parts);

        if ($newsId <= 0) {
            abort(404);
        }

        try {
            $response = $this->newsService->getDetailTinTuc($newsId, Request::create('/', 'GET'));
            $body = json_decode($response->getContent(), true);
            $news = $body['DATAS']['NEWS'] ?? null;
        } catch (Throwable) {
            abort(404);
        }

        if (! is_array($news) || empty($news['ID'])) {
            abort(404);
        }

        $categoryId = (int) ($news['DANH_MUC_TIN_TUC']['ID'] ?? 0);
        $relatedNews = [];

        if ($categoryId > 0) {
            $relatedResult = $this->fetchNewsList(1, 7, $categoryId, null, [$newsId]);
            $relatedNews = array_values(array_filter(
                $relatedResult['items'],
                static fn (array $item): bool => (int) ($item['ID'] ?? 0) !== $newsId
            ));
            $relatedNews = array_slice($relatedNews, 0, 6);
        }

        return view('UI-FRONTEND.tin-tuc.chi-tiet', [
            'productId' => 0,
            'news' => $news,
            'newsId' => $newsId,
            'relatedNews' => $relatedNews,
            'categories' => $this->fetchNewsCategoryTree(),
            'hotNews' => $this->fetchNewsList(1, 5, null, true)['items'],
            'appUrl' => rtrim(url('/'), '/'),
        ]);
    }

    private function productQuickViewFragment(int $productId, string $slug): Response
    {
        try {
            $response = $this->productService->getDetailSanPham($productId, Request::create('/', 'GET'));
            $body = json_decode($response->getContent(), true);
            $product = $body['DATAS']['PRODUCT'] ?? null;
        } catch (Throwable) {
            abort(404);
        }

        if (!$product || !is_array($product)) {
            abort(404);
        }

        return response()
            ->view('UI-FRONTEND.san-pham.partials.quick-view-fragment', [
                'product' => $product,
                'productId' => $productId,
                'productSlug' => $slug,
            ])
            ->header('Content-Type', 'text/html; charset=UTF-8');
    }

    public function productOrQuickview(Request $request, string $themeProductSlug): View|Response
    {
        $file = public_path('UI-FRONTEND/'.$themeProductSlug.'.html');

        if (File::exists($file)) {
            if ($request->query('view') === 'quickview') {
                return response(File::get($file), 200)->header('Content-Type', 'text/html; charset=UTF-8');
            }

            return response()->file($file);
        }

        if (preg_match('/-(\d+)$/', $themeProductSlug, $matches)) {
            $productId = (int) $matches[1];
            if ($productId > 0) {
                return $this->productDetail($request, $themeProductSlug);
            }
        }

        abort(404);
    }

    private function parseCategoryIdFromKey(mixed $key): ?int
    {
        if (! is_string($key) || $key === '') {
            return null;
        }

        if (! preg_match('/-(\d+)$/', $key, $matches)) {
            return null;
        }

        $id = (int) $matches[1];

        return $id > 0 ? $id : null;
    }

    private function parseProductCategoryId(Request $request): int
    {
        $danhMuc = $request->query('danh-muc');
        if (is_string($danhMuc) && $danhMuc !== '') {
            return (int) ($this->parseCategoryIdFromKey($danhMuc) ?? 0);
        }

        return (int) $request->query('category_id', 0);
    }

    /**
     * @return array<int, array{id: string, label: string, min: int|null, max: int|null}>
     */
    private function productPriceFilterOptions(): array
    {
        return [
            ['id' => 'duoi-300k', 'label' => 'Dưới 300.000đ', 'min' => 0, 'max' => 300000],
            ['id' => '300-500k', 'label' => '300.000 - 500.000đ', 'min' => 300000, 'max' => 500000],
            ['id' => '500-800k', 'label' => '500.000 - 800.000đ', 'min' => 500000, 'max' => 800000],
            ['id' => '800-1tr', 'label' => '800.000 - 1.000.000đ', 'min' => 800000, 'max' => 1000000],
            ['id' => 'tren-1tr', 'label' => 'Trên 1.000.000đ', 'min' => 1000000, 'max' => null],
        ];
    }

    /**
     * @return array<int, string>
     */
    private function parseSelectedPriceFilterIds(Request $request): array
    {
        $gia = $request->query('gia', '');
        if (! is_string($gia) || $gia === '') {
            return [];
        }

        $validIds = array_column($this->productPriceFilterOptions(), 'id');

        return array_values(array_filter(
            array_map('trim', explode(',', $gia)),
            static fn (string $id): bool => $id !== '' && in_array($id, $validIds, true)
        ));
    }

    /**
     * @param  array<int, string>  $selectedIds
     * @param  array<int, array{id: string, label: string, min: int|null, max: int|null}>  $options
     * @return array<int, array{MIN_VALUE?: int, MAX_VALUE?: int}>
     */
    private function buildMucGiaFromFilterIds(array $selectedIds, array $options): array
    {
        if ($selectedIds === []) {
            return [];
        }

        $optionMap = [];
        foreach ($options as $option) {
            $optionMap[$option['id']] = $option;
        }

        $mucGia = [];
        foreach ($selectedIds as $id) {
            $option = $optionMap[$id] ?? null;
            if (! $option) {
                continue;
            }

            $range = [];
            if ($option['min'] !== null) {
                $range['MIN_VALUE'] = (int) $option['min'];
            }
            if ($option['max'] !== null) {
                $range['MAX_VALUE'] = (int) $option['max'];
            }
            if ($range !== []) {
                $mucGia[] = $range;
            }
        }

        return $mucGia;
    }

    private function buildProductCategoryKey(int $categoryId): string
    {
        if ($categoryId <= 0) {
            return '';
        }

        try {
            $category = \App\Models\CategoryP::query()
                ->where('ID', $categoryId)
                ->where('STATUS', 'USING')
                ->first();

            if (! $category) {
                return 'danh-muc-' . $categoryId;
            }

            return convertStrToSlug((string) $category->NAME) . '-' . $categoryId;
        } catch (Throwable) {
            return 'danh-muc-' . $categoryId;
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function fetchNewsCategoryTree(): array
    {
        try {
            $response = $this->categoryNService->getListDanhMucTinTucTree(Request::create('/', 'GET', [
                'IS_GET_ALL_ELEMENTS' => true,
                'IS_API_PUBLIC' => true,
            ]));
            $body = json_decode($response->getContent(), true);

            return $body['DATAS']['CATEGORY_N']['DATA'] ?? [];
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * @param  array<int, int>|null  $notInIds
     * @return array{items: array<int, array<string, mixed>>, total: int, totalPages: int}
     */
    private function fetchNewsList(
        int $page,
        int $perPage,
        ?int $categoryId = null,
        ?bool $hotOnly = null,
        ?array $notInIds = null,
    ): array {
        $params = [
            'PAGE' => $page,
            'PER_PAGE' => $perPage,
            'BO_LOC' => 'moi-den-cu',
            'TRANG_THAI_HOAT_DONG' => true,
            'IS_API_PUBLIC' => true,
        ];

        if ($categoryId !== null && $categoryId > 0) {
            $params['DANH_MUC_TIN_TUC_ID'] = [$categoryId];
        }

        if ($hotOnly === true) {
            $params['LOAI_TIN_TUC'] = true;
        }

        if ($notInIds !== null && $notInIds !== []) {
            $params['NOT_IN_ID'] = $notInIds;
        }

        try {
            $response = $this->newsService->getListTinTuc(Request::create('/', 'GET', $params));
            $body = json_decode($response->getContent(), true);
            $pagination = $body['DATAS']['NEWS'] ?? [];
        } catch (Throwable) {
            return ['items' => [], 'total' => 0, 'totalPages' => 0];
        }

        return [
            'items' => $pagination['DATA'] ?? [],
            'total' => (int) ($pagination['TOTAL_ITEM'] ?? 0),
            'totalPages' => (int) ($pagination['TOTAL_PAGE'] ?? 0),
        ];
    }

    /**
     * @return array{items: array<int, array<string, mixed>>, total: int, totalPages: int}
     */
    private function fetchVideoList(int $page, int $perPage): array
    {
        $params = [
            'PAGE' => $page,
            'PER_PAGE' => $perPage,
            'BO_LOC' => 'moi-den-cu',
            'TRANG_THAI_HOAT_DONG' => true,
            'IS_API_PUBLIC' => true,
        ];

        try {
            $response = $this->videoService->getListVideo(Request::create('/', 'GET', $params));
            $body = json_decode($response->getContent(), true);
            $pagination = $body['DATAS']['VIDEO'] ?? [];
        } catch (Throwable) {
            return ['items' => [], 'total' => 0, 'totalPages' => 0];
        }

        return [
            'items' => $pagination['DATA'] ?? [],
            'total' => (int) ($pagination['TOTAL_ITEM'] ?? 0),
            'totalPages' => (int) ($pagination['TOTAL_PAGE'] ?? 0),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getCartLines(): array
    {
        return session(self::SESSION_KEY, []) ?: [];
    }

    private function resolveProductCategoryId(int $productId): int
    {
        if ($productId <= 0) {
            return 0;
        }

        try {
            $response = $this->productService->getDetailSanPham($productId, Request::create('/', 'GET'));
            $body = json_decode($response->getContent(), true);
            $category = $body['DATAS']['PRODUCT']['DANH_MUC_SAN_PHAM'] ?? null;
            return (int) ($category['ID'] ?? 0);
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function totalQuantity(array $items): int
    {
        $n = 0;
        foreach ($items as $line) {
            $n += (int) ($line['quantity'] ?? 0);
        }

        return $n;
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function totalPrice(array $items): int
    {
        $n = 0;
        foreach ($items as $line) {
            $n += (int) ($line['line_price'] ?? 0);
        }

        return $n;
    }
}
