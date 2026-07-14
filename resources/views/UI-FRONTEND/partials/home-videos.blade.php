<section
  class="section section-home-videos"
  id="section-home-videos"
  hidden
  aria-hidden="true"
  style="display:none;--section-padding: 0;--section-margin: 24px 0 24px;--section-padding-mb: 0;--section-margin-mb: 24px 0 24px;"
>
  <div class="container">
    <div class="section-card">
      <div class="heading-bar mb-4 md:mb-6 flex items-center justify-between gap-3 flex-wrap">
        <h2 class="heading w-auto font-semibold mb-0">
          <a class="link" href="{{ url('/video') }}" title="Video">Video</a>
        </h2>
        <a href="{{ url('/video') }}" class="ww-home-viewmore__btn ww-home-viewmore__btn--compact" title="Xem tất cả video">
          <span class="ww-home-viewmore__label">Xem tất cả</span>
          <span class="ww-home-viewmore__icon" aria-hidden="true"><i class="icon icon-carret-right"></i></span>
        </a>
      </div>
      <div
        id="home-videos-grid"
        class="ww-home-videos__grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4"
      ></div>
    </div>
  </div>
</section>

<div id="ww-home-video-modal" class="ww-video-modal" hidden aria-hidden="true">
  <div class="ww-video-modal__overlay" data-ww-video-close></div>
  <div class="ww-video-modal__panel" role="dialog" aria-modal="true" aria-labelledby="ww-home-video-modal-title">
    <button type="button" class="ww-video-modal__close" data-ww-video-close title="Đóng" aria-label="Đóng">
      <i class="icon icon-cross"></i>
    </button>
    <div class="ww-video-modal__scroll">
      <div class="ww-video-modal__media" id="ww-home-video-modal-media"></div>
      <div class="ww-video-modal__body">
        <h3 class="ww-video-modal__title" id="ww-home-video-modal-title"></h3>
        <p class="ww-video-modal__summary" id="ww-home-video-modal-summary"></p>
        <div class="ww-video-modal__content prose text-base" id="ww-home-video-modal-content"></div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  var cfg = {
    listUrl: @json(url('/api/public/video/list')),
    detailUrl: @json(url('/api/public/video/detail')),
    appUrl: @json(rtrim(url('/'), '/')),
    defaultImg: @json(asset('image/UI-BACKEND/default-image.png')),
  };

  var sectionEl = document.getElementById('section-home-videos');
  var gridEl = document.getElementById('home-videos-grid');
  var modalEl = document.getElementById('ww-home-video-modal');
  var mediaEl = document.getElementById('ww-home-video-modal-media');
  var titleEl = document.getElementById('ww-home-video-modal-title');
  var summaryEl = document.getElementById('ww-home-video-modal-summary');
  var contentEl = document.getElementById('ww-home-video-modal-content');
  if (!sectionEl || !gridEl || !modalEl) return;

  function escapeHtml(s) {
    if (s == null) return '';
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function joinAppUrl(pathRel, updDt) {
    if (!pathRel) return '';
    var url = cfg.appUrl + '/' + String(pathRel).replace(/^\/+/, '');
    if (updDt) {
      var t = new Date(updDt).getTime();
      if (!isNaN(t)) url += (url.indexOf('?') >= 0 ? '&' : '?') + 'update_time=' + t;
    }
    return url;
  }

  function avatarUrl(video) {
    var list = (video && video.DANH_SACH_HINH_ANH_DAI_DIEN) || [];
    var img = list[0];
    if (!img) return cfg.defaultImg;
    var ratio = img.ASPECT_RATIO || '1x1';
    var dir = img.DIRECTORY || '';
    var name = img.NAME || '';
    if (!dir || !name) return img.PATH ? joinAppUrl(img.PATH, img.UPD_DT) : cfg.defaultImg;
    return joinAppUrl(dir + '/' + ratio + '_' + name, img.UPD_DT);
  }

  function showSection() {
    sectionEl.style.display = '';
    sectionEl.removeAttribute('hidden');
    sectionEl.removeAttribute('aria-hidden');
  }

  function hideSection() {
    sectionEl.style.display = 'none';
    sectionEl.setAttribute('hidden', '');
    sectionEl.setAttribute('aria-hidden', 'true');
  }

  function stopMedia() {
    if (!mediaEl) return;
    mediaEl.querySelectorAll('video').forEach(function (v) {
      try { v.pause(); } catch (e) {}
    });
    mediaEl.querySelectorAll('iframe').forEach(function (f) {
      f.src = '';
    });
    mediaEl.innerHTML = '';
  }

  function closeModal() {
    stopMedia();
    modalEl.hidden = true;
    modalEl.setAttribute('aria-hidden', 'true');
    document.documentElement.classList.remove('ww-video-modal-open');
  }

  function openModalShell(title, summary) {
    titleEl.textContent = title || '';
    summaryEl.textContent = summary || '';
    summaryEl.hidden = !summary;
    contentEl.innerHTML = '<p class="text-sm text-neutral-200">Đang tải video...</p>';
    mediaEl.innerHTML = '';
    modalEl.hidden = false;
    modalEl.removeAttribute('aria-hidden');
    document.documentElement.classList.add('ww-video-modal-open');
  }

  function isVideoFile(file) {
    if (!file) return false;
    var ext = String(file.EXTENSION || file.TYPE_FILE || '').toLowerCase().replace(/^\./, '');
    var name = String(file.ORIGINAL_NAME || file.NAME || '').toLowerCase();
    var type = String(file.TYPE_FILE || '').toLowerCase();
    if (['mp4', 'webm', 'ogg', 'mov', 'm4v'].indexOf(ext) >= 0) return true;
    if (type.indexOf('video/') === 0) return true;
    return /\.(mp4|webm|ogg|mov|m4v)(\?|$)/.test(name);
  }

  function fileUrl(file) {
    if (!file) return '';
    if (file.PATH) return joinAppUrl(file.PATH, file.UPD_DT);
    if (file.DIRECTORY && file.NAME) return joinAppUrl(file.DIRECTORY + '/' + file.NAME, file.UPD_DT);
    return '';
  }

  function contentHasPlayable(html) {
    if (!html) return false;
    return /<(iframe|video|embed)\b/i.test(html);
  }

  function renderMediaFromDetail(detail) {
    var files = (detail && detail.DANH_SACH_FILE_DINH_KEM) || [];
    var videoFile = null;
    for (var i = 0; i < files.length; i++) {
      if (isVideoFile(files[i])) {
        videoFile = files[i];
        break;
      }
    }

    var contentHtml = (detail && detail.NOI_DUNG_VIDEO) || '';
    if (videoFile) {
      var src = fileUrl(videoFile);
      mediaEl.innerHTML =
        '<video class="ww-video-modal__player" controls playsinline preload="metadata" src="' +
        escapeHtml(src) +
        '"></video>';
      contentEl.innerHTML = contentHtml || '';
      return;
    }

    if (contentHasPlayable(contentHtml)) {
      mediaEl.innerHTML = contentHtml;
      contentEl.innerHTML = '';
      return;
    }

    mediaEl.innerHTML = '';
    contentEl.innerHTML = contentHtml || '<p class="text-sm text-neutral-200">Chưa có nội dung video.</p>';
  }

  function buildCard(video) {
    var title = video.TIEU_DE_VIDEO || 'Video';
    var summary = video.TOM_TAT_VIDEO || '';
    var id = video.ID;
    var thumb = avatarUrl(video);

    return (
      '<button type="button" class="ww-home-video-card" data-video-id="' +
      escapeHtml(id) +
      '" data-video-title="' +
      escapeHtml(title) +
      '" data-video-summary="' +
      escapeHtml(summary) +
      '" title="' +
      escapeHtml(title) +
      '">' +
      '<span class="ww-home-video-card__thumb">' +
      '<img src="' +
      escapeHtml(thumb) +
      '" alt="' +
      escapeHtml(title) +
      '" loading="lazy" width="400" height="400">' +
      '<span class="ww-home-video-card__play" aria-hidden="true">' +
      '<svg viewBox="0 0 64 64" width="48" height="48" fill="none" xmlns="http://www.w3.org/2000/svg">' +
      '<circle cx="32" cy="32" r="32" fill="rgba(0,0,0,0.55)"/>' +
      '<path d="M26 20L46 32L26 44V20Z" fill="#fff"/>' +
      '</svg>' +
      '</span>' +
      '</span>' +
      '<span class="ww-home-video-card__title">' +
      escapeHtml(title) +
      '</span>' +
      (summary
        ? '<span class="ww-home-video-card__summary">' + escapeHtml(summary) + '</span>'
        : '') +
      '</button>'
    );
  }

  function openVideo(id, title, summary) {
    openModalShell(title, summary);
    fetch(cfg.detailUrl + '/' + encodeURIComponent(id), {
      method: 'GET',
      headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
    })
      .then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function (data) {
        var detail = data && data.DATAS && data.DATAS.VIDEO;
        if (!detail) throw new Error('empty');
        titleEl.textContent = detail.TIEU_DE_VIDEO || title || '';
        var sum = detail.TOM_TAT_VIDEO || summary || '';
        summaryEl.textContent = sum;
        summaryEl.hidden = !sum;
        renderMediaFromDetail(detail);
      })
      .catch(function () {
        contentEl.innerHTML = '<p class="text-sm text-rose-600">Không tải được video. Vui lòng thử lại.</p>';
      });
  }

  function bindCards() {
    gridEl.querySelectorAll('.ww-home-video-card').forEach(function (btn) {
      btn.addEventListener('click', function () {
        openVideo(
          btn.getAttribute('data-video-id'),
          btn.getAttribute('data-video-title'),
          btn.getAttribute('data-video-summary')
        );
      });
    });
  }

  modalEl.querySelectorAll('[data-ww-video-close]').forEach(function (el) {
    el.addEventListener('click', closeModal);
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modalEl.hidden) closeModal();
  });

  function loadVideos() {
    var params = new URLSearchParams();
    params.set('PAGE', '1');
    params.set('PER_PAGE', '12');
    params.set('TRANG_THAI_HOAT_DONG', 'true');
    params.set('BO_LOC', 'moi-den-cu');

    fetch(cfg.listUrl + '?' + params.toString(), {
      method: 'GET',
      headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
    })
      .then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function (data) {
        var rows = (data && data.DATAS && data.DATAS.VIDEO && data.DATAS.VIDEO.DATA) || [];
        if (!rows.length) {
          hideSection();
          return;
        }
        var html = '';
        for (var i = 0; i < rows.length; i++) html += buildCard(rows[i]);
        gridEl.innerHTML = html;
        bindCards();
        showSection();
      })
      .catch(function () {
        hideSection();
      });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadVideos);
  } else {
    loadVideos();
  }
})();
</script>
