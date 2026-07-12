{{-- Ô tìm kiếm header / drawer — gọi GET /search và API product/list qua ThemeStorefrontController --}}
<div class="search-bar relative">
  <quick-search class="quick-search">
    <form action="{{ url('/search') }}" method="get" class="m-0 flex bg-background pl-1 pr-0 py-0 rounded items-stretch relative border border-neutral-50 overflow-hidden" role="search">
      <div class="search-input-group w-full relative flex items-stretch min-h-[4rem]">
        <input
          type="text"
          name="query"
          value="{{ request('query', '') }}"
          autocomplete="off"
          class="border-0 bg-transparent focus:ring-transparent py-0 pl-1 pr-2 w-full text-base text-foreground text-ellipsis self-center"
          required
          data-placeholder="Tìm trái cây, giỏ quà, yến sào,...; Tìm theo loại quà...;"
          placeholder="Tìm trái cây, giỏ quà, yến sào,..."
        >
        <input type="hidden" name="type" value="product">
        <button type="submit" aria-label="search" class="search-button btn flex items-center justify-center shrink-0 text-foreground rounded-none rounded-r bg-[var(--color-search)] text-white">
          <i class="icon icon-search"></i>
        </button>
      </div>
    </form>
    <div class="search-dropdown absolute bottom-0 top-full mt-1 left-0 bg-background rounded-lg py-3 text-foreground w-full px-2">
      <div class="search-loading absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full z-[1] bg-background flex items-center justify-center">
        <span class="loading-icon gap-1 hidden items-center justify-center">
          <span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>
          <span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>
          <span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>
        </span>
      </div>
      <div class="search-result space-y-3"></div>
      <div class="search-history-list border-neutral-50"></div>
      <div class="search-keywords space-y-2 pt-2 px-2">
        <span class="text-primary font-semibold">Từ khóa phổ biến</span>
        <div class="search-keyword-list flex gap-1 items-center flex-wrap">
          @php
            $popularKeywords = [
              [
                'label' => 'Giỏ quà trái cây',
                'url' => storefrontProductCategoryUrl(1004, 'Giỏ quà trái cây'),
              ],
              [
                'label' => 'Hộp quà trái cây',
                'url' => storefrontProductCategoryUrl(1005, 'Hộp quà trái cây'),
              ],
              [
                'label' => 'Yến sào chính hãng',
                'url' => storefrontProductCategoryUrl(1003, 'Yến sào Cao Cấp'),
              ],
            ];
          @endphp
          @foreach ($popularKeywords as $keyword)
          <a
            href="{{ $keyword['url'] }}"
            class="search-keyword text-secondary px-3 py-1 bg-relative rounded-full inline-flex items-center justify-center hover:border-secondary border border-transparent"
            title="{{ $keyword['label'] }}"
          >{{ $keyword['label'] }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </quick-search>
</div>
