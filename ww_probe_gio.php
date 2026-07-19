<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$cats = DB::table('category_p')
    ->where(function ($q) {
        $q->where('ID', 1004)
            ->orWhere('PARENT_ID', 1004)
            ->orWhere('NAME', 'like', '%Giỏ%')
            ->orWhere('NAME', 'like', '%giỏ%')
            ->orWhere('NAME', 'like', '%gio%');
    })
    ->select('ID', 'NAME', 'PARENT_ID', 'STATUS')
    ->get();

echo "CATS=\n" . json_encode($cats, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";

$ids = $cats->pluck('ID')->all();
if ($ids === []) {
    exit(0);
}

$counts = DB::table('product_category as pc')
    ->join('product as p', 'p.ID', '=', 'pc.PRODUCT_ID')
    ->whereIn('pc.CATEGORY_ID', $ids)
    ->selectRaw('pc.CATEGORY_ID, pc.STATUS as PCS, p.STATUS as PS, count(*) as c')
    ->groupBy('pc.CATEGORY_ID', 'pc.STATUS', 'p.STATUS')
    ->get();
echo "COUNTS=\n" . json_encode($counts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";

$products = DB::table('product as p')
    ->join('product_category as pc', 'p.ID', '=', 'pc.PRODUCT_ID')
    ->whereIn('pc.CATEGORY_ID', $ids)
    ->where('pc.STATUS', 'USING')
    ->whereIn('p.STATUS', ['USING', 'SOLD'])
    ->select('p.ID', 'p.NAME', 'pc.CATEGORY_ID')
    ->distinct()
    ->orderBy('p.ID')
    ->get();

echo 'PRODUCT_COUNT=' . $products->count() . "\n";
echo "PRODUCTS=\n" . json_encode($products->take(40), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
