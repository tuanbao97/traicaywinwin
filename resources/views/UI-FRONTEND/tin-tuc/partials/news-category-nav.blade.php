@foreach ($categories as $category)
  @php
    $catId = (int) ($category['ID'] ?? 0);
    $catSlug = $category['TEN_DANH_MUC_TIN_TUC_SLUG'] ?? '';
    $catName = $category['TEN_DANH_MUC_TIN_TUC'] ?? '';
    $catUrl = storefrontNewsCategoryUrl((string) $catSlug, $catId);
    $isActive = isset($activeCategoryId) && (int) $activeCategoryId === $catId;
    $children = $category['DANH_SACH_CHILDREN'] ?? [];
    $level = (int) ($category['TREE_LEVEL'] ?? 0);
    $paddingClass = $level <= 0 ? '' : ($level === 1 ? 'pl-3' : 'pl-5');
  @endphp
  <li class="nav-item">
    <a
      class="nav-link link {{ $paddingClass }} {{ $isActive ? 'text-primary font-semibold' : '' }}"
      href="{{ $catUrl }}"
      title="{{ $catName }}"
    >{{ $catName }}</a>
  </li>
  @if (is_array($children) && count($children) > 0)
    @include('UI-FRONTEND.tin-tuc.partials.news-category-nav', [
      'categories' => $children,
      'activeCategoryId' => $activeCategoryId ?? null,
    ])
  @endif
@endforeach
