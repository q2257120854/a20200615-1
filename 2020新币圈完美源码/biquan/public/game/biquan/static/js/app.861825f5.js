(function (e) {
    function t(t) {
        for (var a, c, u = t[0], o = t[1], s = t[2], h = 0, l = []; h < u.length; h++) c = u[h], i[c] && l.push(i[c][0]), i[c] = 0;
        for (a in o) Object.prototype.hasOwnProperty.call(o, a) && (e[a] = o[a]);
        d && d(t);
        while (l.length) l.shift()();
        return r.push.apply(r, s || []), n()
    }

    function n() {
        for (var e, t = 0; t < r.length; t++) {
            for (var n = r[t], a = !0, c = 1; c < n.length; c++) {
                var u = n[c];
                0 !== i[u] && (a = !1)
            }
            a && (r.splice(t--, 1), e = o(o.s = n[0]))
        }
        return e
    }

    var a = {}, c = {app: 0}, i = {app: 0}, r = [];

    function u(e) {
        return o.p + "static/js/" + ({}[e] || e) + "." + {
            "chunk-1998e2ea": "d518cb22",
            "chunk-33a2c8de": "d2a0d299",
            "chunk-3e0424f3": "98ec285b",
            "chunk-45aed970": "0e142e2d",
            "chunk-6702eaf4": "d66b5a9e",
            "chunk-6d0d808d": "1167cc21",
            "chunk-87551494": "5503b3f8",
            "chunk-0197dd74": "42a1cd01",
            "chunk-031124e8": "268fe8d6",
            "chunk-0cc0378d": "21a5138a",
            "chunk-0ec7f69c": "ffdd9593",
            "chunk-1c7cec60": "e96a3d21",
            "chunk-3a4bc4f7": "6579e3b6",
            "chunk-46446bab": "b9d15441",
            "chunk-713a9404": "596738f5",
            "chunk-ce5316f0": "58b55f8d",
            "chunk-8b580738": "d603bd9a",
            "chunk-9b2617c4": "785e8294",
            "chunk-ad3b3990": "3f127c47"
        }[e] + ".js"
    }

    function o(t) {
        if (a[t]) return a[t].exports;
        var n = a[t] = {i: t, l: !1, exports: {}};
        return e[t].call(n.exports, n, n.exports, o), n.l = !0, n.exports
    }

    o.e = function (e) {
        var t = [], n = {
            "chunk-33a2c8de": 1,
            "chunk-3e0424f3": 1,
            "chunk-45aed970": 1,
            "chunk-6702eaf4": 1,
            "chunk-6d0d808d": 1,
            "chunk-0197dd74": 1,
            "chunk-031124e8": 1,
            "chunk-0cc0378d": 1,
            "chunk-0ec7f69c": 1,
            "chunk-1c7cec60": 1,
            "chunk-3a4bc4f7": 1,
            "chunk-46446bab": 1,
            "chunk-713a9404": 1,
            "chunk-ce5316f0": 1,
            "chunk-8b580738": 1,
            "chunk-9b2617c4": 1,
            "chunk-ad3b3990": 1
        };
        c[e] ? t.push(c[e]) : 0 !== c[e] && n[e] && t.push(c[e] = new Promise(function (t, n) {
            for (var a = "static/css/" + ({}[e] || e) + "." + {
                "chunk-1998e2ea": "31d6cfe0",
                "chunk-33a2c8de": "b4ee5ecb",
                "chunk-3e0424f3": "e0fde566",
                "chunk-45aed970": "fd1f8630",
                "chunk-6702eaf4": "4f31bb8b",
                "chunk-6d0d808d": "dc31c3a1",
                "chunk-87551494": "31d6cfe0",
                "chunk-0197dd74": "949facbb",
                "chunk-031124e8": "e8d4c757",
                "chunk-0cc0378d": "41bb4f8c",
                "chunk-0ec7f69c": "8bbda70d",
                "chunk-1c7cec60": "1fd6a055",
                "chunk-3a4bc4f7": "5c0d69c3",
                "chunk-46446bab": "178f8b33",
                "chunk-713a9404": "204ecd0c",
                "chunk-ce5316f0": "563ebeb9",
                "chunk-8b580738": "cc850c1e",
                "chunk-9b2617c4": "4ab638e8",
                "chunk-ad3b3990": "6e93dca3"
            }[e] + ".css", i = o.p + a, r = document.getElementsByTagName("link"), u = 0; u < r.length; u++) {
                var s = r[u], h = s.getAttribute("data-href") || s.getAttribute("href");
                if ("stylesheet" === s.rel && (h === a || h === i)) return t()
            }
            var l = document.getElementsByTagName("style");
            for (u = 0; u < l.length; u++) {
                s = l[u], h = s.getAttribute("data-href");
                if (h === a || h === i) return t()
            }
            var d = document.createElement("link");
            d.rel = "stylesheet", d.type = "text/css", d.onload = t, d.onerror = function (t) {
                var a = t && t.target && t.target.src || i,
                    r = new Error("Loading CSS chunk " + e + " failed.\n(" + a + ")");
                r.code = "CSS_CHUNK_LOAD_FAILED", r.request = a, delete c[e], d.parentNode.removeChild(d), n(r)
            }, d.href = i;
            var f = document.getElementsByTagName("head")[0];
            f.appendChild(d)
        }).then(function () {
            c[e] = 0
        }));
        var a = i[e];
        if (0 !== a) if (a) t.push(a[2]); else {
            var r = new Promise(function (t, n) {
                a = i[e] = [t, n]
            });
            t.push(a[2] = r);
            var s, h = document.createElement("script");
            h.charset = "utf-8", h.timeout = 120, o.nc && h.setAttribute("nonce", o.nc), h.src = u(e), s = function (t) {
                h.onerror = h.onload = null, clearTimeout(l);
                var n = i[e];
                if (0 !== n) {
                    if (n) {
                        var a = t && ("load" === t.type ? "missing" : t.type), c = t && t.target && t.target.src,
                            r = new Error("Loading chunk " + e + " failed.\n(" + a + ": " + c + ")");
                        r.type = a, r.request = c, n[1](r)
                    }
                    i[e] = void 0
                }
            };
            var l = setTimeout(function () {
                s({type: "timeout", target: h})
            }, 12e4);
            h.onerror = h.onload = s, document.head.appendChild(h)
        }
        return Promise.all(t)
    }, o.m = e, o.c = a, o.d = function (e, t, n) {
        o.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: n})
    }, o.r = function (e) {
        "undefined" !== typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
    }, o.t = function (e, t) {
        if (1 & t && (e = o(e)), 8 & t) return e;
        if (4 & t && "object" === typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (o.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e) for (var a in e) o.d(n, a, function (t) {
            return e[t]
        }.bind(null, a));
        return n
    }, o.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e["default"]
        } : function () {
            return e
        };
        return o.d(t, "a", t), t
    }, o.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, o.p = "/game/biquan/", o.oe = function (e) {
        throw console.error(e), e
    };
    var s = window["webpackJsonp"] = window["webpackJsonp"] || [], h = s.push.bind(s);
    s.push = t, s = s.slice();
    for (var l = 0; l < s.length; l++) t(s[l]);
    var d = h;
    r.push([0, "chunk-vendors"]), n()
})({
    0: function (e, t, n) {
        e.exports = n("56d7")
    }, "0168": function (e, t, n) {
        e.exports = n.p + "static/media/return.7780f54a.mp3"
    }, 1023: function (e, t, n) {
        e.exports = n.p + "static/media/the mass.78dd0d72.mp3"
    }, "36cb": function (e, t, n) {
        "use strict";
        var a = n("a07d"), c = n.n(a);
        c.a
    }, "4cce": function (e, t, n) {
    }, "56d7": function (e, t, n) {
        "use strict";
        n.r(t);
        n("7fc0"), n("62d2"), n("d6eb"), n("3784");
        var a = n("eaf6"), c = function () {
                var e = this, t = e.$createElement, a = e._self._c || t;
                return a("div", {attrs: {id: "app"}}, [e.$route.meta.navShow ? a("Tabbar") : e._e(), a("div", {staticClass: "main-prod"}, [a("router-view")], 1), a("div", {staticClass: "video"}, [a("audio", {
                    ref: "audioMusic",
                    attrs: {id: "audioAll", preload: "auto", loop: ""}
                }, [a("source", {attrs: {src: n("1023"), type: "audio/mpeg"}})]), e._m(0)])], 1)
            }, i = [function () {
                var e = this, t = e.$createElement, a = e._self._c || t;
                return a("audio", {attrs: {id: "audioRetrun", preload: "auto"}}, [a("source", {
                    attrs: {
                        src: n("0168"),
                        type: "audio/mpeg"
                    }
                })])
            }], r = n("3556"), u = n("591a"), o = function () {
                var e = this, t = e.$createElement, n = e._self._c || t;
                return n("div", {attrs: {id: "tabbar"}}, [n("van-tabbar", {
                    model: {
                        value: e.active, callback: function (t) {
                            e.active = t
                        }, expression: "active"
                    }
                }, e._l(e.nav, function (t, a) {
                    return n("van-tabbar-item", {
                        key: a, on: {
                            click: function (n) {
                                return e.linkTap(t)
                            }
                        }
                    }, [n("div", [n("svg", {
                        staticClass: "icon",
                        attrs: {"aria-hidden": "true"}
                    }, [n("use", {attrs: {"xlink:href": "#" + t.icon}})])]), n("span", [e._v(e._s(t.title))])])
                }), 1)], 1)
            }, s = [], h = (n("582d"), {
                data: function () {
                    return {
                        active: 0,
                        nav: [{title: "交易", path: "/home", icon: "icon-icon-test2"}, {
                            title: "邀请",
                            path: "/invite",
                            icon: "icon-tuoluo2"
                        }, {title: "战队", path: "/combat", icon: "icon-tuoluo"}, {
                            title: "个人中心",
                            path: "/my",
                            icon: "icon-icon-test"
                        }]
                    }
                }, watch: {
                    $route: function (e, t) {
                        this.getActive()
                    }
                }, methods: {
                    getActive: function () {
                        var e = this.nav, t = this.$route.path, n = e.findIndex(function (e, n) {
                            return t === e.path
                        });
                        this.active = n
                    }, linkTap: function (e) {
                        this.$router.push(e.path)
                    }
                }, created: function () {
                    this.getActive()
                }
            }), l = h, d = (n("36cb"), n("17cc")), f = Object(d["a"])(l, o, s, !1, null, null, null), p = f.exports,
            m = n("9feb"), b = {
                name: "App", components: {Tabbar: p}, data: function () {
                    return {audiohomeRetrun: ""}
                }, computed: Object(u["c"])(["flag"]), created: function () {
                }, mounted: function () {
                    var e = this;
                    this.$nextTick(function () {
                        e.audioInit()
                    })
                }, destroyed: function () {
                    m["a"].remove("first")
                }, methods: Object(r["a"])({}, Object(u["b"])(["submitOFF", "submitON"]), {
                    audioInit: function () {
                        var e = this.$refs.audioMusic;
                        document.addEventListener("WeixinJSBridgeReady", function () {
                            e.play()
                        }, !1), e.play(), setTimeout(function () {
                            e.play()
                        }, 200)
                    }, taggleMusic: function (e) {
                        this.$store.state.flag = !this.$store.state.flag;
                        var t = this.$refs.audioMusic;
                        this.flag ? this.audioInit() : t.pause()
                    }
                })
            }, k = b, v = Object(d["a"])(k, c, i, !1, null, null, null), g = v.exports, y = n("1e6f"), w = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-0ec7f69c")]).then(function () {
                    var t = [n("fdc7")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, P = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-6d0d808d")]).then(function () {
                    var t = [n("de28")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, O = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-0197dd74")]).then(function () {
                    var t = [n("7c10")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, S = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-3a4bc4f7")]).then(function () {
                    var t = [n("8853")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, j = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-8b580738")]).then(function () {
                    var t = [n("8df7")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, x = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-6702eaf4")]).then(function () {
                    var t = [n("1668")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, E = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-ce5316f0")]).then(function () {
                    var t = [n("8ba9")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, _ = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-031124e8")]).then(function () {
                    var t = [n("545d")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, C = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-0cc0378d")]).then(function () {
                    var t = [n("5fad")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, A = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-9b2617c4")]).then(function () {
                    var t = [n("a73c")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, T = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-33a2c8de")]).then(function () {
                    var t = [n("d4b4")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, $ = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-45aed970")]).then(function () {
                    var t = [n("25de")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, I = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-713a9404")]).then(function () {
                    var t = [n("681a")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, N = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-46446bab")]).then(function () {
                    var t = [n("2ecf")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, B = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-3e0424f3")]).then(function () {
                    var t = [n("76f3")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, M = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-ad3b3990")]).then(function () {
                    var t = [n("6ad11")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            }, D = function (e) {
                return Promise.all([n.e("chunk-1998e2ea"), n.e("chunk-87551494"), n.e("chunk-1c7cec60")]).then(function () {
                    var t = [n("d051")];
                    e.apply(null, t)
                }.bind(this)).catch(n.oe)
            };
        a["a"].use(y["a"]);
        var F = new y["a"]({
            mode: "hash",
            base: "/game/biquan/",
            routes: [{path: "/", redirect: "/home"}, {
                path: "/home",
                name: "pageHome",
                component: w,
                meta: {navShow: !0, title: "King财经"}
            }, {path: "/invite", name: "pageIinvite", component: P, meta: {navShow: !0, title: "邀请"}}, {
                path: "/combat",
                name: "pageCombat",
                component: O,
                meta: {navShow: !0, title: "战队"}
            }, {path: "/my", name: "pageMy", component: S, meta: {navShow: !0, title: "个人中心"}}, {
                path: "/recharge",
                name: "pageRecharge",
                component: j,
                meta: {title: "充值"}
            }, {path: "/cash", name: "pageCash", component: x, meta: {title: "提现"}}, {
                path: "/hb-list",
                name: "pageHblist",
                component: D,
                meta: {title: "红包记录"}
            }, {
                path: "/recharge-list",
                name: "pageRechargelist",
                component: E,
                meta: {title: "充值记录"}
            }, {path: "/cahs-list", name: "pageCashlist", component: C, meta: {title: "提现记录"}}, {
                path: "/order-list",
                name: "pageOrderlist",
                component: _,
                meta: {title: "历史订单"}
            }, {path: "/novice", name: "pageNovice", component: A, meta: {title: "新手须知"}}, {
                path: "/introduction",
                name: "pageIntroduction",
                component: T,
                meta: {title: "平台介绍"}
            }, {path: "/profit", name: "pageProfit", component: $, meta: {title: "盈利模式"}}, {
                path: "/money-list",
                name: "pagemoneyList",
                component: I,
                meta: {title: "战队列表"}
            }, {path: "/ranking", name: "pageRanking", component: N, meta: {title: "排行榜"}}, {
                path: "/packet",
                name: "pagePacket",
                component: B,
                meta: {title: "拆红包"}
            }, {path: "/cell-packet", name: "pageCellpacket", component: M, meta: {title: "每天领红包"}}]
        });
        F.beforeEach(function (e, t, n) {
            e.meta.title && (document.title = e.meta.title), n()
        });
        var L = F, R = n("816c"), J = n.n(R), q = (n("79e8"), n("dc42")), U = (n("6e1c"), n("8c26")),
            H = (n("1d5e"), n("e1ec")), z = (n("09b3"), n("59c6")), K = (n("7e02"), n("fa3d")),
            W = (n("a019"), n("89d8")), G = (n("cb23"), n("e4c1")), Q = (n("282e"), n("b780")),
            V = (n("5a2e"), n("c5a9")), X = (n("ccca"), n("a6b6")), Y = (n("97d4"), n("4a27")),
            Z = (n("cd89"), n("195f")), ee = (n("5cae"), n("d2d0")), te = (n("d0a3"), n("85b6")),
            ne = (n("e563"), n("f1f5")), ae = (n("bd83"), n("c545")), ce = (n("34eb"), n("a167")),
            ie = (n("0946"), n("e3ce")), re = (n("3831"), n("1ada")), ue = (n("1d68"), n("1c4f")),
            oe = (n("1bb4"), n("e6f0"));
        a["a"].use(ue["a"]).use(oe["a"]), a["a"].use(ie["a"]).use(re["a"]), a["a"].use(ae["a"]).use(ce["a"]), a["a"].use(ne["a"]), a["a"].use(te["a"]), a["a"].use(ee["a"]), a["a"].use(Z["a"]), a["a"].use(Y["a"]), a["a"].use(X["a"]), a["a"].use(V["a"]), a["a"].use(Q["a"]), a["a"].use(G["a"]), a["a"].use(W["a"]), a["a"].use(K["a"]), a["a"].use(z["a"]), a["a"].use(U["a"]).use(H["a"]), a["a"].use(q["a"]), a["a"].use(u["a"]);
        var se = new u["a"].Store({
            state: {flag: !0}, mutations: {
                submitOFF: function (e) {
                    e.flag = !1
                }, submitON: function (e) {
                    e.flag = !0
                }
            }, getters: {}, actions: {}
        }), he = se;
        n("44ce"), n("4cce");
        a["a"].filter("getstate", function (e) {
            switch (e) {
                case 0:
                    return "已退还";
                case 1:
                    return "已成功";
                case 2:
                    return "人工提";
                case-1:
                    return "未通过审核";
                default:
                    return "非法状态"
            }
        }), a["a"].config.productionTip = !1, J.a.attach(document.body), new a["a"]({
            router: L,
            store: he,
            render: function (e) {
                return e(g)
            }
        }).$mount("#app")
    }, "9feb": function (e, t, n) {
        "use strict";
        var a = n("2919"), c = (n("568e"), n("34c6")), i = n("962b"), r = n("78e7"), u = (n("ac44"), n("7eeb")),
            o = n.n(u), s = function () {
                function e() {
                    Object(i["a"])(this, e), this.config = {
                        key: o.a.enc.Utf8.parse("9A6dfD308dd21730fdF3aa0ab1f744EA"),
                        iv: o.a.enc.Utf8.parse("CB3EC842D7C69570")
                    }
                }

                return Object(r["a"])(e, [{
                    key: "encryption", value: function (e) {
                        var t = JSON.stringify({
                            config: {
                                key: "#bsus1*hc0y7%x$jzwhov@p#@ko#!*5o",
                                time: (Date.parse(new Date) / 1e3).toString(),
                                token: ""
                            }, params: e
                        }), n = o.a.AES.encrypt(t, this.config.key, {
                            iv: this.config.iv,
                            mode: o.a.mode.ECB,
                            padding: o.a.pad.Pkcs7
                        }).toString();
                        return n
                    }
                }, {
                    key: "decryption", value: function (e) {
                        var t = o.a.enc.Base64.parse(e), n = o.a.enc.Base64.stringify(t),
                            a = o.a.AES.decrypt(n, this.config.key, {
                                iv: this.config.iv,
                                mode: o.a.mode.ECB,
                                padding: o.a.pad.Pkcs7
                            }), c = a.toString(o.a.enc.Utf8).toString();
                        return JSON.parse(c)
                    }
                }]), e
            }(), h = new s;
        n.d(t, "a", function () {
            return d
        });
        var l = function () {
            function e(t) {
                Object(i["a"])(this, e), "local" === t ? this.store = window.localStorage : "session" === t && (this.store = window.sessionStorage), this.prefix = "app_storage_"
            }

            return Object(r["a"])(e, [{
                key: "set", value: function (e, t) {
                    try {
                        t = h.encryption(t)
                    } catch (n) {
                        throw new Error(t)
                    }
                    return this.store.setItem(this.prefix + e, t), this
                }
            }, {
                key: "get", value: function (e) {
                    if (!e) throw new Error("没有找到key。");
                    if ("object" === Object(c["a"])(e)) throw new Error("key不能是一个对象。");
                    var t = this.store.getItem(this.prefix + e);
                    if (null === t) return null;
                    try {
                        t = h.decryption(t)
                    } catch (n) {
                        t = !1
                    }
                    return t.params
                }
            }, {
                key: "remove", value: function (e) {
                    return this.store.removeItem(this.prefix + e), this
                }
            }, {
                key: "all", value: function () {
                    for (var e = [], t = 0; t < this.store.length; t++) {
                        var n = this.store.key(t).replace(this.prefix, "");
                        e.push(Object(a["a"])({}, n, this.get(n)))
                    }
                    return console.log(e), e
                }
            }]), e
        }(), d = new l("local");
        new l("session")
    }, a07d: function (e, t, n) {
    }
});