<?php
//将微信二维码图片转换为链接
function img_parse($img_url){
//	else{
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://zxing.org/w/decode?u=".$img_url);//设置请求url地址 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //是否显示内容
    $rule="%<pre[^>]*>(.*?)</pre>%si";
	$content=curl_exec($ch);
    preg_match($rule,$content,$rs);
	curl_close($ch);
	$res=strstr($rs[1],"http://weixin.qq.com/g/");
	if($res==false)
   return false;
   else
	return $rs[1];
//	}
	}