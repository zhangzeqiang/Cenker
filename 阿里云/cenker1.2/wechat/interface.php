<?php
/*--------------------------------------------------------------------
 *--@Author:���ڴ�ѧ��԰����2014�������Ա
 *--@Time:21/5/2014
 *--@��Ȩ����
 *--@˵��:ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
 */
/*//////////////////////////////////////////////////////////////////
 * ---------------------  ������URL -------------------------------
 *///////////////////////////////////////////////////////////////////
class URL{
	//public static $LOCAL = "http://3.szunbbs.sinaapp.com";
	public static $LOCAL = "http://114.215.101.188/cenker";
}
/*///////////////////////////////////////////////////////////////////
 * -------------------------- END ----------------------------------
 *///////////////////////////////////////////////////////////////////

/*///////////////////////////////////////////////////////////////////
 * ------------------- TODO �ַ��������涨�� -------------------------
 *///////////////////////////////////////////////////////////////////
class WINDOWS{

	public static $type = array(

	/*activity_main
	another
	activity_register
	activity_show*/

	/*
	 * �����ҳ
	 */
	wechat_main => "
	��1�����ز��
	��2���ҵĿγ�
	��3�������
	��4��������
	��5������ͨСվ
	��6�����<a href='http://www.szubike.com/'>΢����</a>
	��7��������Ѷ
	��8����ݲ�ѯ
	��9����ѧ��
	��10���ɰ�
	����������ʾ��ҳ
	���ร���������ڴ���
	",
	wechat_main_pictxt => "
	        ��1�����ز��
	        ��2���ҵĿγ�
	        ��3�������
	        ��4��������
	        ��5������ͨСվ
	        ��6�����΢����
	        ��7��������Ѷ
	        ��8����ݲ�ѯ
	        ��9����ѧ��
	        ��10���ɰ�
	         ����������ʾ��ҳ
	",
	/*
	 * �ҵĿγ�
	 */
	my_lesson => "
	<a href='%s/mobile/index.php?action=%s&student_no=%s'>���</a>��ҳ���ҵĿγ�
	��1�����ز��
	��2�����ݿγ����鿴
	��3������ʱ��鿴
	�������������ҵĿγ���ҳ
	���ร���������ڴ���",

	lesson_check_with_name => "
	@����γ���",


	lesson_check_with_time => "
	��Tip��ģʽ:����һ7,8,9
	@����ʱ���",
	
	lesson_check_success => "
	@�γ���Ϣ:
	��1�����ز��
	��2�������ҵĿγ�",
	
	lesson_check_fail => "
	@�����ڼ�¼",
	
	/*
	 * ��ǰ�
	 */
	activity_main => "
	�鿴�
	��1�����ز��
	��2����ӻ
	��3���鿴�",
	
	/*
	 *�鿴�
	 */
	activity_show_main=>"
	��1�����ز��
	��2������
	��3���Լ�����Ļ
	",
	
	activity_douban =>"
	@����",


	activity_show => "
	@�Լ�����Ļ",



	activity_apply => "
	@��ӳɹ�",
	
	/*
	 * ��ӻ
	 */
	activity_apply_main => "
	��д���
	��1�����ز��
	��2������(����)
	��3������(��ѡ)
	��4��ʱ��(����)
	��5������(����)
	��6���ص�(����)
	��7��������ʽ(��ѡ)
	��8����ע(�������õ�)
	��9���ύ",

	activity_apply_subject => "
	��������",
	
	/*///////////////////////////////////////////////////////////////////////
	 * ����࣬ע�⣬��ʽ�����һ�µ�ƥ�䣬��Ϊϵͳ�û���ӵĻ������
	 * �����Ϊ׼��
	 * ---------------------------------------------------------------------
							ѡ������
							��1������
							��2����ְ
							 ...
							��n������
	 * -------------------------- END ---------------------------------------
	 *////////////////////////////////////////////////////////////////////////
	activity_apply_type => "
	ѡ������
	��1������
	��2����ְ
	��3������
	��4������
	��5���ƹ�
	��6������",
	
	activity_apply_time => "
	����ʱ��",

	activity_apply_content => "
	��������",

	activity_apply_place => "
	�����ص�",

	activity_apply_join_type => "
	������ϵ��ʽ",
	
	activity_apply_other => "
	����(��������)",

	activity_apply_submit =>"
	�ύ�ɹ�",
	activity_apply_fail => "
	%s����Ϊ��",
	activity_apply_return_txt => "
	�ظ����ⷵ��",

	/*
	 * ��ѧ��
	 */
	bindToStudent => "
	@��������Ҫ�󶨵�ѧ��",
	
	bindNameCheck => "
	@������ʵ����������֤",

	bindToStudentSuccess => "
	@ѧ�Ű󶨳ɹ�",

	bindToStudentFail => "
	@ѧ�Ű󶨳���
	��1�����ز��
	��2��������
	",
	/*
	 * ������
	 */
	room_apply_main_add => "
	�����뷿����",
	room_apply_send_QR_Code => "
	���ϴ���ά��",
	room_apply_send_QR_Code_success => "
	�ϴ��ɹ�,�����ɹ�",
	room_apply_send_QR_Code_fail => "
	@��ά�벻����Ҫ��
	�������ϴ���ά��",

	room_apply_main => "
	��1�����ز��
	��2����ӷ���
	��3���鿴����
	��4���˳�����",
	
	room_apply_main_show => "
	�鿴����",
	room_apply_main_delete_list => "
	�ظ�Ҫ��ɢ�ķ����\n",
	room_apply_main_delete => "
	�ɹ���ɢ����",
	room_apply_main_delete_fail => "
	��ɢ����ʧ��",
	/*
	 * ����ͨ
	 */
	news_main=>"
	@����ͨСվ,����Ŭ��������",
	//ͬ�鿴���һ��������ʾ
	
	/*
	 * �绰
	 */
	telephone_main=>"
	��1�����ز��
	��2����ְ��
	��3��Ժϵ�칫��
	��4������
	���ร���������ڴ���",
	telephone_ask=>"
	������ؼ��ʣ��������ȣ�",
	telephone_answer_success=>"
	����ҵĿ����ǣ�
	%s",
	telephone_answer_fail=>"
	δ�ҵ�����
	��1�����ز��",
	
	wechat_zoon => "
	<a href='http://www.szubike.com/'>����</a>΢����
	��΢�ŵ���޷���ʾ���������Ͻǵ��ʹ���������",
	/*
	 * ����
	 */
	weather_main=>"
	��1�����ز��
	��2����������
	��3����������
	���ร���������ڴ���",

	weather_local=>"
	�뷢����Ķ�λ��ַ��cenker�������κ���ʽ�ռ����ĸ�����Ϣ��",

	weather_other=>"
	��������Ҫ��ѯ�ĳ�����",

	weather_show=>"",//����չʾ������ͼ����Ϣ����

	weather_show_error=>"
	��ѯʧ��
	��1�����ز��",

	/*
	 * ���
	 */
	express_main=>"
	��1�����ز��
	��2����ݵ���(����)
	���ร���������ڴ���",

	express_company=>"
	�������ݹ�˾����",

	express_number=>"
	�������ݵ���",

	express_submit_success=>"
	%s",

	express_submit_fail=>"
	�Բ���δ��ѯ���õ���",
	
	/*
	 * �ܱ�����
	 */
	localLife_main=>"
	��1�����ز��
	��2����Ժ�
	��3��������
	��4��������
	��5����ס��
	��6�������
	���ร���������ڴ���
	",
	localLife_eat=>"��δ���ţ����ร���������ڴ���",
	localLife_play=>"��δ���ţ����ร���������ڴ���",
	localLife_visit=>"��δ���ţ����ร���������ڴ���",
	localLife_live=>"��δ���ţ����ร���������ڴ���",
	localLife_transport=>"��δ���ţ����ร���������ڴ���",
	
	/*
	 * ������Ϣ
	 */
	develop => "
	@����Ŭ��������
	�����ע",
	
	no_define => "
	δ����,����������",
	
	welcome => "��ӭ���Ĳ��",
	
	invalid => "���Ϸ�������",
	/*
	 * ����ϵͳ
	 */
	
	/*///////////////////
	 * NOTICE:
	 * 1������ַ�����ע�ⲻҪ��©','
	 * 2�������other��Ҫɾ��
	 *//////////////////
	other => " "
	);
}
/*//////////////////////////////////////////////////////////////////////
 *-------------------------- THE END -----------------------------------
 *///////////////////////////////////////////////////////////////////////

 
