<script>
(function () {
  var cfg = {
    apiUrl: @json(url('/api/public/product/list')),
    appUrl: @json(rtrim(url('/'), '/')),
    defaultImg: @json(asset('image/UI-BACKEND/default-image.png')),
    detailPath: '/san-pham/chi-tiet',
    frameSrc: @json(asset('UI-FRONTEND/images/Khung vien xanh.png')),
    query: @json($query ?? ''),
    categoryId: @json($categoryId ?? 0),
    categoryKey: @json($categoryKey ?? ''),
    boLoc: @json($boLoc ?? 'default'),
    selectedGia: @json($selectedPriceFilterIds ?? []),
    giaTu: @json($giaTu ?? null),
    giaDen: @json($giaDen ?? null),
    page: @json($page ?? 1),
    perPage: @json($perPage ?? 20),
    skeletonCount: 20,
    containerId: 'search-results-grid',
    paginationId: 'search-pagination',
    listAll: @json(!empty($listAll)),
    productHot: @json(!empty($productHot)),
    productVip: @json(!empty($productVip)),
    pageBasePath: @json($pageBasePath ?? '/tat-ca-san-pham'),
    noPagination: true,
  };

  if (!cfg.query && !cfg.categoryId && !cfg.listAll && !cfg.productHot && !cfg.productVip) return;

  function joinAppUrl(pathRel, updDt) {
    if (!pathRel) return '';
    var url = cfg.appUrl + '/' + String(pathRel).replace(/^\/+/, '');
    return (window.wwStorefrontImage && window.wwStorefrontImage.appendUpdTime)
      ? window.wwStorefrontImage.appendUpdTime(url, updDt)
      : url;
  }

  function escapeHtml(s) {
    if (s == null) return '';
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function formatIntViDots(num) {
    var s = String(Math.floor(Math.abs(Number(num))));
    if (s.length <= 3) return s;
    return s.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function formatPriceShortVnd(amount) {
    var n = Math.round(Number(amount));
    if (!isFinite(n) || n <= 0) return '0';
    if (n < 1000) return String(n);
    return formatIntViDots(n) + ' ₫';
  }

  function relativeImagePathFromImg(img) {
    if (!img) return '';
    var fname = img.IMAGE_THUMNAIL || img.NAME || '';
    var ar = (img.ASPECT_RATIO && String(img.ASPECT_RATIO).trim()) || '1x1';
    if (img.DIRECTORY && fname) {
      return String(img.DIRECTORY).replace(/^\/+|\/+$/g, '') + '/' + ar + '_' + fname;
    }
    if (img.PATH) return String(img.PATH).replace(/\\/g, '/');
    return '';
  }

  function avatarUrl(p) {
    var list = p.DANH_SACH_HINH_ANH_DAI_DIEN;
    if (!list || !list.length) return cfg.defaultImg;
    var rel = relativeImagePathFromImg(list[0]);
    if (!rel) return cfg.defaultImg;
    var upd = (window.wwStorefrontImage && window.wwStorefrontImage.pickUpdTime)
      ? window.wwStorefrontImage.pickUpdTime(p, list[0])
      : (p.UPD_DT || '');
    return joinAppUrl(rel, upd);
  }

  function hoverUrl(p) {
    var list = p.DANH_SACH_HINH_ANH;
    if (!list || !list.length) return '';
    var rel = relativeImagePathFromImg(list[0]);
    if (!rel) return '';
    var upd = (window.wwStorefrontImage && window.wwStorefrontImage.pickUpdTime)
      ? window.wwStorefrontImage.pickUpdTime(p, list[0])
      : (p.UPD_DT || '');
    return joinAppUrl(rel, upd);
  }

  function relativeImagePath(p) {
    var list = p.DANH_SACH_HINH_ANH_DAI_DIEN;
    if (!list || !list.length) return '';
    return relativeImagePathFromImg(list[0]);
  }

  function detailUrl(p) {
    var slug = (p.TEN_SAN_PHAM_SLUG && String(p.TEN_SAN_PHAM_SLUG).trim()) || 'sp';
    return cfg.appUrl + cfg.detailPath + '/' + slug + '-' + p.ID;
  }

  function prefetchPath(fullUrl) {
    try {
      return new URL(fullUrl, window.location.origin).pathname || '';
    } catch (e) {
      return '';
    }
  }

  function csrfField() {
    var m = document.querySelector('meta[name="csrf-token"]');
    if (!m || !m.content) return '';
    return '<input type="hidden" name="_token" value="' + escapeHtml(m.content) + '">';
  }

  function buildCardHtml(p) {
    var title = p.TEN_SAN_PHAM || 'Sản phẩm';
    var href = detailUrl(p);
    var pref = prefetchPath(href);
    var imgRel = relativeImagePath(p);
    var priceInt = Math.round(Number(p.GIA_CA) || 0);
    var priceLabel = formatPriceShortVnd(priceInt);
    var compareInt = Math.round(Number(p.GIA_GOC) || 0);
    var discountPct = 0;
    var showCompare = priceInt > 0 && compareInt > priceInt;
    if (showCompare) {
      discountPct = Math.min(99, Math.max(1, Math.round((1 - priceInt / compareInt) * 100)));
    }
    var compareLabel = showCompare ? formatPriceShortVnd(compareInt) : '';
    var hov = hoverUrl(p);
    var hasHover = hov !== '';
    var imgMainClass =
      'card-product__image max-h-full w-auto object-contain scale-[var(--image-scale)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition duration-300 ease-out' +
      (hasHover ? ' group-hover/card:opacity-0' : '');

    var priceBlock = '';
    if (priceInt <= 0) {
      priceBlock =
        '<div class="flex flex-col gap-0.5">' +
        '<span class="price text-h6 font-semibold leading-tight text-neutral-500">Liên hệ</span>' +
        '</div>';
    } else {
      priceBlock =
        '<div class="flex flex-col gap-1 min-w-0">' +
        '<div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5 min-w-0">' +
        '<span class="price text-h6 font-semibold leading-tight text-rose-600">' + escapeHtml(priceLabel) + '</span>' +
        '</div>';
      if (showCompare) {
        priceBlock +=
          '<div class="flex items-baseline gap-2 min-w-0">' +
          '<span class="compare-price price--struck line-through text-sm font-medium leading-snug text-neutral-400 decoration-neutral-300/80">' +
          escapeHtml(compareLabel) +
          '</span></div>';
      }
      priceBlock += '</div>';
    }

    var hoverPictures = hasHover
      ? '<picture><source media="(max-width: 600px)" srcset="' +
        escapeHtml(hov) +
        '"><img class="card-product__image-2 max-h-full w-auto object-contain opacity-0 scale-[var(--image-scale)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[0] group-hover/card:opacity-100 transition duration-300 ease-out" width="480" height="480" loading="lazy" style="--image-scale:0.9" src="' +
        escapeHtml(hov) +
        '" alt="' +
        escapeHtml(title) +
        '"></picture>'
      : '';

    return (
      '<card-product class="h-full card-product--vertical ww-card-opens-qv" data-product-id="' +
      escapeHtml(p.ID) +
      '" data-prefetch="' +
      escapeHtml(pref) +
      '">' +
      '<div class="item_product_main card-product relative transition-transform duration-200 ease-in-out h-full">' +
      '<form action="/cart/add" method="post" data-id="product-actions-' +
      escapeHtml(p.ID) +
      '" enctype="multipart/form-data" class="bg-background relative z-10 m-0 h-full" style="border: 1px solid rgba(2, 132, 199, 0.18);">' +
      csrfField() +
      '<input type="hidden" name="product_title" value="' +
      escapeHtml(title) +
      '">' +
      '<input type="hidden" name="product_handle" value="' +
      escapeHtml(p.TEN_SAN_PHAM_SLUG || '') +
      '">' +
      '<input type="hidden" name="price" value="' +
      escapeHtml(priceInt) +
      '">' +
      '<input type="hidden" name="image" value="' +
      escapeHtml(imgRel) +
      '">' +
      '<input type="hidden" name="category_id" value="' +
      escapeHtml((p.DANH_MUC_SAN_PHAM && p.DANH_MUC_SAN_PHAM.ID) || '') +
      '">' +
      '<div class="card-product__top relative overflow-visible group/card p-2">' +
      '<div class="sapo-combo-badge" data-id="' +
      escapeHtml(p.ID) +
      '"></div>' +
      '<a class="link aspect-square flex items-center justify-center w-full relative overflow-hidden" href="' +
      escapeHtml(href) +
      '" title="' +
      escapeHtml(title) +
      '">' +
      '<div class="card-product__badges absolute top-2 left-2 z-10 flex items-center gap-2"></div>' +
      '<img class="product-frame w-full object-contain absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10" src="' +
      escapeHtml(cfg.frameSrc) +
      '" alt="" loading="lazy" width="480" height="480">' +
      '<picture><source media="(max-width: 600px)" srcset="' +
      escapeHtml(avatarUrl(p)) +
      '">' +
      '<img class="' +
      imgMainClass +
      '" width="480" height="480" decoding="async" loading="lazy" style="--image-scale:0.9" src="' +
      escapeHtml(avatarUrl(p)) +
      '" alt="' +
      escapeHtml(title) +
      '"></picture>' +
      hoverPictures +
      '</a>' +
      '</div>' +
      '<div class="card-product__body flex flex-col gap-2 px-2 pb-2 md:gap-1 md:px-2 md:pb-2">' +
      '<a class="link block" href="' +
      escapeHtml(href) +
      '" title="' +
      escapeHtml(title) +
      '">' +
      '<div class="card-product__title text-base line-clamp-3">' +
      escapeHtml(title) +
      '</div>' +
      '<div class="sapo-product-reviews-badge" data-id="' +
      escapeHtml(p.ID) +
      '"></div>' +
      '</a>' +
      '<div class="card-product__price-row flex justify-between items-center gap-3 w-full min-w-0">' +
      '<a class="link flex-1 min-w-0" href="' +
      escapeHtml(href) +
      '" title="' +
      escapeHtml(title) +
      '">' +
      '<div class="price-box flex-1 min-w-0">' +
      priceBlock +
      '</div></a>' +
      '<div class="card-product__price-actions shrink-0 flex flex-col items-center gap-1">' +
      '<div class="card-product__cart-btn">' +
      '<input type="hidden" name="variantId" value="' +
      escapeHtml(p.ID) +
      '">' +
      '<button type="button" class="btn bg-relative addtocart-btn font-semibold add_to_cart flex justify-center items-center gap-3" data-variant-id="' +
      escapeHtml(p.ID) +
      '" data-product="' +
      escapeHtml(pref) +
      '" data-action="addtocart" aria-label="Thêm vào giỏ">' +
      '<span class="loading-icon gap-1 hidden items-center justify-center">' +
      '<span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>' +
      '<span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>' +
      '<span class="w-1.5 h-1.5 bg-[currentColor] rounded-full animate-pulse"></span>' +
      '</span><span class="flex items-center justify-center"><i class="icon icon-cart text-[1.35rem]"></i></span></button></div>' +
      (showCompare && discountPct > 0
        ? '<span class="badge sale-badge flashsale-discount-badge rounded-full">-' + discountPct + '%</span>'
        : '') +
      '</div></div></div></form></div></card-product>'
    );
  }

  function buildSkeletonHtml(count) {
    var n = Math.max(1, Math.round(Number(count)) || 10);
    var html = '';
    for (var i = 0; i < n; i++) {
      html +=
        '<div class="skeleton__product-grid__item bg-background border border-neutral-50 relative z-10 m-0 h-full">' +
        '<div class="skeleton__product-grid__item__image aspect-square bg-neutral-50 animate-pulse"></div>' +
        '<div class="skeleton__product-grid__item__body p-2 md:p-4 space-y-2">' +
        '<div class="skeleton__product-grid__item__title w-full h-4 bg-neutral-50 animate-pulse"></div>' +
        '<div class="skeleton__product-grid__item__price w-1/3 h-4 bg-neutral-50 animate-pulse"></div>' +
        '</div></div>';
    }
    return html;
  }

  function updateClearPriceButton() {
    var btn = document.getElementById('ww-search-price-clear');
    if (!btn) return;
    var hasChecked = document.querySelectorAll('.ww-search-price-checkbox:checked').length > 0;
    btn.hidden = !hasChecked;
  }

  function clearPriceFilters() {
    document.querySelectorAll('.ww-search-price-checkbox:checked').forEach(function (el) {
      el.checked = false;
    });
    updateClearPriceButton();
    loadSearchResults(1);
  }

  function getSelectedGiaFromDom() {
    var ids = [];
    document.querySelectorAll('.ww-search-price-checkbox:checked').forEach(function (el) {
      if (el.value) ids.push(el.value);
    });
    return ids;
  }

  function buildMucGiaParams(params) {
    var index = 0;
    document.querySelectorAll('.ww-search-price-checkbox:checked').forEach(function (el) {
      var min = el.getAttribute('data-min');
      var max = el.getAttribute('data-max');
      if (min !== null && min !== '') {
        params.append('MUC_GIA[' + index + '][MIN_VALUE]', min);
      }
      if (max !== null && max !== '') {
        params.append('MUC_GIA[' + index + '][MAX_VALUE]', max);
      }
      index++;
    });

    if (cfg.giaTu != null && cfg.giaTu !== '') {
      params.append('MUC_GIA[' + index + '][MIN_VALUE]', String(cfg.giaTu));
    }
    if (cfg.giaDen != null && cfg.giaDen !== '') {
      params.append('MUC_GIA[' + index + '][MAX_VALUE]', String(cfg.giaDen));
    }
  }

  function buildSearchPageUrl(page) {
    var basePath = (cfg.pageBasePath || '/tat-ca-san-pham').replace(/\/+$/, '');
    var parts = [];
    if (cfg.giaTu != null && cfg.giaTu !== '') {
      var maxPart = cfg.giaDen != null && cfg.giaDen !== '' ? String(cfg.giaDen) : 'up';
      parts.push('gia/' + String(cfg.giaTu) + '-' + maxPart);
    }
    if (cfg.selectedGia && cfg.selectedGia.length) {
      parts.push('muc-gia/' + encodeURIComponent(cfg.selectedGia.join('--')));
    }
    if (cfg.boLoc && cfg.boLoc !== 'default') {
      parts.push('sap-xep/' + encodeURIComponent(String(cfg.boLoc)));
    }
    if (cfg.productHot && String(basePath).indexOf('/danh-muc/') === 0) {
      parts.push('noi-bat');
    }
    if (page > 1) {
      parts.push('trang/' + String(page));
    }
    var path = parts.length ? basePath + '/' + parts.join('/') : basePath;
    return new URL(cfg.appUrl + path, window.location.origin);
  }

  function syncBrowserUrl(page) {
    var url = buildSearchPageUrl(page);
    window.history.replaceState({}, '', url.pathname);
  }

  function renderPagination(totalPages, currentPage) {
    var nav = document.getElementById(cfg.paginationId);
    if (!nav) return;
    // Danh sách sản phẩm: không phân trang
    if (cfg.noPagination) {
      nav.innerHTML = '';
      nav.setAttribute('hidden', 'hidden');
      return;
    }
    if (!totalPages || totalPages <= 1) {
      nav.innerHTML = '';
      return;
    }

    var html = '';
    for (var p = 1; p <= totalPages; p++) {
      var pageUrl = buildSearchPageUrl(p);
      html +=
        '<a href="' +
        escapeHtml(pageUrl.pathname) +
        '" data-page="' +
        p +
        '" class="ww-search-page-btn btn px-3 py-1.5 rounded-sm border border-neutral-50 text-sm font-semibold ' +
        (p === currentPage ? 'bg-primary text-white border-primary' : 'hover:bg-neutral-50') +
        '">' +
        p +
        '</a>';
    }
    nav.innerHTML = html;

    nav.querySelectorAll('.ww-search-page-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var page = parseInt(btn.getAttribute('data-page'), 10) || 1;
        loadSearchResults(page);
      });
    });
  }

  function updateTotalCount(total) {
    var el = document.getElementById('search-total-count');
    if (!el) return;
    el.textContent = formatIntViDots(total);
  }

  function loadSearchResults(page) {
    cfg.page = cfg.noPagination ? 1 : page || 1;
    cfg.selectedGia = getSelectedGiaFromDom();

    var el = document.getElementById(cfg.containerId);
    if (el) el.innerHTML = buildSkeletonHtml(cfg.skeletonCount || cfg.perPage || 20);

    var params = new URLSearchParams();
    params.set('PAGE', '1');
    if (cfg.noPagination) {
      params.set('IS_GET_ALL_ELEMENTS', 'true');
      params.set('PER_PAGE', '9999');
    } else {
      params.set('PAGE', String(cfg.page));
      params.set('PER_PAGE', String(cfg.perPage));
    }
    params.set('BO_LOC', cfg.boLoc || 'default');
    params.set('TRANG_THAI_HOAT_DONG', 'true');
    params.set('IS_API_PUBLIC', 'true');
    if (cfg.query) params.set('TU_KHOA', cfg.query);
    if (cfg.categoryId) params.append('DANH_MUC_SAN_PHAM_ID[]', String(cfg.categoryId));
    if (cfg.productHot) params.set('PRODUCT_HOT', 'true');
    if (cfg.productVip) params.set('PRODUCT_VIP', 'true');
    buildMucGiaParams(params);

    fetch(cfg.apiUrl + '?' + params.toString(), {
      method: 'GET',
      headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
    })
      .then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function (data) {
        if (!el) return;
        var pagination = (data && data.DATAS && data.DATAS.PRODUCT) || {};
        var rows = pagination.DATA || [];
        var totalPages = Number(pagination.TOTAL_PAGE) || 0;
        var totalItems = Number(pagination.TOTAL_ITEM) || 0;
        var currentPage = Number(pagination.CURRENT_PAGE) || cfg.page;

        updateTotalCount(totalItems);
        renderPagination(cfg.noPagination ? 1 : totalPages, cfg.noPagination ? 1 : currentPage);
        syncBrowserUrl(cfg.noPagination ? 1 : currentPage);

        if (!rows.length) {
          el.innerHTML = '<p class="col-span-full text-center text-sm text-slate-600 py-8">Không tìm thấy sản phẩm phù hợp.</p>';
          return;
        }

        var html = '';
        for (var i = 0; i < rows.length; i++) {
          html += buildCardHtml(rows[i]);
        }
        el.innerHTML = html;
      })
      .catch(function () {
        if (el) {
          el.innerHTML = '<p class="col-span-full text-center text-sm text-slate-600 py-8">Không tải được kết quả tìm kiếm.</p>';
        }
      });
  }

  function setActiveSortTab(boLoc) {
    var tabs = document.querySelectorAll('#search-sort-tabs .tab-btn');
    tabs.forEach(function (tab) {
      var isActive = tab.getAttribute('data-bo-loc') === boLoc;
      tab.classList.toggle('active', isActive);
    });
  }

  document.querySelectorAll('#search-sort-tabs .tab-btn').forEach(function (tab) {
    tab.addEventListener('click', function (e) {
      e.preventDefault();
      var boLoc = tab.getAttribute('data-bo-loc') || 'default';
      cfg.boLoc = boLoc;
      setActiveSortTab(boLoc);
      loadSearchResults(1);
    });
  });

  function lockPageHorizontal() {
    try {
      document.documentElement.scrollLeft = 0;
      document.body.scrollLeft = 0;
      if (window.scrollX !== 0) window.scrollTo(0, window.scrollY);
      [
        'main',
        '.index-container',
        '.ww-search-layout',
        '.ww-search-filter-card',
        '.ww-search-filter-card__row',
        '.section-main-search',
      ].forEach(function (sel) {
        document.querySelectorAll(sel).forEach(function (node) {
          if (node && node.scrollLeft) node.scrollLeft = 0;
        });
      });
    } catch (err) {
      /* ignore */
    }
  }

  function keepChipInHorizontalStrip(strip, el) {
    if (!strip || !el) return;
    var stripRect = strip.getBoundingClientRect();
    var elRect = el.getBoundingClientRect();
    if (elRect.right > stripRect.right) {
      strip.scrollLeft += elRect.right - stripRect.right + 12;
    } else if (elRect.left < stripRect.left) {
      strip.scrollLeft -= stripRect.left - elRect.left + 12;
    }
    lockPageHorizontal();
    requestAnimationFrame(lockPageHorizontal);
    setTimeout(lockPageHorizontal, 50);
    setTimeout(lockPageHorizontal, 200);
  }

  document.querySelectorAll('.ww-search-price-checkbox').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      updateClearPriceButton();
      cfg.selectedGia = getSelectedGiaFromDom();
      var strip = checkbox.closest('.ww-search-price-filters--inline');
      var chip = checkbox.closest('li') || checkbox.closest('label');
      keepChipInHorizontalStrip(strip, chip);
      try {
        checkbox.blur();
      } catch (err) {
        /* ignore */
      }
      lockPageHorizontal();
      loadSearchResults(1);
      lockPageHorizontal();
    });
    checkbox.addEventListener('focus', function () {
      var strip = checkbox.closest('.ww-search-price-filters--inline');
      var chip = checkbox.closest('li') || checkbox.closest('label');
      keepChipInHorizontalStrip(strip, chip);
    });
    checkbox.addEventListener('click', function () {
      var strip = checkbox.closest('.ww-search-price-filters--inline');
      var chip = checkbox.closest('li') || checkbox.closest('label');
      keepChipInHorizontalStrip(strip, chip);
    });
  });

  document.querySelectorAll('#search-sort-tabs .tab-btn').forEach(function (tab) {
    tab.addEventListener('focus', function () {
      var strip = tab.closest('.heading-tabs--scroll') || document.getElementById('search-sort-tabs');
      keepChipInHorizontalStrip(strip, tab);
    });
    tab.addEventListener('click', function () {
      var strip = tab.closest('.heading-tabs--scroll') || document.getElementById('search-sort-tabs');
      keepChipInHorizontalStrip(strip, tab);
    });
  });

  window.addEventListener('scroll', lockPageHorizontal, { passive: true });
  window.addEventListener('resize', lockPageHorizontal, { passive: true });
  document.addEventListener(
    'touchend',
    function (e) {
      if (e.target && e.target.closest && e.target.closest('.ww-search-price-filters--inline, #search-sort-tabs')) {
        lockPageHorizontal();
        setTimeout(lockPageHorizontal, 30);
      }
    },
    { passive: true }
  );

  var clearBtn = document.getElementById('ww-search-price-clear');
  if (clearBtn) {
    clearBtn.addEventListener('click', clearPriceFilters);
  }

  updateClearPriceButton();
  loadSearchResults(cfg.page);
})();
</script>
