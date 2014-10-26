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
	/*print_r(delete_room_with_orderNum($openid));*/
	/*$type_str = WINDOWS::$type['activity_apply_type'];
	$type_str = str_replace("【", ";", $type_str);
	$type_str = str_replace("】", ";", $type_str);
	$type_list = explode(";",$type_str);
	$count = count($type_list);

	for ($i=0,$j=0;$i<$count;$i++){
		if ($i!==0){
			/*$num = $i%2;
			if ($num === 0){*/
			/*	$my_type_list[$j++]=$type_list[$i];
			//}
		}
	}
	print_r($my_type_list);*/
	/*echo "hello";
	setTempDataWithIndex("1", "mytest", "first");
	$db = new saeDatabase();
	$sql = "select*from class limit 2";
	print_r($db->select($sql));*/
	/*$data = "交友";
	//判断分类是否符合
	$type_list = get_type_with_activity_apply_type();

	setTempDataWithIndex($fromUsername, "test", $type_list[2]);		//存入临时表中

	$type_list_count = count($type_list);
	$bool = false;
	$i = 0;
	for(;$i<$type_list_count;$i=$i+2){			//判断用户输入的数字
		if ($data == $i){
			$data = $type_list[$i+1];			//匹配到分类,将数字转化成文字
			$bool = true;
			break;
		}
	}
	$i = 1;
	for(;$i<$type_list_count;$i=$i+2){			//判断用户输入的文字分类
		if ($data == $type_list[$i]){			//匹配到分类
			$bool = true;
			break;
		}
	}
	if ($bool !== false){		//符合规则的输入
		$index = "activity_apply_type";
		setTempDataWithIndex($fromUsername, $index, $data);		//存入临时表中
		$code = "120";
	}else{			//不符合规则的输入
		$code = "903";
	}*/
	/*$list = getGwtList();
	print_r($list);*/

	//$data = "张泽强";
	//$index = "bindToStudent_no";
	/*echo "test";
	echo setTempDataWithIndex($openid, $index, $data);

	/*echo "<br>";
	echo "test2";*/
	/*$student_no = "2011130019";
	$student_no = getTempDataWithIndex($openid, $index);*/
	/*$student_no = "2011130019";
	echo getNameWithStudentNo($student_no);*/
	//$db = new saeDatabase();							//初始化数据库
	/*$wechat_user_db = new wechat_usr_lesson_db($db);
	$openid = "1";
	$code = "21";
	$wechat_user_db->set_interact_code($openid, $code);*/
	/*insert_wechat_user_instruct($openid,"sister");
	insert_wechat_user_instruct($openid,"sister1");
	echo "final";*/
	$db = new saeDatabase();
	print_r(get_my_room_record($db,$openid));
	/*echo "df";
	$db = new saeDatabase();							//初始化数据库
	$wechat_user_db = new wechat_usr_lesson_db($db);

	$list['openid'] = $openid;
	$list['student_no'] = "2011130019";
	$list['code'] = "21";													
	$list['other'] = '';
	$wechat_user_db->bindingWithStudentNO($list);*/
	//$openid = "hello world";
	/*$data = "张则强";
	$index = "activity_apply_subject";
	setTempDataWithIndex($openid, $index, $data);	//存入临时表中
	$index = "activity_apply_subject";
	getAndDeleteTempWithIndex($openid, $index);
	echo "hello";*/
	/*$activity_apply_list[0] = "activity_apply_subject";
	$activity_apply_list[1] = "activity_apply_type";
	$activity_apply_list[2] = "activity_apply_time";
	$activity_apply_list[3] = "activity_apply_content";
	$activity_apply_list[4] = "activity_apply_place";
	$activity_apply_list[5] = "activity_apply_join_type";
	$activity_apply_list[6] = "activity_apply_other";

	echo activity_apply_submit_handle($openid, $activity_apply_list);*/
	//print_r(getActivityList());
	
?>