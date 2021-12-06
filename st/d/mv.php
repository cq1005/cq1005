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
function get_u($url){ //抓取跳转地址
      $header = array("Referer: http://www.baidu.com/"); 
      $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL, $url); 
      curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
      curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //能無法 抓取跳轉后的頁面
      ob_start(); 
      curl_exec($ch); 
      $contents = ob_get_contents(); 
      ob_end_clean(); 
      curl_close($ch); 
      return $contents; 
      }
function isPost() {
return $_SERVER['REQUEST_METHOD'] == 'POST'?1:0;
} 
function sss($url) {
       $t = $_GET['t']?$_GET['t']:dtime();
       $u = $_GET['u']?$_GET['u']:0;
       $wk= array('https://www.fx678.cn/kx/column?column=important','https://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$t,'https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid=2856&pnum=1&psize=100&callback=GetHistory','https://c.open.163.com/open/pc/v2/search/searchCourse.do?keyword=&pageNum=1&pSize=20');
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
function b_e($url) {  return base64_encode($url); }
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
function h_v($url) {  $header = get_headers($url); return str_replace("Location: ","",$header[6]); }
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
$hd=isset($hd)?$hd:0;
$hdr=array('flv','mp4','hd2','hd3');
$hd=$hdr[$hd];
function get_url($url) {
    $redirect_url = null; 
    $url_parts = @parse_url($url);
    if (!$url_parts) return false;
    if (!isset($url_parts['host'])) return false;
    if (!isset($url_parts['path'])) $url_parts['path'] = '/';
    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
    if (!$sock) return false;
    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n"; 
    $request .= 'Host: ' . $url_parts['host'] . "\r\n"; 
    $request .= "Connection: Close\r\n\r\n"; 
    fwrite($sock, $request);
    $response = '';
    while(!feof($sock)) $response .= fread($sock, 8192);
    fclose($sock);
    if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
        if ( substr($matches[1], 0, 1) == "/" )
            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
        else
            return trim($matches[1]);
    } else {
        return false;
    }
}  
function n360dy($url,$a) {
       $tk= array("1","2","3","4");
       $w = $_GET['w']?$_GET['w']:0;
$w1k= array("","科幻","战争","悬疑","历史","犯罪","喜剧","爱情","动作","恐怖","剧情","奇幻","动画","文艺","纪录","传记","歌舞","古装","惊悚","伦理");
$w2k= array("","悬疑","古装","都市","军事","警匪","谍战","科幻","言情","剧情","伦理","喜剧","偶像","历史","励志","神话","青春","家庭","动作","情景","武侠");
$w3k= array("","纪实","科教","曲艺","访谈","音乐","脱口秀","真人秀","搞笑","选秀","八卦","情感","生活","晚会","职场","美食","时尚","游戏","少儿","体育","歌舞","财经","汽车","播报");
$w4k= array("","热血","科幻","美少女","魔幻","经典","励志","少儿","冒险","搞笑","推理","恋爱","治愈","幻想","校园","动物","机战","悬疑","怪物","战争","益智","青春","竞技","动作","社会","友情","真人版","电影版","OVA版");
       $t = $_GET['t']?$_GET['t']:'0';
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
  if($t<=3) $t=$t;else $t=0;
       $tnk=$tk[$t];
if($t==1) {
       $wnk=k_w($w2k[$w]);
}else if($t==2) {
       $wnk=k_w($w3k[$w]);
}else if($t==3) {
       $wnk=k_w($w4k[$w]);
}else {
       $wnk=k_w($w1k[$w]);
}
       $kw=k_w($w); 
    for($i=1;$i<=$p;$i++){
	$ul1 = 'http://www.360kan.com/'.$wnk.'/list.php?pageno='.$i.'&cat='.$tnk.'&year=all&area=all&act=all';
	$ul2 = 'http://www.360kan.com/'.$wnk.'/list?rank=rankhot&cat='.$tnk.'&area=all&act=all&year=all&pageno='.$i.'';
	$ul3 = 'http://www.360kan.com/gene/mlist.php?kw='.$kw.'&pageno='.$i.'';
if($t==3) {
	$ul4 = 'https://api.web.360kan.com/v1/filter/list?catid='.$tnk.'&rank=rankhot&cat='.$wnk.'&year=&area=&act=&size=35&pageno='.$i.'&callback=';
}else {
	$ul4 = 'https://api.web.360kan.com/v1/filter/list?catid='.$tnk.'&rank=ranklatest&cat='.$wnk.'&year=&area=&act=&size=35&pageno='.$i.'&callback=';
}

        $ul='';
        $ut = m_v($ul4);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["movies"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
if($t==2){
       $a2 = $a0["playlink_sites"][0];
       $a41 = t_m($a0["lastpubline"]);
       $a5 = $a0["lasttitle"];
       $a4 = $a0["tag"];
       $a6 = $a0["tvstation"][0];
}else {
       $a2 = $a0["playlink_sites"][0];
       $a3 = $a0["playlinks"][$a2];
       $a4 = $a0["pubdate"];
       $a5 = $a0["title"];
       $a6 = $a0["upinfo"];
       //$ua =  'https://www.360kan.com/m/'.$a1.'.html'; 
       $ua =  '../t.htm?f='.$a3;
} 
       $dd360="";
if($t==1){$dd360 = "dsj360";}else if($t==2) {$dd360 = "zy360";}else if($t==3) {$dd360 = "dm360";}else {$dd360 = "dy360";}
if($t==0){
       //$xml ='<a href="'.$fname.'?&'.$dd360.'='.$a1.'&rst='.$a2.'&cat='.$tnk.'" target="b">'.$a5.' ('.$a2.') ('.$a4.')</a>';
        $xml ='<a href="'.$ua.'"  target="b" >'.$a5.' ('.$a2.') ('.$a4.')</a>';
}else{
       $xml ='<a href="'.$fname.'?&'.$dd360.'='.$a1.'&rst='.$a2.'&cat='.$tnk.'&name='.$a5.'&up='.$a6.'" target="b1">'.$a5.' ('.$a2.') ('.$a4.')('.$a6.')</a>';
}
echo $xml;
}}} 
function cn_lm($wnk) {
       $w1nk= array("huanqiushixian"=>"huanqiushixian","huanqiujizhelianxian"=>"huanqiujizhelianxian","haixialiangan"=>"haixialiangan","xinwendiaocha"=>"xinwendiaocha",
"shijiezhoukan"=>"shijiezhoukan","xinwenyijiayi"=>"xinwenyijiayi","shenduguoji"=>"shenduguoji","jinriguanzhu"=>"jinriguanzhu","mianduimian"=>"mianduimian",
"guobaodangan"=>"guobaodangan","xinlifangtan"=>"xinlifangtan","meizhouzhiliangbaogao"=>"meizhouzhiliangbaogao","caifuhaojihua"=>"caifuhaojihua",
"baijiajiangtan"=>"baijiajiangtan","jiaodianfangtan"=>"jiaodianfangtan","lvseshikong"=>"lvseshikong","jingjibanxiaoshi"=>"jingjibanxiaoshi",
"jingjixinxilianbo"=>"jingjixinxilianbo","huanqiucaijinglianxian"=>"huanqiucaijinglianxian","shichangfenxishi"=>"shichangfenxishi",
"zoujinkexue"=>"zoujinkexue","kejirensheng"=>"kejirensheng","kejizhiguang"=>"kejizhiguang","ziranchuanqi"=>"ziranchuanqi","renwu"=>"renwu",
"daodeguancha"=>"daodeguancha","fangwuxinguancha"=>"fangwuxinguancha");
       $w1k1= array("huanqiushixian","huanqiujizhelianxian","haixialiangan","xinwendiaocha","shijiezhoukan","xinwenyijiayi","shenduguoji","jinriguanzhu","mianduimian",
"guobaodangan","xinlifangtan","meizhouzhiliangbaogao","caifuhaojihua","baijiajiangtan","jiaodianfangtan","lvseshikong","jingjibanxiaoshi",
"jingjixinxilianbo","huanqiucaijinglianxian","shichangfenxishi","zoujinkexue","kejirensheng","kejizhiguang","ziranchuanqi","renwu","daodeguancha",
"fangwuxinguancha");
       $w2nk= array("huanqiushixian"=>"hqsx","huanqiujizhelianxian"=>"hqjzlx","haixialiangan"=>"hxla","xinwendiaocha"=>"xwdc",
"shijiezhoukan"=>"sjzk","xinwenyijiayi"=>"xwyjy","shenduguoji"=>"sdgj","jinriguanzhu"=>"jrgz","mianduimian"=>"mdm",
"guobaodangan"=>"gbda","xinlifangtan"=>"xlft","meizhouzhiliangbaogao"=>"mzzlbg","caifuhaojihua"=>"cfhjh",
"baijiajiangtan"=>"bjjt","jiaodianfangtan"=>"jdft","lvseshikong"=>"lssk","jingjibanxiaoshi"=>"jjbxs",
"jingjixinxilianbo"=>"jjxxlb","huanqiucaijinglianxian"=>"hqcjlx","shichangfenxishi"=>"scfxs","zoujinkexue"=>"zjkx",
"kejirensheng"=>"kjrs","kejizhiguang"=>"kjzg","ziranchuanqi"=>"zrcq","renwu"=>"rw","daodeguancha"=>"ddgc",
"fangwuxinguancha"=>"fwxgc");
       $w2k2= array("huanqiushixian","huanqiujizhelianxian","haixialiangan","xinwendiaocha","shijiezhoukan","xinwenyijiayi","shenduguoji","jinriguanzhu","mianduimian",
"guobaodangan","xinlifangtan","meizhouzhiliangbaogao","caifuhaojihua","baijiajiangtan","jiaodianfangtan","lvseshikong","jingjibanxiaoshi",
"jingjixinxilianbo","huanqiucaijinglianxian","shichangfenxishi","zoujinkexue","kejirensheng","kejizhiguang","ziranchuanqi","renwu","daodeguancha",
"fangwuxinguancha");
       $w = $_GET['w']?$_GET['w']:'0';
       $u = $_GET['u']?$_GET['u']:0;
       $w1mk=$w1k1[$w]; 
       $wmk1=$w1nk[$w1mk];
       $w2mk=$w2k2[$w]; 
       $wmk2=$w2nk[$w2mk];
   if( $u=='1') $wnk=$wmk1;else $wnk=$wmk2;
      return $wnk;
}
function cn_vid($url) {
       //$w = $_GET['w']?$_GET['w']:$url;
       $ut = f_g($url);
preg_match('|"videoId", "([^<]+)"|ism',$ut,$d1);
preg_match('|"videoCenterId","([^<]+)"|ism',$ut,$d2);
//foreach ($d[1] as $k=>$v){}
        $a2=$d1[1];
        $a3=$d2[1];
      return $a3;
}
function cn_lmv($url) {
       $p = $_GET['p']?$_GET['p']:12;
    for($ii=1;$ii<=$p;$ii++){
       $ul = 'http://api.cntv.cn/lanmu/columnSearch?p='.$ii.'&n=20&serviceId=tvcctv&t=jsonp&cb=Callback';
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
       //$a5 = $a0["lastVIDE"];
       //$a6 = $a0["videoId"];
       //$a7 = $a0["videoSharedCode"];
       $xml ='<a>'.$a2.'--'.$a4.'</a>';
echo $xml;
//return $a3;
}}}
function clmv($url) {
       $w = $_GET['w']?$_GET['w']:'';
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:12;
    for($i=1;$i<=$p;$i++){
       $ul1 = 'https://api.cntv.cn/lanmu/columnSearch?&fl=&fc=&cid=&p='.$i.'&n=20&serviceId=tvcctv&t=jsonp&cb=Callback';
       $ul2 = 'http://api.cntv.cn/lanmu/columnSearch?p='.$i.'&n=20&serviceId=tvcctv&t=jsonp&cb=Callback';
       $ut = m_v($ul2);
 preg_match_all('#"column_name":"([^<]+)",#ismU',$ut,$b);
 foreach($b[1] as $k=>$v){
       $a5 = m_u($b[1][$k]);
       $xml ='<a>'.$a5.'</a>';
echo $xml;
}}}
function cnlmv($url) {
       $w = $_GET['w']?$_GET['w']:'huanqiushixian';
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:20;
       $wnk=cn_lm($w);
       $ul1 = 'http://cctv.cntv.cn/lm/'.$wnk.'/';
       $ul3 = 'https://search.cctv.com/m/if3g_search.php?page=1&qtext='.$wnk.'&type=video&sort=SCORE&pageSize='.$p.'&channel=';
       $ul4 = 'http://api.cntv.cn/lanmu/columnSearch?p=1&n=10&serviceId=tvcctv&t=jsonp&cb=Callback';
       $ul2 = 'http://tv.cctv.com/lm/'.$wnk.'/videoset/index.shtml';
   if( $u=='1') $ul=$ul1;else $ul=$ul2;
       $ut = f_g($ul);
 preg_match_all('#<div class="text">(.*)<a href="([^<]+)"(.*)>([^<]+)<#ismU',$ut,$b);
 preg_match_all('#<span class="strg">(.*)</span>#ismU',$ut,$b2);
 foreach($b[1] as $k=>$v){
       $a4 = $b[2][$k];
       $a5 = m_u($b[4][$k]);
       $ua =  $a4;
       $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
function cnlmmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y").date("m").date("d"); 
       $tk= array( "-1","0","1","2","3","4");
       $t = $_GET['t']?$_GET['t']:"0";
       $tnk=$tk[$t];
       $p = $_GET['p']?$_GET['p']:5;
    for($ii=1;$ii<=$p;$ii++){
       $ul = 'http://api.cntv.cn/lanmu/columnSearch?p='.$ii.'&n=100&serviceId=tvcctv&t=jsonp&cb=Callback';
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
       //$a5 = $a0["lastVIDE"];
       //$a6 = $a0["videoId"];
       //$a7 = $a0["videoSharedCode"];
       //$xml2 ='<a>'.$a2.'--'.$a4.'</a>';
       $kw = k_w( $a2 );
       //$xul = 'https://search.cctv.com/ifsearch.php?page=1&qtext='.$a2.'&sort=date&pageSize=20&type=video&vtime='.$tnk.'&datepid=1&channel=%E4%B8%8D%E9%99%90&pageflag=0&qtext_str='.$a2.'';
       $xml ='<a href="'.$fname.'?&clm='.$kw.'&vtime='.$tnk.'" >'.$a2.'</a>';
echo $xml;
}}}
function cnjmv($url) {
       $w1k= array(""=>"humhis","humhis"=>"humhis","military"=>"military","explore"=>"explore","social"=>"social","Nature"=>"Nature","other"=>"other");
       $cnk= array("CN02","CN03","CN04","CN05","CN06","CN07","CN08","CN09","CN10","CN95","CN96");
       $w = $_GET['w']?$_GET['w']:'C11269';
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $w1nk=$w1k[$w];
       $wnk='';
   if( $w==$w1nk) $wnk=$w1nk;else $wnk=$w;
    for($i=1;$i<=$p;++$i){
       $ul1 = 'http://tv.cntv.cn/videoset/'.$wnk.'/page/'.$i.'';
       $ul2 = 'http://tv.cntv.cn/videoset/search?type=CN02';
       $ul3 = 'http://jishi.cntv.cn/doc/list/lx/explore/index.shtml';
       $ul4 = 'http://search.cctv.com/search.php?&type=video&page=1&datepid=3&vtime=1&qtext='.$w;
   if( $w==$w1nk) $ul=$ul3;else $ul=$ul1;
       $ut = f_g($ul);
 preg_match_all('#<h3><a href="([^<]+)"(.*)>([^<]+)</a>#ismU',$ut,$d);
 foreach($d[1] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = 'http://tv.cntv.cn'.$a3;
       $a5 = m_u($d[3][$k]);
       $ua =  $a4;
       $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $fn = ''.$fname.'?&cnlx='.$a4.'&w='.$wnk.'&name='.$a5.'';
   //if( $u=='3') $ud=$ud3;else $ud=$ud;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}

function cnxmv($url) {
       $wk= array(""=>"humhis","humhis"=>"humhis","military"=>"military","explore"=>"explore","social"=>"social","Nature"=>"Nature","other"=>"other");
       $w = $_GET['w']?$_GET['w']:humhis;
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $ul = 'http://jishi.cntv.cn/doc/list/lx/explore/index.shtml';
       $ur = f_g($ul);
 preg_match_all('#<h3><a href="([^<]+)"(.*)>([^<]+)</a>#ismU',$ut,$d);
  foreach($d[1] as $k=>$v){
       $a4 = m_u($d[3][$k]);
       $a5 = $d[1][$k];
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a5.'" >'.$a5.'</a>'."\n";
    //$xml ='<a href="'.$fname.'?&cnlx='.$a5.'&w='.$wnk.'&name='.$a4.'" >'.$a4.'</a>'."\n";
   echo $xml;
}}
function cnnmv($url) {
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $w=$_GET['w'];
   if ($w == '')  $w='video';else  if ($w == '1')  $w='video';else  if ($w == '2')  $w='yuanchuang';else  $w=$_GET["w"];
       $ul = 'http://news.cctv.com/'.$w.'/data/index.json';
       $ul2 = 'http://news.cctv.com/yuanchuang/data/index.json';
       $ur2 = f_g($ul);
  preg_match_all('#"title":"([^>]+)"(.*)"dateTime":"([^>]+)","url":"([^>]+)"#ismU',$ur2,$d);
  foreach($d[1] as $k=>$v){
       $a3 = r_u($d[1][$k]);
       $a4 = $d[3][$k];
       $a5 = $d[4][$k];
       $ua =  $a5;
       $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $ud3 = '../ap.php?f=http://localhost/ck/php/v/cnv.php?ap='.$ua;
   if( $u=='3') $ud=$ud3;else $ud=$ud;
        $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'"  target = "b">'.$a3.'('.$a4.')</a>'."\n";
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
function ledy4($url) {
       $wk= array("1","1","2","11","9","5","22","16","30","1009","1035");
       $t1k= array("-1","30020","30008","30009","30010","30011","30012","30013","30014","30015","30016","30017","30018","30019","30021","30022","30024","30026",
"30027","30153","30043");
       $t2k= array("-1","30024","30009","30017","30014","30022","30320","30039","30042","30020","30044","30318","31367","30011","30015","30054","30280","31368",
"31369","31370","540033");
       $t3k= array("-1","30046","30083","30075","300057","30065","30072","30045","30082","30167","30069","30284","30290","30291","30327","30370","30371","30372",
"30373","30374","30375","30376","30119","30275","30071","30323");
       $t4k = array("-1","542171","542172","542173","542174","542175","542170","542001");
       $t5k = array("-1","30261","30050","30019","30054","300274","30270","30271","30272","30265","30017","30057","30063","30088","30282","30266","30273","30015","30269",
"30039","30056","30020","30264","30278","30055","30089","30279","30280","30045","30275","30051","30052","30059","30058","30354","30010","30053","30060","30061","542087");
       $t6k = array("-1","530001","530002","530003","530004","5300015","530006");
       $t7k = array("-1","30112","30113","30114","30115","30116","30117","30014","30119","30153","30121","30122","30018","30124","30125","30126","30127","30128",
"30069","30130","30131","100000");
       $t8k = array("-1","592001","592002","592003","592004","5920015","592006");
       $t9k = array("-1","532001","532002","532003","532004","5320015","532006");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $tnk= '';
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
       $t5nk=$t5k[$t];
       $t6nk=$t6k[$t];
       $t7nk=$t7k[$t];
       $t8nk=$t8k[$t];
       $t9nk=$t9k[$t];
    if($wnk==1) $tnk=$t1nk;else if($wnk==2) $tnk=$t2nk;else if($wnk==11) $tnk=$t3nk;else if($wnk==9) $tnk=$t4nk;else if($wnk==5) $tnk=$t5nk;
else if($wnk==22) $tnk=$t6nk;else if($wnk==16) $tnk=$t7nk;else if($wnk==30) $tnk=$t8nk;else if($wnk==1009) $tnk=$t9nk;else if($wnk==1035) $tnk=$t1nk;
else $tnk=$t1nk;
    if($tnk==null) $tnk='-1';else $tnk=$tnk;
    for($i=1;$i<=$p;$i++){
       $url1 = 'http://list.letv.com/listn/c'.$wnk.'_t'.$tnk.'_a_y_s_lg_ph'.$u.'_md_o4_d_p'.$i.'.html';
       $url2 = 'http://list.letv.com/listn/c'.$wnk.'_t'.$tnk.'_a-1_y-1_s1_lg-1_ph'.$u.'_md_o1_d1_p'.$i.'.html';
       $url3 ='http://list.letv.com/listn/c'.$wnk.'_t'.$tnk.'_vt-1_md_o1_d2_p'.$i.'.html';
       $url4 = 'http://list.letv.com/listn/c'.$wnk.'_t'.$tnk.'_a_y_s_lg_ph'.$u.'_md_o20_d_p'.$i.'.html';
       $url5 = 'http://list.letv.com/listn/c'.$wnk.'_sc'.$tnk.'_d2_p'.$i.'_o1.html';
   if ($wnk == '2') $url=$url4;else if($wnk == '22') $url=$url3;else if($wnk == '3') $url=$url2;else if($wnk == '16') $url=$url2;else if($wnk == '1009') $url=$url5;else  $url=$url1;
        $ul = m_v($url);
preg_match_all('|<p class="p_t"><a(.*)href="(.*)/([0-9]+).html"(.*)>([^>]+)</a>|imsU',$ul,$d);
preg_match_all('|<span(.*)class="number_bg">([^>]+)</span>|imsU',$ul,$d2);
preg_match_all('|class="huiyuan"><b>([^>]+)</b>|imsU',$ul,$d3);
foreach($d[1] as $k=>$v){
        $a1 = $d[1][$k];
        $a2 = $d[3][$k];
        $a3 = $d[5][$k];
        $a5 = $d2[2][$k];
        $a4 = $d3[1][$k];
        $b4 = m_u('免费');
        $b5 = m_u('会员');
     if($d3[1][$k] == null) $a9=$b4;else $a9=$a4;
        $b6 = 'http://img1.c0.letv.com/ptv/player/swfPlayer.swf?autoPlay=1&id='.$a2;
        $a6 = 'http://www.letv.com/ptv/vplay/'.$a2.'.html';
        $a8 =  'http://www.le.com/tv/'.$a2.'.html';
 preg_match('|<p class="desBox_con">(.*)<div class="top_botm"><a href="([^>]+)"(.*)>([^>]+)</a>|imsU',f_g($a8),$d5);
        $a9 =  $d5[2];
 //preg_match("|vplay\/([^>]+).html|U",$a9,$d6);
        //$a10 =  $d6[1];
        //$a11 =  'http://player.pc.le.com/mms/out/video/playJson?id='.$a10.'&platid=1&splatid=101&format=1&tkey=861758424&domain=www.le.com&dvtype=1000&devid=C6464051F8E115A0440B747C0E4494BA317B5DFA&accessyx=1&source=1000&region=cn;';
        $ua =  $a6;
        $a7 =  '';
        $ua =  f_ht($ua);
        $ud2 = '../ck.php?a=le&vid='.$a2;
        $ud = f_kd(f_ht($ua));
     if($wnk=='11'||$wnk=='16') $a7=le_js($a6);else $a7=$a9;
        $fn = ''.$fname.'?&ledsj='.$a7.'&name='.$a3.'';
        $tg='target="b1"';
        $tb='target="b"';
     if($wnk==$fnk) $ud=$fn;else $ud=$ud;
     if($wnk==$fnk) $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" '.$tg.'>'.$a3.'('.$a5.')</a>'."\n";
   echo $xml;
}}}
function le_j($url) {
        $ul = f_g($url);
preg_match_all('|pid:([0-9]+),(.*)vid:([0-9]+),|imsU',$ul,$d);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
       $ud=$a2;
     return $ud;
}}
function le_js($url) {
        $ul = m_v($url);
preg_match_all('|cid:([0-9]+),|imsU',$ul,$d);
preg_match_all('|pid:([0-9]+),(.*)vid:([0-9]+),|imsU',$ul,$d2);
preg_match_all('|vid:([0-9]+),|imsU',$ul,$d3);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d2[1][$k];
        $a4 = $d3[1][$k];
        $a5 = '&cid='.$a2.'&pid='.$a3.'&vid='.$a4;
       $ud=$a5;
     return $ud;
}}
function le_ts($url) {
       $t1k= array("-1","30020","30008","30009","30010","30011","30012","30013","30014","30015","30016","30017","30018","30019","30021","30022","30024","30026",
"30027","30153","30043");
       $t2k= array("-1","30024","30009","30017","30014","30022","30320","30039","30042","30020","30044","30318","31367","30011","30015","30054","30280","31368",
"31369","31370","540033");
       $t3k= array("-1","30046","30083","30075","300057","30065","30072","30045","30082","30167","30069","30284","30290","30291","30327","30370","30371","30372",
"30373","30374","30375","30376","30119","30275","30071","30323");
       $t4k = array("-1","542171","542172","542173","542174","542175","542170","542001");
       $t5k = array("-1","30261","30050","30019","30054","300274","30270","30271","30272","30265","30017","30057","30063","30088","30282","30266","30273","30015","30269",
"30039","30056","30020","30264","30278","30055","30089","30279","30280","30045","30275","30051","30052","30059","30058","30354","30010","30053","30060","30061","542087");
       $t6k = array("-1","530001","530002","530003","530004","5300015","530006");
       $t7k = array("-1","30112","30113","30114","30115","30116","30117","30014","30119","30153","30121","30122","30018","30124","30125","30126","30127","30128",
"30069","30130","30131","100000");
       $t8k = array("-1","592001","592002","592003","592004","5920015","592006");
       $t9k = array("-1","532001","532002","532003","532004","5320015","532006");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
       $t5nk=$t5k[$t];
       $t6nk=$t6k[$t];
       $t7nk=$t7k[$t];
       $t8nk=$t8k[$t];
       $t9nk=$t9k[$t];
       $tnk="";
 if($w==2) $tnk=$t2nk;else if($w==3) $tnk=$t3nk;else if($w==4) $tnk=$t4nk;else if($w==5) $tnk=$t5nk;else if($w==6) $tnk=$t6nk;else if($w==7) $tnk=$t7nk;
           else if($w==8) $tnk=$t8nk;else if($w==9) $tnk=$t9nk;else $tnk=$t1nk;
     return $tnk;
}
function ledy2($url) {
$allmv = array (
       '动作片电影' => '30010-20',
       '喜剧片电影' => '30009-20',
       '恐怖片电影' => '30012-7',
       '警匪片电影' => '30021-2',
       '武侠片电影' => '30022-2',
       '战争片电影' => '30014-5',
       '爱情片电影' => '30011-20',
       '科幻片电影' => '30020-4',
       '奇幻片电影' => '30017-6',
       '犯罪片电影' => '30018-12',
       '动画片电影' => '30013-3',
       '剧情片电影' => '30008-20',
       '冒险片电影' => '30019-7',
       '灾难片电影' => '30023-1',
       '伦理片电影' => '30024-2',
       '传记片电影' => '30155-1',
       '记录片电影' => '30027-2',
       '历史片电影' => '30153-1',        
       '悬疑片电影' => '30016-8',        
       '惊悚片电影' => '30015-15',                           
);
foreach ($allmv as $kl => $vl) {
       $ad=m_u($kl);
       $ck='<a href="'.$fname.'?&ledy='.$vl.'" target="b1" >'.$ad.'</a>';
       $cmp= '<m list_src="'.$fname.'?ledy='.$vl.'"    label="'.$kl.'" />';
echo $ck;
}}
function ledy($url) {
       $wk= array("1","1","2","11","9","3","20","16","23","21","1035");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $tnk=le_ts($t);
if($t==0) $tkk='&';else $tkk='&sc='.$tnk;
    for($i=1;$i<=$p;$i++){
	//$ul2 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=2&cg=20&or=4&stt=1&vt=182210&s=undefined';
	//$ul3 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=1&ph=420001&dt=1&cg=2&or=4&stt=1&vt=180001&s=1';
 if($w==3||$w==4||$w==5||$w==7||$w==9){
	$ul4 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=2&cg='.$wnk.'&or=4&stt=1&vt=180001'.$tkk.'&s=1';
}else if($w==6||$w==8||$w==10){
	$ul4 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=2&cg='.$wnk.'&or=4&stt=1&vt=182210'.$tkk.'&s=undefined';
}else {
	$ul4 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=1&cg='.$wnk.'&or=4&stt=1&vt=180001'.$tkk.'&s=1';
}
	//$ul5 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=1&cg='.$wnk.'&or=5&stt=1&vt=180001&s=1';
	//$ul6 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=2&cg=2&or=7&stt=1&vt=180001&isend=1&s=5';
	//$ul7 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=2&cg=11&or=4&stt=1&s=3';
	//$ul8 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=2&cg=11&or=4&stt=1&vt=180001&sc=30069&s=1';
        $ut = m_v($ul4);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["arr"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["name"];
       $a2 = $a0["url"];
       $a3 = $a0["vid"];
       $a4 = $a0["ctime"];
       $a5 = $a0["unique_id"];
       $a6 = $a0["releaseDate"];
       //$a7 = $a0["ctime"];
       //$a8 =  'http://www.le.com/tv/'.$a2.'.html';
       //$a9 =  '../v.htm?f='.$a2.'';
       $a9 =  '../v.htm?f=http://www.le.com/ptv/vplay/'.$a3.'.html';
     if($wnk=='11'||$wnk=='2'||$wnk=='16') $a7=$a3;else $a7=$a9;
        $fn = ''.$fname.'?&levid='.$a7.'&aid='.$a5.'&wk='.$wnk.'';
        $tg='target="b1"';
        $tb='target="b"';
     if($wnk=='11'||$wnk=='2'||$wnk=='16') $ud=$fn;else $ud=$a7;
     if($wnk=='11'||$wnk=='2'||$wnk=='16') $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" '.$tg.'>'.$a1.'('.$a3.')</a>'."\n";
        //$xml ='<a href="'.$ud.'" " target="b" >'.$a1.' ('.$a3.')</a>'."\n";
echo $xml;
}}}
function ledy5($url) {
       $wk= array("1","1","2","11","9","5","22","16","30","1009","1035");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $tnk=le_ts($t);
if($t==0) $tkk='&';else $tkk='&sc='.$tnk;
    for($i=1;$i<=$p;$i++){
	$ul = 'http://www.le.com/?home'; 
	$ul2 = 'http://list.le.com/listn/c1_t-1_a-1_y-1_s1_lg-1_ph-1_md_o4_d1_p.html';
	$ul3 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=1&cg=1&or=1&stt=1&vt=180001&ispay=0&s=1';
	$ul4 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=1&cg='.$wnk.'&or=1&stt=1&vt=180001'.$tkk.'&s=1';
	$ul5 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn='.$i.'&ph=420001&dt=1&cg='.$wnk.'&or=5&stt=1&vt=180001&s=1';
	$ul6 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=1&cg=2&or=7&stt=1&vt=180001&isend=1&s=5';
	$ul7 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=3&ph=420001&dt=1&cg=1&or=1&stt=1&vt=180001&sc=30020&s=1';
	$ul8 = 'http://list.le.com/getLesoData?from=pc&src=1&stype=1&ps=30&pn=2&ph=420001&dt=1&cg=1&or=1&stt=1&vt=180001&sc=30020&s=1';
        $ut = m_v($ul4);
preg_match_all('|"name":"([^>]+)"(.*)"videoType":"([^>]+)"(.*)"videoTypeName":"([^>]+)"(.*)"url":"([^>]+)"(.*)"vid":"([^>]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2=m_u($d[1][$k]);
	$a0=$d[3][$k];
	$a3=m_u($d[5][$k]);
	$a4=$d[7][$k];
	$a5=$d[9][$k];
        $table=$a2;
        $ud =  '../v.htm?f='.$a4;
     if($wnk=='11'||$wnk=='2'||$wnk=='16') $a7=$a4;else $a7=$a4;//$a7=le_js($a4)
        $fn = ''.$fname.'?&ledsj='.$a7.'&name='.$a3.'';
        $tg='target="b1"';
        $tb='target="b"';
     if($wnk==$fnk) $ud=$fn;else $ud=$ud;
     if($wnk==$fnk) $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" '.$tg.'>'.$a2.'('.$a3.')</a>'."\n";
        //$xml ='<a href="'.$ud.'" " target="b" >'.$a2.' ('.$a3.')</a>'."\n";
echo $xml;
}}}
function kkdy($url) {
       $t1k= array("","Sci-Fi","Action","Comedy","Romance","Disaster","Horror","Mystery","Fantasy","War","Crime","Thriller","Ethics","Documentary","Drama","NetBusterFilm");
       $t2k= array("all","ox","aq","jd","wx","ls","shj","hz","zz","jf","xy","ll","kh","ds","xj","dz","gt","xz","nd","nc","qj","zj","dzp","jsp","mh","za","sz","szp","et","wlj","xqx","zkw","sgx","lj","lz");
       $t9k= array("all","home","international","society","finance","technology","tourism","life","auto","education","baby","ugc");
       $wk= array("movie"=>"movie","teleplay"=>"teleplay","tv"=>"tv","anime"=>"anime","vmovie"=>"vmovie","documentary"=>"documentary","lesson"=>"lesson",
"fashion"=>"fashion","news"=>"news","yule"=>"yule","joke"=>"joke","sports"=>"sports","1080"=>"1080");
       $w4k= array("teleplay"=>"teleplay","tv"=>"tv","anime"=>"anime","vmovie"=>"vmovie","documentary"=>"documentary","lesson"=>"lesson","fashion"=>"fashion");
       $w9k= array("news"=>"news","yule"=>"yule","joke"=>"joke","sports"=>"sports","1080"=>"1080");
       $w2k= array("movie","movie","teleplay","tv","anime","vmovie","documentary","lesson","fashion","news","yule","joke","sports","1080");
       $uk= array("","free","hhtc");
       $w = $_GET['w']?$_GET['w']:movie;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $unk=$uk[$u];
       $unkk=','.$unk;
    if($u == '0') $unkk=null;else $unkk=$unkk;
       $wnk=$wk[$w];
       $w2nk=$w2k[$w];
       $w9nk=$w9k[$w];
       $w4nk=$w4k[$w];
       $charges=',charges';
    if($u == '0') $charges=null;else $charges=$charges;
       $genre=',genre';
    if($t == '0') $genre=null;else $genre=$genre;
       $status=',status';
       $update=',update';
       $zp=',zp';
    if($wnk == 'movie'||$wnk == '1080') $status=$status;else $status=null;
    if($wnk == 'movie'||$wnk == '1080') $zp=$zp;else $zp=null;
    if($wnk == 'movie'||$wnk == '1080') $unk=$unk;else $unk=null;
    if($unk == $unk ) $charges=$charges;else $charges=null;
       $area=',area';
    if($wnk == 'fashion') $genre='region';else $genre=$genre;
    if($wnk == 'teleplay'||$wnk == 'fashion') $unkk=null;else $unkk=$unkk;
    if($wnk == 'fashion') $status=null;else $status=$status;
       $tnk='';
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $t9nk=$t9k[$t];
    if($wnk == 'movie') $tnk=$t1nk;else $tnk=$t2nk;
    if($wnk == $w9k) $tnk=$t9nk;else $tnk=$tnk;
    if($wnk == 'teleplay') $tnk=$t2nk;else $tnk=$tnk;
       $tnkk=','.$tnk;
    if($t == '0') $tnkk=null;else $tnkk=$tnkk;
    if($wnk == 'fashion') $unkk=$t;else $unkk=$unkk;
    for($i=1;$i<=$p;$i++){
        $page='page'.$i.'/';
    if($p <= '1') $page=null;else $page=$page;
        $url ='http://movie.kankan.com/type,order,status/'.$wnk.',update,zp/'.$page.'';
        $url0 ='http://movie.kankan.com/type,order,status/movie,update,zp,free/'.$page.'';
        $url3 ='http://1080.kankan.com/list/movie/update/'.$i.'.shtml';
        $url5='http://movie.kankan.com/type,order'.$genre.'/'.$wnk.''.$update.','.$t.'/'.$page.'';
        $url6='http://movie.kankan.com/type,order'.$genre.''.$status.''.$charges.'/'.$wnk.''.$update.''.$tnkk.''.$zp.''.$unkk.'/'.$page.'';
        $url7='http://video.kankan.com/list/'.$w9nk.'/'.$t9nk.',new/index-'.$i.'.html';
        $ul='';
if( $wnk=='1080'){ 
        $ut = f_g($url3);    
   preg_match_all('#<h3><a href="([^>]+)"(.*)title="([^>]+)"#ismU',$ut,$b);
   foreach($b[2] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[3][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = '';
        $ud0 = f_ud($ua);
        $ud1 = kk_dy($ua);
        $ud2 = kk_dy2($ua);
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
     $xml ='<a href="'.$ud1.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
else if( $wnk==$w4nk){ 
        $ut = f_g($url5);    
   preg_match_all('#class="movielist_tt">(.*)<(.*)href="([^>]+)"(.*)>([^>]+)<#ismU',$ut,$b);
   foreach($b[2] as $k=>$v){
        $a4 = $b[3][$k];
        $a5 = $b[5][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = '';
        $ud0 = f_ud($ua);
        $ud1 = kk_dy($ua);
        $ud2 = kk_dy2($ua);
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud0.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
else if( $wnk==$w9nk){
        $ut = f_g($url7);
   preg_match_all('#<li><a href="([^>]+)" title="([^>]+)"(.*)class="pic">#ismU',$ut,$b);
   foreach($b[2] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[2][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = '';
        $ud0 = f_ud($ua);
        $ud1 = kk_dy($ua);
        $ud2 = kk_dy2($ua);
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
     $xml ='<a href="'.$ud0.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
else {
      $ut = f_g($url6); 
   preg_match_all('#class="movielist_tt">(.*)<(.*)href="([^>]+)"(.*)>([^>]+)<#ismU',$ut,$b);
   foreach($b[2] as $k=>$v){
        $a4 = $b[3][$k];
        $a5 = $b[5][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = '';
        $ud0 = f_ud($ua);
        $ud1 = kk_dy($ua);
        $ud2 = kk_dy2($ua);
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}
}
function kk_dy($url) {
        $u = $_GET['u']?$_GET['u']:0;
   preg_match_all("#G_MOVIEID = '([^>]+)'#ismU",f_g($url),$d);
   preg_match_all('#submovieid:([^>]+),#ismU',f_g($url),$d2);
   foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d2[1][$k];
        $ud1 =  'http://video.kankan.com/dt/swf/v_sina.swf?id='.$a2.'&sid='.$a3.'&vtype=1&mtype=teleplay';
        $ud0 =  '../tv/kkdy.php?id='.$a2.'&sid='.$a3.'';
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
return $ua2;
}}
function kk_dy2($url) {//片头
       $u = $_GET['u']?$_GET['u']:0;
     preg_match('|/v/([^>]+)/([^>]+).shtml|',$url,$d2);
     //preg_match('|/vod/([^>]+).html|',$url,$d2);
        $vid =  $d2[1];
        $ul = 'http://auth.vip.kankan.com/vod/getPrevue?movieId='.$vid.'&callback=getVodsCallback&t=0&type=1';
   preg_match_all('#"id":([^>]+),"subId":([^>]+),"chapterTitle":"([^>]+)","chapterType":([^>]+),"blueRay":([^>]+),"byteType":([^>]+),"filesize":([^>]+),"ext":"([^>]+)","length":([^>]+),"type":([^>]+),"previewVodUrl":"([^>]+)","previewVodrUrl":"([^>]+)","previewFilesize":([^>]+),"previewLength":([^>]+),#ismU',f_g($ul),$d);
   foreach($d[1] as $k=>$v){
        $a1 = $d[1][$k];
        $a2 = $d[2][$k];
        $a3 = $d[7][$k];
        $a4 = $d[11][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud0 = f_ud($ua);
        $ud1 =  '../tv/kkdy.php?id='.$a1.'&sid='.$a2.'';
   if($u == '1'){$ud=$ud1;}else {$ud=$ud0;};
return $ud;
}}
function kk_dy3($url) {//片头
       $u = $_GET['u']?$_GET['u']:0;
     //preg_match('|/v/([^>]+)/([^>]+).shtml|',$url,$d2);
     preg_match('|/vod/([^>]+).html|',$url,$d2);
        $vid =  $d2[1];
        $pid =  $d2[1];
        $uid =  $d2[1];
        $ul = 'http://auth.vip.kankan.com/vod/getPrevue?movieId='.$vid.'&callback=getVodsCallback&t=0&type=1';
        $ul2 = 'http://auth.vip.kankan.com:8091/vod/jdb_auth?pid='.$pid.'&uid='.$uid.'&mdcode=';
   preg_match_all('#"id":([^>]+),"subId":([^>]+),"chapterTitle":"([^>]+)","chapterType":([^>]+),"blueRay":([^>]+),"byteType":([^>]+),"filesize":([^>]+),"ext":"([^>]+)","length":([^>]+),"type":([^>]+),"previewVodUrl":"([^>]+)","previewVodrUrl":"([^>]+)","previewFilesize":([^>]+),"previewLength":([^>]+),#ismU',f_g($ul),$d);
   foreach($d[1] as $k=>$v){
        $a1 = $d[1][$k];
        $a2 = $d[2][$k];
        $a3 = $d[7][$k];
        $a4 = $d[11][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud0 = f_ud($ua);
        $ud1 =  'http://js.kankan.com/vip/player/KKPlayerVIP.swf?id='.$a1.'&sid='.$a2.'';
        $ud2 =  '../tv/kkdy.php?id='.$a1.'&sid='.$a2.'';
   if($u == '2'){$ud=$ud0;}else {$ud=$ud2;};
return $ud;
}}
function kkvdy($url) {
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p=$_GET['p'];
       $vw=$p+5;
       for ($i = 1; $i <=$vw; $i++) {
	$a1 = 'http://list.vip.kankan.com/list_0_'.$t.'_0_0_0_'.$i.'.html'; 
        $ub = f_g($a1);
//preg_match_all('|<ul>(.*)</ul>|imsU',$ub,$c);
//foreach ($c[1] as $ks=>$vs){}
preg_match_all('|<li><a(.*)title="([^>]+)" href="([^>]+)"><img(.*)/><span>([^>]+)</span></a><span class="score"><strong>([^>]+)</strong>([^>]+)</span><p>([^>]+)</p></li>|imsU',$ub,$d);
foreach ($d[1] as $k=>$v){
	$a2=$d[3][$k];
        $table=$d[2][$k];
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = '';
        $ud0 = f_ud($ua);
        $ud1 = kk_dy2($ua);
        $ud2 = kk_dy3($ua);
   if($u == '2') {$ud=$ud2;}else if($u == '1') {$ud=$ud1;}else {$ud=$ud0;};
        $v=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$table.'</a>';
echo $xml;
}}}
function qqdy($url) {
       $wk= array("movie","movie","tv","cartoon","doco","usuk","variety","knowledge","child","dv","tech","music","fun","travel","ent","news","finance","life","livemusic");
       $tk = array("-1","100012","1000062","100061","4","100003","100004","100005","100006","100007","100008","100009","100010","100011","100013","1000014","1000015","1000016",
"1000017","1000018","1000019","1000020","1000021","1000022");
       $t2k = array("10","1","2","3","4","5","6","7","8","9","10","11","12","13","14","41");
       $t3k = array("815","10471","2","3","4","5","6","7","8","9","10","11");
       $uk = array("-1","1","2","3","4","5","6","7","8","9","10","11");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $tnk=$tk[$t];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $unk=$uk[$u];
       $wnk=$wk[$w];
       $itype = '&itype='.$tnk;
       $iarea = '&iarea='.$t3nk;
       $feature = '&feature='.$t3nk;
if($u==0) $characteristic=null;else $characteristic = '&characteristic=5';
if($w==0) $itype=null;else if($w==9) {
if($t==0) $itype=$iarea;else $itype=$feature;
}else $itype=$itype;

    for($i=0;$i<=$p;$i++){
        $i30 = $i*30;  $i3 = $i-1;
 $url2 ='https://v.qq.com/x/list/movie?cate=10001&offset='.$i20.'&subtype='.$tnk.'&pay='.$unk;
 $url3 ='http://film.qq.com/paylist/0/pay_'.$unk.'_-1_-1_-1_1_'.$i3.'_0_30_-1_-1.html';
if($w==8) {
 $url5='https://v.qq.com/x/bu/pagesheet/list?append=1&channel='.$wnk.'&listpage=2&offset='.$i30.'&pagesize=30&pay_level_one='.$unk.'&sort='.$t2nk.'';
}else if($w==9){
 $url5='https://v.qq.com/x/bu/pagesheet/list?_all=1&append=0&channel='.$wnk.''.$itype.''.$characteristic.'&listpage=2&offset='.$i30.'&pagesize=30&sort=18';
}else {
 $url5='https://v.qq.com/x/bu/pagesheet/list?_all=1&append=1&channel='.$wnk.''.$itype.''.$characteristic.'&offset='.$i30.'&pagesize=30&sort=18';
 $url51='https://v.qq.com/x/bu/pagesheet/list?_all=1&append=1&channel=movie&itype=100012&offset=0&pagesize=30&sort=18';
}
        $ul = m_v($url5);
if($w==7) {
  preg_match_all('#<div class="list_item"(.*)>(.*)<a href="([^<]+)"(.*)data-float="([^<]+)" title="([^<]+)">#ismU',$ul,$d);
}else {
  preg_match_all('#<div class="list_item"(.*)>(.*)<a href="([^<]+)"(.*)data-float="([^<]+)" title="([^<]+)">(.*)<div class="figure_caption" >([^<]+)</div>#ismU',$ul,$d);
}
  foreach($d[1] as $k=>$v){
        $a1 = $d[3][$k];
        $a2 = $d[5][$k]; 
        $a3 = m_u($d[6][$k]); 
        $a4 = $d[8][$k]; 
   if(stripos($a1,'http') === false){$a5=$a1;}else{$a5=$a1;};
        $a0 = 'http://v.qq.com/iframe/player.html?vid='.$a2.'&tiny=0&height=720&auto=1'; 
        $ua =  $a5;
        $ud = f_kd(f_ht($ua));
//preg_match('|http://v.qq.com/cover/([^<]+).html|',$ud,$d2);
       //$aa3 = $d2[1];
       //$aa4 = 'http://v.qq.com/x/cover/'.$aa3.'.html';
        $fn = ''.$fname.'?&qqdsj='.$a2.'&name='.$a3.'';
        $tg='target="b1"';
        $tb='target="b"';
     if($w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==8) $ud=$fn;else $ud=$ud;
     if($w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==8) $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v2));
if($w==8) {
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a3.' </a>';
}else {
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a3.'  ('.$a4.')</a>';
}
echo $xml;
}}}
function qqvdy($url) {
       $wk= array("movie","movie","tv","cartoon","doco","children","variety","music");
  $tk= array("-1","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24");
  $uk= array("1","2","3","4","5");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $type ="1";
       $wnk= $wk[$w];
if($wnk=="movie") $type="1";else if($wnk=="tv") $type="2";else if($wnk=="cartoon") $type="3";else if($wnk=="doco") $type="9";else if($wnk=="variety") $type="10";else if($wnk=="music") $type="22";else if($wnk=="children") $type="106";else $type=$type;
       $tnk= $tk[$t];
       $unk= $uk[$u];
    for($i=0;$i<=$p;$i++){
        $i30 = $i*30;
        $i3 = $i-1;
 if($w==5) {
 $url2 ='https://list.video.qq.com/fcgi-bin/list_common_cgi?otype=json&novalue=1&platform=1&version=10000&intfname=web_vip_children&tid=687&appkey=d105a714b21c771f&appid=20001140&type=106&sourcetype=1&iarea=-1&iyear=-1&gender='.$unk.'&itype='.$tnk.'&sort=19&charge=-1&pagesize=30&offset='.$i30.'&';
}else if($w==6) {
 $url2 ='https://list.video.qq.com/fcgi-bin/list_common_cgi?otype=json&novalue=1&platform=1&version=20340&intfname=vip_'.$wnk.'&tid=687&appkey=c8094537f5337021&appid=20001059&type=10&sourcetype=3&itype='.$tnk.'&itrailer=-1&sort=5&pagesize=30&offset='.$i30.'&callback=jQuery19109217368305143401_1632301863551';
} else {
 $url2 ='https://list.video.qq.com/fcgi-bin/list_common_cgi?otype=json&novalue=1&platform=1&version=10000&intfname=web_vip_'.$wnk.'_new&tid=687&appkey=c8094537f5337021&appid=20001059&type='.$type.'&sourcetype=1&itype='.$tnk.'&iarea=-1&characteristic=-1&iyear=-1&charge='.$unk.'&sort=19&pagesize=30&offset='.$i30.'';
}
       $ul = m_v($url2);
 preg_match("#\"results\":\[\{(.*)\}\]\}#U",$ul,$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = m_u($a0["fields"]["c_title"]);
       $a2 = $a0["fields"]["online_time"];
       $a3 = $a0["id"];
        $ua =  'https://v.qq.com/x/cover/'.$a3.'.html';
        $ud = f_kd($ua);
        $fn = ''.$fname.'?&qqdsj='.$a3.'&name='.$a1.'';
        $tg='target="b1"';
        $tb='target="b"';
     if($w==2||$w==3||$w==4||$w==5||$w==61||$w==7||$w==8) $ud=$fn;else $ud=$ud;
     if($w==2||$w==3||$w==4||$w==5||$w==61||$w==7||$w==8) $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'"'.$tg.'>'.$a1.'  ('.$a2.')</a>';
echo $xml;
}}}
function mg_id($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $t = $_GET['t']?$_GET['t']:0;
       $ul = 'https://pianku.api.mgtv.com/rider/config/channel/v1?channelId='.$url.'&platform=pcweb&_support=10000000';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["listItems"][0]["items"];
       //$count_json = count($aa);
 //for ($i2 = 0; $i2 < $count_json; $i2++) {}
       //$a0 = $aa[$i2];
       $a1 = $aa[$t]["tagId"];
       //$a2 = m_u($a0["tagName"]);
       //$ud = J_e($a1);
   return $a1;
}
function mgdy($url) {
       $wk = array("3","2","51","50","1","88","105","106","20","111","115","116");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk = $wk[$w];
       $tk = mg_id($wnk);
       //$tnk = $tk[$t];
     if($w==1||$w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==9) $dk=null;else $dk=$dk;
    for($i=1;$i<=$p;$i++){
       $ul1 = 'https://list.mgtv.com/'.$wnk.'/'.$tk.'-a3-------'.$dk.'-2-'.$i.'--a1-.html?channelId='.$wnk.'';
       $ul2 = 'https://pianku.api.mgtv.com/rider/list/pcweb/v3?platform=pcweb&channelId='.$wnk.'&pn='.$i.'&pc=80&hudong=1&_support=10000000&kind='.$tk.'&sort=c1&year=all&edition=a1&chargeInfo=a1';
       //$ul2 = 'https://pianku.api.mgtv.com/rider/list/pcweb/v3?platform=pcweb&channelId=3&pn='.$i.'&pc=80&hudong=1&_support=10000000&kind='.$tk.'&sort=c1&year=all&edition=a1&chargeInfo=a1&callback=jsonp_1606178601806_85735';
       $ul3 = 'https://list.mgtv.com/1/a4-a3--------2-'.$i.'--b1-.html?channelId='.$wnk.'';
       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["hitDocs"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = m_u($a0["updateInfo"]);
    preg_match('/\d+/',$a1,$ar1);
       $ar = $ar1[0];
    if($ar>1500) $ar=100;else $ar=$ar;
       $tn = round($ar/30,0)+1;
       $a2 = m_u($a0["title"]);
       $a3 = $a0["se_updateTime"];
     if($w==1||$w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==9) $a3=$a1;else $a3=$a3;
       $a4 = $a0["playPartId"];
       $a5 = $a0["clipId"];
       $a6 = 'https://www.mgtv.com/b/'.$a5.'/'.$a4.'.html?';
       $ua =  $a6;
       $gn='mgdsj';
     if($w==1||$w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==9) $gn='mgdsj';else $gn=$gn;
       $fn = ''.$fname.'?&'.$gn.'='.$a4.'&name='.$a2.'&tn='.$tn.'';
       $ud = f_kd(f_ht($ua));
       $tg='target="b1"';
       $tb='target="b"';
     if($w==1||$w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==9) $ud=$fn;else $ud=$ud;
     if($w==1||$w==2||$w==3||$w==4||$w==5||$w==6||$w==7||$w==9) $tg=$tg;else $tg=$tb;
       $xml='<a href="'.$ud.'" '.$tg.' >'.$a2.' '.$a3.'</a>';
echo $xml;
}}}
function mgsdy($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       //$ul = 'http://so.hunantv.com/so/k-'.$w.'-rt--dt-'.$n.'-od-2-page-'.$i.'.html';
       $ul = 'http://mgso.hunantv.com/search?callback=jQuery182048894658095993426_1436058950985&ic=0&pn=1&pc=40&ut=1&dt='.$t.'&st=2&ty=0&q='.$w.'';
       $str = f_g($ul);
    preg_match_all('|"url":"(.*?)"|',$str,$b);
    preg_match_all('|"title":"(.*?)"|',$str,$b2);
    preg_match_all('|"addtime":"(.*?)"|',$str,$b3);
    preg_match_all('|"id":"(.*?)"|',$str,$b4);
    preg_match_all('|"duration":"(.*?)"|',$str,$b5);
    //preg_match_all('|<a href="(.*?)" title="(.*?)" target="_blank" class="a-pic-play"></a>|',$str,$b);
    foreach($b[1] as $k=>$v){
       $a2 = $b[1][$k];
       $a3 = $b2[1][$k];
       $a4 = $b3[1][$k];
       $a5 = $b4[1][$k];
       $a6 = $b5[1][$k];
       $ua =  $a2;
       $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $xml='<a href="'.$ud.'" target="b" >'.$a3.'('.$a4.')('.$a6.')</a>';
echo $xml;
}}
function qydy($url) {
       $wk = array("1","2","3","4","5","6","7","8","9","10","32","12","13","31","15","16","17","30","29","20","21","22","28","24","25","26","27","29","30","31","32");
       $t4k = array("","30230","30232","30233","30237","30245","30247","30248","30249","30254","30255","30256","30258","30267","30268","32792","32793");
       $t3k = array("","70","33908","33924","33933","33960","33967","33953","33974","72","74","73","71","28119","310");
       $t2k = array("","24","20","23","30","1654","1653","24064","135","27916","1655","290","32","149","148","139","21","145","34","27","29","140","24063","27881","24065","11992","32839");
       $t1k = array("","9","8","6","11","131","291","128","10","289","12","27356","1284","129","7","130","27396","27397","27815","30149","27401");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:'';
       $p = $_GET['p']?$_GET['p']:"2";
       $wnk =$wk[$w];
       $tnk ='';
       $t1nk =$t1k[$t];
       $t2nk =$t2k[$t];
       $t3nk =$t3k[$t];
 if($w==1) $tnk=$t2nk;else if($w==2) $tnk=$t3nk;else if($w==3) $tnk=$t4nk;else $tnk=$t1nk;
       for ($i = 1; $i <=$p; $i++) {
   $url3 ='http://pcw-api.iqiyi.com/search/video/videolists?access_play_control_platform=14&channel_id=1&data_type=1&from=pcw_list&is_album_finished=&is_purchase='.$tnk.'&market_release_date_level=&mode=24&pageNum='.$i.'&pageSize=48&site=iqiyi&source_type=&three_category_id='.$wnk.';must&without_qipu=1';
   $url5 ='https://pcw-api.iqiyi.com/search/recommend/list?channel_id='.$wnk.'&data_type=1&mode=11&page_id='.$i.'&ret_num=48&three_category_id='.$tnk.';';
        $ut = m_v($url5);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["albumId"];
       $a2 = $a0["name"];
       $a3 = $a0["videoCount"];
       $a4 = $a0["latestOrder"];
       $a5 = $a0["period"];
       $a6 = $a0["title"];
       //$a8 = $a0["pingback"]["doc_id"];
       $a7 = $a0["playUrl"];
        $ua =  $a7;
        $ud = f_kd($ua);
        $tb='target="b1"';
        $tg='target="b"';
        $fn=$fname.'?&qydsj='.$a1;
     if($w=='2'||$w=='3'||$w=='1'||$w=='11') $ud=$fn;else $ud=$ud;
     if($w=='2'||$w=='3'||$w=='1'||$w=='11') $tg=$tb;else $tg=$tg;
        $vd=Current(explode('?',$v));
if($w==1||$w==2||$w==3||$w==11) {
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a2.'  ('.$a3.''.m_u('集').')('.m_u('更新至').''.$a4.')('.$a5.')</a>';
}else {
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a2.'  ('.$a5.')</a>';
}
echo $xml;
}}}
function shudy($url) {
       $wk= array("100","101","115","106","112","122","107","197","133","208","128","210","126","127","1001","1000","1003");
       $t1k= array("","103","101","102","100","104","105","106","107","108","109","110","111","112","113","114","115",
"116","117","118","119","120","121","122","123","135");
       $t2k= array("","141","142","143","144","145","146","147","148","149","150","151","152","153","154","155","156",
"157","158","159","160","161");
       $t3k= array("","100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115",
"116","117","118","119","120","121","122","123","135");
       $uk= array("","5","4","3","1");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $tnk='';
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $unk=$uk[$u];
       $wnk=$wk[$w];
if($wnk==101) $tnk =$t2nk;else if($wnk==115) $tnk =$t1nk;else $tnk =$t1nk;
       $nnk=$wnk.$tnk;
    if($t=="0") $nnk=null;else $nnk=$nnk;
    for($i=1;$i<=$p;$i++){
       $ul = 'http://so.tv.sohu.com/list_p1'.$wnk.'_p2'.$nnk.'_p3_p4_p5_p6_p73_p8_p91_p10'.$i.'_p11_p12'.$unk.'_p13.html';
       //$ul2 = 'http://so.tv.sohu.com/list_p1100_p2100103_p3_p4_p5_p6_p73_p8_p91_p10_p11_p12_p13.html';
       $ut = m_v($ul);
 preg_match_all('|<strong>(.*)<a(.*)href="([^>]+)"(.*)title="([^>]+)"(.*)pb-url=(.*)>([^>]+)</a>(.*)</strong>|ismU',$ut,$d2);
 preg_match_all('|<h3(.*)>(.*)<a(.*)href="([^>]+)"(.*)title="([^>]+)"|ismU',$ut,$d3);
 preg_match_all('|<h3(.*)class=(.*)>(.*)<a href="([^>]+)"(.*)title="([^>]+)"|ismU',$ut,$d3);
 preg_match_all('|<p class="time-fb">([^>]+)</p>|ismU',$ut,$d4);
 preg_match_all('|<p class="lh-type">(.*)<span>([^>]+)</span>|ismU',$ut,$d5);
    foreach($d2[1] as $k=>$v){
       $a3 = 'http:'.$d2[3][$k];
       $a4 = m_u($d2[8][$k]);
       $a1 = $d3[4][$k];
       $a2 = $d3[6][$k];
       $a5 = $d5[2][$k];  
       $a6 = $d4[1][$k]; 
       $a8 = '';$a9 = ''; 
     if($w<="8") $a8=$a3;else $a8=$a1;
     if($w<="8") $a9=$a4;else $a9=$a2;
        $ua =  $a8;
        //$ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $gn='';
        $tg='target="b1"';
        $tb='target="b"';
        $fn = ''.$fname.'?&shdsj='.$ua.'&name='.$a4.'';
     if($wnk==101||$wnk==115||$wnk==106||$wnk==107) $ud=$fn;else $ud=$ud;
     if($wnk==101||$wnk==115||$wnk==106||$wnk==107) $tg=$tg;else $tg=$tb;
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$ud.'" '.$tg.' >'.$a9.'('.$a5.')('.$a6.')</a>';
echo $xml;
 }}}
function sh_dsj($url) {
       $ut = m_v($url);
  preg_match('#var playlistId = "([^>]+)"#U',$ut,$d);
       $a3 = $d[1];
       $ud ='http://m.tv.sohu.com/album/s'.$a3.'.shtml'; 
       $ud2 ='http://pl.hd.sohu.com/videolist?playlistid='.$a3.'&order=0&cnt=1&withLookPoint=1&preVideoRule=1&callback=__get_videolist'; 
  return $ud2;
}
function shtv($url) {
       $xml = "<ckplayer><flashvars>{h->4}</flashvars>";
       $content= f_g('http://tvimg.tv.itc.cn/live/stations.jsonp');
       $content=str_ireplace('(function(args){var par=','',$content);$content=str_ireplace(';channelList(par,args);})()','',$content);
       $json=json_decode($content);
       $con=count($json->STATIONS);
for($i = 0;$i<$con; $i++){
       $name=$json->STATIONS[$i]->STATION_NAME;
       $a3=$json->STATIONS[$i]->STATION_ID;
       $a4=htmlspecialchars($a3);
       $ud = '../ck.php?a=shtv&f='.$a3;
$xml ='<a href="'.$ud.'" target="b" >'.$name.'</a>';
echo $xml;
}}
function sinady($url) {
       $wk= array("category","movie","teleplay","zongyi","comic","real","dv","zt");
       $tk= array(index,"1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25");
       $w = $_GET['w']?$_GET['w']:1;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:30;
       $tnk=$tk[$t];
       $unk=$uk[$u];
       $wnk=$wk[$w];
       $wnk2='';
       $video='video';
    if($tnk=='index') $wnk2=$wnk;else $wnk2='type';
    for($i=1;$i<=$w;$i++){
 $url2 ='http://video.sina.com.cn/movie/category/movie/#top_daohang';
 $url ='http://video.sina.com.cn/interface/movie/category.php?category=movie&page=2&pagesize=20&liststyle=1&topid=2&leftid=movie-index&rnd=';
 $url1 ='http://video.sina.com.cn/interface/movie/category.php?category='.$wnk.'page=1&pagesize='.$p.'&liststyle=1&topid=1&leftid=teleplay-index&rnd=';
 $url3 ='http://'.$video.'.sina.com.cn/interface/movie/category.php?category='.$wnk.'&page=1&pagesize='.$p.'&liststyle=1&topid=1&leftid='.$wnk2.'-'.$tnk.'&rnd=';
        $ut = m_v($url3);
preg_match_all('|"url":"([^>]+)","area"|imsU',$ut,$d);
preg_match_all("|\"name\":\"([^>]+)\",|imsU",$ut,$d2);
preg_match_all("|\"video_length\":\"([^>]+)\",|imsU",$ut,$d3);
preg_match_all("|\"detail\":\"([^>]+)\"|imsU",$ut,$d4);
foreach($d[1] as $k=>$v){
        $a4 = x_g($d[1][$k]);
        $a5 = x_g(r_u($d2[1][$k]));
        $a6 = 'http://video.sina.com.cn'.$a4.'';
        $a7 = $d3[1][$k];
        $a8 = x_g($d4[1][$k]);
        $a9 = 'http://video.sina.com.cn'.$a8.'';
    if($wnk=='teleplay') $a10=$a9;else $a10=$a6;
        $ua =  $a10;
        $ua =  f_ht($ua);
        $tg='target="b1"';
        $tb='target="b"';
        $fn = ''.$fname.'?&sinadsj='.$a10.'&name='.$a5.'';
        $ud = f_kd(f_ht($ua));
     if($wnk=='teleplay') $ud=$fn;else $ud=$ud;
     if($wnk=='teleplay') $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.' ('.$a7.')</a>';
echo $xml;
}}}
function n195dy($url) {
       $wk= array("newmovie","2017dianyin","top","huayupian","oumeipian","rihanpian","guochanju","oumeiju","rihanju","videos/lunlipian","zhuanjizixun");
       $w = $_GET['w']?$_GET['w']:0;
       //$t = $_GET['t']?$_GET['t']:1;
       //$u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
    for($i=1;$i<=$p;$i++){
       $ur = 'http://www.tl95.com/'.$wnk.'/page/'.$i;
       $ut = m_v($ur);
 preg_match_all('|<h2(.*)class="entry-title">(.*)<a href="([^>]+)" rel="bookmark">([^>]+)</a>(.*)</h2>|ismU',$ut,$d);
    foreach($d[1] as $k=>$v){
       $a2 = t_195($d[3][$k]);
       $a3 = m_u($d[4][$k]);
        //$ua =  $a2;
        //$ua =  f_ht($ua);
        //$ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
 $xml='<a href="'.$a2.'" target="b" >'.$a3.'</a>';
 echo  $xml;
 } }}
function t_195($url) {
 preg_match('|<p style="text-indent(.*)"><iframe src="([^>]+)"(.*)></iframe>(.*)</p>|ismU',f_g($url),$d);
       $a2 = $d[2];
      return $a2;
 }
function fundy($url) {
       $w = $_GET['w']?$_GET['w']:"e794b5e5bdb1";
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ur = 'http://www.fun.tv/retrieve/c-'.$w.'.n-e5bdb1e78987.o-mf.pg-1';
       $ut = m_v($ur);
 preg_match_all('|<h3 class="tit">(.*)<a  href="([^>]+)"(.*)title="([^>]+)"(.*)>([^>]+)</a>(.*)</h3><p class="desc">([^>]+)</p>|ismU',$ut,$c);
    foreach($c[1] as $k=>$v){
       $a2 = $c[2][$k];
       $a3 = $c[4][$k];
       $a4 = $c[8][$k];
       $a5='http://www.fun.tv'.$a2.'';
       $ua =  $a5;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
 $xml='<a href="'.$ud.'" target="b" >'.$a3.'('.$a4.')</a>';
 echo  $xml;
 } }

function funjmv($url) {
       $w = $_GET['w']?$_GET['w']:"e7baaae5bd95e78987";
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ur = 'http://www.fun.tv/retrieve/c-'.$w.'.o-mo.pg-'.$p.'';
       $ut = m_v($ur);
 preg_match_all('|<h3 class="(.*)"><a href="/vplay/([^>]+)-([^>]+)/"(.*)title="(.*)"|ismU',$ut,$c);
 foreach($c[1] as $k=>$v){
       $a3 = $c[2][$k];
       $a4 = $c[3][$k];
       $a5 = $c[5][$k];
       $a6='http://www.fun.tv/vplay/'.$a3.'-'.$a4.'/';
        
       $a7='http://static.funshion.com/market/p2p/vod/2014-3-12/FunPlayerUi_3.0.0.7.swf?type=movie&itemid='.$a4.'&data=1&startAd=1';
       $ua =  $a6;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
 } }
function fundsj($url) {
       $w = $_GET['w']?$_GET['w']:"e794b5e8a786e589a7";
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       //$ur = 'http://www.fun.tv/retrieve/c-'.$w.'.o-mo.pg-'.$p.'';
       $ur = 'http://www.fun.tv/retrieve/c-'.$w.'.n-e5bdb1e78987.o-mo.pg-'.$p.'';
       $ut = m_v($ur);
preg_match_all('|<i class="tip">(.*)</i></span>|ismU',$ut,$c2);
 preg_match_all('|<h3 class="(.*)">(.*)<a(.*)href="/vplay/([^>]+)-(.*)/"(.*)title="(.*)"(.*)>(.*)</a>|ismU',$ut,$c);
 foreach($c[1] as $k=>$v){
       $a3 = $c[4][$k];
       $a4 = $c[5][$k];
       $a5 = $c[7][$k];
       $a6 = $c2[1][$k];
    $xml ='<a href="'.$fname.'?&fundsj='.$a4.'&lid='.$a3.'" >'.$a5.'</a>';
echo $xml;
}}

function tddy2($url) {
       $tk= array("null","110","91","92","93","94","95","96","97","98","99","100","101","102","103","104","105","106","107","108","111","112","113","114","115","116","117","119","1009","130");
       $t2k= array("null","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","108","111","112","113","114","115","116","117","119","1009","130");
       $uk= array("null","998","999","1000","1686");
       $u2k= array("1769","1769","1770","1771","1772");
       $hk= array("null","373","374","375","2265");
       $w = $_GET['w']?$_GET['w']:5;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $znk='&tags=352';
    if($w==3||$w==5) $znk=null;else $znk=$znk;
       $tnk=$tk[$t];
       $t2nk=$t2k[$t];
    if($w==3) $tnnk=$t2nk;else $tnnk=$tnk;
       $unk=$uk[$u];
    if($u==0) $unk=null;else $unk=$unk;
       $u2nk=$u2k[$u];
    if($w==3) $unk=$u2nk;else $unk=$unk;
       $u3nk='&tags='.$unk;
       $hnk=$hk[$u];
       $h2nk='&tags='.$hnk;
    if($u==0) $h2nk=null;else $h2nk=$h2nk;
    for($i=1;$i<=$p;$i++){
 $ul ='http://www.tudou.com/s3portal/service/pianku/data.action?pageSize=90&app=mainsitepc&deviceType=1&tags='.$tnnk.''.$znk.''.$h2nk.''.$u3nk.'&tagType=3&firstTagId='.$w.'&areaCode=&initials=&hotSingerId=&pageNo='.$i.'&sortDesc=pubTime';
 $ul2 ='http://www.tudou.com/s3portal/service/pianku/data.action?pageSize=90&app=mainsitepc&deviceType=1&tags=&tagType=3&firstTagId=3&areaCode=&initials=&hotSingerId=&pageNo=1&sortDesc=pubTime';
        $ut = m_v($ul);
preg_match_all('|"albumId":([^>]+),"title":"([^>]+)",|imsU',$ut,$b);
preg_match_all('|"hdType":([^>]+),"playUrl":"([^>]+)",|imsU',$ut,$b2);
preg_match_all('|"updateInfo":"([^>]+)"|imsU',$ut,$b3);
foreach($b[1] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[2][$k];
        $a6 = $b2[1][$k];
        $a7 = $b2[2][$k];
        $a8 = $b3[1][$k];
        $ua =  $a7;
        $ua =  f_ht($ua);
        $tg='target="b1"';
        $tb='target="b"';
        $fn = ''.$fname.'?&tddsj='.$ua.'&name='.$a5.'';
        $ud = f_kd(f_ht($ua));
     if($w=='3') $ud=$fn;else $ud=$ud;
     if($w=='3') $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" '.$tg.' >'.$a5.'  ('.$a8.')</a>';
echo $xml;
}}}
function tddy($url) {
       $wk= array("null","97","96","85","100","87","84","98","91");
 $t1k= array("0","科幻","武侠","警匪","犯罪","战争","恐怖","惊悚","纪录片","传记","悬疑","剧情","冒险","西部","奇幻","历史","爱情","动作","儿童","动画","戏曲",
"运动","短片");
 $t2k= array("0","古装","武侠","警匪","军事","神话","科幻","悬疑","历史","儿童","农村","都市","家庭","搞笑","偶像","言情","时装","优酷出品");
 $t3k= array("0","热门网综","优酷牛人","脱口秀","真人秀","选秀","美食","旅游","汽车","访谈","纪实","搞笑","时尚","晚会","理财","演唱会","曲艺","益智","音乐","舞蹈","体育娱乐","生活");
 $t4k= array("0","人物","军事","历史","自然","古迹","探险","科技","文化","刑侦","社会","旅游");
 $t5k= array("0","时政","财经","社会","生活","军事","科技","体育","公益");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
     if($w=='2') $tk=$t1k;else if($w=='3') $tk=$t3k;else if($w=='6') $tk=$t4k;else if($w=='8') $tk=$t5k;else $tk=$t2k;
       $tnk=$tk[$t];
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;++$i){
 $ul ='http://category.tudou.com/category/c_'.$wnk.'_u_1_g_'.$tnk.'_p_'.$i.'.html';
        $ut = m_v($ul);
preg_match_all('|<span class="v-num">([^>]+)</span>(.*)<a href="([^>]+)"(.*)title="([^>]+)"(.*)class="v-thumb__link" data-spm=""></a>|ismU',$ut,$b);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = 'http:'.$b[3][$k];
        $a3 = $b[5][$k];
        $ua = $a2;
        $ud =  f_ht($ua);
        $tg='target="b1"';
        $tb='target="b"';
        $tddsj = '';
        $tddsj1 = 'tddsj';
        $tddsj2 = 'ykdsj';
   if(stripos($ua,'youku.com') === false){$tddsj=$tddsj1;}else{$tddsj=$tddsj2;};
        $fn = ''.$fname.'?&'.$tddsj.'='.$ua.'&name='.$a3.'';
        $ud = f_kd(f_ht($ua));
     if($w=='2') $ud=$ud;else $ud=$fn;
     if($w=='2') $tg=$tb;else $tg=$tg;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" '.$tg.' >'.$a3.'('.$a1.')</a>';
echo $xml;
}}}



function tdpdy($url) {
       $w = $_GET['w']?$_GET['w']:30;
        $ww = '_'.$w;
   if ($w == '0')  $ww='';else  $ww=$ww;
 $url ='http://www.tudou.com/top/rank'.$ww.'.html';
        $ut = m_v($url);
preg_match_all('|<h2><a href="http://www.tudou.com/(.*)/([^>]+).html" target="_blank" title="(.*)">(.*)</a></h2>|imsU',$ut,$b);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[2][$k];
        $a4 = 'http://www.tudou.com/crp/getAlbumvoInfo.action?charset=utf-8&acode='.$a3.'&areaCode=310000';
        $a5 = $b[3][$k];
    $xml ='<a href="'.$fname.'?&tdph='.$a4.'" >'.$a5.'</a>'."\n";
echo $xml;
}}

function wsdy($url) {
       $wk= array("vip"=>"vip","1"=>"1","11"=>"11","19"=>"19","601"=>"601","37"=>"37","38"=>"38","180"=>"180","220"=>"220","22"=>"22","26"=>"26","32"=>"32","91"=>"91",
"160"=>"160","300"=>"300","137"=>"137","102"=>"102","200"=>"200","55"=>"55","48"=>"48","60"=>"60","650"=>"650","700"=>"700","Dance"=>"Dance");
       $w2k= array("vip","1","11","19","601","37","180","220","22","26","32","91","160","300","137","102","200","55","48","60","650","700","Dance","38");
       $fk= array("11"=>"11","19"=>"19","160"=>"160","650"=>"650");
       $w = $_GET['w']?$_GET['w']:'1';
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$w2k[$w];
       $fnk=$fk[$wnk];
    for($i=1;$i<=$p;++$i){
       $urk= array( "vip","Dance");
       $ur2k= array(
            "vip"=>$url2 ='http://all.wasu.cn/index/type/fee/cid/1?&p='.$i,
            "Dance"=>$url3 ='http://www.wasu.cn/Dance/dancerList?p='.$i );
       $urnk=$ur2k[$wnk];
       $url ='http://all.wasu.cn/index/cid/'.$wnk.'?&p='.$i;
       $url2 ='http://all.wasu.cn/index/type/fee/cid/1?&p='.$i;
       $url3 ='http://www.wasu.cn/Dance/dancerList?p='.$i;
   if ($wnk == 'vip') $url=$url2;else if($wnk == 'Dance') $url=$url3;else $url=$url;
        $ul = m_v($url);
 preg_match_all("#<div class=\"meta_tr\">([^<]+)</div>#ismU",$ul,$d2);
 preg_match_all("#<div class=\"(.*)_link\">(.*)<a href=\"([^<]+)\" title='([^<]+)'(.*)>(.*)</a>#ismU",$ul,$d);
 preg_match_all("#<div class=\"(.*)_link\">(.*)<a href=\"([^<]+)\" title=\"([^<]+)\"(.*)>(.*)</a>#ismU",$ul,$d1);
 foreach($d2[1] as $k=>$v){
        $a2 = $d[3][$k];
        $a4 = $d2[1][$k];
   if ($wnk == '38') $a3=$d1[4][$k];else $a3=$d[4][$k];
   if ($wnk == '38') $a2=$d1[3][$k];else $a2=$d[3][$k];
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $tg='target="b1"';
        $tb='target="b"';
        $fn = ''.$fname.'?&wsdsj='.$ua.'&name='.$a3.'';
        $fn2 = ''.$fname.'?&wsjs='.$ua.'&name='.$a3.'';
        $fn3 = ''.$fname.'?&wszx='.$ua.'&name='.$a3.'';
     if($wnk=='180') $ud=$fn2;else if($wnk=='38') $ud=$fn3;else if($wnk==$fnk) $ud=$fn;else $ud=$ud;
     if($wnk=='180') $tg=$tg2;else if($wnk==$fnk) $tg=$tg;else if($wnk=='38') $tg=$tg;else $tg=$tb;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a3.' ('.$a4.')</a>';
echo $xml;
}}}

function wsvdy($url) {
       $w = $_GET['w']?$_GET['w']:'1';
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://all.wasu.cn/index/type/fee/cid/1?&p='.$p.'';
        $ul = m_v($url);
preg_match_all("|<div class=\"p_link\">(.*)<a href=\"([^>]+)\" title='([^<]+)'(.*)>|ismU",$ul,$b);
foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = $b[3][$k];
       /* $ul2 = f_g($a2);
preg_match_all("|var _payVodLink = \"http://vip.wasu.cn/pay/id/(.*)\";|ismU",$ul2,$b2);
foreach($b2[1] as $k2=>$v2){
        $a6 = $b2[1][$k2];
        $ur='http://www.wasu.cn/Api/getPlayInfoById/id/'.$a6.'/datatype/xml';
        $ul3 = m_v($ur);
preg_match_all("|<swf>(.*)</swf>|ismU",$ul3,$b3);
preg_match_all("|<video>(.*)</video>|ismU",$ul3,$b4);
preg_match_all("|<hd2>(.*)</hd2>|ismU",$ul3,$b5);
preg_match_all("|<hd1>(.*)</hd1>|ismU",$ul3,$b6);
preg_match_all("|<hd0>(.*)</hd0>|ismU",$ul3,$b7);
foreach($b3[1] as $k3=>$v3){
        $a7 = $b3[1][$k3];
        $a8 = m_b($b4[1][$k3]);
        $a9 = m_b($b5[1][$k3]);
        $a10 = m_b($b6[1][$k3]);
        $a11 = m_b($b7[1][$k3]);*/
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function wsldy($url) {
       $w = $_GET['w']?$_GET['w']:'tv';
        $ul ='http://live.wasu.cn';
        $st = m_v($ul);
   preg_match_all('#<li><a target="_blank" class="ys" href="/show/id/(.*)">(.*)</a></li>#ismU',$st,$b);
        foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[2][$k];
        $a3 ='http://play.wasu.cn/live/'.$a1.'.swf ';
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a3.'" target="TV" >'.$a2.'</a>';
echo $xml;
}}
function gatmv($url) {
       $w = $_GET['w']?$_GET['w']:38;
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://all.wasu.cn/index/cid/'.$w;
        $ul = f_g($url);
preg_match_all('#<div class="all_hg20"><a title="(.*)" target="_blank" href="(.*)">(.*)</a></div>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[2][$k];
        $a4 = $b[3][$k];
        $ur = m_v($a3);
preg_match_all('|<div class="meta_tr">(.*)</div>(.*)<div class="meta_shadow"></div>(.*)</div>(.*)</div>(.*)<div class="ws_des">(.*)<p><a href="(.*)" title="(.*)" target="_blank">(.*)</a></p>|ismU',$ur,$b2);
foreach($b2[1] as $k2=>$v2){
        $a5 = $b2[7][$k2];
        $a6 = $b2[8][$k2];
        $a7 = $b2[1][$k2];  
        $ua =  $a5;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a6.'('.$a2.$a7.')</a>';
echo $xml;
}}}

function ykpdy($url) {
       $w = $_GET['w']?$_GET['w']:84;
 $url2 ='http://i.youku.com/u/UMTY5NjU0OTAzNg==/videos/?q='.$w.'';
 $url ='http://www.youku.com/u/originalRanking/channel/'.$w.'';
        $ul = f_g($url);
preg_match_all('#<h3><a href="([^>]+)"(.*)>(.*)</a>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a1 = $b[3][$k];
    $xml ='<a href="'.$fname.'?&ykph='.$a2.'"  target="b1" >'.$a1.'</a>'."\n";
echo $xml;
}}
function yk_uk($url) {
       $wk= array("96","97","84","85","100","95","87","86","91","98","99","94","103","104","105","89","90","88","171","172","174","175","176");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $wnk=$wk[$w];
  $u1k= array("","科幻","武侠","警匪","犯罪","战争","恐怖","惊悚","纪录片","传记","悬疑","剧情","冒险","西部","奇幻","历史","爱情","动作","儿童","动画","戏曲",
"运动","短片");
  $u2k= array("","古装","武侠","警匪","军事","神话","科幻","悬疑","历史","儿童","农村","都市","家庭","搞笑","偶像","言情","时装","优酷出品");
  $u3k= array("","人物","军事","历史","自然","古迹","探险","科技","文化","刑侦","社会","旅游");
  $u4k= array("","热血","格斗","恋爱","美少女","校园","搞笑","LOLI","神魔","机战","科幻","真人","青春","魔法","神话","冒险","运动","竞技","童话","亲子","教育",
"励志","剧情","社会","历史","战争");
  $u5k= array("","优酷出品","优酷牛人","脱口秀","真人秀","选秀","美食","旅游","汽车","访谈","纪实","搞笑","时尚","晚会","理财","演唱会","曲艺","益智","音乐",
"舞蹈","体育娱乐","游戏","生活");
  $u6k= array("","流行","摇滚","舞曲","电子","R&B","HIP-HOP","乡村","民族","民谣","拉丁","爵士","雷鬼","新世纪","古典","音乐剧","轻音乐");
  $u7k= array("","公开课","名人名嘴","文化","艺术","伦理社会","理工","历史","心理学","经济","政治","管理学","外语","法律","计算机","哲学","职业培训","家庭教育");
  $u8k= array("","娱乐资讯","电视资讯","电影资讯","音乐资讯","颁奖礼","戏剧","曲艺","艺术","魔术");
  $u9k= array("","社会资讯","科技资讯","生活资讯","军事资讯","财经资讯","时政资讯","法制");
       $u1nk=$u1k[$u];
       $u2nk=$u2k[$u];
       $u3nk=$u3k[$u];
       $u4nk=$u4k[$u];
       $u5nk=$u5k[$u];
       $u6nk=$u6k[$u];
       $u7nk=$u7k[$u];
       $u8nk=$u8k[$u];
       $u9nk=$u9k[$u];
       $unk='';
if($wnk=="96") $unk=$u1nk;else if($wnk=="97") $unk=$u2nk;else if($wnk=="100") $unk=$u3nk;else if($wnk=="84") $unk=$u4nk;else if($wnk=="85") $unk=$u5nk;
else if($wnk=="95") $unk=$u6nk;else if($wnk=="87") $unk=$u7nk;else if($wnk=="86") $unk=$u8nk;else if($wnk=="91") $unk=$u9nk;else $unk=$u1nk;
      return $unk;
}
function yk_tk($url) {
       $wk= array("96","97","84","100","85","95","87","86","91","98","99","94","103","104","105","89","90","88","171","172","174","175","176","177","178");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $wnk=$wk[$w];
  $t1k= array("","科幻","武侠","警匪","犯罪","战争","恐怖","惊悚","纪录片","传记","悬疑","剧情","冒险","西部","奇幻","历史","爱情","动作","儿童","动画","戏曲",
"运动","短片","优酷出品");
  $t2k= array("","古装","武侠","警匪","军事","神话","科幻","悬疑","历史","儿童","农村","都市","家庭","搞笑","偶像","言情","时装","优酷出品");
  $t3k= array("","人物","军事","历史","自然","古迹","探险","科技","文化","刑侦","社会","旅游");
$u4k= array("","热血","格斗","恋爱","美少女","校园","搞笑","LOLI","神魔","机战","科幻","真人","青春","魔法","神话","冒险","运动","竞技","童话","亲子","教育",
"励志","剧情","社会","历史","战争");
  $t5k= array("","相声","喜剧","音乐","舞蹈","偶像","情感","婚恋","体育","明星访谈","旅游","文化","时尚","美食","生活","益智","晚会","游戏","亲子");
  $t51k= array("","优酷出品","优酷牛人","脱口秀","真人秀","选秀","美食","旅游","汽车","访谈","纪实","搞笑","时尚","晚会","理财","演唱会","曲艺","益智","音乐",
"舞蹈","体育娱乐","游戏","生活");
  $t6k= array("","流行","摇滚","舞曲","电子","R&B","HIP-HOP","乡村","民族","民谣","拉丁","爵士","雷鬼","新世纪","古典","音乐剧","轻音乐");
  $t7k= array("","公开课","名人名嘴","文化","艺术","伦理社会","理工","历史","心理学","经济","政治","管理学","外语","法律","计算机","哲学","职业培训","家庭教育");
  $t8k= array("","明星资讯","电视资讯","电影资讯","音乐资讯","颁奖礼","戏剧","曲艺","艺术","魔术");
  $t9k= array("","社会资讯","科技资讯","生活资讯","军事资讯","财经资讯","时政资讯","法制");
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
       $t5nk=$t5k[$t];
       $t6nk=$t6k[$t];
       $t7nk=$t7k[$t];
       $t8nk=$t8k[$t];
       $t9nk=$t9k[$t];
       $tnk='';
if($wnk=="96") $tnk=$t1nk;else if($wnk=="97") $tnk=$t2nk;else if($wnk=="84") $tnk=$t3nk;else if($wnk=="100") $tnk=$t4nk;else if($wnk=="85") $tnk=$t5nk;
else if($wnk=="95") $tnk=$t6nk;else if($wnk=="87") $tnk=$t7nk;else if($wnk=="86") $tnk=$t8nk;else if($wnk=="91") $tnk=$t9nk;else $tnk=$t1nk;
      return $tnk;
}
function ykdy($url) {
  $t2k= array("武侠","警匪","犯罪","科幻","战争","恐怖","惊悚","纪录片","西部","戏曲","歌舞","奇幻","冒险","悬疑","历史","动作","传记","动画","儿童","喜剧","爱情","剧情","运动","短片","优酷出品");
  $uk= array("","1","2","3","4");
  $wk= array("96","97","84","100","85","95","87","86","91","98","99","94","103","104","105","89","90","88","171","172","174","175","176","177","178");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $unk=$uk[$u];
       $tnk=yk_tk($w);
if($wnk == "94"||$wnk == "103"||$wnk == "104"||$wnk == "105"||$wnk == "89"||$wnk == "90"||$wnk == "88"||$wnk == "171"||
$wnk == "172"||$wnk == "174"||$wnk == "175"||$wnk == "176"||$wnk == "177") $type="video";else $type="show";      
       $gk = '&g='.k_w($tnk);
if(t == "0") $gk='';else $gk=$gk;
       $pk = '&pt='.$unk;
if(u == "0") $pk='';else $pk=$pk;
    for($i=1;$i<=$p;$i++){
 $url1 ='https://list.youku.com/category/page?&type='.$type.'&c='.$wnk.''.$gk.''.$pk.'&s=6&p='.$i.'';
 $url2 ='https://list.youku.com/category/page?&type='.$type.'&c='.$wnk.''.$gk.'&s=6&loadNewCategory=true&p='.$i.'';
 $url3 ='https://list.youku.com/category/page?c=84&type=show&p=1';
 $url2 ='https://list.youku.com/category/page?c=96&type=show&p=1';
 $url4 ='https://www.youku.com/category/page?c=97&type=show&p=1';
 $url5 ='https://www.youku.com/category/data?c=96&g=%E7%A7%91%E5%B9%BB&s=6&p=1&type=show&loadNewCategory=true';
        $ut = m_v($url1);
preg_match_all('|"title":"([^>]+)"|ismU',$ut,$b1);
preg_match_all('|"subTitle":"([^>]+)"|ismU',$ut,$b2);
preg_match_all('|"videoId":"([^>]+)"|ismU',$ut,$b3);
preg_match_all('|"videoLink":"(.*)id_([^>]+).html"|ismU',$ut,$b4);
preg_match_all('|"summary":"([^>]+)"|ismU',$ut,$b5);
foreach($b1[1] as $k=>$v){
        $a1 = r_u($b1[1][$k]);
        $a2 = r_u($b2[1][$k]);
        $a3 = $b3[1][$k];
        $a4 = $b4[1][$k];
        $a5 = r_u($b5[1][$k]);
        //$a6 = 'http:'.$a5;
        $a7 = 'https://v.youku.com/v_show/id_'.$a3.'.html';
        $b7 = 'https://v.youku.com/v_show/id_'.$a4.'.html';
        /*$a9 = 'http://player.youku.com/embed/'.$a3.'';
        $a8 = 'http://pl.youku.com/playlist/m3u8?vid='.$a3.'&type=mp4';
        $a10 = 'http://player.youku.com/player.php/sid/'.$a3.'/v.swf';*/
if($wnk==95) $a7=$b7;else $a7=$a7;
        $ua = $a7;
        $ud = f_kd($ua);
        $tb='target="b"';
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" target="b">'.$a1.' ('.$a2.')('.$a5.')</a>';
echo $xml;
}}}
function ykdy0($url) {
  $tk= array("","1","2","3","4");
  $wk= array("96","97","84","100","85","95","87","86","91","98","99","94","103","104","105","89","90","88","171","172","174","175","176","177","178");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $unk=$uk[$u];
       $tnk=yk_tk($w);
if($wnk == "94"||$wnk == "103"||$wnk == "104"||$wnk == "105"||$wnk == "89"||$wnk == "90"||$wnk == "88"||$wnk == "171"||
$wnk == "172"||$wnk == "174"||$wnk == "175"||$wnk == "176"||$wnk == "177") $type="video";else $type="show";      
       $gk = '&g='.$tnk;
if(t == "0") $gk='';else $gk=$gk;
       $pk = '&pt='.$unk;
if(u == "0") $pk='';else $pk=$pk;
    for($i=1;$i<=$p;$i++){
 $url1 ='https://list.youku.com/category/page?&type='.$type.'&c='.$wnk.''.$gk.''.$pt.'&u=1&p='.$i.'';
 $url3 ='https://list.youku.com/category/page?c=84&type=show&p=1';
 $url2 ='https://list.youku.com/category/page?c=96&type=show&p=1';
        $ut = m_v($url1);
preg_match_all('|"title":"([^>]+)"|ismU',$ut,$b1);
preg_match_all('|"subTitle":"([^>]+)"|ismU',$ut,$b2);
preg_match_all('|"videoId":"([^>]+)"|ismU',$ut,$b3);
preg_match_all('|"videoLink":"(.*)id_([^>]+).html"|ismU',$ut,$b4);
preg_match_all('|"summary":"([^>]+)"|ismU',$ut,$b5);
foreach($b1[1] as $k=>$v){
        $a1 = r_u($b1[1][$k]);
        $a2 = r_u($b2[1][$k]);
        $a3 = $b3[1][$k];
        $a4 = $b4[1][$k];
        $a5 = r_u($b5[1][$k]);
        //$a6 = 'http:'.$a5;
        $a7 = 'https://v.youku.com/v_show/id_'.$a3.'.html';
        $b7 = 'https://v.youku.com/v_show/id_'.$a4.'.html';
        /*$a9 = 'http://player.youku.com/embed/'.$a3.'';
        $a8 = 'http://pl.youku.com/playlist/m3u8?vid='.$a3.'&type=mp4';
        $a10 = 'http://player.youku.com/player.php/sid/'.$a3.'/v.swf';*/
if($wnk==95) $a7=$b7;else $a7=$a7;
        $ua = $a7;
        $ud = f_kd($ua);
        $tb='target="b"';
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" target="b">'.$a1.' ('.$a2.')('.$a5.')</a>';
echo $xml;
}}}
function ykdy1($url) {
  $wk= array("96","97","84","100","85","95","87","86","91","98","99","94","103","104","105","89","90","88","171","172","174","175","176","177","178");
  $tk= array("","1","2","3","4");
  $uk= array("","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $tk='';
       $wnk=$wk[$w];
       $unk=$uk[$u];
       $tnk='';
       $tnk=yk_tk($w);
if($wnk == "94"||$wnk == "103"||$wnk == "104"||$wnk == "105"||$wnk == "89"||$wnk == "90"||$wnk == "88"||$wnk == "171"||
$wnk == "172"||$wnk == "174"||$wnk == "175"||$wnk == "176"||$wnk == "177") $type="video";else $type="show";   
       $gk = '&g='.$tnk;
if(t == "0") $gk='';else $gk=$gk;
       $pk = '&pt='.$unk;
if(u == "0") $pk='';else $pk=$pk;
    for($i=1;$i<=$p;$i++){
 $url1 ='https://list.youku.com/category/page?&type='.$type.'&c='.$wnk.''.$gk.''.$pt.'&u=1&p='.$i.'';
 $url3 ='https://list.youku.com/category/page?c=96&g=%E7%A7%91%E5%B9%BB&u=1&pt=0&type=show&p=1';
        $ut = m_v($url1);
preg_match_all('|"title":"([^>]+)"(.*)"subTitle":"([^>]+)"(.*)"videoId":"([^>]+)"(.*)"videoLink":"([^>]+)"|ismU',$ut,$b);
foreach($b[1] as $k=>$v){
        $a2 = r_u($b[1][$k]);
        $a3 = r_u($b[3][$k]);
        $a4 = $b[5][$k];
        $a5 = x_g($b[7][$k]);
        $a6 = 'http:'.$a5;
        $a7 = 'https://v.youku.com/v_show/id_'.$a4.'.html';
        $a9 = 'http://player.youku.com/embed/'.$a4.'';
        $a8 = 'http://pl.youku.com/playlist/m3u8?vid='.$a4.'&type=mp4';
        $a10 = 'http://player.youku.com/player.php/sid/'.$a4.'/v.swf';
        $ua = $a7;
        $ud = f_kd($ua);
        $fn = ''.$fname.'?&ykdsj='.$a4.'&wid='.yk_wid( $a7 ).'&p='.$p.'&wnk='.$wnk.'&name='.$a2.'';
        $tg='target="b1"';
        $tb='target="b"';
   if ($wnk == '96'||$wnk == '95'||$wnk == '86'||$wnk == '91'||$wnk == '94'||$wnk == '103'||$wnk == '104'||$wnk == '105'||$wnk == '89'
||$wnk == '90'||$wnk == '88'||$wnk == '171'||$wnk == '172'||$wnk == '174'||$wnk == '175') $ud=$ud;else $ud=$fn;
   if ($wnk == '96'||$wnk == '95'||$wnk == '86'||$wnk == '91'||$wnk == '94'||$wnk == '103'||$wnk == '104'||$wnk == '105'||$wnk == '89'
||$wnk == '90'||$wnk == '88'||$wnk == '171'||$wnk == '172'||$wnk == '174'||$wnk == '175') $tg=$tb;else $tg=$tg;
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" '.$tg.' >'.$a2.' ('.$a3.')</a>';
echo $xml;
}}}
function yk_fs($url) {
        $ul = "http://list.youku.com/category/show/c_96_u_0_s_6_d_1_p_1.html";
        $ut = m_v($ul);
preg_match_all("|<li><a  href=\"\/category\/([^>]+)\/c_([^>]+).html\">([^>]+)<\/a><\/li>|ismU",$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d[2][$k];
        $a4 = $d[3][$k];
        $a5 = '"'.$a3.'"=>"'.$a4.'",';
        $a7 = print $arr['fruit'];
        //$a6 =  substr_replace($a5,"",-1); 
        //$a7 = substr($a6,0,strlen($a6)-1); 
   return $a5;
//$xml ='<a>'.$a6.'</a>';
//echo $xml;
}}
function yk_ts($url) {
        $ul = "http://list.youku.com/category/show/c_96_u_0_s_6_d_1_p_1.html";
        $ut = f_g($ul);
preg_match_all("|<li ><a href=\"(.*)\/category\/show\/c_96_s_6_d_1_g_([^>]+).html\">([^>]+)<\/a><\/li>|ismU",$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = $d[1][$k];
        $a3 = $d[2][$k];
        $a4 = $d[3][$k];
        $a5 = '"'.$a3.'"=>"'.$a4.'",';
        $a6 = '"'.$a4.'",';
        //$a6 =  substr_replace($a5,"",-1); 
        //$a7 = substr($a6,0,strlen($a6)-1); 
   //return $a5;
$xml ='<a>'.$a5.'</a>';
echo $xml;
}}

function y_ds($url) {
     $url='http://play-ali.youku.com/play/get.json?vid='.$url.'&ct=10&time=1477477932296';
        $ul = f_g($url);
preg_match_all('|"encodeid":"([^>]+)",|ismU',$ul,$d);
foreach($d[1] as $k=>$v){
        $ud = $d[1][$k];
   return $ud;
}}
function y_ds2($url) {
        $ut = f_g($url);
preg_match_all('|<div class="item  current" name="tvlist"(.*)item-id="([^>]+)" title="([^>]+)"><a(.*)href="([^>]+)"(.*)><span class="sn_num">([^>]+)</span></a><div(.*)vid="([^>]+)"></div>|ismU',$ut,$d);
foreach($d[3] as $k=>$v){
        $ud = 'http:'.$d[5][$k];
   return $ud;
}}
function yk_id($url) {
preg_match('|(.*)id_([^>]+).html|U',$url,$d);
        $ud = $d[2];
   return $ud;
}
function yk_wid($url) {
        $ut= m_v($url);
preg_match("|showid: '([^>]+)'|U",$ut,$d);
        $ud = $d[1];
   return $ud;
//echo $ud;
}
function ykvdy($url) {
  $wk= array(10005,10005,10006,10007,10008);
  $t1k= array("","科幻","武侠","警匪","犯罪","战争","恐怖","惊悚","纪录片","传记","悬疑","剧情","冒险","西部","奇幻","历史","爱情","动作","儿童","动画","戏曲","运动","短片");
  $t2k= array("","古装","武侠","警匪","军事","神话","科幻","悬疑","历史","儿童","农村","都市","家庭","搞笑","偶像","言情","时装","优酷出品");
  $t3k= array("","人物","军事","历史","自然","古迹","探险","科技","文化","刑侦","社会","旅游");
  $t4k= array("","热血","格斗","恋爱","美少女","校园","搞笑","LOLI","神魔","机战","科幻","真人","青春","魔法","神话","冒险","运动","竞技","童话","亲子","教育","励志","剧情","社会","历史","战争");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk=$wk[$w];
       $tnk='';
       $t1nk=$t1k[$t];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
   if ($w == '4') $tnk=$t4nk;else if ($w == '3') $tnk=$t3nk;else if ($w == '2') $tnk=$t2nk;else $tnk=$t1nk;
    for($ii=1;$ii<=$p;$ii++){
 $url1 ='http://vip.youku.com/ajax/filter/filter_data?tag='.$wnk.'&pl=30&pt='.$u.'&ar=0&mg='.$tnk.'&y=0&cl=1&o=0&pn='.$ii.'&banner=1';
 $url4 ='http://vip.youku.com/ajax/filter/filter_data?tag=10005&pl=30&pt=1&ar=0&mg=科幻&y=0&cl=1&o=0&pn=1&banner=1';
        $ul = m_v($url1);
 preg_match("#\"result\":\[\{(.*)\}\]\}\}#U",m_v($url1),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["showlastupdate"];
       $a5 = r_u($a0["showname"]);
       $a6 = r_u($a0["showsubtitle"]);
       $a4 = x_g($a0["firstepisode_videourl"]);
       $a3 = $a0["firstepisode_videoid"];
       //$a7 = $a0["showid"];
        $a8 = $a1; 
        //$ua2 = yk_id($a4);
 if ($wnk == '10005') {
        $tg='target="b"';
        $ud0 = $a4;
        $ud = f_kd( $ud0 );
   }else {
        $tg='target="b1"';
        $ua = $a3;
        $ud0 = $a4;
        //$ud0 = 'https://v.youku.com/v_show/id_'.$ua2.'.html';
        $ud = ''.$fname.'?&ykdsj='.$ua.'&wid='.yk_wid( $ud0 ).'&p='.$p.'&wnk='.$wnk.'';
   }
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" '.$tg.' >'.$a5.' ('.$a6.') ('.$a8.')</a>';
echo $xml;
}}}
function bfdy($url) {
       $w = $_GET['w']?$_GET['w']:1;
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.baofeng.com/1080p/3/list-type-'.$w.'-sid-1-p-'.$p.'.shtml';
        $ul = m_v($url);
 preg_match_all('|<p class="hot-pic-tit clearfix">(.*)</p>|imsU',$ul,$c);
 foreach ($c[1] as $ks=>$vs){
 preg_match_all('|<a href="([^>]+)" target="_blank" class="hot-pic-name" title="([^>]+)">(.*)</a>|imsU',$vs,$b);
        foreach($b[1] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[2][$k];
        $a8 = 'http://www.baofeng.com/'.$a4.'';
        $ua =  $a8;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}}
function bfdsj($url) {
       $w = $_GET['w']?$_GET['w']:2;
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ul = 'http://www.baofeng.com/1080p/3/list-type-'.$w.'-sid-1-p-'.$p.'.shtml';
       $ut = m_v($ul);
 preg_match_all('#<p class="hot-pic-tit clearfix"><a href="([^>]+)" target="_blank" class="(.*)" title="(.*)">(.*)</a></p>#U',$ut,$c);
    foreach($c[1] as $k=>$v){
       $a3 = $c[1][$k];
       $a4 = $c[2][$k];
       $a5 = $c[3][$k];
       $a6 ='http://www.baofeng.com'.$a3;
    $xml ='<a href="'.$fname.'?&bfdsj='.$a6.'&name='.$a5.'" >'.$a5.'</a>'."\n";
echo $xml;
}}
function yytmv($url) {
       $wk= array("","3","4","5","6","24","25","26","27","28","29","50","51","52","55","30","31","32","33","34","35","36","38","10","17","18","21","22","23","98","7");
       $tk= array("","8","10","9","11","12","13","14","15","16");
       $uk= array("","sh","shd","hd");
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:3;
       $tnk = $tk[$t];
       $wnk = $wk[$w];
       $unk = $uk[$u];
       $wtk = $tnk.';'.$wnk;
  if($t=="0" and $w=="0") $wtk=null;else $wtk=$wtk;
       for ($i = 1; $i <=$p; $i++) {
        //$p2 = '50'*$i;
	$ul2 = 'http://mv.yinyuetai.com/all.html?pageType=page&page='.$i.'&tab=allmv&parenttab=mv#sid=&tid=&a=&p=&c='; 
	$ul = 'http://mvapi.yinyuetai.com/mvchannel/so?callback=success_jsonpCallback_so&sid='.$wtk.'&tid=&a=&p=&c='.$unk.'&s=pubdate&pageSize=20&page='.$i.''; 
	//$ul1 = 'http://soapi.yinyuetai.com/search/video-search?callback=jQuery1102040496006277611196_1538736167805&keyword='.$w.'&pageIndex='.$i.'&pageSize=24&offset=0&orderType=&area=&property=&durationStart='.$tt.'&durationEnd=&regdateStart=&regdateEnd=1538736170&clarityGrade=&source=&thirdSource=';
	$b = @file_get_contents($ul);
        $m =str_ireplace("'",'"',$b);
preg_match_all('|"videoId":([^<]+),"title":"([^<]+)",|imsU',$m,$d);
preg_match_all('|"labelContent":"([^<]+)",|imsU',$m,$d2);
preg_match_all('|"duration":"([^<]+)",|imsU',$m,$d3);
preg_match_all('|"videoType":"([^<]+)",|imsU',$m,$d4);
foreach ($d[1] as $k=>$v){
        $a2 = explode('http://v.yinyuetai.com/video/', $v);
        $a3 = $d[1][$k];
        $a4=m_u($d[2][$k]);
        $a5=$d2[1][$k];
        $a6=$d3[1][$k];
        $a7=$d4[1][$k];
        $a8='http://v.yinyuetai.com/video/'.$a3.'';
        $ua =  $a8;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$a6.')-('.$a5.')('.$a7.')</a>';
echo $xml;
}}}
function ytpmv($url) {
       $wk= array("","3%3B10","4%3B11","9%3B16","5%3B12","6%3B13","7%3B14","8%3B15");
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk = $wk[$w];
       for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://www.1ting.com/mv/top/0/'.$p.'.html'; 
	$ut = m_v($ul);
preg_match_all('|<a href="([^<]+)" class="u-cover"(.*)>(.*)<img(.*)alt="(.*)"(.*)/>|imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = $d[5][$k];
       //$a5 = $d2[1][$k];
       $a6 ='http://www.1ting.com'.$a3;
       $ua =  $a6;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.'</a>';
echo $xml;
}}}
function kkxmv($url) {
       $wk= array("","431","1027","281","1021","26","421","1066","31","120","156","651","1011");
       $w2k= array("1","2","3","4");
       $tk= array("cataId","type");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $p2 = $p*50;
       $wnk1 = $wk[$w];
       $wnk2 = $w2k[$w];
    if($t=="1") $wnk=$wnk2;else $wnk=$wnk1;
       $tnk = $tk[$t];
       $ul1 = 'http://www.kktv5.com/CDN/output/M/3/I/10002032/P/partId-'.$wnk.'_start-0_offset-10000_platform-1/json.js';
       $ul2 = 'http://www.kktv5.com/CDN/output/M/3/I/55000003/P/'.$tnk.'-'.$wnk.'_start-0_offset-'.$p2.'_platform-1_a-1_c-100101/json.js';
       $ul3 = 'http://www.kktv5.com/CDN/output/M/3/I/20010302/P/'.$tnk.'-'.$wnk.'_start-0_offset-'.$p2.'_platform-1_a-1_c-100101/json.js';
       $ul4 = 'http://www.kktv5.com/CDN/output/M/3/I/50001004/P/c-1_a-1_platform-1/json.js';
    if($t=="1") $ul=$ul2;else $ul=$ul3;
       $ut = m_v($ul);
preg_match_all('|"userId":(.*),|ismU',$ut,$d);
preg_match_all('|"nickname":"(.*)"|ismU',$ut,$d1);
preg_match_all('|"roomId":(.*),|ismU',$ut,$d2);
preg_match_all('|"liveStream":"(.*)"|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d1[1][$k]);
       $a4 = $d2[1][$k];
       $a5 = $d3[1][$k];
       $a6 = 'http://pull.kktv8.com/livekktv/'.$a2.'.flv';
     $xml ='<a href="../v.htm?a=&f='.$a5.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function sgdy($url) {
      $tk= array("dianying","dianying","dianshiju","zongyi","dongman");
      $wk= array("","aiqing","donghua","dongzuo","jilupian","jingsong","jingfei","juqing","kehuan","kongbu","linli","qihuan","qingchun","weidianying","wenyi","wuxia",
"xiju","xuanyi","yinyue","zhanzheng","qita");
      $uk= array("","good","new");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $wnk = $wk[$w];
       $unk = $uk[$u];
       $tnk = $tk[$t];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
        $url ='http://kan.sogou.com/'.$tnk.'/'.$wnk.'---'.$unk.'-'.$i.'/';
        $tit = "tit";
        $nn = "nn";
        $cls = "";
   if($w == 0 ||$w == 1||$w == 2){$cls=$tit;}else{$cls=$nn;};
        $ul = m_v($url);
   preg_match_all('#<div class="btn-wrap">(.*)<a href="([^>]+)"(.*)>(.*)</a>#ismU',$ul,$b);
   preg_match_all('#<p class="'.$cls.'"(.*)>(.*)<a href="([^>]+)"(.*)>([^>]+)</a>#ismU',$ul,$b1);
   preg_match_all('#<p class="text_over"(.*)>([^>]+)</p>#ismU',$ul,$b2);
   foreach($b1[2] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = $b1[3][$k];
        $a4 = $b1[5][$k];
        $a5 = $b2[2][$k];
        $a6 ='http://kan.sogou.com'.$a3.'';
    //$xml ='<a href="'.$a6.'"  target="b1" >'.$a4.'</a>'."\n";
    $xml ='<a href="'.$fname.'?&name='.$a4.'&sgdy='.$a6.'"  target="b1" >'.$a4.'</a>'."\n";
echo $xml;
}}}
function h123dy($url) {
      $wk= array("movie","movie","tvplay","tvshow","comic");
      $uk= array("%E7%A7%91%E5%B9%BB","%E5%96%9C%E5%89%A7","%E6%81%90%E6%80%96","%E7%88%B1%E6%83%85","%E5%8A%A8%E4%BD%9C","%E7%A7%91%E5%B9%BB","%E6%88%98%E4%BA%89",
"%E7%8A%AF%E7%BD%AA","%E6%83%8A%E6%82%9A","%E5%8A%A8%E7%94%BB","%E5%89%A7%E6%83%85","%E5%8F%A4%E8%A3%85","%E5%A5%87%E5%B9%BB","%E6%AD%A6%E4%BE%A0","%E5%86%92%E9%99%A9",
"%E6%82%AC%E7%96%91","%E4%BC%A0%E8%AE%B0","%E8%BF%90%E5%8A%A8","%E9%9F%B3%E4%B9%90","%E7%BD%91%E7%BB%9C%E5%A4%A7%E7%94%B5%E5%BD%B1");
      $u2k= array("科幻","喜剧","恐怖","爱情","动作","科幻","战争","犯罪","惊悚","动画","剧情","古装","奇幻","武侠","冒险","悬疑","传记","运动","音乐","网络大电影");
      $tk= array("pubtime","hot","rating");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $wnk = $wk[$w];
       $unk = $uk[$u];
       //$unk2 = $uk2[$u];
       //$unkm = m_b($unk2);
       $tnk = $tk[$t];
       $zk = k_w("正片");
       $zk2 = "%E6%AD%A3%E7%89%87";
       $hk = k_w("花絮");
       $hk2 = "%E8%8A%B1%E7%B5%AE";
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
        $url2 ='http://v.hao123.com/'.$wnk.'_index/type-'.$unk.'_complete-'.$tnk.'_order-hot_pn-'.$i.'_channel-movie';
   $url ='http://v.hao123.com/commonapi/'.$wnk.'2level/?filter=false&type='.$unk.'&area=&actor=&start=&complete='.$zk.'&order='.$tnk.'&pn='.$i.'&rating=&prop=&channel='.$wnk.'';
        $url4 ='http://v.hao123.com/commonapi/tvplay2level/?filter=true&type='.$unk.'&area=&actor=&start=&complete='.$tnk.'&order=hot&pn='.$i.'&rating=&prop=&channel=tvplay';
        $ul = m_v($url);
   preg_match_all('#"title":"([^>]+)","id":"([^>]+)",#ismU',$ul,$b);
   preg_match_all('#"url":"([^>]+)","hao123_url":"([^>]+)","player_url":"([^>]+)"#ismU',$ul,$b1);
   preg_match_all('#"works_id":"([^>]+)"#ismU',$ul,$b2);
   preg_match_all('#"site_url":"([^>]+)"#ismU',$ul,$b3);
   foreach($b[1] as $k=>$v){
        $a2 = r_u($b[1][$k]);
        $a3 = $b[2][$k];
        $u3 = 'http://v.hao123.com/person_intro/?dtype=personWorks&service=json&ps=30&id='.$a3.'&wt=movie:tvplay:show&callback=jQuery111103896039162962288_1488105628551';
        $u4 = 'http://v.hao123.com/dianying_intro/?dtype=playUrl&service=json&e=1&id='.$a3.'&callback=jQuery111108648766243499958_1488152950690&_=1488152950699';
        $u5 = 'http://v.hao123.com/dianying/'.$a3.'.htm';
        //$au = hao_u4($a3);
        $a4 = x_g($b1[1][$k]);
        $a5 = x_g($b1[2][$k]);
        $a6 = x_g($b1[3][$k]);
        $a7 = x_g($b2[1][$k]);
        $a8 = x_g($b3[1][$k]);
        $ut2 = f_g($u4);
   preg_match_all('#"link":"([^>]+)","site":"([^>]+)"#ismU',$ut2,$d);
   foreach($d[1] as $k2=>$v2){
        $ua1 = x_g($d[1][$k2]);
        $ua2 ='http://v.hao123.com'.$ua1;
        $ua3 = $d[2][$k2];
   if(stripos($ua1,'http') === false){$ua4=$ua2;}else{$ua4=$ua1;};
        //$ua=g_u( $ua4 );
   if(stripos($ua4,'m3u8') === false){$a=$a;}else{$a='m3u8';};
        //$ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v2));
        $xml ='<a href="'.$ua4.'" target="b" >'.$a2.' ('.$ua3.')('.$a3.')</a>';
echo $xml;
}}}}

function hao_u3($url) {
        $ul = 'http://v.hao123.com/person_intro/?dtype=personWorks&service=json&ps=30&id='.$url.'&wt=movie:tvplay:show&callback=jQuery111103896039162962288_1488105628551';
        $ut = m_v($ul);
   preg_match_all('#"url":"([^>]+)"#ismU',$ut,$d);
   foreach($d[1] as $k=>$v){
        $ua1 = x_g($d[1][$k]);
        $ua2 ='http://v.hao123.com'.$ua1;
   if(stripos($ua1,'http') === false){$ua=$ua2;}else{$ua=$ua1;};
      return $ua;
}}
function hao_u4($url) {
        $ul = 'http://v.hao123.com/dianying_intro/?dtype=playUrl&service=json&e=1&id='.$url.'&callback=jQuery111108648766243499958_1488152950690';
        $ul2 = 'http://v.hao123.com/dianying_intro/?dtype=playUrl&service=json&e=1&id='.$url.'&callback=jQuery1111021273764217129187_1488178194644&_=1488178194653';
        $ut = m_v($ul);
   preg_match_all('#"link":"([^>]+)"#ismU',$ut,$d);
   foreach($d[1] as $k=>$v){
        $ua1 = x_g($d[1][$k]);
        $ua2 ='http://v.hao123.com'.$ua1;
   if(stripos($ua1,'http') === false){$ua=$ua2;}else{$ua=$ua1;};
      $ul = $ua;  
      return $ua;
}}
function hao_u5($url) {
        $ul = 'http://v.hao123.com/dianying/'.$url.'.htm';
        $ut = m_v($ul);
   preg_match('#<div class="poster-sec">(.*)</div>#ism',$ut,$d);
   preg_match_all('#<a href="([^>]+)"(.*)data-site="([^>]+)"(.*)title="([^>]+)"#ismU',$d[1],$d2);
   foreach($d2[1] as $k=>$v){
        $ua1 = $d2[1][$k];
        $ua2 ='http://v.hao123.com'.$ua1;
   if(stripos($ua1,'http') === false){$ua=$ua2;}else{$ua=$ua1;};
      $ul = $ua;  
      return $ul;
}}
function hao_t($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    ob_start();
    curl_exec($ch);
    ob_end_clean();
    $data = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); 
    return $data;
}
function fhzmv($url) {
  $wk= array("1","2","5","6","7","8","9","10","11","12","14","15","55","57","61","66","70","85","91","94","105","118","129","140","145","135");
  $wk2= array("all","infor","vari","doc","mili","ent","nius","pubcls","hist","orig","fash","tv");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $size = "25";
       $date = "2017";
       $wnk=$wk[$w];
    if($w <= '30') $wnk2 =$wnk;else $wnk2=$w;
    for($i=1;$i<=$p;$i++){
       $ul0 ='http://v.ifeng.com/vlist/channel/'.$wnk2.'/showData/first_more.js';
       $ul3 ='http://v.ifeng.com/vlist/channel/'.$wnk2.'/" + date + "/'.$size.'/channel_more.js';
       $ul1 ='http://v.ifeng.com/vlist/nav/'.$wnk2.'/'.$i.'/list.shtml';
       $ul2 ='http://v.ifeng.com/vlist/nav_category/'.$wnk2.'_'.$t.'/'.$i.'/list.shtml';
    if($wnk == 'infor') $ul =$ul2;else $ul =$ul1;
        $ut = m_v($ul0);
 preg_match_all('#<li><a href="([^>]+)"(.*)>(.*)data-guid="([^>]+)">(.*)<span>([^>]+)</span></div><h3>([^>]+)</h3>(.*)<span class="upTime">([^>]+)</span></div></li>#ismU',$ut,$b);
 foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[4][$k];
        $a3 = $b[6][$k];
        $a4 = m_u($b[7][$k]);  
        $a5 = $b[9][$k];  
        $ua =  $a1;
        $ua =  f_ht($ua);
        $fn = ''.$fname.'?&fh_tv='.$ua.'&name='.$a2.'';
        $tg='target="b1"';
        $tb='target="b"';
    if($wnk == 'vari') $ud=$fn;else $ud =$ud;
    if($wnk == 'tv') $ud=$fn;else $ud =$ud;
    if($wnk == 'vari') $tg=$tg;else $tg=$tb;
    if($wnk == 'tv') $tg=$tg;else $tg=$tb;
        $ud1 = f_ud(f_ht($ua));
        $ud2 = '../ck/ck.php?a=tv&f='.fhf($ua);
if($a=="stv") $ud=$ud1;else $ud=$ud2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" '.$tg.' >'.$a5.': '.$a4.'('.$a3.')</a>';
echo $xml;
}}}
function fhmv($url) {
       $tk= array("95102","95095","95022","95224","95366","95144","95283","95171","95239","95273");
       $w = $_GET['w']?$_GET['w']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:3;
       $tnk=$tk[$t];
      for ($ii = 1; $ii <=$p; $ii++) {
       $ul = 'https://shankapi.ifeng.com/shanklist/getVideoStream/'.$ii.'/24/27-'.$tnk.'-/1/getVideoStream?callback=getVideoStream';
 preg_match("#\"data\":\{\"data\":(.*),\"total\"#U",m_v($ul),$b);
       $nt = J_d($b[1]);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = m_u($a0["title"]);
       $a2 = $a0["newsTime"];
       $a3 = $a0["guid"];
       $a4 = $a0["base62Id"];
       $a5 = $a0["url"];
       $a6 = $a0["commentUrl"];
        $ua1 =  f_ht($a5);
        $ua = fhf($ua1);
        $ud = f_ul($ua);
        $vd=Current(explode('?',$v));
   $xml ='<a href="'.$ud.'" target="b">'.$a1.'('.$a2.')</a>';
echo $xml;
}}}
function fhf($url) {
       $ul = $_GET['w']?$_GET['w']:$url;
  preg_match('|"url":"(.*)","videoPlayUrl":"([^>]+)","m3u8Url"|ism',m_v($ul),$d);
       $a3 = $d[2];
       $ud =$a3;
return $ud;
//echo $ud;
}
function fhv($url) {
       //$url = $_GET['w']?$_GET['w']:$url;
       $ut = m_v($url);
  preg_match('|"id":"(.*?)","vid":"(.*?)","cid":"(.*?)","cdate":"(.*?)","sign":"(.*?)","param":"(.*?)"|ims', $ut, $d);
       $a1 = $d[1];
       $a2 = $d[2];
       $a3 = $d[3];
       $a4 = $d[5];
       $a5 = $d[6];
       $ur='http://dyn.v.ifeng.com/cmpp/GetVipPlayerXml?id='.$a2;
       $ul= f_g($ur);
  preg_match('|VideoPlayUrl="([^<]+)"(.*)PlayerUrl="|',$ul, $d2);
       $id = $d2[1];
       $ud = $id;
return $ud;
}
function xgdy($url) {
       $tk= array("movie","lvideo_pc_homepage","lvideo_pc_drama","lvideo_pc_movie","lvideo_pc_variety","lvideo_pc_shaoer","lvideo_pc_dm","lvideo_pc_jilupian");
       $wk= array("130","0","145","150","151","147","143","153","130","161","158","159","157","156","154","129","163","131");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $tnk=$tk[$t];
       $wnk=$wk[$w];
 $ul1 ='http://is.snssdk.com/api/news/feed/v51/?&category=subv_xg_'.$tnk.'&tag='.$wnk.'&page_type='.$p.'&utm_source=dianyin&tadrequire=true&refer=1';
 $ul2 ='https://www.365yg.com/api/pc/feed/?&category=subv_xg_'.$tnk.'&tag='.$wnk.'&page_type='.$p.'&utm_source=movie&tadrequire=true';
       $ut = J_d(m_s($ul1),True);
       $aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = r_u($a0["content"]["abstract"]);
       $a5 = $a0["content"]["item_id"];
       $a2 = $a0["video_id"];
       $a3 = $a0["behot_time"];
       $a4 = $a0["content"]["group_id"];
       $ud2 = 'https://www.ixigua.com/embed?group_id='.$a4;
       $ud = 'https://www.ixigua.com/iframe/'.$a4.'?autoplay=1&startTime=0';
       $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a1.' ('.$a5.')</a>';
echo $xml;
}}
function ppdy($url) {
       $wk= array("1","211280","100","124","101","104","102","103","125","126","127","128","129","130","131","132","133","134","135","136","209","75261","75281",
"2","138","139","140","141","142","143","144","145","146","147","148","149","150","151","152","184");
       $tk= array("0","1","2","3");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk= $wk[$w];
       $tnk= $tk[$t];
       for ($i = 1; $i <=$p; $i++) {
	$ul = 'http://list.pptv.com/?type=1';
	$ul1 = 'http://list.pptv.com/channel_list.html?page=2&type=2&sort=1&ft=0&status=4';
	$ul2 = 'http://list.pptv.com/channel_list.html?&type='.$wnk.'&sort=1&contype=0&ft='.$tnk.'&pay='.$u.'&page='.$i.'';
        $ut = m_v($ul2);
preg_match_all("#<a class=\"ui-list-ct\"(.*)cid=\"([^>]+)\" href='([^>]+)'(.*)title=\"([^>]+)\">#ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=$d[3][$k];
        $a5=$d[5][$k];  
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $fn = ''.$fname.'?&ppdsj='.$ua.'&name='.$a5.'';
        $tg='target="b1"';
        $tb='target="b"';
    if($w >= '23') $ud=$fn;else $ud =$ud;
        $v=Current(explode('-',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
	}} }
function ppdsj($url) {
       $w = $_GET['w']?$_GET['w']:1;
       for ($i = 1; $i <=5; $i++) {
	$ul = 'http://list.pptv.com/channel_list.html?page='.$i.'&type=2&sort=1';
        $ut = m_v($ul);
preg_match_all("#href='([^>]+)' target='_blank' title=\"(.*)\">(.*)<p class=\"ui-pic\">#ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=$d[1][$k];
        $a5=$d[2][$k];    
        $ua =  $a4; 
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $v=Current(explode('-',$v));
    $xml ='<a href="'.$fname.'?&ppdsj='.$a4.'&name='.$a5.'" >'.$a5.'</a>'."\n";
echo $xml;
	}} }
function n1905dy($url) {
  $tk= array("0","16","5","8","1","17","15","19","13","20","27","20","30","14","3","36","25");
       $w = $_GET['w']?$_GET['w']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $tnk= $tk[$t];
    for($i=1;$i<=$p;$i++){
	$ul = 'http://www.1905.com/vod/list/n_'.$w.'_t_'.$tnk.'/o1p'.$i.'.html';
        $ut = m_v($ul);
preg_match_all('#<a class="pic-pack-outer" target="(.*)"(.*)href="(.*)" title="([^>]+)">#imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=$d[3][$k];
        $a5=$d[4][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('-',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}
function v6_d($url) {
       $url = $_GET['w']?$_GET['w']:$url;
       $ut = h_s($url);
//preg_match("#a:'([^>]+)',#U",m_v($ut),$d);
       //$id=$d[1];
       //$ud = $id;
//return $ud;
echo $ut;
}
function v6dy($url) {
  $wk= array("kehuanpian/","xijupian/","dongzuopian/","aiqingpian/","kongbupian/","juqingpian/","zhanzhengpian/","jilupian/","donghuapian/","dianshiju/","ZongYi/");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk= $wk[$w];
    for($i=1;$i<=$p;$i++){
       if($i=="1") $p1="";else $p1='_'.$i;
	$ul = 'https://www.6vdy.org/'.$wnk.'index'.$p1.'.html';
        $ut = m_v($ul);
preg_match_all('#<h2>(.*)<a href="([^>]+)"(.*)title="([^>]+)">([^>]+)</a>(.*)</h2>#imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=$d[2][$k];
        $a5=m_u($d[4][$k]);
preg_match('#href= "([^>]+)&pathid2=0([^>]+)"(.*)class="lBtn"(.*)>#ism',m_v($a4),$d2);
        $a6=$d2[1].'&pathid2='.$d2[2];
        //$a61=t_zh($a6);
//preg_match("#a:'([^>]+)',#",f_g($a6),$d4);
        //$a7=$d4[1];
        $ua =  $a6;
        //$ua =  f_ht($ua);
        //$ud = f_kd(f_ht($ua));
        $vd=Current(explode('-',$v));
	$xml ='<a href="'.$ua.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}
function zhanq($url) {
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;++$i){
       $shurl = 'http://www.zhanqi.tv/api/static/game.lives/45/50-'.$i.'.json';
       $ut = m_v($shurl);
  preg_match_all('|"url":"([^>]+)","title":"([^>]+)","gameId"|ismU',$ut, $d);
  preg_match_all('|"spic":"([^>]+)","bpic|',$ut, $nm);
  foreach ($d[1] as $k => $v){
       $a2=$d[1][$k];
       $a3 = str_replace('\/','',$a2);
       $a4=$d[2][$k];
       $name= htmlspecialchars($a4);
       $a5 = zhanq2($a3);
       $ua = $a5;
        $ua =  f_ht($ua);
       $ud = '../ck.php?a=tv&f='.$ua.'';
	$xml ='<a href="'.$ud.'" target="b" >'.$name.'</a>';
       //$xml ='<a href="'.$fname.'?&zqlid='.$a3.'&name='.$name.'" >'.$name.'</a>'."\n";
echo $xml;
}}}
function zhanq2($url) {
       $ul= 'http://www.zhanqi.tv/'.$url;
       $ut = m_v($ul);
       preg_match('|"videoId":"(.*?)"|i', $ut, $vid);
       $a3 = 'http://zqcdn.ebit.cn/zqlive/'.$vid[1].'.flv';
       $a4 = 'http://yfrtmp.cdn.zhanqi.tv/zqlive/'.$vid[1];
       $a5 = 'http://yfhdl.cdn.zhanqi.tv/zqlive/'.$vid[1];
       $ua = $a5;
return $ua;
}
function n91dy($url) {
       $p = $_GET['p']?$_GET['p']:1;
        for($i=1;$i<=$p;$i++){
        $url ='http://www.9le8.com/Program/n-p-9-d-'.$i.'';
        $ul = m_v($url);
preg_match_all('#<a target="_blank" href="([^>]+)"><img src="(.*)" title="([^>]+)" class="(.*)" /></a>#ismU',$ul,$b);
foreach($b[1] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[3][$k];
        $url2 ='http://www.9le8.com'.$a4.'';
        $ul2 = f_g($url2);
preg_match_all("#var url='([^>]+)&(.*)'#ismU",$ul2,$b2);
foreach ($b2[1] as $kk=>$vv){
        $a6 = $b2[1][$kk];  
        $ua =  $a6;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$vv));
     $xml ='<a href="'.$a6.'" target="b" >'.$a5.'</a>';
echo $xml;
}}}} 
function cutv2($url) {
        $ul ='http://liveapp.cutv.com/crossdomain/timeshiftinglive/getTSLAllChannelList/first/cutv';
        $st = m_v($ul);
   preg_match_all("#\{\"name\":\"([^>]+)\",\"id\":\"([^>]+)\"#ismU",$st,$b);
        foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[2][$k];
        $a3 ='http://www.zhiboba.cc/app/cutvzb.html?id='.$a2;
        $a4 ='http://tv.cutv.com/player/cv.swf?channelId='.$a2;
        $a5 = r_u($a1); 
        $a6 =m_g($a5);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a4.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
function pd_163($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $ul= 'http://c.open.163.com/open/mob/movie/list.do?plid='.$w;
 preg_match("#\"videoList\":\[\{(.*)\}\],\"isStore\":false,\"isDocumentary\"#U",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       //$a2 = $a0["mp4HdUrl"];
       //$a2 = $a0["mp4SdUrl"];
       //$a2 = $a0["mp4ShdUrl"];
       //$a2 = $a0["m3u8SdUrl"];
       //$a2 = $a0["m3u8HdUrl"];
       //$a2 = $a0["m3u8ShdUrl"];
       $a2 = $a0["mp4ShareUrl"];
return $a2;
//echo $ua;
}}
function pid_163($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $ul= 'http://c.open.163.com/open/mob/movie/list.do?plid='.$url;
       //preg_match('|(.*)"mp4HdUrl":"([^>]+)"|ism', m_v($ul), $d);
       //preg_match('|(.*)"mp4SdUrl":"([^>]+)"|U', m_v($ul), $d);
       //preg_match('|(.*)"mp4ShdUrl":"([^>]+)"|U', m_v($ul), $d);
       //preg_match('|(.*)"m3u8SdUrl":"([^>]+)"|U', m_v($ul), $d);
       preg_match('|(.*)"m3u8HdUrl":"([^>]+)"|U', m_v($ul), $d);
       //preg_match('|(.*)"m3u8ShdUrl":"([^>]+)"|U', m_v($ul), $d);
       //preg_match('|(.*)"mp4ShareUrl":"([^>]+)"|U', m_v($ul), $d);
       $ua = $d[2];
return $ua;
//echo $ua;
}
function m163mv($url) {
       $wk= array("Video","Course");//("CompetitiveProducts","Special")
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
    //for($ii=1;$ii<=$p;++$ii){}
if($w<2) {
	$ul1 = 'https://c.open.163.com/open/pc/v2/search/search'.$wnk.'.do?keyword=&pageNum='.$p.'&pSize=12';
	//$ul4 = 'https://v.163.com/special/opencourse/aspacetimeodyssey.html';
	//$ul5 = 'https://so.open.163.com/getMovieListByType.htm?callback=movie&pagesize=17';
	//$ul6 = 'https://c.open.163.com/open/pc/v2/search/searchCourse.do?keyword=&pageNum=1&pSize=20';
	//$ul7 = 'https://vip.open.163.com/open/trade/mob/course/items.do?cursor=0&pagesize=21&contentType=1';
        $ut = m_s($ul1);
       $nt = J_d($ut,ture);
       $aa = $nt["dtos"];
} else {
	$ul1 = 'https://c.open.163.com/search/school.do?&school='.$kw.'&pageNum='.$p.'&pSize=12';
 preg_match("#\"dtos\":\[\{(.*)\}\]\}#U",m_s($ul1),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       //$ut = m_s($ul1);
       //$nt = J_d($ut,ture);
       //$aa = $nt["result"]["dtos"];
}
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["title"]);
       $a3 = $a0["courseId"];
       //$a3 = $a0["courseUid"];
       //$a31 = $a0["Url"];
       //$a32 = $a0["courseUrl"];
 //if($w=="1") $a3=$a32;else $a3=$a31;
  //preg_match("|(.*)\/([^>]+)_([^>]+).html|i",$a3,$d);
       //$a4 = pid_163($d[2]);  
       $a4 = pid_163($a3);  
       $ud = f_d($a4);  
       //$ud = f_kd(f_ht($a3));
       //$xml ='<a>'.$a3.'</a>';
       $xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
        //$a7='http://mov.bn.netease.com/movie/2011/3/Q/H/S6TUJ45QH-list.m3u8';
        //$a7='http://open.163.com/newview/movie/free?pid=MAFVHG7E7&mid=MAFVOI7RT';
        //$a7='http://c.open.163.com/mobile/free/gb/video?plid=MB74QHKL8&mid=MB74V0GS1';
    //$xml ='<a href="'.$fname.'?&mv163='.$a6.'&rd='.$a2.'&name='.$a4.'"  >'.$a4.' '.$a5.'</a>'."\n";
echo $xml;
}}
function m163mv0($url) {
       $wk= array("Video","Course","CompetitiveProducts","special","vip");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;++$i){
	$ul1 = 'https://c.open.163.com/open/pc/v2/search/search'.$wnk.'.do?keyword=&pageNum='.$i.'&pSize=20';
	//$ul4 = 'https://v.163.com/special/opencourse/aspacetimeodyssey.html';
	//$ul5 = 'https://so.open.163.com/getMovieListByType.htm?callback=movie&pagesize=17';
	//$ul6 = 'https://c.open.163.com/open/pc/v2/search/searchCourse.do?keyword=&pageNum=1&pSize=20';
	//$ul7 = 'https://vip.open.163.com/open/trade/mob/course/items.do?cursor=0&pagesize=21&contentType=1';
        $ut = m_s($ul1);
preg_match_all('|"id":"([^>]+)"(.*)"title":"([^>]+)"|ismU',$ut,$d1);
preg_match_all('|"id":"([^>]+)"(.*)"url":"([^>]+)"|ismU',$ut,$d2);
foreach ($d1[1] as $k=>$v){
        $a2=$d1[1][$k];
        $a3=m_u($d1[3][$k]);
        $a4=$d2[3][$k];
        $ud = f_kd(f_ht($a4));
        $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
    //$a7='http://open.163.com/newview/movie/free?pid=MAFVHG7E7&mid=MAFVOI7RT';
    //$a7='http://c.open.163.com/mobile/free/gb/video?plid=MB74QHKL8&mid=MB74V0GS1';
    //$xml ='<a href="'.$fname.'?&mv163='.$a6.'&rd='.$a2.'&name='.$a4.'"  >'.$a4.' '.$a5.'</a>'."\n";
echo $xml;
}}}
function n189mv($url) {
 $ul='http://pgmsvr.tv189.cn/program/getLiveChannels?useplat=1&format=xml';
        $ut = f_g($ul);
preg_match_all("|<channel liveid=\"([^>]+)\" name=\"([^>]+)\"|imsU",$ut,$b);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[2][$k];
        $ud ='../ck.php?a=str&f=http://localhost/ck/php/tv189.php?ck='.$a2;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'"  target="b" >'.$a3.'</a>';
echo $xml;
}}
function kktdy($url) {
       $w = $_GET['w']?$_GET['w']:1; 
 $ul1 ='http://api.app.kankanews.com/kankan/v5/livePC/stream/channel/?jsoncallback=jQuery111004845780842640952_1452209994388';
        $ut = m_v($ul1);
preg_match_all('|"appstream":"(.*)","pcstream":"(.*)",|imsU',$ut,$b);
preg_match_all('|"title":"(.*)","subtitle":"(.*)",|imsU',$ut,$b2);
foreach($b[1] as $k=>$v){
        $a2 = stripslashes($b[1][$k]);
        $a3 = stripslashes($b[2][$k]);
        $a4 = $b2[1][$k];
        $a5 = r_u($a4); 
        $ua =  $a3;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
function fhtv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
 $ul1 ='http://v.ifeng.com/live/js/scheduleurlall.js';
        $ut = m_v($ul1);
preg_match_all("|'([^>]+)':\{'name':'([^>]+)','url':'([^>]+)'\}|imsU",$ut,$b);
foreach($b[1] as $k=>$v){
        $a3 = $b[1][$k];
        $a4 = $b[2][$k];
        
        $ud = '../tv/fh.htm?f='.$a3.'';
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a4.'</a>';
echo $xml;
}}
function cutv($url) {
        $ul ='http://liveapp.cutv.com/crossdomain/timeshiftinglive/getTSLAllChannelList/first/cutv';
        $st = f_g($ul);
   preg_match_all("|\{\"name\":\"([^>]+)\",\"id\":\"([^>]+)\"|ismU",$st,$b);
   foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[2][$k];
        $a3 ='http://www.zhiboba.cc/app/cutvzb.html?id='.$a2;
        $a4 ='http://tv.cutv.com/player/cv.swf?channelId='.$a2;
        $a5 = r_u($a1);
        $a6 =m_u($a5);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a4.'" target="b" >'.$a6.'</a>';
echo $xml;
}}
function povmv($url) {
$xml = "";
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;++$i){
        $ul ='http://pov.com/?page='.$i;
        $ut = m_v($ul);
   preg_match_all('|<div class="details">(.*)<div class="title">(.*)<a  href=(.*)"/(.*)/">(.*)</a>(.*)<span class="age genderm">(.*)</span>|ismU',$ut,$d);
        foreach($d[1] as $k=>$v){
        $a3 = $d[4][$k];
        $a4 = $d[5][$k];
        $a5 = $d[6][$k];
        $a6 = 'http://pov.com/'.$a3;
        //$a7 = 'http://pov.com/static/flash/CBV_2p647.swf?pid='.$a3.'&tv=100&cv=100&address=edge28-b.stream.highwebmedia.com&language=viewer.xml&mute=0&pr=login_required_true_if_loggedin&sa=0&uid=AnonymousUser&jg=$.mydefchatconn('join_group_show')&jp=$.mydefchatconn('spy_on_private')&js=registration_required()&elu=logo.png&dom=chaturbate.com&pw=anonymous';
        $vd=Current(explode('?',$v));
     $xml ='<a href="http://pov.com/static/flash/CBV_2p647.swf?pid='.$a3.'&tv=100&cv=100&address=edge28-b.stream.highwebmedia.com&language=viewer.xml&mute=0&pr=login_required_true_if_loggedin&sa=0&uid=AnonymousUser&jg=1&jp=1&js=registration_required()&elu=1&dom=1&pw=anonymous" target="b" >'.$a4.'</a>';
echo $xml;
}}}
function yicmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
   if ($w == '')  $w='jinrigushi';else  $w=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i<=$p; $i++) {
	$ul = 'http://www.yicai.com/video/'.$w.'/index.html';
        $ut = f_g($ul);
preg_match_all('|<p><a href="([^<]+)" class="grey" target="_blank">(.*)</a></p>|imsU',$ut,$d);
preg_match_all('|<h2>([^<]+)</h2>|imsU',$ut,$d1);
foreach ($d[1] as $k=>$v){
       $a3=$d[1][$k];
       $a4=$d[2][$k];
       $a5=$d1[1][$k];
       $ut2 = m_v($a3);
preg_match_all('|<video src="(.*)"|imsU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a7=$d2[1][$k2];
       $ua =  $a7;
        $ua =  f_ht($ua);
        $ud2 = '../ap.php?a=tv&f='.$a7.'';
        $ud = f_kd(f_ht($ua));
        $v2=Current(explode('?',$v2));
        //header("location:$a7");
	$xml ='<a href="'.$ud.'" target="b" >'.$a4.'('.$a5.')</a>'. "\n";
echo $xml;
}}}}
function ledys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:-1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       //$url = 'http://le.so.letv.com/interface?&ph=420001,420002&mix=1&jf=1&hl=1&dt='.$t.'&from=pcjs&show=4&ps=14&pn=1&wd='.$w.'&e='.$i.'';
       //$url = 'http://le.so.letv.com/interface?&ph=420001,420002&dt=2&dur='.$t.'&jf=1&hl=1&from=pcjs&show=4&wd='.$w.'&e='.$i.'';
       $url = 'http://le.so.letv.com/interface?&ph=420001,420002&dt=2&or=1&dur='.$t.'&wd='.$w.'&e='.$i.'';
        $ul = m_v($url);
preg_match_all('|"vid":"(.*)",|imsU',$ul,$b);
preg_match_all('|"name":"(.*)",|imsU',$ul,$b2);
preg_match_all('|"mid":"(.*)",|imsU',$ul,$b3);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b2[1][$k];
        $a4 = $b3[1][$k];
        $a6 = 'http://www.letv.com/ptv/vplay/'.$a2.'.html';
        $ua =  $a6;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'&hd=720p" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function fhmvs($url) {
       $uk= array("","free","charge");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $u = $_GET['u']?$_GET['u']:0;
       $unk=$uk[$u];
       $p = $_GET['p']?$_GET['p']:2;
       $t=$_GET['t'];
   if ($t == '')  $t='0';else if ($t == '1')  $t='10';else if ($t == '2')  $t='30';else if ($t == '3')  $t='60';else $t=$_GET['t'];
       for ($i = 1; $i <=$p; $i++) {
	$ul2 = 'http://so.v.ifeng.com/video?q='.$w.'&c=5&s=1&pubtime=w&category=&dualt=-1&dualf='.$t.'&p='.$i.''; 
	$ul = 'http://so.v.ifeng.com/video?q='.$w.'&c=5&s=1&category=&dualt=-1&dualf='.$t.'&pubtime=&categoryroot='.$unk.'&p='.$i.''; 
        $ut = m_v($ul);
preg_match_all('|<h3><a href="([^>]+)"(.*)>(.*)</a></h3>(.*)<p>([^>]+)</p>|ismU',$ut,$d);
preg_match_all('|<span class="s_r_time">([^>]+)</span>|ismU',$ut,$d2);
preg_match_all('|<p>([^>]+)</p>(.*)</div>(.*)</li>|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
        $a2=$d[1][$k];
        $a3=$d[3][$k];
        $a4=$d2[1][$k];
        $a5=$d[5][$k];
        $a6=$d3[1][$k];
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd($ua);
        $ud2 = '../ck/ck.php?a=tv&f='.fhv($ua);
        $vd=Current(explode('?',$v));
	$xml='<a href="'.$ud2.'" target="b" >'.$a3.'('.$a4.')('.$a6.')</a>';
echo $xml;
}}}
function fundys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ur = 'http://www.fun.tv/search/pg-'.$p.'.word-'.$w.'';
       $ut = m_v($ur);
 preg_match_all('|<h3 class="tit">(.*)<a title="(.*)" href="/vplay/(.*)/"|ismU',$ut,$d);
    foreach($d[1] as $k=>$v){
       $a4 = $d[2][$k];
       $a5 = $d[3][$k];
       //$a6 = $d[3][$k];
       $a7='http://www.fun.tv/vplay/'.$a5.'/';
       $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml='<a href="'.$ud.'" target="b" >'.$a4.'</a>';
echo $xml;
 }}
function qqmvs($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:4;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:0;
for($i=1;$i<=$t;$i++){
 $url ='http://s.video.qq.com/search?comment=0&stype=0&plat=2&otype=json&query='.$kw.'&pver=0&tabid=0&sort=1&cur='.$p.'&num=20&start=0&end=0&stag=word.sort_latest&referrer=&rsrc=0&pltimefilter='.$t.'&pubtime=0&filter=20&query_type=0&callback=jQuery19103983879460474903_1422681823500&low_login=1';
 $url2 ='https://s.video.qq.com/load_poster_list_info?otype=json&callback=jQuery19109852637175992458_1556792961845&cur='.$i.'&num=10&plat=2&pver=0&duration='.$tnk.'&req_type=3&sort=0&pltimefilter=1&tabid=1&query='.$kw.'&qid=7QA99P-gFdprlsEBxF_LFjHLB-GYm0xL-RUK16n1gv6bnZ3difW8Rw&uid=43b34ada-8c08-4842-ba75-d431d257961e&intention_id=3&g_tk=&g_vstk=&g_actk=';
        $ul = m_v($url);
preg_match_all('|"AI":"(.*)",|U',$ul,$c1);
preg_match_all('|"AT":"(.*)",|U',$ul,$c2);
preg_match_all('|"AW":"(.*)",|U',$ul,$c3);
preg_match_all('|"title":"(.*)",|U',$ul,$c4);
preg_match_all('|"ID":"(.*)",|U',$ul,$c5);
foreach($c1[1] as $k=>$v){
        $a2 = $c1[1][$k];
        $a3 = $c2[1][$k];
        $a4 = $c3[1][$k];
        $a5 = m_u($c4[1][$k]);
        $a6 = $c5[1][$k];
        $a7 = 'http://v.qq.com/iframe/player.html?&width=&height=&auto=1&platform=1&cKey=1&vid='.$a6.'';  
        //$a8 = 'http://vv.video.qq.com/getinfo?vids='.$a6.'&platform=101001&charge=0&otype=json';
        //$ud2 =  f_kd(qq_u($a8));
        //$ua =  f_ht($a7);
        $ud = '../v.htm?f='.$a4;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'('.$a3.')</a>';
echo $xml;
}}}
function qq_u($url) {
preg_match('#"fmd5":"([^>]+)","fn":"([^>]+)"(.*)"fvkey":"([^>]+)"(.*)"url":"([^>]+)"(.*)"url":"([^>]+)"(.*)"url":"([^>]+)"(.*)"url":"([^>]+)",#ismU',m_v($url),$b);
       $a1=$b(1);
       $a2=$b(2);
       $a3=$b(4);
       $a4=$b(12);
       $a5=$a4.$a2.'?fvkey='.$a3;
return  $a5;
}
function ykdys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.soku.com/search_video/q_'.$w.'_orderby_2_lengthtype_'.$t.'_page_'.$i.'?sfilter=1 ';
        $ul = m_v($url);
preg_match_all('#<div class="v-link">(.*)<a title="(.*)" target="_blank" href="(.*)"  _log_type=#ismU',$ul,$b);
preg_match_all('#<span class="v-time">(.*)</span></div>#ismU',$ul,$b1);
        foreach($b[1] as $k=>$v){
        $a1 = $b[2][$k];
        $a2 = $b[3][$k];
        $a3 = $b1[1][$k];
        $ua =  $a2;   
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a1.'('.$a3.')</a>';
echo $xml;
}}}
function ykdys2($url) {
       $uk= array("orderfield","createtime","");
       $w = $_GET['w']?$_GET['w']:"电影"; 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $unk=$uk[$u];
    for($i=1;$i<=$p;$i++){
 $url ='https://so.youku.com/search_video/bigword?keyword='.$kw.'&orderfield='.$unk.'&pz=10&pg='.$i.'&totalPage=50&lengthtype=4&aaid=f55e994831744fc21bd015d5fb428e8c&spm=a2h0k.11417342.soresults.dtab';
        $ul = m_v($url);
        $ut =  str_replace('\t', '',$ul);
        $ut =  str_replace('\n', '',$ul);
preg_match_all('|data-spm="dtitle"(.*)href="([^>]+)">([^>]+)</a>|ismU',x_g($ut),$d);
        foreach($d[1] as $k=>$v){
        $a1 = $d[2][$k];
        $a2 = $d[3][$k];
        //$a3 = $d[6][$k];
        $ua =  $a1;   
        $ud = '../v.htm?f='.$ua;
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}}
function shdys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ur = 'http://so.tv.sohu.com/mts?wd='.$w.'&c=0&v=0&length='.$t.'&limit=4&o=3&p='.$p.'&st=0';
       $ut= m_v($ur);
preg_match_all('|<div class="pic170" >(.*)<a(.*)href="([^>]+)" title="(.*)" target="_blank"|ismU',$ut,$c);
preg_match_all('|<span class="maskTx">(.*)</span>|imsU',$ut,$c2);
    foreach($c[1] as $k=>$v){
       $a3 = $c[3][$k];
       $a4 = $c[4][$k];
       $a5 = $c2[1][$k]; 
       $ua =  $a3;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a4.'('.$a5.')</a>';
echo $xml;
 }}
function sinadys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://so.video.sina.com.cn/interface/s?from=video&wd='.$w.'&s_id=w00001&p='.$i.'&n=20&pf=100';
 $url4 ='http://so.video.sina.com.cn/interface/s?from=video&wd='.$w.'&s_id=w00001&p='.$i.'&n=20&pf=30&vf=60000-0';
 $url3 ='http://search.sina.com.cn/?q='.$w.'&c=news&col=&range=all&source=&from=&country=&size=&time=&a=&sort=time&t=2&page='.$i.'&pf=2131425478&ps=2134309112&dpc=1';
 $url2 ='http://search.sina.com.cn/?q=2015&c=video&range=title&col=&source=&from=&country=&size=&time=&a=&num=20&sort=time&page=2&dpc=1';
        $ul = m_v($url);
preg_match_all('|"url"\:"(.*)","videoname"\:"(.*)"|U',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a4 = stripslashes($b[1][$k]);
        $a5 = $b[2][$k];
        $a6 = r_u($a5);
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $v=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$_GET['w'].$a6.'</a>';
echo $xml;
}}}
function wsdys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
 $url ='http://www.wasu.cn/Search/show?k='.$w.'';
        $ul = m_v($url);
preg_match_all("#<p class=\"one\"><a href=\"(.*)\" title=\"(.*)\" target=\"_blank\">(.*)</a></p>#U",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[2][$k];
        $a4 = 'http://www.wasu.cn'.$a2.'';
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function haosmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w); 
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
        $ul ='http://video.haosou.com/ugc?kw='.$w.'&from=&du=100&fr=100&pb=100&st=101&pageno='.$i.'';
        $ul2 ='http://so.360kan.com/ugc?kw='.$w.'&from=&du=10'.$i.'&fr=100&pb=100&st=100&pageno='.$p.'';
        $ut = f_g($ul);
   preg_match_all("|<span class=\"w-figure-lefthint\">(.*)</span><span class=\"w-figure-righthint\">(.*)</span></span></a><h4><a class='w-figure-title' href='(.*)' title=\"(.*)\">(.*)</a></h4>|ismU",$ut,$d);
        foreach($d[1] as $k=>$v){
        $a3 = $d[2][$k];
        $a4 = $d[3][$k];
        $a5 = $d[4][$k];   
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'('.$a3.')</a>';
echo $xml;
}}}
function haosmv2($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w); 
	$ul = 'http://video.haosou.com/v?ie=utf-8&src=360sou_home&q='.$w.'&_re=0';
	$ul2 = 'http://video.haosou.com/v?q='.$w.'&src=&ie=utf-8';
        $ut = m_v($ul);
