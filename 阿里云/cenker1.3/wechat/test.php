<!--------------------------------------------------------------------
--@Author:���ڴ�ѧ��԰����2014�������Ա
--@Time:21/5/2014
--@��Ȩ����
--@˵��:ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
-->
<?php
/*
 * ѧ�Ű󶨲���
 */
	require_once("../class/database.php");
	require_once("../class/wechat_db.php");
	require_once("wechat_func.php");
	require_once("interface.php");
	$openid = "otS7tjqHc9MChh-rBExWv8vANTk8";
	
	$db = new saeDatabase();
	//print_r(get_my_room_record($db,$openid));
	if ($result = getTelPhoneWithName($db, "����")){
		//print_r($result);
		$count = count($result);
		$content = "";
		$mytext = "%s ��ϵ�绰\n%s\n";
		for ($i=0;$i<$count;$i++){
			$content .= sprintf($mytext,$result[$i]['name'],$result[$i]['phone']); 
		}
		echo $content."\n";
	}else{
		echo "error\n";
	}
?>