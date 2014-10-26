<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<?php
/*
 * 学号绑定测试
 */
	require_once("../class/database.php");
	require_once("../class/wechat_db.php");
	require_once("wechat_func.php");
	require_once("interface.php");
	$openid = "otS7tjqHc9MChh-rBExWv8vANTk8";
	
	$db = new saeDatabase();
	//print_r(get_my_room_record($db,$openid));
	if ($result = getTelPhoneWithName($db, "主任")){
		//print_r($result);
		$count = count($result);
		$content = "";
		$mytext = "%s 联系电话\n%s\n";
		for ($i=0;$i<$count;$i++){
			$content .= sprintf($mytext,$result[$i]['name'],$result[$i]['phone']); 
		}
		echo $content."\n";
	}else{
		echo "error\n";
	}
?>