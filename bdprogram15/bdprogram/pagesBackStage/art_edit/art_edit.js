(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pagesBackStage/art_edit/art_edit"],{"331f":function(t,e,i){"use strict";i.r(e);var a=i("f39b"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,function(){return a[t]})}(s);e["default"]=n.a},"6b00":function(t,e,i){"use strict";var a={datetime:()=>i.e("components/datetime/datetime").then(i.bind(null,"c598"))},n=function(){var t=this,e=t.$createElement;t._self._c},s=[];i.d(e,"b",function(){return n}),i.d(e,"c",function(){return s}),i.d(e,"a",function(){return a})},"6d85":function(t,e,i){"use strict";i.r(e);var a=i("6b00"),n=i("331f");for(var s in n)"default"!==s&&function(t){i.d(e,t,function(){return n[t]})}(s);i("e6f3");var o,c=i("f0c5"),r=Object(c["a"])(n["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],o);e["default"]=r.exports},"917f":function(t,e,i){},a992:function(t,e,i){"use strict";(function(t){i("d28f");a(i("66fd"));var e=a(i("6d85"));function a(t){return t&&t.__esModule?t:{default:t}}t(e.default)}).call(this,i("5486")["createPage"])},e6f3:function(t,e,i){"use strict";var a=i("917f"),n=i.n(a);n.a},f39b:function(t,e,i){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=function(){return i.e("components/datetime/datetime").then(i.bind(null,"c598"))},n=(i("88e4"),{data:function(){return{baseinfo:"",$imgurl:this.$imgurl,nid:0,editorBox:0,readOnly:!1,formats:{},release_img:"",cates_all:[],cates_all_name:[],current_cate:0,cate_index:0,pro_thumb:"",update_time:"",start_year:2019,end_year:2060,isShare:!1,art_name:"",look_num:"",art_text:"",art_editor_text:"",art_money:"",art_onejf:"",art_limitjf:"",is_sub:0,w_width:"",w_height:""}},components:{datetime:a},onLoad:function(e){this._baseMin(this);var i=this;e.nid?(this.nid=e.nid,this.getNewsInfo()):this.getNewsCates(),t.getSystemInfo({success:function(t){i.w_width=t.windowWidth,i.w_height=t.windowHeight}}),t.loadFontFace({family:"Pacifico",source:'url("https://sungd.github.io/Pacifico.ttf")'})},onPullDownRefresh:function(){this.nid?this.getNewsInfo():this.getNewsCates(),t.stopPullDownRefresh()},methods:{getNewsInfo:function(){var e=this;t.request({url:this.$host+"/api/Managewxapp/getNewsInfo",data:{uniacid:this.$uniacid,suid:t.getStorageSync("suid"),nid:e.nid},success:function(i){if(0==i.data.data.error){var a=i.data.data.news;e.art_name=a.title,e.cates_all=a.cates_all,e.cates_all_name=a.cates_all_name,e.cate_index=a.cate_index,e.current_cate=a.cid,e.pro_thumb=a.thumb,e.update_time=a.edittime,e.look_num=a.hits,e.art_text=a.desc,e.art_editor_text=a.text,a.music_art_info&&(e.art_money=a.music_art_info.art_price),e.isShare=1==a.get_share_gz,e.isShare&&(e.art_onejf=a.get_share_score,e.art_limitjf=a.get_share_num)}else t.showModal({title:"提示",content:i.data.data.msg,showCancel:!1,success:function(e){t.navigateBack({})}})}})},getNewsCates:function(){var e=this;t.request({url:this.$host+"/api/Managewxapp/getNewsCatesForAdd",data:{uniacid:this.$uniacid,suid:t.getStorageSync("suid")},success:function(t){e.cates_all=t.data.data.cates.cates_all,e.cates_all_name=t.data.data.cates.cates_all_name,e.current_cate=e.cates_all[0].id}})},input_name:function(t){this.art_name=t.detail.value},input_look:function(t){this.look_num=t.detail.value},input_artText:function(t){this.art_text=t.detail.value},input_artMoney:function(t){this.art_money=t.detail.value},input_onejf:function(t){this.art_onejf=t.detail.value},input_limitjf:function(t){this.art_limitjf=t.detail.value},chooseCate:function(t){this.cate_index=t.target.value,this.current_cate=this.cates_all[this.cate_index]["id"]},openDatetimePicker:function(t){this.$refs.myPicker.show()},closeDatetimePicker:function(){this.$refs.myPicker.hide()},handleSubmit:function(t){this.update_time="".concat(t.year,"-").concat(t.month,"-").concat(t.day," ").concat(t.hour,":").concat(t.minute)},changeJfShare:function(){this.isShare=!this.isShare},getEditor:function(){t.showModal({title:"提示",content:"此端暂不支持富文本编辑，请前往H5端、微信端或后台填写详情！",showCancel:!1,success:function(t){}})},closeEditor:function(){var t=this;t.editorBox=0},chooseThumb:function(){this.chooseImg(1)},readOnlyChange:function(){this.readOnly=!this.readOnly},onEditorReady:function(){var e=this;t.createSelectorQuery().select("#editor").context(function(t){e.editorCtx=t.context,e.editorCtx.setContents({html:e.art_editor_text})}).exec()},undo:function(){this.editorCtx.undo()},redo:function(){this.editorCtx.redo()},format:function(t){var e=t.target.dataset,i=e.name,a=e.value;i&&this.editorCtx.format(i,a)},onStatusChange:function(t){var e=t.detail;this.formats=e},insertDivider:function(){this.editorCtx.insertDivider({success:function(){console.log("insert divider success")}})},clear:function(){this.editorCtx.clear({success:function(t){console.log("clear success")}})},removeFormat:function(){this.editorCtx.removeFormat()},insertDate:function(){var t=new Date,e="".concat(t.getFullYear(),"/").concat(t.getMonth()+1,"/").concat(t.getDate());this.editorCtx.insertText({text:e})},insertImage:function(){this.chooseImg(2)},chooseImg:function(e){var i=this,a=i.$baseurl+"wxupimg";t.chooseImage({count:9,sizeType:["original","compressed"],sourceType:["album","camera"],success:function(n){t.showLoading({title:"图片上传中"});var s=n.tempFilePaths,o=0,c=(s.length,function(){t.uploadFile({url:a,formData:{uniacid:i.$uniacid},filePath:s[o],name:"file",success:function(a){a.data;1==e&&(i.pro_thumb=a.data),2==e&&i.editorCtx.insertImage({src:a.data,alt:"图像",success:function(){console.log("insert image success")}}),t.hideLoading()},fail:function(t){console.log(t)}})});c(),console.log(i.release_img)}})},saveContent:function(){var t=this;this.editorCtx.getContents({success:function(e){t.art_editor_text=e.html,t.editorBox=0}})},errorMsg:function(e){t.showToast({title:e,duration:1e3,icon:"none"})},formSubmit:function(e){if(1==this.is_sub)return!1;var i={};return this.art_name?(i["title"]=this.art_name,this.current_cate?(i["cid"]=this.current_cate,this.pro_thumb?(i["thumb"]=this.pro_thumb,this.product_txt||(this.product_txt="请填写文章详情"),i["edittime"]=this.update_time,i["hits"]=this.look_num,i["art_price"]=this.art_money,i["get_share_gz"]=this.isShare?1:2,i["desc"]=this.art_text,this.isShare&&(i["get_share_num"]=this.art_limitjf,i["get_share_score"]=this.art_onejf),this.is_sub=1,void t.request({url:this.$host+"/api/Managewxapp/saveNewsInfo",data:{uniacid:this.$uniacid,suid:t.getStorageSync("suid"),nid:this.nid,art_data:JSON.stringify(i),art_txt:this.art_editor_text},success:function(e){if(0!=e.data.data.error)return t.showModal({title:"提示",content:e.data.data.msg,showCancel:!1,success:function(t){}}),!1;t.showModal({title:"提示",content:"保存成功",showCancel:!1,success:function(e){e.confirm&&t.reLaunch({url:"/pagesBackStage/content_manage/content_manage?type=1"})}})}})):(this.errorMsg("请上传文章缩略图"),!1)):(this.errorMsg("请选择文章所属栏目"),!1)):(this.errorMsg("文章标题不能为空"),!1)}}});e.default=n}).call(this,i("5486")["default"])}},[["a992","common/runtime","common/vendor"]]]);