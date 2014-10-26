<?php
	function isMobile(){
		$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
		function CheckSubstrs($substrs,$text){
			foreach($substrs as $substr)
				if(false!==strpos($text,$substr)){
				return true;
			}
			return false;
		}
		$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
		$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');
	 
		$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
		CheckSubstrs($mobile_token_list,$useragent);
	 
		if ($found_mobile){
			return true;
		}else{
			return false;
		}
	}
	if (isMobile()){
		header("Location:mobile/index.php");
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>标题</title>
        <style type='text/css'>
			body{background:#D6D6D6;}
            div.layout{text-align:center;border:1px #8F8F8F solid;width:50%;height:100%;padding:40px 5px 10px 5px;margin:auto auto auto auto;background:white;}
		</style>
	</head>
	<body>
		<div class='layout'>
			<form action='index.php' method='post'>
				<label>【注册活动版块】</label><br>
				活动:<input type='text'><br>
				电脑端访问。
			</form>
			
		</div>
	</body>
</html>