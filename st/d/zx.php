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
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
      curl_setopt($ch, CURLOPT_URL, $url);
      //curl_setopt($ch, CURLOPT_HTTPGET, true);
      curl_setopt($ch, CURLOPT_ENCODING, "");  
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
      curl_setopt($ch, CURLOPT_SSLVERSION, 0);
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
      curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
     $file=curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Errno'.curl_error($ch);//捕抓异常
    }
     //$recode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch); // 关闭CURL会话
       //$return = json_decode($file,true);
    return $file; // 返回数据
}
function m_v( $url,$type,$data= false,&$err_msg = null,$cookie='',$cert_info = array()){
    $ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
    $type = strtoupper($type);
    if ($type == 'GET' && is_array($data)) {
        $data = http_build_query($data);
    }
    $option = array();
    if ($type == 'POST') {
        $option[CURLOPT_POST] = 1;
    }
    if ($data) {
        if ($type == 'POST') {
            $option[CURLOPT_POSTFIELDS] = $data;
        } elseif ($type == 'GET') {
            $url = strpos($url, '?') !== false ? $url . '&' . $data : $url . '?' . $data;
        }
    }
      //$header=array('Expect:');//避免data数据过长问题 
      //$https= $_SERVER["HTTPS"];
      //$host = str_replace('&','&',$url);
      //$postdata = array ( );
      //$post_data = http_build_query($postdata);
      //$ssl = stripos($url,'https://') === 0 ? true : false;
      //$ssl = substr($url, 0, 7) == "https" ? true : false;
      //$cacert = getcwd() . '/cacert.pem'; //CA根证书 
    $time = '6000';
    $option = array();
    $option[CURLOPT_URL] = $url;
    $option[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
    $option[CURLOPT_ENCODING] = "";
    $option[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
    $option[CURLOPT_REFERER] = $url;
    $option[CURLOPT_CONNECTTIMEOUT] = $time;
    $option[CURLOPT_TIMEOUT] = $time;
    $option[CURLOPT_USERAGENT] = $_SERVER['HTTP_USER_AGENT'];
    $option[CURLOPT_FOLLOWLOCATION] = 1;
    $option[CURLOPT_NOBODY] = 0;
    $option[CURLOPT_FORBID_REUSE] = 1;
    $option[CURLOPT_AUTOREFERER] = 1;
    $option[CURLOPT_MAXREDIRS] = 4;
    $option[CURLOPT_VERBOSE] = 1;
    $option[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
    $option[CURLOPT_HTTPHEADER] = array('Expect:');
    $option[CURLOPT_RETURNTRANSFER] = true;
    $option[CURLOPT_HEADER] = false;
    $option[CURLOPT_SSL_VERIFYPEER] = false;
    $option[CURLOPT_SSL_VERIFYHOST] = false;
    if (!empty($cert_info) && !empty($cert_info['cert_file'])) {
        $option[CURLOPT_SSLCERT] = $cert_info['cert_file'];
        $option[CURLOPT_SSLCERTPASSWD] = $cert_info['cert_pass'];
        $option[CURLOPT_SSLCERTTYPE] = $cert_info['cert_type'];
        $option[CURLOPT_SSL_VERIFYHOST] = false;
    }
    if (!empty($cert_info['ca_file'])) {
        $option[CURLOPT_SSL_VERIFYPEER] = 1;
        $option[CURLOPT_CAINFO] = $cert_info['ca_file'];
    } else {
        $option[CURLOPT_SSL_VERIFYPEER] = false;
        $option[CURLOPT_SSL_VERIFYHOST] = false;
    }
  if ( $cookie ) {
    $option[CURLOPT_COOKIE] = $cookie;
        }
    $ch = curl_init();
    curl_setopt_array($ch, $option);
    $file = curl_exec($ch);
    $curl_no = curl_errno($ch);
    $curl_err = curl_error($ch);
    curl_close($ch);
    if ($curl_no > 0) {
        if ($err_msg !== null) {
            $err_msg = '(' . $curl_no . ')' . $curl_err;
        }
    }
    return $file;
}
function m_v2($url,$data=null,$postdata=null,$cookie='',$params = []) {
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
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
       curl_setopt($ch, CURLOPT_URL, $url);//访问地
       curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
       curl_setopt($ch, CURLOPT_ENCODING, "");  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//检查证书
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//从证书中检查SSL加密算法是否存在
       curl_setopt($ch, CURLOPT_SSLVERSION, 0);
       //curl_setopt($ch, CURLOPT_HTTPGET, true);
       //curl_setopt($ch, CURLOPT_MUTE,1);
       //curl_setopt($ch, CURLINFO_HEADER_OUT,1);//启用时追踪句柄的请求字符串
       curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$time);
       curl_setopt($ch, CURLOPT_TIMEOUT,$time);//设置超时限制
       curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);//模拟用户使用的浏览器
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
       curl_setopt($ch, CURLOPT_NOBODY,false);//输出中不包含body
       curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
 if (!empty($params)) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode(json_encode($postdata)));
        }
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
       curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
       @ $file = curl_exec($ch); 
        if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch);//捕抓异常
        }
     //$recode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
     if ($file === false) { 
    header('HTTP/1.1 400 Bad Request'); 
    exit; 
  } else { 
       return $file; 
}}
function sss($url) {
       $t = $_GET['t']?$_GET['t']:dtime();
       $u = $_GET['u']?$_GET['u']:0;
       $wk= array('https://m.fx678.cn/kx/moreNews?publishTime='.$t.'&size=100','https://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$t,'https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid=2856&pnum=1&psize=100&callback=','https://news.10jqka.com.cn/tapp/news/push/stock/?page=1&tag=&track=website&pagesize=10','https://m.fx678.cn/news/columnPageNews?page=1&column=10119','https://www.jin10.com/flash_newest.js','http://app.cnfol.com/dataapi/index.php/kuaixundata/kuainewse?num1=0&num2=5&strlen=25&cstrlen=200&callback=','https://www.tianyancha.com/pagination/relatedAnnouncement.xhtml?ps=20&pn=1&id=3191323252');
       $w = $_GET['w']?$_GET['w']:0;
       $wnk = $wk[$w];
    if( $w<=5 ) $wnkk=$wnk;else $wnkk=u_e($w);
   if($u==1){
       $ut =  m_s( $wnkk );
}else if($u==2){
       $ut =  m_t( $wnkk );
}else if($u==3){
       $ut =  m_ss( $wnkk );
}else if($u==4){
       $ut =  m_mt( $wnkk );
}else {
       $ut =  m_v( $wnkk );
}
  //print_r($ut);
    echo $ut;
}
function m_mt($url, $isPostRequest=false, $data=[], $header=[], $certParam=[]){ // 模拟提交数据函数
    $ch= curl_init(); // 启动一个CURL会话
    //如果是POST请求
    if( $isPostRequest ){
        curl_setopt($ch, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post提交的数据包
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
    curl_setopt($ch, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    //检查链接是否https请求
    if(strpos($url, 'https') !== false){
        //设置证书
        if( !empty($certParam) && isset($certParam['cert_path']) && isset($certParam['key_path']) ){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch, CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, $certParam['cert_path']);
            curl_setopt($ch, CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch, CURLOPT_SSLKEY, $certParam['key_path']);
        }else{
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
        }
    }
    // 模拟用户使用的浏览器
    if(isset($_SERVER['HTTP_USER_AGENT'])){
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($ch, CURLOPT_TIMEOUT, 0); // 设置超时限制防止死循环
    curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);   //设置头部
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $result = curl_exec($ch); // 执行操作
    if ( curl_errno($ch) ) {
        $result = 'error: '.curl_error($ch);//捕抓异常
    }
    curl_close($ch); // 关闭CURL会话
    return $result; // 返回数据，json格式
}
function m_ss($url, $data){
    $time = 30;
    $ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
    $ch = curl_init();
    $opt = array(
            CURLOPT_URL     => $url,
            CURLOPT_POST    => 1,
            CURLOPT_HEADER  => 0,
            CURLOPT_POSTFIELDS      => (array)$data,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_TIMEOUT         => $time,
            );
    if ($ssl){
        $opt[CURLOPT_SSL_VERIFYHOST] = 0;
        $opt[CURLOPT_SSL_VERIFYPEER] = FALSE;
    }
    curl_setopt_array($ch, $opt);
    $data = curl_exec($ch);
        if(curl_errno($ch)) {
            return 'Errno'.curl_errno($ch);
        }
    curl_close($ch);
    return $data;
}
function m_t($url,$data){
        $ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
        $header=array('Expect:');//避免data数据过长问题 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);//构造来路
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
    if ($ssl){
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        if(curl_errno($ch)) {
            return 'Errno'.curl_errno($ch);
        }
        curl_close($ch);
        return $result;
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
function m_c($url, $params='', $headers=''){
$re = m_v($http, $data, 1);// 解析HTTP数据流
list($header, $body) = explode("\r\n\r\n", $re);//解析COOKIE
preg_match("/set\-cookie:([^\r\n]*)/i", $header, $matches);//请求的时候headers 带上cookie就可以了
$cookie = explode( ';',$matches[1]);
   return $cookie[0];
}
function x_st($url) {
     $xmldata = file_get_contents("php://input"); 
     $data = (array)simplexml_load_string($xmldata); 
return $data;
}
function j_st($url) {
   $content = file_get_contents('php://input');
   $post  = (array)json_decode($content, true);
return $post;
}
function isPost() {
return $_SERVER['REQUEST_METHOD'] == 'POST'?1:0;
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
function b_d6($url) {  return base64_decode($url); }
function e_b($url) {  return eval(gzinflate(base64_decode($url))); } 
function m_b($url) {  return mb_convert_encoding(base64_decode($url,"gb2312","UTF-8"));}
function k_w($url) {  return rawurlencode(mb_convert_encoding(m_g($url), 'utf-8', 'gb2312'));}
function k_h($url) { return substr(substr($number,strripos($number,"(")+1),0,strrpos(substr($number,strripos($number,"(")+1),")"));}
function b_60($url) {  return urlencode(base64_encode($url)); }
function b_61($url) {  return base64_encode(urlencode($url)); }
function b_62($url) {  return base64_encode(urlencode(iconv('gb2312','UTF-8',$url))); }
function b_63($url) {  return strtr(base64_encode(preg_replace('/^(http?:)\/\//','$1##',$url)),'+/','-_');  }
function b_64($url) {  return mb_convert_encoding(base64_encode($url),"gb2312","UTF-8");   }
function b_65($url) {  return encodeURIComponent($url);  }
function b_d($url) {  return base64_decode($url); }
function b_d1($url) {  return urldecode(base64_decode($url)); }
function b_d2($url) {  return base64_decode(urldecode(iconv('gb2312','UTF-8',$url))); }
function u_c($url) {  return unescape($url); }
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
        $ud12= f_ul($ua);
        $ud13= f_kl($ua);
        $ud14= f_b($ua);
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
function f_b($ua){
       $url= '../ck/b.htm?&f='.$ua;
      return $url;
}
function f_k($ua){
       $url= '../k.htm?&f='.$ua;
      return $url;
}
function f_kk($ua){
       $url = '../ck/k.htm?&f='.$ua;
      return $url;
}
function f_ck($ua){
       $url= '../ck.htm?&f='.$ua;
      return $url;
}
function f_ckk($ua){
       $url= '../ck/ck.htm?&f='.$ua;
      return $url;
}
function f_uu($ua){
       $url = '../u.htm?u=&f='.$ua;
      return $url;
}
function f_ku($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ck/u.htm?u='.$u.'&f='.$ua;
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
       $url = '../t.htm?&f='.$ua;
      return $url;
}
function f_kt($ua){
       $url= '../ck/t.htm?&f='.$ua;
      return $url;
}
function f_uk($ua){
        $u = $_GET['u']?$_GET['u']:"1";
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
function f_ul($ua){
       $u = $_GET['u']?$_GET['u']:0;
       $url = '../ul.htm?u='.$u.'&f='.$ua;
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
function f_w($ua){
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
function cnzx($url) {
       $wk= array("china","world","society","life","ent","edu","law","tech");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
       $ul1 = 'http://news.cntv.cn/'.$wnk.'/data/index.json?r=0.9668800662893942';
       $ul = 'http://news.cctv.com/2019/07/gaiban/cmsdatainterface/page/'.$wnk.'_'.$ii.'.jsonp?cb='.$wnk.'';
 //preg_match("#\"list\":(.*)\}\}\)#U",m_v($ul),$b);
 preg_match("#\((.*)\)#",m_v($ul),$b);
       $nt = J_d($b[1],true);
       $aa = $nt["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = m_u($a0["title"]);
       $a3 = m_u($a0["brief"]);
       $a4 = $a0["focus_date"];
       $a5 = $a0["url"];
       $xml ='<a>'.$a4.': '.$a3.'</a>';
       //$xml ='<a href="'.$ud.'" target="tv">'.$a3.': '.$a2.'</a>';
echo $xml;
}}}
function request_url_data($data) {//获取保存COOKIE
    $cookieSuccess = __DIR__."/cookie.txt";//cookie保存文件地址
    //$data['user'] = '用户名';
    //$data['pwd'] = '密码';
    //$requesturl = 'http://GET登陆提交地址?'.http_build_query($data);
    $requesturl = "http://www.55188.com/logging.php?action=login&formhash=19a4dc8e&referer=index.php&username=%BC%CE%B6%A8%B3%C2&password=cq700708&answer=0&loginsubmit=%B5%C7%C2%BC";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requesturl);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieSuccess);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data=curl_exec($ch);
    curl_close($ch);
    return $data;
}
function sinaxw($url) {
       $wk= array("0","1","2","3","4","5","6","7","8","9","10");
       $tk= array("152","153");
       $w = $_GET['w']?$_GET['w']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:2; 
       $p1 = $p*50;
       $wnk = $wk[$w];
       $tnk = $tk[$t];
       $ul = 'http://zhibo.sina.com.cn/api/zhibo/feed?callback=&page=1&page_size='.$p1.'&zhibo_id='.$tnk.'&tag_id='.$wnk.'&dire=f&dpc=1';
       $ul2 = 'https://feed.mix.sina.com.cn/api/roll/get?pageid=153&lid=2509&k=&num='.$p1.'&page=1&callback=';
       $ut = m_v($ul);
       $nt = J_d($ut,true);
       $aa = $nt["result"]["data"]["feed"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["zhibo_id"];
       $a4 = r_u($a0['rich_text']);
       $a5 = $a0['create_time'];
       $a6 = r_u($a0['anchor']);
       $xml ='<a>'.$a5.' :'.$a4.'  </a>';
echo $xml;
}}
function sinxw($url) {
       $wk= array("0","1","2","3","4","5","6","7","8","9","10");
       $tk= array("153","152");
       $w = $_GET['w']?$_GET['w']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:1; 
       //$p1 = $p*20;
       //$wnk = $wk[$w];
       $tnk = $tk[$t];
  for ($i = 1; $i <=$p; $i++) {
       //$ul = 'http://feed.mix.sina.com.cn/api/roll/get?pageid=384&lid=2519&k=&num=50&page=1&callback=';
       $ul = 'https://feed.mix.sina.com.cn/api/roll/get?pageid=153&lid=2509&k=&num=30&page='.$i.'&callback=';
       $ut = f_g($ul);
       $nt = J_d($ut,true);
       $aa = $nt["result"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["oid"];
       $a2 = $a0["docid"];
       $a3 = $a0["url"];
       $a4 = $a0["wapurl"];
       $a5 = r_u($a0['title']);
       $a6 = r_u($a0['intro']);
       $a7 = t_m($a0['ctime']-28800);
       $a8 = t_m($a0['mtime']-28800);
       $a9 = t_m($a0['intime']-28800);
       $xml ='<a>'.$a7.' :'.$a5.'  </a>';
echo $xml;
}}}
function sinazx($url) {//新浪
       $wk= array( "102","101","102","103","104","105","106","107","108","109","110");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"1";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
  for ($i = 1; $i <=$p; $i++) {
    $ul='https://interface.sina.cn/wap_api/news_roll.d.html?col=38790&level=1%2C2&show_num=20&page='.$i.'&act=more&jsoncallback=&&callback=jsonp2';
        $ut = m_v($ul);
        $nt = J_d($ut,true);
        $aa = $nt["result"]["data"]["list"];
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["_id"];
        $a2 = r_u($a0["title"]); 
        $a3 = $a0["URL"]; 
        $a4 = r_u($a0["cTime"]);    
        //$a5= $a0["NewsID"];     
       $xml ='<a>'.$a4.' :   '.$a2.'</a>';
       //$xml1 ='<a href="'.$ud.'"  target="tv">'.$a5.' : '.$a4.'</a>';
echo $xml;
}}}
function ttiao($url) {
       $wk= array("__all__","news_hot","news_world","news_society","news_finance","news_tech","news_military","news_discovery","news_regimen","video","subv_society",
"subv_funny","news_car","news_entertainment","news_sports","news_food","news_history","essay_joke");
       //$tk= array("0","1524308121","1524313404","-1");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
       $u = $_GET['u']?$_GET['u']:"1";
       $year = date("Y");
       $mouth = date("m")+1-1;
       $tmm = date("H");
       $nmouth = "";
    if($mouth<10) $nmouth='0'.$mouth;else $nmouth=$mouth;
       $day = date("d")+1-1;
    if($day<10) $nday='0'.$day;else $nday=$day;
       $t = $_GET['t']?$_GET['t']:$day;
       $wnk = $wk[$w];
       //$tnk = $tk[$t];
       $st = $year.'-'.$nmouth.'-'.$nday;
       $tt = time();
       $nt = strtotime('now');
//for($i=1;$i<=$p;$i++){}
       $ul2 = 'https://www.toutiao.com/api/pc/feed/?max_behot_time='.$nt.'&category='.$wnk.'&utm_source=toutiao&widen=1&tadrequire=true&_signature=_02B4Z6wo00d01tW4nxwAAIBCTBxmI.sahGbVvZuAAOsIHnBvjHCW8oOMGzZcdYi5WjgP2WUfVjuJogyoXh09M978aTK2I1rhPP5AbTgWZetHtBK0I8fJ1u6lkD5872tlp9xS1XScHGT5UoaKed'; 
       $ul1 = 'https://www.toutiao.com/api/pc/feed/?min_behot_time=0&max_behot_time='.$nt.'&category='.$wnk.'&utm_source=toutiao&widen=1&tadrequire=true&_signature=_02B4Z6wo00f01om4EDgAAIBCEBzpBdUrwgKJvRSAAP4HWtCVPLbazk1ek1j1.Cj3VLa59sCjmgaMgWnZ3eOVkaesNbNRRyr38COHdoLkRSHyYvVCj47n2U9MeYjp8dmdbr-gATorIJhQ7f9xc2'; 
       $ut = J_d(m_v($ul2),ture);
       $aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = m_u(r_u($a0["abstract"]));
       $a2 = m_u(r_u($a0["title"]));
       $a3 = m_u(r_u($a0["source"]));
       $a4 = t_m($a0["behot_time"]);
       $a5 = $a0["source"];
       $xml ='<a>'.$a4.' : '.$a1.' </a>';
echo $xml;
	}}
function ttso($url) {
       //$mm=date("m");
       //$mt=date("d");
       //$tt=$mm.$mt;
       $ww = $_GET['w']?$_GET['w']:date("m").'-'.date("d");
       $kw=k_w($ww); 
       $p = $_GET['p']?$_GET['p']:1; 
       $tte = time();
       $ttn = strtotime('now');
    for($i=0;$i<=$p;$i++){
       $p1 = $i*20; 
       $ul1 = 'https://www.toutiao.com/api/search/content/?aid=24&app_name=web_search&offset=60&format=json&keyword='.$kw.'&autoload=true&count=20&en_qc=1&cur_tab=1&from=search_tab&pd=synthesis&timestamp=1603670200525&_signature=_02B4Z6wo00f018DOkCAAAIBDWWppH.BGmjPAy5SAAK-wLBfTjfoqpttd2kRAzUU-YAO2XURA5N9Ql.ljA41dsc.ZzLbiSYV1GBi4zpBR4El9PoVxODe2uUDoIyiLqvIlfr7gjn3TXI5mG-Occ8';
       $ul2 = 'https://www.toutiao.com/api/search/content/?aid=24&app_name=web_search&offset='.$p1.'&format=json&keyword='.$kw.'&autoload=true&count=20&en_qc=1&cur_tab=1&from=search_tab&pd=synthesis&timestamp='.$ttn.'&_signature=_02B4Z6wo00d015WYengAAIBDDDyDRDi-1-eVnX7AALr7rt8S6j0BieybByFOCiYTToliOewNr1CGlIqgjn1eaTAG5h5ylC547vV8RrIO1X-6tr16ztXaORR0o6mCxvb.n5861m9Pep.t4nYC2c';
       $ut = J_d(m_v($ul1),ture);
       $aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = m_u(r_u($a0["abstract"]));
       $a2 = $a0["article_url"];
       $a4 = t_m($a0["behot_time"]);
       $a5 = $a0["source"];
       $a6 = $a0["datetime"];
       $a7 = m_u(r_u($a0["summary"]));
    $xml ='<a>'.$a4.' : '.$a1.'</a>';
    //$xml ='<a href="'.$a2.'" target="b" >'.$a6.' : '.$a1.'</a>';
echo $xml;
	}}}
function dftt($url) {
       $wk= array("all","mainland","world","society","mil","tech","finance","history","health","home","ent","sports");
       $w = $_GET['w']?$_GET['w']:0; 
       $p = $_GET['p']?$_GET['p']:2; 
        $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
        $i1 = '-'.$i;
   if ($i == '1')  $i2=null;else  $i2=$i1;
       $ur = 'http://mini.eastday.com/listpage/'.$wnk.''.$i2.'.html';
       $ul = m_v($ur);
preg_match_all('#<li><div><a href="([^>]+)" pdata="(.*)"(.*)>([^>]+)</a>(.*)<em>([^>]+)</em></li>#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a2=$d[1][$k];
	$a3=m_U($d[4][$k]);
	$a4=$d[6][$k];
        $a5 = 'http://mini.eastday.com'.$a2.'';
	$ud=$a5;
        $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="b" > '.$a4.': '.$a3.'</a>';
echo $xml;
	}}}
function jin10($url) {//+8*3600
       $p = $_GET['p']?$_GET['p']:1;
       $ul1 = 'https://www.jin10.com/newest_1.js?';
       $ul2 = 'https://www.jin10.com/flash_newest.js';
       $ut = m_v($ul2);
 preg_match("|var newest = (.*);|", $ut,$b);
       $nt = J_d($b[1],ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a20 = strtotime($a0["time"]);
       $a2= date("Y-m-d H:i:s",$a20);
       $a21 =$a2.': ' ;
       $a3 = m_u($a0["data"]["content"]);
   if(stripos($a3,'<img src=') != false){ 
         $a21 = false;
         $a3  = false;
} 
       $xml ='<a>'.$a21.'   '.$a3.'</a>';
echo $xml;
}}
function jin2($url) {
       $p = $_GET['p']?$_GET['p']:200;
       $p1 = 50;
       $ul21 = 'https://m.jin10.com/flash?jsonpCallback=jQuery1111008383088390442583_1526723999186&maxId=0&count=';
       $ul2 = 'https://flash-api.jin10.com/get_flash_list?channel=-8200&vip=1&max_time=2021-11-12&t=1636073906064';
       $ul3 = 'http://www.jin10.com/?oem';
       $ut = f_g($ul21);   
       /*$nt = J_d($ut,ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a3 = $a0["time"];
       $a4 = m_u($a0["data"]["content"]);
       $xml ='<a>'.$a3.':  '.$a4.'</a>';*/
echo $ut;
}
function jin21($url) {
       $p = $_GET['p']?$_GET['p']:200;
       $p1 = 50;
       $ul21 = 'https://www.jin10.com/example/jin10.com.html';
       $ul2 = 'https://flash-api.jin10.com/get_flash_list?channel=-8200&vip=1&max_time=2021-11-05&t=1636073906064';
       $ul3 = 'http://www.jin10.com/?oem';
       $ut = m_v($ul2);   
 preg_match_all('|(.*)#(.*)#([^<]+)#([^<]+)#####([^<]+)###([^<]+)|ismU',$ut,$b);
 foreach($b[3] as $k=>$v){
       $a3 = $b[3][$k];
       $a4 = m_u($b[4][$k]);
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a3.':  '.$a4.'</a>';
echo $xml;
}}
function xgbb($url) {
       $wk= array("1","2","3");
       $tk= array("3725","2856","2821","2822","2830","2823");
       $w = $_GET['w']?$_GET['w']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:2; 
       $p1 = $p*50; 
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i=1;$i<=$p;$i++){}
 $ul ='https://baoer-api.xuangubao.cn/api/v6/message/newsflash?limit='.$p1.'&cursor=&subj_ids=9,10,723,35,469&platform=pcweb';
preg_match("|\"messages\":\[\{(.*)\}\],\"next_cursor\"|",m_v($ul),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0['id'];
        $a2 = m_u($a0['title']);
        $a3 = t_m($a0['created_at']-28800);
        $a4 = $a0['summary'];
     $xml ='<a>'.$a3.':'.$a2.'</a>';
echo $xml;
}}
function cnfol($url) {
       $wk= array("guoneicaijing","zhengquanyaowen","guojicaijing","chanyejingji","jingjiguancha");
       $w=$_GET['w']?$_GET['w']:0;
   if ($w == '')  $w='guoneicaijing';else  $w=$w;
       $p = $_GET['p']?$_GET['p']:"2";
       $wnk = $wk[$w];
       $news='';
   if ($wnk == 'jingjiguancha')  $news='review';else  $news='news';
   if ($p == '')  $p=1;else  $p=$p;
   if ($p == '1')  $t=null;else  $t='_0'.$p;
    //for($i=1;$i<=$p;$i++){}
       $p1= $p*50;
 $url ='http://gold.cnfol.com/caijingyaowen/index'.$t.'.shtml';
 $url3 ='http://'.$news.'.cnfol.com/'.$wnk.'/index'.$t.'.shtml';
 $url2 ='http://app.cnfol.com/dataapi/index.php/kuaixundata/kuainewse?num1=0&num2='.$p1.'&strlen=25&cstrlen=200&callback=';
 $url21 ='http://app.cnfol.com/dataapi/index.php/kuaixundata/kuainewse?num1=0&num2='.$p1.'&strlen=25&cstrlen=200&callback=jQuery18304236997972750952_1525525446837';
        $ut = m_v($url2);
//preg_match("|\((.*)\)|",$ul,$b);
       //$ut = $b[1];
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i = 1; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = $a0["id"];
       $a2 = r_u($a0["Content"]);
       $a3 = t_m($a0["Addtime"]-28800);
       $a4 = $a0["CreatedTime"];
       $a5 = x_g($a0["DTime"]);
     $xml ='<a>'.$a3.':'.$a2.'</a>';
     //$xml ='<a>'.$a5.'     '.$a4.' :'.$a2.'</a>';
echo $xml;
}}
function taoguba($url) {
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.taoguba.com.cn/moreWonderList?pageNo='.$i.'&pageNum=';
        $ul = m_v($url);
preg_match_all("|<div class=\"wonder\">(.*)<div style=\"(.*)\">(.*)<a href='(.*)' class=\"wonderLink\" target=\"_blank\">(.*)</a>(.*)<div style=\"(.*)\">(.*)<span style=\"(.*)\">(.*)</span>&nbsp;&nbsp;(.*)</div>|ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[4][$k];
        $a3 = m_u($b[5][$k]);
        $a4 = $b[11][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}}
function fx1682($url) {//(https://wap.fx168.com/m/t/)
       $wk= array("3725","2856","2821","2822","2830","2823");
       $w = $_GET['w']?$_GET['w']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:1; 
       $wnk = $wk[$w];
       $tnk = $tk[$t];
    for($i0=1;$i0<=$p;$i0++){
 $ul1 ='https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid='.$wnk.'&pnum='.$i0.'&psize=50&callback=GetHistory';
 $ul2 ='https://api3.fx168api.com/cms/SudiList.aspx?psize=50&pnum='.$i0.'&callback=GetHistory&_=1607178349432';
preg_match("|\((.*)\)|",m_v($ul2),$d);
        $ut = $d[1];
        $aa = J_d($ut,ture);
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a2 = r_u($a0['send_content']);
        $a3 = $a0['docpuburl'];
        $a4 = $a0['firstpubtime'];
     $xml ='<a>'.$a4.':'.$a2.'</a>';
echo $xml;
}}}
function fx1680($url) {//(https://wap.fx168.com/m/t/)
       //$wk= array("3725","2856","2821","2822","2830","2823");
       $w = $_GET['w']?$_GET['w']:0; 
       //$t = $_GET['t']?$_GET['t']:0; 
       //$t = $_GET['t']?$_GET['t']:date('Y-m-d',strtotime('day'));
       $t = $_GET['t']?$_GET['t']:date('Y-m-d');
       $p = $_GET['p']?$_GET['p']:1; 
       $p1 =$p*20;
       //$wnk = $wk[$w];
       //$tnk = $tk[$t];
    for($ii=1;$ii<=$p;$ii++){
 $ul0 ='https://app5.fx168api.com/h5/newsExpress/getData_V2.json?callback=&pageSize='.$p1.'&firstPubTime='.$t.'%2023%3A59%3A59&';
 $ul10 ='https://app5.fx168api.com/h5/newsExpress/getData_V2.json?callback=jQuery33100326650617383375_1607180917859&pageSize='.$p1.'&firstPubTime='.$t.'%2023%3A59%3A59&';
 $ul1 ='https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid='.$wnk.'&pnum='.$ii.'&psize=100&callback=GetHistory';
 $ul2 ='https://api3.fx168api.com/cms/SudiList.aspx?psize=50&pnum=2&callback=GetHistory&_=1607178349432';
//preg_match("|\((.*)\)|",m_v($ul0),$d);
        //$ut = $d[1];
        $ut = m_v($ul0);
        $aa0 = J_d($ut,ture);
        $aa = $aa0["data"]["result"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        //$a3 = $a0['docpuburl'];
        $a4 = $a0['updateTime'];
        $a2 = m_u($a0['title']);
     $xml ='<a>'.$a4.':'.$a2.'</a>';
echo $xml;
}}}
function fx168($url) {//(https://wap.fx168.com/m/t/)
       $wk= array("3725","2856","2821","2822","2830","2823");
       $w = $_GET['w']?$_GET['w']:0; 
       $t = $_GET['t']?$_GET['t']:0; 
       $p = $_GET['p']?$_GET['p']:1; 
       $wnk = $wk[$w];
       //$tnk = $tk[$t];
    for($ii=1;$ii<=$p;$ii++){
 $ul0 ='https://app5.fx168api.com/h5/newsExpress/getData_V2.json?callback=jQuery33100326650617383375_1607180917859&pageSize=20&firstPubTime=2020-12-05%2017%3A40%3A09&';
 $ul1 ='https://api3.fx168api.com/historynews/GetHistoryNews.aspx?chid='.$wnk.'&pnum='.$ii.'&psize=100&callback=';
 $ul2 ='https://api3.fx168api.com/cms/SudiList.aspx?psize=50&pnum=2&callback=GetHistory&_=1607178349432';
//preg_match("|\((.*)\)|",m_v($ul1),$d);
        //$ut = $d[1];
        $ut = m_v($ul1);
        $aa = J_d($ut,ture);
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a2 = m_u($a0['doctitle']);
        $a3 = $a0['docpuburl'];
        $a4 = $a0['docfirstpubtime'];
     $xml ='<a>'.$a4.':   '.$a2.'</a>';
echo $xml;
}}}
function fx6780($url) {
       $wk= array("important","gold","silver","oil","stock");
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:2;
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
 $ul0 ='https://www.fx678.cn/kx/column?column='.$wnk.'';
 $ul4 ='https://m.fx678.cn/kx/column?publishTime='.$t.'&size=100&column='.$wnk.'&'.$wnk.'=true';
        $nt = m_s($ul0);
        $ut = J_d($nt,ture);
        $aa = $ut["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0['newsId'];
        $a2 = m_u($a0['newsTitle']);
        //$a3 = $a0['docpuburl'];
        $a4 = $a0['publishTime'];
        $a5 = str_replace('T',' ',$a4);
        $a6 = str_replace('.000+0800','',$a5);
     $xml ='<a>'.$a6.'&nbsp;&nbsp;'.$a2.'</a>';
echo $xml;
}}}
function fx678($url) {
       $wk= array("important","gold","silver","oil","stock");
       $w = $_GET['w']?$_GET['w']:0; 
       $th= date("d") +2;
       //$t = $_GET['t']?$_GET['t']:date('Y').'-'.date('m').'-'.$th;
       //$t = $_GET['t']?$_GET['t']:date('Y-m-d')  +2;
       $t = $_GET['t']?$_GET['t']:date('Y-m-d',strtotime('+1 day'));
       $p = $_GET['p']?$_GET['p']:2;
       $wnk = $wk[$w];
    for($i=1;$i<=$p;$i++){
 $ul0 ='https://m.fx678.cn/news/columnPageNews?page='.$i.'&column=10119';
 $ul3 ='https://m.fx678.cn/kx/moreNews?publishTime='.$t.'&size=100';
 $ul4 ='https://m.fx678.cn/kx/column?publishTime='.$t.'&size=100&column='.$wnk.'&'.$wnk.'=true';
        $nt = m_v($ul3);
        $ut = J_d($nt,ture);
        $aa = $ut["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["newsID"];
        $a3 = $a0['createDate'];
        $a2 = m_u($a0['newsTitle']);
        //$a2 = m_u($a0['newsSummary']);
        $a4 = $a0['publishTime'];
        $a5 = str_replace('T',' ',$a4);
        $a6 = str_replace('.000+0800','',$a5);
     $xml ='<a>'.$a6.'&nbsp;&nbsp;'.$a2.'</a>';
echo $xml;
}}}
function fx678y($url) {
       $wk= array("important","gold","silver","oil","stock");
       $w = $_GET['w']?$_GET['w']:0; 
       $p = $_GET['p']?$_GET['p']:2;
       $t = $_GET['t']?$_GET['t']:date("d")+1;
       $yar = date("Y").date("m").$t;
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
 $ul0 ='https://3g.fx678.com/news/more/NEWS_YAO_WEN/'.$yar;
 $ul3 ='https://3g.fx678.com/Live/more/.$yar';
        $ut = J_d(m_v($ul0),ture);
        //$aa = $ut["data"];
        $aa = $ut["news"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        //$a2 = r_u($a0['NEWS_TITLE']);
        $a2 = r_u($a0['NewsTitle']);
        //$a4 = $a0['PUBLISHTIME'];
        $a4 = $a0['NewsTime'];
     $xml ='<a>'.$a4.'&nbsp;&nbsp;'.$a2.'</a>';
echo $xml;
}}}
function gold678($url) {
       $wk= array("important","gold","silver","oil","stock");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
 $ul2 ='https://www.gold678.com/live/column?column='.$wnk.'';
       $nt = m_s($ul2);
       $aaa = J_d( $nt,ture);
       $aa = $aaa["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["newsId"];
       $a2 = m_u($a0["newsTitle"]);
       $a3 = t_m($a0["NewsTime"]);
       $a4 = $a0["publishTime"];
       $a5 = str_replace('T',' ',$a4);
       $a6 = str_replace('.000+0800','',$a5);
       $a7 = t_m($a0["publishTime"]/1000);
     $xml ='<a>'.$a6.' &nbsp;&nbsp;'.$a2.'</a>';
echo $xml;
}}}
function yycj($url) {
       $wk= array("0","2");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:0;
       $wnk = $wk[$w];
    for($i=0;$i<=$p;$i++){
       $tm = time()-$i*3600;
 $ul0 ='http://live.123.com.cn/7x24/?cid=692&time='.$tm.'&type=2';
 $ul1 ='http://live.123.com.cn/7x24/?cid=692&type=0';
       $nt = m_v($ul0);
preg_match("|\{\"list\":(.*)\}\}|",$nt,$b);
       $ut = $b[1];
       $aa = J_d($ut,ture);
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a3 = m_u($a0['NewsTitle']);
        $a4 = $a0['NewsType'];
        $a5 = $a0['CreateDate'];
        $a6 = t_m($a0['second']-28800);
     $xml ='<a>'.$a6.':&nbsp;&nbsp;'.$a3.'</a>';
echo $xml;
}}}
function lxrt($url) {
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.55188.com/forumdisplay.php?fid=68&orderby=dateline&page='.$i.'';
        $ul = m_v($url);
preg_match_all('|<th class="new" >(.*)<span id="(.*)" class="forumdisplay"><a href="(.*)" target="_blank">(.*)</a></span>(.*)</th>(.*)<td class="author">(.*)<cite>(.*)<a href="(.*)">(.*)</a>(.*)</cite>(.*)<em class="ad_(.*)" >(.*)</em>(.*)</td>(.*)<td class="nums"><strong>(.*)</strong><em>(.*)</em></td>(.*)<td class="lastpost">(.*)<cite><a href="(.*)">(.*)</a></cite>(.*)<em><a href="(.*)">(.*)</a></em>(.*)</td>|ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[3][$k];
        $a3 = $b[4][$k];
        $a5 = 'http://www.55188.com/'.$a2;
        $a6 = m_u($b[10][$k]);
        $a7 = m_u($b[14][$k]);
        $a8 = $b[25][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="b" >'.$a6.':'.$a3.'  |'.$a7.'('.$a8.')</a>';
echo $xml;
}}}
function lxxz($url) {
	$ul =$_GET["f"];
        $ut = m_v($ul);
preg_match_all('|<img src="(.*)" border="0" class="absmiddle" alt="" />(.*)<a href="(.*)" onclick="return confirm|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a4=$d[3][$k];
       $a7='http://www.55188.com/'.$a4;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a7.'" target="_blank" >下载</a>';
echo $xml;
}}
function tdxqs($url) {//通达信取数
     SetCookie("FullCookie", "Full cookie value", time()+3600, "/forum", "http://www.55188.com/logging.php?action=login&formhash=19a4dc8e&referer=index.php&username=%BC%CE%B6%A8%B3%C2&password=cq700708&answer=0&loginsubmit=%B5%C7%C2%BC", 1);
        $wk= array("https://www.55188.com/thread-8128859-2999-1.html","https://www.55188.com/thread-8935896-2999-1.html","https://www.55188.com/thread-8777006-2999-1.html");
        $w = $_GET['w']?$_GET['w']:"0";
        $wnk = $wk[$w];
if($w>5) $wnk=$w;else $wnk=$wnk;
        $url=$wnk;
    //setcookie( "1168545",  "嘉定陈",  time() + 3600,  "/", $url, 1 ); 
        $day = date("d");
        $zm1=m_g('正版用户');
        $zm2=m_g('取数时间:');
        $ri=m_g('日');
        $rr='2019';
        //$fh1=' - ';
        //$fh2='；';
        $ut = m_v($url);
preg_match_all('|<div class="nei ">
(.*)<|ismU',$ut,$d);
//preg_match_all("|<div class=\"nei \">([^>]+)2019([^>]+)".date("j")."".$ri."([^>]+)<|ismU",$ut,$d);
//preg_match_all("|<div class=\"nei \">([^>]+)".$rr."([^>]+)<|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=m_u($d[1][$k]);
       //$a3=m_u($d[2][$k]);
       //$a4=m_u($d[3][$k]);
       //$ud=$a2.'&nbsp;&nbsp;2019'.$a3.$day.m_u($ri).$a4;
       $ud=$a2;
       //$ud2=$a2.'&nbsp;&nbsp;2019'.$a3;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$ud.'</a>';
echo $xml;
}}

function wpxz($url) {
        $w=$_GET['f'];
        $url =$w;
        $ul = m_v($url);
preg_match_all("|\"is_stream\":([^>]+),\"url\":\"([^>]+)\",(.*)\"download_list\":\[\"([^>]+)\",|ismU",$ul,$b);
foreach($b[1] as $k=>$v){
        $a4 = x_g($b[2][$k]);
        $ud =$a4;
        //$v=Current(explode('?',$v));
  header("location: $ud");
     //$xml ='<a href="'.$ud.'" target="b" >下载</a></br>';
//echo $xml;
}}

function ckxz($url) {
	$ul =$_GET["f"];
        $ut = m_v($ul);
preg_match_all('|<div class="tip tip_(.*)" id="attach_(.*)_menu" style="(.*)" disautofocus="true">|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=b_d($d[2][$k]);
       $a3=$d[3][$k];
       $a4='http://www.ckplayer.com/bbs/forum.php?mod=attachment&aid='.$a2.'%3D';
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a4.'" target="_blank" >下载</a>';
echo $xml;
}}
function lxsc($url) {
 $url ='http://www.58188.com/news/Classjs/sccw50.js';
        $ul = f_g($url);
preg_match_all('#<a href=(.*) target=_blank>(.*)</a></td><td(.*)>(.*)</td>#U',$ul,$b);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[2][$k]);
        $a4 = $b[4][$k];
        $vd=Current(explode('?',$v));
     $xml ='<br><a href="'.$a2.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}
function lxzq($url) {//证券要闻;
       $wk= array("zqyw","zqyw","qysx","tdx","ths","dzhL2","dzh","zqyw");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
       $ur ='';
       $ur1 = 'http://www.58188.com/news/Classjs/'.$wnk.'50.js'; 
       $ur2 = 'http://www.58188.com/invest/Classjs/'.$wnk.'20.js'; 
       $ur6 = 'http://www.58188.com/gpgs/news/Classjs/'.$wnk.'50.js'; 
   if ($w == '2')  $ur=$ur2;else if($w=='4'||$w=='5'||$w=='6'||$w=='3') $ur=$ur6;else  $ur=$ur1;
       $ul = f_g($ur);
preg_match_all('#<a href=([^<]+)target=_blank>([^<]+)</a><(.*)>(.*)<(.*)>([^<]+)<#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=m_u($d[2][$k]);
        $a5=$d[6][$k];
        $a6 = 'http://www.58188.com'.$a3;
   if ($w == '2')  $ur=$ur2;else if($w=='4'||$w=='5'||$w=='6'||$w=='3') $a6=$a3;else  $a6=$a6;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a6.'" target="b" >'.$a4.'('.$a5.')</a>';
echo $xml;
	}}
function lxzq2($url) {
       $wk= array("qysx","fxtz","tzhlw","jjdt","smjj","jjxx","jjzc","jjfx","hsjj","jjgd","rmbdt","fc","qh","hj");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $ur ='';
       $ur1 = 'http://www.58188.com/news/newslook.asp?page='.$i.'&lm='.$wnk.''; 
       $ur2 = 'http://www.58188.com/invest/newslook.asp?page='.$i.'&lm='.$wnk.''; 
       $ur3 = 'http://www.58188.com/fund/news/newslook.asp?page='.$i.'&lm='.$wnk.''; 
       $ur4 = 'http://www.58188.com/forex/whnews/newslook.asp?page='.$i.'&lm='.$wnk.''; 
       $ur5 = 'http://www.58188.com/new/newslook1.asp?page='.$i.'&lm='.$wnk.''; 
       $ur6 = 'http://www.58188.com/gpgs/news/Class/'.$wnk.'/'.$wnk.''.$i.'.html'; 
   if($w=='0'|$w=='1'|$w=='2') $ur=$ur2;else if($w=='3'|$w=='4'|$w=='5'|$w=='6'|$w=='7') $ur=$ur3;else if($w=='8'|$w=='9'|$w=='10') $ur=$ur4;else if($w=='11'|$w=='12'|$w=='13') $ur=$ur5;else $ur=$ur1;
       $ul = f_g($ur);
preg_match_all("#<a href=..\/([^<]+)target=_blank>([^<]+)</a></td>(.*)<td(.*)><a(.*)>([^<]+)</a>#ismU",$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=m_u($d[2][$k]);
        $a5=$d[6][$k];
        $a6 = 'http://www.58188.com/'.$a3;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a6.'" target="b" >'.$a4.' ('.$a5.')</a>';
echo $xml;
	}}}
function lxzq3($url) {
       $wk= array("tdx","ths","dzhL2","dzh");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $ur ='';
       $ur2 = 'http://www.58188.com/gpgs/news/Class/'.$wnk.'/'.$wnk.'0'.$p.'.html'; 
       $ul = f_g($ur2);
preg_match_all('#<a href=([^<]+)target=_blank>([^<]+)</a></td><td(.*)>([^<]+)</td></tr>#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=m_u($d[2][$k]);
        $a5=$d[4][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a3.'" target="b" >'.$a4.' ('.$a5.')</a>';
echo $xml;
	}}}
function tdxtest($url) {
       $w = $_GET['w']?$_GET['w']:'187124';
       $p = $_GET['p']?$_GET['p']:'';
       $ur = 'http://fk.tdx.com.cn/dispbbs.asp?boardid=44&Id=187124'; 
       $ul = f_g($ur);
preg_match_all('#>201([^<]+)-(\d++)-(\d++)(.*)<#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=$d[2][$k];
        $a5=$d[3][$k];
        $a6='201'.$a3.'-'.$a4.'-'.$a5;
        $a7='http://www.tdx.com.cn/products/level2/new_tdx_test'.$a4.$a5.'.exe';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a7.'" target="b" >'.$a4.$a5.'</a>';
echo $xml;
	}}
function tdxzx($url) {
       $w = $_GET['w']?$_GET['w']:'187124';
       $p = $_GET['p']?$_GET['p']:'';
       $ul1 = 'http://page.tdx.com.cn:7615/site/pcwebcall/html/pc_tcld_bkzx.html?&color=0'; 
       $ul2 = 'http://page.tdx.com.cn:7615/TQLEX?Entry=CWServ.pcwebcall_tcld_bkzx{"Params":["2","0"]}'; 
       $ul = J_d(f_g($ul2),true);
       $ut = $ul["Content"];
/*preg_match_all('#>201([^<]+)-(\d++)-(\d++)(.*)<#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=$d[2][$k];
        $a5=$d[3][$k];
        $a6='201'.$a3.'-'.$a4.'-'.$a5;
        $a7='http://www.tdx.com.cn/products/level2/new_tdx_test'.$a4.$a5.'.exe';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a7.'" target="b" >'.$a4.$a5.'</a>';*/
echo $ut;
	}
function gggg($url) {
       $w = $_GET['w']?$_GET['w']:'600000';
       $p = $_GET['p']?$_GET['p']:'';
       $ur = 'http://www.sse.com.cn/js/common/stocks/new/'.$w.'.js'; 
       $ul = f_g($ur);
preg_match_all('#stock_code:"([^<]+)"(.*)bulletin_date:"([^<]+)"(.*)bulletin_large_type:"([^<]+)"(.*)bulletin_title:"([^<]+)"(.*)bulletin_file_url:"([^<]+)"#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
	$a4=$d[3][$k];
        $a5=m_u($d[7][$k]);
        $a6=$d[9][$k];
        $a7='http://www.sse.com.cn'.$a6;
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a7.'" target="b" >'.$a4.' '.$a5.'</a>';
echo $xml;
	}}
function ggxw($url) {
       $w = $_GET['w']?$_GET['w']:'([^<]+)';
       $p = $_GET['p']?$_GET['p']:'';
       //$ul2 = 'http://www.sse.com.cn/disclosure/listedinfo/announcement/s_docdatesort_desc_2016openpdf.htm'; 
       $ul = 'http://www.sse.com.cn/disclosure/listedinfo/announcement/json/stock_bulletin_publish_order.json?'; 
       $ul3 = 'http://www.sse.com.cn/js/common/companyissuebulletinInformation/companyissuebulletin_new.js?';
       $ut = J_d(m_v($ul),true);
       $nt = $ut["publishData"];
       $aa = $nt;
       $count_json = count($aa);
 for ($i = 0; $i < $count_json; $i++) {
       $a0 = $aa[$i];
       $a1 = $a0["discloseId"];
       $a2 = $a0["discloseDate"];
       $a3=m_u($a0["bulletinTitle"]);
	$a4=$a0["publishTime"];
        $a5='http://www.sse.com.cn'.$a0["bulletinUrl"];
        $a6=$a0["securityCode"];
	$xml ='<a href="'.$a5.'" target="b" >'.$a4.' '.$a3.'   ('.$a6.')</a>';
echo $xml;
	}}
function qqxw($url) {
       $wk= array("top","world","finance","digi","ent","milite","auto","finance_stock","antip","tech");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;$i++){
 $url ='https://pacaio.match.qq.com/irs/rcd?cid=137&token=d0f13d594edfc180f5bf6b845456f3ea&id=&ext='.$wnk.'&page='.$i.'&callback=__jp5';
 $url2 ='https://pacaio.match.qq.com/irs/rcd?cid=135&token=6e92c215fb08afa901ac31eca115a34f&ext=world&page='.$i.'&expIds=&callback=__jp5';
        $ul = m_v($url);
preg_match_all('#"intro":"([^<]+)"#ismU',$ul,$b);
//preg_match_all('#"nick":"([^<]+)"#ismU',$ul,$b1);
preg_match_all('#"publish_time":"([^<]+)",#ismU',$ul,$b2);
//preg_match_all('#"rose_url":"([^<]+)"#ismU',$ul,$b3);
        foreach($b[1] as $k=>$v){
        $a2 = m_u($b[1][$k]);
        //$a1 = r_u($b1[1][$k]);
        $a3 = $b2[1][$k];
        //$a4 = x_g($b3[1][$k]);
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$a3.': '.$a2.' </a>';
echo $xml;
}}}
function qqxw2($url) {
       //$wk= array("top","world","finance","digi","ent","milite","auto","finance_stock","antip","tech");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $ww=substr($w,0,1);
     if($ww =="6") $ss='sh';else $ss='sz';
       $sss=$ss.$w;
       $p = $_GET['p']?$_GET['p']:2;
    for($ii=1;$ii<=$p;$ii++){
 $ul1 ='http://web.ifzq.gtimg.cn/appstock/news/info/search?page='.$ii.'&symbol='.$sss.'&n=51&_var=finance_notice&type='.$t.'&_appver=1.0&';
 $ul2 ='http://web.ifzq.gtimg.cn/appstock/news/info/search?page='.$ii.'&symbol='.$sss.'&n=51&_var=finance_notice&type=2&_appver=1.0&_=1599750243677';
        $ul = m_v($ul1);
preg_match_all('#"time":"([^<]+)"#ismU',$ul,$b);
preg_match_all('#"symbol":"([^<]+)",#ismU',$ul,$b2);
preg_match_all('#"title":"([^<]+)"#ismU',$ul,$b3);
preg_match_all('#"url":"([^<]+)"#ismU',$ul,$b4);
preg_match_all('#"src":"([^<]+)"#ismU',$ul,$b5);
        foreach($b[1] as $k=>$v){
        $a1 = m_u($b[1][$k]);
        $a2 = m_u($b2[1][$k]);
        $a3 = m_u(r_u($b3[1][$k]));
        $a4 = x_g($b4[1][$k]);
        $a5 = $b5[1][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a4.'" target="b" >'.$a1.': ( '.$a2.' ) '.$a3.'  </a>';
     //$xml ='<a>'.$a1.': '.$a2.' '.$a3.'  </a>';
echo $xml;
}}}
function qqwb($url) {
       $w = $_GET['w']?$_GET['w']:see;
 $ul ='http://e.t.qq.com/'.$w.'?pref=qqcom.tpeople';
        $ut = m_v($ul);
preg_match_all('#<div class="msgCnt"><a href="([^<]+)" target="_blank">([^<]+)</a>([^<]+)</div>#ismU',$ut,$b);
preg_match_all('#<div class="picBox">(.*)<a href="([^<]+)"(.*)data-like=#ismU',$ut,$b2);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[2][$k]);
        $a4 = $b[3][$k];
        $a5 = $b2[1][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a><a href="'.$a5.'" target="b" >'.$a3.' '.$a4.'</a>';
echo $xml;
}}
function qqgd($url) {
       $w = $_GET['w']?$_GET['w']:news;
 $ul ='http://roll.news.qq.com/interface/roll.php?&cata=&site=news&date=&page=1&mode=1&of=json';
        $ut = x_g(f_g($ul));
//preg_match_all('#<li><span class="t-time">([^<]+)</span><span class="t-tit">([^<]+)</span><a target="_blank" href="([^<]+)">([^<]+)</a></li>#ismU',$ut,$b);
//foreach($b[1] as $k=>$v){
        //$a2 = $b[1][$k];
        //$a3 = m_u($b[2][$k]);
        //$a4 = $b[3][$k];
        //$a5 = m_u($b[4][$k]);
        //$a6 = ':';
        //$ud = ''.$a2.''.$a6.''.$a5.''.$a3.'';
        $vd=Current(explode('?',$v));
     //$xml ='<a><a href="'.$a4.'" target="b" >'.$a2.''.$a6.''.$a5.''.$a3.'</a>';
     $xml ='<a>'.$ut.'</a>';
echo $xml;
}
function hqwh($url) {
       $p = $_GET['p']?$_GET['p']:1;
       $ye=date('Y');
    for($i=1;$i<=$p;$i++){
 $url ='http://www.cnforex.com/news/jrsc/default.aspx?shwqg='.$i.'';
 //$url ='http://live.cnforex.com/home/getmore?md5=d1c4496c0884518f1b4e696472a9ccaa';
 //$url ='http://live.cnforex.com/home/getwhere?area=1&area=2&area=16&undefined=undefined&variety=1&type=Post&dataType=json';
 //$url ='http://live.cnforex.com/home/GetMore?area=1&area=2&area=16&undefined=undefined';
 //$url ='http://live.cnforex.com/home/m';
        $ul = m_v($url);
preg_match_all('#<td class="first" style="(.*)">(.*)<a href="(.*)" target="_blank" title="(.*)" tag="(.*)">(.*)</a>(.*)</td>(.*)<td class="(.*)" style="(.*)">(.*)<div onclick="(.*)" title="(.*)">(.*)</div>(.*)</td>(.*)<td style="(.*)">(.*)</td>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[3][$k];
        $a3 = m_u($b[4][$k]);
        $a4 = $b[18][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$ye.'&nbsp;'.$a4.' :'.$a3.'</a>';
echo $xml;
}}}
function tgbzx($url) {
       $wk= array("A","H","HR","K","vip");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk =$wk[$w];
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='https://shuo.taoguba.com.cn/newsFlash/getAllNewsFlash?type='.$wnk.'&pageNo='.$i;
 $url2 ='https://shuo.taoguba.com.cn/newsFlash/getAllNewsFlash?type='.$wnk.'&pageNo='.$i;
        $ut = m_v($url);
       $nt = J_d($ut,ture);
       $aa = $nt["dto"]["list"];
       $count_json = count($aa);
 for ($ii = 0; $ii < $count_json; $ii++) {
       $a0 = $aa[$ii];
       $a1 = $a0["id"];
       $a2 = $a0["shuoID"];
       $a3 = m_u($a0["subject"]);
       $a4 = m_u($a0["summary"]);
       $a5 = m_u($a0["body"]);
       $a6 = t_m($a0["ctime"]-28800);
       $a7 = $a0["date"];
       $a8 = $a0["time"];
     $xml ='<a>'.$a6.' :  '.$a5.'</a>';
echo $xml;
}}}
function tgb($url) {
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.taoguba.com.cn/moreWonderList?pageNo='.$i.'&pageNum=30';
        $ul = m_v($url);
preg_match_all("#<div class=\"wonder\">(.*)<div style=\"(.*)\">(.*)<a href='(.*)' class=\"wonderLink\" target=\"_blank\">(.*)</a>(.*)<div style=\"(.*)\">(.*)<span style=\"(.*)\">(.*)</span>&nbsp;&nbsp;(.*)</div>#ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[4][$k];
        $a3 = m_u($b[5][$k]);
        $a4 = m_u($b[11][$k]);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}}
function tgb1($url) {
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.taoguba.com.cn/moreWonderList?pageNo='.$i.'&pageNum=';
        $ul = m_v($url);
preg_match_all("#<div class=\"wonder\">(.*)<div style=\"(.*)\">(.*)<a href='(.*)' class=\"wonderLink\" target=\"_blank\">(.*)</a>(.*)<div style=\"(.*)\">(.*)<span style=\"(.*)\">(.*)</span>&nbsp;&nbsp;(.*)</div>#ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[4][$k];
        $a3 = m_u($b[5][$k]);
        $a4 = m_u($b[11][$k]);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="_blank" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}}
function tgb2($url) {
       $w=strtoupper($_GET['w']);
   if ($w == '')  $w='A';else  $w=$w;//523494//479363//252069//269977//444409;
       $p = $_GET['p']?$_GET['p']:5;
    for($i=1;$i<=$p;$i++){
 $url1 ='http://www.taoguba.com.cn/viewMoreTop?topFlag='.$w.'&pageNo='.$i.'';
 $url2 ='http://www.taoguba.com.cn/moreCredit?pageNum=10&pageNo='.$i.'&sortType=F';
   if ($w == 'F')  $url=$url2;else  $url=$url1;
        $ul = m_v($url);
preg_match_all("#<div style=\"(.*)\">(.*)<span class=\"font5\">(.*)</span><a target=\"_blank\"(.*)href='blog\/(.*)'>(.*)</a>(.*)</div>(.*)<div style=\"(.*)\">#ismU",$ul,$b2);
 $arr=count($b2[1]);
 if($arr!="")for($i2=1;$i2<=$arr;$i2++){
        foreach($b2[1] as $k2=>$v2){
        $a0 = $b2[5][$k2];
        $a1 = m_u($b2[6][$k2]);
        $tgb=$a0;
    $xml ='<a href="'.$fname.'?tgb='.$a0.'" >'.$i.'-'.$i2++.'): '.$a1.'('.$a0.')</a>'."\n";
echo $xml;
}}}}
function tgb3($url) {
       $w = $_GET['w']?$_GET['w']:1; 
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.taoguba.com.cn/index?pageNo='.$i.'&blockID=1&flag='.$w.'&pageNum=';
        $ul = m_v($url);
preg_match_all("#<li class=\"pcdj08\"><a id =\"(.*)\" href=\"blog\/(.*)\" onmouseover=\"(.*)\" onmouseout=\"(.*)\" target=\"_blank\">(.*)</a></li>#ismU",$ul,$b);
preg_match_all("#<li class=\"pcdj03\">(.*)</li>#ismU",$ul,$b2);
preg_match_all("#<li class=\"pcdj06\">(.*)</li>#ismU",$ul,$b3);
preg_match_all("#<li class=\"pcdj02\">(.*)<a href=\"(.*)\" title='(.*)'   target=\"_blank\">(.*)</a>(.*)</li>#ismU",$ul,$b4);
        foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = m_u($b[5][$k]);
        $a5 = 'http://www.taoguba.com.cn/blog/'.$a2;
        $a6 = $b2[1][$k];
        $a7 = $b3[1][$k];
        $a8 = m_u($b4[3][$k]);
       $a9 = m_u("帖子：");
       $a10 = m_u("发帖时间：");
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.' ( '.$a2.' )'.$a9.''.$a8.'  |'.$a10.''.$a7.'|'.$a6.'</a>';
echo $xml;
}}}
function tgb4($url) {
       $w=$_GET['w'];
   if ($w == '')  $w='523494';else  $w=$w;//479363//252069//269977//444409;
 $url ='http://www.taoguba.com.cn/blog/'.$w.'';
        $ul = m_v($url);
preg_match_all("#<td class=\"table_bottom01 suh\" align=\"left\"><div><a href='(.*)' title='(.*)' target=\"_blank\">(.*)</a></div>(.*)</td><td class=\"table_bottom01\">(.*)</td><td class=\"table_bottom01\">(.*)</td>#ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[3][$k]);
        $a4 = m_u($b[6][$k]);
        $a5 = 'http://www.taoguba.com.cn/'.$a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="tv">'.$a3.'('.$a4.')</a>';
echo $xml;
}}
function tgb5($url) {
       $w=strtoupper($_GET['w']);
   if ($w == '')  $w='F';else  $w=$w;//523494//479363//252069//269977//444409;
       $p = $_GET['p']?$_GET['p']:5;
    for($i=1;$i<=$p;$i++){
 $url2 ='http://www.taoguba.com.cn/viewMoreTop?topFlag='.$w.'&pageNo='.$i.'';
 $url ='http://www.taoguba.com.cn/moreCredit?pageNum=10&pageNo='.$i.'&sortType='.$w.'';
        $ul = m_v($url);
preg_match_all("#userID=([^<]+)' class=\"font4\">(.*)</a>#ismU",$ul,$b2);
 $arr=count($b2[1]);
 if($arr!="")for($i2=1;$i2<=$arr;$i2++){
        foreach($b2[1] as $k2=>$v2){
        $a0 = $b2[1][$k2];
        $a1 = m_u($b2[2][$k2]);
    $xml ='<a href="'.$fname.'?tgb='.$a0.'" target="tv">'.$i.'-'.$i2++.'): '.$a1.'('.$a0.')</a>';
echo $xml;
}}}}

function swb($url) {
        $w = $_GET['w']?$_GET['w']:date("Y"); 
        $w=k_w($w);
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $ri = ''.$year.$mon.$day.'';
       for ($i = 1; $i <=1; $i++) {
	$ul = 'http://www.mofcom.gov.cn/column/todayupdateoncle.shtml?www/'.$year.'/'.$mon.'/'.$ri.'';
	//$ul = 'http://www.mofcom.gov.cn/todayupdates/datenews1.html';
        $ut = m_v($ul);
preg_match_all('|<a class="todaytitle" href="(.*)" target="_blank">(.*)</a>(.*)<font class="todaytime">(.*)</font></td>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a4=$d[1][$k];
       $a5=m_u($d[2][$k]);
       $a6=$d[4][$k];
       $v=Current(explode('?',$v));
	$xml ='<a href="'.$a4.'" target="_blank" >'.$a5.' ('.$a6.')</a> ';
echo $xml;
}}}
function futu($url) {
       $p = $_GET['p']?$_GET['p']:2;
       for ($i1 = 0; $i1 <=$p; $i1++) {
       $p1 =$i1*50;
 $ul2 ='https://news.futunn.com/main/live-list?page=0&page_size='.$p;
 $ul ='https://news.futunn.com/main/live-list?page='.$i1.'&page_size=50';
       $ut = J_d(m_v($ul),true);
       $aa = $ut["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a3 = $a0["content"];
       $a4 = t_m($a0["timestamp"]-28800);
     $xml ='<a>'.$a4.':  '.$a3.'</a>';
echo $xml;
}}}
function rmwjs($url) {
       $w=$_GET['w']?$_GET['w']:'military';
       $t=$_GET['t'];
   if ($w == 'military')  $t='172467';else if($w == 'finance')  $t='70846';else  $t=$t;
       $p=$_GET['p']?$_GET['p']:"";
   if ($p == '')  $p=null;else  $p=$p;
    for($i=$p;$i<=$p;$i++){
 $url ='http://'.$w.'.people.com.cn/GB/'.$t.'/index'.$i.'.html';
        $ul = m_v($url);
preg_match_all("#<li><a href='([^<]+)'(.*)>([^<]+)<\/a>(.*)<em>([^<]+)<\/em>(.*)<\/li>#ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[3][$k]);
        $a4 = $b[5][$k];
        $a5 = 'http://military.people.com.cn'.$a2.'';
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="tv">'.$a3.'  '.$a4.'</a>';
echo $xml;
}}}
function rmwnews($url) {
 $url ='http://news.people.com.cn/210801/211150/index.js?pagesize=30';
       $ut = m_v($url);
       $nt = J_d($ut,ture);
       $aa = $nt["items"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["id"];
       $a3 = m_u($a0["title"]);
       $a4 = $a0["url"];
       $a5 = $a0["date"];
     $xml ='<a href="'.$a4.'" target="tv">'.$a5.':   '.$a3.' </a>';
echo $xml;
}}
function gtw($url) {
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $t='_'.$i;
   if ($p == '1')  $t=null;else $t=$t;
   if ($t == '_1')  $t=null;else $t=$t;
 $url ='https://china.kyodonews.net/';
        $ul = m_v($url);
preg_match_all('#<li>(.*)<a href="([^<]+)">(.*)<h(.*)>([^<]+)<#ismU',$ul,$b);
preg_match_all('#class="time">([^<]+)<#ismU',$ul,$b2);
        foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = m_u($b[5][$k]);
        $a4 = m_u($b2[1][$k]);
        $a5 ='https://china.kyodonews.net'.$a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.'  ('.$a4.')</a>';
echo $xml;
}}}
function gbso($url) {
       $wk= array("9313013693864916","1716094393547746","6078094297583398","5947094331518346","6289094302906540","2507013340726168","3903113146337218","4443112426765580");
       $w=$_GET['w']?$_GET['w']:"0";
       $wnk=$wk[$w];
       $ul = 'http://iguba.eastmoney.com/'.$wnk.''; 
       $ut = m_v($ul);
preg_match_all('#"user_id":"([^<]+)"(.*)"post_title":"([^<]+)"(.*)"post_content":"([^<]+)"(.*)"post_publish_time":"([^<]+)"#ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[1][$k];
        $a4=m_u($d[3][$k]);
        $a5=m_u($d[5][$k]);
        $a6=$d[7][$k];
        //$b3 = 'http://guba.eastmoney.com/news,'.$a4.','.$a3.'.html';
        $vd=Current(explode('?',$v));
	$xml ='<a>'.$a6.' :'.$a4.' ('.$a5.')</a>';
echo $xml;
	}}
function gbso2($url) {
       $w=$_GET['w'];
   if ($w == '')  $w='cjpl';else  $w=$w;
       $p = $_GET['p']?$_GET['p']:1;
for ($i = 1; $i <=$p; $i++) {
       $ur = 'http://guba.eastmoney.com/list,'.$w.'_'.$i.'.html'; 
       $ul = f_g($ur);
preg_match_all('#<span class="l1">(.*)<a href="([^<]+)" title="([^<]+)" >(.*)<span class="l5">([^<]+)</span>#ismU',$ul,$d);
foreach ($d[1] as $k=>$v){
	$a3=$d[2][$k];
        $a4=m_u($d[3][$k]);
        $a5=$d[5][$k];
        $b3 = 'http://guba.eastmoney.com'.$a3.'';
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$b3.'" target="_blank" >'.$a4.'('.$a5.')</a>';
echo $xml;
	}}}
function guba($url) {//股吧
       $tk= array("0","1","2","3","11");
       $w = $_GET['w'] ? $_GET['w'] : "600000";
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:'1'; 
       $tnk=$tk[$t];
for ($i1 = 1; $i1 <=$p; $i1++) {
       $p1= $i1*30;
       $ul = 'http://m.guba.eastmoney.com/getdata/articlelist?code='.$w.'&count=30&type='.$tnk.'&thispage='.$i1.'&id=&sort=0';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["re"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       //$a2 = $a0["post_id"];
       //$a3 = $a0["post_user"]["user_id"];
       //$a4 = m_u($a0["post_user"]["user_nickname"]);
       $a5 = $a0["post_guba"]["stockbar_market"];
       $a6 = m_u($a0["post_title"]);
       $a7 = m_u($a0["post_content"]);
       $a8 = $a0["post_publish_time"];
        //$b3 = 'http://guba.eastmoney.com'.$a3.'';
	$xml ='<a>'.$a5.' : '.$a6.' ('.$a7.') ('.$a8.')</a>';
echo $xml;
	}}}
function guba2($url) {//股吧
       $tk= array("0","1","3","5","11");
       $w = $_GET['w'] ? $_GET['w'] : "600000";
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1; 
       $tnk=$tk[$t];
for ($i = 1; $i <=$p; $i++) {
       $p1= $i*50;
       $ul = 'http://m.guba.eastmoney.com/getdata/articlelist?code='.$w.'&count='.$p1.'&type='.$tnk.'&thispage=1&id=&sort=0';
       $ut = m_v($ul);
preg_match_all('#"post_id":([^<]+),(.*)"user_id":"([^<]+)"(.*)"user_nickname":"([^<]+)"(.*)"stockbar_market":"([^<]+)"(.*)"post_title":"([^<]+)"(.*)"post_content":"([^<]+)"(.*)"post_publish_time":"([^<]+)"#ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2=$d[1][$k];
	$a3=$d[3][$k];
        $a4=m_u($d[5][$k]);
        $a5=$d[7][$k];
        $a6=m_u($d[9][$k]);
        $a7=m_u($d[11][$k]);
        $a8=$d[13][$k];
        $b3 = 'http://guba.eastmoney.com'.$a3.'';
        $vd=Current(explode('?',$v));
	$xml ='<a>'.$a5.' : '.$a6.' ('.$a7.') ('.$a8.')</a>';
echo $xml;
	}}}
function zygg($url) {
       $tk= array("A","A","SHA","SZA","ZXB","CYB","KCB","BJA");
       $wk= array("5","0","1","2","3","6","4","7","8","9","13");
       $w=$_GET['w']?$_GET['w']:"0";
       $t=$_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:3;
       $wnk=$wk[$w];
       $tnk=$tk[$t];
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $rw = $year.'-'.$mon.'-'.$day;
       for ($i = 1; $i <=$p; $i++) {
    if($t>0) {
       $url1 = 'https://np-anotice-stock.eastmoney.com/api/security/ann?cb=&sr=-1&page_size=50&page_index='.$i.'&ann_type='.$tnk.'&client_source=web&f_node=0&s_node=0';
} else {
       $url2 = 'https://newsapi.eastmoney.com/kuaixun/v1/getlist_102_ajaxResult_50_2_.html?r=0.32087988642129983&';
       $url1 = 'https://np-anotice-stock.eastmoney.com/api/security/ann?cb=&sr=-1&page_size=50&page_index='.$i.'&ann_type=SHA%2CCYB%2CSZA%2CBJA&client_source=web&f_node=0&s_node=0'; 
}
       $ul = m_v($url1);
        $nt = J_d($ul,ture);
        $aa = $nt["data"]["list"];
        $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["art_code"];
        $a2 = $a0["eiTime"];
        $a3 = m_u($a0["title"]);
        //$a8 = 'https://data.eastmoney.com/notices/detail/'.$a4.'/'.$a1.'.html';
        $ud1=''.$a3.'   ( '.$a2.' )  ';
	//$xml1 ='<a href="'.$a8.'" target="_blank" >'.$ud1.'</a>';
	$xml ='<a>'.$ud1.'</a>';
echo $xml;
	}}}
function fhss($url) {
       $uk= array("addNewData","setCont","liveDateInit","getLiveData","getFinanceDataCb");
       $u=$_GET['u']?$_GET['u']:"0";
       $unk=$uk[$u];
       $wk= array("868910","868873","462728","462735","462737");
       //$wk= array("462703","462704","462708","462728","462735","462737");
       $w=$_GET['w']?$_GET['w']:"0";
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1; 
       $p1 = $p*20; 
       //for ($ii = 0; $ii <=$p; $ii++) {}
        //$ul1 = 'https://api3.finance.ifeng.com/live/getclsold?lastid='.$wnk.'&num=20&page='.$ii.'&cb='.$unk.'';
        $ul = 'https://api3.finance.ifeng.com/live/getclsold?lastid=&num=2&cb=addNewData';
        //$ul3 = 'https://api3.finance.ifeng.com/live/getclsnew?beg=0&end=-1&cb=_57928b38187cc5870e18c08778dff5a5&page='.$ii.'lastid='.$wnk.'';
        //$ul4 = 'https://api3.finance.ifeng.com/live/getclsnew?beg=0&end=-1&cb=_434e1d6218b046b51e30870ea0b9062e&page='.$ii.'lastid='.$wnk.'';
preg_match("#\"id\":\"([^<]+)\",#ism",m_v($ul),$bb); 
       $at = substr($bb[1] , 0 , 5).'0';
       $ul2 = 'https://api3.finance.ifeng.com/live/getclsold?lastid='.$at.'&num='.$p1.'&cb='.$unk.'';
preg_match("#\((.*)\)#ism",m_v($ul2),$b); 
       $nt = J_d($b[1]);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = r_u($a0["brief"]);
       $a3 = t_m($a0["ctime"]-28800);
	$xml ='<a>'.$a3.' :'.$a2.'</a>';
echo $xml;
}}
function fhgd($url) {
       $uk= array("addNewData","setCont","liveDateInit","getLiveData","getFinanceDataCb");
       $u=$_GET['u']?$_GET['u']:"0";
       $unk=$uk[$u];
       $wk= array("462703","462704","462708","462728","462735","462737");
       $w=$_GET['w']?$_GET['w']:"0";
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:2; 
       for ($ii = 1; $ii <=$p; $ii++) {
        $ul = 'https://api3.finance.ifeng.com/live/getclsold?lastid='.$wnk.'&num=20&page='.$ii.'&cb='.$unk.'';
        $ul2 = 'http://shankapi.ifeng.com/shanklist/_/getColumnInfo/_/dynamicFragment/6646821658298433575/1584726491000/20/3-35191-/getColumnInfoCallback?callback=getColumnInfoCallback';
        $ul3 = 'http://api3.finance.ifeng.com/live/getclsnew?beg=0&end=-1&cb=_57928b38187cc5870e18c08778dff5a5&page='.$ii.'lastid='.$wnk.'';
 preg_match("#\((.*)\)#ism",m_v($ul3),$b); 
       $nt = J_d($b[1]);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = r_u($a0["brief"]);
       $a3 = t_m($a0["ctime"]-28800);
	$xml ='<a>'.$a3.' :'.$a2.'</a>';
echo $xml;
}}}
function fhcj($url) {
       $uk= array("addNewData","setCont","liveDateInit","getLiveData","getFinanceDataCb");
       $u=$_GET['u']?$_GET['u']:"0";
       $unk=$uk[$u];
       $wk= array("462001","462703","462704","462708","462728","462735","462737");
       $w=$_GET['w']?$_GET['w']:"0";
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1; 
      for ($ii = 1; $ii <=$p; $ii++) {
        $ul1 = 'https://api3.finance.ifeng.com/live/getclsold?page='.$i.'&num=20&level=1&lastid=457928&cb='.$wnk.'';
        $ul3 = 'https://api3.finance.ifeng.com/live/getclsold?&num=20&page='.$i.'&lastid='.$wnk.'&cb='.$unk.'';
        $ul2 = 'http://api3.finance.ifeng.com/live/getclsnew?beg=0&end=1584604105&cb=_57928b38187cc5870e18c08778dff5a5&page='.$ii.'';
 preg_match("#\((.*)\)#ism",m_v($ul2),$b); 
       $nt = J_d($b[1]);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = r_u($a0["brief"]);
       $a3 = t_m($a0["ctime"]-28800);
	$xml ='<a>'.$a3.' :'.$a2.'</a>';
echo $xml;
}}}
function cnkx($url) {  
       $wk= array("","sns_bwkx","sns_yw","sid_zxk","sid_rdjj","scp_gsxw","tjd_ggkx","tjd_bbdj");     
       $w = $_GET['w']?$_GET['w']:0; 
       $p = $_GET['p']?$_GET['p']:2; 
       $wnk = $wk[$w];
      for ($ii = 1; $ii <=$p; $ii++) {
 $ul1 ='http://news.cnstock.com/news/sns_'.$w.'/'.$p.'';
   if($w==0) {
 $ul2 ='http://app.cnstock.com/api/xcx/kx?callback=jQuery19108453429325540578_1515855388660&colunm='.$wnk.'&page='.$ii.'&num=20';
}else {
 $ul2 ='http://app.cnstock.com/api/waterfall?callback=jQuery19109028417838585712_1604579541302&colunm=qmt-'.$wnk.'&page='.$ii.'&num=20&showstock=1&';
}
 preg_match("#\((.*)\)#",m_v($ul2),$b);
       //$nt = $b[1];
       $nt = J_d($b[1],ture);
   if($w==0) {
       $aa = $nt["item"];
}else {
       $aa = $nt["data"]["item"];
}
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = r_u($a0["title"]);
       $a3 = $a0["link"];
       $a4 = r_u($a0["desc"]);
       $a5 = $a0["time"];
       $a6 = r_u($a0["dateline"]);
       $ud = $a5.' : ' .$a2.'  ( '.$a4.') ';
       $xml ='<a>'.$ud .'</a>';
echo $xml;
}}}
function cnyj($url) {    
       $wk= array( "yjyg","yjyg","cwsj","yjyz");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
      //for ($i = 1; $i <=$p; $i++) {};
 $url1 ='http://news.cnstock.com/news/sns_'.$w.'/'.$p.'';
 $url2 ='http://data.cnstock.com/result/gpsj/'.$wnk.'/report_1.js';
        $ul = f_g($url2);
        $nt = J_d($ul,ture);
        $aa = $nt["rows"];
        $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["cell"]["ZhengQuanDaiMa"];
        $a2 = m_u($a0["cell"]["ZhengQuanJianCheng"]);
        $a3 = $a0["cell"]["GongGaoRiQi"];
        $a4 = m_u($a0["cell"]["type"]);
        $a5 = $a0["cell"]["detail"];
        $a6 = $a0["cell"]["eps"];
        $ud = $a3.' : ' .$a2.'  ( '.$a1.') ( '.$a4.' : '.$a5.')';
     $xml ='<a>'.$ud .'</a>';
     //$xml ='<a href="'.$a3.'" target="b" >'.$ud .'</a>';
echo $xml;
}}
function cnyj0($url) {    
       $wk= array( "yjyg","yjyg","v2","v3");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
      //for ($i = 1; $i <=$p; $i++) {};
 $url1 ='http://news.cnstock.com/news/sns_'.$w.'/'.$p.'';
 $url2 ='http://data.cnstock.com/result/gpsj/'.$wnk.'/report_1.js';
        $ul = f_g($url2);
preg_match_all('#"ZhengQuanDaiMa":"([^<]+)","ZhengQuanJianCheng":"([^<]+)","GongGaoRiQi":"([^<]+)","type":"([^<]+)","detail":"([^<]+)","eps":"([^<]+)"#ismU',$ul,$b);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = r_u($b[2][$k]);
        $a3 = $b[3][$k];
        $a4 = r_u($b[4][$k]);
        $a5 = $b[5][$k];
        $a6 = $b[6][$k];
        $ud = $a3.' : ' .$a2.'  ( '.$a1.') ( '.$a4.' : '.$a5.')';
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$ud .'</a>';
     //$xml ='<a href="'.$a3.'" target="b" >'.$ud .'</a>';
echo $xml;
}}
function cngq($url) {    
       $wk= array( "gqjl","yjyg","v2","v3");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
      //for ($i = 1; $i <=$p; $i++) {};
 $url1 ='http://news.cnstock.com/news/sns_'.$w.'/'.$p.'';
 $url2 ='http://data.cnstock.com/result/gpsj/'.$wnk.'/report_1.js';
        $ul = m_v($url2);
        $nt = J_d($ul,ture);
        $aa = $nt["rows"];
        $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["cell"]["secucode"];
        $a2 = m_u($a0["cell"]["secuabbr"]);
        $a3 = $a0["cell"]["InitialInfoPublDate"];
        $a4 = m_u($a0["cell"]["EventProcedure"]);
        $a5 = m_u($a0["cell"]["IncentiveMode"]);
        $a7 = m_u($a0["cell"]["PeriodOfValidity"]);
        $a6 = m_u($a0["cell"]["hangye"]);
        $ud = $a3.' : ' .$a2.'   ( '.$a1.' )   '.$a5.' : '.$a4.'  '.$a6.' ( '.$a7.' )';
     $xml ='<a>'.$ud .'</a>';
     //$xml ='<a href="'.$a3.'" target="b" >'.$ud .'</a>';
echo $xml;
}}
function cngq0($url) {    
       $wk= array( "gqjl","yjyg","v2","v3");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
      //for ($i = 1; $i <=$p; $i++) {};
 $url1 ='http://news.cnstock.com/news/sns_'.$w.'/'.$p.'';
 $url2 ='http://data.cnstock.com/result/gpsj/'.$wnk.'/report_1.js';
        $ul = m_v($url2);
preg_match_all('#"secucode":"([^<]+)","secuabbr":"([^<]+)","InitialInfoPublDate":"([^<]+)","DMAnnounceDate":"([^<]+)","SMAnnounceDate":"([^<]+)","EventProcedure":"([^<]+)","IncentiveMode":"([^<]+)","PeriodOfValidity":"([^<]+)","hangye":"([^<]+)"#ismU',$ul,$b);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = r_u($b[2][$k]);
        $a3 = $b[3][$k];
        $a4 = r_u($b[6][$k]);
        $a5 = r_u($b[7][$k]);
        $a6 = $b[9][$k];
        $ud = $a3.' : ' .$a2.'  ( '.$a1.') ( '.$a5.' : '.$a4.')('.$a6.')';
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$ud .'</a>';
     //$xml ='<a href="'.$a3.'" target="b" >'.$ud .'</a>';
echo $xml;
}}
function cns($url) {       
       $wk= array( "sd","sd","zxk","yw");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:2; 
   for ($i = 1; $i <=$p; $i++) {
 $url1 ='http://news.cnstock.com/news/sns_'.$wnk.'/'.$i.'';
 $url2 ='http://app.cnstock.com/api/xcx/kx?callback=jQuery191049699088298711513_1525528303508&colunm=szkx&page='.$i.'&num=15';
        $ul = m_v($url2);
preg_match_all('#"id":"([^<]+)"(.*)"title":"([^<]+)"(.*)"link":"([^<]+)"(.*)"desc":"([^<]+)"(.*)"time":"([^<]+)"(.*)"dateline":"([^<]+)"#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[3][$k];
        $a3 = r_u($b[5][$k]);
        $a4 = r_u($b[7][$k]);
        $a5 = $b[9][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$a5.' '.$a4.'</a>';
     $xml2 ='<a href="'.$a3.'" target="b" >'.$a5.' '.$a4.'</a>';
echo $xml;
}}}
function cjw($url) {
       $wk= array( "114","112","113","115");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
        $ul ='http://roll.caijing.com.cn/ajax_lists.php?modelid='.$wnk.'&time=0';
        $ut = m_v($ul);
   preg_match_all('|"url":"(.*)"|ismU',$ut,$d);
   preg_match_all('|"published":"(.*)"|ismU',$ut,$d2);
   preg_match_all('|"title":"(.*)"|ismU',$ut,$d3);
        foreach($d[1] as $k=>$v){
        $a3 = stripslashes($d[1][$k]);
        $a4 = $d2[1][$k];
        $a5 = $d3[1][$k];
$a7 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $a5); 
        $vd=Current(explode('?',$v));
     $xml ='<a >'.$a4.'  '.m_u($a7).'  </a>';
     $xml2 ='<a href="'.$a3.'" target="b" >'.$a4.'  '.m_u($a7).'  </a>';
echo $xml;
}}
function cfi($url) {
       $wk= array( "BCA0A4127A4346A4439","BCA0A4127A4346A4447","BCA0A4127A4346A4441","BCA0A4127A4346A4436","BCA0A4127A4128A4132","BCA0A4127A4128A4137");  
       $w = $_GET['w']?$_GET['w']:'0'; 
       $p = $_GET['p']?$_GET['p']:'1'; 
       $wnk = $wk[$w];
 $url ='http://stock.cfi.cn/'.$wnk.'.html';
        $ul = m_v($url);
preg_match_all('#<span>([^>]+)</span>(.*)<a href=([^>]+)>([^>]+)</a><br>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = 'http://stock.cfi.cn/'.$b[3][$k];
        $a3 = $b[1][$k];
        $a4 = m_u($b[4][$k]);
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="b" >'.$a4.'&nbsp;&nbsp;(&nbsp;'.$a3.'&nbsp;)</a>';
echo $xml;
}}
function xh08($url) {
       $w=$_GET['w'];
   if($w == '') $w='zlyj';else if($w == '1') $w='zlyj';else if($w == '2') $w='hydt';else if($w == '3') $w='hgjj';else if($w == '4') $w='zgyh';else if($w == '5') $w='zgyh';else $w=$_GET['w'];
       $pt1='stock';
       $pt2='news';
       $pt3='stock';
   if($w == 'zlyj') $pt='stock';else if($w == 'hydt') $pt='stock';else if($w == 'zgyh') $pt='rmb';else if($w == 'list/s307') $pt='www';else if($w == 'hgjj') $pt='news';else if($w == 'qyjj') $pt='news';else if($w == 'cyjj') $pt='news';else if($w == 'shrd') $pt='news';else if($w == 'qt') $pt='world';else $pt=$pt;
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 1; $i <=$p; $i++) {
   if($w == 'zxzx') $i='index'.$i;else $i=$i;
 $url ='http://'.$pt.'.xinhua08.com/'.$w.'/'.$i.'.shtml';
        $ul = f_g($url);
preg_match_all('#<div class="newsinfo">(.*)<a href="([^>]+)"(.*)>(.*)<h4>([^>]+)</h4>#ismU',$ul,$b);
preg_match_all('#<div class="cattime">([^>]+)</a>#ismU',$ul,$b2);
        foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = m_u($b[5][$k]);
        //$a4 = m_u($b[6][$k]);
        $a5 = $b2[1][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="b" >'.$a3.'  ('.$a5.')</a>';
echo $xml;
}}}
function cecn($url) {
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
        $p1 = $i-1;
        //$p1 = '_'.$i;
   if($p1 == '0') $ii=null;else $ii='_'.$p1;
 $url ='http://www.ce.cn/2012sy/gd/index'.$ii.'.shtml';
        $ul = m_v($url);
preg_match_all('#<td height="(.*)"><span class="font3">(.*)</span><a href="(.*)" target="_blank" style="(.*)">(.*)</a> <span class="rq1">(.*)</span>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[3][$k];
        $a3 = m_u($b[5][$k]);
        $a4 = $b[6][$k];
if(stripos($a2,'../../') !== false) {            
        $a5 = str_replace("../../","http://www.ce.cn/",$a2);
}else $a5=$a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="b2">'.$a3.' '.$a4.'</a>';
     //$xml ='<a href="'.$a2.'" target="b" >'.$a3.' '.$a4.'</a>';
echo $xml;
}}}
function ndrc($url) {
       $w = $_GET['w']?$_GET['w']: date('d');
       $w=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
       for ($i = 0; $i <=$p; $i++) {
 $url ='http://www.ndrc.gov.cn/fgwSearch/searchResult.jsp?&type=1&order=-DOCRELTIME&page='.$i.'&sword='.$w.'';
        $ul = m_v($url);
preg_match_all('#<dd  class="txt">(.*)<p><a href="([^>]+)" title="([^>]+)"(.*)>(.*)</a></p>(.*)<p><a href="([^>]+)" title="([^>]+)"(.*)class="url">([^>]+)</a><font class="dateShow">([^>]+)</font></p>#ismU',$ul,$b);
foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = m_u($b[3][$k]);
        $a4 = m_u($b[5][$k]);
        $a5 = $b[11][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a2.'" target="b" >'.$a3.' '.$a5.'</a>';
echo $xml;
}}}
function n163($url) {
 $url ='http://news.163.com/rollnews/';
        $ul = m_v($url);
preg_match_all('#<a href="(.*)" target="_blank">(.*)</a> <span>(.*)</span> </li>#U',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[2][$k]);
        $a4 = m_u($b[3][$k]);
        $vd=Current(explode('?',$v));
	$xml ='<a><a href="'.$a2.'" target="b">'.$a3.''.$a4.'</a>';
echo $xml;
}}
function gw($url) {
       $f=strtoupper($_GET['w']);
$ul1='http://f9data.gw.com.cn/f9/f9stock/left.php?obj='.$f.'.stk';
        $ut = m_v($ul1);
preg_match_all("|id:12,pid:(.*),title:\"(.*)\",url:\"\/f9\/shareholders\/stenfloatingview.php\?itcode=(.*)\"|ismU",$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[3][$k];
       $a3 = 'http://f9data.gw.com.cn/f9/shareholders/stenfloatingview.php?itcode='.$a2.'&obj='.$f.'.stk';
       $ut2 = m_v($a3);
preg_match_all("|<td class=\"c_left\" style=\"border-right\:0\" title=\"(.*)\">|ismU",$ut2,$d);
preg_match_all("|<td class=\"c_center\" style=\"border(.*)\">(.*)<a class=\"popup\" href=\"(.*)\" rel=\"(.*)gddm=(.*)\">|ismU",$ut2,$d2);
preg_match_all("|<td class=\"c_center\"><a class=\"popup\" href=\"(.*)\" rel=\"fotherstocksview.php\?obj=(.*).stk\&type=1\&itcode=(.*)\&gddm=(.*)\&title=(.*)\&jzrq=(.*)\">|ismU",$ut2,$d3);
foreach ($d[1] as $k=>$v){
       $a3 = m_u($d[1][$k]);
       $a4 = $d2[5][$k];
       $a5 = $d3[5][$k];
       $a6 = $d3[6][$k];
       $vd=Current(explode('?',$v));
        $number=$number+1;
        $mu =$number;
       $xml ='<a href="../cg.php?s='.$a4.'&w='.$a5.'" target="tv">('.$mu.')'.$a3.'</a>';
echo $xml;
}}}
function gw2($url) {
       $f=strtoupper($_GET['w']);
$ul1='http://f9data.gw.com.cn/f9/f9stock/left.php?obj='.$f.'.stk';
        $ut = m_v($ul1);
preg_match_all("|id:12,pid:(.*),title:\"(.*)\",url:\"\/f9\/shareholders\/stenfloatingview.php\?itcode=(.*)\"|ismU",$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[3][$k];
       $a4 = m_u($d1[2][$k]);
       $a3 = 'http://f9data.gw.com.cn/f9/shareholders/stenfloatingview.php?itcode='.$a2.'&obj='.$f.'.stk';
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a3.'" target="tv">'.$_GET["w"].''.$a4.'</a>';
echo $xml;
}}
function gwnews($url) {
       $wk= array("txs","toutiao","news/mobile/mgxw","news/mobile/ggxw","news/mobile/jjxw","news/mobile/lcxw");
       $w=$_GET['w']?$_GET['w']:'0';
       $p = $_GET['p']?$_GET['p']:2;
       $wnk = $wk[$w];
       for ($ii = 1; $ii <=$p; $ii++) {
$ul1='http://mnews.gw.com.cn/wap/data/news/'.$wnk.'/page_'.$ii.'.json';
$ul2='http://mnews.gw.com.cn/wap/data/news/xbsjxw/page_1.json';
        $ut = J_d(m_v($ul1),true);
        $aa = $ut[0]["data"];
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        //$a1 = m_u($a0["summary"]);
        $a2 = m_u($a0["title"]);
        //$a3 = $a0["summary"];
        $a4 = $a0["otime"];
       $xml ='<a>'.$a4.' : '.$a2.' </a>';
echo $xml;
}}}
function gwnews0($url) {
       $wk= array("txs","toutiao","news/mobile/mgxw","news/mobile/ggxw","news/mobile/jjxw","news/mobile/lcxw");
       $w=$_GET['w']?$_GET['w']:'0';
       $p = $_GET['p']?$_GET['p']:2;
       $wnk = $wk[$w];
       for ($ii = 1; $ii <=$p; $ii++) {
$ul1='http://mnews.gw.com.cn/wap/data/news/'.$wnk.'/page_'.$ii.'.json';
        $ut = m_v($ul1);
preg_match_all('|"id":([^<]+),"title":"([^<]+)",|ismU',$ut,$d1);
preg_match_all('|"summary":"([^<]+)"(.*)"otime":"([^<]+)"(.*)"url":"([^<]+)"|ismU',$ut,$d2);
foreach ($d1[1] as $k=>$v){
       $a2 = m_u($d1[2][$k]);
       $a3 = m_u($d2[1][$k]);
       $a4 = $d2[3][$k];
       //$a5 = $d3[5][$k];
       //$ud = $a5;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a4.' : '.$a2.'    ('.$a3.')</a>';
       //$xml ='<a href="'.$ud.'" target="b" >'.$a4.' : '.$a2.'    ('.$a3.')</a>';
echo $xml;
}}}
function zxdp($url) {
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url1 ='http://report.hermes.hexun.com/client/client_report.php?&code=&name=&institution=&gradetype=&grade=&gradechange=&growth=&rise=&reporttime=&sc=&st=&page='.$i.'';
 $url ='http://roll.hexun.com/roolNews_listRool.action?type=all&ids=&date=&page='.$i.'&tempTime=';
 $url2 ='http://roll.hexun.com/roolNews_listRool.action?type=all&ids=100,101,103,125,105,124,162,194&date=&page='.$i.'&tempTime=';
        $ul = f_g($url);
preg_match_all("#time:'([^>]+)'(.*)title:'([^>]+)'(.*)titleLink:'([^>]+)'(.*)desc:'([^>]+)'#ismU",$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_u($b[3][$k]);
        $a4 = $b[5][$k];
        $a5 = m_u(r_u($b[7][$k]));
        $vd=Current(explode('?',$v));
     $xml ='<a >'.$a2.'-'.$a3.'</a>';
     //$xml ='<a href="'.$a4.'" target="b" >'.$a2.'-'.$a3.'</a>';
echo $xml;
}}}
function zxgg($url) {
       $w=$_GET['w'];
   if ($w == '')  $w='600000';else  $w=$w;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.chinastock.com.cn/yhwz/astock/shareholdersEquityAction.do?methodCall=announcementNews_ZXGG&stockCode='.$w.'&pageNum='.$i.'&pageSize=20';
        $ul = m_v($url);
preg_match_all('#style="width: 580px;"(.*)href="(.*)">(.*)</a>(.*)<bdo dir="ltr">(.*)</bdo>(.*)</li>#ismU',$ul,$b);
  foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = $b[3][$k];
        $a4 = $b[5][$k];
        $a5 = 'http://www.chinastock.com.cn/'.$a2.'';
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a5.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}}
function thsxzx($url) {
       $wk= array("","485469","485419","485503","484799","485319");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $url1 ='http://news.10jqka.com.cn/tapp/news/push/stock/?kid='.$wnk.'&ctime=1604907486&tag=%E5%85%A8%E9%83%A8&trace=website';
       $url ='https://news.10jqka.com.cn/tapp/news/push/stock/?page=1&tag=&track=website&pagesize=100';
       //$ul = m_v($url);
       $ut = J_d(m_v($url),True);
       $aa = $ut["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["digest"]);
       $a3 = x_g($a0["url"]);
       $a4 = x_g($a0["appUrl"]);
       $a5 = t_m($a0["rtime"]-28800);
       $xml1 ='<a>'.$a5.'  &nbsp;&nbsp; '.$a2.'   </a>';
     $xml2 ='<a href="'.$a4.'" target="b" >'.$a6.'   '.$a3.'  </a>';
     $xml='';
if($u==0) $xml=$xml1;else $xml=$xml2;
echo $xml;
}}}
function thszx($url) {
       $wk= array("","485469","485419","485503","484799","485319");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $url1 ='http://news.10jqka.com.cn/tapp/news/push/stock/?kid='.$wnk.'&ctime=1604907486&tag=%E5%85%A8%E9%83%A8&trace=website';
       $url ='http://news.10jqka.com.cn/tapp/news/push/stock/?kid='.$wnk.'&page='.$i.'&tag=&track=website';
       //$ul = m_v($url);
       $ut = J_d(m_v($url),True);
       $aa = $ut["data"]["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["digest"]);
       $a3 = x_g($a0["url"]);
       $a4 = x_g($a0["appUrl"]);
       $a5 = t_m($a0["rtime"]-28800);
       $xml1 ='<a>'.$a5.'  &nbsp;&nbsp; '.$a2.'   </a>';
     $xml2 ='<a href="'.$a4.'" target="b" >'.$a6.'   '.$a3.'  </a>';
     $xml='';
if($u==0) $xml=$xml1;else $xml=$xml2;
echo $xml;
}}}
function thsxw2($url) {
       $wk= array("realtime/624491106","ywjh","siteall","caijingall","gupiaoall","today");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:2;
   for($i=1;$i<=$p;$i++){
if($w==0){
       $url ='http://m.10jqka.com.cn/wapapi/list/realtime/624491106/'.$i.'';
}else if($w==1){
       $url ='http://m.10jqka.com.cn/wapapi/list/jsonnews/headline/'.$i.'/';
}else if($w==2){
       $url ='http://m.10jqka.com.cn/wapapi/list/qqgs/page/'.$i.'/num/15';
}else {
       $url ='http://m.10jqka.com.cn/wapapi/list/page/news/guojicj/15/624962517/'.$i.'/';
}
       $nt = m_v($url);
preg_match("#\[\{(.*)\}\]#",$nt,$b);
       $nt1 = '['.'{'.$b[1].'}'.']';
       $ut = J_d($nt1,True);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = r_u($a0["title"]);
if($w==0) {
       $a3 = r_u($a0["content"]);
}else {
       $a3 = r_u($a0["title"]);
}
if($w==2) {
       $a5 = $a0["ctime"];
}else {
       $a5 = t_m($a0["ctime"]-28800);
}
       $a4 = x_g($a0["url"]);
       $xml ='<a>'.$a5.'  &nbsp;&nbsp; '.$a3.'   </a>';
     //$xml2 ='<a href="'.$a4.'" target="b" >'.$a5.'   '.$a2.'  </a>';
echo $xml;
}}}
function thsxw0($url) {
       $wk= array("realtimenews","ywjh","siteall","caijingall","gupiaoall","today","cjzx","cjkx","guojicj","comnews","zqyw","touziall");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
       //for ($i = 1; $i <=$p; $i++) {}
       //$ul = 'http://stock.10jqka.com.cn/thsgd/'.$wnk.'.js';
       $ul = 'http://stock.10jqka.com.cn/thsgd/realtimenews.js';
       $nt = m_v($ul);
/*preg_match("#item:\[\{(.*)\}\]\}#ismU",$nt,$b);
       $ut1 = '['.'{'.$b[1].'}'.']';
       $ut = J_d($ut1,True);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["title"]);
       $a3 = m_u($a0["content"]);
       $a4 = $a0["url"];
       $a5 = $a0["source"];
       $a6 = $a0["curl"];
       $a7 = $a0["pubDate"];
       $xml ='<a>'.$a7.' : '.$a2.'('.$a3.')</a>';*/
       //$xml2 ='<a href="'.$a6.'" target="b" >'.$a7.' : '.$a2.'('.$a3.')</a>';
echo $nt;
}
function thsxw($url) {
       $wk= array("realtimenews","ywjh","siteall","caijingall","gupiaoall","today","cjzx","cjkx","guojicj","comnews","zqyw","touziall");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
       //for ($i = 1; $i <=$p; $i++) {}
       $ul = 'http://stock.10jqka.com.cn/thsgd/'.$wnk.'.js';
       $ut = f_g($ul);
preg_match_all('#"title":"([^<]+)"(.*)"content":"([^<]+)"(.*)"url":"([^<]+)"(.*)"source":"([^<]+)"(.*)"curl":"([^<]+)"(.*)"pubDate":"([^<]+)"#ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2=m_u($d[1][$k]);
	$a3=m_u($d[3][$k]);
	$a4=$d[5][$k];
	$a5=$d[7][$k];
	$a6=$d[9][$k];
	$a7=$d[11][$k];
        $vd=Current(explode('?',$v));
	$xml ='<a>'.$a7.' : '.$a2.'('.$a3.')</a>';
	$xml2 ='<a href="'.$a6.'" target="b" >'.$a7.' : '.$a2.'('.$a3.')</a>';
echo $xml;
}}
function ths24($url) {
       $wk= array("3","3","20","21","16");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 //$url ='http://comment.10jqka.com.cn/api/realtime.php?block=getnews&page='.$i.'&jsoncallback=jQuery18309176104395639189_1604905676799&';
 $url ='http://comment.10jqka.com.cn/api/realtime.php?block=getnews&page='.$i.'&jsoncallback=&';
 //preg_match("#\((.*)\)#ism",m_v($url),$b);
       //$ut = $b[1];
       $ut = m_v($url);
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = x_g($a0["url"]);
       $a3 = r_u($a0["xmlsource"]);
       $a4 = m_u($a0["title"]);
       $a5 = t_m($a0["ctime"]-28800);
       $a6 = r_u($a0["source"]);
       $a7 = r_u($a0["content"]);
       $a8 = t_m($a0["rtime"]);
     $xml1 ='<a>'.$a5.'  &nbsp;&nbsp; '.$a7.'   </a>';
     //$xml ='<a href="'.$a2.'" target="b" >'.$a5.'   '.$a3.'</a>';
echo $xml1;
}}}
function zqyw($url) {
       $p = $_GET['p']?$_GET['p']:1;
        $ul ='http://app.finance.china.com.cn/news/column.php?cname=%E8%AF%81%E5%88%B8%E8%A6%81%E9%97%BB&p='.$p.'';
        $ut = m_v($ul);
   preg_match_all('|<li><span>(.*)</span>(.*)<a href="([^>]+)" target="_blank">(.*)</a></li>|ismU',$ut,$d);
        foreach($d[1] as $k=>$v){
        $a3 = $d[1][$k];
        $a4 = $d[3][$k];
        $a5 = $d[4][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$a4.'" target="b" >'.$a5.'('.$a3.')</a>';
echo $xml;
}
}
function qhrb($url) {
       $w=$_GET['w'];
   if ($w == '')  $w='1';else  $w=$_GET['w'];
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=1;$i<=$p;$i++){
       $ul = 'http://app.qhrb.com.cn/roll.php?do=query&callback=jsonp1448429163753&_=1448429260875&channel='.$w.'&size=50&page='.$i.'';
       $ut = m_s($ul);
 preg_match_all('#,"title":"(.*)"#ismU',$ut,$b);
 preg_match_all('#,"url":"(.*)",#ismU',$ut,$b1);
 preg_match_all('#,"date":"(.*)"#ismU',$ut,$b2);
 foreach($b[1] as $k=>$v){
       $a4 = $b[1][$k];
       $a5 = x_g($b1[1][$k]);
       $a6 = $b2[1][$k];
       $a7 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $a4); 
       $a8 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $a6); 
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a5.'" target="tv">'.m_u($a7).'&nbsp;&nbsp;(&nbsp;'.$a8.'&nbsp;)</a>';
echo $xml;
}}}

function cngold2($url) {
       $w=strtoupper($_GET['w']);
   if ($w == '')  $w=date("m");else  $w=$_GET['w'];
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
$ul='http://kuaixun.cngold.org/all/p'.$i.'/';
$ul2='http://kuaixun.cngold.org/getLastNews.html?variable=data&lastTime='.date("d").''.$w.'';
$ul3='https://kuaixun.cngold.org/getLastNews.html?versionType=new&lastTime=1560864999000&flId=';
        $ut = f_g($ul);
preg_match_all('|<td class="item-news" colspan="(.*)">(.*)<a(.*)href="([^<]+)"(.*)<font(.*)>([^<]+)</font>|ismU',$ut,$d1);
preg_match_all('|<td class="item-time"(.*)>(.*)<span class="(.*)"(.*)style=""(.*)>([^<]+)</span>|ismU',$ut,$d2);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[4][$k];
       $a3 = m_u($d1[7][$k]);
       $a4 = t_m($d2[2][$k]);
       $a5 = $d2[6][$k];
       $ud = $a2;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a5.' :'.$a3.'</a>';
       $xml2 ='<a href="'.$a2.'"  target="tv">'.$a5.' :'.$a3.'</a>';
echo $xml;
}}}
function cngold20($url) {
       $w = $_GET['w']?$_GET['w']:date("m");
       $ww=strtoupper($_GET['w']);
       $p = $_GET['p']?$_GET['p']:1;
       $tt = date("Y").date("m").date("d");
       $t = $_GET['t']?$_GET['t']:3;
       for ($i = 1; $i <=$p; $i++) {
       $tm = time();
       $tmm=$tm*1000;
$ul='https://kuaixun.cngold.org/getLastNews.html?variable=new&lastTime='.date("Y").''.$ww.'';
$ul3='https://kuaixun.cngold.org/getLastNews.html?versionType=new&lastTime='.$tt.'&flId=&';
preg_match("|\"data\":\{\"count\":(.*),\"data\":(.*)\}\}|U",m_v($ul3),$b);
        $ut = $b[2];
        $aa = J_d($ut,true);
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a2 = $a0["id"];
        $a3 = m_u($a0["title"]);   
        $a4 = $a0["pubTime"]["date"];   
        $a5 = $a0["pubTime"]["hours"];  
        $a6 = $a0["pubTime"]["minutes"];  
        $a7 = $w.'-'.$a4.'-'.$a5.':'.$a6;
       $xml ='<a>'.$a3.' ('.$a7.')</a>';
echo $xml;
}}}
function cngold($url) {
       $wk= array("0","1","2","3","4","5");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
$ul='https://m.cngold.org/kuaixun/getNewsList/'.$i.'/fl'.$wnk.'/';
$ul2='https://m.cngold.org/kuaixun/getNewsList/2/fl0/';
        $ut = m_v($ul);
preg_match_all('|<div class="right_time"><span>([^<]+)</span></div>|ismU',$ut,$d1);
preg_match_all('|<div class="right_cont_warp">(.*)<div(.*)>([^<]+)</div>(.*)</div>|ismU',$ut,$d2);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = m_u($d2[3][$k]);
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a2.' :'.$a3.'</a>';
echo $xml;
}}}
function gupiao($url) {//爱股票
       $wk= array('Express','News');
       $w = $_GET['w']?$_GET['w']:0;
       $wnk = $wk[$w];
       $t = $_GET['t']?$_GET['t']:time();
       $p = $_GET['p']?$_GET['p']:1;
   for ($i1 = 0; $i1 <=$p; $i1++) {
       $tm = date("s")-$i1;
       $ter= date("Y").'-'.date("m").'-'.date("d").'-'.$tm;
       $dt =  strtotime($ter);
       $tt = time()- $i1*3600;
       $tim= date('Y-m-d H:i:s',$tt);
       $dt2 = strtotime($tim);
   if( $w==0) {
if($p>=1) {
$ul2='https://mobile.aigupiao.com/H5ReactExpress/index?Agp-Super-Project=1&before='.$dt2.'';
}else {
$ul2='https://mobile.aigupiao.com/H5ReactExpress/index?Agp-Super-Project=1';
}
}else if( $w==2) {
$ul2='https://www.aigupiao.com/indexNew/express_hot_list?genre=day&page='.$i1.'';
}
else {
$ul2='https://mobile.aigupiao.com/H5ReactNews/index?Agp-Super-Project=1&before='.$dt2.'&';
}
        $ut = m_v($ul2);
        $nt = J_d($ut,true);
if( $w==2) {
        $aa = $nt["datalist"];
} else {
        $aa = $nt["data"];
}
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
   if( $w==0||$w==2) {
       $a3 = m_u(r_u($a0["content"]));
}else {
       $a3 = m_u(r_u($a0["title"]));
}
   if( $w==0||$w==2) {
       $a4 = t_m($a0["rec_time"]-28800);
}else {
       $a4 = $a0["rec_time"];
}
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a4.'  :'.$a3.'</a>';
echo $xml;
}}}
function gupiao2($url) {
       $t = $_GET['t']?$_GET['t']:time();
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"3";
       $ye=date("Y");
       $ym=date("m");
       $yd=date("d");
       $yt=date("Y")-date("m")-date("d")-2;
if($w==1) {
//$ul1='http://m.5igupiao.com/express';
$ul2='https://www.aigupiao.com/index.php?s=/Api/News/news_list&u_id=undefined&before='.$t.'&md=';
//$ul3='https://www.aigupiao.com/index.php?s=/Api/Express/express_list&u_id=undefined&before='.$t.'&md=8f2cd77f3925e2688b799de8db011b3f';
//$ul4='https://www.aigupiao.com/indexNew/express_hot_list?genre=day&page=1';
        $ut = m_v($ul2);
        $nt = J_d($ut,true);
        $aa = $nt["top_list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = r_u($a0["title"]);
       $a4 = t_m($a0["rec_time"]);
       $xml ='<a>'.$a4.'  :'.$a2.'</a>';
echo $xml;
 }
} else {
$ul='https://www.aigupiao.com/index.php?s=/Api/Express/express_list&u_id=undefined&before='.$t.'&md=8f2cd77f3925e2688b799de8db011b3f';
$ul2='https://www.aigupiao.com/index.php?s=/Api/Express/express_list&u_id=undefined&before=1637027806&md=fa988ce83a45784e36e0b1d489ca0d93';
        $ut = m_s($ul2);
        $nt = f_g($ut,true);
        $aa = $nt["datalist"]["2021-11-16-2"]["data"];
        //$aa = $nt["datalist"]["'.$yt.'"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a3 = r_u($a0["content"]);
       $a4 = t_m($a0["rec_time"]);
       $a5 = $a0["update_time"];
}
       $xml ='<a>'.$a5.'  :'.$a3.'</a>';
echo $xml;
}
}
function cff($url) {
       $wk= array("default","finance","stock","gold","fund","149438","107530");
       $w=$_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:2;
       $wnk=$wk[$w];
  if($w<=10) $wnk=$wnk;else $wnk=$w;
    for($ii=0;$ii<=$p;$ii++){
       $ul2 = 'http://roll.eastmoney.com/list?count=40&type=finance,stock,gold,forex,fund&pageindex='.$ii.''; 
       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["type"]);
       $a3 = m_u($a0["title"]);
       $a4 = $a0["url"];
       $a5 = $a0["time"];
	$xml ='<a>'.$a5.' :'.$a3.' (  '.$a2.'  )</a>';
        $xml2 ='<a href="'.$a4.'" target="b" >'.$a5.' :'.$a3.' (  '.$a2.'  )</a>';
echo $xml2;
	}}}
function cftt($url) {
       $wk= array("102","101","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:"3";
       for ($i1 = 1; $i1 <=$p; $i1++) {
$ul1='https://newsinfo.eastmoney.com/kuaixun/v2/api/list?callback=jsonp_5425A849FF7C4759BDDBC6D3A8AA7D11&column='.$wnk.'&p='.$i1.'&limit=50';
$ul20='http://newsapi.eastmoney.com/kuaixun/v2/api/list?callback=jQuery22105640370558202532_1569842154172&column='.$wnk.'&p='.$i1.'&limit=50';
$ul2='http://newsapi.eastmoney.com/kuaixun/v2/api/list?#&column='.$wnk.'&p='.$i1.'&limit=50';
//preg_match("|\((.*)\)|ism",f_g($ul2),$b);
        $ut = m_v($ul2);
        $nt = J_d($ut,true);
        $aa = $nt["news"];
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["url_w"];   
        $a2 = m_u($a0["title"]); 
        $a3 = m_u($a0["digest"]);  
        $a4 = $a0["showtime"]; 
        $a5 = $a0["ordertime"]; 
        $xml ='<a>'.$a4.' &nbsp;&nbsp;&nbsp;&nbsp; '.$a3.'</a>';
        //$xml2 ='<a href="'.$ud.'"  target="tv">'.$a4.''.$a3.'</a>';
echo $xml;
}}}
function cft($url) {
       $wk= array("102","101","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:"2";
       for ($i1 = 1; $i1 <=$p; $i1++) {
//$ul='https://newsinfo.eastmoney.com/kuaixun/v2/api/list?callback=jsonp_5425A849FF7C4759BDDBC6D3A8AA7D11&column='.$wnk.'&p='.$i1.'&limit=50';
$ul='https://newsinfo.eastmoney.com/kuaixun/v2/api/list?#&column='.$wnk.'&p='.$i1.'&limit=50';
//preg_match("|\((.*)\)|ism",m_v($ul),$b);
        $ut = m_v($ul);
        $nt = J_d($ut,true);
        $aa = $nt["news"];
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a2 = $a0["url_w"];   
        $a3 = m_u($a0["title"]); 
        $a4 = m_u($a0["digest"]);  
        $a5 = $a0["showtime"]; 
        $a6 = $a0["ordertime"]; 
       $ud = $a2;
       $xml ='<a>'.$a6.' &nbsp;&nbsp;&nbsp;&nbsp; '.$a4.'</a>';
       //$xml2 ='<a href="'.$ud.'"  target="tv">'.$a6.''.$a3.'</a>';
echo $xml;
}}}
function cft20($url) {
       $wk= array("zhiboall","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:"1";
       for ($i = 1; $i <=$p; $i++) {
    $ul='http://newsapi.eastmoney.com/kuaixun/v1/getlist_'.$wnk.'_ajaxResult_50_'.$i.'_.html?';
        $ut = f_g($ul);
preg_match_all('|"url_w":"([^<]+)"(.*)"url_m":"([^<]+)"(.*)"title":"([^<]+)"(.*)"digest":"([^<]+)"(.*)"showtime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = $d[3][$k];
       $a4 = m_u($d[5][$k]);
       $a5 = m_u($d[7][$k]);
       $a6 = $d[9][$k];
       $ud = $a2;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a6.'&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;( '.$a5.' )</a>';
       $xml2 ='<a href="'.$ud.'"  target="tv">'.$a6.'&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;( '.$a5.' )</a>';
echo $xml;
}}}
function cft2($url) {//东方财经
       $wk= array( "102","101","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"1";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
  for ($i = 1; $i <=$p; $i++) {
       $p1 =$i*100;
    //$ul='https://newsapi.eastmoney.com/kuaixun/v1/getlist_'.$wnk.'_ajaxResult_50_'.$i.'_.html?';
    $ul='https://newsapi.eastmoney.com/kuaixun/v1/getlist_'.$wnk.'__50_'.$i.'_.html?';
//preg_match("|\"LivesList\":\[\{(.*)\}\],\"PageCount\"|ism",m_v($ul),$b);
        //$ut = '['.'{'.$b[1].'}'.']';
        $ut = m_v($ul);
        $nt = J_d($ut,true);
        $aa = $nt["LivesList"];
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a2 = $a0["url_w"];   
        $a3 = m_u($a0["title"]); 
        $a4 = m_u($a0["digest"]);  
        $a5 = $a0["showtime"]; 
        $a6 = $a0["ordertime"]; 
       $xml ='<a>'.$a5.' : '.$a4.'</a>';
       $xml1 ='<a href="'.$ud.'"  target="tv">'.$a5.' : '.$a4.'</a>';
echo $xml;
}}}
function ycxw($url) {//一财经
       $wk= array( "102","101","102","103","104","105","106","107","108","109","110");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"1";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
  for ($i = 1; $i <=$p; $i++) {
    $ul='https://www.yicai.com/api/ajax/getjuhelist?action=news&page='.$i.'&pagesize=25';
        $ut = m_v($ul);
        $nt = J_d($ut,true);
        $aa = $nt;
        $J_ccc = count($aa);
 for ($i2 = 0; $i2 < $J_ccc; $i2++) {
        $a0 = $aa[$i2];
        $a1 = $a0["ChannelID"];
        $a2 = $a0["CreateDate"]; 
        $a3 = $a0["LastDate"];    
        $a4 = $a0["NewsID"];     
        $a5 = m_u($a0["NewsNotes"]); 
        $a6 = m_u($a0["NewsTitle"]);  
        $a7 = $a0["VideoUrl"]; 
       $xml ='<a>'.$a3.'  &nbsp;&nbsp;'.$a5.' --- --  '.$a6.' </a>';
       $xml1 ='<a href="'.$ud.'"  target="tv">'.$a5.' : '.$a4.'</a>';
echo $xml;
}}}
function cft3($url) {//资讯精华
       $wk= array("zhiboall","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131","132");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
       $p = $_GET['p']?$_GET['p']:"1";
       //for ($i = 1; $i <=$p; $i++) {}
       $p1 = $p*20;
$ul='http://newsapi.eastmoney.com/kuaixun/v1/yw_m_ywjh_'.$p1.'_0.html';
        $ut = f_g($ul);
preg_match_all('|"url_w":"([^<]+)"(.*)"url_m":"([^<]+)","title":"([^<]+)"(.*)"digest":"([^<]+)"(.*)"showtime":"([^<]+)","ordertime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2 = $d[1][$k];
       $a3 = $d[3][$k];
       $a4 = $d[4][$k];
       $a5 = m_u($d[6][$k]);
       $a6 = $d[8][$k];
       $ud = $a2;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a6.''.$a5.'</a>';
       $xml2 ='<a href="'.$ud.'"  target="tv">'.$a6.''.$a5.'</a>';
echo $xml;
}}
function dfcj($url) {//东方财经
       $wk= array( "100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119","120","121","122","123","124","125","126","127","128","129","130","131");
       $w = $_GET['w']?$_GET['w']:"0";
       $u = $_GET['u']?$_GET['u']:"1";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $wnk = $wk[$w];
  for ($i = 1; $i <=$p; $i++) {
       $p1 =$i*100;
       $ul='http://newsapi.eastmoney.com/kuaixun/v1/getlist_'.$wnk.'_ajaxResult_'.$p1.'_'.$u.'_'.$t.'.html';
        $ut = f_g($ul);
preg_match_all('|"newsid":"([^<]+)"(.*)"url_w":"([^<]+)"(.*)"digest":"([^<]+)"(.*)"showtime":"([^<]+)"(.*)"ordertime":"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|"showtime":"([^<]+)"(.*)"ordertime":"([^<]+)"|ismU',$ut,$d2);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = $d1[3][$k];
       $a4 = $d1[5][$k];
       $a5 = $d1[7][$k];
       $a6 = $d1[9][$k];
       $a7 = $d2[1][$k];
       $a8 = $d2[3][$k];
       $ud2 = 'http://finance.eastmoney.com/news/'.$a3.'.html';
       $ud = 'http://newsapi.eastmoney.com/soft/zixun/pages/article.html?newsid='.$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a5.' : '.$a4.'</a>';
       $xml1 ='<a href="'.$ud.'"  target="tv">'.$a5.' : '.$a4.'</a>';
echo $xml;
}}}
function wst($url) {
       $wk= array("201","301","401","701","a01","g02","p01","q01","s01","t01","w01","704");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w];
$ul='http://news.vsatauth.com/mound/getnews?count=200&name=G'.$wnk.'&start=0&guid=690f463154c64699b33226f97d413e20&format=json&prefix=QSXW=&rnd=&mnid=1&submid=1&mns=QS';
        $ut = f_g($ul);                                                        
preg_match_all('|CODE:"([^<]+)",SUFFIX:"([^<]+)",CAPTION:"([^<]+)",|ismU',$ut,$d1);
preg_match_all('|NEWSDATE:"([^<]+)",|ismU',$ut,$d2);
preg_match_all('|NAMECN:"([^<]+)",|ismU',$ut,$d3);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = $d1[2][$k];
       $a4 = m_u($d1[3][$k]);
       $a5 = $d2[1][$k];
       $a6 = 'http://web.vsatauth.com/vsatjjyw/artbody.aspx?reqtype=news&fileid='.$a2.'&guid=9db39f606d7340e8aca6808c768e35c4';
       $a7 = 'http://web.vsatauth.com/web/vsatnews/'.$a2.'/'.$a2.'.html';
       $a8 = 'http://report.vsatauth.com/web/vsatnews/'.$a2.'/'.$a2.'.html';
       $ud = $a8;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'"  target="tv">'.$a5.':: '.$a4.' </a>';
echo $xml;
}}
function wstqb($url) {//公司情报
       $w = $_GET['w']?$_GET['w']:date("d");
       $we=$w-1;
       $ye=date("Y");
       $yue=date("m");
       $dt=date("d")-1;
       $da=date("d");
       $de='-';
       $rd=$ye.$de.$yue.$de.$dt.' 00:00:00';
       $re=$ye.$de.$yue.$de.$da.' 23:59:59';
$ul1='http://news.vsatauth.com/mound/getnewstop?news=Gq04&startdate='.$re.''.$we.' 00:00:00&enddate='.$re.''.$w.' 23:59:59&type=0&sort=1&format=json&maxcount=100&prefix=VC1=';
$ul='http://news.vsatauth.com/mound/getnewstop?news=Gq04&startdate='.$rd.'&enddate='.$re.'&type=0&sort=1&format=json&maxcount=100&prefix=VC1=';
        $ut = f_g($ul);                                                          
preg_match('|CODE:"([^<]+)",|',$ut,$d1);
//preg_match_all('|"([^<]+)","1001","([^<]+)","([^<]+)",|ismU',$ut,$d1);
//preg_match_all('|CAPTION:"([^<]+)",|ismU',$ut,$d2);
//preg_match_all('|NEWSDATE:"([^<]+)",|ismU',$ut,$d3);
//foreach ($d1[1] as $k=>$v){}
       $a3 = $d1[1];
       $a4 = m_u($d2[2][$k]);
       $a5 = $d3[3][$k];
       $a6 = 'http://web.vsatauth.com/vsatjjyw/artbody.aspx?reqtype=news&fileid='.$a3.'&guid=9db39f606d7340e8aca6808c768e35c4';
       $a7 = 'http://web.vsatauth.com/web/vsatnews/'.$a3.'/'.$a3.'.html';
       $a8 = 'http://report.vsatauth.com/web/vsatnews/'.$a3.'/'.$a3.'.html';
       $ud = $a3;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$ud.'</a>';
       //$xml ='<a href="'.$ud.'"  target="tv">'.$a3.':: '.$a2.' </a>';
echo $ut;
}
function jiejin($url) {
       $yue=date("m");
       $ye=date("Y");
       $de=date("d");
       $da=date("d")-3;
       $dat=$ye.'-'.$yue.'-'.$de;
       //$wk= array("BST","1","2","3","4","5","6","7","8","9");
       $wk= array("true","0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:$yue;
     //if($w=="") $t=$yue;
       $p = $_GET['p']?$_GET['p']:50;
       //$tnk =$tk[$t];
       $wnk =$wk[$w];
       $ul='http://datainterface.eastmoney.com/EM_DataCenter/JS.aspx?type=FD&sty=BST&st=3&sr='.$wnk.'&fd='.$ye.'&mkt=1&p=1&ps='.$p.'&stat='.$t.'&js=date[(x)]&code='.$w;  
       $ul2='http://datainterface.eastmoney.com/EM_DataCenter/JS.aspx?type=FD&sty=BST&st=3&sr=true&fd=2019&mkt=1&p=1&ps=4&stat=5&js=date[(x)]&code=600000';
       $ul3='http://searchapi.eastmoney.com/api/Info/Search?and20=MultiMatch%2fArt_Title%2cArt_Content%7c0%2f%E9%99%90%E5%94%AE%E8%A7%A3%E7%A6%81%5e%2fTrue&isAssociation20=true&sort20=Art_ShowTime|2&pageIndex20=1&pageSize20=10&returnFields20=Art_Url,Art_Title,Art_ShowTime,Art_UniqueUrl|0&type=20&token=421E6C71CE2AB57E01D7AF704E5356F5&highlights20=null&nor20=Term%2fArt_Channel_Id%2f9%5e%2fFalse&cb=jQuery18308712034501817145_1558862354255&_=1558862354262';
       $ul4='http://data.eastmoney.com/center/zxtg.html?key=%E9%99%90%E5%94%AE%E8%A7%A3%E7%A6%81&infolist_eventcode=sjpd_xsjjlb_xsjjjd_wzqydjzh&more_eventcode=sjpd_xsjjlb_xsjjjd_djgd';
       $ut = m_v($ul);
preg_match_all('|"([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1 = $d[1][$k];
       $a2 = $d[2][$k];
       $a3 = $d[3][$k];
       $a4 = m_u($d[4][$k]);
       $a5 = $d[5][$k];
       $a6 =m_u('解禁数量: ').$d[6][$k].m_u(' 股');
       $a7 = $d[7][$k].m_u(' 股');
       $a8 = m_u('价 ').$d[8][$k];
       $a9 = $d[9][$k];
       $a10 = $d[10][$k];
       $a11 = $d[11][$k];
       $a12 = $d[12][$k];
       $a13 = m_u('合计 ').$d[6][$k]*$d[8][$k]/100000000;
       $a14 = m_u('亿元');
       $ud = ''.$a5.': '.$a4.' ( '.$a2.' )&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;'.$a13.'( '.$a14.' )';
       $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function jianci($url) {
       $wk= array("GGMC","1","2","3","4","5","6","7","8","9");
       $tk= array("true","0","1","2","3","4");
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $tnk =$tk[$t];
       $wnk =$wk[$w];
     if($w=="") $tnk=$tnk;else $tnk=0;
       for ($i = 1; $i <=$p; $i++) {
       $ul='http://datainterface.eastmoney.com/EM_DataCenter/JS.aspx?type=GG&sty=GGMC&st=-1&sr='.$tnk.'&name=&p='.$i.'&ps=10&mkt=1&js=var%20data=[(x)]&code='.$w;
       $ut = f_g($ul);
preg_match_all("|\"([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+)\"|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1 = $d[1][$k];
       $a2 = m_u($d[2][$k]);
       $a3 = $d[3][$k];
       $a4 = $d[4][$k];
       $a5 = $d[5][$k];
       $a6 = $d[6][$k];
       //$a6 = '2016-'.$d[6][$k];
       $a7 = $d[7][$k].m_u('股');
       $a8 = m_u('剩余').$d[8][$k].m_u('股');
       $a9 = m_u('均价').$d[9][$k];
       $a10 = $d[10][$k];
       $a13 = $d[13][$k];
       $a14 = $d[14][$k];
       $a15 = $d[15][$k];
       $ud = ''.$a6.': '.$a10.' ( '.$a3.' )  '.$a13.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a14.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a15.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a2.' ';
	$xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function east($url) {
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:1;
     if($w=="") $t=$t;else $tnk=0;
$ul='http://datainterface.eastmoney.com/EM_DataCenter/JS.aspx?type=LHB&sty=YYTJ&stat='.$t.'&st=1&sr=0&p=1&ps=100&mkt=1&js=var%20lhb={"data":[(x)]}&code='.$w;
        $ut = m_v($ul);
preg_match_all('|{"data":(.*)}|U',$ut,$ud);
foreach ($ud[1] as $uk=>$uv){
preg_match_all("|\"(.*),(.*),(.*),(.*),(.*),(.*),(.*),(.*),(.*),(.*),(.*),(.*),([^>]+),(.*)\",|U",$uv,$d);
foreach ($d[1] as $k=>$v){
       $a3 = $d[1][$k];
       $a4 = m_u($d[13][$k]);
       $zm = $d[11][$k]/100000000;
       $mc = $d[6][$k];
       $mr = $d[12][$k];
       $ce=($mr-$mc)/100000000;
        $vd=Current(explode('?',$v));
        $number=$number+1;
        $mu =$number;
       $a5 = m_u("总");
       $a6 = m_u("差");
	$xml ='<a href="http://data.eastmoney.com/soft/stock/TradeSearchHistory.aspx?id='.$a3.'" target="tv">'.$a4.'('.$mu.')('.$a5.':'.$zm.')('.$a6.':'.$ce.')</a>';
echo $xml;
}}}
function hejkx($url) {//东方财富解禁
       $wk= array("global","a-stock","us-stock","hk-stock","forex-stock","goldc-stock");
       $w = $_GET['w']?$_GET['w']:'0';
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk =$wk[$w];
 //for ($i1 = 0; $i1 <= $p; $i1++) { }
       $p1=$p*20;
   $ul1='https://api-one.wallstcn.com/apiv1/content/lives?channel='.$wnk.'-channel&client=pc&cursor=&limit='.$p1.'&first_page=false&accept=live%2Cvip-live';
   $ul2='https://api-one.wallstcn.com/apiv1/content/lives?channel=a-stock-channel&client=pc&limit=20&first_page=true&accept=live%2Cvip-live';
       $ut = J_d(m_v($ul1),True);
       $aa = $ut["data"]["items"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = m_u(r_u($a0["content"]));
       $a2 = m_u($a0["content_text"]);
       $a3 = t_m($a0["display_time"]-28800);
       $a4 = m_u($a0["title"]);
       $a5 = $a0["uri"];
       $xml ='<a>'.$a3.' :  '.$a2.'</a>';
echo $xml;
}}
function dfjj($url) {//东方财富解禁
       $w = $_GET['w']?$_GET['w']:'600000';
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:1;
       $ul='http://m.data.eastmoney.com/dxf/detailinfo/'.$w;
       $ut = J_d(m_v($ul),True);
 for ($ii = 0; $ii <= $p; $ii++) { 
       $aa = $ut[$ii];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0["ShareholderName"];
       $a2 = $a0["JjSumCount"];
       $a3 = $a0["JjCount"];
       $a4 = $a0["JjDate"];
       $a5 = $a0["JjDateStr"];
       $a6 = $a0["XsType"];
       $a7 = $a0["SecurityCode"];
       $a8 = $a0["SecurityName"];
       $a9 = $a0["Source"];
       $a10 = m_u("数量：");
       $xml ='<a>'.$a5.' : '.$a8.' ('.$a7.')   '.$a1.'     ( '.$a6.' )      '.$a10.''.$a2.' ('.$a9.')</a>';
echo $xml;
}}}
function yjyg($url) {//业绩预告
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $yt=date("Y")-date("m");
       $dd=date("d")-1;
     if($dd<10) $dd='0'.$dd;
 for ($i1 = 1; $i1 <= $p; $i1++) { 
   if($w==1) {
       $ul2='https://datacenter-web.eastmoney.com/securities/api/data/v1/get?callback=&sortColumns=NOTICE_DATE%2CSECURITY_CODE&sortTypes=-1%2C-1&pageSize=50&pageNumber='.$i1.'&reportName=RPT_PUBLIC_OP_NEWPREDICT&columns=ALL&token=894050c76af8597a853f5b408b759f5d&filter=(FORECAST_STATE%3D%22reduction%22)';
} else if($w==3) {
       $ul2='https://datacenter-web.eastmoney.com/securities/api/data/v1/get?callback=&sortColumns=NOTICE_DATE%2CSECURITY_CODE&sortTypes=-1%2C-1&pageSize=50&pageNumber='.$i1.'&reportName=RPT_PUBLIC_OP_NEWPREDICT&columns=ALL&token=894050c76af8597a853f5b408b759f5d&filter=(REPORT_DATE%3D%272021-09-30%27)(FORECAST_STATE%3D%22reduction%22)';
} else if($w==2)  {
       $ul2='https://datacenter-web.eastmoney.com/securities/api/data/v1/get?callback=&sortColumns=NOTICE_DATE%2CSECURITY_CODE&sortTypes=-1%2C-1&pageSize=50&pageNumber='.$i1.'&reportName=RPT_PUBLIC_OP_NEWPREDICT&columns=ALL&token=894050c76af8597a853f5b408b759f5d&filter=(REPORT_DATE%3D%272021-09-30%27)(FORECAST_STATE%3D%22increase%22)';
} else if($w==4)  {
       $ul2='https://datacenter-web.eastmoney.com/api/data/get?callback=&st=UPDATE_DATE%2CSECURITY_CODE&sr=-1%2C-1&ps=50&p='.$i1.'&type=RPT_LICO_FN_CPD&sty=ALL&token=894050c76af8597a853f5b408b759f5d&filter=';
} else if($w==5)  {
       $ul2='https://datacenter-web.eastmoney.com/api/data/v1/get?callback=&sortColumns=ADD_MARKET_CAP&sortTypes=-1&pageSize=50&pageNumber='.$i1.'&reportName=RPT_MUTUAL_STOCK_NORTHSTA&columns=ALL&source=WEB&client=WEB&filter=(TRADE_DATE%3D%27'.date("Y").'-'.date("m").'-'.$dd.'%27)(INTERVAL_TYPE%3D%221%22)';
} else {
       $ul2='https://datacenter-web.eastmoney.com/securities/api/data/v1/get?callback=&sortColumns=NOTICE_DATE%2CSECURITY_CODE&sortTypes=-1%2C-1&pageSize=50&pageNumber='.$i1.'&reportName=RPT_PUBLIC_OP_NEWPREDICT&columns=ALL&token=894050c76af8597a853f5b408b759f5d&filter=(FORECAST_STATE%3D%22increase%22)';
}

       $ut = m_v($ul2);
       $nt = J_d($ut,ture);
       $aa = $nt["result"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
if($w==4) {
       $a1 = $a0["SECURITY_CODE"];
       $a2 = $a0["SECURITY_NAME_ABBR"];
       $a3 = $a0["UPDATE_DATE"];
       $a4 = $a0["ASSIGNDSCRPT"];
}else if($w==5){
       $a1 = $a0["SECUCODE"];
       $a3 = $a0["TRADE_DATE"];
       $a2 = m_u($a0["SECURITY_NAME"]);
       $a5 = m_u('占流通股比:').$a0["FREE_SHARES_RATIO"];
       $a4 = m_u('持股:').$a0["ADD_SHARES_REPAIR"];

}else {
       $a1 = $a0["SECUCODE"];
       $a2 = $a0["SECURITY_NAME_ABBR"];
       $a3 = $a0["NOTICE_DATE"];
       $a4 = $a0["PREDICT_CONTENT"];
       $a5 = $a0["PREDICT_TYPE"];
       $a6 = $a0["TRADE_MARKET"];
}
       $xml ='<a target="b">'.$a2.' : ('.$a1.')   '.$a4.'   ('.$a5.')     ('.$a3.')</a>';
echo $xml;
}}}
function dfjj0($url) {//东方财富解禁
       $w = $_GET['w']?$_GET['w']:'600000';
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:50;
       $ul='http://m.data.eastmoney.com/dxf/detailinfo/'.$w;
        $ut = f_g($ul);
preg_match_all('|"CompanyCode":"([^<]+)","ShareholderName":"([^<]+)","JjNum":([^<]+),"JjSumCount":([^<]+),"JjCount":([^<]+),"JjDate":"([^<]+)","JjDateStr":"([^<]+)","XsType":"([^<]+)","SecurityCode":"([^<]+)","SecurityName":"([^<]+)","Source":"([^<]+)"|ismU',$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[7][$k];
       $a3 = $d1[8][$k];
       $a4 = $d1[9][$k];
       $a5 = $d1[10][$k];
       $a6 = $d1[11][$k];
       $a7 = $d1[4][$k];
       $a8 = $d1[6][$k];
       $a9 = m_u("数量：");
       $ud = 'http://m.data.eastmoney.com/dxf/detail/'.$w;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="tv">'.$a2.' : '.$a3.' ('.$a4.''.$a5.')  '.$a9.' '.$a7.' ('.$a6.')</a>';
echo $xml;
}}

function dfyyb($url) {//东方财富营业部
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:1;
       $p = $_GET['p']?$_GET['p']:50;
       $ul='http://m.data.eastmoney.com/lhb/inquiryofsales';
        $ut = f_g($ul);
preg_match_all("|<a href=\"(.*)SalesDetail\('([^<]+)'\)\">(.*)<li>([^<]+)<\/li>|ismU",$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[2][$k];
       $a3 = $d1[4][$k];
       $ud = 'http://m.data.eastmoney.com/lhb/jgsearch/'.$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="tv">'.$a2.' : '.$a3.'</a>';
echo $xml;
}}
function dfyybt($url) {//东方财富营业部统计
       $uk= array("TraderStatisticList","ActiveStatisticsList");
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:'0';
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:50;
       $unk= $uk[$u];
       $year = date("Y");
       $mouth = date("m");
       $rmouth = $mouth -1;
       $day = date("D");
       $rday = date("Y-m-d",strtotime("last month"));
       $tday = date("Y-m-d,time()");
       $ul2='http://m.data.eastmoney.com/lhb/TraderStatisticList';
       $ul1='http://m.data.eastmoney.com/api/Lhb/TraderStatisticList?sortRule=-1&startDate='.$rday.'&endDate='.$tday.'&page=1&pagesize=200';
       $ul='http://m.data.eastmoney.com/api/Lhb/TraderStatisticList?sortRule=-1&startDate='.$rday.'&endDate='.$tday.'&page=1&pagesize=200&sortType=UpCount';
       $ul3='http://m.data.eastmoney.com/api/Lhb/ActiveStatisticsList?sortType=Bmoney&sortRule=-1&startDate='.$tday.'&endDate='.$tday.'&page=1&pagesize=200';
        $ut = f_g($ul);
preg_match_all('|"SalesCode":"([^<]+)","SalesName":"([^<]+)","SumActBMoney":"([^<]+)","SumActSMoney":"([^<]+)","SumActMoney":"([^<]+)","BCount":"([^<]+)","SCount":"([^<]+)","UpCount":"([^<]+)"|ismU',$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = $d1[2][$k];
       $a4 = $d1[3][$k]/100;
       $a5 = $d1[4][$k]/100;
       $a6 = $d1[5][$k]/100;
       $a7 = $d1[8][$k];
       $b6 = m_u("&nbsp;&nbsp;&nbsp;总成交额&nbsp;&nbsp;");
       $b7 = m_u("&nbsp;&nbsp;&nbsp;上榜次数&nbsp;&nbsp;");
       $b4 = m_u("&nbsp;&nbsp;&nbsp;买入&nbsp;&nbsp;");
       $b5 = m_u("&nbsp;&nbsp;&nbsp;卖出&nbsp;&nbsp;");
       $b8 = m_u("&nbsp;万&nbsp;&nbsp;");
       $ud = 'http://m.data.eastmoney.com/lhb/jgsearch/'.$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="tv">'.$a2.' : '.$a3.$b4.$a4.$b8.$b5.$a5.$b8.$b6.$a6.$b8.$b7.$a7.'</a>';
echo $xml;
}}
function dfyybd($url) {//东方财富营业部统计
       $uk= array("TraderStatisticList","ActiveStatisticsList");
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:'0';
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:50;
       $unk= $uk[$u];
       $year = date("Y");
       $mouth = date("m");
       $rmouth = $mouth -1;
       $day = date("D");
   if($t<=$day) $t=$t;else $t=$day;
       $rday = date("Y-m-d",strtotime("last month"));
       $tday = date("Y-m-d,time()");
       $mday = $year.'-'.$mouth.'-'.$t;
       $ul2='http://m.data.eastmoney.com/lhb/TraderStatisticList';
       $ul1='http://m.data.eastmoney.com/api/Lhb/TraderStatisticList?sortRule=-1&startDate='.$rday.'&endDate='.$tday.'&page=1&pagesize=200';
       $ul='http://m.data.eastmoney.com/api/Lhb/TraderStatisticList?sortRule=-1&startDate='.$rday.'&endDate='.$tday.'&page=1&pagesize=200&sortType=UpCount';
       $ul3='http://m.data.eastmoney.com/api/Lhb/ActiveStatisticsList?sortType=Bmoney&sortRule=-1&startDate='.$mday.'&endDate='.$mday.'&page=1&pagesize='.$p;
        $ut = f_g($ul3);
preg_match_all('|"YybCode":"([^<]+)","YybName":"([^<]+)"(.*)"Bmoney":"([^<]+)","Smoney":"([^<]+)","JmMoney":"([^<]+)"(.*)"JsonNameCodes"(.*)"CodeName":"([^<]+)","SCode":"([^<]+)"(.*)"TDate":"([^<]+)"|ismU',$ut,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = $d1[2][$k];
       $a4 = $d1[4][$k]/100;
       $a5 = $d1[5][$k]/100;
       $a6 = $d1[6][$k]/100;
       $a7 = $d1[9][$k];
       $a8 = $d1[10][$k];
       $b6 = m_u("&nbsp;万&nbsp;&nbsp;");
       $b7 = m_u("&nbsp;&nbsp;&nbsp;股票&nbsp;&nbsp;");
       $b4 = m_u("&nbsp;&nbsp;&nbsp;买入&nbsp;&nbsp;");
       $b5 = m_u("&nbsp;&nbsp;&nbsp;卖出&nbsp;&nbsp;");
       $ud = 'http://m.data.eastmoney.com/lhb/jgsearch/'.$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'" target="tv">'.$a2.' : '.$a3.$b4.$a4.$b6.$b5.$a5.$b6.$b7.$a7.$b8.'</a>';
echo $xml;
}}
function dfapp($url) {//东方财富
       $wk= array("","增","涨","国家","打造","合作","断货","签署","签订","签约");
       $uk= array("01","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25");
       $tk= array("1","1","2","3","4","5","6","7","8","9");
       $t2k= array("F888001","F888005","F888008","F888006","S888005001","S888005002","S888005003","S888005004","S888005005","S888005011");
       $t3k= array("S004003","S004004","T004004001","T004013003","C888001034001","S007040","S007038","S007006","T004012003");
       $t = $_GET['t']?$_GET['t']:0;
       $a = $_GET['a']?$_GET['a']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
if( $a==1) {
     if($t<4) $w = $_GET['w']?$_GET['w']:"减持";
}else $w = $_GET['w']?$_GET['w']:"";
       $kw=k_w($w);
       $sh='SH';
       $sz='SZ';
       $ww=substr($w,0,2);
       $wm='';
   if($ww=='60'|| $ww=='68') $wm=$w.'.SH';else $wm=$w.'.SZ';
       $unk= $uk[$u];
       $tnk= $tk[$t];
       $t2nk= $t2k[$t];
       $t3nk= $t3k[$t];
   if($ww<='68' and $w >0) {
       $wmm='&securitycodes='.$wm.'&title=';
}else {
       $wmm='&securitycodes=&title='.$kw.'';
}
for ($i = 1; $i <=$p; $i++) {
if($a==0){//公告
       $ul='http://app.jg.eastmoney.com/Notice/GetNoticeBySearch.do?'.$wmm.'&pageIndex='.$i.'&limit=50&sort=datetime&order=desc';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["attach"][0]["name"]);
       $a3 = $a0["attach"][0]["url"];
       $a4 = $a0["publishDate"];
       $ud = $a3;
       $xml ='<a href="'.$ud.'"  target="b" >'.$a4.' : '.$a2.' </a>';
echo $xml;
}
}else if($a==3){//滚动
       $p1 = $i*30;
       $ul='http://183.136.162.242/web/webapi?type=102&count='.$p1.'&newsid=1';
       $ut = m_v($ul);
       $nt = J_d($ut,true);
       $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = m_u($a0["digest"]);
       $a3 = $a0["id"];
       $a4 = $a0["infoCode"];
       $a5 = $a0["showtime"];
       $a6 = m_u($a0["title"]);
       $a7 = $a0["url_w"];
       $xml ='<a>'.$a5.' : '.$a2.' </a>';
       $xml2 ='<a href="'.$a7.'"  target="b" >'.$a5.' : '.$a6.' </a>';
echo $xml;
}}else if($a==2){//研报
$ul='http://app.jg.eastmoney.com/Report/GetReportByTreeNode.do?columnCode=&type=1&id='.$t3nk.'&request=simpleSearch&cid=Admin&pageIndex='.$i.'&limit=50&sort=datetime&order=desc';
        $ut = m_v($ul);
        $nt = J_d($ut,ture);
        $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = m_u($a0["attach"][0]["name"]);
       $a3 = $a0["attach"][0]["url"];
       $a4 = $a0["date"];
       $a5 = $a0["insClassCode"];
       $a6 = m_u($a0["org"]);
       $a7 = m_u($a0["orgcode"]);
       $a8 = m_u($a0["title"]);
       $ud = $a3;
       $xml ='<a href="'.$ud.'"  target="b" >'.$a4.' : '.$a2.'&nbsp;&nbsp;(  '.$a6.' - '.$a7.' )</a>';
echo $xml;
}}else {//新闻
 if( $a==1) {
 if( stripos($t,'888') !== false){
       $types= 'types='.$t.'&columnCode=&type=&source=&text=&cid=Admin';
}else {
       $types= 'types='.$t2nk.'&columnCode=&type=&source=&text=&cid=Admin';
}} else {
if($t<='10' and $t>'0') {
       $types= 'types=I01:0040'.$unk.'00'.$tnk.'';
}else {
       $types= 'types=I01:'.$t;
}
}
       $ul='http://app.jg.eastmoney.com/NewsData/GetNewsBySearch.do?'.$types.'&'.$wmm.'&sort=date&order=desc&pageIndex='.$i.'&limit=50';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["Date"];
       $a3 = m_u($a0["Title"]);
       $a4 = m_u($a0["medianame"]);
       $a5 = $a0["url"];
       $ud = $a5;
       $xml ='<a href="'.$ud.'"  target="b" >'.$a2.' : '.$a3.' ('.$a4.')</a>';
echo $xml;
}
}
}}
function dfapps($url) {//东方财富个股公告
       $w = $_GET['w']?$_GET['w']:''; 
       $kw=k_w($w);
       $sh='.SH';
       $sz='.SZ';
       $ww=substr($w,0,2);
       $wm='';
   if($ww=='60'|| $ww=='68') $wm=$w.$sh;else $wm=$w.$sz;
       $p = $_GET['p']?$_GET['p']:1;
   if($ww<='68' and $w >0) {
       $wmm='&securitycodes='.$wm.'&title=';
}else {
       $wmm='&securitycodes=&title='.$kw.'';
}
for ($i = 1; $i <=$p; $i++) {
       $ul='http://app.jg.eastmoney.com/Notice/GetNoticeBySearch.do?'.$wmm.'&pageIndex='.$i.'&limit=50&sort=datetime&order=desc';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = m_u($a0["attach"][0]["name"]);
       $a3 = $a0["attach"][0]["url"];
       $a4 = $a0["publishDate"];
       $ud = $a3;
       $xml ='<a href="'.$ud.'"  target="b" >'.$a4.' : '.$a2.' </a>';
echo $xml;
}}}
function gasj($url) {//港澳数据
       $wk= array("102","102","103","104");
       $w = $_GET['w']?$_GET['w']:"减持";
       $wnk= $wk[$w];
       $kw= k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
 for ($i = 1; $i <=$p; $i++) {
       //$p1 = $i*30;
       $ul='http://f10.gaotime.com/search?&keyWords='.$kw.'&pageIndex='.$i.'&pageSize=10&sjly=%E5%85%A8%E9%83%A8&searchType=%E6%8C%89%E5%85%A8%E6%96%87%E6%9F%A5%E8%AF%A2&sort=%E6%8C%89%E6%97%B6%E9%97%B4%E6%8E%92%E5%BA%8F&dateType=';
       $ut = m_v($ul);
       $nt = J_d($ut,true);
       $aa = $nt["data"]["result"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = m_u($a0["zt"]);
       $a3 = m_u($a0["nr"]);
       $a4 = $a0["fsrq"];
       $a5 = $a0["zhxgrq"];
       $a6 = $a0["zhxgrqstring"];
       $a7 = "http://f10.gaotime.com/getZXInfo?id=".$a1;
       $a8 = "http://f10.gaotime.com/pdf/web/viewer.html?file=https%3A%2F%2Fggssl.gaotime.com%2F%7B'.$a1.'%7D.pdf";
       //$xml ='<a>'.$a6.' : '.$a2.' ----( '.$a3.') </a>';
       $xml ='<a href="'.$a7.'"  target="TV" >'.$a6.' : '.$a2.' --( '.$a3.') </a>';
echo $xml;
}}}
function dfappa($url) {//东方财富
       $wk= array("102","102","103","104");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk= $wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
 for ($i = 1; $i <=$p; $i++) {
       $p1 = $i*30;
       $ul='http://183.136.162.242/web/webapi?type='.$wnk.'&count='.$p1.'&newsid=1';
       $ut = m_v($ul);
       $nt = J_d($ut,true);
       $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = m_u($a0["digest"]);
       $a3 = $a0["id"];
       $a4 = $a0["infoCode"];
       $a5 = $a0["showtime"];
       $a6 = m_u($a0["title"]);
       $a7 = $a0["url_w"];
       $xml ='<a>'.$a5.' : '.$a2.' </a>';
       $xml2 ='<a href="'.$a7.'"  target="b" >'.$a5.' : '.$a6.' </a>';
echo $xml;
}}}
function dfappn($url) {//东方财富
       $wk= array("0","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25");
       $tk= array("0","1","2","3","4","5","6","7","8","9");
       $uk= array("","增","涨","国家","打造","合作","断货","签署","签订","签约");
       $w = $_GET['w']?$_GET['w']:0;
       $t = $_GET['t']?$_GET['t']:1;
       $u = $_GET['u']?$_GET['u']:"0";
       $wnk= $wk[$w];
       $tnk= $tk[$t];
       $unk= $uk[$u];
       $nnk= m_u($uk[$u]);
       $types= 'types=I01:0040'.$wnk.'00'.$tnk.'';
    if($w=='0') $types=null;else {$types=$types;};
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $p1 = $i*50;
       $ul='http://app.jg.eastmoney.com/NewsData/GetNewsBySearch.do?'.$types.'&pageIndex='.$i.'&limit=50';
        $ut = m_v($ul);
preg_match_all('|"Date":"([^<]+)"(.*)"From":"([^<]+)"(.*)"Title":"([^<]+)"(.*)"url":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1 = $d[1][$k];
       $a2 = $d[3][$k];
       $a5 = m_u($d[5][$k]);
       $a8 = $d[7][$k];
       $ud = $a8;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'"  target="b" >'.$a1.' : '.$a5.' ('.$a2.')</a>';
echo $xml;
}}}

function dfappid0($url) {
       $ul ='http://app.jg.eastmoney.com/Notice/GetLeftTree.do?cid=Admin';
       $nt = J_d(m_v($ul),ture);
       $aa = $nt["NodeList"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["Id"];
       $a2 = $a0["Name"];
     if( $a1=="F004") {
       $a3 = $a0["NodeList"];
       $c_json = count($a3);
 for ($i2 = 0; $i2 < $c_json; $i2++) { 
       $a00 = $a3[$i2]; 
       $a4 = $a00["Id"];
       $a5 = $a00["Name"];
       $ud=$a4.$a5;
}
}
//return  $ud;
echo $ud;
}}
function dfappid($url) {
       $ul ='http://app.jg.eastmoney.com/Notice/GetLeftTree.do?cid=Admin';
       $ut = m_v($ul);
preg_match_all('|"Id":"([^>]+)",(.*),"Name":"([^>]+)",|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
       $a1=$d[1];
       $a2=$d[3];
       $ud=$a1;
       $tk=json_encode($ud);
preg_match("|\[([^>]+)\]|U",$tk,$d2);
       $tk=$d2[1];
       $tk=str_replace('"', '', $tk);
return  $tk;
//echo $tk;
}}
function dfappid2($url) {
       $ul ='http://app.jg.eastmoney.com/Notice/GetLeftTree.do?cid=Admin';
       $ut = f_g($ul);
preg_match_all('|"Id":"([^>]+)",(.*),"Name":"([^>]+)",|ismU',$ut,$d);
foreach($d[1] as $k=>$v){
       $a1=$d[1];
       $a2=$d[3];
       $tk1=json_encode($a1);
       $tk2=json_encode($a2);
       $ud=array ($tk2 => $tk1);
//return $tk1;
echo $tk1;
}} 
function dfappd($url) {//东方财富
       $tk= array("","F888001","F888005","F888008","F888006","S888005001","S888005002","S888005003","S888005004","S888005005","S888005011");
       $wk= array("S004003","S004003","S004004","T004004001","T004013003","C888001034001","S007040","S007038","S007006","T004012003");
       //$w = $_GET['w']?$_GET['w']:"中国";
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
     if($t<=4) $w = $_GET['w']?$_GET['w']:"减持";else $w = $_GET['w']?$_GET['w']:"";
       $kw=k_w($w);
       $tnk= $tk[$t];
       $wnk= $wk[$w];
    for($i=1;$i<=$p;$i++){
      if( stripos($tnk,'888') !== false){
$ul2='http://app.jg.eastmoney.com/NewsData/GetNewsBySearch.do?columnCode=&type=&text=&types='.$tnk.'&title='.$kw.'&source=&cid=Admin&pageIndex='.$i.'&limit=50&sort=date&order=desc';
        $ut = m_v($ul2);
        $nt = J_d($ut,ture);
        $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = $a0["Date"];
       $a3 = m_u($a0["Title"]);
       $a6 = m_u($a0["medianame"]);
       $a5 = $a0["url"];
       $ud = $a5;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'"  target="b" >'.$a2.' : '.$a3.'&nbsp;&nbsp;(  '.$a6.')</a>';
echo $xml;
}}else {
//$ul='http://app.jg.eastmoney.com/Notice/GetNoticeBySearch.do?types=F004&date=2020/11/8T00:00:00Z%20TO%202020/11/8T23:59:59Z&pageIndex=1&limit=50&sort=datetime&order=desc';
$ul2='http://app.jg.eastmoney.com/Report/GetReportByTreeNode.do?columnCode=&type=1&id='.$wnk.'&request=simpleSearch&cid=Admin&pageIndex='.$i.'&limit=50&sort=datetime&order=desc';
        $ut = m_v($ul2);
        $nt = J_d($ut,ture);
        $aa = $nt["records"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = m_u($a0["attach"][0]["name"]);
       $a3 = $a0["attach"][0]["url"];
       $a4 = $a0["date"];
       $a5 = $a0["insClassCode"];
       $a6 = m_u($a0["org"]);
       $a7 = m_u($a0["orgcode"]);
       $a8 = m_u($a0["title"]);
       $ud = $a3;
       $xml ='<a href="'.$ud.'"  target="b" >'.$a4.' : '.$a2.'&nbsp;&nbsp;(  '.$a6.' - '.$a7.' )</a>';
echo $xml;
}}}}
function dfapp0($url) {//东方财富
       $w = $_GET['w']?$_GET['w']:'';
       $t = $_GET['t']?$_GET['t']:3;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=dfappid($url);
       $tk = explode(",", $wnk); 
       $tnk=$tk[$t]; 
       if($w=='') $tnk=$tnk;else $tnk=$w;
       $p1 = $p*50;
$ul='http://app.jg.eastmoney.com/Notice/GetNoticeById.do?id='.$tnk.'&pageIndex=1&limit='.$p1.'&sort=date&order=desc';
$ul2='http://app.jg.eastmoney.com/Report/GetReportByTreeNode.do?id='.$tnk.'&request=simpleSearch&cid=Admin&type=8&pageIndex='.$p.'&limit=50&sort=datetime&order=desc';
        $ut = m_v($ul2);
preg_match_all("|\"name\":\"([^<]+)\",|ismU",$ut,$d1);
preg_match_all("|\"date\":\"([^<]+)\",|ismU",$ut,$d2);
preg_match_all("|\"url\":\"([^<]+)\"|ismU",$ut,$d3);
preg_match_all("|\"secuFullCode\":\"([^<]+)\",|ismU",$ut,$d4);
preg_match_all("|\"secuSName\":\"([^<]+)\"|ismU",$ut,$d5);
preg_match_all("|\"title\":\"([^<]+)\"|ismU",$ut,$d6);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[1][$k];
       $a3 = $d3[1][$k];
       $a4 = $d2[1][$k];
       $a5 = $d4[1][$k];
       $a6 = $d5[1][$k];
       $a7 = m_u($d6[1][$k]);
       $ud = $a3;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'"  target="b" >'.$a4.' : '.$a2.'&nbsp;&nbsp;( '.$a7.' )</a>';
echo $xml;
}}
function gdcg($url) {//汇金持股
       $w = $_GET['w']?$_GET['w']:'80475097';
       $t = $_GET['t']?$_GET['t']:1;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $p1 = $i*50;
$ul='http://data.eastmoney.com/DataCenter_V3/gdfx/data.ashx?SortType=RDATE,NDATE&SortRule=3&PageIndex=1&PageSize='.$p1.'&jsObj=aYlSRvfT&type=NSHDDETAIL&cgbd=0&filter=(SHAREHDCODE=%27'.$w.'%27)&rt=50879441';
$ul2='http://datacenter.eastmoney.com/api/data/get?type=RPT_LICO_FN_CPD&sty=ALL&p='.$p.'&ps=50&st=UPDATE_DATE,SECURITY_CODE&sr=-1,-1&var=cdGfixAQ&filter=(REPORTDATE=%272020-09-30%27)&rt=53484451';
        $ut = f_g($ul);
preg_match_all("|\"COMPANYCODE\":\"([^<]+)\",|ismU",$ut,$d1);
preg_match_all("|\"SHAREHDNAME\":\"([^<]+)\",|ismU",$ut,$d2);
preg_match_all("|\"SCODE\":\"([^<]+)\"|ismU",$ut,$d3);
preg_match_all("|\"SNAME\":\"([^<]+)\",|ismU",$ut,$d4);
preg_match_all("|\"RDATE\":\"([^<]+)\"|ismU",$ut,$d5);
preg_match_all("|\"SHAREHDNUM\":([^<]+),\"LTAG\":([^<]+),\"ZB\":([^<]+),\"NDATE\":\"([^<]+)\",\"BZ\":\"([^<]+)\",|ismU",$ut,$d6);
foreach ($d1[1] as $k=>$v){
       $a1 = $d1[1][$k];
       $a2 = m_u($d2[1][$k]);
       $a3 = $d3[1][$k];
       $a4 = m_u($d4[1][$k]);
       $a5 = $d5[1][$k];
       $a6 = $d6[1][$k];
       $a7 = $d6[3][$k]*100;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a2.' : '.$a4.'&nbsp;( '.$a3.' ) &nbsp;( '.$a5.' )  : '.$a7.'</a>';
echo $xml;
}}}
function lhb($url) {
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
$ul='http://lhb.shdjt.com/jgzxcx.asp?jgzx=&pageno='.$i.'';
        $ut = m_v($ul);
preg_match_all("|<table class=\"tb0td1\"(.*)</table|ismU",$ut,$vd);
foreach ($vd[1] as $kv=>$vv){
preg_match_all("|<td>(.*)</td>(.*)<td>(.*)</td>(.*)<td class=tdleft1><a target=\"_blank\" href=\"(.*)\">(.*)</td>(.*)</tr>|ismU",$vv,$d1);
foreach ($d1[1] as $k=>$v){
       $a2 = $d1[3][$k];
       $a3 = $d1[5][$k];
       $a4 = 'http://lhb.shdjt.com/'.$a3;
       $a5 = m_u($d1[6][$k]);
       $vd=Current(explode('?',$v));
        $number=$number+1;
        $mu =$number;
       $a7 = m_u("上榜时间:");
       $xml ='<a href="'.$a4.'" target="tv">('.$mu.')'.$a5.'('.$a7.''.$a2.')</a>';
echo $xml;
}}}}
function jckx($url) {//巨潮快讯
       //$uk= array("sse","szse","szse_main","szse_sme","regulator","pre_disclosure");
       $t=$_GET['t']?$_GET['t']:date("d");
       $ye = date("Y");
       $ym = date("m"); if(strlen($ym)<2 ) $ym='0'.$ym;else $ym=$ym;
       if(strlen($t)<2 ) $dm='0'.$t;else $dm=$t;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://www.cninfo.com.cn/new/quickNews/queryQuickNews?queryDate='.$ye.'-'.$ym.'-'.$dm.'&type=%E5%85%AC%E5%91%8A&pageNum='.$i.'&pageSize=30';
       $ul1 ='http://www.cninfo.com.cn/new/quickNews/queryQuickNews?queryDate=2021-11-01&type=%E5%85%AC%E5%91%8A&pageNum='.$i.'&pageSize=30';
       $ut =  J_d(m_s($ul2),ture);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["code"];
       $a2 = $a0["pageUrl"];
       $a3 = m_u($a0["title"]);
       $a5 = t_m(substr($a0["announcementTime"], 0, -3));
       $a6 = $a0["pagePath"];
       $a7 = m_u($a0["type"]);
     //$xml ='<a>'.$a7.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
     $xml ='<a href="'.$a6.'" target="b" >'.$a5.' : ('.$a1.'):'.$a3.'('.$a7.')</a>';
echo $xml;
}}}
function cgg($url) {
       $uk= array("sse","szse","szse_main","szse_sme","regulator","pre_disclosure");
       $w=$_GET['w']?$_GET['w']:"600000";
       $u=$_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $unk =  $uk[$u];
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://www.cninfo.com.cn/new/disclosure?column='.$unk.'_latest&pageNum='.$i.'&pageSize=30';
       $ul ='http://www.cninfo.com.cn/new/disclosure?column='.$unk.'_latest&pageNum='.$i.'&pageSize=30&sortName=&sortType=&clusterFlag=true';
       $ul3 ='http://www.cninfo.com.cn/new/disclosure?#&column=szse_latest&pageNum=1&pageSize=30&sortName=&sortType=&clusterFlag=true';
       $ut =  J_d(m_s($ul),ture);
    for($i3=0;$i3<=200;$i3++){
       $aa = $ut["classifiedAnnouncements"][$i3];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["secCode"];
       $a2 = m_u($a0["secName"]);
       $a3 = $a0["announcementId"];
       $a4 = m_u($a0["announcementTitle"]);
       $a5 = t_m(substr($a0["announcementTime"], 0, -3));
       $a6 = $a0["adjunctSize"];
       $a7 = t_m(substr($a0["storageTime"], 0, -3));
       $a8 = 'http://www.cninfo.com.cn/new/disclosure/detail?plate=szse&stockCode='.$a1.'&announcementId='.$a3.'&&announcementTime='.$a5.'';
     //$xml ='<a>'.$a7.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
     $xml ='<a href="'.$a8.'" target="b" >'.$a5.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
echo $xml;
}}}}
function cgg0($url) {
       $uk= array("sse","szse","szse_main","szse_sme","regulator","pre_disclosure");
       $w=$_GET['w']?$_GET['w']:"600000";
       $u=$_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $unk =  $uk[$u];
    for($i=1;$i<=$p;$i++){
       $ul ='http://www.cninfo.com.cn/new/disclosure?column='.$unk.'_latest&pageNum='.$i.'&pageSize=30&sortName=&sortType=&clusterFlag=true';
     $ut =  m_s($ul);
preg_match("#\[\[(.*)\]\]#U",$ut,$b1);
preg_match_all('|"secCode":"([^<]+)"(.*)"secName":"([^<]+)"(.*)"announcementId":"([^<]+)"(.*)"announcementTitle":"([^<]+)"(.*)"announcementTime":([^<]+),"adjunctUrl":"([^<]+)"(.*)"storageTime":([^<]+),|ismU',$b1[1],$b);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = m_u($b[3][$k]);
        $a3 = $b[5][$k];
        $a4 = m_u($b[7][$k]);
        $a5 = t_m(substr($b[9][$k], 0, -3));
        $a6 = $b[10][$k];
        $a7 = t_m(substr($b[12][$k], 0, -3));
        $a8 = 'http://www.cninfo.com.cn/new/disclosure/detail?plate=szse&stockCode='.$a1.'&announcementId='.$a3.'&&announcementTime='.$a5.'';
        $vd=Current(explode('?',$v));
     //$xml ='<a>'.$a7.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
     $xml ='<a href="'.$a8.'" target="b" >'.$a5.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
echo $xml;
}}}
function cggg($url) {//巨潮个股公告
       $uk= array("0","sse","szse","szse_main","szse_sme","sse_latest","regulator","pre_disclosure");
       $w=$_GET['w']?$_GET['w']:"600000";
       $u=$_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $unk =  $uk[$u];
    for($i=1;$i<=$p;$i++){
      $ul ='';
     $ul3 ='http://www.cninfo.com.cn/new/fulltextSearch/full?searchkey='.$w.'&sdate=&edate=&isfulltext=false&sortName=pubdate&sortType=desc&pageNum='.$i.'';
     $ul2 ='http://www.cninfo.com.cn/new/singleDisclosure/fulltext?stock='.$w.'&pageSize=30&pageNum='.$i.'&tabname=latest&plate=szse&limit=';
     $ul1 ='http://www.cninfo.com.cn/new/disclosure?column='.$unk.'_latest&pageNum='.$i.'&pageSize=30&sortName=&sortType=&clusterFlag=true';
if($u>0) $ul=$ul1;else $ul=$ul3;
       $ut = J_d(m_s($ul),True);
if($u>0) 
    for($i3=0;$i3<=200;$i3++){
       $aa = $ut["classifiedAnnouncements"][$i3];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["secCode"];
       $a2 = m_u($a0["secName"]);
       $a3 = $a0["announcementId"];
       $a4 = m_u($a0["announcementTitle"]);
       $a5 = t_m(substr($a0["announcementTime"], 0, -3));
       $a6 = $a0["adjunctSize"];
       $a7 = t_m(substr($a0["storageTime"], 0, -3));
       $a8 = 'http://www.cninfo.com.cn/new/disclosure/detail?plate=szse&stockCode='.$a1.'&announcementId='.$a3.'&&announcementTime='.$a5.'';
     //$xml ='<a>'.$a7.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
     $xml ='<a href="'.$a8.'" target="b" >'.$a5.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
echo $xml;
}
}else {
$aa = $ut["announcements"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {   
       $a0 = $aa[$i2];
       $a1 = $a0['secCode'];
       $a2 = m_u($a0['secName']);
       $a3 = $a0['announcementId'];
       $a4 = m_u($a0['announcementTitle']);
       $a5 = t_m(substr($a0['announcementTime'], 0, -3));
       $a6 = $a0['adjunctUrl'];
       $a7 = t_m(substr($a0['storageTime'], 0, -3));
       $a8 = 'http://www.cninfo.com.cn/new/disclosure/detail?plate=szse&stockCode='.$a1.'&announcementId='.$a3.'&&announcementTime='.$a5.'';
     $xml ='<a href="'.$a8.'" target="b" >'.$a5.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
echo $xml;
}}}}
function cggg0($url) {//巨潮个股公告
       $uk= array("0","sse","szse","szse_main","szse_sme","sse_latest","regulator","pre_disclosure");
       $w=$_GET['w']?$_GET['w']:"600000";
       $u=$_GET['u']?$_GET['u']:"0";
       $p = $_GET['p']?$_GET['p']:1;
       $unk =  $uk[$u];
    for($i=1;$i<=$p;$i++){
     $ul3 ='http://www.cninfo.com.cn/new/fulltextSearch/full?searchkey='.$w.'&sdate=&edate=&isfulltext=false&sortName=pubdate&sortType=desc&pageNum='.$i.'';
 $ul ='http://www.cninfo.com.cn/new/singleDisclosure/fulltext?stock='.$w.'&pageSize=30&pageNum='.$i.'&tabname=latest&plate=szse&limit=';
     $ul1 ='http://www.cninfo.com.cn/new/disclosure?column='.$unk.'_latest&pageNum='.$i.'&pageSize=30&sortName=&sortType=&clusterFlag=false';
if($u>0) $ul=$ul1;else $ul=$ul;
       $ut =  m_s($ul);
preg_match("#\[\[(.*)\]\]#U",$ut,$b1);
preg_match_all('|"secCode":"([^<]+)"(.*)"secName":"([^<]+)"(.*)"announcementId":"([^<]+)"(.*)"announcementTitle":"([^<]+)"(.*)"announcementTime":([^<]+),"adjunctUrl":"([^<]+)"(.*)"storageTime":|ismU',$b1[1],$b);
 foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = m_u($b[3][$k]);
        $a3 = $b[5][$k];
        $a4 = m_u($b[7][$k]);
        $a5 = t_m(substr($b[9][$k], 0, -3));
        $a6 = $b[10][$k];
        //$a7 = t_m(substr($b[12][$k], 0, -3));
        $a8 = 'http://www.cninfo.com.cn/new/disclosure/detail?plate=szse&stockCode='.$a1.'&announcementId='.$a3.'&&announcementTime='.$a5.'';
        $vd=Current(explode('?',$v));
     //$xml ='<a>'.$a7.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
     $xml ='<a href="'.$a8.'" target="b" >'.$a5.' : ('.$a1.'):'.$a4.'('.$a2.')</a>';
echo $xml;
}}}
function zqsb($url) {
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
        $p1=$p-1;
    if($p1==0) $mp='';else $mp='_'.$i;
 $url ='http://kuaixun.stcn.com/index'.$mp.'.html';
        $ul = m_v($url);
preg_match_all('#<li>(.*)<i>([^<]+)</i>(.*)<a href="([^<]+)" title="([^<]+)"(.*)>([^<]+)</a>(.*)<span>([^<]+)</span>(.*)</li>#ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[2][$k];
        $a3 = $b[4][$k];
        $a4 = $b[5][$k];
        $a5 = $b[7][$k];
        $a8 = $b[9][$k];
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$a8.'&nbsp;&nbsp;'.$a2.'&nbsp;:&nbsp;  '.$a4.'</a>';
     //$xml ='<a href="'.$a3.'" target="b" >'.$a8.' : '.$a2.' :  '.$a4.'</a>';
echo $xml;
}}}
function stcnso($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:5;
    for($i=1;$i<=$p;$i++){
 $url ='http://app.stcn.com/?app=search&controller=index&action=search&type=all&wd='.$kw.'&catid=&before=&after=&order=time&page='.$i.'';
 $url2 ='http://search.stcn.com/was5/web/search?page='.$i.'&channelid=252914&searchword='.$kw.'&keyword='.$kw.'&token=0.1584090199903.75&perpage=10&outlinepage=10&&andsen=&total=&orsen=&exclude=&searchscope=&timescope=&timescopecolumn=&orderby=-DOCPUBTIME%2CRELEVANCE';
        $ul = m_v($url);
preg_match_all('#<dt><a href="([^<]+)"(.*)>([^<]+)</a></dt>#ismU',$ul,$b);
preg_match_all('#<dd>(.*)<(.*)>([^<]+)</a>(.*)<span class="green">([^<]+)</span>#ismU',$ul,$b2);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[3][$k];
        $a4 = $b2[5][$k];
        $a5 = $b2[3][$k];
        $ud = $a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.' :&nbsp;&nbsp;&nbsp;'.$a3.' ('.$a5.')</a>';
echo $xml;
}}}
function stcncw($url) {
       $wk= array( "guGaiLiftTheBan","partnerOutperform","partnerReduceDataSearch","borrowing","securityInvestment","parOtherListedCompany","partNotListedFinanOrgan","organStakeTotal","fasctHigh","fasctLow","investProject","assetsSellAndAssignment","assetsRestructuring","planRefinanceDataSearch");
       $w = $_GET['w']?$_GET['w']:0; 
       $wnk=$wk[$w];
       $year = date("Y");
       $mouth = date("m");
       $day = date("D");
       $t=$_GET['t']?$_GET['t']:$mouth;
       $sday = $year.'-01-01';
       $enday = $year.'-'.$t.'-'.$day;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='http://info.stcn.com/companydata/'.$wnk.'.jsp?currentPage=1&startTime='.$sday.'&endTime='.$enday.'&issort=InfoPublDate&ASCFlag=1';
        $ul = m_v($url);
preg_match_all('#<dt><a href="([^<]+)"(.*)>([^<]+)</a></dt>#ismU',$ul,$b);
preg_match_all('#<dd>(.*)<(.*)>([^<]+)</a>(.*)<span class="green">([^<]+)</span>#ismU',$ul,$b2);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[3][$k];
        $a4 = $b2[5][$k];
        $a5 = $b2[3][$k];
        $ud = $a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.' :&nbsp;&nbsp;&nbsp;'.$a3.' ('.$a5.')</a>';
echo $xml;
}}}
function xppt($url) {//信披平台
       $wk= array( "16","18","19","20","22","23","24","25","26","27","28","29","30","31","32","33","34","36","37","38");
       $uk2= array( "0","010112","010113","010114","010115","16");
       $uk1= array("0","0102","0105","0107","0111","011301","011103","0115","0117","0119","0121","0123","0125","0127","0129","0131","010301","010305","010307");
       $w=$_GET['w']?$_GET['w']:'0';
       $wnk=$wk[$w];
       $year = date("Y");
       $mouth = date("m");
       $t=$_GET['t']?$_GET['t']:$mouth;
       $dday = ''.$year.'-'.$t.'-';
       $u=$_GET['u']?$_GET['u']:'0';
       $ww=substr($w,0,2);if($ww=='60'|| $ww=='68') $w2='sh'.$w;else $w2='sz'.$w;
       $unk1=$uk1[$u];
       $unk2=$uk2[$u];
   if ($w <= '15') $wnk=$wnk;else $wnk=$w2;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url1 ='http://xinpi.stcn.com/'.$wnk.'bulletin/bulletinlist_1_'.$i.'.shtml';
 $url2 ='http://xinpi.stcn.com/search2018.jsp?op=xxjs&tj2='.$unk2.'&d1='.$dday.'01&d2='.$dday.'30&pageNo='.$i.'';
 $url3 ='http://xinpi.stcn.com/search2018.jsp?op=xxjs&tj1='.$unk1.'&tj2=&kw1=&kw3=&d1='.$dday.'01&d2='.$dday.'30&page='.$i.'';
 $url4 ='http://xinpi.stcn.com/include/list/'.$wnk.'/'.$i.'.html';
   if ($w == '5') $url5=$url4;else if ($w == '0')  $url5=$url3;else  $url5=$url3;
        $ul = m_v($url4);
preg_match_all('|<li>(.*)<a href="([^<]+)"(.*)>([^<]+)</a>(.*)<span>([^<]+)<|ismU',$ul,$b);
        foreach($b[1] as $k=>$v){
        $a2 = 'http://xinpi.stcn.com'.$b[2][$k];
        $a3 = $b[4][$k];
        $a4 = $b[6][$k];
        $a5 = 'http://xinpi.stcn.com'.$a2;
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$a3.'('.$a4.')</a>';
     $xml2 ='<a href="'.$a2.'" target="b" >'.$a3.'('.$a4.')</a>';
echo $xml2;
}}}
function wcai($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $w=k_w($w);
       $w1=m_u("总市值从小到大排列");
       $w2=m_u("业绩预增大于'.$w.'%；");
       $w3=$w2.$w1;
       $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;$i++){
 $url ='http://www.iwencai.com/stockpick/search?typed=0&preParams=&ts=1&f=1&qs=ths_data_cwfx&selfsectsn=&querytype=&searchfilter=&tid=stockpick&w='.$w3.'';
        $ul = m_v($url);
preg_match_all('#<dt><a href="([^<]+)"(.*)>([^<]+)</a></dt>#ismU',$ul,$b);
preg_match_all('#<dd>(.*)<(.*)>([^<]+)</a>(.*)<span class="green">([^<]+)</span>#ismU',$ul,$b2);
foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = $b[3][$k];
        $a4 = $b2[5][$k];
        $a5 = $b2[3][$k];
        $ud = $a2;
        $vd=Current(explode('?',$v));
     $xml ='<a href="'.$ud.'" target="b" >'.$a4.' :&nbsp;&nbsp;&nbsp;'.$a3.' ('.$a5.')</a>';
echo $xml;
}}}

function bdso($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
        $p=15;
       for ($i = 1; $i <=5; $i++) {
	$ul = 'http://news.baidu.com/ns?word='.$kw.'&pn='.$i*$p.'&cl=2&ct=1&tn=news&rn=20&ie=utf-8&bt=0&et=0';
        $ut = m_v($ul);
preg_match_all('|<h3 class="c-title">(.*)</h3>|imsU',$ut,$c);
foreach ($c[1] as $ks=>$vs){
preg_match_all('|<a href="([^<]+)"([^<]+)>([^<]+)<em>([^<]+)</em>([^<]+)</a>|ims',$vs,$d);
foreach ($d[1] as $k=>$v){
       $a2 = explode(' data-click=', $v);
       $a3 = $a2[0];
        $a4=m_g($d[3][$k]);
        $a5=m_g($d[4][$k]);
        $a6=m_g($d[5][$k]);
        $v=Current(explode('?',$v));
	$xml ='<a href="'.$a3.'" target="_blank" >'.$a4.''.$a5.''.$a6.'</a>';
echo $xml;
}
}}}
function bdson($url) {
        $w=$_GET['w']?$_GET['w']:date("Y"); 
        $kw=k_w($w);
        $mw=m_u($w);
        $p=$_GET['p']?$_GET['p']:"2"; 
       for ($ii = 1; $ii <=$p; $ii++) {
	//$ul2 = 'http://www.baidu.com/s?ct=0&tn=json&ajax=json&rn=50&bs='.$mw.'&wd='.$mw.'&rsv_bp=1&sr=0&cl=2&f=8&clk=sortbytime&pn='.$ii.'';
	$ul2 = 'https://www.baidu.com/s?wd='.$mw.'&bs='.$mw.'&pn='.$ii.'&rn=50&tn=json&ct=2&f4s=1&isbd=1&stftype=1&pn=10&tfflag=1&medium=0&bsst=1&rsv_dl=news_t_sk';
	$ul3 = 'https://news.baidu.com/?m=rddata&v=hot_word&type=0&ajax=json&query_word='.$mw.'';
        $ut = J_d(m_v($ul2),true);
        $aa = $ut["feed"]["entry"];
 for ($i2 = 0; $i2 < count($aa); $i2++) {
        $a0 = $aa[$i2];
        //$a1 = x_g($a0["url"]);  
        $a2 = r_u($a0["abs"]); 
        $a3 = t_m($a0["time"]);
	//$xml =$ut;
	$xml ='<a>'.$a3.'&nbsp;&nbsp;&nbsp;'.$a2.'&nbsp;</a>';
echo $xml;
}}}
function bdson1($url) {
        $w=$_GET['w']?$_GET['w']:date("Y"); 
        $kw=k_w($w);
        $mw=m_u($w);
        $p=$_GET['p']?$_GET['p']:"2"; 
       for ($i = 1; $i <=$p; $i++) {
	$ul1 = 'http://www.baidu.com/s?ct=0&tn=json&ajax=json&rn=50&bs='.$mw.'&wd='.$mw.'&rsv_bp=1&sr=0&cl=2&f=8&clk=sortbytime&pn='.$i.'';
	$ul2 = 'https://www.baidu.com/s?wd='.$mw.'&bs='.$mw.'&pn='.$i.'&rn=50&tn=json&ct=2&mod=1&isbd=1&stftype=1&medium=0&bsst=1&rsv_dl=news_t_sk';
	$ul3 = 'https://news.baidu.com/?m=rddata&v=hot_word&type=0&ajax=json&query_word='.$mw.'';
        $ut = m_v($ul1);
preg_match_all('|"title": "([^<]+)"(.*)"url": "([^<]+)"(.*)"abs": "([^<]+)"(.*)"time": ([^<]+),|imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=r_u($d[1][$k]);
        $a5=x_g($d[3][$k]);
        $a6=r_u($d[5][$k]);
        $a7=t_m($d[7][$k]);
        $v=Current(explode('?',$v));
	$xml ='<a>'.$a7.'&nbsp;&nbsp;'.$a6.'</a>';
	//$xml ='<a href="'.$a5.'" target="_blank" >'.$a4.'&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
echo $xml;
}}
}
function bdson0($url) {
        $w=$_GET['w']?$_GET['w']:date("Y"); 
        $kw=k_w($w);
        $mw=m_u($w);
        $p=$_GET['p']?$_GET['p']:"2"; 
       for ($i = 1; $i <=$p; $i++) {
	//$ul2 = 'http://www.baidu.com/s?ct=0&tn=json&ajax=json&rn=50&bs='.$mw.'&wd='.$mw.'&rsv_bp=1&sr=0&cl=2&f=8&clk=sortbytime&pn='.$i.'';
	$ul2 = 'https://www.baidu.com/s?wd='.$mw.'&bs='.$mw.'&pn='.$i.'&rn=50&tn=json&ct=2&tfflag=1&medium=0&bsst=1&rsv_dl=news_t_sk';
	$ul3 = 'https://news.baidu.com/?m=rddata&v=hot_word&type=0&ajax=json&query_word='.$mw.'';
        $ut = m_v($ul3);
preg_match_all('|"TS":"([^<]+)"(.*)"m_url":"([^<]+)"(.*)"m_title":"([^<]+)"|imsU',$ut,$d);
foreach ($d[1] as $k=>$v){
        $a4=$d[1][$k];
        $a5=x_g($d[3][$k]);
        $a6=r_u($d[5][$k]);
        $v=Current(explode('?',$v));
	$xml ='<a>'.$a4.'&nbsp;&nbsp;'.$a6.'</a>';
	//$xml ='<a href="'.$a5.'" target="_blank" >'.$a4.'&nbsp;&nbsp;(&nbsp;'.$a6.'&nbsp;)</a>';
echo $xml;
}}
}
function bdbj($url) {
       $w = $_GET['w']?$_GET['w']:3; 
       $t = $_GET['t']?$_GET['t']:1;
       $p = $_GET['p']?$_GET['p']:50;
	$ul = 'http://baijia.baidu.com/ajax/labellatestarticle?page=1&pagesize='.$p.'&prevarticalid=390314&flagtogether='.$t.'&labelid='.$w.'';
        $ut = m_v($ul);
preg_match_all('|"m_display_url":"([^<]+)","m_writer_name":"([^<]+)",|imsU',$ut,$d);
preg_match_all('|"m_create_time":"([^<]+)","m_title":"([^<]+)","m_summary":"([^<]+)",|imsU',$ut,$d2);
foreach ($d[1] as $k=>$v){
        $a2 =x_g($d[1][$k]);
        $a3 =r_u($d[2][$k]);
        $a4 =r_u($d2[1][$k]);
        $a5 =r_u($d2[2][$k]);
        $a6 =r_u($d2[3][$k]);
        $v=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="_blank" >'.$a5.' ('.$a3.') '.$a4.' '.$a6.'</a>';
echo $xml;
}}

function bdnews($url) {
       $wk= array( "guonei","guoji","mil","finance","ent","sports","internet","tech","sh");
       $w=$_GET['w'];
       $wnk=$wk[$w];
   if ($w < '15')  $wnk=$wnk;else  $wnk=$w;
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 1; $i <=$p; $i++) {
	$ul2 = 'http://news.baidu.com/n?cmd=4&class='.$wnk.'&pn='.$i.'&from=tab';
	$ul = 'http://news.baidu.com/'.$wnk.'';
        $b = m_v($ul);
preg_match_all('|<li(.*)>(.*)<a href="([^<]+)"(.*)mon="(.*)"(.*)>([^<]+)</a>|imsU',$b,$d);
foreach ($d[1] as $k=>$v){
        $a2=m_u($d[3][$k]);
        $a3=m_u($d[7][$k]);
        $v=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="_blank" >'.$a3.'</a>'.PHP_EOL;
echo $xml;
}}}

function guanc($url) {//风闻社区
       $wk= array("","110","133","140","143");
       $w = $_GET['w']?$_GET['w']:1;
       $p = $_GET['p']?$_GET['p']:2;
       $wnk=$wk[$w];
   for ($i = 1; $i <=$p; $i++) {
       $ul2 = 'http://newrss.guancha.cn/'.$wnk.'/';
       $ul = 'https://user.guancha.cn/main/index-list.json?page='.$i.'&topic_id='.$wnk.'&order=2';
       $ul3 = 'https://user.guancha.cn/topic/post-list?page=1&topic_id=110&order=2';
       $ut = m_v($ul);
preg_match_all("#<h4><a href=\"([^<]+)\"(.*)>([^<]+)<\/a><\/h4>(.*)<span class=\"time\">([^<]+)<\/span>#ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
	$a2='https://user.guancha.cn'.$d[1][$k];
	$a3=m_u($d[3][$k]);
	$a4=$d[5][$k];
	$a6=m_u($d[8][$k]);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a2.'" target="b" >'.$a3.'  ('.$a4.')</a>';
echo $xml;
}}}
function yjcf2($url) {//赢家财富
       $year = date("Y");
       $w = $_GET['w']?$_GET['w']:$year;
 if($w==$year-1) $w=$year-1;else $w=$year;
       $mouth = date("m");
       $u = $_GET['u']?$_GET['u']:$mouth;
       $day = date("d");
       $t = $_GET['t']?$_GET['t']:$day;
       $tn= u_e('00:00:01');
       $tm= $year.'-'.date("m").'-'.$t;
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 0; $i <=$p; $i++) {
       $ul1 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+00%3A00%3A01';
       $ul2 = 'http://www.yjcf360.com/api/get-telegraph-pege.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+'.$tn;
       $ul3 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian=2019-06-13+00%3A00%3A01';
       $ul4 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+'.$tn;
       $ut = m_v($ul4);
       $ut2 = x_g($ut);
       $nt = J_d($ut,ture);
       $aa = $nt["jsonlist"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = m_u($a0["text"]);
       $a3 = m_u($a0["title"]);
       $a4 = $a0["addTime"];
	$xml ='<a>'.$a4.':  '.$a2.'</a>';
	//$xml2 ='<a href="'.$a3.'" target="b" >'.$a6.':  '.$a3.'</a>';
echo $xml;
}}
}
function yjcf($url) {//赢家财富
       $year = date("Y");
       $w = $_GET['w']?$_GET['w']:$year;
 if($w==$year-1) $w=$year-1;else $w=$year;
       $mouth = date("m");
       $u = $_GET['u']?$_GET['u']:$mouth;
       $day = date("d");
       $t = $_GET['t']?$_GET['t']:$day;
       $tn= u_e('00:00:01');
       $tm= $year.'-'.date("m").'-'.$t;
       $p = $_GET['p']?$_GET['p']:2;
       for ($i = 0; $i <=$p; $i++) {
       $ul1 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+00%3A00%3A01';
       $ul2 = 'http://www.yjcf360.com/api/get-telegraph-pege.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+'.$tn;
       $ul3 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian=2019-06-13+00%3A00%3A01';
       $ul4 = 'http://www.yjcf360.com/api/get-telegraph-zhibolist.json?&pageno='.$i.'&size=20&zuijinshijian='.$tm.'+'.$tn;
       $ut = m_s($ul4);
       $ut2 = x_g($ut);
preg_match_all('#"text":"([^<]+)"(.*)"title":"([^<]+)","views"(.*)"addTime":"([^<]+)"#ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
	$a3=m_u(r_u($d[1][$k]));
	//$a4=$d[3][$k];
	$a5=m_u($d[3][$k]);
	$a6=m_u($d[5][$k]);
        $vd=Current(explode('?',$v));
	$xml ='<a>'.$a6.':  '.$a3.'</a>';
	//$xml2 ='<a href="'.$a3.'" target="b" >'.$a6.':  '.$a3.'</a>';
echo $xml;
}}
}
function xqzx($url) {
       $wk= array( "CN","CN","HOT");
       $w= $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){}
       $p1=$i*10;
 $ul2 ='https://xueqiu.com/v4/statuses/public_timeline_by_category.json?since_id=-1&max_id=-1&count=10&category=6';
 $ul ='https://xueqiu.com/v4/statuses/public_timeline_by_category.json?since_id=-1&max_id=-1&count=10&category=1';
       $ut = m_s($ul);
       /*$nt = J_d($ut,ture);
       $aa = $nt["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = m_u($a0["data"]["text"]);
       $a3 = t_m($a0["data"]["created_at"]);
	$xml ='<a>'.$a3.':  '.$a2.'</a>';*/
echo $ut;
}
function nbjy($url) {
       $wk= array( "CN","CN","HOT");
       $w= $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
 $url ='https://xueqiu.com/service/v5/stock/f10/cn/skholderchg?size=10&page='.$i.'&extend=true';
        $ul = m_v($url);
preg_match_all('#"symbol":"([^<]+)","name":"([^<]+)","share_changer_name":"([^<]+)","manage_name":"([^<]+)","chg_date":([^<]+),"chg_shares_num":([^<]+),"trans_avg_price":([^<]+),"daily_shares_balance_otd":([^<]+),"rr_of_chgr_and_manage":"([^<]+)","duty":"([^<]+)"#ismU',$ul,$b);
foreach($b[1] as $k=>$v){
        $a1 = $b[1][$k];
        $a2 = $b[2][$k];
        $a3 = $b[3][$k];
        $a4 = $b[4][$k];
        $a5 =  t_m($b[5][$k]/1000);
        $a6 = $b[6][$k];
if($a6<=0) $a6='<font color=#00cc00>'.$a6.'</font>';else $a6=$a6;
        $a7 = $b[7][$k];
        $a8 = $b[8][$k];
        $a9 = $b[9][$k];
        $a10 = $b[10][$k];
        $c1=m_u('变动人：');
        $c2=m_u('<font color=#00cc00>变动股数：</font>');
        $c3=m_u('变动股数：');
if($a6<=0) $c3=$c2;else $c3=$c3;
        $c4=m_u('成交均价：');
        $c5=m_u('现持股数：');
        $c6=m_u('与董监关系：');
        $c7=m_u('职务：');
        $vd=Current(explode('?',$v));
     $xml ='<a>'.$a2.' (&nbsp;'.$a1.'&nbsp;):  '.$a5.' &nbsp;&nbsp;&nbsp;&nbsp; '.$c1.''.$a3.'  &nbsp;&nbsp;&nbsp;&nbsp; '.$c3.''.$a6.'  &nbsp;&nbsp;&nbsp;&nbsp; '.$c4.''.$a7.'  &nbsp;&nbsp;&nbsp;&nbsp; '.$c5.''.$a8.' &nbsp;&nbsp;&nbsp;&nbsp;'.$c6.''.$a9.'  &nbsp;&nbsp;&nbsp;&nbsp;'.$c7.''.$a10.'</a>';
echo $xml;
}}}
function cls($url) {
       $wk= array( "","announcement","explain","red","jpush","remin","watch");
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
    for($i=0;$i<=$p;$i++){
        $t0 = date('Y-m-d',time());
        $t1 = date('Y-m-d H:i:s',time());
        $p0 = strtotime($t0);
        $p1 = strtotime($t1) -$i*3600;
        $p2 = time() -$i*3600;
  if($w==0) {
	$ul ='https://www.cls.cn/nodeapi/telegraphList?app=CailianpressWeb&category='.$wnk.'&lastTime='.$p1.'&os=web&refresh_type=1&rn=20&sv=7.2.2&sign=8acaf51e9f8db6dde6d8e7c3b1e76b4a';
} else {
	$ul2 ='https://www.cls.cn/v1/roll/get_roll_list?app=CailianpressWeb&category=announcement&last_time=1604667928&os=web&refresh_type=1&rn=20&sv=7.2.2&sign=1d3fac236af08da9b37aef8f53c7f9d8';
	$ul ='https://www.cls.cn/v1/roll/get_roll_list?app=CailianpressWeb&category=announcement&last_time='.$p1.'&os=web&refresh_type=1&rn=20&sv=7.2.2&sign=1d3fac236af08da9b37aef8f53c7f9d8';
}
       $nt = J_d(m_v($ul),ture);
       $aa = $nt["data"]["roll_data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       //$a1 = $a0["id"];
       $a3 = m_u($a0["brief"]);
       $a4 = t_m($a0["ctime"]);
       $a41 = t_m($a0["ctime"]-28800);
       //$a2 = m_u($a0["title"]);
       $xml ='<a>'.$a41.':  '.$a3.'</a>';
echo $xml;
}}}
function zhgw($url) {
set_time_limit(0);
       //$t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://news.bajsx.com/news/?pages='.$i.'';
       $nt = J_d(m_v($ul2),ture);
       $aa = $nt["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["url"];
       $a2 = m_u($a0["title"]);
       $a3 = m_u($a0["content"]);
       $a4 = t_m($a0["timestamp"]);
       $a5 = $a0["date"];
       $xml ='<a>'.$a4.':  '.$a3.'</a>';
       $xml2 ='<a href="'.$a1.'" target="_blank" >'.$a3.':  '.$a2.'</a>';
echo $xml;
}}}
function wen($url) {
       $ww=$_GET['w']?$_GET['w']:"";
       $w=k_w($ww);
       $p = $_GET['p']?$_GET['p']:"1";
    for($i=0;$i<=$p;$i++){
	$ul ='https://doc.xuehai.net/search/'.$w.'-'.$i.'0.html';
        $ut = m_s($ul, $data, $header, 5);
preg_match_all("|<li><i class=\"([^<]+)\"(.*)title=\"([^<]+)\"><\/i>(.*)<a href=\"\/([^<]+).html\" title=\"([^<]+)\"(.*)>([^<]+)<\/a><p>(.*)<\/p><\/li>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2='https://doc.xuehai.net/word/'.$d[5][$k].'-1.doc';
       $a4='https://doc.xuehai.net/'.$d[5][$k].'.html';
       $a3=m_u($d[6][$k]);
       $a5=m_u($d[9][$k]);
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a4.'" target="_blank" >'.$a3.'('.$a5.')</a>';
echo $xml;
}}
}
function dyhjw($url) {//第一黄金快讯
	$ul ='http://www.dyhjw.com/kuaixun/';
        $ut = m_v($ul);
preg_match_all('|<p class="kx_title">(.*)</p>|ismU',$ut,$d);
preg_match_all('|<td class="time" align="left"(.*)>([^<]+)<|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=$d[6][$k];
       $a4=$d2[2][$k];
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$a4.':&nbsp;'.$a2.'</a>';
echo $xml;
}}
function nbd($url) {
       $wk= array("2","431","340","3","1");
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:3;
       $wnk=$wk[$w];
    for($i=0;$i<=$p;$i++){
	$ul ='http://m.nbd.com.cn/columns/'.$wnk.'/page/'.$i.'';
        $ut = f_g($ul);
preg_match_all('|<li>(.*)<a href="http://m.nbd.com.cn/articles/([^<]+)/(.*)">(.*)<h4>([^<]+)</h4>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a3=m_u($d[5][$k]);
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$a3.'&nbsp;&nbsp;:'.$a4.'&nbsp;&nbsp;</a>';
echo $xml;
}}}
function hnew($url) {
       $wk= array("36","64","49","88","1");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $w=$_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:3;
    for($i=0;$i<=$p;$i++){
	$ul ='http://www.hinew8.com/e/extend/list/index1.php?classid='.$wnk.'&orderby=newstime&page='.$i.'';
        $ut = f_g($ul);
preg_match_all('|<div class="texts">(.*)<a(.*)href="([^<]+)"(.*)data-node="title">([^<]+)</a>(.*)<div class="times">([^<]+)</div>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=m_u($d[5][$k]);
       $a4=$d[7][$k];
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$a4.'&nbsp;&nbsp;:'.$a3.'&nbsp;&nbsp;</a>';
echo $xml;
}}}

function upchina($url) {//优品财经
       $wk= array( "9000000000000","9000000000000","9000000000000","1522807378186","1522714327698","1522809410438","1522825375767");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:2;
for($i=1;$i<=$p;$i++){
        $p1 = $i*60;
	$ul2 ='https://bigdata.upchina.com/lhb/page/1524525937000/2/1522738800000';
	$ul3 ='https://www.upchina.com/media/newsflash/'.$wnk.'/'.$p1.'/0';
        $ut = J_d(m_v($ul3),true);
       $aa = $ut["list"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = $a0["sPubTime"];
       $a3 = r_u($a0["sFlashSum"]);
       $ud=''.$a2.':&nbsp;&nbsp;&nbsp;&nbsp;'.$a3.'';
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function zifu($url) {//知乎
       $ww=$_GET['w']?$_GET['w']:"2020";
       $kw=k_w($ww);
       $p = $_GET['p']?$_GET['p']:1;
for($i=0;$i<=$p;$i++){
       $p1= ($i-1)*20;
       $p2= $i*20;
       $ul ='https://api.zhihu.com/search_v3?advert_count=0&correction=1&lc_idx=1&limit=20&offset=20&search_hash_id=457b638036cd41a694162286c4a2b6d0&show_all_topics=0&t=general&vertical_info=0&q='.$kw.'';
       $ut = m_s($ul);
       //$ut = J_d(m_v($ul),ture);
       /*$aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = $a0["object"]["id"];
       $a3 = $a0["object"]["title"];
       $a4 = $a0["object"]["url"];
       $a5 = $a0["object"]["comment_count"];
       $ud='https://zhuanlan.zhihu.com/p/'.$a2;
       $xml ='<a href="'.$ud.'" target="_blank" >'.$a3.'('.$a5.')</a>';*/
echo $ut;
}}
function zifu0($url) {//知乎
       $w=$_GET['w']?$_GET['w']:"2020";
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1;
for($i=1;$i<=$p;$i++){
       $p1= ($i-1)*20;
       $p2= $i*20;
       $ul ='https://api.zhihu.com/search_v3?advert_count=0&correction=1&lc_idx=1&limit=20&offset=20&search_hash_id=457b638036cd41a694162286c4a2b6d0&show_all_topics=0&t=general&vertical_info=0&q='.$kw.'';
       $ut = m_v($ul);
/*preg_match_all('|"id":"([^<]+)"(.*)"title":"([^<]+)"(.*)"url":"([^<]+)"(.*)"comment_count":([^<]+),|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=$d[3][$k];
       $a4=$d[5][$k];
       $a5=$d[7][$k];
       $ud='https://zhuanlan.zhihu.com/p/'.$a2;
       $xml ='<a href="'.$ud.'" target="_blank" >'.$a2.'('.$a5.')</a>';*/
echo $ut;
}}
function wcx($url) {//微财讯
       $wk= array( "22405539","213895","213895");
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
    for($i=1;$i<=$p;$i++){
       $tm = time()-$i*3600;
	$ul ='http://www.weicaixun.com/live/?ajax=1&min_id='.$tm;
        $ut = J_d(f_g($ul),true);
        $aa = $ut["data"][0];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = r_u($a0["source"]);
       $a3 = r_u($a0["content"]);
       $a4 = $a0["ctime"];
       $ud=''.$a4.'&nbsp;&nbsp;'.$a3.'';
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function wcx0($url) {//微财讯
       $wk= array( "22405539","213895","213895");
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
    for($i=1;$i<=$p;$i++){
       $tm = time()-$i*3600;
	$ul ='http://www.weicaixun.com/live/?ajax=1&min_id='.$tm;
        $ut = f_g($ul);
preg_match_all('|"source":"([^<]+)"(.*)"content":"([^<]+)"(.*)"ctime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=r_u($d[1][$k]);
       $a3=r_u($d[3][$k]);
       $a4=$d[5][$k];
       $ud=''.$a4.'&nbsp;&nbsp;'.$a3.'';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function julin($url) {//巨灵
       $wk = array( "PSTK_COM_EVENT_HINT","V_BS_RH_REPORT","INVEST_CALENDAR","NEWS_BREAKFAST","STK_CHART_SEAT_TRD_INFO_HP","STK_CHART_OPE_STAT_HP","STK_CSRC_INDU_CLS","THEME_TRIG_EVENT","STK_IPO_LIM_UP_TERM_DTL_3M","THEME_CHNG_PCT_MON_LAT","PSTK_COM_EVENT_HINT","V_BS_RH_REPORT","INVEST_CALENDAR","NEWS_BREAKFAST","STK_CHART_SEAT_TRD_INFO_HP","STK_CHART_OPE_STAT_HP","STK_CSRC_INDU_CLS","THEME_TRIG_EVENT","STK_IPO_LIM_UP_TERM_DTL_3M","THEME_CHNG_PCT_MON_LAT","STK_INVEST_HOT","STK_DIAGA_CAP_NET_IN","STK_SNAME","V_JRJ_FUND_SAMEMANA","V_JRJ_FUND_HTSEC_RATE","STK_IPO_PAY_REMIND","STK_IPO_CALENDAR","INDX_MKT_COMM","STK_CHART_STK_SEARCH","RES_DISC_INFO","V_JRJ_INDX_EXPR_IDX","STK_FILTER_CLS_1_2","STK_FILTER_CLS_2","SEC_DISC_INFO","SEC_NEWS_INFO","FND_AUTOMATIC_INVST_YLD","STK_DISK_UNSCRAMBLE","V_JRJ_APOLLO_COMSHHDTL","IMPORTANT_HINT","SEC_LIST","SEC_ISS","SEC_SPEC_HINT","STK_SEC_TRADE_INFO","STK_POL_BUY_ANA_INFO","STK_POL_BUY_ORG_INFO","STK_POL_BUY_RISE_SPACE","STK_POL_BUY_RATNG_ANA","STK_IPO_LIM_UP_TERM_DTL_6M","INTE_ECO_IDEX_REVIEW","INTE_ECO_EVENT_REVIEW","MAC_ECO_FCST_REVIEW","V_JRJ_COMPANYMANAGER","STK_IPO_LIST_SEC_CLS","STK_IPO_CON_FRE_DIST","STK_POL_BUY_RATNG","STK_POL_BUY_RTNG_ORG","STK_POL_BUY_MAX_RISE","STK_DIAGA_DAY_MKT","STK_DIAGA_STKCODE","STK_DIAGA_ORG_SEC_TRADE","STK_DIAGA_RATNG","V_JRJ_FUND_CHAG_RATE","STK_DIAGA_DAY_TRD_STAT","STK_DIAGA_NEW_EXPR","STK_DIAGA_INDX_INTER_DMK","STK_DIAGA_SWINDU_INDX_DMK","STK_DIAGA_INTER_COST_AVG","V_JRJ_FUND_FND_RELA_ORG","ITG_STK_TAG","V_FD_FDPFM","CFP_PRD_RPT","V_JRJ_FUND_NET_RATING","CFP_MANAGER_INFO","V_JRJ_FUND_AVG_DISCOUNT","V_JRJ_FUND_FND_GEN_INFO","CFP_NETVAL_YLD","CFP_CHAN_RATE","CFP_GEN_INFO","V_JRJ_FUND_MSTAR_PERFM","V_JRJ_FUND_MSTAR_RATE","V_JRJ_FUND_FND_MNG_HOLDER","V_JRJ_FUND_ISS_INFO","V_JRJ_FUND_PROFIT","V_JRJ_FUND_ORG_PROFILE_TG","V_JRJ_STK_IPOPFM","V_JRJ_FUND_FND_SPLIT_TRANSL","V_JRJ_FUND_FND_DIV","V_JRJ_FUND_FND_CHAG_RATE","V_JRJ_FUND_UNIT_CHNG","V_JRJ_FUND_BND_CONF","V_JRJ_FUND_BALANCE","V_JRJ_FUND_FND_ORGR_HLD","V_JRJ_FUND_ASSET_CONF","V_JRJ_FUND_FIN_IDX","file","FND_ANN_LIST","STK_IPO_LIM_UP_LED_LW_10D","V_JRJ_FUND_INDU_SUM_CONF","V_JRJ_FUND_KEYSTK_DTL","V_JRJ_STOCK_ALL_FIN_LTT","V_JRJ_STK_RATING_STAT","V_JRJ_STK_FIN_IDX_TMPE3","V_JRJ_STK_FIN_IDX_TMPE2","V_JRJ_RELA_NBALA","V_JRJ_INCOME_PRODUCT","V_JRJ_INCOME_INDUSTRY","V_JRJ_INCOME_DISTRICT","V_JRJ_FUND_NET_LASTDAY","V_JRJ_FUND_MNG_ACHIVE","V_JRJ_FUND_MANA_FIN_IDX");

       $w = $_GET['w']?$_GET['w']:'0';
       $t = $_GET['t']?$_GET['t']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $wnk=$wk[$w];
     if($w<='300') $wnk=$wnk;else $wnk=$w;
       $ul ='http://glink.genius.com.cn/base/'.$wnk.'/limit=0&full=2';
       $ut = f_g($ul);
//preg_match_all('|"STOCKCODE":"([^<]+)"(.*)"EVENT_TYPE":"([^<]+)"(.*)"DECLAREDATE":"([^<]+)"(.*)"EVENT":"([^<]+)"|ismU',$ut,$d);
preg_match_all('|"STOCKCODE":"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|"EVENT_TYPE":"([^<]+)"|ismU',$ut,$d2);
preg_match_all('|"DECLAREDATE":"([^<]+)"|ismU',$ut,$d3);
preg_match_all('|"EVENT":"([^<]+)"|ismU',$ut,$d4);
foreach ($d1[1] as $k=>$v){
       $a1=$d1[1][$k];
       $a2=r_u($d2[1][$k]);
       $a3=$d3[1][$k];
       $a4=r_u($d4[1][$k]);
       $ud=''.$a1.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp; ('.$a2.')&nbsp;&nbsp;&nbsp;&nbsp;   '.$a3.'';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}

function ju_lin($url) {//巨灵接口
       $p = $_GET['p']?$_GET['p']:10;
    for($i=0;$i<=$p;$i++){
       $ul ='http://glink.genius.com.cn/dict/?type=1&page='.$i;
       $ut = f_g($ul);
preg_match_all('|<div class="i_listItem">(.*)<h3><a(.*)>(.*)<|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=r_u($d[3][$k]);
preg_match_all("/\b[A-Za-z_-].+?\b/", $a2, $x);
       $tk=json_encode($x);
preg_match("|\[([^>]+)\]|U",$tk,$d2);
       $tk=$d2[1];
       $tk=str_replace('[',',',$tk);
       //$tk=str_replace(',"','',$tk);
       //$tk=str_replace('"',',', $tk);
       //$tk=str_replace(',"','",', $tk);
       //$tk= print($tk); 
       //$tk=str_replace('1','', $tk);
       //$tk = explode('1',$tk); 
       //$tk=json_encode($tk);
       //$tk=json_decode($tk);
       //$tk=ltrim($tk,',');//去掉前面
       //$tk = substr($tk,0,-1) ;//去掉最后
       //$tk=rtrim($tk,',');//去掉最后
//echo  $tk;
return  $tk;
}}}
function get_betw($s) {
preg_match_all("/\b[A-Za-z_-].+?\b/", $s, $x);
       $tk=json_encode($x);
preg_match("|\[([^>]+)\]|U",$tk,$d2);
       $tk=$d2[1];
       $tk=str_replace('[', ',', $tk);
return $tk;
}
function daili($url) {//代理
       $wk= array( "nn","nt","wn","wt","qq");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:2; 
       $wnk = $wk[$w]; 
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
	$ul ='https://www.xicidaili.com/'.$wnk.'/'.$i.'';
        $ut = m_v($ul);
preg_match_all('|<tr class="([^<]+)">(.*)<td class="country">(.*)</td>(.*)<td>([^<]+)</td>(.*)<td>([^<]+)</td>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[5][$k];
       $a3=$d[7][$k];
       $ud= $a2.':'.$a3;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function caixin($url) {//财新网滚动
       $wk= array( "0","129","125","130","131","132","126","164");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:2; 
       $wnk = $wk[$w]; 
    for($i=0;$i<=$p;$i++){
	$ul ='http://www.caixin.com/search/scroll/'.$wnk.'.jsp?date=&page='.$i.'';
	$ul2 ='http://www.caixin.com/search/scroll/129.jsp?date=&page='.$i.'';
        $ut = m_v($ul);
preg_match_all('|<dl>(.*)<dd>(.*)<a href="([^<]+)">([^<]+)</a>(.*)<a(.*)</a>(.*)<span>([^<]+)</span>(.*)<p>([^<]+)</p>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=$d[4][$k];
       $a4=$d[8][$k];
       $a5=$d[10][$k];
       $ud=''.$a4.'&nbsp;&nbsp;'.$a5.'&nbsp;';
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$ud.'</a>';
       $xml2 ='<a href="'.$a2.'">'.$ud.'</a>';
echo $xml;
}}}
function qqdt($url) {//动态
       $w=$_GET['w'];
   if ($w == '')  $w='1021460518';else  $w=$w;//
       //$f=$_GET['f'];
   //if ($f == '')  $f='180270388';else  $f=$f;//
	$ul ='http://ic2.s11.qzone.qq.com/cgi-bin/feeds/feeds_html_module?i_uin='.$w.'&i_login_uin=1&mode=4&previewV8=1&style=1&version=8&needDelOpr=true&transparence=true&hideExtend=false&showcount=5&MORE_FEEDS_CGI=http%3A%2F%2Fic2.s11.qzone.qq.com%2Fcgi-bin%2Ffeeds%2Ffeeds_html_act_all&refer=2&paramstring=os-winxp|100';
        $ut = m_v($ul);
preg_match_all('|<span  class=" ui-(.*)state" >([^<]+)</span>|ismU',$ut,$d);
preg_match_all('|class="f-info">([^<]+)<(.*)>(.*)<|ismU',$ut,$d2);
preg_match_all('|data-clicklog="pic" data-originurl="([^<]+)"|ismU',$ut,$d3);
preg_match_all('|<a class="c_tx q_namecard"  link="(.*)"(.*)>(.*)</a>([^<]+)<|ismU',$ut,$d4);
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a3=$d2[1][$k];
       $a4=$d2[3][$k];
       $a5=$d4[4][$k];
       $a6=$d3[1][$k];

       //$a7=$d3[1][$k];
       $ud=''.$a3.' '.$a4.''.$a5.'&nbsp;&nbsp;'.$a2.'';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a6.'" target="_blank" >'.$ud.'</a>';
echo $xml;
}}
function qqhy2($url) {//好友
       $w=$_GET['w'];
   if ($w == '')  $w='1021460518';else  $w=$w;//
	$ul2 ='http://r.qzone.qq.com/cgi-bin/tfriend/friend_ship_manager.cgi?uin='.$w.'&do=1&rd=1&fupdate=1&clean=1&g_tk=1';
	$ul ='http://r.qzone.qq.com/cgi-bin/tfriend/friend_ship_manager.cgi?uin=180270388&do=1&rd=0.6183838499777109&fupdate=1&clean=1&g_tk=1413217680';
        $ut = f_g($ul);
preg_match_all('|"uin":([^<]+),"name":"([^<]+)",|ismU',$ut,$d);
preg_match_all('|"img":"([^<]+)"|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a2=$ul->items_list->uin;
       //$a3=$ul->data->items_list->name;
       //$a4=$ul->data->items_list->img;
$file = $_GET['file']; 
header("Content-type: octet/stream"); 
header("Content-disposition:attachment;filename=".$file.";"); 
header("Content-Length:".filesize($file)); 
readfile($file); 
       $ud=''.$a2.'';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a2.'" target="_blank" >'.$ud.'</a>';
echo $xml;
}}
function qqhy($url) {//好友
       $w=$_GET['w'];
   if ($w == '')  $w='1021460518';else  $w=$w;//
	$ul2 ='http://r.qzone.qq.com/cgi-bin/tfriend/friend_ship_manager.cgi?uin='.$w.'&do=1&rd=1&fupdate=1&clean=1&g_tk=1';
	$ul ='http://r.qzone.qq.com/cgi-bin/tfriend/friend_ship_manager.cgi?uin=180270388&do=1&rd=0.6183838499777109&fupdate=1&clean=1&g_tk=1413217680';
header("Content-type: octet/stream"); 
header("Content-disposition:attachment;filename=".$ul.";"); 
header("Content-Length:".filesize($ul)); 
$ut=readfile($ul);
        //$ut = file_put_contents('news.txt',$ul);
        //$ut2 =readfile($ul);            
        //$ut2 = f_g($ut);
/*preg_match_all('|"uin":([^<]+),"name":"([^<]+)",|ismU',$ut2,$d);
preg_match_all('|"img":"([^<]+)"|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=$d[2][$k];
       $a4=$d2[1][$k];
       $ud=''.$a2.' '.$a3.''.$a4.'';
       $vd=Current(explode('?',$v));*/
    $xml ='<a href="'.$ut.'" target="_blank" >'.$ut.'</a>';
echo $xml;
}
function qqqun2($url) {//QQ群好友
       $w=$_GET['w'];
   if ($w == '')  $w='499123097';else  $w=$w;
	$ul ='http://qun.qzone.qq.com/cgi-bin/get_group_member?uin=180270388&groupid=499123097&random=0.3645549176689022&g_tk=1650381822';  
        $ut = f_g($ul);
//preg_match_all('|"iscreator":([^<]+),"ismanager":([^<]+),"nick":([^<]+),"uin":([^<]+)|ismU',$ut,$d);               
//foreach ($d[1] as $k=>$v){
       //$a1=$d[1][$k];
       //$a2=$d[2][$k];
       //$a3=$d[3][$k];
       //$a4=$d[4][$k];
       //$ud=''.$a3.' '.$a4.'';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ut.'</a>';
echo $xml;
}
function qqqun($url) {//QQ群好友
       $w=$_GET['w'];
   if ($w == '')  $w='485013141';else  $w=$w;
	$ul2 ='http://qun.qzone.qq.com/group#!/'.$w.'/member'; 
        $gtk=g_tk($ul2);
	$ul ='http://qun.qzone.qq.com/cgi-bin/get_group_member?uin=180270388&groupid='.$w.'&random=0.3645549176689022&g_tk='.$gtk.'';  
        $ut = f_g($ul);
preg_match_all('|"iscreator":([^<]+),"ismanager":([^<]+),"nick":([^<]+),"uin":([^<]+)|ismU',$ut,$d);               
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=$d[2][$k];
       $a3=$d[3][$k];
       $a4=$d[4][$k];
       $a5='';
       $a6='';
   if ($a1 == '1')  $a5='群主';else if ($a2 == '1')  $a5='管理';else $a5='群友';
       $ud=$a5.'&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;'.$a4;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function weib($url) {//weibo
       $w=$_GET['w'];
       $kw=k_w($w)?k_w($w):date("Y");
	$ul ='https://weibo.com/aj/v6/comment/big?ajwvr=6&id=4419841824173108&type=photolayer&page=1';  
        $ut = m_v($ul);
preg_match_all('|"iscreator":([^<]+),"ismanager":([^<]+),"nick":([^<]+),"uin":([^<]+)|ismU',$ut,$d);               
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=$d[2][$k];
       $a3=$d[3][$k];
       $a4=$d[4][$k];
       $a5='';
       $a6='';
   if ($a1 == '1')  $a5='群主';else if ($a2 == '1')  $a5='管理';else $a5='群友';
       $ud=$a5.'&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;'.$a4;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function weibo($url) {//weibo
       $w=$_GET['w'];
       $kw=k_w($w)?k_w($w):date("Y");
	$ul ='http://s.weibo.com/weibo/'.$kw.'&Refer=STopic_box';  
        $ut = f_g($ul);
preg_match_all('|"iscreator":([^<]+),"ismanager":([^<]+),"nick":([^<]+),"uin":([^<]+)|ismU',$ut,$d);               
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=$d[2][$k];
       $a3=$d[3][$k];
       $a4=$d[4][$k];
       $a5='';
       $a6='';
   if ($a1 == '1')  $a5='群主';else if ($a2 == '1')  $a5='管理';else $a5='群友';
       $ud=$a5.'&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;'.$a4;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function wxqso($url) {//微信群
       $uk= array("0","cse_block1%3DforumIn_forumName%253A%25E5%25BE%25AE%25E4%25BF%25A1%25E7%25BE%25A4","cse_block1%3DforumIn_forumName%253A%25E5%2585%25AC%25E4%25BC%2597%25E5%258F%25B7","cse_block1%3DforumIn_forumName%253A%25E4%25B8%25AA%25E4%25BA%25BA%25E5%25BE%25AE%25E4%25BF%25A1","cse_block1%3DforumIn_forumName%253A%25E7%2594%25A8%25E6%2588%25B7%25E6%2596%2587%25E7%25AB%25A0");
       $tk= array("0","1440","10080","43200");
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
       $unk= $uk[ $u ];
       $tnk= $tk[ $t ];
       $tnk2= $t*1440;
   if ($t <= '3')  $tnk=$tnk;else  $tnk=$tnk2;
       $w=rawurlencode(mb_convert_encoding($_GET["w"], 'utf-8', 'gbk')); 
       $w = $_GET['w']?$_GET['w']:'上海';
       $p = $_GET['p']?$_GET['p']:2;
       $p2 =  $p-1;  
       $p3 =  '&p='.$p2; 
    for($i=0;$i<=$p;$i++){
   if ($_GET['p'] == '0')  $p3=null;else  $p3=$p3; 
	$ul ='http://so.weixinqun.com/cse/search?s=1626844590849882386&entry=1&q='.$w.'';  
	$ul2 ='http://so.weixinqun.com/cse/search?q='.$w.'&p='.$i.'&entry=1&s=1626844590849882386&flt='.$unk.'&sti='.$tnk.'&nsid=0';
        $ut = f_g($ul2);
preg_match_all('|<(.*)class="c-title">(.*)<a(.*)href="([^<]+)"(.*)>(.*)</a>|ismU',$ut,$d); 
preg_match_all('|class="c-abstract">(.*)</div>|ismU',$ut,$d2);  
preg_match_all('|class="c-summary-1"(.*)><span>([^<]+)</span><span></span><span>([^<]+)</span>|ismU',$ut,$d3);       
foreach ($d[1] as $k=>$v){
       $a1=$d[4][$k];
       $a2=$d[6][$k];
       $a3=$d2[1][$k];
       $a4=$d3[2][$k].$d3[3][$k];
       $ud=$a1;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="_blank" >'.$a2.' ( '.$a4.' ) '.$a3.'</a>';
echo $xml;
}}}



function wxq($url) {//微信群
       $wk= array("group","city","personal","openid","product","product","article","circle","list","ad_group");
       $uk= array("","310100","310100","310100");
       $tk= array("","1","2","3","4","5");
       $w = $_GET['w']?$_GET['w']:0;
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:'';
       $unk= $uk[ $u ];
       $tnk= $tk[ $t ];
       $wnk= $wk[ $w ];
       $new= '&new=1';
   if ($w == '5')  $new=$new;else  $new=null;
       $p = $_GET['p']?$_GET['p']:2;
       $p2 =  $p-1;  
       $p3 =  '&p='.$p2; 
    for($i=0;$i<=$p;$i++){
   if ($_GET['p'] == '0')  $p3=null;else  $p3=$p3; 
	$ul ='http://www.weixinqun.com/'.$wnk.'?t='.$t.'&c='.$unk.''.$new.'&p='.$i.'&o=default';  
        $ut = f_g($ul);
preg_match_all('|<(.*)class="(.*)ellips">(.*)<a href="([^<]+)"(.*)>([^<]+)</a>|ismU',$ut,$d);
preg_match_all('|<span class="pink">([^<]+)</span>(.*)<span class="caaa">([^<]+)</span>(.*)<span class="Pink ml10">(.*)<a(.*)>([^<]+)</a>(.*)</span>|ismU',$ut,$d2);
preg_match_all('|<div class="cover">(.*)<a href="([^<]+)">(.*)<img(.*)alt="([^<]+)" title="([^<]+)">(.*)<div class="txt">(.*)<p>([^<]+)</p>|ismU',$ut,$d3);
preg_match_all('|<a class="nickname"(.*)>(.*)<b>([^<]+)</b>|ismU',$ut,$d4);
preg_match_all('|<label class="pr5">([^<]+)</label>(.*)<a class="nickname"(.*)>(.*)<b>([^<]+)</b>(.*)<label class="pr5">([^<]+)</label>(.*)<span>([^<]+)</span>|ismU',$ut,$d5);
   if ($w == '4'||$w == '5')  $dd=$d3[1];else  $dd=$d[1];
foreach ($dd as $k=>$v){
       $a1=$d[4][$k];
       $a2=$d[6][$k];
       $a3=$d2[1][$k];
       $a4=$d2[3][$k];
       $a5=$d2[7][$k];
       $b4=$a3.$a4;
       $a7=$d3[2][$k];
       $a8=$d3[5][$k]; 
       $a6='http://www.weixinqun.com'.$a1;
       $a9='http://www.weixinqun.com'.$a7;
       $a11=$d4[3][$k]; 
       $a12=$d5[7][$k].$d5[9][$k]; 
       $a13=$d5[1][$k].$d5[5][$k]; 
       $a14=$d3[9][$k]; 
   if ($w == '4'||$w == '5')  $a10=$a9;else  $a10=$a6;
   if ($w == '4'||$w == '5')  $a2=$a8;else  $a2=$a2;
   if ($w == '4'||$w == '5')  $a5=''.$a13.'('.$a12.')  ('.$a14.')';else  $a5=''.$a2.' ('.$b4.') ('.$a5.')';
       $ud=$a10;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="_blank" >'.$a5.'</a>';
echo $xml;
}}}

function weixin($url) {//微信
        $w = $_GET['w']?$_GET['w']:date("Y"); 
        $kw= k_w($w);
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=1;$i<=$p;$i++){
	$ul0 ='http://weixin.sogou.com/weixin?query='.$w.'&_sug_type_=&_sug_=y&type=1&page='.$i.'&ie=utf8'; 
	$ul1 ='http://weixin.sogou.com/weixin?type=1&query='.$w.'&ie=utf8&_sug_=n&_sug_type_=&w=01019900&sut=608715&sst0=1460641552787&lkt=1';
	$ul2='http://weixin.sogou.com/weixin?query='.$w.'&_sug_type_=&_sug_=n&type=1&ie=utf8&sourceid=inttime_year&interation=&interV=kKIOkrELjboJmLkElbYTkKIKmbELjbkRmLkElbk%3D_1893302304&tsn=4'; 
        $ut = m_v(g_h($ul0));
//preg_match_all('|<div class="wx-rb bg-blue wx-rb_v1 _item" href="(.*)?([^<]+)"|ismU',$ut,$d);
preg_match_all('|<h3><em><(.*)>([^<]+)<(.*)></em></h3>|ismU',$ut,$d2);
preg_match_all('|<span class="sp-txt">([^<]+)</span>|ismU',$ut,$d3);
preg_match_all('|<label name="em_weixinhao">([^<]+)</label>|ismU',$ut,$d4);
preg_match_all("|onclick=\"gotourl\('(.*)\?([^<]+)',event,this\);|ismU",$ut,$d);       
foreach ($d[1] as $k=>$v){
       $a1=$d[2][$k];
       $a2='http://weixin.sogou.com/gzh?'.$a1.'&cb=sogou.weixin_gzhcb&page='.$p.'&gzhArtKeyWord=&tsn=0&t=1';
       $a22='http://weixin.sogou.com/gzhjs?'.$a1.'&cb=sogou.weixin_gzhcb&page='.$p.'&gzhArtKeyWord=&tsn=0&t=1';
       $a3=m_u($d2[2][$k]);
       $a4=m_u($d3[1][$k]);
       $a5=m_u($d4[1][$k]);
       //$a6=m_u('微信号:');
       $a7=''.$a3.' '.$a4.'('.$a5.')';
       $ud=$a2;
       $vd=Current(explode('?',$v));
    //$xml ='<a href="'.$ud.'" target="_blank" >'.$a7.'</a>';
    $xml='<a href="'.$fname.'?&weixin='.$ud.'&name='.$a3.'&cn='.$a5.'" target="_blank" >'.$a7.'</a>';
echo $xml;
}}}
function weixin2($url) {//微信
        $w = $_GET['w']?$_GET['w']:date("Y"); 
        $kw= k_w($w);
        $p = $_GET['p']?$_GET['p']:1; 
	$ul ='http://weixin.sogou.com/weixin?type=1&ie=utf8&_sug_=n&_sug_type_=&query='.$w.''; 
	$ul2='http://weixin.sogou.com/gzhjs?openid=oIWsFt5Y_VirSKV206JiJoMXfPRE&ext=NIh7jNwwaRlPim_KfW1FcIqKCiAYL_F4hvCrsPyKMN-HLwA0dDLg-yUUXEbXWKP8&cb=sogou.weixin_gzhcb&page=2&gzhArtKeyWord=&tsn=0&t=1460637858567'; 
        $ut = m_v($ul);
preg_match_all('|<div class="wx-rb bg-blue wx-rb_v1 _item" href="([^<]+)" target="_blank" uigs_exp_id=""|ismU',$ut,$d);
preg_match_all('|<h3><em><(.*)>([^<]+)<(.*)></em></h3>|ismU',$ut,$d2);
preg_match_all('|<span class="sp-txt">([^<]+)</span>|ismU',$ut,$d3);
preg_match_all('|<label name="em_weixinhao">([^<]+)</label>|ismU',$ut,$d4);
//preg_match_all"|onclick=\"gotourl\('([^<]+)',event,this\);|ismU",$ut,$d);       
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
    for($i=1;$i<=$p;$i++){
       $a2='http://weixin.sogou.com'.$a1.'&cb=sogou.weixin_gzhcb&page='.$i.'&gzhArtKeyWord=&tsn=0&t=1';
       $a3=m_u($d2[2][$k]);
       $a4=m_u($d3[1][$k]);
       $a5=m_u($d4[1][$k]);
       $ut2 = f_g($a2);
preg_match_all("|<title><\!\[CDATA\[([^<]+)\]\]><\/title><url><\!\[CDATA\[([^<]+)\]\]><\/url>ismU",$ut2,$d5);      
foreach ($d5[1] as $k2=>$v2){
       $a6=m_u($d5[1][$k2]);
       $a7=$d5[2][$k2];
       $a8='http://weixin.sogou.com'.$a7;
       $ud=$a8;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="_blank" >'.$a6.'</a>';
echo $xml;
}}}}
function jrjzj($url) {//板块资金
       $w = $_GET['w']?$_GET['w']:"in";
       $p = $_GET['p']?$_GET['p']:50; //
	$ul0 ='http://zj.hqquery.jrj.com.cn/bzj.do?vname=sflow&c=name,code,sname,scode,pl,zjin,inratio,zlin,zlratio,j2,zdratio,j1,xdratio&zj='.$w.'&sort=zjin&page=1&order=desc&size='.$p.'';
	$ul2 ='http://zj.hqquery.jrj.com.cn/szj.do?vname=ggzjlxtoday&c=code,name,np,pl,zjin,inratio,zlin,zlratio,j2,zdratio,j1,xdratio&zb=400115931&size=20&order=desc&sort=zjin';
	$ul1 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?sort=todaypl&order=desc&pn=1&ps=300';
	$ul ='http://stock.jrj.com.cn/concept/conceptList.shtml?sort=todaypl&order=desc&test='.$i.'';
        $ut = m_v($ul0);
preg_match_all("|\[\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+)\],|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=m_u($d[1][$k]);
       $a2=$d[2][$k];
       $a3=m_u($d[3][$k]);
       $a4=$d[4][$k];
       $a5=$d[6][$k]/100000000;
       $a6=$d[8][$k]/100000000;
       $a7=$d[10][$k]/100000000;
       $a8=$d[12][$k]/100000000;
       $a9=m_u('净入:');
       $a10=m_u('大入:');
       $a11=m_u('中入:');
       $a12=m_u('小入:');
       $a13=m_u('领涨:');
       $a14=m_u('亿');
       $ud=''.$a1.':&nbsp;&nbsp;&nbsp;&nbsp;'.$a13.'&nbsp;'.$a3.'&nbsp;('.$a4.')&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;'.$a5.'&nbsp;'.$a14.'&nbsp;&nbsp;&nbsp;'.$a10.'&nbsp;'.$a6.'&nbsp;'.$a14.'&nbsp;&nbsp;&nbsp;'.$a11.'&nbsp;'.$a7.'&nbsp;'.$a14.'&nbsp;&nbsp;&nbsp;'.$a12.'&nbsp;'.$a8.'&nbsp;'.$a14.'&nbsp;';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function agp($url) {//爱股票
       $w = $_GET['w']?$_GET['w']:"";
       $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;$i++){
	$ul1 ='https://www.aigupiao.com/index.php?s=/Api/Express/express_list&u_id=undefined&before=0&md=8eb9e690499d3d38415aeee14ce759f0';
	$ul2 ='https://www.aigupiao.com/indexNew/express_hot_list?genre=day&page='.$i.'';
        $ut = m_v($ul1);
preg_match_all('|"content":"([^<]+)"(.*)"rec_time":"([^<]+)"(.*)"update_time":"([^<]+)"|ismU',$ut,$d);
//preg_match_all('|"id":"([^<]+)"(.*)"content":"([^<]+)"(.*)"rec_time":"([^<]+)"(.*)"update_time":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       //$a1=$d[1][$k];
       $a2=x_g(r_u($d[1][$k]));
       //$a3=t_m($d[3][$k]);
       $a4=$d[5][$k];
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a4.'  :'.$a2.'</a>';
       //$xml2 ='<a href="'.$ud.'" target="_blank">'.$a3.'  :'.$a2.'</a>';
echo $xml;
}}}
function ggds($url) {//公告大事
       $w = $_GET['w']?$_GET['w']:"3";
       $p = $_GET['p']?$_GET['p']:1;
    for($i=1;$i<=$p;$i++){}
	$ul ='http://data.10jqka.com.cn/market/ggsd/ggtype/1/board/3/page/1/ajax/1/';
	$ul2 ='http://data.10jqka.com.cn/ajax/yjyg/agentSource/static1604587843/date/2020-12-31/board/ALL/field/enddate/order/desc/page/2/ajax/1/free/1/';
        $ut = m_v($ul);
/*preg_match_all('|<tr>(.*)<td>([^<]+)</td>(.*)<td class="tc">([^<]+)</td>(.*)<td class="tc"><a href="([^<]+)"(.*)>([^<]+)</a></td>(.*)<td class="tc"><a href="([^<]+)"(.*)code="([^<]+)" class="J_showCanvas">([^<]+)</a></td>(.*)<td class="tc c-rise">([^<]+)</td>(.*)<td class="tc c-rise">([^<]+)</td>(.*)<td class="tl">(.*)<table class="m-table">(.*)<tr>(.*)<td(.*)class="tl">(.*)<div class="clearfix"><a(.*)href="([^<]+)">([^<]+)</a></div>(.*)</td>(.*)<td(.*)>([^<]+)</td>(.*)</tr>(.*)</table>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[4][$k];
       $a2=$d[8][$k];
       $a3=m_u($d[13][$k]);
       $a4=$d[25][$k];
       $a5=m_u($d[26][$k]);
       $a6=m_u($d[30][$k]);
       $ud=$a4;
       $vd=Current(explode('?',$v));*/
       $xml ='<a href="'.$ul.'" target="_blank">'.$ut.'</a>';
       //$xml2 ='<a href="'.$ud.'" target="_blank">'.$a1.'  :'.$a2.'('.$a3.') ('.$a5.') ('.$a6.')</a>';
echo $xml;
}
function gn($url) {//股票概念
       $w = $_GET['w']?$_GET['w']:"conceptList";
       $p = $_GET['p']?$_GET['p']:300; //
	$ul2 ='http://stock.jrj.com.cn/action/concept/queryConceptInfoList.jspa?vname=conceptList&pn=1&ps=300';
	$ul1 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?sort=todaypl&order=desc&pn=1&ps=300';
	$ul0 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?&vname=hotconcept&sort=todaypl&order=desc&pl=1&ps=300';
	$ul ='http://stock.jrj.com.cn/concept/conceptList.shtml?sort=todaypl&order=desc&test='.$i.'';
        $ut = f_g($ul0);
preg_match_all("|\[([^<]+),\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+)\]|ismU",$ut,$d);
//preg_match_all("|\[\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+)\]|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[2][$k];
       $a2=r_u($d[3][$k]);
       $a3=r_u($d[4][$k]);
       $a4=r_u($d[5][$k]);
       $a5=$d[6][$k];
       $a6=$d[7][$k];
       $a8='http://stock.jrj.com.cn/concept/conceptdetail/conceptDetail_'.$a1.'.shtml';
       $a9=m_u('股票数:');
       $ud=''.$a8.'';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$fname.'?&gnt='.$a1.'&name='.$a2.'" >'.$a2.' :'.$a4.'&nbsp;(&nbsp;'.$a6.'&nbsp;)('.$a3.')</a>';
echo $xml;
}}

function gn2($url) {//股票概念
       $wk= array("zjlx","zjlx","todaypl");
       $w=$_GET['w'];
       $wnk=$wk[$w];
   if($w == '') $w='zjlx';else if($w == '1') $w='zjlx';else if($w == '2') $w='todaypl';else $w=$w;//zjlx,todaypl,
       $p = $_GET['p']?$_GET['p']:300; //
    for($i=1;$i<=$p;$i++){
        $p1 = $i*100;
	$ul0 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?&vname=hotconcept&sort=todaypl&order=desc&pl=1&ps='.$p.'';
	$ul1 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?sort=todaypl&order=desc&pn=1&ps=300';
	$ul2 ='http://stock.jrj.com.cn/action/concept/queryConceptInfoList.jspa?vname=conceptList&pn=1&ps=300';
        $ul3 ='http://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?sort='.$wnk.'&order=desc&pn=1&ps='.$p1.'&_dc=1459862339682';
	//$ul ='http://stock.jrj.com.cn/concept/conceptList.shtml?sort=todaypl&order=desc&test='.$i.'';
        $ut = m_v($ul3);
preg_match_all("|\"data\"\:\[(.*)\]\};|ismU",$ut,$d2);
foreach ($d2[1] as $ks=>$vs){
preg_match_all("|\[([^<]+),\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+),([^<]+)\]|ismU",$vs,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=$d[2][$k];
       $a3=$d[3][$k];
       $a4=$d[4][$k];
       $a5=$d[5][$k];
       $a6=$d[6][$k];
       $a7=m_u('板块涨幅:');
       $a8=$d[10][$k].'%';
       $a9=$d[14][$k];
       $a10=m_u('个');
       $a11=m_u('资金流入:');
       $a12=m_u('万');
       $a13=$d[9][$k];
       $a14=$d[8][$k].'%';
       $a15=m_u('领涨:');
       $a16=m_u('涨幅:');
       $ud=''.$a3.' :&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;'.$a9.''.$a10.'&nbsp;&nbsp;&nbsp;'.$a15.'&nbsp;'.$a6.'|&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;'.$a16.''.$a14.')&nbsp;&nbsp;'.$a7.'&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a11.'&nbsp;'.$a13.''.$a12.'';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$fname.'?&gnt='.$a2.'&name='.$a3.'" >'.$ud.'</a>';
echo $xml;
}}}}
function gnso($url) {//概念搜索
       $w = $_GET['w']?$_GET['w']:"qs";
       $name = $_GET['name'];
       $ul='http://stock.jrj.com.cn/concept/stock/concept_'.$w.'.js';
 preg_match("#\"HqData\":(.*)\]\}#",m_v($ul),$b);
       $ut = $b[1].']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2=$a0[2];
       $a3=$a0[3];
    if($a3<0) $a3='<font color=#00cc00>'.$a3.'</font>';else if($a3>1.9) $a3='<font color=#ff033e>'.$a3.'</font>';else $a3=$a3;
       $a4=m_u('现价:');
       $a5=m_u('涨幅:');
       $a6 = $a4.'&nbsp;&nbsp;'.$a0[2];
       $a7 = $a5.'&nbsp;&nbsp;'.$a3.'%';
       $a8=$a0[4].m_u('  万元');
       $a9=$a0[0];
       $a10=r_u($a0[1]);
       $a11=m_u('总量  ').$a0[5].m_u('  手');
       $b9='&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a10.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a11;
       $xml='<a>'.$b9.'</a>';
    //$xml ='<a>'.$name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'</a>';
echo $xml;
}}
function gnso0($url) {//概念搜索
       $w = $_GET['w']?$_GET['w']:"qs";
       $name = $_GET['name'];
       $a8='http://stock.jrj.com.cn/concept/stock/concept_'.$w.'.js';
       $ut2 = m_v($a8);
preg_match_all("|\[\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+)\]|ismU",$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a4=m_u('现价:');
       $a5=m_u('涨幅:');
       $a6=$a4.'&nbsp;&nbsp;'.$d2[3][$k2];
       $a7=$a5.'&nbsp;&nbsp;'.$d2[4][$k2].'%';
       $a8=$d2[5][$k2];
       $a9=$d2[1][$k2];
       $a10=r_u($d2[2][$k2]);
       $b9=$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a10;
       $ud=''.$b9.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.$name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'</a>';
echo $xml;
}}
function gnn($url) {//金融街概念
       $w = $_GET['w']?$_GET['w']:"qs";
       $p = $_GET['p']?$_GET['p']:"1";
    for($i=1;$i<=$p;$i++){
       $ul='https://stock.jrj.com.cn/action/concept/queryConceptHQ.jspa?sort=todaypl&order=desc&pn='.$i.'&ps=30&_dc=1560661529320';
       $ut = m_v($ul);
preg_match("|\"data\":\[(.*)\]\}|",$ut,$d2);
preg_match_all("|\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",\"([^<]+)\",|ismU",$d2[1],$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=m_u($d[2][$k]);
       $a4=$d[3][$k];
       $a5=$d[4][$k];
       $a6=m_u($d[5][$k]);
       $a7=$d[8][$k];
       $b9='http://stock.jrj.com.cn/concept/conceptdetail/conceptDetail_'.$a2.'.shtml';
       $b92='https://stock.jrj.com.cn/concept/conceptdetail/conceptDetail_'.$a2.'.shtml';
       $ud=''.$b9.'';
       $vd=Current(explode('?',$v2));
       $xml ='<a href="'.$ud.'" target="b" >'.$a3.'  '.$a2.'  ('.$a5.')</a>';
echo $xml;
}}}
function jrjm($url) {//金融街新闻
       $w = $_GET['w']?$_GET['w']:"yaowen";
       $year = date("Y");
       $mouth = date("m");
       $day = date("d");
       $tday = $year.'-'.$mouth.'-'.$day;
       $t = $_GET['t']?$_GET['t']:$tday;
       $ul='http://stock.jrj.com.cn/share/news/yaowen/yw'.$t.'.js';
       $ul2='http://stock.jrj.com.cn/share/news/app/yaowen/'.$t.'.js';
       $ul1='http://stock.jrj.com.cn/share/news/yaowen/yw2021-11-05.js?';
       $ut = m_v($ul);
preg_match_all('|"title":"([^<]+)"(.*)"makedate":"([^<]+)"(.*)"infourl":"([^<]+)"(.*)"detail":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=r_u($d[1][$k]);
       $a3=$d[3][$k];
       $a4=$d[5][$k];
       $a5=r_u($d[7][$k]);
       $ud=$a4;
       $vd=Current(explode('?',$v));
       $xml ='<a>'.$a3.'  '.$a2.'  ('.$a5.')</a>';
       $xml2 ='<a href="'.$ud.'" target="_blank">'.$a3.'  '.$a2.'  ('.$a5.')</a>';
echo $xml;
}}
function qqgg($url) {//公告
       $wk= array("100","101","102","103","104","105");
       $w = $_GET['w']?$_GET['w']:"600000";
       $p = $_GET['p']?$_GET['p']:"1";
       $t = $_GET['t']?$_GET['t']:"1";
       $sz='sz';
       $sh='sh';
       $ss='';
       $ww=substr($w,0,2);
   if($ww=='60'|| $ww=='68') $ss=$sh;else $ss=$sz;
       $ws = $ss.$w;
    for($ii=1;$ii<=$p;$ii++){
       $ul='https://proxy.finance.qq.com/ifzqgtimg/appstock/news/info/search?page=1&symbol='.$ws.'&n=51&type=0&_appver=1.0';
       $ul2='http://newsinfo.eastmoney.com/kuaixun/v2/api/list?callback=jsonp_8FA61BE00B5947CA855845F4F2261071&column='.$wnk.'&p='.$ii.'&limit=30';
       $ut = m_v($ul);
       $nt = J_d($ut,ture);
       $aa = $nt["data"]["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["symbol"];
       $a2 = r_u($a0["title"]);
       $a3 = $a0["time"];
       $a4 = $a0["create_time"];
    $xml ='<a>'.$a4.'  '.$a2.' </a>';
echo $xml;
}}}
function emest($url) {//新闻
       $wk= array("100","101","102","103","104","105");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $t = $_GET['t']?$_GET['t']:"1";
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
       $ul1='http://emwap.eastmoney.com/info/channel/getscrollnewsdata?channelid=999&pagenum=1&pagesize=30';
       $ul2='http://newsinfo.eastmoney.com/kuaixun/v2/api/list?callback=jsonp_8FA61BE00B5947CA855845F4F2261071&column='.$wnk.'&p='.$ii.'&limit=30';
 preg_match("|\"news\":\[\{(.*)\}\],\"PageCount\"|U",m_v($ul2),$b);
       $ut = '['.'{'.$b[1].'}'.']';
       $nt = J_d($ut,ture);
       $aa = $nt;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0["id"];
       $a2 = $a0["url_w"];
       $a3 = $a0["title"];
       $a4 = $a0["digest"];
       $a5 = $a0["ordertime"];
    $xml ='<a>'.$a5.'  '.$a4.' </a>';
echo $xml;
}}}
function emest0($url) {//新闻
       $wk= array("100","101","102","103","104","105");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $t = $_GET['t']?$_GET['t']:"1";
       $wnk = $wk[$w];
    for($ii=1;$ii<=$p;$ii++){
       $ul1='http://emwap.eastmoney.com/info/channel/getscrollnewsdata?channelid=999&pagenum=1&pagesize=30';
       $ul2='http://newsinfo.eastmoney.com/kuaixun/v2/api/list?callback=jsonp_8FA61BE00B5947CA855845F4F2261071&column='.$wnk.'&p='.$ii.'&limit=30';
       $ut = m_v($ul2);
preg_match_all('|"digest":"([^<]+)"(.*)"ordertime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=m_u($d[1][$k]);
       $a5=$d[3][$k];
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$a5.'  '.$a2.' </a>';
echo $xml;
}}}
function gbgg($url) {//公告
       $w = $_GET['w']?$_GET['w']:"600000";
       $p = $_GET['p']?$_GET['p']:"20";
       $t = $_GET['t']?$_GET['t']:"1";
       $ul='http://newsnotice.eastmoney.com/webapi/api/Notice?Time=&FirstNodeType=0&SecNodeType=0&PageIndex=1&PageSize='.$p.'&callback=jQuery183003080773907082035_1540384881165&StockCode='.$w.'&CodeType=1';
      $ut = f_g($ul);
preg_match_all('|"NOTICETITLE":"([^<]+)","INFOCODE":(.*)"EUTIME":"([^<]+)","TABLEID":([^<]+),"Order":([^<]+),"Url":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=m_u($d[1][$k]);
       $a3=$d[3][$k];
       $a4=$d[6][$k];
       $vd=Current(explode('?',$v));
      $xml ='<a>'.$a3.' : '.$a2.' </a>';
      $xml2 ='<a href="'.$a4.'" target="_blank">'.$a3.' : '.$a2.'</a>';
echo $xml2;
}}
function qqzj($url) {//qq资金
       $w = $_GET['w']?$_GET['w']:"600000";
       $sz='sz';
       $sh='sh';
       $ss='';
       $ww=substr($w,0,2);
   if($ww=='60'|| $ww=='68') $ss=$sh;else $ss=$sz;
       $p = $_GET['p']?$_GET['p']:30; 
       $ul1='http://qt.gtimg.cn/q=ff_'.$ss.''.$w.'';
       $ut = f_g($ul1);
    preg_match('|"(.*)"|ismU',$ut,$d2);
       $dd=$d2[0];
       $d=explode("~", $dd); 
       $d3=explode("^", $dd); 
       $a0=$d[0];
       $a1=$d[1];
       $a2=$d[2];
       $a3=$d[3];
       $a4=$d[4];
       $a5=$d[5];
       $a6=$d[6];
       $a7=$d[7];
       $a8=$d[8];
       $a9=$d[9];
       $a10=$d[10];
       $a11=$d[11];
       $a12=m_u($d[12]);
       $a13=$d[13];
       $a14=$d[14];
       $d4=explode("^",$a14); 
       $a15=$d3[1];
       $a16=$d3[2];
       $a17=$d[15];
       $d5=explode("^",$a17);
       $a18=$d3[3];
       $a19=$d3[4];
       $a20=$d[16];
       $d6=explode("^",$a20);
       $a21=$d3[5];
       $a22=$d3[6];
       $a23=$d[17];
       $d7=explode("^",$a23);
       $a24=$d3[7];
       $a25=$d3[8];
       $a26=$d[26];
       $a27=$a15-$a16;
       $a28=$a18-$a19;
       $a29=$a21-$a22;
       $a30=$a24-$a25;
       $w1=m_u('主力入：');
       $w2=m_u('主力出：');
       $w3=m_u('主力净入：');
       $w4=m_u('流入额：');
       $w5=m_u('流出额：');
       $w6=m_u('净入额：');
       $w7=m_u('散户入额：');
       $w8=m_u('散户出额：');
       $w9=m_u('流入总额：');
       $w10=m_u('：');
       $w11=m_u('日期：');
       $w12=m_u('净入：');
       $w13=m_u('主入：');
$ud=''.$a12.'('.$w.')'.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w1.''.$a1.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.''.$a2.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.''.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.''.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w5.''.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.''.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.''.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w8.''.$a10.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w9.''.$a11.'&nbsp;&nbsp;&nbsp;&nbsp;( '.$a13.''.$w13.''.$a3.' )&nbsp;&nbsp;&nbsp;&nbsp;'.$d4[0].''.$w12.''.$a27.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d5[0].''.$w12.''.$a28.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d6[0].''.$w12.''.$a29.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d7[0].''.$w12.''.$a30.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}

function qqzj2($url) {//qq资金
       $w = $_GET['w']?$_GET['w']:"600000";
       $sz='sz';
       $sh='sh';
       $ss='';
       $ww=substr($w,0,2);
   if($ww=='60'|| $ww=='68') $ss=$sh;else $ss=$sz;
       $p = $_GET['p']?$_GET['p']:30; 
       $ul1='http://qt.gtimg.cn/q=ff_'.$ss.''.$w.'';
       $ut = f_g($ul1);
    preg_match('|"(.*)"|ismU',$ut,$d2);
       $dd=$d2[0];
       $d=explode("~", $dd); 
       $d3=explode("^", $dd); 
       $a0=$d[0];
       $a1=$d[1];
       $a2=$d[2];
       $a3=$d[3];
       $a4=$d[4];
       $a5=$d[5];
       $a6=$d[6];
       $a7=$d[7];
       $a8=$d[8];
       $a9=$d[9];
       $a10=$d[10];
       $a11=$d[11];
       $a12=m_u($d[12]);
       $a13=$d[13];
       $a14=$d[14];
       $d4=explode("^",$a14); 
       $a15=$d3[1];
       $a16=$d3[2];
       $a17=$d[15];
       $d5=explode("^",$a17);
       $a18=$d3[3];
       $a19=$d3[4];
       $a20=$d[16];
       $d6=explode("^",$a20);
       $a21=$d3[5];
       $a22=$d3[6];
       $a23=$d[17];
       $d7=explode("^",$a23);
       $a24=$d3[7];
       $a25=$d3[8];
       $a26=$d[26];
       $a27=$a15-$a16;
       $a28=$a18-$a19;
       $a29=$a21-$a22;
       $a30=$a24-$a25;
       $w1=m_u('主力入：');
       $w2=m_u('主力出：');
       $w3=m_u('主力净入：');
       $w4=m_u('流入额：');
       $w5=m_u('流出额：');
       $w6=m_u('净入额：');
       $w7=m_u('散户入额：');
       $w8=m_u('散户出额：');
       $w9=m_u('流入总额：');
       $w10=m_u('：');
       $w11=m_u('日期：');
       $w12=m_u('净入：');
$ud=''.$a12.'('.$w.')'.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w1.''.$a1.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.''.$a2.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.''.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.''.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w5.''.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.''.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.''.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w8.''.$a10.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w9.''.$a11.'&nbsp;&nbsp;&nbsp;&nbsp;( '.$a13.''.$w12.''.$a3.' )&nbsp;&nbsp;&nbsp;&nbsp;'.$d4[0].''.$w12.''.$a27.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d5[0].''.$w12.''.$a28.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d6[0].''.$w12.''.$a29.'&nbsp;&nbsp;&nbsp;&nbsp;'.$d7[0].''.$w12.''.$a30.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}

function bk($url) {//新浪板块资金
       $w = $_GET['w']?$_GET['w']:"0";
       $p=$_GET['p']?$_GET['p']:1;
    for($ii=1;$ii<=$p;$ii++){
       $ul1='https://money.finance.sina.com.cn/quotes_service/api/jsonp_v2.php/IO.XSRV2.CallbackList/MoneyFlow.ssl_bkzj_bk?page=1&num='.$ii.'&sort=netamount&asc=0&fenlei='.$w.'';
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_bk?page='.$ii.'&num=30&sort=netamount&asc=0&fenlei='.$w.'';
       $ut = J_d(m_v($ul2),ture);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = $a0["category"];
       $a3 = m_u($a0["name"]).':';
       $a4 = m_u('涨跌').(round($a0["avg_changeratio"]*100,3)).'%';
       $a5 = m_u('流入').(round($a0["inamount"]/10000,2)).m_u('万');
       $a6 = m_u('流出').(round($a0["outamount"]/10000,2)).m_u('万');
       $a7 = m_u('净流入').(round($a0["netamount"]/10000,2)).m_u('万');
       $a8 = $a0["ts_symbol"];
       $a9 = m_u('领涨:').m_u($a0["ts_name"]);
       $a10 = m_u('涨幅').(round($a0["ts_changeratio"]*100,3)).'%';
$ud=''.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;('.$a8.')&nbsp;&nbsp;'.$a10.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function bk0($url) {//新浪板块资金
       $w = $_GET['w']?$_GET['w']:"0";
       $p=$_GET['p'];
   if ($p == '')  $p='30';else  $p=$p;
       $ul1='http://money.finance.sina.com.cn/quotes_service/api/jsonp_v2.php/IO.XSRV2.CallbackList/MoneyFlow.ssl_bkzj_bk?page=1&num='.$p.'&sort=netamount&asc=0&fenlei='.$w.'';
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_bk?page=1&num='.$p.'&sort=netamount&asc=0&fenlei='.$w.'';
       $ut2 = m_v($ul2);
preg_match_all('|category:"(.*)_([^<]+)",name:"([^<]+)",avg_price:"([^<]+)",avg_changeratio:"([^<]+)",turnover:"([^<]+)",inamount:"([^<]+)",outamount:"([^<]+)",netamount:"([^<]+)",ratioamount:"([^<]+)",ts_symbol:"([^<]+)",ts_name:"([^<]+)",ts_trade:"([^<]+)",ts_changeratio:"([^<]+)",ts_ratioamount:"([^<]+)"|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a2=$d2[2][$k2];
       $a3=m_u($d2[3][$k2]).':';
       $a4=m_u('涨跌').(round($d2[5][$k2]*100,3)).'%';
       $a5=m_u('流入').(round($d2[7][$k2]/10000,2)).m_u('万');
       $a6=m_u('流出').(round($d2[8][$k2]/10000,2)).m_u('万');
       $a7=m_u('净流入').(round($d2[9][$k2]/10000,2)).m_u('万');
       $a8=$d2[11][$k2];
       $a9=m_u('领涨:').m_u($d2[12][$k2]);
       $a10=m_u('涨幅').(round($d2[14][$k2]*100,3)).'%';
$ud=''.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;('.$a8.')&nbsp;&nbsp;'.$a10.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function gg($url) {//新浪个股资金
        $wk= array( "ratioamount","changeratio","netamount","r0_net","symbol");
        $w = $_GET['w']?$_GET['w']:0;
        $wnk= $wk[$w];
        $u = $_GET['u']?$_GET['u']:0;
        $t = $_GET['t']?$_GET['t']:"5";
        $p = $_GET['p']?$_GET['p']:3;
    for($ii=1;$ii<=$p;$ii++){
       $ul1='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_ssggzj?page='.$ii.'&num=30&sort='.$wnk.'&asc='.$u.'&bankuai=&shichang=';
       $ul0='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_ssggzj?page='.$ii.'&num=20&sort=symbol&asc='.$u.'&bankuai=2%2Fhangye_ZL&shichang=';
       $ul2='https://money.finance.sina.com.cn/quotes_service/api/jsonp_v2.php/IO.XSRV2.CallbackList/MoneyFlow.ssl_bkzj_ssggzj?page=1&num='.$p.'&sort='.$wnk.'&asc='.$u.'&bankuai=&shichang=';
       $ut = J_d(m_v($ul1),ture);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       //$a1 = $a0["symbol"];
       //$a2 = $a0["name"];
       //$a3 = $a0["trade"];
       //$a4 = $a0["changeratio"];
       //$a5 = $a0["turnover"];
       //$a6 = $a0["amount"];
       //$a7 = $a0["inamount"];
       //$a8 = $a0["outamount"];
       //$a9 = $a0["netamount"];
       //$a10 = $a0["ratioamount"];
       //$a11 = $a0["r0_in"];
       //$a12 = $a0["r0_out"];
       //$a13 = $a0["r0_net"];
       //$a14 = $a0["r3_in"];
       //$a15 = $a0["r3_out"];
       //$a16 = $a0["r3_net"];
       //$a17 = $a0["r0_ratio"];
       //$a18 = $a0["r3_ratio"];
       //$a19 = $a0["r0x_ratio"];
       $a2 = $a0["symbol"];
       $a3 = m_u($a0["name"]).':';
       $a4 = m_u('涨幅').round(($a0["changeratio"]*100),2).'%';
       $b5=round(($a0["turnover"]*100),2);
       $a5=m_u('换手').round(($a0["turnover"]/100),2);
       $b6=round(($a0["amount"]/10000),2);
       $a6=m_u('成交额').round(($a0["amount"]/10000),2).m_u('万元');
       $b7=round(($a0["r0_out"]/10000),2);
       $a7=m_u('主力流出').round(($a0["r0_out"]/10000),2).m_u('万元');
       $b8=round(($a0["r0_in"]/10000),2);
       $a8=m_u('主力流入').round(($a0["r0_in"]/10000),2).m_u('万元');
       $b11= round(($a0["ratioamount"]*100),2);
       $a11=m_u('流入率').round(($a0["ratioamount"]*100),2).m_u('%');
       $b9= round(($a0["r0_net"]/10000),2);
       $a9=m_u('主力净流入').round(($a0["r0_net"]/10000),2).m_u('万元');
       $b12= $a0["r0_in"]/$a0["amount"]*100;
       $a12=m_u('流入率').round($b12,2).m_u('%');
       $b13= round($a0["r0_net"]/($a0["r0_in"] + $a0["r0_out"])*100,2);
       $a13=m_u('对比').round($a0["r0_net"]/($a0["r0_in"] + $a0["r0_out"])*100,2).m_u('%');
       $b17=round(($a0["r0_ratio"]*100),2);
       $a17=m_u('R0比').round(($a0["r0_ratio"]*100),2).m_u('%');
       $b18=round(($a0["r3_ratio"]*100),2);
       $a18=m_u('R3比').round(($a0["r3_ratio"]*100),2).m_u('%');
     if($b11 >= "5" and  $b11 <= "15") $a11='<font color=#fd2a05>'.$a11.'</font>';else $a11=$a11;
     if($b11 >= "15" ) $a11='<font color=#ee82ee>'.$a11.'</font>';else $a11=$a11;
     if($b11 >= "5" and  $b11 <= "15") $a13='<font color=#fd2a05>'.$a13.'</font>';else $a13=$a13;
     if($b11 >= "15" ) $a13='<font color=#ee82ee>'.$a13.'</font>';else $a13=$a13;
     if($b11 >= "5" and  $b11 <= "15") $a17='<font color=#fd2a05>'.$a17.'</font>';else $a17=$a17;
     if($b11 >= "15" ) $a17='<font color=#ee82ee>'.$a17.'</font>';else $a17=$a17;
     if($b11 >= "5" and  $b11 <= "15") $a18='<font color=#fd2a05>'.$a18.'</font>';else $a18=$a18;
     if($b11 >= "15" ) $a18='<font color=#ee82ee>'.$a18.'</font>';else $a18=$a18;
        $ud=''.$a3.'&nbsp;('.$a2.')&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a11.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a17.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a18.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a13.'';
if( $b17>$t and $b13>1) $ud1= $ud;
    $xml ='<a>'.$ud1.'</a>';
echo $xml;
}}}
function gg0($url) {//新浪个股资金
        $wk= array( "symbol","ratioamount","changeratio","netamount","r0_net");
        $w = $_GET['w']?$_GET['w']:0;
        $wnk= $wk[$w];
        $u = $_GET['u']?$_GET['u']:0;
        $t = $_GET['t']?$_GET['t']:"5";
        $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;$i++){
       $ul1='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_ssggzj?page='.$i.'&num=30&sort='.$wnk.'&asc='.$u.'&bankuai=&shichang=';
       $ul0='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/MoneyFlow.ssl_bkzj_ssggzj?page='.$i.'&num=20&sort=symbol&asc='.$u.'&bankuai=2%2Fhangye_ZL&shichang=';
       $ul2='https://money.finance.sina.com.cn/quotes_service/api/jsonp_v2.php/IO.XSRV2.CallbackList/MoneyFlow.ssl_bkzj_ssggzj?page=1&num='.$p.'&sort='.$wnk.'&asc='.$u.'&bankuai=&shichang=';
       $ut2 = m_v($ul1);
preg_match_all('|symbol:"([^<]+)",name:"([^<]+)",trade:"([^<]+)",changeratio:"([^<]+)",turnover:"([^<]+)",amount:"([^<]+)",inamount:"([^<]+)",outamount:"([^<]+)",netamount:"([^<]+)",ratioamount:"([^<]+)",r0_in:"([^<]+)",r0_out:"([^<]+)",r0_net:"([^<]+)",r3_in:"([^<]+)",r3_out:"([^<]+)",r3_net:"([^<]+)",r0_ratio:"([^<]+)",r3_ratio:"([^<]+)",r0x_ratio:"([^<]+)"|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a2=$d2[1][$k2];
       $a3=m_u($d2[2][$k2]).':';
       $b4=round(($d2[4][$k2]*100),2);
       $a4=m_u('涨幅').round(($d2[4][$k2]*100),2).'%';
       $b5=round(($d2[5][$k2]*100),2);
       $a5=m_u('换手').round(($d2[5][$k2]/100),2);
       $b6=round(($d2[6][$k2]/10000),2);
       $a6=m_u('成交额').round(($d2[6][$k2]/10000),2).m_u('万元');
       $b7=round(($d2[12][$k2]/10000),2);
       $a7=m_u('主力流出').round(($d2[12][$k2]/10000),2).m_u('万元');
       $b8=round(($d2[11][$k2]/10000),2);
       $a8=m_u('主力流入').round(($d2[11][$k2]/10000),2).m_u('万元');
       $b11= round(($d2[10][$k2]*100),2);
       $a11=m_u('流入率').round(($d2[10][$k2]*100),2).m_u('%');
       $b9= round(($d2[13][$k2]/10000),2);
       $a9=m_u('主力净流入').round(($d2[13][$k2]/10000),2).m_u('万元');
       $b12= $d2[11][$k2]/$d2[6][$k2]*100;
       $a12=m_u('流入率').round($b12,2).m_u('%');
       $b13= round($d2[13][$k2]/($d2[11][$k2] + $d2[12][$k2])*100,2);
       $a13=m_u('对比').round($d2[13][$k2]/($d2[11][$k2] + $d2[12][$k2])*100,2).m_u('%');
       $b17=round(($d2[17][$k2]*100),2);
       $a17=m_u('R0比').round(($d2[17][$k2]*100),2).m_u('%');
       $b18=round(($d2[18][$k2]*100),2);
       $a18=m_u('R3比').round(($d2[18][$k2]*100),2).m_u('%');
     if($b11 >= "5" and  $b11 <= "15") $a11='<font color=#fd2a05>'.$a11.'</font>';else $a11=$a11;
     if($b11 >= "15" ) $a11='<font color=#ee82ee>'.$a11.'</font>';else $a11=$a11;
     if($b11 >= "5" and  $b11 <= "15") $a13='<font color=#fd2a05>'.$a13.'</font>';else $a13=$a13;
     if($b11 >= "15" ) $a13='<font color=#ee82ee>'.$a13.'</font>';else $a13=$a13;
     if($b11 >= "5" and  $b11 <= "15") $a17='<font color=#fd2a05>'.$a17.'</font>';else $a17=$a17;
     if($b11 >= "15" ) $a17='<font color=#ee82ee>'.$a17.'</font>';else $a17=$a17;
     if($b11 >= "5" and  $b11 <= "15") $a18='<font color=#fd2a05>'.$a18.'</font>';else $a18=$a18;
     if($b11 >= "15" ) $a18='<font color=#ee82ee>'.$a18.'</font>';else $a18=$a18;
       //$a10=$d2[3][$k2];
        $ud=''.$a3.'&nbsp;('.$a2.')&nbsp;&nbsp;&nbsp;&nbsp;'.$a4.'&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a11.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a17.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a18.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a13.'';
       //$vd=Current(explode('?',$v2));
if( $b17>$t and $b13>1) $ud1= $ud ;
//if( $b17>$t and $b13>1 and $b12>8) $ud1= $ud ;
//if($u==0) $ud2= $ud1;else $ud2=$ud1;
    $xml ='<a>'.$ud1.'</a>';
echo $xml;
}}}
function zxyb($url) {//新浪研报
        $wk= array( "ratioamount","changeratio","netamount","r0_net");
        $w = $_GET['w']?$_GET['w']:0;
        $wnk= $wk[$w];
        $p = $_GET['p']?$_GET['p']:3;
    for($i=1;$i<=$p;$i++){
       $ul1='http://vip.stock.finance.sina.com.cn/q/go.php/vReport_List/kind/lastest/index.phtml?p='.$i;
       $ul2='http://vip.stock.finance.sina.com.cn/q/go.php/vReport_List/kind/search/index.phtml?t1=2&symbol='.$w.'&pubdate=&p=1';
   if($w>=50) $ul=$ul2;else $ul=$ul1;
       $ut2 = m_v($ul);
preg_match_all('|<td class="tal f14">(.*)<a target="_blank" title="([^<]+)" href="([^<]+)">([^<]+)</a>(.*)</td>(.*)<td>([^<]+)</td>(.*)<td>([^<]+)</td>|ismU',$ut2,$d2);
preg_match_all('|<div class="fname"><span>([^<]+)</span>|ismU',$ut2,$d3);
foreach ($d2[1] as $k2=>$v2){
       $a2=m_u($d2[2][$k2]);
       $a3=$d2[3][$k2];
       $a4=m_u($d2[7][$k2]);
       $a5=$d2[9][$k2];
       $a6=m_u($d3[1][$k2]);
       $ud=$a3;
       $vd=Current(explode('?',$v2));
       $xml ='<a href="'.$ud.'" target="_blank">'.$a2.' ('.$a4.')('.$a6.') ('.$a5.')</a>';
echo $xml;
}}}
function ssdd($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $p=$_GET['p']? $_GET['p']: "1";
        $a = $_GET['a']?$_GET['a']:"100";
        $t = $_GET['t']?$_GET['t']:date("d");
        $udk= "";
        $wnk= $wk[$w];
        $unk= $uk[$u];
        $aa=$a * 100;
        $nday=dtime($t);
     if($wnk=="ticktime") $uu=$u;else $uu=$unk;
        $ww=substr($uu,0,1);
     if($ww =="6") $ss='sh';else $ss='sz';
     $sss=$ss.$uu;
     if($wnk=="ticktime") $udk=$sss;else $udk=$unk;//字符串字数
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;$i++){
     if($wnk=="ticktime") $aaa=$aa;
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol='.$udk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&amount=0&type=0&day='.$nday.'';
       $ul3 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sh600000&num=60&page=1&sort=ticktime&asc=0&volume=0&amount=500000&type=0&day=2019-05-24';
       $ul1 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&type='.$udk.'&dpc=1';
       $ul21 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sh603077&num=60&page=1&sort=ticktime&asc=0&volume=50000&amount=0&type=0&day=2020-09-08';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $ut = J_d(m_v($ul),ture);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["symbol"];
       $a2 = m_u($a0["name"]).'&nbsp;';
       $a3 = $a0["ticktime"];
       $a4 = $a0["price"];
       $a5 = $a0["volume"]/100;
       $a6 = $a0["prev_price"];
       $a7 = $a0["kind"];
       $w6=m_u('<font color=#cc0200>买盘</font>');
       $w0=m_u('<font color=#cc03ff>集合竞价</font>');
 if($a3<="09:29:59") $w6=$w0;else $w6=$w6;
 if($a3>="14:56:59") $w6=$w0;else $w6=$w6;
       $w7=m_u('<font color=#00cc00>卖盘</font>');
 if($a3<="09:29:59") $w7=$w0;else $w7=$w7;
 if($a3>="14:56:59") $w7=$w0;else $w7=$w7;
       $w8=m_u('中性');
 if($a3<="09:29:59") $w8=$w0;else $w8=$w8;
 if($a3>="14:56:59") $w8=$w0;else $w8=$w8;
       $b7="";
 if($a7=="D") $b7=$w7;else if($a7=="U") $b7=$w6;else $b7=$w8;
       $w0='%';
       $w1=m_u('时间：');
       $w2=m_u('成交价');
       $w3=m_u('成交量');
       $w4=m_u('上一笔价格');
       $w5=m_u('买卖性质');
       $w8=m_u('(万股)');
       $w9=m_u('(手)');
       $ud=''.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$a5.''.$w9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b7.'&nbsp;&nbsp;';
      $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ssdd1($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $p=$_GET['p']? $_GET['p']: "1";
        $a = $_GET['a']?$_GET['a']:"100";
        $t = $_GET['t']?$_GET['t']:date("d");
        $udk= "";
        $wnk= $wk[$w];
        $unk= $uk[$u];
        $aa=$a * 100;
        $nday=dtime($t);
     if($wnk=="ticktime") $uu=$u;else $uu=$unk;
        $ww=substr($uu,0,1);
     if($ww =="6") $ss='sh';else $ss='sz';
     $sss=$ss.$uu;
     if($wnk=="ticktime") $udk=$sss;else $udk=$unk;//字符串字数
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;$i++){
     if($wnk=="ticktime") $aaa=$aa;
       $ul21 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol='.$udk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&amount=0&type=0&day='.$nday.'';
       $ul3 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sh600000&num=60&page=1&sort=ticktime&asc=0&volume=0&amount=500000&type=0&day=2019-05-24';
       $ul1 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&type='.$udk.'&dpc=1';
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sh603077&num=60&page=1&sort=ticktime&asc=0&volume=50000&amount=0&type=0&day=2020-09-08';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all('|symbol:"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|name:"([^<]+)"|ismU',$ut,$d2);
preg_match_all('|ticktime:"([^<]+)"|ismU',$ut,$d3);
preg_match_all('|price:"([^<]+)"|ismU',$ut,$d4);
preg_match_all('|volume:"([^<]+)"|ismU',$ut,$d5);
preg_match_all('|prev_price:"([^<]+)"|ismU',$ut,$d6);//上一笔
preg_match_all('|kind:"([^<]+)"|ismU',$ut,$d7);//买卖
foreach ($d1[1] as $k=>$v){
       $a1=$d1[1][$k];
       $a2=m_u($d2[1][$k]).'&nbsp;';
       $a3=$d3[1][$k];
       $a4=$d4[1][$k];
       $a5=$d5[1][$k]/100;
       $a6=$d6[1][$k];
       $a7=$d7[1][$k];
       $w6=m_u('<font color=#cc0200>买盘</font>');
       $w0=m_u('<font color=#cc03ff>集合竞价</font>');
 if($a3<="09:29:59") $w6=$w0;else $w6=$w6;
 if($a3>="14:56:59") $w6=$w0;else $w6=$w6;
       $w7=m_u('<font color=#00cc00>卖盘</font>');
 if($a3<="09:29:59") $w7=$w0;else $w7=$w7;
 if($a3>="14:56:59") $w7=$w0;else $w7=$w7;
       $w8=m_u('中性');
 if($a3<="09:29:59") $w8=$w0;else $w8=$w8;
 if($a3>="14:56:59") $w8=$w0;else $w8=$w8;
       $b7="";
 if($a7=="D") $b7=$w7;else if($a7=="U") $b7=$w6;else $b7=$w8;
       $w0='%';
       $w1=m_u('时间：');
       $w2=m_u('成交价');
       $w3=m_u('成交量');
       $w4=m_u('上一笔价格');
       $w5=m_u('买卖性质');
       $w8=m_u('(万股)');
       $w9=m_u('(手)');
       $ud=''.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$a5.''.$w9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b7.'&nbsp;&nbsp;';
      $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ssdd0($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $p=$_GET['p']? $_GET['p']: "1";
        $a = $_GET['a']?$_GET['a']:"100";
        $t = $_GET['t']?$_GET['t']:date("d");
        $udk= "";
        $wnk= $wk[$w];
        $unk= $uk[$u];
        $aa=$a * 100;
        $nday=stime($t);
     if($wnk=="ticktime") $uu=$u;else $uu=$unk;
        $ww=substr($uu,0,1);
     if($ww =="6") $ss='sh';else $ss='sz';
     $sss=$ss.$uu;
     //if($ww=='60'|| $ww=='68') $ss='sh'.$uu;else $ss='sz'.$uu;
     if($wnk=="ticktime") $udk=$sss;else $udk=$unk;//字符串字数
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
    for($i=1;$i<=$p;$i++){
     //if(strlen($u)<3) $aa=$aa;
     if($wnk=="ticktime") $aaa=$aa;
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol='.$udk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&amount=0&type=0&day='.$nday.'';
       $ul3 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sh600000&num=60&page=1&sort=ticktime&asc=0&volume=0&amount=500000&type=0&day=2019-05-24';
       $ul1 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aaa.'&type='.$udk.'&dpc=1';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all('|symbol:"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|name:"([^<]+)"|ismU',$ut,$d2);
preg_match_all('|ticktime:"([^<]+)"|ismU',$ut,$d3);
preg_match_all('|price:"([^<]+)"|ismU',$ut,$d4);
preg_match_all('|volume:"([^<]+)"|ismU',$ut,$d5);
preg_match_all('|prev_price:"([^<]+)"|ismU',$ut,$d6);//上一笔
preg_match_all('|kind:"([^<]+)"|ismU',$ut,$d7);//买卖
foreach ($d1[1] as $k=>$v){
       $a1=$d1[1][$k];
       $a2=m_u($d2[1][$k]).'&nbsp;';
       $a3=$d3[1][$k];
       $a4=$d4[1][$k];
       $a5=$d5[1][$k]/100;
       $a6=$d6[1][$k];
       $a7=$d7[1][$k];
       $w6=m_u('<font color=#cc0200>买盘</font>');
       $w0=m_u('<font color=#cc03ff>集合竞价</font>');
 if($a3<="09:29:59") $w6=$w0;else $w6=$w6;
 if($a3>="14:56:59") $w6=$w0;else $w6=$w6;
       $w7=m_u('<font color=#00cc00>卖盘</font>');
 if($a3<="09:29:59") $w7=$w0;else $w7=$w7;
 if($a3>="14:56:59") $w7=$w0;else $w7=$w7;
       $w8=m_u('中性');
 if($a3<="09:29:59") $w8=$w0;else $w8=$w8;
 if($a3>="14:56:59") $w8=$w0;else $w8=$w8;
       $b7="";
 if($a7=="D") $b7=$w7;else if($a7=="U") $b7=$w6;else $b7=$w8;
       $w0='%';
       $w1=m_u('时间：');
       $w2=m_u('成交价');
       $w3=m_u('成交量');
       $w4=m_u('上一笔价格');
       $w5=m_u('买卖性质');
       $w8=m_u('(万股)');
       $w9=m_u('(手)');
       $ud=''.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$a5.''.$w9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b7.'&nbsp;&nbsp;';
      $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ddxx5($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $a = $_GET['a']?$_GET['a']:'1000';
        $wnk= $wk[$w];
        $unk= $uk[$u];
        $aa=$a * 100;
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $tday= date("Y").'-'.date("m").'-'.date("d");
        $week = date('w', strtotime(''.$tday.''));
        $t = $_GET['t']?$_GET['t']:$day;
      if($week=="6") $t=$t-1;else if($week=="0")  $t=$t-2;else $t=$t;
        $nt=$mon.'-'.$t;
        $nday = $year.'-'.$nt;
if(stripos($t,'-') !== false) $nday=$year.'-'.$t;else $nday = $year.'-'.$nt;
if($t>1300) $nday=$t;else $nday = $nday;
        $ww=substr($u,0,2);
     if($ww=='60'|| $ww=='68') $ss='sh'.$u;else $ss='sz'.$u;
     if(strlen($u)>3) $unk=$ss;else $unk=$unk;
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
       $p=$_GET['p']? $_GET['p']: "1";
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?symbol='.$unk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&amount=0&type=0&day='.$nday.'';
     if(strlen($u)<3) $aa=$aa;else $aa="0";
       $ul1 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&type='.$unk.'&dpc=1';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $aa = J_d(m_v($ul),True);
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["symbol"];
       $a2 = m_u($a0["name"]);
       $a3 = $a0["opendate"];
       $a4 = $a0["minvol"]*100;
       $a5 = $a0["voltype"]*100;
       $a6 = $a0["totalvol"]/100000;
       $b6=round($a6,2);
       $a7 = $a0["totalvolpct"]/10000;
       $b7=round($a7,2);
       $a8 = $a0["totalamt"]/10000;
    if($a0["totalamt"]<1) $a8=1;else $a8=$a8;
       $b8=round($a8,2);
       $a9 = $a0["totalamtpct"]/10000;
    if($a0["totalamtpct"]<1) $a9=1;else $a9=$a9;
       $a10 = $a0["avgprice"]/10000;
       $b10=round($a10,2);
       $a11 = $a0["kuvolume"]/10000;
       $b11=round($a11,2);
       $b12=$a8/$a9*100;
       $b13=round($b12,2);
       $a12 = $a0["kuamount"];
       $a13 = $a0["kevolume"];
       $a14 = $a0["keamount"];
       $a15 = $a0["kdvolume"];
       $a16 = $a0["kdamount"];
       $a17 = $a0["stockvol"];
       $a18 = $a0["stockamt"];
       $w0='%';
       $w1=m_u('大单量');
       $w2=m_u('大量比');
       $w3=m_u('主买额');
       $w4=m_u('主卖额');
       $w5=m_u('(万手)');
       $w6=m_u('大单额');
       $w7=m_u('大额比');
       $w8=m_u('总量');
       $w9=m_u('总额');
       $w10=m_u('万元');
       $w11=m_u('买卖比');
     if($b13 >= 105 ) $w11='<font color=#cc0100>'.$w11.'</font>';else $w11=$w11;
     if($b13 >= "105" and  $b13 <= "150") $b13='<font color=#fd2a05>'.$b13.'</font>';else $b13=$b13;
     if($b13 >= "150" ) $b13='<font color=#ee82ee>'.$b13.'</font>';else $b13=$b13;
       $ud=''.$a3.': '.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;'.$w1.'&nbsp;'.$b6.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.'&nbsp;'.$b7.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.'&nbsp;'.$a5.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$b8.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$b9.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w11.'&nbsp;'.$b13.''.$w0.'';
     /*if($b9 >= $u ) $ud1=$ud;else $ud1=null; 
     if($b11 >= 50 ) $ud2=$ud1;else $ud2=null;
     if($b11 <= $t ) $ud=$ud2;else $ud=null;*/
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ddxx($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        //$tk= array( "0","1","2","3","4","5","6","7");
        //$ak= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $a = $_GET['a']?$_GET['a']:'1000';
        $wnk= $wk[$w];
        $unk= $uk[$u];
        //$ank= $ak[$a];
        $aa=$a * 100;
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $tday= date("Y").'-'.date("m").'-'.date("d");
        $week = date('w', strtotime(''.$tday.''));
        $t = $_GET['t']?$_GET['t']:$day;
      if($week=="6") $t=$t-1;else if($week=="0")  $t=$t-2;else $t=$t;
        $nt=$mon.'-'.$t;
        $nday = $year.'-'.$nt;
if(stripos($t,'-') !== false) $nday=$year.'-'.$t;else $nday = $year.'-'.$nt;
if($t>1300) $nday=$t;else $nday = $nday;
        $ww=substr($u,0,2);
     if($ww=='60'|| $ww=='68') $ss='sh'.$u;else $ss='sz'.$u;
     if(strlen($u)>3) $unk=$ss;else $unk=$unk;
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
       $p=$_GET['p']? $_GET['p']: "1";
    for($i=1;$i<=$p;$i++){
       $ul2 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?symbol='.$unk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&amount=0&type=0&day='.$nday.'';
     if(strlen($u)<3) $aa=$aa;else $aa="0";
       $ul1 ='https://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&type='.$unk.'&dpc=1';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $ut = J_d(m_v($ul),ture);
       $aa = $ut;
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["symbol"];
       $a2 = m_u($a0["name"]);
       $a3 = $a0["opendate"];
       $a4 = $a0["minvol"]*100;
       $a5 = $a0["voltype"]*100;
       $a6 = $a0["totalvol"]/100000;//大单成交量
       $b6=round($a6,2);
       $a7 = $a0["totalvolpct"]/10000;
       $b7=round($a7,2);
       $a8 = $a0["totalamt"]/10000;
    if($a8<1) $a8=1;else $a8=$a8;
       $b8=round($a8,2);
       $a90 = $a0["totalamtpct"];
       $a10 = $a0["avgprice"]/10000;
       $b10=round($a10,2);
       $a11 = $a0["kuvolume"]/10000;
       $b11=round($a11,2);
       $a12 = $a0["kuamount"];
       $a13 = $a0["kevolume"];
       $a14 = $a0["keamount"];
       $a15 = $a0["kdvolume"];
       $a16 = $a0["kdamount"]/10000;
       $a9 =$a16;
    if($a9<1) $a9=1;else $a9=$a9;
       $b9=round($a9,2);
       $a17 = $a0["stockvol"];
       $a18 = $a0["stockamt"];
       $b12=$a8/$a9*100;
       $b13=round($b12,2);
       $w0='%';
       $w1=m_u('大单量');
       $w2=m_u('大量比');
       $w3=m_u('主买额');
       $w4=m_u('主卖额');
       $w5=m_u('(万手)');
       $w6=m_u('大单额');
       $w7=m_u('大额比');
       $w8=m_u('总量');
       $w9=m_u('总额');
       $w10=m_u('万元');
       $w11=m_u('买卖比');
     if($b13 >= 105 ) $w11='<font color=#cc0100>'.$w11.'</font>';else $w11=$w11;
     if($b13 >= "105" and  $b13 <= "150") $b13='<font color=#fd2a05>'.$b13.'</font>';else $b13=$b13;
     if($b13 >= "150" ) $b13='<font color=#ee82ee>'.$b13.'</font>';else $b13=$b13;

       $ud=''.$a3.': '.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;'.$w1.'&nbsp;'.$b6.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.'&nbsp;'.$b7.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.'&nbsp;'.$a5.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$b8.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$b9.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w11.'&nbsp;'.$b13.''.$w0.'';
      if($a4 > 30 and $b12>105)  $ud1=$ud;else if($a4 > 30 and $b12<30) $ud1=$ud;
      $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud1.'</a>';
echo $xml;
}}}
function ddxx1($url) {
        $wk= array( "ticktime","totalamt","totalvol","totalvolpct","totalamtpct","kuvolume","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        //$tk= array( "0","1","2","3","4","5","6","7");
        //$ak= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:'0';
        $a = $_GET['a']?$_GET['a']:'1000';
        $wnk= $wk[$w];
        $unk= $uk[$u];
        //$ank= $ak[$a];
        $aa=$a * 100;
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $tday= date("Y").'-'.date("m").'-'.date("d");
        $week = date('w', strtotime(''.$tday.''));
        $t = $_GET['t']?$_GET['t']:$day;
      if($week=="6") $t=$t-1;else if($week=="0")  $t=$t-2;else $t=$t;
        $nt=$mon.'-'.$t;
        $nday = $year.'-'.$nt;
if(stripos($t,'-') !== false) $nday=$year.'-'.$t;else $nday = $year.'-'.$nt;
if($t>1300) $nday=$t;else $nday = $nday;
        $ww=substr($u,0,2);
     if($ww=='60'|| $ww=='68') $ss='sh'.$u;else $ss='sz'.$u;
     if(strlen($u)>3) $unk=$ss;else $unk=$unk;
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
       $p=$_GET['p']? $_GET['p']: "1";
    for($i=1;$i<=$p;$i++){
       $ul2 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?symbol='.$unk.'&num=60&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&amount=0&type=0&day='.$nday.'';
     if(strlen($u)<3) $aa=$aa;else $aa="0";
       $ul1 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$aa.'&type='.$unk.'&dpc=1';
     if(strlen($u)>3) $ul=$ul2;else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all('|symbol:"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|name:"([^<]+)"|ismU',$ut,$d2);
//preg_match_all('|ticktime:"([^<]+)"|ismU',$ut,$d0);
preg_match_all('|opendate:"([^<]+)"|ismU',$ut,$d3);
preg_match_all('|minvol:"([^<]+)"|ismU',$ut,$d4);
preg_match_all('|voltype:"([^<]+)"|ismU',$ut,$d5);
preg_match_all('|totalvol:"([^<]+)"|ismU',$ut,$d6);//大单成交量
preg_match_all('|totalvolpct:"([^<]+)"|ismU',$ut,$d7);//成交量占比
preg_match_all('|totalamt:"([^<]+)"|ismU',$ut,$d8);//大单成交额
preg_match_all('|totalamtpct:"([^<]+)"|ismU',$ut,$d9);//成交额占比
preg_match_all('|avgprice:"([^<]+)"|ismU',$ut,$d10);
preg_match_all('|kuvolume:"([^<]+)"|ismU',$ut,$d11);//主买量
preg_match_all('|kuamount:"([^<]+)"|ismU',$ut,$d12);//主买额
preg_match_all('|kevolume:"([^<]+)"|ismU',$ut,$d13);//中性量
preg_match_all('|keamount:"([^<]+)"|ismU',$ut,$d14);//中性额
preg_match_all('|kdvolume:"([^<]+)"|ismU',$ut,$d15);//主卖量
preg_match_all('|kdamount:"([^<]+)"|ismU',$ut,$d16);//主卖额
preg_match_all('|stockvol:"([^<]+)"|ismU',$ut,$d17);//总量
preg_match_all('|stockamt:"([^<]+)"|ismU',$ut,$d18);//总额
foreach ($d1[1] as $k=>$v){
       $a1=$d1[1][$k];
       $a2=m_u($d2[1][$k]);
       $a3=$d3[1][$k];
       $a4=$d7[1][$k]*100;
       $a5=$d9[1][$k]*100;
       $a6=$d6[1][$k]/100000;
       $b6=round($a6,2);
       $a7=$d8[1][$k]/10000;
       $b7=round($a7,2);
       $a8=$d12[1][$k]/10000;
    if($d12[1][$k]<1) $a8=1;else $a8=$a8;
       $b8=round($a8,2);
       $a9=$d16[1][$k]/10000;
    if($d16[1][$k]<1) $a9=1;else $a9=$a9;
       $b9=round($a9,2);
       $a10=$d17[1][$k]/10000;
       $b10=round($a10,2);
       $a11=$d18[1][$k]/10000;
       $b11=round($a11,2);
       $b12=$a8/$a9*100;
       $b13=round($b12,2);
       $w0='%';
       $w1=m_u('大单量');
       $w2=m_u('大量比');
       $w3=m_u('主买额');
       $w4=m_u('主卖额');
       $w5=m_u('(万手)');
       $w6=m_u('大单额');
       $w7=m_u('大额比');
       $w8=m_u('总量');
       $w9=m_u('总额');
       $w10=m_u('万元');
       $w11=m_u('买卖比');
     if($b13 >= 105 ) $w11='<font color=#cc0100>'.$w11.'</font>';else $w11=$w11;
     if($b13 >= "105" and  $b13 <= "150") $b13='<font color=#fd2a05>'.$b13.'</font>';else $b13=$b13;
     if($b13 >= "150" ) $b13='<font color=#ee82ee>'.$b13.'</font>';else $b13=$b13;
       $ud=''.$a3.': '.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;'.$w1.'&nbsp;'.$b6.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a4.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.'&nbsp;'.$b7.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.'&nbsp;'.$a5.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$b8.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$b9.''.$w10.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w11.'&nbsp;'.$b13.''.$w0.'';
      if($a4 > 30 and $b12>105)  $ud1=$ud;else if($a4 > 30 and $b12<30) $ud1=$ud;
      $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud1.'</a>';
echo $xml;
}}}
function ddfx($url) {
        $wk= array("ticktime","totalvolpct","kuvolume","totalamtpct","stockvol");
        $uk= array( "0","1","2","3","4","5","6","7");
        $w = $_GET['w']?$_GET['w']:0;
        $u = $_GET['u']?$_GET['u']:0;
        $t = $_GET['t']?$_GET['t']:'2000';
        $t2=$t*100;
        $wnk= $wk[$w];
        $unk= $uk[$u];
     if($w <= '4') $wnk=$wnk;else $wnk=$w;
        $year = date("Y");
        $mon = date("m");
        $day = date("d");
        $nt=$mon.'-'.$day;
        $nday = $year.'-'.$nt;
        $p=$_GET['p']? $_GET['p']: "1";
    for($i=1;$i<=$p;$i++){
        $ul1 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&asc=0&dpc=1&sort='.$wnk.'&volume='.$p2.'&type=0&day='.$nday.'';
       $ul2 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&sort=kuvolume&asc=0&volume=0&type=1&dpc=1';
       $ul3 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillList?symbol=sz002136&num=60&page='.$i.'&sort=ticktime&asc=0&volume=40000&amount=0&type=0&day=2018-01-19';
       $ul4 ='http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/CN_Bill.GetBillSum?num=100&page='.$i.'&sort='.$wnk.'&asc=0&volume='.$t2.'&type='.$unk.'&dpc=1';
   if($t!== '0') $ul=$ul2;else  $ul=$ul1;
       $ut = f_g($ul4);
preg_match_all('|symbol:"([^<]+)",name:"([^<]+)",opendate:"([^<]+)",minvol:"([^<]+)",voltype:"([^<]+)",totalvol:"([^<]+)",totalvolpct:"([^<]+)",totalamt:"([^<]+)",totalamtpct:"([^<]+)",avgprice:"([^<]+)",kuvolume:"([^<]+)",kuamount:"([^<]+)",kevolume:"([^<]+)",keamount:"([^<]+)",kdvolume:"([^<]+)",kdamount:"([^<]+)",stockvol:"([^<]+)",stockamt:"([^<]+)"|ismU',$ut,$d);
preg_match_all('|symbol:"([^<]+)",name:"([^<]+)",opendate:"([^<]+)",minvol:"([^<]+)",voltype:"([^<]+)",totalvol:"([^<]+)",totalvolpct:"([^<]+)",totalamt:"([^<]+)",totalamtpct:"([^<]+)",avgprice:"([^<]+)",kuvolume:"([^<]+)",kuamount:"([^<]+)",kevolume:"([^<]+)",keamount:"([^<]+)",kdvolume:"([^<]+)",kdamount:"([^<]+)",stockvol:"([^<]+)",stockamt:"([^<]+)"|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=m_u($d[2][$k]);
       $a3=$d[3][$k];
       $a4=$d[7][$k]*100;
       $a5=$d[9][$k]*100;
       $a6=$d[11][$k]/10000;
       $b6=round($a6,2);
       $a7=$d[13][$k]/10000;
       $b7=round($a7,2);
       $a8=$d[15][$k]/10000;
       $b8=round($a8,2);
       $a9=$d[11][$k]/$d[15][$k];
       $b9=round($a9,2);
       $a10=$a6-$d[15][$k]/10000;
       $b10=round($a10,2);
       $b11=round($b10/$b6*100,2);
       $w0='%';
       $w1=m_u('大单占比');
       $w2=m_u('成交额占比');
       $w3=m_u('主买量');
       $w4=m_u('主卖量');
       $w5=m_u('(万手)');
       $w6=m_u('买卖比');
       $w7=m_u('差');
       $w8=m_u('总单');
       $w9=m_u('成交额');
       $w10=m_u('差比');
       $ud=''.$a3.': '.$a2.' ('.$a1.')&nbsp;&nbsp;&nbsp;'.$w1.'&nbsp;'.$a4.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$a5.''.$w0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$b6.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$b8.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w6.'&nbsp;'.$b9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.'&nbsp;'.$b10.''.$w5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w10.'&nbsp;'.$b11.'';
     if($b9 >= $u ) $ud1=$ud;else $ud1=null; 
     if($b11 >= 50 ) $ud2=$ud1;else $ud2=null;
     if($b11 <= $t ) $ud=$ud2;else $ud=null;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function mbcj($url) {//每笔成交
       $w = $_GET['w']?$_GET['w']:1; 
       $ul1='http://data.stcn.com/common/data/fiveDayTurnVolume/fsFiveDayTurnvolumeMore.html';
       $ul2='http://data.stcn.com/common/data/fiveDayTurnVolume/chinexDayMore.html';
   if ($w == '1')  $ul=$ul1;else  $ul=$ul2;
       $ut2 = m_v($ul);
preg_match_all('|<tr><td >([^<]+)</td><td >([^<]+)</td><td >([^<]+)</td><td >([^<]+)</td><td >([^<]+)</td><td >([^<]+)</td><td >([^<]+)</td></tr>|ismU',$ut2,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=m_u($d[2][$k]);
       $a3=$d[3][$k];
       $a4=$d[4][$k];
       $a5=$d[5][$k];
       $a6=$d[6][$k];
       $a7=$d[7][$k];
       $b3=$a3/$a7*100;
       $c3=round($b3,2);
       $b4=$a4/$a7*100;
       $c4=round($b4,2);
       $b5=$a5/$a7*100;
       $c5=round($b5,2);
       $b6=$a6/$a7*100;
       $c6=round($b6,5);
     if($c3>= 150 ) $d3=$b3;else $d3='';
     if($c4>= 150 ) $d4=$b4;else $d4='';
     if($c5>= 150 ) $d5=$b5;else $d5='';
     if($c6>= 150 ) $d6=$b6;else $d6='';
     if($c3<=60 ) $d7=$b3;else $d7='';
     if($c4<=60 ) $d8=$b4;else $d8='';
     if($c4<=60 and $c3<=60 ) $d9=$b3;else $d9=$b4;
       $w1=m_u('比值');
       $w2=m_u('今比');
       $w3=m_u('昨比');
       $w4=m_u('昨放');
       $w5=m_u('今放');
       $w6=m_u('日');
       $w7=m_u('前比');
       $w8=m_u('前放');
       $w9=m_u('缩量');
       $day = date("d");
       $day2=$day-1;
       $day3=$day-2;
       $day4=$day-3;
       $day5=$day-4;
$ud=''.$a2.'&nbsp;&nbsp;'.$a1.'&nbsp;&nbsp;&nbsp;&nbsp;'.$day.''.$w6.'&nbsp;'.$a3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$day2.''.$w6.'&nbsp;'.$a4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$day3.''.$w6.'&nbsp;'.$a5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$day4.''.$w6.'&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;'.$day5.''.$w6.'&nbsp;'.$a7.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w7.'&nbsp;'.$c5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$w3.'&nbsp;'.$c4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w2.'&nbsp;'.$c3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w8.'&nbsp;'.$d5.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w4.'&nbsp;'.$d4.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w5.'&nbsp;'.$d3.'&nbsp;&nbsp;&nbsp;&nbsp;'.$w9.'&nbsp;'.$d7.'';
    $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function zdcq($url) {//征地拆迁
       $wk= array( "tdzsly","ydys","gdbhly","tdkfzl","tddc","tddj","tdpg","cfjc","tdsp");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $ws=k_w($w);
   if ($w <= '9')  $ww=$wnk;else $ww=$ws;
       $p = $_GET['p']?$_GET['p']:0;
    for($i=0;$i<=$p;$i++){
       $i1='_'.$i;
   if ($p == '0')  $i2=null;else $i2=$i1;
       $ul1='http://www.mlr.gov.cn/tdgl/'.$ww.'/index'.$i2.'.htm';
       $ul2='http://s.mlr.gov.cn/search/search.do?webid=1&pg=12&p=$i&tpl=&uid=&category=&q='.$ww.'&pos=title%2Ccontent&od=2&date=&date=&criteria_xzqh=&pq=&oq=&eq=&doctype=';
   if ($w <= '9')  $ul=$ul1;else $ul=$ul2;
       $ut = f_g($ul);
preg_match_all('|<td(.*)class="outlinebig"(.*)>(.*)<a href="./([^<]+)"(.*)>([^<]+)</a></td>(.*)<td(.*)style=(.*)>([^<]+)</td>|ismU',$ut,$d);
preg_match_all('|<div class="jsearch-similarly-item">(.*)<a(.*)href="([^<]+)" class="jsearch-similarly-item-title">([^<]+)</a>(.*)<span class="jsearch-similarly-item-date">([^<]+)</span>|ismU',$ut,$d2);
   if ($w <= '9')  $uld=$d[1];else $uld=$d2[1];
foreach ($uld as $k=>$v){
       $a2=$d[4][$k];
       $a3=m_u($d[6][$k]);
       $a4=$d[10][$k];
       $a6='http://www.mlr.gov.cn/tdgl/tdzsly/'.$a2;
       $a7=$d2[3][$k];
       $a8=m_u($d2[4][$k]);
       $a9=$d2[6][$k];
   if ($w <= '9')  $ud=$a6;else $ud=$a7;
   if ($w <= '9')  $a10=$a3;else $a10=$a8;
   if ($w <= '9')  $a11=$a4;else $a11=$a9;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'">'.$a10.' ('.$a11.')</a>';
echo $xml;
}}}
function shzd($url) {//上海征地
       $wk= array( "/gsgg/zdgg/","/tdgl/zdbc/","/tdgl/zdfwbcgg/","/gsgg/bcfa/","/gsgg/bzsm/","/gsgg/tdcr/","/gsgg/ysqgg/","/gsgg/qtgg/");
       $w = $_GET['w']?$_GET['w']:0;
       $wnk=$wk[$w];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
       $i1='_'.$i;
   if ($p == '0')  $i2=null;else $i2=$i1;
       $ul='http://www.shgtj.gov.cn'.$wnk.'index'.$i2.'.html';
       $ut = m_v($ul);
preg_match_all('|<li><a href="./([^<]+)" target="_blank" title="([^<]+)">([^<]+)</a><font color="gray">([^<]+)</font></li>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=m_u($d[2][$k]);
       $a4=m_u($d[4][$k]);
       $ud='http://www.shgtj.gov.cn'.$wnk.$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$ud.'">'.$a3.' ('.$a4.')</a>';
echo $xml;
}}}
function shxf($url) {//上海信访
       $w = $_GET['w']?$_GET['w']:0;
       $p = $_GET['p']?$_GET['p']:"1";
    for($i=0;$i<=$p;$i++){
       $ul='http://wsxf.sh.gov.cn/xf_rmyjzj/list.aspx?nav=&pageindex='.$i.'&pagesize=20';
       $ut = m_v($ul);
preg_match_all("|<li>(.*)<span>(.*)<\/span>(.*)<span>([^<]+)<\/span>(.*)<a href='([^<]+)'(.*)>([^<]+)<\/a>(.*)<\/span>(.*)<\/li>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[4][$k];
       $a2='http://wsxf.sh.gov.cn/xf_rmyjzj/'.$d[6][$k];
       $a3=m_u($d[8][$k]);
       $ud=$a2;
       $vd=Current(explode('?',$v));
       $xml ='<a href="'.$a2.'">'.$a3.' ('.$a1.')</a>';
echo $xml;
}}}
function ycj2($url) {//云财经tag
       $wk= array( "insider","hot_news","get_tag_news","h_news","article","discovery","ybds");
       $tk= array( "1","1","2","3","4","5","6");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
       $wnk = $wk[$w]; 
       $tnk = $tk[$t]; 
    for($i=0;$i<=$p;$i++){
       $ul1='https://m.yuncaijing.com/tag/id_'.$tnk.'.html?page='.$i.'';
       $ul2='https://m.yuncaijing.com/news/get_tag_news/yapi/mobile_v1.html?id='.$tnk.'&page='.$i.'';
       $ul3='http://m.yuncaijing.com/news/'.$wnk.'/yapi/mobile_v1.html?id='.$tnk.'&page='.$i.'';
       $ul4='https://www.yuncaijing.com/news/get_tag_news/yapi/ajax.html?id='.$tnk.'&page='.$i.'';
       $ul5='https://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?id='.$tnk.'&page='.$i.'';
       $ut = m_s($ul3);
preg_match_all('|"title":"([^<]+)"(.*)"description":"([^<]+)"(.*)"inputtime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a3=m_u($d[1][$k]);
       $a4=m_u($d[3][$k]);
       $a5=t_m($d[5][$k]);
       $ud=''.$a5.': '.$a3.'  : (  '.$a4.' )';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ycj4($url) {//云财经tag
       $uk= array( "news/get_realtime_news","news/get_more_vip_news","news/vip_news","news/get_tag_news","news/get_guess_like_news","news/modal","news/get_news_comment","index/get_news","search/get_coms","search/cs","subject/get_news","subject/detail_chart","subject/get_story_info","stock/get_notice","stock/get_news_scan","stock/get_report_list","quotes/get_stock_news","subject/concepts_stocks","stock/get_klines","event/region_view");
       $wk= array( "insider","hot_news","get_tag_news","h_news","article","discovery","ybds");
       $tk= array( "1","1","2","3","4","5","6");
       $w = $_GET['w']?$_GET['w']:"0";
       $ww=k_w($_GET['w'])?k_w($_GET['w']):"题材";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
       $wnk = $wk[$w]; 
       $tnk = $tk[$t]; 
       $unk = $uk[$u]; 
    for($ii=0;$ii<=$p;$ii++){
       $ul='https://www.yuncaijing.com/'.$unk.'/yapi/ajax.html?&title='.$ww.'&name='.$w.'&code='.$w.'&id='.$tnk.'&field=&page='.$ii.'&data='.$ww.'&word='.$ww.'&status=';
       $ul1='http://www.yuncaijing.com/insider/simple.html';
       $ul4='https://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?page=1&yesterday=1';
       $ul2='https://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?&yesterday=1&page='.$ii;
       $ul3='https://www.yuncaijing.com/'.$unk.'/yapi/ajax.html?&yesterday=0&id='.$tnk.'&page='.$ii.'&title='.$ww.'&name='.$w.'&code='.$w.'&data='.$ww.'&word='.$ww.'';
       //$ut = m_v($ul2);
       $ut = J_d(m_v($ul3),True);
       $aa = $ut["data"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a2 = $a0["id"];
       $a5 = m_u($a0["title"]);
       $a6 = m_u($a0["description"]);
       $a7 = m_u($a0["thmtags"]);
       $a8 = $a0["date"];
       $a9 = t_m($a0["inputtime"]);
       $ud2=''.$a8.': '.$a5.' ('.$a6.')('.$a9.')';
    $xml ='<a>'.$ud2.'</a>';
echo $xml;
}}}
function ycj($url) {//云财经
       $wk= array( "insider","get_realtime_news","get_tag_news");
       $tk= array( "1","1","2","3","5","6","8","9","88","91","95");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1";
       $key = "key";
       $wnk = $wk[$w];
       $tnk = $tk[$t];  
    for($ii=1;$ii<=$p;$ii++){
       $ul1='https://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?page='.$ii.'&date=';
       $ul2='http://q.yuncaijing.com/market/getMktIndexMinuteLine/yapi/api_v1.html?key='.$key.'&beginDate=20171229&endDate=20171229&code=600000&field=code,ratio';
       $ul3='http://m.yuncaijing.com/news/'.$wnk.'/yapi/mobile_v1.html?&page='.$ii.'&yesterday=1';
       $ul4='https://www.yuncaijing.com/news/'.$wnk.'/yapi/ajax.html?&page='.$ii.'&id='.$tnk.'&yesterday=1';
       $ul="";
    if($w=='1') $ul=$ul4;else $ul=$ul3;
       $ut = J_d(m_s($ul1),ture);
       //$aa1 = $ut["data"]["news"];
       //$aa2 = $ut["data"];
    if($w=='1') $aa=$ut["data"];else $aa=$ut["data"]["news"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a1 = $a0["id"]; 
       $a2 = m_u($a0["title"]);  
       $a3 = m_u($a0["description"]);  
       $a4 = t_m($a0["inputtime"]);  
       $a5 = $a0["date"];     
       $ud=''.$a4.': '.$a3.' ('.$a2.')';
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ycj0($url) {//云财经tag
       $wk= array( "insider","hot_news","topnews","h_news","article","discovery","ybds");
       $tk= array( "1","1","2","3","4","5","6");
       $w = $_GET['w']?$_GET['w']:"0";
       $t = $_GET['t']?$_GET['t']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
       $key = "key";
       $wnk = $wk[$w];
       $tnk = $tk[$t];  
    for($i=0;$i<=$p;$i++){
       $ul1='http://m.yuncaijing.com/tag/id_'.$tnk.'.html?page='.$i.'';
       $ul2='http://q.yuncaijing.com/market/getMktIndexMinuteLine/yapi/api_v1.html?key='.$key.'&beginDate=20171229&endDate=20171229&code=600000&field=code,ratio';
       $ul3='http://m.yuncaijing.com/news/'.$wnk.'/yapi/mobile_v1.html?&page='.$i.'';
       $ut = m_s($ul3);
preg_match_all('|"title":"([^<]+)"(.*)"description":"([^<]+)"(.*)"inputtime":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a3=m_u($d[1][$k]);
       $a4=m_u($d[3][$k]);
       $a5=t_m($d[5][$k]);
       $ud=''.$a5.': '.$a4.' ('.$a3.')';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ycj40($url) {//云财经tag
       $w = $_GET['w']?$_GET['w']:"";
       $p = $_GET['p']?$_GET['p']:"1";  
    for($i=0;$i<=$p;$i++){
       $ul1='http://www.yuncaijing.com/insider/simple.html';
       $ul2='http://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?page='.$i;
       $ul3='https://www.yuncaijing.com/news/get_realtime_news/yapi/ajax.html?&yesterday=1&page='.$i;
       $ut = m_v($ul3);
preg_match_all('|"id":"([^<]+)","title":"([^<]+)","description":"([^<]+)"(.*)"thmtags":"([^<]+)"(.*)"date":"([^<]+)"|ismU',$ut,$d2);
foreach ($d2[1] as $k=>$v){
       $a2=$d1[2][$k];
       $a3=m_u($d1[6][$k]);
       $a4=m_u($d1[8][$k]);
       $a5=m_u($d2[2][$k]);
       $a6=m_u($d2[3][$k]);
       $a7=m_u($d2[5][$k]);
       $a8=$d2[7][$k];
       $ud1=''.$a2.': '.$a3.' ('.$a4.')';
       $ud2=''.$a8.': '.$a5.' ('.$a6.')('.$a7.')';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud2.'</a>';
echo $xml;
}}}
function ycj5($url) {//云财经tag
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
    for($i=0;$i<=$p;$i++){
       $ul='';
       $ul1='http://m.yuncaijing.com/insider/main.html';
       $ul2='http://m.yuncaijing.com/stock/get_quote_new/yapi/ajax.html?id=1&page='.$i;
       $ul3='http://m.yuncaijing.com/news/insider/yapi/mobile_v1.html?id=1&page='.$i;
    if($p>1) $ul=$ul3;else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all('|<time data-time="([^<]+)">([^<]+)</time>(.*)<p(.*)class="before "(.*)>(.*)<a class="direct"(.*)>([^<]+)</a>([^<]+)</span>|ismU',$ut,$d1);
preg_match_all('|"id":"([^<]+)","title":"([^<]+)","description":"([^<]+)"(.*)"date":"([^<]+)",|ismU',$ut,$d2);
    if($p>1) $d=$d2;else $d=$d1;
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a3=m_u($d[8][$k]);
       $a4=m_u($d[9][$k]);
       $a5=m_u($d2[2][$k]);
       $a6=m_u($d2[3][$k]);
       $a7=$d2[5][$k];
       $ud1=''.$a2.': '.$a3.' ('.$a4.')';
       $ud2=''.$a7.': '.$a5.' ('.$a6.')';
    if($p>1) $ud=$ud2;else $ud=$ud1;
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}}
function ycjn($url) {//云财经公告
       $uk= array( "stock/get_notice","stock/get_news_scan","stock/get_report_list","quotes/get_stock_news","subject/concepts_stocks","index/get_news","stock/get_klines",
"news/get_more_vip_news","news/vip_news","news/get_realtime_news","news/get_tag_news","news/get_guess_like_news","search/get_coms","search/cs","news/modal",
"subject/get_news","subject/detail_chart","subject/get_story_info","event/region_view","news/get_news_comment");
       $w=$_GET['w']?$_GET['w']:"600000";
       $ww=k_w($_GET['w'])?k_w($_GET['w']):"题材";
       $u = $_GET['u']?$_GET['u']:0; 
       $t = $_GET['t']?$_GET['t']:1; 
       $p = $_GET['p']?$_GET['p']:1; 
       $unk = $uk[$u]; 
    for($i=0;$i<=$p;$i++){
       $ul='https://www.yuncaijing.com/'.$unk.'/yapi/ajax.html?&title='.$ww.'&name='.$w.'&code='.$w.'&id='.$t.'&field=&page='.$i.'&data='.$ww.'&word='.$ww.'&status=';
       $ul1='https://m.yuncaijing.com/news/insider/yapi/mobile_v1.html?id=1&page=1';
       $ut = m_v($ul);
preg_match_all('|"id":"([^<]+)"|ismU',$ut,$d1);
preg_match_all('|"description":"([^<]+)"|ismU',$ut,$d0);
preg_match_all('|"title":"([^<]+)"|ismU',$ut,$d2);
preg_match_all('|"filepath":"([^<]+)"|ismU',$ut,$d3);
preg_match_all('|"date":"([^<]+)"|ismU',$ut,$d4);
preg_match_all('|"datetime":"([^<]+)"|ismU',$ut,$d5);
preg_match_all('|"source_url":"([^<]+)"|ismU',$ut,$d6);
preg_match_all('|"url":"([^<]+)"|ismU',$ut,$d7);
preg_match_all('|<kbd>([^<]+)<|ismU',$ut,$d8);
foreach ($d1[1] as $k=>$v){
       $a1=m_u($d0[1][$k]);
       $a2=$d1[1][$k];
       $a3=m_u($d2[1][$k]);
       $a4=$d3[1][$k].x_g($d6[1][$k]).$d7[1][$k];
       $a5=$d4[1][$k].$d5[1][$k].$d8[1][$k];
       $ud=$a4;
       $utr=''.$a5.' : '.$a1.' ('.$a3.')';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'">'.$utr.'</a>';
echo $xml;
}}}
function gov($url) {//国务院
       $wk= array( "224","225","226","473","474","479");
       $w = $_GET['w']?$_GET['w']:"0";
       $p = $_GET['p']?$_GET['p']:"1"; 
       $wnk = $wk[$w]; 
    for($i=0;$i<=$p;$i++){
       $ul='';
       $ul2='http://www.drc.gov.cn/Json/GetPageDocuments.ashx?chnid=1&leafid='.$wnk.'&page='.$i.'&pagesize=30&sublen=26&sumlen=160&expertid=0&keyword=&experts=&year=0';
       $ut = m_v($ul2);
preg_match_all('|"id":"([^<]+)",|ismU',$ut,$d1);
preg_match_all('|"doccode":"([^<]+)",|ismU',$ut,$d2);
preg_match_all('|"title":"([^<]+)",|ismU',$ut,$d3);
preg_match_all('|"link":"([^<]+)",|ismU',$ut,$d4);
preg_match_all('|"deliveddate":"([^<]+)",|ismU',$ut,$d5);
preg_match_all('|"summary":"([^<]+)",|ismU',$ut,$d6);
foreach ($d1[1] as $k=>$v){
       $a1=$d1[1][$k];
       $a2=m_u($d2[1][$k]);
       $a3=m_u($d3[1][$k]);
       $a4='http://www.drc.gov.cn'.$d4[1][$k];
       $a5=$d5[1][$k];
       $a6=m_u($d6[1][$k]);
       $a7=m_u($d6[1][$k]);
       $ud=''.$a5.': '.$a2.' :'.$a3.'  (id:'.$a1.')';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a4.'">'.$ud.'</a>';
    $xml2 ='<a>'.$ud.'</a>';
echo $xml;
}}}
function gs($url) {//古诗搜索
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=0;$i<=$p;$i++){
       $ul='http://so.gushiwen.org/search.aspx?page='.$i.'&value='.$kw.'';
       $ut2 = m_v($ul);
preg_match_all('|<div class="sons">(.*)<p><a(.*)href="([^<]+)"(.*)>([^<]+)<|ismU',$ut2,$d2);
preg_match_all('|<p style="color(.*)">([^<]+)<|ismU',$ut2,$d1);
preg_match_all('|<span style="(.*)">([^<]+)</span>|ismU',$ut2,$d0);
foreach ($d2[1] as $k2=>$v2){
       $a2=$d2[3][$k2];
       $a3=$d2[5][$k2];
       $a4=$d1[2][$k2];
       $a5=$d0[2][$k2];
       $a6='http://so.gushiwen.org'.$a2;
       $vd=Current(explode('?',$v2));
    //$xml ='<a href="'.$a6.'">'.$a3.'</a>';
    $xml ='<a href="'.$a6.'">'.$a5.'&nbsp;'.$a3.'&nbsp;'.$a4.'&nbsp;----'.$a5.'</a>';
echo $xml;
}}}
function p5w($url) {//全景快讯
       $p = $_GET['p']?$_GET['p']:'0'; 
    for($i=0;$i<=$p;$i++){
   if ($i == '0')  $i=null;else  $i='-'.$i;
       $ul='http://www.p5w.net/kuaixun/tj/index'.$i.'.htm';
       $ut = f_g($ul);
preg_match_all('|<h1><a href="([^<]+)"(.*)>([^<]+)</a></h1>(.*)<div class="setinfo3">([^<]+)</div>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=m_u($d[3][$k]);
       $a4=m_u($d[5][$k]);
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a2.'">'.$a4.'&nbsp;'.$a3.'</a>';
echo $xml;
}}}

function jmso($url) {//鸠摩搜索
       $w = $_GET['w']?$_GET['w']:date("Y");  
       $uk= array("wordsfz_forum","wordsf_ishare");
       $w=k_w($w);
       $u = $_GET['u']?$_GET['u']:0;
       $p = $_GET['p']?$_GET['p']:1;
       $unk=$uk[$u];
    for($i=0;$i<=$p;$i++){
       $ul='https://www.jiumodiary.com/'.$unk.'.php?&q='.$w.'&p='.$i.'';
       $ut = m_v($ul);
preg_match_all('|href="([^<]+)">([^<]+)</a>|ismU',u_d($ut),$d1);
preg_match_all('|"http([^<]+)","([^<]+)",|ismU',u_d($ut),$d2);
     if($u == '1')  $wd=$d2[1];else $wd=$d1[1];
foreach ($wd as $k=>$v){
       $a1=$d1[1][$k];
       $a2=$d1[2][$k];
       $a3=x_g($d2[1][$k]);
       $a4=r_u($d2[2][$k]);
       $a5='http'.$a3;
       $a7='http'.$a1;
     if($u == '0')  $ud=$a1;else $ud=$a5;
     if($u == '0')  $a6=$a2;else $a6=$a4;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'">'.$a6.'</a>';
echo $xml;
}}}
function qxf($url) {//网上信访
       $w = $_GET['w']?$_GET['w']:0;  
       $wk= array("100","101","102","103","104","105","106","107","108","109","110","111","112","113","114","115","116","117","118","119");
       $p = $_GET['p']?$_GET['p']:2;
       $wnk=$wk[$w];
    for($i=0;$i<=$p;$i++){
       $ul='http://qxf.sh.gov.cn/310'.$wnk.'/reply.setInit.do?page='.$i.'';
       $ut = f_g($ul);
preg_match_all('|<tr class="tableTr">(.*)<td title="([^<]+)">(.*)<a target="_blank" href="([^<]+)">([^<]+)</a>(.*)</td>(.*)<td title="([^<]+)">(.*)</td>(.*)<td>([^<]+)</td>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a1=$d[2][$k];
       $a2=$d[4][$k];
       $a3='http://qxf.sh.gov.cn'.$a2;
       $a4=$d[5][$k];
       $a5=$d[8][$k];
       $a6=$d[11][$k];
       $ud=$a3;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'">'.$a6.'  : '.$a1.' &nbsp;&nbsp;&nbsp;&nbsp; ( '.$a5.' )</a>';
echo $xml;
}}}


function zm($url) {//字幕搜索
       $ww = $_GET['w']?$_GET['w']:date("Y");
       $w = k_w($ww);
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=0;$i<=$p;$i++){
       $ul='http://www.zimuku.net/search?ad=1&q='.$w.'';
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
function zm2($url) {//字幕搜索
       $w = $_GET['w']?$_GET['w']:date("Y"); 
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
function stxt($url) {//书
       $ww = $_GET['w']?$_GET['w']:'1';
       $w=k_w($ww);
       if($_GET['w'] <= "9") $w1 = '0'.$w;else $w1=$w;
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=0;$i<=$p;$i++){
       $ul1='http://www.sjtxt.com/soft/'.$w.'/Soft_0'.$w1.'_'.$i.'.html';
       $ul2='http://www.sjtxt.com/search.php?s=&searchkey='.$w;
       $ut = m_v($ul1);
preg_match_all('|<u style=(.*)>(.*)<a(.*)href="([^<]+)">([^<]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=$d[4][$k];
       $a4=$d[5][$k];
       $a5='http://www.sjtxt.com'.$a3;
       $a6=d_txt($a5);
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a6.'">'.$a4.'</a>';
echo $xml;
}}}

function d_txt($url) {
       $ut = f_g($url);
preg_match_all("|class=\"downButton\"(.*)href='http([^<]+)'|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a4 = 'http'.$d[2][$k];
       $ua =$a4;
      return $ua;
}}

function jyso($url) {//教育搜索
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=0;$i<=$p;$i++){
       $ul='http://www.shmec.gov.cn/html/xxgk/'.$kw.'.php';
       $ul2='http://www.shmec.gov.cn/web/search_engine2014.php?type=0&startS=852048000&endS=1458835200&range=1&limit=12&like=0&page='.$i.'&topkeyword='.$kw.'';
       $ut2 = m_v($ul2);
preg_match_all('|<div class="newsivs_content" id="ivs_content">(.*)<div class="news_attach">(.*)</font></a><br>(.*)<a href="(.*)" target="_blank" title="(.*)">(.*)</a><br>|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a2=$d2[5][$k2];
       $a3=$d2[6][$k2];
       $a4=$d1[2][$k2];
       $a5=$d0[2][$k2];
       $a6='http://www.shmec.gov.cn/'.$a2;
       $vd=Current(explode('?',$v2));
    $xml ='<a href="'.$a6.'">'.$a2.'</a>';
echo $xml;
}}}
function baidupan($url) {//百度盘
       $w=$_GET["w"]; 
       $ul='http://www.shmec.gov.cn/html/xxgk/'.$w.'.php';
       $ut2 = m_v($w);
preg_match_all('|"status":"([^<]+)","uk":([^<]+),"name":"([^<]+)",|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a2=$d2[2][$k2];
       $a3=r_u($d2[3][$k2]);
       $a6='http://pan.baidu.com/share/home?uk='.$a2.'#category/type=0';
       $vd=Current(explode('?',$v2));
    $xml ='<a href="'.$a6.'">'.$a3.'</a>';
echo $xml;
}}

function apk($url) {//apk搜索
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p=$_GET['p'];
   if($p == '')  $p='1';else if($p == '1')  $p='1'; $p=$p;
    for($i=1;$i<=$p;$i++){
       $ul='';
       $ul1='http://www.apppark.cn/software_search.action?key='.$kw.'&t=2';
       $ul2='http://www.apppark.cn/software_search.action?pageModel.currentPage='.$i.'&key='.$kw.'';
   if ($p == '1')  $ul=$ul1;else  $ul=$ul2;
       $ut = m_v($ul);
preg_match_all('|<li class="app_item">(.*)<div class="app_icon"><a href="([^<]+)" title="([^<]+)">|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=m_u($d[3][$k]);
       $a3=$d[2][$k];
       $a4='http://www.apppark.cn'.$a3;
       $ut2 = m_v($a4);
preg_match_all('|<div class="app_dl clearfix">(.*)<a href="([^<]+)"(.*)class="dl_a"></a>|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a5=$d2[2][$k2];
       $a6='http://www.apppark.cn'.$a5;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a6.'">'.$a2.'</a>';
echo $xml;
}}}}


function gaot($url) {//港澳台搜索
       $w=$_GET['w'];
   if($w == '') $w='cjtt';else if($w == '1') $w='cjtt';else if($w == '2') $w='zqscyw';else if($w == '3') $w='scyw';else if($w == '4') $w='gncj';else if($w == '5') $w='gatcj';else if($w == '6') $w='gjcj';else if($w == '7') $w='hyxw';else if($w == '8') $w='hyfx';else if($w == '9') $w='gsxw';else if($w == '10') $w='hgjj';else if($w == '11') $w='zhcx';else if($w == '12') $w='jg';else if($w == '13') $w='gs';else if($w == '14') $w='scqw';else if($w == '15') $w='zgzqb';else if($w == '16') $w='shzqb';else if($w == '17') $w='zqsb';else if($w == '18') $w='zqrb';else $w=$w;
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=0;$i<=$p;$i++){
       $ul1='http://vip1.gaotime.com/info-product/financialnewsHome_right.do?pageNo='.$i.'&pageSize=20&code='.$w.'';
       $ul2='http://vip1.gaotime.com/info-product/reportrearch.do?pageNo='.$i.'&pageSize=20&query='.$w.'';
       $ul3='http://vip1.gaotime.com/info-product/reportrearch.do?pageNo='.$i.'&pageSize=20&v=&code='.$w.'';
       $ul4='http://vip1.gaotime.com/info-product/financialnewsHome_right.do?pageNo='.$i.'&pageSize=20&data='.$w.'';
       $ul='';
   if($w == 'zhcx') $ul=$ul2;else if($w == 'jg') $ul=$ul3;else if($w == 'gs') $ul=$ul3;else if($w == 'scqw') $ul=$ul3;else if($w == 'zgzqb') $ul=$ul4;else if($w == 'shzqb') $ul=$ul4;else if($w == 'zqsb') $ul=$ul4;else if($w == 'zqrb') $ul=$ul4;else $ul=$ul1;
       $ut = m_v($ul);
preg_match_all("|<a href='(.*)' onclick=\"(.*)\('([^<]+)'\)\;\">(.*)<(.*)class=\"trimword\"(.*)>([^<]+)<|ismU",$ut,$d);
preg_match_all('|<td class="text01" >([^<]+)</td>|ismU',$ut,$d2);
preg_match_all('|<td class="text01-time">([^<]+)</td>|ismU',$ut,$d3);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=m_u($d[7][$k]);
       $a4=m_u($d2[1][$k]);
       $a5=$d3[1][$k];
       $a6='http://vip1.gaotime.com/info-product/financialnews_view.do?id='.$a2;
       $a7='http://vip1.gaotime.com/info-product/researchreport_newviewReport.do?id='.$a2;
   if($w == 'zhcx') $a8=$a7;else if($w == 'jg') $a8=$a7;else if($w == 'gs') $a8=$a7;else if($w == 'scqw') $a8=$a7;else $a8=$a6;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a8.'">'.$a3.' ('.$a5.')-'.$a4.'</a>';
echo $xml;
}}}
function jj21($url) {//21经济
       $wk= array( "finance","finance","politics","capital","business","express","opinion","global");
       $w = $_GET['w']?$_GET['w']:"0";
       $wnk = $wk[$w]; 
       $p = $_GET['p']?$_GET['p']:1; 
    for($i=1;$i<=$p;$i++){
       $ul='http://m.21jingji.com/channel/'.$wnk.'?short='.$w.'&page='.$i.'&type=json';
       $ut = m_v($ul);
preg_match_all('|"title":"([^<]+)",(.*)"url":"([^<]+)"|ismU',$ut,$d);
preg_match_all('|"mdtime":"([^<]+)"(.*)"hitime":"([^<]+)"|ismU',$ut,$d0);
preg_match_all('|"issuedate":"([^<]+)",|ismU',$ut,$d1);
preg_match_all('|"pressdate":"([^<]+)",|ismU',$ut,$d2);
preg_match_all('|"content":"([^<]+)",|ismU',$ut,$d4);
       $ud='';
   if($w == '5')  $ud=$d4[1];else  $ud=$d[1];
foreach ($ud as $k=>$v){
       $a1=r_u($d4[1][$k]);
       $a2=r_u($d[1][$k]);
       $a3=x_g($d[3][$k]);
       $a4=x_g($d1[1][$k]);
       $a5=x_g($d2[1][$k]);
       $a6=x_g($d0[1][$k]);
       $a7=x_g($d0[3][$k]);
   if($a4 == '')  $a8=$a5;else  $a8=$a4;
   if($w == '5')  $a9=$a6.$a7;else  $a9=$a8;
   if($w == '5')  $b2=$a1;else  $b2=$a2;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a3.'">'.$b2.'&nbsp;&nbsp;'.$a9.'</a>';
echo $xml;
}}}
function cstp($url) {//临时停牌
 $w = $_GET['w']?$_GET['w']:"0";
 $tt = $_GET['t']?$_GET['t']:dtime(); 
 $ul ='http://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$tt;
 $ut =  m_s($ul);
 //$ut =  json_decode(json_encode(m_s($ul)),true);
echo $ut;
}
function lstp($url) {//临时停牌
header('Content-Type: application/json');
 $tt = $_GET['t']?$_GET['t']:dtime(); 
 $ul ='http://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$tt;
 $ut =  json_decode(json_encode(m_s($ul)),true);
return $ut;
}
function tfp($url) {//停复牌
       $u = $_GET['u']?$_GET['u']:0;
       $yer =date("Y");
       $mou =date("m");
       $day =date("d");
       $t = $_GET['t']?$_GET['t']:$day;
       $dar = $yer.'-'.$mou.'-'.$day;
    if(strlen($t) <2) $t='0'.$t;else $t=$t;
    if($t!=date("d")){
       $tt = date("Y").'-'.date("m").'-'.$t;
} else {
       $tt = $_GET['t']?$_GET['t']:dtime(); 
}
       $ul ='http://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$tt;
       $ut =  m_s($ul);
       $nt =  J_d($ut,ture);
       $aa = $nt["szshSRTbTrade0111"]["suspensionTbTrades"];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {  
       $a0 = $aa[$i2];
       $a2 = t_m(substr($a0["f001d0111"], 0, -3));
       $a3= $a0["obSeccode0111"];
       $a4= m_u($a0["obSecname0111"]);
       $a5= m_u($a0["f004v0111"]);
       $a6= m_u($a0["f005v0111"]);
       $a7= m_u($a0["f006v0111"]);
       $a8= m_u($a0["f007v0111"]);
       $a9= t_m(substr($a0["obRectime0111"], 0, -3));
       $a10= t_m(substr($a0["obModtime0111"], 0, -3));
       $ud=''.$a9.':'.$a4.'('.$a3.')&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;'.$a7.'&nbsp;&nbsp;'.$a8.'';
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function tfp0($url) {//停复牌
       $u = $_GET['u']?$_GET['u']:0;
       $t = $_GET['t']?$_GET['t']:0;
    if($t <31 and $t>0 ) {
       $tt = date("Y").'-'.date("m").'-'.$t;
} else {
       $tt = $_GET['t']?$_GET['t']:dtime(); 
}
       $ul ='http://www.cninfo.com.cn/new/information/getSuspensionResumptions?queryDate='.$tt;
       $ut =  m_s($ul);
preg_match_all('|"f001d0111":([^<]+),"obSeccode0111":"([^<]+)","obSecname0111":"([^<]+)"(.*)"f004v0111":"([^<]+)","f005v0111":"([^<]+)"(.*)"obRectime0111":([^<]+),(.*)"f006v0111":"([^<]+)"(.*)"f007v0111":"([^<]+)"|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2= t_m(substr($d[1][$k], 0, -3));
       $a3= $d[2][$k];
       $a4= m_u($d[3][$k]);
       $a5= m_u($d[5][$k]);
       $a6= m_u($d[6][$k]);
       $a7= t_m(substr($d[8][$k], 0, -3));
       $a8= m_u($d[10][$k]);
       $a9= m_u($d[12][$k]);
       $a10= t_m(substr($d[14][$k], 0, -3));
       $ud=''.$a7.':'.$a4.'('.$a3.')&nbsp;&nbsp;&nbsp;&nbsp;'.$a5.'&nbsp;&nbsp;'.$a8.'&nbsp;&nbsp;'.$a9.'';
       $vd=Current(explode('?',$v));
    $xml ='<a>'.$ud.'</a>';
echo $xml;
}}
function bdpan($url) {
       $ul2 = $_GET['w'];
       $ul = urlencode($ul2);
       $ut = m_v($ul2);
preg_match_all('|"status":"([^<]+)","uk":([^<]+),|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a4='http://pan.baidu.com/share/home?uk='.$a2.'#category/type=0';
       $a5='打开';
       $ud=$a4;
       $vd=Current(explode('?',$v));
    //$xml ='<a href="'.$ut.'">'.$ut.'</a>';
    $xml ='<a href="'.$ud.'">'.$a5.'</a>';
echo $xml;
}}

function gpdm($url) {
       $w=$_GET['w'];
   echo "var w='$w'";
       $url='./zxb.js';
       $Data= "<script type=text/javascript>window.SuggestData(w)</script>";
return $Data;
}

function tzfd($url) {
       $key="<script type=text/javascript> function gpdm(){ alert(w); }</script>"; 
       $w = $_GET['w']?$_GET['w']:600000;
       $ul ='http://irm.cninfo.com.cn/ircs/interaction/lastQuestionforSzseSsgs.do?condition.type=2&condition.stockcode='.$w.'&condition.stocktype=S';
       $ul2 ='http://irm.cninfo.com.cn/ircs/interaction/moreQuestionForSsgs.do?condition.type=2&condition.stockcode='.$w.'&condition.stocktype=S';
       $ut = m_v($ul);
preg_match_all('|<p style="float(.*)>(.*)<a href="([^<]+)"(.*)class="ask">(.*)</a>|ismU',$ut,$d);
preg_match_all('|<span class="time">([^<]+)</span>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a2=$d[3][$k];
       $a3=$d2[1][$k];
       $a4='http://irm.cninfo.com.cn/ircs/interaction/'.$a2;
       $a5=$d[5][$k];
       $a6=$d3[5][$k];
       $ud=$a4;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'">'.$a5.'   '.$a3.'</a>';
echo $xml;
}}
function tzfd2($url) {
       $w = $_GET['w']?$_GET['w']:600000;
       $p = $_GET['p']?$_GET['p']:2;
    for($i=1;$i<=$p;$i++){
       $ul ='http://irm.cninfo.com.cn/ircs/interaction/moreQuestionForSsgs.do?condition.type=2&condition.stockcode='.$w.'&condition.stocktype=S&pageNo='.$i.'';
       $ut = m_v($ul);
preg_match_all('|<td(.*)class="hd_td">([^<]+)<br />([^<]+)</td>(.*)<td(.*)class="hd_td"(.*)>([^<]+)<br /><span(.*)></span></td>(.*)<td(.*)class="hd_td1"(.*)><a href="([^<]+)"(.*)>([^<]+)</a>|ismU',$ut,$d);
preg_match_all('|<dt class="text_sm">(.*)</dt>(.*)</td>(.*)<td(.*)class="hd_td">([^<]+)</td>(.*)<td(.*)class="hd_td">([^<]+)</td>|ismU',$ut,$d2);
foreach ($d[1] as $k=>$v){
       $a1=$d[1][$k];
       $a2=$d[2][$k];
       $a3=$d[12][$k];
       $a4=$d[14][$k];
       $a5='http://irm.cninfo.com.cn/ircs/interaction/'.$a3;
       $a6=$d2[5][$k];
       $a7=$d2[8][$k];
       $a8=$d[3][$k];
       $ud=$a5;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'">'.$a4.'   ('.$a6.') '.$a7.'</a>';
echo $xml;
}}}


function wxs($url) {
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $ul ='http://kj.eywedu.com/wenben/Search.asp?Field=SoftName&ClassID=&keyword='.$kw.'&Submit=++';
       $ut = f_g(g_h($ul));
preg_match_all('|<table style="WORD-BREAK(.*)"(.*)>(.*)<a href="([^<]+)">([^<]+)</a>(.*)</table>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[4][$k];
       $a3=$d[5][$k];
       $a4='http://kj.eywedu.com'.$a2;
       //$ut2 = m_v($a4);
//preg_match_all("|<td style=\"LINE-HEIGHT: 16px\" bgColor=#fffffe>(.*)<div align=left><BR><a href='([^<]+)' target='_blank'>([^<]+)</a>|ismU",$ut2,$d2);
//foreach ($d2[1] as $k2=>$v2){
       //$a6=$d2[2][$k2];
       //$a7='http://kj.eywedu.com'.$a6;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a4.'">'.$a4.'</a>';
echo $xml;
}}
function hyzj($url) {
       $w=$_GET['w'];
   if ($w == '')  $w='hyjj0';else  $w=$w;
       $ul ='http://www.chinastock.com.cn/yhwz/information/hyjj0.shtml';
       $ut = m_v($ul);
preg_match_all("|<td><a href=\"\/yhwz\/toptrader\/mcConcept2.jsp\?categoryname=1&indexcode=([^<]+)\"  target=\"_blank\">([^<]+)</a></td>|ismU",$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[1][$k];
       $a3=$d[2][$k];
       $a4='http://www.chinastock.com.cn/yhwz/toptrader/mcConcept_3.jsp?indexcode='.$a2.'&colname=netfundflow&ordertype=desc';
       $a5='http://www.chinastock.com.cn/yhwz/toptrader/mcConcept_3.jsp?indexcode='.$a2.'&colname=netfundflow&ordertype=desc';
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a4.'">'.$a3.'</a>';
echo $xml;
}}
function swsh($url) {//税务上海
       $p = $_GET['p']?$_GET['p']:1;
      $pp=$p-1;
    for($i=0;$i<=$pp;$i++){
      if ($i == '0')  $ii=null;else  $ii='_'.$i;
       $ul='http://www.tax.sh.gov.cn/pub/xxgk/ssgg/index'.$ii.'.html';
       $ut = f_g($ul);
preg_match_all('|<dd>(.*)<a href="./([^<]+)" title="([^<]+)"(.*)>(.*)<span class="newtitle">(.*)<span class="date">([^<]+)</span>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[2][$k];
       $a3=$d[3][$k];
       $a4='http://www.tax.sh.gov.cn/pub/xxgk/ssgg/'.$a2;
       $a5=$d[7][$k];
       $a10=$d2[7][$k2];
    $xml ='<a href="'.$fname.'?&shsw='.$a4.'&name='.$a5.'" >'.$a3.' ('.$a5.')</a>'."\n";
echo $xml;
}}}
function wencai($url) {//问财选股
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p=$_GET['p']?$_GET['p']:'1';
    for($i1=0;$i1<=$p;$i1++){
       $ul='http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=&searchfilter=&tid=stockpick&queryarea=&w='.kw;
       $ul2='http://www.iwencai.com/asyn/search?q='.kw.'&queryType=stock&app=qnas&qid=';
       $ul3='http://www.iwencai.com/stockpick/cache?token=7dae1ec565942a5ffaa29a695dfa360e&p=1&perpage=50&changeperpage='.$i1.'';
       $ul4='http://search.10jqka.com.cn/stockpick/cache?token=c3f55eede15bf694b171f606407353b3&p=1&perpage=30&showType=&showIndexId='.kw;
       $ut = m_v($ul3);
       $nt = J_d($ut,ture);
       $aa = $nt["result"][0];
       $count_json = count($aa);
 for ($i2 = 0; $i2 < $count_json; $i2++) {
       $a0 = $aa[$i2];
       $a1 = $a0[1];
       $a2 = $a0[2];
       $a3 = $a0[3];
       $a4 = $a0[4];
       $a5 = $a0[5][0]["PageRawTitle"];
       $a6 = $a0[5][0]["PublishTime"];
       $xml ='<a>'.$a2.' ('.$a3.')</a>';
echo $xml;
}}}
function wencai2($url) {//问财选股
       $w = $_GET['w']?$_GET['w']:date("Y"); 
       $kw=k_w($w);
       $p=$_GET['p']?$_GET['p']:'1';
    //for($i=0;$i<=$p;$i++){}
       $ul='http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=&searchfilter=&tid=stockpick&queryarea=&w='.kw;
       $ul2='http://www.iwencai.com/asyn/search?q='.kw.'&queryType=stock&app=qnas&qid=';
       $ul3='http://search.10jqka.com.cn/stockpick/search?preParams=&ts=1&f=1&qs=zxmcxh&querytype=&tid=stockpick&w='.kw;
       $ul4='http://search.10jqka.com.cn/stockpick/cache?token=c3f55eede15bf694b171f606407353b3&p=1&perpage=30&showType=&showIndexId='.kw;
       $ut = m_v($ul3);
preg_match_all('|<input(.*)class="checkbox"(.*)type="checkbox">(.*)<(.*)class="em">([^<]+)</div>(.*)<a(.*)>([^<]+)</a>|ismU',$ut,$d);
foreach ($d[1] as $k=>$v){
       $a2=$d[5][$k];
       $a3=r_u($d[8][$k]);
       $xml ='<a>'.$a2.' ('.$a3.')</a>'."\n";
echo $xml;
}}
if(isset ($_GET['s'])) {
       $xml = "";
       $s = $_GET['s']?$_GET['s']:"fx168";
       $xml= $s($xml);
echo $xml;
 }
elseif(isset ($_GET['tgb'])){
        $vid=$_GET['tgb'];
        $b0 = 'http://www.taoguba.com.cn/blog/'.$vid;
        $ul2 = m_v($b0);
preg_match_all("#<td class=\"table_bottom01 suh\" align=\"left\"><div><a href='(.*)' title='(.*)' target=\"_blank\">(.*)</a></div>(.*)</td><td class=\"table_bottom01\">(.*)</td><td class=\"table_bottom01\">(.*)</td>#ismU",$ul2,$b);
        foreach($b[1] as $k=>$v){
        $a2 = $b[1][$k];
        $a3 = m_g($b[3][$k]);
        $a4 = m_g($b[6][$k]);
        $a5 = 'http://www.taoguba.com.cn/'.$a2;
        $vd=Current(explode('?',$v));
    $xml ='<a href="'.$a5.'" target="_blank" >'.$a3.'('.$a4.')</a>';
echo $xml;
}}
elseif(isset ($_GET['ttiao'])){
       $vid=$_GET['ttiao'];
       $p = $_GET['p']?$_GET['p']:1;
    for($i=0;$i<=$p;$i++){
        $pt = 'p'.$p.'/';
   if ($p == '1')  $pt=null;else  $pt=$pt;
       $ur2 = $vid;
       $ur3 = 'https://www.toutiao.com/c/user/'.$vid.'/';
       $ur = 'https://www.toutiao.com/c/user/article/?page_type=1&user_id='.$vid.'&max_behot_time=0&count=20&as=A1B54ACE17A2E90&cp=5AE7929E49D08E1&_signature=sDISMRAT6uOVOIAQ2c.H27AyEi';
       $ul = m_v($ur);
preg_match_all('# "title": "([^>]+)",#ismU',$ul,$d);
preg_match_all('# "source_url": "([^>]+)",#ismU',$ul,$d2);
preg_match_all('# "behot_time": ([^>]+),#ismU',$ul,$d3);
foreach ($d[1] as $k=>$v){
	$a3=r_u($d[1][$k]);
	$a4='https://www.toutiao.com'.$d2[1][$k];
	$a5=t_m($d3[1][$k]);
        $vd=Current(explode('?',$v));
	$xml ='<a href="'.$a4.'" target="_blank" >'.$a5.' ('.$a3.')</a>';
echo $xml;
	}}}
elseif(isset ($_GET['gnt'])){
        $vid = $_GET['gnt'];
        $name = $_GET['name'];
       $a8='http://stock.jrj.com.cn/concept/stock/concept_'.$vid.'.js';
       $ut2 = m_v($a8);
preg_match_all("|\[\"([^<]+)\",\"([^<]+)\",([^<]+),([^<]+),([^<]+)\]|ismU",$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a4=m_u('现价:');
       $a5=m_u('涨幅:');
       $a6=$a4.'&nbsp;&nbsp;'.$d2[3][$k2];
       $a7=$a5.'&nbsp;&nbsp;'.$d2[4][$k2].'%';
       $a8=$d2[5][$k2];
       $a9=$d2[1][$k2];
       $a10=r_u($d2[2][$k2]);
       $b9=$a9.'&nbsp;&nbsp;&nbsp;&nbsp;'.$a10;
       $ud=''.$b9.'';
       $vd=Current(explode('?',$v2));
    $xml ='<a>'.m_u($name).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b9.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$a7.'</a>';
echo $xml;
}}
elseif(isset ($_GET['weixin'])){
       //$a2='http://weixin.sogou.com/gzhjs?openid=oIWsFt5Y_VirSKV206JiJoMXfPRE&ext=NIh7jNwwaRlPim_KfW1FcIqKCiAYL_F4hvCrsPyKMN-HLwA0dDLg-4-0k7BQ2cQX&cb=sogou.weixin_gzhcb&page=1&gzhArtKeyWord=&tsn=0&t=1&name=学而思上海中考指导';
       $a2='http://weixin.sogou.com/gzhjs?openid=oIWsFt5Y_VirSKV206JiJoMXfPRE&ext=NIh7jNwwaRlPim_KfW1FcIqKCiAYL_F4hvCrsPyKMN-HLwA0dDLg-yUUXEbXWKP8&cb=sogou.weixin_gzhcb&page=1&gzhArtKeyWord=&tsn=0&t=1460637858567';
       $vid=$_GET['weixin'];
       $name=$_GET['name'];
       $cn=$_GET['cn'];
   if($vid == '')  $vid=$a2;else  $vid=$vid;
       $ut = f_g(g_h($vid));
preg_match_all("|<title><([^<]+)><(.*)/title><url><([^<]+)><(.*)/url>ismU",$ut,$d);   
//preg_match_all("|<title><\!\[CDATA\[([^<]+)\]\]><\/title><url><\!\[CDATA\[([^<]+)\]\]><\/url>ismU",$ut,$d);     
foreach ($d[1] as $k=>$v){
       $a6=m_u($d[1][$k]);
       $a7=$d[3][$k];
       $a8='http://weixin.sogou.com'.$a7;
       $ud=$a8;
       $vd=Current(explode('?',$v));
    $xml ='<a href="'.$ud.'" target="_blank" >'.$u7.'('.$name.')</a>';
echo $xml;
}}
elseif(isset ($_GET['shsw'])){
        $ul=$_GET['shsw'];
       $ut2 = f_g($ul);
preg_match_all('|<A title=([^<]+) href="/([^<]+)/([^<]+)/ssgg/([^<]+)/([^<]+)/([^<]+).html"(.*)_fcksavedurl="([^<]+)">([^<]+)</A>(.*)</LI>|ismU',$ut2,$d2);
foreach ($d2[1] as $k2=>$v2){
       $a1=$d2[2][$k2];
       $a2=$d2[3][$k2];
       $a3=$d2[4][$k2];
       $a4=$d2[5][$k2];
       $a5=$d2[6][$k2];
       $a8='http://www.tax.sh.gov.cn/'.$a1.'/'.$a2.'/ssgg/'.$a3.'/'.$a4.'/';
       $a9='http://www.tax.sh.gov.cn/'.$a1.'/'.$a2.'/ssgg/'.$a3.'/'.$a4.'/'.$a5.'.html';
       $a10=$d2[9][$k2];
       $ut3 = f_g($a9);
preg_match_all('|<A href="./([^<]+).xls"(.*)>([^<]+)</A>|ismU',$ut3,$d3);
foreach ($d3[1] as $k=>$v){
       $a11=$d3[1][$k];
       $a12=$a8.$a11.'.xls';
       $a13=$d3[3][$k];
        $vd=Current(explode('?',$v3));
    $xml ='<a href="'.$a12.'" target="_blank" >'.$a10.': '.$a13.' </a>';
echo $xml;
}}}

?>