/*//////////////////////////////////////////////////////////////////////
 * --------------------- TODO �û��¼������붨�� ----------------------------
 *//////////////////////////////////////////////////////////////////////
class CONSTANTS{
	
	public static $code_list = array (
	/*
	 * ԭ��:0��ʾ��ҳ.ÿ������ռ10~20���������
	 */
		/**
		 * �û��
		 * ��Χ:10 - 20
		 */
		10 => "activity_main",
		11 => "activity_show",
		12 => "activity_apply",
		13 => "activity_show_main",

		/*
		 * ѧ�Ű�
		 */
		20 => "bindToStudent",
		21 => "bindNameCheck",
		22 => "bindToStudentSuccess",
		23 => "bindToStudentFail",
		
		/*
		 * �ҵĿγ� 
		 */
		30 => "my_lesson",
		31 => "lesson_check_with_name",
		32 => "lesson_check_with_time",
		33 => "lesson_check_success",
		34 => "lesson_check_fail",
		
		/*
		 *�鿴�
		 */
		130 => "activity_douban",

		/*
		 * ������
		 */
		40=>"room_apply_main",

		41 => "room_apply_main_add",
		42 => "room_apply_send_QR_Code",
		43 => "room_apply_send_QR_Code_success",
		44 => "room_apply_send_QR_Code_fail",
		
		45 => "room_apply_main_show",
		
		46 => "room_apply_main_page",

		48 => "room_apply_main_delete_list",
		49 => "room_apply_main_delete",
		47 => "room_apply_main_delete_fail",
		/*
		 * ����ͨ
		 */
		 50=>"news_main",
			
		 /*
		 * �������ͨ
		 */
		60=>"telephone_main",
		61=>"telephone_ask",
		62=>"telephone_answer_success",
		63=>"telephone_answer_fail",
		
		/*
		 * ΢����
		 */
		64 => "wechat_zoon",
		/*
		 * ������Ѷ
		 */
		70=>"weather_main",
		71=>"weather_local",
		72=>"weather_other",
		73=>"weather_show",
		74=>"weather_show_error",

		/*
		 * ��ݲ�ѯ
		 */
		80=>"express_main",
		81=>"express_company",
		82=>"express_number",
		83=>"express_submit_success",
		84=>"express_submit_fail",

		/*
		 * �ܱ�����
		 */
		90=>"localLife_main",
		91=>"localLife_eat",
		92=>"localLife_play",
		93=>"localLife_visit",
		94=>"localLife_live",
		95=>"localLife_transport",

		/*
		 * ��ӻ
		 */
		120 => "activity_apply_main",
		121 => "activity_apply_subject",
		122 => "activity_apply_type",
		123 => "activity_apply_time",
		124 => "activity_apply_content",
		125 => "activity_apply_place",
		126 => "activity_apply_join_type",
		127 => "activity_apply_other",
		128 => "activity_apply_submit",
		129 => "activity_apply_fail",
		
		/*
		 * ������Ϣ���涨��
		 */
		900 => "develop",
		901 => "no_define",
		902 => "welcome",
		903 => "invalid",
		/*
		 * ��ξɰ汾
		 */
		1000 => "cenker_old_version",
		/*
		 * ���
		 */
		0 => "wechat_main"

	);
}
/*//////////////////////////////////////////////////////////////////////
 * -------------------------- The End ----------------------------------
 *//////////////////////////////////////////////////////////////////////
?>
