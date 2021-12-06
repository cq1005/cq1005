<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type=text/css>
HTML{
overflow:scroll;
overflow-x: hidden;
overflow-x: auto !important;
FONT-FAMILY:ºÚÌå;
font-size:12px;}
</style>
<style>*,body,ul,h1,h2{ margin:0; padding:0px;}
a{ color:#c0c0c0;border:#808080 1px solid;FONT-FAMILY:ËÎÌå;}
#menu { width:100%;}
#menu h1 {height:18px; line-height:14px; background:#303030;text-indent:5px;font-size:13px;font-weight:bold;cursor:default;border-bottom:0.2px #222222 solid; margin-bottom:0.2px;}
#menu h2 {height:14px; line-height:14px; background:#303030;text-indent:5px;font-size:13px;font-weight:bold;cursor:default;border-bottom:0.2px #585830 solid; margin-bottom:0.2px;}
#menu a { display:block; padding:5px 0 3px 14px;text-decoration:none;overflow:hidden;border:#222222 0px solid;}
#menu a:hover{ color:#FF0000; background:#66aeff;}
#menu .no {display:none;}
#menu .h1 a{color:#FF0000;background:#006600;}
#menu .h2 a{color:#FF0000;background:#556655;}
</style>
</head>
<script language="JavaScript">
<!--//
function ShowMenu(obj,n){
  var Nav = obj.parentNode;
  if(!Nav.id){  var BName = Nav.getElementsByTagName("ul");
  var HName = Nav.getElementsByTagName("h2");
  var t = 2; }else{
  var BName = document.getElementById(Nav.id).getElementsByTagName("span");
  var HName = document.getElementById(Nav.id).getElementsByTagName("h1");
  var t = 1; }
  for(var i=0; i<HName.length;i++){
  HName[i].innerHTML = HName[i].innerHTML.replace("-","+");
  HName[i].className = ""; }
  obj.className = "h" + t;
  for(var i=0; i<BName.length; i++){
  if(i!=n){BName[i].className = "no";}}
  if(BName[n].className == "no"){
  BName[n].className = "";
  obj.innerHTML = obj.innerHTML.replace("+","-"); }else{
  BName[n].className = "no"; 
  obj.className = "";  
  obj.innerHTML = obj.innerHTML.replace("-","+"); }}
//-->
</script>
<body style="margin:0px;" bgcolor="#454545" scroll="auto">
<DIV id="menu"  style="height:auto scroll:auto" >
<a>~~~~~~~~~~~~~~~</a>
<h1 onClick="javascript:ShowMenu(this,0)"><a href="javascript:void(0)">+somv</a></h1>
<span class="yes">
<?php
header('Access-Control-Allow-Origin:*');
 include_once(iconv("gbk","UTF-8","../st/d/so.php"));?>
</span>
</DIV>
</body>
</html>