preg_match_all("|<a href=\"([^<]+)\" data-logger=\"(.*)\" data-record='(.*)'>(.*)</a>|U",$ut,$d);
foreach ($d[1] as $k=>$v){
        $a3=$d[1][$k];
        $a4=$d[4][$k];
        $a5 = m_u($a4);
        $ua =  $a3;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.m_u($_GET["w"]).$a5.'</a>';
echo $xml;
}
}
function ytsomv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
    $ul = 'http://www.1ting.com/mv/search?q='.$w.'&order=&page='.$i.''; 
	$ut = m_v($ul);
preg_match_all('|<a href="([^<]+)" target="_video">(.*)<h5 class="f-cgreen">([^<]+)<span class="f-cted">(.*)</h5>|ismU',$ut,$d);
preg_match_all('|<span class="time">(.*)</span>|imsU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = $d[3][$k];
       $a5 = $d2[1][$k];
        $a6='http://www.1ting.com'.$a3.'';
       $ua =  $a6;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a4.'('.$a5.')</a>';
echo $xml;
	}}}
function yytsmv($url) {
       $w = $_GET['w']?$_GET['w']:date("d"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $tt = $t*60;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:5;
       for ($i = 1; $i <=$p; $i++) {
	$ul2 = 'http://so.yinyuetai.com/mv?keyword='.$w.'&page='.$i.''; 
	$ul = 'http://soapi.yinyuetai.com/search/video-search?callback=jQuery1102040496006277611196_1538736167805&keyword='.$w.'&pageIndex='.$i.'&pageSize=24&offset=0&orderType=&area=&property=&durationStart='.$tt.'&durationEnd=&regdateStart=&regdateEnd=1538736170&clarityGrade=&source=&thirdSource=';
	$ut = @file_get_contents($ul);
preg_match_all('|"id":([^<]+),"title":"([^<]+)","headImg":"([^<]+)","duration":"([^<]+)"(.*)"artists"(.*)"id":([^<]+),"name":"([^<]+)","hlName":"([^<]+)"(.*)"hltitle":"([^<]+)","pubDate":"([^<]+)",|imsU',$ut,$d);
preg_match_all('|"pubDate":"([^<]+)"(.*)"userId":([^<]+),"userName":|imsU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d[2][$k]);
       $a4 = $d[4][$k];
       $a5='http://v.yinyuetai.com/video/'.$a2;
       $a6=m_u($d[9][$k]);
       $a7=$d[12][$k];
       $a8=''.$a3.'('.$a6.')('.$a4.')('.$a7.')';
        $ua =  $a5;
        $ud = f_kd($ua);
        $vd=Current(explode('?',$v));
	$xml='<a href="'.$ud.'" target="b" >'.$a8.'</a>';
echo $xml;
	}}}
function tddys($url) {
       $w = $_GET['w']?$_GET['w']:pch5; 
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $ul2 ='http://www.tudou.com/list/'.$w.'ch5.html';
 $ul ='http://www.tudou.com/list/'.$w.'a-2b-2c-2d-2e-2f-2g-2h-2i-2j-2k-2l-2m-2n-2sort2.html';
        $ut = m_v($ul);
preg_match_all('|<h6 class="caption"><a href="([^>]+)" title="(.*)" target="_blank">(.*)</a></h6>|imsU',$ut,$b);
        foreach($b[1] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[2][$k];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $v=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
function cndys($url) {
       $tk= array( "-1","0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:3;
       $tnk=$tk[$t];
    for($i=1;$i<=$p;++$i){
     $ul = 'http://search.cctv.com/search.php?qtext='.$kw.'&type=video&sid=0001&pid=0000&page='.$i.'';
     $ul2 = 'http://search.cctv.com/ifsearch.php?qtext='.$kw.'&type=video&page='.$i.'&datepid=5&vtime='.$tnk.'';
     $ul3 = 'https://search.cctv.com/ifsearch.php?page=1&qtext='.$kw.'&sort=relevance&pageSize=20&type=video&vtime=-1&datepid=1&channel=%E4%B8%8D%E9%99%90&pageflag=0&qtext_str='.$kw.'';
       $ut = m_v($ul3);
preg_match_all('|"id":"(.*)","title":"(.*)","all_title":"(.*)","channel":"(.*)","urllink":"(.*)"(.*)"TV":"(.*)","playtime":(.*),"uploadtime":"(.*)"|ismU',$ut,$b);
 foreach($b[1] as $k=>$v){
       $a4 = $b[1][$k];
       $a5 = r_u($b[3][$k]);
       $a6 = x_g($b[5][$k]);
       $a8 = r_u($b[7][$k]);
       $a7 = $b[9][$k];
       $ua =  $a6;
       $ua2 =  cn_vd($a6);
       $ud3 = f_ck($ua2);
       //$ud2 = '../tv/cctvh.php?vid='.$ua2;
       //$ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud3.'" target="b" >'.$a5.'('.$a7.')</a>';
echo $xml;
}}}

function n56dy($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $ul = 'http://so.56.com/mts?wd='.$w.'&c=0&v=0&length=0&limit=1&o=3&st=&p='.$i.'';
       $ut = m_v($ul);
  preg_match_all('#href="([^>]+)" title="(.*)"(.*)pb-url="meta#ismU',$ut,$d);
  preg_match_all('#<span class="maskTx">(.*)</span>#ismU',$ut,$d2);
  foreach($d[1] as $k=>$v){
       $a2 =$d[1][$k];
       $a3 =$d[2][$k];
       $a4 =$d2[1][$k];
       $ua =  $a2;
        $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}}
function kkxwsmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://www.kankanews.com/search/index.php?index=1&q='.$w.'';
        $ul = f_g($url);
preg_match_all('|<div class="news_tit"><a href="([^<]+)" target="_blank"><b style="(.*)">(.*)</b>(.*)</a></div>|ismU',$ul,$c1);
        foreach($c1[1] as $k=>$v){
        $a2 = $c1[1][$k];
        $a3 = $c1[3][$k];
        $a4 = $c1[4][$k];
        $a10 = $b6[1][$k2];
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.$a4.'</a>';
echo $xml;
}}
function fengymv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://www.fengyunlive.com/channel-list';
        $ul = m_v($url);
preg_match_all('|<li class="channel-item"><a(.*)cid="([^<]+)"(.*)>([^<]+)</a></li>|ismU',$ul,$c1);
        foreach($c1[1] as $k=>$v){
        $a2 = $c1[2][$k];
        $a3 = $c1[4][$k];
        $a4 = 'https://fyplayer.b0.upaiyun.com/upload/fyplay-4.html?&src=https://fyplayer.b0.upaiyun.com/upload/fengyun3.0.62.swf&cid='.$a2;
        $ud =  $a4;
       //header("location:".$ud);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';

echo $xml;
}}
function n36dy($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w); 
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=4;++$i){
        $ul ='http://so.360kan.com/ugc?kw='.$w.'&from=&du=10'.$i.'&fr=100&pb=103&st=101&pageno='.$p.'';
        $ut = m_v($ul);
   preg_match_all("|<a class='(.*)' href='([^>]+)'  > <img src='(.*)' data-src='(.*)' alt='(.*)'  />|ismU",$ut,$d);
   preg_match_all("|<span class=\"w-figure-lefthint\">(.*)</span><span class=\"w-figure-righthint\">(.*)</span>|ismU",$ut,$d2);
        foreach($d[1] as $k=>$v){
        $a3 = $d[2][$k];
        $a4 = $d[5][$k];
        $a5 = $d2[1][$k];
        $a6 = $d2[2][$k];  
        $ua =  $a3;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.'('.$a5.')('.$a6.')</a>';
echo $xml;
}}}
function n163dy($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w); 
        $a = $_GET['a'];
   if ($a == '') $a='stv';else $a=$a;
        $t = $_GET['t'];
   if ($t == '')  $t='00';else  $t=$_GET['t'];
        $p = $_GET['p'];
   if ($p == '')  $p='1';else  $p=$_GET['p'];
    for($i=1;$i<=$p;++$i){
	$ul = 'http://so.v.163.com/search/000-2-00'.$t.'-1-'.$i.'-0-'.$w.'/';
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
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml='<a href="'.$ud.'" target="b" >'.$a3.''.$a4.''.$a5.'('.$a1.')('.$a6.')</a>';
echo $xml;
}}}
function bmhdys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://so.baomihua.com/DataList.aspx?keyword='.$w.'&seachtype=0&page='.$p.'';
        $ul = f_g($url);
