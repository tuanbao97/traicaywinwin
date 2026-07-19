@php
  $p = $product ?? [];
  $id = (int) ($p['ID'] ?? $productId ?? 0);
  $title = $p['TEN_SAN_PHAM'] ?? 'Sản phẩm';
  $slug = ($p['TEN_SAN_PHAM_SLUG'] ?? null) ? trim((string) $p['TEN_SAN_PHAM_SLUG']) : 'sp';
  $priceInt = (int) round((float) ($p['GIA_CA'] ?? 0));
  $displayText = trim((string) ($p['GIA_HIEN_THI'] ?? ''));
  $isContactPrice = !empty($p['IS_GIA_CA_LIEN_HE']);
  $category = $p['DANH_MUC_SAN_PHAM'] ?? [];
  $categoryId = (int) ($category['ID'] ?? 0);
  $categoryName = $category['TEN_DANH_MUC_SAN_PHAM'] ?? '';
  $detailUrl = url('san-pham/chi-tiet/' . $slug . '-' . $id);

  $imageDisplayRelFromImg = function ($img) {
      if (!$img || !is_array($img)) {
          return '';
      }
      $fname = $img['IMAGE_THUMNAIL'] ?? $img['NAME'] ?? '';
      $ar = trim((string) ($img['ASPECT_RATIO'] ?? '1x1')) ?: '1x1';
      if ($fname !== '' && !empty($img['DIRECTORY'])) {
          $dir = trim(str_replace('\\', '/', (string) $img['DIRECTORY']), '/');

          return $dir . '/' . $ar . '_' . $fname;
      }
      if (!empty($img['PATH'])) {
          return str_replace('\\', '/', (string) $img['PATH']);
      }

      return '';
  };

  $imageOriginalRelFromImg = function ($img) {
      if (!$img || !is_array($img)) {
          return '';
      }
      $fname = $img['IMAGE_THUMNAIL'] ?? $img['NAME'] ?? '';
      if ($fname !== '' && !empty($img['DIRECTORY'])) {
          $dir = trim(str_replace('\\', '/', (string) $img['DIRECTORY']), '/');

          return $dir . '/' . $fname;
      }
      if (!empty($img['PATH'])) {
          $path = str_replace('\\', '/', (string) $img['PATH']);

          return preg_replace('#/(\d+x\d+)_([^/]+)$#i', '/$2', $path) ?: $path;
      }

      return '';
  };

  $imageUrls = [];
  $imageOriginalUrls = [];
  $imageRels = [];
  $productUpd = $p['UPD_DT'] ?? null;
  $pushImages = function ($list) use (&$imageUrls, &$imageOriginalUrls, &$imageRels, $imageDisplayRelFromImg, $imageOriginalRelFromImg, $productUpd) {
      if (!$list || !is_array($list)) {
          return;
      }
      foreach ($list as $img) {
          $displayRel = $imageDisplayRelFromImg($img);
          $originalRel = $imageOriginalRelFromImg($img) ?: $displayRel;
          if ($displayRel === '' && $originalRel === '') {
              continue;
          }
          $bust = $productUpd ?? ($img['UPD_DT'] ?? null);
          $displayUrl = storefrontImageUrl($displayRel ?: $originalRel, $bust);
          $originalUrl = storefrontImageUrl($originalRel ?: $displayRel, $bust);
          if (!in_array($displayUrl, $imageUrls, true)) {
              $imageUrls[] = $displayUrl;
              $imageOriginalUrls[] = $originalUrl;
              $imageRels[] = $displayRel ?: $originalRel;
          }
      }
  };
  $pushImages($p['DANH_SACH_HINH_ANH_DAI_DIEN'] ?? null);
  $pushImages($p['DANH_SACH_HINH_ANH'] ?? null);
  if ($imageUrls === []) {
      $imageUrls[] = asset('image/UI-BACKEND/default-image.png');
      $imageOriginalUrls[] = asset('image/UI-BACKEND/default-image.png');
      $imageRels[] = '';
  }

  $formatPrice = function (int $amount): string {
      if ($amount <= 0) {
          return 'Liên hệ';
      }

      return number_format($amount, 0, ',', '.');
  };

  $compareInt = (int) round((float) ($p['GIA_GOC'] ?? 0));
  $discountPct = 0;
  $showCompare = !$isContactPrice && $displayText === '' && $priceInt > 0 && $compareInt > $priceInt;
  if ($showCompare) {
      $discountPct = min(99, max(1, (int) round((1 - $priceInt / $compareInt) * 100)));
  }
  $priceLabel = $isContactPrice
      ? 'Liên hệ'
      : ($displayText !== ''
          ? $displayText
          : ($priceInt > 0 ? $formatPrice($priceInt) : 'Liên hệ'));
  $showVndSuffix = !$isContactPrice && $displayText === '' && $priceInt > 0;
