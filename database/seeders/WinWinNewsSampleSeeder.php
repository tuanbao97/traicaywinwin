<?php

namespace Database\Seeders;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class WinWinNewsSampleSeeder extends Seeder
{
    private string $uploadDir;

    private int $nextDocId = 1;

    private int $nextNewsId = 1;

    public function run(): void
    {
        $this->uploadDir = 'upload/UI-BACKEND/' . date('Y-m-d');
        $publicDir = public_path($this->uploadDir);
        if (! is_dir($publicDir)) {
            mkdir($publicDir, 0755, true);
        }

        $this->nextDocId = (int) DB::table('document_storage')->max('ID') + 1;
        $this->nextNewsId = 1;

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if (Schema::hasTable('news_document_storage')) {
            DB::table('news_document_storage')->truncate();
        }
        if (Schema::hasTable('news_category')) {
            DB::table('news_category')->truncate();
        }
        if (Schema::hasTable('news')) {
            DB::table('news')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $articles = $this->articles();
        $now = now();
        $adminId = AuthConstant::USER_SUPER_ADMIN_ID;
        $adminName = AuthConstant::USER_SUPER_ADMIN_FULL_NAME;

        foreach ($articles as $index => $article) {
            $imageMeta = $this->storeImage($article['image'], $article['image_label']);
            $docId = $imageMeta['id'];
            $imageExt = $imageMeta['extension'];

            $newsId = $this->nextNewsId++;
            DB::table('news')->insert([
                'ID' => $newsId,
                'TITLE' => $article['title'],
                'SUMMARY' => Str::limit($article['summary'], 500, ''),
                'CONTENT_FORMAT' => $article['html'],
                'CONTENT_RAW' => $article['text'],
                'META_SEO_KEYWORDS' => $article['keywords'],
                'META_SEO_DESCRIPTION' => Str::limit($article['summary'], 1000, ''),
                'APPROVED_DATE' => $now,
                'PUBLISHED_DATE' => $now->copy()->subDays(15 - $index),
                'IS_HOT_NEWS' => $article['hot'] ?? false,
                'COUNT_VIEWS' => random_int(50, 800),
                'IS_APPROVED' => true,
                'USER_POST_NEWS_ID' => $adminId,
                'USER_APPROVED_POST_NEWS_ID' => $adminId,
                'CRT_DT' => $now,
                'UPD_DT' => $now,
                'CRT_ID' => $adminId,
                'UPD_ID' => $adminId,
                'CRT_NAME' => $adminName,
                'UPD_NAME' => $adminName,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
                'ATTR49' => AppConstant::TYPE_NEWS_COMMON,
            ]);

            DB::table('news_category')->insert([
                'NEWS_ID' => $newsId,
                'CATEGORY_ID' => $article['category_id'],
                'SORT_ORDER' => 0,
                'CRT_DT' => $now,
                'UPD_DT' => $now,
                'CRT_ID' => $adminId,
                'UPD_ID' => $adminId,
                'CRT_NAME' => $adminName,
                'UPD_NAME' => $adminName,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
            ]);

            DB::table('news_document_storage')->insert([
                'NEWS_ID' => $newsId,
                'DOCUMENT_STORAGE_ID' => $docId,
                'SORT_ORDER' => 0,
                'IS_THUMNAIL' => true,
                'TYPE' => 'image',
                'EXTENSION' => $imageExt,
                'CRT_DT' => $now,
                'UPD_DT' => $now,
                'CRT_ID' => $adminId,
                'UPD_ID' => $adminId,
                'CRT_NAME' => $adminName,
                'UPD_NAME' => $adminName,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
                'ATTR1' => 'DANH_SACH_HINH_ANH_DAI_DIEN',
                'ATTR2' => '1x1',
            ]);
        }

        $this->command?->info('Đã seed ' . count($articles) . ' bài tin tức Win Win kèm hình ảnh.');
    }

    private function storeImage(string $source, string $label): array
    {
        $publicDir = public_path($this->uploadDir);
        $extension = 'jpg';
        if (! str_starts_with($source, 'http')) {
            $extension = strtolower(pathinfo($source, PATHINFO_EXTENSION)) ?: 'jpg';
        }
        $hashName = Str::lower(Str::random(40)) . '.' . $extension;
        $target = $publicDir . DIRECTORY_SEPARATOR . $hashName;

        if (str_starts_with($source, 'http')) {
            $response = Http::timeout(90)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; WinWinSeeder/1.0)'])
                ->get($source);
            if (! $response->successful()) {
                throw new \RuntimeException('Không tải được ảnh: ' . $label . ' (HTTP ' . $response->status() . ')');
            }
            file_put_contents($target, $response->body());
        } else {
            if (! copy($source, $target)) {
                throw new \RuntimeException('Không copy được ảnh: ' . $label);
            }
        }

        copy($target, $publicDir . DIRECTORY_SEPARATOR . '1x1_' . $hashName);

        $relativePath = $this->uploadDir . '/' . $hashName;
        $id = $this->nextDocId++;
        $now = now();
        $adminId = AuthConstant::USER_SUPER_ADMIN_ID;
        $adminName = AuthConstant::USER_SUPER_ADMIN_FULL_NAME;

        DB::table('document_storage')->insert([
            'ID' => $id,
            'NAME' => $hashName,
            'ORIGINAL_NAME' => Str::slug($label) . '.jpg',
            'EXTENSION' => $extension,
            'PATH' => $relativePath,
            'DIRECTORY' => $this->uploadDir,
            'SIZE' => filesize($target) ?: 0,
            'MD5' => md5_file($target),
            'TYPE_FILE' => 'image',
            'DESCRIPTION' => $label,
            'CRT_DT' => $now,
            'UPD_DT' => $now,
            'CRT_ID' => $adminId,
            'UPD_ID' => $adminId,
            'CRT_NAME' => $adminName,
            'UPD_NAME' => $adminName,
            'STATUS' => AppConstant::STATUS_USING,
            'IS_ACTIVE' => true,
        ]);

        return ['id' => $id, 'extension' => $extension];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function seedImage(string $filename): string
    {
        $path = database_path('seeders/assets/news-images/' . $filename);
        if (! is_file($path)) {
            throw new \RuntimeException('Thiếu ảnh seed: ' . $filename);
        }

        return $path;
    }

    private function articles(): array
    {
        $storeImg = public_path('UI-FRONTEND/images/win-win-cua-hang.png');

        return array_merge(
            $this->categoryArticles(1, [
                ['Cách chọn cherry Mỹ nhập khẩu ngọt, căng vỏ', $this->seedImage('01-cherry.jpg'), 'cherry-my'],
                ['Bảo quản nho xanh trong tủ lạnh 7–10 ngày', $this->seedImage('02-grapes.jpg'), 'nho-xanh'],
                ['Phân biệt táo Fuji và Envy nhập khẩu chuẩn', $this->seedImage('03-apple.jpg'), 'tao-fuji-envy'],
                ['Kiwi xanh New Zealand: chọn quả chín vừa ăn', $this->seedImage('04-kiwi.jpg'), 'kiwi-xanh'],
                ['Dâu tây nhập khẩu — rửa và bảo quản đúng cách', $this->seedImage('05-strawberry.jpg'), 'dau-tay'],
            ], 'mẹo chọn và bảo quản trái cây nhập khẩu'),
            $this->categoryArticles(2, [
                ['Giỏ trái cây biếu Tết cho gia đình và người thân', $this->seedImage('06-fruits.jpg'), 'gio-qua-tet'],
                ['Combo quà trái cây nhập khẩu tặng đối tác doanh nghiệp', $this->seedImage('07-basket.jpg'), 'qua-doi-tac'],
                ['Giỏ quà trái cây tặng thầy cô dịp 20/11', $this->seedImage('08-basket2.jpg'), 'qua-thay-co'],
                ['Quà tặng trái cây khai trương — lời chúc tươi mới', $this->seedImage('09-orange.jpg'), 'qua-khai-truong'],
                ['Set giỏ quà trái cây cao cấp: cherry, nho, berry', $this->seedImage('10-berries.jpg'), 'gio-qua-cao-cap'],
            ], 'quà tặng và giỏ quà trái cây'),
            $this->categoryArticles(3, [
                ['Win Win — cửa hàng trái cây nhập khẩu tại Hòa Tiến', $storeImg, 'win-win-cua-hang'],
                ['Nguồn trái cây nhập khẩu chính ngạch tại Win Win', $this->seedImage('11-market.jpg'), 'nguon-trai-cay'],
                ['Giao trái cây nội thành Đà Nẵng — giờ nhận đơn', $this->seedImage('12-delivery.jpg'), 'giao-hang'],
                ['Cam kết đổi trả khi trái không đạt chất lượng', $this->seedImage('13-shop.jpg'), 'chat-luong'],
                ['Đặt giỏ quà theo yêu cầu — hotline Win Win', $this->seedImage('14-market2.jpg'), 'dat-gio-qua'],
            ], 'tin cửa hàng Win Win'),
        );
    }

    /**
     * @param  array<int, array{0: string, 1: string, 2: string}>  $items
     * @return array<int, array<string, mixed>>
     */
    private function categoryArticles(int $categoryId, array $items, string $topic): array
    {
        $out = [];
        foreach ($items as $i => [$title, $image, $slug]) {
            $body = $this->bodyFor($slug, $title);
            $out[] = [
                'category_id' => $categoryId,
                'title' => $title,
                'summary' => $body['summary'],
                'html' => $body['html'],
                'text' => $body['text'],
                'keywords' => $body['keywords'],
                'image' => $image,
                'image_label' => $slug,
                'hot' => $i < 2,
            ];
        }

        return $out;
    }

    /**
     * @return array{summary: string, html: string, text: string, keywords: string}
     */
    private function bodyFor(string $slug, string $title): array
    {
        $blocks = [
            'cherry-my' => [
                'summary' => 'Cherry Mỹ nhập khẩu nên chọn quả căng, cuống xanh, vỏ bóng và không có vết nứt. Bảo quản lạnh 0–4°C giúp giữ độ giòn 5–7 ngày.',
                'html' => '<p>Cherry Mỹ (đặc biệt các vùng Washington, California) được ưa chuộng nhờ vị ngọt cân bằng, thịt giòn. Khi mua tại cửa hàng hoặc siêu thị, hãy ưu tiên quả <strong>căng tròn, vỏ bóng, không nhăn</strong> và cuống còn xanh tươi.</p><p>Tránh chọn quả có vết nứt, mốc hoặc mùi lên men. Sau khi mua, để cherry trong túi thoáng hoặc hộp nhựa có lỗ thoát khí, bảo quản ngăn mát tủ lạnh <strong>0–4°C</strong>. Rửa cherry ngay trước khi ăn để hạn chế thấm nước làm mềm vỏ.</p><p>Tại Win Win, cherry được nhập theo mùa vụ và bảo quản chuỗi lạnh ngắn, giúp quả giữ độ tươi khi đến tay khách hàng.</p>',
                'keywords' => 'cherry Mỹ, chọn cherry, trái cây nhập khẩu, Win Win',
            ],
            'nho-xanh' => [
                'summary' => 'Nho xanh không hạt nên chọn chùm dày, quả căng, không rụng. Bảo quản tủ lạnh 2–4°C, không rửa trước khi cất giữ được 7–10 ngày.',
                'html' => '<p>Nho xanh không hạt (thường từ Chile, Úc, Mỹ) có vị ngọt thanh, vỏ giòn. Quả ngon có <strong>chùm dày, trái căng tròn</strong>, màu xanh vàng đồng đều, không có quả rụng rời trong hộp.</p><p>Khi bảo quản, để nguyên chùm trong túi có lỗ thoát khí, đặt ngăn mát <strong>2–4°C</strong>. Không rửa nho trước khi bảo quản vì độ ẩm dễ làm mốc. Chỉ rửa nhẹ dưới vòi nước lạnh trước khi ăn.</p><p>Nếu thấy quả mềm hoặc có mùi chua lên men, nên loại bỏ ngay để không ảnh hưởng cả chùm.</p>',
                'keywords' => 'nho xanh, bảo quản nho, trái cây nhập khẩu',
            ],
            'tao-fuji-envy' => [
                'summary' => 'Táo Fuji có vị ngọt đậm, giòn; táo Envy vỏ đỏ đậm, thịt chắc. Chọn quả nặng tay, vỏ căng, không lõm hoặc đốm thâm.',
                'html' => '<p><strong>Táo Fuji</strong> Nhật/Mỹ nổi bật với vị ngọt đậm, hương thơm dịu và độ giòn cao. <strong>Táo Envy</strong> (New Zealand/Mỹ) có vỏ đỏ sẫm, thịt trắng ngà, ít tanh khi cắt lâu nhờ hàm lượng polyphenol cao.</p><p>Dấu hiệu táo nhập khẩu chất lượng: quả <strong>nặng tay so với kích thước</strong>, vỏ căng mịn, không lõm, không vết bầm. Tránh táo có vết thâm lan rộng hoặc mùi rượu.</p><p>Bảo quản ở ngăn mát tủ lạnh, có thể bọc giấy hoặc túi thoáng. Táo Fuji và Envy đều phù hợp ăn trực tiếp hoặc làm salad trái cây.</p>',
                'keywords' => 'táo Fuji, táo Envy, chọn táo nhập khẩu',
            ],
            'kiwi-xanh' => [
                'summary' => 'Kiwi xanh chín khi ấn nhẹ hơi mềm, không quá nhũn. Ủ với táo/chuối 1–2 ngày nếu cần chín nhanh; bảo quản lạnh sau khi chín.',
                'html' => '<p>Kiwi xanh (hay vàng) nhập từ New Zealand, Ý thường được thu hoạch khi còn cứng để vận chuyển an toàn. Quả <strong>chín vừa ăn</strong> khi ấn nhẹ hơi lõm, không quá mềm hoặc nhũn.</p><p>Nếu mua kiwi còn cứng, có thể ủ cùng táo hoặc chuối trong túi giấy 1–2 ngày ở nhiệt độ phòng để tăng tốc chín. Sau khi chín, chuyển vào ngăn mát tủ lạnh và dùng trong 5–7 ngày.</p><p>Cắt đôi và dùng thìa múc là cách phổ biến; vỏ kiwi xanh ăn được nếu rửa sạch lông bên ngoài.</p>',
                'keywords' => 'kiwi xanh, chọn kiwi, bảo quản kiwi',
            ],
            'dau-tay' => [
                'summary' => 'Dâu tây nhập khẩu nên chọn quả đỏ đều, lá xanh, không dập. Rửa nhẹ, để ráo và dùng trong 2–3 ngày; bảo quản lạnh sau khi rửa.',
                'html' => '<p>Dâu tây nhập khẩu (Mỹ, Hàn, Nhật) thường có kích thước đồng đều, màu đỏ tươi và hương thơm rõ. Chọn quả <strong>lá xanh tươi, không héo</strong>, thân quả chắc, không dập hoặc có vết mốc trắng.</p><p>Không ngâm dâu lâu trong nước; rửa nhẹ dưới vòi, để ráo trên giấy thấm. Bảo quản ngăn mát, dùng trong <strong>2–3 ngày</strong> để giữ độ giòn và vị ngọt.</p><p>Dâu tây phù hợp ăn trực tiếp, làm sinh tố hoặc trang trí bánh — nên chuẩn bị ngay trước khi phục vụ.</p>',
                'keywords' => 'dâu tây, bảo quản dâu, trái cây nhập khẩu',
            ],
            'gio-qua-tet' => [
                'summary' => 'Giỏ trái cây Tết nên cân bằng màu sắc: cam, táo đỏ, nho, cherry. Đóng gói chắc, thêm lá trang trí và thiệp chúc mang ý nghĩa sung túc.',
                'html' => '<p>Giỏ quà Tết trái cây nhập khẩu là món biếu phổ biến thể hiện lời chúc <strong>đủ đầy, sung túc</strong>. Nên kết hợp trái có màu đỏ, vàng, xanh: táo, cam, cherry, nho, kiwi.</p><p>Ưu tiên trái tươi, căng vỏ, đóng gói riêng từng loại trong túi thoáng trước khi xếp giỏ. Thêm lá cọ hoặc ruy băng đỏ tạo điểm nhấn. Nên đặt trước 3–5 ngày để shop chuẩn bị và giao đúng dịp.</p><p>Win Win nhận đóng giỏ quà theo ngân sách, có hóa đơn và giao tận nơi tại Đà Nẵng.</p>',
                'keywords' => 'giỏ quà Tết, quà trái cây, Win Win',
            ],
            'qua-doi-tac' => [
                'summary' => 'Quà trái cây doanh nghiệp nên gọn gàng, đồng bộ thương hiệu. Combo 3–5 loại trái nhập khẩu cao cấp phù hợp tặng đối tác, ký kết hợp đồng.',
                'html' => '<p>Combo quà trái cây cho đối tác cần thể hiện sự trang trọng nhưng gọn nhẹ. Thường chọn <strong>hộp cứng, giỏ có nắp</strong>, kèm thiệp in logo doanh nghiệp.</p><p>Gợi ý nội dung: cherry, nho xanh, táo Envy, kiwi vàng — các loại dễ bảo quản 3–5 ngày trong điều kiện văn phòng có điều hòa. Tránh trái mềm dễ dập nếu giao xa.</p><p>Win Win hỗ trợ in thiệp, giao hàng loạt theo danh sách và xuất hóa đơn VAT cho doanh nghiệp.</p>',
                'keywords' => 'quà doanh nghiệp, giỏ trái cây, quà đối tác',
            ],
            'qua-thay-co' => [
                'summary' => 'Giỏ quà 20/11 nên tươi, thanh nhã: táo, lê, nho, cam. Mức giá 300.000–800.000đ phù hợp tặng thầy cô, kèm thiệp tri ân.',
                'html' => '<p>Quà tặng ngày Nhà giáo Việt Nam (20/11) nên mang ý nghĩa tri ân, không cần quá cầu kỳ. <strong>Giỏ trái cây tươi</strong> với táo, lê, nho, cam hoặc dưa lưới là lựa chọn an toàn, phù hợp mọi lứa tuổi.</p><p>Nên đặt trước để chọn trái đẹp, đóng gói gọn. Kèm thiệp viết tay lời cảm ơn sẽ tạo ấn tượng tốt hơn quà giá trị cao nhưng thiếu ý nghĩa.</p><p>Win Win có sẵn mẫu giỏ quà 20/11 và nhận thiết kế theo yêu cầu trường/lớp.</p>',
                'keywords' => 'quà 20/11, giỏ quà thầy cô, trái cây quà tặng',
            ],
            'qua-khai-truong' => [
                'summary' => 'Quà khai trương trái cây tượng trưng thịnh vượng: cam, táo đỏ, lê vàng. Giỏ to, màu sắc rực rỡ, kèm băng chúc mừng khai trương.',
                'html' => '<p>Trái cây khai trương thường chọn loại có màu <strong>đỏ, vàng, cam</strong> — tượng trưng may mắn, phát đạt. Cam sành, táo đỏ, lê vàng, nho đỏ là các lựa chọn phổ biến.</p><p>Giỏ quà khai trương thường lớn hơn giỏ biếu thông thường, có băng rôn “Chúc mừng khai trương”. Nên giao sáng sớm ngày khai trương để trưng tại quầy lễ.</p><p>Liên hệ Win Win để đặt giỏ theo mức ngân sách và thời gian giao cố định.</p>',
                'keywords' => 'quà khai trương, giỏ trái cây, Win Win',
            ],
            'gio-qua-cao-cap' => [
                'summary' => 'Giỏ quà cao cấp kết hợp cherry, berry, nho đen, táo Envy trong hộp lạnh hoặc giỏ có nắp. Phù hợp biếu sếp, khách VIP.',
                'html' => '<p>Set giỏ quà cao cấp tập trung vào <strong>trái nhập khẩu thượng hạng</strong>: cherry Mỹ, việt quất, mâm xôi, nho đen không hạt, táo Envy hoặc Rockit.</p><p>Đóng gói thường dùng hộp carton cứng, lót lạnh hoặc túi giữ nhiệt nếu giao xa. Mỗi loại trái bọc riêng, xếp layer để tránh dập.</p><p>Win Win tư vấn combo theo mùa vụ và ngân sách từ 500.000đ đến vài triệu đồng, có giao nội thành Đà Nẵng.</p>',
                'keywords' => 'giỏ quà cao cấp, cherry, quà VIP',
            ],
            'win-win-cua-hang' => [
                'summary' => 'Win Win Trái Cây Nhập Khẩu & Quà tặng tại Đường DT605, xã Hòa Tiến, Đà Nẵng. Trái tươi chọn lọc, giỏ quà và giao hàng nhanh.',
                'html' => '<p><strong>Win Win Trái Cây Nhập Khẩu &amp; Quà tặng</strong> là điểm đến tin cậy tại Đà Nẵng, chuyên trái cây nhập khẩu chọn lọc, giỏ quà và quà biếu.</p><p><strong>Địa chỉ:</strong> Đường DT605, xã Hòa Tiến, Đà Nẵng (đối diện Trường Tiểu học số 2 Hòa Tiến).</p><p><strong>Hotline:</strong> 0905 454 775 · 0905 09 09 10<br><strong>Email:</strong> winwintraicaynhapkhau@gmail.com</p><p>Chúng tôi cam kết nguồn hàng rõ ràng, bảo quản chuẩn lạnh và tư vấn tận tình cho từng nhu cầu mua lẻ hoặc đặt giỏ quà.</p>',
                'keywords' => 'Win Win, cửa hàng trái cây, Hòa Tiến Đà Nẵng',
            ],
            'nguon-trai-cay' => [
                'summary' => 'Win Win nhập trái cây chính ngạch có chứng từ, kiểm dịch đầy đủ. Chuỗi lạnh ngắn giúp trái giữ độ tươi từ kho đến quầy.',
                'html' => '<p>Trái cây nhập khẩu tại Win Win đều có <strong>giấy tờ nguồn gốc, kiểm dịch thực vật</strong> theo quy định. Hàng về kho được kiểm tra độ tươi, loại trái dập hoặc quá chín trước khi lên kệ.</p><p>Chúng tôi ưu tiên nhà cung cấp uy tín từ Mỹ, Úc, New Zealand, Chile, Hàn Quốc, Nhật Bản tùy mùa vụ. Mỗi lô hàng ghi nhận ngày nhập để quản lý hạn sử dụng và luân chuyển FIFO.</p><p>Khách hàng có thể yêu cầu xem thông tin lô hàng khi mua số lượng lớn hoặc đặt giỏ quà doanh nghiệp.</p>',
                'keywords' => 'trái cây chính ngạch, nguồn hàng Win Win, nhập khẩu',
            ],
            'giao-hang' => [
                'summary' => 'Win Win giao trái cây và giỏ quà nội thành Đà Nẵng. Đặt trước qua hotline; giờ giao linh hoạt sáng–chiều các ngày trong tuần.',
                'html' => '<p>Win Win hỗ trợ <strong>giao hàng nội thành Đà Nẵng</strong> cho đơn trái cây lẻ và giỏ quà. Khách đặt qua hotline <strong>0905 454 775</strong> hoặc <strong>0905 09 09 10</strong>, cung cấp địa chỉ và khung giờ nhận.</p><p>Giỏ quà được đóng chắc, cố định trái bằng lưới hoặc giấy lót để hạn chế dập trong vận chuyển. Đơn gấp nên đặt trước ít nhất 2–3 giờ; giỏ quà lớn nên đặt trước 1 ngày.</p><p>Phí giao tùy khu vực và kích thước đơn — nhân viên sẽ báo khi xác nhận đơn.</p>',
                'keywords' => 'giao trái cây Đà Nẵng, giao giỏ quà, Win Win',
            ],
            'chat-luong' => [
                'summary' => 'Win Win đổi trả trái không đạt chất lượng trong 24 giờ nếu còn hóa đơn và trái chưa qua xử lý. Cam kết minh bạch, tư vấn bảo quản sau mua.',
                'html' => '<p>Chúng tôi cam kết <strong>đổi trả hoặc hỗ trợ</strong> khi trái cây không đạt chất lượng cam kết (dập, hỏng, không đúng loại) trong vòng 24 giờ kể từ khi nhận hàng, với điều kiện còn hóa đơn và sản phẩm chưa qua chế biến.</p><p>Nhân viên Win Win luôn tư vấn cách bảo quản sau mua để trái giữ tươi lâu nhất. Nếu cần, chụp ảnh sản phẩm và liên hệ hotline để được xử lý nhanh.</p><p>Sự hài lòng của khách hàng là ưu tiên hàng đầu của chúng tôi.</p>',
                'keywords' => 'đổi trả trái cây, cam kết chất lượng, Win Win',
            ],
            'dat-gio-qua' => [
                'summary' => 'Đặt giỏ quà theo ngân sách và dịp: Tết, khai trương, sinh nhật. Hotline 0905 454 775 — Win Win tư vấn và giao tận nơi.',
                'html' => '<p>Bạn cần giỏ quà theo <strong>ngân sách, số lượng và dịp cụ thể</strong>? Win Win nhận đặt trước với đầy đủ lựa chọn trái nhập khẩu và đóng gói theo yêu cầu.</p><p>Gọi <strong>0905 454 775</strong> hoặc <strong>0905 09 09 10</strong> để được tư vấn mẫu giỏ, thời gian giao và in thiệp. Có hỗ trợ giao nhiều điểm cho doanh nghiệp.</p><p><strong>Địa chỉ cửa hàng:</strong> Đường DT605, xã Hòa Tiến, Đà Nẵng.<br><strong>Website:</strong> traicaywinwin.com</p>',
                'keywords' => 'đặt giỏ quà, hotline Win Win, quà tặng trái cây',
            ],
        ];

        $data = $blocks[$slug] ?? [
            'summary' => $title,
            'html' => '<p>' . e($title) . '</p>',
            'keywords' => 'Win Win, trái cây nhập khẩu',
        ];

        $text = trim(preg_replace('/\s+/', ' ', strip_tags($data['html'])));

        return [
            'summary' => $data['summary'],
            'html' => $data['html'],
            'text' => $text,
            'keywords' => $data['keywords'],
        ];
    }
}