preg_match_all('#<li class="(.*)"><a target="_blank" href="([^>]+)"><img alt="(.*)" src="(.*)" /></a></li>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = $b[3][$k];
        $ul2 = m_v($a2);
preg_match_all('#param value="(.*)" name="flashvars">#U',$ul2,$b2);
foreach($b2[1] as $k2=>$v2){
        $a4 = $b2[1][$k2];
        $a5 = 'http://resources.baomihua.com/swf/pomoho_player_640.swf?'.$a4.'';
        $vd=Current(explode('?',$v2));
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function skdy($url) {
       $w = $_GET['w']?$_GET['w']:date("d"); 
       $kw=k_w($w);
       $tk= array("0","1","2","3","4");
       $ak= array("1","2","3");
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
function skdy1($url) {
       $tk= array("0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw= k_w($w);
   if ($w == '')  $w=date("d");else  $w=$w;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $tnk= $tk[$t];
for ($i = 1; $i <=$p; $i++) {
   if ($u == '1'){
 $ul = 'http://www.soku.com/v/q_'.$kw.'_orderby_2_limitdate_0_page_'.$i.'_site_14?site=14&_lg=1&lengthtype='.$tnk.'&page='.$i.'';
}else {
 $ul = 'http://www.soku.com/v/q_'.$kw.'_orderby_2_limitdate_0?site=14&lengthtype='.$tnk.'&_lg=10&page='.$i.'&spm=';
}
        $ut = m_v($ul);
preg_match_all('#<div class="v-link"(.*)>(.*)<a(.*)title="([^>]+)"(.*)href="([^>]+)"#ismU',$ut,$d);
preg_match_all('#<span class="v-time">([^>]+)</span>#ismU',$ut2,$d1);
preg_match_all('#<span class="pub">([^>]+)</span></div>#ismU',$ut2,$d2);
foreach ($d[1] as $k=>$v){
        $a1=$d[4][$k];
        $a2=$d[6][$k];
        $a3=$d1[1][$k];
        $a4=$d2[1][$k];
        $bu = str_ireplace('http://','',$a2);
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_v(f_ht($ua));
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$ud.'" target="b" >'.$a1.'('.$a3.')('.$a4.')</a>'."\n";
echo $xml;
}}}
function sgmv($url) {
       $wk= array("","喜剧","爱情","动作","恐怖","科幻","惊悚","犯罪","奇幻","战争","悬疑","动画","文艺","传记","歌舞","古装","警匪","其他","音乐MV","相声","纪录片");
       $w2k= array("","爱情","喜剧","都市","悬疑","古装","偶像","犯罪","历史","战争","武侠","警匪","科幻","奇幻","谍战","农村","其他");
       $w3k= array("","搞笑","热血","冒险","美少女","科幻","校园","恋爱","神魔","机战","益智","亲子","励志","童话","青春","原创","动作","耽美","魔幻","其他");
       $w4k= array("","社会","历史","战争","运动","文艺","青春","剧情","儿童","成长");
       $w5k= array("","喜剧","音乐","社会","历史","儿童");
       $uk= array("","%20site:qq.com","%20site:youku.com","%20site:iqiyi.com","%20site:sohu.com","%20site:baomihua.com","%20site:bilibili.com","%20site:le.com","%20site:boosj.com","%20site:ifeng.com","%20site:pptv.com","%20site:miaopai.com");
       $tk= array("film","teleplay","cartoon","documentary","tvhow","mv","essay","crosstalk","pair");
       //$tk= array("0","l5","l30","m30","m60");
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
    if($t=="4"||$t=="5"||$t=="6"||$t=="8") {
       $ul ='https://v.sogou.com/api/video/result?style=&zone=&year=&starring=&fee=&order=&emcee=&req=class&query=%E9%9F%B3%E4%B9%90MV&entity='.$tnk.'&page='.$i.'&pagesize=30';
} else if($t=="7") {
       $ul ='https://v.sogou.com/api/video/result?style=&zone=&year=&starring=&fee=&order=&emcee=&req=class&query=%E7%9B%B8%E5%A3%B0&entity=crosstalk&page='.$i.'&pagesize=30';
} else if($t=="3") {
       $ul ='https://v.sogou.com/api/video/result?style=&zone=&year=&starring=&fee=&order=&emcee=&req=class&query=%E7%BA%AA%E5%BD%95%E7%89%87&entity=documentary&page='.$i.'&pagesize=30';
} else {
       $ul ='https://v.sogou.com/api/video/longVideo?style='.$kw.'&zone=&year=&starring=&fee=%E6%AD%A3%E7%89%87&order=time&emcee=&req=list&query=&entity='.$tnk.'&page='.$i.'&pagesize=30';
}
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
    if($t=="1"||$t=="2"||$t=="4") {
     $xml ='<a href="'.$fname.'?&sgsovids='.$ua.'&name='.$a3.'" target="b1">'.$a3.'&nbsp;&nbsp;('.$a4.'&nbsp;&nbsp;'.$a8.')&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
}else {
     $xml ='<a href="'.$fname.'?&sgsovid='.$ua.'" target="b">'.$a3.'&nbsp;&nbsp;('.$a4.'&nbsp;&nbsp;'.$a8.')&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
}
echo $xml;
}}}
function cnsmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:-1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;++$i){
     $ul2 = 'http://search.cctv.com/search.php?qtext='.$w.'&type=video&page='.$i.'&datepid=3&vtime='.$t.'&redirect=1';
     $ul = 'http://search.cctv.com/ifsearch.php?qtext='.$w.'&type=video&page='.$i.'&datepid=3&vtime='.$t.'&redirect=1';
       $ut = m_v($ul);
preg_match_all('|<ul class="list_rec mt(.*)clearfix">(.*)</ul>|ismU',$ut,$ub);
 foreach($ub[2] as $k1=>$v1){
preg_match_all('|<li>(.*)<span>(.*)</span></div><a class="p_txt" href="(.*)" target="_blank">(.*)</a><p class="p_date">(.*)</p></li>|ismU',$v1,$b);
 foreach($b[1] as $k=>$v){
       $a4 = $b[2][$k];
       $a5 = $b[3][$k];
       $a6 = $b[4][$k];
       $a7 = $b[5][$k];  
       $ua =  $a5;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="b" >'.$a6.'('.$a7.')('.$a4.')</a>';
echo $xml;
}}}}
function qydys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $ew=urldecode($w);
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
 $url ='http://so.iqiyi.com/so/q_'.$w.'_ctg__t_0_page_'.$p.'_p_1_qc_0_rd_0_site__m_4_bitrate_?refersource=lib';
        $ut = m_v($url);