@endphp
<div class="ww-qv-shell">
  <div class="ww-qv-scroll">
    <product-form class="block h-full" data-product-id="{{ $id }}" id="ww-qv-product-form">
      <div class="product-detail lg:gap-x-[3.2rem] gap-4 gap-x-6 grid grid-cols-1 auto-rows-min lg:grid-cols-2 relative">
        <div class="product-gallery-wrapper bg-background min-h-0 min-w-0 relative lg:rounded-lg" style="height:fit-content">
          <div class="">
            <div class="product-gallery md:px-3 pt-3 md:pt-6">
              <media-gallery>
                <div id="GalleryMain-qv-{{ $id }}" class="embla gallery-main relative mx-auto">
                  <div class="embla__viewport">
                    <div class="embla__container" id="ww-qv-gallery-main">
                      @foreach ($imageUrls as $i => $imgUrl)
                        @php $originalUrl = $imageOriginalUrls[$i] ?? $imgUrl; @endphp
                        <div
                          class="embla__slide w-full grow-0 shrink-0 aspect-square flex items-center justify-center relative swiper-spotlight cursor-zoom-in"
                          data-src="{{ $originalUrl }}"
                          data-original-src="{{ $originalUrl }}"
                          data-display-src="{{ $imgUrl }}"
                          data-index="{{ $i }}"
                        >
                          <img
                            class="object-contain rounded-lg scale-[var(--image-scale)] gallery-main-img"
                            src="{{ $imgUrl }}"
                            alt="{{ $title }}"
                            style="--image-scale:1"
                            width="480"
                            height="480"
                            decoding="async"
                            loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                          >
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="embla__buttons">
                    <button class="embla__button embla__button--prev" type="button">
                      <i class="icon icon-carret-left"></i>
                    </button>
                    <button class="embla__button embla__button--next" type="button">
                      <i class="icon icon-carret-right"></i>
                    </button>
                  </div>
                </div>

                <div id="GalleryThumbnails-qv-{{ $id }}" class="embla embla-thumbs overflow-hidde text-center tec gallery-thumbnails mt-3 relative">
                  <div class="embla__viewport">
                    <div class="embla__container gap-3" id="ww-qv-gallery-thumbs">
                      @foreach ($imageUrls as $i => $imgUrl)
                        <div class="embla__slide aspect-square cursor-pointer grow-0 shrink-0 w-[6.1rem] md:w-[9rem]{{ $i === 0 ? ' embla-thumbs__slide--selected' : '' }}">
                          <div class="flex items-center justify-center w-full h-full">
                            <img class="object-contain w-auto" src="{{ $imgUrl }}" width="64" height="64" loading="lazy" alt="{{ $title }}">
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  @if (count($imageUrls) > 1)
                    <div class="embla__buttons">
                      <button class="embla__button embla__button--prev" type="button" aria-label="Thumbnail trước">
                        <i class="icon icon-carret-left"></i>
                      </button>
                      <button class="embla__button embla__button--next" type="button" aria-label="Thumbnail sau">
                        <i class="icon icon-carret-right"></i>
                      </button>
                    </div>
                  @endif
                </div>
              </media-gallery>
            </div>
          </div>
        </div>

        <div class="product-form-wrapper lg:row-start-1 lg:col-start-2">
          <div class="bg-background relative">
            <div class="product-title space-y-2 mb-3">
              <h2 class="font-semibold text-h4 leading-snug">{{ $title }}</h2>
            </div>

            <div class="product-price-group mb-3">
              <div class="price-box flex items-center flex-wrap gap-2">
                <div class="flex flex-wrap gap-1 items-baseline">
                  <span class="price text-h4">
                    @if ($isContactPrice || ($displayText === '' && $priceInt <= 0))
                      Liên hệ
                    @elseif ($displayText !== '')
                      {{ $priceLabel }}
                    @else
                      {{ $priceLabel }}@if ($showVndSuffix)<span class="ww-vnd">&#8363;</span>@endif
                    @endif
                  </span>
                  @if ($showCompare)
                    <span class="compare-price text-h6 line-through">{{ $formatPrice($compareInt) }}<span class="ww-vnd">&#8363;</span></span>
                  @endif
                </div>
                @if ($showCompare && $discountPct > 0)
                  <div class="badge sale-badge px-2 py-1 text-h6 font-semibold">-{{ $discountPct }}%</div>
                @endif
              </div>
            </div>

            <div class="ww-qv-meta text-sm text-neutral-300 mb-4">
              <div>Mã sản phẩm: <b class="text-foreground">{{ $p['MA_SAN_PHAM'] ?? $id }}</b></div>
              <div>Tình trạng: <b class="text-success">Còn hàng</b></div>
              @if ($categoryName !== '')
                <div>Danh mục: <b class="text-foreground">{{ $categoryName }}</b></div>
              @endif
            </div>

            <div class="product-cta mb-0 mt-4">
              <form class="ww-qv-cart-form" enctype="multipart/form-data" action="/cart/add" method="post">
                @csrf
                <input type="hidden" name="variantId" value="{{ $id }}">
                <input type="hidden" name="product_title" value="{{ $title }}">
                <input type="hidden" name="product_handle" value="{{ $slug }}">
                <input type="hidden" name="price" value="{{ $priceInt }}">
                <input type="hidden" name="image" value="{{ $imageRels[0] ?? '' }}">
                <input type="hidden" name="category_id" value="{{ $categoryId ?: '' }}">

                <div class="flex items-center gap-3 mb-4">
                  <div class="w-[88px] text-neutral-400">Số lượng</div>
                  <quantity-input>
                    <div class="custom-number-input product-quantity">
                      <div class="flex flex-row h-10 border border-neutral-50 relative bg-background rounded-pill overflow-hidden h-[3.8rem] w-[13rem]">
                        <button type="button" name="minus" class="h-full w-20 cursor-pointer outline-none p-2">
                          <i class="m-auto icon icon-minus"></i>
                        </button>
                        <input type="number" class="focus:outline-none form-quantity w-full focus:ring-transparent text-base font-semibold bg-transparent border-none text-center" name="quantity" value="1" min="1">
                        <button type="button" name="plus" class="h-full w-20 rounded-r cursor-pointer p-2">
                          <i class="m-auto icon icon-plus"></i>
                        </button>
                      </div>
                    </div>
                  </quantity-input>
                </div>

                <div class="flex gap-2 mt-4 border-t border-neutral-50 pt-4">
                  <button type="button" name="addtocart" class="font-semibold btn bg-[var(--color-addtocart-bg)] text-[var(--color-addtocart)] btn-add-to-cart add_to_cart w-full" data-variant-id="{{ $id }}" data-action="addtocart">
                    THÊM VÀO GIỎ
                    <br><span class="text-xs font-normal opacity-90">Giao hàng tận nơi hoặc nhận tại cửa hàng</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </product-form>
  </div>

  <div class="ww-qv-footer">
    <a class="ww-qv-detail-link link font-semibold text-sm" href="{{ $detailUrl }}">Xem chi tiết sản phẩm »</a>
  </div>
</div>
