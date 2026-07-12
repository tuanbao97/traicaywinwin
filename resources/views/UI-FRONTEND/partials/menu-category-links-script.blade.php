<script>
(function () {
  var categoryUrlMap = @json(storefrontProductCategoryUrlMap());
  var gioQuaPriceUrlMap = @json(storefrontGioQuaPriceUrlMap());
  var toyMenuTitle = 'Đồ chơi trẻ em';

  function wireMenuCategoryLinks() {
    document.querySelectorAll('.navigation-vertical a[title]').forEach(function (anchor) {
      var title = (anchor.getAttribute('title') || '').replace(/\s+/g, ' ').trim();
      if (!title) return;

      // Menu Đồ chơi: hardcode FE → dochoiwinwin.com (không map từ DB)
      if (title === toyMenuTitle) {
        anchor.setAttribute('href', 'https://dochoiwinwin.com');
        anchor.setAttribute('target', '_blank');
        anchor.setAttribute('rel', 'noopener noreferrer');
        anchor.removeAttribute('data-prefetch');
        return;
      }

      var targetUrl = gioQuaPriceUrlMap[title] || categoryUrlMap[title];
      if (!targetUrl) return;

      anchor.setAttribute('href', targetUrl);
      anchor.removeAttribute('target');
      anchor.removeAttribute('rel');

      try {
        var parsed = new URL(targetUrl, window.location.origin);
        anchor.setAttribute('data-prefetch', parsed.pathname + parsed.search);
      } catch (e) {
        anchor.removeAttribute('data-prefetch');
      }
    });
  }

  function scheduleWireMenuCategoryLinks() {
    requestAnimationFrame(wireMenuCategoryLinks);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', scheduleWireMenuCategoryLinks);
  } else {
    scheduleWireMenuCategoryLinks();
  }
})();
</script>
