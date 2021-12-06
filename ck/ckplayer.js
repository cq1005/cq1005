function ckcpt() {
    var cpt = '';
        cpt += 'right.swf,2,1,0,0,2,0|'; //右边开关灯，调整，分享按钮的插件
        cpt += 'adjustment.swf,1,1,-180,-100,3,0|'; //调整大小和颜色的插件
        cpt += 'subtitle.swf,0,0,0,0,2,0|';//字幕
        //cpt += 'definition.swf,2,2,-36,-26,2,1|';//清晰度
        //cpt += 'bj.swf,0,0,0,0,2,0|'; //背景
	//cpt += 'list_pic.swf,2,2,-350,-150,3,0|';//列表插件插件
        //cpt += 'time.swf,2,2,-250,-25,2|';
        //cpt += 'downloadspeeds.swf,2,2,-400,-23,2|';//下载速度插件 
        //cpt += 'Proportion.swf,2,2,-449,-32,2|';//根据你的自己播放器修改参数-170和-32,-180向左边移动，-33向上移动
	//cpt += 'scaling.swf,0,0,0,0,2,0|';
	//cpt += 'barrage.swf,0,0,0,0,2,0|';
        //cpt += 'barrage_control.swf,2,2,-210,-26,2,1|';
	//cpt += 'barrage_text.swf,0,2,160,-28,2,1|';
        //cpt += 'list.swf,1,1,-180,-150,3|';
        //cpt += 'list_btn.swf,1,2,-200,-30,2|';
        //cpt += 'share.swf,1,1,-180,-100,3,0|'; 
    return cpt;
}
function ckstyle() { //定义总的风格
    var ck = {
	cpt_barrageopen:'0',
	cpt_barragetext:'290',
        cpath: 'style.swf',
        language: 'language.xml',
        flashvars: '{p->1}{b->1}{h->4}{v->100}{f->php/v.php?url=[$pat]}{c->0}{fs->1}{x->ckplayer.xml}',
        setup: '1,1,1,1,1,2,0,1,2,0,0,1,200,0,2,1,0,1,1,1,2,10,3,0,1,2,3000,0,0,0,0,1,1,1,1,1,1,250,0,90,0,0,0',
        pm_bg: '0x000000,100,230,180',
        pm_pr: '0x000000,0xfdfdfd,0xffffff,0,70,80,18,5',
        pm_start: '10,5,0xFF0000,20',
        mylogo: '',
        pm_mylogo: '',
        logo: '',
        pm_logo: '',
        control_rel: '',
        control_pv: 'Preview.swf,105,2000',
        pm_repc: '[]->&',
        pm_repc2: "",
        pm_spac: '|',
        pm_fpac: 'file->f|src->f|url->f|url->f',
        pm_advtime: '2,0,-110,10,0,300,0',
        pm_advstatus: '1,2,2,-200,-40',
        pm_advjp: '1,1,2,2,-100,-40',
        pm_padvc: '2,0,-10,-10',
        pm_advms: '2,2,-46,-56',
        pm_zip: '1,1,-20,-8,1,0,0',
	  pm_advmarquee: '1,2,50,-60,50,20,0,0x000000,50,0,20,1,30,2000',
	  pm_glowfilter:'1,0x01485d, 100, 6, 3, 10, 1, 0, 0',
        advmarquee: escape(''),
		mainfuntion:'',
		flashplayer:'',
		calljs:'ckplayer_status,ckadjump,playerstop,ckmarqueeadv',
        myweb: escape(''),
        cpt_lights: '1',
        cpt_share: '',
cpt_definition_text:'标清,高清,超清,蓝光',
cpt_definition:'0x656565,0x2c2c2c,80,20,0xFFFFFF,0x00b4ff,10,10,1,3,自动,12,MicrosoftYaHei|微软雅黑,0x505050,10,80,20,15,0,10,15,0x656565,0x2c2c2c,80,20,0xFFFFFF,0x00b4ff,10,10,1,3,12,MicrosoftYaHei|微软雅黑,50,0xb7b7b7,40,1,10,10',
cpt_subtitle_cn:'{font color="#FFFFFF" size="22" face="Microsoft YaHei,微软雅黑,SimHei,黑体"}[$subtitle]{/font}',
cpt_subtitle_en:'{font color="#FFDD00" size="22" face="Arial"}[$subtitle]{/font}</cpt_subtitle_en',
        cpt_list: ckcpt()
    }
    return ck;
}


