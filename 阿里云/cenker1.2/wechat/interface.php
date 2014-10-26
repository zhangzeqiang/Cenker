<?php
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
 */
/*//////////////////////////////////////////////////////////////////
 * ---------------------  服务器URL -------------------------------
 *///////////////////////////////////////////////////////////////////
class URL{
	//public static $LOCAL = "http://3.szunbbs.sinaapp.com";
	public static $LOCAL = "http://114.215.101.188/cenker";
}
/*///////////////////////////////////////////////////////////////////
 * -------------------------- END ----------------------------------
 *///////////////////////////////////////////////////////////////////

/*///////////////////////////////////////////////////////////////////
 * ------------------- TODO 字符交互界面定义 -------------------------
 *///////////////////////////////////////////////////////////////////
class WINDOWS{

	public static $type = array(

	/*activity_main
	another
	activity_register
	activity_show*/

	/*
	 * 蹭课主页
	 */
	wechat_main => "
	【1】返回蹭课
	【2】我的课程
	【3】活动中心
	【4】开开房
	【5】公文通小站
	【6】蹭课<a href='http://www.szubike.com/'>微社区</a>
	【7】天气资讯
	【8】快递查询
	【9】绑定学号
	【10】旧版
	输入其他显示主页
	更多福利，敬请期待！
	",
	wechat_main_pictxt => "
	        【1】返回蹭课
	        【2】我的课程
	        【3】活动中心
	        【4】开开房
	        【5】公文通小站
	        【6】蹭课微社区
	        【7】天气资讯
	        【8】快递查询
	        【9】绑定学号
	        【10】旧版
	         输入其他显示主页
	",
	/*
	 * 我的课程
	 */
	my_lesson => "
	<a href='%s/mobile/index.php?action=%s&student_no=%s'>点击</a>网页端我的课程
	【1】返回蹭课
	【2】根据课程名查看
	【3】根据时间查看
	输入其他返回我的课程主页
	更多福利，敬请期待！",

	lesson_check_with_name => "
	@输入课程名",


	lesson_check_with_time => "
	【Tip】模式:单周一7,8,9
	@输入时间段",
	
	lesson_check_success => "
	@课程信息:
	【1】返回蹭课
	【2】返回我的课程",
	
	lesson_check_fail => "
	@不存在记录",
	
	/*
	 * 当前活动
	 */
	activity_main => "
	查看活动
	【1】返回蹭课
	【2】添加活动
	【3】查看活动",
	
	/*
	 *查看活动
	 */
	activity_show_main=>"
	【1】返回蹭课
	【2】豆瓣活动
	【3】自己发起的活动
	",
	
	activity_douban =>"
	@豆瓣活动",


	activity_show => "
	@自己发起的活动",



	activity_apply => "
	@添加成功",
	
	/*
	 * 添加活动
	 */
	activity_apply_main => "
	填写结果
	【1】返回蹭课
	【2】主题(必须)
	【3】分类(必选)
	【4】时间(必须)
	【5】详情(必须)
	【6】地点(必须)
	【7】报名方式(可选)
	【8】备注(报名费用等)
	【9】提交",

	activity_apply_subject => "
	输入活动主题",
	
	/*///////////////////////////////////////////////////////////////////////
	 * 活动分类，注意，格式必须跟一下的匹配，因为系统用户添加的活动分类是
	 * 以这个为准的
	 * ---------------------------------------------------------------------
							选择活动分类
							【1】返回
							【2】兼职
							 ...
							【n】其他
	 * -------------------------- END ---------------------------------------
	 *////////////////////////////////////////////////////////////////////////
	activity_apply_type => "
	选择活动分类
	【1】返回
	【2】兼职
	【3】体育
	【4】交友
	【5】推广
	【6】其他",
	
	activity_apply_time => "
	输入活动时间",

	activity_apply_content => "
	输入活动详情",

	activity_apply_place => "
	输入活动地点",

	activity_apply_join_type => "
	报名联系方式",
	
	activity_apply_other => "
	其他(报名费用)",

	activity_apply_submit =>"
	提交成功",
	activity_apply_fail => "
	%s不能为空",
	activity_apply_return_txt => "
	回复任意返回",

	/*
	 * 绑定学号
	 */
	bindToStudent => "
	@请输入你要绑定的学号",
	
	bindNameCheck => "
	@输入真实姓名进行验证",

	bindToStudentSuccess => "
	@学号绑定成功",

	bindToStudentFail => "
	@学号绑定出错
	【1】返回蹭课
	【2】继续绑定
	",
	/*
	 * 开开房
	 */
	room_apply_main_add => "
	请输入房间名",
	room_apply_send_QR_Code => "
	请上传二维码",
	room_apply_send_QR_Code_success => "
	上传成功,开房成功",
	room_apply_send_QR_Code_fail => "
	@二维码不符合要求
	请重新上传二维码",

	room_apply_main => "
	【1】返回蹭课
	【2】添加房间
	【3】查看房间
	【4】退出房间",
	
	room_apply_main_show => "
	查看房间",
	room_apply_main_delete_list => "
	回复要解散的房间号\n",
	room_apply_main_delete => "
	成功解散房间",
	room_apply_main_delete_fail => "
	解散房间失败",
	/*
	 * 公文通
	 */
	news_main=>"
	@公文通小站,正在努力建设中",
	//同查看活动，一样无需显示
	
	/*
	 * 电话
	 */
	telephone_main=>"
	【1】返回蹭课
	【2】教职工
	【3】院系办公室
	【4】外卖
	更多福利，敬请期待！",
	telephone_ask=>"
	请输入关键词（如姓名等）",
	telephone_answer_success=>"
	你查找的可能是：
	%s",
	telephone_answer_fail=>"
	未找到数据
	【1】返回蹭课",
	
	wechat_zoon => "
	<a href='http://www.szubike.com/'>进入</a>微社区
	若微信点击无法显示，请在右上角点击使用浏览器打开",
	/*
	 * 天气
	 */
	weather_main=>"
	【1】返回蹭课
	【2】本地天气
	【3】其他城市
	更多福利，敬请期待！",

	weather_local=>"
	请发送你的定位地址（cenker不会以任何形式收集您的个人信息）",

	weather_other=>"
	请输入你要查询的城市名",

	weather_show=>"",//无需展示，发送图文信息即可

	weather_show_error=>"
	查询失败
	【1】返回蹭课",

	/*
	 * 快递
	 */
	express_main=>"
	【1】返回蹭课
	【2】快递单号(必填)
	更多福利，敬请期待！",

	express_company=>"
	请输入快递公司名称",

	express_number=>"
	请输入快递单号",

	express_submit_success=>"
	%s",

	express_submit_fail=>"
	对不起，未查询到该单号",
	
	/*
	 * 周边生活
	 */
	localLife_main=>"
	【1】返回蹭课
	【2】蹭吃喝
	【3】蹭玩乐
	【4】蹭旅游
	【5】蹭住宿
	【6】蹭出行
	更多福利，敬请期待！
	",
	localLife_eat=>"还未开放，更多福利，敬请期待！",
	localLife_play=>"还未开放，更多福利，敬请期待！",
	localLife_visit=>"还未开放，更多福利，敬请期待！",
	localLife_live=>"还未开放，更多福利，敬请期待！",
	localLife_transport=>"还未开放，更多福利，敬请期待！",
	
	/*
	 * 其他信息
	 */
	develop => "
	@正在努力建设中
	敬请关注",
	
	no_define => "
	未定义,返回主界面",
	
	welcome => "欢迎订阅蹭课",
	
	invalid => "不合法的输入",
	/*
	 * 开房系统
	 */
	
	/*///////////////////
	 * NOTICE:
	 * 1、添加字符界面注意不要遗漏','
	 * 2、这里的other不要删除
	 *//////////////////
	other => " "
	);
}
/*//////////////////////////////////////////////////////////////////////
 *-------------------------- THE END -----------------------------------
 *///////////////////////////////////////////////////////////////////////

 
