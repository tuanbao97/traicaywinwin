/**
 * Admin danh-sách: đồng bộ phân trang trên URL dạng path
 * /admin/.../danh-sach/trang/{page}/so-luong/{length}
 * Hỗ trợ fallback đọc ?page=&length= cũ và tự migrate.
 */
(function (window) {
  'use strict';

  function parseLengthValue(raw, defaultLength) {
    if (raw == null || raw === '') return defaultLength;
    if (String(raw) === 'all') return 'all';
    var n = Number(parseFloat(raw));
    return !isNaN(n) && n > 0 ? n : defaultLength;
  }

  var wwAdminListUrl = {
    parse: function (defaultLength) {
      if (defaultLength == null) defaultLength = 10;
      var path = window.location.pathname || '';
      var page = 1;
      var length = defaultLength;
      var mPage = path.match(/\/trang\/(\d+)(?=\/|$)/);
      var mLen = path.match(/\/so-luong\/([^\/]+)(?=\/|$)/);

      if (mPage) {
        page = Math.max(1, parseInt(mPage[1], 10) || 1);
      }
      if (mLen) {
        length = parseLengthValue(mLen[1], defaultLength);
      }

      var qs = new URLSearchParams(window.location.search || '');
      if (!mPage && qs.has('page')) {
        var qp = Number(parseFloat(qs.get('page')));
        if (!isNaN(qp) && qp > 0) page = qp;
      }
      if (!mLen && qs.has('length')) {
        length = parseLengthValue(qs.get('length'), defaultLength);
      }

      return { page: page, length: length };
    },

    /** Index 0-based cho DataTables */
    pageIndex: function (defaultLength) {
      return Math.max(0, this.parse(defaultLength).page - 1);
    },

    dataTableLength: function (defaultLength) {
      var len = this.parse(defaultLength).length;
      if (len === 'all') return 2147483647;
      return Number(len) > 0 ? Number(len) : (defaultLength || 10);
    },

    basePath: function () {
      return String(window.location.pathname || '')
        .replace(/\/trang\/\d+/g, '')
        .replace(/\/so-luong\/[^\/]+/g, '')
        .replace(/\/+$/, '');
    },

    sync: function (page, length) {
      page = Math.max(1, Number(page) || 1);
      if (length == null || length === '' || Number(length) === 0) {
        length = 'all';
      } else if (length !== 'all') {
        length = Number(length);
        if (isNaN(length) || length < 0) length = 10;
      }

      var base = this.basePath();
      var path =
        page === 1 && (length === 10 || length === '10')
          ? base
          : base + '/trang/' + page + '/so-luong/' + length;

      window.history.pushState({}, '', path);
    },

    migrateLegacyQuery: function () {
      var qs = new URLSearchParams(window.location.search || '');
      if (!qs.has('page') && !qs.has('length')) return;
      var parsed = this.parse(10);
      this.sync(parsed.page, parsed.length);
    },
  };

  window.wwAdminListUrl = wwAdminListUrl;

  document.addEventListener('DOMContentLoaded', function () {
    var path = window.location.pathname || '';
    if (/\/danh-sach(\/|$)/.test(path) || /\/admin\/cai-dat(\/|$)/.test(path)) {
      wwAdminListUrl.migrateLegacyQuery();
    }
  });
})(window);
