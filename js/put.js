<!--
function catch_keydown(sel)
{
switch(event.keyCode)
{
case 13:
//Enter;
sel.options[sel.length] = new Option("","",false,true);
event.returnValue = false;
break;
case 27:
//Esc;
alert("text:" + sel.options[sel.selectedIndex].text + ", value:" + sel.options[sel.selectedIndex].value + ";");
event.returnValue = false;
break;
case 46:
//Delete;
if(confirm("删除当前选项!?"))
{
sel.options[sel.selectedIndex] = null;
if(sel.length>0)
{
sel.options[0].selected = true;
}
}
event.returnValue = false;
break;
case 8:
//Back Space;
var s = sel.options[sel.selectedIndex].text;
sel.options[sel.selectedIndex].text = s.substr(0,s.length-1);
event.returnValue = false;
break;
}
}
function catch_press(sel)
{
sel.options[sel.selectedIndex].text = sel.options[sel.selectedIndex].text + String.fromCharCode(event.keyCode);
event.returnValue = false;
}
//-->
function str2asc(strstr){
    str2asc   =   hex(asc(strstr))
}
function   asc2str(ascasc){
    asc2str   =   chr(ascasc)
}
function urlEncode(str){//urlEncode
var ret="";
for(var i=0;i<str.length;i++){
var chr = str.charAt(i);
if(chr == "+"){
ret+=" ";
}else if(chr=="%"){
var asc = str.substring(i+1,i+3);
if(parseInt("0x"+asc)>0x7f){
ret+=asc2str(parseInt("0x"+asc+str.substring(i+4,i+6)));
i+=5;
}else{
ret+=asc2str(parseInt("0x"+asc));
i+=2;
}
}else{
ret+= chr;
} }
return ret;
}
function urlDecode(str){
var ret="";
var strSpecial="!\"#$%&'()*+,/:;<=>?[]^`{|}~%";
var tt= "";
for(var i=0;i<str.length;i++){
var chr = str.charAt(i);
var c=str2asc(chr);
tt += chr+":"+c+"n";
if(parseInt("0x"+c) > 0x7f){
ret+="%"+c.slice(0,2)+"%"+c.slice(-2);
}else{
if(chr==" ")
ret+="+";
else if(strSpecial.indexOf(chr)!=-1)
ret+="%"+c.toString(16);
else
ret+=chr;
} }
return ret;
}
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function showsubmenu(){
	whichEl = eval("list");
	if (whichEl.style.display == "none") {
		eval("list.style.display=\"\";");
		idFlag.innerHTML = "<div class='close'><a href='#' title='关闭列表'></a></div>";
	}else {
		eval("list.style.display=\"none\";");
		idFlag.innerHTML = "<div class='open'><a href='#' title='打开列表'></a>";
	}
 }
	var cookie = {
		set: function(name, value) {
			var Days = 30;
			var exp = new Date();
			exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
			document.cookie = name + '=' + escape(value) + ';expires=' + exp.toGMTString();
		},
		get: function(name) {
			var arr, reg = new RegExp('(^| )' + name + '=([^;]*)(;|$)');
			if(arr = document.cookie.match(reg)) {
				return unescape(arr[2]);
			} else {
				return null;
			}
		},
		del: function(name) {
			var exp = new Date();
			exp.setTime(exp.getTime() - 1);
			var cval = getCookie(name);
			if(cval != null) {
				document.cookie = name + '=' + cval + ';expires=' + exp.toGMTString();
			}
		}
	};
	var cookieTime = cookie.get('time_'  + flss);
	//console.log(cookieTime);
	if(!cookieTime || cookieTime == undefined) {
		cookieTime = 0;
	}
	if(cookieTime > 0) { 
		videoObject['seek'] = cookieTime;
	}
	function loadedHandler() { //播放器加载后会调用该函数
		playerLoad = true;
	}
	function loadHandler() {
		player.addListener('time', timeHandler);
	}
	function timeHandler(t) {
		cookie.set('time_' + flss, t); 
	}
