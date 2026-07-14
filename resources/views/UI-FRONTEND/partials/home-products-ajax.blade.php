<script>
(function () {
  var cfg = {
    apiUrl: @json(url('/api/public/product/list')),
    categoryUrl: @json(url('/api/public/categoryp/list/tree')),
    /** Gốc ứng dụng (có subpath nếu chạy trong thư mục) — dùng cho ảnh để không bị <base href=".../UI-FRONTEND/"> làm sai đường dẫn */
    appUrl: @json(rtrim(url('/'), '/')),
    defaultImg: @json(asset('image/UI-BACKEND/default-image.png')),
    /** Trang chi tiết storefront UI-FRONTEND (không dùng /admin) */
    detailPath: '/san-pham/chi-tiet',
    frameSrc: @json(asset('UI-FRONTEND/images/Khung vien xanh.png')),
  };

  function joinAppUrl(pathRel, updDt) {
    if (!pathRel) return '';
    var p = String(pathRel).replace(/^\/+/, '');
    var url = cfg.appUrl + '/' + p;
    return (window.wwStorefrontImage && window.wwStorefrontImage.appendUpdTime)
      ? window.wwStorefrontImage.appendUpdTime(url, updDt)
      : url;
  }

  function storageFileName(img) {
    if (!img) return '';
    return img.IMAGE_THUMNAIL || img.NAME || '';
  }

  function escapeHtml(s) {
    if (s == null) return '';
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  /** Chèn dấu . phân tách hàng nghìn khi phần số có hơn 3 chữ số */
  function formatIntViDots(num) {
    var s = String(Math.floor(Math.abs(Number(num))));
    if (s.length <= 3) return s;
    return s.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  /** Hiển thị giá tiền đầy đủ: 120000 → 120.000 ₫ */
  function formatPriceShortVnd(amount) {
    var n = Math.round(Number(amount));
    if (!isFinite(n) || n <= 0) return '0';
    if (n < 1000) return String(n);
    return formatIntViDots(n) + ' ₫';
  }

  function relativeImagePathFromImg(img) {
    if (!img) return '';
    var fname = storageFileName(img);
    // Thumbnail card: ưu tiên bản crop theo aspect_ratio (vd 1x1_file.jpg)
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

  function quickViewBtnHtml(productId) {
    return (
      '<button type="button" class="ww-quick-view-btn absolute left-1/2 top-1/2 z-[50] w-[4.2rem] h-[4.2rem] rounded-full bg-white/95 text-foreground shadow-l border border-neutral-50 flex items-center justify-center transition-all duration-200" data-product-id="' +
      escapeHtml(productId) +
      '" aria-label="Xem nhanh" onclick="return window.wwQuickViewClick && window.wwQuickViewClick(event, this);" onmousedown="event.preventDefault();event.stopPropagation();">' +
      '<i class="icon icon-eye text-[2rem] pointer-events-none"></i>' +
      '<span class="ww-quick-view-tooltip absolute left-1/2 bottom-full mb-2 whitespace-nowrap rounded bg-white px-3 py-1.5 text-sm font-medium text-foreground shadow border border-neutral-50 pointer-events-none">Xem nhanh</span>' +
      '</button>'
    );
  }

  function buildCardHtml(p, opts) {
    var wrapFlash = opts && opts.wrapFlash;
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
    var imgMainClass = 'card-product__image max-h-full w-auto object-contain scale-[var(--image-scale)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition duration-300 ease-out' + (hasHover ? ' group-hover/card:opacity-0' : '');

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

    var hoverPictures = '';
    if (hasHover) {
      hoverPictures =
        '<picture><source media="(max-width: 600px)" srcset="' + escapeHtml(hov) + '">' +
        '<img class="card-product__image-2 max-h-full w-auto object-contain opacity-0 scale-[var(--image-scale)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[0] group-hover/card:opacity-1 group-hover/card:z-[1] group-hover/card:opacity-100 transition duration-300 ease-out" width="480" height="480" loading="lazy" style="--image-scale:0.9" src="' +
        escapeHtml(hov) +
        '" alt="' +
        escapeHtml(title) +
        '"></picture>';
    }

    // Tắt stock-countdown (flash sale bar)
    // var stockRow = wrapFlash
    //   ? '<stock-countdown class="stock-countdown" data-id="section-flashsale-0" data-product-id="' +
    //     escapeHtml(p.ID) +
    //     '" data-type="tag" data-max-qty="" data-real-qty="0" data-available="true"></stock-countdown>'
    //   : '';
    var stockRow = '';

    // Background bên trong card (chỉ section bên dưới, không đổi flash sale)
    // Gradient xanh blue nhẹ -> trắng
    var cardInnerStyle = wrapFlash
      ? ''
      : 'border: 1px solid rgba(2, 132, 199, 0.18);"';

    var inner =
      '<card-product class="h-full card-product--vertical" data-prefetch="' +
      escapeHtml(pref) +
      '">' +
      '<div class=" item_product_main card-product relative transition-transform duration-200 ease-in-out  h-full h-full">' +
      '<form action="/cart/add" method="post" data-id="product-actions-' +
      escapeHtml(p.ID) +
      '" enctype="multipart/form-data" class="bg-background relative z-10 m-0   h-full"' +
      cardInnerStyle +
      '>' +
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
      '<img class="product-frame w-full  object-contain absolute  top-1/2 left-1/2   -translate-x-1/2 -translate-y-1/2 z-10" src="' +
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
      quickViewBtnHtml(p.ID) +
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
      '</div>' +
      '</a>' +
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
      '</div></div>' +
      stockRow +
      '</div></form></div></card-product>';

    if (wrapFlash) {
      return (
        '<div class="relative h-inherit flashsale__item embla__slide w-[65.5%]  md:w-1/3 lg:w-1/5 flex-shrink-0 flex-grow-0 pl-2">' +
        inner +
        '</div>'
      );
    }
    return inner;
  }

  function buildProductGridSkeletonItemHtml() {
    return (
      '<div class="skeleton__product-grid__item bg-background border border-neutral-50 relative z-10 m-0   h-full ">' +
      '<div class="skeleton__product-grid__item__image aspect-square bg-neutral-50 animate-pulse "></div>' +
      '<div class="skeleton__product-grid__item__body p-2 md:p-4 space-y-2">' +
      '<div class="skeleton__product-grid__item__title w-full h-4 bg-neutral-50 animate-pulse "></div>' +
      '<div class="skeleton__product-grid__item__price w-1/3 h-4 bg-neutral-50 animate-pulse "></div>' +
      '</div></div>'
    );
  }

  /** Skeleton khi đang fetch API sản phẩm */
  function buildProductGridSkeletonHtml(count, wrapFlash) {
    var n = Math.max(1, Math.round(Number(count)) || 10);
    var html = '';
    for (var i = 0; i < n; i++) {
      if (wrapFlash) {
        html +=
          '<div class="relative h-inherit flashsale__item embla__slide w-[65.5%] md:w-1/3 lg:w-1/5 flex-shrink-0 flex-grow-0 pl-2">' +
          buildProductGridSkeletonItemHtml() +
          '</div>';
      } else {
        html += buildProductGridSkeletonItemHtml();
      }
    }
    return html;
  }

  function getFlashSectionEl() {
    return document.getElementById('section-flashsale-0');
  }

  function getCategorySectionEl(catId) {
    if (!catId) return null;
    return document.querySelector(
      'section.section-home-category-products[data-home-category-id="' + String(catId) + '"]'
    );
  }

  function hideHomeBlock(el) {
    if (!el) return;
    el.style.display = 'none';
    el.setAttribute('hidden', '');
    el.setAttribute('aria-hidden', 'true');
  }

  function showHomeBlock(el) {
    if (!el) return;
    el.style.display = '';
    el.removeAttribute('hidden');
    el.removeAttribute('aria-hidden');
  }

  var homeProductsSkeletonHidden = false;
  function hideHomeProductsSkeleton() {
    if (homeProductsSkeletonHidden) return;
    homeProductsSkeletonHidden = true;
    var sk = document.getElementById('ww-home-products-skeleton');
    if (!sk) return;
    hideHomeBlock(sk);
    sk.setAttribute('aria-busy', 'false');
  }

  function buildEmptyProductsHtml() {
    return '<p class="col-span-full text-center text-sm text-slate-600 py-8">Không tìm thấy sản phẩm phù hợp.</p>';
  }

  function isHomeBlockVisible(el) {
    return !!(el && !el.hasAttribute('hidden') && el.style.display !== 'none');
  }

  /** Theo dõi load tab theo danh mục — ẩn cả section nếu mọi tab đều trống */
  var categoryLoadState = {};

  function beginCategoryLoads(catId, total) {
    if (!catId) return;
    categoryLoadState[String(catId)] = { pending: total, hasProducts: false };
  }

  function noteCategoryLoadResult(catId, hasProducts) {
    var key = String(catId || '');
    var st = categoryLoadState[key];
    if (!st) return;
    if (hasProducts) st.hasProducts = true;
    st.pending = Math.max(0, st.pending - 1);
    var sectionEl = getCategorySectionEl(key);
    if (st.hasProducts) {
      hideHomeProductsSkeleton();
      // Chỉ hiện khi đã có sản phẩm (không hiện skeleton trống)
      if (!isHomeBlockVisible(sectionEl)) {
        showHomeBlock(sectionEl);
      }
      return;
    }
    if (st.pending <= 0 && !st.hasProducts) {
      hideHomeBlock(sectionEl);
      // Hết mọi tab của section này mà chưa có SP — nếu không còn section nào đang chờ thì ẩn skeleton
      var stillWaiting = false;
      Object.keys(categoryLoadState).forEach(function (k) {
        if (categoryLoadState[k] && categoryLoadState[k].pending > 0) stillWaiting = true;
      });
      if (!stillWaiting) {
        var anyVisible = !!document.querySelector(
          'section.section-home-category-products:not([hidden])'
        );
        if (!anyVisible) hideHomeProductsSkeleton();
      }
    }
  }

  function loadProducts(section, containerSelector, opts) {
    var el = document.querySelector(containerSelector);
    if (!el) return;

    var params = new URLSearchParams();
    params.set('PAGE', '1');
    var per = (opts && opts.perPage) || (section === 'flash' ? 12 : 10);
    el.innerHTML = buildProductGridSkeletonHtml(per, section === 'flash');

    params.set('PER_PAGE', String(per));
    params.set('BO_LOC', (opts && opts.boLoc) || 'moi-den-cu');
    if (section === 'flash') {
      params.set('PRODUCT_VIP', 'true');
    } else if (opts && opts.productVip) {
      params.set('PRODUCT_VIP', 'true');
    } else if (opts && opts.productHot) {
      params.set('PRODUCT_HOT', 'true');
    }
    if (opts && opts.categoryId) {
      params.append('DANH_MUC_SAN_PHAM_ID[]', String(opts.categoryId));
    }

    var categoryId = opts && opts.trackCategoryId != null ? opts.trackCategoryId : opts && opts.categoryId;

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
        if (!data || data.STATUS !== true || !data.DATAS || !data.DATAS.PRODUCT) {
          throw new Error((data && data.STATUS_DETAIL) || 'Phản hồi không hợp lệ');
        }
        var rows = data.DATAS.PRODUCT.DATA || [];
        if (!rows.length) {
          if (section === 'flash') {
            el.innerHTML = '';
            hideHomeBlock(getFlashSectionEl());
          } else {
            el.innerHTML = buildEmptyProductsHtml();
            if (categoryId) {
              noteCategoryLoadResult(categoryId, false);
            }
          }
          return;
        }
        var html = '';
        for (var i = 0; i < rows.length; i++) {
          html += buildCardHtml(rows[i], { wrapFlash: section === 'flash' });
        }
        el.innerHTML = html;
        if (section === 'flash') {
          showHomeBlock(getFlashSectionEl());
        } else if (categoryId) {
          noteCategoryLoadResult(categoryId, true);
        }
        window.dispatchEvent(new CustomEvent('home-product-cards-loaded', { detail: { section: section } }));
      })
      .catch(function () {
        if (section === 'flash') {
          el.innerHTML = '';
          hideHomeBlock(getFlashSectionEl());
        } else {
          el.innerHTML = buildEmptyProductsHtml();
          if (categoryId) {
            noteCategoryLoadResult(categoryId, false);
          }
        }
      });
  }

  function getCategoryChildren(cat) {
    var children = (cat && cat.DANH_SACH_CHILDREN) || [];
    if (!Array.isArray(children)) return [];
    return children
      .filter(function (c) {
        return c && c.ID && c.TRANG_THAI_HOAT_DONG !== false;
      })
      .slice()
      .sort(function (a, b) {
        var sa = a && a.SORT_ORDER != null ? Number(a.SORT_ORDER) : 0;
        var sb = b && b.SORT_ORDER != null ? Number(b.SORT_ORDER) : 0;
        return sa - sb;
      });
  }

  function hasChildCategoryTabs(cat) {
    // Chỉ section Giỏ quà trái cây dùng tab = menu con (+ hardcode mức giá)
    var name = ((cat && cat.TEN_DANH_MUC_SAN_PHAM) || '').toLowerCase();
    return Number(cat && cat.ID) === 1004 || name.indexOf('giỏ quà trái cây') !== -1;
  }

  /** Khoảng giá hardcode — liên tục: >= min và < max (max null = không giới hạn) */
  var gioQuaPriceRanges = @json(storefrontGioQuaPriceRanges());

  function buildGioQuaPriceSearchUrl(range) {
    var path = '/danh-muc/gio-qua-trai-cay-1004/gia/' + encodeURIComponent(String(range.min)) + '-' + (range.max != null ? encodeURIComponent(String(range.max)) : 'up');
    return cfg.appUrl + path;
  }

  function buildCategoryListUrl(cat, opts) {
    opts = opts || {};
    var cid = opts.categoryId != null ? opts.categoryId : cat && cat.ID;
    if (!cid) return cfg.appUrl + '/tat-ca-san-pham';
    var slug = (opts.slug || (cat && cat.TEN_DANH_MUC_SAN_PHAM_SLUG) || 'danh-muc').toString();
    var parts = ['/danh-muc/' + encodeURIComponent(slug + '-' + cid)];
    if (opts.boLoc && opts.boLoc !== 'default') {
      parts.push('sap-xep/' + encodeURIComponent(String(opts.boLoc)));
    }
    if (opts.productHot) {
      parts.push('noi-bat');
    }
    return cfg.appUrl + parts.join('/');
  }

  function buildFilterTabsHtml(cat, tabPrefix) {
    var defs = [
      { label: 'Nổi bật', boLoc: 'moi-den-cu' },
      { label: 'Giá tăng dần', boLoc: 'gia-tang' },
      { label: 'Giá giảm dần', boLoc: 'gia-giam' },
      { label: 'Tên từ A-Z', boLoc: 'a-z' },
      { label: 'Tên từ Z-A', boLoc: 'z-a' },
      { label: 'Tất cả', boLoc: 'default' },
    ];
    var html =
      '<ul class="heading-tabs heading-tabs--scroll mb-4 md:mb-6 w-full max-w-full overflow-x-auto list-none flex md:gap-3 gap-2 font-semibold whitespace-nowrap">';
    for (var i = 0; i < defs.length; i++) {
      var def = defs[i];
      var href = buildCategoryListUrl(cat, { boLoc: def.boLoc });
      html +=
        '<li aria-controls="' +
        tabPrefix +
        '-tab' +
        (i + 1) +
        '" data-ww-href="' +
        escapeHtml(href) +
        '" class="tab-btn cursor-pointer heading-tab px-5 py-2 bg-white rounded-pill text-secondary font-semibold hover:text-foreground' +
        (i === 0 ? ' active' : '') +
        ' inline-flex items-center md:gap-3 gap-2">' +
        escapeHtml(def.label) +
        '</li>';
    }
    html += '</ul>';
    return html;
  }

  function buildChildTabsHtml(cat, tabPrefix) {
    var children = getCategoryChildren(cat);
    var firstHref = buildCategoryListUrl(cat, { boLoc: 'moi-den-cu', productHot: true });
    var html =
      '<ul class="heading-tabs heading-tabs--scroll mb-4 md:mb-6 w-full max-w-full overflow-x-auto list-none flex md:gap-3 gap-2 font-semibold whitespace-nowrap">' +
      '<li aria-controls="' +
      tabPrefix +
      '-tab1" data-ww-href="' +
      escapeHtml(firstHref) +
      '" class="tab-btn cursor-pointer heading-tab px-5 py-2 bg-white rounded-pill text-secondary font-semibold hover:text-foreground active inline-flex items-center md:gap-3 gap-2">Nổi bật</li>';
    for (var i = 0; i < children.length; i++) {
      var child = children[i];
      var childTitle = child.TEN_DANH_MUC_SAN_PHAM || 'Danh mục';
      var childHref = buildCategoryListUrl(child, { boLoc: 'moi-den-cu' });
      html +=
        '<li aria-controls="' +
        tabPrefix +
        '-tab' +
        (i + 2) +
        '" data-ww-href="' +
        escapeHtml(childHref) +
        '" class="tab-btn cursor-pointer heading-tab px-5 py-2 bg-white rounded-pill text-secondary font-semibold hover:text-foreground inline-flex items-center md:gap-3 gap-2">' +
        escapeHtml(childTitle) +
        '</li>';
    }
    // Hardcode mức giá → trang tìm kiếm (khoảng giá liên tục)
    for (var p = 0; p < gioQuaPriceRanges.length; p++) {
      var range = gioQuaPriceRanges[p];
      var href = buildGioQuaPriceSearchUrl(range);
      html +=
        '<li class="heading-tab px-5 py-2 bg-white rounded-pill text-secondary font-semibold hover:text-foreground inline-flex items-center md:gap-3 gap-2">' +
        '<a class="link" href="' +
        escapeHtml(href) +
        '" title="' +
        escapeHtml(range.label) +
        '">' +
        escapeHtml(range.label) +
        '</a></li>';
    }
    html += '</ul>';
    return html;
  }

  function buildTabPanelsHtml(tabPrefix, baseGrid, tabCount, skHtml) {
    var html = '';
    for (var i = 1; i <= tabCount; i++) {
      html +=
        '<div class="tab-content' +
        (i === 1 ? '' : ' hidden') +
        '" id="' +
        tabPrefix +
        '-tab' +
        i +
        '">' +
        '<div class="product-list grid tab-content-inner grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mt-2" id="' +
        baseGrid +
        '-t' +
        i +
        '">' +
        skHtml +
        '</div></div>';
    }
    return html;
  }

  function buildCategorySectionHtml(cat, skeletonCount) {
    var sk = skeletonCount == null ? 10 : skeletonCount;
    var cid = cat && cat.ID ? String(cat.ID) : '0';
    var title = (cat && cat.TEN_DANH_MUC_SAN_PHAM) || 'Danh mục';
    var useChildTabs = hasChildCategoryTabs(cat);
    var children = useChildTabs ? getCategoryChildren(cat) : [];
    var defaultViewmoreHref = useChildTabs
      ? buildCategoryListUrl(cat, { boLoc: 'moi-den-cu', productHot: true })
      : buildCategoryListUrl(cat, { boLoc: 'moi-den-cu' });
    var titleHref = buildCategoryListUrl(cat);
    var baseGrid = 'home-category-products-' + cid;
    var tabPrefix = 'home-cat-' + cid;
    var skHtml = buildProductGridSkeletonHtml(sk, false);
    var tabsHtml = useChildTabs ? buildChildTabsHtml(cat, tabPrefix) : buildFilterTabsHtml(cat, tabPrefix);
    var panelsHtml = buildTabPanelsHtml(
      tabPrefix,
      baseGrid,
      useChildTabs ? Math.max(children.length + 1, 1) : 6,
      skHtml
    );

    return (
      '<section class="section section-home-category-products section-product-tabs" data-home-category-id="' +
      escapeHtml(cid) +
      '" hidden aria-hidden="true" style="display:none;--section-padding: 0;--section-margin: 24px 0 24px;--section-padding-mb: 0;--section-margin-mb: 24px 0 24px;">' +
      '<div class="container">' +
      '<div class="section-card">' +
      '<tabs-section data-type=".card-product--vertical">' +
      '<div>' +
      '<div class="flex justify-between items-center md:gap-3 flex-wrap">' +
      '<div class="heading-bar">' +
      '<h2 class="heading w-auto font-semibold">' +
      '<a class="link" href="' +
      escapeHtml(titleHref) +
      '" title="' +
      escapeHtml(title) +
      '">' +
      escapeHtml(title) +
      '</a>' +
      '</h2>' +
      '</div>' +
      tabsHtml +
      '</div>' +
      panelsHtml +
      '<a href="' +
      escapeHtml(defaultViewmoreHref) +
      '" title="Xem tất cả" class="btn tab-viewmore link text-primary items-center gap-1 flex w-auto rounded-sm justify-center mt-2 md:mt-6 font-semibold py-2.5 border-0">Xem tất cả <i class="icon icon-carret-right"></i></a>' +
      '</div>' +
      '</tabs-section>' +
      '</div>' +
      '</div>' +
      '</section>'
    );
  }

  function loadCategorySectionTabs(cat, perPage) {
    var catId = cat && cat.ID;
    if (!catId) return;
    var p = '#home-category-products-' + catId;
    var n = perPage == null ? 10 : perPage;

    if (hasChildCategoryTabs(cat)) {
      var children = getCategoryChildren(cat);
      beginCategoryLoads(catId, children.length + 1);
      // Tab 1 = Nổi bật (parent category)
      loadProducts('category', p + '-t1', {
        categoryId: catId,
        perPage: n,
        boLoc: 'moi-den-cu',
        productHot: true,
        trackCategoryId: catId,
      });
      for (var i = 0; i < children.length; i++) {
        loadProducts('category', p + '-t' + (i + 2), {
          categoryId: children[i].ID,
          perPage: n,
          boLoc: 'moi-den-cu',
          trackCategoryId: catId,
        });
      }
      return;
    }

    beginCategoryLoads(catId, 6);
    loadProducts('category', p + '-t1', { categoryId: catId, perPage: n, boLoc: 'moi-den-cu', trackCategoryId: catId });
    loadProducts('category', p + '-t2', { categoryId: catId, perPage: n, boLoc: 'gia-tang', trackCategoryId: catId });
    loadProducts('category', p + '-t3', { categoryId: catId, perPage: n, boLoc: 'gia-giam', trackCategoryId: catId });
    loadProducts('category', p + '-t4', { categoryId: catId, perPage: n, boLoc: 'a-z', trackCategoryId: catId });
    loadProducts('category', p + '-t5', { categoryId: catId, perPage: n, boLoc: 'z-a', trackCategoryId: catId });
    loadProducts('category', p + '-t6', { categoryId: catId, perPage: n, boLoc: 'default', trackCategoryId: catId });
  }

  function insertCategorySectionsAndLoad() {
    // Ưu anchor cố định (sau banner ngang) để không phụ thuộc section tĩnh đã xóa; fallback .section-product-tabs rồi main
    var anchor =
      document.getElementById('home-category-section-anchor') ||
      document.querySelector('.section-product-tabs');
    var mainEl = document.querySelector('main');
    if (!anchor && !mainEl) return;

    // Tránh chèn lặp
    if (document.getElementById('home-category-sections')) return;

    var wrapper = document.createElement('div');
    wrapper.id = 'home-category-sections';
    if (anchor && anchor.parentNode) {
      anchor.parentNode.insertBefore(wrapper, anchor.nextSibling);
    } else if (mainEl) {
      mainEl.appendChild(wrapper);
    }

    var catParams = new URLSearchParams();
    catParams.set('PAGE', '1');
    catParams.set('PER_PAGE', '999');
    catParams.set('IS_GET_ALL_ELEMENTS', 'true');

    fetch(cfg.categoryUrl + '?' + catParams.toString(), {
      method: 'GET',
      headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
    })
      .then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function (data) {
        var cats = (data && data.DATAS && data.DATAS.CATEGORY_P && data.DATAS.CATEGORY_P.DATA) || [];
        if (!cats || !cats.length) {
          hideHomeProductsSkeleton();
          return;
        }

        // Chỉ đổ section cho danh mục root (PARENT_ID = null)
        // Bỏ qua menu ngoài (Đồ chơi → dochoiwinwin.com) — không tạo section sản phẩm
        var roots = cats.filter(function (c) {
          if (!c || c.PARENT_ID != null) return false;
          var name = String(c.TEN_DANH_MUC_SAN_PHAM || c.NAME || '').replace(/\s+/g, ' ').trim();
          if (Number(c.ID) === 1009) return false;
          if (name === 'Đồ chơi trẻ em' || name === 'Đồ chơi') return false;
          var external = String(c.ATTR1 || '').trim();
          if (external.indexOf('http') === 0) return false;
          return true;
        });

        if (!roots.length) {
          hideHomeProductsSkeleton();
          return;
        }

        roots.sort(function (a, b) {
          var sa = a && a.SORT_ORDER != null ? Number(a.SORT_ORDER) : 0;
          var sb = b && b.SORT_ORDER != null ? Number(b.SORT_ORDER) : 0;
          return sa - sb;
        });

        for (var i = 0; i < roots.length; i++) {
          var c = roots[i];
          if (!c || !c.ID) continue;
          wrapper.insertAdjacentHTML('beforeend', buildCategorySectionHtml(c, 10));
          loadCategorySectionTabs(c, 10);
        }
      })
      .catch(function () {
        hideHomeProductsSkeleton();
      });
  }

  function run() {
    loadProducts('flash', '#home-flashsale-products');
    insertCategorySectionsAndLoad();

    // Cập nhật "Xem tất cả" theo tab đang chọn
    document.addEventListener(
      'click',
      function (e) {
        var tab = e.target && e.target.closest ? e.target.closest('.section-home-category-products .tab-btn[data-ww-href]') : null;
        if (!tab) return;
        var href = tab.getAttribute('data-ww-href');
        if (!href) return;
        var section = tab.closest('.section-home-category-products');
        var link = section && section.querySelector('a.tab-viewmore');
        if (link) {
          link.setAttribute('href', href);
        }
      },
      true
    );
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', run);
  } else {
    run();
  }
})();
</script>
