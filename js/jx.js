   $(document).ready(function () {
    $('.jiexi').click(function () {
      $('.panel').slideToggle('slow');
    });
     $('.panel a').click(function () {
      $('.panel').slideToggle('slow');
    });
  });
var url_adress = (GetQueryString("url"));
var flss = flss();
var url = flss;
var durl=new Array()
 durl[0 ] ="../v/A/?url="+flss;
 durl[1 ] ="../v/B/?url="+flss;
 durl[2 ] ="../v/C/?url="+flss;
 durl[3 ] ="../v/D/?url="+flss;
 durl[4 ] ="../v/E/?url="+flss;
 durl[5 ] ="../v/F/?url="+flss;
 durl[6 ] ="../v/G/?url="+flss;
 durl[7 ] ="../v/H/?url="+flss;
 durl[8 ] ="../v/I/?url="+flss;
 durl[9 ] ="../v/J/?url="+flss;
 durl[10 ]="../v/K/?url="+flss;
 durl[11 ]="../v/L/?url="+flss;
 durl[12 ]="../v/M/?url="+flss;
 durl[13 ]="../v/N/?url="+flss;
 durl[14 ]="../v/O/?url="+flss;
 durl[15 ]="../v/P/?url="+flss;
 durl[16 ]="../v/Q/?url="+flss;
 durl[17 ]="../v/R/?url="+flss;
 durl[18 ]="../v/S/?url="+flss;
 durl[19 ]="../v/T/?url="+flss;
 durl[20 ]="../v/U/?url="+flss;
 durl[21 ]="../v/V/?url="+flss;
 durl[22 ]="../v/W/?url="+flss;
var turl=new Array()
 turl[0 ]="./vv.htm?url="+flss;
 turl[1 ]="https://api.jiubojx.com/vip/?url="+flss;
 turl[2 ]="https://php.cloudhai.cn/new/?url="+flss;//http://vip.66parse.club/?url=
 turl[3 ]="https://player.gxtstatic.com/vipplay.php?&h=572&url="+flss;
 turl[4 ]="https://z1.m1907.cn/?jx="+flss;
 turl[5 ]="https://jx5.178du.com/p1/?url="+flss;
 turl[6 ]="https://123.xxgcx.cn:4433/jx.php?url="+flss;
 turl[7 ]="http://api.baiyug.vip/?url="+flss;
 turl[8 ]="https://jx.m3u8.tv/jiexi/?url="+flss;
 turl[9 ]="https://ckmov.ccyjjd.com/ckmov/?url="+flss;
 turl[10 ]="https://play.ds163.cc/jiexi/?url="+flss;
 turl[11 ]="https://yparse.jn1.cc/index.php?url="+flss;
 turl[12 ]="https://www.kpezp.cn/jlexi.php?url="+flss;
 turl[13 ]="https://dmjx.m3u8.tv/?url="+flss;
 turl[14 ]="https://api.jiubojx.com/vip/?url="+flss;
 turl[15 ]="https://www.qianyicp.com/jiexi/index.php?url="+flss;
 turl[16 ]="http://jx.13tv.top/?url=" +flss;
 turl[17 ]="https://jx.yswy.top/?url="+flss;
 turl[18 ]="http://okjx.cc/?url="+flss;
 turl[19 ]="https://jx.618g.com/?url="+flss;
 turl[20 ]="https://jiexi.fei05.xyz/?url="+flss;
 turl[21 ]="https://jx.htv009.com/?url="+flss;
 turl[22 ]="https://api.sigujx.com/?url="+flss;
 turl[23 ]="https://www.33tn.cn/?url="+flss;
 turl[24 ]="https://jiexi.380k.com/?url="+flss;
 turl[100 ]="./vv.htm?url="+flss;
    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)return unescape(r[2]);
        return null;
    }
   function playt(url) {
     loadat();
        $('#PLAYERS').attr('src', decodeURIComponent(decodeURIComponent(url))).show();
    }
  function loadat() {
		var a = document.getElementById("playat");
		a.innerHTML = '<iframe  width="100%" height="100%" src="" frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no"   ></iframe>';
		$("#playat").show()
	setTimeout("$('#playat').empty().hide();$('#PLAYERS').show();", 0 * 1000)
}
   function playd(url) {
     loadad();
        $('#PLAYERS').attr('src', decodeURIComponent(decodeURIComponent(url))).show();
    }
   
  function loadad() {
		var a = document.getElementById("playad");
		a.innerHTML = '<iframe  width="100%" height="100%" src="" frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no"   ></iframe>';
		$("#playad").show()
	setTimeout("$('#playad').empty().hide();$('#PLAYERS').show();", 0 * 1000)
}
function getId( s ) { var re = new RegExp( s + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function flss(){
var flss = getId('f')?getId('f'):getId('url')?getId('url'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
if(flss==null || flss==''){flss='';}else{flss=flss;};
return flss;
}