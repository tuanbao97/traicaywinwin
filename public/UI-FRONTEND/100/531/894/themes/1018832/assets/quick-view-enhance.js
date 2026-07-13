(function () {
  if (window.__wwQuickViewEnhanceLoaded) return;
  window.__wwQuickViewEnhanceLoaded = true;

  function themeApiUrl(path) {
    return typeof window.themeUrl === "function"
      ? window.themeUrl(path)
      : path.startsWith("/")
        ? path
        : "/" + path;
  }

  function escapeHtml(value) {
    return String(value == null ? "" : value)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");
  }

  function productIdFromCard(card) {
    const btn = card.querySelector(".ww-quick-view-btn[data-product-id]");
    if (btn && btn.dataset.productId) return parseInt(btn.dataset.productId, 10) || 0;
    const input = card.querySelector('input[name="variantId"]');
    if (input && input.value) return parseInt(input.value, 10) || 0;
    const form = card.querySelector("form[data-id]");
    const match = form && String(form.dataset.id || "").match(/(\d+)$/);
    return match ? parseInt(match[1], 10) || 0 : 0;
  }

  function quickViewBtnHtml(productId) {
    return (
      '<button type="button" class="ww-quick-view-btn absolute left-1/2 top-1/2 z-[50] w-[4.2rem] h-[4.2rem] rounded-full bg-white/95 text-foreground shadow-l border border-neutral-50 flex items-center justify-center transition-all duration-200" data-product-id="' +
      escapeHtml(productId) +
      '" aria-label="Xem nhanh" onclick="return window.wwQuickViewClick && window.wwQuickViewClick(event, this);" onmousedown="event.preventDefault();event.stopPropagation();">' +
      '<i class="icon icon-eye text-[2rem] pointer-events-none"></i>' +
      '<span class="ww-quick-view-tooltip absolute left-1/2 bottom-full mb-2 whitespace-nowrap rounded bg-white px-3 py-1.5 text-sm font-medium text-foreground shadow border border-neutral-50 pointer-events-none">Xem nhanh</span>' +
      "</button>"
    );
  }

  function ensureModalInBody() {
    const modal = document.getElementById("quick-view-product");
    if (modal && modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }
    return modal;
  }

  function hasActivePortal() {
    return !!document.querySelector(
      ".portal.active, quick-view.active, quick-view.ww-open, dialog.portal-dialog[open]"
    );
  }

  function forceCloseQuickViewDialog(modal) {
    if (!modal) return;
    const dialog = modal.querySelector("dialog");
    modal.classList.remove("active", "ww-open");
    if (!dialog) return;
    try {
      if (dialog.open && typeof dialog.close === "function") {
        dialog.close();
      }
    } catch (e) {
      /* ignore */
    }
    dialog.removeAttribute("open");
  }

  function unlockPageInteraction(force) {
    if (!force && hasActivePortal()) return;
    document.body.classList.remove("overflow-hidden");
    document.documentElement.classList.remove("overflow-hidden");
    document.body.style.removeProperty("overflow");
    document.documentElement.style.removeProperty("overflow");
  }

  window.__wwUnlockPageIfIdle = function () {
    // Bỏ qua portal đang đóng (không còn .active) nhưng dialog còn sót [open]
    document.querySelectorAll("quick-view").forEach(function (el) {
      if (!el.classList.contains("active") && !el.classList.contains("ww-open")) {
        forceCloseQuickViewDialog(el);
      }
    });
    document.querySelectorAll(".portal:not(.active) > dialog[open], .portal:not(.active) dialog.portal-dialog[open]").forEach(function (dialog) {
      try {
        if (dialog.open && typeof dialog.close === "function") dialog.close();
      } catch (e) {
        /* ignore */
      }
      dialog.removeAttribute("open");
    });
    unlockPageInteraction(false);
  };

  function releasePageInteraction() {
    const modal = document.getElementById("quick-view-product");
    forceCloseQuickViewDialog(modal);
    const otherBlocker = document.querySelector(
      ".portal.active:not(#quick-view-product), quick-view.active:not(#quick-view-product), quick-view.ww-open:not(#quick-view-product)"
    );
    if (!otherBlocker) {
      unlockPageInteraction(true);
    }
  }

  function resetQuickViewAnimation(modal) {
    if (!modal) return;
    modal.querySelectorAll(".animation").forEach(function (el) {
      el.classList.remove("scale-in-hor-left", "slide-in-bottom", "slide-in-left", "animating");
      el.style.transform = "";
      el.style.animation = "";
    });
  }

  function openModal() {
    const modal = ensureModalInBody();
    if (!modal) return;
    const dialog = modal.querySelector("dialog");
    const isMobile =
      (window.themeConfigs &&
        window.themeConfigs.mbBreakpoint &&
        window.themeConfigs.mbBreakpoint.matches) ||
      window.matchMedia("(max-width: 767px)").matches;

    resetQuickViewAnimation(modal);
    if (isMobile) {
      modal.dataset.animation = "slide-in-bottom";
    }

    modal.classList.add("active", "ww-open");
    document.body.classList.add("overflow-hidden");
    document.documentElement.classList.add("overflow-hidden");
    if (!dialog) return;
    dialog.setAttribute("open", "");
  }

  function closeModal() {
    const modal = document.getElementById("quick-view-product");
    if (!modal) return;
    modal.classList.remove("active", "ww-open");
    releasePageInteraction();
    if (document.activeElement && modal.contains(document.activeElement)) {
      document.activeElement.blur();
    }
  }

  function bindQuickViewPortalHooks() {
    const modal = document.getElementById("quick-view-product");
    if (!modal) return;

    // Re-bind sau khi <quick-view> được upgrade (product.js defer)
    const canWrapHide = typeof modal.hide === "function";
    if (modal.dataset.wwQvHideWrapped === "1" && canWrapHide) return;

    if (!modal.dataset.wwQvHooks) {
      modal.dataset.wwQvHooks = "1";
      modal.addEventListener("keyup", function (event) {
        if (event.code && event.code.toUpperCase() === "ESCAPE") {
          closeModal();
        }
      });
    }

    if (canWrapHide && modal.dataset.wwQvHideWrapped !== "1") {
      const nativeHide = modal.hide.bind(modal);
      modal.hide = function () {
        releasePageInteraction();
        modal.classList.remove("active", "ww-open");
        const result = nativeHide();
        window.setTimeout(function () {
          releasePageInteraction();
          if (typeof window.__wwUnlockPageIfIdle === "function") {
            window.__wwUnlockPageIfIdle();
          }
        }, (window.themeConfigs && window.themeConfigs.defaultTransitionTime) || 400);
        return result;
      };
      modal.dataset.wwQvHideWrapped = "1";
    }
  }

  function destroyQuickViewGallery(gallery) {
    if (!gallery) return;
    if (typeof gallery.destroyGallery === "function") {
      gallery.destroyGallery();
    }
    if (gallery._wwQvTeardown) {
      gallery._wwQvTeardown();
      gallery._wwQvTeardown = null;
    }
  }

  function initQuickViewGalleryEmbla(gallery) {
    if (!gallery || typeof EmblaCarousel !== "function") return false;

    const mainGalleryEl = gallery.querySelector('[id^="GalleryMain"]');
    if (!mainGalleryEl) return false;

    const mainViewport = mainGalleryEl.querySelector(".embla__viewport");
    const mainSlides = mainGalleryEl.querySelectorAll(".embla__viewport > .embla__container > .embla__slide");
    if (!mainViewport || !mainSlides.length) return false;

    destroyQuickViewGallery(gallery);

    const emblaMain = EmblaCarousel(mainViewport, {});
    let emblaThumb = null;

    const thumbsEl = gallery.querySelector('[id^="GalleryThumbnails"]');
    if (thumbsEl && mainSlides.length > 1) {
      const thumbViewport = thumbsEl.querySelector(".embla__viewport");
      if (thumbViewport) {
        emblaThumb = EmblaCarousel(thumbViewport, {
          containScroll: "keepSnaps",
          dragFree: true,
        });
        const thumbSlides = emblaThumb.slideNodes();
        thumbSlides.forEach(function (slide, index) {
          slide.addEventListener(
            "click",
            function () {
              emblaMain.scrollTo(index);
            },
            false
          );
        });

        const syncThumbs = function () {
          const selected = emblaMain.selectedScrollSnap();
          const idx = Math.min(Math.max(0, selected), thumbSlides.length - 1);
          emblaThumb.scrollTo(idx);
          thumbSlides.forEach(function (slide, i) {
            slide.classList.toggle("embla-thumbs__slide--selected", i === idx);
          });
        };

        emblaMain.on("select", syncThumbs);
        emblaThumb.on("init", syncThumbs);
        emblaThumb.on("reInit", syncThumbs);
        syncThumbs();
      }
    }

    const prevBtn = mainGalleryEl.querySelector(".embla__button--prev");
    const nextBtn = mainGalleryEl.querySelector(".embla__button--next");
    const onPrev = function () {
      emblaMain.scrollPrev();
    };
    const onNext = function () {
      emblaMain.scrollNext();
    };
    if (prevBtn) prevBtn.addEventListener("click", onPrev, false);
    if (nextBtn) nextBtn.addEventListener("click", onNext, false);

    const buttonsWrap = mainGalleryEl.querySelector(".embla__buttons");
    if (buttonsWrap && mainSlides.length <= 1) {
      buttonsWrap.style.display = "none";
    }

    gallery._wwQvTeardown = function () {
      if (prevBtn) prevBtn.removeEventListener("click", onPrev, false);
      if (nextBtn) nextBtn.removeEventListener("click", onNext, false);
      emblaMain.destroy();
      if (emblaThumb) emblaThumb.destroy();
    };

    return true;
  }

  function refreshGalleryElements(gallery) {
    if (!gallery) return;
    gallery.elements = {
      thumbnails: gallery.querySelector('[id^="GalleryThumbnails"]'),
      mainGallery: gallery.querySelector('[id^="GalleryMain"]'),
    };
    gallery.prevBtnNode = gallery.querySelector(".embla__button--prev");
    gallery.nextBtnNode = gallery.querySelector(".embla__button--next");
  }

  function initQuickViewGallery(root) {
    const gallery = (root || document).querySelector("#quick-view-product media-gallery");
    if (!gallery) return;

    function run() {
      destroyQuickViewGallery(gallery);
      refreshGalleryElements(gallery);
      if (gallery.elements && gallery.elements.mainGallery && typeof gallery.init === "function") {
        gallery.init();
        if (typeof gallery.bindSpotlightClicks === "function") {
          gallery.bindSpotlightClicks();
        }
        if (gallery.mainGallery) return true;
      }
      return initQuickViewGalleryEmbla(gallery);
    }

    function scheduleInit() {
      if (run()) return;
      let tries = 0;
      const timer = window.setInterval(function () {
        tries += 1;
        if (run() || tries > 40) window.clearInterval(timer);
      }, 100);
    }

    if (typeof window.requestAnimationFrame === "function") {
      window.requestAnimationFrame(scheduleInit);
    } else {
      scheduleInit();
    }
  }

  function quickViewSkeletonHtml() {
    return (
      '<div class="ww-qv-skeleton" aria-hidden="true">' +
      '<div class="ww-qv-skeleton__grid">' +
      '<div class="ww-qv-skeleton__gallery">' +
      '<div class="ww-qv-skeleton__img"></div>' +
      '<div class="ww-qv-skeleton__thumbs">' +
      '<span></span><span></span><span></span><span></span>' +
      "</div>" +
      "</div>" +
      '<div class="ww-qv-skeleton__info">' +
      '<div class="ww-qv-skeleton__line ww-qv-skeleton__line--title"></div>' +
      '<div class="ww-qv-skeleton__line ww-qv-skeleton__line--price"></div>' +
      '<div class="ww-qv-skeleton__box"></div>' +
      '<div class="ww-qv-skeleton__line ww-qv-skeleton__line--short"></div>' +
      '<div class="ww-qv-skeleton__btn"></div>' +
      '<div class="ww-qv-skeleton__btn ww-qv-skeleton__btn--outline"></div>' +
      "</div>" +
      "</div>" +
      "</div>"
    );
  }

  function setQuickViewLoading(loading) {
    const modal = document.getElementById("quick-view-product");
    if (!modal) return;
    const inner = modal.querySelector(".portal-inner");
    const wrapper = modal.querySelector(".product-wrapper");
    if (inner) inner.classList.toggle("loading", loading);
    if (wrapper) wrapper.classList.toggle("is-loading", loading);
  }

  function showQuickViewSkeleton(wrapper) {
    setQuickViewLoading(true);
    wrapper.innerHTML = quickViewSkeletonHtml();
  }

  function injectQuickViewHtml(html) {
    const wrapper = document.querySelector("#quick-view-product .product-wrapper");
    if (!wrapper) return false;

    const doc = new DOMParser().parseFromString(html, "text/html");
    const productForm = doc.querySelector("product-form");
    if (!productForm) return false;

    wrapper.replaceChildren();
    wrapper.appendChild(document.importNode(productForm, true));
    setQuickViewLoading(false);
    wrapper.classList.remove("is-ready");
    void wrapper.offsetWidth;
    wrapper.classList.add("is-ready");
    window.setTimeout(function () {
      wrapper.classList.remove("is-ready");
    }, 320);
    initQuickViewGallery(wrapper);

    if (window.EGATheme && window.EGATheme.publish && window.themeConfigs) {
      window.EGATheme.publish(window.themeConfigs.productLoaded);
      window.EGATheme.publish(window.themeConfigs.quickViewShow);
    }

    return true;
  }

  let loadingId = 0;

  function loadProduct(id) {
    if (!id) return;
    loadingId = id;

    const wrapper = document.querySelector("#quick-view-product .product-wrapper");
    if (wrapper) {
      showQuickViewSkeleton(wrapper);
    }

    openModal();

    fetch(themeApiUrl("/san-pham/chi-tiet/sp-" + id + "?view=quickview"), {
      headers: { Accept: "text/html", "X-Requested-With": "XMLHttpRequest" },
      credentials: "same-origin",
    })
      .then(function (res) {
        if (!res.ok) throw new Error("HTTP " + res.status);
        return res.text();
      })
      .then(function (html) {
        if (loadingId !== id) return;
        if (!injectQuickViewHtml(html)) throw new Error("empty");
      })
      .catch(function () {
        if (loadingId !== id) return;
        setQuickViewLoading(false);
        if (wrapper) {
          wrapper.innerHTML =
            '<div class="ww-qv-error bg-background p-6 rounded-lg text-center min-h-[20rem] flex items-center justify-center">Không tải được nội dung xem nhanh.</div>';
        }
      });
  }

  window.wwOpenQuickView = loadProduct;
  window.wwQuickViewClick = function (e, btn) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
      if (e.stopImmediatePropagation) e.stopImmediatePropagation();
    }
    const id = btn && (btn.dataset ? btn.dataset.productId : btn.getAttribute("data-product-id"));
    loadProduct(parseInt(id, 10) || 0);
    return false;
  };

  function bindQuickViewButton(btn) {
    if (!btn || btn.dataset.wwQvBound === "1") return;
    btn.dataset.wwQvBound = "1";
    const activate = function (e) {
      e.preventDefault();
      e.stopPropagation();
      if (e.stopImmediatePropagation) e.stopImmediatePropagation();
      loadProduct(parseInt(btn.dataset.productId, 10) || 0);
    };
    btn.addEventListener("mousedown", activate, true);
    btn.addEventListener("click", activate, true);
    btn.addEventListener("touchstart", activate, { capture: true, passive: false });
  }

  function ensureButtons(root) {
    (root || document).querySelectorAll(".ww-quick-view-btn").forEach(bindQuickViewButton);
    (root || document).querySelectorAll("card-product").forEach(function (card) {
      if (card.querySelector(".ww-quick-view-btn")) return;
      const pid = productIdFromCard(card);
      const top = card.querySelector(".card-product__top");
      if (!pid || !top) return;
      top.classList.add("relative");
      top.insertAdjacentHTML("beforeend", quickViewBtnHtml(pid));
      const btn = top.querySelector(".ww-quick-view-btn");
      if (btn) bindQuickViewButton(btn);
    });
  }

  document.addEventListener("click", function (e) {
    if (e.target.closest("#PortalClose-quick-view-product, #quick-view-product .portal-overlay")) {
      e.preventDefault();
      e.stopPropagation();
      closeModal();
      if (typeof window.__wwUnlockPageIfIdle === "function") {
        window.setTimeout(window.__wwUnlockPageIfIdle, 50);
      }
      return;
    }
    const btn = e.target.closest(".ww-quick-view-btn");
    if (!btn) return;
    e.preventDefault();
    e.stopPropagation();
    if (e.stopImmediatePropagation) e.stopImmediatePropagation();
    loadProduct(parseInt(btn.dataset.productId, 10) || 0);
  }, true);

  function initQuickViewButtons() {
    ensureModalInBody();
    bindQuickViewPortalHooks();
    ensureButtons(document);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initQuickViewButtons);
  } else {
    initQuickViewButtons();
  }

  // product.js defer: retry wrap hide sau khi custom element sẵn sàng
  window.setTimeout(bindQuickViewPortalHooks, 0);
  window.setTimeout(bindQuickViewPortalHooks, 500);
  window.setTimeout(bindQuickViewPortalHooks, 1500);

  document.addEventListener("PortalClosed", function () {
    window.setTimeout(function () {
      if (typeof window.__wwUnlockPageIfIdle === "function") {
        window.__wwUnlockPageIfIdle();
      }
    }, 30);
  });

  if (window.EGATheme && window.EGATheme.subscribe && window.themeConfigs) {
    window.EGATheme.subscribe(window.themeConfigs.productAddEvent, function () {
      window.setTimeout(function () {
        bindQuickViewPortalHooks();
        const qv = document.getElementById("quick-view-product");
        if (qv && (qv.classList.contains("active") || qv.classList.contains("ww-open"))) {
          if (typeof qv.hide === "function") qv.hide();
          else closeModal();
        } else {
          releasePageInteraction();
        }
        window.setTimeout(function () {
          if (typeof window.__wwUnlockPageIfIdle === "function") {
            window.__wwUnlockPageIfIdle();
          }
        }, (window.themeConfigs && window.themeConfigs.defaultTransitionTime) || 400);
      }, 0);
    });
  }

  document.addEventListener("home-product-cards-loaded", initQuickViewButtons);
  if (window.EGATheme && window.EGATheme.subscribe && window.themeConfigs) {
    window.EGATheme.subscribe(window.themeConfigs.productLoaded, initQuickViewButtons);
  }

  new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      mutation.addedNodes.forEach(function (node) {
        if (node.nodeType === 1) ensureButtons(node);
      });
    });
  }).observe(document.documentElement, { childList: true, subtree: true });
})();