preg_match_all('|data-searchpingback-param="ptype=(.*)" href="([^<]+)" target="(.*)">(.*)<img alt="(.*)" title="(.*)" src="(.*)"/>|ismU',$ut,$b);
preg_match_all('|<span class="v_name">(.*)</span>|ismU',$ut,$b2);
preg_match_all('|<div class="info_item">(.*)<div class="result_info_cont result_info_cont-half">(.*)<label class="result_info_lbl">(.*)</label>(.*)<em class="result_info_desc">(.*)</em>|ismU',$ut,$b3);
foreach($b[1] as $k=>$v){
        $a3 = $b[2][$k];
        $a4 = $b2[1][$k];
        $a5 = $b[6][$k];
        $a6 = $b3[5][$k];
        $ua =  $a3;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$ew.'('.$a5.')('.$a4.')('.$a6.')</a>';
echo $xml;
}}
function nhsmv($url) {
       $ur = 'http://neihanshequ.com/video/?is_json=1&app_name=neihanshequ_web&max_time=1445733543';
       $ut = m_v($ur);
 preg_match_all('|"mp4_url": "(.*)",|ismU',$ut,$c1);
 preg_match_all('|"title": "(.*)",|ismU',$ut,$c2);
 foreach($c1[1] as $k=>$v){
       $a3 = $c1[1][$k];
       $a4 = $c2[1][$k];
       $a5 = r_u($a4);
       $ua =  $a3;
        $ua =  f_ht($ua);
       $a6 = '../ck.php?a=tv&f='.$a3;
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$a6.'" target="b" >'.$a5.'</a>';
echo $xml;
 }}
