(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/service"],{"0086":function(e,t,n){"use strict";n.r(t);var r=n("71e1"),c=n("3454");for(var o in c)"default"!==o&&function(e){n.d(t,e,function(){return c[e]})}(o);var a,u=n("f0c5"),i=Object(u["a"])(c["default"],r["b"],r["c"],!1,null,null,null,!1,r["a"],a);t["default"]=i.exports},3454:function(e,t,n){"use strict";n.r(t);var r=n("a5fc"),c=n.n(r);for(var o in r)"default"!==o&&function(e){n.d(t,e,function(){return r[e]})}(o);t["default"]=c.a},"71e1":function(e,t,n){"use strict";var r,c=function(){var e=this,t=e.$createElement;e._self._c},o=[];n.d(t,"b",function(){return c}),n.d(t,"c",function(){return o}),n.d(t,"a",function(){return r})},a5fc:function(e,t,n){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n={name:"service",props:{service:{type:Object,value:"service"}},data:function(){return{baseinfo:""}},created:function(){console.log(this.service)},methods:{redirectto:function(e){var t=e.currentTarget.dataset.link,n=e.currentTarget.dataset.linktype;console.log(t),console.log(n),this._redirectto(t,n)},makephonecall:function(){e.makePhoneCall({phoneNumber:e.getStorageSync("base_tel")})}}};t.default=n}).call(this,n("5486")["default"])}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/service-create-component',
    {
        'components/diy_components/service-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("0086"))
        })
    },
    [['components/diy_components/service-create-component']]
]);
