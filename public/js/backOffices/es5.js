"use strict";
$(document).ready(function () {
    var e = $(".menu-toggle"), n = $(".sidebar-left"), l = $(".sidebar-left-secondary"), t = $(".sidebar-overlay"),
        a = $(".main-content-wrap"), i = $(".nav-item"), c = $(".search-bar input"), s = $(".search-close");

    function o() {
        n.addClass("open"), a.addClass("sidenav-open")
    }

    function r() {
        n.removeClass("open"), a.removeClass("sidenav-open")
    }

    function u() {
        l.addClass("open"), t.addClass("open")
    }

    function d() {
        l.removeClass("open"), t.removeClass("open")
    }

    window.gullUtils = {
        isMobile: function () {
            return window && window.matchMedia("(max-width: 767px)").matches
        }
    }, $(window).on("resize", function (e) {
        gullUtils.isMobile() && (r(), d())
    }), i.each(function (e) {
        var n = $(this);
        if (n.hasClass("active")) {
            var t = n.data("item");
            l.find('[data-parent="' + t + '"]').show()
        }
    }), gullUtils.isMobile() && (r(), d()), n.find(".nav-item").on("mouseenter", function (e) {
        var n, t = $(e.currentTarget), a = t.data("item");
        a ? (n = t, $(".nav-item").removeClass("active"), n.addClass("active"), u()) : d(), l.find(".childNav").hide(), l.find('[data-parent="' + a + '"]').show()
    }), n.find(".nav-item").on("click", function (e) {
        $(event.currentTarget).data("item") && e.preventDefault()
    }), t.on("click", function (e) {
        gullUtils.isMobile() && r(), d()
    }), e.on("click", function (e) {
        var t = n.hasClass("open"), a = l.hasClass("open"), i = $(".nav-item.active").data("item");
        t && a && gullUtils.isMobile() ? (r(), d()) : t && a ? d() : t ? r() : t || a || i ? t || a || (o(), u()) : o()
    });
    var v = $(".search-ui");
    c.on("focus", function () {
        v.addClass("open")
    }), s.on("click", function () {
        v.removeClass("open")
    }), $(".perfect-scrollbar, [data-perfect-scrollbar]").each(function (e) {
        var n = $(this);
        new PerfectScrollbar(this, {
            suppressScrollX: n.data("suppress-scroll-x"),
            suppressScrollY: n.data("suppress-scroll-y")
        })
    }), $("[data-fullscreen]").on("click", function () {
        var e = document.body;
        return document.fullScreenElement && null !== document.fullScreenElement || document.mozFullScreen || document.webkitIsFullScreen ? function (e) {
            var n = e.cancelFullScreen || e.webkitCancelFullScreen || e.mozCancelFullScreen || e.exitFullscreen;
            if (n) n.call(e); else if (void 0 !== window.ActiveXObject) {
                var l = new ActiveXObject("WScript.Shell");
                null !== l && l.SendKeys("{F11}")
            }
        }(document) : function (e) {
            var n = e.requestFullScreen || e.webkitRequestFullScreen || e.mozRequestFullScreen || e.msRequestFullscreen;
            if (n) n.call(e); else if (void 0 !== window.ActiveXObject) {
                var l = new ActiveXObject("WScript.Shell");
                null !== l && l.SendKeys("{F11}")
            }
        }(e), !1
    })
});