function boomv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $ul = 'http://search.boosj.com/q1_tresource/styped/c'.$w.'.html';
       $ul2 = 'http://search.boosj.com/q3_tresource/styped/c'.$w.'.html';
       $ut = m_v($ul2);
preg_match_all('|<h3><a href="http://www.boosj.com/([^<]+).html"(.*)title="([^<]+)" >|imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a4=$d[1][$k];
        $a5=m_u($d[3][$k]);
        $str = "http://www.boosj.com/";
        $a6=str_replace($str,"",$a4);
	$a7='http://static.boosj.com/v/swf/w_player1.0.swf?vid='.$a4.'&a=1&p=1&f=1&s=1&r=1&m=1';
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$a7.'" target="b" >'.$a5.'</a>';
echo  $xml;
}}
function ysmv($url) {
       $tk= array("0","1","2","3","4","30","56","74","98","100");
       $wk= array("42","43","44","45","46","47","48","100");
       $w2k= array("42"=>"42","43"=>"43","44"=>"44","45"=>"45","46"=>"46","47"=>"47","48"=>"48","100"=>"100");
       $t = $_GET['t']?$_GET['t']:0;
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:100;
       $p1 = 50;
       $tnk=$tk[$t];
 if($t <= "10") $tnk=$tnk;else $tnk=$t;
       $wnk=$wk[$w];
 if($w <= "10") $wnk=$wnk;else $wnk=$w;
       $w2nk=$w2k[$wnk];
    /*if($w2nk != $wnk) $w2nk=$wnk;else $w2nk=$w;*/
       $i1 = 1; $i2 = 1;
 $url0 ='http://square.ys7.com/square/demoCameraApplyAction!queryShareCamera.action?cameraId=1860760&jsoncallback=';
 $url1 ='http://square.ys7.com/square/demoCameraApplyAction!queryDemoCameraList.action?type=200&pageStart=0&pageSize='.$p.'&channel='.$tnk.'&jsoncallback=jQuery19109071659004160157_1';
 $url2 ='http://square.ys7.com/remark/demoRemarkAction!getList.action?squareId=5030&pageStart=0&pageSize='.$p.'&channel='.$tnk.'&jsoncallback=jQuery19103996857418753818_1';
 $url3 ='http://square.ys7.com/remark/demoRemarkAction!getSearchList.action?squareId=5030&pageStart=0&pageSize='.$p.'&key='.$tnk.'&jsoncallback=jQuery19103996857418753818_1';
 $url4 ='http://pbsquare.ys7.com/remark/demoRemarkAction!getList.action?squareId=1308&pageStart=0&pageSize=10&jsoncallback=jQuery11130706891666301696_1470721889347';
    //if($w=='0') $url= $url1;else $url=$url2;
        $ul = m_v($url1);
preg_match_all('#"subSerail":"([^>]+)",#ismU',$ul,$c1);
preg_match_all('#"city":"([^>]+)",#ismU',$ul,$c2);
preg_match_all('#"userId":"([^>]+)",#ismU',$ul,$c3);
preg_match_all('#"province":"([^>]+)",#ismU',$ul,$c4);
preg_match_all('#"hlsAddr":"([^>]+)",#ismU',$ul,$c5);
preg_match_all('#"casIp":"([^>]+)",#ismU',$ul,$c6);
preg_match_all('#"webSocketUrl":"([^>]+)",#ismU',$ul,$c7);
preg_match_all('#"cdnUrl":"([^>]+)",#ismU',$ul,$c8);
preg_match_all('#"vtduAddr":"([^>]+)",#ismU',$ul,$c9);
preg_match_all('#"channelNo":([^>]+),#ismU',$ul,$c10);
preg_match_all('#"id":"([^>]+)",#ismU',$ul,$c11);
preg_match_all('#"name":"([^>]+)",#ismU',$ul,$c12);
preg_match_all('#"casPort":([^>]+),#ismU',$ul,$c13);
preg_match_all('#"cameraName":"([^>]+)",#ismU',$ul,$c14);
preg_match_all('#"address":"([^>]+)",#ismU',$ul,$c15);
preg_match_all('#"rtmpAddr":"([^>]+)",#ismU',$ul,$c16);
preg_match_all('#"rtmpPort":([^>]+),#ismU',$ul,$c17);
foreach($c1[1] as $k=>$v){
       $a1=$c1[1][$k];
       $a2=$c2[1][$k];
       $a3=$c3[1][$k];
       $a4=$c4[1][$k];
       $a5=$c5[1][$k];
       $a6=$c6[1][$k];
       $a7=$c7[1][$k];
       $a8=$c8[1][$k];
       $a9=$c9[1][$k];
       $a10=$c10[1][$k];
       $a11=$c11[1][$k];
       $a12=$c12[1][$k];
       $a13=$c13[1][$k];
       $a14=$c14[1][$k];
       $a15=$c15[1][$k];
       $a16=$c16[1][$k];
       $a17=$c17[1][$k];
       $a18='';
   if(stripos($a8,'http') === false){$a18='http://hlsbys.ys7.com/hcnp/';}else{$a18=$a8;};
       $b6=''.$a18.''.$a1.'_'.$a10.'_2_1_0_'.$a9.'_'.$a13.'.m3u8';
       $b9='rtmp://'.$a16.'/livestream/'.$a1.'_'.$a10.'_2_1_0_'.$a9.'_'.$a13.'.flv';
       $b10='http://'.$a16.':'.$a17.'/livestream/'.$a1.'_'.$a10.'_2_1_0?jsoncallback=jQuery111309680565449782288_1469713305275';
       $b11='http://hlsbys.ys7.com/hcnp/'.$a1.'_'.$a4.'_2_1_0_183.136.184.7_6500.m3u8';
    if($a== 'm3u8') $ua=$b6;else $ua=$b9;
       $ua =  $ua;
       $ua =  f_ht($ua);
       $ud = f_kd($ua);
       $ud4=''.$a14.'('.$a15.')';
   if ($t == '100')  $na=$a12;else  $na=$ud4;
       $vd=Current(explode('?',$v));
       //header("location: ".$ud);
     $xml ='<a href="'.$ud.'" target="b" >'.$na.'</a>';
       /*$i3 = $i1++; $i4 = $i2++;
       $ud5='File'.$i3.'='.$b9.'
             Title'.$i4.'='.$ud4.'';
    $xml2 = $ud5 ;
    $ar =$xml2;
    $fn = 'yszb.pls';
    $arr=file_put_contents($fn,$ar.PHP_EOL,FILE_APPEND);
    fclose($fn);*/
echo  $xml;
}}

