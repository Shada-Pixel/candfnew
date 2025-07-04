lucide.createIcons();
class ThemeCustomizer {
    constructor() {
        this.html = document.getElementsByTagName("html")[0];
        this.config = {};
        this.defaultConfig = window.config;
    }

    initConfig() {
        this.defaultConfig = JSON.parse(JSON.stringify(window.defaultConfig));
        this.config = JSON.parse(JSON.stringify(window.config));
        this.setSwitchFromConfig();
    }

    initSidenav() {
        var e = window.location.href.split(/[?#]/)[0];
        document.querySelectorAll("ul.menu a.menu-link").forEach((n) => {
            if (n.href === e) {
                n.classList.add("active");
                let e = n.parentElement.parentElement.parentElement;
                if (e && e.classList.contains("menu-item")) {
                    var i = e.querySelector('[data-fc-type="collapse"]');
                    if (i && null != frost) {
                        const o = frost.Collapse.getInstanceOrCreate(i);
                        o.show();
                    }
                }
                let t =
                    n.parentElement.parentElement.parentElement.parentElement
                        .parentElement;
                if (t && t.classList.contains("menu-item")) {
                    i = t.querySelector('[data-fc-type="collapse"]');
                    if (i && null != frost) {
                        const a = frost.Collapse.getInstanceOrCreate(i);
                        a.show();
                    }
                }
            }
        }),
            setTimeout(function () {
                var e,
                    i,
                    o,
                    a,
                    c,
                    r,
                    t = document.querySelector("ul.menu .active");
                function d() {
                    (e = r += 20), (t = a), (n = c);
                    var e,
                        t,
                        n =
                            (e /= o / 2) < 1
                                ? (n / 2) * e * e + t
                                : (-n / 2) * (--e * (e - 2) - 1) + t;
                    (i.scrollTop = n), r < o && setTimeout(d, 20);
                }
                null != t &&
                    ((e = document.querySelector(
                        ".app-menu .simplebar-content-wrapper",
                    )),
                    (t = t.offsetTop - 300),
                    e &&
                        100 < t &&
                        ((o = 600),
                        (a = (i = e).scrollTop),
                        (c = t - a),
                        (r = 0),
                        d()));
            }, 200);
    }
    reverseQuery(e, t) {
        for (; e; ) {
            if (e.parentElement && e.parentElement.querySelector(t) === e)
                return e;
            e = e.parentElement;
        }
        return null;
    }
    changeThemeDirection(e) {
        this.config.direction = e;
        this.html.setAttribute("dir", e);
        this.setSwitchFromConfig();
    }
    changeThemeMode(e) {
        this.config.theme = e;
        this.html.setAttribute("data-mode", e);
        this.html.classList.toggle('dark', e === 'dark');
        this.setSwitchFromConfig();
    }
    changeLayoutWidth(e, t = !0) {
        this.html.setAttribute("data-layout-width", e),
            t && ((this.config.layout.width = e), this.setSwitchFromConfig());
    }
    changeLayoutPosition(e, t = !0) {
        this.html.setAttribute("data-layout-position", e),
            t &&
                ((this.config.layout.position = e), this.setSwitchFromConfig());
    }
    changeTopbarColor(e) {
        (this.config.topbar.color = e),
            this.html.setAttribute("data-topbar-color", e),
            this.setSwitchFromConfig();
    }
    changeMenuColor(e) {
        (this.config.menu.color = e),
            this.html.setAttribute("data-menu-color", e),
            this.setSwitchFromConfig();
    }
    changeSidenavView(e, t = !0) {
        this.html.setAttribute("data-sidenav-view", e),
            t && ((this.config.sidenav.view = e), this.setSwitchFromConfig());
    }
    resetTheme() {
        (this.config = JSON.parse(JSON.stringify(window.defaultConfig))),
            this.changeThemeDirection(this.config.direction),
            this.changeThemeMode(this.config.theme),
            this.changeLayoutWidth(this.config.layout.width),
            this.changeLayoutPosition(this.config.layout.position),
            this.changeTopbarColor(this.config.topbar.color),
            this.changeMenuColor(this.config.menu.color),
            this.changeSidenavView(this.config.sidenav.view),
            this.adjustLayout();
    }
    initSwitchListener() {
        var n = this,
            e = document.getElementById("light-dark-mode"),
            e =
                (e &&
                    e.addEventListener("click", function (e) {
                        "light" === n.config.theme
                            ? n.changeThemeMode("dark")
                            : n.changeThemeMode("light");
                    }),
                document.querySelector("#button-toggle-menu")),
            e =
                (e &&
                    e.addEventListener("click", function () {
                        var e = n.config.sidenav.view;
                        var t = n.html.getAttribute("data-sidenav-view", e);
                        "mobile" === t ? (n.showBackdrop(), n.html.classList.toggle("sidenav-enable")) : "hidden" == e ? "hidden" === t ? n.changeSidenavView(
                                      "hidden" == e ? "default" : e,
                                      !1,
                                  )
                                : n.changeSidenavView("hidden", !1)
                            : "condensed" === t
                            ? n.changeSidenavView(
                                  "condensed" == e ? "default" : e,
                                  !1,
                              )
                            : n.changeSidenavView("condensed", !1);
                    }),
                document
                    .querySelectorAll("input[name=dir]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeThemeDirection(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-mode]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeThemeMode(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-layout-width]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeLayoutWidth(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-layout-position]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeLayoutPosition(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-topbar-color]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeTopbarColor(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-menu-color]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeMenuColor(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-sidenav-view]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            n.changeSidenavView(t.value);
                        });
                    }),
                document.querySelector("#reset-layout"));
        e &&
            e.addEventListener("click", function (e) {
                n.resetTheme();
            });
    }
    showBackdrop() {
        const e = document.createElement("div"),
            t =
                ((e.id = "backdrop"),
                (e.classList =
                    "transition-all fixed inset-0 z-40 bg-gray-900 bg-opacity-50 dark:bg-opacity-80"),
                document.body.appendChild(e),
                document.getElementsByTagName("html")[0] &&
                    ((document.body.style.overflow = "hidden"),
                    1140 < window.innerWidth &&
                        (document.body.style.paddingRight = "15px")),
                this);
        e.addEventListener("click", function (e) {
            t.html.classList.remove("sidenav-enable"), t.hideBackdrop();
        });
    }
    hideBackdrop() {
        var e = document.getElementById("backdrop");
        e &&
            (document.body.removeChild(e),
            (document.body.style.overflow = null),
            (document.body.style.paddingRight = null));
    }
    initWindowSize() {
        var t = this;
        window.addEventListener("resize", function (e) {
            t.adjustLayout();
        });
    }
    adjustLayout() {
        window.innerWidth <= 1140
            ? this.changeSidenavView("mobile", !1)
            : this.changeSidenavView(this.config.sidenav.view);
    }
    setSwitchFromConfig() {
        sessionStorage.setItem(
            "_PIXADMIN_CONFIG_",
            JSON.stringify(this.config),
        ),
            document
                .querySelectorAll("#theme-customization input[type=checkbox]")
                .forEach(function (e) {
                    e.checked = !1;
                });
        var e,
            t,
            n,
            i,
            o,
            a,
            c = this.config;
        c &&
            ((e = document.querySelector(
                "input[type=checkbox][name=dir][value=" + c.direction + "]",
            )),
            (t = document.querySelector(
                "input[type=checkbox][name=data-mode][value=" + c.theme + "]",
            )),
            (n = document.querySelector(
                "input[type=checkbox][name=data-layout-width][value=" +
                    c.layout.width +
                    "]",
            )),
            (i = document.querySelector(
                "input[type=checkbox][name=data-layout-position][value=" +
                    c.layout.position +
                    "]",
            )),
            (o = document.querySelector(
                "input[type=checkbox][name=data-topbar-color][value=" +
                    c.topbar.color +
                    "]",
            )),
            (a = document.querySelector(
                "input[type=checkbox][name=data-menu-color][value=" +
                    c.menu.color +
                    "]",
            )),
            (c = document.querySelector(
                "input[type=checkbox][name=data-sidenav-view][value=" +
                    c.sidenav.view +
                    "]",
            )),
            e && (e.checked = !0),
            t && (t.checked = !0),
            n && (n.checked = !0),
            i && (i.checked = !0),
            o && (o.checked = !0),
            a && (a.checked = !0),
            c && (c.checked = !0));
    }
    init() {
        this.initConfig(),
            this.initSidenav(),
            this.initSwitchListener(),
            this.initWindowSize(),
            this.adjustLayout(),
            this.setSwitchFromConfig();
    }
}
new ThemeCustomizer().init();
