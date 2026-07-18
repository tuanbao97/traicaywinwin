{{-- Placeholder trước khi AJAX đổ section danh mục — tránh trang trống rồi nhảy layout --}}
<section
  id="ww-home-products-skeleton"
  class="section section-home-products-skeleton"
  aria-busy="true"
  aria-live="polite"
  style="--section-padding: 0; --section-margin: 24px 0 24px; --section-padding-mb: 0; --section-margin-mb: 24px 0 24px;"
>
  <div class="container">
    <div class="section-card">
      <div class="flex justify-between items-center md:gap-3 flex-wrap mb-3 md:mb-4">
        <div class="heading-bar w-full max-w-[18rem]">
          <div class="h-7 md:h-8 w-3/4 rounded bg-neutral-50 animate-pulse"></div>
        </div>
        <div class="flex gap-2 w-full md:w-auto mt-2 md:mt-0 overflow-hidden">
          <div class="h-9 w-20 shrink-0 rounded-pill bg-neutral-50 animate-pulse"></div>
          <div class="h-9 w-24 shrink-0 rounded-pill bg-neutral-50 animate-pulse"></div>
          <div class="h-9 w-20 shrink-0 rounded-pill bg-neutral-50 animate-pulse"></div>
          <div class="h-9 w-28 shrink-0 rounded-pill bg-neutral-50 animate-pulse hidden md:block"></div>
        </div>
      </div>

      <div class="product-list grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
        @for ($i = 0; $i < 10; $i++)
          <div class="skeleton__product-grid__item bg-background border border-neutral-50 relative z-10 m-0 h-full">
            <div class="skeleton__product-grid__item__image aspect-square bg-neutral-50 animate-pulse"></div>
            <div class="skeleton__product-grid__item__body p-2 space-y-2">
              <div class="skeleton__product-grid__item__title w-full rounded bg-neutral-50 animate-pulse" style="min-height:calc(var(--font-size-body, 1.5rem) * 1.5 * 3)"></div>
              <div class="flex justify-between items-center gap-3">
                <div class="skeleton__product-grid__item__price w-1/3 h-5 rounded bg-neutral-50 animate-pulse"></div>
                <div class="w-9 h-9 shrink-0 rounded bg-neutral-50 animate-pulse"></div>
              </div>
            </div>
          </div>
        @endfor
      </div>

      <div class="mt-2 md:mt-6 flex justify-center">
        <div class="h-10 w-36 rounded-sm bg-neutral-50 animate-pulse"></div>
      </div>
    </div>
  </div>
</section>
