
<script language="JavaScript" type="text/javascript" src='/Public/js/SelectDate.js'></script>
<strong>从</strong>&nbsp;<select name="StartYear" id="Date1_StartYear">
<?php
$yei=2013;
if ($_GET['StartYear']==''){
$StartYears=date("Y");
}else{
$StartYears=$_GET['StartYear'];
}

while($yei<=2040) {?>
<option <?php if ($StartYears==$yei){?>selected="selected"<?php } ?> value="<?=$yei?>"><?=$yei?></option>
<?php
$yei++;
}
?>
</select> 
年
<select name="StartMonth" id="Date1_StartMonth">
<?php
$mi=1;
if ($_GET['StartMonth']==''){
$StartMonths=date("m");
}else{
$StartMonths=$_GET['StartMonth'];
}
while($mi<=12) {?>
<option <?php if ($StartMonths==$mi){?>selected="selected"<?php } ?> value="<?=$mi?>"><?=$mi?></option>
<?php
$mi++;
}
?>
</select>
月
<select name="StartDay" id="Date1_StartDay">
<?php
$di=1;
if ($_GET['StartDay']==''){
$StartDays=1;
}else{
$StartDays=$_GET['StartDay'];
}
while($di<=31) {?>
<option <?php if ($di==$StartDays){?>selected="selected"<?php } ?> value="<?=$di?>"><?=$di?></option>
<?php
$di++;
}
?>
</select>
日
<select name="StartHour" id="Date1_StartHour">
<option selected="selected" value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select>
点
<select name="StartMinute" id="Date1_StartMinute">
<option selected="selected" value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
</select>
分<br />
<strong>至</strong>&nbsp;<select name="EndYear" id="Date1_EndYear">
<?php
$yei=2013;
if ($_GET['EndYear']==''){
$EndYears=date("Y");
}else{
$EndYears=$_GET['EndYear'];
}
while($yei<=2040) {?>
<option <?php if ($EndYears==$yei){?>selected="selected"<?php } ?> value="<?=$yei?>"><?=$yei?></option>
<?php
$yei++;
}
?>
</select> 年
<select name="EndMonth" id="Date1_EndMonth">
<?php
$mi=1;
if ($_GET['EndMonth']==''){
$EndMonths=date("m");
}else{
$EndMonths=$_GET['EndMonth'];
}
while($mi<=12){?>
<option <?php if ($EndMonths==$mi){?>selected="selected"<?php } ?> value="<?=$mi?>"><?=$mi?></option>
<?php
$mi++;
}
?>
</select>
月
<select name="EndDay" id="Date1_EndDay">
<?php
$di=1;
if ($_GET['EndDay']==''){
$EndDays=date("d");
}else{
$EndDays=$_GET['EndDay'];
}
while($di<=31){?>
<option <?php if ($EndDays==$di){?>selected="selected"<?php }?> value="<?=$di?>"><?=$di?></option>
<?php
$di++;
}
?>
</select>
日
<select name="EndHour" id="Date1_EndHour">
<option value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option selected="selected" value="23">23</option>
</select>
点
<select name="EndMinute" id="Date1_EndMinute">
<option value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option selected="selected" value="59">59</option>
</select>
分
<a href="javascript:" id="Date1_a1" class="date_di">昨 天</a>
<a href="javascript:" id="Date1_a2" class="date_di">今 天</a>
<a href="javascript:" id="Date1_a3" class="date_di">本 周</a>
<a href="javascript:" id="Date1_a4" class="date_di date_di_on">本 月</a>
<a href="javascript:" id="Date1_a5" class="date_di">近1周</a>
<a href="javascript:" id="Date1_a6" class="date_di">近1月</a>
<a href="javascript:" id="Date1_a7" class="date_di">近3月</a>
<input type="hidden" name="HiddenField1" id="Date1_HiddenField1" value="<?=$_GET['HiddenField1']?>" />
<script type="text/javascript" language="javascript">
if (typeof klgdate == "function") {
if (klgdate.$("Date1_HiddenField1") != null)
{
var klgdate1 = new klgdate("Date1_StartYear", "Date1_StartMonth", "Date1_StartDay", "Date1_StartHour", "Date1_StartMinute", "Date1_EndYear", "Date1_EndMonth", "Date1_EndDay", "Date1_EndHour", "Date1_EndMinute", "Date1_a1", "Date1_a2", "Date1_a3", "Date1_a4", "Date1_a5", "Date1_a6", "Date1_HiddenField1");
klgdate.$("Date1_a1").href = "javascript:klgdate1.setDate1(klgdate.$('Date1_a1'))";
klgdate.$("Date1_a2").href = "javascript:klgdate1.setDate2(klgdate.$('Date1_a2'))";
klgdate.$("Date1_a3").href = "javascript:klgdate1.setDate3(klgdate.$('Date1_a3'))";
klgdate.$("Date1_a4").href = "javascript:klgdate1.setDate4(klgdate.$('Date1_a4'))";
klgdate.$("Date1_a5").href = "javascript:klgdate1.setDate5(klgdate.$('Date1_a5'))";
klgdate.$("Date1_a6").href = "javascript:klgdate1.setDate6(klgdate.$('Date1_a6'))";
klgdate.$("Date1_a7").href = "javascript:klgdate1.setDate7(klgdate.$('Date1_a7'))";
}
else
{
var klgdate1 = new klgdate("Date1_StartYear", "Date1_StartMonth", "Date1_StartDay", "Date1_StartHour", "Date1_StartMinute", "Date1_EndYear", "Date1_EndMonth", "Date1_EndDay", "Date1_EndHour", "Date1_EndMinute");
}
}
</script>