function bdsmv($url) {
       $p = $_GET['p']?$_GET['p']:2; 
for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.iermu.com/service/api.php?&keyword=2021&method=get_dev_list&pageIndex=0&pageSize=100&type='.$i.'';
       $ut = m_v($ul);
  preg_match_all('#"shareid":"([^>]+)",#ismU',$ut,$d2);
  preg_match_all('#"description":"([^>]+)",#ismU',$ut,$d3);
  preg_match_all('#"userid":"([^>]+)",#ismU',$ut,$d4);
  foreach($d2[1] as $k=>$v){
       $a2 =$d2[1][$k];
       $a3 =$d3[1][$k];
       $b3 = r_u($a3); 
       $a4 =$d4[1][$k];
       $a5 ='http://www.iermu.com/svideo.php?shareid='.$a2.'&uk='.$a4.'';
       $ud = $a5;
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$b3.'</a>';
      $xml2 ='<a href="'.$ud.'" target="_about" >'.$b3.'</a>';
echo  $xml;
}}}

function sd360mv($url) {
       $uk= array("hot","hot","11","20","4","16","43","44","5","2","33","8","replay");
       $u = $_GET['u']?$_GET['u']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $w1=r_g(m_g('风景'));
       $w2=m_g('风景');
       $w = $_GET['w']?$_GET['w']:$w2; 
       $unk=$uk[$u];
   if ($u <= '12')  $unk2=$unk;else  $unk2=$u;
       $kw=k_w($w); 
   if ($u == '0')  $kw=$kw;else  $kw=null;
        $mm = ' : ';
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $p2 = '32'*$i;
       $ul1 = 'http://www.h31game.com/cate/'.$unk2.'/'.$p.'';
       $ul2 = 'https://live3.jia.360.cn/public/getPublicList?isPage=1&sortType=1&callback=jQuery1102033906860394798355_1510378959042&orderBy=&count=16&from=mpc_ipcam_web&category='.$unk2.'&page='.$p2.'';
   if ($u == '0')  $ut=f_g($ul1);else  $ut=m_v($ul2);
  preg_match_all('#<dt class="preview">(.*)<a href="([^>]+)"(.*)>#ismU',$ut,$d2);
  preg_match_all('#<span class="camera-title">([^>]+)</span>(.*)<span class="channel">([^>]+)</span>#ismU',$ut,$d3);
  //preg_match_all('#"channel":"([^>]+)"#ismU',$ut,$d4);
  //preg_match_all('#"titlePub":"(.*)"#ismU',$ut,$d5);
  foreach($d2[1] as $k=>$v){
       $a2 ='http://www.h31game.com'.$d2[2][$k];
       $a3 =m_u($d3[1][$k]);
       $a4 =m_u($d3[3][$k]);
       //$a5 =r_u($d5[1][$k]);
       //$a6 ='https://live3.jia.360.cn/public/getInfoAndPlayV2?callback=jQuery18307851184004056839_1510373793744&from=mpc_ipcam_web&sn='.$a2.'&taskid='.$a4.'';
       //$a7 = sd_3($a6);
       //$aa ='http://shuidi.huajiao.com/pc/player_autosize.html?sn='.$a2.'&';
       //$aa ='http://jia.360.cn/pc/view.html?sn='.$a2.'&';
       //$aa ='rtmp://rtmp-live.jia.360.cn/live_jia_public/_LC_RE_non_3605378337215103707521297157_CX';
       //$aa ='http://hls-live.jia.360.cn/live_jia_public/_LC_RE_non_3605378337215103707521297157_CX/index.m3u8';
       //preg_match('|"hls":"([^>]+)"|',m_v($a5),$d7);
       //$a6 = x_g($d7[1]);
       //$aa ='../tv/vw.php?sn='.$a2.'&channel='.$a7.'';
       //$aa ='http://jia.360.cn/player/flash/QihooPlayer.swf?&sn='.$a2.'&channel='.$a7.'&autostart=true&ctrbarhide=true&buffertime=3&streamversion=2';
       //$aa ='../tv/sd360.php?sn='.$a2.'&channel='.$a7.'';
       //$a8 ='rtmp://rlive.jia.360.cn/live_jia_public/'.$a2.'';
       //$a9 ='../v.htm?a=&f='.$a7.'';
   //if ($u == '0')  $ud=$a9;else if ($u == '2')  $ud=$a7;else if ($u == '3')  $ud=$a8;else $ud=$a5;
       $ud = $a2;
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo  $xml;
}}}
function sd_3($url) {
       $ut = m_v($url);
preg_match('|"relayStream":"([^>]+)"|',$ut,$d1);
preg_match('|"rtmp":"([^>]+)"|',$ut,$d2);
preg_match('|"hls":"([^>]+)"|',$ut,$d3);
       $ud1=$d2[1];
       $ud2=x_g($d2[1]);
       $ud3=x_g($d3[1]);
return $ud3;
} 

function bitmv($url) {//25//50-37
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $wk= array("145","146","147","82","83","85","86","95","96","98","121","122","124","126","127","128","130","131","136","137","138","152","153","154","156","157",
"158","159","161","162","163","164","166","15","17","19","20","21","22","24","25","26","27","28","29","30","31","32","33","34","37","39","40","43","44","45","46","47",
"48","49","50","51","52","53","54","56","57","58","59","60","61","65","71","75","76");
       $wwk= array("145","146","147","83","82","85","37","124","39","148","15","16","84","86","33","166");
       $wnk=$wk[$w];
       $w2nk=birid($wnk);
       $tk = explode(",", $w2nk); 
       $tnk=$tk[$t]; 
    for($i=1;$i<=$p;$i++){
       $ul0 ='http://bangumi.bilibili.com/index/catalogy/85.json';
       $ul1 ='http://bangumi.bilibili.com/index/catalogy/'.$wnk.'-3day.json';
       $ul2 ='http://api.bilibili.com/archive_rank/getarchiverankbypartion?callback=&type=jsonp&tid='.$wnk.'&pn='.$i;
       $ul3 ='http://api.bilibili.com/x/tag/ranking/archives?jsonp=jsonp&tag_id='.$tnk.'&rid='.$wnk.'&pn='.$i.'&page=1&callback=';
       $ul4 ='http://live.bilibili.com/'.$wnk.'?page='.$i.'&ajax=1';
   if( $t=='0') $ul=$ul2;else $ul=$ul3;
       $ut2 = m_v($ul);
       $ut = J_d($ut2,True);
       $aa = $ut["data"]["archives"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0["aid"];
       $a2 = x_g(m_u(r_u($a0["title"])));
       $a8 = $a0["rights"]["pay"];
       $a7 = t_m($a0["pubdate"]);
       $a3 = x_g($a0["redirect_url"]);
       $a4 = $a0["cid"];
       $a5 = $a0["bvid"];
       $a6 = x_g(m_u(r_u($a0["description"])));
       $aid=$a1;
       $cid=$a4;
       $bvid=$a5;
if($a8==0) {
       $a10='../tv/bili.htm?&f='.$aid.'&cid='.$cid.'&bvid='.$bvid.'';
}else {
       //$a10='http://player.bilibili.com/player.html?aid='.$aid.'&cid='.$cid.'&page=1&autoplay=1';
       $a10='https://www.bilibili.com/html/player.html?aid='.$aid.'&cid='.$cid.'&page=1&autoplay=1';
       //$a10='https://www.bilibili.com/blackboard/html5player.html?aid='.$aid.'&cid='.$cid.'&page=1&autoplay=1';
       //$a10 = 'http://www.bilibili.com/video/av'.$aid.'/';
}
   if( $wnk==32||$wnk==34||$wnk==37) $ua=$aid;else $ua=$a10;
        $fn = ''.$fname.'?&bidsj='.$ua.'&name='.$a2.'';
        $ud = $ua;
        $tg='target="b1"';
if($a8==0) {
        $tb='target="b"';
}else {
        $tb='target="b2"';
}
     if($wnk==32||$wnk==34||$wnk==37) $ud=$fn;else $ud=$ud;
     if($wnk==32||$wnk==34||$wnk==37) $tg=$tg;else $tg=$tb;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" '.$tg.' >'.m_u($a2).' </a>';
echo $xml;
}}}
function birid($url) {
       $ul ='http://api.bilibili.com/x/tag/hots?callback=jQuery172017914524300764206_1478599526313&type=0&jsonp=jsonp&rid='.$url;
       $ut = m_v($ul);
preg_match_all('|"tag_id":([^>]+),|ismU',$ut,$d);
preg_match_all('|"tag_name":"([^>]+)",|ismU',$ut,$d2);
foreach($d[1] as $k=>$v){
       $ud=$d[1];

}    
       $tk=json_encode($ud);
preg_match("|\[([^>]+)\]|U",$tk,$d2);
       $tk=$d2[1];
       $tk=str_replace('"', '', $tk);
return  $tk;
}
function bicid($aid){
    $url1 = "https://api.bilibili.com/view?appkey=8e9fc618fbd41e28&id=6486950&type=json";
    $url2 = "https://api.bilibili.com/view?appkey=8e9fc618fbd41e28&id=".$aid."&type=json";
    $file = m_v($url2);
    $arr = json_encode($file,true);
    $arr = json_decode($arr,true);
preg_match('|"cid":([^>]+),|U',$arr,$d2);
preg_match('|"pages":([^>]+),|U',$arr,$d3);
       $a2=$d2[1];
       $a3=$d3[1];
       //$i=1;$i<=$a3;
    for($i=1;$i<=$a3;$i++){
       $ud = 'http://www.bilibili.com/video/av'.$aid.'/index_'.$i.'.html';
 return $ud;
}}
function xxav($url) {
       $wk= array("1","27","19","36","37","38","39","40","41");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
       $ul1 = 'http://www.xxavse1.com/?m=vod-type-id-'.$wnk.'-pg-'.$i.'.html';
       $ut = m_v($ul1);
preg_match_all("|<li><a class=\"link\" href=\"\/\?m=vod-detail-id-([^>]+).html\" title=\"([^>]+)\">|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d[2][$k]);
       $a4 = 'http://www.xxavse1.com/?m=vod-play-id-'.$a2.'-src-1-num-1.html';
//preg_match("|mac_url=unescape\('([^>]+)'\)|ismU",f_g($a4),$d2);
       //$a5 = urldecode($d2[1]);
       //$a6=strstr($a5,'$');
       //$a8=substr($a6,strlen('$')); 
       //$ud = f_ck($a8);  
    $xml ='<a href="'.$fname.'?&xxav='.$a4.'&name='.$a3.'" >'.$a3.'</a>';
    //$xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function xxav1($url) {
       $w = $_GET['w']?$_GET['w']:'';
       $p = $_GET['p']?$_GET['p']:1; 
       $wk= array("亚洲","欧美","巨乳","熟女","潮吹","制服","人妻","女神","自拍","3p");
       $wnk=$wk[$w];
for ($i = 1; $i <=$p; $i++) {
       $ul1 = 'http://sifangpian.club/vodtype/23/'.$i.'.html';
       $ul2 = 'http://sifangpian.club/index.php?m=vod-search-pg-'.$i.'-wd-'.$wnk.'.html';
     if($w=='') $ul=$ul1;else $ul=$ul2;
       $ut = m_v($ul);
  preg_match_all('#<a(.*)href="/vodplay/([^>]+)/1/0.html"(.*)title="([^>]+)">(.*)<time(.*)>(.*)</i>([^>]+)</time>#ismU',$ut,$d2);
  foreach($d2[1] as $k=>$v){
       $a2 =$d2[2][$k];
       $a3 =$d2[4][$k];
       $b3 = r_u($a3); 
       $a4 =$d2[8][$k];
       $a5 ='http://sifangpian.club/player/ck3.php?&id='.$a2;
       $ud = $a5;
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$b3.' ('.$a4.')</a>';
echo  $xml;
}}}
function xxav2($url) {
       $wk= array("","431","1027","281","1021","26","421","1066","31","120","156","651","1011");
       $w2k= array("1","2","3","4");
       $tk= array("cataId","type");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $ul1 = 'http://2mm.in/';
       $ut = m_v($ul1);
preg_match_all("|<a href=\"\/tags\?tag=([^>]+)\"(.*)>([^>]+)<\/a>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d[3][$k]);
       $a4 = 'http://2mm.in/tags?tag='.$a2.'&page=1';
    $xml ='<a href="'.$fname.'?&mmxs='.$a4.'&name='.$a3.'" >'.$a3.'</a></br>';
echo $xml;
}}
function xxav3($url) {
       $wk= array("89","90","94","99","105","107","117","118","85","87","91","92","93");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       if( $w<= '20') $wnk2 = $wnk;else $wnk2 = $w;
    for($i=1;$i<=$p;$i++){
       $ul1 = 'http://www.gavxxx.com/?m=vod-type-id-'.$wnk2.'-pg-'.$i.'.html';
       $ut = f_g($ul1);
preg_match_all("|<a class=\"ga_click\" href=\"\/\?m=vod-play-id-([^>]+)-src-1-num-1.html\">|ismU",$ut,$d);
preg_match_all('|<h3 class="one_name ga_name">([^>]+)</h3></a>|ismU',$ut,$d2);
preg_match_all("|var fs='([^>]+)';|ismU",$ut,$d3);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d2[1][$k]);
       $a5 = $d3[1][$k];
       $a4 = 'http://www.gavxxx.com/?m=vod-play-id-'.$a2.'-src-1-num-1.html';
       $a6 = 'https://www.119vrs.com/2mm.php?vid='.$a5;
//preg_match("|mac_url=unescape\('([^>]+)'\)|ismU",f_g($a4),$d2);
       //$a5 = urldecode($d2[1]);
       //$a6=strstr($a5,'$');
       //$a8=substr($a6,strlen('$')); 
       //$ud = f_ck($a8);  
    $xml ='<a href="'.$fname.'?&xxxav='.$a4.'&name='.$a3.'" >'.$a3.'</a>';
    //$xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function xxav4($url) {
       $wk= array("","hot","category/gangbang","category/hardcore","category/pussy","category/extreme-deepthroat","category/gagging","tag/guy",
"tag/beautiful","tag/girls","tag/white","tag/creampie","tag/funk","tag/hd%20porn","tag/jennifer","tag/guys","tag/720p%20porn","tag/girl");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
       $ul = 'https://www.pornoeggs.com/'.$wnk.'?page='.$i.'';
       $ut = m_v($ul);
preg_match_all("|<li class=\"(.*)\">(.*)<div class=\"thumb thumbs_rotate rotate-([^>]+)\"(.*)>(.*)<a href=\"\/([^>]+)\/(.*)\">(.*)<span class=\"time\">([^>]+)<\/span>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[3][$k];
       $a3 = $d[6][$k];
       $a4 = $d[7][$k];
       $a6 = $d[9][$k];
       $a7 = 'https://www.pornoeggs.com/embed?v='.$a3.'&auto_play=1';
       $a8 = 'https://www.pornoeggs.com/flash/player.swf?&embedded=1&auto_play=1&video_id='.$a2.'';
       if($t==1) $ud = $a8;else $ud=$a7;
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.'    &nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
echo $xml;
}}}
function dhmdy($url) {
       $wk= array("25","16","27","28","29","30","31","32","33","34","35");
       $w = $_GET['w']?$_GET['w']:0; 
       $w=k_w($w);
       $wnk = $wk[$w];
       $t = $_GET['t']?$_GET['t']:4;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $url = 'https://www.duhama.com/index.php?s=home-vod-type-id-28-mcid--lz--area--year--letter--order-addtime-picm-1-p-'.$i.'.html';
       $ut = m_s($url);
       $at = json_decode($ut,true);
  preg_match_all('|<li>(.*)<h2><a href="([^>]+)"(.*)>([^>]+)</a></h2>(.*)<p class="up"><em>([^>]+)</em>([^>]+)</p>(.*)</li>|ismU',$at,$d);
  foreach($d[1] as $k=>$v){
       $a2='https://www.duhama.com'.$d[2][$k].'2-1.html';
       $a3=$d[4][$k];
       $a4=$d[7][$k];
       //$ud = f_kd(f_ht($ua));
    //$xml ='<a href="'.$ud.'" target="b" >'.$a3.' ('.$a4.')</a>';
    $xml ='<a href="'.$fname.'?&dhmav='.$a2.'&name='.$a3.'" >'.$a3.' ('.$a4.')</a>';
echo $xml;
}}}
function ngdy($url) {
       $w = $_GET['w']?$_GET['w']:0; 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $url = 'https://www.ooe.la/vodshow/kehuanpian--------'.$i.'---/';
       $at = f_g($url);
  preg_match_all("|<a class=\"hl-item-thumb hl-lazy\"(.*)href=\"\/n\/([^>]+)\/\"(.*)title=\"([^>]+)\" data-original=\"|ismU",$at,$d);
foreach($d[1] as $k=>$v){
       $a2='https://www.ooe.la/play-'.$d[2][$k].'-4-1/';
       $a3=m_g($d[4][$k]);
       //$ua= $a2;
       //$ud = f_kd(f_ht($ua));
    //$xml ='<a href="'.$ud.'" target="b" >'.m_u($a3).'</a>';
    $xml ='<a href="'.$fname.'?&ngid='.$a2.'" >'.$a3.'</a>';
echo $xml;
}}}
function bidys($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:4;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $url = 'http://search.bilibili.com/ajax_api/video?keyword='.$w.'&page='.$i.'&order=totalrank&duration='.$t.'';
       $file = m_v($url);
       $arr = json_encode($file,true);
       $arr = json_decode($arr,true);
       $arr = x_g($arr,true);
  preg_match_all('|href="([^>]+)"(.*)se-linkid=([^>]+)title="([^>]+)"|ismU',$arr,$d);
foreach($d[1] as $k=>$v){
       $a2=$d[1][$k].'/';
       $a3=m_g($d[4][$k]);
       $ua= $a2;
       $ud = f_kd(f_ht($ua));
    $xml ='<a href="'.$ud.'" target="b" >'.m_u($a3).'</a>';
echo $xml;
}}}
function bidys2($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:4;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $url = 'http://search.bilibili.com/ajax_api/video?keyword='.$w.'&page='.$i.'&order=totalrank&duration='.$t.'';
       $file = m_v($url);
       $arr = json_encode($file,true);
       $arr = json_decode($arr,true);
       $arr = x_g($arr,true);
  preg_match_all('|href="([^>]+)"(.*)se-linkid=([^>]+)title="([^>]+)"|ismU',$arr,$d);
foreach($d[1] as $k=>$v){
       $a2=$d[2][$k].'/';
preg_match('|/av([^>]+)/|U',$a2,$d2);$a4=$d2[1];
       $a3=$d[4][$k];
       $a6=m_g($a3);
       $a5='http://www.bilibili.com/video/av'.$a4.'/';
       $fn = ''.$fname.'?&name='.$a6.'&bidsj='.$a4.'';
    $xml ='<a href="'.$fn.'" target="b" >'.$a6.'</a>';
echo $xml;
}}}
function bdmv($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://v.baidu.com/v?fid=&word='.$w.'&rn=40&ct=905969664&ie=utf-8&du='.$t.'&pd=0&sc=0&pn=('.$i.'-1)*20&order=0&db=0';
       $ut = m_v($ul);
  preg_match_all('#"ti":"([^>]+)"(.*)"origin_url":"([^>]+)"#ismU',$ut,$d);
  foreach($d[1] as $k=>$v){
       $a2 =$d[1][$k];
       //$a3 =$d[2][$k];
       $a4 =x_g($d[3][$k]);
       //$a5 =x_g($d[4][$k]);
       $a6 ='http://v.baidu.com'.$a5.'';
       $b2 = r_u($a2); 
       $ua =  $a4;
        $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$b2.'</a>';
echo  $xml;
}}}
function xiangmv($url) {
       $wk= array("guodegang","kengwang","yueyunpeng","qiandao","tuokouxiu","liuluoguo","download","xiazai","zhanghelun","guoqilin");
       $w = $_GET['w']?$_GET['w']:"0"; 
       //$kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       $ul = 'http://www.tingdegang.com/'.$wnk.'/';
       $ut = m_v($ul);
  preg_match_all("#<li><a href=\"(.*)\/([^>]+)\/([^>]+).html\"(.*)><img(.*)alt=\"([^>]+)\"(.*)\/>(.*)<(.*)span>([^>]+)<\/span(.*)><\/li>#ismU",$ut,$d);
  foreach($d[2] as $k=>$v){
       $a1 =$d[2][$k];
       $a2 =$d[3][$k];
       $a4 =m_u($d[6][$k]);
       $a5 =m_u($d[10][$k]);
       $ua =  'http://www.tingdegang.com/'.$a1.'/'.$a2.'.html';
       $ud = $ua;
       $vd=Current(explode('?',$v));
      //$xml ='<a href="'.$ua.'" target="b" >'.$a4.'('.$a5.')</a>';
    $xml ='<a href="'.$fname.'?&xsvid='.$ua.'"  target="b">'.$a4.'('.$a5.')</a>';
echo  $xml;
}}
function pansmv($url) {
       $w = $_GET['w']?$_GET['w']:"中英字幕"; 
       $kw=k_w($w);
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $ul = 'https://www.fastsoso.cn/search?page='.$i.'&k='.$kw.'&t=-1&s=1';
       $ut = m_s($ul);
  preg_match_all('#<strong>(.*)<a href="([^>]+)"(.*)target="_blank">([^>]+)</a>(.*)</strong>#ismU',$ut,$d);
  foreach($d[2] as $k=>$v){
       $a2 ='https://www.fastsoso.cn'.$d[2][$k];
       $a4 =m_u($d[4][$k]);
       //$a5 =m_u($d[8][$k]);
       $ud = $a2;
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ua.'" target="b" >'.$a4.'</a>';
echo  $xml;
}}}
function zymv($url) {
       $uk= array("0","7","8","9","10","11","12","13","14","5");
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $unk=$uk[$u];
       $ul = 'http://ziyuanpian.com/list/?'.$unk.'-'.$p.'.html';
       $ut = m_v($ul);
  preg_match_all('#<tr class="row"(.*)>(.*)<td(.*)align="left">(.*)<a href="([^>]+)"(.*)>([^>]+)</a></td>(.*)<td(.*)><font(.*)>([^>]+)</font></td>(.*)<td(.*)><font color="(.*)FF0000">([^>]+)</font>#ismU',$ut,$d);
  foreach($d[1] as $k=>$v){
       $a2 =$d[5][$k];
       $a3 =m_u($d[7][$k]);
       $a4 =m_u($d[11][$k]);
       $a5 =$d[15][$k];
       $a6 ='http://ziyuanpian.com'.$a2;
       $ut2 = m_v($a6);
  preg_match_all("#id='(.*)'(.*)value='([^>]+)'(.*)>([^>]+)<#ismU",$ut2,$d2);
  foreach($d2[1] as $k2=>$v2){
       $a7 =$d2[3][$k2];
       $a8 =m_u($d2[5][$k2]);
       $ua =  $a7;
       $ud = 'http://www.filmyun.cn/ykyun/yc.php?vid='.$ua;
       $vd=Current(explode('?',$v2));
      $xml ='<a href="'.$ud.'" target="b" >'.$a3.'  '.$a8.''.$a4.' ('.$a5.')</a>';
echo  $xml;
}}}
function xsmv($url) {//相声
       $wk= array("dankou","zuixin","jingdian","deyunshe2016","chunwan","jinguqiguan","zhaobenshan","movie","houyaowen","jiangkun","houbaolin","maji","taiyouquyishe","zmxsjlb");
       $uk= array("4","2","3","452","33","168","20","252","69","72","19","15","197","136");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$u];
       $unk=$uk[$u];
