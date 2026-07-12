@php
  $title = $news['TIEU_DE_TIN_TUC'] ?? '';
  $slug = $news['TIEU_DE_TIN_TUC_SLUG'] ?? '';
  $id = (int) ($news['ID'] ?? 0);
  $detailUrl = url('tin-tuc/chi-tiet/' . $slug . '-' . $id);
  $categoryName = $news['DANH_MUC_TIN_TUC']['TEN_DANH_MUC_TIN_TUC'] ?? '';
  $summary = $news['TOM_TAT_TIN_TUC'] ?? '';
  $dateRaw = $news['NGAY_XUAT_BAN'] ?? $news['UPD_DT'] ?? $news['CRT_DT'] ?? null;
  $dateText = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('d/m/Y') : '';
  $updTime = $news['UPD_DT'] ?? $news['CRT_DT'] ?? null;

  $img = asset('image/UI-BACKEND/default-image.png');
  $avatars = $news['DANH_SACH_HINH_ANH_DAI_DIEN'] ?? [];
  if (is_array($avatars) && count($avatars) > 0) {
    $avatar = $avatars[0];
    $bust = $updTime ?? ($avatar['UPD_DT'] ?? null);
    if (! empty($avatar['PATH'])) {
      $img = storefrontImageUrl($avatar['PATH'], $bust);
    } else {
      $ratio = $avatar['ASPECT_RATIO'] ?? '1x1';
      $name = $avatar['NAME'] ?? '';
      $dir = $avatar['DIRECTORY'] ?? '';
      if ($dir !== '' && $name !== '') {
        $img = storefrontImageUrl($dir . '/' . $ratio . '_' . $name, $bust);
      }
    }
  }
@endphp

<div class="card-article grid grid-rows-[auto_1fr] bg-background rounded-sm overflow-hidden group" style="--aspect-ratio: 480/320">
  <div class="card-article__image aspect-custom flex items-center justify-center overflow-hidden">
    <a href="{{ $detailUrl }}" title="{{ $title }}" data-prefetch="{{ $detailUrl }}">
      <img
        loading="lazy"
        class="aspect-custom object-contain group-hover:scale-105 transition-transform duration-300"
        src="{{ $img }}"
        alt="{{ $title }}"
        width="480"
        height="320"
      >
    </a>
  </div>
  <div class="card-article__body h-full p-3 lg:p-4 flex flex-col gap-2-5 md:gap-4">
    <div>
      @if ($categoryName !== '')
        <p class="card-article__category font-semibold text-xs text-secondary mb-1">{{ $categoryName }}</p>
      @endif
      <p class="card-article__title font-semibold">
        <a href="{{ $detailUrl }}" title="{{ $title }}" class="link line-clamp-2 break-word">{{ $title }}</a>
      </p>
    </div>
    @if ($summary !== '')
      <div class="card-article__desc break-word hidden md:line-clamp-3 text-neutral-200">{{ $summary }}</div>
    @endif
    <div class="flex gap-2 justify-between items-center pt-2 mt-auto md:pt-3 border-t border-neutral-50 flex-wrap">
      @if ($dateText !== '')
        <div class="cart-article__date text-xs md:text-sm text-neutral-200 flex gap-1 items-center whitespace-nowrap">
          <i class="icon icon-calendar"></i>
          {{ $dateText }}
        </div>
      @endif
      <a
        href="{{ $detailUrl }}"
        title="Xem chi tiết"
        class="btn font-semibold text-secondary border border-secondary hover:bg-secondary hover:text-background whitespace-nowrap md:w-auto w-full p-2 md:p-3 md:px-6 text-xs md:text-sm"
      >Xem chi tiết</a>
    </div>
  </div>
</div>
