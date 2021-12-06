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
    var vodhtml = '<div class="player"><div class="play"></div><div class="vod"><video class="video"></video><video class="video" style="display:none"></video></div><div class="cmd"><div class="left tvp_button tvp_play"><button type="button" title="[²¥·ÅÔÝÍ£]"><span class="tvp_btn_value">[²¥·Å]</span></button></div><div class="centent tvp_time_rail"><span class="tvp_time_total"><span class="tvp_time_loaded" style="width:0"></span></span> <span class="tvp_time_panel">[<span class="time1">00:00</span>/<span class="time2">00:00</span>]</span></div><div class="right tvp_button tvp_fullscreen_button"><button type="button" title="[È«ÆÁÇÐ»»]"><span class="tvp_quan">[È«ÆÁ]</span></button></div><span class="tvp_time_handel_hint" style="display:none"></span></div></div>';
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
      $('#playat').click(function () {
        $('.panel').slideToggle();
        $(this).toggleClass("open");
      });
      $('.panel a').click(function(){
        $('.panel').slideToggle();
        $(this).addClass("active").siblings().removeClass("active");
        $("#playat").removeClass("open");
      });
    } );
    document.oncontextmenu = function () {
      return false;
    }
function height(){  var height=document.documentElement.clientHeight; return height; }
function getId( s ) { var re = new RegExp( s + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function playt( url ){$( '#PLAYERS' ).attr( 'src', decodeURIComponent( decodeURIComponent( url ) ) ).show();  }
function playd( url ) { $( '#WANG' ).attr('src',decodeURIComponent(decodeURIComponent(url))).show(); } 
function ifrm(){
var ifrm='width="100%" frameborder="0" scrolling="yes" allowtransparency="true" height="' + height() +'" style="width:100%;border:none"';
return ifrm;
}
function flss(){
var flss = getId('f')?getId('f'):getId('url')?getId('url'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
if(flss==null || flss==''){flss='';}else{flss=flss;};
return flss;
}
function alss(){
var alss = getId('a')?getId('a'):"tv";
if(alss==null || alss==''){alss='tv';}else{alss=alss;};
return alss;
}
function ulss(){
var ulss = getId('u')?getId('u'):"";
if(ulss==null || ulss==''){ulss='';}else{ulss=ulss;};
return ulss;
}
function th(){
var h=window.screen.height;document.cookie="screen="+h;var h1=h-200;var h2=h-190;var h3=h-180;var h4=h-170;var h5=h-160;var h6=h-150;var h7=h-140;var h8=h-130;
var hht = window.screen.height;
return h3;
}
function tsrc(){
var src = "";
var flss1 = '../v2.htm?&f='+flss;
var flss0 = '../ck.htm?f= ' + flss;
if( flss.indexOf('.rm'||'.flv'||'.f4v'||'.wmv'||'.mpv'||'.mp4'||'.3gb'||'.3gb2'||'.avi'||'.mkv'||'.mov'||'.mp3'||'.mpeg'||'.webm'||'.rmvb'||'.m3u') >0 ) src = flss0;
else if(flss.indexOf('rtmp:') >0 || flss.indexOf('rtsp:') >0  ) src=flss0;
else src = flss1;
return src;
}
function dsrc(){
var src = "";
var flss1 = "../v/A/?url="+flss;
var flss0 = "../ck.htm?f= "+flss;
if( flss.indexOf('.rm'||'.flv'||'.f4v'||'.wmv'||'.mpv'||'.mp4'||'.3gb'||'.3gb2'||'.avi'||'.mkv'||'.mov'||'.mp3'||'.mpeg'||'.webm'||'.rmvb'||'.m3u') >0 ) src = flss0;else if(flss.indexOf('rtmp:') >0 || flss.indexOf('rtsp:') >0  ) src=flss0;
else src = flss1;
return src;
}
var flss = flss();
var tsrc = tsrc();
var dsrc = dsrc();
var h=th();
var alss = alss();
var ifrm = ifrm();
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









