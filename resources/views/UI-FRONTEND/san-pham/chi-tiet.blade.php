{{-- Trang chi tiết sản phẩm — shell gọn; gallery hydrate qua API --}}
@include('UI-FRONTEND.san-pham.partials.product-detail-head')

<body class="ega-theme product">@include('UI-FRONTEND.common.header')

  <main>
    @include('UI-FRONTEND.san-pham.partials.product-detail-main')
    @include('UI-FRONTEND.san-pham.partials.related-products')
    @include('UI-FRONTEND.san-pham.partials.recent-viewed-products')
  </main>

  @include('UI-FRONTEND.common.theme-portals')
  @include('UI-FRONTEND.san-pham.partials.product-detail-scripts')
</body>
</html>
