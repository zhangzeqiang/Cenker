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
	/*print_r(delete_room_with_orderNum($openid));*/
	/*$type_str = WINDOWS::$type['activity_apply_type'];
	$type_str = str_replace("��", ";", $type_str);
	$type_str = str_replace("��", ";", $type_str);
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
	$data = "����";
	//�жϷ����Ƿ����
	$type_list = get_type_with_activity_apply_type();

	setTempDataWithIndex($fromUsername, "test", $type_list[2]);		//������ʱ����

	$type_list_count = count($type_list);
	$bool = false;
	$i = 0;
	for(;$i<$type_list_count;$i=$i+2){			//�ж��û����������
		if ($data == $i){
			$data = $type_list[$i+1];			//ƥ�䵽����,������ת��������
			$bool = true;
			break;
		}
	}
	$i = 1;
	for(;$i<$type_list_count;$i=$i+2){			//�ж��û���������ַ���
		if ($data == $type_list[$i]){			//ƥ�䵽����
			$bool = true;
			break;
		}
	}
	if ($bool !== false){		//���Ϲ��������
		$index = "activity_apply_type";
		setTempDataWithIndex($fromUsername, $index, $data);		//������ʱ����
		$code = "120";
	}else{			//�����Ϲ��������
		$code = "903";
	}
	/*$list = getGwtList();
	print_r($list);*/

	//$data = "����ǿ";
	//$index = "bindToStudent_no";
	/*echo "test";
	echo setTempDataWithIndex($openid, $index, $data);

	/*echo "<br>";
	echo "test2";*/
	//$student_no = "2011130019";
	//$student_no = getTempDataWithIndex($openid, $index);
	//echo getNameWithStudentNo($student_no);
	/*echo "df";
	$db = new saeDatabase();							//��ʼ�����ݿ�
	$wechat_user_db = new wechat_usr_lesson_db($db);

	$list['openid'] = $openid;
	$list['student_no'] = "2011130019";
	$list['code'] = "21";													
	$list['other'] = '';
	$wechat_user_db->bindingWithStudentNO($list);*/
	//$openid = "hello world";
	/*$data = "����ǿ";
	$index = "activity_apply_subject";
	setTempDataWithIndex($openid, $index, $data);	//������ʱ����
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