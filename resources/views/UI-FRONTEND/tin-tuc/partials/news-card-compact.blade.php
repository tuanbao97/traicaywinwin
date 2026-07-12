@php
  $title = $news['TIEU_DE_TIN_TUC'] ?? '';
  $slug = $news['TIEU_DE_TIN_TUC_SLUG'] ?? '';
  $id = (int) ($news['ID'] ?? 0);
  $detailUrl = url('tin-tuc/chi-tiet/' . $slug . '-' . $id);
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

<div class="card-article-media flex gap-2">
  <div class="card-article__image w-[107px] flex-shrink-0 flex-grow-0" style="--aspect-ratio: 480/320">
    <a class="link line-clamp-2 break-words" href="{{ $detailUrl }}" title="{{ $title }}" data-prefetch="{{ $detailUrl }}">
      <img
        loading="lazy"
        class="aspect-custom object-contain group-hover:scale-105 transition-transform duration-300"
        src="{{ $img }}"
        alt="{{ $title }}"
        width="107"
        height="80"
      >
    </a>
  </div>
  <div class="card-article__body">
    <p class="card-article__title font-semibold">
      <a class="link line-clamp-2 break-word" href="{{ $detailUrl }}" title="{{ $title }}">{{ $title }}</a>
    </p>
  </div>
</div>
