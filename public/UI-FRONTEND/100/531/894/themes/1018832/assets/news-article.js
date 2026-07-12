(function () {
  function imageSrc(img) {
    return img?.currentSrc || img?.src || "";
  }

  function wrapImageToSpotlight(img) {
    if (!img || img.closest(".swiper-spotlight")) return;

    var src = imageSrc(img);
    if (!src || src.indexOf("default-image") !== -1) return;

    var wrap = document.createElement("span");
    wrap.className = "swiper-spotlight cursor-zoom-in";
    wrap.dataset.src = src;
    wrap.style.display = "block";
    wrap.style.cursor = "zoom-in";
    wrap.style.width = "100%";

    img.parentNode.insertBefore(wrap, img);
    wrap.appendChild(img);
  }

  function ensureSpotlightSlides(root) {
    // Hero
    root.querySelectorAll(".ww-news-hero img").forEach(wrapImageToSpotlight);
    // Content
    root.querySelectorAll(".article-content img").forEach(wrapImageToSpotlight);
  }

  function collectSlides(root) {
    var slides = Array.from(root.querySelectorAll(".swiper-spotlight"));
    slides.forEach(function (el, idx) {
      el.dataset.index = String(idx);
      if (!el.dataset.src) {
        var img = el.querySelector("img");
        var src = imageSrc(img);
        if (src) el.dataset.src = src;
      }
    });
    return slides.filter(function (el) {
      return !!el.dataset.src;
    });
  }

  function ensureSpotlight(done) {
    if (typeof window.Spotlight === "function") {
      done();
      return;
    }
    if (typeof window.loadDefer === "function") {
      window.loadDefer();
    }
    var attempts = 0;
    var timer = window.setInterval(function () {
      attempts += 1;
      if (typeof window.Spotlight === "function") {
        window.clearInterval(timer);
        done();
      } else if (attempts > 80) {
        window.clearInterval(timer);
      }
    }, 100);
  }

  function openLightbox(slides, activeIndex) {
    // Nếu Spotlight chưa sẵn sàng, fallback mở tab mới
    ensureSpotlight(function () {
      var active = slides[activeIndex];
      var src = active && active.dataset.src;
      if (typeof window.Spotlight !== "function" || !src) {
        if (src) {
          window.open(src, "_blank");
        }
        return;
      }

      var list = slides.map(function (el) {
        return { src: el.dataset.src };
      });
      window.Spotlight.show(list, { download: true });
      window.Spotlight.goto(activeIndex + 1);
    });
  }

  function bindNewsImages(root) {
    ensureSpotlightSlides(root);
    var slides = collectSlides(root);

    slides.forEach(function (el, idx) {
      if (el.dataset.spotlightBound === "1") return;
      el.dataset.spotlightBound = "1";
      el.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        openLightbox(slides, idx);
      });
    });
  }

  function init() {
    var root = document.querySelector(".main-article");
    if (!root) return;
    bindNewsImages(root);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