window.addEventListener('resize',function(){document.getElementById( id ).style.height=window.innerHeight+'px';});
function getto( s ) { var re = new RegExp( s + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function getId( s ) { var re = new RegExp( s + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
var isPad=navigator.userAgent.toLowerCase().match(/(ipod|ipad|iphone|android|coolpad|mmp|smartphone|midp|wap|xoom|symbian|j2me|blackberry|wince)/i) != null;
//var isPad = navigator.userAgent.match(/iPhone|Linux|Android|iPad|iPod|ios|iOS|Windows Phone|Phone|WebOS/i) != null;
function height(){  var height=document.documentElement.clientHeight; return height; }
function heighn(){  var height=document.documentElement.clientHeight-41; return height; }
function heigh(){  var height=document.documentElement.clientHeight; return height; }
/*function mDate() {
var mDate = new Date(); 
var myear = mDate.getFullYear();
var mmonth = (mDate.getMonth()+1)<10?"0":"" + (mDate.getMonth()+1);
var mday = (mDate.getDate()<10?"0":"") + mDate.getDate();
var mmDate = myear + mmonth + mday;
return mmDate;
}*/
function ifrm(){
var ifr='topmargin="0" frameborder="0" scrolling="yes" width="100%" height="'+ height() +'" scroll="auto" bgcolor="#000000" style="width:100%;bgcolor:#000000;border:none"';
return ifr;
}
function ifcm(){
var ifr='<iframe name="b" src="'+ usrc() +'"  id="player" width="100%" height="'+ height() +'" autoplay="true" auto="true" topmargin="0" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="yes" scroll="auto" bgcolor="#454545" cellpadding="0" cellspacing="0" wmode="transparent" style="width:100%;border:none;margin:0px auto; background:none;z-index:-1"/></iframe>';
return ifr;
}
function ifch(){
document.getElementById('hplayer').innerHTML  = '<iframe width="100%" src="http://vr.v.ipanda.com/utovr/pano.html?src=../video/201604/bjcc_qjsp.mp4"  height="'+height()+'" scrolling="no" frameborder="0" scroll="auto" border="0" bgcolor="#000000"></iframe>';
}
function ifcn(){
var ifr='<iframe name="b2" src="'+scn()+'" width="0" height="0" frameborder="0" /></iframe>';
return ifr;
}
function ifcb(){
var id = id();
var swfd = swfm();
var height = height();
var ifr='<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" name=id id=id src=swfd data=swfd width="100%" height=height type="application/x-shockwave-flash" ><param name="movie" value="" /><param name="quality" value="high"/><param name="allowscriptaccess" value="always"/><param name="allowfullscreen" value="true"/><param name="wmode" value="Opaque"/><param name="bgcolor" value="#000000"/><param name="flashvars" value="autoplay=true&auto=true"/><embed name=id id=id src=swfd data=swfd flashvars="autoplay=true&auto=true" quality="best" allowscriptaccess="always" wmode="Opaque" allowfullscreen="true" bgcolor="#000000" type="application/x-shockwave-flash" height=height width="100%"/></embed></object>';
return ifr;
}
function ifh5(){
var kfss = fkss();
var ifr='<video id="video" preload="load" controls="controls" parentId="#player" width="100%" height="'+height()+'" autoplay="true" auto="true"><source src="'+fkss()+'" type="'+htype()+'"></video>';
return ifr;
}
function paramt() { 
var paramt = {frameborder:"0",border:"0",allowtransparency:"true"};
return paramt;
}
function wh() { 
var wh=window.screen.width;document.cookie="screen="+wh;
var wh1=wh-30;var wh2=wh-40;var wh3=wh-50;var wh4=wh-60;
return wh;
}
function th() { 
var h=window.screen.height;document.cookie="screen="+h;
var h8=h-180;var h7=h-170;var h6=h-160;var h5=h-150;var h4=h-140;var h3=h-130;var h2=h-120;var h1=h-100;var h0=2500;
return h5;
}
function ths() { 
var h=window.screen.height;document.cookie="screen="+h;
var h8=h-180;var h7=h-170;var h6=h-160;var h5=h-150;var h4=h-140;var h3=h-130;var h2=h-120;var h1=h-100;var h0=2500;
return h4;
}
function tha() { 
var h=window.screen.height;document.cookie="screen="+h;
var h8=h-180;var h7=h-170;var h6=h-160;var h5=h-150;var h4=h-140;var h3=h-130;var h2=h-120;var h1=h-100;var h0=2500;
return h3;
}
function scn() { 
var scn = "http://vdn.apps.cntv.cn/api2/liveHtml5.do?channel=pa://cctv_p2p_hdcctv4";
return scn;
}
var dlss=dlss();
var tlss=tlss();var t=tlss;
//var ttls = parseInt( tlss ) + 1;
//var mDate = mDate();
//var stime = mDate + tlss +'00';
//var ntime = mDate + ttls +'00';
var ifrm=ifrm();
var usrc=usrc();
var h=th();
var h1=th();
var h4=th()?th():2500;
var th=ths();
var ths=ths();
var tha=tha();
var id=id();
var vid=vid();
var slss=slss();var s=slss;
var ulss=ulss();
var us=ulss;
var alss=alss();var a=alss;
var wlss=wlss();var w=wlss;
var plss=plss();var p=plss;
var fkss = fkss();
var fmss=fmss();
function tdss(){ 
var us=ulss()?ulss():'0';
var tdss =udss() + fkss();
return  tdss;
}
function ttss(){ 
//var ttss=jsur() + fkss;
var us=ulss()?ulss():'0';
var ttss =jsur() + fkss();
return  ttss;
}
function tsrd(){ 
//var tsrd=jscd() + fkss; 
var us=ulss()?ulss():'0';
var tsrc =jsur() + fkss();
return  tsrc;
}
function tsrc(){ 
//var tsrc=jscd() + fkss; 
var us=ulss()?ulss():'0';
var tsrc =jscd() + fkss();
return  tsrc;
}
var nlist= nlist();
var mlist= mlist();

var rlist = 'rlist.htm';
var huiid =  fkss();
var videoid = fmss();
function nlist(){ 
var s=slss();var a=alss();var p=plss();var t=tlss();var u=ulss();var us=ulss();var f=fkss();var w=wlss();
var slist = './st/'+listn()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&w=' + w + '&' ;
//var slist = './st/'+lists()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&f=' + f + '&w=' + w + '&' ;
return slist;
}
function slist(){ 
var s=slss();var a=alss();var p=plss();var t=tlss();var u=ulss();var us=ulss();var f=fkss();var w=wlss();
var slist = './st/'+lists()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&w=' + w + '&' ;
//var slist = './st/'+lists()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&f=' + f + '&w=' + w + '&' ;
return slist;
}
function zlist(){ 
var s=slss();var a=alss();var p=plss();var t=tlss();var u=ulss();var us=ulss();var f=fkss();var w=wlss();
var slist = './st/'+listz()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&w=' + w + '&' ;
//var slist = './st/'+listz()+'?&s=' + s + '&a=' + a + '&p=' + p + '&u=' + us + '&t=' + t + '&f=' + f + '&w=' + w + '&' ;
return slist;
}
function usrc(){ 
var atss=alss()?alss():'ck';
var us=ulss()?ulss():'0';
var kfss = fkss();
var nsrc = '';
var src0 =  './t.htm?u='  + us + '&f=' + kfss;
var src1 =  './ck.htm?u=' + us + '&f=' + kfss;
var src3 =  './k.htm?u=' + us + '&f=' + kfss;
var src5 =  './w.htm?u=' + us + '&f=' + kfss;
var src6 =  './w/jw.htm?&f=' + kfss;
var src7 =  './w/xg.htm?&f=' + kfss;
var src8 =  './d.htm?u=' + us + '&f=' + kfss;
var src9 =  './u.htm?u=' + us + '&f=' + kfss;
var srcv0 = './v.htm?&f='+ kfss;
if( atss =='v') nsrc=srcv0;else if( atss =='u') nsrc=src9;else if( atss =='ck') nsrc=src1;else if( atss =='k') nsrc=src3;
else if( atss =='w') nsrc=src5;else if( atss =='x'||atss =='xg') nsrc=src7;else if( atss =='d') nsrc=src8;
else if( atss =='jw') nsrc=src6;else if( atss =='t') nsrc=src0;else nsrc=src1;
if( kfss.indexOf("rtmp:") >0 ) fsrc=src1;else if( kfss.indexOf(".htm") >0 || kfss.indexOf(".html") >0 || kfss.indexOf(".shtml") >0 || kfss.indexOf("sogou.com") >0) fsrc=srcv0;else if( kfss.indexOf("nbs.cn") >0 ) fsrc=src6;else if( kfss.indexOf("hljtv.com") >0 ||kfss.indexOf("wenshibaowenbei.com") >0) fsrc=src8;else fsrc=nsrc;
return fsrc;
}
/*else if( kfss.length >16 && kfss.length <26 && kfss.indexOf("http") < 0) fsrc=src8;*/
/*else if( kfss.indexOf("leduotv.com") >0 ||kfss.indexOf("xxctzy.com")>0) fsrc=src8;*/
function slss(){
var slss = getId('s')?getId('s'):'0';
if(slss==null) slss ="0";else slss=slss;
return slss;
}
function alss(){
var alss = getId('a')?getId('a'):'0';
if(alss==null) alss ="0";else alss=alss;
return alss;
}
function ulss(){
var ulss = getId('u')?getId('u'):'0';
if(ulss==null) ulss ="0";else ulss=ulss;
return ulss;
}
function plss(){
var plss = getId('p')?getId('p'):'1';
return plss;
}
function wlss(){
var wlss = getId('w')?getId('w'):'';
return wlss;
}
function tlss(){
var tlss = getId('t')?getId('t'):'0';
return tlss;
}
function dlss(){
var dlss = getId('d')?getId('d'):'player';
return dlss;
}
function id(){
var dlss = getId('id')?getId('id'):'player';
return dlss;
}
function vid(){
var dlss = getId('vid')?getId('vid'):'';
if(dlss==null || dlss==''){dlss='';}else{dlss=dlss;};
return dlss;
}
function stype(){
var kfss = fkss();
var type1="Hls";
var type2="customHls";
var type3="normal";
if(kfss.indexOf(".mp4")>0) {type="mp4";}else if(kfss.indexOf(".flv")>0) {type="flv";}else if(kfss.indexOf(".mpd")>0){type="dash";}else {type =type1;}
return type;
}
function htype(){
var kfss = fkss();
var type="application/x-mpegurl";
if(kfss.indexOf(".mp4")>0) {type ="video/mp4";}else if(kfss.indexOf(".flv")>0) {type="video/flv";}else if(kfss.indexOf(".mpeg")>0 ) {type ="video/mpeg";}else {type =type;}
return type;
}
function listn(){
var ssmv = '';
if(slss()==0) ssmv="plist.htm";else if(slss()==1) ssmv="wlist.htm";else if(slss()==2) ssmv="clist.htm";else if(slss()==3) ssmv="dlist.htm";else if(slss()==4) ssmv="flist.htm";else ssmv="plist.htm" ;
return ssmv;
}
function lists(){
var ssmv = '';
if(slss().indexOf("dy") >0||slss().indexOf("dsj") >0||slss().indexOf("mv") >0) ssmv="mvlist.php";
else if(slss().indexOf("tv")>0||slss().indexOf("zb")>0||slss().indexOf("av")>0|slss().indexOf("zg")>0||slss().indexOf("hb")>0) ssmv="tvlist.php";
else if(slss().indexOf("so")>0||slss().indexOf("yu") >0||slss().indexOf("yun") >0) ssmv="solist.php";
else if(slss().indexOf("zx") >0||slss().indexOf("xw") >0) ssmv="zxlist.php";else if(slss()==1) ssmv="wlist.htm";else if(slss()==2) ssmv="clist.htm";else if(slss()==3) ssmv="dlist.htm";else if(slss()==4) ssmv="flist.htm";else ssmv="plist.htm";
return ssmv;
}
function listz(){
var ssmv = '';
if(slss().indexOf("dy") >0||slss().indexOf("dsj") >0||slss().indexOf("mv") >0) ssmv="mvlist.php";
else if(slss().indexOf("tv")>0||slss().indexOf("zb")>0||slss().indexOf("av")>0|slss().indexOf("zg")>0||slss().indexOf("hb")>0) ssmv="tvlist.php";
else if(slss().indexOf("so")>0||slss().indexOf("yu") >0||slss().indexOf("yun") >0) ssmv="solist.php";
else if(slss().indexOf("zx") >0||slss().indexOf("xw") >0) ssmv="zxlist.php";else if(slss()==1) ssmv="wlist.htm";else if(slss()==2) ssmv="clist.htm";else if(slss()==3) ssmv="dlist.htm";else if(slss()==4) ssmv="flist.htm";else ssmv="zxlist.php";
return ssmv;
}
function fmss(){
var ftss = "";
var cfts = "http://cctvalih5ca.v.myalicdn.com/live/";
var cfts1 = "http://cctvksh5ca.v.kcdnvip.com/clive/";
var cfts2 = "http://cctvksh5ca.v.kcdnvip.com/live/";
var cfts3 = "http://cctvcnch5ca.v.wscdns.com/live/";
var cfts4 = "http://cctvtxyh5ca.liveplay.myqcloud.com/live/";
var cfts5 = "http://112.132.209.46/liveplay-kk.rtxapp.com/live/program/live/";
var cfts6 = "http://112.132.209.46/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts7 = "http://219.151.31.43/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts8 = "http://112.132.209.46/"//125.74.5.39//14.152.88.77
var fdss = getId('f')?getId('f'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
var fss = "http://zhibo.hkstv.tv/livestream/mutfysrq/playlist.m3u8";//香港
  if( fdss==null||fdss=="") ftss =fss;else ftss=fdss;
  if( fdss.length >16 && fdss.length <26 && fdss.indexOf("http") < 0){
 ftss="https://api.leduotv.com/wp-api/glid.php?vid=" + fdss;//XMMTY2ODczMDAwMF8xNzE=
//ftss="https://api.xxctzy.com/wp-api/glid.php?vid=" + fdss;
//ftss="https://api.xxctzy.com/wp-api/ifr.php?vid=" + fdss;
//ftss="https://api.leduotv.com/wp-api/ifr.php?vid=" + fdss;
} else if( fdss.length <16) {
  if( fdss=="0"|| fdss=="jspd") ftss =cfts5 + "jspdhd/4000000/mnf.m3u8";//纪实频道;
else if( fdss=="1"|| fdss=="cctv1") ftss =cfts + "cctv1_2/index.m3u8";//cctv1;
else if( fdss=="2"|| fdss=="cctv2") ftss =cfts5 + "cctv2/1300000/mnf.m3u8";//cctv2;
else if( fdss=="3"|| fdss=="cctv3") ftss =cfts5 + "cctv3hd/4000000/mnf.m3u8";//cctv3;
else if( fdss=="4"|| fdss=="cctv4") ftss =cfts + "cctv4_2/index.m3u8";//cctv4;
else if( fdss=="5"|| fdss=="cctv5") ftss =cfts + "cctv5_2/index.m3u8";//cctv5;
else if( fdss=="6"|| fdss=="cctv6") ftss =cfts5 + "cctv6hd/4000000/mnf.m3u8";//cctv6;
else if( fdss=="7"|| fdss=="cctv7") ftss =cfts4 + "cctv7_2_hd.m3u8";//cctv7;
else if( fdss=="8"|| fdss=="cctv8") ftss =cfts5 + "cctv8hd/4000000/mnf.m3u8";//cctv8;
else if( fdss=="9"|| fdss=="cctv9"|| fdss=="jilu") ftss =cfts + "cctvjilu_2/index.m3u8";//cctv9;
else if(fdss=="10"|| fdss=="cctv10") ftss =cfts + "cctv10_2/index.m3u8";//cctv10;
else if(fdss=="11"|| fdss=="cctv11") ftss =cfts + "cctv11_2/index.m3u8";//cctv11;
else if(fdss=="12"|| fdss=="cctv12") ftss =cfts + "cctv12_2/index.m3u8";//cctv12;
else if(fdss=="13"|| fdss=="cctv13") ftss =cfts + "cctv13_2/index.m3u8";//cctv13;
else if(fdss=="14"|| fdss=="cctv14"|| fdss=="child") ftss =cfts + "cctvchild_2/index.m3u8";//cctv14;
else if(fdss=="15"|| fdss=="cctv15") ftss =cfts + "cctv15_2/index.m3u8";//音乐;
else if(fdss=="16"|| fdss=="btv1"||fdss=="bjws") ftss =cfts5 + "bjws/1300000/mnf.m3u8";//北京卫视;
else if(fdss=="17"|| fdss=="cctv17") ftss =cfts + "cctv17_2/index.m3u8";//cctv17;
else if(fdss=="18"|| fdss=="laozuo") ftss ="http://cclive2.aniu.tv/live/anzb.m3u8";//老左;
else if(fdss=="19"|| fdss=="dycj"|| fdss=="caijing") ftss =cfts5 + "dycjhd/4000000/mnf.m3u8"; //第一财经
else if(fdss=="20"|| fdss=="qixiang"|| fdss=="tianqi") ftss =cfts5 + "zgqx/1300000/mnf.m3u8"; //气象;
else if(fdss=="21"|| fdss=="dfys"|| fdss=="dongfang") ftss =cfts5 + "dsjpdhd/4000000/mnf.m3u8";//东方影视
else if(fdss=="22"|| fdss=="sxws1"||fdss=="shanxi1") ftss =cfts5 + "shanxiws/1300000/mnf.m3u8";//山西卫视;
else if(fdss=="23"|| fdss=="scws"||fdss=="sicuan") ftss =cfts5 + "scws/1300000/mnf.m3u8";     //四川卫视;
else if(fdss=="24"|| fdss=="dfws"||fdss=="dongfang") ftss =cfts5 + "hddfws/4000000/mnf.m3u8"; //东方卫视
else if(fdss=="25"|| fdss=="hbws"|| fdss=="hubei") ftss =cfts5 + "hbwshd/4000000/mnf.m3u8";   //湖北卫视
else if(fdss=="26"|| fdss=="jsws"|| fdss=="jiangsu") ftss =cfts5 + "jswshd/4000000/mnf.m3u8"; //江苏卫视
else if(fdss=="27"|| fdss=="tjws"||fdss=="tianjin") ftss =cfts5 + "tjwshd/4000000/mnf.m3u8";  //天津卫视
else if(fdss=="28"|| fdss=="gzws"||fdss=="guizou") ftss =cfts5 + "gzws/1300000/mnf.m3u8";     //贵州卫视
else if(fdss=="29"|| fdss=="jlws"||fdss=="jilin") ftss =cfts5 + "btws/1300000/mnf.m3u8";      //吉林卫视
else if(fdss=="30"|| fdss=="sdws"||fdss=="shandong") ftss =cfts5 + "sdwshd/4000000/mnf.m3u8"; //山东卫视
else if(fdss=="31"|| fdss=="hnws"||fdss=="hunan") ftss =cfts5 + "hnwshd/4000000/mnf.m3u8";    //湖南卫视
else if(fdss=="32"|| fdss=="btes"||fdss=="bintuan") ftss =cfts5 + "jlws/1300000/mnf.m3u8";    //兵团卫视
else if(fdss=="33"|| fdss=="lnws"||fdss=="liaoning") ftss =cfts5 + "lnwshd/4000000/mnf.m3u8"; //辽宁卫视
else if(fdss=="34"|| fdss=="hljws"||fdss=="heilongjiang") ftss =cfts5 + "hljwshd/4000000/mnf.m3u8"; //黑龙江卫视
else if(fdss=="35"|| fdss=="qjs" ||fdss=="quanjishi") ftss =cfts5 + "qjshd/4000000/mnf.m3u8";//全纪实
else if(fdss=="36"|| fdss=="ahws"||fdss=="anhui") ftss =cfts5 + "ahwshd/4000000/mnf.m3u8";    //安徽卫视
else if(fdss=="37"|| fdss=="szws"||fdss=="senzen") ftss =cfts5 + "szwshd/4000000/mnf.m3u8";//深圳卫视
else if(fdss=="38"|| fdss=="dnws"||fdss=="dongnan") ftss =cfts5 + "dnwshd/4000000/mnf.m3u8";//东南卫视
else if(fdss=="39"|| fdss=="ynws"||fdss=="yunnan") ftss =cfts5 + "ynws/1300000/mnf.m3u8";//云南卫视
else if(fdss=="40"|| fdss=="qhws"||fdss=="qinghai") ftss =cfts5 + "qhws/1300000/mnf.m3u8";//青海卫视
else if(fdss=="41"|| fdss=="hbws1"||fdss=="hebei1") ftss =cfts5 + "hbws/1300000/mnf.m3u8";//河北卫视
else if(fdss=="42"|| fdss=="hnws" ||fdss=="henan" ) ftss =cfts5 + "hnws/1300000/mnf.m3u8";//河南卫视
else if(fdss=="43"|| fdss=="sxws" ||fdss=="sanxi2") ftss =cfts5 + "sxws/1300000/mnf.m3u8";//陕西卫视

else if(fdss=="44"|| fdss=="fzzh" ||fdss=="fuzou1") ftss ="http://live.zohi.tv/video/s10001-FZTV-1/index.m3u8";//福州综合
else if(fdss=="45"|| fdss=="fzys" ||fdss=="fuzou2") ftss ="http://live.zohi.tv/video/s10001-yspd-2/index.m3u8";//福州影视
else if(fdss=="46"|| fdss=="fzsh" ||fdss=="fuzou3") ftss ="http://live.zohi.tv/video/s10001-shpd-3/index.m3u8";//福州生活
else if(fdss=="47"|| fdss=="zjws"|| fdss=="zhejiang") ftss ="http://hw-m-l.cztv.com/channels/lantian/channel01/1080p.m3u8";//浙江卫视
else if(fdss=="48"|| fdss=="qjws"|| fdss=="qianjiang") ftss ="http://hw-m-l.cztv.com/channels/lantian/channel02/1080p.m3u8";//钱江卫视
else if(fdss=="49"|| fdss=="zjjj"|| fdss=="zhejiang1") ftss ="http://hw-m-l.cztv.com/channels/lantian/channel03/1080p.m3u8";//浙江经济
else if(fdss=="50"|| fdss=="zjkj"|| fdss=="zhejiang2") ftss ="http://hw-m-l.cztv.com/channels/lantian/channel04/1080p.m3u8";//浙江科教
else if(fdss=="51"|| fdss=="zjys"|| fdss=="zhejiang3" ) ftss ="http://hw-m-l.cztv.com/channels/lantian/channel05/1080p.m3u8";//浙江影视
else if(fdss=="52"|| fdss=="hfxw"||fdss=="hefei1") ftss ="http://223.244.92.30:808/2774goN/1000/live.m3u8";//合肥新闻
else if(fdss=="53"|| fdss=="hfsh"||fdss=="hefei2") ftss ="http://223.244.92.30:808/xcd72q7/1000/live.m3u8";//合肥生活
else if(fdss=="54"|| fdss=="hffz"||fdss=="hefei3") ftss ="http://223.244.92.30:808/x91Hoz8/1000/live.m3u8";//合肥法制
else if(fdss=="55"|| fdss=="hfwt"||fdss=="hefei4") ftss ="http://223.244.92.30:808/52e58Sh/1000/live.m3u8";//合肥文体
else if(fdss=="56"|| fdss=="whxw"||fdss=="wuhu1") ftss ="http://live1.wuhubtv.com/channel1/sd/live.m3u8";//芜湖新闻
else if(fdss=="57"|| fdss=="whsh"||fdss=="wuhu2") ftss ="http://live1.wuhubtv.com/channel2/sd/live.m3u8";//芜湖生活
else if(fdss=="58"|| fdss=="whgg"||fdss=="wuhu3") ftss ="http://live1.wuhubtv.com/channel3/sd/live.m3u8";//芜湖公共
else if(fdss=="59"|| fdss=="whjy"||fdss=="wuhu4") ftss ="http://live1.wuhubtv.com/channel4/sd/live.m3u8";//芜湖教育
else if(fdss=="60"|| fdss=="laxw"||fdss=="liuan1") ftss ="http://live.china-latv.com/channel1/sd/live.m3u8";//六安新闻
else if(fdss=="61"|| fdss=="lagg"||fdss=="liuan2") ftss ="http://live.china-latv.com/channel1/sd/live.m3u8";//六安公共
else if(fdss=="62"|| fdss=="ycsh"||fdss=="yincuan1") ftss ="http://stream.ycgbtv.com.cn/ycxw/sd/live.m3u8";//银川生活
else if(fdss=="63"|| fdss=="ycgg"||fdss=="yincuan2") ftss ="http://stream.ycgbtv.com.cn/ycgg/sd/live.m3u8";//银川公共
else if(fdss=="64"|| fdss=="xzxw"||fdss=="xuzou1") ftss ="http://stream1.huaihai.tv/xwzh/playlist.m3u8";//徐州新闻
else if(fdss=="65"|| fdss=="xzjj"||fdss=="xuzou2") ftss ="http://stream1.huaihai.tv/jjsh/playlist.m3u8";//徐州经济
else if(fdss=="66"|| fdss=="xzys"||fdss=="xuzou3") ftss ="http://stream1.huaihai.tv/wyys/playlist.m3u8";//徐州影视
else if(fdss=="67"|| fdss=="xzgg"||fdss=="xuzou4") ftss ="http://stream1.huaihai.tv/ggpd/playlist.m3u8";//徐州公共
else if(fdss=="68"|| fdss=="btxw"||fdss=="baotou1") ftss ="http://live.btgdt.com/channels/btgd/xwzh/m3u8:500k/live";//包头新闻
else if(fdss=="69"|| fdss=="btsh"||fdss=="baotou2") ftss ="http://live.btgdt.com/channels/btgd/shfw/m3u8:500k/live";//包头生活
else if(fdss=="70"|| fdss=="btjj"||fdss=="baotou3") ftss ="http://live.btgdt.com/channels/btgd/jjpd/m3u8:500k/live";//包头经济
else if(fdss=="71"|| fdss=="zsxw"||fdss=="zousan1") ftss ="http://live.wifizs.cn/xwzh/sd/live.m3u8";//舟山新闻
else if(fdss=="71"|| fdss=="zsgg"||fdss=="zousan2") ftss ="http://live.wifizs.cn/ggsh/sd/live.m3u8";//舟山公共
else if(fdss=="71"|| fdss=="zsly"||fdss=="zousan3") ftss ="http://live.wifizs.cn/qdly/sd/live.m3u8";//舟山旅游
else if(fdss=="74"|| fdss=="szzh"||fdss=="suzou1") ftss ="http://live.ahsz.tv/video/s10001-szzh/index.m3u8";//宿州综合
else if(fdss=="75"|| fdss=="szgg"||fdss=="suzou2") ftss ="http://live.ahsz.tv/video/s10001-ggpd/index.m3u8";//宿州公共
else if(fdss=="76"|| fdss=="szkj"||fdss=="suzou3") ftss ="http://live.ahsz.tv/video/s10001-kxjy/index.m3u8";//宿州科教
else if(fdss=="77"|| fdss=="hsgg"||fdss=="hstv2") ftss ="http://hls.hsrtv.cn/hls/hstv2.m3u8";//衡水公共
else if(fdss=="78"|| fdss=="hsxw"||fdss=="hstv1") ftss ="http://hls.hsrtv.cn/hls/hstv1.m3u8";//衡水新闻
else if(fdss=="79"|| fdss=="hsys"||fdss=="hstv3") ftss ="http://hls.hsrtv.cn/hls/hstv3.m3u8";//衡水影视
else if(fdss=="80"|| fdss=="hbzh"||fdss=="hebi") ftss ="http://pili-live-hls.hebitv.com/hebi/hebi.m3u8 ";//鹤壁综合
else if(fdss=="81"|| fdss=="zjg"||fdss=="zhangjiagang") ftss ="http://3gvod.zjgonline.com.cn:1935/live/xinwenzonghe2/playlist.m3u8";//张家港新闻
else if(fdss=="82"|| fdss=="dyzh"||fdss=="dongyin1") ftss ="http://stream.hhek.cn/xwzh/sd/live.m3u8";//东营综合
else if(fdss=="83"|| fdss=="dykj"||fdss=="dongyin2") ftss ="http://stream.hhek.cn/dyjy/sd/live.m3u8";//东营科教
else if(fdss=="84"|| fdss=="dygg"||fdss=="dongyin3") ftss ="http://stream.hhek.cn/ggpd/sd/live.m3u8";//东营公共
else if(fdss=="85"|| fdss=="xaxw"||fdss=="xian1") ftss ="http://stream2.xiancity.cn/xatv1/sd/live.m3u8";//西安新闻
else if(fdss=="86"|| fdss=="xabg"||fdss=="xian2") ftss ="http://stream2.xiancity.cn/xatv2/sd/live.m3u8";//西安白鸽
else if(fdss=="87"|| fdss=="xazx"||fdss=="xian3") ftss ="http://stream2.xiancity.cn/xatv3/sd/live.m3u8";//西安资讯
else if(fdss=="88"|| fdss=="xays"||fdss=="xian4") ftss ="http://stream2.xiancity.cn/xatv4/sd/live.m3u8";//西安影视
else if(fdss=="89"|| fdss=="yyxw"||fdss=="yuyao1") ftss ="http://l.cztvcloud.com/channels/lantian/SXyuyao1/720p.m3u8";//余姚新闻
else if(fdss=="90"|| fdss=="yywh"||fdss=="yuyao2") ftss ="http://l.cztvcloud.com/channels/lantian/SXyuyao2/720p.m3u8";//余姚文化
else if(fdss=="91"|| fdss=="yysh"||fdss=="yuyao3") ftss ="http://l.cztvcloud.com/channels/lantian/SXyuyao3/720p.m3u8";//余姚生活
else if(fdss=="92"|| fdss=="xsxw"||fdss=="xiaosan1") ftss ="http://l.cztvcloud.com/channels/lantian/SXxiaoshan1/720p.m3u8";//萧山新闻
else if(fdss=="93"|| fdss=="xssh"||fdss=="xiaosan2") ftss ="http://l.cztvcloud.com/channels/lantian/SXxiaoshan2/720p.m3u8";//萧山生活
else if(fdss=="94"|| fdss=="syxw"||fdss=="shangyu1") ftss ="http://l.cztvcloud.com/channels/lantian/SXshangyu1/720p.m3u8 ";//上虞新闻
else if(fdss=="95"|| fdss=="syjj"||fdss=="shangyu2") ftss ="http://l.cztvcloud.com/channels/lantian/SXshangyu2/720p.m3u8";//上虞经济
else if(fdss=="96"|| fdss=="xcxw"||fdss=="xincang1") ftss ="http://l.cztvcloud.com/channels/lantian/SXxinchang1/720p.m3u8";//新昌新闻
else if(fdss=="97"|| fdss=="xcys"||fdss=="xincang2") ftss ="http://l.cztvcloud.com/channels/lantian/SXxinchang2/720p.m3u8";//新昌影视
else if(fdss=="98"|| fdss=="szxw"||fdss=="senzou") ftss ="http://l.cztvcloud.com/channels/lantian/SXshengzhou1/720p.m3u8";//嵊州新闻
else if(fdss=="99"|| fdss=="lygzh"||fdss=="lianyungang1") ftss ="http://live.lyg1.com/zhpd/sd/live.m3u8";//连云港综合
else if(fdss=="100"|| fdss=="lyggg"||fdss=="lianyungang2") ftss ="http://live.lyg1.com/ggpd/sd/live.m3u8";//连云港公共
else if(fdss=="101"|| fdss=="sdys"||fdss=="sandong1") ftss ="http://livealone302.iqilu.com/iqilu/yspd.m3u8";//山东影视
else if(fdss=="102"|| fdss=="sdzy"||fdss=="sandong2") ftss ="http://livealone302.iqilu.com/iqilu/zypd.m3u8";//山东综艺
else if(fdss=="103"|| fdss=="sdsh"||fdss=="sandong3") ftss ="http://livealone302.iqilu.com/iqilu/shpd.m3u8";//山东生活
else if(fdss=="104"|| fdss=="sdgg"||fdss=="sandong4") ftss ="http://livealone302.iqilu.com/iqilu/ggpd.m3u8";//山东公共
else if(fdss=="105"|| fdss=="sdnk"||fdss=="sandong5") ftss ="http://livealone302.iqilu.com/iqilu/nkpd.m3u8";//山东农科
else if(fdss=="106"|| fdss=="sdty"||fdss=="sandong6") ftss ="http://livealone302.iqilu.com/iqilu/typd.m3u8";//山东体育
else if(fdss=="107"|| fdss=="sdql"||fdss=="sandong7") ftss ="http://livealone302.iqilu.com/iqilu/qlpd.m3u8";//山东齐鲁
else if(fdss=="108"|| fdss=="ntxw"||fdss=="nantong1") ftss ="http://cm.wshls.homecdn.com/live/7cc9.m3u8";//南通新闻
else if(fdss=="109"|| fdss=="ntsj"||fdss=="nantong2") ftss ="http://cm.wshls.homecdn.com/live/7cc7.m3u8";//南通2
else if(fdss=="110"|| fdss=="ntgg"||fdss=="nantong3") ftss ="http://cm.wshls.homecdn.com/live/7cc5.m3u8";//南通公共
else if(fdss=="111"|| fdss=="ntcc"||fdss=="nantong4") ftss ="http://cm.wshls.homecdn.com/live/7cc1.m3u8";//崇川TV
else if(fdss=="112"|| fdss=="ntxn"||fdss=="nantong5") ftss ="http://cm.wshls.homecdn.com/live/139a3.m3u8";//Xn新闻
else if(fdss=="113"|| fdss=="scjj"||fdss=="sicuan1") ftss ="http://scgctvshow.sctv.com/hdlive/sctv2/1.m3u8";//四川经济
else if(fdss=="114"|| fdss=="scwh"||fdss=="sicuan2") ftss ="http://scgctvshow.sctv.com/hdlive/sctv3/1.m3u8";//四川文化
else if(fdss=="115"|| fdss=="sxxw"||fdss=="sicuan3") ftss ="http://scgctvshow.sctv.com/hdlive/sctv4/1.m3u8";//四川新闻
else if(fdss=="116"|| fdss=="scys"||fdss=="sicuan4") ftss ="http://scgctvshow.sctv.com/hdlive/sctv5/1.m3u8";//四川影视
else if(fdss=="117"|| fdss=="sc7"||fdss=="sicuan5") ftss ="http://scgctvshow.sctv.com/hdlive/sctv7/1.m3u8";//四川7
else if(fdss=="118"|| fdss=="scxc"||fdss=="sicuan5") ftss ="http://scgctvshow.sctv.com/hdlive/sctv9/1.m3u8";//四川乡村
else if(fdss=="119"|| fdss=="kmjj"||fdss=="kunming1") ftss ="http://wshls.live.migucloud.com/live/01YCQY7M_C0/playlist.m3u8";//昆明经济
else if(fdss=="120"|| fdss=="kmkx"||fdss=="kunming2") ftss ="http://wshls.live.migucloud.com/live/ZBXWIMTD_C0/playlist.m3u8";//昆明科学
else if(fdss=="121"|| fdss=="kmly"||fdss=="kunming3") ftss ="http://wshls.live.migucloud.com/live/6KN3ZB2S_C0/playlist.m3u8";//昆明娱乐
else if(fdss=="122"|| fdss=="kmys"||fdss=="kunming4") ftss ="http://wshls.live.migucloud.com/live/KYLNJWFD_C0/playlist.m3u8";//昆明影视
else if(fdss=="123"|| fdss=="kmgg"||fdss=="kunming5") ftss ="http://wshls.live.migucloud.com/live/UD0YLY2G_C0/playlist.m3u8";//昆明公共
else if(fdss=="124"|| fdss=="hbjj"||fdss=="hebei1") ftss ="http://live2.plus.hebtv.com/jjshx/hd/live.m3u8";//河北经济
else if(fdss=="125"|| fdss=="hbjj"||fdss=="hebei2") ftss ="http://live3.plus.hebtv.com/hbdsx/hd/live.m3u8";//河北都市
else if(fdss=="126"|| fdss=="hbjj"||fdss=="hebei3") ftss ="http://live4.plus.hebtv.com/hbysx/hd/live.m3u8";//河北影视
else if(fdss=="127"|| fdss=="hbjj"||fdss=="hebei4") ftss ="http://live7.plus.hebtv.com/hbggx/hd/live.m3u8";//河北公共
else if(fdss=="128"|| fdss=="hbjj"||fdss=="hebei5") ftss ="http://live3.plus.hebtv.com/nmpdx/hd/live.m3u8";//河北农民
}else ftss = ftss;
return ftss;
}
function fkss(){
var ftss = new Array();
var fkds = "";
var cfts = "http://cctvalih5ca.v.myalicdn.com/live/";
var cfts1 = "http://cctvksh5ca.v.kcdnvip.com/clive/";
var cfts2 = "http://cctvksh5ca.v.kcdnvip.com/live/";
var cfts3 = "http://cctvcnch5ca.v.wscdns.com/live/";
var cfts4 = "http://cctvtxyh5ca.liveplay.myqcloud.com/live/";
var cfts5 = "http://112.132.209.46/liveplay-kk.rtxapp.com/live/program/live/";
var cfts6 = "http://112.132.209.46/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts7 = "http://219.151.31.43/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts8 = "http://112.132.209.46/";
var cfks1 = "http://ivi.bupt.edu.cn/player.html?channel=";
var cfks2 = "http://ivi.bupt.edu.cn/hls/";
var muss = ".m3u8";
//var nnss = "/index.m3u8";
var nuss = "_2/index.m3u8";
//var ndss = "_2_hd.m3u8";
//var nnds = "/4000000/mnf.m3u8";
//var nnfs = "/1300000/mnf.m3u8";
var fdss = getId('f')?getId('f'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
var fss = "http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
 if( fdss==null||fdss=="") fkds =fss;else fkds=fdss;
  if( fdss.length >16 && fdss.length <26 && fdss.indexOf("http") < 0){
 ftss="https://api.leduotv.com/wp-api/glid.php?vid=" + fdss;//XMMTY2ODczMDAwMF8xNzE=
//ftss="https://api.xxctzy.com/wp-api/glid.php?vid=" + fdss;
//ftss="https://api.xxctzy.com/wp-api/ifr.php?vid=" + fdss;
//ftss="https://api.leduotv.com/wp-api/ifr.php?vid=" + fdss;
} else if( fdss.length <16) {
ftss[0]  =cfts5 + "jspdhd/4000000/mnf.m3u8";//纪实频道;
ftss[1]  =cfts + "cctv1_2/index.m3u8";//cctv1;
ftss[2]  =cfts5 + "cctv2/1300000/mnf.m3u8";//cctv2;
ftss[3]  =cfts5 + "cctv3hd/4000000/mnf.m3u8";//cctv3;
ftss[4]  =cfts + "cctv4_2/index.m3u8";//cctv4
ftss[5]  =cfts + "cctv5_2/index.m3u8";//cctv5
ftss[6]  =cfts5 + "cctv6hd/4000000/mnf.m3u8";//cctv6;
ftss[7]  =cfts4 + "cctv7_2_hd.m3u8";//cctv7;
ftss[8]  =cfts5 + "cctv8hd/4000000/mnf.m3u8";//cctv8;
ftss[9]  =cfts + "cctvjilu_2/index.m3u8";//cctv9;          
ftss[10] =cfts + "cctv10_2/index.m3u8";//cctv10;
ftss[11] =cfts + "cctv11_2/index.m3u8";//cctv11;
ftss[12] =cfts + "cctv12_2/index.m3u8";//cctv12;
ftss[13] =cfts + "cctv13_2/index.m3u8";//cctv13;
ftss[14] =cfts + "cctvchild_2/index.m3u8"; //少儿;
ftss[15] =cfts + "cctv15_2/index.m3u8"; //音乐;
ftss[16] =cfts5 + "bjws/1300000/mnf.m3u8"; //北京卫视
ftss[17] =cfts + "cctv17_2/index.m3u8";//cctv17;
ftss[18] ="http://cclive2.aniu.tv/live/anzb.m3u8";//老左;
ftss[19] =cfts5 + "dycjhd/4000000/mnf.m3u8";  //第一财经
ftss[20] =cfts5 + "zgqx/1300000/mnf.m3u8";    //气象;
ftss[21] =cfts5 + "dsjpdhd/4000000/mnf.m3u8"; //东方影视
ftss[22] =cfts5 + "shanxiws/1300000/mnf.m3u8";    //山西卫视;
ftss[23] =cfts5 + "scws/1300000/mnf.m3u8";    //四川卫视;
ftss[24] =cfts5 + "hddfws/4000000/mnf.m3u8";  //东方卫视
ftss[25] =cfts5 + "hbwshd/4000000/mnf.m3u8";  //湖北卫视
ftss[26] =cfts5 + "jswshd/4000000/mnf.m3u8";  //江苏卫视
ftss[27] =cfts5 + "tjwshd/4000000/mnf.m3u8";  //天津卫视
ftss[28] =cfts5 + "gzws/1300000/mnf.m3u8";    //贵州卫视
ftss[29] =cfts5 + "jlws/1300000/mnf.m3u8";    //吉林卫视
ftss[30] =cfts5 + "sdwshd/4000000/mnf.m3u8";  //山东卫视
ftss[31] =cfts5 + "hnwshd/4000000/mnf.m3u8";  //湖南卫视
ftss[32] =cfts5 + "btws/1300000/mnf.m3u8";    //兵团卫视
ftss[33] =cfts5 + "lnwshd/4000000/mnf.m3u8";  //辽宁卫视
ftss[34] =cfts5 + "hljwshd/4000000/mnf.m3u8"; //黑龙江卫视
ftss[35] =cfts5 + "qjshd/4000000/mnf.m3u8";//全纪实
ftss[36] =cfts5 + "ahwshd/4000000/mnf.m3u8";  //安徽卫视
ftss[37] =cfts5 + "szwshd/4000000/mnf.m3u8";//深圳卫视
ftss[38] =cfts5 + "dnwshd/4000000/mnf.m3u8";//东南卫视
ftss[39] =cfts5 + "ynws/1300000/mnf.m3u8";//云南卫视
ftss[40] =cfts5 + "qhws/1300000/mnf.m3u8";//青海卫视
ftss[41] =cfts5 + "hbws/1300000/mnf.m3u8";//河北卫视
ftss[42] =cfts5 + "hnws/1300000/mnf.m3u8";//河南卫视
ftss[43] =cfts5 + "sxws/1300000/mnf.m3u8";//陕西卫视
ftss[44] ="http://live.zohi.tv/video/s10001-FZTV-1/index.m3u8";//福州综合
ftss[45] ="http://live.zohi.tv/video/s10001-yspd-2/index.m3u8";//福州影视
ftss[46] ="http://live.zohi.tv/video/s10001-shpd-3/index.m3u8";//福州生活

ftss[47] ="http://hw-m-l.cztv.com/channels/lantian/channel01/1080p.m3u8";//浙江卫视
ftss[48] ="http://hw-m-l.cztv.com/channels/lantian/channel02/1080p.m3u8";//钱江卫视
ftss[49] ="http://hw-m-l.cztv.com/channels/lantian/channel03/1080p.m3u8";//浙江经济
ftss[50] ="http://hw-m-l.cztv.com/channels/lantian/channel04/1080p.m3u8";//浙江科教
ftss[51] ="http://hw-m-l.cztv.com/channels/lantian/channel051080p.m3u8"; //浙江影视
ftss[52] ="http://223.244.92.30:808/2774goN/1000/live.m3u8";//合肥新闻
ftss[53] ="http://223.244.92.30:808/xcd72q7/1000/live.m3u8";//合肥生活
ftss[54] ="http://223.244.92.30:808/x91Hoz8/1000/live.m3u8";//合肥法制
ftss[55] ="http://223.244.92.30:808/52e58Sh/1000/live.m3u8";//合肥文体
ftss[56] ="http://live1.wuhubtv.com/channel1/sd/live.m3u8";//芜湖新闻
ftss[57] ="http://live1.wuhubtv.com/channel2/sd/live.m3u8";//芜湖生活
ftss[58] ="http://live1.wuhubtv.com/channel3/sd/live.m3u8";//芜湖公共
ftss[59] ="http://live1.wuhubtv.com/channel4/sd/live.m3u8";//芜湖教育
ftss[60] ="http://live.china-latv.com/channel1/sd/live.m3u8";//六安新闻
ftss[61] ="http://live.china-latv.com/channel2/sd/live.m3u8";//六安公共
ftss[62] ="http://stream.ycgbtv.com.cn/ycxw/sd/live.m3u8";//银川生活
ftss[63] ="http://stream.ycgbtv.com.cn/ycgg/sd/live.m3u8";//银川公共
ftss[64] ="http://stream1.huaihai.tv/xwzh/playlist.m3u8";//徐州新闻
ftss[65] ="http://stream1.huaihai.tv/jjsh/playlist.m3u8";//徐州经济
ftss[66] ="http://stream1.huaihai.tv/wyys/playlist.m3u8";//徐州影视
ftss[67] ="http://stream1.huaihai.tv/ggpd/playlist.m3u8";//徐州公共
ftss[68] ="http://live.btgdt.com/channels/btgd/xwzh/m3u8:500k/live";//包头新闻
ftss[69] ="http://live.btgdt.com/channels/btgd/shfw/m3u8:500k/live";//包头生活
ftss[70] ="http://live.btgdt.com/channels/btgd/jjpd/m3u8:500k/live";//包头经济
ftss[71] ="http://live.wifizs.cn/xwzh/sd/live.m3u8";//舟山新闻
ftss[72] ="http://live.wifizs.cn/ggsh/sd/live.m3u8";//舟山公共
ftss[73] ="http://live.wifizs.cn/qdly/sd/live.m3u8";//舟山旅游
ftss[74] ="http://live.ahsz.tv/video/s10001-szzh/index.m3u8";//宿州综合
ftss[75] ="http://live.ahsz.tv/video/s10001-ggpd/index.m3u8";//宿州公共
ftss[76] ="http://live.ahsz.tv/video/s10001-kxjy/index.m3u8";//宿州科教
ftss[77] ="http://hls.hsrtv.cn/hls/hstv2.m3u8";//衡水公共
ftss[78] ="http://hls.hsrtv.cn/hls/hstv1.m3u8";//衡水新闻
ftss[79] ="http://hls.hsrtv.cn/hls/hstv3.m3u8";//衡水影视
ftss[80] ="http://pili-live-hls.hebitv.com/hebi/hebi.m3u8";//鹤壁综合
ftss[81] ="http://3gvod.zjgonline.com.cn:1935/live/xinwenzonghe2/playlist.m3u8";//张家港新闻
ftss[82] ="http://stream.hhek.cn/xwzh/sd/live.m3u8";//东营综合
ftss[83] ="http://stream.hhek.cn/dyjy/sd/live.m3u8";//东营科教
ftss[84] ="http://stream.hhek.cn/ggpd/sd/live.m3u8";//东营公共
ftss[85] ="http://stream2.xiancity.cn/xatv1/sd/live.m3u8";//西安新闻
ftss[86] ="http://stream2.xiancity.cn/xatv2/sd/live.m3u8";//西安白鸽
ftss[87] ="http://stream2.xiancity.cn/xatv3/sd/live.m3u8";//西安资讯
ftss[88] ="http://stream2.xiancity.cn/xatv4/sd/live.m3u8";//西安影视
ftss[89] ="http://l.cztvcloud.com/channels/lantian/SXyuyao1/720p.m3u8";//余姚新闻
ftss[90] ="http://l.cztvcloud.com/channels/lantian/SXyuyao1/720p.m3u8";//余姚文化
ftss[91] ="http://l.cztvcloud.com/channels/lantian/SXyuyao1/720p.m3u8";//余姚生活
ftss[92] ="http://l.cztvcloud.com/channels/lantian/SXxiaoshan1/720p.m3u8";//萧山新闻
ftss[93] ="http://l.cztvcloud.com/channels/lantian/SXxiaoshan2/720p.m3u8";//萧山生活
ftss[94] ="http://l.cztvcloud.com/channels/lantian/SXshangyu1/720p.m3u8";//上虞新闻
ftss[95] ="http://l.cztvcloud.com/channels/lantian/SXshangyu2/720p.m3u8";//上虞经济
ftss[96] ="http://l.cztvcloud.com/channels/lantian/SXxinchang1/720p.m3u8";//新昌新闻
ftss[97] ="http://l.cztvcloud.com/channels/lantian/SXxinchang2/720p.m3u8";//新昌影视
ftss[98] ="http://l.cztvcloud.com/channels/lantian/SXshengzhou1/720p.m3u8";//嵊州新闻
ftss[99] ="http://live.lyg1.com/zhpd/sd/live.m3u8";//连云港综合
ftss[100]="http://live.lyg1.com/ggpd/sd/live.m3u8";//连云港公共
ftss[101] ="http://livealone302.iqilu.com/iqilu/yspd.m3u8";//山东影视
ftss[102] ="http://livealone302.iqilu.com/iqilu/zypd.m3u8";//山东综艺
ftss[103] ="http://livealone302.iqilu.com/iqilu/shpd.m3u8";//山东生活
ftss[104] ="http://livealone302.iqilu.com/iqilu/ggpd.m3u8";//山东公共
ftss[105] ="http://livealone302.iqilu.com/iqilu/nkpd.m3u8";//山东农科
ftss[106] ="http://livealone302.iqilu.com/iqilu/typd.m3u8";//山东体育
ftss[107] ="http://livealone302.iqilu.com/iqilu/qlpd.m3u8";//山东齐鲁
ftss[108] ="http://cm.wshls.homecdn.com/live/7cc9.m3u8";//南通新闻
ftss[109] ="http://cm.wshls.homecdn.com/live/7cc7.m3u8";//南通2
ftss[110] ="http://cm.wshls.homecdn.com/live/7cc5.m3u8";//南通公共
ftss[111] ="http://cm.wshls.homecdn.com/live/7cc1.m3u8";//崇川TV
ftss[112] ="http://cm.wshls.homecdn.com/live/139a3.m3u8";//Xn新闻
ftss[113] ="http://scgctvshow.sctv.com/hdlive/sctv2/1.m3u8";//四川经济
ftss[114] ="http://scgctvshow.sctv.com/hdlive/sctv3/1.m3u8";//四川文化
ftss[115] ="http://scgctvshow.sctv.com/hdlive/sctv4/1.m3u8";//四川新闻
ftss[116] ="http://scgctvshow.sctv.com/hdlive/sctv5/1.m3u8";//四川影视
ftss[117] ="http://scgctvshow.sctv.com/hdlive/sctv7/1.m3u8";//四川7
ftss[118] ="http://scgctvshow.sctv.com/hdlive/sctv9/1.m3u8";//四川乡村
ftss[119] ="http://wshls.live.migucloud.com/live/01YCQY7M_C0/playlist.m3u8";//昆明经济
ftss[120] ="http://wshls.live.migucloud.com/live/ZBXWIMTD_C0/playlist.m3u8";//昆明科学
ftss[121] ="http://wshls.live.migucloud.com/live/6KN3ZB2S_C0/playlist.m3u8";//昆明娱乐
ftss[122] ="http://wshls.live.migucloud.com/live/KYLNJWFD_C0/playlist.m3u8";//昆明影视
ftss[123] ="http://wshls.live.migucloud.com/live/UD0YLY2G_C0/playlist.m3u8";//昆明公共
ftss[124] ="http://live2.plus.hebtv.com/jjshx/hd/live.m3u8";//河北经济
ftss[125] ="http://live3.plus.hebtv.com/hbdsx/hd/live.m3u8";//河北都市
ftss[126] ="http://live4.plus.hebtv.com/hbysx/hd/live.m3u8";//河北影视
ftss[127] ="http://live7.plus.hebtv.com/hbggx/hd/live.m3u8";//河北公共
ftss[128] ="http://live3.plus.hebtv.com/nmpdx/hd/live.m3u8";//河北农民

     if( fdss=="0" || fdss=="jspd") fkds = ftss[0];
else if( fdss=="1" || fdss=="cctv1") fkds = ftss[1];
else if( fdss=="2" || fdss=="cctv2") fkds = ftss[2];
else if( fdss=="3" || fdss=="cctv3") fkds = ftss[3];
else if( fdss=="4" || fdss=="cctv4") fkds = ftss[4];
else if( fdss=="5" || fdss=="cctv5") fkds = ftss[5];
else if( fdss=="6" || fdss=="cctv6") fkds = ftss[6];
else if( fdss=="7" || fdss=="cctv7") fkds = ftss[7];
else if( fdss=="8" || fdss=="cctv8") fkds = ftss[8];
else if( fdss=="9" || fdss=="cctv9"|| fdss=="jilu") fkds = ftss[9];
else if( fdss=="10"|| fdss=="cctv10") fkds = ftss[10];
else if( fdss=="11"|| fdss=="cctv11") fkds = ftss[11];
else if( fdss=="12"|| fdss=="cctv12") fkds = ftss[12];
else if( fdss=="13"|| fdss=="cctv13") fkds = ftss[13];
else if( fdss=="14"|| fdss=="cctv14") fkds = ftss[14];
else if( fdss=="15"|| fdss=="cctv15") fkds = ftss[15];
else if( fdss=="16"|| fdss=="btv1"||fdss=="beijin"||fdss=="bjws") fkds = ftss[16];
else if( fdss=="17"|| fdss=="cctv17") fkds = ftss[17];
else if( fdss=="18"|| fdss=="laozuo")   fkds = ftss[18];
else if( fdss=="19"|| fdss=="dycj"|| fdss=="caijin")   fkds = ftss[19];
else if( fdss=="20"|| fdss=="tianqi"||fdss=="qixiang")   fkds = ftss[20];
else if( fdss=="21"|| fdss=="dfys") fkds = ftss[21];
else if( fdss=="22"|| fdss=="sxws1"||fdss=="shanxi1")   fkds = ftss[22];
else if( fdss=="23"|| fdss=="scws"|| fdss=="sicuan") fkds = ftss[23];
else if( fdss=="24"|| fdss=="dfws"|| fdss=="dongfang") fkds = ftss[24];
else if( fdss=="25"|| fdss=="hbws"|| fdss=="hubei") fkds = ftss[25];
else if( fdss=="26"|| fdss=="jsws"|| fdss=="jiangsu") fkds = ftss[26];
else if( fdss=="27"|| fdss=="tjws"|| fdss=="tianjin") fkds = ftss[27];
else if( fdss=="28"|| fdss=="gzws"|| fdss=="guizou") fkds = ftss[28];
else if( fdss=="29"|| fdss=="jlws"|| fdss=="jilin") fkds = ftss[29];
else if( fdss=="30"|| fdss=="sdws"|| fdss=="shandong") fkds = ftss[30];
else if( fdss=="31"|| fdss=="hnws"|| fdss=="hunan") fkds = ftss[31];
else if( fdss=="32"|| fdss=="btws"|| fdss=="bintuan") fkds = ftss[32];
else if( fdss=="33"|| fdss=="lnws"|| fdss=="liaoning") fkds = ftss[33];
else if( fdss=="34"|| fdss=="hljws"||fdss=="heilongjiang") fkds = ftss[34];
else if( fdss=="35"|| fdss=="qjs"|| fdss=="quanjishi") fkds = ftss[35];
else if( fdss=="36"|| fdss=="ahws"|| fdss=="anhui") fkds = ftds[36];
else if( fdss=="37"|| fdss=="szws"|| fdss=="senzen")  fkds = ftss[37];
else if( fdss=="38"|| fdss=="dnws"|| fdss=="dongnan")  fkds = ftss[38];
else if( fdss=="39"|| fdss=="ynws"|| fdss=="yunnan")   fkds = ftss[39];
else if( fdss=="40"|| fdss=="qhws"|| fdss=="qinghai")   fkds = ftss[40];
else if( fdss=="41"|| fdss=="hbws1"||fdss=="hebei1")   fkds = ftss[41];
else if( fdss=="42"|| fdss=="hnws"|| fdss=="henan")   fkds = ftss[42];
else if( fdss=="43"|| fdss=="sxws"|| fdss=="sanxi2")   fkds = ftss[43];
else if( fdss=="44"|| fdss=="fzzh"|| fdss=="fuzou1")   fkds = ftss[44];
else if( fdss=="45"|| fdss=="fzys"|| fdss=="fuzou2")   fkds = ftss[45];
else if( fdss=="46"|| fdss=="fzsh"|| fdss=="fuzou3")   fkds = ftss[46];
else if( fdss=="47"|| fdss=="zjws"|| fdss=="zhejiang")   fkds = ftss[47];
else if( fdss=="48"|| fdss=="qjws"|| fdss=="qianjiang")  fkds = ftss[49];
else if( fdss=="49"|| fdss=="zjjj"|| fdss=="zhejiang1")  fkds = ftss[49];
else if( fdss=="50"|| fdss=="zjkj"|| fdss=="zhejiang2")  fkds = ftss[50];
else if( fdss=="51"|| fdss=="zjys"|| fdss=="zhejiang3")  fkds = ftss[51];
else if( fdss=="52"|| fdss=="hfxw"|| fdss=="hefei1") fkds = ftss[52];//合肥新闻
else if( fdss=="53"|| fdss=="hfsh"|| fdss=="hefei2") fkds = ftss[53];//合肥生活
else if( fdss=="54"|| fdss=="hffz"|| fdss=="hefei3") fkds = ftss[54];//合肥法制
else if( fdss=="55"|| fdss=="hfwt"|| fdss=="hefei4") fkds = ftss[55];//合肥文体
else if( fdss=="52"|| fdss=="njxw"|| fdss=="nanjin1")   fkds = ftss[52];
else if( fdss=="53"|| fdss=="njkj"|| fdss=="nanjin2")   fkds = ftss[53];
else if( fdss=="54"|| fdss=="njsh"|| fdss=="nanjin3")   fkds = ftss[54];
else if( fdss=="55"|| fdss=="njyl"|| fdss=="nanjin4")   fkds = ftss[55];
else if( fdss=="56"|| fdss=="whxw"|| fdss=="wuhu1")   fkds = ftss[56];
else if( fdss=="57"|| fdss=="whsh"|| fdss=="wuhu2")   fkds = ftss[57];
else if( fdss=="58"|| fdss=="whgg"|| fdss=="wuhu3")   fkds = ftss[58];
else if( fdss=="59"|| fdss=="whjy"|| fdss=="wuhu4")   fkds = ftss[59];
else if( fdss=="60"|| fdss=="laxw"|| fdss=="liuan1")   fkds = ftss[60];
else if( fdss=="61"|| fdss=="lagg"|| fdss=="liuan2")   fkds = ftss[61];
else if( fdss=="62"|| fdss=="ycsh"|| fdss=="yincuan1")   fkds = ftss[62];
else if( fdss=="63"|| fdss=="ycgg"|| fdss=="yincuan2")   fkds = ftss[63];
else if( fdss=="64"|| fdss=="xzxw"|| fdss=="xuzou1")   fkds = ftss[64];
else if( fdss=="65"|| fdss=="xzjj"|| fdss=="xuzou2")   fkds = ftss[65];
else if( fdss=="66"|| fdss=="xzys"|| fdss=="xuzou3")   fkds = ftss[66];
else if( fdss=="67"|| fdss=="xzgg"|| fdss=="xuzou4")   fkds = ftss[67];
else if( fdss=="68"|| fdss=="btxw"|| fdss=="baotou1")   fkds = ftss[68];
else if( fdss=="69"|| fdss=="btsh"|| fdss=="baotou2")   fkds = ftss[69];
else if( fdss=="70"|| fdss=="btjj"|| fdss=="baotou3")   fkds = ftss[70];
else if(fdss=="71"|| fdss=="zsxw"||fdss=="zousan1")   fkds = ftss[71];
else if(fdss=="72"|| fdss=="zsgg"||fdss=="zousan2")   fkds = ftss[72];
else if(fdss=="73"|| fdss=="zsly"||fdss=="zousan3")   fkds = ftss[73];
else if( fdss=="74"|| fdss=="szzh"|| fdss=="suzou1")    fkds = ftss[74];
else if( fdss=="75"|| fdss=="szgg"|| fdss=="suzou2")    fkds = ftss[75];
else if( fdss=="76"|| fdss=="szkj"|| fdss=="suzou3")    fkds = ftss[76];
else if( fdss=="77"|| fdss=="hsgg"|| fdss=="hstv2")     fkds = ftss[77];
else if( fdss=="78"|| fdss=="hsxw"|| fdss=="hstv1")     fkds = ftss[78];
else if( fdss=="79"|| fdss=="hsys"|| fdss=="hstv3")     fkds = ftss[79];
else if( fdss=="80"|| fdss=="hbzh"|| fdss=="hebi")      fkds = ftss[80];
else if( fdss=="81"|| fdss=="zjg"|| fdss=="zhangjiagang") fkds = ftss[81];
else if( fdss=="82"|| fdss=="dyzh"|| fdss=="dongyin1")      fkds = ftss[82];
else if( fdss=="83"|| fdss=="dykj"|| fdss=="dongyin2")      fkds = ftss[83];
else if( fdss=="84"|| fdss=="dygg"|| fdss=="dongyin3")      fkds = ftss[84];
else if(fdss=="85"|| fdss=="xaxw"||fdss=="xian1")     fkds = ftss[85];
else if(fdss=="86"|| fdss=="xabg"||fdss=="xian2")     fkds = ftss[86];
else if(fdss=="87"|| fdss=="xazx"||fdss=="xian3")     fkds = ftss[87];
else if(fdss=="88"|| fdss=="xays"||fdss=="xian4")     fkds = ftss[88];
else if( fdss=="89"|| fdss=="yyxw"|| fdss=="yuyao1")   fkds = ftss[89];
else if( fdss=="90"|| fdss=="yywh"|| fdss=="yuyao2")   fkds = ftss[90];
else if( fdss=="91"|| fdss=="yysh"|| fdss=="yuyao3")   fkds = ftss[91];
else if(fdss=="92"|| fdss=="xsxw"||fdss=="xiaosan1")    fkds = ftss[92];
else if(fdss=="93"|| fdss=="xssh"||fdss=="xiaosan2")    fkds = ftss[93];
else if(fdss=="94"|| fdss=="syxw"||fdss=="shangyu1")    fkds = ftss[94];
else if(fdss=="95"|| fdss=="syjj"||fdss=="shangyu2")    fkds = ftss[95];
else if(fdss=="96"|| fdss=="xcxw"||fdss=="xincang1")    fkds = ftss[96];
else if(fdss=="97"|| fdss=="xcys"||fdss=="xincang2")    fkds = ftss[97];
else if(fdss=="98"|| fdss=="szxw"||fdss=="senzou")    fkds = ftss[98];
else if(fdss=="99"|| fdss=="lygzh"||fdss=="lianyungang1")  fkds = ftss[99];
else if(fdss=="100"|| fdss=="lyggg"||fdss=="lianyungang2") fkds = ftss[100];
else if(fdss=="101"|| fdss=="sdys"||fdss=="sandong1") fkds = ftss[101];
else if(fdss=="102"|| fdss=="sdzy"||fdss=="sandong2") fkds = ftss[102];
else if(fdss=="103"|| fdss=="sdsh"||fdss=="sandong3") fkds = ftss[103];
else if(fdss=="104"|| fdss=="sdgg"||fdss=="sandong4") fkds = ftss[104];
else if(fdss=="105"|| fdss=="sdnk"||fdss=="sandong5") fkds = ftss[105];
else if(fdss=="106"|| fdss=="sdty"||fdss=="sandong6") fkds = ftss[106];
else if(fdss=="107"|| fdss=="sdql"||fdss=="sandong7") fkds = ftss[107];
else if(fdss=="108"|| fdss=="ntxw"||fdss=="nantong1") fkds = ftss[108];//南通新闻
else if(fdss=="109"|| fdss=="ntsj"||fdss=="nantong2") fkds = ftss[109];//南通2
else if(fdss=="110"|| fdss=="ntgg"||fdss=="nantong3") fkds = ftss[110];//南通公共
else if(fdss=="111"|| fdss=="ntcc"||fdss=="nantong4") fkds = ftss[111];//崇川TV
else if(fdss=="112"|| fdss=="ntxn"||fdss=="nantong5") fkds = ftss[112];//Xn新闻
else if(fdss=="113"|| fdss=="scjj"||fdss=="sicuan1") fkds =ftss[113];//四川经济
else if(fdss=="114"|| fdss=="scwh"||fdss=="sicuan2") fkds =ftss[114];//四川文化
else if(fdss=="115"|| fdss=="sxxw"||fdss=="sicuan3") fkds =ftss[115];//四川新闻
else if(fdss=="116"|| fdss=="scys"||fdss=="sicuan4") fkds =ftss[116];//四川影视
else if(fdss=="117"|| fdss=="sc7"||fdss=="sicuan5") fkds =ftss[117];//四川7
else if(fdss=="118"|| fdss=="scxc"||fdss=="sicuan5") fkds =ftss[118];//四川乡村
else if(fdss=="119"|| fdss=="kmjj"||fdss=="kunming1") fkds =ftss[119];//昆明经济
else if(fdss=="120"|| fdss=="kmkx"||fdss=="kunming2") fkds =ftss[120];//昆明科学
else if(fdss=="121"|| fdss=="kmly"||fdss=="kunming3") fkds =ftss[121];//昆明娱乐
else if(fdss=="122"|| fdss=="kmys"||fdss=="kunming4") fkds =ftss[122];//昆明影视
else if(fdss=="123"|| fdss=="kmgg"||fdss=="kunming5") fkds =ftss[123];//昆明公共
else if(fdss=="124"|| fdss=="hbjj"||fdss=="hebei1") fkds =ftss[124];//河北经济
else if(fdss=="125"|| fdss=="hbjj"||fdss=="hebei2") fkds =ftss[125];//河北都市
else if(fdss=="126"|| fdss=="hbjj"||fdss=="hebei3") fkds =ftss[126];//河北影视
else if(fdss=="127"|| fdss=="hbjj"||fdss=="hebei4") fkds =ftss[127];//河北公共
else if(fdss=="128"|| fdss=="hbjj"||fdss=="hebei5") fkds =ftss[128];//河北农民
else fkds = ftss[13];
}else fkds = fkds;
return fkds;
}
function jsur(){
//var us=ulss()?ulss():'0';
     if(us=="0" ) return "https://api.jiubojx.com/vip/?url=";
else if(us=="1" ) return "https://www.administratorw.com/video.php?url=";
else if(us=="2" ) return "http://yy.sv028.cn/public/player/player.php?url=";
else if(us=="3" ) return "https://jx.618g.com/?url=";
else if(us=="4" ) return "https://api.okjx.cc:3389/jx.php?url=";
else if(us=="5" ) return "https://www.kpezp.cn/jlexi.php?url=";
else if(us=="6" ) return "https://www.33tn.cn/?url=";
else if(us=="7" ) return "https://jx.xmflv.com/?url=";
else if(us=="8" ) return "http://vip.66parse.club/?url=";
else if(us=="9" ) return "http://jx.yparse.com/index.php?url=";//b
else if(us=="10") return "https://www.ckmov.vip/api.php?url=";
else if(us=="11") return "http://17kyun.com/api.php?url=";//b
else if(us=="12") return "https://z1.m1907.cn/?jx=";//b
else if(us=="13") return "https://www.nxflv.com/?url=";
else if(us=="14") return "https://www.8090g.cn/jiexi/?url=";
else if(us=="15") return "https://www.xymav.com/?url=";
else if(us=="16") return "https://m2090.com/?url=";//b
else if(us=="17") return "https://jx.duzheba.cn/hy/?url=";
else if(us=="18") return "https://17kyun.com/jx.php?url=";//b
else if(us=="19") return "https://www.qianyicp.com/jiexi/index.php?url=";
else if(us=="20") return "https://1717.ntryjd.net/1717yun/?url=";
else if(us=="21") return "https://jx.yswy.top/?url=";
else if(us=="22") return "https://lbjx9.com/?url=";
else if(us=="23") return "https://jx5.178du.com/p1/?url=";
else if(us=="24") return "https://jx.m3u8.tv/jiexi/?url=";
else if(us=="25") return "https://jx.aidouer.net/?url=";
else if(us=="26") return "http://v.whalefall.net/ptjx/vip4.php?url=";
else if(us=="27") return "http://vip.wandhi.com/?v=";
else if(us=="28") return "https://jx.sjzvip.com/?v=";
else if(us=="29") return "https://y.9dan.cc/?v=";//b
else if(us=="30") return "https://jx.jiubojx.com/vip/?url=";
else if(us=="31") return "https://www.jiexila.com/?url=";
else if(us=="32") return "https://chaxun.truechat365.com/?url=";
else return "https://z1.m1907.cn/?jx=";
}
function udss(){
var ntss = new Array();
var udss = "";
var us=ulss()?ulss():'0';
ntss[0] = 'https://api.jiubojx.com/vip/?url=';
ntss[1] = 'https://www.administratorw.com/video.php?url=';
ntss[2] = 'http://yy.sv028.cn/public/player/player.php?url=';
ntss[3] = 'https://jx.618g.com/?url=';
ntss[4] = 'https://api.okjx.cc:3389/jx.php?url=';
ntss[5] = 'https://www.kpezp.cn/jlexi.php?url=';
ntss[6] = 'https://www.33tn.cn/?url=';
ntss[7] = 'https://jx.xmflv.com/?url=';
ntss[8] = 'http://vip.66parse.club/?url=';
ntss[9] = 'http://jx.yparse.com/index.php?url=';
ntss[10]= 'https://www.ckmov.vip/api.php?url=';
ntss[11]= "http://17kyun.com/api.php?url=";
ntss[12]= "https://z1.m1907.cn/?jx=";
ntss[13]= "https://www.nxflv.com/?url=";
ntss[14]= "https://www.8090g.cn/jiexi/?url=";
ntss[15]= "https://www.xymav.com/?url=";
ntss[16]= "https://m2090.com/?url=";
ntss[17]= "https://jx.duzheba.cn/hy/?url=";
ntss[18]= "https://17kyun.com/jx.php?url=";
ntss[19]= "https://www.qianyicp.com/jiexi/index.php?url=";
ntss[20]= "https://1717.ntryjd.net/1717yun/?url=";
ntss[21]= "https://jx.yswy.top/?url=";
ntss[22]= "https://lbjx9.com/?url=";
ntss[23]= "https://jx5.178du.com/p1/?url=";
ntss[24]= "https://jx.m3u8.tv/jiexi/?url=";
ntss[25]= "https://jx.aidouer.net/?url=";
ntss[26]= "http://v.whalefall.net/ptjx/vip4.php?url=";
ntss[27]= "http://vip.wandhi.com/?v=";
ntss[28]= "https://jx.sjzvip.com/?v=";
ntss[29]= "https://y.9dan.cc/?v=";
ntss[30]= "https://jx.jiubojx.com/vip/?url=";
ntss[31]= "https://www.jiexila.com/?url=";
ntss[32]= "https://chaxun.truechat365.com/?url=";
     if( us=="0")  udss = ntss[0];
else if( us=="1")  udss = ntss[1];
else if( us=="2")  udss = ntss[2];
else if( us=="3")  udss = ntss[3];
else if( us=="4")  udss = ntss[4];
else if( us=="5")  udss = ntss[5];
else if( us=="6")  udss = ntss[6];
else if( us=="7")  udss = ntss[7];
else if( us=="8")  udss = ntss[8];
else if( us=="9")  udss = ntss[9];
else if( us=="10") udss = ntss[10];
else if( us=="11") udss = ntss[11];
else if( us=="12") udss = ntss[12];
else if( us=="13") udss = ntss[13];
else if( us=="14") udss = ntss[14];
else if( us=="15") udss = ntss[15];
else if( us=="16") udss = ntss[16];
else if( us=="17") udss = ntss[17];
else if( us=="18") udss = ntss[18];
else if( us=="19") udss = ntss[19];
else if( us=="20") udss = ntss[20];
else if( us=="21") udss = ntss[21];
else if( us=="22") udss = ntss[22];
else if( us=="23") udss = ntss[23];
else if( us=="24") udss = ntss[24];
else if( us=="25") udss = ntss[25];
else if( us=="26") udss = ntss[26];
else if( us=="27") udss = ntss[27];
else if( us=="28") udss = ntss[28];
else if( us=="29") udss = ntss[29];
else if( us=="30") udss = ntss[30];
else if( us=="31") udss = ntss[31];
else if( us=="32") udss = ntss[32];
else udss=ntss[0];
return udss;
}
function jscd() {
//var us=ulss()?ulss():'0';
     if(us=="0" ) return "./d.htm?u=&f=";
else if(us=="1" ) return "https://shayujx.com/?url=";
else if(us=="2" ) return "https://lbjx9.com/?&url=";
else if(us=="3" ) return "https://jx.444662.cn/m3u8/?url=";
else if(us=="4" ) return "https://www.dplayerx.com/m3u8.php?url=";//p
else if(us=="5" ) return "https://jx.yswy.top/?&url=";//p
else if(us=="6" ) return "https://www.ooe.la/m3u8/?url=";//p
else if(us=="7" ) return "https://img.mandudu.com/dp.html?&v=";
else if(us=="8") return "https://lajiaoapi.com/watch?&url=";
else if(us=="9") return "https://lbjx9.com/?&url=";
else if(us=="10") return "https://www.cuan.la/m3u8.php?&url=";
else if(us=="11") return "https://play.ds163.cc/play/m3u8.php?&v=";//
else return "../w.htm?f=";
}
function jsck() {
//var us=ulss()?ulss():'0';
var wck = "";
     if(us=="0" ) wck = "../ck/";
else if(us=="1" ) wck = "http://www.ye23.win/ck/";
else if(us=="2" ) wck = "http://player.ioioz.com/ckplayer/";
else if(us=="3" ) wck = "http://www.cietv.com/player/ckplayer/";
else if(us=="4" ) wck = "http://player.200877926.top/ckplayer/";
else if(us=="5" ) wck = "http://www.cietv.com/CKm3u8/ckplayer/";
else if(us=="6" ) wck = "https://play.ds163.cc/jiexi/player/ckplayer/";
else if(us=="7" ) wck = "http://fsgroup.com/scripts/ckplayer/";
else if(us=="8" ) wck = "http://jiexi.071811.cc/2x/ckplayer/";
else if(us=="9" ) wck = "https://wow.techbrood.com/uploads/150901/";
else if(us=="10") wck = "https://api.1dior.cn/analysis/123/player/ckplayer/";
else if(us=="11") wck = "https://1717.ntryjd.net/1717yun/player/ckplayer/";
else if(us=="12") wck = "https://aaa.000180.top/180/ckplayer/";
else if(us=="13") wck = "http://hq.ioioz.com/static/js/ckplayer/";
else if(us=="14") wck = "https://www.administratorm.com/WMXZ/ckplayer/";
else wck = "./ck/";
return wck;
}
function jskk() {
var us=ulss()?ulss():'0';
var wnk = "ckplayer.js";
var wmk = "ckplayer.min.js";
var wkk = "";
     if(us=="0" ) wkk = "./k/";
else if(us=="1" ) wkk = "https://cdn.jsdelivr.net/npm/p2p-ckplayer@latest/ckplayer/";
else if(us=="2" ) wkk = "http://player.ioioz.com/ckplayerx/";
else if(us=="3" ) wkk = "https://www.yaosou.cc/jiexi/player/ckplayerx/";
else if(us=="4" ) wkk = "https://www.xymav.com/xiaoyema/player/ckplayer/";
else if(us=="5" ) wkk = "https://www.tuyidm.com/m3u8/ck/ckx/";
else if(us=="6" ) wkk = "https://aaa.000180.top/180/ckplayerx/";
else if(us=="7" ) wkk = "https://api.1dior.cn/analysis/123/player/ckplayerx/";
else if(us=="8" ) wkk = "https://cdn.jsdelivr.net/gh/yellowside/ckplayer/";
else if(us=="9" ) wkk = "https://2.ddyunbo.com/html/ckplayerx/";
else if(us=="10") wkk = "https://ddyunbo.com/ckplayerx/";
else if(us=="11") wkk = "https://dadi-bo.com/html/ckplayerx/";
else if(us=="12") wkk = "https://www.mycheryclub.com/js/player/ckplayerx/";
else if(us=="13") wkk = "https://ckplayer.com/public/static/ckplayer-x2/";
else if(us=="14") wkk = "http://tsdmw.net/yunbo/ckx/";
else if(us=="15") wkk = "https://vip4.ddyunbo.com/html/ckplayerx/";
else if(us=="16") wkk = "https://www.ikulive.com/ckplayer/";
else if(us=="17") wkk = "https://www.umming.com/demo/ckplayer/js/";
else if(us=="18") wck = "http://xzglwx.gandongyun.com/xz_video/js/h5videoplayer/js/ckplayer/";
else if(us=="19") wkk = "https://lirongyao.com/player/ckx/";
else wkk = "./ckplayerx/";
if(us=='1'||us=='17'||us=='18') return wkk + wmk;else return wkk + wnk;
}
/*
function swfn(){
var swfn = new Array();
var swfd ='';
swfn[0] = 'http://y0.ifengimg.com/swf/ifengLivePlayer_v5.0.50_p.swf';
swfn[1] = 'http://v.ifeng.com/include/exterior.swf';
swfn[2] = 'https://staticlive.douyucdn.cn/common/share/play.swf';
swfn[3] = 'http://g.alicdn.com/de/prismplayer-flash/1.2.16/PrismPlayer.swf';
swfn[4] = 'http://data.cnlive.com/export/CnlivePlayer_v5.swf';
swfn[5] = 'http://player.hunantv.com/mgtv_v5_live/live.swf';
if( us=="0") swfd = swfn[0];
else if( us=="1") swfd = swfn[1];
else swfd=swfn[0];
return swfd;
}
function swfm(){
var kfss = fkss();
var swfm = new Array();
var swfd ='';
swfm[0] = 'http://liveshare.huya.com/'+kfss+'/huyacoop.swf';
swfm[1] = 'https://staticlive.douyucdn.cn/common/share/play.swf?room_id='+kfss;
swfm[2] = 'http://g.alicdn.com/de/prismplayer-flash/1.2.16/PrismPlayer.swf?vurl=' + kfss;
swfm[3] = 'https://www.ixigua.com/embed/?group_id='+kfss;
swfm[4] = 'http://data.cnlive.com/export/CnlivePlayer_v5.swf?eleId=live&type=1&model=1&owner=1&appid=82_irej0pbo53&channelid='+kfss;
swfm[5] = 'http://player.hunantv.com/mgtv_v5_live/live.swf?activity_id='+kfss+'&channel_id='+kfss;
swfm[6] = 'http://liveshare.huya.com/iframe/'+kfss;
swfm[7] = 'http://player.kksmg.com/data/player_swf/KKPlayer.swf?playerId=2969363206&liveChannelID=8000'+kfss;
swfm[8] = 'http://player.youku.com/embed/'+kfss;
swfm[9] = 'https://v.qq.com/txp/iframe/player.html?&auto=1&vid='+kfss;
swfm[10]= 'https://api.qianqi.net/ckplayer/live.html?url='+kfss;
if( us=="0") swfd = swfm[7];
else if( us=="1") swfd = swfm[1];
else swfd=swfm[0];
return swfd;
}*/
/*response.setDateHeader("Expires", 0);      
response.setHeader("Cache-Control", "no-store");      
response.setHeader("Pragma", "no-store");
function click(){　if(event.button!==1){　alert( '哥们，手下留情 !!'); 　} } 
document.onmousedown=click
*/
var murl=new Array()
 murl[0 ]="../t.htm?&f=http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
 murl[1 ]="../t.htm?&f=http://183.207.255.190/live/program/live/zgqx/1300000/mnf.m3u8";



