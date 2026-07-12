<div class="blog-sidebar w-full ml-auto xl:max-w-[32rem]">
  <div class="bg-background mb-5 h-auto px-5 z-10 relative flex flex-col rounded-sm">
    <aside class="aside-item blog-sidebar aside-item md:py-5 py-4">
      <div class="aside-title">
        <h2 class="title-head margin-top-0 text-base font-semibold mb-3">
          <span>DANH MỤC</span>
        </h2>
      </div>
      <div class="aside-content">
        <nav class="nav-category navbar-toggleable-md">
          <ul class="space-y-3">
            <li class="nav-item">
              <a
                class="nav-link link {{ empty($activeCategoryId) ? 'text-primary font-semibold' : '' }}"
                href="{{ url('tin-tuc') }}"
                title="Tất cả"
              >Tất cả</a>
            </li>
            @if (!empty($categories))
              @include('UI-FRONTEND.tin-tuc.partials.news-category-nav', [
                'categories' => $categories,
                'activeCategoryId' => $activeCategoryId ?? null,
              ])
            @endif
          </ul>
        </nav>
      </div>
    </aside>

    @if (!empty($hotNews))
      <aside class="blog-aside aside-item blog-aside-article aside-item md:py-5 py-4 border-t border-neutral-50">
        <div class="aside-title">
          <h2 class="title-head margin-top-0 text-base font-semibold mb-3">
            <span>
              <a class="link" href="{{ url('tin-tuc') }}" title="TIN TỨC NỔI BẬT">TIN TỨC NỔI BẬT</a>
            </span>
          </h2>
        </div>
        <div class="aside-content-article aside-content margin-top-0">
          <div class="blog-image-list space-y-3">
            @foreach ($hotNews as $hotItem)
              @include('UI-FRONTEND.tin-tuc.partials.news-card-compact', ['news' => $hotItem])
            @endforeach
          </div>
        </div>
      </aside>
    @endif
  </div>
</div>