/*//////////////////////////////////////////////////////////////////////
 * --------------------- TODO 用户事件交互码定义 ----------------------------
 *//////////////////////////////////////////////////////////////////////
class CONSTANTS{
	
	public static $code_list = array (
	/*
	 * 原则:0表示主页.每种类型占10~20条交互码段
	 */
		/**
		 * 用户活动
		 * 范围:10 - 20
		 */
		10 => "activity_main",
		11 => "activity_show",
		12 => "activity_apply",
		13 => "activity_show_main",

		/*
		 * 学号绑定
		 */
		20 => "bindToStudent",
		21 => "bindNameCheck",
		22 => "bindToStudentSuccess",
		23 => "bindToStudentFail",
		
		/*
		 * 我的课程 
		 */
		30 => "my_lesson",
		31 => "lesson_check_with_name",
		32 => "lesson_check_with_time",
		33 => "lesson_check_success",
		34 => "lesson_check_fail",
		
		/*
		 *查看活动
		 */
		130 => "activity_douban",

		/*
		 * 开开房
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
		 * 公文通
		 */
		 50=>"news_main",
			
		 /*
		 * 号码百事通
		 */
		60=>"telephone_main",
		61=>"telephone_ask",
		62=>"telephone_answer_success",
		63=>"telephone_answer_fail",
		
		/*
		 * 微社区
		 */
		64 => "wechat_zoon",
		/*
		 * 天气资讯
		 */
		70=>"weather_main",
		71=>"weather_local",
		72=>"weather_other",
		73=>"weather_show",
		74=>"weather_show_error",

		/*
		 * 快递查询
		 */
		80=>"express_main",
		81=>"express_company",
		82=>"express_number",
		83=>"express_submit_success",
		84=>"express_submit_fail",

		/*
		 * 周边生活
		 */
		90=>"localLife_main",
		91=>"localLife_eat",
		92=>"localLife_play",
		93=>"localLife_visit",
		94=>"localLife_live",
		95=>"localLife_transport",

		/*
		 * 添加活动
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
		 * 其他信息界面定义
		 */
		900 => "develop",
		901 => "no_define",
		902 => "welcome",
		903 => "invalid",
		/*
		 * 蹭课旧版本
		 */
		1000 => "cenker_old_version",
		/*
		 * 蹭课
		 */
		0 => "wechat_main"

	);
}
/*//////////////////////////////////////////////////////////////////////
 * -------------------------- The End ----------------------------------
 *//////////////////////////////////////////////////////////////////////
?>
