
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<!-- jQuery元素 开始 -->
<script src="http://batian.22km.cn:80/js/main/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQuery元素 结束 -->

<!-- 基本元素 开始 -->
<link href="http://batian.22km.cn:80/front/2016/11/08/01/css/style.css" rel="stylesheet" type="text/css" />
<!-- 基本元素 结束 -->

<!-- 表单元素 开始 -->
<script src="http://batian.22km.cn:80/js/main/jquery.form.js" type="text/javascript"></script>
<!-- 表单元素 结束 -->

<!-- 时间元素 开始 -->
<link href="http://batian.22km.cn:80/css/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="http://batian.22km.cn:80/js/jQueryUI/jquery-ui.js" type="text/javascript"></script>
<script src="http://batian.22km.cn:80/js/util/DateUtil.js" type="text/javascript"></script>
<!-- 时间元素 结束 -->
</head>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>销售记录查询</b>
		</h3>
		<div id="menuBox">








<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
	var now = new Date(); //当前日期     
	var nowDayOfWeek = now.getDay(); //今天本周的第几天     
	var nowDay = now.getDate(); //当前日     
	var nowMonth = now.getMonth(); //当前月     
	var nowYear = now.getYear(); //当前年     
	nowYear += (nowYear < 2000) ? 1900 : 0; //

	//格式化日期：yyyy-MM-dd     
	function formatDate(date) {
		var myyear = date.getFullYear();
		var mymonth = date.getMonth() + 1;
		var myweekday = date.getDate();

		if (mymonth < 10) {
			mymonth = "0" + mymonth;
		}
		if (myweekday < 10) {
			myweekday = "0" + myweekday;
		}
		return (myyear + "-" + mymonth + "-" + myweekday);
	}
	function getWeekStartDate() {
		var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);
		return formatDate(weekStartDate);
	}
	//获得本月的开始日期     
	function getMonthStartDate() {
		var monthStartDate = new Date(nowYear, nowMonth, 1);
		return formatDate(monthStartDate);
	}
</script>
<script type="text/javascript">
	$().ready(function(){
		$.datepicker.setDefaults({
			dateFormat : "yy-mm-dd", // 日期格式
			// showAnim : "scale", //显示效果 slide | scale | fadeIn
			// showButtonPanel : true, //显示按钮面板
			// currentText : "今天",
			// closeText : "完成",
			showOn : "button",
			buttonImage : "http://batian.22km.cn/front/imgs/calendar.gif",
			buttonImageOnly : true,
			selectOtherMonths : true,
			defaultDate : +7,// 默认时间
			dayNamesMin : [ "日", "一", "二", "三", "四", "五", "六" ],
			monthNames : [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月","9月", "10月", "11月", "12月" ],
			beforeShow : function(picker) { // 开始日期小于结束日期
				/*
				 * return { minDate : (picker.id == "pickerEndDate" ?
				 * $("#startTime").datepicker("getDate"): null), maxDate :
				 * (picker.id == "pickerStartDate" ?
				 * $("#endTime").datepicker("getDate") : null) }
				 */
				// alert(picker.value);
			}
		});
		$("#startTime,#endTime").datepicker();
		$("#startTime").val($.formatDate(new Date(), 2, 0));
		$("#endTime").val($.formatDate(new Date(), 2, 1));
			
			
		//时间控件样式
		$(".period a").click(function(){
			$(".period a").attr("class","date_di");
			$(this).attr("class","date_di date_di_on");
		});
		$("a[name='afterday']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -1));
		});
		$("a[name='today']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, 0));
		});
		$("a[name='toweek']").click(function(){
			$("#startTime").val(getWeekStartDate());
		});
		$("a[name='tomonth']").click(function(){
			$("#startTime").val(getMonthStartDate());
		});
			 
		$("a[name='theweek']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -7));
		});
		$("a[name='themonth']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -30));
		});
		$("a[name='thetree']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -90));
		});
	});
