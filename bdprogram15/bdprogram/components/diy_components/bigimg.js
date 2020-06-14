(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/bigimg"],{"0435":function(t,e,n){"use strict";n.r(e);var r=n("08cb"),a=n.n(r);for(var u in r)"default"!==u&&function(t){n.d(e,t,function(){return r[t]})}(u);e["default"]=a.a},"08cb":function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"bigimg",props:{bigimg:{type:Object,value:"bigimg"}},data:function(){return{baseinfo:""}},created:function(){},methods:{redirectto:function(t){var e=t.currentTarget.dataset.link,n=t.currentTarget.dataset.linktype;this._redirectto(e,n)},makephonecall:function(){t.makePhoneCall({phoneNumber:t.getStorageSync("base_tel")})}}};e.default=n}).call(this,n("5486")["default"])},"52bb":function(t,e,n){"use strict";n.r(e);var r=n("f2bb"),a=n("0435");for(var u in a)"default"!==u&&function(t){n.d(e,t,function(){return a[t]})}(u);var c,i=n("f0c5"),o=Object(i["a"])(a["default"],r["b"],r["c"],!1,null,null,null,!1,r["a"],c);e["default"]=o.exports},f2bb:function(t,e,n){"use strict";var r,a=function(){var t=this,e=t.$createElement;t._self._c},u=[];n.d(e,"b",function(){return a}),n.d(e,"c",function(){return u}),n.d(e,"a",function(){return r})}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/bigimg-create-component',
    {
        'components/diy_components/bigimg-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("52bb"))
        })
    },
    [['components/diy_components/bigimg-create-component']]
]);
