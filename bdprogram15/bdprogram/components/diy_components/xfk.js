(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/diy_components/xfk"],{"099a":function(t,e,n){"use strict";n.r(e);var a=n("c02e"),r=n.n(a);for(var u in a)"default"!==u&&function(t){n.d(e,t,function(){return a[t]})}(u);e["default"]=r.a},"3d11":function(t,e,n){},"9e4e":function(t,e,n){"use strict";var a=n("3d11"),r=n.n(a);r.a},af3e:function(t,e,n){"use strict";var a,r=function(){var t=this,e=t.$createElement;t._self._c},u=[];n.d(e,"b",function(){return r}),n.d(e,"c",function(){return u}),n.d(e,"a",function(){return a})},bf87:function(t,e,n){"use strict";n.r(e);var a=n("af3e"),r=n("099a");for(var u in r)"default"!==u&&function(t){n.d(e,t,function(){return r[t]})}(u);n("9e4e");var c,o=n("f0c5"),f=Object(o["a"])(r["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],c);e["default"]=f.exports},c02e:function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"xfk",props:{xfk:{params:{},style:{},data:{}}},data:function(){return{baseinfo:""}},created:function(){},methods:{redirectto:function(t){console.log(4444);var e=t.currentTarget.dataset.link,n=t.currentTarget.dataset.linktype;this._redirectto(e,n)},makephonecall:function(){t.makePhoneCall({phoneNumber:t.getStorageSync("base_tel")})}}};e.default=n}).call(this,n("5486")["default"])}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/diy_components/xfk-create-component',
    {
        'components/diy_components/xfk-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('5486')['createComponent'](__webpack_require__("bf87"))
        })
    },
    [['components/diy_components/xfk-create-component']]
]);
