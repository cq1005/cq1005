<?php
//set_time_limit(0);
//error_reporting(0);
error_reporting(E_ALL ^ (E_WARNING|E_NOTICE));
//header('Content-Type: application/json;charset=utf-8');//json
//Header('Content-type: application/x-javascript text/xml;charset=utf-8');//xml
//header('content-type: application/x-www-form-urlencoded;charset=utf-8');//post
//header('string:"content-type:text/html;charset=utf-8"');
header('Content-Type:text/html;charset=utf-8');
header('Access-Control-Allow-Origin:*');//允许任意域名
header('Access-Control-Allow-Methods:*');//响应类型
header('Access-Control-Allow-Headers:*');//请求头
header('Access-Control-Allow-Credentials:true');//响应头设置false
header('Access-Control-Request-Method: *');
header('Access-Control-Max-Age: *');
header('P3P: CP="CAO CURa ADMa DEVa PSA PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
function m_s($url,$data=null,$postdata=null,$cookie=''){
set_time_limit(0);
      $header=array('Expect:'); //避免data数据过长问题
      //$headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
      //$post = $_SERVER['QUERY_STRING']; 
      $postdata = array ( );
      $post_data = http_build_query($postdata);
      //$cacert = getcwd() . '/cacert.pem'; //CA根证书   
      //$SSL = substr($url, 0, 8) == "https";
      $time=6000;
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_URL, $url);
      //curl_setopt($ch, CURLOPT_HTTPGET, true);
      curl_setopt($ch, CURLOPT_ENCODING, "");  
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
      curl_setopt($ch, CURLOPT_SSLVERSION, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
      curl_setopt($ch, CURLOPT_MUTE,1);
      curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
      curl_setopt($ch, CURLINFO_HEADER_OUT,1);//启用时追踪句柄的请求字符串
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time); 
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); //模拟用户使用的浏览器
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
  if($postdata!='') { 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode(json_encode($postdata)));
      } 
  if ( $cookie ) {
        curl_setopt ( $curl , CURLOPT_COOKIE ,  $cookie ) ;
       //curl_setopt($ch, CURLOPT_COOKIESESSION,true);
       //curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);//存放Cookie
       //curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);//读取Cookie
       //curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');//存放Cookie
       //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');//读取Cookie
        }
      curl_setopt($ch, CURLOPT_HEADER,0);//输出头部
      curl_setopt($ch, CURLOPT_TIMEOUT,$time);//设置超时限制
      curl_setopt($ch, CURLOPT_AUTOREFERER,1);//自动设置Referer  
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//显示输出结果
     $file=curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Errno'.curl_error($ch);//捕抓异常
    }
     //$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch); // 关闭CURL会话
       //$return = json_decode($file,true);
    return $file; // 返回数据
}
function m_v($url,$data=null,$postdata=null,$cookie='') {
      //$headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
      $header=array('Expect:');//避免data数据过长问题 
      $https= $_SERVER["HTTPS"];
      $host = str_replace('&','&',$url);
      $postdata = array ( );
      $post_data = http_build_query($postdata);
      //$SSL = substr($url, 0, 7) == "https" ? true : false;
      //$cacert = getcwd() . '/cacert.pem'; //CA根证书 
      $time = '6000';
      $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_URL, $url);//要访问地
      //curl_setopt($ch, CURLOPT_HTTPGET, true);
       curl_setopt($ch, CURLOPT_ENCODING, "");  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
       curl_setopt($ch, CURLOPT_SSLVERSION, 0);
       curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
       curl_setopt($ch, CURLOPT_MUTE,1);
       curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
       curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
       curl_setopt($ch, CURLINFO_HEADER_OUT,1);//启用时追踪句柄的请求字符串
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$time);
       curl_setopt($ch, CURLOPT_TIMEOUT,$time);//设置超时限制
       curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);//模拟用户使用的浏览器
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
       curl_setopt($ch, CURLOPT_NOBODY,false);//输出中不包含body
       curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
 /*if($postdata!='') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode(json_encode($postdata)));
        }*/
  if ( $cookie ) {
        curl_setopt ($ch, CURLOPT_COOKIE ,  $cookie ) ;
       //curl_setopt($ch, CURLOPT_COOKIESESSION,true);
       //curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);//存放Cookie
       //curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);//读取Cookie
       //curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');//存放Cookie
       //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');//读取Cookie
        }
       curl_setopt($ch, CURLOPT_HEADER, 0);//输出头部  
       curl_setopt($ch, CURLOPT_AUTOREFERER,1);//自动设置Referer   
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//显示输出结果
       @ $file = curl_exec($ch); 
     //$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
     if ($file === false) { 
    header('HTTP/1.1 400 Bad Request'); 
    exit; 
  } else { 
       //$return = json_decode($file,true);
       return $file; 
}}
function m_t($url){//跳转后地址
    $realurl = $url;
    try {
        $headers = get_headers($realurl, true);
        if(isset($headers['Location'])){
            if(is_array($headers['Location'])){
                $location = '';
                for($i=count($headers['Location']); $i>0; $i--){
                    $location = $headers['Location'][$i-1] . $location;
                    if (preg_match("/^(http|https)\:\/\//i", $location)) {
                        break;
                    }
                }
                $realurl = $location;
            }else{
                if (!preg_match("/^(http|https)\:\/\//i", $headers['Location'])) {
                    $realurl .= $headers['Location'];
                }else{
                    $realurl = $headers['Location'];
                }
            }
        }
    } catch (Exception $e) {
    }
    return $realurl;
}
function m_d($url,$params){
    $url = "{$url}?" . http_build_query ( $params );
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_TIMEOUT, 60 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $params );
    $result = curl_exec ( $ch );
    curl_close ( $ch );
    return $result;
}
function isPost() {
return $_SERVER['REQUEST_METHOD'] == 'POST'?1:0;
} 
function sss($url) {
       $t = $_GET['t']?$_GET['t']:dtime();
       $u = $_GET['u']?$_GET['u']:0;
       $wk= array('https://www.fx678.cn/kx/column?column=important','https://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$t,'https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid=2856&pnum=1&psize=100&callback=GetHistory','https://www.woxiu.com/92663595');
       $w = $_GET['w']?$_GET['w']:0;
       $wnk = $wk[$w];
    if( $w<=5 ) $wnkk=$wnk;else $wnkk=$w;
 if($u==1) {
       $ut =  m_s( $wnkk );
}else {
       $ut =  m_v( $wnkk );
}
    echo $ut;
}
function is_mobile() {
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
            $is_mobile = false;
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false 
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
        $is_mobile = true;
    }else{
        $is_mobile = false;
    }
    return $is_mobile;
}
function stime($url){
        $t = $_GET['t']?$_GET['t']:date("d");
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $tday= date("Y").'-'.date("m").'-'.date("d");
        $week = date("w", strtotime(''.$tday.''));
   if($week=="6" and date("d")<2 and $t!=date("d")) $nmon=$mon-1;else if($week=="0" and date("d")<3 and $t!=date("d")) $nmon=$mon-1;else $nmon=$mon;
   if($week=="6" and $t==date("d")) $tt=date("d",strtotime("-1 day"));else if($week=="0" and $t==date("d")) $tt=date("d",strtotime("-2 day"));
else $tt=$t;
     if(strlen($tt)<3 and strlen($tt)>1) $nt=$nmon.'-'.$tt;else if(strlen($tt)==1) $nt=$nmon.'-0'.$tt;
        $nday = $year.'-'.$nt;
if(stripos($t,'-') !== false) $nday=$year.'-'.$tt;else $nday = $year.'-'.$nt;
   if($week=="6" and $t=="") $nday=date("Y-m-d",strtotime("-1 day"));else if($week=="0" and $t=="") $nday=date("Y-m-d",strtotime("-2 day"));else $nday=$nday;
return $nday;
}
function dtime($url){
       $year = date("Y");
       $mouth = date("m")+1-1;
       $nmouth = "";
    if($mouth<10) $nmouth='0'.$mouth;else $nmouth=$mouth;
       $day = date("d")+1-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $t = $_GET['t']?$_GET['t']:$day;
       $stn = $year.'-'.$nmouth.'-'.$nday;
if($t<"32" and $t>"9" ) $tt=$year.'-'.$nmouth.'-'.$t;else if($t<"10") $tt=$year.'-'.$nmouth.'-'.'0'.$t;else if($t<"1232" and $t>"32") $tt=$year.'-'.$t;
else $tt=$stn;
return $tt;
}
function rtime($url){
       $year = date("Y");
       $mouth = date("m")+1-1;
       $nmouth = "";
    if($mouth<10) $nmouth='0'.$mouth;else $nmouth=$mouth;
       $day = date("d")-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $t = $_GET['t']?$_GET['t']:$day;
       $stn = $year.'-'.$nmouth.'-'.$nday;
if($t<"32" and $t>"9" ) $tt=$year.'-'.$nmouth.'-'.$t;else if($t<"10") $tt=$year.'-'.$nmouth.'-'.'0'.$t;else if($t<"1232" and $t>"32") $tt=$year.'-'.$t;
else $tt=$stn;
return $tt;
}
function mtime($url){
       $year = date("Y");
       $mouth = date("m")+1-1;
       $nmouth = "";
    if($mouth<10) $nmouth='0'.$mouth;else $nmouth=$mouth;
       $day = date("d")+1-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $t = $_GET['t']?$_GET['t']:$day;
       $stn = $year.$nmouth.$nday;
if($t<"32" and $t>"9" ) $tt=$year.$nmouth.$t;else if($t<"10") $tt=$year.$nmouth.'0'.$t;else if($t<"1232" and $t>"32") $tt=$year.$t;else $tt=$stn;
return $tt;
}
function t_d($times){
        $result = '00:00:00';
        if ($times>0) {
                $hour = floor($times/3600);
                $minute = floor(($times-3600 * $hour)/60);
                $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
                $result = $hour.':'.$minute.':'.$second;
        }
        return $result;
}
function replace_unicode_escape_sequence($match) { return mb_convert_encoding(pack('H*', $match[1]), 'utf-8', 'UCS-2BE'); } 
function r_u($url) {  return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence',$url); }
function r_g($url) {  return rawurlencode(mb_convert_encoding($url, 'utf-8', 'gbk')); }
function r_b($url) {  return rawurlencode(mb_convert_encoding($url, 'utf-8', 'gb2312')); }
function m_g($url) {  $encode = mb_detect_encoding($url,array('ASCII','UTF-8','GBk','GB2312','BIG5')); return iconv($encode,"gbk//IGNORE",$url); }
function m_u($url) {  $encode = mb_detect_encoding($url,array('ASCII','UTF-8','GBk','GB2312','BIG5')); return iconv($encode,"UTF-8//IGNORE" ,$url); } 
function i_g($url) {  return iconv("gbk","UTF-8//IGNORE",$url); }
function i_u($url) {  return iconv('UTF-8', 'gbk', $url); }
function J_e($url) {  return json_encode($url,true); }
function J_d($url) {  return json_decode($url,true); }
function jp_d($jsonp, $assoc = false) { if($jsonp[0] !== '[' && $jsonp[0] !== '{') {
                    $jsonp = substr($jsonp, strpos($jsonp, '(')); }   return json_decode(trim($jsonp,'();'), $assoc);}
function h_x($url) {  return hash_file('md5', $url); }
function h_sh($url) {  return hash('ripemd160', $url); }
function h_hm($url) {  return hash_hmac('ripemd160',$url, 'secret'); }
function h_ps($url) {  return password_hash($url,PASSWORD_DEFAULT); }
function h_ud($url) { $ctx=hash_init('md5');hash_update($ctx,$url);return hash_final($ctx); }
function h_sd($url) { $ctx=hash_init('md5');hash_update_stream($ctx,$url);return hash_final($ctx); }
function u_e($url) {  return urlencode($url); }
function u_d($url) {  return urldecode($url); }
function u_c($url) {  return unescape($url); }
function b_d6($url) {  return base64_decode($url); }
function e_b($url) {  return eval(gzinflate(base64_decode($url))); } 
function m_b($url) {  return mb_convert_encoding(base64_decode($url,"gb2312","UTF-8"));}
function k_w($url) {  return rawurlencode(mb_convert_encoding(m_g($url), 'utf-8', 'gb2312'));}
function b_60($url) {  return urlencode(base64_encode($url)); }
function b_61($url) {  return base64_encode(urlencode($url)); }
function b_62($url) {  return base64_encode(urlencode(iconv('gb2312','UTF-8',$url))); }
function b_63($url) {  return strtr(base64_encode(preg_replace('/^(http?:)\/\//','$1##',$url)),'+/','-_');  }
function b_64($url) {  return mb_convert_encoding(base64_encode($url),"gb2312","UTF-8");   }
function b_65($url) {  return encodeURIComponent($url);  }
function b_d($url) {  return base64_decode($url); }
function b_d1($url) {  return urldecode(base64_decode($url)); }
function b_d2($url) {  return base64_decode(urldecode(iconv('gb2312','UTF-8',$url))); }
function b_d3($url) {  return urldecode(iconv('gb2312','UTF-8',$url)); }
function x_g($url) {  return stripslashes($url); }
function f_g($url) {  return file_get_contents($url); }
function f_u($url) {  return g_url_contents($url); }
function c_c($url) {  return curl_get_contents($url); }
function f_c($url) {  return file_put_contents('txt.txt',$url); }
function c_g($url) {  return curl_multi_getcontent($url);}
function g_t($url) {  return get_meta_tags($url); }
function t_m($url) {  return date('Y-m-d H:i:s',$url +8*60*60); }
function t_n($url) {  return date('Y-m-d H:i:s',$url); }
function t_hm() {  $arr = explode(' ',microtime());   $hm = 0;   foreach($arr as $v){  $hm += floor($v * 1000);    }    return $hm;} //毫秒时间戳
function t_t($url) { if($_SERVER['HTTP_HOST']=='localhost'||$_SERVER['HTTP_HOST']=='127.0.0.1') $tm=date('Y-m-d H:i:s',$url);else $tm=date('Y-m-d H:i:s',$url +8*60*60); return $tm; }
function t_y($url) {  return date("Y")-date("m")-date("d"); }
function q_k($url) {  return str_replace(" ","",$url); }
function q_m($url) {  return str_replace(":","",$url); }
function q_g($url) {  return str_replace("-","",$url); }
function q_w($url) {  return substr($url, 0, -2); }
function q_kk($url){  return preg_replace("@\s@is",'',$url);}   //去空
function q_s($url){  return preg_replace("@\s@is",'0111',$url);}   //去特定字
function trimall($url){  $qian=array(" ","　","\t","\n","\r");  return str_replace($qian, '', $url);    }  //去空
function d_x($url) {  return strtoupper($url); }
function x_x($url) {  return strtolower($url); }
function x_s($url) {  return round($url,2); }//小数点2位
function x_s2($url) {  return number_format($url,2); }//小数点2位
function h_u($url) {  return header("Location:$url"); }
function p_u($url) {  return print_r(array_unique($url)); }
function c_s($url) {  return strtr($url, array('<'=>'《','>'=>'》','"'=>'“'));  }
function h_v($url) {  $header = get_headers($url,1);if (isset($headers['Location'])){ return $headers['Location'];} }
function g_h($url) {  $header = get_headers($url,1);
if (strpos($header[0],'301') || strpos($header[0],'302')) { if(is_array($header['Location'])) { return $header['Location'][count($header['Location'])-1]; }
else{ return $header['Location']; } }else{ return $url;}
}
function unescape($str) {  
         $str = rawurldecode($str);  
         preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/u",$str,$r);  
         $ar = $r[0];  
         foreach($ar as $k=>$v) {  
                  if(substr($v,0,2) == "%u")  
                           $ar[$k] = iconv("ucs-2","gbk",pack("h4",substr($v,-4)));  
                  elseif(substr($v,0,3) == "&#x")  
                           $ar[$k] = iconv("ucs-2","gbk",pack("h4",substr($v,3,-1)));  
                  elseif(substr($v,0,2) == "&#") {  
                           $ar[$k] = iconv("ucs-2","gbk",pack("n",substr($v,2,-1)));  
                  }  
         }  
         return join("",$ar);  
}
function getNeedBetween($kw1,$mark1,$mark2){ //截取字符串之间
$kw=$kw1; $kw='123'.$kw.'123'; $st =stripos($kw,$mark1); $ed =stripos($kw,$mark2);
 if(($st==false||$ed==false)||$st>=$ed) return 0;
 $kw=substr($kw,($st+1),($ed-$st-1));
 return $kw;
 }
function g_l(){  
     if(empty($_SESSION['user_info'])){   
     if(empty($_COOKIE['username']) || empty($_COOKIE['password'])){ 
     header("location:login.php?req_url=".$_SERVER['REQUEST_URI']);  }
else{ $user = getUserInfo($_COOKIE['username'],$_COOKIE['password']);   //去取用户的个人资料  
     if(empty($user)){ header("location:login.php?req_url=".$_SERVER['REQUEST_URI']);  }
else{ $_SESSION['user_info'] = $user; } } } }
function get_bet($s) {
preg_match_all('/[A-Za-z_].+/', $s, $x);
   return var_dump($x);
}
function get_be($str) {
  $str=mb_substr($str, 0, 5, 'utf8');
  return $str;
}
function object_array($array){
   if(is_object($array)){ $array = (array)$array;}
   if(is_array($array)){
    foreach($array as $key=>$value){ $array[$key] = object_array($value);
    } }
   return $array;
}
function q_c($url) {  $arr =$url; $arr = array();for($i=0; $i<100; $i++){ $arr[] = mt_rand(1,99);}
$arr = array_flip($arr);$arr = array_flip($arr);$arr = array_values($arr);return $arr; }
function a_a($ua) {
       $a = $_GET['a']?$_GET['a']:"";
       $vk= array( "v0"=>"v0","v1"=>"v1","v2"=>"v2","v3"=>"v3","v4"=>"v4","v5"=>"v5","v6"=>"v6","v7"=>"v7","v8"=>"v8","v9"=>"v9","v10"=>"v10","m3u8"=>"m3u8","tv"=>"tv");
       $ak= array( "v0","v1","v2","v3","v4","v5","v6","v7","v8","v9","v10","m3u8","tv");
       $ank=$ak[$a];
       $vnk=$vk[$ank];
       $vnk2=$vk[$a];
   if( $_GET['a'] <='20') $aa=$vnk;else $aa=$a;
   if(stripos($ua,'m3u8') === false){$aa=$aa;}else{$aa='m3u8';};
      return $aa;
}
function f_ua($ua){
   if(stripos($ua,'m3u8') === false){$a=$a;}else{$a='m3u8';}; 
      return $a;
}
function f_ht($ua){
   $zf = substr($ua, 0, 8); 
   if( stripos($zf,'rtmp:') !== false || stripos($zf,'http:') !== false || stripos($zf,'https:') !== false || stripos($zf,'rtsp:') !== false  || stripos($zf,'p2p:') !== false) $ht=$ua;
 else if(stripos($zf,'//') === false) $ht=$ua;else if(stripos($zf,'://') === false) $ht='http:'.$ua;
      return $ht;
}
function f_kd($ua){
        $u = $_GET['u']?$_GET['u']:"0";
        $ud="";
        $ud0= f_t($ua);
        $ud1= f_k($ua);
        $ud2= f_ck($ua);
        $ud3= f_ckk($ua);
        $ud4= f_kt($ua);
        $ud5= f_kk($ua);
        $ud6= f_v($ua);
        $ud7= f_cd($ua);
        $ud8= f_dd($ua);
        $ud9= f_wt($ua);
        $ud10= f_uu($ua);
        $ud11= f_ku($ua);
        //$ud12= f_ul($ua);
        $ud13= f_kl($ua);
        //$ud14= f_b($ua);
   if($u == "ck"||$u == "2") {$ud=$ud2;} else if($u == "k"||$u == "1"){$ud=$ud1;} else if($u == "uu"){$ud=$ud10;} else if($u == "cd"){$ud=$ud7;}else if($u == "dd"){$ud=$ud8;}
else if($u == "ku"){$ud=$ud11;} else if($u == "b"){$ud=$ud12;} else if($u == "v"){$ud=$ud6;} else if($u == "kt"){$ud=$ud4;} else if($u == "ul"){$ud=$ud12;} 
else if($u == "t"||$u == "0"||$u == ""){$ud=$ud0;}else if($u == "ckk"){$ud=$ud3;} else if($u == "wt"){$ud=$ud9;}else if($u == "kl"){$ud=$ud13;} 
else {$ud=$ud0;};
   $zf = substr($ua, 0, 40); 
if(stripos($zf,'cntv.cn') !== false || stripos($zf,'youku.com') !== false || stripos($zf,'iqiyi.com') !== false || stripos($zf,'qq.com') !== false ||
 stripos($zf,'fun.tv') !== false || stripos($zf,'wasu.cn') !== false|| stripos($zf,'tudou.com') !== false|| stripos($zf,'pptv.com') !== false||
 stripos($zf,'le.com') !== false|| stripos($zf,'cctv.com') !== false|| stripos($zf,'kankan.com') !== false|| stripos($zf,'163.com') !== false||
 stripos($zf,'sohu.com') !== false||stripos($zf,'sina.com') !== false||stripos($zf,'cctv.com') !== false||stripos($zf,'douyu.com') !== false||
 stripos($zf,'kugou.com') !== false|| stripos($zf,'yinyuetai.com') !== false|| stripos($zf,'mgtv.com/b') !== false) $ud=$ud6;
else $ud=$ud;
      return $ud; 
}
function f_td($ua){
        $ud = f_kd(f_ht($ua));
      return $ud;
}
function f_d($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../d.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_k($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../k.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_kk($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ck/k.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_ck($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../ck.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_ckk($ua){
       $url= '../ck/ck.htm?&f='.$ua;
      return $url;
}
function f_uu($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../u.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_ku($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ck/u.htm?&f='.$ua;
      return $url;
}
function f_v($ua){
       $url= '../v.htm?&f='.$ua;
      return $url;
}
function f_vv($ua){
       $url= '../v.php?&f='.$ua;
      return $url;
}
function f_t($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../t.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_kt($ua){
       $url= '../ck/t.htm?&f='.$ua;
      return $url;
}
function f_uk($ua){
        $u = $_GET['u']?$_GET['u']:"0";
       $url= '../ck.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_kh($ua){
       $url= '../ck/h.php?f='.$ua;
      return $url;
}
function f_cd($ua){
       $url = '../ck/d.htm?&f='.$ua;
      return $url;
}
function f_dd($ua){
       $url = '../ck/d2.htm?&f='.$ua;
      return $url;
}
function f_w($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../w.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_kl($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ck/ul.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_uf($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ul.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_wd($ua){
       $url = '../?&f='.$ua;
      return $url;
}
function f_wt($ua){
       $url = '../?&f='.$ua;
      return $url;
}
function f_ud($ua){
        $a = f_ua($_GET['a'])?f_ua($_GET['a']):"tv";
        $ak= array( 
          "tv" =>$ud= '../ck.php?&f='.$ua,
          "v0" =>$ud= '../v.htm?&f='.$ua,
         "m3u8" =>$ud= '../ck.php?&f='.$ua,
          $_GET['a']  =>$ud=  f_kd($ua)  );
          $ank=$ak[$a];
   if( $ank=='') $ank=$udv;else $ank=$ank;
           $a2nk=$ak[$a];
   if( $a<='50') $ank=$a2nk;else $ank=$ank;
        $ud=$ank;
      return $ud;
}
$fname = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["SCRIPT_NAME"];define("URL","$fname"); global $fname;
$a=isset($_GET['a'])?$_GET['a']:0;
$s=isset($_GET['s'])?$_GET['s']:0;
$m=isset($_GET['m'])?$_GET['m']:0;
$u=isset($_GET['u'])?$_GET['u']:0;
$t=isset($_GET['t'])?$_GET['t']:0;
$p=isset($_GET['p'])?$_GET['p']:1;
$w=isset($_GET['w'])?$_GET['w']:0;
$v=isset($_GET['v'])?$_GET['v']:'';
$f=isset($_GET['f'])?$_GET['f']:'';
function get_u($url){
//$url = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  //返回重定向url
$return_url = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL); //获取重定向url
$response = curl_exec($ch);
$error = curl_error($ch);
return $return_url;
    }
function leso($url) {
       $tk= array("0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $u = $_GET['u']?$_GET['u']:0;
       $tnk=$tk[$t];
    for($i=1;$i<=$p;$i++){
       $url1 = 'http://le.so.letv.com/interface?&ph=420001,420002&mix=1&jf=1&hl=1&dt='.$t.'&from=pcjs&show=4&ps=14&pn=1&wd='.$kw.'&e='.$i.'';
       $url2 = 'http://le.so.letv.com/interface?&ph=420001,420002&dt=2&dur='.$t.'&jf=1&hl=1&from=pcjs&show=4&wd='.$kw.'&e='.$i.'';
       $url = 'http://le.so.letv.com/interface?&ph=420001,420002&dt=2&or=1&dur='.$t.'&wd='.$kw.'&e='.$i.'';
       $url3 = 'http://search.lekan.letv.com/lekan/apisearch_json.so?from=pc&jf=1&hl=1&dt=1,2&ph=420001,420002&show=4&callback=jQuery17102821987269974946_1556798454074&cg=1&or=1&dur='.$tnk.'&pn='.$i.'&ps=30&wd='.$kw.'&lc=CD59FBBFF8391021BA2D8ED48C5C330FF801AAC8&uid=&session=';
        $ul = f_g($url3);
preg_match_all('|"subSrc":"([^<]+)"(.*)"vid":"([^<]+)"|imsU',$ul,$b);
preg_match_all('|"url":"([^<]+)"|imsU',$ul,$b1);
preg_match_all('|"name":"([^<]+)"|imsU',$ul,$b2);
preg_match_all('|:"video_([^<]+)"|imsU',$ul,$b0);
preg_match_all('|"mid":"([^<]+)",|imsU',$ul,$b3);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[3][$k];
        $a3 = $b1[1][$k];
        $a4 = m_u(r_u($b2[1][$k]));
        $a0 = $b0[1][$k];
        $a5 = $b3[1][$k];
        $a6 = 'http://www.le.com/ptv/vplay/'.$a2.'.html';
        $b6 = 'http://img1.c0.le.com/ptv/player/swfPlayer.swf?autoPlay=1&id='.$a1;
        $ua ='';
if($a1=='letv') $ua=$a6;else $ua=$a3;
        $ud =f_kd($ua);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.'</a>';
echo $xml;
}}}

function fhso($url) {
       $w = $_GET["w"] ? $_GET["w"]:date("m").date("d");
       $kw=k_w($w);
       $tk = array( "&dualt=0&dualf=0","&dualt=10&dualf=0","&dualt=30&dualf=10","&dualt=60&dualf=30","&dualt=0&dualf=60" );
       $t = $_GET['t']?$_GET['t']:0;
       $tnk = $tk[$t];
       $p = $_GET['p']?$_GET['p']:2;
    for ($i = 1; $i <=$p; $i++) {
	$ul2 = 'http://so.v.ifeng.com/video?q='.$kw.'&c=5&s=1&category='.$tnk.'&pubtime=&categoryroot=&p='.$i.''; 
	$ul = 'http://so.v.ifeng.com/video?q='.$kw.'&c=5&s=1&category='.$tnk.'&pubtime=&p='.$i.'&categoryroot='; 
        $ut = m_v($ul);
preg_match_all('|<h3><a href="([^>]+)"(.*)>(.*)</a>(.*)</h3>(.*)<p>([^>]+)</p>|ismU',$ut,$d);
//preg_match_all('|<span class="s_r_time">([^>]+)</span>|ismU',$ut,$d2);
preg_match_all('|<p>([^>]+)</p>(.*)<p>([^>]+)</p>(.*)</div>(.*)</li>|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
        $a2=$d[1][$k];
        $a3=$d[3][$k];
        //$a4=$d2[1][$k];
        //$a5=$d[5][$k];
        $a6=$d3[3][$k];
        $ua =  fhf(f_ht($a2));
        $ud = f_ul($ua);
        $vd=Current(explode('?',$v));
	$xml='<a href="'.$ud.'" target="b" >'.$a3.'('.$a6.')</a>';
echo $xml;
}}}
function fhf($url) {
       //$ul = $_GET['w']?$_GET['w']:$url;
  preg_match('|"url":"(.*)","videoPlayUrl":"([^>]+)","m3u8Url"|ism',m_v($url),$d);
       $a3 = $d[2];
       $ud =$a3;
return $ud;
//echo $ud;
}
function funso($url){
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       $ur = 'http://www.fun.tv/search/pg-'.$p.'.word-'.$kw.'';
       $ut = t_v($ur);
 preg_match_all('|<h3 class="tit">(.*)<a title="(.*)" href="/vplay/(.*)/"|ismU',$ut,$d);
    foreach($d[1] as $k=>$v){
       $a4 = $d[2][$k];
       $a5 = $d[3][$k];
       //$a6 = $d[3][$k];//100;
       $a7='http://www.fun.tv/vplay/'.$a5.'/';
        $bu = str_ireplace('http://','',$a7);
   if(stripos($a7,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a7;
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml='<a href="'.$ud.'" target="b" >'.$a4.'</a></br>';
echo $xml;
 }}
function qqmso($url) {
       $w = $_GET['w']?$_GET['w']:"电影"; 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
for($i=0;$i<=$p;$i++){
 $url ='https://pbaccess.video.qq.com/trpc.videosearch.search_cgi.http/load_intent_list_info?&pageContext=%3D%26%3D%26%3D%26%3D&queryFrom=4&platform=2&pageNum='.$i.'&query='.$kw.'&pageSize=10&';
 $url2 ='https://pbaccess.video.qq.com/trpc.videosearch.search_cgi.http/load_intent_list_info?&pageContext=query%3D%26boxType%3Dintent%26intentId%3D132%26pageSize%3D10&queryFrom=4&platform=2&pageNum='.$i.'&query='.$kw.'&pageSize=10&';
       $ut = m_v($url2);
  if($t==1){
preg_match_all('|"id":"([^>]+)","dataType":([^>]+),"url":"([^>]+)","title":"([^>]+)","markLabel":"([^>]+)","asnycParams"|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d[2][$k];
        $a4 = $d[3][$k];
        $a5 = $d[4][$k];
        $ud = '../v.htm?f='.$a4;
     $xml ='<a href="'.$ud.'" target="b" >'.$w.'('.$a5.')</a>';
echo $xml;
}}else {
preg_match_all('|"videoType":([^>]+),"title":"([^>]+)","typeName":"([^>]+)","year":"([^>]+)","checkupTime"(.*)"descrip":"([^>]+)","url":"([^>]+)"|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = m_u($d[2][$k]);
        $a3 = m_u($d[3][$k]);
        $a4 = $d[4][$k];
        $a5 = m_u($d[6][$k]);
        $a6 = $d[7][$k];
        $ud = '../v.htm?f='.$a6;
     $xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a4.')</a>';
echo $xml;
}}
}}
function qqso($url) {
       $w = $_GET['w']?$_GET['w']:'科幻'; 
       $t = $_GET['t']?$_GET['t']:'0'; 
       $u = $_GET['u']?$_GET['u']:'0'; 
       $p = $_GET['p']?$_GET['p']:'2'; 
       $kw=k_w($w);
       for ($i = 0; $i <=$p; $i++) {
 $url ='https://pbaccess.video.qq.com/trpc.videosearch.search_cgi.http/load_intent_list_info?&pageContext=%3D%26%3D%26%3D%26%3D&queryFrom=4&platform=2&pageNum='.$i.'&query='.$kw.'&pageSize=10&';
       $ut = m_v($url);
  if($t==1){
preg_match_all('|"id":"([^>]+)","dataType":([^>]+),"url":"([^>]+)","title":"([^>]+)","markLabel":"([^>]+)","asnycParams"|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d[2][$k];
        $a4 = $d[3][$k];
        $a5 = $d[4][$k];
        $ud = '../v.htm?f='.$a4;
     $xml ='<a href="'.$ud.'" target="b" >'.$w.'('.$a5.')</a>';
echo $xml;
}}else {
       $nt = J_d($ut,ture);
       $aaa = $nt["data"]["areaBoxList"][1];
       $aa = $aaa["itemList"];
       $count_j = count($aaa);
 for ($i2 = 0; $i2 < $count_j; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["videoInfo"]["title"];
       $a2 = $a0["videoInfo"]["year"];
       $a3 = $a0["videoInfo"]["descrip"];
       $a4 = $a0["videoInfo"]["url"];
       $ud = '../v.htm?f='.$a4;
       $xml ='<a href="'.$ud.'" target="b" >'.$a1.'('.$a2.')</a>';
echo $xml;
}}}}
function ykso($url) {
       $w = $_GET['w']?$_GET['w']:'科幻'; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='http://so.youku.com/search_video/'.$kw.'?searchfrom=3';
        $ut = m_v($url);
//preg_match_all('#"object_title":"([^>]+)","group_type":([^>]+),"item_log":"([^>]+)","object_url":"([^>]+)","group_id":"([^>]+)"#ismU',$ut,$d);
preg_match_all('#"object_title":"([^>]+)"(.*)"object_url":"([^>]+)","group_id":"([^>]+)"#ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = m_u($d[1][$k]);
        $a2 = $d[4][$k];
        $ua =  'https://v.youku.com/v_show/id_'.$a2.'.html';
        $ud = '../v.htm?f='.$ua;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a1.'</a>';
echo $xml;
}}}
function haoso($url) {
       $w = $_GET['w']?$_GET['w']:"科幻"; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
        $ul ='https://api.so.360kan.com/index?force_v=1&kw='.$kw.'&from=&pageno='.$i.'&v_ap=1&tab=all&cb=';
        $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["video"]["dy"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = $a0["url"];
       $a3 = m_u($a0["title"]);
       $a4 = $a0["coverInfo"]["duration"];
       //$a5 = $a0["playlinks"];
preg_match('#(.*)/([^>]+).html#ism',$a2,$d);
        $ua =  $d[2];
        //$ud = f_t($ua);
     //$xml ='<a href="'.$ud.'" target="b" >'.$a3.'   (  '.$a4.'  )</a>';
     $xml ='<a href="'.$fname.'?&hsovid='.$ua.'" target="b">'.$a3.'&nbsp;(&nbsp;'.$a4.'&nbsp;)</a>';
echo $xml;
}}}
function kugso($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
$ul = 'https://mvsearch.kugou.com/mv_search?&keyword='.$kw.'&page='.$i.'&pagesize=30&clientver=&userid=&platform=WebFilter&tag=em&filter=2&iscorrection=1&privilege_filter=0'; 
    $ul4 = 'http://mobilecdn.kugou.com/api/v3/rank/song?pagesize=100&rankid=23784&page=1'; 
	$ut = J_d(m_v($ul));
        $aa= $ut["data"]["lists"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["MvID"];
       $a3 = $a0["FileName"];
       $a1 = $a0["Duration"];
       $a4 = $a0["PublishDate"];
        $ua =  'https://www.kugou.com/mvweb/html/mv_'.$a2.'.html';
        $ud = f_kd(f_ht($ua));
	$xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$a1.')('.$a4.')</a>';
echo $xml;
	}}}
function kugsso($url) {
       //$wk= array( "-1","1","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:2; 
       for ($ii = 1; $ii <=$p; $ii++) {
    $ul = 'http://www.kuwo.cn/api/www/search/searchMvBykeyWord?key='.$kw.'&pn='.$ii.'&rn=30&reqId=0d379880-70aa-11ea-8388-97bd203dcc2d'; 
    $ul1 = 'http://www.kuwo.cn/api/www/music/mvList?pid=236682871&pn='.$ii.'&rn=30&reqId=0894cbc0-70a7-11ea-8388-97bd203dcc2d';
    $ul2 = 'http://www.kuwo.cn/api/www/music/mvList?pid=236682731&pn='.$ii.'&rn=30&reqId=6cdd71d0-70a8-11ea-8388-97bd203dcc2d ';
    $ul3 = 'http://www.kuwo.cn/comment?type=get_comment&f=web&page='.$ii.'&rows=20&digest=7&sid=85453264&uid=0&prod=newWeb&reqId=cd244610-70a6-11ea-8388-97bd203dcc2d'; 
    $ul5 = 'http://songsearch.kugou.com/song_search_v2?keyword='.$kw.'&page='.$ii.'&pagesize=30&platform=WebFilter'; 
    $ul4 = 'http://mvsearch.kugou.com/mv_search?keyword='.$kw.'&page='.$ii.'&pagesize=50&platform=WebFilter'; 
	$ut = J_d(m_v($ul4));
        $aa= $ut["data"]["lists"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["MvID"];
       $a3 = $a0["FileName"];
       $a1 = $a0["Duration"];
       $a4 = $a0["PublishDate"];
        $ua =  'https://www.kugou.com/mvweb/html/mv_'.$a2.'.html';
        $ud = f_kd(f_ht($ua));
	$xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$a1.')('.$a4.')</a>';
echo $xml;
	}}}
function kuwso($url) {
       $wk= array( "-1","236682871","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:"唱山歌"; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       for ($ii = 1; $ii <=$p; $ii++) {
    $ul = 'http://www.kuwo.cn/api/www/music/mvList?pid=236682871&pn='.$ii.'&rn=30&reqId=c3427a50-70a5-11ea-8388-97bd203dcc2d'; 
    $ul1 = 'http://www.kuwo.cn/api/www/search/searchMusicBykeyWord?key=%E5%B1%B1%E6%AD%8C%E5%A5%BD%E6%AF%94&pn=1&rn=30&httpsStatus=1&reqId=d1f639a0-5060-11ec-9203-8789a0d9ca4c';
    $ul2 = 'http://www.kuwo.cn/api/www/search/searchMusicBykeyWord?&prod=newWeb&key='.$kw.'&pn=1&rn=30&reqId=0a997420-7b15-11ea-86d2-5bb0a7d2be19';
    $ul3 = 'http://www.kuwo.cn/api/www/search/searchMusicBykeyWord?key='.$kw.'&pn=2&rn=30&httpsStatus=1&reqId=400575a0-4aad-11ec-80db-afed88454f87'; 
	$ut = m_d($ul1);
	//$ut = J_d(m_d($ul1));
        /*$aa= $ut["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {}
       $a0 = $aa[$i2];
       $a1 = $a0["artist"];
       $a2 = $a0["artistid"];
       $a3 = $a0["musicrid"];
       $a4 = $a0["name"];
       $a5 = $a0["rid"];
       $a6 = $a0["songTimeMinutes"];*/
/*preg_match_all('|"artist":"([^<]+)"(.*)"id":"([^<]+)"(.*)"name":"([^<]+)"(.*)"songTimeMinutes":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1 = $d[1][$k];
       $a2 = $d[3][$k];
       $a3 = m_u($d[5][$k]);
       $a4 = $d[7][$k];
       $a7= m_u('秒');
        $ua =  'http://www.kuwo.cn/mvplay/'.$a2;
        //$uu =  'http://www.kuwo.cn/url?format=mp4&rid=85422071&response=url&type=convert_url3&br=128kmp4&from=web&t=&reqId=88deb4f1-0692-11ea-94a9-91c1807c7d33';
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$a1.')('.$a4.')</a>';*/
echo $ut;
	}}
function ytso($url) {
       $w = $_GET['w']?$_GET['w']:date("d"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
    $ul = 'http://www.1ting.com/mv/search?q='.$kw.'&order=created&page='.$i.''; 
	$ut = m_v($ul);
preg_match_all('|<a href="([^<]+)" target="_video">(.*)<h5 class="f-cgreen">(.*)</h5>|ismU',$ut,$d);
preg_match_all('|<span class="time">(.*)</span>|imsU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = $d[3][$k];
       $a5 = $d2[1][$k];
        $a6='http://www.1ting.com'.$a3.'';
        $bu = str_ireplace('http://','',$a6);
   if(stripos($a6,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a6;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ua.'" target="b" >'.$a4.'('.$a5.')</a>';
echo $xml;
	}}}
function cnso($url) {
       $tk= array( "-1","0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:date("Y").date("m").date("d"); 
       $kw = k_w( $w );
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:2;
       $tnk=$tk[$t];
    for($ii=1;$ii<=$p;$ii++){
     $ul = 'http://search.cctv.com/search.php?qtext='.$kw.'&type=video&sid=0001&pid=0000&page='.$ii.'';
     $ul2 = 'https://search.cctv.com/ifsearch.php?qtext='.$kw.'&type=video&page='.$ii.'&datepid='.$tnk.'&vtime=-1';
     $ul3 = 'https://search.cctv.com/ifsearch.php?page='.$ii.'&qtext='.$kw.'&sort=date&pageSize=20&type=video&vtime='.$tnk.'&datepid=1&channel=%E4%B8%8D%E9%99%90&pageflag=0&qtext_str='.$kw.'';
       $ut = m_v($ul3);
       $nt = J_d($ut,ture);
       $aa = $nt["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a4 = $a0["id"];
       $a5 = r_u($a0["all_title"]);
       $a6 =  x_g($a0["urllink"]);
       $a8 = t_d($a0["durations"]);
       $a7 = $a0["uploadtime"];
       $ua =  $a6;
       //$ua2 =  cn_vd($a6);
       //$ud2 = '../tv/cctvh.php?vid='.$ua2;
       //$ud3 = '../ck/ck.php?f='.$ua2;
       //$ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$fname.'?&cn_vd='.$ua.'"  target="b">'.$a5.' ('.$a7.') ('.$a8.')</a>';
       //$xml ='<a href="'.$ud3.'" target="b" >'.$a5.' ('.$a7.') ('.$a8.')</a>';
       //$xml ='<a href="'.$ud2.'" target="b" >'.$a5.'('.$a7.')('.$a8.')</a>';
echo $xml;
}}}
function lmso($url) {
       $w = $_GET['w']?$_GET['w']:date("Y").date("m").date("d"); 
       $tk= array( "-1","0","1","2","3","4");
       $t = $_GET['t']?$_GET['t']:"0";
       $tnk=$tk[$t];
       $p = $_GET['p']?$_GET['p']:5;
    for($ii=1;$ii<=$p;$ii++){
       $ul = 'http://api.cntv.cn/lanmu/columnSearch?p='.$ii.'&n=100&serviceId=tvcctv&t=jsonp&cb=Callback';
       //$ut = m_v($ul);
 preg_match("#\"docs\":\[\{(.*)\}\}\],#U",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["column_id"];
       $a2 = $a0["column_name"];
       //$a3 = $a0["column_backvideoaddress"];
       $a4 = $a0["vms_video_album_id"];
       $xml ='<a href="'.$fname.'?&clmso='.$a2.'&vtime='.$tnk.'" >'.$a2.'</a>';
echo $xml;
}}}
function cnsso($url) {
       $w = $_GET['w']?$_GET['w']:'三国演义';
       $kw = k_w( $w );
       $a = $_GET['a']?$_GET['a']:"0";
       $ul2 = 'https://search.cctv.com/search.php?&type=video&qtext='.$kw.'&qtext_str='.$kw.'';
 preg_match('#var playlistid ="([^>]+)";#U',m_v($ul2),$d);
       $at = $d[1];
       $ul = 'https://r.img.cctvpic.com/so/cctv/list/7/'.$at.'.js?';
 preg_match("#\{\"video\":\[\{(.*)\}\],#U",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["detailsid"];
       $a2 = $a0["playtime"];
       $a3 = $a0["duration"];
       $a4 = $a0["title"];
       $a5 = $a0["album_order_id"];
       $a6 = $a0["targetpage"];
       $ua =  $a6;
       //$ua2 =  cn_vd($ua);
       //$ud3 = '../t.htm?f='.$ua2;
       //$ud = f_kd(f_ht($ua));
     $xml ='<a href="'.$fname.'?&cn_vd='.$ua.'"  target="b">'.r_u($w).'('.$a5.')('.$a2.')</a>';
       //$xml ='<a href="'.$ud3.'" target="b" >'.r_u($w).'('.$a5.')('.$a2.')</a>';
echo $xml;
}}
function cn_vd($url) {
       //$w = $_GET['w']?$_GET['w']:"http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid=acc4892b26974f05888054f85ceab5e5";
preg_match('|var guid = "([^<]+)"|ism',m_v($url),$d0);
        $a3='http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid='.$d0[1];
preg_match('|"hls_url":"([^<]+)"|ism',m_v($a3),$d2);
        $aa=$d2[1];
      return $aa;
}
function cn_vdd($url) {
       //$w = $_GET['w']?$_GET['w']:"http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid=acc4892b26974f05888054f85ceab5e5";
       $ut = m_v($url);
preg_match('|"hls_url":"([^<]+)"|ism',$ut,$d0);
        $a1=$d0[1];
      return $a1;
}
function so163($url) {
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
        $t = $_GET['t']?$_GET['t']:'00';
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;++$i){
	$ul = 'http://so.v.163.com/search/000-2-00'.$t.'-1-'.$i.'-0-'.$kw.'/';
        $ut = m_v($ul);
preg_match_all("|<h3><a target=\"_blank\"  href=\"([^>]+)\">(.*)<span id='video_hl'>(.*)</span>(.*)</a></h3>(.*)<p>(.*)</p>(.*)</li>|ismU",$ut,$d);
preg_match_all("|<span class=\"length\">(.*)</span>|ismU",$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d2[1][$k];
        $a2=$d[1][$k];
        $a3=m_u($d[2][$k]);
        $a4=m_u($d[3][$k]);
        $a5=m_u($d[4][$k]);
        $a6=$d[6][$k];
        $bu = str_ireplace('http://','',$a2);
   if(stripos($a2,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a2;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a3.''.$a4.''.$a5.'('.$a1.')('.$a6.')</a></br>';
echo $xml;
}}}
function skso($url) {
       $w = $_GET['w']?$_GET['w']:date("d"); 
       $kw=k_w($w);
       $tk= array("0","1","2","3","4");
       $ak= array("2","0","1","2","3");
       $uk= array("","96","97","95","85","94","100","84","92","87","89","91","171","172");
       $p = $_GET['p']?$_GET['p']:2;
       $a = $_GET['a']?$_GET['a']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $tnk= $tk[$t];
       $unk= $uk[$u];
       $ank= $ak[$a];
for ($i = 1; $i <=$p; $i++) {
$ul = 'http://www.soku.com/v/q_'.$kw.'_orderby_'.$ank.'_lengthtype_'.$tnk.'_limitdate_0?site=14&page='.$i.'&_lg=1&cateid='.$unk.'';
        $ut = m_v($ul);
preg_match_all('#<div class="s_link">(.*)<a href="([^>]+)"(.*)title="([^>]+)"#ismU',$ut,$d0);
preg_match_all('#<div class="v-link"(.*)>(.*)<a(.*)title="([^>]+)"(.*)href="([^>]+)"#ismU',$ut,$d);
preg_match_all('#<span class="v-time">(.*)</span>#U',$ut,$d2);
preg_match_all('#<span class="pub">(.*)</span></div>#U',$ut,$d3);
foreach ($d[1] as $k=>$v){
        $a0=$d0[2][$k];
        $a1=$d0[4][$k];
        $a2=$d[4][$k];
        $a3=$d[6][$k];
        $a4=$d2[1][$k];
        $a5=$d3[1][$k];
        $b2 = "http://www.soku.com/u?url=";
        $b3=str_replace($b2,"",$a3);
        $b4='';
   if ($uu == '0')  $b4=$a0;else  $b4=$b3;
        $bu = str_ireplace('http://','',$b4);
        $ua =  $b4;
   if(stripos($ua,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ud = f_v(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a4.')('.$a5.')</a>'. "\n";
echo $xml;
}}}
function skmso($url) {
       $tk= array("0","1","2","3","4");
       $ak= array("2","0","1","2","3");
       $uk= array("","96","97","95","85","94","100","84","92","87","89","91","171","172");
       $w=$_GET["w"]?$_GET["w"]:date("d"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $tnk= $tk[$t];
       $ank= $ak[$a];
       $unk= $uk[$u];
   if ($t < '6') $tnkk=$tnk;else $tnkk=$t;
for ($i = 1; $i <=$p; $i++) {
        $ul1 = 'https://www.soku.com/m/y/video_ajax?q='.$kw.'&site=14&cp='.$i.'&ps=20&od='.$ank.'&lt='.$tnkk.'&categories='.$unk.'&hd=0&noqc=0';
        $ul2 = 'https://www.soku.com/m/y/video_ajax?q='.$kw.'&site=14&cp='.$i.'&ps=20&od=2&lt='.$tnkk.'&hd=0&noqc=0&tag=1&stag=-1&sfilter=0&kb=120200000000000_'.$kw.'&categories=96';
        $ut = m_v($ul1);
preg_match_all('#<span class="v-time">([^>]+)</span>(.*)<div class="v-title"><a href="([^>]+)"(.*)title="([^>]+)"(.*)>(.*)<span class="v-num">([^>]+)</span>#ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
        $a2=$d[3][$k];
        $a3=r_u($d[5][$k]);
        $a4=$d[8][$k];
        $ud = f_kd(f_ht($a2));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$a1.')('.$a4.')</a>'."\n";
echo $xml;
}}}
function sgwso($url) {
       $wk= array("","喜剧","爱情","动作","恐怖","科幻","惊悚","犯罪","奇幻","战争","悬疑","动画","文艺","传记","歌舞","古装","警匪","其他");
   $uk= array("","%20site:qq.com","%20site:youku.com","%20site:iqiyi.com","%20site:sohu.com","%20site:baomihua.com","%20site:bilibili.com","%20site:le.com","%20site:boosj.com","%20site:ifeng.com","%20site:pptv.com","%20site:miaopai.com");
       $tk= array("0","l5","l30","m30","m60");
       //$tk= array("film","teleplay","cartoon","documentary","tvhow","mv","essay","crosstalk","pair");
       //$w = $_GET['w']?$_GET['w']:date("Y").'-'.date("m");  
       $t = $_GET['t']?$_GET['t']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $w = $_GET['w']?$_GET['w']:0; 
       $wnk= $wk[$w]; 
       $kw = k_w($w);
       $tnk=$tk[$t];
       $unk=$uk[$u];
    for($i=0;$i<=$p;$i++){
        $p1 =$i*10;
        $p2 =$i*15;
if( $a =='1') {
if($w<20) $wnkk =$wnk;else $wnkk= $kw;
        $url ='https://waptv.sogou.com/napi/video/re?fee=%E6%AD%A3%E7%89%87&order=time&entity=film&query='.$wnkk.''.$unk.'&class=1&fr=filter&req=class&duration='.$tnk.'&start='.$p2.'&len=15';
        //$url ='https://waptv.sogou.com/napi/video/classlist?abtest=0&iploc=CN3100&spver=0&listTab=film&filter=&start=15&len=15&emcee=&fr=filter&style=&zone=&year=&fee=%E6%AD%A3%E7%89%87&order=';
        //$url ='https://waptv.sogou.com/napi/video/classlist?abtest=0&iploc=CN3100&spver=0&listTab=film&filter=&start=15&len=15&emcee=&fr=filter&style=%E7%A7%91%E5%B9%BB&zone=&year=&fee=%E6%AD%A3%E7%89%87&order=';
        $ul = J_d(m_v($url),true);
        $aa = $ul["data"]["results"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = m_u($a0["name"]);
       $a3 = $a0["release_time"];
       $a5 = $a0["duration"].'分';
       $a2 = 'https://waptv.sogou.com'.$a0["tiny_url"];
       $a4 = 'https://waptv.sogou.com'.$a0["url"];
     $xml ='<a href="'.$fname.'?&sgsovid='.$a4.'"  target="b">'.$a1.'('.$a3.')( '.$a5.' )('.$a7.')</a>';
echo $xml;
}}else {
if($w<20) $wnkk =$wnk;else $wnkk= $kw;
        $url ='https://waptv.sogou.com/napi/video/shortvideo?query='.$kw.''.$unk.'&fee=%E6%AD%A3%E7%89%87&order=time&start='.$p1.'&len=10&w=06009900&duration='.$tnk.'&class=1&fr=filter&req=class&entity=film';
        //$url ='https://waptv.sogou.com/napi/video/shortvideo?query=2021&start=10&len=10&tag=&session=&w=06009900&pornclass=0&duration='.$tnk.'&copyrightclass=0';
        $ul = J_d(m_v($url),true);
        $aa = $ul["data"]["shortVideoList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = m_u($a0["titleCut"]);
       $a2 = $a0["murl"];
       $a5 = $a0["duration"];
       $a3 = $a0["date"];
       $a4 = $a0["itemUrl"];
if( stripos($a4,'bilibili') !== false ) {$a7 = m_u("哔哩");}else if( stripos($a4,'ixigua') !== false ){$a7 = m_u("西瓜");}else if( stripos($a4,'qq.com') !== false ){$a7 = m_u("qq");}else if( stripos($a4,'iqiyi') !== false ){$a7 = m_u("iqiyi");}else if( stripos($a4,'sohu') !== false ){$a7 = m_u("sohu");}else if( stripos($a4,'youku') !== false ){$a7 = m_u("youku");}else if( stripos($a4,'pptv') !== false ){$a7 = m_u("pptv");}else if( stripos($a4,'baomihua') !== false ){$a7 = m_u("baomihua");}else if( stripos($a4,'miaopai.com') !== false ){$a7 = m_u("miaopai");}else if( stripos($a4,'le.com') !== false ){$a7 = m_u("le");}
else $a7="";

    /*if(stripos($a4,'ixigua.com') !== false) {
   preg_match("#(.*)ixigua.com\/(.*)\/#U",$a4,$b2);
       $ud  = 'https://www.ixigua.com/embed?group_id='.substr($b2[2],1);
}else if( stripos($a4,'m.v.qq.com') !== false ){
   preg_match("#(.*)\/([^<]+).html#ism",$a4,$b2);
       $a8  = 'https://v.qq.com/x/page/'.$b2[2].'.html';
       $ud =  '../v.htm?f='.$a8;
}else if( stripos($a4,'i.y.qq.com') !== false ){
   preg_match("#(.*)?vid=([^<]+)&channelId=(.*)#ism",$a4,$b2);
       $a8  = 'https://y.qq.com/n/ryqq/mv/'.$b2[2];
       $ud =  '../v.htm?f='.$a8;
}else {  $ud =  '../v.htm?f='.$a4;};*/
         $ud =  '../v.htm?f='.$a4;
     $xml ='<a href="'.$ud.'" target="b" >'.$a1.'  (  '.$a3.'  )  ( '.$a5.' )  (  '.$a7.'  )</a>';
echo $xml;
}}
}}
function sgvso($url) {
       $wk= array("","喜剧","爱情","动作","恐怖","科幻","惊悚","犯罪","奇幻","战争","悬疑","动画","文艺","传记","歌舞","古装","警匪","其他","音乐MV","相声","纪录片");
       $w2k= array("","爱情","喜剧","都市","悬疑","古装","偶像","犯罪","历史","战争","武侠","警匪","科幻","奇幻","谍战","农村","其他");
       $w3k= array("","搞笑","热血","冒险","美少女","科幻","校园","恋爱","神魔","机战","益智","亲子","励志","童话","青春","原创","动作","耽美","魔幻","其他");
       $w4k= array("","社会","历史","战争","运动","文艺","青春","剧情","儿童","成长");
       $w5k= array("","喜剧","音乐","社会","历史","儿童");
       $uk= array("","%20site:qq.com","%20site:youku.com","%20site:iqiyi.com","%20site:sohu.com","%20site:baomihua.com","%20site:bilibili.com","%20site:le.com","%20site:boosj.com","%20site:ifeng.com","%20site:pptv.com","%20site:miaopai.com");
       $tk= array("film","teleplay","cartoon","documentary","tvhow","mv","essay","crosstalk","pair");
       $t2k= array("0","l5","l30","m30","m60");
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $unk= $uk[$u];
       $tnk= $tk[$t];
       $w=$_GET["w"]?$_GET["w"]:'0'; 
if($t==0){
       $wnk= $wk[$w];
}else if($t==1){
       $wnk= $w2k[$w];
}else if($t==2){
       $wnk= $w3k[$w];
}else if($t==3){
       $wnk= $w4k[$w];
}else if($t==4){
       $wnk= $w5k[$w];
}else {
       $wnk= $wk[$w];
}
       $kw=k_w($wnk); 
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
    /*if($t>"30") {
       $ul ='https://v.sogou.com/api/video/result?style=&zone=&year=&starring=&fee=&order=&emcee=&req=class&query=%E9%9F%B3%E4%B9%90MV&duration=m60&entity='.$tnk.'&page='.$i.'&pagesize=30';
}else {}*/
       $ul ='https://v.sogou.com/api/video/longVideo?style='.$kw.'&zone=&year=&starring=&fee=%E6%AD%A3%E7%89%87&order=time&emcee=&req=list&query=&entity='.$tnk.'&page='.$i.'&pagesize=30';

       $st = m_v($ul);
       $nt = J_d($st,ture);
       $aa = $nt["longVideo"]["results"];
       $counts = count($aa);
 for ($i2 = 0; $i2 < $counts; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["dockey"];
       $a1 = $a0["year"];
       $a3 = m_u($a0["titleCut"]);
       $a4 = m_u($a0["style"]);
       $a5 = $a0["tiny_url"];
       $a8 = $a0["persistence"];
       $a6 = $a0["_duration"];
      if($a6=="") $a6=$a1;else $a6=$a6;
        $ua =  'https://v.sogou.com'.$a5;
      //if($a7 >1) $ua =$a7;else $ua=$ua;
        $ud =  '../v.htm?f='.$ua;
       //$xml ='<a href="'.$ud.'" target="b" >'.$a3.'&nbsp;&nbsp;(&nbsp;'.$a4.'&nbsp;)&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
    if($t=="1"||$t=="2") {
     $xml ='<a href="'.$fname.'?&sgsovids='.$ua.'&name='.$a3.'" target="b1">'.$a3.'&nbsp;&nbsp;('.$a4.'&nbsp;&nbsp;'.$a8.')&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
}else if($t=="4"||$t=="5"||$t=="6"||$t=="7"||$t=="8"){
     $xml ='<a href="'.$fname.'?&sgsovidu='.$ua.'" target="b">'.$a3.'&nbsp;&nbsp;('.$a4.'&nbsp;&nbsp;'.$a8.')&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
}else {
     $xml ='<a href="'.$fname.'?&sgsovid='.$ua.'" target="b">'.$a3.'&nbsp;&nbsp;('.$a4.'&nbsp;&nbsp;'.$a8.')&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
}
echo $xml;
}}}
function sgmso($url) {//相关视频
       $uk= array("","%20site:qq.com","%20site:youku.com","%20site:iqiyi.com","%20site:sohu.com","%20site:baomihua.com","%20site:bilibili.com","%20site:le.com","%20site:boosj.com","%20site:ifeng.com","%20site:pptv.com","%20site:miaopai.com");
       $tk= array("0","l5","l30","m30","m60");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $unk= $uk[$u];
       $tnk= $tk[$t];
if(t<=4) $tnk=$tnk;else $tnk=$t;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
        $url2 ='https://v.sogou.com/v?query='.$kw.''.$unk.'&duration='.$tnk.'&ie=utf8&tcc=1&tn=0&len=20&page='.$i.'';
        $url ='https://v.sogou.com/api/video/shortVideo?query='.$kw.''.$unk.'&page='.$i.'&pagesize=20&sort_type=&duration='.$tnk.'&publish=&hd=';
        $ut = m_v($url);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["titleEsc"]);
       $a1=$a0["url"];
       $a3 = 'https://v.sogou.com'.$a1;
       $a4 = $a0["date"];
       $a5 = $a0["duration"];
       $a6 = $a0["dateTime"];
        $ud =  $a3;
        $vd=Current(explode('?',$v));
     //$xml ='<a href="'.$fname.'?&sg_so='.$a3.'" target="b">'.$a2.' ( '.$a4.' ) ( '.$a5.' )</a>';
     $xml ='<a href="'.$ud.'" target="b2" >'.$a2.' ( '.$a4.' ) ( '.$a5.' )</a>';
echo $xml;
}}}
function xgso($url) {//西瓜视频
       $u = $_GET['u']?$_GET['u']:0;  
       $w = $_GET['w']?$_GET['w']:"2020"; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
        $url1 ='https://www.ixigua.com/api/searchv2/complex/'.$kw.'/13?search_id=202012210956200100290550180016EDFC&debug_model=false&_signature=_02B4Z6wo00f01CeD0.wAAIBAvicqwuy47eQnhtdAAFYG92';
        $url2 ='https://www.ixigua.com/api/searchv2/complex/%E9%98%BF%E6%B3%A2%E7%BD%97%E7%99%BB%E6%9C%88%E5%85%A8%E8%BF%87%E7%A8%8B/0?min_duration=301&max_duration=600&interval_type=5-10min&debug_model=false&_signature=_02B4Z6wo00f01xRPtOAAAIBDjetN3Y4AIusUSrBAAJr9df';
        $ut = m_s($url2);
       /*$nt = J_d($ut,ture);
       $aa = $nt["data"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["data"]["title"]);
       $a3 = $a0["data"]["video_time"];
       $a4 = t_m($a0["data"]["publish_time"]);
       $a5 = m_u($a0["data"]["anchor"]);
       $a6 = $a0["data"]["group_id"];
       $ua =  'https://www.ixigua.com/iframe/'.$a6.'?autoplay=1&startTime=0';
        //$ud = f_t($ua);
        $ud =  $ua;
     $xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.$a3.')</a>';*/
echo $ut;
}
function smso($url) {
       $u = $_GET['u']?$_GET['u']:0;  
       $w = $_GET['w']?$_GET['w']:""; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
        $url1 ='https://z1.m1907.cn/api/v/?z=5d855143e6fd5d1a252ac6c34b2b7e0f&jx='.$kw;
        $url2 ='https://z1.m1907.cn/api/v/?z=1c8af15f8706ec379353f8b04d2b4c3a&jx='.$kw;
        $url="";
if($u=="0") $url=$url2;else $url=$url1;
        $ul = m_v($url);
   preg_match_all('|{"name":"([^<]+)","url":"([^<]+)"}|ismU',$ul,$b);
   foreach($b[1] as $k=>$v){
        $a4 = m_u($b[1][$k]);
        $a5 = $b[2][$k];
        $ua =  $a5;
        //$ud = f_kd($ua);
        $ud =  '../t.htm?&f='.$ua;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$w.')</a>';
echo $xml;
}}
function smso3($url) {
       $u = $_GET['u']?$_GET['u']:0;  
       $w = $_GET['w']?$_GET['w']:""; 
       $kw=k_w($w);
        $url1 ='https://z1.m1907.cn/api/v/?z=5d855143e6fd5d1a252ac6c34b2b7e0f&jx='.$kw;
        $url2 ='https://z1.m1907.cn/api/v/?z=1c8af15f8706ec379353f8b04d2b4c3a&jx='.$kw;
        $url="";
if($u=="0") $url=$url2;else $url=$url1;
  preg_match("#\{\"eps\":\[\{(.*)\}\]\};#U",m_v($url),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       //$ut = m_v($url);
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
        $a3 = $a0["name"];
        $a4 = $a0["url"];
        $ud =  '../t.htm?&f='.$a4;
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.' ('.$w.')</a>'.'</n>';
echo $xml;
}}
function wbbso($url) {
       $u = $_GET['u']?$_GET['u']:0;  
       $w = $_GET['w']?$_GET['w']:"科幻"; 
       $kw=k_w($w);
 $url ='https://m.weibo.cn/api/container/getIndex?containerid=100103type%3D1%26q%3D'.$kw.'&display=0&retcode=6102&page_type=searchall';
 preg_match_all('#"video_orientation":"([^<]+)","name":"([^<]+)"#ismU',m_v($url),$b);
 preg_match_all('#"stream_url":"([^<]+)"#ismU',m_v($url),$b1);
 //preg_match_all('#"stream_url_hd":"([^<]+)"#ismU',m_v($url),$b2);
 //preg_match_all('#"mp4_sd_url":"([^<]+)"#ismU',m_v($url),$b3);
 foreach($b[1] as $k=>$v){
        $a0 = r_u($b[2][$k]);
        $a1 = x_g($b1[1][$k]);
        $a2 = x_g($b2[1][$k]);
        $a3 = x_g($b3[1][$k]);
        $ud =  $a1;
     $xml ='<a href="'.$ud.'" target="b" >'.$a0.'</a>'.'';
echo $xml;
}}
function bdsso($url) {
       $uk= array("","e054a2d2f466627cbb7a81b4d6cd06c1","017c2c68fa1b3389e1b01208971a2f34","cd1bea5e88db74b90bda9a7017f3dc90","ff724cc22634f646e096010990747323","7067d60762088a64230d5009a7c9e411","6e26209098b503d92a8562ae047f3b35");
       $tk= array("","28286","6869","cd1be","ff724","7067","6e262");
       $w = $_GET['w']?$_GET['w']:date("Y");  
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $p2 = $p*8;
       $tnk=$tk[$t];
        $url ='https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?format=json&ie=utf-8&oe=utf-8&resource_id=6869&query='.$kw.'&from_mid=1&co=vlink&apn=0&arn=96&locsign='.$tnk.'&tn=baidu&cb=jQuery110208250916592633848_1560135074101&';
        $url2 ='https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?resource_id=28286&from_mid=1&&format=json&ie=utf-8&oe=utf-8&query='.$kw.'&sort_key=17&sort_type=1&stat0=&stat1=&stat2=&stat3=&pn='.$p2.'&rn=8&cb=jQuery110200617472365420888_1560138491101&';
        $url3 ='http://v.baidu.com/v?ct=301989888&ie=utf-8&quickling=1&word='.$kw.'&du=1&order=0&sc=0&pd=0&pn=0&rn=60&pagelets[]=widget_normalresult&pagelets[]=main&force_mode=1&t=257401';
        $url4 ='http://v.baidu.com/v?ct=301989888&ie=utf-8&quickling=1&word=2019&du=1&order=0&sc=0&pd=0&pn=60&rn=20&pagelets[]=widget_normalresult&pagelets[]=main&force_mode=1&t=872081';
        $url5 ='http://v.baidu.com/v?ct=301989888&ie=utf-8&quickling=1&word=2019&du=1&order=1&sc=0&pd=0&pn=0&rn=60&pagelets[]=widget_normalresult&pagelets[]=main&force_mode=1&t=271916';
        $ul = m_v($url);
   preg_match_all('|"linkcontent":"([^<]+)"(.*)"linkurl":"([^<]+)"|ismU',$ul,$b);
   //preg_match_all('|"linkcontent":"([^<]+)","linkurl":"([^<]+)"(.*)"wiselinkurl":"([^<]+)"|ismU',$ul,$b);
   foreach($b[1] as $k=>$v){
        $a4 = m_u($b[1][$k]);
        $a5 = x_g($b[3][$k]);
        //$a6 = x_g($b[4][$k]);
        $ua =  $a5;
        //$ud = f_kd($ua);
        $ud =  '../v.htm?f='.$ua;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$w.')</a>';
echo $xml;
}}
function yunfso($url) {
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $a = a_a($_GET['a'])?a_a($_GET['a']):"tv";
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.yunfan.com/s.php?q='.$kw.'&c=0&long_total=53&p='.$i;
       $ut = m_v($ul);
preg_match_all('|<div class="bt_t(.*)">([^<]+)<a data-entryid="([^<]+)"(.*)href="([^<]+)"(.*)>([^<]+)</a>|imsU',$ut,$d);
preg_match_all('| <div class="hb_sc1"><span>([^<]+)</span></div>|ims',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a3 = $d2[2][$k];
        $a4='http://www.yunfan.com'.$d[5][$k];
        $a5=m_u($d[7][$k]);
       $ut2 = m_v($a4);
preg_match_all('|<div class="hb_L1">(.*)<a data-entryid="(.*)" href="([^<]+)"(.*)source="([^<]+)"(.*)playname="([^<]+)">|imsU',$ut2,$d3);
preg_match_all('|<span class="ht_name">([^<]+)</span></li>|ims',$ut2,$d4);
foreach ($d3[1] as $k2=>$v2){
        $a6=$d3[3][$k2];
        $a7=$d3[7][$k2];
        $a8=m_u($d4[1][$k2]);
        $bu = str_ireplace('http://','',$a3);
   if(stripos($a6,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a6;
        $ud = f_kd(f_ht($ua));
        $v=Current(explode('?',$v2));
	$xml ='<a href="'.$ud.'" target="b" >'.$a7.' ('.$a8.')</a>'. "\n";
echo $xml;
}}}}
function v1so($url) {
       $w = $_GET['w']?$_GET['w']:date("Y");  
       $kw=k_w($w);
       $a = a_a($_GET['a'])?a_a($_GET['a']):"tv";
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=4;$i++){
 $url ='http://so.v1.cn/search/news/video/all/q_'.$kw.'_sort_2_order_2_pagesize_16_page_'.$p.'';
        $ul = m_v($url);
preg_match_all('|<a target="_blank" href="(.*)" class="title" title="(.*)"><font color=red>(.*)</font>(.*)</a>|U',$ul,$c1);
        foreach($c1[1] as $k=>$v){
        $a2 = $c1[1][$k];
        $a3 = $c1[2][$k];
        $ul2 = m_v($a2);
preg_match_all('|flashvars="(.*)"|U',$ul2,$c2);
        foreach($c2[1] as $k2=>$v2){
        $a4 = $c2[1][$k2];
        $a5 = 'http://www.v1.cn/player/cloud/cloud_player.swf?&autoPlay=true&'.$a4.'';
        $vd=Current(explode('?',$v2));
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.'</a></br>';
echo $xml;
}}}}
function qyso($url) {
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $ew=urldecode($w);
   if ($w == '')  $w='';else  $w=$w;
       $t = $_GET['t']?$_GET['t']:1;
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
 $url ='http://so.iqiyi.com/so/q_'.$kw.'_ctg__t_0_page_'.$i.'_p_1_qc_0_rd_0_site__m_'.$t.'_bitrate_?refersource=lib';
        $ut = f_g($url);
preg_match_all('|data-searchpingback-param="ptype=1-1"(.*)href="([^<]+)"(.*)<img(.*)title="(.*)"|ismU',$ut,$b);
preg_match_all('|<em class="vm-inline"(.*)>([^<]+)</em>|ismU',$ut,$b2);
preg_match_all('|<div class="info_item">(.*)<div class="(.*)">(.*)<label class="result_info_lbl">(.*)</label>(.*)<em(.*)>([^<]+)</em>|ismU',$ut,$b3);
   foreach($b[1] as $k=>$v){
        $a3 = $b[2][$k];
        $a4 = $b2[2][$k];
        $a5 = $b[5][$k];
        $a6 = $b3[7][$k];
        $bu = str_ireplace('http://','',$a3);
   if(stripos($a3,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a3;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'('.$a6.')('.$a4.')</a>';
echo $xml;
}}
}
function qyso2($url) {
       $tk= array("0","1","2","3","4","5");
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $ew=urldecode($w);
   if ($w == '')  $w='';else  $w=$w;
       $uk= array("null","电影","电视剧","纪录片","军事","科技");
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $tnk=$tk[$t];
       $unk=$uk[$u];
       $usnk1='ctg_'.$unk.'_';
       $usnk2='ctg__';
   if ($u == '0')  $usnk=$usnk2;else $usnk=$usnk1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $url ='http://so.iqiyi.com/so/q_'.$kw.'_'.$usnk.'t_'.$t.'_page_'.$i.'_p_1_qc_0_rd_0_site__m_4_bitrate_?refersource=lib';
        $ut = f_g($url);
preg_match_all('|<p class="viedo_rb">(.*)<span class="icon-vInfo">([^<]+)</span>|ismU',$ut,$b0);
preg_match_all('|<h3 class="result_title">(.*)<a(.*)data-searchpingback-elem="link"(.*)data-searchpingback-param="ptype=(.*)"(.*)title="([^<]+)"(.*)data-playsrc-elem="title"(.*)href="([^<]+)"(.*)>|ismU',$ut,$b);
preg_match_all('|<div class="info_item">(.*)<div class="result_info_cont result_info_cont-half">(.*)<label class="result_info_lbl">(.*)</label>(.*)<em class="result_info_desc">(.*)</em>|ismU',$ut,$b3);
   foreach($b0[1] as $k=>$v){
        $a2 = $b0[2][$k];
        $a3 = $b[6][$k];
        $a4 = $b[9][$k];
        $a6 = $b3[5][$k];
        $bu = str_ireplace('http://','',$a3);
   if(stripos($a3,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        $ua =  $a4;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$ew.'('.$a6.')('.$a3.')  ('.$a2.')</a>';
echo $xml;
}}
}
function byvso($url) {
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:0;
    for($i=0;$i<=$p;$i++){
	$ul = 'http://cn.bing.com/search?q=site:video.weibo.com+'.$kw.'&first='.$p.'1&FORM=PERE';
	$ul2 = 'https://cn.bing.com/videos/asyncv2?q='.$w.'&async=content&first=77&count=35&dgst=RowIndex_u23*ColumnIndex_u1*TotalWidth_u268*OrdinalPosition_u70*ThumbnailWidth_u252*HeroContainerWidth_u520*HeroContainerHeight_u532*HeroOnPage_b0*arn_u0*ayo_u0*cry_u6302*&IID=video.1&SFX=4&IG=4DA72D6C8C944202BB8F868A5E86DB0E&CW=990&CH=571&qft=+filterui:duration-long&form=VRFLTR';
        $ut = m_v($ul);
preg_match_all('|<h2><a href="(.*)" target="_blank" h="(.*)">(.*)</a></h2>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a3 =$d[1][$k];
        $a4 =$d[3][$k];
        $ut2 = m_v($a3);
//preg_match_all('|flashvars="(.*)"|ismU',$ut2,$d2);
preg_match_all('|src="(.*)" flashvars="(.*)"|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
        $a5 =$d2[1][$k2];
        $a6 =$d2[2][$k2];
        //$a6 ='http%3A%2F%2Fus.sinaimg.cn%2F'.$a5.'.m3u8';
        //$ut3 = m_v($a6);
//preg_match_all('|/(.*).mp4|ismU',$ut3,$d3);
//foreach ($d3[1] as $k3=>$v3){
        //$a7 =$d3[1][$k3];
        //$a8 ='http://us.sinaimg.cn/'.$a7.'.mp4';
        $vd=Current(explode('?',$v2));
	$xml ='<a href="http://js.t.sinajs.cn/t5/album/static/swf/video/player.swf?'.$a6.'" target="b" >'.$a4.'</a>';
echo $xml;
}}}}
function byso($url) {
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $u = $_GET['u']?$_GET['u']:'0';
       $p = $_GET['p']?$_GET['p']:'1';
        $p1 = $p*30;
 //for($i=0;$i<=$p;$i++){}
$ul = 'https://cn.bing.com/videos/asyncv2?q='.$kw.'&async=content&first=0&count='.$p1.'&qft=+filterui:duration-long&form=VRFLTR&&IID=video.1&SFX=3';
	$ut = m_v($ul);
preg_match_all('|<a(.*)aria-label="([^<]+)"(.*)class="(.*)"(.*)href="([^<]+)"(.*)>|ismU',$ut,$d);
foreach ($d[2] as $k=>$v){
        $a4 =m_u($d[2][$k]);
        $a5 =$d[6][$k];
        $ud = f_kd($a5);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a4.'</a>';
echo $xml;
}}
function zmso($url) {//字幕搜索
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $a = a_a($_GET['a'])?a_a($_GET['a']):"tv";
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
       $ul='http://www.zimuku.net/search?ad=1&q='.$kw.'';
       $ut = m_v($ul);
preg_match_all('|<td class="first">(.*)<a href="([^<]+)" target="_blank" title="([^<]+)"><b>([^<]+)</b></a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a3=m_u($d[3][$k]);
       $a4='http://www.zimuku.net'.$a2;
       $ut2 = f_g($a4);
preg_match_all('|<li class="li dlsub">(.*)<a href="([^<]+)"><span class="dl">|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a5=$d2[2][$k2];
       $a6='http://www.zimuku.net'.$a5;
       $vd=Current(explode('?',$v2));
    $xml ='<a href="'.$a6.'">'.$a3.'</a>';
echo $xml;
}}}}
function zmso2($url) {//字幕搜索
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
       $ul='http://www.disanlou.org/plugin.php?id=attachcenter%3Alist&srchtxt='.$kw.'&page='.$p.'';
       $ut = m_v($ul);
preg_match_all('|<li>(.*)</b>(.*)<a href="([^<]+)" title="([^<]+)">([^<]+)</a></li>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=m_u($d[4][$k]);
       $a4='http://www.disanlou.org/'.$a2;
       $ut2 = m_v($a4);
preg_match_all('|<li><a href="([^<]+)" target="_blank"><img(.*)/></a></li>(.*)</ul>|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a7=$d2[1][$k2];
       $a8='http://www.disanlou.org'.$a7;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a7.'">'.$a3.'</a>';
echo $xml;
}}}}
function psso($url) {//评书搜索
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $ul='http://www.5tps.com/search.asp?keyword='.$kw.'';
       //$ut = f_g(g_h($ul));
//preg_match_all('|<li><a href=([^<]+)>([^<]+)<span>([^<]+)</span></a></li>|ismU',$ut,$d);
//foreach ($d[1] as $k=>$v){
       //$a2=$d[1][$k];
       //$a3=m_u($d[2][$k]);
       //$a4=m_u($d[3][$k]);
       //$a5='http://www.5tps.com'.$a2;
       //$ut2 = f_g($a5);
//preg_match_all("|<li><a href=([^<]+)title='([^<]+)'>([^<]+)</a><a href=([^<]+)title='([^<]+)'><b>([^<]+)</b></a></li>|ismU",$ut2,$d2);
//foreach ($d2[1] as $k2=>$v2){
       //$a6=$d2[1][$k2];
       //$a7=m_u($d2[2][$k2]);
       //$a8='http://www.5tps.com'.$a6;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ul.'">'.$ul.'</a>';
    //$xml ='<a href="'.$a8.'">'.$a7.'</a>';
echo $xml;
}
function yunso($url) {//bt兔子
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btrabbit.vip/search/'.$kw.'/time-'.$i.'.html'; 
       $ur = m_v($ul);
preg_match_all("#<h3><a title=\"([^<]+)\"(.*)href=\"(.*)\/wiki\/([^<]+).html\"(.*)>(.*)<\/h3>#ismU",$ur,$d);
preg_match_all('|<div class="item-bar">(.*)<span class="cpill(.*)">([^<]+)</span>(.*)<b class="cpill(.*)">([^<]+)</b>|ismU',$ur,$d2);
foreach ($d[1] as $k=>$v){
	$a4=$d[1][$k];
        $a5=m_u($d[4][$k]);
        $a6=m_u($d2[3][$k]);
        $a7=m_u($d2[6][$k]);
        $bt = 'magnet:?xt=urn:btih:'.$a5;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$bt.'" target="b" >'.$a4.'('.$a6.')('.$a7.')</a>';
echo $xml;
	}}}
function yunso0($url) {//bt天堂
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
	$ul = 'https://www.bturl.at/search/'.$kw.'_ctime_'.$i.'.html'; 
        $mt = m_v($ul);
preg_match_all("|<h3(.*)>(.*)<a(.*)href=\"\/([^<]+).html\">(.*)<\/h3>(.*)<div class=\"item-list\">([^<]+)<\/div>(.*)<dt>([^<]+)<span>([^<]+)<\/span>([^<]+)<span>([^<]+)<\/span>([^<]+)<span>([^<]+)<\/span>|ismU",$mt,$d);
foreach ($d[1] as $k=>$v){
        $a3='magnet:?xt=urn:btih:'.$d[4][$k];
        $a4=m_u($d[7][$k]);
        $a5=m_u($d[10][$k]);
        $a6=m_u($d[12][$k]);
        $vd=Current(explode('?',$v2));
	$xml .='<a href="'.$a3.'" target="b" >'.$a4.'('.$a5.')('.$a6.')</a>';
echo $xml;
	}}}

function yunso1($url) {//bt飞客
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
   for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://feikebt.pw/s/'.$kw.'/'.$i.'/1/0.html'; 
        $ml =m_v($ul);
preg_match_all('#<h3><span class="red fb">(.*)</span><a(.*)>([^<]+)</a>(.*)</h3>(.*)<div class="categorybar">(.*)<span>(.*)<a href="([^<]+)"(.*)>(.*)</a></span>(.*)<span>([^<]+)<b>([^<]+)</b>(.*)</span>(.*)<span>([^<]+)<b>([^<]+)</b>(.*)</span>(.*)<span>([^<]+)<b>([^<]+)</b>(.*)</span>#ismU',$ml,$d);
foreach ($d[1] as $k=>$v){
	$a1=m_u($d[3][$k]);
	$a2=$d[8][$k];
        $a3=$d[13][$k];
        $a4=$d[21][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="b" >'.$a1.' ('.$a3.')('.$a4.')</a>';
echo $xml;
	}}}

function yunso2($url) {//潘森吧
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://www.pspbar.com/main-search-kw-'.$kw.'-px-1-page-'.$i.'.html'; 
	$ml =m_v($ul);
preg_match_all('|<tr><td class="x-item">(.*)<a title="(.*)" class="title" href="/h/(.*)">|ismU',$ml,$d);
preg_match_all('|<span class="ctime">(.*)</span>|imsU',$ml,$d2);
foreach ($d[1] as $k => $v){
        $a1=$d[2][$k];
        $a2=$d[3][$k];
        $a3='http://www.cilibaba.com/api/json_info?hashes='.$a2;
        $a4=$d2[1][$k];
	$ml2 =m_v($a3);
preg_match_all('|"info_hash": "([^<]+)",|ismU',$ml2,$d3);
preg_match_all('|"create_time": "(.*)",|ismU',$ml2,$d4);
foreach ($d3[1] as $k2 => $v2){
        $a5=$d3[1][$k2];
        $a6=$d4[1][$k2];
        $a7=''.$a1.'('.$a4.')('.$a6.')';
        $a9=m_g($a7);
        $a8='magnet:?xt=urn:btih:'.$a5;
        $vd=Current(explode('?',$v2));
	$xml ='<a href="'.$a8.'" target="b" >'.$a7.'</a></br>'.PHP_EOL;
	//$xml .='<a href="../yn.php?f='.$a6.'" target="b" >'.$a1.'('.$a4.')('.$a7.')</a>'.PHP_EOL;
echo $xml;
	}}}}
function yunso3($url) {//bt樱桃
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btcerise.me/search?keyword='.$kw.'&p='.$i.'';
       $ut = m_v($ul);
preg_match_all("|<div class=\"r\">(.*)<a href=\"\/info\/([^<]+)\"(.*)>(.*)<h5 class=\"h\">([^<]+)<span(.*)>(.*)<\/h5>|ismU",$ut,$d);
preg_match_all("|<span style=\"padding-right(.*)\">(.*)<span(.*)class=\"prop_val\">([^<]+)<\/span><\/span>(.*)<span(.*)style=\"padding-right(.*)\">(.*)<span(.*)class=\"prop_val\">([^<]+)<\/span>|ismU",$ut,$d2);
foreach ($d[1] as $k=>$v){
	$a1='magnet:?xt=urn:btih:'.$d[2][$k];
	$a2=$d[5][$k];
	$a5=$d2[4][$k];
	$a6=$d2[10][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a1.'" target="b" >'.$a2.'('.$a5.') ('.$a6.')</a>';
echo $xml;
	}}}
function yunso4($url) {//btbook
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
        $cl = m_u('磁力链接');
        $xl = m_u('迅雷链接');
        $wl = '';
   if ($wl !== '.zip')  $wl='';else  $wl=$wl;
       for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://www.btbook.net/search/'.$kw.'/'.$i.'-1.html'; 
	$ut = m_v($ul);
preg_match_all('|<div class="item-list">(.*)<li>([^<]+)<span class="lightColor">(.*)</li>|ismU',$ut,$d);
preg_match_all('|<a href="([^<]+)" class="download">'.$cl.'</a>(.*)<a href="([^<]+)" class="download">'.$xl.'</a>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a2=$d[2][$k];
        $a1=$d[3][$k];
        $a3=m_g($d[2][$k]);
        $a4=$d2[1][$k];
        $a5=$d2[3][$k];
   if(stripos($a2,".zip") === false){$a2=$a2;}else if(stripos($a2,".rar") === false){$a2=$a2;}else if(stripos($a2,".pdf") === false){$a2=$a2;}else if(stripos($a2,".iso") === false){$a2=$a2;}else if(stripos($a2,".txt") === false){$a2=$a2;}else{$a2=null;};
   if(stripos($a2,'.zip') === false){$a4=$a4;}else if(stripos($a2,'.rar') === false){$a4=$a4;}else if(stripos($a2,'.pdf') === false){$a4=$a4;}else if(stripos($a2,'.iso') === false){$a4=$a4;}else if(stripos($a2,'.txt') === false){$a4=$a4;}else{$a4=null;};
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a4.'" target="b" >'.$a2.'('.$a1.')</a>';
echo $xml;
	}}}
function yunso5($url) {//福利搜
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://www.juzisousuo.com/word/'.$kw.'_'.$i.'.html'; 
        $mt = m_v($ul);
preg_match_all("|<li><div class=\"T1\"><a href=\"\/read\/([^>]+).html\"(.*)>([^>]+)<\/a>(.*)<dl class=\"BotInfo\">(.*)<span>(.*)<span class=\"ctime\">([^>]+)<\/span>|ismU",$mt,$d);
foreach ($d[1] as $k=>$v){
        $a2='magnet:?xt=urn:btih:'.$d[1][$k];
        $a1=m_u($d[3][$k]);
        $a3=$d[7][$k];
        //$a4=$d[9][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="b" >'.$a1.'('.$a3.')</a>';
echo $xml;
	}}}
function yunso6($url) {//磁力链
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://cililian.me/list/'.$kw.'/'.$i.'.html';
       $ut = m_v($ul);
preg_match_all('|<div class="T1">(.*)<a name=(.*)>([^>]+)<span class="mhl">([^>]+)</span>(.*)</a></div>(.*)<dl class="BotInfo">(.*)<dt>(.*)<span>([^>]+)</span>|ismU',$ut,$d);
preg_match_all('|<div class="dInfo">(.*)<a href="(.*)">|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
	$a1=$d[3][$k];
	$a2=$d[4][$k];
	$a3=$d[5][$k];
	$a0=$d[9][$k];
	$a4=$a1.$a2.$a3;
	$a5=m_g($a4);
        $a6=$d2[2][$k];
   if(stripos($a6,'.zip') === false){$a6=$a6;}else if(stripos($a6,'.rar') === false){$a6=$a6;}else if(stripos($a6,'.pdf') === false){$a6=$a6;}else if(stripos($a6,'.iso') === false){$a6=$a6;}else if(stripos($a6,'.txt') === false){$a6=$a6;}else{$a6=null;};
   if(stripos($a6,'.zip') === false){$a4=$a4;}else if(stripos($a6,'.rar') === false){$a4=$a4;}else if(stripos($a6,'.pdf') === false){$a4=$a4;}else if(stripos($a6,'.iso') === false){$a4=$a4;}else if(stripos($a6,'.txt') === false){$a4=$a4;}else{$a4=null;};
        $vt=Current(explode('?',$v));
	$xml ='<a href="'.$a6.'" target="b" >'.$a4.'('.$a0.')</a>';
echo $xml;
	}}}
function yunso7($url) {//磁力
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
 for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.diaosisou.org/list/'.$kw.'/'.$i.'';
       $ut = m_v($ul);
preg_match_all("|<li>(.*)<div class=\"T1\">(.*)<a(.*)href=\"\/torrent\/([^>]+)\">([^>]+)<span class=\"mhl\">([^>]+)<\/span>([^>]+)<\/a>(.*)<dl class=\"BotInfo\">(.*)<dt>([^>]+)<span>([^>]+)<\/span>([^>]+)<span>([^>]+)<\/span>([^>]+)<span>([^>]+)<\/span>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2='magnet:?xt=urn:btih:'.$d[4][$k];
        //$a3=$d[3][$k];
        //$a5=$d[4][$k];
        $a6=m_u($d[5][$k]);
        $a7=m_u($d[6][$k]);
        $a8=m_u($d[7][$k]);
        $a9=m_u($d[11][$k]);
        $a10=m_u($d[15][$k]);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="b" >'.$a6.''.$a7.''.$a8.' ('.$a10.') ('.$a9.')</a>';
echo $xml;
	}
	}}
function yunso8($url) {//bt蚂蚁
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
     for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btants.com/search/'.$kw.'-first-asc-'.$i.'';
       $ut = m_v($ul);
preg_match_all('|<div class="item-title">(.*)<a href=(.*)>([^>]+)<span class="highlight">([^>]+)</span>(.*)</a>(.*)<div class="item-bar">(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<a href="([^>]+)"(.*)class="download">([^>]+)</a>(.*)<a href="([^>]+)"(.*)class="download">([^>]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a5=m_u($d[3][$k]);
	$a6=m_u($d[4][$k]);
	$a7=m_u($d[5][$k]);
        $a1=$d[10][$k];
	$a2=$d[12][$k];
	$a3=$d[22][$k];
        $a4=$d[24][$k];
        $a0=$d[28][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a4.'" target="b" >'.$a5.''.$a6.''.$a7.'   ('.$a1.')('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso92($url) {//磁力猫
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.cilimao.me/search?word='.$kw.'&sortDirections=desc&resourceSource=0&resourceType=1&sortProperties=created_time&page='.$i.'';
       $ul2 = 'http://www.cilimao.me/api/search?size=10&sortDirections=desc&word='.$kw.'&sortProperties=created_time&resourceType=1&resourceSource=0&page=0';
       $ut = m_v($ul);
preg_match_all("|<a href=\"\/information\/([^<]+)\?(.*)\"(.*)>([^<]+)<em>([^<]+)<\/em><em>([^<]+)<\/em>([^<]+)<\/a><div(.*)><span(.*)>(.*)<\/span><em data(.*)>([^<]+)<\/em>([^<]+)<em data(.*)>([^<]+)<\/em>(.*)<em data(.*)>([^<]+)<\/em>(.*)<\/div>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1='magnet:?xt=urn:btih:'.$d[1][$k];
	$a2=m_u($d[4][$k]);
	$a3= $d[18][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a1.'" target="b" >'.$a2.' ('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso9($url) {//磁力猫
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.cilimao.me/search?word='.$kw.'&sortDirections=desc&resourceSource=0&resourceType=1&sortProperties=created_time&page='.$i.'';
       $ul2 = 'http://www.cilimao.me/api/search?size=10&sortDirections=desc&word='.$kw.'&sortProperties=created_time&resourceType=1&resourceSource=0&page='.$i.'';
       $ut = m_v($ul2);
preg_match_all('|"title":"([^<]+)"(.*)"infohash":"([^<]+)"(.*)"created_time":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2=m_u($d[1][$k]);
        $a1='magnet:?xt=urn:btih:'.$d[3][$k];
	$a3= $d[5][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a1.'" target="b" >'.$a2.' ('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso10($url) {//磁力云
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://btbtbt8.com/search/'.$kw.'/?c=&s=create_time&p='.$i.'';
       $ut = f_g($ul);
preg_match_all('|<td(.*)class="x-item">(.*)<a(.*)title="([^<]+)"(.*)class="title"(.*)href="([^<]+)"><(.*)data-cfemail="([^<]+)"|ismU',$ut,$d);
preg_match_all('|<div class="tail">([^<]+)<span class="label label-info">([^<]+)</span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=m_u($d[4][$k]);
	$a2='http://btbtbt8.com'.$d[6][$k];
        $a3=$d2[1][$k];
        $a4=$d2[2][$k];
        $a5=$a2;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="b" >'.$a1.'('.$a3.')('.$a4.')</a>';
echo $xml;
	}
	}}
function yunso11($url) {//bt蚂蚁
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btmayis.com/search/'.$kw.'-first-asc-'.$i.'';
       $ut = m_v($ul);
preg_match_all("|<div class=\"item-title\">(.*)<a href=\"\/cili\/([^<]+)\"(.*)>([^<]+)<span class=\"highlight\">([^<]+)<\/span><span class=\"highlight\">([^<]+)<\/span>([^<]+)<\/a>|ismU",$ut,$d);
preg_match_all("|<div class=\"item-list\">(.*)<p>([^<]+)<span class=\"highlight\">([^<]+)<\/span><span class=\"highlight\">([^<]+)<\/span>([^<]+)<span>([^<]+)<\/span><\/p>|ismU",$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1='magnet:?xt=urn:btih:'.$d[2][$k];
	$a2=$d2[2][$k];
        $a3=$d2[3][$k];
        $a4=$d2[4][$k];
        $a5=$d2[5][$k];
        $a6=$d2[6][$k];
        $a7=$a2.$a3.$a4.$a5.$a6;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a1.'" target="b" >'.m_u($a7).'</a>';
echo $xml;
	}
	}}
function yunso12($url) {//搜bt
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.sobt5.com/q/'.$kw.'_rel_'.$i.'.html';
       $ut = m_v($ul);
preg_match_all('|<div class="item-title"><h3><a href="/torrent/([^>]+).html" target="_blank">(.*)</a></h3>(.*)<b(.*)>([^>]+)</b>(.*)<b(.*)>([^>]+)</b></span>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
	$a2=$d[2][$k];
	$a3=$d[8][$k];
        $a5='magnet:?xt=urn:btih:'.$a1.'';
        //$a6=''.$a2.'('.$a4.')'.$a3.'';
        //$a7=m_g(''.$a2.'('.$a4.')'.$a3.'');
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a5.'" target="b" >'.$a2.'('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso13($url) {//bt工厂
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btup.net/s/'.$w.'/'.$i.'/';
       $ul2 = 'http://api.xhub.cn/api.php?op=search_list&key='.$kw.'&page='.$i.'';
       $ut = m_v($ul);
preg_match_all('|<li><a href="http://www.btup.net/info/([^>]+)">([^>]+)</a></li>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
	$a2=$d[2][$k];
        $a5='magnet:?xt=urn:btih:'.$a1.'';
        $a6=m_g($a2);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a5.'" target="b" >'.$a2.'</a>';
echo $xml;
	}
	}}
function yunso14($url) {//bt蚂蚁
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btany.com/search/'.$kw.'-first-asc-'.$i.'';
       $ul2 = 'http://api.xhub.cn/api.php?op=search_list&key='.$kw.'&page='.$i.'';
       $ut = f_g($ul);
preg_match_all('|<div class="item-title">(.*)<a href=(.*)>([^>]+)<span class="highlight">([^>]+)</span>(.*)</a>(.*)<div class="item-bar">(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<span>([^>]+)<b(.*)>([^>]+)</b>(.*)<a href="([^>]+)"(.*)class="download">([^>]+)</a>(.*)<a href="([^>]+)"(.*)class="download">([^>]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a5=m_u($d[3][$k]);
	$a6=m_u($d[4][$k]);
	$a7=m_u($d[5][$k]);
        $a1=$d[10][$k];
	$a2=$d[12][$k];
	$a3=$d[22][$k];
        $a4=$d[24][$k];
        $a0=$d[28][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a4.'" target="b" >'.$a5.''.$a6.''.$a7.'   ('.$a1.')('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso15($url) {//bt尼玛
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.nimasou.net/l/'.$kw.'-first-asc-'.$i.'';
       $ut = f_g($ul);
preg_match_all('|<li>([^>]+)<span class="highlight">([^>]+)</span>([^>]+)</li>(.*)<div class="tail">([^>]+)<a rel="nofollow" class="title" href="([^>]+)"><span class="glyphicon glyphicon-magnet">|ismU',$ut,$d);
preg_match_all('||ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=m_u($d[1][$k]);
	$a2=m_u($d[2][$k]);
	$a3=m_u($d[3][$k]);
        $a4=$d[5][$k];
        $a5=$d[6][$k];
        $a6=$a1.$a2.$a3;
        $a7=$a5.'&dn='.$a6;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a7.'" target="b" >'.$a6.''.$a4.'</a>';
echo $xml;
	}
	}}
function yunso16($url) {//磁力搜
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.cilisou.cn/s.php?q='.$kw.'&encode_=1&p='.$i.'&order=2';
       $ut = f_g($ul);
preg_match_all('|<td class="torrent_name">(.*)<a href="(.*)" target="_blank">([^>]+)</a>|ismU',$ut,$d);
preg_match_all('|<td class="ttth">(.*)<a href="([^>]+)dn=([^>]+)" target="_blank" title="(.*)">|ismU',$ut,$d2);
preg_match_all('|<span class="attr_val">([^>]+)</span>|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
        $a1=m_u($d[3][$k]);
	$a2=$d2[2][$k];
	$a3=$a2.'&dn='.$a1;
        $a4=$d3[1][$k];
        $a5=$d2[2][$k];
        $a6=$a1.$a2.$a3;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a3.'" target="b" >'.$a1.'('.$a4.')</a>';
echo $xml;
	}
	}}
function yunso17($url) {//种子搜
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.zhongziso.com/list/'.$kw.'/'.$i.'';
       $ut = f_g($ul);
preg_match_all('|<span class="glyphicon glyphicon-thumbs-up"></span>(.*)<a href="(.*)">([^>]+)<span class="highlight">([^>]+)</span>(.*)</span>|ismU',$ut,$d);
preg_match_all('|<td(.*)>(.*)<strong>([^>]+)</strong></td>(.*)<td(.*)>(.*)<strong>([^>]+)</strong></td>(.*)<td(.*)>(.*)<strong>(.*)</strong></td>(.*)<td(.*)>(.*)<a href="([^>]+)"><span class="glyphicon glyphicon-magnet"></span>(.*)</a></td>|ismU',$ut,$d2);
preg_match_all('|<span class="attr_val">([^>]+)</span>|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
        $a1=m_u($d[3][$k]);
	$a2=m_u($d[4][$k]);
	$a3=m_u($d[5][$k]);
        //$a4=m_u($d[6][$k]);
        $a5=$a1.$a2;
        $a6=$d2[3][$k];
        $a7=$d2[7][$k];
        $a8=$d2[15][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a8.'" target="b" >'.$a5.'('.$a7.')</a>';
echo $xml;
	}
	}}
function yunso18($url) {//磁力之家
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.cilihome.com/word/'.$kw.'_'.$i.'.html';
       $ut = f_g($ul);
preg_match_all('|<div class="r">(.*)<a href="/read/([^>]+).html" target="_blank" class="link">(.*)<h5 class="h">([^>]+)<span class=(.*)>([^>]+)</span>([^>]+)</h5>(.*)</a>(.*)<div>(.*)<span style="(.*)"><span(.*)class="prop_val">([^>]+)</span>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[2][$k];
	$a2=$d[4][$k];
	$a3=$d[6][$k];
        $a4=$d[7][$k];
        $a5=$d[13][$k];
        $a6=$a2.$a3.$a4;
        $b5='magnet:?xt=urn:btih:'.$a1.'';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$b5.'" target="b" >'.$a6.'('.$a5.')</a>';
echo $xml;
	}
	}}
function yunso19($url) {//人人bt
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul = 'http://www.douqucl.com/s/'.$kw.'-'.$i.'-time.html';
       $ut = f_g($ul);
preg_match_all('|<div class="item-title">(.*)<a href="http://www.douqucl.com/bt/([^>]+).html" target="_blank">([^>]+)<span class="highlight">([^>]+)</span>([^>]+)</a>|ismU',$ut,$d);
preg_match_all('|<div class="item-bar">(.*)<span>([^>]+)<b class="cpill blue-pill">([^>]+)</b> </span>(.*)<span>([^>]+)<b class="cpill yellow-pill">([^>]+)</b> </span>(.*)<span>([^>]+)<b class="cpill yellow-pill">([^>]+)</b> </span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[2][$k];
	$a2=$d[3][$k];
	$a3=$d[4][$k];
	$a4=$d[5][$k];
        $a5=$d2[3][$k];
        $a6=$d2[6][$k];
        $a7=$d2[9][$k];
        $b5='magnet:?xt=urn:btih:'.$a1.'';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$b5.'" target="b" >'.$a2.''.$a3.''.$a4.'('.$a5.')('.$a7.')</a>';
echo $xml;
	}}}


function yunso20($url) {//狼友帮
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
   if ($i == '1')  $i='1';else  $i=$i;
       $ul = 'http://www.btmeet.org/search/'.$kw.'/2-'.$i.'.html';
       $ul2 = 'http://www.fulipao.org/so/1-4-'.$kw.'-'.$i.'.html';
       $ul3 = 'http://www.btdidi.org/rss/'.$kw.'-'.$i.'.xml';
       $ut = f_g($ul3);
preg_match_all("|<title>(.*)<\/title>(.*)<link>http:\/\/www.btdidi.org\/wiki\/([^>]+).html<\/link>(.*)<description>(.*)<\/description>(.*)<pubDate>(.*)<\/pubDate>|ismU",$ut,$d);
preg_match_all("||ismU",$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=m_u($d[1][$k]);
	$a2='magnet:?xt=urn:btih:'.$d[3][$k];
	$a4=m_u($d[5][$k]);
	$a3=$d[7][$k];
        $ud=$a2;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a4.'('.$a3.')</a>';
echo $xml;
	}
	}}
function yunso21($url) {//BT磁力
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.bturls.net/search/'.$kw.'_ctime_'.$i.'.html';
       $ut = f_g($ul);
preg_match_all('|<h3 class="T1">(.*)<a(.*)href="/([^>]+).html">([^>]+)<span class="highlight">([^>]+)</span>([^>]+)</a></h3>|ismU',$ut,$d);
preg_match_all('|<dt>(.*)<span>([^>]+)</span>(.*)<span>([^>]+)</span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[3][$k];
	$a2=m_u($d[4][$k]);
	$a3=$d2[2][$k];
        $a4=$d2[4][$k];
        $a5='magnet:?xt=urn:btih:'.$a1.'';
        $a6='http://www.bturls.net/'.$a1.'.html';
        $ud=''.$a5;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a3.')('.$a4.')</a>';
echo $xml;
	}}
	}

function yunso22($url) {/*BT吧*/
  $wk= array( "电影","美剧","动作","科幻","喜剧","爱情","惊悚","恐怖","剧情","冒险","战争","古装","悬疑","情色","武侠","奇幻","历史","电视剧","动画","短片","纪录片","2016","1","2","3","4","5","6","7","8","9","10");
       $w = $_GET['w']?$_GET['w']:0; 
       $kw=k_w($w);
       $wnk1=$wk[$w];
       $wnk2=m_u($wnk1);
   if ( $w <='21') $wnk=$wnk2;else if ( $w <='31') $ul=$ul1;else if ($w == '21'||$w == '22'||$w == '23'||$w == '24'||$w == '25'||$w == '26'||$w == '27'||$w == '28'||$w == '29'||$w == '30'||$w == '31') $wnk=$wnk1;else $wnk=$kw;
       $p = $_GET['p']?$_GET['p']:2;
     for ($i = 1; $i <=$p; $i++) {
       $ul1 = 'http://www.btba.com.cn/type/'.$wnk2.'.html?page='.$i;
       $ul2 = 'http://www.btba.com.cn/search?keyword='.$kw.'&page='.$i;
       $ul3 = 'http://www.btba.com.cn/score/'.$wnk.'.html?page='.$i;
       $ul4 = 'http://www.btba.com.cn/showtime/'.$wnk.'.html?page='.$i;
    if ($w == '2016'||$w <= '2019'||$w >= '1900') $ul=$ul4;else if ( $w <='31') $ul=$ul1;else $ul=$ul2;
       $ut = f_g($ul1);
preg_match_all('|<h3>(.*)<a(.*)href="http://www.btba.com.cn/bt/([^>]+).html"(.*)>([^>]+)</a>|ismU',$ut,$d0);
preg_match_all('|<h3>(.*)<b>([^>]+)</b>(.*)</h3>|ismU',$ut,$d1);
preg_match_all('|<p><i>([^>]+)</i>(.*)<b>(.*)</b></p>|ismU',$ut,$d2);
foreach ($d0[1] as $k=>$v){
        $a1=$d0[3][$k];
	$a2=m_u($d0[5][$k]);
	$a3=$d1[2][$k];
	$a4=m_u($d2[1][$k]);
        $a5='http://www.btba.com.cn/down/'.$a1.'/1.html';
        $ut2 = f_g($a5);
preg_match_all('|location.href="([^>]+)"|ismU',$ut2,$d3);
preg_match_all("|<textarea id=\"status\" readonly>magnet:\?xt=urn:btih:([^>]+)&dn=(.*)</textarea></td></tr>|ismU",$ut2,$d4);
foreach ($d3[1] as $k2=>$v2){
        $a6=$d3[1][$k2];
        $a7=$d4[1][$k2];
        $a8='magnet:?xt=urn:btih:'.$a7;
        $vd=Current(explode('?',$v2));
        $ud=$a8;
        $ud2=$a6;
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a4.')('.$a3.')</a>';
	$xnl ='<a href="'.$ud2.'" target="b" >'.$a2.'('.$a4.')('.$a3.')</a>';
echo $xml;
	}}}
	}


function yunso23($url) {//BT大雄
       $tk= array( "kehuanpian","kehuanpian","dongzuopian","fanzuipian","xijupian","aiqingpian","xuanyipian","kongbupian","zainanpian","zhanzhengpian","donghuapian",
"maoxian","jingsong","qihuan","juqingpian","jilupian");
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $t = $_GET['t']?$_GET['t']:"0";
       $tnk=$tk[$t];
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul1 = 'https://www.xl720.com/page/'.$i.'?s='.$kw.'';
       $ul2 = 'https://www.xl720.com/category/'.$tnk.'/page/'.$i.'';
     if(t>0) {$ul=$ul2;} else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all('|<h3(.*)class="entry(.*)">(.*)<a href="([^>]+)"(.*)title="([^>]+)"|ismU',$ut,$d);
preg_match_all('|<span(.*)class="date">([^>]+)</span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[4][$k];
	$a2=$d[6][$k];
	//$a3=$d[8][$k];
        $a5=$d2[2][$k];
        $ud=yunso_23($a1);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a5.')</a>';
echo $xml;
	}}}
function yunso_23($url) {//BT大雄
       $ul = $url;
preg_match("|<a href=\"magnet:\?xt=urn:btih:([^>]+)&(.*)\"|ismU",m_v($ul),$d);
        $a1='magnet:?xt=urn:btih:'.$d[1];
return $a1;
	}
function yunso24($url) {//BT蜘蛛
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul = 'http://www.zhizhu88.com/so/'.$kw.'-first-asc-'.$i.'?f=h';
       $ut = f_g($ul);
preg_match_all('|<dt >(.*)<a href="([^>]+)">([^>]+)<span class="highlight">(.*)</a></dt>|ismU',$ut,$d);
preg_match_all('|<dd class="dsize">([^>]+)</dd>|ismU',$ut,$d1);
preg_match_all('|<dd class="dmagg">([^>]+)</dd>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1="http://www.zhizhu88.com".$d[2][$k];
	$a2=m_u($d[3][$k]);
	$a3=$d1[1][$k];
        $a4=$d2[1][$k];
        $a5=yun_24($a1);
        $ud=$a5;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a3.')('.$a4.')</a>';
echo $xml;
	}}}
function yun_23($url) {//BT蜘蛛
       $ul = $url;
       $ut = f_g($ul);
preg_match_all('|<textarea class="(.*)" style="(.*)">([^>]+)</textarea>|ismU',$ut,$d);
foreach ($d[3] as $k=>$v){
        $a1=$d[3][$k];
       return $a1; 
	}}
function yun_24($url) {//BT蜘蛛
       $ul = $url;
       $ut = f_g($ul);
preg_match('|<textarea(.*)>([^>]+)</textarea>|ismU',$ut,$d);
        $a1=$d[2];
       return $a1; 
	}
function yunso25($url) {//BT蜘蛛
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul = 'http://www.runbt.co/list/'.$kw.'/'.$i.'/time_d';
       $ut = f_g($ul);
preg_match_all('|<div class="T1">(.*)<a(.*)href="http://www.runbt.cc/detail/([^>]+)">([^>]+)<span class="mhl">(.*)</a></div>|ismU',$ut,$d);
preg_match_all('|<dl class="BotInfo">(.*)<dt>(.*)<span>([^>]+)</span>(.*)<span>(.*)</span>(.*)<span>([^>]+)</span>|ismU',$ut,$d1);
preg_match_all('|<div class="dInfo">(.*)<a href="([^>]+)">|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[3][$k];
	$a2=m_u($d[4][$k]);
	$a3=$d1[3][$k];
        $a4=$d1[7][$k];
        $a5='magnet:?xt=urn:btih:'.$a1.'';
        $ud=$a5;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a3.')('.$a4.')</a>';
echo $xml;
	}}}
function yunso26($url) {//btavas
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul = 'https://btmayi.xyz/sousuo/'.$kw.'-first-asc-'.$i.'';
       $ut = m_v($ul);
preg_match_all("|<div class=\"item-title\">(.*)<a href=\"\/detail\/([^>]+)\"(.*)>([^>]+)<\/a>|ismU",$ut,$d);
preg_match_all('|<div class="item-bar">(.*)<span>(.*)<b class="(.*)">([^>]+)</b> </span>(.*)<span>(.*)</span>(.*)<span>(.*)</span>(.*)<span>(.*)<b class="(.*)">([^>]+)</b> </span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[2][$k];
	$a2=m_u($d[4][$k]);
	$a3=$d2[4][$k];
        $a4=$d2[12][$k];
        $ud='magnet:?xt=urn:btih:'.$a1.'';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a1.'" target="b" >'.$a2.'('.$a3.')('.$a4.')</a>';
echo $xml;
	}}}
function yunso_26($url) {
       $ut = f_g($url);
preg_match('|<a id="magnetDownload" href="([^>]+)" class="btn btn-primary"(.*)>|',$ut,$d);
        $a1=$d[1];
        $ua=$a1;
       return $ua; 
	}
function yunso28($url) {
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) { 
       $ul = 'http://www.fulicilian.com/search/'.$kw.'/?c=video&s=create_time&p='.$i.'/';
       $ut = m_v($ul);
preg_match_all('|<td class="x-item">(.*)<a title="([^>]+)" class="title" href="/info/([^>]+)">(.*)</a>(.*)<div class="tail">([^>]+)</div>|ismU',$ut,$d1);
foreach ($d1[1] as $k=>$v){
	$a1=m_u($d1[2][$k]);
	$a2=$d1[3][$k];
        $a3=m_u($d1[6][$k]);
        $a5='http://www.fulicilian.com/api/json_info?hashes='.$a2.'';
        $ut2 = m_v($a5);
preg_match('|"info_hash": "([^>]+)"|U',$ut2,$d2);
        $aa = $d2[1];
        $ud='magnet:?xt=urn:btih:'.$aa.'';
        //$vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a1.'('.$a3.')</a>';
echo $xml;
	}}}
function yunso30($url) {//磁力王
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.btup.net/s/'.$w.'/'.$i.'/';
       $ul2 = 'https://www.ciliwang.club/search?keyword='.$kw.'&sort=hot&mode=1&page='.$i.'';
       $ut = J_d(m_v($ul2),True);
       $aa = $ut["data"]["data"];
 for ($ii = 1; $ii < count($aa); $ii++) {   
       $a0 = $aa[$ii];
       $a1 = $a0["name"];
       $a2 = $a0["id"];
       $a3 = $a0["time"];
       $a4 = $a0["hot"];
       $a5 = $a0["uri"];
       $a6 = $a0["file_size"];
        $a7=m_u($a1);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a5.'" target="b" >'.$a7.'('.$a6.')('.$a3.')('.$a4.')</a>';
echo $xml;
	}
	}}
function wbso($url) {//微博搜
       $ww = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://vdisk.weibo.com/search/?type=&sortby=default&keyword='.$kw.'&filetype=&page='.$i.'';
       $ut = m_v($ul);
preg_match_all('|<div class="sort_name_detail"><a href="([^>]+)" target="_blank" title="([^>]+)">(.*)<div class="sort_name_time clearfix"><span>([^>]+)</span>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
	$a2=$d[2][$k];
        $a3=$d[4][$k];
       $ut2 = m_v($a1);
preg_match_all("|\"download_list\":\[\"([^>]+)\"\],|ismU",$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
        $a5=$d2[1][$k2];
        $a6=x_g($a5);
        $vd=Current(explode('?',$v2));
	$xml ='<a href="'.$a6.'" target="b" >'.$a2.'('.$a3.')</a></br>';
echo $xml;
	}}
	}}
function bdyso($url) {//百度云
       $w=$_GET['w']; 
   if ($w == '')  $w=m_u('请填写网盘地址');else  $w=$w;
       $ul1 = 'http://jx.zz3456.com/baidu.php?url='.$w.'';
       $ul2 = 'http://cloudkey.aliapp.com/dushare/?url='.$w.'';
       $ul3 = 'http://bojuessc.com/wp.php?url='.$w.'';
       $ul4 = 'http://jx.zz3456.com/yunpan.php?url='.$w.'';
       $ul5 = 'http://jx.zz3456.com/sina.php?url='.$w.'';
       $ul6 = 'http://jx.hlhd.cn/baidu.php?url='.$w.'';
       $ul7 = g_h($ul1);
       $ud=f_g($ul7);
preg_match('|(.*)|i',$ud,$d);
        $a2=$d[0];
       //header("location:$a2");
	$xml ='<a href="'.$a2.'" target="_blank" >'.$w.'</a></br>';
echo $xml;
	}
function bdyunso2($url) {//百度云搜索
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       $ul = 'http://so.ygyhg.com/s?keyword='.$kw.'&t=0&o=0&page='.$p.'';
       $ut=f_g(g_h($ul));
preg_match_all('|<a class="bd-title" href="([^>]+)"(.*)>([^>]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
	$a2=$d[3][$k];
	$a3=m_u('下载地址 :');
       $ud2=m_v($a1);
preg_match_all('|<div>'.$a3.'<a href="([^>]+)"(.*)>(.*)</a> </div>|ismU',$ud2,$d2);
preg_match_all('|<li>([^>]+)<span style="(.*)">([^>]+)</span></li>|ismU',$ud2,$d3);
preg_match_all("|window.open\(\"([^>]+)\"\);|ismU",$ud2,$d4);
preg_match_all('|<span class="label label-warning label-daren"><b>([^>]+)</b></span>|ismU',$ud2,$d5);
foreach ($d2[1] as $k2=>$v2){
        $a4=$d2[1][$k2];
        $a5=$d3[1][$k2];
        $a6=$d3[3][$k2];
        $a7=$d4[1][$k2];
        $a8=$d5[1][$k2];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a7.'" target="_blank" >'.$a8.'('.$a5.')</a></br>';
echo $xml;
	}}}
function bdyunso($url) {//百度云搜索2
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
        $p1 = $p-1;
       for ($i = 0; $i <=$p1; $i++) { 
       $p2 = $i*10;
       $ul = 'http://api1227.pansou.com/uds/GwebSearch?callback=google.search.WebSearch.RawCompletion&rsz=filtered_cse&hl=zh_CN&source=gsc&gss=.com&sig=432dd570d1a386253361f581254f9ca1&cx=002349702754071923830:gks5b3h5cho&safe=off&filter=0&qid=153cc90eb327c53d2&context='.$i.'&key=notsupplied&v=1.0&nocache=1&start='.$p2.'&q='.$kw.'';
       $ul2 = 'http://api1227.pansou.com/search?hl=zh-HK&as_q='.$kw.'&as_epq=&as_oq=&as_eq=&as_nlo=&as_nhi=&lr=&cr=&as_qdr=all&as_sitesearch=yun.baidu.com&as_occt=&safe=images&as_filetype=&as_rights=';
       $ul3 = 'http://api1227.pansou.com/search?q='.$kw.'+site:yun.baidu.com&lr=&safe=off&hl=zh-HK&as_rights=&tbs=qdr:m,sbd:1&prmd=ivns&source=lnt&start='.$p2.'&sa=X&ved=0ahUKEwj0ipeqo4XMAhUBOJQKHWw7AuMQpwUIDg';
       $ut=f_g(g_h($ul));
preg_match_all("|\"url\":\"(.*)uk%3D([^>]+)\",\"visibleUrl\":\"([^>]+)\",\"cacheUrl\":\"([^>]+)\",\"title\":\"([^>]+)\",|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[2][$k];
	$a2=r_u($d[5][$k]);
        $a3='http://yun.baidu.com/share/home?uk='.$a1.'&view=share#category/type=0';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a3.'" target="_blank" >'.$a2.'</a></br>';
echo $xml;
	}}}
function s0so($url) {//资源
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"
,"32","33","34","35","36");
       $tk= array("www.okzyw.com");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $a = $_GET['a']?$_GET['a']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $kw=k_w($w);
       $w1nk = $w1k[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
       $ul = 'https://'.$tnk.'/index.php?m=vod-search-pg-'.$i.'-wd-'.$kw.'.html';
       $ut = m_v($ul);
preg_match_all("|<a(.*)href=\"\/\?m=vod-detail-id-([^>]+).html\"(.*)>([^>]+)<\/a>(.*)<span class=\"xing_vb6\">([^>]+)<\/span>|ismU",$ut,$d);
foreach ($d[2] as $k=>$v){
       $a2 = $d[2][$k];
       $a3 = m_u($d[4][$k]);
       $a5 = $d[7][$k];
       $ud = 'http://'.$tnk.'/?m=vod-detail-id-'.$a2.'.html';
       $xsso='xsso0';
    $xml ='<a href="'.$fname.'?&'.$xsso.'='.$ud.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function s1so($url) {
       $wk= array("1","2","3","4","5","6","7","8","9","10");
       $w = $_GET['w']?$_GET['w']:"科幻";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $kw=k_w($w);
    for($i=1;$i<=$p;$i++){
       $ul = 'http://www.mphj.com/vod-search-wd-'.$kw.'-p-'.$i.'.html';
       $ut = m_v($ul);
preg_match_all('|<a(.*)href="/vod/([^>]+).html">([^>]+)</a>(.*)</h3>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = 'http://www.mphj.com/v/'.$d[2][$k].'-1-1.html';
       $a3 = m_u($d[3][$k]);
    $xml ='<a href="'.$fname.'?&xsso1='.$a2.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function yunjx($url) {//百度云
       $w=$_GET['w']; 
   if ($w == '')  $w='magnet:?xt=urn:btih:b5c97e0dac851252bec3c52e03e955ba27d0f35c';else  $w=$w;
       $ul1 = 'http://xiayifa.com/player.php?url='.$w.'';
       $ul2 = 'http://cloudkey.aliapp.com/dushare/?url='.$w.'';
       $ud = f_g($ul1);
preg_match_all("|<video controls=\"controls\" src='(.*)'(.*)>|ismU",$ud,$d);
foreach ($d[1] as $k=>$v){
        $a2=$d[1][$k];
        $a3='../ck.php?a=tv&f='.$a2.'';
        $a4 = '../ck.php?a='.$a.'&f='.$a2.'';
	$a5=m_u('播放');
       //header("location:$a2");
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a3.'" target="_blank" >'.$a5.'</a></br>';
echo $xml;
	}}
function wbso2($url) {//微博搜
       $w = $_GET['w']?$_GET['w']:date("d");  
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://vdisk.weibo.com/search/?type=&sortby=default&keyword='.$kw.'&filetype=&page='.$i.'';
       $ut = m_v($ul);
preg_match_all('|<div class="sort_name_detail"><a href="([^>]+)" target="_blank" title="([^>]+)">(.*)<div class="sort_name_time clearfix"><span>([^>]+)</span>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a1=$d[1][$k];
	$a2=$d[2][$k];
        $a3=$d[4][$k];
       $ut2 = m_v($a1);
preg_match_all("|\"download_list\":\[\"([^>]+)\"\],|ismU",$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
        $a5=$d2[1][$k2];
        $a6=x_g($a5);
        $vd=Current(explode('?',$v2));
	$xml ='<a href="'.$a6.'" target="b" >'.$a2.'('.$a3.')</a></br>';
echo $xml;
	}}
	}}
if(isset ($_GET['s'])) {
       $xml = "";
       $s = $_GET['s']?$_GET['s']:"skso";
       $xml= $s($xml);
echo $xml;
 }
elseif(isset ($_GET['xsso0'])){
set_time_limit(0);
       $a2 = $_GET['xsso0'];
       $tnk = $_GET['tnk'];
       $wnk = $_GET['wnk'];
preg_match_all("|<input type=\"checkbox\" name=\"copy_sel\" value=\"([^>]+)index.m3u8\"(.*)\/>([^>]+)<\/li>|ismU",m_v($a2),$d);
foreach ($d[1] as $k=>$v){
       $a8 = $d[1][$k].'index.m3u8';
       $a3 = $d[3][$k];
       $b9 = strpos($a8,'$');
   if($b9 === false ) $a11=$a8; else{
       $a10=strstr($a8,'$');
       $a11=substr($a8,strripos($a8,"$")+1);}
  if(stripos($a11,'share') !== false) {
       $ud = $a11;
}else{  
       $ud = '../w.htm?u=0&f='.$a11; 
}
echo header("Location: $ud");   
} } 
elseif(isset ($_GET['xsso1'])){
set_time_limit(0);
       $a2 = $_GET['xsso1'];
       $tnk = $_GET['tnk'];
preg_match('|<iframe src="//([^>]+)=([^>]+)"|U',m_v($a2),$d);
       $a1 = $d[2]; 
       $ud = '../t.htm?u=0&f='.$a1;
echo header("Location: $ud");
}
elseif(isset ($_GET['qq_so'])){
       $ul= $_GET['qq_so'];
preg_match("#btnPlayUrl: '([^>]+)',#U",m_v($ul),$b);
       $a2 = $b[1];
       $ud = '../t.htm?u=0&f='.$a2;
echo header("Location: $ud");
}
elseif(isset ($_GET['sgm_so2'])){
set_time_limit(0);
        $url = $_GET['sgm_so'];
        $nd = m_d($url);
        $nd = m_d($nd);
        //$ud =  '../v.htm?u=&f='.$nd;
 echo header("Location: $nd"); 
}
elseif(isset ($_GET['sgm_so'])){
set_time_limit(0);
        $url = $_GET['sgm_so'];
echo $url;
}
elseif(isset ($_GET['hsovid'])){
       $ul= $_GET['hsovid'];
       $ut= 'https://api.web.360kan.com/v1/detail?cat=1&id='.$ul.'&callback=';
       $nt = m_v($ut);
preg_match_all('|"default_url":"([^>]+)"(.*)"site":"([^>]+)"|ismU',$nt,$d);
foreach ($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d[3][$k];
        $ud =  '../v.htm?f='.$a2;
       $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
//echo header("Location: $ud");
}}
elseif(isset ($_GET['sgsovidu'])){
       $ul= $_GET['sgsovidu'];
       $ul2 = 'https://v.sogou.com/api/video/shortVideo?query='.$ul.'&page=1&pagesize=50&sort_type=&duration=&publish=&hd=';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["titleEsc"];
       $a2 = $a0["url"];
       $a3 = $a0["date"];
       $a4 = $a0["duration"];
        $ua2 =  'https://v.sogou.com'.$a2;
//if(stripos($ua1,'http') !== false) $ua3 = $ua1;else $ua3=$ua2;
        $ud =  '../v.htm?f='.$ua2;
        //$ud =  '../v.htm?f='.g_h($ua2);
       $xml ='<a href="'.$ud.'" target="b" >'.$a1.'  ('.$a3.')('.$a4.') </a>';
echo xml;
//echo header("Location: $ud");
}}
elseif(isset ($_GET['sgsovid'])){
       $ul= $_GET['sgsovid'];
   preg_match("#\"ourl\":\"([^<]+)\"#ismU",m_v($ul),$b);
        $ua1 =  r_u(b_d3($b[1]));
        $ua2 =  'https://v.sogou.com'.$ua1;
//if(stripos($ua1,'http') !== false) $ua3 = $ua1;else $ua3=$ua2;
        $ud =  '../v.htm?f='.$ua1;
        //$ud =  '../v.htm?f='.g_h($ua2);
echo header("Location: $ud");
}
elseif(isset ($_GET['sgsovids'])){
       $url= $_GET['sgsovids'];
       $name= $_GET['name'];
       $ut = m_v($url);
preg_match_all('|<li><a(.*)href="([^>]+)"(.*)data-uigs="(.*)"(.*)class="source-lst-tab"><(.*)>(.*)<(.*)>([^>]+)</a></li|ismU',$ut,$d);
foreach ($d[2] as $k=>$v){
        $a2 =  'https://v.sogou.com'.$d[2][$k];
        $a4 = r_u(b_d3($a2));
        $a3 =  $d[9][$k];
        $ud =  '../v.htm?f='.g_h($a4);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b">'.$name.'('.$a3.')</a>';
echo $xml;
}}
elseif(isset ($_GET['sg_so'])){
        $ul= $_GET['sg_so'];
        $ua =  m_t($ul);
        $ud =  '../v.htm?f='.$ua;
echo header("Location: $ud");
}
elseif(isset ($_GET['cn_vd'])){
       $ul= $_GET['cn_vd'];
       //$w = $_GET['w']?$_GET['w']:"http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid=acc4892b26974f05888054f85ceab5e5";
preg_match('|var guid = "([^<]+)"|ismU',m_v($ul),$d0);
        $a3='http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid='.$d0[1];
preg_match('|"hls_url":"([^<]+)"|ismU',m_v($a3),$d2);
        $ua=$d2[1];
        $ud =  '../t.htm?u&f='.$ua;
echo header("Location: $ud");
}
elseif(isset ($_GET['clmso'])){
       $p = $_GET['p']?$_GET['p']:1;
       $p1= $p*20;
       $clmso =$_GET['clmso'];
       $vtime =$_GET['vtime'];
       $ul = 'https://search.cctv.com/ifsearch.php?page=1&qtext='.$clmso.'&sort=date&pageSize=40&type=video&vtime='.$vtime.'&datepid=1&channel=%E4%B8%8D%E9%99%90&pageflag=0&qtext_str='.$clmso.'';
 preg_match("#\"list\":\[\{(.*)\}\],\"flag\"#U",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $aa = J_d($ut,ture);
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a4 = $a0["id"];
       $a5 = r_u($a0["all_title"]);
       $a6 =  x_g($a0["urllink"]);
       $a8 = t_d($a0["durations"]);
       $a7 = $a0["uploadtime"];
       $ua =  $a6;
       $ua2 =  cn_vd($a6);
       $ud3 = '../ck/ck.php?f='.$ua2;
       $xml ='<a href="'.$ud3.'" target="b" >'.$a5.' ('.$a7.') ('.$a8.')</a>';
echo $xml;
}}
?>






