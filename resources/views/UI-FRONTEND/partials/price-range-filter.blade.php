{{-- Khoảng giá: Từ — Đến + dual slider --}}
@php
  $priceRangeMax = (int) ($priceRangeMax ?? 5000000);
  if ($priceRangeMax < 1000000) {
      $priceRangeMax = 5000000;
  }
  $giaTuDisplay = isset($giaTu) && $giaTu !== null && $giaTu !== '' ? (int) $giaTu : null;
  $giaDenDisplay = isset($giaDen) && $giaDen !== null && $giaDen !== '' ? (int) $giaDen : null;
  $formatVndDots = static function (?int $n): string {
      if ($n === null) {
          return '';
      }

      return number_format($n, 0, ',', '.');
  };
@endphp
<div class="ww-search-filter-card ww-search-filter-card--inline mb-4 md:mb-5">
  <div class="ww-search-filter-card__row ww-search-filter-card__row--price-range">
    <div class="ww-search-filter-card__head">
      <span class="ww-search-filter-card__icon" aria-hidden="true">
        <i class="icon icon-dollar-circle"></i>
      </span>
      <h2 class="ww-search-filter-card__title">Khoảng giá</h2>
    </div>

    <div
      class="ww-price-range"
      id="ww-price-range"
      data-min="0"
      data-max="{{ $priceRangeMax }}"
      data-step="50000"
    >
      <div class="ww-price-range__inputs">
        <label class="ww-price-range__field">
          <span class="ww-price-range__label">Từ</span>
          <div class="ww-price-range__control">
            <input
              type="text"
              inputmode="numeric"
              autocomplete="off"
              class="ww-price-range__input"
              id="ww-price-from"
              placeholder="0"
              value="{{ $formatVndDots($giaTuDisplay) }}"
              aria-label="Giá từ"
            >
            <span class="ww-price-range__unit">đ</span>
          </div>
        </label>

        <span class="ww-price-range__dash" aria-hidden="true">—</span>

        <label class="ww-price-range__field">
          <span class="ww-price-range__label">Đến</span>
          <div class="ww-price-range__control">
            <input
              type="text"
              inputmode="numeric"
              autocomplete="off"
              class="ww-price-range__input"
              id="ww-price-to"
              placeholder="5.000.000"
              value="{{ $formatVndDots($giaDenDisplay) }}"
              aria-label="Giá đến"
            >
            <span class="ww-price-range__unit">đ</span>
          </div>
        </label>

        <button type="button" class="ww-price-range__apply" id="ww-price-apply">
          Áp dụng
        </button>

        <button type="button" class="ww-search-price-clear" id="ww-search-price-clear" hidden>
          <i class="icon icon-refresh" aria-hidden="true"></i>
          <span class="ww-search-price-clear__text">Xóa</span>
        </button>
      </div>

      <div class="ww-price-range__slider" aria-hidden="true">
        <div class="ww-price-range__track">
          <div class="ww-price-range__fill" id="ww-price-fill"></div>
        </div>
        <input
          type="range"
          class="ww-price-range__thumb ww-price-range__thumb--min"
          id="ww-price-min-slider"
          min="0"
          max="{{ $priceRangeMax }}"
          step="50000"
          value="{{ $giaTuDisplay ?? 0 }}"
        >
        <input
          type="range"
          class="ww-price-range__thumb ww-price-range__thumb--max"
          id="ww-price-max-slider"
          min="0"
          max="{{ $priceRangeMax }}"
          step="50000"
          value="{{ $giaDenDisplay ?? $priceRangeMax }}"
        >
      </div>
    </div>
  </div>
</div>
