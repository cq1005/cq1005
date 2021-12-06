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
function m_s($url,$postdata,$cookie=''){
set_time_limit(0);
      $header=array('Expect:'); //避免data数据过长问题 
      //$post = $_SERVER['QUERY_STRING']; 
      $postdata = array ( );
      $post_data = http_build_query($postdata);
      //$cacert = getcwd() . '/cacert.pem'; //CA根证书   
      //$SSL = substr($url, 0, 8) == "https";
      $time=6000;
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
      curl_setopt($ch, CURLOPT_SSLVERSION, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
      curl_setopt($ch, CURLOPT_MUTE,1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
      curl_setopt($ch, CURLINFO_HEADER_OUT,1);//启用时追踪句柄的请求字符串
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time); 
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); //模拟用户使用的浏览器
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
  if($postdata!='') {
	curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
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
    curl_close($ch); // 关闭CURL会话
    return $file; // 返回数据
}
function m_v($url,$data=null,$cookie='') {
      $header=array('Expect:');//避免data数据过长问题 
      $https= $_SERVER["HTTPS"];
      $host = str_replace('&','&',$url);
      //$SSL = substr($url, 0, 7) == "https" ? true : false;
      //$cacert = getcwd() . '/cacert.pem'; //CA根证书 
      $time = '6000';
      $ch = curl_init($url); 
       curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
       curl_setopt($ch, CURLOPT_SSLVERSION, 0);
       curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
       curl_setopt($ch, CURLOPT_MUTE,1);
       curl_setopt($ch, CURLOPT_URL, $url);//要访问地
       curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
       curl_setopt($ch, CURLINFO_HEADER_OUT,1);//启用时追踪句柄的请求字符串
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$time);
       curl_setopt($ch, CURLOPT_TIMEOUT,$time);//设置超时限制
       curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);//模拟用户使用的浏览器
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
       curl_setopt($ch, CURLOPT_NOBODY,false);//输出中不包含body
       curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
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
      curl_close($ch);
     if ($file === false) { 
    header('HTTP/1.1 400 Bad Request'); 
    exit; 
  } else { 
       return $file; 
}}
function m_t($url, $isPostRequest=false, $data=[], $header=[], $certParam=[]){ // 模拟提交数据函数
    $curlObj = curl_init(); // 启动一个CURL会话
    //如果是POST请求
    if( $isPostRequest ){
        curl_setopt($curlObj, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, http_build_query($data)); // Post提交的数据包
    }else{  //get请求检查是否拼接了参数，如果没有，检查$data是否有参数，有参数就进行拼接操作
        $getParamStr = '';
        if(!empty($data) && is_array($data)){
            $tmpArr = [];
            foreach ($data as $k=>$v){
                $tmpArr[] = $k . '=' . $v;
            }
            $getParamStr = implode('&', $tmpArr);
        }
        //检查链接中是否有参数
        $url .= strpos($url, '?') !== false ? '&' . $getParamStr : '?' . $getParamStr;
    }
    curl_setopt($curlObj, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    //检查链接是否https请求
    if(strpos($url, 'https') !== false){
        //设置证书
        if( !empty($certParam) && isset($certParam['cert_path']) && isset($certParam['key_path']) ){
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($curlObj, CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($curlObj, CURLOPT_SSLCERT, $certParam['cert_path']);
            curl_setopt($curlObj, CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($curlObj, CURLOPT_SSLKEY, $certParam['key_path']);
        }else{
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($curlObj, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
        }
    }
    // 模拟用户使用的浏览器
    if(isset($_SERVER['HTTP_USER_AGENT'])){
        curl_setopt($curlObj, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    }
    curl_setopt($curlObj, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curlObj, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curlObj, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curlObj, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, $header);   //设置头部
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $result = curl_exec($curlObj); // 执行操作
    if ( curl_errno($curlObj) ) {
        $result = 'error: '.curl_error($curlObj);//捕抓异常
    }
    curl_close($curlObj); // 关闭CURL会话
    return $result; // 返回数据，json格式
}
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
       $wk= array('https://m.fx678.cn/kx/moreNews?publishTime=2021-11-03&size=100','https://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$t,'https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid=2856&pnum=1&psize=100&callback=GetHistory','https://www.woxiu.com/92663595','https://live.51lm.tv/live/program/info/list?typeCode=Recom&offset=0&limit=20','https://www.tianyancha.com/pagination/relatedAnnouncement.xhtml?ps=20&pn=1&id=3191323252');
       $w = $_GET['w']?$_GET['w']:0;
       $wnk = $wk[$w];
    if( $w<=5 ) $wnkk=$wnk;else $wnkk=$w;
 if($u==1) {
       $ut =  m_s( $wnkk );
}else if($u==2){
       $ut =  m_t( $wnkk );
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
        $a = $_GET['a']?$_GET['a']:"0";
        $ud="";
        $ud0= f_t($ua);
        $ud1= f_k($ua);
        $ud2= f_kk($ua);
        $ud3= f_ck($ua);
        $ud4= f_ckk($ua);
        $ud5= f_cb($ua);
        $ud6= f_cc($ua);
        $ud7= f_v($ua);
        $ud8= f_vv($ua);
        $ud9= f_w($ua);
        $ud10= f_um($ua);
        $ud11= f_un($ua);
        $ud12= f_tt($ua);
        $ud13= f_d($ua);
        $ud14= f_dt($ua);
        $ud15= f_h($ua);
        $ud16= f_h2($ua);
        $ud17= f_x($ua);
   if($a == "ck") {$ud=$ud3;} else if($a == "k"){$ud=$ud1;} else if($a == "kk"){$ud=$ud2;} else if($a == "ckk"){$ud=$ud4;}else if($a == "cb"){$ud=$ud5;}
else if($a == "cc"){$ud=$ud6;} else if($a == "v"){$ud=$ud7;} else if($a == "vv"){$ud=$ud8;} else if($a == "w"){$ud=$ud9;} else if($a == "u"){$ud=$ud10;} 
else if($a == "uu"){$ud=$ud11;}else if($a == "tt"){$ud=$ud12;} else if($a == "d"){$ud=$ud13;}else if($a == "dt"){$ud=$ud14;}else if($a == "h"){$ud=$ud15;}  else if($a == "h2"){$ud=$ud16;} else if($a == "x"){$ud=$ud17;} 
else {$ud=$ud0;};
   $zf = substr($ua, 0, 120); 
if(stripos($zf,'.htm') !== false || stripos($zf,'.html') !== false) $ud=$ud6;
else $ud=$ud;
      return $ud;
}
function f_td($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
        $ud = f_kd(f_ht($ua));
      return $ud;
}
function f_cd($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../cd.htm?&f='.$ua;
      return $url;
}
function f_cb($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../cb.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_cc($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../cb.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_k($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../k.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_kk($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../k.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_ck($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../ck.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_ckk($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $url= '../ck.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_um($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../u.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_un($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../u.php?u='.$u.'&f='.$ua;
      return $url;
}
function f_v($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../v.htm?&f='.$ua;
      return $url;
}
function f_vv($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../v.php?&f='.$ua;
      return $url;
}
function f_t($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../t.htm?a='.$a.'&u='.$u.'&f='.$ua;
      return $url;
}
function f_tt($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../t.php?a='.$a.'&u='.$u.'&f='.$ua;
      return $url;
}
function f_h($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../h.htm?f='.$ua;
      return $url;
}
function f_h2($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../h2.htm?f='.$ua;
      return $url;
}
function f_d($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url= '../d.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_dt($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../dt.htm?&f='.$ua;
      return $url;
}
function f_x($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../x.htm?u='.$u.'&f='.$ua;
      return $url;
}
function f_wd($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../?u='.$u.'&f='.$ua;
      return $url;
}
function f_w($ua){
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../w.htm?&f='.$ua;
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
function hmgtv($url) {
       $a = $_GET['a']?$_GET['a']:0;
       $ul ='http://mpp.liveapi.mgtv.com/v1/epg/turnplay/getLiveAssetCategoryList?version=PCweb_1.0&platform=4&media_asset_id=TVStationAll&buss_id=2000001&callback=livecallback';
       $ut = m_v($ul);
   preg_match_all('|"id":"([^>]+)"(.*)"name":"([^>]+)"|ismU',$ut,$b);
   foreach($b[1] as $k=>$v){
       $a1 = $b[1][$k];
       $a2 = m_u(r_u($b[3][$k]));
if(is_mobile()) $a=4;else $a=$a;
    $xml ='<a href="'.$fname.'?&hmg_tv='.$a1.'&a='.$a.'" target="b">'.$a2.'  ('.$a1.')</a>';
echo $xml;
}}
function hmg_tv($url) {//316
       $w = $_GET['w']?$_GET['w']:$url;
       $a5 = 'http://mpp.liveapi.mgtv.com/v1/epg/turnplay/getLivePlayUrlMPP?version=PCweb_1.0&platform=4&buss_id=2000001&channel_id='.$w;
       $ut = file_get_contents($a5);
       $aa=J_d($ut,ture);
       $a1 = $aa["data"]["url"];
       $ua =$a1.'&.m3u8';
      return $ua;
}
function hn_tv($url) {//316
       $w = $_GET['w']?$_GET['w']:$url;
       $ul = 'http://mpp.liveapi.mgtv.com/v1/epg/turnplay/getLivePlayUrlMPP?version=PCweb_1.0&platform=4&buss_id=2000001&channel_id='.$w.'';
       $ut = f_g($ul);
   preg_match("|\"npuk\"\:\"([^>]+)\",\"url\"\:\"([^>]+)\"|U",$ut,$b2);
       $a6 = $b2[2];
       $ua =$a6;
       $ud = f_kd($ua);
      //return $ua;
    $xml ='<a href="'.$ud.'" target="b" >'.m_u("播放").'</a>';
echo $xml;
}
function mgtv($url) {
       $a = $_GET['a']?$_GET['a']:'0';
       //$t = $_GET['t']?$_GET['t']:'0';
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"mlist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all("|\{\"code\":\"([^>]+)\"(.*)\"name\":\"([^>]+)\"\}|ismU",$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a2 = $b[1][$k];
       $a3 = m_u($b[3][$k]);
       $ud = 'https://api.qianqi.net/tv/migu/?id='.$a2;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function mghtv($url) {
$wk= array("e7716fea6aa1483c80cfc10b7795fcb8","a5f78af9d160418eb679a6dd0429c920","0847b3f6c08a4ca28f85ba5701268424","855e9adc91b04ea18ef3f2dbd43f495b","dd5311d848b54c56acba186ff1107236","10b0d04cb23d4ac5945c4bc77c7ac44e","c584f67ad63f4bc983c31de3a9be977c","af72267483d94275995a4498b2799ecd","e76e56e88fff4c11b0168f55e826445d","192a12edfef04b5eb616b878f031f32f","fc2f5b8fd7db43ff88c4243e731ecede","e1165138bdaa44b9a3138d74af6c6673","72504196e156468b873a39734f0af7db","f24ab89d1ad94b66b623945ae0c1350e","7538163cdac044398cb292ecf75db4e0");
       $uk= array("70002091","70002091","70002092","70002087","70002088","70053476","70034641","70085693","70053471","70053472","70002089","70010276");
       $w = $_GET['w']?$_GET['w']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $wnk = $wk[$w];
       $ul0 ='http://m.miguvideo.com/wap/resource/migu/miguH5/liveList.jsp';
       $ul1 ='https://program-sc.miguvideo.com/live/v2/tv-data/'.$wnk;
       $ul3 ='http://m.miguvideo.com/wap/resource/migu/miguH5/liveList.jsp?channelid=90020002012';
       $ut= m_v($ul1);
       $nt = J_d($ut,ture);
       $aa = $nt["body"]["dataList"];
       $count_json = count($aa);
 for ($i = 1; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = m_u($a0["name"]);
       $a2 = $a0["pID"];
       //$a3 = 'https://api.qianqi.net/tv/migu/?id='.$a2;
       //$ud = '../t.htm?f='.mg_tv($a2);
    //$xml ='<a href="'.$ud.'" target="b" >'.$a1.'</a>';
    $xml ='<a href="'.$fname.'?&mg_tv='.$a2.'"  target="b">'.$a1.'</a>';
echo $xml;
}
}
function mg_t($url) {
       $w = $_GET['w']?$_GET['w']:$url;//623604663
       $ut ='http://m.miguvideo.com/playurl/v1/play/playurlh5?contId='.$w.'&clientId=migu';
preg_match("|\"urlInfos\"(.*)\"urlType\":\"([^>]+)\",\"url\":\"http://h5live.gslb.cmvideo.cn/([^>]+)\"|U",m_v($ut),$d);
       $a1 = u_e('http://mgzb.live.miguvideo.com:8088/'.$d[3]);
return  $a1;
  //echo $a1;
}
function mg_tv($url) {
       $w = $_GET['w']?$_GET['w']:$url?$url:"623604663";
       $ut ='http://m.miguvideo.com/playurl/v1/play/playurlh5?contId='.$w.'&clientId=migu';
       $ut2 ='https://webapi.miguvideo.com/gateway/playurl/v3/play/playurl?contId='.$w;
       $nt=J_d(m_v($ut),ture);
       $aa = $nt["body"]["urlInfo"];
       $count_j=count($aa);
 //for ($i = 1; $i < $count_j; $i++) { }  
       //$a0 = $aa[$i];
       $aa1= $aa["url"];
//preg_match("|(.*)gslb.cmvideo.cn\/(.*)|",$aa1,$d);
       //$a1 = u_e('http://mgzb.live.miguvideo.com:8088/'.$d[2]);
  return   $aa1;
}
function t189tv($url) {
       $u = $_GET['u']?$_GET['u']:'0';
       $ul="http://pgmsvr.tv189.cn/program/getLiveChannels?useplat=1&format=xml";
       $ut = m_v($ul);
preg_match_all('|liveid="([^>]+)"(.*)name="([^>]+)"|imsU',$ut,$b);
foreach($b[1] as $k=>$v){
       $a2 = $b[1][$k];
       $a3 = m_u($b[3][$k]);
       $ua =tv_189($a2);
       $ud =f_kd($ua);
       $vd=Current(explode('?',$v));
    $xml='<a href="'.$ud.'"  target="b" >'.$a3.'</a>';
echo $xml;
}}
function tv_1891($w) {
       $w = $_GET['w']?$_GET['w']:'157';
       $u = $_GET['u']?$_GET['u']:'0';
       $a = $_GET['a']?$_GET['a']:'0';
 $ul1 ='http://yx.tv189.com/checkoadetail.php?liveid='.$w.'&useplat=1&token=543e3a4dcd72d&uid=free&appid=80260010300&devid=000012&signkey=TTBNRUdCTDc7ODlCzDA9MDtBPEJORUc5OTRMMMoxRUQ=&type=getliveplayinfo';
       $ut = m_v($ul1);
preg_match_all("|<url(.*)><\!\[CDATA\[([^>]+)\]\]>(.*)</url>|imsU",$ut,$b);
foreach($b[1] as $k=>$v){
       $a3 = $b[2][$k];
       $ut2 = f_g($a3);
preg_match("|<Ref href=\"([^>]+)\"|",$ut2,$b2);
       $a4 = $b2[1];
       $ua =$a4;
/*$ap = "
#EXTM3U
#EXT-X-TARGETDURATION:0
#EXT-X-VERSION:0
";
      $ap = '#EXTINF:0
'.$ud.''."\n"; 
$ap .= '#EXT-X-ENDLIST';*/
       $ud =f_kd($ua);
 header("location: $ud");
}}
function tv_189($url) {
 $ul1 ='http://yx.tv189.com/checkoadetail.php?liveid='.$url.'&useplat=1&token=543e3a4dcd72d&uid=free&appid=80260010300&devid=000012&signkey=TTBNRUdCTDc7ODlCzDA9MDtBPEJORUc5OTRMMMoxRUQ=&type=getliveplayinfo';
       $ut = m_v($ul1);
preg_match_all("|<url(.*)><\!\[CDATA\[([^>]+)\]\]>(.*)</url>|imsU",$ut,$b);
foreach($b[1] as $k=>$v){
       $a3 = $b[2][$k];
       $ut2 = f_g($a3);
preg_match("|<Ref href=\"([^>]+)\"|",$ut2,$b2);
       $a4 = $b2[1];
       $ua =$a4;
      return $ua;
}}
function t_189($url) {
preg_match("|<Ref href=\"([^>]+)\"|",f_g($url),$b2);
       $a4 = $b2[1];
       $ua =$a4;
      return $ua;
}
function kktv($url) {
       $w = $_GET['w']?$_GET['w']:'1';
 $ul1 ='http://api.app.kankanews.com/kankan/v5/livePC/stream/channel/?jsoncallback=jQuery111004845780842640952_1452209994388&_=1452209994389';
       $ut = m_v($ul1);
preg_match_all('|"appstream":"(.*)","pcstream":"(.*)",|imsU',$ut,$b);
preg_match_all('|"title":"(.*)","subtitle":"(.*)",|imsU',$ut,$b2);
foreach($b[1] as $k=>$v){
       $a2 = stripslashes($b[1][$k]);
       $a3 = stripslashes($b[2][$k]);
       $a4 = $b2[1][$k];
       $a5 = r_u($a4); 
       $ua =$a3;
       $ud =f_kd($ua);
       $vd=Current(explode('?',$v));
    $xml='<a href="'.$ud.'" target="b" >'.m_u($a5).'</a></br>';
echo $xml;
}}
function fhtv($url) {
       $u = $_GET['u']?$_GET['u']:'0';
       $w = $_GET['w']?$_GET['w']:'1';
       $a = $_GET['a']?$_GET['a']:'0';
 $ul1 ='http://v.ifeng.com/live/js/scheduleurlall.js';
       $ut = m_v($ul1);
preg_match_all("|'([^>]+)':\{'name':'([^>]+)','url':'([^>]+)'\}|imsU",$ut,$b);
foreach($b[1] as $k=>$v){
       $a3 = $b[1][$k];
       $a4 = m_u($b[2][$k]);
       $ua =$a3;
   if(stripos($ua,'m3u8') === false){$a=$a;}else{$a='m3u8';};
       $ud = '../tv/fh.php?f='.$ua.'';
       $vd=Current(explode('?',$v));
    $xml='<a href="'.$ud.'" target="b" >'.$a4.'</a></br>';
echo $xml;
}}
function wstv($url) {
       $u = $_GET['u']?$_GET['u']:'0';
       $a = $_GET['a']?$_GET['a']:'0';
       $ul ='http://live.wasu.cn';
       $st = m_v($ul);
   preg_match_all('|<li><a target="_blank" class="ys" href="(.*)show/id/(.*)">(.*)</a></li>|ismU',$st,$b);
   foreach($b[1] as $k=>$v){
       $a1 = $b[2][$k];
       $a2 = m_u($b[3][$k]);
       $a3 ='http://play.wasu.cn/live/'.$a1.'.swf ';
       $a4 ='http://s.wasu.cn/portal/player/20151104/WsPlayer.swf?vid='.$a1.'&mode=4&live=1&ap=1&ad=1';
       $ua =$a1;
       $ud ='./ws.php?f='.$ua;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a4.'" target="b" >'.$a2.'</a></br>';
echo $xml;
}}
function cctvn($url) {
       $wk= array("cctv13","cctv1","cctv2","cctv3","cctv4","cctv5","cctv6","cctv7","cctv8","cctv9","cctv10","cctv11","cctv12","cctv13","cctvjilu","cctv15","cctvchild");
       $year = date("Y");
       $mouth = date("m");
       $day = date("d");
       $htm =  date("H");
       $tm =  date("H",time()) + 8;
       $itm =  date("i");
       $tday = date("YmdHi",time());
       $ntm =  $tm -1;
     if($tm<=9) $tm=$tm;else $tm=$tm;
     if($ntm<=9) $ntm='0'.$ntm;else $ntm=$ntm;
     if($day<10) $sday=$day.$tm;else $sday=$day.$tm;
     if($day<10) $nday=$day.$ntm;else $nday=$day.$ntm;
       $w = $_GET['w']?$_GET['w']:'0';

       $t = $_GET['t']?$_GET['t']: $nday;
       $u = $_GET['u']?$_GET['u']:'0';
       $st = $t;
       $nt = $t+1;
     if($_GET['t']>10) $itm='00';else $itm=$itm;
       $sttm =$year.$mouth.$st.$itm;
       $nttm =$year.$mouth.$nt.$itm;
       $wnk = $wk[$w];
    if($w <= 20){$wnk=$wnk;}else {$wnk=$w;};
       $ud6 = 'http://player.cntv.cn/standard/cntvBuguLiveBackPlayer20140117.swf?videoInfoPath=http://vdn.apps.cntv.cn/api/liveback.do&channel='.$wnk.'&starttime='.$sttm.'&endtime='.$nttm.'&url=';
       //$ud5 = '../tv/cctvnh.htm?&f='.$wnk.'&st='.$sttm.'&et='.$nttm.'';
       $ud5 = '../tv/swf.htm?m=cntv&f='.$wnk.'&st='.$sttm.'&et='.$nttm.'';
       $ud = $ud5;
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$w.'</a></br>';
echo $xml;
}
function zgjqzb($url) {
set_time_limit(0);
       $wk= array("zbzg","shangdianshi","muhou","saishi","gongyi","huodong","reping","wenhua","shenghuo");
       $w = $_GET['w']?$_GET['w']:'0';
       $t = $_GET['t']?$_GET['t']: 0;
       $u = $_GET['u']?$_GET['u']:'0';
       $p = $_GET['p']?$_GET['p']:'2';
       $wnk = $wk[$w];
for($i1=0;$i1<=$p;++$i1){
       $ul = 'http://api.cntv.cn/list/getCboxLiveList?serviceId=cbox&type='.$wnk.'&p='.$i1.'&n=18&cb=jQuery17209499000597289895_1590646338817';
  preg_match("#\"liveList\":\[(.*)\]#ismU",m_v($ul),$d);
       $at = '['.$d[1].']';
       $an = J_d($at,True);
       $co_json = count($an);
 for ($i2 = 0; $i2 < $co_json; $i2++) {
       $an0 = $an[$i2];
       $an2 = $an0["detailUrl"];
       $an3 = $an0["covertitle"];
       $ut2 = J_d(m_v($an2),True);
       $aa = $ut2["data"]["liveList"];
       $count_json = count($aa);
 for ($i3 = 0; $i3 < $count_json; $i3++) {
       $aa0 = $aa[$i3];
       $d1 = $aa0["liveUrl"];
       $d2 = m_u($aa0["liveTitle"]);
if(strpos($d1,'p2p') !== false){ } else if(strlen( $d1 )>25 ){} else{
       $d12 = 'https://gccncc.v.wscdns.com/gc/'.$d1.'_1/index.m3u8';
       //$d13 = 'https://gcalic.v.myalicdn.com/gc/'.$d1.'_1/index.m3u8';
       $d13 ='http://gcksc.v.kcdnvip.com/gc/'.$d1.'_1/index.m3u8';
       $ud2 = '../t.htm?u=&f='.$d13;
       $d14 = $an3.' ('.$d2.')';
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud2.'" target="b" >'.$d14.'</a>';
echo $xml;
}}}}}
function zgzb($url) {
       $wk= array('zrjg','czfj','zxdw');
       $w = $_GET['w']?$_GET['w']:'0';
       $wnk=$wk[$w];
       $ul = 'http://livechina.ipanda.com/zhibo/index.shtml#'.$wnk.'';
  preg_match_all('#<li>(.*)<a href="([^>]+)" target="_blank">(.*)<div class="bx">(.*)<span class="(.*)">([^>]+)</span>(.*)<span>([^>]+)</span>#ismU',m_v($ul),$d);
  foreach($d[0] as $k=>$v){
       $a2 =$d[2][$k];
       $a3 =m_u($d[6][$k]);
       $a4 =m_u($d[8][$k]);
       //$vd=Current(explode('?',$v));
       $xml ='<a href="'.$fname.'?&zburl='.$a2.'"  target="b">'.$a3.' ('.$a4.')</a>';
echo  $xml;
}}
function qitv($url) {
       $a = $_GET['a']?$_GET['a']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"ilist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"url":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
       //$a3 = $a2;
       $ud =f_w($a2);
       $vd=Current(explode('?',$v));
    //$xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
    $xml ='<a href="'.$fname.'?&qitv='.$a2.'"  target="b">'.$a1.'</a>';
echo $xml;
}}
function ptv($url) {
       $ak= array("http://183.207.255.190","http://112.25.48.68","http://140.207.241.2:8080","http://liveplay-kk.rtxapp.com","http://keonline.shanghai.liveplay.qq.com");
       $a = $_GET['a']?$_GET['a']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $ank = $ak[$a];
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"plist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"url":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
       $a3 = $ank.$a2;
       $ud =f_w($a3);
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}}
function sztv($url) {
       //$a = $_GET['a']?$_GET['a']:'0';
       //$t = $_GET['t']?$_GET['t']:'0';
       //$ul2 = "https://api.scms.sztv.com.cn/api/com/catalog/getCatalogList?isTree=0&tenantId=ysz&types=2&appCode=20";
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"slist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"code":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
       $ud ='https://sztv.cutv.com/pindao/index.html?id='.$a2;
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}}
function jqzb2($url) {
       $a = $_GET['a']?$_GET['a']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $ul ='../tv/cntv.txt';
       $ut = m_u(f_g($ul));
       //$ut = f_g($ul);
       $at = J_d($ut,ture);
       $aa = $at["qlist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["name"];
 if($a1!='') {
       $a2 = $a0["url"];
       $ud =f_uk($a2);
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}
}}
function jqzb($url) {
       $a = $_GET['a']?$_GET['a']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"qlist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"url":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
       $ud =f_uk($a2);
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}}
function cctvzb($url) {
       $ak= array( "cctvalih5ca.v.myalicdn.com","cctvksh5ca.v.kcdnvip.com","cctvcnch5ca.v.wscdns.com","cctvtxyh5ca.liveplay.myqcloud.com","cctvbsh5ca.v.live.baishancdnx.cn");
       $a = $_GET['a']?$_GET['a']:'0';
       $t = $_GET['t']?$_GET['t']:'0';
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"clist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"code":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
if(is_mobile()){
       $a3 = cn_tt($a2);
       //$a3 ='http://cctvalih5ca.v.myalicdn.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
       /*$ul2 ='http://vdn.live.cntv.cn/api2/live.do?channel=pa://cctv_p2p_hd'.$a2.'&client=flash';
       $json = json_decode(m_v($ul2),true);
       $hcd = $json["hls_cdn_info"]["cdn_code"];
       $hls2 = $json["hls_url"]["hls2"];
       $a3 = $hls2.'&cdnName='.$hcd;*/
}else {
 if( $a=="10") {
       $ud ='../tv/cctv.htm?&f='.$a2;
}else if( $a=="1") {
       $a3 = cn_tt($a2);
       //$a3 = 'http://cctvalih5ca.v.myalicdn.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="11") {
       //$a3 = cn_tt($a2);
       //$a3 = 'http://cctvalih5ca.v.myalicdn.com/live/'.$a2.'_2_hd/index.m3u8';
       $a3 = 'http://cctvalih5ca.v.myalicdn.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="2") {
       $a3 = 'http://cctvksh5ca.v.kcdnvip.com/clive/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="20") {
       $a3 = 'http://cctvksh5ca.v.kcdnvip.com/clive/'.$a2.'_2_hd/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="3") {
       $a3 = 'http://cctvcnch5ca.v.wscdns.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="4") {
       $a3 = 'http://cctvtxyh5ca.liveplay.myqcloud.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="40") {
       $a3 = 'http://cctvtxyh5ca.liveplay.myqcloud.com/live/'.$a2.'_2_hd/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="5") {
       $a3 = 'http://cctvbsh5ca.v.live.baishancdnx.cn/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="6") {
       $a3 = 'http://cctvcnch5c.v.wscdns.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="7") {
       $a3 = 'http://cctvdnh5ca.v.dwion.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else if( $a=="8") {
       $a3 = 'http://keonline.shanghai.liveplay.qq.com/live/program/live/'.$a2.'/1300000/mnf.m3u8';
       $ud =f_ck($a3);
}else if( $a=="9") {
       $a3 = 'http://ivi.bupt.edu.cn/hls/'.$a2.'.m3u8';
       $ud =f_t($a3);
}else if( $a=="w"||$a=="wt") {
       $a3 = 'http://cctvksh5ca.v.kcdnvip.com/clive/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
}else {
       $ud ='../tv/cctv.htm?&f='.$a2;
}}
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}}
function cctvzb0($url) {
       $a = $_GET['a']?$_GET['a']:'0';
       //$t = $_GET['t']?$_GET['t']:'0';
       $ul ="../tv/cntv.txt";
       $ut = m_u(f_g($ul));
       $at = J_d($ut,ture);
       $aa = $at["clist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["name"];
       $a2 = $a0["code"];
if(is_mobile()){
       $a3 ='http://cctvalih5ca.v.myalicdn.com/live/'.$a2.'_2/index.m3u8';
       $ud =f_kd($a3);
       /*$ul2 ='http://vdn.live.cntv.cn/api2/live.do?channel=pa://cctv_p2p_hd'.$a2.'&client=flash';
       $json = json_decode(m_v($ul2),true);
       $hcd = $json["hls_cdn_info"]["cdn_code"];
       $hls2 = $json["hls_url"]["hls2"];
       $a3 = $hls2.'&cdnName='.$hcd;*/
}else {
 if( $a=="1") {
       $ud ='../tv/cctv.htm?&f='.$a2;
}else if( $a=="3") {
       $a3 = cn_tt($a2);
       $ud =f_ck($a3);
}else {
       $ud ='../tv/cctv.htm?&f='.$a2;
}}
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a1.'</a>'."\n";
echo $xml;
}}
function cntv($url) {
       $tk= array( "$a3","$a1","$a2","$a3","$a4","$a5","$a6","$a7","$a8","$a9","$a10");
       $w = $_GET['w']?$_GET['w']:'cctv13';
       $t = $_GET['t']?$_GET['t']:'0';
       $a = $_GET['a']?$_GET['a']:'0';
       $tnk = $tk[$t];
       $ul ='https://tv.cctv.com/live/index.shtml';
       $ut = m_v($ul);
   preg_match_all("|<dt>(.*)<a href=\"https:\/\/tv.cctv.com\/live\/([^>]+)\"(.*)>([^>]+)<\/a>|ismU",$ut,$d);
   foreach($d[1] as $k=>$v){
       $a1 = $d[2][$k];
if(stripos($a1,'/') === false) $a1=$a1;else $a1= Current(explode('/',$a1));
       $a2 = m_u($d[4][$k]);
if(is_mobile()){
       $a3 ='http://cctvalih5ca.v.myalicdn.com/live/'.$a1.'_2/index.m3u8';
       //$a3 = cn_tt($a1);
       $ud =f_kd($a3);
}else {
 if( $a=="0") {
       $ud ='../tv/cctv.htm?&f='.$a1;
}else if( $a=="3") {
       $a3 = cn_tt($a1);
       $ud =f_kd($a3);
}else {
       $ud ='../tv/cctv.htm?&f='.$a1;
}}
       $vd=Current(explode('?',$v));
    $xml =' <a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}
function cn_tt($url) {
       $ur = $_GET['w']?$_GET['w']:$url;
       $t = $_GET['t']?$_GET['t']:'0';
       $ul1 ='http://vdn.apps.cntv.cn/api2/live.do?channel=pa://cctv_p2p_hd'.$ur;
       $ul2 ='http://vdn.live.cntv.cn/api2/live.do?channel=pa://cctv_p2p_hd'.$ur.'&client=flash';
       $ul3 ='http://vdn.apps.cntv.cn/api2/liveHtml5.do?channel=pa://cctv_p2p_hd'.$ur;
       $ul4 ='https://vdn.live.cntv.cn/api2/liveHtml5.do?channel=pc://cctv_p2p_hd'.$ur.'&client=flash';
       $json = json_decode(m_v($ul2),true);
      $flv5 = $json["flv_url"]["flv5"];
      $fcd = $json["flv_cdn_info"]["cdn_code"];
      $hcd = $json["hls_cdn_info"]["cdn_code"];
      $hls1 = $json["hls_url"]["hls1"];
      $hls2 = $json["hls_url"]["hls2"];
      $hls4 = $json["hls_url"]["hls4"];
      $hls5 = $json["hls_url"]["hls5"];
      $hls6 = $json["hls_url"]["hls6"];
      $dcd = $json["hds_cdn_info"]["cdn_code"];
      $hds1 = $json["hds_url"]["hds4"];
        $a1 = $flv5.'&cdnName='.$fcd;
        $a2 = $hls1.'&cdnName='.$hcd;
        $a3 = $hls2.'&cdnName='.$hcd;
        $a4 = $hls4.'&cdnName='.$hcd;
        $a5 = $hls5.'&cdnName='.$hcd;
        $a6 = $hls6.'&cdnName='.$hcd;
        $a7 = $hds1.'&cdnName='.$dcd;
        $tk= array( "$a3","$a1","$a2","$a3","$a4","$a5","$a6","$a7");
        $tnk = $tk[$t];
        $ua=$tnk;
        $ud=$ua;
//echo $ud;
return  $ud;
}
function cctvhb($url) {
       $w = $_GET['w']?$_GET['w']:'cctv13';
       $t = $_GET['t']?$_GET['t']:'';
       $a = $_GET['a']?$_GET['a']:'0';
       $ul ='../tv/cntv.txt';
       $ut = m_u(f_g($ul));
       $at = J_d($ut,ture);
       $aa = $at["clist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["name"];
       $a2 = $a0["code"];
       $ua =$a2;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$fname.'?&cctvcid='. $ua.'&t='.$t.'" target="b">'.$a1.'</a>'."\n";
echo $xml;
}}
function cctvhb2($url) {
       $w = $_GET['w']?$_GET['w']:'cctv13';
       $t = $_GET['t']?$_GET['t']:'';
       $a = $_GET['a']?$_GET['a']:'0';
       $ul ='../tv/cntv.txt';
       $ut = f_g($ul);
   preg_match("|\"clist\":\[(.*)\]|ismU",$ut,$b0);
   preg_match_all('|"name":"([^>]+)"(.*)"code":"([^>]+)"|ismU',$b0[1],$b);
   foreach($b[1] as $k=>$v){
       $a1 = m_u($b[1][$k]);
       $a2 = $b[3][$k];
       $ua =$a2;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$fname.'?&cctvcid='. $ua.'&t='.$t.'" target="b">'.$a1.'</a>'."\n";
echo $xml;
}}
function cctvhb0($url) {
       $w = $_GET['w']?$_GET['w']:'cctv13';
       $t = $_GET['t']?$_GET['t']:'';
       $ul ='https://tv.cntv.cn/pindao/';
       $ul2 ='http://tv.cctv.com/lm/';
       $ut = m_v($ul);
   preg_match_all("|<dt><a href=\"https:\/\/tv.cctv.com\/live\/([^>]+)\"(.*)>([^>]+)<\/a>|ismU",$ut,$b);
   foreach($b[1] as $k=>$v){
       $a1 = $b[1][$k];
if(stripos($a1,'/') === false) $a1=$a1;else $a1= Current(explode('/',$a1));
       $a2 = m_u($b[3][$k]);
       $ua =$a1;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$fname.'?&cctvcid='. $ua.'&t='.$t.'"  target="b">'.$a2.'</a>'."\n";
echo $xml;
}}
function cctvdb($url) {
       $wk= array( "cctvjilu","cctv1","cctv2","cctv3","cctv4","cctv5","cctv6","cctv7","cctv8","cctvjilu","cctv10","cctv11","cctv12",
"cctv13","cctv15","cctv5plus","cctvchild","btv9","btv3","btv8","btv7","btv6","btv2","btv4","cctvdoc","cctvjilu",
"shenzhen","btv5","jiangsu","shandong","xinjiang","shan1xi","dongfang","btv1","travel","ningxia","gansu","xizang","qinghai","dongnan","neimenggu",
"guangdong","jilin","shan3xi","hebei","guangxi","yunnan","henan","hubei","guizhou","heilongjiang","chongqing","sichuan","jiangxi","tianjin",
"liaoning","anhui","hunan","zhejiang","taiqiu","cctvgaowang","cctvamerica","cctveurope","cctvfrench","cctvarabic","russian","xiyu","ipanda");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0; 
       $p = $_GET['p']?$_GET['p']:0; 
       $a = $_GET['a']?$_GET['a']:"0";
       $wnk = $wk[$w];
if($w<="71") $wnk=$wnk;else $wnk=$w;
       $tt=mtime($_GET['t']);
       $ul ='http://api.cntv.cn/epg/getEpgInfoByChannelNew?c='.$wnk.'&serviceId=tvcctv&d='.$tt.'&cb=t';
       $ul1 ='http://api.cntv.cn/epg/Epg24h?serviceId=cbox&c='.$w.'&cb=callback&t=jsonp';
       $ul2 ='http://api.cntv.cn/epg/epginfo?serviceId=tvcctv&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
       $ul3 ='http://api.cntv.cn/epg/epginfo?serviceId=shiyi&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
       $ut = m_v($ul);
preg_match_all('|"title":"([^>]+)","startTime":([^>]+),"endTime":([^>]+),"showTime":"([^>]+)"(.*)"length":([^>]+),|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
       $a2 = r_u($d[1][$k]);
       $b3 = $d[2][$k];
       $b4 = $d[3][$k];
       $a3 = q_w(q_g(q_m(q_k(t_t($b3)))));
       $a4 = q_w(q_g(q_m(q_k(t_t($b4)))));
       $a5 = $d[4][$k];
       $a6 = $d[6][$k]/60;
       $a9 = m_u('分');
       //$ud = '../tv/cctvnh.htm?f='.$wnk.'&st='.$a3.'&et='.$a4.'';
       $ud = '../tv/swf.htm?m=cntv&f='.$wnk.'&st='.$a3.'&et='.$a4.'';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.$a5.')('.$a6.''.$a9.')</a>';
echo $xml;
}}
function qqtv($url) {
       $uk= array( "0","1","2","3","4","5","6","7","8","9","10");
       $u = $_GET['u']?$_GET['u']:'0';
       $p = $_GET['p']?$_GET['p']:'1';
       $unk = $uk[$u];
for($ii=1;$ii<=$p;++$ii){
       $url1="https://live.qq.com/api/live/vlist?page_size=60&page='.$ii.'&shortName=Game&child_id='.$unk.'";
       $url2="https://live.qq.com/api/live/vlist?page_size=60&page='.$ii.'&shortName=0&child_id='.$unk.'";
       $ul= m_v($url2);
       $nt = J_d($ul,ture);
       $aa = $nt["data"]["result"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["room_id"];
       $a2 = r_u($a0["room_name"]);
       $a3 = t_m($a0["show_time"]);
       $a4 = $a0["owner_uid"];
       $a5 = r_u($a0["nickname"]);
       $a6 = $a0["room_hotv"];
       //$a7 = x_g($a0["url"]);
       //$a8 = str_replace("/",'',$a7);
       //$a9 = 'https://upstatic.qiecdn.com/common/share/play.swf?room_id=10140152';
       //$a10 = 'https://live.qq.com/swf_api/room/10140152?cdn=ws&nofan=yes&_t=26718432&sign=faf5f4f91b18920de094ef0c7635d4ac';
       //$ua = 'https://live.qq.com/'.$a1;
       $ud='../tv/qqtv.php?&f='.$a1;
       $xml ='<a href="'.$ud.'" target="b" >'.$a2.'  ('.$a5.')</a>';
    //$xml ='<a href="'.$fname.'?&qe_tv='.$a1.'" target="b">'.$a2.'  ('.$a5.')</a>';
echo $xml;
}}}
function cutv($url) {
       $w = $_GET['w']?$_GET['w']:'';
       $ul ='http://liveapp.cutv.com/crossdomain/timeshiftinglive/getTSLAllChannelList/first/cutv';
       $st = m_v($ul);
   preg_match_all("|\{\"name\":\"([^>]+)\",\"id\":\"([^>]+)\"|ismU",$st,$b);
   foreach($b[1] as $k=>$v){
       $a1 = r_u($b[1][$k]);
       $a2 = $b[2][$k];
       $a3 ='http://www.zhiboba.cc/app/cutvzb.html?id='.$a2;
       $a4 ='http://tv.cutv.com/player/cv.swf?channelId='.$a2;
       $a5 ='../tv/swf.htm?m=cu&f='.$a2;
       $a6 =m_u($a1);
       $ud =$a5;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a6.'</a>';
echo $xml;
}}
function t64tv($url) {
       $a = $_GET['a']?$_GET['a']:'0'; 
       $w = $_GET['w']?$_GET['w']:'0'; 
       $ul ='http://live.64ma.com';
       $mm = m_u('：');
       $ut = m_v($ul);
   preg_match_all("|<a class=\"btn btn-default\"(.*)href=\"tv\/tv.asp\?pid=([^>]+)\">([^>]+)<\/a>|ismU",$ut,$b);
   foreach($b[1] as $k=>$v){
       $a1 = $b[2][$k];
       $a5 = m_u($b[3][$k]);
  if($a==1) {
       $a4 ='../tv/cc.php?&f='.$a1;
}else {
       $a4 ='../tv/swf.htm?m=64&f='.$a1;
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a4.'" target="b" >'.$a5.'</a>';
echo $xml;
}}
function shhtv($url) {
       $u = $_GET['u']?$_GET['u']:'0';
       $ul ='http://api.app.kankanews.com/kankan/v5/livePC/stream/channel/?jsoncallback=jQuery111008220436877656947_1453603132612';
       $ut = m_v($ul);
preg_match('|\((.*)\)|ismU',$ut,$b);
       $nt = J_d($b[1],ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i = 1; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = $a0["id"];
       $a2 = r_u($a0["title"]);
       $a3 = x_g($a0["appstream"]);
       $a4 = x_g($a0["pcstream"]);
       //$ud='http://player.kksmg.com/data/player_swf/KKPlayer.swf?playerId=2969363206&liveChannelID='.$a1;
       //$ud ='../tv/swf.htm?m=sh&f='.$a1;
       $ud ='../tv/shtv.htm?&f='.$a1;
       //$ud ='../d.htm?&f='.$a3;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.m_u($a2).'</a>';
echo $xml;
}}
function shhtv2($url) {
       $u = $_GET['u']?$_GET['u']:'0';
       $ul ='http://api.app.kankanews.com/kankan/v5/livePC/stream/channel/?jsoncallback=jQuery111008220436877656947_1453603132612';
       $ut = m_v($ul);
preg_match_all('|"id":"([^>]+)"(.*)"title":"([^>]+)"|ismU',$ut,$b);
preg_match_all('|"appstream":"([^>]+)"(.*)"pcstream":"([^>]+)"|ismU',$ut,$b2);
foreach($b[1] as $k=>$v){
       $a1 = $b[1][$k];
       $a2 = r_u($b[3][$k]);
       $a3 = x_g($b2[1][$k]);
       $a4 = x_g($b2[3][$k]);
       $ua =$a4;
       //$ud='http://player.kksmg.com/data/player_swf/KKPlayer.swf?playerId=2969363206&liveChannelID='.$a1;
       $ud ='../tv/swf.htm?m=sh&f='.$a1;
       //$ud =f_kd($ua);
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.m_u($a2).'</a>';
echo $xml;
}}
function jstv($url) {
       $w1k= array(cctv1,weishi1,qita1);
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $w1nk=$w1k[$w];
     if($w <= '3') $wnk=$w1nk;else $wnk=$w;
       $ul ='http://jsontv.oss-cn-shenzhen.aliyuncs.com/tvjson/'.$wnk.'.txt';
preg_match_all('|"url": "([^>]+)"|ismU',m_v($ul),$d1);
preg_match_all('|"name": "([^>]+)"|ismU',m_v($ul),$d2);
foreach($d1[1] as $k=>$v){
       $a1 = $d1[1][$k];
       $a2 = $d2[1][$k];
       $ud = f_kd($a1);
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="b">'.$a2.'</a>';
  echo $xml;
}}
function m51tv($url) {
       $wk= array("Recom","Hot","New","Dancer","Singer","Funny");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
       //$kw= k_w($w);
    for($i=0;$i<=$p;++$i){
       $p1 = $i*20;
       //$ul = 'https://live.51lm.tv/live/program/info/list?{"typeCode":"Hot","offset":0,"limit":20}';
       //$ul1 ='https://live.51lm.tv/live/program/info/list?typeCode='.$wnk.'&offset='.$p1.'&limit=20';
       $ul ='https://live.51lm.tv/live/program/info/list?typeCode=Hot&offset=36&limit=20';
       $ut = m_s($ul);
       /*$nt = J_d($ut,true);
       $aa = $nt["data"]["programList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["programId"];
       $a3 = m_u($a0["programName"]);
       $a4 = 'https://aliyun-flv.51lm.tv/lingmeng/'.$a2.'.flv';
       $ud = f_t($a4);
       $xml ='<a href="'.$ud.'" target="b">'.$a3.'</a>';*/
  echo $ut;
}}
function zqtv($url) {
set_time_limit(0);
       $wk= array(45,49,6,65,63,73,76,67,8,9,10,72,13,80,82,35,22,28,35,37);
       $tk= array("","_360p","_720p","_1024p","_720p","_14400p");
       $ak= array("dl","ws","al","dl","ws","al");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $p1 = $p*60;
       $wnk=$wk[$w];
       $ank=$ak[$a];
       $tnk=$tk[$t];
     if($w <= '20') $wnk=$wnk;else $wnk=$w;
       $ul1 ='https://m.zhanqi.tv/api/static/game.lives/'.$wnk.'/'.$p1.'-1.json';
       $ul4 ='https://www.zhanqi.tv/api/static/game.lives/'.$wnk.'/'.$p1.'-1.json';
       $ul5 ='https://www.zhanqi.tv/api/static/v2.1/game/live/'.$wnk.'/'.$p1.'/1.json';
       $ul3 ='https://m.zhanqi.tv/api/static/v2.1/live/list/'.$wnk.'/'.$p1.'/1.json';
       $ut = J_d(m_v($ul5),True);
       $aa = $ut["data"]["rooms"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       //$a1 = $a0["id"];
       $a2 = $a0['nickname'];
       //$a4 = $a0["code"];
       $a5 = $a0["url"];
       $a13 = $a0['title'];
       $a12 = $a0['videoId'];
       //$b10 = 'http://wshls.cdn.zhanqi.tv/zqlive/'.$a12.''.$tnk.'/playlist.m3u8';
       //$b11 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a12.''.$tnk.'.m3u8';
       //$b15 = 'http://alhls.cdn.zhanqi.tv/zqlive/210915_Mg4QM.m3u8';
       //$b13 = 'http://dlhls-cdn-mp.zhanqi.tv/zqlive/'.$a12.''.$tnk.'.m3u8';
if(is_mobile()){
       $b14 = 'http://dlhdl-cdn.zhanqi.tv/zqlive/'.$a12.'.flv';
       $ua = $b14;
       $ud = f_t($ua);
}else {
  if( $a>="3") {
       $b14 = 'http://'.$ank.'hls-cdn.zhanqi.tv/zqlive/'.$a12.'.m3u8';
       $ua = $b14;
       $ud = f_t($ua);
} else {
       $b14 = 'http://'.$ank.'hdl-cdn.zhanqi.tv/zqlive/'.$a12.''.$tnk.'.flv';
       $ua = $b14;
       $ud = f_t($ua);
}}
       $xml ='<a href="'.$ud.'" target="b">'.$a2.'('.$a13.')</a>';
  echo $xml;
}}
function zqtv2($url) {
       $wk= array(45,49,6,65,63,73,76,67,8,9,10,72,13,80,82,35,22,28,35,37);
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:180;
       $wnk=$wk[$w];
     if($w <= '20') $wnk=$wnk;else $wnk=$w;
    //for($i=1;$i<=$p;++$i){}
       $ul1 ='http://www.zhanqi.tv/api/static/game.lives/'.$wnk.'/'.$p.'-1.json';
       $ul5 ='https://www.zhanqi.tv/api/static/v2.1/game/live/'.$wnk.'/'.$p.'/1.json';
       $ul ='';
     if($t == '1') $ul=$ul1;else $ul=$ul5;
       $ut = m_v($ul);
preg_match_all('|"id":"([^>]+)",|ismU',$ut,$d);
preg_match_all('|"uid":"([^>]+)",|ismU',$ut,$d1);
preg_match_all('|"nickname":"([^>]+)",|ismU',$ut,$d2);
preg_match_all('|"title":"([^>]+)",|ismU',$ut,$d4);
preg_match_all('|"online":"([^>]+)",|ismU',$ut,$d6);
preg_match_all('|"status":"([^>]+)",|ismU',$ut,$d7);
preg_match_all('|"hotsLevel":"([^>]+)",|ismU',$ut,$d5);
preg_match_all('|"videoId":"([^>]+)",|ismU',$ut,$d3);
foreach($d[1] as $k=>$v){
       $a0 = $d[1][$k];
       $a1 = r_u($d1[1][$k]);
       $a2 = r_u($d2[1][$k]);
       $a3 = $d3[1][$k];
       $a4 = x_g($d3[1][$k]);
       $a13 = $d5[1][$k];
     if($t == '1'||$t == '2'||$t == '3') $a5=$a4;else $a5=$a3;
       $a6 = $d6[1][$k];
       $a7 = r_u($d4[1][$k]);
       $b4 = $a6.$a4;
       //$a8 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a5.'.flv?platform=01';
       //$a9 = 'http://wshdl.load.cdn.zhanqi.tv/zqlive/'.$a5.'.flv';
       //$a10 = 'http://yfhdl.cdn.zhanqi.tv/zqlive/'.$a5.'.flv';
       //$a12 = 'http://dlhdl.cdn.zhanqi.tv/zqlive/'.$a5.'_480p.flv';
       //$b83 = 'http://alhdl.cdn.zhanqi.tv/zqlive/'.$a5.'.m3u8';
       //$b81 = 'http://bshdl.cdn.zhanqi.tv/zqlive/'.$a5.'.m3u8';
       //$b93 = 'http://alhdl.cdn.zhanqi.tv/zqlive/'.$a5.'_1024/index.m3u8';
       //$b91 = 'http://bshdl.cdn.zhanqi.tv/zqlive/'.$a5.'_1024/index.m3u8';
       //$b5 = 'http://zqcdn.ebit.cn/zqlive/'.$a5.'.flv';
       //$b6 = 'rtmp://lxrtmp.load.cdn.zhanqi.tv/zqlive/'.$a5;
       //$b7 = 'rtmp://dlrtmp.cdn.zhanqi.tv/zqlive/'.$a5;
       $b8 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a5.'.m3u8';
       //$b8 = 'http://wshls.cdn.zhanqi.tv/zqlive/'.$a5.'/playlist.m3u8';
       $b9 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a5.'_1024/index.m3u8';
       $b10 = 'http://dlvod.cdn.zhanqi.tv'.$a5;
       $b11 = 'http://dlvod.cdn.zhanqi.tv/videonew/hls/special'.$a5.'.m3u8';
       $b12 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a5.'_1024/index.m3u8?Dnion_vsnae='.$a5.'';
       $ub = '';
   if($t == '4') $ub=$b8;else if($t== '5'||$t == '6'){$ub=$b9;}else if($t == '1'||$t == '2'||$t == '3'){$ub=$b10;}else $ub=$a8;
       $ua = $ub;
   if($unk == '0') $ua=$ua;else $ua=$b9;
       $ud = f_kd($ua);
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b">'.$a2.'-'.$a7.'</a>';
      /*$i3 = $i1++;$i4 = $i2++;
       $ud4=''.m_u($a2).'-'.m_u($a7).'';
       $ud5='File'.$i3.'='.$ub.'
             Title'.$i4.'='.$ud4.'';
    $xml2 = $ud5 ;
    $ar =$xml2;
    $fn = 'zqtv.pls';
    $arr=file_put_contents($fn,$ar.PHP_EOL,FILE_APPEND);
    fclose($fn);*/
  echo $xml;
}}
function zqtvs($url) {
       $w = $_GET['w']?$_GET['w']:"放映";  
       $w=k_w($w);
       $tk= array("anchor","room","union","video");
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $a = $_GET['a']?$_GET['a']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $tnk=$tk[$t]; 
    for($i=1;$i<=$p;++$i){
       $ul ='http://www.zhanqi.tv/api/zsearch/'.$tnk.'?q='.$w.'&page='.$i.'&os=0&num=20&_v=25218969';
       $ul2 ='https://www.zhanqi.tv/api/zsearch/union?q='.$kw.'&os=0&page='.$i.'&num=20&_v=25219350';
       $ut = m_v($ul);
preg_match_all('|"title":"([^>]+)"|ismU',$ut,$b5);
preg_match_all('|"nickName":"([^>]+)"|ismU',$ut,$b6);
preg_match_all('|"url":"([^>]+)"|ismU',$ut,$b7);
preg_match_all('|"code":"([^>]+)"|ismU',$ut,$b8);
preg_match_all('|"liveId":"([^>]+)"|ismU',$ut,$b9);
foreach($b5[1] as $k=>$v){
       $a3 = m_u(r_u($b5[1][$k]));
       $a4 = m_u(r_u($b6[1][$k]));
       $a1 = $b9[1][$k];
       $a5 = 'http://www.zhanqi.tv/'.$b8[1][$k];
       $a8 = 'http://yfrtmp.cdn.zhanqi.tv/zqlive/'.$a1;
       $a9 = 'http://wshdl.load.cdn.zhanqi.tv/zqlive/'.$a1.'.flv';
       $a10 = 'http://dlvod.cdn.zhanqi.tv/'.$a1.'';
       //$a11 = 'rtmp://dlrtmp.cdn.zhanqi.tv/zqlive/'.$a1;
       //$a12 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a1.'.m3u8';
       //$a13 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a1.'_1024/index.m3u8';
       //$a14 = 'http://dlvod.cdn.zhanqi.tv/videonew/hls/special'.$a1.'.m3u8';
       //$a15 = 'http://dlhls.cdn.zhanqi.tv/zqlive/'.$a1.'_1024/index.m3u8?Dnion_vsnae='.$a1.'';
if(is_mobile()){
       //$ua = 'https://603ulclsqv10nzs3rdgync6f0o4mn2a.dwion.com/dlhdl-cdn.zhanqi.tv/zqlive/'.$a1.'_1024p.flv?';
       $ua = 'https://dlhls-cdn-mp.zhanqi.tv/zqlive/'.$a1.'.m3u8';
       $ud=f_kd($ua);
}else if( $a=="3") {
       //$ua = 'https://603ulclsqv10nzs3rdgync6f0o4mn2a.dwion.com/dlhdl-cdn.zhanqi.tv/zqlive/'.$a1.'_1024p.flv?';
       $ua = 'https://dlhls-cdn-mp.zhanqi.tv/zqlive/'.$a1.'.m3u8';
       $ud=f_kd($ua);
}else {
       $ua = 'https://ip655415354.mobgslb.tbcache.com/dlhdl-cdn.zhanqi.tv/zqlive/'.$a1.'.flv?';
       //$ua = 'https://603ulclsqv10nzs3rdgync6f0o4mn2a.dwion.com/dlhdl-cdn.zhanqi.tv/zqlive/'.$a1.'_1024p.flv?';
       $ud=f_kd($ua);
       //$ud='../v.htm?&f='.$a5;
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$a3.')</a>';
echo $xml;
}}}
function zqtv0($url) {
       $t = $_GET['t']?$_GET['t']:4;
       $ul ='http://www.zhanqi.tv/games';
       $ut = m_v($ul);
preg_match_all('|<li class="js-game-list-item" data-cid="([^>]+)" data-fid="([^>]+)" data-id="([^>]+)"(.*)>(.*)<p class="name">([^>]+)</p>(.*)</li>|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
       $a1 = $d[3][$k];
       $a2 = m_u($d[6][$k]);
       $vd=Current(explode('?',$v));
     $xml ='<a href="'.$fname.'?&zqtv_m='.$a1.'&&t='.$t.'" target="b">'.$a2.'</a>'."\n";  
  echo $xml;
}}
function yytv($url) {
set_time_limit(0);
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $p1 = $p*50;
       $uk= array("other","red","talk","mc","sing","piece","dance","sport");
       $unk=$uk[$u];
       $w0k= array("mobilelive","nice","mobilelive","xing","zonghe","jiangshi","dtjh","lieqi");
       $w1k= array("idx","lvyou","dashan","meishi","daye");
       $w2k= array("idx","nj","girl");
       $w3k= array("idx","music","show","acg","lieqi","nj","girl");
       $w4k= array("idx");
       $wnk='';
       $w0nk=$w0k[$w];
       $w1nk=$w1k[$w];
       $w2nk=$w2k[$w];
       $w3nk=$w3k[$w];
       $w4nk=$w4k[$w];
    if($u=='0') $wnk=$w0nk;else if($u=='1') $wnk=$w1nk;else if($u=='2') $wnk=$w2nk;else $wnk=$w4nk;
       $t0k= array("3134","3133","3212","3216","3141","3142","3147");//yqk;
       $t2k= array("328","975","976");//talk;
       $t1k= array("1872","560","556","1656","562");//red;
       $t3k= array("322","4232","4233","4234");//mc;
       $t4k= array("3613","3603");//sport;
       $t5k= array("1479","1480","1481","1482","1483");//mobilelive;
       $t6k= array("1576","3763","3454");//xing;
       $t7k= array("3643","3644");//zonghe;
       $t8k= array("3642");//jiangshi;
       $t9k= array("447893");//dtjh;
       $t10k= array("313");//dance;
       $t11k= array("308","4230","4231","4232","4233","4234");//sing;
       $t12k= array("555","556");//dasan;
       $t13k= array("557","560");//lvyou;
       $t14k= array("561");//lieqi;
       $t15k= array("562");//daye;
       $t16k= array("975");//nj;
       $t17k= array("976");//girl;
       $t18k= array("1811");//piece;
       $tnk='';
       $t0nk=$t0k[$t];
       $t1nk=$t1k[$w];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
       $t5nk=$t5k[$t];
       $t6nk=$t6k[$t];
       $t7nk=$t7k[$t];
       $t8nk=$t8k[$t];
       $t9nk=$t9k[$t];
       $t10nk=$t10k[$t];
       $t11nk=$t11k[$t];
       $t12nk=$t12k[$t];
       $t13nk=$t13k[$t];
       $t14nk=$t14k[$t];
       $t15nk=$t15k[$t];
       $t16nk=$t16k[$t];
       $t17nk=$t17k[$t];
       $t18nk=$t18k[$t];
    if($wnk=='yqk') $tnk=$t0nk; else if($wnk=='sing') $tnk=$t11nk; else if($wnk=='mobilelive') $tnk=$t5nk; else if($wnk=='4') $tnk=$t4nk;
else if($wnk=='zonghe') $tnk=$t7nk; else if($wnk=='jiangshi') $tnk=$t8nk; else if($wnk=='dtjh') $tnk=$t9nk; else if($wnk=='nj') $tnk=$t16nk;
else if($wnk=='dasan') $tnk=$t12nk; else if($wnk=='lvyou') $tnk=$t13nk; else if($wnk=='lieqi') $tnk=$t14nk; else if($wnk=='daye') $tnk=$t15nk;
else if($wnk=='girl') $tnk=$t17nk; 
else $tnk=$tnk;
    if($u=='4') $tnk=$t11nk; else if($u=='3') $tnk=$t3nk; else if($u=='7') $tnk=$t4nk;else if($u=='1') $tnk=$t1nk; else if($u=='2') $tnk=$t2nk;
 else if($u=='6') $tnk=$t10nk; else if($u=='5') $tnk=$t18nk;
 else $tnk=$tnk;
 //for ($ii = 0; $ii < $p; $ii++) { }
       $ul0 ='http://www.yy.com/more/page.action?biz='.$unk.'&subBiz='.$wnk.'&page=1&moduleId='.$tnk.'&pageSize='.$p1.'';
       //$ul2 ='http://www.yy.com/c/cont/video/pageReviewVideoById.action?id='.$wnk.'&pageSize=200';
       //$ul3 ='http://www.yy.com/c/cont/video/listVideoById.action?id='.$w.'&pageSize=200';
       //$ul4 ='http://www.yy.com/more/page.action?biz=mc&subBiz=idx&page='.$ii.'&moduleId=322&pageSize=20';
       //$ul5 ='http://www.yy.com/more/page.action?biz=other&subBiz=yqk&page='.$ii.'&moduleId=3134&pageSize=60';
       //$ul8 ='http://www.yy.com/more/page.action?biz=talk&subBiz=idx&page=1&moduleId=328&pageSize=60';
       //$ul9 ='http://www.yy.com/more/page.action?biz=red&subBiz=idx&page=2&moduleId=1872&pageSize=60';
       //$ul6 ='http://api-tinyvideo-web.yy.com/home/tinyvideos?callback=jQuery112403172347705373326_1558531473425&appId=svwebpc&sign=&data={"uid"%3A0%2C"page"%3A1%2C"pageSize"%3A10}&_=1558531473426';
       //$ul7 ='http://www.yy.com/c/yycom/category/getCategory.action?parentId=2';
       $nt = J_d(m_v($ul0),ture);
       $aa = $nt["data"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = $a0["version"];
       $a3 = $a0["moduleId"];
       $a4 = $a0["uid"];
       $a5 = $a0["sid"];
       $a6 = $a0["ssid"];
       $a7 = $a0["users"];
       $a8 = $a0["type"];
       $a9 = $a0["pid"];
       $a10 = $a0["biz"];
       $a11 = $a0["subBiz"];
       $a12 = m_u(r_u($a0["name"]));
       $a13 = m_u(r_u($a0["desc"]));
       $a14 = m_u($a0["tag"]);
       $a15 = $a0["liveurl"];
       $a16 = $a0["url"];
       $a17 = m_u($a0["profile"]);
       $a18 = $a0["resurl"];
       $a19 = $a0["title"];
       //$a20 = 'https://hls.yy.com/newlive/'.$a5.'_'.$a6.'.m3u8';
       $a20 = 'https://hls.yy.com/newlive/'.$a5.'_'.$a6.'.flv';
       //$a21 = 'https://ks-flv.yy.com/live/15013_xv_1352219272_1352219272_0_0_0-15013_xa_1352219272_1352219272_0_0_0-5807737554013822035-5807737554013822036-2-3441981-33.flv?codec=orig&secret=2b8a8efe641dc57a72084b7d9acffb94&t=1558621796&u=4294229405&appid=15013';
if($a==1) {
       $ua =$a20;
       $ud = f_kd($ua);
}else {
       $ud='../tv/swf.htm?m=yy&f='.$a5.'&cid='.$a6.'';
       //$ud='../t.htm?u=&f=http://sousou2.top/dl/yy1.php?t='.$a1.'';
       //$ud='../tv/yy.htm?f='.$a5.'&cid='.$a6.'';
       //$ud = 'http://weblbs.yystatic.com/s/'.$a5.'/'.$a6.'/yycomscene.swf';
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a17.'('.$a13.')</a>';
    //$xml ='<a href="'.$fname.'?&yytvid='.$a5.'&yytvcid='.$a6.'" target="b">'.$a17.'('.$a13.')</a>';
echo $xml;
}}
function yytv0($url) {
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $uk= array("other","red","talk","mc","sing","piece","dance","sport","travel");
       $unk=$uk[$u];
       $w0k= array("yqk","nice","mobilelive","xing","zonghe","jiangshi","dtjh","lieqi");
       $w1k= array("idx","lvyou","dashan","meishi","daye");
       $w2k= array("idx","nj","girl");
       $w3k= array("idx","music","show","acg","lieqi","nj","girl");
       $w4k= array("idx");
       $wnk='';
       $w0nk=$w0k[$w];
       $w1nk=$w1k[$w];
       $w2nk=$w2k[$w];
       $w3nk=$w3k[$w];
       $w4nk=$w4k[$w];
    if($u=='0') $wnk=$w0nk;else if($u=='1') $wnk=$w1nk;else if($u=='2') $wnk=$w2nk;else $wnk=$w4nk;
       $t0k= array("3134","3133","3212","3216","3141","3142","3147");//yqk;
       $t2k= array("328","975","976");//talk;
       $t1k= array("1872","560","556","1656","562");//red;
       $t3k= array("322","4232","4233","4234");//mc;
       $t4k= array("3613","3603");//sport;
       $t5k= array("1479","1480","1481","1482","1483");//mobilelive;
       $t6k= array("1576","3763","3454");//xing;
       $t7k= array("3643","3644");//zonghe;
       $t8k= array("3642");//jiangshi;
       $t9k= array("447893");//dtjh;
       $t10k= array("313");//dance;
       $t11k= array("308","4230","4231","4232","4233","4234");//sing;
       $t12k= array("555","556");//dasan;
       $t13k= array("557","560");//lvyou;
       $t14k= array("561");//lieqi;
       $t15k= array("562");//daye;
       $t16k= array("975");//nj;
       $t17k= array("976");//girl;
       $t18k= array("1811");//piece;
       $tnk='';
       $t0nk=$t0k[$t];
       $t1nk=$t1k[$w];
       $t2nk=$t2k[$t];
       $t3nk=$t3k[$t];
       $t4nk=$t4k[$t];
       $t5nk=$t5k[$t];
       $t6nk=$t6k[$t];
       $t7nk=$t7k[$t];
       $t8nk=$t8k[$t];
       $t9nk=$t9k[$t];
       $t10nk=$t10k[$t];
       $t11nk=$t11k[$t];
       $t12nk=$t12k[$t];
       $t13nk=$t13k[$t];
       $t14nk=$t14k[$t];
       $t15nk=$t15k[$t];
       $t16nk=$t16k[$t];
       $t17nk=$t17k[$t];
       $t18nk=$t18k[$t];
    if($wnk=='yqk') $tnk=$t0nk; else if($wnk=='sing') $tnk=$t11nk; else if($wnk=='mobilelive') $tnk=$t5nk; else if($wnk=='4') $tnk=$t4nk;
else if($wnk=='zonghe') $tnk=$t7nk; else if($wnk=='jiangshi') $tnk=$t8nk; else if($wnk=='dtjh') $tnk=$t9nk; else if($wnk=='nj') $tnk=$t16nk;
else if($wnk=='dasan') $tnk=$t12nk; else if($wnk=='lvyou') $tnk=$t13nk; else if($wnk=='lieqi') $tnk=$t14nk; else if($wnk=='daye') $tnk=$t15nk;
else if($wnk=='girl') $tnk=$t17nk; 
else $tnk=$tnk;
    if($u=='4') $tnk=$t11nk; else if($u=='3') $tnk=$t3nk; else if($u=='7') $tnk=$t4nk;else if($u=='1') $tnk=$t1nk; else if($u=='2') $tnk=$t2nk;
 else if($u=='6') $tnk=$t10nk; else if($u=='5') $tnk=$t18nk;
 else $tnk=$tnk;
    for($i=1;$i<=$p;++$i){
       $ul0 ='http://www.yy.com/more/page.action?biz='.$unk.'&subBiz='.$wnk.'&page='.$i.'&moduleId='.$tnk.'&pageSize=60';
       //$ul2 ='http://www.yy.com/c/cont/video/pageReviewVideoById.action?id='.$wnk.'&pageSize=200';
       //$ul3 ='http://www.yy.com/c/cont/video/listVideoById.action?id='.$w.'&pageSize=200';
       //$ul4 ='http://www.yy.com/more/page.action?biz=mc&subBiz=idx&page='.$i.'&moduleId=322&pageSize=20';
       //$ul5 ='http://www.yy.com/more/page.action?biz=other&subBiz=yqk&page='.$i.'&moduleId=3134&pageSize=60';
       //$ul8 ='http://www.yy.com/more/page.action?biz=talk&subBiz=idx&page=1&moduleId=328&pageSize=60';
       //$ul9 ='http://www.yy.com/more/page.action?biz=red&subBiz=idx&page=2&moduleId=1872&pageSize=60';
       //$ul6 ='http://api-tinyvideo-web.yy.com/home/tinyvideos?callback=jQuery112403172347705373326_1558531473425&appId=svwebpc&sign=&data={"uid"%3A0%2C"page"%3A1%2C"pageSize"%3A10}&_=1558531473426';
       //$ul7 ='http://www.yy.com/c/yycom/category/getCategory.action?parentId=2';
       $ut = m_v($ul0);
preg_match_all('|"id":([^>]+),|ismU',$ut,$d);
preg_match_all('|"version":([^>]+),|ismU',$ut,$d1);
preg_match_all('|"moduleId":([^>]+),|ismU',$ut,$d2);
preg_match_all('|"uid":([^>]+),|ismU',$ut,$d3);
preg_match_all('|"sid":([^>]+),|ismU',$ut,$d4);
preg_match_all('|"ssid":([^>]+),|ismU',$ut,$d5);
preg_match_all('|"users":([^>]+),|ismU',$ut,$d6);
preg_match_all('|"type":([^>]+),|ismU',$ut,$d7);
preg_match_all('|"pid":"([^>]+)",|ismU',$ut,$d8);
preg_match_all('|"biz":"([^>]+)",|ismU',$ut,$d9);
preg_match_all('|"subBiz":"([^>]+)",|ismU',$ut,$d10);
preg_match_all('|"name":"([^>]+)",|ismU',$ut,$d11);
preg_match_all('|"desc":"([^>]+)",|ismU',$ut,$d12);
preg_match_all('|"tag":"([^>]+)",|ismU',$ut,$d13);
preg_match_all('|"liveurl":"([^>]+)",|ismU',$ut,$d14);
preg_match_all('|"url":"([^>]+)",|ismU',$ut,$d15);
preg_match_all('|"profile":"([^>]+)",|ismU',$ut,$d16);
preg_match_all('|"resurl":"([^>]+)",|ismU',$ut,$d17);
preg_match_all('|"title":"([^>]+)",|ismU',$ut,$d18);
foreach($d[1] as $k=>$v){
       $a0 = $d[1][$k];
       $a1 = $d1[1][$k];
       $a2 = $d2[1][$k];
       $a3 = $d3[1][$k];
       $a4 = $d4[1][$k];
       $a5 = $d5[1][$k];
       $a6 = $d6[1][$k];
       $a7 = $d7[1][$k];
       $a8 = $d8[1][$k];
       $a9 = $d9[1][$k];
       $a10 = $d10[1][$k];
       $a11 = m_u(r_u($d11[1][$k]));
       $a12 = m_u(r_u($d12[1][$k]));
       $a13 = m_u($d13[1][$k]);
       $a14 = $d14[1][$k];
       $a15 = $d15[1][$k];
       $a16 = m_u($d16[1][$k]);
       //$b15 = $d17[1][$k];
       //$b16 = m_u($d18[1][$k]);
       $a17 = 'https://hls.yy.com/newlive/'.$a4.'_'.$a5.'.m3u8';
       //$a17 = 'https://hls.yy.com/newlive/'.$a4.'_'.$a5.'.flv';
       //$a18 = 'https://ks-flv.yy.com/live/15013_xv_1352219272_1352219272_0_0_0-15013_xa_1352219272_1352219272_0_0_0-5807737554013822035-5807737554013822036-2-3441981-33.flv?codec=orig&secret=2b8a8efe641dc57a72084b7d9acffb94&t=1558621796&u=4294229405&appid=15013';
if($a==1) {
       $ua =$a17;
       $ud = f_kd($ua);
}else {
       $ud='../tv/swf.htm?m=yy&f='.$a4.'&cid='.$a5.'';
       //$ud='../tv/yy.htm?f='.$a4.'&cid='.$a5.'';
       //$ud = 'http://weblbs.yystatic.com/s/'.$a4.'/'.$a5.'/yycomscene.swf';
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a16.'('.$a12.')</a>';
echo $xml;
}}}
function hytv($url) {
set_time_limit(0);
       $ak= array('tx','bd','migu-bd','migu','al','js','ws','hw','aldirect');
       $wk= array("2135","2165","1671","2168","2752","100036","2356","100044","5883","3793","2633","4079","2561","2694","5367","100022","3841","2420","5907","100031","2333","2836","xingxiu","1663","2408","2409","2595","2746","100004","411","2303","100042","2746","1085","2766","2833");
 if( is_mobile()) {
$tk= array('','2067','2079','1011','987','1223');
$t0k= array('all','2067','2069','2071','2073','2075','2077','2079','2081','2083','2085','2087','2089','1273','987','1011','1223');
}else {
$tk= array('','2067','2079','1011','987','1223');
$t0k= array('all','2067','2069','2071','2073','2075','2077','2079','2081','2083','2085','2087','2089','1273','987','1011','1223');
$t1k= array('0','1441','203','2505','3155','3279','619','1445','621','3329');
$t2k= array('all','386','1455','490','821');
$t3k= array('all','3487','3529','2609');
$t4k= array('all','3159','3163','3161','3361','2053');
$t5k= array('all','40','39','46','33','2999','1031','3425','783');
$t6k= array('all','3055','2947','2943','2945','2951');
$t7k= array('all','199','201','202','989');
$t8k= array('all','3171','3177','3173','3175','3181','3179','3503','3505');
$t9k= array('all','2845','2849','2847','3189','3185','2841','3187');
$t10k= array('0','2633');
$t11k= array('all','1659','2045');
$t12k= array('');
$t13k= array('');
$t14k= array('');
$t15k= array('');
$t16k= array('');
}
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $p1 = $p*30;
       $wnk = $wk[$w];
       $ank = $ak[$a];
       $tnk = "";
       $t0nk = $t0k[$t];
       $t1nk = $t1k[$t];
       $t2nk = $t2k[$t];
       $t3nk = $t3k[$t];
       $t4nk = $t4k[$t];
       $t5nk = $t5k[$t];
       $t6nk = $t6k[$t];
       $t7nk = $t7k[$t];
       $t8nk = $t8k[$t];
       $t9nk = $t9k[$t];
       $t10nk = $t10k[$t];
       $t11nk = $t11k[$t];
       $t12nk = $t12k[$t];
       $t13nk = $t13k[$t];
       $t14nk = $t14k[$t];
       $t15nk = $t15k[$t];
       $t16nk = $t16k[$t];
  if($w=='1') $tnk=$t1nk;else if($w=='2') $tnk=$t2nk;else if($w=='3') $tnk=$t3nk;else if($w=='4') $tnk=$t4nk;else if($w=='5') $tnk=$t5nk;else if($w=='6') $tnk=$t6nk;
else if($w=='7') $tnk=$t7nk;else if($w=='8') $tnk=$t8nk;else if($w=='9') $tnk=$t9nk;else if($w=='10') $tnk=$t10nk;else if($w=='11') $tnk=$t11nk;else if($w=='12') $tnk=$t12nk;
else if($w=='13') $tnk=$t13nk;else if($w=='14') $tnk=$t14nk;else if($w=='15') $tnk=$t15nk;else if($w=='16') $tnk=$t16nk;else $tnk=$t0nk;
    for($i=1;$i<=$p;++$i){
   if($t==0) {
       $ul1 ='https://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&gameId='.$wnk.'&tagAll='.$tnk.'&page='.$i.'';
       $ul12 ='http://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&callback=getLiveListCallback&gameId='.$wnk.'&page='.$i.'';
       $ul2 ='http://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&gameId='.$wnk.'&tmpId='.$tnk.'&page='.$i.'';
       $ul22 ='http://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&callback=getLiveListCallback&gameId='.$wnk.'&tmpId='.$tnk.'&page='.$i.'';
}else {
       $ul4 ='https://www.huya.com/cache.php?m=LiveList&do=getTmpLiveByPage&gameId='.$wnk.'&tmpId='.$tnk.'&page='.$i.'';
       $ul2 ='http://www.huya.com/cache.php?m=LiveList&do=getGameLiveLibrary&callback=getTagListCallback&gid=2135';
       $ul1 ='https://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&gameId='.$wnk.'&tagAll=0&callback=getLiveListJsonpCallback&page='.$i.'';

}
       $ul3 ='http://www.huya.com/cache.php?m=Game&do=ajaxGameLiveByPage&gid='.$wnk.'&page='.$p.'';
       $ut = J_d(m_v($ul1),True);
       $aa = $ut["data"]["datas"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
   if($t==0) {
       $a1 = m_u(r_u($a0["roomName"]));
}else {
       //$a1 = m_u(r_u($a0["roomName"]));
       $a1 = m_u(r_u($a0["introduction"]));
}
       $a4 = m_u(r_u($a0["nick"]));
       $aa2 = $a0["isBluRay"];
       $aa3 = $a0["bluRayMBitRate"];
       $aa4 = $a0["liveSourceType"];
       $aa5 = $a0["liveChannel"];
       $aa6 = $a0["profileRoom"];
  if($aa3!=="") {
       $a5 = $aa5;
       $ax5 = $aa6;
}else {
       $a5 = $aa6;
       $ax5 = $aa5;
}
       $a6 = $a0["screenshot"];
       $ut=x_g($a6);
preg_match('|(.*)//([^>]+)/([^>]+)/([^>]+)/([^>]+)?(.*)|U',$ut,$b);
       $a11 = $b[4]; 

 if(is_mobile()) {
       $a12 = 'http://'.$ank.'.hls.huya.com/src/'.$a11.'.m3u8';
       //$a12 = 'http://'.$ank.'.hls.huya.com/src/'.$a11.'-imgplus.m3u8';
       //$ud = '../ck.htm?u=1&f='.$a12;
       $ud = '../tv/hy.htm?&f='.$aa6;
}else {
if($a<=7) {
       //$a12 = 'http://'.$ank.'.flv.huya.com/src/'.$a11.'.flv';
       //$a12 = 'http://'.$ank.'.hls.huya.com/src/'.$a11.'.m3u8';
       //$a12 = 'http://'.$ank.'.flv.huya.com/huyalive/'.$a11.'-imgplus.flv';
       //$a12 = 'http://'.$ank.'.hls.huya.com/huyalive/'.$a11.'-imgplus.m3u8';
       //$a12 = 'http://'.$ank.'.flv.huya.com/src/'.$a11.'-imgplus.flv';
       //$a12 = 'http://'.$ank.'.hls.huya.com/src/'.$a11.'-imgplus.m3u8';
       $a12 = 'http://121.12.115.162/txdirect.hls.huya.com/src/'.$a11.'.m3u8';
       //$a12 = 'http://'.$ank.'.rtmp.huya.com/huyalive/'.$a11.'.m3u8';
       //$a12 = 'http://'.$ank.'.p2p.huya.com/huyalive/'.$a11.'.slice';
       $ud = f_ck($a12);
}else if($a==8) {
       //$ud = '../tv/hy.htm?&f='.$aa6;
       $ud = '../tv/swf.htm?m=hy&f='.$aa6;
       //$ud = 'https://liveshare.huya.com/iframe/'.$aa6.'';
       //$ud = 'http://liveshare.huya.com/'.$aa6.'/huyacoop.swf';
}else if($a==9) {
       $ud = '../tv/hy.htm?&f='.$aa6;
       //$ud = '../tv/swf.htm?m=hy&f='.$aa6;
       //$ud = 'https://liveshare.huya.com/iframe/'.$aa6.'';
       //$ud = 'http://liveshare.huya.com/'.$aa6.'/huyacoop.swf';
}else {
  if($aa3!=="") {
       $ud = '../tv/swf.htm?m=hyv&f='.$a5;
}else {
       //$ud = '../tv/swf.htm?m=hy&f='.$aa6;
       $ud = '../tv/hy.htm?&f='.$aa6;
}}
}
    $xml ='<a href="'.$ud.'" target="b">'.$a1.' ('.$a4.')('.$ax5.')</a>';
echo $xml;
}
}
}
function hytv2($url) {
       $wk= array("2135","2333","100022","2836","xingxiu","1663","2165","2408","2409","2168","2356","2752","2595","2746","2633","1671","100004","100036","411","2303","2561","100042","2746","2420","1085","2766","2833","2694");
       //$tk= array('AL','WS','TX');
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $p1 = $p*30;
       $wnk = $wk[$w];
       //$tnk = $tk[$t];
  if($w<='30') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;++$i){
       $ul  ='http://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&gameId='.$wnk.'&tagAll=0&rows=10&page='.$i.'';
preg_match_all('|"roomName":"([^>]+)"(.*)"screenshot":"([^>]+)"(.*)"nick":"([^>]+)"(.*)"profileRoom":"([^>]+)"|ismU',m_v($ul),$d);
foreach($d[1] as $k=>$v){
       $a1 = m_u(r_u($d[1][$k]));
       $a6 = $d[3][$k];
       $a3 = m_u(r_u($d[5][$k]));
       $a2 = $d[7][$k];
       $a9 = 'https://www.huya.com/'.$a2;
 if($a==0) {
       $a10 = hy_nt($a6);
       $ud = f_kd($a10);
}else {
       $ud = 'http://liveshare.huya.com/iframe/'.$a2;
       //$ud = '../tv/hy.php?f='.$a2;
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.' : ('.$a1.')</a>';
echo $xml;
}}}
function hy_nt($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $ut=x_g($w);
preg_match('|(.*)//([^>]+)/([^>]+)/([^>]+)/([^>]+)?(.*)|U',$ut,$b);
       $a11 = $b[4];
       $a12 = 'http://aldirect.rtmp.huya.com/huyalive/'.$a11.'.m3u8';
       //$a5 = 'http://aldirect.rtmp.huya.com/huyalive/'.$a2.'_1200.'.$a4;
       //$a6 = 'http://ws.streamhls.huya.com/huyalive/'.$a2.'_1200.m3u8';
       //$a5 = x_g($a3).'/'.$a2.'_1200.'.$a4;
       $ud=$a12;
//echo $ud;
return $ud;
}
function hytvs($url) {
       //$tk= array("0","1","2","3","4","5");
       //$uk= array("true","false");
       $w = $_GET['w']?$_GET['w']:'一起看';
       $a = $_GET['a']?$_GET['a']:'0';
       $kw = k_w($w);
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       //$tnk = $tk[$t];
       //$unk = $uk[$u];
       $p = $_GET['p']?$_GET['p']:"1";
       $p1 = $p*30;
    if($u=="1") $p2=$p;else $p2=$p1;
//$ul ='http://search.huya.com/?callback=jQuery1111010404377846364604_1508671253035&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate='.$tnk.'&rows='.$p1.'&start=0';
$ul2 ='http://search.cdn.huya.com/?callback=jQuery111104829705609715517_1520331269691&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate=0&rows='.$p2.'&start='.$u;
//$ul3 ='http://search.cdn.huya.com/?callback=jQuery111104829705609715517_1520331269689&m=Search&do=getSearchArticle&q='.$kw.'&uid=0&app=11&v=4&typ=-5&rows='.$p1.'';
//$ul4 ='http://search.cdn.huya.com/?callback=jQuery1111082022519756079_1520486889533&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate=1&rows=40&start=0';
//https://search.cdn.huya.com/?callback=jQuery111109333381787876274_1598083916274&m=Search&do=getSearchContent&q=%E7%BD%91%E7%90%83&uid=0&v=4&typ=-5&livestate=0&rows=40&start=0
 preg_match("#\[\{(.*)\}\],#U",m_v($ul2),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $aa0 = $a0["screen_type"];
if($aa0=='0') {
       $a1 = $a0["game_liveLink"];
       $a2 = m_u($a0["game_nick"]);
       $a3 = m_u($a0["live_intro"]);
       $aa3 = m_u($a0["game_roomName"]);
       $a4 = $a0["room_id"];
       $aa4 = $a0["uid"];
 if($a==0) {
       //$ud = 'http://liveshare.huya.com/iframe/'.$a4;
       //$ud = '../tv/swf.htm?m=hy&f='.$a4;
       $ud = '../tv/hy.htm?&f='.$a4;
       //$a9 = 'http://www.huya.com/'.$a4;
}else {
       //$ud = 'http://liveshare.huya.com/iframe/'.$a4;
       //$ud = 'http://liveshare.huya.com/'.$a4.'/huyacoop.swf';
       //$ud = '../tv/swf.htm?m=hyv&f='.$aa4;
       $ud = '../tv/hy.htm?&f='.$aa4;
}
       $v=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.'('.$aa4.')</a>';
echo $xml;
}}}
function hytvs0($url) {
       //$tk= array("0","1","2","3","4","5");
       //$uk= array("true","false");
       $w = $_GET['w']?$_GET['w']:'';
       $a = $_GET['a']?$_GET['a']:'0';
       $kw = k_w($w)?k_w($w):"一起看";
       $t = $_GET['t']?$_GET['t']:"0";
       //$u = $_GET['u']?$_GET['u']:"0";
       //$tnk = $tk[$t];
       //$unk = $uk[$u];
       $p = $_GET['p']?$_GET['p']:"2";
       $p1 = $p*30;
       $ul ='http://search.huya.com/?callback=jQuery1111010404377846364604_1508671253035&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate='.$tnk.'&rows='.$p1.'&start=0';
       $ul2 ='http://search.cdn.huya.com/?callback=jQuery111104829705609715517_1520331269691&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate='.$tnk.'&rows='.$p1.'&start=0';
       $ul3 ='http://search.cdn.huya.com/?callback=jQuery111104829705609715517_1520331269689&m=Search&do=getSearchArticle&q='.$kw.'&uid=0&app=11&v=4&typ=-5&rows='.$p1.'';
       $ul4 ='http://search.cdn.huya.com/?callback=jQuery1111082022519756079_1520486889533&m=Search&do=getSearchContent&q='.$kw.'&uid=0&v=4&typ=-5&livestate=1&rows=40&start=0';
       $ut = m_v($ul2);
preg_match_all("|\"game_roo([^>]+)\":\"([^>]+)\"(.*)\"room_id\":([^>]+),(.*)\"screen_type\":0,(.*)\"uid\":([^>]+),|ismU",$ut,$b);
foreach($b[3] as $k=>$v){
       //$a1 = $b[1][$k];
       //$a0 = $b[3][$k];
       $a2 = m_u(r_u($b[2][$k]));
       $a3 = $b[4][$k];
       $aa3 = $b[7][$k];
 if($a==0) {
       //$a9 = 'http://www.huya.com/'.$a3;
       //$ud = f_kd($a10);
       //$ud = '../tv/huya2.php?f='.$aa3;
       $ud = '../tv/swf.htm?m=hyv&f='.$aa3;
}else {
       //$ud = '../tv/huya2.php?f='.$a3;
       //$ud = 'http://liveshare.huya.com/iframe/'.$a3;
       //$ud = '../tv/swf.htm?m=hy&f='.$a3;
       $ud = '../tv/hy.htm?&f='.$a3;
       //$ud = 'http://liveshare.huya.com/'.$a3.'/huyacoop.swf';
       //$ud = '../tv/hy.htm?f='.$a3;
       //$ud = '../tv/huya2.php?f='.$aa3;

}
       $v=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$aa3.')</a>';
echo $xml;
}}
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
function bitv($url) {//25//50-37
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
       $ul2 ='http://api.bilibili.com/archive_rank/getarchiverankbypartion?callback=&type=jsonp&tid='.$wnk.'&pn='.$i;
       $ul3 ='http://api.bilibili.com/x/tag/ranking/archives?jsonp=jsonp&tag_id='.$tnk.'&rid='.$wnk.'&pn='.$i.'&page=1&callback=';
       $ul4 ='https://api.bilibili.com/pgc/season/index/result?st=2&style_id=10023&area=-1&release_date=-1&season_status=-1&order=0&sort=0&page=1&season_type=2&pagesize=20&type=1';
       $ul5 ='https://api.bilibili.com/pgc/season/index/result?st=2&style_id=-1&area=-1&release_date=-1&season_status=-1&order=6&sort=0&page=1&season_type=2&pagesize=20&type=1';
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
function bilitv($url) {
set_time_limit(0);
       $wk= array("","live_time","income","movie","all","otaku","round","subject","draw","sing-dance","ent-life","association","live");
       $uk= array("3","0","1","2","4","5","6","7","8","9");
       $t1k= array("online","pubdate");
       $tk= array("10","1","2","3","4","5","6","7","8","9","11");
       $t2k= array("33","0","21","207","145","530","123","207","399","367","369","372","373","374","375","376","377","190","192","193","194","465");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $p1= 50;
       $u = $_GET['u']?$_GET['u']:0;
       $a = $_GET['a']?$_GET['a']:"0";
       $unk = $uk[$u];
       $t2nk = $t2k[$t];
       $wnk = $wk[$w];
       $tnk = $tk[$t];
       $nk = '';
if($t==1||$t==2||$t==3||$t==4||$t==5||$t==6||$t==7||$t==8) $nk =1;else if($t==0||$t==9||$t==10) $nk =10;else if($t==11||$t==12||$t==13||$t==14||$t==15||$t==16) $nk =11;else $nk =$tnk;
       $kw=k_w($w);
  if($w<='12') $wnk=$wnk;else $wnk=$kw;//%E7%A7%91%E5%B9%BB
    for($i=1;$i<=$p;$i++){
       //$ul1 ='https://api.live.bilibili.com/xlive/web-interface/v1/index/getWebAreaList?source_id=2';
 //$ul2 ='https://api.live.bilibili.com/xlive/web-interface/v1/second/getList?platform=web&parent_area_id=10&area_id=0&sort_type=sort_type_269&page=1';
       //$ul3 ='http://api.live.bilibili.com/room/v1/room/get_user_recommend?page='.$i.'';
       //$ul4 ='https://api.live.bilibili.com/area/liveList?area='.$wnk.'&order='.$tnk.'&page='.$i.'';
  $ul6 ='https://api.live.bilibili.com/xlive/web-interface/v1/second/getList?platform=web&parent_area_id=10&area_id='.$t2nk.'&sort_type=online&page='.$i;
  $ul5 ='https://api.live.bilibili.com/room/v3/area/getRoomList?platform=web&parent_area_id=10&cate_id=0&area_id='.$t2nk.'&sort_type=live_time&page='.$i.'&page_size=30&tag_version=1';
  $ul7 = 'https://api.bilibili.com/x/web-interface/search/type?&search_type=live_user&cover_type=user_cover&order=&keyword='.$kw.'&category_id=&page='.$i.'&highlight=1&single_column=0';
 $ul8 ='https://api.live.bilibili.com/xlive/web-interface/v1/second/getList?platform=web&parent_area_id='.$nk.'&area_id='.$t2nk.'&sort_type=&page='.$i.'';
       //$ul9 ='https://search.bilibili.com/api/search?search_type=live&keyword='.$wnk.'&order=pubdate&cate_id='.$unk.'&page='.$i.'';
       //$ul10 ='https://api.live.bilibili.com/room/v2/AppIndex/getAllList?page='.$i.'';
  if($w=='0'||$w=='1'||$w=='2') $ul=$ul6;else if($w<'13'and $w>'2') $ul=$ul5;else $ul=$ul7;
       $ut = J_d(m_v($ul8),True);
       $aa1 = $ut["data"]["list"];
       $aa2 = $ut["data"]["result"];
  if($w<=15) $aa=$aa1;else $aa=$aa1;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0["roomid"];
       $cid = $a1;
       $a3 = $a0["uid"];
       $a4 = m_u(r_u($a0["uname"]));
       $a5 = m_u(r_u($a0["title"]));
       //$a10 = 'http://live.bilibili.com/'.$a1;
if($a=="0") {
    $xml ='<a href="'.$fname.'?&biliid='.$a1.'" target="b">'.$a4.' ( '.$a5.' )</a>';
}else if($a=="1") {
       $ud = '../tv/bili.htm?f=&cid='.$a1.'';
       //$ud = 'https://player.bilibili.com/player.html?&autoplay=1&aid='.$a1.'&cid='.$cid.'&bvid='.$a3.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ( '.$a5.' )</a>';
}else if($a=="3") {
       $ud = '../tv/bili.htm?f=&cid='.$a1.'';
       //$ud = 'https://player.bilibili.com/player.html?&autoplay=1&aid='.$a1.'&cid='.$cid.'&bvid='.$a3.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ( '.$a5.' )</a>';
}else {
       $ud = '../tv/bili.htm?f=&cid='.$a1.'';
       //$ud = '../tv/swf.htm?&m=bi&f='.$a3.'&cid='.$a1.'';
       //$ud = 'https://player.bilibili.com/player.html?&autoplay=1&aid='.$a1.'&cid='.$cid.'&bvid='.$a3.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ( '.$a5.' )</a>';
}
echo $xml;
}}}
function bitvs($url){
       $t2k= array("0","1","2","3","4","5");
       $tk= array("online","live_time");
       $uk= array("live","all","video","0");
       $w = $_GET['w']?$_GET['w']:"电影"; 
       $t = $_GET['t']?$_GET['t']:"0";
       $tnk=$tk[$t];
       $t2nk=$t2k[$t];
       $a = $_GET['a']?$_GET['a']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $unk=$uk[$u];
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
    for($ii=1;$ii<=$p;$ii++){
       $ul2 ='https://search.bilibili.com/api/search?search_type='.$unk.'&keyword='.$kw.'&order=pubdate&duration='.$tnk.'&page='.$ii.'&tids=0';
       $ul1 ='https://api.bilibili.com/x/web-interface/search/type?&search_type=live&cover_type=user_cover&page='.$ii.'&order=live_time&keyword='.$kw.'&category_id=&highlight=1&single_column=0';
       $ut = J_d(m_v($ul1),true);
       $aa = $ut["data"]["result"]["live_room"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["uid"];
       $a2 = $a0["tags"];
       $a3 = $a0["live_time"];
       $a4 = m_u(r_u($a0["uname"]));
       $a5 = m_u(r_u($a0["title"]));
       $a6 = $a0["roomid"];
       $a7 = $a0["aid"];
if($a=="0") {
    $xml ='<a href="'.$fname.'?&biliid='.$a6.'" target="b">'.$a4.' ( '.$a5.' )</a>';
}else if($a=="1"){
       $ud =  '../tv/bili.htm?cid='.$a6.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$a2.')</a>';
}else {
       //$ud =  '../tv/bili.htm?cid='.$a6.'';
       $ud = '../tv/bili.htm?&f=1&cid='.$a6.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ('.$a2.')</a>';
}
echo $xml;
}}}
function bitvs0($url){
       $t2k= array("0","1","2","3","4","5");
       $ak= array("click","pubdate");
       $uk= array("0","23","177","11","160","13","167","3","129","36","181","16");
       $w = $_GET['w']?$_GET['w']:"电影"; 
       $a = $_GET['a']?$_GET['a']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $ank=$ak[$a];
       $t2nk=$t2k[$t];
       $u = $_GET['u']?$_GET['u']:"0";
       $unk=$uk[$u];
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
    for($ii=1;$ii<=$p;$ii++){
       $ul2 ='https://search.bilibili.com/api/search?search_type='.$unk.'&keyword='.$kw.'&order=pubdate&duration='.$tnk.'&page='.$ii.'&tids=0';
       $ul1 ='https://api.bilibili.com/x/web-interface/search/type?&page='.$ii.'&order='.$ank.'&keyword='.$kw.'&duration='.$t2nk.'&from_source=webtop_search&from_spmid=333.5&platform=pc&search_type=video&tids='.$unk.'&highlight=1&single_column=0';
       $ut = J_d(m_v($ul1),true);
       $aa = $ut["data"]["result"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = $a0["mid"];
       $a5 = m_u(r_u($a0["typename"]));
       $a3 = $a0["bvid"];
       $a4 = m_u(r_u($a0["title"]));
       $a6 = $a0["duration"];
       $a7 = $a0["rank_score"];
       $ud = '../tv/bili.htm?&f='.$a1.'&cid='.$a2.'&bvid='.$a3.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ( '.$a5.''.$a6.')</a>';
echo $xml;
}}}
function kstv($url) {//快手
       $wk= array("WYJJ/10","WYJJ/22185","WYJJ/6","SYXX/22160","SYXX/1052","SYXX/9","2165","2408","2409","2168","2356");
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $p1 = $p*30;
       $wnk = $wk[$w];
       //$tnk = $tk[$t];
  if($w<='30') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;++$i){
       $ul  ='https://live.kuaishou.com/cate/'.$wnk.'?page='.$p.'';
       $ul1  ='https://live.kuaishou.com/m_graphql?data={"operationName":"LiveCardQuery","variables":{"type":"SYXX","gameId":"1001","heroType":"HOT","heroName":"巅峰赛","currentPage":1,"pageSize":60}"}';
       $ut = m_v($ul);
/*preg_match_all('|"roomName":"([^>]+)"(.*)"screenshot":"([^>]+)"(.*)"nick":"([^>]+)"(.*)"profileRoom":"([^>]+)"|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
       $a1 = m_u(r_u($d[1][$k]));
       $a6 = $d[3][$k];
       $a3 = m_u(r_u($d[5][$k]));
       $a2 = $d[7][$k];
       $a9 = 'https://www.huya.com/'.$a2;
 if($a==0) {
       $a10 = hy_nt($a6);
       $ud = f_kd($a10);
}else {
       $ud = 'http://liveshare.huya.com/iframe/'.$a2;
       //$ud = '../tv/hy.htm?f='.$a2;
}
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.' : ('.$a1.')</a>';*/
echo $ut;
}}
function sd360zb($url) {
       $uk= array("","hot","11","20","4","16","43","44","5","2","33","8","replay");

       $u = $_GET['u']?$_GET['u']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $w = $_GET['w']?$_GET['w']:0; 
       $unk=$uk[$u];
   if ($u <= '12')  $unk2=$unk;else  $unk2=$u;
       $w1=r_g(m_u('风景'));
       $kw=k_w($_GET["w"])?k_w($_GET["w"]):$w1; 
   if ($u == '0')  $kw=$kw;else  $kw=null;
        $mm = ' : ';
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $p2 = '32'*$i;
       $ul1 = 'http://live.jia.360.cn/search/searchList?sortType=1&isPage=1&callback=jQuery18309479157291881185_1469424753618&kw='.$kw.'&count='.$p2.'&from=mpc_ipcam_web&page=0';
       $ul2 = 'https://live3.jia.360.cn/public/getPublicList?isPage=1&sortType=1&callback=jQuery1102033906860394798355_1510378959042&orderBy=&count=16&from=mpc_ipcam_web&category='.$unk2.'&page='.$p2.'';
   if ($u == '0')  $ut=m_v($ul1);else  $ut=m_v($ul2);
  preg_match_all('#"sn":"([^>]+)"#ismU',$ut,$d2);
  preg_match_all('#"qid":"([^>]+)"#ismU',$ut,$d3);
  preg_match_all('#"channel":"([^>]+)"#ismU',$ut,$d4);
  preg_match_all('#"titlePub":"(.*)"#ismU',$ut,$d5);
  foreach($d2[1] as $k=>$v){
       $a2 =$d2[1][$k];
       $a3 =$d3[1][$k];
       $a4 =$d4[1][$k];
       $a5 =r_u($d5[1][$k]);
       $a6 ='https://live3.jia.360.cn/public/getInfoAndPlayV2?callback=jQuery18307851184004056839_1510373793744&from=mpc_ipcam_web&sn='.$a2.'&taskid='.$a4.'';
       $a7 = sd_3($a6);
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
       $a9 ='../v.htm?a=&f='.$a7.'';
   //if ($u == '0')  $ud=$a9;else if ($u == '2')  $ud=$a7;else if ($u == '3')  $ud=$a8;else $ud=$a5;
       $ud = $a9;
       $vd=Current(explode('?',$v));
      $xml ='<a href="'.$ud.'" target="b" >'.$a5.'</a>';
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
function qetv($url) {
set_time_limit(0);
       $wk= array("2000000110","2000000008","100880170","2000000162","40000001470","40000001472","2000000163","40000001480","100880170","2000000157");
       $tk= array("0","1300","1297","1298","1296","1295");
       $uk2= array("3","2","0","1","2","4","5","6","11","13","15","19");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $kw=k_w($w); 
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
    if($w<='20') { //$wnk=$wnk;//else $wnk=$kw;
       $ul2 ='https://share.egame.qq.com/cgi-bin/pgg_async_fcgi?param={"key":{"module":"pgg_live_read_ifc_mt_svr","method":"get_pc_live_list","param":{"appid":"'.$wnk.'","page_num":'.$i.',"page_size":40,"tag_id":'.$tnk.',"tag_id_str":""}}}&tt=1';
       $ul21 ='https://share.egame.qq.com/cgi-bin/pgg_async_fcgi?param={"key":{"module":"pgg_live_read_ifc_mt_svr","method":"get_pc_live_list","param":{"appid":"'.$wnk.'","page_num":'.$i.',"page_size":40,"tag_id":0,"tag_id_str":""}}}&app_info={"platform":4,"terminal_type":2,%22egame_id":"egame_official","imei":"","version_code":"9.9.9.9","version_name":"9.9.9.9","ext_info":{"_qedj_t":"","ALG-flag_type":"","ALG-flag_pos":""},"pvid":"953904844820090510"}&g_tk=&pgg_tk=&tt=1&_t=1599274009606';
       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["key"]["retBody"]["data"]["live_data"]["live_list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a5 = $a0["video_info"]["play_url"];
       $a1 = $a0["video_info"]["dst"];
       $a2 = r_u($a0["title"]);
       $a3 = $a0["anchor_id"];
       $a4 = r_u($a0["anchor_name"]);
       $a6 = 'https://m.egame.qq.com/live?anchorid='.$a3;
 if(is_mobile()) {
       //$ud= '../ck.htm?&u=&f=http://hls333.dszbdq.cn/egame.php?id='.$a3.'';
       //$ud= '../ck.htm?&u=&f=http://stream.guihet.com/t/egame.php?id='.$a3.'';
       $ud= '../t.htm?&u=&f=https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$a3.'_500.xs&.m3u8';
       //$ud= '../t.htm?&u=&f=https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$a3.'_1200.xs&.m3u8';
}else if($a==0) {
       $ud= $a6;
}else if($a==2) {
       $ud= '../tv/swf.htm?&m=qe&f='.$a3.'';
}else {
       //$ud= $a5;
       //$ud= '../t.htm?&u=&f=http://hls333.dszbdq.cn/egame.php?id='.$a3.'';
       //$ud= '../t.htm?&u=&f=http://stream.guihet.com/t/egame.php?id='.$a3.'';
       $ud= '../t.htm?&u=&f=https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$a3.'_500.xs&.m3u8';
       //$ud= '../t.htm?&u=&f=https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$a3.'_1200.xs&.m3u8';
       //$ud= '../d.htm?&u=&f='.$a5.'';
}
    //$xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.$a4.')('.$a3.')</a>';
    $xml ='<a href="'.$fname.'?&qe_td='.$a3.'" target="b">'.$a2.' ('.$a4.')('.$a3.')</a>';
echo $xml;
}
}else {
       $ul2 ='https://game.egame.qq.com/cgi-bin/pgg_async_fcgi?param={"key":{"module":"pgg_search_svr","method":"search_feeds_video","param":{"search_key_words":"'.$kw.'","page_no":'.$i.',"page_size":30}}}&app_info={"platform":4,"terminal_type":2,"egame_id":"egame_official","pvid":"953904844820090510"}&tt=1&';
       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["key"]["retBody"]["data"]["feeds_video_list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a3 = t_m($a0["create_ts"]);
       $a5 = m_u($a0["text"]);
       $a1 = $a0["pic_list"]["vid"];
       $a2 = $a0["outer_video_detail"]["video_url"];
       //$a4 = r_u($a0["anchor_name"]);
       $a6 = 'https://egame.qq.com/vod?videoId='.$a1;
 if(is_mobile()) {
       $ud= '../t.htm?&u=1&f='.$a2.'';
}else if($a==0) {
       $ud= $a6;
}else {
       $ud= '../t.htm?&u=&f='.$a2.'';
}
    $xml ='<a href="'.$ud.'" target="b" >'.$a5.' ( '.$a3.' )</a>';
echo $xml;
}
}
}}
function nowtv($url) {
set_time_limit(0);
       $w = $_GET['w']?$_GET['w']:0; 
       $wk= array("热门","音乐","新人","上海市","北京市","深圳市","广州市","其他","影视","江苏省","天津市","河北省","内蒙古自治区");
       $tk= array("topic","near","0","1");
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $wnk = $wk[$w];
       $tnk = $tk[$t];
       $kw=k_w($wnk);
    if($w<='15') $wnk2=k_w($wnk);else $wnk2=k_w($w);
    for($i=0;$i<=$p;$i++){
       $p1 = $p*50;
       $p2 = $i*20;
    if($w==0) {
       $ul2 ='https://now.qq.com/cgi-bin/now/pc/firstpage/anchorrecommendation?start='.$p2.'&count=0&num=20&bkn=';
}else  if($w==8) {
       $ul2 ='https://now.qq.com/cgi-bin/now/web/topic/get_topic_room_new?start='.$p2.'&count=0&topic='.$wnk2.'&num=20&bkn=1464643769';
       //$ul2 ='https://now.qq.com/cgi-bin/now/web/topic/get_topic_room_new?start='.$p2.'&count=0&topic=%E5%BD%B1%E8%A7%86&num=20&bkn=';
       //$ul2 ='https://now.qq.com/cgi-bin/now/web/topic/get_topic_room_new?start=20&count=20&topic=%E5%BD%B1%E8%A7%86&num=20&topic_group=%E7%83%AD%E9%97%A8&topic_type=%E5%BD%B1%E8%A7%86&topic_type_id=1&bkn=';
}else  if($w==1||$w==2) {
       $ul2 ='https://now.qq.com/cgi-bin/now/pc/firstpage/topic_anchor_list?start='.$p2.'&count=20&&topic='.$wnk2.'&num=20&bkn=';
}else   if($w==3||$w==4||$w==5||$w==6||$w==7||$w==9||$w==10||$w==11||$w==12) {
       $ul2 ='https://now.qq.com/cgi-bin/now/pc/firstpage/near_anchor_list?start='.$p2.'&count=20&location='.$wnk2.'&num=20&bkn=';
}else {
       $ul2 ='https://now.qq.com/cgi-bin/now/pc/firstpage/near_anchor_list?start='.$p2.'&count=20&location='.k_w($w).'&num=20&bkn=';
}
       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
if($w==8) {
       $aa = $nt["result"]["room_hot"];
}else {
       $aa = $nt["result"]["data"];
}
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a5 = $a0["room_jump_url"];
       $a1 = r_u($a0["room_city"]);
       $a2 = $a0["now_id"];
       $a3 = r_u($a0["room_name"]);
if($w==8) {
       $a4 = $a0["roomid"];
}else {
       $a4 = $a0["room_id"];
}
       $a6 = r_u($a0["anchor_nickname"]);
       /*$a7 = 'https://now.qq.com/pcweb/story.html?roomid='.$a4.'&_wv=16778245';
       $a8 = 'https://now.qq.com/cgi-bin/now/web/room/get_live_room_url?room_id='.$a4.'&is_sub_room=0&platform=2&playtype=3&bkn=&_=0.04899073286333899';
       $nt=J_d(m_v($a8),true);
       $aa1 = $nt["result"]["raw_hls_url"];
       $aa2 = $nt["result"]["raw_rtmp_url"];
       $aa3 = $nt["result"]["raw_flv_url"];
       $aa4 = $nt["result"]["pure_voice_flv"];
       $aa5 = $nt["result"]["pure_voice_rtmp"];
       $ud= f_t($aa3);
    //$xml ='<a href="'.$ud.'" target="b" >'.$a3.' ('.$a6.')('.$a1.')</a>';*/
    $xml ='<a href="'.$fname.'?&nowtvid='.$a4.'&" target="b">'.$a3.' ('.$a6.')('.$a1.')</a>';
echo $xml;
}}}
function xgtv($url) {//西瓜
set_time_limit(0);
       //$wk= array("208","124","341","136","212","204","195","134","201","174","194","183","441","250");
       //$uk= array("3","2","0","1","2","4","5","6","11","13","15","19");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       //$wnk = $wk[$w];
       //$unk = $uk[$u];
    for($i=1;$i<=$p;$i++){
       $ul ='https://www.ixigua.com/api/cinema/filterv2/albums?_signature=_02B4Z6wo00f015wxSZwAAIBDBZWwox9HZ8ucNE0AALjPa6';
       $ut = m_s($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["albumList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["albumId"];
       $a2 = m_u($a0["title"]);
 if($a==0) {
       $ud = 'https://www.ixigua.com/'.$a1;
    $xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
    //$xml ='<a href="'.$fname.'?&dy_td='.$a3.'&" target="b">'.$a2.' ('.$a1.')</a>';
}else {
       $ud = 'https://www.ixigua.com/'.$a1.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
}
echo $xml;
}}}
function kutv($url) {//西瓜
set_time_limit(0);
       $wk= array("38","8000","3013","49","39","1001","24","25","26","29","43","44","21","20","1007");
       //$uk= array("3","2","0","1","2","4","5","6","11","13","15","19");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $wnk = $wk[$w];
       //$unk = $uk[$u];
  for($i=1;$i<=$p;$i++){
      $ul ='https://fx.service.kugou.com/soa/pkshow/pkcollection/collectionList.json?page='.$i.'&pageSize=60&';
      $ul1 ='https://fx1.service.kugou.com/fx_flow_pc/category/cdn/getList?cid='.$wnk.'&appid=1010&page='.$i.'&pageSize=60&&platform=0&';
      $ul2 ='https://fx1.service.kugou.com/fx_flow_pc/category/cdn/getList?cid=26&page=1&appid=1010&platform=0&device=d41d8cd98f00b204e9800998ecf8427e&';
      $ul3 ='https://fx.service.kugou.com/soa/pkshow/pkmode/info?pkMode=2&roomId=4049516&kugouId=1319986999&_p=7';
      $ul4 ='https://fx.service.kugou.com/singlike/realsinglike/push/getExtActivityInfo?startKugouId=1319986999&isStar=false&pid=90&appId=1010';
      $ul5 ='https://fx1.service.kugou.com/platform_business_service/star_dynamic/list?isIntimacyGray=true&isWeb=true&starKugouId=1319986999&pageNum=1';
      $ul6 ='https://fx.service.kugou.com/vodcenter/songorder/getInServiceOrder?roomId=4049516';
      $ul7 ='https://fx.service.kugou.com/platform_rank/rank/hour/getAreaRankList?hideLastList=0&areaId=10';
      $ul8 ='https://fx1.service.kugou.com/mfanxing-home/h5/cdn/room/index/list_v2?page='.$i.'&entranceType=4&areaName=&gaodeCode=&latitude=0&longitude=0&device_brand=&device_manufacturer=&std_plat=7&platform=7&_p=7&uiMode=0&kugouId=0&pid=0&cid=6000&device=448d82701bcf37b137775a144d542243&device_model=&sysVersion=0&version=0&channel=0&appid=1010';
      $ul9 ='https://fx1.service.kugou.com/IndexWebPlat/IndexWebService/IndexWebService/getExclusiveStarList/'.$i.'/?';
if($a==1 ){
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["collectionList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["pkId"];
       $a2 = $a0["masterKugouId"];
       $a3 = $a0["masterRoomId"];
       $a4 = m_u($a0["masterNickName"]);
       $a5 = m_u($a0["competitorNickName"]);
       $ua1 = 'https://tx.liveplay.live.kugou.com/live/fx_hifi_'.$a2.'_avc.m3u8';
       $ua2 = 'https://fxliveplay.kugou.com/hls/fx_hifi_'.$a2.'.m3u8';
       $ud = '../d.htm?f='.$ua1;
    $xml ='<a href="'.$ud.'" target="b" >'.$a4.' ( '.$a2.' )</a>';
    //$xml ='<a href="'.$fname.'?&dy_td='.$a2.'&" target="b">'.$a4.' ('.$a1.')</a>';
echo $xml;
}}else if($a==2 ){
       $ut = m_v($ul8);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["roomId"];
       $a2 = $a0["userId"];
       $a3 = m_u($a0["nickName"]);
       $a4 = $a0["kugouId"];
       $a5 = m_u($a0["cityName"]);
       $ua1 = 'https://tx.liveplay.live.kugou.com/live/fx_hifi_'.$a4.'_avc.m3u8';
       $ua2 = 'https://fxliveplay.kugou.com/hls/fx_hifi_'.$a4.'.m3u8';
       $ud = '../d.htm?f='.$ua1;
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.' ( '.$a2.' )</a>';
echo $xml;
}}else if($a==3 ){
       $ut = m_v($ul9);
       $nt = J_d($ut,ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["roomId"];
       $a2 = $a0["userId"];
       $a3 = m_u($a0["roomName"]);
       $a4 = $a0["kugouId"];
       $a5 = m_u($a0["nickName"]);
       $ua1 = 'https://tx.liveplay.live.kugou.com/live/fx_hifi_'.$a4.'_avc.m3u8';
       $ua2 = 'https://fxliveplay.kugou.com/hls/fx_hifi_'.$a4.'.m3u8';
       $ud = '../d.htm?f='.$ua1;
    $xml ='<a href="'.$ud.'" target="b" >'.$a5.' ('.$a2.')</a>';
echo $xml;
}}else {
       $ut = m_v($ul1);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["roomId"];
       $a2 = $a0["userId"];
       $a3 = m_u($a0["nickName"]);
       $a4 = $a0["kugouId"];
       $a5 = m_u($a0["cityName"]);
       $ua1 = 'https://tx.liveplay.live.kugou.com/live/fx_hifi_'.$a4.'_avc.m3u8';
       $ua2 = 'https://fxliveplay.kugou.com/hls/fx_hifi_'.$a4.'.m3u8';
       $ud = '../d.htm?f='.$ua1;
    $xml ='<a href="'.$ud.'" target="b" >'.$a3.' ( '.$a2.' )</a>';
echo $xml;
}}}}
function dytv($url) {
set_time_limit(0);
       $wk= array("208","124","341","136","212","204","195","134","201","174","194","183","441","250");
       $uk= array("3","2","0","1","2","4","5","6","11","13","15","19");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $a = $_GET['a']?$_GET['a']:0;
       $wnk = $wk[$w];
       $unk = $uk[$u];
    if($w<='20') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://capi.douyucdn.cn/api/v1/getColumnRoom/'.$unk.'?limit=30&page='.$i.'&offset=0';
       $ul3 ='https://www.douyu.com/gapi/rkc/directory/'.$unk.'_'.$wnk.'/'.$i.'';
       $ul4 ='http://capi.douyucdn.cn/api/v1/live/'.$wnk.'?limit=30&page='.$i.'&offset=0';
       $ul5 ='http://open.douyucdn.cn/api/RoomApi/live/'.$wnk.'?page='.$i.'&isAjax=1&limit=30&offset=0';
       $ul6 ='https://www.douyu.com/gapi/rkc/directory/mixList/2_'.$wnk.'/'.$i.'';
    /* $ut = m_v($ul6);
       $nt = J_d($ut,ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["room_id"];
       $a2 = r_u($a0["room_name"]);*/

       $ut = m_s($ul6);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["rl"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["rid"];
       $a2 = m_u($a0["rn"]); 
 if($a==0) {
       //$a3 = 'https://www.douyu.com'.x_g($a0["url"]);
       $a3 = $a1;
       //$ud= f_kd($a10);
    $xml ='<a href="'.$fname.'?&dy_td='.$a3.'&" target="b">'.$a2.' ('.$a1.')</a>';
}else {
       //$ud = 'https://staticlive.douyucdn.cn/common/share/play.swf?room_id='.$a1.'';
       $ud = '../tv/swf.htm?m=dy&f='.$a1.'';
    $xml ='<a href="'.$ud.'" target="b" >'.$a2.' ('.$a1.')</a>';
}
echo $xml;
}}}
function dytd($url) {
       $ul = $_GET['w']?$_GET['w']:'431460';
       $url1 = 'https://rtbapi.douyucdn.cn/japi/sign/web/getconfig?posid=4112241&roomid='.$ul.'&cate1=2&cate2=208';
       $tm = J_d(m_s($url1),true);
       $tmm= $tm["data"][0]["expireTime"];
       //$url = 'https://www.douyu.com/lapi/live/getH5Play/'.$ul.'?rid='.$ul.'&tt='.$tmm.'&did=2dfd02149496030e407b1e3900031501';
       $url = 'https://www.douyu.com/lapi/live/getH5Play/'.$ul.'?ver=120111811&v=220120201216&sign=f464362739cc2c086677ae843513f9fa&cdn=&rate=0&tt='.$tmm.'&did=95b4a17ebfafc7c900a75bd800061501&ive=0&aid=web%2Dflash&iar=1';
       //$url = 'https://playweb.douyucdn.cn/lapi/live/hlsH5Preview/'.$ul.'?rid='.$ul.'&did=95b4a17ebfafc7c900a75bd800061501&sign=f7d2bc21bedfc6b7fb579de89851ef9a';
       $ut = m_s($url);
echo $ut;
}
function bxtv($url) {
set_time_limit(0);
       $wk= array("hot","mobile","new","tag","tag","tag","tag","tag","tag");
       $tk= array("hot","5","new","4","2","3","1","15","99");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:1; 
       $p1 = $p*30;
       $wnk = $wk[$w];
    if($w<='10') $wnk=$wnk;else $wnk=$w;
       $tnk = $tk[$w];
       $ul = '';
    for($i0=1;$i0<=$p;$i0++){
       $ul1 ='http://show.9xiu.com/ajax/index/getroomsbytag?tag='.$wnk.'&index='.$tnk.'&page='.$i0.'&pagesize=20&v=1';
       $ul2 ='http://www.9xiu.com/ajax/index/getroomsbytag?tag='.$wnk.'&index='.$tnk.'&sorttype=1&page='.$i0.'&pagesize=20';
       $ut = J_d(m_v($ul2),true);
       $aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["rid"];
       $a2 = $a0["uid"];
       $a3 = r_u($a0["nickname"]);
       //$a6 = 'http://static.69xiu.com/pack/flash/201601291610/new_live.swf?&room_id='.$a1.'&uid='.$a2.'';
       //$a7 = 'http://img.static.9xiu.com/pack/flash/201601291610/main_baidu_live.swf?server=rtmp://videodownws.69xiu.com:1935/9xiu&action_type=8888&room_id='.$a1.'&uid='.$a2.'';
       //$a9 = 'rtmp://videodownws.69xiu.com:1935/9xiu&action_type=8888&room_id='.$a1.'&uid='.$a2.'';
       //$a8 = 'rtmp://livedownrtmpws.9xiuimg.com:1935/9xiu/'.$a1;
       //$a11 = 'rtmp://video-rtmp.qn.9xiu.com/9xiu/'.$a1;
       //$a10 = 'http://video-rtmp.qn.9xiu.com/9xiu/'.$a1.'.m3u8';
       $a10 = 'http://video-hls.qn.9xiu.com/9xiu/'.$a1.'.m3u8';
       //$a12 = 'http://video-rtmp.qn.9xiuimg.com/9xiu/'.$a1.'/playlist.m3u8';
       //$a12 = 'http://video-hls.qn.9xiuimg.com/9xiu/'.$a1.'/playlist.m3u8';
       //$ua = f_ht($a10);
       $ud = f_kd($a10);
    $xml ='<a href="'.$ud.'" target="b" >'.m_u($a3).'</a>';
echo $xml;
}}}
function kkxtv($url) {
       $wk= array("all","431","1027","281","1021","26","421","1066","31","120","156","651","1011");
       $w1k= array("1001","1156","1441","1655","1286","1650","1752","421","1171","1336","1011","421","1782");
       $w2k= array("1","2","3","4");
       $uk= array("20010302","55000003","50001004","10002032");
       $tk= array("cataId","type");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:"0";
       $p2 = $p*35;
       $tnk = $tk[$t];
       $unk = $uk[$u];
       $wnk =  $wk[$w];
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
    if($tnk=="2") $wnk=$w2nk;else if($tnk=="1") $wnk=$wnk;else $wnk=$w1nk;
       $ul = '';
       $ul1 = 'http://www.kktv5.com/CDN/output/M/3/I/10002032/P/partId-'.$wnk.'_start-0_offset-'.$p2.'_platform-1/json.js';
       $ul2 = 'http://www.kktv5.com/CDN/output/M/1/I/20010302/P/'.$tnk.'-'.$wnk.'_start-0_offset-'.$p2.'_platform-1_a-1_c-100101/json.js';
       $ul3 = 'http://www.kktv5.com/CDN/output/M/3/I/55000003/P/'.$tnk.'-'.$wnk.'_start-0_offset-'.$p2.'_platform-1_a-1_c-100101/json.js';
       $ul4 = 'http://www.kktv5.com/CDN/output/M/3/I/50001004/P/c-1_a-1_platform-1/json.js';
       $ul5 = 'http://www.kktv5.com/CDN/output/M/3/I/55000003/P/type-1_start-0_offset-35_gender-0_platform-1_a-1_c-100101/json.js';
       $ut = J_d(m_v($ul2),True);
       $aa = $ut["roomList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) { 
       $a0 = $aa[$i2];
       $a1 = $a0["userId"];
       $a2 = m_u($a0["nickname"]);
       //$a3 = $a0["roomId"];
       //$a4 = f_t($a0["liveStream"]);
       //$a6 = f_t('http://pull.kktv8.com/livekktv/'.$a1.'.flv');
       //$a8 = f_t('rtmp://pull.kktv8.com/livekktv/'.$a1.'');
       $a8 = f_t('http://pull.kktv8.com/livekktv/'.$a1.'/playlist.m3u8');
     $xml ='<a href="'.$a8.'" target="b" >'.$a2.'</a>';
echo $xml;
}}
function kkxtv0($url) {
       $wk= array("1156","1441","1655","1286","1650","1752","421","1001","1171","1336","1011","421","1782");
       //$wk= array("431","1027","281","1021","26","421","1066","31","120","156","651","1011");
       $w2k= array("1","2","3","4");
       $uk= array("20010302","55000003","10002032","50001004");
       $tk= array("cataId","type");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $p2 = $p*50;
       $wnk1 = $wk[$w];
       $wnk2 = $w2k[$w];
    if($t=="1") $wnk=$wnk2;else $wnk=$wnk1;
       $tnk = $tk[$t];
       $unk = $uk[$u];
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
       $a5 = f_kd($d3[1][$k]);
       $a6 = 'http://pull.kktv8.com/livekktv/'.$a2.'.flv';
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function iktv($url) {//映客
       $wk= array("hot","recommend","62F3CD3ACF8347C9","411F2448D92E4317","004201909183MQTW","03FF96A6E88E36F4","AFCC0BC263924F20","00420190126LHHBM","2","5","805");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
       //$p1 = $i*20;
       $ul = 'https://www.inke.cn/hotlive_list.html?page='.$i;
       $ut = m_v($ul);
preg_match_all("|<div class=\"list_pic\">(.*)<a href=\"\/liveroom\/index.html\?uid=([^>]+)&id=([^>]+)\">(.*)<div class=\"list_intro\"><p>([^>]+)<\/p><\/div>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[2][$k];
       $a3 = $d[3][$k];
       $a4 = $d[5][$k];
       $xml ='<a href="'.$fname.'?&ik_tv='.$a2.'" target="b">'.$a4.'</a>';
     //$xml ='<a href="'.$ud.'" target="b" >'.$a1.'</a>';
echo $xml;
}}}
function hjtv($url) {//花椒
       $wk= array("1000","803","811","999","802","800","801","806","2","5","805");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
       $p1 = $i*20;
       $ul = 'https://webh.huajiao.com/live/listcategory?_callback=jQuery1102025443527895912155_1608190755016&cateid='.$wnk.'&offset='.$p1.'&nums=20&fmt=jsonp&';
       $ut = m_v($ul);
 preg_match("#\((.*)\)#U",$ut,$b);
       $ut = $b[1];
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["feeds"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = r_u($a0["feed"]["title"]);
       $a2 = $a0["feed"]["sn"];
       $a3 = $a0["feed"]["u_id"];
       $a4 = 'https://qh2-flv.live.huajiao.com/live_huajiao_v2/'.$a2.'.flv';
       $ud = f_t($a4);
       //$xml ='<a href="'.$fname.'?&hj_tv='.$a2.'" target="b">'.$a1.'</a>';
     $xml ='<a href="'.$ud.'" target="b" >'.$a1.'</a>';
echo $xml;
}}}
function wxtv($url) {//我秀
       $wk= array("1","100","200","300","400","500","600","700");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"10";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
       $ul = 'https://www.woxiu.com/index.php?action=Index/Page&do=ZhuboGrade&sort=1&order=1&gtype=0&json=1&page='.$i;
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = r_u($a0["name"]);
       $a2 = $a0["room_id"];
       $a3 = $a0["u_id"];
       $a4 = 'https://www.woxiu.com/'.$a2;
       $ud = $a4;
       $xml ='<a href="'.$fname.'?&wx_tv='.$a4.'" target="b">'.$a1.'</a>';
     //$xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}}
function v6tv3($url) {//6间房
       $wk= array("1","100","200","300","400","500","600","700");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=0;$i<=$p;$i++){
       $ul1 = 'https://v.6.cn/liveAjax.html';
       $ul = 'https://v.6.cn/subareaIndex/getSubareaIndexNew.php?subarea=1';
       $ul2 = 'https://v.6.cn/subareaIndex/getFieryRank.php?subarea=1';
       $ul3 = 'https://v.6.cn/subareaIndex/getFieryRank.php?subarea=0';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["content"]["videoList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a4 = $a0["vid"];
       $a2 = $a0["uid"];
       $a1 = r_u($a0["alias"]);
       //$a3 = 'https://v.6.cn/'.$a4;
       $ud = $a3;
       $xml ='<a href="'.$fname.'?&v6_tv='.$a4.'" target="b">'.$a1.'</a>';
     //$xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}}
function v6tv($url) {//6间房
       $wk= array("1","100","200","300","400","500","600","700");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=0;$i<=$p;$i++){
       $ul = 'https://v.6.cn/liveAjax.html?subarea='.$i.'';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["roomList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = r_u($a0["username"]);
       $a2 = $a0["rid"];
       //$a3 = 'https://v.6.cn/'.$a2;
       $ud = $a3;
       $xml ='<a href="'.$fname.'?&v6_tv='.$a2.'" target="b">'.$a1.'</a>';
     //$xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $xml;
}}}
function dbtv($url) {//豆瓣
       $wk= array("%E7%94%B5%E5%BD%B1","100","200","300","400","500","600","700");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"科幻";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"0";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
       $kw = k_w($w);
    for($i=0;$i<=$p;$i++){
       $p1 = $p*20;
       $ul = 'http://movie.douban.com/j/new_search_subjects?sort=T&range=0,10&tags=%E7%94%B5%E5%BD%B1&playable=1&start='.$p1.'';
       $ut = f_g($ul);
       /*$nt = J_d($ut,ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = r_u($a0["title"]);
       $a2 = $a0["url"];
       $a3 = $a0["id"];
       $ud = $a3;
       $xml ='<a href="'.$fname.'?&db_tv='.$a2.'" target="b">'.$a1.'</a>';*/
     //$xml ='<a href="'.$ud.'" target="b" >'.$a2.'</a>';
echo $ut;
}}
function t95tv($url) {//95秀
       $wk= array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22");
       //$tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       //$tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=1;$i<=10;$i++){
       $p1 = $i*20;
 if($w==0) {
       $ul1 = 'http://www.95.cn/index/AnchorCategoryNew?page='.$i.'&type=1&screen_high=0&counts=20&';
}else {
       $ul1 = 'http://www.95.cn/index/AnchorCategory2?page='.$i.'&type='.$wnk.'&screen_high=0&counts=20&';
}
       $ut = m_v($ul1);
preg_match_all('|<li>(.*)<a(.*)href="([^>]+)" target="anchor-([^>]+)">(.*)<div class="pane_mm_name ell">([^>]+)</div>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = 'http://www.95.cn'.$d[3][$k];
       $a3 = $d[6][$k];
       $ud = $a2;
       //$ud = '../d.htm?u=0&f='.$a2;
       $xml ='<a href="'.$fname.'?&v95tv='.$a2.'&" target="b">'.$a3.'</a>';
     //$xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function tstv($url) {//懒人听书
       $wk= array("1","100","200","300","400","500","600","700");
       $tk= array("2904","465","7862","5112","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"10";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
   if($t<10) $t2nk=$tnk;else $t2nk=$t;
   if($w<10) $w2nk=$wnk;else $w2nk=$w;
    for($i=0;$i<=10;$i++){
       $p1 = $i*10;
       $w3nk = $w2nk + $p1;
       $ul = 'https://www.lrts.me/ajax/playlist/2/'.$t2nk.'/'.$w3nk.'/next';
       $ul2 = 'https://www.lrts.me/search/book/1/诗';
       $ut = m_v($ul);
preg_match_all('|<input type="hidden" value="([^>]+)" name="source" />(.*)<input type="hidden" value="([^>]+)" name="number"/>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = $d[3][$k];
       $ud = $a2;
       //$ud = '../d.htm?u=0&f='.$a2;
       //$xml ='<a href="'.$fname.'?&haoqtv='.$a5.'&" target="b">'.$a3.'</a>';
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function tsstv($url) {//懒人听书搜索
       $wk= array("1","100","200","300","400","500","600","700");
       $tk= array("199","199");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"3";
       $tnk = $tk[$t];
       $wnk = $wk[$w];
       $kw=k_w($w);
    for($i=0;$i<=$p;$i++){
       $p1 = $i*10;
       $ul = 'https://www.lrts.me/search/book/'.$i.'/'.$kw;
       $ut = m_v($ul);
preg_match_all('|<a class="book-item-name" href="/book/([^>]+)" target="_blank">([^>]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d[2][$k]);
       $ud = 'https://www.lrts.me/book/'.$a2;
       //$ud = '../d.htm?u=0&f='.$a2;
     $xml ='<a href="'.$ud.'" target="b" >'.$a3.'</a>';
echo $xml;
}}}
function tqtv($url) {//天气
       $w = $_GET['w']?$_GET['w']:"072310";
       $t = $_GET['t']?$_GET['t']:"072310";
       $tt=$t + 8;
       $p = $_GET['p']?$_GET['p']:"0";
       $ul = 'https://pi.weather.com.cn/i/product/pic/l/sevp_nsmc_wxcl_asc_e99_achn_lno_py_2021'.$t.'1500000.jpg';
     $xml ='<a href="'.$ul.'" target="b" >'.$tt.'</a>';
echo $xml;
}
function haoqtv($url) {
       $wk= array("1","2","3/shanghai","4","5","3/beijing","3/guangdong","3/jiangsu","3/hunan","3/anhui","3/zhejiang","3/liaoning","3/jiangxi","3/shandong",
"3/heilongjiang","3/yunnan","3/sichuan","3/henan","3/hubei","3/fujian","3/congqing","3/hebei","3/jilin","3/guangxi","3/shanxi","3/shan-xi","3/ningxia","3/hainan","3/gansu",
"3/xinjiang","3/neimenggu","3/tianjin","3/guizhou","3/qinghai","zhibo/zongyi","zhibo/sports","zhibo/xinwen","zhibo/yingshi","zhibo/shaoer","zhibo/caijing","zhibo/qita");
       $tk= array("1","2");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $wnk = $wk[$w];
  //if(w>33) $wnk='([^>]+)';else $wnk=$wnk;
       $ul = 'http://www.haoqu.net/'.$wnk.'/';
       $ut = m_v($ul);
//preg_match_all('|<li(.*)class="p-item">(.*)<a(.*)href="([^>]+)"(.*)class="thumb-outer"(.*)title="([^>]+)"(.*)>(.*)<strong(.*)>([^>]+)</strong>|ismU',$ut,$d);
preg_match_all('|<li(.*)class="p-item">(.*)<a(.*)href="([^>]+)"(.*)class="thumb-outer"(.*)title="([^>]+)"(.*)>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[4][$k];
       $a3 = m_u($d[7][$k]);
       //$a4 = $d[11][$k];
       $a5 = 'http://www.haoqu.net'.$a2;
       $xml ='<a href="'.$fname.'?&haoqtv='.$a5.'&" target="b">'.$a3.'</a>';
     //$xml ='<a href="'.$a5.'" target="b" >'.$a3.'</a>';
echo $xml;
}}
function hao_q($url) {
       $w = $_GET['w']?$_GET['w']:$url;
       $ut = f_g($w);
preg_match_all("|signal = '(.*)'|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3=strstr($a2,'$');
       $a4=substr($a3,strlen('$'));
       $a5=Current(explode('$',$a4));
return $a5;
//echo $a5;
}}
function dycj($url) {
       $w = "https://www.yicai.com/api/dycj/liveIndex.m3u8";
       $ut = m_v($w);
       $a3=strstr($ut,'https://ycallive.yicai.com/live/ycliv');
       //$a4=substr($a3,strlen('$'));
       //$a5=Current(explode('https://ycallive.yicai.com/live/ycliv',$a3));
//return $a5;
//echo $a3;
       $ud = 'http://localhost/d.htm?u=&f='.$a3;
       //$ud = 'http://localhost/p.php?&f='.$a3;
       //$ud = 'http://localhost/u.php?u=31&f='.$a3;
       //$ud = 'http://localhost/u.php?u=7&f='.$a3;
       //$ud = 'http://localhost/u.php?u=8&f='.$a3;
       //$ud = 'http://localhost/u.php?u=9&f='.$a3;
       //$ud = 'http://localhost/u.php?u=10&f='.$a3;
       //$ud = 'http://localhost/u.php?u=13&f='.$a3;
       //$ud = 'http://localhost/u.php?u=14&f='.$a3;
       //$ud = 'http://localhost/u.php?u=21&f='.$a3;
       //$ud = 'http://localhost/u.php?u=25&f='.$a3;
echo header("Location: $ud");  
}
function ttzb($url) {
set_time_limit(0);
header("".$_SERVER['REQUEST_URI']); 
       $host="live.ixigua.com";
       $tk= array("30","84","85","86","87","91","106","113","117","118","119","120","122","124","125","129","135","139","143","156","2","3","4","5","6","11","18","26","27","28","30","31","40","41","45","61","64","65","68","69","71","80","81","82","109","99");
       $tk2= array("30","2","3","4","5","6","11","18","26","27","28","30","31","40","41","45","61","64","65","68","69","71","80","81","82","85","87","91","106","113","117","118","119","120","122","124","125","129","135","139","143","156","99","109");
       $w = $_GET['w']?$_GET['w']:0; 
       $u = $_GET['u']?$_GET['u']:0; 
       $p = $_GET['p']?$_GET['p']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $a = $_GET['a']?$_GET['a']:0;
       $tnk = $tk[$t];
   if($w=="0") $tnk2=$tnk;else $tnk2=$w;
       $tt = t_hm();
       $ul2 ='https://live.ixigua.com/api/feed/category/1/'.$tnk2.'?_signature=xjCZGgAgEBYkPyrbSZxs3cYwmQAAJiq';
       $ul3 ='https://live.ixigua.com/api/feed/category/more/1/1592794084088/109?_signature=AXZ9MAAgEBdpMXyAgRjZOAF2fSAAF-M';
       $ul0 ='https://live.ixigua.com/api/feed/category/more/1/'.t_hm().'/109?_signature=AXZ9MAAgEBdpMXyAgRjZOAF2fSAAF-M';
       $ul1 ='https://live.ixigua.com/api/feed/category/1/'.$tnk2;
       $ut = J_d(m_s($ul1),True);
       $aa = $ut["data"]["liveSource"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0["room_id"];
       $a2 = m_u($a0["title"]);
       $a7 = $a0["user_name"];
       $a8 = $a0["short_id"];
       $a9 = 'https://live.ixigua.com/'.$a8.'/';
       //$a10 = 'http://pull-flv-l1.ixigua.com/normal/stream-'.$a1.'.flv';
       //$a10 = 'http://pull-hls-l1.ixigua.com/normal/stream-'.$a1.'_or4/playlist.m3u8';
       //$a10 = 'http://pull-hls-l1-xg.ixigua.com/normal/stream-'.$a1.'_or4/playlist.m3u8';
if(is_mobile()) $a=="4";else {$a=$a;}
    $xml ='<a href="'.$fname.'?&a='.$a.'&ttzbid='.$a8.'"  target="b">'.$a2.'('.$a7.')</a>';
   //$xml ='<a href="'.$ud.'" target="b" >'.$a2.'('.$a7.')</a>';
echo $xml;
}}
function nmtv($url) {
       $wk= array("4","6","12","13","14","15","18");
       $tk= array("1","2");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:stime();
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $ul = 'http://www.wrbtv.cn/m2o/player/program_xml.php?&access_token=&channel_id='.$wnk;
       $ul2 = 'http://www.wrbtv.cn/m2o/program_switch.php?channel_id='.$wnk.'&play_time=0&dates=2020-12-26&shownums=7';
       $ut = m_v($ul);
preg_match_all('|<item name="([^>]+)" startTime="([^>]+)"(.*)url="([^>]+)"(.*)/>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = m_u($d[1][$k]);
       $a3 = t_m($d[2][$k]/1000);
       $a4 = $d[4][$k];
       $a5 = '../d.htm?u=&f='.$a4;
       //$a5 = '../h.htm?u=&f='.$a4;
       //$xml ='<a href="'.$fname.'?&haoqtv='.$a5.'&" target="b">'.$a3.'</a>';
     $xml ='<a href="'.$a5.'" target="b" >'.$a2.' ('.$a3.')</a>';
echo $xml;
}}
function shtv($url) {
       $a = $_GET['a']?$_GET['a']:0; 
       $content=m_v('http://tvimg.tv.itc.cn/live/stations.jsonp');
       $content=str_ireplace('(function(args){var par=','',$content);$content=str_ireplace(';channelList(par,args);})()','',$content);
       $json=json_decode($content);
       $con=count($json->STATIONS);
 for($i = 0;$i<$con; $i++){
       $id=$json->STATIONS[$i]->STATION_ID;
       $name=$json->STATIONS[$i]->STATION_NAME;
       $neme=$json->STATIONS[$i]->EN_NAME;
       $per=$json->STATIONS[$i]->OTHER_STATION_PLAYER;
       $shid=$id;
       $a4=htmlspecialchars($id);
       //$ua =$per;
       //$ua =sh_tv($id);
       $ud = f_kd($ua2);
$xml ='<a href="'.$shid.'" target="b" >'.r_u($name).'</a>';
echo $xml;
}}
function gstv($url) {
       $wk= array("7","8","11","13","14","15","18");
       $a = $_GET['a']?$_GET['a']:0;
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $content=m_v('http://xzglwx.gandongyun.com/xz_video/video/queryJsCloudlVideo?fPubNumber=20000320000&mapLevel='.$wnk);
       $aa=json_decode($content,true);
       $count_json = count($aa);
 for ($i = 1; $i < $count_json; $i++) {  
       $a0 = $aa[$i];
       $id = $a0["id"];
       $name=$a0["cn"];
       //$ud = f_ck($id);
    //$xml ='<a href="'.$ud.'" target="b" >'.$name.'</a>';
    $xml ='<a href="'.$fname.'?gsxtv='.$id.'" target="b">'.$name.'</a>';
echo $xml;
}}
function gs_tv($url) {
       //$wk= array("SXJ000000003705","6","12","13","14","15","18");
       //$a = $_GET['a']?$_GET['a']:0;
       $w = $_GET['w']?$_GET['w']:$url;
       //$wnk = $wk[$w];
       $content=m_v('http://xzglwx.gandongyun.com/xz_video/video/getVideoUrl?videoId='.$w);
       $json=json_decode($content,true);
       $id = $json["playUrl"];
       //$name=$json["cameraId"];
       //$ud = f_d($id);
//$xml ='<a href="'.$ud.'" target="b" >'.$name.'</a>';
//echo $xml;
return $id;
}
function hb_tv($url) {
       $id = $_GET['w']?$_GET['w']:$url; 
       $g=m_v('http://app.cjyun.org/video/player/stream?stream_id='.$id.'&site_id=10008');
       $nt = J_d($g,ture);
       $a2 = x_g($nt["stream"]);
       $a3 = x_g($nt["rtmp"]);
       $a4 = x_g($nt["url"]);
       $a5 = x_g($nt["play_url"]);
       $ua =$a4;
//return $ua;
    $xml ='<a href="../ck.htm?f='.$ua.'"  target="b">'.$id.'</a>';
echo $xml;
}
function sh_tv($shid) {
       $id = $_GET['shid']?$_GET['shid']:$shid; 
       $g=m_v('http://live.tv.sohu.com/live/player_json.jhtml?encoding=utf-8&lid='.$id.'&type=1');
 preg_match('#live":"(.*?)","cid"#',$g, $t);
       $gg=m_v($t[1]);
 preg_match('#url":"(.*?)","cid#',$gg, $tt);
       $a3=$tt[1];
       $ua =$a3;
return $ua;
}
function xxav($url) {
       $w0k= array("1","2","17","18","19","20","21","22","23","24");
       $w1k= array("5","6","7","8","9","10","11","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54");
       $w2k= array("16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38");
       $w3k= array("31","32","33","34","35","36","37","38","39","40","41");
       $w4k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $w5k= array("43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","42");
       $w6k= array("1","2","3","4","5","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $tk= array("1ph.cc","5hao.pw","118.107.46.68","5hao.pw","118.107.46.68","1ph.cc");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $a = $_GET['a']?$_GET['a']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $kw=k_w($w);
       $wnk = '';
       $w0nk = $w0k[$w];
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
       $w4nk = $w4k[$w];
       $w5nk = $w5k[$w];
       $w6nk = $w6k[$w];
       $tnk = $tk[$t];
     if($t=='0') $wnk=$w2nk;else if($t=='1'||$t=='2'||$t=='3'||$t=='4'||$t=='5') $wnk=$w4nk;else if($t=='6'||$t=='8') $wnk=$w2nk;else $wnk=$w1nk;
    for( $i=1; $i<=$p;$i++){
   if($t==111) {
       $ul1 = 'http://'.$tnk.'/?m=vod-type-id-'.$wnk.'-pg-'.$i.'.html';
       $ut = m_s($ul1);
} else if( $t==2) {
       $ii=$i-1; 
       $ul1 = 'http://'.$tnk.'/type/'.$wnk.'-'.$i.'.html';
       $ut = m_v($ul1);
}else {
       $ul1 = 'http://'.$tnk.'/?m=vod-type-id-'.$wnk.'-pg-'.$i.'.html';
       $ut = m_v($ul1);
}
if($t==99||$t==3) {
preg_match_all('|<a(.*)href="(.*)detail-id-([^>]+).html(.*)"(.*)>([^>]+)</a|ismU',$ut,$d);
}else if($t==1||$t==5) {
preg_match_all('|<a(.*)href="(.*)detail-id-([^>]+).html(.*)"(.*)title="([^>]+)"(.*)>(.*)</h|ismU',$ut,$d);
}else if($t==7) {
preg_match_all('|<a(.*)href="(.*)detail-id-([^>]+).html(.*)">(.*)<img(.*)title="([^>]+)"|ismU',$ut,$d);
}else if($t==101) {
preg_match_all('|<a(.*)href="(.*)detail-id-([^>]+).html(.*)">(.*)<img(.*)alt="([^>]+)"|ismU',$ut,$d);
}else if($t==1111) {
preg_match_all('|<a(.*)href="(.*)detail-id-([^>]+).html">(.*)<(.*)class="show-title">([^>]+)<|ismU',$ut,$d);
}else if($t==2) {
preg_match_all("|<a(.*)href=\"(.*)play\/([^>]+).html\">(.*)<p><script>document.write\((.*)\(\"([^>]+)\"\)\)<|ismU",$ut,$d);
}else if($t==0||$t==6) {
preg_match_all('|<a(.*)href="(.*)play-id-([^>]+)-src-1-num-1.html"(.*)>(.*)<(.*)alt="([^>]+)"|ismU',$ut,$d);
}else {
preg_match_all('|<a(.*)href="(.*)play-id-([^>]+)-src-1-num-1.html(.*)"(.*)title="([^>]+)"(.*)>|ismU',$ut,$d);
}
foreach ($d[3] as $k=>$v){
       $a2 = $d[3][$k];
  if($t==0||$t==8||$t==6) { 
       $a3 = m_u($d[7][$k]);
}else {
 if(t==2) {
       $a3 = r_g($d[6][$k]);
}
else  $a3 = m_u($d[6][$k]);
}
  if($t==11) { $a4 = $a2;}else if($t==2){
       $a4 = 'http://'.$tnk.'/play/'.$a2.'.html';
}else {
       $a4 = 'http://'.$tnk.'/?m=vod-play-id-'.$a2.'-src-1-num-1.html';
}
  if($t==2) $xxav= "xxav62";else $xxav ="xxav";
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$a4.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x1av($url) {//资源
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"
,"32","33","34","35","36");
       $w2k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
       $w3k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $w4k= array("1","5","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42");
       $w5k= array("1","2","3","4","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44");
       $w6k= array("dianying","kehuan","dongzuo","aiqing","xiju","kongbu","dyjuqing","zhanzheng","jingsong","xuanyi","fanzui","qihuan","maoxian","jilupian","lunli","xiangganglunli","hanguolunli","ribenlunli","oumeilunli");
       $w7k= array("","动作","喜剧","爱情","科幻","恐怖","剧情","战争","动画","纪录","微电影");
       $w8k= array("","kehuanpian","dongzuopian ","xijupian","aiqingpian","kongbupian","zhanzhengpian","jilupian","donghuapian");
       $tk= array("www.zcgs668.com","www.okdytt.net","cqzjt.com","www.shuajuba.com","www.eninepump.com","www.96dy.com","www.0724web.com");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $a = $_GET['a']?$_GET['a']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $kw=k_w($w);
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
       $w4nk = $w4k[$w];
       $w5nk = $w5k[$w];
       $w6nk = $w6k[$w];
       $w7nk = $w7k[$w];
       $w8nk = $w8k[$w];
     if($t=='1') $wnk=$w6nk;else if($t=='10') $wnk=$w3nk;else if($t=='3'||$t=='6'||$t=='0') $wnk=$w4nk;else if($t=='2'||$t=='4') $wnk=k_w($w7nk);
else if($t=='61') $wnk=$w8nk;else $wnk=$w1nk;
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
       $ii=$i+1;
if( $t==1) {
       $ul = 'http://'.$tnk.'/'.$wnk.'/page-'.$i.'/';
       $ut = m_v($ul);
}else if( $t==2||$t==4) {
       $ul = 'http://'.$tnk.'/vodshow/1--time-'.$wnk.'-----'.$i.'---.html';
       $ut = m_v($ul);
}else if( $t==5) {
       $ul = 'http://'.$tnk.'/vodshow/'.$wnk.'--time------'.$i.'---.html';
       $ut = m_v($ul);
}else if( $t==0) {
       $ul = 'http://'.$tnk.'/index.php?s=home-vod-type-id-'.$wnk.'-mcid--area--year--letter--order--picm-1-p-'.$i.'';
       $ut = m_v($ul);
}else if( $t==6) {
       $ul = 'http://'.$tnk.'/index.php?s=vod-type-id-'.$wnk.'-mcid--lz--area--year--letter--order-addtime-picm-1-p-'.$i.'.html';
       $ut = m_v($ul);
}else if( $t==3) {
       $ul = 'http://'.$tnk.'/vodshow/'.$wnk.'-'.$i.'.html';
       $ut = m_v($ul);
}else {
       //$ul = 'http://'.$tnk.'/vod-type-id-'.$wnk.'-pg-'.$i.'.html';
       $ul = 'http://'.$tnk.'/?m=vod-type-id-'.$wnk.'-pg-'.$i.'.html';
       $ut = m_v($ul);
}
if($t==10) {
preg_match_all("|<a(.*)href=\"(.*)detail-id-([^>]+).html\"(.*)>([^>]+)<\/a>(.*)|ismU",$ut,$d);
}else if($t==5){
preg_match_all("|<a(.*)href=\"(.*)/detail([^>]+).html\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}else if($t==3){
preg_match_all("|<a(.*)href=\"(.*)/vod/([^>]+).html\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}else if($t==1){
preg_match_all("|<a(.*)href=\"(.*)movie_([^>]+)\/\"(.*)title=\"([^>]+)\"(.*)><img|ismU",$ut,$d);
}else if($t==4){
preg_match_all("|<a(.*)href=\"(.*)/vodplay\/([^>]+)-1-1.html\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}else if($t==2){
preg_match_all("|<a(.*)href=\"(.*)/voddetail\/([^>]+).html\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}else if($t==6){
preg_match_all("|<a(.*)href=\"(.*)/video\/([^>]+).html\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}else {
preg_match_all('|<h5(.*)class="text-overflow">(.*)<a href="([^>]+)"(.*)title="([^>]+)">([^>]+)</a>(.*)</h5>|ismU',$ut,$d);
}
foreach ($d[2] as $k=>$v){	
       $a2 = $d[3][$k];
       $a3 = m_u($d[5][$k]);
   if($t==1||$t==21) {
       $ud = 'http://'.$tnk.'/movie_'.$a2.'/play-0-0.html';
       $xxav= xxav141;
} else if($t==10) {
       $ud = 'http://'.$tnk.'/?m=vod-play-id-'.$a2.'-src-1-num-1.html';
       $xxav= xxav;
} else if($t==0) {
       $ud = 'http://'.$tnk.''.$a2.'1-1.html';
       $xxav= xxav143;
} else if($t==6) {
       $ud = 'http://'.$tnk.'/play/'.$a2.'/0-1.html';
       $xxav= xxav142;
}else  if($t==2||$t==4) {
       $ud = 'http://'.$tnk.'/vodplay/'.$a2.'-1-1.html';
       $xxav='xxav4';
}else  if($t==3) {
       $ud = 'http://'.$tnk.'/play/'.$a2.'-1-1.html';
       $xxav='xxav41';
}else  if($t==5) {
       $ud = 'http://'.$tnk.'/play'.$a2.'-1-1.html';
       $xxav='xxav4';
}else {
       $ud = 'http://'.$tnk.'/vodplay/'.$a2.'-1-1.html';
       $xxav='xxav1';
}
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$ud.'&tnk='.$tnk.'&wnk='.$wnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x2av($url) {
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $w2k= array("50","20","21","22","26","27","28","29","31","32","42","43","44","45","50");
       $w3k= array("49","50","42","41","40","44","45","46","47","48","38","39","37","57","56","55","54","53","52","27","58","59","60","61","62","63","64","65");
       $w4k= array("26","28","29","30","34","39","60","58","41","49","69","105","106","107","108","109","110","111");
       $w5k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32");
       $w6k= array("50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90","91","92","93","94","95","96","97","98","99","100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132","133","134","135","136","137","138","139","140","141","142","143","144","145","146","147","148","149","150");
       $w6k1= array("35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90","91","92","93","94","95","96","97","98","99","100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132","133","134","135","136","137","138","139","140","141","142","143","144","145","146","147","148","149","150");
       $tk= array("www.xxhd6.com","www.yueyipao.top","www.yibendaowuma.buzz","www.gudian1.xyz","www.tqsx1.buzz");//3
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
       $w4nk = $w4k[$w];
       $w5nk = $w5k[$w];
       $w6nk = $w6k[$w];
    if($t==133||$t==11) $wnk=$w2nk;else if($t==22||$t==40) $wnk=$w3nk;else if($t==11) $wnk=$w6nk;else if($t==30||$t==14) $wnk=$w4nk;else $wnk=$w1nk;
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
   if($t==3) {
       $ul1 = 'http://'.$tnk.'/categories/'.$wnk.'/'.$i.'/';
       $ut = m_v($ul1);
} else if($t==11) {
       $ii= $i+1; 
       $ul1 = 'http://'.$tnk.'/vodtype/'.$wnk.'-'.$ii.'.html';
       $ut = m_v($ul1);
}else {
       $ul1 = 'http://'.$tnk.'/vodtype/'.$wnk.'-'.$i.'.html';
       $ut = m_v($ul1);
}
   if($t==8) {
preg_match_all("|<a(.*)href='(.*)vodplay\/([^>]+).html'(.*)title='([^>]+)'|ismU",$ut,$d);
}else if($t==3||$t==4||$t==11) {
preg_match_all('|<a(.*)href="(.*)vodplay/([^>]+).html"(.*)title="([^>]+)"(.*)>|ismU',$ut,$d);
}else if($t==0) {
preg_match_all('|<a(.*)href="(.*)vodplay/([^>]+).html"(.*)>(.*)<span>([^>]+)</span></a|ismU',$ut,$d);
}else if($t==22||$t==0||$t==7) {
preg_match_all('|<a(.*)href="(.*)vodplay/([^>]+).html(.*)"(.*)>([^>]+)</a|ismU',$ut,$d);
}else if($t==2) {
preg_match_all('|<a(.*)href="(.*)voddetail/([^>]+).html(.*)"(.*)title="([^>]+)">|ismU',$ut,$d);
}else {
preg_match_all('|<a(.*)href="(.*)voddetail/([^>]+).html(.*)"(.*)>([^>]+)</a|ismU',$ut,$d);
}
foreach ($d[1] as $k=>$v){
       $a2 = $d[3][$k];
   if($t==3||$t==4||$t==10||$t==11||$t==12||$t==13) {
       $a3 = m_u($d[5][$k]);
} else {
       $a3 = m_u($d[6][$k]);
}
   if($t==21||$t==2) {
       $a4 = 'http://'.$tnk.'/vodplay/'.$a2.'-2-1.html'; 
}else if($t==1||$t==14) {
       $a4 = 'http://'.$tnk.'/vodplay/'.$a2.'-1-1.html'; 
}else {
       $a4 = 'http://'.$tnk.'/vodplay/'.$a2.'.html'; 
}           
       $xxav='';
  if($t=="0"||$t=="22") $xxav='xxav20';else if($t=="4"||$t=="11") $xxav='xxav4';else $xxav='xxav2';
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$a4.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x3av($url) {
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"
,"32","33","34","35","36","37");
       $w2k= array("16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38");
       $w3k= array("1","2","3","4","5","6","7","8","9","10","11","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31");
       $w42k= array("6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"
,"32","33","34","35","36","37");
       $w5k= array("50","51","52","53","54","55","56","57","58","178","179","180","181","181","182","183","184","185","186","3187","188","189","190","191","192");
       $w4k= array("33","34","35","36","37","38","39","40","60","61","62","63","64","65","66","67","68","69","70","71"
,"72","73","74","75","76","77");
       $tk= array("ygyg1.com","www.99rgg.com","jjyingshi.info","mitaoav2019.info","xgjp.info","www.wmzq.casa/cn/home/web");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $a = $_GET['a']?$_GET['a']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $kw=k_w($w);
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
       $w4nk = $w4k[$w];
       $w5nk = $w5k[$w];
    if($t==10) $wnk=$w3nk;else if($t==2) $wnk=$w5nk;else if($t==3) $wnk=$w4nk;else $wnk=$w1nk;
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
if($t==1) {
       $ul= 'http://'.$tnk.'/?s=vod/type/'.$wnk.'/'.$i.'.html';
       $ut =m_v($ul);
} else if($t==13||$t==0) {
       $ul= 'http://'.$tnk.'/vod/type/id/'.$wnk.'/page/'.$i.'.html';
       $ut =m_v($ul);
} else if( $t==2||$t==3||$t==4 ) {
       $ul= 'http://'.$tnk.'/index.php/vod/type/id/'.$wnk.'/page/'.$i.'.html';
       $ut =m_v($ul);
} else {
       $ul= 'http://'.$tnk.'/?s=vod/type/'.$wnk.'/'.$i.'.html';
       $ut =m_v($ul);
}
if($t==0||$t==1||$t==2||$t==3) {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html(.*)\"(.*)title=\"([^>]+)\"|ismU",$ut,$d);
}else if($t==21||$t==8) {
preg_match_all("|<a(.*)href=\"(.*)view\/id\/([^>]+).html\"(.*)>(.*)<p>([^>]+)<\/p>|ismU",$ut,$d);
}else if($t==6) {
preg_match_all("|<a(.*)href=\"(.*)view\/id\/([^>]+).html\">(.*)<h4(.*)>([^>]+)<\/h|ismU",$ut,$d);
}else if($t==7) {
preg_match_all("|<a(.*)href=\"(.*)view\/id\/([^>]+).html\"(.*)>(.*)([^>]+)<\/a|ismU",$ut,$d);
}else if($t==4) {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html(.*)\"(.*)title=\"([^>]+)\"(.*)>(.*)</a|ismU",$ut,$d);
}else {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html\">(.*)<div class=\"video-list-title-bottom(.*)\">([^>]+)<\/div>|ismU",$ut,$d);
}
foreach ($d[3] as $k=>$v){
       $a2 = $d[3][$k];
       $a3 = m_u($d[6][$k]);
   if( $t==222||$t==0||$t==1||$t==22) {
       $a4 = 'http://'.$tnk.'/vod/play/id/'.$a2.'/sid/1/nid/1.html';
       $xxav= 'xxav70';
} else if($t==3||$t==2) {
       $a4 = 'http://'.$tnk.'/index.php/vod/play/id/'.$a2.'/sid/1/nid/1.html';
       $xxav= 'xxav4';
} else {
       $a4 = 'http://'.$tnk.'/?s=vod/view/id/'.$a2.'.html';
       $xxav='xxav3';
}
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$a4.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}
}
function x4av($url) {
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69");
       $w2k= array("20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39");
       $w3k= array("4","5","6","7","8","9","11","12","13","14","15","16","20");
       $w4k= array("156","171","177","1","2","14","23","25","27","30","40","39","49","50","53","55","57","59","60","61","65","67","68","80","81","83","84","85","86","93","95","97","91","92","88","120","117");
       $w5k= array("33","32","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50");
       $w6k= array("87","88","89","90","94","96","93","95","97","91","92","98","120","117","121","122");
       $w7k= array("1","2","4","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50");
       $w8k= array("60","61","62","63","64","65","66","67","68","69","70","71","72","73","74");
       $w9k= array("30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","50","51","52","53","54","55","56","57","27","21","20","16","71","86","178","179","180","181","182","183","184","185","186","187","188","189","190","191");
       $w10k= array("21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90","91","92","93","94","95","96","97","98","99","100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125");
       $w11k= array("6","7","8","9","10","11","12");
       $w12k= array("119","120","121","122","123","124","125","126","127","128","129","130","131","132","133","134","135","136","137");
       $tk= array("99kk.xyz","www.1977ss.com","nljsp.pw","qqczx1999.buzz","zxfuli.xyz","zxfuli.xyz","9kpkp.me","lwkp.site");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $kw=k_w($w);
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
       $w4nk = $w4k[$w];
       $w5nk = $w5k[$w];
       $w6nk = $w6k[$w];
       $w7nk = $w7k[$w];
       $w8nk = $w8k[$w];
       $w9nk = $w9k[$w];
       $w10nk = $w10k[$w];
       $w11nk = $w11k[$w];
       $w12nk = $w12k[$w];
if($t==40) $wnk=$w4nk;else if($t==15) $wnk=$w2nk;else if($t==14) $wnk=$w5nk;else if($t==1||$t==2) $wnk=$w7nk;else if($t==33) $wnk=$w8nk;else if($t==5) $wnk=$w9nk;else $wnk=$w1nk;
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
  if($t==222||$t==221||$t==51){
       $ul1 = 'http://'.$tnk.'/index.php/vodtype/'.$wnk.'-'.$i.'.html';
       $ut = m_s($ul1);
} else if($t==2){
       $ii =$i;
       $ul1 = 'http://'.$tnk.'/index.php/vod/search/page/'.$i.'/wd/'.$kw.'.html';
       $ut = m_v($ul1);
}else {
       $ul1 = 'http://'.$tnk.'/index.php/vod/type/id/'.$wnk.'/page/'.$i.'.html';
       $ut = m_v($ul1);
}
 if($t==61) {
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html\"(.*)>(.*)<span>([^>]+)</span></a></h3>|ismU",$ut,$d);
} else if($t==0||$t==33||$t==10||$t==5) {
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html(.*)\"(.*)>([^>]+)<\/a>|ismU",$ut,$d);
} else if($t==7){
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html\">(.*)<p(.*)>(.*)</span>([^>]+)</p>|ismU",$ut,$d);
} else if($t==2){
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html\">(.*)<p(.*)>([^>]+)</p>|ismU",$ut,$d);
} else if($t==510){
preg_match_all("|<a(.*)href='(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html'(.*)>(.*)<img(.*)alt='([^>]+)'|ismU",$ut,$d);
} else if($t==222){
preg_match_all("|<a(.*)href=\"(.*)\/vodplay\/([^>]+)\-1\-1.html\"(.*)>(.*)<span class=\"title\">([^>]+)<|ismU",$ut,$d);
}  else if($t==101){
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html\"(.*)></a>(.*)</p>(.*)<p>([^>]+)</p>|ismU",$ut,$d);
} else if($t==5){
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html(.*)\"(.*)title=\"([^>]+)\"(.*)>(.*)<\/a><|ismU",$ut,$d);
} else if($t==48){
preg_match_all("|<a(.*)href=\"(.*)play\/id\/([^>]+)\/sid\/1\/nid\/1.html(.*)\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
} else if($t==16){
preg_match_all("|<a(.*)href=(.*)play\/id\/([^>]+)\/sid\/1\/nid\/([^>]+).html(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
} else if($t==33||$t==17) {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html\">(.*)<img(.*)alt=\"([^>]+)\"|ismU",$ut,$d);
} else if($t==6||$t==23) {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html(.*)\"(.*)>([^>]+)</a|ismU",$ut,$d);
} else if($t==9||$t==11||$t==4||$t==18){
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html(.*)\"(.*)title=\"([^>]+)\"(.*)>([^>]+)</a><|ismU",$ut,$d);
} else if($t==30||$t==1){
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html\"(.*)>(.*)<img(.*)alt=\"([^>]+)\"|ismU",$ut,$d);
} else {
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html(.*)\"(.*)title=\"([^>]+)\"(.*)>|ismU",$ut,$d);
}
foreach ($d[3] as $k=>$v){
       $a2 = $d[3][$k];
 if($t==0||$t==7||$t==211||$t==1) {
       $a3 = m_u($d[7][$k]);
}else {
       $a3 = m_u($d[6][$k]);}
  if($t==7||$t==0||$t==3||$t==4||$t==5||$t==11||$t==14||$t==21||$t==16||$t==17||$t==1||$t==6||$t==2){ 
       $xxav= 'xxav4';
       $ud = 'http://'.$tnk.'/index.php/vod/play/id/'.$a2.'/sid/1/nid/1.html';
}else { 
       $xxav= 'xxav2';
       $ud = 'http://'.$tnk.'/index.php/vod/play/id/'.$a2.'/sid/1/nid/1.html';
}
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$ud.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x5av($url) {
       $wk= array("1","2","3","4","5","6","7","8","9","10","11","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60");
       $tk= array("5altrf.com:35981","www.paaqnn.cn","3","4");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
       $ul = 'https://'.$tnk.'/index.php?c1=1&c2='.$wnk.'&search=&page='.$i.'';
       $ut = m_v($ul);
preg_match_all('|<dd><a(.*)href="(.*)show.php?id=([^>]+)&p=1"(.*)><h3>([^>]+)</h3></a>|ismU',$ut,$d);
foreach ($d[2] as $k=>$v){
       $a2 = $d[3][$k];
       $a3 = m_u($d[5][$k]);
       $ud = 'https://'.$tnk.'/show.php?id='.$a2.'&b';
    $xml ='<a href="'.$fname.'?&xxav5='.$ud.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x6av($url) {
       $w1k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $w2k= array("35","36","37","38","39","40","41","42");
       $tk= array("www.chaopen.top","hengha.pw","www.qingshow.top","www.qiucao3.xyz","www.seyizi.top","www.51avsq.buzz","hengha.pw");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
    if($t==31) $wnk=$w2nk;else $wnk=$w1nk;
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
   if($t==111) {
       $ul1 = 'http://'.$tnk.'/video_list/'.$wnk.'/'.$i.'/index.html';
       $ut = m_s($ul1);
} else {
       $ul1 = 'http://'.$tnk.'/video_list/'.$wnk.'/'.$i.'/index.html';
       $ut = m_v($ul1);
}
if ($t==4) {
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html"(.*)>(.*)<a href="javascript(.*)" title="([^>]+)">|ismU',$ut,$d);
}else if ($t==0) {
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html">(.*)<p>(.*)</i>([^>]+)</p>|ismU',$ut,$d);
}else if ($t==31) {
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html">(.*)<div(.*)class="movie-title-1">([^>]+)</div>|ismU',$ut,$d);
}else if ($t==5){
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html"(.*)>(.*)<img(.*)title="([^>]+)"|ismU',$ut,$d);
}else if ($t==7||$t==2){
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html(.*)"(.*)>([^>]+)</a><|ismU',$ut,$d);
}else {
preg_match_all('|<a(.*)href="(.*)video_detail/([^>]+)/'.$wnk.'/index.html(.*)"(.*)title="([^>]+)"(.*)>(.*)<img(.*)alt=|ismU',$ut,$d);
}
foreach ($d[1] as $k=>$v){
       $a2 = $d[3][$k];
if ($t==4||$t==5) {
       $a3 = m_u($d[7][$k]);
}else  {
       $a3 = m_u($d[6][$k]);
}
       $ud = 'http://'.$tnk.'/video_conter/'.$a2.'/'.$wnk.'/index.html';
/*if ($t==11) {
       $ud = 'http://'.$tnk.'/video_detail/'.$a2.'/1/index.html';
}else if ($t==0||$t==1||$t==2||$t==3||$t==4||$t==5||$t==6||$t==7) {
       $ud = 'http://'.$tnk.'/video_conter/'.$a2.'/'.$wnk.'/index.html';
}else {
       $ud = 'http://'.$tnk.'/video_conter/'.$a2.'/1/index.html';
}*/
    $xml ='<a href="'.$fname.'?&xxav61='.$ud.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x7av($url) {
       $wk= array("guochan","rbhs","rihan","nysp","meiguo","tongxing","xiangjiao");
       $w2k= array("lang/chinese","lang/japanese","c/Mature-38","pornstars-index","best/2020-12","c/Black_Woman-30","index/china","xiangjiao");
       $w1k= array("1","2","3","4","5","6","7","8","9","10");
       $tk= array("www.715886.com","xv.98es.xyz","info.xvideos.com");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
   if($t==1) {
       $ul1 = 'http://'.$tnk.'/'.$wnk.'/'.$i;
       //$ul2 = 'http://'.$tnk.'/channels-'.$wnk.'/'.$i;
       $ut = m_s($ul1);
} else {
       $ul1 = 'http://'.$tnk.'/'.$wnk.'/page_'.$i.'.html';
       $ut = m_v($ul1);
}
if ($t==1) {
preg_match_all('|<a(.*)href="(.*)video([^>]+)"(.*)title="([^>]+)"(.*)>([^>]+)</a></p>|ismU',$ut,$d);
}else {
preg_match_all('|<a(.*)href="(.*)/'.$wnk.'/([^>]+).html"(.*)>([^>]+)</a></h2>|ismU',$ut,$d);
}
foreach ($d[1] as $k=>$v){
       $a2 = $d[3][$k];
if ($t==1) {
       $a4 = 'https://'.$tnk.'/video'.$a2.'';
}else {
       $a4 = 'http://'.$tnk.'/'.$wnk.'/'.$a2.'.html';
}
       $a3 = m_u($d[5][$k]);
    $xml ='<a href="'.$fname.'?&xxav7='.$a4.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x8av($url) {
       $w1k= array("1","2","3","4","5","6","7","8");
       $w2k= array("35","36","37","38","39","40","41","42");
       $w3k= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50");
       $tk= array("www.hzscwj.com","www.52iav.com","www.av982.com","www.hzscwj.com","www.av982.com","272xb.com");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $tnk = $tk[$t];
       $wnk = '';
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
       $w3nk = $w3k[$w];
    if($t==0||$t==3) $wnk=$w2nk;else $wnk=$w3nk;
    for($i=1;$i<=$p;$i++){
if($t==111) {
     if($i<2) $pp='';else $pp='-'.$i;
       $ul1 = 'http://'.$tnk.'/list/index'.$wnk.$pp.'.html';
       $ut = m_s($ul1);
}else if($t==10) {
     if($i<2) $pp='';else $pp='-'.$i;
       $ul1 = 'http://'.$tnk.'/channel/index'.$wnk.$pp.'.html';
       $ut = m_v($ul1);
}else {
     if($i<2) $pp='';else $pp='_'.$i;
       $ul1 = 'http://'.$tnk.'/list/index'.$wnk.$pp.'.html';
       $ut = m_v($ul1);
}
  if($t==1||$t==2 ||$t==5) {
preg_match_all("|<a(.*)href=\"(.*)video\/([^>]+).html(.*)\"(.*)>(.*)<h3>([^>]+)<\/h3>(.*)<\/a>|ismU",$ut,$d);
} else {
preg_match_all("|<a(.*)href=\"(.*)index([^>]+).html\"(.*)>(.*)<h3>([^>]+)<\/h3>(.*)<\/a>|ismU",$ut,$d);
}
foreach ($d[3] as $k=>$v){
       $a2 = $d[3][$k];
  if($t==1||$t==2||$t==5) {
       $a3 = m_u($d[7][$k]);
}else 
       $a3 = m_u($d[6][$k]);
  if($t==10) {
       $xxav= 'xxav80';
} else if($t==3||$t==0) {
       $xxav= 'xxav9';
} else {
       $xxav= 'xxav8';
}
       //$ud = 'http://'.$tnk.'/player/index'.$a2.'.html';
    $xml ='<a href="'.$fname.'?&'.$xxav.'='.$a2.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x9av($url) {
       $wk= array("35","36","37","38","39","40","41","42");
       $tk= array("www.hzscwj.com","189bks.com","www.hbdcsm.com","www.52iav.com","www.av982.com","272xb.com");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
   if($t==111) {
     if($i<2) $pp='';else $pp='_'.$i;
       $ul1 = 'http://'.$tnk.'/list/index'.$wnk.$pp.'.html';
       $ut = m_s($ul1);
} else {
     if($i<2) $pp='';else $pp='_'.$i;
       $ul1 = 'http://'.$tnk.'/list/index'.$wnk.$pp.'.html';
       $ut = m_v($ul1);
}
preg_match_all("|<li><a href=\"\/([^>]+)\/index([^>]+).html\" target=\"_blank\">(.*)<h3>([^>]+)<\/h3>(.*)<\/a><\/li>|ismU",$ut,$d);
foreach ($d[2] as $k=>$v){
       $a2 = $d[2][$k];
       $a3 = m_u($d[4][$k]);
       //$ud = 'http://'.$tnk.'/video/'.$a2.'.html';
    $xml ='<a href="'.$fname.'?&xxav9='.$a2.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function x10av($url) {//x
       $w1k= array("tags/914","categories/full91","categories/chinesehomemadevideo","categories/57a2994fc77619ad9790198945927a9e","categories/55687e2a4de24bc18521f63f241a9bcb","categories/339f173950ac8da7eddf3a6c708b1088","categories/982955abe0b04690c242a5f372f0cf9e","categories/ad17e1c0cb979ccff684d70300171938","categories/df3e7ba7241a8a01f0c771211903b207","categories/b256840c93aa20916870055de9489a68","categories/d2d73e7a2257e28b0573a76ca6a94a02");
       $w2k= array("latest-updates","top-rated","categories/390e6a5d67423d91d7f7bd1642db5e7b","categories/c8dd6eef911c4dcb4e3c8c20c4a13cdf","categories/265bf8ab0e0507b1f769720fbd07987e","categories/68d1e8dcdaf8ebd5c4fe96ee5b6a9a6c","categories/2ecc21991dfdbe500adc4747d58ca8bd","categories/a811059acb87998a9a5f1c81b4734bb0","categories/73d4bfed3fcf5ea19aea2be948163b46","categories/49ccc25ccd43331cc4b3d841ed3d4022","categories/56fa775522cbd42ee5c5ecf2f64e5046","categories/bad70c0f59d0a3a5c58f8b5f6858b9d0","categories/cdd610c35ff9e81ddd7af9f086fecc0e","categories/db0fba34160586d9ee4a7303f9b0abd4","categories/615c9adfda33dda95f9e0023c2efce3e");
       $tk= array("https://91zz7.vip","http://www.xiaobi035.com");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $tnk = $tk[$t];
       $w1nk = $w1k[$w];
       $w2nk = $w2k[$w];
  if($t==1) $wnk=$w2nk;else $wnk=$w1nk;
    for($i=1;$i<=$p;$i++){
       $ul = ''.$tnk.'/'.$wnk.'/'.$i.'/';
       $ut = m_v($ul);
preg_match_all('|<div class="item  ">(.*)<a href="'.$tnk.'/videos/([^>]+)/([^>]+)/"(.*)title="([^>]+)" >|ismU',$ut,$d);
foreach ($d[3] as $k=>$v){
       $a1 = $d[2][$k];
       $a2 = m_u($d[5][$k]);
       $a4 = ''.$tnk.'/embed/'.$a1;
   $xml ='<a href="'.$a4.'" target="b" >'.$a2.'</a>';
    //$xml ='<a href="'.$fname.'?&xxav10='.$a1.'&tnk='.$tnk.'"  target="b">'.$a2.'</a>';
echo $xml;
}}}
function x11av($url) {//x
set_time_limit(0);
       $wk= array("26","31","21","25","28","29","22","23","39","35","34","44","42","45","38");
       $tk= array("www.mitaoshipinapp.com","xxxxdyw261.vip");
       $w = $_GET['w']?$_GET['w']:"0"; 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1; 
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $tnk = $tk[$t];
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
  if( $t==111) {
       $ul='http://'.$tnk.'/vod/type/id/'.$wnk.'/page/'.$i.'.html';
       $ut = m_s($ul);
} else {
       $ul='http://'.$tnk.'/vod/type/id/'.$wnk.'/page/'.$i.'.html';
       $ut = m_v($ul);
}
preg_match_all("|<a(.*)href=\"(.*)detail\/id\/([^>]+).html\"(.*)>([^>]+)<\/a>|ismU",$ut,$d);
foreach($d[3] as $k=>$v){
       $a2 = $d[3][$k];
       $a3 = 'https://'.$tnk.'/vod/play/id/'.$a2.'/sid/1/nid/1.html';
       $a5 = u_c($a3);
       $a4 = m_u($d[5][$k]);
    //$xml ='<a href="'.$a5.'" target="b" >'.$a4.'</a>';
    $xml ='<a href="'.$fname.'?&xxav11='.$a3.'&tnk='.$tnk.'" target="b">'.$a4.'</a>';
echo $xml;
}}}
function x12av($url) {
set_time_limit(0);
       $wk= array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
       $tk= array("www.gczp11.xyz","www.ycl100.xyz","www.yzxh000.xyz","m.33qqq5.com","www.ybwsg.xyz","www.sbc08.pw","www.lsw1.pw");
       $p = $_GET['p']?$_GET['p']:1; 
       $t = $_GET['t']?$_GET['t']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $w = $_GET['w']?$_GET['w']:0;
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){
  if( $t==13||$t==10) {
       $ul ='http://'.$tnk.'/?m=video_list*'.$wnk.'*'.$i.'';
       $ut = m_v($ul);
} else {
       $ul ='http://'.$tnk.'/?m=video_list*'.$wnk.'*'.$i.'';
       $ut = m_v($ul);
}
  if( $t==1||$t==2||$t==6) {
preg_match_all("|<a(.*)href=\"(.*)video_detail\*([^>]+)\*([^>]+)\"(.*)title=\"([^>]+)\"|ismU",$ut,$d);
} else  if( $t==9||$t==21){
preg_match_all('|<a(.*)href="(.*)video_detail([^>]+)"(.*)>([^>]+)</a|ismU',$ut,$d);
} else  if( $t==7){
preg_match_all('|<a(.*)href="(.*)video_detail([^>]+)"(.*)>(.*)<font(.*)>([^>]+)"</font>|ismU',$ut,$d);
} else  if( $t==0){
preg_match_all('|<a(.*)href="(.*)video_detail([^>]+)"(.*)target="_blank">([^>]+)</a|ismU',$ut,$d);
} else if( $t==21||$t==6){
preg_match_all('|<a(.*)href="(.*)video_detail([^>]+)"(.*)>(.*)<h3(.*)>([^>]+)</h3|ismU',$ut,$d);
} else {
preg_match_all('|<a(.*)href="(.*)video_detail([^>]+)"(.*)title="([^>]+)"(.*)>(.*)</a><|ismU',$ut,$d);
}
foreach($d[1] as $k=>$v){
       $a2 = $d[3][$k];
       $a5 = $d[4][$k];
  if( $t==1||$t==2||$t==6) {
       $a3 = m_u($d[6][$k]);
       $a4 = 'http://'.$tnk.'/?m=video_conter*'.$a2.'*'.$a5.'';
} else {
       $a3 = m_u($d[5][$k]);
       $a4 = 'http://'.$tnk.'/?m=video_conter'.$a2;
}

    $xml ='<a href="'.$fname.'?&xxav13='.$a4.'&u='.$u.'&tnk='.$tnk.'"  target="b">'.$a3.'</a>';
echo $xml;
}}}
function xav($url) {
       $ul = $_GET['ks_tv'];
       $ul2 = 'https://live.kuaishou.com/u/zhj1196668974';
preg_match('|"caption":"([^>]+)","playUrls":(.*),"coverUrl"|',m_v($ul2),$d);
       //$w = $_GET['w']?$_GET['w']:$url;
       $nt = $d[2];
preg_match('|"quality":"high","url":"([^>]+)"|U',$nt,$d2);
       $nt2 = $d2[1];
       $ua = str_replace('\u002F', '/', $nt2);
       $ud = '../d.htm?u=&f='.$ua;
//echo $ua;
echo header("Location:".$ud );
}
if(isset ($_GET['s'])) {
       $xml = "";
       $s = $_GET['s']?$_GET['s']:"cntv";
       $xml= $s($xml);
echo $xml;
 }
elseif(isset ($_GET['cctvcid'])){
       $w = $_GET['cctvcid'];
       $year = date("Y");
       $mouth = date("m");
       $day = date("d")+1-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $stn = $year.$mouth.$nday;
       $t = $_GET['t']?$_GET['t']:$stn;
       $a = $_GET['a']?$_GET['a']:"0";
       $ul2 ='http://api.cntv.cn/epg/Epg24h?serviceId=cbox&c='.$w.'&cb=callback&t=jsonp';
       $ul1 ='http://api.cntv.cn/epg/epginfo?serviceId=tvcctv&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
       $ul3 ='http://api.cntv.cn/epg/epginfo?serviceId=shiyi&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
 preg_match("#\"program\":\[\{(.*)\}\]\}\}\);#U",m_v($ul1),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = r_u($a0["t"]);
       $st = q_w(q_g(q_m(q_k(t_t($a0["st"]-57600)))));
       $et = q_w(q_g(q_m(q_k(t_t($a0["et"]-57600)))));
       $a4 = $a0["showTime"];
       $a5 = $a0["duration"]/60;
       $a9 = m_u('分');
if($a==0) {
       //$ud = '../tv/cctvnh.htm?f=' .$w.'&st=' .$st .'&et=' .$et .'';
       $ud = '../tv/swf.htm?m=cntv&f=' .$w.'&st=' .$st .'&et=' .$et .'';
}else {
       $ud = 'http://player.cntv.cn/standard/cntvBuguLiveBackPlayer20140117.swf?videoInfoPath=http://vdn.apps.cntv.cn/api/liveback.do&channel=' .$w.'&starttime=' .$st .'&endtime=' .$et .'&url=&from=web';
}
echo header("Location: $ud");
}}
elseif(isset ($_GET['cctvcd'])){
       $w = $_GET['cctvcd'];
       $year = date("Y");
       $mouth = date("m");
       $day = date("d")+1-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $stn = $year.$mouth.$nday;
       $t = $_GET['t']?$_GET['t']:$stn;
       $a = $_GET['a']?$_GET['a']:"0";
       $ul2 ='http://api.cntv.cn/epg/Epg24h?serviceId=cbox&c='.$w.'&cb=callback&t=jsonp';
       $ul ='http://api.cntv.cn/epg/epginfo?serviceId=tvcctv&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
       $ul3 ='http://api.cntv.cn/epg/epginfo?serviceId=shiyi&c='.$w.'&d='.$t.'&cb=callback&t=jsonp';
       $ut = m_v($ul);
   preg_match_all("|\"t\":\"([^>]+)\"(.*)\"st\":([^>]+),\"et\":([^>]+),\"showTime\":\"([^>]+)\"(.*)\"duration\":([^>]+)\}|ismU",$ut,$b);
   foreach($b[1] as $k=>$v){
       $a1 = r_u($b[1][$k]);
       $st = q_w(q_g(q_m(q_k(t_t($b[3][$k]-57600)))));
       $et = q_w(q_g(q_m(q_k(t_t($b[4][$k]-57600)))));
       $a4 = $b[5][$k];
       $a5 = $b[7][$k]/60;
       $a9 = m_u('分');
if($a==0) {
       //$ud = '../tv/cctvnh.htm?f=' .$w.'&st=' .$st .'&et=' .$et .'';
       $ud = '../tv/swf.htm?m=cntv&f=' .$w.'&st=' .$st .'&et=' .$et .'';
}else {
       $ud = 'http://player.cntv.cn/standard/cntvBuguLiveBackPlayer20140117.swf?videoInfoPath=http://vdn.apps.cntv.cn/api/liveback.do&channel=' .$w.'&starttime=' .$st .'&endtime=' .$et .'&url=&from=web';
}
echo header("Location: $ud");
}}
elseif(isset ($_GET['haoqtv'])){
       $w = $_GET['haoqtv'];
       $name = $_GET['name'];
       $ut = m_v($w);
preg_match_all('|<li data-player="([^>]+)"(.*)class="(.*)">(.*)<span class="s">([^>]+)</span></li>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = m_u($d[5][$k]);
       $a4 = 'http://www.haoqu.net/e/extend/tv.php?id='.$a2;
       $a5 = hao_q( $a4 );
echo header("Location: $a5");
    //$xml ='<a href="'.$a5.'"  target="b" >'.m_u($name).' ('.$a3.')</a>';
//echo $xml;
}}
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
       $ud = f_ud(f_ht($ua));
echo header("Location: $ud");
}}
elseif(isset ($_GET['hmg_tv'])){
       $w = $_GET['hmg_tv'];
       $a = $_GET['a'];
       $a5 = 'http://mpp.liveapi.mgtv.com/v1/epg/turnplay/getLivePlayUrlMPP?version=PCweb_1.0&platform=4&buss_id=2000001&channel_id='.$w;
       $ut = file_get_contents($a5);
       $aa=J_d($ut,ture);
       $a1 = $aa["data"]["url"];
       $ua =$a1.'&.m3u8';
       //$ud= f_t($ua);
if($a==4) { 
       $ud = f_h5($ua);
}else {
if(a==0){
       $ud = f_kd($ua);
}else {
       $ud = 'http://player.hunantv.com/mgtv_v5_live/live.swf?activity_id='.$a1.'&channel_id='.$a1;
}}
echo header("Location: $ud");
}
elseif(isset ($_GET['gsxtv'])){
       $w = $_GET['gsxtv'];
       $content=m_v('http://xzglwx.gandongyun.com/xz_video/video/getVideoUrl?videoId='.$w);
       $json=json_decode($content,true);
       $id = $json["playUrl"];
       $ud= f_d($id);
echo header("Location: $ud");
}
elseif(isset ($_GET['zgzbid'])){
       $a8 = $_GET['zgzbid'];
       $name = $_GET['name'];
       $ut = m_v($a8);
       $nt = J_d($ut,true);
       $d1 = $nt["data"]["liveUrl"];
if(strpos($d1,'p2p') !== false){ } else if(strlen( $d1 )>25 ){} else{
       $d2 = m_u($nt["liveTitle"]);
       $d12 = 'https://gccncc.v.wscdns.com/gc/'.$d1.'_1/index.m3u8';
       $d13 = 'https://gcalic.v.myalicdn.com/gc/'.$d1.'_1/index.m3u8';
       $ud= f_d($d12);
echo header("Location: $ud");
    //$xml =' <a href="'.$ud.'" target="b" >'.$d14.'</a>';
//echo $ut;
}}
elseif(isset ($_GET['nowtvid'])){
       $url = $_GET['url'];
       $a4 = $_GET['nowtvid'];
       $a8 ='https://now.qq.com/cgi-bin/now/web/room/get_live_room_url?room_id='.$a4.'&is_sub_room=0&platform=2&playtype=3&bkn=&_=0.04899073286333899';
       $nt=J_d(m_v($a8),true);
       $aa1 = $nt["result"]["raw_hls_url"];
       $aa2 = $nt["result"]["raw_rtmp_url"];
       $aa3 = $nt["result"]["raw_flv_url"];
       $aa4 = $nt["result"]["pure_voice_flv"];
       $aa5 = $nt["result"]["pure_voice_rtmp"];
       $ud= f_t($aa3);
echo header("Location: $ud");
}
elseif(isset ($_GET['yytvid'])){
       $a8 = $_GET['yytvid'];
       $a9 = $_GET['yytvcid'];
       $ut = 'https://stream-manager.yy.com/v3/channel/streams?uid=0&cid='.$yytvcid.'&sid='.$yytvid.'&sequence=1602408888779&encode=json';
       $nt=J_d(J_e(m_v($ut)));
preg_match("|\"cdn_info\":\{\"provider_id\":([^>]+),\"url_id\":([^>]+),\"url\":\"([^>]+)\"}|ismU",$nt,$d2);
       $aa1 = $d2[3];
       $ud= f_t($aa1);
echo $nt;
//echo header("Location: $ud");
}
elseif(isset ($_GET['biliid'])){
       $a1 = $_GET['biliid'];
       $nt1 = 'https://api.live.bilibili.com/room/v1/Room/playUrl?cid='.$a1.'&otype=json&quality=0&platform=h5';
       $nt2 = 'https://api.live.bilibili.com/room/v1/Room/playUrl?cid='.$a1.'&quality=0&platform=web';
       $nt3 = 'https://api.live.bilibili.com/xlive/web-room/v1/playUrl/playUrl?cid='.$a1.'&platform=pd';
       $ut2 = J_d(m_v($nt3),True);
       $aaa = $ut2["data"]["durl"];
       $aa0 = $aaa[2];
       $ua1 = x_g($aa0["url"]);
 if(is_mobile()) { $ud = '../w.htm?&f='.u_e($ua1);
}else $ud = f_w(u_e($ua1));
echo header("Location: $ud");
}
elseif(isset ($_GET['biliid2'])){
       $aid = $_GET['biliid2'];
 $url = "http://api.live.bilibili.com/xlive/web-room/v2/index/getRoomPlayInfo?room_id=".$aid."&protocol=0,1&format=0,1,2&codec=0,1&&platform=web&ptype=8";
       $file = m_v($url);
       $at = json_decode($file,true);
       $aa = $at["data"]["playurl_info"]["playurl"]["stream"];
       $count_json = count($aa);
       $a0 = $aa[1];
       $a1 = $a0["format"];
       $countn = count($a1);
       $aa0 = $a1[0];
       $aa1 = $aa0["codec"];
       $count = count($aa1);
       $aaa0 = $aa1[0];
       $aaa1 = x_g($aaa0["base_url"]);
       $aaa2 = $aaa0["url_info"];
       $count = count($aaa2);
       $aaaa0 = $aaa2[0]["host"];
       $ua = $aaaa0.$aaa1 ;
       $ud = f_w(u_e($ua));
echo header("Location: $ud");
//echo $ua;
}
elseif(isset ($_GET['ttzbid'])){
      $at= $_GET['ttzbid'];
       $ut = 'https://live.ixigua.com/'.$at.'/';
      $a= $_GET['a'];
    if($a=="4"){
preg_match('|"HlsUrl":"([^>]+)"|ismU',m_v($ut),$d2);
       $a11 = $d2[1];
       $ua = r_u($a11);
       $ud = f_kd($ua);
    }else if( $a=="3") {
preg_match('|"HlsUrl":"([^>]+)"|ismU',m_v($ut),$d2);
       $a11 = $d2[1];
       $ua = r_u($a11);
       $ud = f_kd($ua);
}else {
preg_match('|"FlvUrl":"([^>]+)"|ismU',m_v($ut),$d2);
       $a11 = $d2[1];
       $ua = r_u($a11);
       $ud = f_kd($ua);
}
echo header("Location: $ud");
}
elseif(isset ($_GET['zburl'])){
       $ul = $_GET['zburl'];
   if(stripos($ul,'yts') !== false) {
  preg_match_all("#<li class=\"\" guid=\"\"> <a href=\"http:\/\/www.livechina.com\/([^>]+)\/([^>]+)\">([^>]+)<\/a>#ismU",m_v($ul),$d);
  foreach($d[1] as $k=>$v){
       $a3 =$d[1][$k];
       $a4 =$d[2][$k];
   if(stripos($a4,'01') !== false) { 
       $a5 = $a3.'hsx';
}else if(stripos($a4,'02') !== false) { 
       $a5 = $a3.'xzg';
}else if(stripos($a4,'03') !== false) { 
       $a5 = $a3.'bjy';
}else if(stripos($a4,'04') !== false) { 
       $a5 = $a3.'zyf';
}else {
       $a5 = $a3.'hsx';
}
       $a7 =m_u($d[3][$k]);
if(is_mobile()){
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1/index.m3u8';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}else {
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1.flv';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}
       $ud = f_kd($a8);
 //echo header("Location: $ud");
     $xml ='<a href="'.$ud.'" target="b" >'.$a7.' </a>';
echo $xml;
 }}else if(stripos($ul,'lijiang') !== false) {
  preg_match_all("#<li class=\"\" guid=\"\"> <a href=\"http:\/\/www.livechina.com\/([^>]+)\/([^>]+)\">([^>]+)<\/a>#ismU",m_v($ul),$d);
  foreach($d[1] as $k=>$v){
       $a3 =$d[1][$k];
       $a4 =$d[2][$k];
   if(stripos($a4,'01') !== false) { 
       $a5 = 'ljgc'.'szsnkgc';
}else if(stripos($a4,'02') !== false) { 
       $a5 = 'ljgc'.'wglytylxs';
}else if(stripos($a4,'03') !== false) {
       $a5 = 'ljgc'.'dyhxgjt';
}else if(stripos($a4,'04') !== false) { 
       $a5 = 'ljgc'.'dsc';
}else {
       $a5 = 'ljgc'.'szsnkgc';
}
       $a7 =m_u($d[3][$k]);
if(is_mobile()){
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1/index.m3u8';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}else {
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1.flv';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}
       $ud = f_kd($a8);
 //echo header("Location: $ud");
     $xml ='<a href="'.$ud.'" target="b" >'.$a7.' </a>';
echo $xml;
 }}else if(stripos($ul,'yixian') !== false) {
  preg_match_all("#<li class=\"\" guid=\"\"> <a href=\"http:\/\/www.livechina.com\/([^>]+)\/([^>]+)\">([^>]+)<\/a>#ismU",m_v($ul),$d);
  foreach($d[1] as $k=>$v){
       $a3 =$d[1][$k];
       $a4 =$d[2][$k];
   if(stripos($a4,'01') !== false) { 
       $a5 = 'yx'.'lcyt';
}else if(stripos($a4,'02') !== false) { 
       $a5 = 'yx'.'hcyz';
}else {
       $a5 = 'yx'.'lcyt';
}
       $a7 =m_u($d[3][$k]);
if(is_mobile()){
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1/index.m3u8';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}else {
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1.flv';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}
       $ud = f_kd($a8);
 //echo header("Location: $ud");
     $xml ='<a href="'.$ud.'" target="b" >'.$a7.' </a>';
echo $xml;
 }}else if(stripos($ul,'jiayuguan') !== false) {
  preg_match_all('#<li(.*)guid="([^>]+)">(.*)<a(.*)href="([^>]+)">([^>]+)</a>#ismU',m_v("http://greatwall.ipanda.com/jiayuguan/index.shtml"),$d);
  foreach($d[1] as $k=>$v){
       $a5 =$d[2][$k];
       $a6 =$d[5][$k];
       $a7 =m_u($d[6][$k]);
if(is_mobile()){
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1/index.m3u8';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}else {
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1.flv';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}
       $ud = f_kd($a8);
 //echo header("Location: $ud");
     $xml ='<a href="'.$ud.'" target="b" >'.$a7.' </a>';
echo $xml;
 }}


 else {
  preg_match_all('#<li(.*)guid="([^>]+)">(.*)<a(.*)href="([^>]+)">([^>]+)</a>#ismU',m_v($ul),$d);
  foreach($d[1] as $k=>$v){
       $a5 =$d[2][$k];
       $a6 =$d[5][$k];
       $a7 =m_u($d[6][$k]);
if(is_mobile()){
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1/index.m3u8';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}else {
       //$a8 ='http://gccncc.v.wscdns.com/gc/'.$a5.'_1.flv';
       $a8 ='http://gcksc.v.kcdnvip.com/gc/'.$a5.'_1/index.m3u8';
}

       $ud = f_kd($a8);
 //echo header("Location: $ud");
     $xml ='<a href="'.$ud.'" target="b" >'.$a7.' </a>';
echo $xml;
}}}
elseif(isset ($_GET['wx_tv'])){
set_time_limit(0);
       $ul = $_GET['wx_tv'];
preg_match('|"token":"([^>]+)"(.*)"flv":"([^>]+)"|U',m_v($ul),$d);
       $a8 = x_g($d[3]);
       $ud = '../t.htm?u=0&f='.$a8; 
 echo header("Location: $ud"); 
}
elseif(isset ($_GET['v6_tv'])){
set_time_limit(0);
       $ul = $_GET['v6_tv'];
       $ul1 = 'https://v.6.cn/'.$ul;
       $ul2 = 'https://rio.6rooms.com/live/?s='.$ul;
preg_match('|<hip>([^>]+)</hip>|U',m_v($ul2),$d2);
       $a7 = $d2[1];
preg_match('|"flvtitle":"([^>]+)"(.*)"liveMode"|U',m_v($ul1),$d1);
       $a8 = $d1[1];
       //$a9 = 'https://'.$a7.'/httpflv/'.$a8.'.flv';  
       $a9 = 'https://'.$a7.'/'.$a8.'/playlist.m3u8';  
       $ud = '../d.htm?u=0&f='.$a9; 
 echo header("Location: $ud"); 
}
elseif(isset ($_GET['qitv'])){
set_time_limit(0);
        $url = $_GET['qitv'];
        $nd = m_d($url);
        $ud =  '../d.htm?u=&f='.$nd;
 echo header("Location: $ud"); 
}
elseif(isset ($_GET['qitv2'])){
set_time_limit(0);
       $url = $_GET['qitv'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ut = curl_exec($ch);
        $ud=  curl_getinfo($ch);
    curl_close($ch);
        $nd = $ud["url"];
        $nt =  '../t.htm?u=&f='.$nd;
 echo header("Location: $nt"); 
}
elseif(isset ($_GET['xxav0'])){
set_time_limit(0);
       $at = $_GET['xxav0'];
       $ul = 'http://'.$tnk.'/?m=vod-neiron-id-'.$at.'.html';
       $t = $_GET['t'];
       $tnk = $_GET['tnk'];
preg_match("|var vPath = '([^>]+)'|U",m_v($ul),$d);
       $a8 = $d[1];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a8;
}else{  
       $ud = '../d.htm?u=&f='.$a8; 
}
 echo header("Location: $ud"); 
}
elseif(isset ($_GET['xxav'])){
set_time_limit(0);
       $at = $_GET['xxav'];
       $tnk = $_GET['tnk'];
       $ul = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-1-num-1.html';
preg_match("|mac_url=(.*)\('([^>]+)'\)|U",m_v($at),$d0);
       $a8 = $d0[2];
       $a9 = u_d($a8);
preg_match("|([^>]+)\$([^>]+)\$([^>]+)|U",$a9,$d);
       $a12 = $d[3];
       $b9 = strpos($a9,'$');
   if($b9 === false ) $a11=$a9; else{
       //$a10=strstr($a9,'$');
       $a11=substr($a9,strripos($a9,"$")+1);}
  if( $a12 !=false) $a13 =$a12;else $a13=$a11;
  if(stripos($a11,'share') !== false) $ud = $a11;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a13; }else {  
  if( $tnk=="5hao.pw"||$tnk=="www.moli44.co") {
       $ud = '../d.htm?u=0&f='.$a13; 
}else if( $tnk=="atbus.icu") {
       $ud = 'https://jx.217663.xyz/98.php?vid='.$a13; 
}else {
       $ud = '../d.htm?u=&f='.$a13; 
}
}  
echo header("Location: $ud");
}
elseif(isset ($_GET['xxav141'])){
set_time_limit(0);
       $at = $_GET['xxav141'];
       $tnk = $_GET['tnk'];
       $ul1 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-1-num-1.html';
       $ul2 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-2-num-1.html';
preg_match("|player\(\"([^>]+)\"|ism",m_v($at),$d0);
       $a8 = $d0[1];
       $a9 = u_d($a8);
       $b9 = strpos($a9,'?url=');
       $a11=substr($a9,$b9 +5);
  if(stripos($a11,'share') !== false) $ud = $a11;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a11; }else {  
       $ud = '../d.htm?u=&f='.$a11; }
echo header("Location: $ud");
}
elseif(isset ($_GET['xxav142'])){
set_time_limit(0);
       $at = $_GET['xxav142'];
       $tnk = $_GET['tnk'];
       //$ul1 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-1-num-1.html';
       //$ul2 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-2-num-1.html';
preg_match("|var Sid=(.*)var url = \"([^>]+)\"(.*)var playname = \"([^>]+)\"|ismU",m_v($at),$d0);
       $a8 = $d0[2];
       $a9 = x_g($a8);
       /*$b9 = strpos($a9,'$');
   if($b9 === false ) $a11=$a9; else{
       $a10=strstr($a9,'$');
       $a11=substr($a9,strripos($a9,"$")+1);}
  if(stripos($a11,'share') !== false) $ud = $a11;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  }*/ 
  if(stripos($a8,'share') !== false) $ud = $a8;else if(is_mobile()){$ud = '../k.htm?u=&f='.$a8; } else if(stripos($a8,'.m3u8') !== false) $ud = '../d.htm?u=&f='.$a8;else 
       $ud = '../v.htm?u=&f='.$a8;
echo header("Location: $ud");
} 
elseif(isset ($_GET['xxav143'])){
//set_time_limit(0);
       $at = $_GET['xxav143'];
       $tnk = $_GET['tnk'];
       //$ul1 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-1-num-1.html';
       //$ul2 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-2-num-1.html';
preg_match('|"player"(.*)"url":"([^>]+)"(.*)"next"|U',m_v($at),$d0);
       $a8 = $d0[2];
       $a9 = x_g($a8);
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; }
echo header("Location: $ud");
}
elseif(isset ($_GET['xxav111'])){
set_time_limit(0);
       $at = $_GET['xxav111'];
       $tnk = $_GET['tnk'];
       $ul1 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-1-num-1.html';
       $ul2 = 'http://'.$tnk.'/?m=vod-play-id-'.$at.'-src-2-num-1.html';
preg_match("|mac_url='(.*)http([^>]+)'|ism",m_v($ul1),$d0);
       $a8 = 'http'.$d0[2];
       $a9 = u_d($a8);
       $b9 = strpos($a9,'$');
   if($b9 === false ) $a11=$a9; else{
       $a10=strstr($a9,'$');
       $a11=substr($a9,strripos($a9,"$")+1);}
  if(stripos($a11,'share') !== false) $ud = $a11;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; }
echo header("Location: $ud");
}
elseif(isset ($_GET['xxav1'])){
set_time_limit(0);
       $at = $_GET['xxav1'];
       $tnk = $_GET['tnk'];
       $wnk = $_GET['wnk'];
       //$ul = 'http://'.$tnk.'/?m=vod-detail-id-'.$at.'.html';
   if( $wnk=="1"||$wnk=="5"||$wnk=="6"||$wnk=="7"||$wnk=="8"||$wnk=="9"||$wnk=="10"||$wnk=="11"||$wnk=="19"||$wnk=="20"||$wnk=="21"||$wnk=="36") {
//preg_match_all("|<input type=\"checkbox\" name=\"copy_sel\" value=\"([^>]+)\"(.*)\/>|ismU",m_v($at),$d);
preg_match_all("|<input type=\"checkbox\" name=\"copy_sel\" value=\"([^>]+)index.m3u8\"(.*)\/>([^>]+)<\/li>|ismU",m_v($at),$d);
foreach ($d[1] as $k=>$v){
       $a8 = $d[1][$k].'index.m3u8';
       $a3 = $d[3][$k];
       $b9 = strpos($a8,'$');
   if($b9 === false ) $a11=$a8; else{
       $a10=strstr($a8,'$');
       $a11=substr($a8,strripos($a8,"$")+1);}
  if(stripos($a11,'share') !== false) {
       $ud = $a11;
}else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a11;
}else{  
       $ud = '../d.htm?u=2&f='.$a11; 
}
echo header("Location: $ud");   
} }  
else {
preg_match_all("|<input type=\"checkbox\" name=\"copy_sel\" value=\"([^>]+)index.m3u8\"(.*)\/>([^>]+)<\/li>|ismU",m_v($at),$d);
foreach ($d[1] as $k=>$v){
       $a8 = $d[1][$k].'index.m3u8';
       $a3 = m_u($d[3][$k]);
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a8;
}else{  
       $ud = '../d.htm?u=&f='.$a8; 
}
echo header("Location: $ud");     
}}
} 
elseif(isset ($_GET['xxav2'])){
set_time_limit(0);
       $at = $_GET['xxav2'];
       $tnk = $_GET['tnk'];
preg_match("|player_data=\{(.*)\"url\":\"([^>]+)\"|U",m_v($at),$d);
       $a5 = x_g($d[2]);
  if(stripos($a5,'share') !== false) $ud = $a5;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a5; } else {  
       $ud = '../d.htm?u=&f='.$a5; }  
echo header("Location: $ud");   
}
elseif(isset ($_GET['xxav20'])){
       $at = $_GET['xxav20'];
       $tnk = $_GET['tnk'];
preg_match('|<span class="hiddenBox" id="vpath">([^>]+)</span>|U',m_v($at),$d);
       $a5 = x_g($d[1]);
  if(stripos($a5,'share') !== false) $ud = $a5;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a5; }else {  
       //$ud = 'https://www.cmsbookpic.com/live_player.php/?smbb='.$a5;
       $ud = '../d.htm?u=&f='.$a5; }  
echo header("Location: $ud");   
}
elseif(isset ($_GET['xxav3'])){
set_time_limit(0);
       $at = $_GET['xxav3'];
       $tnk = $_GET['tnk'];
preg_match("|initVideo(.*)id:'([^>]+)'(.*)url:'([^>]+)'(.*)logo:|ism",m_v($at),$d);
       $a8 = $d[4];
  if(stripos($a8,'share') !== false) {
       $ud = $a8;
} else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a8;
} else {
       $ud = '../d.htm?u=&f='.$a8;  
}
echo header("Location: $ud");     
}
elseif(isset ($_GET['xxav4'])){
set_time_limit(0);
       $at = $_GET['xxav4'];
       $tnk = $_GET['tnk'];
       $ul = 'http://'.$tnk.'/index.php/vod/play/id/'.$at.'/sid/1/nid/1.html';
preg_match_all('|"link_pre"(.*)"url":"([^>]+)"|ismU',m_v($at),$d);
foreach ($d[2] as $k=>$v){
       $a5 = x_g($d[2][$k]);
  if(stripos($a5,'share') !== false) $ud = $a5;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a5; }else {  
       $ud = '../d.htm?u=&f='.$a5; }   
echo header("Location: $ud");   
}}
elseif(isset ($_GET['xxav5'])){
set_time_limit(0);
       $at = $_GET['xxav5'];
       $tnk = $_GET['tnk'];
preg_match("|<a href=\"\/play\?type=ckplayer\&linkId=([^>]+)\"(.*)>|U",m_v($at),$d2);
       $a3 = 'https://'.$tnk.'/play?type=ckplayer&linkId='.$d2[1];
preg_match("|<input type=\"text\" value=\"([^>]+)\"><\/p>|U",m_v($a3),$d);
       $a8 = $d[1];
       $a9 = str_replace('v1-cdn1.ynmmo.com', '8xhw2x.com', $a8);
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; } 
echo header("Location: $ud");       
}
elseif(isset ($_GET['xxav6'])){
set_time_limit(0);
       $at = $_GET['xxav6'];
       $tnk = $_GET['tnk'];
preg_match("|src=\"\/playdata\/([^>]+)\/([^>]+).js(.*)\">|ism",m_v($at),$d);
       $a4 = $d[1];
       $a5 = $d[2];
       $a7 = 'http://'.$tnk.'/playdata/'.$a4.'/'.$a5.'.js';
preg_match("|,\['([^>]+)'\]|ism",f_g($a7),$d2);
       $a8 = $d2[1];
       $a9 = getNeedBetween($a8,'$','$c'); 
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; } 
echo header("Location: $ud");     
}
elseif(isset ($_GET['xxav41'])){
set_time_limit(0);
       $at = $_GET['xxav41'];
       $tnk = $_GET['tnk'];
preg_match("|var player_url=\"([^>]+)\";|ismU",m_v($at),$d);
       $a9 = $d[1];
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; } 
echo header("Location: $ud");     
}
elseif(isset ($_GET['xxav61'])){
set_time_limit(0);
       $at = $_GET['xxav61'];
       $tnk = $_GET['tnk'];
preg_match("|<iframe(.*)src=\"(.*)Play=([^>]+)m3u8\"|ism",m_v($at),$d);
       $a4 = $d[3];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a4.'m3u8'; 
}else{ 
       $ud = '../d.htm?u=&f='.$a4.'m3u8'; 
}
echo header("Location: $ud");     
}
elseif(isset ($_GET['xxav62'])){
set_time_limit(0);
       $at = $_GET['xxav62'];
       $tnk = $_GET['tnk'];
preg_match("|<iframe(.*)src=\"(.*)url=([^>]+)m3u8\"|ism",m_v($at),$d);
       $a4 = $d[3];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a4.'m3u8'; 
}else{ 
       $ud = '../d.htm?u=&f='.$a4.'m3u8'; 
}
echo header("Location: $ud");     
}
elseif(isset ($_GET['xxav70'])){
set_time_limit(0);
       $at = $_GET['xxav70'];
       $tnk = $_GET['tnk'];
preg_match("|var player_data=\{(.*)\"url\":\"([^>]+)\",\"url_next\"|ismU",m_v($at),$d);
       //$a4 = $d[1];
       $a5 = x_g($d[2]);
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a5;
}else{  
       $ud = '../d.htm?u=&f='.$a5; 
}
echo header("Location: $ud");      
}
elseif(isset ($_GET['xxav7'])){
set_time_limit(0);
       $at = $_GET['xxav7'];
       $tnk = $_GET['tnk'];
preg_match("|source src=\"([^>]+)\"|ismU",m_v($at),$d);
       $a4 = $d[1];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a4;
}else{  
       $ud = '../d.htm?u=&f='.$a4; 
}
echo header("Location: $ud");      
}
elseif(isset ($_GET['xxav80'])){
set_time_limit(0);
       $at = $_GET['xxav80'];
       $tnk = $_GET['tnk'];
       $ul ='http://'.$tnk.'/play/'.$at.'-0-0.html';
preg_match("|var now=\"([^>]+)\"|ismU",m_v($ul),$d);
       $a4 = $d[1];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a4;
}else{  
       $ud = '../d.htm?u=&f='.$a4; 
}
echo header("Location: $ud");      
}
elseif(isset ($_GET['xxav8'])){
set_time_limit(0);
       $at = $_GET['xxav8'];
       $tnk = $_GET['tnk'];
       $ul = 'http://'.$tnk.'/video/'.$at.'.html';
preg_match("|src=\"\/playdata\/([^>]+)\/([^>]+).js(.*)\">|ism",m_v($ul),$d);
       $a4 = $d[1];
       $a5 = $d[2];
       $a7 = 'http://'.$tnk.'/playdata/'.$a4.'/'.$a5.'.js';
preg_match("|,\['([^>]+)'\]|ism",m_v($a7),$d2);
       $a8 = $d2[1];
       $a9 = getNeedBetween($a8,'$','$x'); 
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; }       
echo header("Location: $ud");  
}
elseif(isset ($_GET['xxav9'])){
set_time_limit(0);
       $at = $_GET['xxav9'];
       $tnk = $_GET['tnk'];
       $ul = 'http://'.$tnk.'/video/'.$at.'.html';
preg_match("|src=\"\/playdata\/([^>]+)\/([^>]+).js(.*)\">|ism",m_v($ul),$d);
       $a4 = $d[1];
       $a5 = $d[2];
       $a7 = 'http://'.$tnk.'/playdata/'.$a4.'/'.$a5.'.js';
preg_match("|,\['([^>]+)'\]|ism",m_v($a7),$d2);
       $a8 = $d2[1];
       $a9 = getNeedBetween($a8,'$','$l'); 
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; } 
echo header("Location: $ud");      
}
elseif(isset ($_GET['xxav10'])){
set_time_limit(0);
       $at = $_GET['xxav10'];
       $tnk = $_GET['tnk'];
preg_match("|f:'(.*)\/\/([^>]+)\/(.*)',|U",m_v($at),$d3);
       $aa1 = $d3[3]; 
       $aa2 = 'https://dns.89mimi.com/'.$aa1; 
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$aa2;
}else{  
       $ud = '../d.htm?u=&f='.$aa2; 
}
echo header("Location: $ud");
}
elseif(isset ($_GET['xxav11'])){
set_time_limit(0);
       $at = $_GET['xxav11'];
       $tnk = $_GET['tnk'];
 preg_match('|data-pars="([^>]+)"|ismU',m_v($at), $d1);
 preg_match('|data-play="([^>]+)"|ismU',m_v($at), $d2);
       $a3=$d1[1];
       $a4=u_c($d2[1]);
       $ua =$a3.$a4;
  if(stripos($ua,'share') !== false) {$ud = $ua;}else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$ua; }else {  
       $ud = '../d.htm?u=&f='.$ua;
       //$ud = 'https://www.lbjx9.com/?url='.$ua; 
 } 
echo header("Location: $ua");
}
elseif(isset ($_GET['xxav12'])){
       $at = $_GET['xxav12'];
       $tnk = $_GET['tnk'];
       $ul = 'http://'.$tnk.'/video/'.$at.'.html?';
preg_match("|src=\"\/playdata\/([^>]+)\/([^>]+).js(.*)\">|ism",m_v($ul),$d);
       $a4 = $d[1];
       $a5 = $d[2];
       $a7 = 'http://'.$tnk.'/playdata/'.$a4.'/'.$a5.'.js';
preg_match("|,\['([^>]+)'\]|ism",m_v($a7),$d2);
       $a8 = $d2[1];
       $a9 = getNeedBetween($a8,'$','$x'); 
  if(stripos($a9,'share') !== false) $ud = $a9;else if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$a9; }else {  
       $ud = '../d.htm?u=&f='.$a9; }
echo header("Location: $ud");    
} 
elseif(isset ($_GET['xxav13'])){
set_time_limit(0);
       $at = $_GET['xxav13'];
       $tnk = $_GET['tnk'];
       //$u = $_GET['u'];
       $ul = 'http://'.$tnk.'/?m=video_conter'.$at;
 preg_match("|src=\"(.*)Play=([^>]+)\"|U",m_v($at), $d);
       $a3=$d[2];
       $ua =$a3;
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$ua;
}else{  
       $ud = '../d.htm?u=&f='.$ua; 
}
 echo header("Location: $ud");
}
elseif(isset ($_GET['jntvid'])){//5-17
       $at = $_GET['jntvid'];
       $ul = 'http://zhibo.ijntv.cn/m2o/channel/channel_info.php?id='.$at;
       $nt = J_d(m_v($ul),ture);
       $aa = $nt;
       $count_json = count($aa);
       $ua =$aa[0]["m3u8"];
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$ua;
}else{  
       $ud = '../d.htm?u=&f='.$ua; 
}
 echo header("Location: $ud");
}
elseif(isset ($_GET['mg_tv'])){
       $at = $_GET['mg_tv'];
       $ut ='http://m.miguvideo.com/playurl/v1/play/playurlh5?contId='.$at.'&clientId=migu';
       $ut3 ='https://webapi.miguvideo.com/gateway/playurl/v3/play/playurl?contId='.$at;
       $ut2 ='http://webapi.miguvideo.com/gateway/playurl/v2/play/playurlh5?contId='.$at.'&rateType=3&clientId=8a08080c7104a2c28c1e5a90a76ec60e&startPlay=true&channelId=0131_10010001005';
       $nt=J_d(m_v($ut),ture);
       $aa = $nt["body"]["urlInfo"];
       $count_j=count($aa);
       $aa1= $aa["url"];
preg_match("|(.*)gslb.cmvideo.cn\/(.*)|",$aa1,$d);
       $a1 = 'http://h5.live.miguvideo.com:8088/'.$d[2];
       //$a1 = u_e('http://h5.live.miguvideo.com:8088/'.$d[2]);
       $ua=$a1;
  if(is_mobile()){ 
       $ud = '../k.htm?u=&f='.$ua;
}else{  
       $ud = '../d.htm?u=&f='.$ua; 
}
 echo header("Location: $ud");
}
elseif(isset ($_GET['dy_td'])){
       $ul = $_GET['dy_td'];
       $url = 'https://www.douyu.com/'.$ul;
       $url2 = 'https://www.douyu.com/lapi/live/getH5Play/5646920';
       //$w = $_GET['w']?$_GET['w']:$url;
       $name = $_GET['name'];
       $ut = m_s($url);
preg_match("|var streamUrl = \"([^>]+)\/([^>]+)_([^>]+).flv(.*)\"|",$ut,$d);
       $a1=$d[2];
       //$ua='http://tx2play1.douyucdn.cn/live/'.$a1.'_2000p.xs&.m3u8';
       $ua='https://tc-tct.douyucdn2.cn/dyliveflv3a/'.$a1.'.xs&.m3u8';
       //$ud='http://tx2play1.douyucdn.cn/dylivehls1/'.$a1.'_4000p.xs&.m3u8';
       //$ud='https://tc-tct.douyucdn2.cn/dylivehls1/'.$a1.'_2000p.xs&.m3u8';
       //$ud='https://tc-tct.douyucdn2.cn/dyliveflv1/'.$a1.'_2000p.flv?&.m3u8';
 if(is_mobile()) {
       $ud = '../ck.htm?u=&f='.$ua;
}else $ud = '../ck.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['hj_tv'])){
       $ul = $_GET['hj_tv'];
       $url = 'https://qh2-flv.live.huajiao.com/live_huajiao_v2/'.$ul.'.flv';
       $ud = '../t.htm?u=&f='.$url;
echo header("Location:".$ud );
}
/*elseif(isset ($_GET['ddy_td'])){ */
/*function ddytd($url) {
       //$ul = $_GET['ddy_td'];
       $ul = $_GET['w']?$_GET['w']:'';
       $url1 = 'https://rtbapi.douyucdn.cn/japi/sign/web/getconfig?posid=4112241&roomid='.$ul.'&cate1=2&cate2=208';
       $url2 = 'https://www.douyu.com/lapi/live/getH5Play/52787';
       $tm = J_d(m_v($url1),true);
       $tmm= $tm["data"][0]["expireTime"];
       $url = 'https://www.douyu.com/lapi/live/getH5Play/'.$ul.'?rid='.$ul.'&tt='.$tmm.'&did=2dfd02149496030e407b1e3900031501';
       //$url = 'https://www.douyu.com/lapi/live/getH5Play/52787?ver=120111811&v=220120201216&sign=f464362739cc2c086677ae843513f9fa&cdn=&rate=0&tt='.$tmm.'&did=95b4a17ebfafc7c900a75bd800061501&ive=0&aid=web%2Dflash&iar=1';
       //$url = 'https://playweb.douyucdn.cn/lapi/live/hlsH5Preview/52787?rid=52787&did=95b4a17ebfafc7c900a75bd800061501&sign=f7d2bc21bedfc6b7fb579de89851ef9a';
       //$name = $_GET['name'];
       $ut = m_s($url);
preg_match('|"rtmp_url":"([^>]+)"(.*)"rtmp_live":"([^>]+)"|',$ut,$d);
       $a1=$d[1];
       $a2=$d[3];
       $a3=$a1.'/'.$a2;
       $ua= $a3;
       //$ua='http://tx2play1.douyucdn.cn/live/'.$a1.'_2000p.xs&.m3u8';
       //$ud='https://tc-tct.douyucdn2.cn/dyliveflv3/'.$a1.'_2000p.xs&.m3u8';
       //$ud='http://tx2play1.douyucdn.cn/dylivehls1/'.$a1.'_4000p.xs&.m3u8';
       //$ud='https://tc-tct.douyucdn2.cn/dylivehls1/'.$a1.'_2000p.xs&.m3u8';
       //$ud='https://tc-tct.douyucdn2.cn/dyliveflv1/'.$a1.'_2000p.flv?&.m3u8';
       $ud = '../ck.htm?u=&f='.$ua;
//echo header("Location:".$ud );
echo $ut;
}
*/
elseif(isset ($_GET['v95tv'])){
       $ul = $_GET['v95tv'];
       //$w = $_GET['w']?$_GET['w']:$url;
       $ut = m_v($ul);
preg_match('|"uid":([^>]+),"room_id":([^>]+),"sid":([^>]+),|',$ut,$d);
       $a1=$d[1];
       //$ua = 'http://play1.95xiu.com/app/'.$a1.'.m3u8';
       $ua = 'http://play1.95xiu.com/app/'.$a1.'.flv';
       $ud = '../t.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['ik_tv'])){
       $ul = $_GET['ik_tv'];
       $url = 'https://webapi.busi.inke.cn/web/live_share_pc?uid='.$ul;
       //$w = $_GET['w']?$_GET['w']:$url;
       $ut = J_d(m_v($url),true);
       $aa = $ut["data"]["file"]["record_url"];
       //$aa = $ut["data"]["records"];
       //$aa = $ut["data"]["live_addr"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       //$a2 = $a0["record_url"];
       $a3 = $a0["stream_addr"];
       //$a4 = $a0["rtmp_stream_addr"];
       $ua = $aa;
       $ud = f_t($ua);
echo header("Location:".$ud );
}}
elseif(isset ($_GET['cctvid'])){
       $ul = $_GET['cctvid'];
       $url = 'http://player.521fanli.cn/1691/0/ady.php?id='.$ul;
       $ut = m_v($url);
preg_match('|"url": "([^>]+)"|U',$ut,$d);
       $a0 = $d[1];
       $ud = '../d.htm?&f='.$a0;
echo header("Location:".$ud );
}
elseif(isset ($_GET['cctvid1'])){
       $ul = $_GET['cctvid1'];
       $url = 'http://player.521fanli.cn/1691/0/wo.php?id='.$ul;
       $ut = m_v($url);
preg_match('|source src="([^>]+)"|U',$ut,$d);
       $a0 = $d[1];
       $ud = '../d.htm?&f='.$a0;
echo header("Location:".$ud );
}
elseif(isset ($_GET['cctvid2'])){
       $ul = $_GET['cctvid2'];
       $url = 'http://player.521fanli.cn/1691/sh/bstqq.php?&rate=fhd&id='.$ul;
       $ut = m_v($url);
preg_match('|source src="([^>]+)"|U',$ut,$d);
       $a0 = $d[1];
       $ud = '../d.htm?&f='.$a0;
echo header("Location:".$ud );
}
elseif(isset ($_GET['cctvid3'])){
       $ul = $_GET['cctvid3'];
       $url = 'http://player.521fanli.cn/1691/0/wo.php?id='.$ul;
       $ut = m_v($url);
preg_match('|source src="([^>]+)"|U',$ut,$d);
       $a0 = $d[1];
       $ud = '../d.htm?&f='.$a0;
echo header("Location:".$ud );
}
elseif(isset ($_GET['qe_td'])){
       $ul = $_GET['qe_td'];
       $ul2 = 'https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$ul.'_500.xs&.m3u8';
       $ul3 = 'https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$ul.'_1200.xs&.m3u8';
       /*$url = 'https://share.egame.qq.com/cgi-bin/pgg_async_fcgi?param={"key":{"module":"pgg_live_read_svr","method":"get_live_and_profile_info","param":{"anchor_id":"'.$ul.'","layout_id":"hot","index":1,"other_uid":0}}}';
       //$w = $_GET['w']?$_GET['w']:$url;
       //$name = $_GET['name'];
       $ut = J_d(m_v($url),true);
       $aa = $ut["data"]["key"]["retBody"]["data"]["video_info"]["stream_infos"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["play_url"];
       $a3 = m_u($a0["desc"]);
       $a4 = $a0["play_time_shift_url"];*/
       $ua = $ul2;
       $ud = '../t.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['qe_tv'])){
       $ul = $_GET['qe_tv'];
       $ul2 = 'https://live.qq.com/swf_api/room/'.$ul.'?cdn=ws&nofan=yes&_t=26837789&sign=147b60ad11192df1a89fba8f5aac491b';
       $ul3 = 'https://1f97bd333ceef73bfdbd7e9987650b18.v.smtcdns.net/txpcdn.liveplay.egame.qq.com/live/3954_'.$ul.'_1200.xs&.m3u8';
       //$w = $_GET['w']?$_GET['w']:$url;
       //$name = $_GET['name'];
       $ut = J_d(m_v($ul2),true);
       $aa = $ut["data"];
       $a2 = $aa["room_id"];
       $a3 = x_g($aa["rtmp_url"]);
       $a4 = x_g($aa["rtmp_live"]);
       $ua = $a3.'/'.$a4;
       $ud = '../t.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['qe_td3'])){
       $ul = $_GET['qe_td'];
       $ul3 = 'https://egame.qq.com/'.$ul;
preg_match("|\"urlArray\":\[(.*)\],|",m_v($ul3),$d);
       $nt = $d[1];
       $ut = '['.$nt.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $a2 = $aa[1]["playUrl"];
       $a3 = $aa[2]["playUrl"];
       $a4 = $aa[3]["playUrl"];
       $ua = $a3;
       $ud = '../t.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['ks_tv'])){//zhj1196668974
       $ul = $_GET['ks_tv'];
       $w = $_GET['w']?$_GET['w']:$ul;
       $ul2 = 'https://live.kuaishou.com/u/'.$w;
preg_match('|"caption":"([^>]+)","playUrls":(.*),"coverUrl"|',m_v($ul2),$d);
       $nt = $d[2];
//preg_match('|"quality":"super","url":"([^>]+)"|U',$nt,$d2);
preg_match('|"quality":"standard","url":"([^>]+)"|U',$nt,$d2);
//preg_match('|"quality":"high","url":"([^>]+)"|U',$nt,$d2);
       $nt2 = $d2[1];
       $ua = str_replace('\u002F', '/', $nt2);
       $ud = '../t.htm?u=&f='.$ua;
echo header("Location:".$ud );
}
elseif(isset ($_GET['zqtv_m'])){
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"2";
       $p1 = $p*60;
       $wt = $_GET['zqtv_m'];
       $name = $_GET['name'];
       $ul2 ='https://m.zhanqi.tv/api/static/v2.1/room/domain/11531758.json';
       $ul1 ='https://m.zhanqi.tv/api/static/game.lives/'.$wt.'/'.$p1.'-1.json';
       $ul0 ='https://www.zhanqi.tv/api/static/game.lives/'.$wt.'/'.$p1.'-1.json';
       $ul4 ='https://www.zhanqi.tv/api/static/v2.1/game/live/'.$wt.'/'.$p1.'/1.json';
       $ul3 ='https://m.zhanqi.tv/api/static/v2.1/live/list/'.$wt.'/'.$p1.'/1.json';
       //$ul1 ='http://www.zhanqi.tv/api/static/video.news/gameid/'.$wt.'/'.$p1.'-1.json';
       //$ul2 ='http://www.zhanqi.tv/openapi/api__static__game.lives__'.$wt.'__'.$p1.'-1.json&callback=dota';
       //$ul3 ='http://www.zhanqi.tv/api/static/video.news/'.$p1.'-1.json';
       //$ul3 ='http://www.zhanqi.tv/api/static/game.lives/'.$wt.'/'.$p1.'-1.json';
       //$ul5 ='https://www.zhanqi.tv/api/static/v2.1/game/live/'.$wt.'/'.$p1.'/1.json';
       $ul ="";
     if($wt == '45') $ul=$ul0;else $ul=$ul3;
       $ut = J_d(m_v($ul),True);
       $aa = $ut["data"]["rooms"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       //$a1 = $a0["id"];
       $a2 = $a0['nickname'];
       //$a4 = $a0["code"];
       //$a5 = $a0["url"];
       $a13 = $a0['title'];
       $a12 = $a0['videoId'];
if(is_mobile()){
       $b14 = 'https://dlhls-cdn-mp.zhanqi.tv/zqlive/'.$a12.'.m3u8';
       $ua = $b14;
       $ud = f_kd($ua);
    }else if( $a=="3") {
       $b14 = 'https://dlhls-cdn-mp.zhanqi.tv/zqlive/'.$a12.'.m3u8';
       $ua = $b14;
       $ud = f_kd($ua);
}else {
       $b14 = 'https://603ulclsqv10nzs3rdgync6f0o4mn2a.dwion.com/dlhdl-cdn.zhanqi.tv/zqlive/'.$a12.''.$tnk.'.flv?';
       $ua = $b14;
       $ud = f_kd($ua);
}
echo header("Location:".$ud );
}}
?>
 
 