</script>


		<form name="saleForm" id="saleForm">
			<div class="capi-search">
				<dl>
					<dt>查询条件</dt>
					<dd>
						<input name="inputKeyWord" id="inputKeyWord" type="text" class="input2">
					</dd>
					<dd>
					<select id="inputKeyValue" name="inputKeyValue">
						<option value="1">充值账号</option>
						<option value="2">订单号</option>
						<option value="3">商品名称</option>
					</select>
					</dd>
					<dd>
					<select id="goodType" name="goodType">
						<option value="0">全部类型</option>
						<option value="1,2">卡密类</option>
						<option value="3">人工代充类</option>
					</select>
				</dd>
				</dl>
				<dl>
					<dt>订单状态</dt>
					<dd>
						<span id="CheckBoxList1">
  							<label><input type="checkbox" value="1" name="orderState" id="orderState">等待处理</label>
  							<label><input type="checkbox" value="2" name="orderState" id="orderState">正在充值</label>
  							<label><input type="checkbox" value="3" name="orderState" id="orderState">交易成功</label>
  							<label><input type="checkbox" value="4" name="orderState" id="orderState">交易取消</label>
  							</span>
					</dd>
				</dl>
				<dl class="period">
					<dt>查询时段</dt>
					<dd>
						<input type="text" id="startTime" readonly="readonly" name="startTime" value="" class="hasDatepicker"><img class="ui-datepicker-trigger" src="http://batian.22km.cn/front/imgs/calendar.gif" alt="..." title="..."> - <input type="text" id="endTime" readonly="readonly" name="endTime" value="" class="hasDatepicker"><img class="ui-datepicker-trigger" src="http://batian.22km.cn/front/imgs/calendar.gif" alt="..." title="...">
						<a href="javascript:void(0);" name="afterday" class="date_di">昨天</a>
	                    <a href="javascript:void(0);" name="today" class="date_di date_di_on">今天</a>
	                    <a href="javascript:void(0);" name="toweek" class="date_di">本周</a>
	                    <a href="javascript:void(0);" name="tomonth" class="date_di">本月</a>
	                    <a href="javascript:void(0);" name="theweek" class="date_di">近一周</a>
	                    <a href="javascript:void(0);" name="themonth" class="date_di">近一月</a>
	                    <a href="javascript:void(0);" name="thetree" class="date_di">近三月</a>
					</dd>
				</dl>
				<dl class="opear">
					<dt>
						<input name="nowPage" id="nowPage" value="1" type="hidden">
					</dt>
					<dd>
						<input id="btn_search_user" type="button" value="查询" class="btn1">
					</dd>
				</dl>
			</div>
		</form>
		<div id="paramBox" class="capi-tbl capital">







  
    <title></title>
  
  
  
  	<table>
     <thead>
    	<tr>
        	<th>购买日期</th>
            <th>商品名称</th>
            <th>类型</th>
            <th>数量</th>
            <th>购买单价</th>
            <th>面值</th>
			<th>投诉</th>
            <th>状态</th>
        </tr>
    </thead>
    <tbody>
    	
       
       	<tr class="trd">
					<td align="center">2018-04-21 18:11:39 </td>
					<td align="center">test</td>
					<td align="center">类型</td>
					<td align="center">1</td>
					<td align="center">0.00</td>
					<td align="center">1.00</td>
					<td align="center">投诉订单</td>
					<td align="center">状态</td>
				</tr>
       
  </tbody>
  </table>
  
  <form id="selectOrderForm" name="selectOrderForm" method="post">
					<input type="hidden" value="1" id="allpage" name="allPage">
					<input type="hidden" value="1" id="nowpage" name="nowPage">
					<input type="hidden" value="20" id="everypage" name="everyPage">
					<input type="hidden" value="" name="inputKeyWord">
					<input type="hidden" value="1" name="inputKeyValue">
					<input type="hidden" value="" name="orderState">
					<input type="hidden" value="0" name="goodType">
					<input type="hidden" value="2018-04-21" name="startTime">
					<input type="hidden" value="2018-04-22" name="endTime">
				
					</form>
  <script type="text/javascript">
	$(document).ready(function(){
		$("a[name='showorder']").click(function(){
		var orderid=$(this).attr("id");
		parent.Dialog.win({
			title:"订单详细信息<span style='color:red;font-weight: normal;margin-left:25px;'>注意事项：鼠标移到文字上可以查看隐藏的信息</span>",
			iframe:{src:"inter/showordermess.htm?orderid="+orderid},
			width:900,
			height:550
		});
	});
	
	//分页查询
	cutPageOrder=function(num){
		var nowPage=$("#nowpage").val();
		var allPage=$("#allpage").val();
	
		if(num==0){
			$("#nowpage").val("1");
		}
		if(num==-1){
			nowPage=nowPage-1;
			if(nowPage<1){
				nowPage=1;
			}
			
			$("#nowpage").val(nowPage);
		} 
		if(num==1){
			nowPage=parseInt(nowPage)+1;
			if(nowPage>=allPage){
				nowPage=allPage;
			}
			$("#nowpage").val(nowPage);
			
		}
		if(num==2){
			$("#nowpage").val(allPage);	
		}
		
		
		$("#selectOrderForm").ajaxForm({
			url:"salelist.htm",
			dataType:"html",
			type:"post",
			success:function(data){
				$("#paramBox").html(data);
			}
			
		});
		
		$("#selectOrderForm").submit();
	};
	
	});

var ifrheight= Math.min(window.document.documentElement.scrollHeight,window.document.body.scrollHeight);
window.parent.parent.parent.document.getElementById("right").style.height=ifrheight+50+"px";
</script>
<script type="text/javascript">
	$(document).ready(function(){
		InitPage();
	});
	
	function InitPage() {
		$(".table1 .trd").each(function (i) {
        	if (i % 2 == 0) {
            	$(this).addClass("tr1");
            }
            else {
                $(this).addClass("tr2");
            }
            $(this).bind("mouseover", function () {
                this.style.backgroundColor = "#a2dcff";
            });
            $(this).bind("mouseout", function () {
                this.style.backgroundColor = "";
            });
        });
	}
</script>
  

</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#saleForm").ajaxForm({
				url : "salelist.htm",
				type : "post",
				dataType : "html",
				success : function(data) {
					$("#paramBox").html(data);
				}
			});
			$("#saleForm").submit();

			$("#btn_search_user").click(function() {
				$("#saleForm").ajaxForm({
					url : "salelist.htm",
					type : "post",
					dataType : "html",
					success : function(data) {
						$("#paramBox").html(data);
					}
				});
				$("#saleForm").submit();
			});
		});
	</script>


</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#menuBox").load("salerecordparam.htm");
		});
	</script>


<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body>
</Html>
