    var videos = new Array();
    var timeline = new Array( 0 );
    var nowVideoLocation = 0;
    var playerNum = 0;
    var totalTime = 0;
    var currentVideoTime = 0;
    var i = 0;
    var targetTime = 0;
    var targetPlayer = 0;
    var loadNextSource = false;
    var playtime = 0;
    var errid = 0;
    var isiPad = navigator.userAgent.match( /iPad|iPhone|Android|Linux|iPod/i ) != null;
    var vodhtml = '<div class="player"><div class="play"></div><div class="vod"><video class="video"></video><video class="video" style="display:none"></video></div><div class="cmd"><div class="left tvp_button tvp_play"><button type="button" title="[播放暂停]"><span class="tvp_btn_value">[播放]</span></button></div><div class="centent tvp_time_rail"><span class="tvp_time_total"><span class="tvp_time_loaded" style="width:0"></span></span> <span class="tvp_time_panel">[<span class="time1">00:00</span>/<span class="time2">00:00</span>]</span></div><div class="right tvp_button tvp_fullscreen_button"><button type="button" title="[全屏切换]"><span class="tvp_quan">[全屏]</span></button></div><span class="tvp_time_handel_hint" style="display:none"></span></div></div>';
    var ydiskvod = {
      init: function ( urlarr ) {
        if ( urlarr instanceof Array ) {
          videos = urlarr;
        } else {
          videos[ 0 ] = urlarr;
        }
        $( 'document' ).ready( function () {
          initTimeline();
          $( '.tvp_button,.play' ).click( function () {
            if ( $( '.video' )[ playerNum ].paused ) {
              $( '.video' )[ playerNum ].play();
              $( '.play' ).hide();
              $( '.tvp_button' ).removeClass( 'tvp_play' ).addClass( 'tvp_pause' );
            } else {
              $( '.video' )[ playerNum ].pause();
              $( '.play' ).show();
              $( '.tvp_button' ).addClass( 'tvp_play' ).removeClass( 'tvp_pause' );
            }
          } );
          $( '.tvp_time_total' ).click( function () {
            var w = parseFloat( $( this ).css( 'width' ) );
            var l = $( this ).offset().left;
            var e = event || window.event;
            var p = e.pageX;
            var pro = ( p - l ) / w * 100 + '%';
            $( '.tvp_time_loaded' ).css( 'width', pro );
            var time = totalTime * ( p - l ) / w;
            setToTime( time )
          } );
          $( '.tvp_fullscreen_button' ).click( function () {
            $( '.video' )[ playerNum ].webkitEnterFullscreen();
            $( '.video' )[ playerNum ].mozRequestFullScreen();
            return false
          } )
        } )
      }
    };
 
    function initHandler() {
      timeline[ i ] = $( '.video' )[ 1 ].duration;
      totalTime += timeline[ i ];
      if ( i < videos.length - 1 ) {
        $( '.video' )[ 1 ].src = videos[ ++i ]
      } else {
        $( '.video' )[ 1 ].src = '';
        $( '.video' )[ 1 ].removeEventListener( 'loadedmetadata', initHandler, true )
      }
    }
 
    function currentTimeHandler() {
      currentVideoTime = $( '.video' )[ playerNum ].currentTime;
      if ( timeline[ nowVideoLocation ] - currentVideoTime < 20 && !loadNextSource ) {
        loadNextVideo( nowVideoLocation + 1 );
        loadNextSource = true
      }
      var currentVideoTime2 = Number( playtime ) + Number( currentVideoTime );
      $( '.time1' ).html( timetostr( currentVideoTime2 ) );
      $( '.time2' ).html( timetostr( totalTime ) );
      var wid = currentVideoTime2 / totalTime * 100 + '%';
      $( '.tvp_time_loaded' ).css( 'width', wid );
      $( '.video' )[ playerNum ].controls = false;
    }
 
    function initTimeline() {
      $( '.video' )[ 1 ].preload = 'auto';
      $( '.video' )[ 1 ].src = videos[ i ];
      $( '.video' )[ 0 ].src = videos[ i ];
      $( '.video' )[ 1 ].addEventListener( 'loadedmetadata', initHandler, true );
      $( '.video' )[ 0 ].addEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ 0 ].addEventListener( 'ended', switchNextVideo, true )
    }
 
    function loadNextVideo( nextLocation ) {
      var nextPlayer = Number( !playerNum );
      if ( nextLocation < videos.length ) {
        $( '.video' )[ nextPlayer ].preload = 'auto';
        $( '.video' )[ nextPlayer ].src = videos[ nextLocation ]
      }
    }
 
    function setToTime( time ) {
      var videoChapter;
      var nextPlayer = Number( !playerNum );
      if ( time >= totalTime ) {
        videoChapter = videos.length - 1;
        time = totalTime
      } else {
        for ( videoChapter = 0; videoChapter < videos.length - 1; videoChapter++ ) {
          if ( time - timeline[ videoChapter ] < 0 ) {
            break
          } else {
            time -= timeline[ videoChapter ]
          }
        }
      }
      if ( videoChapter == nowVideoLocation ) {
        $( '.video' )[ playerNum ].currentTime = time
      } else {
        loadNextVideo( videoChapter );
        targetTime = time;
        targetPlayer = nextPlayer;
        $( '.video' )[ targetPlayer ].addEventListener( 'durationchange', jumpToTime, true );
        switchToVideo();
        nowVideoLocation = videoChapter
      }
    }
 
    function jumpToTime() {
      $( '.video' )[ targetPlayer ].currentTime = targetTime;
      $( '.video' )[ targetPlayer ].removeEventListener( 'durationchange', jumpToTime, true )
    }
 
    function switchNextVideo() {
      var nextPlayer = Number( !playerNum );
      loadNextSource = false;
      if ( nowVideoLocation < videos.length - 1 ) {
        $( '.video:eq(' + nextPlayer + ')' ).css( 'display', '' );
        $( '.video:eq(' + playerNum + ')' ).css( 'display', 'none' );
        $( '.video' )[ playerNum ].pause();
        $( '.video' )[ playerNum ].removeEventListener( 'timeupdate', currentTimeHandler, true );
        $( '.video' )[ playerNum ].removeEventListener( 'ended', switchNextVideo, true );
        $( '.video' )[ playerNum ].src = '';
        $( '.video' )[ nextPlayer ].addEventListener( 'timeupdate', currentTimeHandler, true );
        $( '.video' )[ nextPlayer ].addEventListener( 'ended', switchNextVideo, true );
        $( '.video' )[ nextPlayer ].play();
        nowVideoLocation++;
        playerNum = nextPlayer;
        playtime = Number( playtime ) + Number( currentVideoTime );
      } else {
        $( '.video' )[ playerNum ].removeEventListener( 'ended', switchNextVideo, true )
      }
    }
 
    function switchToVideo() {
      var nextPlayer = Number( !playerNum );
      loadNextSource = false;
      $( '.video:eq(' + nextPlayer + ')' ).css( 'display', '' );
      $( '.video:eq(' + playerNum + ')' ).css( 'display', 'none' );
      $( '.video' )[ playerNum ].pause();
      $( '.video' )[ playerNum ].removeEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ playerNum ].removeEventListener( 'ended', switchToVideo, true );
      $( '.video' )[ playerNum ].src = '';
      $( '.video' )[ nextPlayer ].addEventListener( 'timeupdate', currentTimeHandler, true );
      $( '.video' )[ nextPlayer ].addEventListener( 'ended', switchToVideo, true );
      $( '.video' )[ nextPlayer ].play();
      playerNum = nextPlayer;
      playtime = Number( playtime ) + Number( currentVideoTime )
    }
 
    function timetostr( time ) {
      var s = parseInt( time % 60 );
      if ( s < 10 ) {
        s = '0' + s
      }
      var m = parseInt( time / 60 );
      if ( m < 10 ) {
        m = '0' + m
      }
      return m + ':' + s
    }
 
    function error() {
      if ( isiPad ) {
        if ( $( '.video' )[ playerNum ].error.code == 4 ) {
          play_up()
        }
      } else {
        CKobject.getObjectById( 'ckplayer_a1' ).addListener( 'error', 'play_up' )
      }
    }
    $( document ).ready( function () {
      $('#play_header').click(function () {
        $('.panel').slideToggle();
        $(this).toggleClass("open");
      });
      $('.panel a').click(function(){
        $('.panel').slideToggle();
        $(this).addClass("active").siblings().removeClass("active");
        $("#play_header").removeClass("open");
      });
    } );
    document.oncontextmenu = function () {
      return false;
    }
