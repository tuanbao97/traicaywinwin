<script>
(function () {
  var productId = {{ (int) $productId }};
  var cfg = {
    apiDetail: @json(url('/api/public/product/detail')),
    appUrl: @json(rtrim(url('/'), '/')),
    defaultImg: @json(asset('image/UI-BACKEND/default-image.png')),
  };

  document.body.classList.add('product-detail-loading');

  function markProductReady() {
    var form = document.getElementById('ww-pd-product-form');
    if (form) {
      form.classList.remove('is-loading');
      form.classList.add('is-ready');
    }
    document.body.classList.remove('product-detail-loading');
    var breadcrumbTitle = document.getElementById('ww-pd-breadcrumb-title');
    if (breadcrumbTitle) breadcrumbTitle.hidden = false;
  }

  function joinAppUrl(pathRel, updDt) {
    if (!pathRel) return '';
    var url = cfg.appUrl + '/' + String(pathRel).replace(/^\/+/, '');
    return (window.wwStorefrontImage && window.wwStorefrontImage.appendUpdTime)
      ? window.wwStorefrontImage.appendUpdTime(url, updDt)
      : url;
  }

  function relativeDisplayImagePathFromImg(img) {
    if (!img) return '';
    var fname = img.IMAGE_THUMNAIL || img.NAME || '';
    // Gallery / thumbnail: luôn dùng bản crop aspect ratio (mặc định 1x1)
    var ar = (img.ASPECT_RATIO && String(img.ASPECT_RATIO).trim()) || '1x1';
    if (img.DIRECTORY && fname) {
      return String(img.DIRECTORY).replace(/^\/+|\/+$/g, '') + '/' + ar + '_' + fname;
    }
    if (img.PATH) return String(img.PATH).replace(/\\/g, '/');
    return '';
  }

  /** Ảnh gốc (không prefix aspect ratio) — chỉ dùng khi mở modal / download */
  function relativeOriginalImagePathFromImg(img) {
    if (!img) return '';
    if (img.PATH) return String(img.PATH).replace(/\\/g, '/');
    var fname = img.IMAGE_THUMNAIL || img.NAME || '';
    if (!img.DIRECTORY || !fname) return '';
    return String(img.DIRECTORY).replace(/^\/+|\/+$/g, '') + '/' + fname;
  }

  function formatIntViDots(num) {
    var s = String(Math.floor(Math.abs(Number(num))));
    if (s.length <= 3) return s;
    return s.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function formatPriceShortVnd(amount) {
    var n = Math.round(Number(amount));
    if (!isFinite(n) || n <= 0) return 'Liên hệ';
    if (n < 1000) return String(n);
    return formatIntViDots(n) + ' ₫';
  }

  function collectImages(p) {
    var items = [];
    var seen = {};
    var productUpd = p && p.UPD_DT ? p.UPD_DT : '';
    function push(list) {
      if (!list) return;
      list.forEach(function (img) {
        var displayRel = relativeDisplayImagePathFromImg(img);
        var originalRel = relativeOriginalImagePathFromImg(img) || displayRel;
        if (!displayRel && !originalRel) return;
        var key = originalRel || displayRel;
        if (seen[key]) return;
        seen[key] = true;
        var upd = (window.wwStorefrontImage && window.wwStorefrontImage.pickUpdTime)
          ? window.wwStorefrontImage.pickUpdTime(p, img)
          : (productUpd || (img && img.UPD_DT) || '');
        items.push({
          display: joinAppUrl(displayRel || originalRel, upd),
          original: joinAppUrl(originalRel || displayRel, upd),
          displayRel: displayRel || originalRel,
          originalRel: originalRel || displayRel,
        });
      });
    }
    push(p.DANH_SACH_HINH_ANH_DAI_DIEN);
    push(p.DANH_SACH_HINH_ANH);
    if (!items.length) {
      items.push({
        display: cfg.defaultImg,
        original: cfg.defaultImg,
        displayRel: '',
        originalRel: '',
      });
    }
    return {
      items: items,
      urls: items.map(function (it) { return it.display; }),
      originals: items.map(function (it) { return it.original; }),
      rels: items.map(function (it) { return it.displayRel; }),
    };
  }

  function renderGallery(items, title) {
    var main = document.getElementById('ww-pd-gallery-main');
    var thumbs = document.getElementById('ww-pd-gallery-thumbs');
    if (!main || !thumbs) return;
    var mainHtml = '', thumbHtml = '';
    items.forEach(function (item, i) {
      var displayUrl = item.display || item;
      var originalUrl = item.original || displayUrl;
      mainHtml +=
        '<div class="embla__slide w-full grow-0 shrink-0 aspect-square flex items-center justify-center relative swiper-spotlight cursor-zoom-in" data-src="' + originalUrl + '" data-display-src="' + displayUrl + '" data-index="' + i + '">' +
        '<img class="object-contain rounded-lg scale-[var(--image-scale)] gallery-main-img" src="' + displayUrl + '" alt="' + title + '" style="--image-scale:1" loading="' + (i === 0 ? 'eager' : 'lazy') + '"></div>';
      thumbHtml +=
        '<div class="embla__slide aspect-square cursor-pointer grow-0 shrink-0 w-[6.1rem] md:w-[9rem]' + (i === 0 ? ' embla-thumbs__slide--selected' : '') + '">' +
        '<div class="flex items-center justify-center w-full h-full"><img class="object-contain w-auto" src="' + displayUrl + '" width="64" height="64" loading="lazy" alt=""></div></div>';
    });
    main.innerHTML = mainHtml;
    thumbs.innerHTML = thumbHtml;
    reinitMediaGallery();
  }

  function reinitMediaGallery() {
    function run() {
      var gallery = document.querySelector('#ww-pd-product-form media-gallery');
      if (!gallery || typeof gallery.init !== 'function') return false;
      gallery._waitHydrate = false;
      if (typeof gallery.destroyGallery === 'function') {
        gallery.destroyGallery();
      }
      gallery.init();
      if (typeof gallery.bindSpotlightClicks === 'function') {
        gallery.bindSpotlightClicks();
      }
      return true;
    }

    if (run()) return;

    var tries = 0;
    var timer = setInterval(function () {
      tries += 1;
      if (run() || tries > 40) clearInterval(timer);
    }, 100);
  }

  function imageSrc(img) {
    return (img && (img.currentSrc || img.src)) || '';
  }

  function isSpotlightReady() {
    return !!(window.Spotlight && typeof window.Spotlight.show === 'function');
  }

  function ensureSpotlightReady(done) {
    if (isSpotlightReady()) {
      done(true);
      return;
    }
    if (typeof window.loadDefer === 'function') window.loadDefer();
    var attempts = 0;
    var timer = setInterval(function () {
      attempts += 1;
      if (isSpotlightReady()) {
        clearInterval(timer);
        done(true);
      } else if (attempts > 80) {
        clearInterval(timer);
        done(false);
      }
    }, 100);
  }

  function openDescLightbox(slides, activeIndex) {
    var active = slides[activeIndex];
    var src = active && active.dataset.src;
    if (!src) return;

    ensureSpotlightReady(function (ok) {
      if (!ok || !isSpotlightReady()) {
        window.open(src, '_blank');
        return;
      }
      var list = slides.map(function (s) {
        return { src: s.dataset.src };
      });
      // Giống gallery: show rồi goto (1-based)
      window.Spotlight.show(list, { download: true });
      window.Spotlight.goto(activeIndex + 1);
    });
  }

  /** Ảnh trong "Đặc điểm nổi bật" — click mở lightbox giống gallery */
  function isInlineEmojiImage(img) {
    if (!img) return false;
    var src = (img.currentSrc || img.src || '').toLowerCase();
    if (src.indexOf('emoji.php') !== -1 || src.indexOf('/emoji/') !== -1) return true;
    var w = parseInt(img.getAttribute('width') || '0', 10);
    var h = parseInt(img.getAttribute('height') || '0', 10);
    if ((w > 0 && w <= 32) || (h > 0 && h <= 32)) return true;
    if (img.naturalWidth > 0 && img.naturalWidth <= 32 && img.naturalHeight <= 32) return true;
    return false;
  }

  function bindDescImageSpotlight(root) {
    if (!root) return;

    // Preload Spotlight (vendors) sớm để click lần đầu đã mở được
    if (typeof window.loadDefer === 'function') window.loadDefer();

    var slides = [];
    root.querySelectorAll('img').forEach(function (img) {
      // Không bọc emoji Facebook/icon nhỏ — tránh xuống dòng
      if (isInlineEmojiImage(img)) return;

      var src = imageSrc(img);
      if (!src || src.indexOf('default-image') !== -1) return;

      var wrap = img.closest('.swiper-spotlight');
      if (!wrap) {
        wrap = document.createElement('span');
        wrap.className = 'swiper-spotlight cursor-zoom-in ww-pd-desc-spotlight';
        wrap.style.display = 'block';
        wrap.style.maxWidth = '100%';
        wrap.style.cursor = 'zoom-in';
        if (img.parentNode) {
          img.parentNode.insertBefore(wrap, img);
          wrap.appendChild(img);
        }
      }
      wrap.dataset.src = src;
      slides.push(wrap);
    });

    slides.forEach(function (el, idx) {
      el.dataset.index = String(idx);
      if (el.dataset.spotlightBound === '1') return;
      el.dataset.spotlightBound = '1';
      el.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        openDescLightbox(slides, idx);
      });
    });

    // Nội dung đổi chiều cao → re-init expandable
    var expandable = root.closest('expandable-content');
    if (expandable && typeof expandable.init === 'function') {
      setTimeout(function () {
        expandable.init();
      }, 50);
    }
  }

  function escapeAttr(str) {
    return String(str || '')
      .replace(/&/g, '&amp;')
      .replace(/"/g, '&quot;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;');
  }

  function renderAttachments(files) {
    var wrap = document.getElementById('ww-pd-attachments');
    var list = document.getElementById('ww-pd-attachments-list');
    if (!wrap || !list) return;

    list.innerHTML = '';
    if (!Array.isArray(files) || files.length === 0) {
      wrap.hidden = true;
      return;
    }

    var html = '';
    files.forEach(function (file) {
      if (!file) return;
      var name = file.ORIGINAL_NAME || file.NAME || 'Tải file';
      var path = file.PATH || '';
      if (!path && file.DIRECTORY && file.NAME) {
        path = String(file.DIRECTORY).replace(/^\/+|\/+$/g, '') + '/' + file.NAME;
      }
      if (!path) return;
      var url = joinAppUrl(path, file.UPD_DT || null);
      html +=
        '<li>' +
          '<a href="' + escapeAttr(url) + '" class="ww-pd-attachment-link" target="_blank" rel="noopener noreferrer" download>' +
            '<i class="icon icon-stickynote" aria-hidden="true"></i>' +
            '<span>' + escapeAttr(name) + '</span>' +
          '</a>' +
        '</li>';
    });

    if (!html) {
      wrap.hidden = true;
      return;
    }
    list.innerHTML = html;
    wrap.hidden = false;
  }

  function renderProduct(p) {
    var title = p.TEN_SAN_PHAM || 'Sản phẩm';
    var priceInt = Math.round(Number(p.GIA_CA) || 0);
    var slug = (p.TEN_SAN_PHAM_SLUG && String(p.TEN_SAN_PHAM_SLUG).trim()) || 'sp';
    var imgs = collectImages(p);

    document.title = title + ' — Win Win';
    var metaDesc = document.getElementById('ww-meta-description');
    if (metaDesc) metaDesc.setAttribute('content', (p.MO_TA_NGAN || title).substring(0, 160));

    var setText = function (id, text) {
      var el = document.getElementById(id);
      if (el) el.textContent = text;
    };
    setText('ww-page-title', title + ' — Win Win');
    setText('ww-pd-breadcrumb-title', title);
    setText('ww-pd-title', title);
    setText('ww-pd-price', formatPriceShortVnd(priceInt));

    var isSold = String(p.TRANG_THAI || '').toUpperCase() === 'SOLD';
    var metaWrap = document.getElementById('ww-pd-meta');
    var skuEl = document.getElementById('ww-pd-sku');
    var stockWrap = document.getElementById('ww-pd-stock');
    var stockLabel = document.getElementById('ww-pd-stock-label');
    if (skuEl) {
      skuEl.textContent = String(p.MA_SAN_PHAM || p.ID || productId || '—');
    }
    if (stockWrap && stockLabel) {
      stockLabel.textContent = isSold ? 'Hết hàng' : 'Còn hàng';
      stockLabel.classList.toggle('text-error', isSold);
      stockLabel.classList.toggle('text-success', !isSold);
    }
    if (metaWrap) metaWrap.hidden = false;
    var soldOutBtn = document.getElementById('ww-pd-soldout');
    var cartForm = document.getElementById('add-to-cart-form');
    if (soldOutBtn) soldOutBtn.classList.toggle('hidden', !isSold);
    if (cartForm) cartForm.classList.toggle('hidden', isSold);

    var handleEl = document.getElementById('ww-pd-product-handle');
    if (handleEl) handleEl.value = slug;
    var titleInput = document.getElementById('ww-pd-product-title');
    if (titleInput) titleInput.value = title;
    var priceInput = document.getElementById('ww-pd-product-price');
    if (priceInput) priceInput.value = String(priceInt);
    var imgInput = document.getElementById('ww-pd-product-image');
    if (imgInput) imgInput.value = imgs.rels[0] || '';
    var variantInput = document.getElementById('ww-pd-variant-id');
    if (variantInput) variantInput.value = String(p.ID || productId);

    var compareEl = document.getElementById('ww-pd-compare');
    var badge = document.getElementById('ww-pd-badge');
    if (compareEl) {
      compareEl.hidden = true;
      compareEl.textContent = '';
    }
    if (badge) {
      badge.hidden = true;
      badge.textContent = '';
    }

    var compareInt = Math.round(Number(p.GIA_GOC) || 0);
    if (priceInt > 0 && compareInt > priceInt) {
      if (compareEl) {
        compareEl.textContent = formatPriceShortVnd(compareInt);
        compareEl.hidden = false;
      }
      if (badge) {
        var pct = Math.min(99, Math.max(1, Math.round((1 - priceInt / compareInt) * 100)));
        badge.textContent = '-' + pct + '%';
        badge.hidden = false;
      }
    }

    renderGallery(imgs.items, title);

    var desc = p.MO_TA_CHI_TIET || p.MO_TA_NGAN || '';
    var descEl = document.getElementById('ww-pd-desc');
    if (descEl && desc) {
      descEl.innerHTML = desc;
      bindDescImageSpotlight(descEl);
    }

    renderAttachments(p.DANH_SACH_FILE_DINH_KEM);

    var jsonEl = document.getElementById('ww-pd-product-json');
    if (jsonEl) {
      jsonEl.textContent = JSON.stringify({
        id: p.ID,
        name: title,
        alias: slug,
        price: priceInt,
        available: !isSold,
        status: p.TRANG_THAI || 'USING',
        images: imgs.items.map(function (it) {
          return { src: it.display, original: it.original };
        }),
      });
    }

    var cat = p.DANH_MUC_SAN_PHAM;
    var categoryId = cat && cat.ID ? Number(cat.ID) : 0;
    var categoryName = cat && cat.TEN_DANH_MUC_SAN_PHAM ? String(cat.TEN_DANH_MUC_SAN_PHAM) : '';
    var categoryInput = document.getElementById('ww-pd-product-category-id');
    if (categoryInput) categoryInput.value = categoryId ? String(categoryId) : '';
    window.__wwCurrentProduct = {
      id: Number(p.ID || productId),
      categoryId: categoryId,
      categoryName: categoryName,
    };
    document.dispatchEvent(
      new CustomEvent('ww:product-hydrated', { detail: window.__wwCurrentProduct })
    );

    if (window.EGATheme && window.EGATheme.publish && window.themeConfigs) {
      window.EGATheme.publish(window.themeConfigs.productLoaded);
    }

    markProductReady();
  }

  fetch(cfg.apiDetail + '/' + productId, {
    headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
    credentials: 'same-origin',
  })
    .then(function (r) {
      if (!r.ok) throw new Error('404');
      return r.json();
    })
    .then(function (res) {
      var p = res && res.DATAS && res.DATAS.PRODUCT;
      if (!p) throw new Error('empty');
      renderProduct(p);
    })
    .catch(function (err) {
      console.error(err);
      markProductReady();
    });
})();
</script>
