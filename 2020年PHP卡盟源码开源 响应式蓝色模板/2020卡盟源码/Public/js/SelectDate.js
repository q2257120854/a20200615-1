var klgdate = function (startyear, startmonth, startday, starthour, startminute, endyear, endmonth, endday, endhour, endminute, a1, a2, a3, a4, a5, a6, h1) {
this._startyear = klgdate.$(startyear); 
this._startmonth = klgdate.$(startmonth);
this._startday = klgdate.$(startday);
this._starthour = klgdate.$(starthour);
this._startminute = klgdate.$(startminute);
this._endyear = klgdate.$(endyear);
this._endmonth = klgdate.$(endmonth);
this._endday = klgdate.$(endday);
this._endhour = klgdate.$(endhour);
this._endminute = klgdate.$(endminute);

if (arguments.length == 17)
{
this._a1 = klgdate.$(a1);
this._a2 = klgdate.$(a2);
this._a3 = klgdate.$(a3);
this._a4 = klgdate.$(a4);
this._a5 = klgdate.$(a5);
this._a6 = klgdate.$(a6);
this._h1 = klgdate.$(h1);
if (this._h1.value != "")
{
this.setClass(klgdate.$(this._h1.value));
}
}

this.displayDate(this._startyear, this._startmonth, this._startday);
this.displayDate(this._endyear, this._endmonth, this._endday);

this._startyear.onchange = this.bind(this, this.displayDate, this._startyear, this._startmonth, this._startday);
this._startmonth.onchange = this.bind(this, this.displayDate, this._startyear, this._startmonth, this._startday);
this._endyear.onchange = this.bind(this, this.displayDate, this._endyear, this._endmonth, this._endday);
this._endmonth.onchange = this.bind(this, this.displayDate, this._endyear, this._endmonth, this._endday);
};
klgdate.$ = function (id) {
return "string" == typeof id ? document.getElementById(id) : id;
};
klgdate.prototype = {
displayDate : function (myYear, myMonth, myDate) {
var i, j, k, l;
monthDates = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
monthDates2 = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var newDateLen;
var oldDateLen = myDate.length;
var yy = myYear.options[myYear.selectedIndex].value;
var mm = myMonth.options[myMonth.selectedIndex].value;
if (this.isLeapYear(yy) == true) {
newDateLen = monthDates2[mm - 1];
} else {
newDateLen = monthDates[mm - 1];
}
if (newDateLen < oldDateLen) {
for (k = oldDateLen; k > newDateLen; k--) {
if (myDate.options[k - 1].selected) myDate.options[newDateLen - 1].selected = true;
myDate.options[k - 1] = null;
}
} else if (newDateLen > oldDateLen) {
for (l = 0; l < oldDateLen && !myDate.options[l].selected; l++) {;
}
for (k = oldDateLen; k < newDateLen; k++) {
newOption = new Option(k + 1, k + 1, false, false);
myDate.options[k] = newOption;
}
myDate.options[l].selected = true;
}
},
isLeapYear : function (yy) {
if (yy % 4 == 0) {
if (yy % 100 != 0) {
return true;
} else if (yy % 400 == 0) {
return true;
}
}
return false;
},
setdate : function (start, end)
{
var myYear = start.getFullYear();    
var myMonth = start.getMonth() + 1;    
var myDate = start.getDate();    
for(var i = 0; i < this._startyear.length; i++)
{
if(this._startyear.options[i].value == myYear)
{
this._startyear.options[i].selected = true;
break;
}
}
for(var i = 0; i < this._startmonth.length; i++)
{
if(this._startmonth.options[i].value == myMonth)
{
this._startmonth.options[i].selected = true;
break;
}
}
this.displayDate(this._startyear, this._startmonth, this._startday);
for(var i = 0; i < this._startday.length; i++)
{
if(this._startday.options[i].value == myDate)
{
this._startday.options[i].selected = true;
break;
}
}
this._starthour.options[0].selected = true;
this._startminute.options[0].selected = true;

myYear = end.getFullYear();    
myMonth = end.getMonth() + 1;    
myDate = end.getDate();  
for(var i = 0; i < this._endyear.length; i++)
{
if(this._endyear.options[i].value == myYear)
{
this._endyear.options[i].selected = true;
break;
}
}
for(var i = 0; i < this._endmonth.length; i++)
{
if(this._endmonth.options[i].value == myMonth)
{
this._endmonth.options[i].selected = true;
break;
}
}
this.displayDate(this._endyear, this._endmonth, this._endday);
for(var i = 0; i < this._endday.length; i++)
{
if(this._endday.options[i].value == myDate)
{
this._endday.options[i].selected = true;
break;
}
}
this._endhour.options[23].selected = true;
this._endminute.options[59].selected = true; 
},
setClass : function(obj)
{
this._a1.className = "date_di";
this._a2.className = "date_di";
this._a3.className = "date_di";
this._a4.className = "date_di";
this._a5.className = "date_di";
this._a6.className = "date_di"; 
obj.className = "date_di date_di_on"; 
this._h1.value = obj.id;   
},
setDate1 : function (obj) { 
var now = new Date();
var startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1); 
this.setdate(startDate, startDate);
this.setClass(obj);
},
setDate2 : function (obj) { 
var now = new Date();
this.setdate(now, now);
this.setClass(obj);
},
setDate3 : function (obj) { 
var now = new Date();
var nowDayOfWeek = now.getDay();         //今天本周的第几天 
nowDayOfWeek = nowDayOfWeek == 0 ? 7 : nowDayOfWeek;
var startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - nowDayOfWeek + 1); 
this.setdate(startDate, now);
this.setClass(obj);
}, 
setDate4 : function (obj) { 
var now = new Date();
var startDate = new Date(now.getFullYear(), now.getMonth(), 1); 
this.setdate(startDate, now);
this.setClass(obj);
},
setDate5 : function (obj) { 
var now = new Date();
var startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7); 
this.setdate(startDate, now);
this.setClass(obj);
},
setDate6 : function (obj) { 
var now = new Date();
var startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 31); 
this.setdate(startDate, now);
this.setClass(obj);
},
setDate7 : function (obj) { 
var now = new Date();
var startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 93); 
this.setdate(startDate, now);
this.setClass(obj);
},
bind : function (object, fun) {
var args = Array.prototype.slice.call(arguments).slice(2);
return function () {
return fun.apply(object, args.concat(Array.prototype.slice.call(arguments)));
}
}
};