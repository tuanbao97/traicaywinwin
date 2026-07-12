@php
  $appUrl = rtrim($appUrl ?? url('/'), '/');
  $title = (string) ($video['TIEU_DE_VIDEO'] ?? 'Video');
  $summary = (string) ($video['TOM_TAT_VIDEO'] ?? '');
  $videoId = (int) ($video['ID'] ?? 0);
  $avatars = $video['DANH_SACH_HINH_ANH_DAI_DIEN'] ?? [];
  $img = is_array($avatars) && count($avatars) ? $avatars[0] : null;
  $thumb = asset('image/UI-BACKEND/default-image.png');
  if (is_array($img)) {
      $dir = (string) ($img['DIRECTORY'] ?? '');
      $name = (string) ($img['NAME'] ?? '');
      $ratio = (string) ($img['ASPECT_RATIO'] ?? '1x1');
      if ($dir !== '' && $name !== '') {
          $thumb = $appUrl . '/' . ltrim($dir . '/' . $ratio . '_' . $name, '/');
          if (! empty($img['UPD_DT'])) {
              $thumb .= '?update_time=' . strtotime((string) $img['UPD_DT']);
          }
      } elseif (! empty($img['PATH'])) {
          $thumb = $appUrl . '/' . ltrim((string) $img['PATH'], '/');
      }
  }
@endphp

<button
  type="button"
  class="ww-home-video-card"
  data-video-id="{{ $videoId }}"
  data-video-title="{{ $title }}"
  data-video-summary="{{ $summary }}"
  title="{{ $title }}"
>
  <span class="ww-home-video-card__thumb">
    <img src="{{ $thumb }}" alt="{{ $title }}" loading="lazy" width="400" height="400">
    <span class="ww-home-video-card__play" aria-hidden="true">
      <svg viewBox="0 0 64 64" width="48" height="48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="32" cy="32" r="32" fill="rgba(0,0,0,0.55)"/>
        <path d="M26 20L46 32L26 44V20Z" fill="#fff"/>
      </svg>
    </span>
  </span>
  <span class="ww-home-video-card__title">{{ $title }}</span>
  @if ($summary !== '')
    <span class="ww-home-video-card__summary">{{ $summary }}</span>
  @endif
</button>
