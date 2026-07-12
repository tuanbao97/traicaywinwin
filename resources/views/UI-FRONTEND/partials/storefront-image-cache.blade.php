{{-- Cache-bust ảnh storefront theo UPD_DT (?upd_time=) --}}
<script>
(function (w) {
  function toUpdTime(updDt) {
    if (updDt == null || updDt === '') return '';
    if (typeof updDt === 'number' && isFinite(updDt)) return String(Math.floor(updDt));
    var raw = String(updDt).trim();
    if (/^\d+$/.test(raw)) return raw;
    var t = Date.parse(raw.replace(' ', 'T'));
    if (!isNaN(t)) return String(Math.floor(t / 1000));
    var digits = raw.replace(/\D+/g, '');
    return digits || '';
  }

  function appendUpdTime(url, updDt) {
    if (!url) return '';
    var bust = toUpdTime(updDt);
    if (!bust) return url;
    if (url.indexOf('upd_time=') !== -1) return url;
    return url + (url.indexOf('?') >= 0 ? '&' : '?') + 'upd_time=' + encodeURIComponent(bust);
  }

  /** Ưu tiên UPD_DT entity (sản phẩm/tin), fallback UPD_DT ảnh */
  function pickUpdTime(entity, img) {
    if (entity && (entity.UPD_DT || entity.updDt)) return entity.UPD_DT || entity.updDt;
    if (img && (img.UPD_DT || img.updDt)) return img.UPD_DT || img.updDt;
    return '';
  }

  w.wwStorefrontImage = {
    toUpdTime: toUpdTime,
    appendUpdTime: appendUpdTime,
    pickUpdTime: pickUpdTime,
  };
})(window);
</script>