for ($i = 1; $i <=$p; $i++) {
       $ul = 'http://www.laoguo5.com/'.$wnk.'/list_'.$unk.'_'.$i.'.html';
       $ut = m_v($ul);
  preg_match_all("#<li><a href='([^>]+)'(.*)title=\"([^>]+)\"(.*)>#ismU",$ut,$d);
  preg_match_all('#<span class="v_time"></span><span class="v_bg"></span></a><span>([^>]+)</span></li>#ismU',$ut,$d1);
  foreach($d[1] as $k=>$v){
       $a2 =$d[1][$k];
       $a3 =m_u($d[3][$k]);
       $a4 =m_u($d1[1][$k]);
       $a5 ='http://www.laoguo5.com'.$a2;
       $ut2 = m_v($a5);
  preg_match_all("#var videostr = '([^>]+)';#ismU",$ut2,$d2);
  foreach($d2[1] as $k2=>$v2){
       $a7 =$d2[1][$k2];
       $ua =  $a7;
       $ud = $ua;
       $vd=Current(explode('?',$v2));
      $xml ='<a href="'.$ua.'" target="b" >'.$a3.'  ('.$a4.')</a>';
echo  $xml;
}}}}
function av99($url) {
       $u = $_GET['u']?$_GET['u']:0; 
       $wk= array("","/categories/d0df014883946b42d905f96390f84892","/categories/5a4e793520c46cbaee2b67760e5aea28","/categories/093dcb72562c17853642cc077829020a",
"/categories/2e42ff66f321b5bda55e8005ed5a002c","/categories/451bf6aed63bf5d8f04a13fb2448d52d","/categories/5d915fafb4889f0b225f2b80cc975332",
"/categories/f29f9403bdd60bc69cb48db835fea297");
       $w = $_GET['w']?$_GET['w']:0; 
       $p = $_GET['p']?$_GET['p']:1;
       $w2=k_w($w);
       $wnk=$wk[$w];
//for ($i = 1; $i <=$p; $i++) {}
       $ul1='http://www.99vv1.com'.$wnk.'/longest/'.$p.'/';
       //$ul2='http://www.99vv1.com/search/'.$p.'/?q='.$w2.'';
   //if ( $w <=7 ) $ul =$ul1;else $ul =$ul2;
       $ut = m_v( $ul1 );
  preg_match_all('#<div(.*)class="thumb-content"(.*)>(.*)<a(.*)href="([^>]+)"(.*)title="([^>]+)"#ismU',$ut,$d);
  preg_match_all('#<span class="duration">([^>]+)</span>#ismU',$ut,$d2);
  preg_match_all('#<span class="data">([^>]+)</span>#ismU',$ut,$d3);
  foreach($d[5] as $k=>$v){
       $a1 =$d[5][$k];  
       $a2 =$d[7][$k]; 
       $a3 =$d2[1][$k]; 
       $a4 =$d3[1][$k]; 
       $ua = av_99( $a1 );
       $ud = f_kd( $ua );
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.$a3.')('.$a4.')</a>';
echo  $xml;
}}
function av_99($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $ut = m_v($w);
  //preg_match('#<h1(.*)class="title">([^>]+)</h1>#U',$ut,$d1);
  preg_match("#video_url\:(.*)'([^>]+)/',#U",$ut,$d2);
       //$a1 =m_u($d1[2]);
       $ud = $d2[2];
  return $ud;
}
function bs_b($url) {
       $ut2 = m_v($url);
  preg_match_all("#f:'([^>]+)',#ismU",$ut2,$d2);
  foreach($d2[1] as $k2=>$v2){
       $ud =$d2[1][$k2];
  return $ud;
}}
if(isset ($_GET['s'])) {
        $xml = "";      
        $sw = $_GET['s']?$_GET['s']:"skdy";
        $xml = $sw($xml);
echo  $xml;
 }
elseif(isset ($_GET['fhdsj'])){
        $vid=$_GET['fhdsj'];
        $name=$_GET['name'];
        $ut2 = m_v($vid);
  preg_match_all("#id:'(.*)',link:'(.*)',img:'(.*)',title:'(.*)',index:'(.*)',text:'(.*)'#U",$ut2,$b2);
  foreach($b2[1] as $k2=>$v2){
        $a3 = $b2[1][$k2];
        $a4 = $b2[2][$k2];
        $a5 = $b2[6][$k2];
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud1 = f_ud($ua);
        $ud2 = '../ck/ck.php?a=tv&f='.fhf($ua);
if($a=="stv") $ud=$ud1;else $ud=$ud2;
        $vd=Current(explode('?',$v2));
     $xml='<a href="'.$ud2.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
elseif(isset ($_GET['fh_tv'])){
       $vid = $_GET['fh_tv'];
       $name=$_GET['name'];
        $st = m_v($vid);
        preg_match_all('#<h6>(.*)<a(.*)href="([^<]+)"(.*)>([^<]+)</a>#ismU',$st,$b);
        preg_match_all('#<span class="sets">([^<]+)</span>#ismU',$st,$b2);
        foreach($b[1] as $k=>$v){
        $a1 = $b[3][$k];
        $a2 = $b[5][$k];
        $a3 ='http://v.ifeng.com'.$a1.'';
        $a6 = $b2[1][$k];
        $a7 = fhv($a3);
        $a8 = '../v.htm?a=tv&f='.$a7;
   if(stripos($a1,'http') === false){$a4=$a3;}else{$a4=$a1;};
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud1 = $a8;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.m_u($name).')  '.$a6.'</a>';
echo $xml;
}}
elseif(isset ($_GET['ppdsj'])){
        $vid=$_GET['ppdsj'];
        $name=$_GET['name'];
        $ut0 = f_g($vid);
  preg_match_all('#"id":([^>]+),"id_encode":"([^>]+)","pid":([^>]+),"p_type":([^>]+),"cat_id":([^>]+),"subCataIds":#ismU',$ut0,$b0);
  foreach($b0[1] as $k0=>$v0){
        //$ut=$b0[1][$k0];
        $ut='http://apis.web.pptv.com/show/recommendall/'.$b0[1][$k0].'?from=web&version=1.0.0&format=jsonp&type=huaxu%2Cactor%2Cdirector%2Ctype%2Cseries%2Clove&num=30&ppi=302c32&cat_id='.$b0[5][$k0].'&contype=1%2C2%2C3%2C4&pid='.$b0[3][$k0].'&cb=pplive_callback_0';
        $ut1 = m_v($ut);
  preg_match_all('#"title":"([^>]+)","id":([^>]+),"url":"([^>]+)","external_url":"([^>]+)",#ismU',$ut1,$b1);
  foreach($b1[1] as $k1=>$v1){
        $a2 = r_u($b1[1][$k1]);
        $a3 = $b1[2][$k1];
        $a4 = x_g($b1[3][$k1]);
        $a5 = $b1[4][$k1];
        $a9='http://v.pptv.com/show/videoList?&cb=videoList&pid='.$a4.'&pageSize=100&cat_id='.$a5.'&ppi='.$bkid.'&highlight='.$a2.'';
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v2));
     $xml='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}}

elseif(isset ($_GET['mgdsj'])){
       $url = $_GET['mgdsj'];
    //preg_match('|/b/(.*)/([^>]+).html|',$url,$d);/*https://www.mgtv.com/b/303799/4149690.html*/
       //$vid = $d[2];
       $name = $_GET['name'];
       $tn = $_GET['tn']?$_GET['tn']:40;
     for($i=1;$i<=$tn;++$i){  
   $ul11='https://pcweb.api.mgtv.com/episode/list?video_id='.$url.'&page=1&size=0&callback=jQuery18207541720363117299_1509112625347&_support=10000000';
   $ul1='https://pcweb.api.mgtv.com/episode/list?_support=10000000&version=5.5.35&video_id='.$url.'&page='.$i.'&size=30';
   $ul2='http://v.api.mgtv.com/list/tvlist?video_id='.$vid.'&page=1&size=0&callback=jQuery182033446321869102197_1472265334706';
       $ut = m_v($ul1);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["clip_id"];
       $a3 = $a0["time"];
       $a4 = m_u($a0["t3"]);
       $a5 = $a0["video_id"];
       $ud = 'https://www.mgtv.com/b/'.$a2.'/'.$a5.'.html?';
       $xml ='<a href="'.f_kd($ud).'" target="b" >'.$a4.'  ('.$a3.')</a>';
echo $xml;
}}}
elseif(isset ($_GET['mgdsj2'])){
       $url = $_GET['mgdsj'];
    preg_match('|/b/(.*)/([^>]+).html|',$url,$d);/*https://www.mgtv.com/b/303799/4149690.html*/
       $vid = $d[2];
       $name = $_GET['name'];
   $ul1='https://pcweb.api.mgtv.com/episode/list?video_id='.$vid.'&page=1&size=0&callback=jQuery18207541720363117299_1509112625347&_support=10000000';
   $ul2='http://v.api.mgtv.com/list/tvlist?video_id='.$vid.'&page=1&size=0&callback=jQuery182033446321869102197_1472265334706';
       $ur = m_v($ul1);
    preg_match_all('|"t2":"([^>]+)"(.*)"t3":"([^>]+)"(.*)"t4":"([^>]+)"(.*)"ts":"([^>]+)"(.*)"url":"([^>]+)"|ismU',$ur,$b2);
    preg_match_all('|"url":"([^>]+)",|ismU',$ur,$b3);
    foreach($b2[1] as $k=>$v){
       $a4 = r_u($b2[1][$k]);
       $a5 = r_u($b2[3][$k]);
       $a6 = r_u($b2[5][$k]);
       $a7 = r_u($b2[7][$k]);
       $a8 = $b2[7][$k];
       $a9 = x_g($b3[1][$k]);
       $a10 = 'http://www.mgtv.com'.$a9.'';
       $ua =  $a10;
        //$ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).'('.$a6.')('.$a4.')('.$a7.')</a>';
echo $xml;
}}

elseif(isset ($_GET['ledsj2'])){
        $name = $_GET['name'];
        $cid1 = $_GET['cid'];
        $pid1 = $_GET['pid'];
        $vid1 = $_GET['vid'];
        $ul=f_g($_GET['ledsj']);
preg_match("|cid: ([0-9]+),|U",$ul,$d2);
preg_match("|pid: ([^>]+),|U",$ul,$d3);
preg_match("|vid: ([0-9]+),|U",$ul,$d4);
        $cid = $d2[1];
        $pid = $d3[1];
        $vid = $d4[1];
if($_GET['ledsj']=="") $cid=$cid1;else $cid=$cid;  
if($_GET['ledsj']=="") $pid=$pid1;else $pid=$pid; 
if($_GET['ledsj']=="") $vid=$vid1;else $vid=$vid; 
   //$url='http://api.letv.com/mms/out/album/getVideoList?top=0&max=10000&p=1&pid='.$vid.'';
   $url='http://d.api.m.le.com/card/dynamic?platform=pc&callback=jQuery19107196090229526585_1512088943978&vid='.$vid.'&cid='.$cid.'&id='.$pid.'&pagesize=100&type=episode&isvip=0&page=1';
        $ut = m_v($url);
   preg_match_all('|"duration":"([^>]+)"(.*)"episode":"([^>]+)"|ismU',$ut,$b1);
   preg_match_all('|"releaseDate":"([^>]+)"(.*)"title":"([^>]+)"|ismU',$ut,$b2);
   preg_match_all('|"vid":([^>]+),(.*)"videoType":([^>]+),|ismU',$ut,$b3);
   preg_match_all('|"subTitle":"([^>]+)",|ismU',$ut,$b4);
   preg_match_all('|"url":"([^>]+)"|ismU',$ut,$b5);
   foreach($b1[1] as $k=>$v){
        $a4 = $b1[1][$k];
        $a5 = $b1[3][$k];
        $a6 = $b2[1][$k];
        $a7 = r_u($b2[3][$k]); 
        $a8 = $b3[1][$k]; 
        $a9 = r_u($b4[1][$k]);
        $a10 = x_g($b5[1][$k]);
        $a11 = 'http://www.letv.com/ptv/vplay/'.$vid.'.html';
        $b6 = 'http://img1.c0.letv.com/ptv/player/swfPlayer.swf?autoPlay=1&cid='.$cid.'&id='.$pid.'&vid='.$vid.'';
        $ua =  $a10;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
   //$xml ='<a href="'.$url.'" target="b" >'.$url.'</a>';
   $xml ='<a href="'.$ud.'" target="b" >'.$a7.'('.$a5.')</a>';
echo $xml;
}}
elseif(isset($_GET['levid'])){
       $vid = $_GET['levid'];
       $aid = $_GET['aid'];
       $wk = $_GET['wk'];
     for($i=1;$i<=5;++$i){ 
       $ul='http://d-api-m.le.com/card/dynamic?platform=pc&callback=&vid='.$vid.'&cid='.$wk.'&id='.$aid.'&pagesize=50&type=episode&isvip=0&page='.$i.'';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["episode"]["videolist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["duration"];
       $a2 = $a0["episode"];
       $a3 = $a0["key"];
       $a4 = m_u($a0["title"]);
       $a5 = $a0["url"];
       $a6 = $a0["vid"];
       $a7 = m_u($a0["subTitle"]);
       $ud = '../v.htm?f='.$a5;
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.'   ('.$a1.')</a>';
echo $xml;
 }}}
elseif(isset($_GET['qqdsj'])){
       $vid = $_GET['qqdsj'];
       $name = $_GET['name'];
       $ul='https://s.video.qq.com/get_playsource?id='.$vid.'&plat=2&type=4&data_type=2&video_type=3&range=1-1500&plname=qq&otype=json&num_mod_cnt=20&callback=_jsonp_2_0044';
 preg_match("#\"videoPlayList\":\[\{(.*)\}\]\}#ism",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["episode_number"];
       $a2 = $a0["id"];
       $a3 = $a0["playUrl"];
       $a4 = $a0["title"];
       $ud = '../v.htm?f='.$a3;
     $xml ='<a href="'.$ud.'" target="b" >'.$name.' ('.$a1.')</a>';
echo $xml;
 }}
elseif(isset($_GET['qqdsj2'])){
       $vid = $_GET['qqdsj'];
       $name = $_GET['name'];
       $ul='https://s.video.qq.com/get_playsource?id='.$vid.'&plat=2&type=4&data_type=2&video_type=3&range=1-1500&plname=qq&otype=json&num_mod_cnt=20&callback=_jsonp_2_0044';
       $ut = m_v($ul);
preg_match_all('|"episode_number":"([^<]+)"(.*)"id":"([^<]+)"(.*)"playUrl":"([^<]+)"(.*)"title":"([^<]+)"|ismU',$ut,$d);
foreach($d[3] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = $d[3][$k];
       $a5 = $d[5][$k];
       $a6 = $d[7][$k];
       $ua =  $a5;
       $ud = '../v.htm?f='.$a5;
       $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$name.' ('.$a6.')</a>';
echo $xml;
 }}
elseif(isset ($_GET['dy360'])){
        $vid = $_GET['dy360'];
        $cat = $_GET['cat'];
        $rst = $_GET['rst']?$_GET['rst']:"qq";
        $up = $_GET['up'];
        $url = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&start=1&end='.$up.'&site='.$rst.'&callback=';
        $ut = m_v($url);
        $nt = J_d($ut,ture);
        $aa = $nt["data"]["playlinksdetail"]["".$rst.""]["default_url"];
        //$count_json = count($aa);
 //for ($i = 1; $i < $count_json; $i++) {}
       //$a0 = $aa[$i];
       //$a1 = $a0["default_url"];
       $ud = '../t.htm?f='.$aa;
echo header("Location: $ud");
}

elseif(isset ($_GET['dsj360'])){
        $vid = $_GET['dsj360'];
        $cat = $_GET['cat'];
        $rst = $_GET['rst']?$_GET['rst']:"qq";
        $up = $_GET['up'];
        $name = $_GET['name'];
        $url = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&callback=';
        $ut = m_v($url);
        $nt = J_d($ut,ture);
        $aa = $nt["data"]["allepidetail"]["".$rst.""];
        $count_json = count($aa);
 for ($i = 0; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = $a0["playlink_num"];
       $a2 = $a0["url"];
       $ud = '../t.htm?f='.$a2;
$xml ='<a href="'.$ud.'" target="b" >'.$name.'   ('.$a1.')</a>';
echo $xml;
}}
elseif(isset ($_GET['dm360'])){
        $vid = $_GET['dm360'];
        $cat = $_GET['cat'];
        $rst = $_GET['rst']?$_GET['rst']:"imgo";
        $up = $_GET['up'];
        $name = $_GET['name'];
        $url1 = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&start=1&end='.$up.'&site=*&callback=';
        $url = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&callback=';
        $ut = m_v($url);
preg_match_all('|"playlink_num":"([^<]+)"(.*)"url":"([^<]+)"|ismU',$ut,$d);
foreach($d[3] as $k=>$v){
       $a1 = $d[1][$k];
       $a2 = $d[3][$k];
       //$a3 = $d[5][$k];
       $ud = '../t.htm?f='.$a2;
$xml ='<a href="'.$ud.'" target="b" >'.$name.'   ('.$a1.')</a>';
echo $xml;
}}
elseif(isset ($_GET['zy360'])){
        $vid = $_GET['zy360'];
        $cat = $_GET['cat'];
        $rst = $_GET['rst']?$_GET['rst']:"qq";
        $up = $_GET['up'];
        $name = $_GET['name'];
        $url = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&callback=';
        //$url = 'https://api.web.360kan.com/v1/detail?cat='.$cat.'&id='.$vid.'&start=1&end='.$up.'&site='.$rst.'&callback=';
        $ut = m_v($url);
        $nt = J_d($ut,ture);
        $aa = $nt["data"]["defaultepisode"];
        $count_json = count($aa);
 for ($i = 0; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = $a0["name"];
       $a2 = $a0["playlink_num"];
       $a3 = $a0["pubdate"];
       $a4 = $a0["url"];
       $ud = '../t.htm?f='.$a4;
$xml ='<a href="'.$ud.'" target="b" >'.$a1.'   ('.$a3.')</a>';
echo $xml;
}}
elseif(isset ($_GET['qydsj'])){
       $vid = $_GET['qydsj'];
       $name=$_GET['name'];
       $ul2 = 'https://pcw-api.iqiyi.com/video/video/playervideoinfo?tvid=4366690063745000&locale=cn_s&callback=';
       $ul = 'https://pcw-api.iqiyi.com/albums/album/avlistinfo?aid='.$vid.'&page=1&size=300&callback=';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["epsodelist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["name"];
       $a2 = $a0["playUrl"];
       $a3 = $a0["duration"];
       $a4 = $a0["period"];
        $ua = $a2; 
        $ud = f_t($ua);
     $xml ='<a href="'.$ud.'" target="b" >'.m_u($a1).' ('.$a3.') ('.$a4.')</a>';
echo $xml;
}}
elseif(isset ($_GET['sinadsj'])){
       $vid = $_GET['sinadsj'];
       $name = $_GET['name'];
       $b2 = m_v($vid);
preg_match_all('#<a href="([^>]+)" target="_blank" id="exp(.*)" rel="(.*)">([^>]+)</a></li>#U',$b2,$d2);
foreach($d2[1] as $k=>$v){
       $a6 = $d2[1][$k];
       $a7 = $d2[4][$k];
       $a8 = 'http://video.sina.com.cn'.$a6.''; 
       $ua =  $a8;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$name.' ('.$a7.')</a>';
echo $xml;
}}
elseif(isset ($_GET['qyjs'])){
       $vid = $_GET['qyjs'];
       $name = $_GET['name'];
        $ul2 = m_v($vid);
//preg_match_all('|<h3><a href="([^<]+)">([^<]+)</a></h3>|imsU',$ul2,$b2);
preg_match_all('|<div class="site-piclist_pic">(.*)<a href="([^<]+)" class="site-piclist_pic_link"(.*)>(.*)<(.*)title="([^<]+)"(.*)>|imsU',$ul2,$b2);
preg_match_all('|<span class="mod-listTitle_right">([^<]+)</span>|imsU',$ul2,$b3);
   foreach($b2[1] as $k2=>$v2){
        $a7 = $b2[2][$k2];
        $a8 = $b2[6][$k2];
        $a10 = $b3[1][$k2];
        $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $v2=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$name.'('.$a8.')('.$a10.')</a>';
echo $xml;
}}
elseif(isset ($_GET['shjs'])){
       $vid = $_GET['shjs'];
       $ul =$vid;
       $ur = m_v($ul);
preg_match_all("#<li(.*)rel= '([^>]+)'(.*)><a(.*)href= '([^>]+)' ><span class=label>(.*)</span><img(.*)alt= '([^>]+)'(.*)></a>(.*)<span><strong><a(.*)href= '([^>]+)' >([^>]+)</a> </strong><em rel=([^>]+)></em></span></li>#ismU",$ur,$d);
    foreach($d[1] as $k=>$v){
       $a5 = m_u($d[2][$k]);
       $a6 = m_u($d[8][$k]);
       $a7 = $d[12][$k]; 
       $a8 = $d[13][$k];
       $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$ud.'" target="b" >'.$a6.' ('.$a5.')</a>';
echo $xml;
 }}

elseif(isset ($_GET['shjs3'])){
       $vid = $_GET['shjs'];
       $ul =$vid;
       $ur = m_v($ul);
preg_match_all("#<li(.*)clear='([^>]+)'><a(.*)href= '([^>]+)' ><span class=label><code class=ch></code></span><img(.*)alt= '([^>]+)'(.*)></a><span><strong><a(.*)href= '([^>]+)' >([^>]+)</a> </strong><em rel=([^>]+)></em></span></li>#ismU",$ur,$d);
    foreach($d[1] as $k=>$v){
       $a6 = m_u($d[6][$k]);
       $a7 = $d[9][$k]; 
       $a8 = $d[10][$k];
        $ua =  f_ht($ua);$ua =  $a7;
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$ud.'" target="b" >'.$a6.'</a>';
echo $xml;
 }}
elseif(isset ($_GET['shdsj'])){
       $ul = $_GET['shdsj'];
  preg_match('#var playlistId = "([^>]+)"#U',f_g($ul),$d1);
       $vid = $d1[1];
       $ur ='http://pl.hd.sohu.com/videolist?playlistid='.$vid.'&order=0&cnt=1&withLookPoint=1&preVideoRule=1&callback=__get_videolist';
       //$ur =sh_dsj($ul);
preg_match_all('#"name":"([^>]+)"(.*)"pageUrl":"([^>]+)"(.*)"publishTime":"([^>]+)"(.*)"showName":"([^>]+)"#ismU',m_v($ur),$d);
foreach($d[1] as $k=>$v){
       $a6 = m_u($d[1][$k]);
       $a7 = $d[3][$k]; 
       $a8 = $d[5][$k]; 
       $ua =  $a7;
       $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$ud.'" target="b" >'.$a6.' ('.$a8.')</a>';
echo $xml;
 }}
elseif(isset ($_GET['shzy'])){
       $vid = $_GET['shzy'];
       $name = $_GET['name'];
       $ul =$vid;
       $ur = m_v($ul);
preg_match_all('#<li class="c1">([^>]+)</li>(.*)<li class="c2"><a href="([^>]+)"(.*)title="([^>]+)"(.*)pb-url="variety"#ismU',$ur,$d);
    foreach($d[1] as $k=>$v){
       $a6 = $d[1][$k];
       $a7 = $d[3][$k]; 
       $a8 = $d[5][$k]; 
       $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v));
 $xml ='<a href="'.$ud.'" target="b" >'.$name.' '.$a8.' ('.$a6.')</a>';
echo $xml;
 }}
