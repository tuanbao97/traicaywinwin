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
    detailUrl: @json(url('/api/public/video/detail')),
    appUrl: @json(rtrim(url('/'), '/')),
  };

  var modalEl = document.getElementById('ww-home-video-modal');
  var mediaEl = document.getElementById('ww-home-video-modal-media');
  var titleEl = document.getElementById('ww-home-video-modal-title');
  var summaryEl = document.getElementById('ww-home-video-modal-summary');
  var contentEl = document.getElementById('ww-home-video-modal-content');
  if (!modalEl || !mediaEl || !titleEl || !summaryEl || !contentEl) return;

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

  function stopMedia() {
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
    return !!(html && /<(iframe|video|embed)\b/i.test(html));
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
      mediaEl.innerHTML =
        '<video class="ww-video-modal__player" controls playsinline preload="metadata" src="' +
        escapeHtml(fileUrl(videoFile)) +
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

  window.wwOpenHomeVideo = openVideo;

  document.querySelectorAll('.ww-home-video-card[data-video-id]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openVideo(
        btn.getAttribute('data-video-id'),
        btn.getAttribute('data-video-title'),
        btn.getAttribute('data-video-summary')
      );
    });
  });

  modalEl.querySelectorAll('[data-ww-video-close]').forEach(function (el) {
    el.addEventListener('click', closeModal);
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modalEl.hidden) closeModal();
  });
})();
</script>
