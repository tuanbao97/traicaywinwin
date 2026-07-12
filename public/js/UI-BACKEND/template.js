(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    //Add active class to nav-link based on url dynamically
    //Active class can be hard coded directly in html file also as required

    function addActiveClass(element) {
      /* if (current === "") {
        //for root url
        if (element.attr('href').indexOf("index.html") !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
        }
      } else {
        //for other url
        if (element.attr('href').indexOf(current) !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
          if (element.parents('.submenu-item').length) {
            element.addClass('active');
          }
        }
      } */
    }

    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    $('.nav li a', sidebar).each(function() {
      var $this = $(this);
      addActiveClass($this);
    })

    $('.horizontal-menu .nav li a').each(function() {
      var $this = $(this);
      addActiveClass($this);
    })

    // Mở tất cả menu khi trang được load và cập nhật aria-expanded
    sidebar.find('.collapse').addClass('show');
    sidebar.find('.nav-link[data-bs-toggle="collapse"]').attr('aria-expanded', 'true');

    // Xử lý click collapse - chỉ collapse menu được click
    sidebar.on('click', '.nav-link[data-bs-toggle="collapse"]', function(e) {
      e.preventDefault();
      var $this = $(this);
      var targetId = $this.attr('href');
      var $targetCollapse = $(targetId);
      
      // Toggle chỉ menu được click
      $targetCollapse.collapse('toggle');
      
      // Cập nhật aria-expanded sau khi toggle
      setTimeout(function() {
        var isExpanded = $targetCollapse.hasClass('show');
        $this.attr('aria-expanded', isExpanded);
      }, 350); // Đợi animation hoàn thành
    });

    // Xử lý click vào menu con để highlight menu cha
    sidebar.on('click', '.sub-menu .nav-link', function(e) {
      // Xóa active class khỏi tất cả menu con
      sidebar.find('.nav-link').removeClass('sub-menu-active');
      sidebar.find('.nav-item').removeClass('active');
      
      // Thêm active class cho menu được click
      $(this).addClass('sub-menu-active');
      
      // Tìm menu cha và thêm active class
      var $parentNavItem = $(this).closest('.nav-item').parent().closest('.nav-item');
      if ($parentNavItem.length) {
        $parentNavItem.addClass('active');
        $parentNavItem.find('> .nav-link').addClass('active');
      } else {
        $(this).closest('.nav-item').addClass('active');
      }
    });

    // Xử lý click vào menu cha
    sidebar.on('click', '.nav-link:not([data-bs-toggle="collapse"]):not(.sub-menu .nav-link)', function(e) {
      // Xóa active class khỏi tất cả menu
      sidebar.find('.nav-link').removeClass('active sub-menu-active');
      sidebar.find('.nav-item').removeClass('active');
      
      // Thêm active class cho menu được click
      $(this).addClass('active');
      $(this).closest('.nav-item').addClass('active');
    });

    //Change sidebar and content-wrapper height
    applyStyles();

    function applyStyles() {
      //Applying perfect scrollbar
      if (!body.hasClass("rtl")) {
        if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
          const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
        }
        if ($('.chats').length) {
          const chatsScroll = new PerfectScrollbar('.chats');
        }
        if (body.hasClass("sidebar-fixed")) {
          if($('#sidebar').length) {
            var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
          }
        }
      }
    }

    $('[data-toggle="minimize"]').on("click", function() {
      if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
        
        // Lưu trạng thái vào sessionStorage
        var isCollapsed = body.hasClass('sidebar-icon-only');
        sessionStorage.setItem('sidebarCollapsed', isCollapsed);
      }
    });

    //checkbox and radios
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    //Horizontal menu in mobile
    $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });
    // Horizontal menu navigation in mobile menu on click
    var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
    navItemClicked.on("click", function(event) {
      if(window.matchMedia('(max-width: 991px)').matches) {
        if(!($(this).hasClass('show-submenu'))) {
          navItemClicked.removeClass('show-submenu');
        }
        $(this).toggleClass('show-submenu');
      }        
    })

    $(window).scroll(function() {
      if(window.matchMedia('(min-width: 992px)').matches) {
        var header = $('.horizontal-menu');
        if ($(window).scrollTop() >= 70) {
          $(header).addClass('fixed-on-scroll');
        } else {
          $(header).removeClass('fixed-on-scroll');
        }
      }
    });

    // --- TỰ ĐỘNG HIGHLIGHT MENU KHI LOAD TRANG ---
    var currentPath = window.location.pathname.replace(/^\/+|\/+$/g, '');
    sidebar.find('.nav-link').each(function() {
      var $this = $(this);
      var linkPath = $this.attr('href');
      if (!linkPath) return;
      // Loại bỏ domain nếu có
      linkPath = linkPath.replace(window.location.origin, '').replace(/^\/+|\/+$/g, '');
      if (linkPath && currentPath.endsWith(linkPath)) {
        $this.addClass('sub-menu-active active');
        var $parentNavItem = $this.closest('.nav-item').parent().closest('.nav-item');
        if ($parentNavItem.length) {
          $parentNavItem.addClass('active');
          $parentNavItem.find('> .nav-link').addClass('active');
        } else {
          $this.closest('.nav-item').addClass('active');
        }
      }
    });

    // --- LƯU VÀ KHÔI PHỤC TRẠNG THÁI COLLAPSE SIDEBAR ---
    // Khôi phục trạng thái collapse khi load trang
    function restoreSidebarState() {
      var sidebarState = sessionStorage.getItem('sidebarCollapsed');
      if (sidebarState === 'true') {
        body.addClass('sidebar-icon-only');
      } else if (sidebarState === 'false') {
        body.removeClass('sidebar-icon-only');
      }
    }

    // Khôi phục trạng thái khi trang load
    restoreSidebarState();
  });
})(jQuery);