function height(){  var height=document.documentElement.clientHeight; return height; }
function getId( s ) { var re = new RegExp( s + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function goPlay( url ){$( '#PLAYERS' ).attr( 'src', decodeURIComponent( decodeURIComponent( url ) ) ).show();  }
function WMXZ( url ) { $( '#WANG' ).attr('src',decodeURIComponent(decodeURIComponent(url))).show(); } 
function ifrm(){
var ifrm='width="100%" frameborder="0" scrolling="yes" allowtransparency="true" height="' + height() +'" style="width:100%;border:none"';
return ifrm;
}
function flss3(){
var ftss = "";
var fuss = getId('f')?getId('f'):getId('url')?getId('url'):"https://v.youku.com/v_show/id_XMTAwNDk1OTky.html";
var fdss = getId('f')?getId('f'):getId('url')?getId('url'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
var flss = getId('f')?getId('f'):getId('url')?getId('url'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
     if( flss==null||flss=="") ftss =fdss;
else if( flss=="0"||flss=="jiaotong") ftss ="http://tv.lanjingfm.com/cctbn/beijing.m3u8";//交通;
else if( flss=="1"||flss=="cctv1") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv1_2/index.m3u8";//cctv1;
else if( flss=="2"||flss=="cctv2") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv2_2/index.m3u8";//cctv2;
else if( flss=="3"|| flss=="cctv3") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv3_2/index.m3u8";//cctv3;
else if( flss=="4"|| flss=="cctv4") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv4_2/index.m3u8";//cctv4;
else if( flss=="5"|| flss=="cctv5") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv5_2/index.m3u8";//cctv5;
else if( flss=="6"|| flss=="cctv6") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv6_2/index.m3u8";//cctv6;
else if( flss=="7"|| flss=="cctv7") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv7_2/index.m3u8";//cctv7;
else if( flss=="8"|| flss=="cctv8") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv8_2/index.m3u8";//cctv8;
else if( flss=="9"|| flss=="cctv9"|| flss=="cctvjilu") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctvjilu_2/index.m3u8";//cctv9;
else if(flss=="10"|| flss=="cctv10") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv10_2/index.m3u8";//cctv10;
else if(flss=="11"|| flss=="cctv11") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv11_2/index.m3u8";//cctv11;
else if(flss=="12"|| flss=="cctv12") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv12_2/index.m3u8";//cctv12;
else if(flss=="13"|| flss=="cctv13") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";//cctv13;
else if(flss=="14"|| flss=="cctv14"|| flss=="cctvchild") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctvchild_2/index.m3u8";//cctv14;
else if(flss=="15"|| flss=="cctv15") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv15_2/index.m3u8";//音乐;
else if(flss=="16"|| flss=="btv4") ftss ="http://cctvksh5ca.v.kcdnvip.com/wstv/btv4_2/index.m3u8";//btv4;
else if(flss=="17"|| flss=="cctv17") ftss ="http://cctvalih5ca.v.myalicdn.com/live/cctv17_2/index.m3u8";//cctv17;
else if( flss=="18"|| flss=="laozuo") ftss ="http://cclive2.aniu.tv/live/anzb.m3u8";//老左;
else if( flss=="19"||flss=="dycj") ftss ="http://liveplay-kk.rtxapp.com/live/program/live/dycjhd/4000000/mnf.m3u8";//第一财经
else if( flss=="20"|| flss=="qixiang"|| flss=="tianqi") ftss ="http://hls.weathertv.cn/tslslive/qCFIfHB/hls/live_sd.m3u8";//气象;
else if( flss=="21" ||flss=="btv1"||flss=="bjws") ftss ="http://cctvksh5ca.v.kcdnvip.com/wstv/btv1_2/index.m3u8";//北京卫视;
else if( flss=="22" ||flss=="btv2") ftss ="http://cctvksh5ca.v.kcdnvip.com/wstv/btv2_2/index.m3u8";//BTV2;
else if( flss=="23"||flss=="btv3") ftss ="http://cctvksh5ca.v.kcdnvip.com/wstv/btv3_2/index.m3u8";//BTV3;
else if( flss=="24"||flss=="dfws"||flss=="dongfang") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/hddfws/4000000/mnf.m3u8";//东方卫视
else if( flss=="25"||flss=="hubei") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/hbwshd/4000000/mnf.m3u8";//湖北卫视
else if( flss=="26"||flss=="jsws"||flss=="jiangsu") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/jswshd/4000000/mnf.m3u8";//江苏卫视
else if( flss=="27"||flss=="hnws"||flss=="hunan") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/hnwshd/4000000/mnf.m3u8";//湖南卫视
else if( flss=="28"||flss=="szws"||flss=="shenzeng") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/szwshd/4000000/mnf.m3u8";//深圳卫视
else if( flss=="29"||flss=="qjs") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/qjshd/4000000/mnf.m3u8";//全纪实
else if( flss=="30"||flss=="shjs") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/jspdhd/4000000/mnf.m3u8";//上海纪实
else if( flss=="31"||flss=="shxw") ftss ="http://liveplay-kk.rtxapp.com/live/program/live/xwzhhd/4000000/mnf.m3u8";//上海新闻
else if( flss=="32"||flss=="dfdy"||flss=="dfys") ftss ="http://liveplay-kk.rtxapp.com/live/program/live/dsjpdhd/4000000/mnf.m3u8";//东方电影
else if( flss=="33"||flss=="sdws"||flss=="shandong") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/sdwshd/4000000/mnf.m3u8";//山东卫视
else if( flss=="34"||flss=="hljws"||flss=="heilongjiang") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/hljwshd/4000000/mnf.m3u8";//黑龙江卫视
else if( flss=="35"||flss=="scws"||flss=="sicuan") ftss ="http://keonline.shanghai.liveplay.qq.com/live/program/live/scwshd/4000000/mnf.m3u8";//四川卫视
else if( flss=="36"||flss=="zjws"|| flss=="zhejiang") ftss ="http://ali.m.l.cztv.com/channels/lantian/channel01/720p.m3u8";//浙江卫视
else if( flss=="37"||flss=="qjws"|| flss=="qianjiang") ftss ="http://ali.m.l.cztv.com/channels/lantian/channel02/720p.m3u8";//钱江卫视
else if( flss=="38"||flss=="zhejiangjinji"|| flss=="zjjj") ftss ="http://ali.m.l.cztv.com/channels/lantian/channel03/720p.m3u8";//浙江经济
else if( flss=="39"||flss=="zhejiangkejiao") ftss ="http://ali.m.l.cztv.com/channels/lantian/channel04/720p.m3u8";//浙江科教
else if( flss=="40"||flss=="zhejiangyingshi" || flss=="zjys") ftss ="http://ali.m.l.cztv.com/channels/lantian/channel05/720p.m3u8";//浙江影视
else if( flss=="41"||flss=="hebeiws" ||flss=="hebei") ftss ="http://weblive.hebtv.com/live/hbws_lc/index.m3u8";//河北卫视
else ftss = flss;
if( ftss.indexOf(".m3u")>0 || ftss.indexOf(".mp4")>0 || ftss.indexOf(".flv")>0 || ftss.indexOf(".f4v")>0|| ftss.indexOf(".avi")>0|| ftss.indexOf(".mkv")>0 || ftss.indexOf(".mov")>0 || ftss.indexOf(".mpeg")>0 || ftss.indexOf(".webm")>0 || ftss.indexOf(".rmvb")>0 || ftss.indexOf(".wmv")>0 || ftss.indexOf(".3gp")>0 ) {
var ftss = fdss;
}else {
var ftss = fuss;
}
if( ftss.length <15){
ftss = fdss;
return ftss;
}else {
return ftss;
}
}
function flss(){
var flss = getId('f')?getId('f'):getId('url')?getId('url'):"http://cctvalih5ca.v.myalicdn.com/live/cctv1_2/index.m3u8";
if(flss==null || flss==''){flss='';}else{flss=flss;};
return flss;
}
function alss(){
var alss = getId('a')?getId('a'):"tv";
if(alss==null || alss==''){alss='tv';}else{alss=alss;};
return alss;
}
function clss(){
var clss = getId('c')?getId('c'):"";
if(clss==null || clss==''){clss='';}else{clss=clss;};
return clss;
}
function th(){
var h=window.screen.height;document.cookie="screen="+h;var h1=h-200;var h2=h-190;var h3=h-180;var h4=h-170;var h5=h-160;var h6=h-150;var h7=h-140;var h8=h-130;
var hht = window.screen.height;
return h3;
}
function src(){
var src = "";
var flss1 = '../v2.htm?url='+flss+'&f='+flss;
var flss0 = '../ck.htm?f= ' + flss;
if( flss.indexOf('.rm'||'.flv'||'.f4v'||'.wmv'||'.mpv'||'.mp4'||'.3gb'||'.3gb2'||'.avi'||'.mkv'||'.mov'||'.mp3'||'.mpeg'||'.webm'||'.rmvb'||'.m3u') >0 ) src = flss0;
else if(flss.indexOf('rtmp:') >0 || flss.indexOf('rtsp:') >0  ) src=flss0;
else src = flss1;
return src;
}
function src2(){
var src = "";
var flss1 = "../v/A/?url="+flss;
var flss2 = "../v/B/?url=" + flss;
var flss3 = "../v/C/?url= " + flss;
var flss4 = "../v/D/?url= " + flss;
var flss0 = "../ck.htm?f= " + flss;
if( flss.indexOf('.rm'||'.flv'||'.f4v'||'.wmv'||'.mpv'||'.mp4'||'.3gb'||'.3gb2'||'.avi'||'.mkv'||'.mov'||'.mp3'||'.mpeg'||'.webm'||'.rmvb'||'.m3u') >0 ) src = flss0;else if(flss.indexOf('rtmp:') >0 || flss.indexOf('rtsp:') >0  ) src=flss0;
else src = flss1;
return src;
}
function sdrc(){
var src = "";
var flss1 = "../v/A/?url="+flss;
var flss0 = "../ck.htm?f= "+flss;
if( flss.indexOf('.rm'||'.flv'||'.f4v'||'.wmv'||'.mpv'||'.mp4'||'.3gb'||'.3gb2'||'.avi'||'.mkv'||'.mov'||'.mp3'||'.mpeg'||'.webm'||'.rmvb'||'.m3u') >0 ) src = flss0;else if(flss.indexOf('rtmp:') >0 || flss.indexOf('rtsp:') >0  ) src=flss0;
else src = flss1;
return src;
}
var flss = flss();
var src = src();
var src2 = src2();
var sdrc = sdrc();
var h=th();
var alss = alss();
var ifrm = ifrm();
var turl=new Array()
 turl[0 ]="./v2.htm?url="+flss;
 turl[1 ]="http://jiexi8.com/vip/index.php?url="+flss;
 turl[2 ]="http://vip.66parse.club/?url="+flss;
 turl[3 ]="https://player.gxtstatic.com/vipplay.php?&h=572&url="+flss;
 turl[4 ]="https://z1.m1907.cn/?jx="+flss;
 turl[5 ]="http://jx.du2.cc/?url="+flss;
 turl[6 ]="https://yun.guoyuvip.com/Yun.php?url="+flss;
 turl[7 ]="http://api.baiyug.vip/?url="+flss;
 turl[8 ]="http://2gty.com/apiurl/yun.php?url="+flss;
 turl[9 ]="http://api.nepian.com/ckparse/?url="+flss;
 turl[10 ]="https://play.ds163.cc/jiexi/?url="+flss;
 turl[11 ]="https://cdn.yangju.vip/k/?url="+flss;
 turl[12 ]="https://www.kpezp.cn/jlexi.php?url="+flss;
 turl[13 ]="http://www.jqaaa.com/jx.php?url="+flss;
 turl[14 ]="https://www.yaosou.cc/jiexi3/?url="+flss;
 turl[15 ]="https://www.qianyicp.com/jiexi/index.php?url="+flss;
 turl[16 ]="https://123dan.top/danke/ch?url=" +flss;
 turl[17 ]="https://jx.yswy.top/?url="+flss;
 turl[18 ]="http://okjx.cc/?url="+flss;
 turl[19 ]="https://jx.618g.com/?url="+flss;
 turl[20 ]="https://jiexi.fei05.xyz/?url="+flss;
 turl[21 ]="https://jx.htv009.com/?url="+flss;
 turl[22 ]="https://api.sigujx.com/?url="+flss;
 turl[23 ]="https://www.33tn.cn/?url="+flss;
 turl[24 ]="https://jiexi.380k.com/?url="+flss;

var durl=new Array()
 durl[0 ]="../v/A/?url="+flss;
 durl[1 ]="../v/B/?url="+flss;
 durl[2 ]="../v/C/?url="+flss;
 durl[3 ]="../v/D/?url="+flss;
 durl[4 ]="../v/E/?url="+flss;
 durl[5 ]="../v/F/?url="+flss;
 durl[6 ]="../v/G/?url="+flss;
 durl[7 ]="../v/H/?url="+flss;
 durl[8 ]="../v/I/?url="+flss;
 durl[9 ]="../v/J/?url="+flss;
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









