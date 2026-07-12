@include('UI-FRONTEND.san-pham.partials.product-detail-head')

<body class="ega-theme page">
  <link rel="stylesheet" href="100/531/894/themes/1018832/assets/policy-page.css?ww-policy-2" media="all">
  @include('UI-FRONTEND.common.header')
  <script>
    (function () {
      var title = 'Chính sách bảo hành — Win Win';
      var desc =
        'Chính sách bảo hành và hỗ trợ sau mua tại Win Win Trái Cây Nhập Khẩu & Quà tặng. Hotline 0905 454 775 - 0905 09 09 10.';
      var t = document.getElementById('ww-page-title');
      if (t) t.textContent = title;
      var meta = document.getElementById('ww-meta-description');
      if (meta) meta.setAttribute('content', desc);
    })();
  </script>

  <main>
    <div class="breadcrumbs">
      <div class="container">
        <ul class="breadcrumb py-3 flex flex-wrap items-center text-xs md:text-sm">
          <li class="home">
            <a class="link" href="{{ url('/') }}" title="Trang chủ"><span>Trang chủ</span></a>
            <span class="mx-1 md:mx-2 inline-block">&nbsp;/&nbsp;</span>
          </li>
          <li>
            <span class="text-neutral-100">Chính sách bảo hành</span>
          </li>
        </ul>
      </div>
    </div>

    <section class="section main-page" style="--section-margin: 0px 0px 40px; --section-margin-mb: 0px 0px 20px">
      <div class="container">
        <div class="bg-background rounded-lg px-3 py-4 md:px-6 md:py-6 mb-6">
          <div class="page-content ww-policy">
            <header class="ww-policy__header">
              <h1 class="text-h4 font-semibold mb-2">Chính sách bảo hành</h1>
              <p class="text-base text-primary font-semibold mb-0">Win Win Trái Cây Nhập Khẩu &amp; Quà tặng</p>
            </header>

            <div class="ww-policy__body prose text-base">
              <p>
                Win Win Trái Cây Nhập Khẩu &amp; Quà tặng cam kết mang đến sản phẩm chất lượng và hỗ trợ
                khách hàng sau khi mua hàng một cách rõ ràng, minh bạch. Chính sách bảo hành dưới đây
                áp dụng cho các sản phẩm mua tại cửa hàng hoặc đặt hàng qua website / Zalo / Messenger / hotline.
              </p>

              <h2>1. Phạm vi hỗ trợ</h2>
              <p>Tùy theo nhóm sản phẩm, Win Win áp dụng hình thức hỗ trợ như sau:</p>
              <ul>
                <li>
                  <strong>Trái cây tươi:</strong> đảm bảo chất lượng khi giao/nhận hàng. Nếu sản phẩm bị hư hỏng,
                  dập nát bất thường, úng thối sớm hoặc sai loại / sai số lượng so với đơn đã xác nhận,
                  quý khách vui lòng báo ngay trong vòng <strong>24 giờ</strong> kể từ khi nhận hàng để được
                  kiểm tra và hỗ trợ đổi/bù phù hợp.
                </li>
                <li>
                  <strong>Giỏ quà / set quà:</strong> quý khách nên kiểm tra tình trạng bao bì, tem niêm phong
                  và sản phẩm ngay khi nhận. Win Win hỗ trợ đổi/bù trong trường hợp lỗi từ phía cửa hàng
                  (sai hàng, thiếu hàng) hoặc hư hỏng do quá trình vận chuyển.
                </li>
                <li>
                  <strong>Hàng đóng gói / đồ uống / sữa / thực phẩm khô:</strong> hỗ trợ theo hạn sử dụng và
                  tình trạng niêm phong. Sản phẩm còn nguyên tem, chưa mở nắp/bao bì và còn hạn sử dụng
                  sẽ được xem xét đổi/trả theo từng trường hợp cụ thể.
                </li>
                <li>
                  <strong>Sản phẩm khác:</strong> điều kiện hỗ trợ sẽ được nhân viên tư vấn rõ khi bán hàng
                  hoặc khi xác nhận đơn.
                </li>
              </ul>

              <h2>2. Thời hạn tiếp nhận yêu cầu</h2>
              <ul>
                <li><strong>Trái cây tươi / hàng dễ hỏng:</strong> trong vòng <strong>24 giờ</strong> sau khi nhận hàng.</li>
                <li><strong>Giỏ quà / hàng đóng gói:</strong> trong vòng <strong>48 giờ</strong> sau khi nhận hàng (trừ khi có thỏa thuận khác).</li>
                <li>Quá thời hạn trên, Win Win vẫn tiếp nhận phản ánh để hỗ trợ tư vấn, nhưng có thể không áp dụng đổi/bù.</li>
              </ul>

              <h2>3. Điều kiện tiếp nhận bảo hành / đổi hàng</h2>
              <ul>
                <li>Còn hóa đơn, biên nhận, tin nhắn xác nhận đơn hoặc thông tin đơn hàng trên hệ thống.</li>
                <li>Cung cấp hình ảnh/video sản phẩm rõ nét thể hiện tình trạng lỗi (nếu yêu cầu đổi/bù).</li>
                <li>Sản phẩm còn nguyên trạng theo điều kiện từng nhóm hàng (tem, bao bì, hạn sử dụng…).</li>
                <li>Lỗi phát sinh không do bảo quản sai hướng dẫn, va đập sau khi nhận, hoặc sử dụng không đúng cách.</li>
              </ul>

              <h2>4. Trường hợp từ chối bảo hành</h2>
              <p>Win Win xin phép <strong>từ chối bảo hành / đổi trả</strong> trong các trường hợp sau:</p>
              <ul>
                <li>
                  Sản phẩm đã đem ra ngoài <strong>chưng cúng</strong>
                  (vì không đảm bảo điều kiện bảo quản).
                </li>
                <li>Sản phẩm đã qua sử dụng, đã mở bao bì/niêm phong (đối với hàng đóng gói) mà không phải lỗi từ cửa hàng.</li>
                <li>Hư hỏng do bảo quản sai (để ngoài nắng, nhiệt độ cao, ẩm ướt, gần nguồn nhiệt…).</li>
                <li>Hư hỏng do vận chuyển lại bởi bên thứ ba sau khi khách đã nhận hàng.</li>
                <li>Không cung cấp được thông tin đơn hàng / bằng chứng mua hàng cần thiết.</li>
                <li>Yêu cầu vượt quá thời hạn tiếp nhận quy định tại mục 2.</li>
              </ul>

              <h2>5. Hình thức hỗ trợ</h2>
              <p>Tùy tình trạng thực tế và thỏa thuận với khách hàng, Win Win có thể hỗ trợ một trong các hình thức:</p>
              <ul>
                <li>Đổi sản phẩm tương đương.</li>
                <li>Bù sản phẩm / bổ sung phần bị thiếu hoặc lỗi.</li>
                <li>Giảm giá / hoàn tiền một phần hoặc toàn bộ (theo từng trường hợp).</li>
              </ul>
              <p>
                Thời gian xử lý thông thường từ <strong>01 – 03 ngày làm việc</strong> sau khi tiếp nhận đủ thông tin.
                Với trái cây tươi, cửa hàng ưu tiên xử lý nhanh trong ngày nếu quý khách liên hệ sớm.
              </p>

              <h2>6. Hướng dẫn bảo quản (khuyến nghị)</h2>
              <ul>
                <li>Trái cây tươi: bảo quản nơi khô ráo, thoáng mát hoặc ngăn mát tủ lạnh tùy loại; tránh ánh nắng trực tiếp.</li>
                <li>Giỏ quà: để nơi sạch sẽ, tránh ẩm và va đập; sử dụng sớm đối với thành phần dễ hỏng.</li>
                <li>Hàng đóng gói / đồ uống: bảo quản theo hướng dẫn trên bao bì, dùng trước hạn sử dụng.</li>
              </ul>

              <h2>7. Cách liên hệ bảo hành / hỗ trợ</h2>
              <p>Khi cần hỗ trợ, quý khách vui lòng cung cấp: họ tên, số điện thoại, mã/đơn hàng (nếu có), mô tả lỗi và hình ảnh/video.</p>
              <ul>
                <li>
                  Hotline:
                  <a class="link text-primary font-semibold" href="{{ wwWebContact()['hotline']['tel'] ?? 'tel:' }}" data-ww-contact="hotline" title="Hotline">
                    <span data-ww-contact-slot="hotline-number">{{ wwWebContact()['hotline']['display'] ?? '' }}</span>
                  </a>
                  —
                  <a class="link text-primary font-semibold" href="tel:0905090910" title="0905 09 09 10">0905 09 09 10</a>
                </li>
                <li>
                  Trang liên hệ:
                  <a class="link text-primary font-semibold" href="{{ url('/lien-he') }}" title="Liên hệ">{{ url('/lien-he') }}</a>
                </li>
                <li>Địa chỉ cửa hàng: Đường DT605, xã Hòa Tiến, Đà Nẵng (đối diện Trường Tiểu học số 2 Hòa Tiến)</li>
                <li>Thời gian hỗ trợ: <strong>6:00 – 21:30</strong> (Tất cả các ngày trong tuần)</li>
              </ul>

              <p class="mb-0">
                Win Win luôn sẵn sàng lắng nghe và hỗ trợ quý khách để mang lại trải nghiệm mua sắm tốt nhất.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  @include('UI-FRONTEND.common.theme-portals')
  <script src="100/531/894/themes/1018832/assets/main.js?ww-page-1" defer fetchpriority="low"></script>
  @include('UI-FRONTEND.common.cart-scripts')
  <script src="100/531/894/themes/1018832/assets/defer-scripts.js?ww-page-1" defer fetchpriority="low"></script>
</body>
</html>