!function(){var CKobject={_K_:function(a){return document.getElementById(a)},_T_:!1,_M_:!1,_G_:!1,_Y_:!1,_I_:null,_J_:0,_O_:{},uaMatch:function(a,b,c,d,e,f,g,h,i){var j=b.exec(a);return null!=j?{b:"IE",v:j[2]||"0"}:(j=c.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:(j=d.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:(j=e.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:(j=f.exec(a),null!=j?{b:j[2]||"",v:j[1]||"0"}:(j=g.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:(j=h.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:(j=i.exec(a),null!=j?{b:j[1]||"",v:j[2]||"0"}:{b:"unknown",v:"0"})))))))},browser:function(){var a=navigator.userAgent,c=/(msie\s|trident.*rv:)([\w.]+)/,d=/(firefox)\/([\w.]+)/,e=/(opera).+version\/([\w.]+)/,f=/(chrome)\/([\w.]+)/,g=/version\/([\w.]+).*(safari)/,h=/(safari)\/([\w.]+)/,i=/(mozilla)\/([\w.]+)/,j=/(mobile)\/([\w.]+)/,k=a.toLowerCase(),l=this.uaMatch(k,c,d,e,f,g,h,i,j);return l.b&&(b=l.b,v=l.v),{B:b,V:v}},Platform:function(){var d,e,a="",b=navigator.userAgent;navigator.appVersion,d={iPhone:b.indexOf("iPhone")>-1||b.indexOf("Mac")>-1,iPad:b.indexOf("iPad")>-1,ios:!!b.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),android:b.indexOf("Android")>-1||b.indexOf("Linux")>-1,webKit:b.indexOf("AppleWebKit")>-1,trident:b.indexOf("Trident")>-1,gecko:b.indexOf("Gecko")>-1&&-1==b.indexOf("KHTML"),presto:b.indexOf("Presto")>-1,mobile:!!b.match(/AppleWebKit.*Mobile.*/)||!!b.match(/AppleWebKit/),webApp:-1==b.indexOf("Safari")};for(e in d)if(d[e]){a=e;break}return a},isHTML5:function(){return!!document.createElement("video").canPlayType},getType:function(){return this._T_},getVideo:function(){var c,d,a="",b=this._E_["v"];if(b&&b.length>1)for(c=0;c<b.length;c++)d=b[c].split("->"),d.length>=1&&""!=d[0]&&(a+='<source src="'+d[0]+'"'),d.length>=2&&""!=d[1]&&(a+=' type="'+d[1]+'"'),a+=">";return a},getVars:function(a){var b=this._A_;return"undefined"==typeof b?null:a in b?b[a]:null},getParams:function(){var a="";return this._A_&&(1==parseInt(this.getVars("p"))&&(a+=' autoplay="autoplay"'),1==parseInt(this.getVars("e"))&&(a+=' loop="loop"'),2==parseInt(this.getVars("p"))&&(a+=' preload="metadata"'),this.getVars("i")&&(a+=' poster="'+this.getVars("i")+'"')),a},getpath:function(a){var d,e,f,g,h,j,k,l,m,n,o,p,q,b="CDEFGHIJKLMNOPQRSTUVWXYZcdefghijklmnopqrstuvwxyz",c=a.substr(0,1);if(b.indexOf(c)>-1&&(a.substr(0,4)==c+"://"||a.substr(0,4)==c+":\\"))return a;for(d=unescape(window.location.href).replace("file:///",""),e=parseInt(document.location.port),f=document.location.protocol+"//"+document.location.hostname,g="",h="",j="",k=0,l=unescape(a).split("//"),l.length>0&&(g=l[0]+"//"),m="http|https|ftp|rtsp|mms|ftp|rtmp|file",n=m.split("|"),80!=e&&e&&(f+=":"+e),i=0;i<n.length;i++)if(n[i]+"://"==g){k=1;break}if(0==k)if("/"==a.substr(0,1))j=f+a;else{for(h=d.substring(0,d.lastIndexOf("/")+1).replace("\\","/"),c=a.replace("../","./"),f=c.split("./"),o=f.length,l=c.replace("./",""),p=h.split("/"),q=p.length-o,i=0;q>i;i++)j+=p[i]+"/";j+=l}else j=a;return j},getXhr:function(){var a;try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(b){try{a=new ActiveXObject("Microsoft.XMLHTTP")}catch(b){a=!1}}return a||"undefined"==typeof XMLHttpRequest||(a=new XMLHttpRequest),a},getX:function(){var f="ckstyle()";this.getVars("x")&&1!=parseInt(this.getVars("c"))&&(f=this.getVars("x")+"()");try{"object"==typeof eval(f)&&(this._X_=eval(f))}catch(e){try{"object"==typeof eval(ckstyle)&&(this._X_=ckstyle())}catch(e){this._X_=ckstyle()}}},getSn:function(a,b){return b>=0?this._X_[a].split(",")[b]:this._X_[a]},getUrl:function(a,b){var d,e,c=["get","utf-8"];a&&2==a.length&&(d=a[0],e=a[1].split("/"),e.length>=2&&(c[0]=e[1]),e.length>=3&&(c[1]=e[2]),this.ajax(c[0],c[1],d,function(a){var d,e,f,g,h,c=CKobject;if(a&&"error"!=a){if(d="",e=a,a.indexOf("}")>-1){for(f=a.split("}"),g=0;g<f.length-1;g++)d+=f[g]+"}",h=f[g].replace("{","").split("->"),2==h.length&&(c._A_[h[0]]=h[1]);e=f[f.length-1]}c._E_["v"]=e.split(","),b?c.showHtml5():(c.changeParams(d),c.newAdr())}}))},getflashvars:function(a){var d,b="",c=0;if(a)for(d in a)c>0&&(b+="&"),"f"==d&&a[d]&&!this.getSn("pm_repc",-1)&&(a[d]=this.getpath(a[d]),a[d].indexOf("&")>-1&&(a[d]=encodeURIComponent(a[d]))),"y"==d&&a[d]&&(a[d]=this.getpath(a[d])),b+=d+"="+a[d],c++;return b},getparam:function(a){var e,f,b="",c="",d={allowScriptAccess:"always",allowFullScreen:!0,quality:"high",bgcolor:"#000"};if(a)for(e in a)d[e]=a[e];for(f in d)b+=f+'="'+d[f]+'" ',c+='<param name="'+f+'" value="'+d[f]+'" />';return b=b.replace("movie=","src="),{w:b,v:c}},getObjectById:function(a){var b,c,d,e;return this._T_?this:(b=null,c=this._K_(a),d="embed",c&&"OBJECT"==c.nodeName&&("undefined"!=typeof c.SetVariable?b=c:(e=c.getElementsByTagName(d)[0],e&&(b=e))),b)},ajax:function(a,b,c,d){var e=this.getXhr(),f=[],g="";"get"==a?(g=c.indexOf("?")>-1?c+"&t="+(new Date).getTime():c+"?t="+(new Date).getTime(),e.open("get",g)):(f=c.split("?"),c=f[0],g=f[1],e.open("post",c,!0)),e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.setRequestHeader("charset",b),"post"==a?e.send(g):e.send(null),e.onreadystatechange=function(){if(4==e.readyState){var a=e.responseText;""!=a?d(a):d(null)}}},addListener:function(a,b){var c=CKobject._V_;if(c.addEventListener)try{c.addEventListener(a,b,!1)}catch(a){this.getNot()}else if(c.attachEvent)try{c.attachEvent("on"+a,b)}catch(a){this.getNot()}else c["on"+a]=b},removeListener:function(a,b){var c=CKobject._V_;if(c.removeEventListener)try{c.removeEventListener(a,b,!1)}catch(a){this.getNot()}else if(c.detachEvent)try{c.detachEvent("on"+a,b)}catch(a){this.getNot()}else c["on"+a]=null},Flash:function(){var c,d,f,g,a=!1,b=0;if(document.all||this.browser()["B"].toLowerCase().indexOf("ie")>-1)try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash"),a=!0,d=c.GetVariable("$version"),b=parseInt(d.split(" ")[1].split(",")[0])}catch(e){}else if(navigator.plugins&&navigator.plugins.length>0&&(c=navigator.plugins["Shockwave Flash"]))for(a=!0,f=c.description.split(" "),g=0;g<f.length;++g)isNaN(parseInt(f[g]))||(b=parseInt(f[g]));return{f:a,v:b}},embed:function(a,b,c,d,e,f,g,h,i){var j=["all"];f?this.isHTML5()?this.embedHTML5(b,c,d,e,h,g,j):this.embedSWF(a,b,c,d,e,g,i):this.Flash()["f"]&&parseInt(this.Flash()["v"])>10?this.embedSWF(a,b,c,d,e,g,i):this.isHTML5()?this.embedHTML5(b,c,d,e,h,g,j):this.embedSWF(a,b,c,d,e,g,i)},embedSWF:function(a,b,c,e,f,g,h){c||(c="ckplayer_a1"),h||(h={bgcolor:"#FFF",allowFullScreen:!0,allowScriptAccess:"always",wmode:"transparent"}),this._A_=g,this.getX();var i="undefined",j=!1,k=document,l="http://www.macromedia.com/go/getflashplayer",m='<a href="'+l+'" target="_blank">请点击此处下载安装最新的flash插件</a>',n={w:"您的网页不符合w3c标准，无法显示播放器",f:"您没有安装flash插件，无法播放视频，"+m,v:"您的flash插件版本过低，无法播放视频，"+m},o=typeof k.getElementById!=i&&typeof k.getElementsByTagName!=i&&typeof k.createElement!=i,p='id="'+c+'" name="'+c+'" ',q="",r="";h["movie"]=a,h["flashvars"]=this.getflashvars(g),-1==e&&(d=!0,this._K_(b).style.width="100%",e="100%"),q+='<object pluginspage="http://www.macromedia.com/go/getflashplayer" ',q+='classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ',q+='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" ',q+='width="'+e+'" ',q+='height="'+f+'" ',q+=p,q+='align="middle">',q+=this.getparam(h)["v"],q+="<embed ",q+=this.getparam(h)["w"],q+=' width="'+e+'" height="'+f+'" name="'+c+'" id="'+c+'" align="middle" '+p,q+='type="application/x-shockwave-flash" pluginspage="'+l+'" />',q+="</object>",o?this.Flash()["f"]?this.Flash()["v"]<10?(r=n["v"],j=!0):(r=q,this._T_=!1):(r=n["f"],j=!0):(r=n["w"],j=!0),r&&(this._K_(b).innerHTML=r),j&&(this._K_(b).style.color="#0066cc",this._K_(b).style.lineHeight=this._K_(b).style.height,this._K_(b).style.textAlign="center")},embedHTML5:function(c,d,e,g,h,i,j){var k,l;for(this._E_={c:c,p:d,w:e,h:g,v:h,s:j},this._A_=i,this.getX(),b=this.browser()["B"],v=this.browser()["V"],x=v.split("."),t=x[0],m=b+v,n=b+t,w="",s=!1,f=this.Flash()["f"],a=!1,j||(j=["iPad","iPhone","ios"]),k=0;k<j.length;k++){if(w=j[k],"all"==w.toLowerCase()){s=!0;break}if("all+false"==w.toLowerCase()&&!f){s=!0;break}if(w.indexOf("+")>-1?(w=w.split("+")[0],a=!0):a=!1,this.Platform()==w||m==w||n==w||b==w){if(!a){s=!0;break}if(!f){s=!0;break}}}if(s){if(h&&(l=h[0].split("->"),l&&2==l.length&&l[1].indexOf("ajax")>-1))return this.getUrl(l,!0),void 0;this.showHtml5()}},status:function(){this._H_=parseInt(this.getSn("setup",20));var f="ckplayer_status";""!=this.getSn("calljs",0)&&(f=this.getSn("calljs",0));try{if("function"==typeof eval(f))return this._L_=eval(f),this._M_=!0,!0}catch(e){try{if("function"==typeof eval(ckplayer_status))return this._L_=ckplayer_status,this._M_=!0,!0}catch(e){return!1}}return!1},showHtml5:function(){var v,f,C=CKobject,p=C._E_["p"],a=C._E_["v"],c=C._E_["c"],b=!1,s=this._E_["v"],w=C._E_["w"],h=C._E_["h"],d=!1,r="";if(1==s.length&&(r=' src="'+s[0].split("->")[0]+'"'),-1==w&&(d=!0,C._K_(c).style.width="100%",w="100%"),w.toString().indexOf("%")>-1&&(w="100%"),h.toString().indexOf("%")>-1&&(h="100%"),v="<video controls"+r+' id="'+p+'" width="'+w+'" height="'+h+'"'+C.getParams()+">"+C.getVideo()+"</video>",C._K_(c).innerHTML=v,C._K_(c).style.backgroundColor="#000",C._V_=this._K_(p),d||(C._K_(c).style.width=this._E_["w"].toString().indexOf("%")>-1?.01*C._K_(c).offsetWidth*parseInt(this._E_["w"])+"px":C._V_.width+"px",C._K_(c).style.height=this._E_["h"].toString().indexOf("%")>-1?.01*C._K_(c).offsetHeight*parseInt(this._E_["h"])+"px":C._V_.height+"px"),C._P_=!1,C._T_=!0,""!=C.getVars("loaded")){f=C.getVars("loaded")+"()";try{"function"==typeof eval(f)&&eval(f)}catch(e){try{"function"==typeof eval(loadedHandler)&&loadedHandler()}catch(e){}}}C.status(),C.addListener("play",C.playHandler),C.addListener("pause",C.playHandler),C.addListener("error",C.errorHandler),C.addListener("emptied",C.errorHandler),C.addListener("loadedmetadata",C.loadedMetadataHandler),C.addListener("ended",C.endedHandler),C.addListener("volumechange",C.volumeChangeHandler)},videoPlay:function(){this._T_&&this._V_.play()},videoPause:function(){this._T_&&this._V_.pause()},playOrPause:function(){this._T_&&(this._V_.paused?this._V_.play():this._V_.pause())},fastNext:function(){this._T_&&(this._V_["currentTime"]=this._V_["currentTime"]+10)},fastBack:function(){this._T_&&(this._V_["currentTime"]=this._V_["currentTime"]-10)},changeVolume:function(a){this._T_&&(this._V_["volume"]=.01*a)},videoSeek:function(a){this._T_&&(this._V_["currentTime"]=a)},newAddress:function(a){var c,b=[];if(a&&(b=this.isHtml5New(a),b&&this._T_)){if(this.changeParams(a),c=b[0].split("->"),c&&2==c.length&&c[1].indexOf("ajax")>-1)return this.getUrl(c,!1),void 0;this._E_["v"]=b,this.newAdr()}},quitFullScreen:function(){document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen()},changeStatus:function(a){this._H_=a},newAdr:function(){var a=this._E_["v"];this._V_.pause(),1==a.length?this._V_.src=a[0].split("->")[0]:this._V_["innerHTML"]=this.getVideo(),this._V_.load()},isHtml5New:function(a){var b,c,d,e;if(-1==a.indexOf("html5"))return!1;for(b=a.replace(/{/g,""),c=b.split("}"),d="",e=0;e<c.length;e++)if(c[e].indexOf("html5")>-1){d=c[e].replace("html5->","").split(",");break}return d},changeParams:function(a){var b,c,e,f;if(a)for(b=a.replace(/{/g,""),c=b.split("}"),e=0;e<c.length;e++)if(f=c[e].split("->"),2==f.length)switch(f[0]){case"p":1==parseInt(f[1])?this._V_.autoplay=!0:2==parseInt(f[1])?this._V_.preload="metadata":(this._V_.autoplay=!1,null!=this._I_&&(clearInterval(this._I_),this._I_=null));break;case"e":this._V_.loop=1==parseInt(f[1])?!0:!1;break;case"i":this._V_.poster=f[1]}},frontAdPause:function(){this.getNot()},frontAdUnload:function(){this.getNot()},changeFace:function(){this.getNot()},plugin:function(){this.getNot()},videoClear:function(){this.getNot()},videoBrightness:function(){this.getNot()},videoContrast:function(){this.getNot()},videoSaturation:function(){this.getNot()},videoSetHue:function(){this.getNot()},videoWAndH:function(){this.getNot()},videoWHXY:function(){this.getNot()},changeFlashvars:function(){this.getNot()},changeMyObject:function(){this.getNot()},getMyObject:function(){this.getNot()},changeeFace:function(){this.getNot()},changeStyle:function(){this.getNot()},promptLoad:function(){this.getNot()},promptUnload:function(){this.getNot()},marqueeLoad:function(){this.getNot()},marqueeClose:function(){this.getNot()},getNot:function(){var a="The ckplayer's API for HTML5 does not exist";return a},volumeChangeHandler:function(){var a=CKobject;a._V_.muted?(a.returnStatus("volumechange:0",1),a._O_["volume"]=0,a._O_["mute"]=!0):(a._O_["mute"]=!1,a._O_["volume"]=100*a._V_["volume"],a.returnStatus("volumechange:"+100*a._V_["volume"],1))},endedHandler:function(){var f,C=CKobject,e=parseInt(C.getVars("e"));if(C.returnStatus("ended",1),C._I_&&(clearInterval(C._I_),C._I_=null),0==e||4==e||6==e){6==e&&this.quitFullScreen(),f="playerstop()",""!=C.getSn("calljs",2)&&(f=C.getSn("calljs",2)+"()");try{if("function"==typeof eval(f))return eval(f),void 0}catch(e){try{if("function"==typeof eval(playerstop))return playerstop(),void 0}catch(e){return}}}},loadedMetadataHandler:function(){var a=CKobject;a.returnStatus("loadedmetadata",1),a._O_["totaltime"]=a._V_["duration"],a._O_["width"]=a._V_["width"],a._O_["height"]=a._V_["height"],a._O_["awidth"]=a._V_["videoWidth"],a._O_["aheight"]=a._V_["videoHeight"],a._V_.defaultMuted?(a.returnStatus("volumechange:0",1),a._O_["mute"]=!0,a._O_["volume"]=0):(a._O_["mute"]=!1,a._O_["volume"]=100*a._V_["volume"],a.returnStatus("volumechange:"+100*a._V_["volume"],1))},errorHandler:function(){CKobject.returnStatus("error",1)},playHandler:function(){var b,c,d,a=CKobject;if(a._V_.paused)a.returnStatus("pause",1),a.addO("play",!1),null!=a._I_&&(clearInterval(a._I_),a._I_=null);else{if(a.returnStatus("play",1),a.addO("play",!0),a._P_||(a.returnStatus("play",1),a._P_=!0),a._I_=setInterval(a.playTime,parseInt(a.getSn("setup",37))),!a._G_){a._G_=!0;for(b in a._A_)"g"==b&&a._A_[b]&&(c=parseInt(a._A_[b]),a.videoSeek(c))}if(!a._Y_){a._Y_=!0;for(b in a._A_)"j"==b&&a._A_[b]&&(d=parseInt(a._A_[b]),a._J_=d>0?d:parseInt(a._O_["totaltime"])+d)}}},returnStatus:function(a,b){var c=a;3==this._H_&&(c=this._E_["p"]+"->"+c),this._M_&&b<=this._H_&&this._L_(c)},addO:function(a,b){this._O_[a]=b},getStatus:function(){return this._O_},playTime:function(){var a=CKobject,b=a._V_["currentTime"];a._O_["time"]=b,a._J_>0&&b>a._J_&&(a._J_=0,a.videoSeek(a._O_["totaltime"])),a.returnStatus("time:"+b,1)}};window.CKobject=CKobject}();

function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
	var r = window.location.search.substr(1).match(reg); //匹配目标参数
	if(r != null) return unescape(r[2]);
	return null; //返回参数值
	}
var support = function (){
if( ispad ) {
var support=['all'];
}else {
var support=['iPad','iPhone','ios','android+false','msie10+false'];
} 
return support;
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
                CKobject.getObjectById('ckplayer_a1').play = true;
		//playerLoad = true;
	}
	function loadHandler() {
		player.addListener('time', timeHandler);
	}
	function timeHandler(t) {
		cookie.set('time_' + flss, t); 
	}

function getId( w ) { var re = new RegExp( w + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function getto( w ) { var re = new RegExp( w + "=([^\&]*)"); re.exec(document.location.href); return RegExp.$1;}
function height(){  var height=document.documentElement.clientHeight; return height; }

var hostname = window.location.hostname
var port = window.location.port || '80';
var isPad=navigator.userAgent.toLowerCase().match(/(ipod|ipad|iphone|android|coolpad|mmp|smartphone|midp|wap|xoom|symbian|j2me|blackberry|wince)/i) != null;
//var isPad = navigator.userAgent.match(/iPad|PAD|iPhone|Android|Linux|iPod/i) != null;
var loadeder=loadedHandler;var loadedHandler=loadedHandler;var loaded=loadedHandler;
var my_url="encodeURIComponent(window.location.href)";
var autoplay = "true";
var auto = "true";

var fnss=fnss();var f=fnss;
//var flss=fnss;
var hlss =hlss();var h=hlss;
var clss =clss();var c=clss;
var ukss =ukss();var uk=ukss;
var alss =alss();
var cswf =cswf();
var elss =elss();var e=elss;
var plss =plss();var p=plss;
var slss =slss();var s=slss; 
var fsss =fsss();var fs=fsss;
var lvss =lvss();var lv=lvss;
var a=alss?alss:flss?flss:tv;

function elss(){
var elss = '';
if(elss==null || elss==''){elss='0';}else{elss=elss;};
return elss;
}
function clss(){
var clss = getId('c')?getId('c'):'0';
return clss;
}
function ukss(){
var ukss = getId('u')?getId('u'):'0';
return ukss;
}
function alss(){
var alss = getId('a')?getId('a'): "tv";
if( fnss.indexOf("m3u") > 0) alss = "m3u8";else alss = alss;
return alss;
}
function cswf(){
if( fnss.indexOf('m3u') > 0) { var cswf = '../ck/m3u8.swf';} else { var cswf='../ck/ckplayer.swf';}
return cswf;
}
function slss(){
if( fnss.indexOf("m3u") > 0) {var slss = '4';} else {var slss = '0';}
return slss;
}
function hlss(){
if( fnss.indexOf("m3u") > 0) {var hlss = '4';} else {var hlss = "0";}
return hlss;
}
function plss(){
if( fnss !== 0) {var plss = '1';} else {var plss = "0";}
return plss;
}
function fsss(){
if( fnss.indexOf("m3u") > 0) {var fsss = '1';} else {var fsss = "0";}
return fsss;
}
function lvss(){
if( fnss.indexOf("m3u") > 0) {var lvss = '0';} else {var lvss = "1";}
return lvss;
}
function cPlayer(){
if( fnss.indexOf("m3u") > 0) {
var flashvars={f:'../ck/m3u8.swf',a:flss,s:4,c:0,v:98,e:e,p:1,h:4,lv:lv,fs:1,q:'',loaded:loaded,my_url:my_url};
} else {
var flashvars= {f:flss, s:s, c:0, v:98, e:e, p:1, h:4, lv:lv, fs:1,q:'',loaded:loaded,my_url:my_url};
};
if( fnss.indexOf("m3u") > 0) {
var video=[fnss+'->video/m3u8',fnss+'->video/flv',fnss+'->video/mp4',fnss+'->video/webm',fnss+'->video/ogg'];
}else {
var video=[ fnss];
};
var autoplay=['true'];
var params = { bgcolor:'#000',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent',allowFullScreenInteractive:'true'};
var attributes = { id:'ckplayer_a1',name:'ckplayer_a1',menu:'false',autoplay:'true'};
var support=['iPad','iPhone','ios','android+false','msie10+false'];
CKobject.embed('../ck/ckplayer.swf','a1','ckplayer_a1','100%','100%',false,flashvars,video,params,attributes);
CKobject.embedHTML5('a1','ckplayer_a1','100%','100%',video,flashvars,support); 
Player.Html = '<embed src=cswf flashvars=flashvars bgcolor="#FFFFFF" quality="high" width="100%" height="100%" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" menu="false" always="false" type="application/x-shockwave-flash" allowFullScreenInteractive="true">';
}
function fnss(){
var ftss = "";
var fss1 = "https://v.youku.com/v_show/id_XMTAwNDk1OTky.html";
var fss2 = "http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
var cfts = "http://cctvalih5ca.v.myalicdn.com/live/";
var cfts1 = "http://cctvksh5ca.v.kcdnvip.com/clive/";
var cfts2 = "http://cctvksh5ca.v.kcdnvip.com/live/";
var cfts3 = "http://cctvcnch5ca.v.wscdns.com/live/";
var cfts4 = "http://cctvtxyh5ca.liveplay.myqcloud.com/live/";
var cfts5 = "http://14.152.88.77/liveplay-kk.rtxapp.com/live/program/live/";
var cfts6 = "http://14.152.88.77/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts7 = "http://219.151.31.43/keonline.shanghai.liveplay.qq.com/live/program/live/";
var cfts8 = "http://112.132.209.46/";

var fdss = getId('f')?getId('f'):"http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";
var fss = "http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8";//香港
  if( fdss==null||fdss=="") ftss =fss;else ftss=fdss;
  if( fdss.length <16) {
  if( fdss=="0"|| fdss=="jspd") ftss =cfts5 + "jspdhd/4000000/mnf.m3u8";//纪实频道;
else if( fdss=="1"|| fdss=="cctv1") ftss =cfts + "cctv1_2/index.m3u8";//cctv1;
else if( fdss=="2"|| fdss=="cctv2") ftss ="rtmp://cm.wshls.homecdn.com/live/11ecc";//cctv2;
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
else if(fdss=="29"|| fdss=="jlws"||fdss=="jilin") ftss =cfts5 + "jlws/1300000/mnf.m3u8";      //吉林卫视
else if(fdss=="30"|| fdss=="sdws"||fdss=="shandong") ftss =cfts5 + "sdwshd/4000000/mnf.m3u8"; //山东卫视
else if(fdss=="31"|| fdss=="hnws"||fdss=="hunan") ftss =cfts5 + "hnwshd/4000000/mnf.m3u8";    //湖南卫视
else if(fdss=="32"|| fdss=="btes"||fdss=="bintuan") ftss =cfts5 + "btws/1300000/mnf.m3u8";    //兵团卫视
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
else ftss =fdss;
}else ftss = fss;
return ftss;
}
/*
function loadedHandler(){
     if(CKobject.getObjectById('ckplayer_a1').getType()){
        CKobject.getObjectById('ckplayer_a1').addListener('error',errorHandler);
        CKobject.getObjectById('ckplayer_a1').addListener('ended',endedHandler);
        CKobject.getObjectById('ckplayer_a1').addListener('sendNetStream',playHandler);
	CKobject.getObjectById('ckplayer_a1').addListener('play',playHandler);
	CKobject.getObjectById('ckplayer_a1').addListener('pause',pauseHandler);        
}else{
        CKobject.getObjectById('ckplayer_a1').addListener('error','errorHandler');
        CKobject.getObjectById('ckplayer_a1').addListener('ended','endedHandler');
        CKobject.getObjectById('ckplayer_a1').addListener('sendNetStream','playHandler');
	CKobject.getObjectById('ckplayer_a1').addListener('play','playHandler');
	CKobject.getObjectById('ckplayer_a1').addListener('pause','pauseHandler');        } }
function playHandler(){
CKobject.getObjectById('ckplayer_a1').play;
CKobject.getObjectById('ckplayer_a1').style.display='none';}
function errorHandler(){sun=sun+1;if(sun<app.length){player();}else{sun=0;
        var err='?:\n\n';
                err=err+'???';
        alert(err);
        } }
function endedHandler(){
    CKobject.getObjectById('ckplayer_a1').newAddress('{p->p}{f->f}{autoplay->autoplay}{html5->flss->video/mp4}')
  }
*/
/*
html5部分开始
*/
(function() {
    var CKobject = {
  _K_: function(d){return document.getElementById(d);},
  _T_: false,_M_: false,_G_: false,_Y_: false,_I_: null,_J_: 0,_O_: {},
		uaMatch:function(u,rMsie,rFirefox,rOpera,rChrome,rSafari,rSafari2,mozilla,mobile){
			var match = rMsie.exec(u);
			if (match != null) {
				return {
					b: 'IE',
					v: match[2] || '0'
				} }
			match = rFirefox.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			match = rOpera.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			match = rChrome.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			match = rSafari.exec(u);
			if (match != null) {
				return {
					b: match[2] || '',
					v: match[1] || '0'
				} }
			match = rSafari2.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			match = mozilla.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			match = mobile.exec(u);
			if (match != null) {
				return {
					b: match[1] || '',
					v: match[2] || '0'
				} }
			else {
				return {
					b: 'unknown',
					v: '0'
				} }
		},
		browser: function() {
			var u = navigator.userAgent,
			rMsie = /(msie\s|trident.*rv:)([\w.]+)/,
			rFirefox = /(firefox)\/([\w.]+)/,
			rOpera = /(opera).+version\/([\w.]+)/,
			rChrome = /(chrome)\/([\w.]+)/,
			rSafari = /version\/([\w.]+).*(safari)/,
			rSafari2 = /(safari)\/([\w.]+)/,
			mozilla = /(mozilla)\/([\w.]+)/,
			mobile = /(mobile)\/([\w.]+)/;
			var c = u.toLowerCase();
			var d = this.uaMatch(c,rMsie,rFirefox,rOpera,rChrome,rSafari,rSafari2,mozilla,mobile);
			if (d.b) {
				b = d.b;
				v = d.v;
			}
			return {B: b, V: v};
        },
        Platform: function() {
            var w = '';
            var u = navigator.userAgent,
            app = navigator.appVersion;
            var b = {
                iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
                iPad: u.indexOf('iPad') > -1,
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
                webKit: u.indexOf('AppleWebKit') > -1,
				trident: u.indexOf('Trident') > -1,
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                presto: u.indexOf('Presto') > -1,
                mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/),
                webApp: u.indexOf('Safari') == -1
            };
            for (var k in b) {
                if (b[k]) {
                    w = k;
                    break;
                }
            }
            return w;
        },
		isHTML5:function(){
			return !!document.createElement('video').canPlayType;
		},
		getType:function(){
			return this._T_;
		},
        getVideo: function() {
            var v = '';
            var s = this._E_['v'];
            if (s && s.length>1) {
                for (var i = 0; i < s.length; i++) {
                    var a = s[i].split('->');
                    if (a.length >= 1 && a[0] != '') {
                        v += '<source src="' + a[0] + '"';
                    }
                    if (a.length >= 2 && a[1] != '') {
                        v += ' type="' + a[1] + '"';
                    }
                    v += '>';
                } }
            return v;
        },
        getVars: function(k) {
			var o=this._A_;
			if (typeof(o) == 'undefined') { 
				return null;
			}
            if (k in o) {
                return o[k];
            } else {
                return null;
            } },
        getParams: function() {
            var p = '';
            if (this._A_) {
                if (parseInt(this.getVars('p')) == 1) {   p += ' autoplay="autoplay"'; }
                if (parseInt(this.getVars('e')) == 1) {   p += ' loop="loop"';  }
                if (parseInt(this.getVars('p')) == 2) {   p += ' preload="metadata"'; }
                if (this.getVars('i')) {   p += ' poster="' + this.getVars('i') + '"';  } }
            return p;  },
        getpath: function(z) {
			var f='CDEFGHIJKLMNOPQRSTUVWXYZcdefghijklmnopqrstuvwxyz';
			var w=z.substr(0,1);
			if(f.indexOf(w)>-1 && (z.substr(0,4)==w+'://' || z.substr(0,4)==w+':\\')){
				return z; }
            var d = unescape(window.location.href).replace('file:///', '');
            var k = parseInt(document.location.port);
            var u = document.location.protocol + '//' + document.location.hostname;
            var l = '',
            e = '',
            t = '';
            var s = 0;
            var r = unescape(z).split('//');
            if (r.length > 0) {   l = r[0] + '//'  }
            var h = 'http|https|ftp|rtsp|mms|ftp|rtmp|file';
            var a = h.split('|');
            if (k != 80 && k) {  u += ':' + k;   }
            for (i = 0; i < a.length; i++) {
                if ((a[i] + '://') == l) {  s = 1;  break;  } }
            if (s == 0) {
                if (z.substr(0, 1) == '/') {    t = u + z;
                } else {
                    e = d.substring(0, d.lastIndexOf('/') + 1).replace('\\', '/');
                    var w = z.replace('../', './');
                    var u = w.split('./');
                    var n = u.length;
                    var r = w.replace('./', '');
                    var q = e.split('/');
                    var j = q.length - n;
                    for (i = 0; i < j; i++) {   t += q[i] + '/';   }
                    t += r;    }
            } else {   t = z; }
            return t; },
        getXhr: function() {
            var x;
            try {   x = new ActiveXObject('Msxml2.XMLHTTP');
            } catch(e) {
            try {   x = new ActiveXObject('Microsoft.XMLHTTP');
                } catch(e) {   x = false;  }
            }
            if (!x && typeof XMLHttpRequest != 'undefined') {
                x = new XMLHttpRequest(); }
            return x; },
		getX: function(){
			var f='ckstyle()';
			if (this.getVars('x') && parseInt(this.getVars('c'))!=1 ) {
				f=this.getVars('x')+'()';  }
		        try {
			if (typeof(eval(f)) == 'object') {
				this._X_ = eval(f); }
			} catch(e) {
			try {
			if (typeof(eval(ckstyle)) == 'object') {
				this._X_ = ckstyle(); }
				} catch(e) {
				this._X_ = ckstyle(); }
			} },
		getSn: function(s, n) {
			if(n>=0){ return this._X_[s].split(',')[n]; }
			else{ return this._X_[s]; } },
		getUrl: function(L, B) {
            var b = ['get', 'utf-8'];
            if (L && L.length == 2) {
                var a = L[0];
                var c = L[1].split('/');
                if (c.length >= 2) {  b[0] = c[1]; }
                if (c.length >= 3) {  b[1] = c[2]; }
                this.ajax(b[0], b[1], a,
                function(s) {
                    var C = CKobject;
                    if (s && s != 'error') {
                        var d = '',
                        e = s;
                        if (s.indexOf('}') > -1) {
                            var f = s.split('}');
                            for (var i = 0; i < f.length - 1; i++) {
                                d += f[i] + '}';
                                var h = f[i].replace('{', '').split('->');
                                if (h.length == 2) {
                                    C._A_[h[0]] = h[1];
                                }
                            }
                            e = f[f.length - 1];
                        }
                        C._E_['v'] = e.split(',');
                        if (B) {  C.showHtml5(); } 
                      else {   C.changeParams(d);
                               C.newAdr(); }
                    } });
            }  },
        getflashvars: function(s) {
            var v = '',
            i = 0;
            if (s) {
                for (var k in s) {
                    if (i > 0) {  v += '&'; }
                    if (k == 'f' && s[k] && ! this.getSn('pm_repc',-1)) {
                        s[k] = this.getpath(s[k]);
                    if (s[k].indexOf('&') > -1) { s[k] = encodeURIComponent(s[k]);   }  }
                    if (k == 'y' && s[k]) {  s[k] = this.getpath(s[k]);  }
                    v += k + '=' + s[k];
                    i++;
                }  }
            return v;
        },
        getparam: function(s) {
            var w = '',
            v = '',
            o = {
                allowScriptAccess: 'always',
                allowFullScreen: true,
                quality: 'high',
                bgcolor: '#000'
            };
            if (s) {
                for (var k in s) {
                    o[k] = s[k];
                }
            }
            for (var e in o) {
                w += e + '="' + o[e] + '" ';
                v += '<param name="' + e + '" value="' + o[e] + '" />';
            }
            w = w.replace('movie=', 'src=');
            return {
                w: w,
                v: v
            };
        },
        getObjectById: function(s) {
            if (this._T_) {
                return this;
            }
            var x = null,
            y = this._K_(s),
            r = 'embed';
            if (y && y.nodeName == 'OBJECT') {
                if (typeof y.SetVariable != 'undefined') {
                   x= y;
                } else {
                    var z = y.getElementsByTagName(r)[0];
                    if (z) {
                        x= z;
                    }
                }
            }
            return x;
        },
        ajax: function(b, u, s, f) {
            var x = this.getXhr();
            var a = [],
            m = '';
            if (b == 'get') {
                if (s.indexOf('?') > -1) {   m = s + '&t=' + new Date().getTime();
                } else {   m = s + '?t=' + new Date().getTime();  }
                x.open('get', m);
            } else {
                a = s.split('?');
                s = a[0],
                m = a[1];
                x.open('post', s, true);
            }
            x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            x.setRequestHeader('charset', u);
            if (b == 'post') {  x.send(m);
            } else {  x.send(null);
            }
            x.onreadystatechange = function() {
                if (x.readyState == 4) {
                    var g = x.responseText;
                    if (g != '') {   f(g);    } 
                else {   f(null);  }
             } }
        },
        addListener: function(e, f) {
			var o=CKobject._V_;
            if (o.addEventListener) {
			try{ o.addEventListener(e, f, false); }
			catch (e) { this.getNot(); }
            }
			else if (o.attachEvent) {
			try{ o.attachEvent('on' + e, f);  }
		catch(e){ this.getNot(); }
            }
			else {  o['on' + e] = f;
            }
        },
        removeListener: function( e, f) {
			var o=CKobject._V_;
            if (o.removeEventListener) {
			try{ o.removeEventListener(e, f, false); }
			catch(e){ this.getNot(); }
			}
			else if (o.detachEvent) {
			try{ o.detachEvent('on' + e, f);  }
			catch(e){ this.getNot(); }
			}
			else { o['on' + e] = null; }
        },
        Flash: function() {
            var f = false,v = 0;
            if (document.all  || this.browser()['B'].toLowerCase().indexOf('ie')>-1) {
                try {
                    var s = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
                    f = true;
                    var z = s.GetVariable('$version');
                    v = parseInt(z.split(' ')[1].split(',')[0]);
                } catch(e) {}
            } else {
                if (navigator.plugins && navigator.plugins.length > 0) {
                    var s = navigator.plugins['Shockwave Flash'];
                    if (s) {
                        f = true;
                        var w = s.description.split(' ');
                        for (var i = 0; i < w.length; ++i) {
                            if (isNaN(parseInt(w[i]))) continue;
                            v = parseInt(w[i]);
                        }
                    }
                }
            }
            return {
                f: f,
                v: v
            };
        },
		embed:function(f,d,i,w,h,b,v,e,p){
			var s=['all'];
			if(b){
				if(this.isHTML5()){ this.embedHTML5(d,i,w,h,e,v,s,autoplay); }
				else{ this.embedSWF(f,d,i,w,h,v,p); }
			}
			else{
				if(this.Flash()['f'] && parseInt(this.Flash()['v'])>10){
					this.embedSWF(f,d,i,w,h,v,p); }
				else if(this.isHTML5()){ this.embedHTML5(d,i,w,h,e,v,s,autoplay); }
				else{ this.embedSWF(f,d,i,w,h,v,p); }
			}
		},
		embedSWF: function(C, D, N, W, H, V, P) {
            if (!N) {  N = 'ckplayer_a1'  }
            if (!P) {
          P = { bgcolor: '#FFF',allowFullScreen: true,allowScriptAccess: 'always',wmode:'transparent' }; }
		this._A_=V;
		this.getX();
            var u = 'undefined',
		g = false,
            j = document,
            r = 'http://www.macromedia.com/go/getflashplayer',
            t = '<a href="' + r + '" target="_blank">请点击此处下载安装最新的flash插件</a>',
            error = {
                w: '您的网页不符合w3c标准，无法显示播放器',
                f: '您没有安装flash插件，无法播放视频，' + t,
                v: '您的flash插件版本过低，无法播放视频，' + t
            },
            w3c = typeof j.getElementById != u && typeof j.getElementsByTagName != u && typeof j.createElement != u,
            i = 'id="' + N + '" name="' + N + '" ',
            s = '',
            l = '';
            P['movie'] = C;
            P['flashvars'] = this.getflashvars(V);
			if(W==-1){
				d=true;
				this._K_(D).style.width='100%';
				W='100%';
			}
            s += '<object pluginspage="http://www.macromedia.com/go/getflashplayer" ';
            s += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
            s += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" ';
            s += 'width="' + W + '" ';
            s += 'height="' + H + '" ';
            s += i;
            s += 'align="middle">';
            s += this.getparam(P)['v'];
            s += '<embed ';
            s += this.getparam(P)['w'];
            s += ' width="' + W + '" height="' + H + '" name="' + N + '" id="' + N + '" align="middle" ' + i;
            s += 'type="application/x-shockwave-flash" pluginspage="' + r + '" />';
            s += '</object>';
            if (!w3c) {
                l = error['w'];
				g = true;
            } else {
                if (!this.Flash()['f']) {
                    l = error['f'];
				g = true;
                } else {
                    if (this.Flash()['v'] < 10) {
                    l = error['v'];
				g = true;
                    } else {
                    l = s;
				this._T_=false;
                    }
                }
            }
            if (l) {
                this._K_(D).innerHTML = l;
            }
			if (g){
				this._K_(D).style.color = '#0066cc';
				this._K_(D).style.lineHeight = this._K_(D).style.height;
				this._K_(D).style.textAlign= 'center';
			}
        },
        embedHTML5: function(C, P, W, H, V, A, S) {
            this._E_ = {
                c: C,
                p: P,
                w: W,
                h: H,
                v: V,
                autoplay : true,
                s: S
            };
            this._A_ = A;
			this.getX();
            b = this.browser()['B'],
            v = this.browser()['V'],
            x = v.split('.'),
            t = x[0],
            m = b + v,
            n = b + t,
            w = '',
            s = false,
            f = this.Flash()['f'],
            a = false;
            if (!S) {
                S = ['iPad', 'iPhone', 'ios'];
            }
            for (var i = 0; i < S.length; i++) {
                w = S[i];
                if (w.toLowerCase() == 'all') {
                    s = true;
                    break;
                }
                if (w.toLowerCase() == 'all+false' && !f) {
                    s = true;
                    break;
                }
                if (w.indexOf('+') > -1) {
                    w = w.split('+')[0];
                    a = true;
                } else {
                    a = false;
                }
                if (this.Platform() == w || m == w || n == w || b == w) {
                    if (a) {
                        if (!f) {
                            s = true;
                            break;
                        }
                    }else {
                        s = true;
                        break;
                    }
                }
            }
            if (s) {
                if (V) {
                    var l = V[0].split('->');
                    if (l && l.length == 2 && l[1].indexOf('ajax') > -1) {
                        this.getUrl(l, true);
                        return;
                    }
                }
                this.showHtml5();
            }
        },
        status: function() {
            this._H_ = parseInt(this.getSn('setup', 20));
			var f='ckplayer_status';
			if (this.getSn('calljs', 0)!='') {
				f=this.getSn('calljs', 0);
			}
			try {
				if (typeof(eval(f)) == 'function') {
					this._L_=eval(f);
					this._M_=true;
					return true;
				}
			} catch(e) {
				try {
					if (typeof(eval(ckplayer_status)) == 'function') {
						this._L_=ckplayer_status;
						this._M_=true;
						return true;
					}
				} catch(e) {
					return false;
				}
			}
			return false;
        },
        showHtml5: function() {
            var C = CKobject;
            var p = C._E_['p'],
			a = C._E_['v'],
			c = C._E_['c'],
			b = false;
			var s = this._E_['v'];
			var w=C._E_['w'],h=C._E_['h'];
			var d=false;
			var r='';
			if(s.length==1){
				r=' src="'+s[0].split('->')[0]+'"';
			}
			if(w==-1){
				d=true;
				C._K_(c).style.width='100%';
				w='100%';
			}
			if(w.toString().indexOf('%')>-1){
				w='100%';
			}
			if(h.toString().indexOf('%')>-1){
				h='100%';
			}
			var v = '<video controls'+r+' id="' + p + '" width="' + w + '" height="' + h + '"' + C.getParams() + '>' + C.getVideo() + ' autoplay="true"</video>';
            C._K_(c).innerHTML = v;
			
            C._K_(c).style.backgroundColor = '#000';
            C._V_ = this._K_(p);
			if(!d){
				C._K_(c).style.width=this._E_['w'].toString().indexOf('%')>-1?(C._K_(c).offsetWidth*parseInt(this._E_['w'])*0.01)+'px':C._V_.width+'px';
				C._K_(c).style.height=this._E_['h'].toString().indexOf('%')>-1?(C._K_(c).offsetHeight*parseInt(this._E_['h'])*0.01)+'px':C._V_.height+'px';
			}
            C._P_ = false;
            C._T_ = true;
			if (C.getVars('loaded')!='') {
				var f=C.getVars('loaded')+'()';
				try {
                	if (typeof(eval(f)) == 'function') {
						eval(f);
					}
				} catch(e) {
					try {
						if (typeof(eval(loadedHandler)) == 'function') {
							loadedHandler();
						}
					} catch(e) {
					}
				}
            }
            C.status();
			C.addListener('play', C.playHandler);
			C.addListener('pause', C.playHandler);
			C.addListener('error', C.errorHandler);
			C.addListener('emptied', C.errorHandler);
			C.addListener('loadedmetadata', C.loadedMetadataHandler);
			C.addListener('ended', C.endedHandler);
			C.addListener('volumechange', C.volumeChangeHandler);
        },
        videoPlay: function() {
            if (this._T_) {
                this._V_.play();
            }
        },
        videoPause: function() {
            if (this._T_) {
                this._V_.pause();
            }
        },
        playOrPause: function() {
            if (this._T_) {
                if (this._V_.paused) {
                    this._V_.play();
                } else {
                    this._V_.pause();
                }
            }
        },
        fastNext: function() {
            if (this._T_) {
                this._V_['currentTime'] = this._V_['currentTime'] + 10;
            }
        },
        fastBack: function() {
            if (this._T_) {
                this._V_['currentTime'] = this._V_['currentTime'] - 10;
            }
        },
        changeVolume: function(n) {
            if (this._T_) {
                this._V_['volume'] = n * 0.01;
            }
        },
        videoSeek: function(t) {
            if (this._T_) {
                this._V_['currentTime'] = t;
            }
        },
        newAddress: function(u) {
            var s = [];
            if (u) {
                s = this.isHtml5New(u);
            } else {
                return;
            }
            if (s && this._T_) {
                this.changeParams(u);
                var l = s[0].split('->');
                if (l && l.length == 2 && l[1].indexOf('ajax') > -1) {
                    this.getUrl(l, false);
                    return;
                }
                this._E_['v'] = s;
                this.newAdr();
            }
        },
		quitFullScreen:function() {
			if(document.cancelFullScreen) {
				document.cancelFullScreen();
			} 
			else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitCancelFullScreen) {
	   			document.webkitCancelFullScreen();
			}

		},
		changeStatus:function(n){
			this._H_=n;
		},
        newAdr: function() {
			var s = this._E_['v'];
            this._V_.pause();
			if(s.length==1){
            	this._V_.src=s[0].split('->')[0];
			}
			else{
				this._V_['innerHTML'] = this.getVideo();
			}
            this._V_.load();
        },
        isHtml5New: function(s) {
            if (s.indexOf('html5') == -1) {
                return false;
            }
            var a = s.replace(/{/g, '');
            var b = a.split('}');
            var c = '';
            var autoplay = "true";
            for (var i = 0; i < b.length; i++) {
                if (b[i].indexOf('html5') > -1) {
                    c = b[i].replace('html5->', '').split(',');
                    break;
                }
            }
            return c;
        },
        changeParams: function(f) {
            if (f) {
                var a = f.replace(/{/g, '');
                var b = a.split('}');
                var c = '';
                for (var i = 0; i < b.length; i++) {
                    var d = b[i].split('->');
					if(d.length == 2){
						switch(d[0]){
							case 'p':
								if(parseInt(d[1]) == 1){
									this._V_.autoplay = true;
								}
								else if(parseInt(d[1]) == 2){
									this._V_.preload = 'metadata';
								}
								else{
									this._V_.autoplay = false;
									if(this._I_!=null){
										clearInterval(this._I_);
										this._I_=null;
									}
								}
								break;
							case 'e':
								if(parseInt(d[1]) == 1){
									this._V_.loop = true;
								}
								else{
									this._V_.loop = false;
								}
								break;
							case 'i':
								this._V_.poster = d[1];
								break;
							default:
								break;
						}
					}
                }
            }
        },
        frontAdPause: function(s) {
            this.getNot();
        },
        frontAdUnload: function() {
            this.getNot();
        },
        changeFace: function(s) {
            this.getNot();
        },
        plugin: function(a, b, c, d, e, f, g) {
            this.getNot();
        },
        videoClear: function() {
            this.getNot();
        },
        videoBrightness: function(s) {
            this.getNot();
        },
        videoContrast: function(s) {
            this.getNot();
        },
        videoSaturation: function(s) {
            this.getNot();
        },
        videoSetHue: function(s) {
            this.getNot();
        },
        videoWAndH: function(a, b) {
            this.getNot();
        },
        videoWHXY: function(a, b, c, d) {
            this.getNot();
        },
		changeFlashvars: function(a) {
            this.getNot();
        },
		changeMyObject: function(a, b) {
            this.getNot();
        },
		getMyObject: function(a, b) {
            this.getNot();
        },
		changeeFace: function() {
            this.getNot();
        },
		changeStyle: function(a, b) {
            this.getNot();
        },
		promptLoad: function() {
            this.getNot();
        },
		promptUnload: function() {
            this.getNot();
        },
		marqueeLoad: function(a,b) {
            this.getNot();
        },
		marqueeClose: function(s) {
            this.getNot();
        },
        getNot: function() {
            var s='The ckplayer\'s API for HTML5 does not exist';
			return s;
        },
        volumeChangeHandler: function() {
            var C = CKobject;
            if (C._V_.muted) {
                C.returnStatus('volumechange:0', 1);
                C._O_['volume'] = 0;
                C._O_['mute'] = true;
            } else {
                C._O_['mute'] = false;
                C._O_['volume'] = C._V_['volume'] * 100;
                C.returnStatus('volumechange:'+C._V_['volume'] * 100, 1);
            }
        },
        endedHandler: function() {
            var C = CKobject;
			var e=parseInt(C.getVars('e'));
            C.returnStatus('ended', 1);
			if(C._I_){
				clearInterval(C._I_);
				C._I_=null;
			}
            if ( e!= 0 && e !=4 && e !=6) {
                return;
            }
			if(e==6){
				this.quitFullScreen();
			}
			var f='playerstop()';
			if (C.getSn('calljs', 2)!='') {
				f=C.getSn('calljs', 2)+'()';
			}
			try {
				if (typeof(eval(f)) == 'function') {
					eval(f);
					return;
				}
			} catch(e) {
				try {
					if (typeof(eval(playerstop)) == 'function') {
						playerstop();
						return;
					}
				} catch(e) {
					return;
				}
			}
        },
        loadedMetadataHandler: function() {
            var C = CKobject;
            C.returnStatus('loadedmetadata', 1);
            C._O_['totaltime'] = C._V_['duration'];
            C._O_['width'] = C._V_['width'];
            C._O_['height'] = C._V_['height'];
            C._O_['awidth'] = C._V_['videoWidth'];
            C._O_['aheight'] = C._V_['videoHeight'];
            if (C._V_.defaultMuted) {
                C.returnStatus('volumechange:0', 1);
                C._O_['mute'] = true;
                C._O_['volume'] = 0;
            } else {
                C._O_['mute'] = false;
                C._O_['volume'] = C._V_['volume'] * 100;
                C.returnStatus('volumechange:'+C._V_['volume'] * 100, 1);
            }
        },
        errorHandler: function() {
            CKobject.returnStatus('error', 1);
        },
        playHandler: function() {
            var C = CKobject;
            if (C._V_.paused) {
                C.returnStatus('pause', 1);
                C.addO('play', false);
				if(C._I_!=null){
					clearInterval(C._I_);
					C._I_=null;
				}
            } else {
                C.returnStatus('play', 1);
                C.addO('play', true);
                if (!C._P_) {
                    C.returnStatus('play', 1);
                    C._P_ = true;
                }
                C._I_ = setInterval(C.playTime, parseInt( C.getSn('setup', 37)));
				if(!C._G_){
					C._G_=true;
					for(var k in C._A_){
						if(k=='g' && C._A_[k]){
							var g=parseInt(C._A_[k]);
							C.videoSeek(g);
						}	
					}
				}
				if(!C._Y_){
					C._Y_=true;
					for(var k in C._A_){
						if(k=='j' && C._A_[k]){
							var j=parseInt(C._A_[k]);
							if(j>0){
								C._J_=j;
							}
							else{
								C._J_=parseInt(C._O_['totaltime'])+j;
							}
						}	
					}
				}
            }
        },
        returnStatus: function(s, j) {
            var h = s;
            if (this._H_ == 3) {
                h = this._E_['p'] +'->'+ h;
            }
            if (this._M_ && j <= this._H_ ) {
                this._L_(h);
            }
        },
        addO: function(s, z) {
            this._O_[s] = z;
        },
        getStatus: function() {
            return this._O_;
        },
        playTime: function() {
            var C = CKobject;
            var t = C._V_['currentTime'];
            C._O_['time'] = t;
			if(C._J_>0 && t>C._J_){
				C._J_=0;
				C.videoSeek(C._O_['totaltime']);
			}
            C.returnStatus('time:' + t, 1);
        }
    }
    window.CKobject = CKobject; })();
/*
html5 部分结束
======================================================
SWFObject v2.2
如果你的网站里已经有swfobject类，可以删除下面的
*/