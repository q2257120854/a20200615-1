(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pagesOther/liveshow_list/liveshow_list"],{"0da2":function(t,a,n){"use strict";var i=n("9fd6"),e=n.n(i);e.a},"0f51":function(t,a,n){"use strict";var i={myfooter:()=>n.e("components/myfooter/myfooter").then(n.bind(null,"6bab"))},e=function(){var t=this,a=t.$createElement;t._self._c},o=[];n.d(a,"b",function(){return e}),n.d(a,"c",function(){return o}),n.d(a,"a",function(){return i})},"411b":function(t,a,n){"use strict";(function(t){Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var i=n("88e4"),e={data:function(){return{$imgurl:this.$imgurl,$host:this.$host,baseinfo:"",page:1,list:[],roomId:""}},onPullDownRefresh:function(){var a=this;a.page=1,a.getShowList(),t.stopPullDownRefresh()},onReachBottom:function(){var a=this,n=a.page+1;t.request({url:this.$host+"/api/mainwxapp/LiveBroadcastList",data:{uniacid:a.$uniacid,page:n},success:function(i){1==i.data.data.err&&t.showModal({title:"提示",content:i.data.data.errmsg,showCancel:!1}),""!=i.data.data&&(a.list=a.list.concat(i.data.data),a.page=n)}})},onLoad:function(t){var a=this;this._baseMin(this),i.bdLogin(0,function(){a.getShowList()})},methods:{getShowList:function(){var a=this;t.request({url:this.$host+"/api/mainwxapp/LiveBroadcastList",data:{uniacid:a.$uniacid,page:a.page},success:function(n){1==n.data.data.err&&t.showModal({title:"提示",content:n.data.data.errmsg,showCancel:!1}),a.list=n.data.data}})},toShow:function(a){var n=this,i=a.currentTarget.dataset.rid,e=a.currentTarget.dataset.index;n.roomId=i,t.request({url:this.$host+"/api/mainwxapp/LiveTraffic",data:{uniacid:n.$uniacid,room_id:n.roomId},success:function(t){"访问量增加"==t.data.msg&&(n.list[e].visit_num=n.list[e].visit_num+1)}});var o="plugin-private://wx2b03c6e691cd7370/pages/live-player-plugin?room_id="+i;t.navigateTo({url:o})}}};a.default=e}).call(this,n("5486")["default"])},"9fd6":function(t,a,n){},b739:function(t,a,n){"use strict";(function(t){n("d28f");i(n("66fd"));var a=i(n("c257"));function i(t){return t&&t.__esModule?t:{default:t}}t(a.default)}).call(this,n("5486")["createPage"])},c257:function(t,a,n){"use strict";n.r(a);var i=n("0f51"),e=n("f844");for(var o in e)"default"!==o&&function(t){n.d(a,t,function(){return e[t]})}(o);n("0da2");var s,r=n("f0c5"),u=Object(r["a"])(e["default"],i["b"],i["c"],!1,null,null,null,!1,i["a"],s);a["default"]=u.exports},f844:function(t,a,n){"use strict";n.r(a);var i=n("411b"),e=n.n(i);for(var o in i)"default"!==o&&function(t){n.d(a,t,function(){return i[t]})}(o);a["default"]=e.a}},[["b739","common/runtime","common/vendor"]]]);