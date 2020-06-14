(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/contact"],{"37e9":function(t,e,n){"use strict";n.r(e);var r=n("9d84"),a=n("c2e6");for(var c in a)"default"!==c&&function(t){n.d(e,t,function(){return a[t]})}(c);var u,o=n("f0c5"),i=Object(o["a"])(a["default"],r["b"],r["c"],!1,null,null,null,!1,r["a"],u);e["default"]=i.exports},"9d84":function(t,e,n){"use strict";var r,a=function(){var t=this,e=t.$createElement;t._self._c},c=[];n.d(e,"b",function(){return a}),n.d(e,"c",function(){return c}),n.d(e,"a",function(){return r})},c2e6:function(t,e,n){"use strict";n.r(e);var r=n("f734"),a=n.n(r);for(var c in r)"default"!==c&&function(t){n.d(e,t,function(){return r[t]})}(c);e["default"]=a.a},f734:function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"contact",props:{contact:{type:Object,value:"contact"}},data:function(){return{}},created:function(){},methods:{redirectto:function(t){var e=t.currentTarget.dataset.link,n=t.currentTarget.dataset.linktype;this._redirectto(e,n)},makephone:function(e){var n=e.currentTarget.dataset.tel;t.makePhoneCall({phoneNumber:n})},ewmshow:function(e){t.previewImage({current:e.currentTarget.dataset.ewm,urls:[e.currentTarget.dataset.ewm]})}}};e.default=n}).call(this,n("5486")["default"])}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/contact-create-component',
    {
        'components/diy_components/contact-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("37e9"))
        })
    },
    [['components/diy_components/contact-create-component']]
]);