elseif(isset ($_GET['fundsj'])){
        $vid = $_GET['fundsj'];
        $lid = $_GET['lid'];
       $ul2='http://www.fun.tv/vplay/'.$lid.'-'.$vid.'/';
       $ul='http://api.funshion.com/ajax/vod_panel/'.$vid.'/w-1';
       $ut2=f_g($ul);
 preg_match_all('|"definition":"dvd","filename":"(.*)","ftype":"(.*)","hashid":"([^>]+)",|ismU',$ut2,$d);
 preg_match_all('|"videoid":(.*),"name":"([^>]+)","index":(.*),"number":(.*),|ismU',$ut2,$d2);
 preg_match_all('|"gallery_id":(.*),"name":"([^>]+)",|ismU',$ut2,$d3);
 preg_match_all('|"url":"([^>]+)"|ismU',$ut2,$d4);
    foreach($d[1] as $k2=>$v2){
       $a7 = $d[3][$k2];
       $a8 = $d2[2][$k2];
       $a9 = $d3[2][$k2];
       $a6 = stripslashes($d4[1][$k2]);
       $b8 = r_u($a8);
       $b9 = r_u($a9);
       $a10 = 'http://www.fun.tv'.$a6;
       $a11 = 'http://jobsfe.funshion.com/play/v1/mp4/'.$a7.'.mp4';
       $ua =  $a10;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v2));
 $xml ='<a href="'.$ud.'" target="b" >'.$b9.'('.$b8.')</a>';
echo $xml;
 } }
elseif(isset ($_GET['td_dy'])){
        $vid = $_GET['td_dy'];
        $lid = $_GET['lid'];
        $ul= 'http://www.tudou.com/outplay/goto/getPlaylistItems.html?lid='.$lid;
        $ut3 = m_v($ul);
  preg_match_all('|"code":"([^<]+)",|ismU',$ut3,$d3);
  preg_match_all('|"title":"([^<]+)",|imsU',$ut3,$d4);
  preg_match_all('|"createdTime":"([^<]+)",|imsU',$ut3,$d5);
  preg_match_all('|"cid":([^<]+),|imsU',$ut3,$d6);
  foreach($d3[1] as $k3=>$v3){
        $a9 = $d3[1][$k3];
        $a10 = $d4[1][$k3];
        $a11 = 'http://www.tudou.com/listplay/'.$vid.'/'.$a9.'.html';
        $a12 = $d5[1][$k3];
        $a13 = $d6[1][$k3];
        $ua =  $a11;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v3));
     //$xml ='<a href="'.$ud.'" target="b" >'.$a10.'('.$a5.'-'.$a13.'个)('.$a12.')</a>';
     $xml ='<a href="'.$ud.'" target="b" >'.$a10.'  ('.$a12.')</a>';
echo $xml;
}}
elseif(isset ($_GET['tddsj'])){
        $url = $_GET['tddsj'];
        $ut = m_v($url);
preg_match_all('|<div class="td-listbox__list__item--show" data-vid="(.*)"><a href="([^<]+)" title="([^<]+)" class="td-video" data-spm="dlink(.*)">(.*)<span class="td-video__num">([^<]+)</span>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a2 = 'http:'.$d[2][$k];
        $a3 = $d[3][$k];
        $a4 = $d[6][$k];
        $ua =  $a2;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}

elseif(isset ($_GET['tdph'])){
        $vid = $_GET['tdph'];
        $lid = $_GET['lid'];
        $ut2 = m_v($a4);
preg_match_all('|"itemTitle":"(.*)"|imsU',$ut2,$b2);
preg_match_all('|"itemPlayUrl":"(.*)"|imsU',$ut2,$b3);
foreach($b2[1] as $k2=>$v2){
        $a6= $b2[1][$k2];
        $a7= $b3[1][$k2];
        $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v2));
     $xml ='<a href="'.$ud.'" target="b" >'.$a6.'</a>';
echo $xml;
}}
elseif(isset ($_GET['dhmav'])){
        $vid = $_GET['dhmav'];
        $lid = $_GET['lid'];
preg_match('|"player":"([^>]+)","url":"([^>]+)"|ism',m_v($vid),$d);
       $a4 = $d[2];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a4.''; 
}else{ 
       $ud = '../d.htm?u=&f='.$a4.''; 
}
echo header("Location: $ud");     
}
elseif(isset ($_GET['cnlx'])){
        $vid=$_GET['cnlx'];
        $name=$_GET['name'];
        $w=$_GET['w']?$_GET['w']:1;
        $ut= m_v($vid);
preg_match_all('|vsid="([^<]+)";|ismU',$ut,$b1);
foreach($b1[1] as $k1=>$v1){
        $a2 = $b1[1][$k1];
        $p = $_GET['p'];
   if ($p == '')  $p='1';else  $p=$_GET['p'];
    for($i=1;$i<=$p;$i++){
        $a3 = 'http://tv.cntv.cn/api/video/getvideo/vsid_'.$a2.'%7Cem_1%7Cof_order%7Cn_16%7Cp_'.$i.'%7Ct_jsonp';
        $ut2= m_v($a3);
preg_match_all('|"vsid":"([^<]+)","order":"([^<]+)","vid":"([^<]+)","t":"([^<]+)","url":"([^<]+)",|ismU',$ut2,$b2);
foreach($b2[1] as $k2=>$v2){
        $a4 = $b2[1][$k2];
        $a5 = $b2[3][$k2];
        $a6 = $b2[4][$k2];
        $d6 = r_u($a6); 
        $a7 = 'http://tv.cntv.cn/video/'.$a4.'/'.$a5.'';
        $a8 = x_g($b2[5][$k2]);
        $ua =  $a8;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
       $v=Current(explode('?',$v2));
       $xml ='<a href="'.$ud.'" target="b" >'.$d6.'</a>';
echo $xml;
}}}}
				
elseif(isset ($_GET['wsdsj'])){
        $vid=$_GET['wsdsj'];
        $name=$_GET['name'];
        $ut= m_v($vid);
preg_match_all('|<li class="rela tele_rela">(.*)<a(.*)href="([^<]+)" onClick=(.*)>([^<]+)</a>|ismU',$ut,$d);
//preg_match_all('|<li class="rela tele_rela">(.*)<a(.*)href="([^<]+)" onClick=(.*)>([^<]+)</a>(.*)<p class="abso focus">([^<]+)</p>(.*)</li>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = $d[3][$k];
        $a2 = $d[5][$k];
        //$a3 = m_u($d[7][$k]);
        $ua =  $a1;
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$name.'('.$a2.')</a>';
echo $xml;
}}
elseif(isset ($_GET['wsdsj2'])){
        $vid=$_GET['wsdsj'];
        $name=$_GET['name'];
        $ut= m_v($vid);
preg_match_all("|changeAggTeleData\(([^<]+),'([^<]+)','([^<]+)',([^<]+),([^<]+)\);|ismU",$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = $d[1][$k];
        $a2 = $d[2][$k];
        $a3 = $d[3][$k];
        $a4 = $d[4][$k];
        $a5 = $d[5][$k];
        $a6 = 'http://www.wasu.cn/AggTele/AjaxAggTeleData?id='.$a1.'&sid='.$a2.'&source='.$a3.'&series='.$a4.'&updnum='.$a5.'&type=11';
        $ut2= x_g(m_v($a6));
preg_match_all("|<li class=\"rela\"><a(.*)href=\"([^<]+)\" onclick=\"gsTracker\('([^<]+)'\)\">([^<]+)<|ismU",$ut2,$d2);
foreach($d2[1] as $k2=>$v2){
        $a7 = $d2[2][$k2];
        $a8 = $d2[3][$k2];
        $a9 = $d2[4][$k2];
        $ua =  $a7;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v2));
     $xml ='<a href="'.$ud.'" target="b" >'.$name.'('.$a8.')('.$a9.')</a>';
echo $xml;
}}}
elseif(isset ($_GET['wsjs'])){
        $vid=$_GET['wsjs'];
        $name=$_GET['name'];
        $ut= m_v($vid);
preg_match_all('|<div class="ws_des">(.*)<p><a(.*)href="([^<]+)"(.*)>([^<]+)</a></p>|ismU',$ut,$b2);
preg_match_all('|<p><span>([^<]+)</span></p>|ismU',$ut,$b3);
preg_match_all('|<div class="meta_tr">([^<]+)</div>|ismU',$ut,$b4);
preg_match_all('|<li><a id="tele(.*)" oid="(.*)" href="([^<]+)"(.*)title="([^<]+)">(.*)</a></li>|ismU',$ut,$b0);
foreach($b2[3] as $k2=>$v2){
        $a4 = $b2[3][$k2];
        $a5 = $b2[5][$k2];
        $a6 = $b3[1][$k2];
        $a3 = $b4[1][$k2];
        $d4 = $b0[3][$k2];
        $d5 = $b0[5][$k2];
   if($d4 == '')  $a7=$a4;else  $a7=$d4;
   if($d4 == '')  $a8=$a5;else  $a8=$d5;
        $ua =  $a4;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
     $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).'('.$a5.')('.$a3.')</a>';
echo $xml;
}}
elseif(isset ($_GET['wszx'])){
        $vid=$_GET['wszx'];
        $name=$_GET['name'];
        $ut= m_v($vid);
preg_match_all("|<li onclick=\"changeAggColumnCp\(([^<]+),'([^<]+)','([^<]+)'\)\;\" class=\"hover\"><a style=\"(.*)\">(.*)</a></li>|ismU",$ut,$b);
foreach($b[1] as $k=>$v){
        $a4 = $b[1][$k];
        $a5 = $b[2][$k];
        $a6 = $b[3][$k];
        $mun=date("m");
//for ($i = 1; $i <=$mun; $i++) {}
        $a7 = 'http://www.wasu.cn/AggColumn/AjaxAggColumnData?id='.$a4.'&sid='.$a5.'&source='.$a6.'&flag=3&year=2016&month='.$mun;
        $ut2= x_g(f_g($a7));
preg_match_all('|<div class="pic_box"><div class="pic_img rela"><a href="([^<]+)"|ismU',$ut2,$b2);
preg_match_all('|<p class="abso_lb pic_shadow">([^<]+)</p></div>|ismU',$ut2,$b3);
foreach($b2[1] as $k2=>$v2){
        $a8 = $b2[1][$k2];
        //$a9 = r_u($b2[3][$k2]);
        //$a10 = r_u($b2[4][$k2]);
        $a11 = $b3[1][$k2];
        $ua =  $a8;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
     //$xml ='<a href="'.$ud.'" target="b" >'.m_u($name).'('.$ud.')</a>';
     $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).'('.$a9.')('.$a10.')('.$a11.')</a>';
echo $xml;
}}}
elseif(isset ($_GET['xsvid'])){
set_time_limit(0);
       $at = $_GET['xsvid'];
preg_match("|url: '([^>]+)',|U",m_v($at),$d);
       $a8 = $d[1];
       $ud = '../w.htm?u=&f='.$a8;
if($a8==null) {
preg_match("|iosplayer\('([^>]+)','([^>]+)'(.*)\);|U",m_v($at),$d);
       $a9 = $d[2];
       $ud = '../t.htm?u=&f=https://v.youku.com/v_show/id_'.$a9.'.html'; 
}
 echo header("Location: $ud"); 
}	
elseif(isset ($_GET['ykph'])){
        $vid = $_GET['ykph'];
        $a3 = ''.$vid.'/videos';
        $ul2 = m_v($a3);
preg_match_all('#<a _hz="l_v_title"   title="(.*)" target="video" href="(.*)">#ismU',$ul2,$b2);
preg_match_all('#<div class="v-thumb-tagrb"><span class="v-time">(.*)</span></div>#ismU',$ul2,$b3);
preg_match_all('#c_time="(.*)"#ismU',$ul2,$b4);
        foreach($b2[1] as $k2=>$v2){
        $a4 = $b2[1][$k2];
        $a5 = $b2[2][$k2];
        $a6 = $b3[1][$k2];
        $a7 = $b4[1][$k2];
        $ua = $a5;   
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v2));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.'('.$a6.')('.$a7.')</a>';
echo $xml;
}}
elseif(isset ($_GET['yk_dy'])){
        $uk= array("0","1","2","3","4");
        $p = $_GET['p']?$_GET['p']:"2";
        $u = $_GET['u'];
        $unk = $uk[$u];
        $ykdv = $_GET['yk_dv'];
        $ykdy = $_GET['yk_dy'];
    for($i=1;$i<=$p;$i++){
        $url2 = 'http://list.youku.com/category/'.$ykdv.'/c_'.$ykdy.'.html';
        $url = 'http://list.youku.com/category/page?c='.$ykdy.'&u=1&pt=0&type='.$ykdv.'&p='.$i.'';
        $name = $_GET['name'];
        $ut = m_v($url);
preg_match_all('|"title":"([^>]+)"(.*)"subTitle":"([^>]+)"(.*)"videoId":"([^>]+)"(.*)"videoLink":"([^>]+)"|ismU',$ut,$b);
foreach($b[1] as $k=>$v){
        $a2 = r_u($b[1][$k]);
        $a3 = r_u($b[3][$k]);
        $a4 = $b[5][$k];
        $a5 = x_g($b[7][$k]);
        $a6 = 'http:'.$a5;
        $a7 = 'https://v.youku.com/v_show/id_'.$a4.'.html';
        $ua = $a6;
        $ud = f_v($ua);
        $fn = ''.$fname.'?&ykdsj='.$a4.'&wid='.yk_wid( $a7 ).'&p='.$p.'&wnk='.$wnk.'&name='.$a2.'';
        $tg='target="b1"';
        $tb='target="b"';
   if ($w == '1'||$w == '6'||$w == '8'||$w == '9') $ud=$ud;else $ud=$fn;
   if ($w == '1'||$w == '6'||$w == '8'||$w == '9') $tg=$tb;else $tg=$tg;
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" '.$tg.' >'.$a2.' ('.$a3.')</a>';
echo $xml;
}}}
elseif(isset ($_GET['yk_dt'])){
        $uk= array("0","1","2","3","4");
        $u = $_GET['u'];
        $unk = $uk[$u];
        $ykdt = $_GET['yk_dt'];
        $ykdv = $_GET['yk_dv2'];
        $ykdy = $_GET['yk_dy2'];
        $p = $_GET['p']?$_GET['p']:"5";
     if($p=="") $p=5;else $p=$p;
    for($i=1;$i<=$p;$i++){
        $url = 'http://list.youku.com/category/show/c_'.$ykdy.'_u_1_s_6_d_1_pt_'.$unk.'_g_'.$a1.'_p_'.$i.'.html';
        $ut = m_v($url);
preg_match_all('|<div class="p-thumb"><a href="([^>]+)"(.*)title="([^>]+)"(.*)>(.*)<li class="actor">(.*)</li><li>([^>]+)</li></ul></div></li>|ismU',$ut,$b);
preg_match_all('|<span>([^>]+)</span></span></li>|ismU',$ut,$b2);
foreach($b[1] as $k=>$v){
        $a3 = 'http:'.$b[1][$k];
preg_match("|(.*)\/id_([^>]+).html|ismU",$a3,$d);
        $a7 = $d[2];
        $a8 = 'http://61.160.236.39/ykdata/%7D/2_'.$a7.'_data.m3u8';
        $a4 = $b[3][$k];
        $a5 = $b[7][$k];
        $a6 = $b2[1][$k];
        $ua = '';
 if($a=="m3u8") $ua= $a8;else $ua= $a3;
        $ud = f_kd(f_ht($ua));
        $fn = ''.$fname.'?&ykdsj='.$ua.'&name='.$a4.'';
        $tg='target="b1"';
        $tb='target="b"';
   if ($ykdy == '95'||$ykdy == '96'||$ykdy == '86'||$ykdy == '91') $ud=$ud;else $ud=$fn;
   if ($ykdy == '95'||$ykdy == '96'||$ykdy == '86'||$ykdy == '91') $tg=$tb;else $tg=$tg;
        $vd=Current(explode('?',$v));
$xml ='<a href="'.$ud.'" '.$tg.' >'.$a4.' ('.$a5.')('.$a6.')</a>';
echo $xml;
}}}
elseif(isset ($_GET['ykdsj'])){
        $ul = $_GET['ykdsj'];
        $wnk = $_GET['wnk']?$_GET['wnk']:"97";
        $name = $_GET['name'];
        $wid = $_GET['wid'];
        $p = $_GET['p']?$_GET['p']:"2";
    for($i=1;$i<=$p;$i++){
        $url = 'https://v.youku.com/page/playlist?&l=debug&pm=3&vid=436660902&fid=0&showid='.$wid.'&sid=0&componentid=38011&videoCategoryId='.$wnk.'&isSimple=false&videoEncodeId='.$ul.'&page='.$i.'&callback=tuijsonp12';
        $url2 = 'https://v.youku.com/page/playlist?&l=debug&pm=3&vid=1032459228&fid=0&showid='.$wid.'&sid=0&componentid=38011&videoCategoryId='.$wnk.'&isSimple=false&videoEncodeId='.$ul.'&page=1&callback=tuijsonp10';
        $url3 = 'https://acs.youku.com/h5/mtop.youku.columbus.gateway.new.execute/1.0/?jsv=2.6.1&appKey=24679788&t=1606123968063&sign=08c6df6e69208e5def0dfc4051ed5e39&api=mtop.youku.columbus.gateway.new.execute&type=originaljson&v=1.0&ecode=1&dataType=json&data={"ms_codes":"2019030100","params":"{"biz":true,"scene":"component","componentVersion":"3","ip":"101.85.1.53","debug":0,"utdid":"jaBYF3Y1jkkCAWVVAJbENNes","userId":",platform":"pc","nextSession":"{"componentIndex":"3","componentId:"61518","level":"2","itemPageNo":"0",lastItemIndex":"0","pageKey":"LOGICSHOW_LOGICTV_DEFAULT","group":"0","itemStartStage":1,"itemEndStage":300}","videoId":"XNDk3MDQ5NDYzNg==","showId":"39cdbdefbfbd36efbfbd"}","system_info":"{"os":"pc","device":"pc",ver":"1.0.0","appPackageKey":"pcweb","appPackageId":"pcweb"}"}';
       $ut = m_v($url2);
        $ut =  str_replace('\t', '',$ut);
        $ut =  str_replace('\n', '',$ut);
preg_match_all('|"title="([^>]+)"(.*)href="([^>]+)"|ismU',x_g($ut),$d);
foreach($d[1] as $k=>$v){
        $a1 = m_u($d[1][$k]);
        $a2 = $d[3][$k];
        $ua = 'http:'.$a2;
        $ud = f_v($ua);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a1.'</a>';
echo $xml;
}}}
elseif(isset ($_GET['ykdsj3'])){
        $url = $_GET['ykdsj'];
        $name = $_GET['name'];
        $ut = m_v($url);
preg_match_all('|<div class="item(.*)item-id="([^>]+)"(.*)title="([^>]+)"(.*)>(.*)<a(.*)href="([^>]+)"(.*)>(.*)<span(.*)>([^>]+)</span>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = $d[4][$k];
        $a2 = $d[8][$k];
        $a3 = $d[12][$k];
        $ua = f_ht($a2);
        $ud = f_kd($ua);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).' ('.$a1.')('.$a3.')</a>';
echo $xml;
}}
elseif(isset ($_GET['le_dy'])){
        $uk= array("0","1","2","3","4");
        $p = $_GET['p']?$_GET['p']:"1";
        $url = $_GET['le_dy'];
        $name = $_GET['name'];
        $ut = m_v($url);
preg_match_all('|<li>(.*)<a(.*)href="http://list.le.com/listn/c([^>]+)_([^>]+)_o([^>]+)_([^>]+)p.html"(.*)title="([^>]+)"(.*)>(.*)</a></li>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = $d[3][$k];
        $u = $a1;
        $a2 = $d[4][$k];
        $a3 = $d[5][$k];
   if($a1=="5") $a3=20;else if($a1=="2"||$a1=="s2") $a3=51;else if($a1=="11") $a3=20;else if($a1=="16") $a3=1;else $a3=4;
        $a4 = $d[6][$k];
        $a5 = $d[8][$k];
        $a6 = 'http://list.le.com/listn/c'.$a1.'_'.$a2.'_o'.$a3.'_'.$a4.'';
        $ua = $a6;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$fname.'?&le_dt='.$a6.'&u='.$u.'&p='.$p.'" >'.$a5.'</a>'."\n";
echo $xml;
}}
elseif(isset ($_GET['le_dt'])){
        $uk= array("0","1","2","3","4");
        $p = $_GET['p']?$_GET['p']:"2";
        $u = $_GET['u'];
        $name = $_GET['name'];
    for($i=1;$i<=$p;$i++){
        $url = $_GET['le_dt'].'p'.$i.'.html';
        $ut = m_v($url);
preg_match_all('|<dt class="hd_pic">(.*)<a(.*)href="([^>]+)"(.*)title="([^>]+)"(.*)>(.*)<span(.*)class="number_bg">([^>]+)</span>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = $d[3][$k];
 preg_match('|<p class="desBox_con">(.*)<div class="top_botm"><a href="([^>]+)"(.*)>([^>]+)</a>|imsU',f_g($a1),$d2);
        $a9 =  $d2[2];
        $a2 = $d[5][$k];
        $a3 = $d[9][$k];
        $tg='target="b1"';
        $tb='target="b"';
        $ud = f_kd(f_ht($a1));
        $vd=Current(explode('?',$v));
     $xml1='<a href="'.$ud.'" target="b">'.$a2.'('.$a3.')</a>'."\n";
     $xml2 ='<a href="'.$fname.'?&ledsj='.$a9.'&name='.$a2.'" >'.$a2.'('.$a3.')</a>'."\n";
     if($u=='2'||$u=='5'||$u=='16'||$u=='11'||$u=='s2') $xml=$xml2;else $xml=$xml1;
echo $xml;
}}}
elseif(isset ($_GET['le_dy2'])){
        $uk= array("","30020","30010","30012","30013","30021","30022","30014","30154","30011","30009","30017","30018","30019","30023","30024","30155","30026","30027","30015","30153","30016","30025","30156");
        $p = $_GET['p']?$_GET['p']:"60";
        $u = $_GET['u']?$_GET['u']:"0";
        $url = $_GET['le_dy2'];
        $unk = $uk[$u];
        $url2 = 'http://api.vip.le.com/search/interface?callback=jQuery19109398005350490409_1513055862158&from=pc_03&request_time=1513055862142&sales_area=cn&user_setting_country=cn&cg=1&ph=420001&pt=141001&dt=1&src=1&ispay=1&stype=1&lang=zh_cn&stt=1&ps='.$p.'&pn=1&lh=0&vt=180001&sc='.$unk.'&ar=&yr=&or=4';
        $name = $_GET['name'];
        $ut = m_v($url2);
preg_match_all('|"name":"([^>]+)"(.*)"videoType":"([^>]+)"(.*)"videoTypeName":"([^>]+)"(.*)"url":"([^>]+)"(.*)"vid":"([^>]+)",|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
        $a1 = m_u($d[1][$k]);
        $a2 = $d[7][$k];
        $ua = f_ud(f_ht($a2));
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ua.'" target="b">'.$a1.'</a>'."\n";
echo $xml;
}}

elseif(isset ($_GET['ykal'])){
       $al=$_GET['ykal'];
       $tl = explode('-',$al);
       for ($i = 1; $i <= $tl[1]; $i++) {
       $ur = 'http://www.youku.com/v_olist/c_96_g_'.urlencode(m_u($tl[0])).'_a__sg__mt__lg__q__s_6_r_0_u_1_pt_1_av_0_ag_0_sg__pr__h__d_1_p_'.$i.'.html';
       $ur2 ='http://www.youku.com/v_olist/c_96_g_'.m_g($tl[0]).'_a__sg__mt__lg__q__s_6_r_0_u_1_pt_1_av_0_ag_0_sg__pr__h__d_1_p_'.$i.'.html';
       $a2='第'.$i.'页';
       $a3=m_u($a2);
       $xml='<a href="'.$fname.'?&ykur='.$ur.'" target="b1" >'.m_u($tl[0]).'-'.$a3.'</a>';
       //$xml='<a href="'.$fname.'?&ykur='.urlencode($ur).'" target="b1" >'.m_u($tl[0]).'-'.$a3.'</a>';
echo $xml;
}}
elseif(isset ($_GET['ykur'])){
       $ul=$_GET['ykur'];
        $ul2 = m_v($ul);
preg_match_all('#<div class="p-link">(.*)<a href="([^>]+)" target="_blank" title="(.*)">#ismU',$ul2,$b);
foreach($b[1] as $k=>$v){
        $a4 = $b[2][$k];
        $a5 = $b[3][$k];
    $xml='<a href="'.$fname.'?&ykdy='.$a4.'&name='.$a5.'"  target="b1" >'.$a5.'</a>'."\n";
echo $xml;
}}
elseif(isset ($_GET['bfdsj'])){
        $vid = $_GET['bfdsj'];
        $name = $_GET['name'];
       $ut2 = m_v($vid);
preg_match_all('#<a href="([^>]+)" title="(.*)" drama="(.*)" class="" rel=nofollow>(.*)</a>#ismU',$ut2,$c2);
    foreach($c2[1] as $k2=>$v2){
       $a5 = $c2[1][$k2];
       $a6 = $c2[2][$k2];
       $a7 = $c2[3][$k2];
       $a8 = 'http://www.baofeng.com/'.$a6.'';
       $ua =  $a8;
        $ua =  f_ht($ua);
       $ud = f_kd(f_ht($ua));
       $vd=Current(explode('?',$v2));
 $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).'('.$a6.')</a>';
echo $xml;
}}
elseif(isset ($_GET['sgdy'])){
       $ul2 = $_GET['sgdy'];
       $name = $_GET['name'];
       $ut = m_v($ul2);
preg_match_all('#<li class="js-source-li"(.*)sid="([^>]+)"(.*)vid="([^>]+)"><a class="picon" href="([^>]+)"><i class="picon-icon(.*)"></i>([^>]+)</a></li>#ismU',$ut,$d);
   foreach ($d[3] as $k=>$v){
        $a6 = $d[5][$k];
        $a7 = $d[7][$k];
        $a9 = 'http://kan.sogou.com'.$a6.'';
        $a12 = g_h($a9);
        $ua =  $a12;
        $ua =  f_ht($ua);
        $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));          
     $xml ='<a href="'.$ud.'" target="b" >'.m_u($name).' '.$a7.'</a>';
echo $xml;
}}
elseif(isset ($_GET['mv163'])){
        $ul = $_GET['mv163'];
        $name = m_u($_GET['name']);
        $rd = $_GET['rd'];
        $ut = m_v($ul);
   if($rd!= 'movie'){
preg_match_all('|<td class="u-ctitle">([^>]+)<a(.*)href="([^>]+)">([^>]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $b3=m_u($d[1][$k]);
        $b5=$d[3][$k];
        $b4=m_u($d[4][$k]);
        $ud =  f_cd2($b5);
        $vd=Current(explode('?',$v));
    $xml='<a href="'.$ud.'" target="b" >'.$name.''.$b3.' '.$b4.'</a>';
}}else{
preg_match("|appsrc : '([^>]+)',|U",$ut,$d2);
        $a2=u_e($d2[1]);
        $ud =  f_kd($a2);
     $xml='<a href="'.$ud.'" target="b" >'.$name.'</a>';
   //if($rd == 'movie')  $xml=$xml2;else  $xml=$xml3;
}
echo  $xml;
}
if(isset ($_GET['zqlid'])){
       $ul2 = $_GET['zqlid'];
       $name = $_GET['name'];
       $ul= 'http://www.zhanqi.tv/'.$_GET['zqlid'].'';
       $ut = m_v($ul);
       preg_match('|"videoId":"(.*?)"|i', $ut, $vid);
       $a3 = 'http://zqcdn.ebit.cn/zqlive/'.$vid[1].'.flv';
       $a4 = 'http://yfhdl.cdn.zhanqi.tv/zqlive/'.$vid[1];
       $a5 = 'http://yfrtmp.cdn.zhanqi.tv/zqlive/'.$vid[1];
       $ua = $a4;
        $ua =  f_ht($ua);
       $ud = '../ck.php?&f='.$a4.'';
       //Header("location:$ud");
 $xml ='<a href="'.$ud.'" target="b" >'.$name.'</a>';
echo $xml;
}
elseif(isset ($_GET['clm'])){
       $clm =$_GET['clm'];
       $vtime =$_GET['vtime'];
       $ul = 'https://search.cctv.com/ifsearch.php?page=1&qtext='.$clm.'&sort=date&pageSize=40&type=video&vtime='.$vtime.'&datepid=1&channel=%E4%B8%8D%E9%99%90&pageflag=0&qtext_str='.$clm.'';
 //preg_match("#\"list\":\[\{(.*)\}\],\"flag\"#U",m_v($ul),$b);
       //$ut = '['.'{'.$b[1].'}'.']';
       $ut = m_v($ul);
       $aa = J_d($ut,ture);
       $aa = $aa["list"];
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
       $ud3 = f_ck($ua2);
       $xml ='<a href="'.$ud3.'" target="b" >'.$a5.' ('.$a7.') ('.$a8.')</a>';
echo $xml;
}}
elseif(isset ($_GET['sgsovid'])){
       $ul= $_GET['sgsovid'];
   preg_match("#\"ourl\":\"([^<]+)\"#ismU",m_v($ul),$b);
        $ua1 =  r_u(b_d3($b[1]));
        $ua2 =  'https://v.sogou.com'.$ua1;
if(stripos($ua1,'http') !== false) $ua3 = $ua1;else $ua3=$ua2;
        $ud =  '../v.htm?f='.g_h($ua3);
echo header("Location: $ud");
}
elseif(isset ($_GET['bidsj'])){
       $aid = $_GET['bidsj'];
       $name = $_GET['name'];
       $url = "https://api.bilibili.com/view?appkey=8e9fc618fbd41e28&id=".$aid."&type=json";
       $file = m_v($url);
       $arr = json_encode($file,true);
       $arr = json_decode($arr,true);
preg_match('|"cid":([^>]+),|U',$arr,$d2);
preg_match('|"pages":([^>]+),|U',$arr,$d3);
       $a2=$d2[1];
       $a3=$d3[1];
    for($i=1;$i<=$a3;$i++){
       $ua = 'http://www.bilibili.com/video/av'.$aid.'/index_'.$i.'.html';
       $ud = f_kd(f_ht($ua));
        $vd=Current(explode('?',$v));          
     $xml ='<a href="'.$ud.'" target="b" >'.$name.' ('.$i.')</a>';
echo $xml;
}}
?>
