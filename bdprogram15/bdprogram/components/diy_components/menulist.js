(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/menulist"],{6728:function(t,n,e){"use strict";(function(t){Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e={name:"menulist",props:{menulist:{type:Object,value:"menulist"}},data:function(){return{baseinfo:""}},created:function(){},methods:{redirectto:function(t){var n=t.currentTarget.dataset.link,e=t.currentTarget.dataset.linktype;this._redirectto(n,e)},makephonecall:function(){t.makePhoneCall({phoneNumber:t.getStorageSync("base_tel")})}}};n.default=e}).call(this,e("5486")["default"])},a1bb:function(t,n,e){"use strict";e.r(n);var a=e("6728"),u=e.n(a);for(var r in a)"default"!==r&&function(t){e.d(n,t,function(){return a[t]})}(r);n["default"]=u.a},b66a:function(t,n,e){},b6bb:function(t,n,e){"use strict";var a,u=function(){var t=this,n=t.$createElement;t._self._c},r=[];e.d(n,"b",function(){return u}),e.d(n,"c",function(){return r}),e.d(n,"a",function(){return a})},bbd8:function(t,n,e){"use strict";e.r(n);var a=e("b6bb"),u=e("a1bb");for(var r in u)"default"!==r&&function(t){e.d(n,t,function(){return u[t]})}(r);e("db0f");var c,o=e("f0c5"),i=Object(o["a"])(u["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],c);n["default"]=i.exports},db0f:function(t,n,e){"use strict";var a=e("b66a"),u=e.n(a);u.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/menulist-create-component',
    {
        'components/diy_components/menulist-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("bbd8"))
        })
    },
    [['components/diy_components/menulist-create-component']]
]);
