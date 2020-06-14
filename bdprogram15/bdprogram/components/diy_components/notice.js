(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/notice"],{"1a66":function(t,e,n){},"23b1":function(t,e,n){"use strict";var a=n("1a66"),c=n.n(a);c.a},"4a13":function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"notice",props:{notice:{type:Object,value:"notice"}},data:function(){return{baseinfo:""}},created:function(){},methods:{redirectto:function(t){console.log(4444);var e=t.currentTarget.dataset.link,n=t.currentTarget.dataset.linktype;this._redirectto(e,n)},makephonecall:function(){t.makePhoneCall({phoneNumber:t.getStorageSync("base_tel")})}}};e.default=n}).call(this,n("5486")["default"])},cd76:function(t,e,n){"use strict";n.r(e);var a=n("e4f1"),c=n("d5fe");for(var o in c)"default"!==o&&function(t){n.d(e,t,function(){return c[t]})}(o);n("23b1");var r,u=n("f0c5"),i=Object(u["a"])(c["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],r);e["default"]=i.exports},d5fe:function(t,e,n){"use strict";n.r(e);var a=n("4a13"),c=n.n(a);for(var o in a)"default"!==o&&function(t){n.d(e,t,function(){return a[t]})}(o);e["default"]=c.a},e4f1:function(t,e,n){"use strict";var a,c=function(){var t=this,e=t.$createElement;t._self._c},o=[];n.d(e,"b",function(){return c}),n.d(e,"c",function(){return o}),n.d(e,"a",function(){return a})}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/notice-create-component',
    {
        'components/diy_components/notice-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("cd76"))
        })
    },
    [['components/diy_components/notice-create-component']]
]);
