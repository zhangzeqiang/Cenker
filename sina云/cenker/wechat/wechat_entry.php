<?php
require_once("wechat_msg_sender.php");
require_once("../class/database.php");
require_once("../class/wechat_db.php");
require_once("interface.php");
require_once("wechat_func.php");

/*
 * 包括旧版本的代码
 */
require_once("wechat_old_version_func.php");
/**
  * wechat php test
  */
class wechatCallback
{
	/*
	 * 注意点:微信上所有数据都是以UTF-8保存比较妥当，不然再查询数据的时候会出现很多意向不到的错误
	 */
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $recMsgType = $postObj->MsgType;
            
			$db = new saeDatabase();							//初始化数据库
			$wechat_user_db = new wechat_usr_lesson_db($db);
			$cenker_old_version = new cenker_old_version_class($postStr);
			
			$icode = $wechat_user_db->get_interact_code($fromUsername);
			//$icode="0";
			$action = CONSTANTS::$code_list[$icode];									//获取用户交互事件码(保证不同用户的不同需求)

			if ($action == "cenker_old_version"){
				if ( $cenker_old_version->responseMsg() !== true ){				//运行旧版本代码
					exit;
				}
			}
			/*///////////////////////////////////////////////////////////////////////
			 *------------------ TODO 用户事件交互及处理 --- ------------------------
			 * notice: $keyword == "中文" ||$keyword == "1"，这里数字一定要放在后面 -
			 * 作用:指定下一步动作，一般都在这里定义，除非特殊情况，需要及时响应的
			 * 如学号绑定成功后(有加连蹭课主页面的这种需要紧急响应的情况，却不需要用户
			 * 进一步处理的交互状态)，就应该在下面主界面显示之后，强制实时指定下一步。
			 *///////////////////////////////////////////////////////////////////////

            if ($recMsgType == "text"){							//接收到用户的文本消息
                
            	$keyword = trim($postObj->Content);		
                //$time = time();
                     
				if(!empty( $keyword ) || $keyword == "0")			
                {
					/*/////////////////////////////////////////////////
					 *				保存用户命令记录
					 */////////////////////////////////////////////////
					insert_wechat_user_instruct($fromUsername,$keyword);
					/*/////////////////////////////////////////////////
					 *						END
					 *////////////////////////////////////////////////
					if ($action == "wechat_main"){

						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";														//启动activity_main
						}else if ($keyword == "我的课程"  || $keyword == "课程" || $keyword == "2"){
							$code = "30";
						}else if ($keyword == "当前活动" || $keyword == "活动" || $keyword == "3"){
							$code = "10";
						}else if ($keyword == "开开房"  || $keyword == "开房" || $keyword == "4"){
							$code = "40";
						}else if ($keyword == "公文通"  || $keyword == "公文通小站" || $keyword == "5"){
							$code = "50";
						}/*else if ($keyword == "号码百事通"  || $keyword == "号码" 
							|| $keyword == "百事通" || $keyword == "6"){
							$code = "60";
						}*/
						else if ($keyword == "微社区" || $keyword == "蹭课微社区" || $keyword == "6"){
							$code = "64";
						}
						else if ($keyword == "天气资讯"  || $keyword == "天气" || $keyword == "7"){
							$code = "70";
						}else if ($keyword == "快递查询"  || $keyword == "快递" || $keyword == "8"){
							$code = "80";
						}/*else if ($keyword == "周边生活"  || $keyword == "周边" || $keyword == "9"){
							$code = "90";
						}*/else if ($keyword == "绑定学号" || $keyword == "9"){
							$code = "20";
						}else if ($keyword == "旧版本" || $keyword == "旧版" || $keyword == "10"){
							$code = "1000";
						}else{
							$code = "0";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);				//改变交互状态
					}
					/*
					 * 当前活动
					 */
					else if ($action == "activity_main"){

						if ($keyword == "返回蹭课" || $keyword == "1"){								//返回蹭课页
							$code = "0";														
						}else if ($keyword == "添加活动" || $keyword == "添加" || $keyword == "2"){	//添加活动
							$code = "120";														
						}else if($keyword == "查看活动" || $keyword == "查看" || $keyword == "3"){
							$code = "13";														
						}else{																//输入其他返回当前活动
							$code = "10";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}
					/*
					 * 查看活动
					 */
					else if($action == "activity_show_main"){
						if($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}else if($keyword == "豆瓣活动" || $keyword == "2"){
							$code = "130";
						}else if($keyword == "自己发起的活动" || $keyword ="3"){
							$code ="11";
						}else{
							$code="13";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					} 
					else if($action == "activity_douban"){

					}
					/*
					 * 添加活动
					 */
					else if ($action == "activity_apply_main"){
						
						if ($keyword == "返回蹭课" || $keyword == "1"){
						
							$code = "0";						
	
						}else if ($keyword == "主题" || $keyword == "2"){
						
							$code = "121";

						}else if ($keyword == "分类" || $keyword == "3"){
						
							$code = "122";

						}else if ($keyword == "时间" ||  $keyword == "4"){
						
							$code = "123";

						}else if ($keyword == "详情" || $keyword == "5"){
						
							$code = "124";

						}else if ($keyword == "地点" || $keyword == "6"){
						
							$code = "125";

						}else if ($keyword == "报名方式" || $keyword == "报名" 
							|| $keyword == "方式" || $keyword == "7"){
						
							$code = "126";

						}else if ($keyword == "备注" || $keyword == "8"){
							
							$code = "127";

						}else if ($keyword == "提交" || $keyword == "9"){
							//从数据库中查看所有临时添加活动数据，判断条件是否符合
							//符合则将数据插入到活动表，并跳转到提交成功
							//否则显示提交出错以及错误内容，然后跳转到添加活动主界面
							$activity_apply_list[0] = "activity_apply_subject";
							$activity_apply_list[1] = "activity_apply_type";
							$activity_apply_list[2] = "activity_apply_time";
							$activity_apply_list[3] = "activity_apply_content";
							$activity_apply_list[4] = "activity_apply_place";
							$activity_apply_list[5] = "activity_apply_join_type";
							$activity_apply_list[6] = "activity_apply_other";
							
							$null_code = activity_apply_submit_handle($fromUsername,$activity_apply_list);//返回第一个不符合条件的空值
							
							if ($null_code < count($activity_apply_list)){		//不符合条件,有些必选项空着
								$code = "129";
							}else{						//验证通过，则自动将数据保存到数据库显示提交成功
								$code = "128";
							}
		
						}else{
							$code = "120";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}
					else if($action == "activity_apply_subject"){				//主题

						$data = $keyword;
						$index = "activity_apply_subject";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_type"){					//类型
						
						$data = $keyword;
						//判断分类是否符合
						$type_list = get_type_with_activity_apply_type();

						$bool = "true";
						if ($bool){		//符合规则的输入
							$index = "activity_apply_type";
							setTempDataWithIndex($fromUsername, $index, $data);		//存入临时表中
							$code = "120";
						}else{			//不符合规则的输入
							$code = "903";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_time"){					//时间

						$data = $keyword;
						$index = "activity_apply_time";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_content"){				//详情

						$data = $keyword;
						$index = "activity_apply_content";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_place"){					//地点

						$data = $keyword;
						$index = "activity_apply_place";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_join_type"){				//报名方式

						$data = $keyword;
						$index = "activity_apply_join_type";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if($action == "activity_apply_other"){					//其他

						$data = $keyword;
						$index = "activity_apply_other";
						setTempDataWithIndex($fromUsername, $index, $data);	//存入临时表中

						$code = 120;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*else if($action == "activity_apply_submit"){				//提交

						//验证全部数据是否符合要求，只有符合要求后才会成功提交
						
						$code = 10;
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}*/
					/*
					 * 绑定学号
					 */
					else if ($action == "bindToStudent"){									
						
						//验证过滤
						/*$list['openid'] = $fromUsername;
						$list['student_no'] = $keyword;
						$list['code'] = "21";													
						$list['other'] = '';
						$wechat_user_db->bindingWithStudentNO($list);*/
						$student_name = $keyword;
						$myindex = "bindToStudent_no";
						setTempDataWithIndex($fromUsername, $myindex, $student_name);			//将学号存入临时数据表

						$code = "21";
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}else if ($action == "bindNameCheck"){
						
						$index = "bindToStudent_no";
						$student_no = getTempDataWithIndex($fromUsername, $index);				//获取临时表中的学号
						
						//在数据库中找出学号对应的姓名,如果匹配成功，绑定学号跳到成功页，否则，跳到失败页
						if ($keyword == getNameWithStudentNo($student_no)){
							//验证成功，绑定，跳到成功页$keyword
							$list['openid'] = $fromUsername;
							$list['student_no'] = $student_no;
							$list['code'] = '22';													
							$list['other'] = '';
							$wechat_user_db->bindingWithStudentNO($list);
						}else{
							//验证失败，跳到失败页
							$code = "23";
							$wechat_user_db->set_interact_code($fromUsername,$code);
						}
																			
					}else if ($action == "bindToStudentFail"){								
						
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}else if ($keyword == "绑定" || $keyword == "继续绑定" || $keyword == "2"){
							$code = "20";
						}else {
							$code = "20";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*
					 * 我的课程
					 */
					else if ($action == "my_lesson"){
					
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}else if ($keyword == "课程名" || $keyword == "根据课程名查看" || $keyword == "2"){
							$code = "31";
						}else if ($keyword == "根据时间查看" || $keyword == "时间" || $keyword == "3"){
							$code = "32";														
						}else {
							$code = "30";													//返回我的课程
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}else if ($action == "lesson_check_with_name"){
					
						if (($content = get_lesson_with_name($keyword)) !== false){
							$code = "33";	
						}else {												//查看成功
							$code = "34";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
						
					}else if ($action == "lesson_check_with_time"){
						
						if (($content = get_lesson_with_time($keyword)) !== false){
							$code = "33";														//查看成功
						}else {
							$code = "34";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}else if ($action == "lesson_check_success"){
					
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";														//返回主界面
						}else {
							$code = "30";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}
					/*
					 * 开房
					 */
					else if ($action == "room_apply_main"){
	
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}else if ($keyword == "添加房间" || $keyword == "添加" || $keyword == "2"){
							$code = "41";
						}else if ($keyword == "查看房间" || $keyword == "查看" || $keyword == "3"){
							$cur_page = 1;
							$picText_list = get_room_record($cur_page);
							$code = "45";
						}else if ($keyword == "退出房间" || $keyword == "退出" || $keyword == "4"){
							$content = get_my_room_record($fromUsername);
							$code = "48";
						}else {
							$code = "40";
						}
						
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if ($action == "room_apply_main_page"){
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}else if ($keyword == "上页" || $keyword == "2"){
							$cur_page = 1;
							$code = "45";
							$picText_list = get_room_record($cur_page);
						}else if ($keyword == "下页" || $keyword == "3"){
							$cur_page = 1;
							$code = "45";
							$picText_list = get_room_record($cur_page);
						}else {
							$cur_page = 1;
							$code = "45";
							$picText_list = get_room_record($cur_page);
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if ($action == "room_apply_main_add"){
						
						$room_name = $keyword;
						$index = "room_apply_room_name";
						setTempDataWithIndex($fromUsername, $index, $room_name);				//存入临时表中

						$code = "42";
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					else if ($action == "room_apply_main_delete_list"){
						$room_num = $keyword;
						if (($bool=delete_room_with_orderNum($fromUsername, $room_num)) === false){		//删除出错
							$code = "47";
						}else {			//成功删除
							$code = "49";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*
					 * 天气
					 */
					else if ($action == "weather_main"){
						
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";														//返回主界面
						}else if ($keyword == "本地" || $keyword == "本地天气" || $keyword == "2"){
							$code = "71";
						}else if ($keyword == "城市" || $keyword == "其他" || $keyword == "其他城市" || $keyword == "3"){
							$code = "72";
						}else {
							$code = "70";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}
					else if ($action == "weather_other"){
						
						$entity = $keyword;
						$url = "http://apix.sinaapp.com/weather/?appkey=".$toUsername."&city=".urlencode($entity); 
						$output = file_get_contents($url);
						$content = json_decode($output, true);
						
						$code = "73";															//天气查询成功
						$wechat_user_db->set_interact_code($fromUsername,$code);
						
					}
					/*
					 * 快递
					 */
					else if ($action == "express_main"){
						
						if ($keyword == "返回蹭课" || $keyword == "1"){
							$code = "0";
						}/*else if ($keyword == "快递公司" || $keyword == "公司" || $keyword == "2"){
							$code = "81";
						}*/else if ($keyword == "快递单号" || $keyword == "单号" || $keyword == "2"){
							$code = "82";
						}else {
							$code = "80";
						}
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*else if ($action == "express_company"){
						
					}*/
					else if ($action == "express_number"){

						$entity = $keyword;
						$url = "http://apix.sinaapp.com/expressauto/?appkey=".$toUsername."&number=".urlencode($entity); 
						$output = file_get_contents($url);
						$content = json_decode($output, true);
						$content = mb_convert_encoding($content, "gbk", "UTF-8");

						$code = "83";							//查找快递单成功
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*else if ($action == "express_submit_success"){
					
					}*/
					/*
					 * 其他
					 */
					else{

						$code = "0";															//蹭课首页
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}
					/*//////////////////////////////////////////////////////////////////////
					 *-------------------------- THE END ----------------------------------
					 *//////////////////////////////////////////////////////////////////////
					$icode = $wechat_user_db->get_interact_code($fromUsername);
					
					$action = CONSTANTS::$code_list[$icode];									//获取用户交互串(保证不同用户的不同需求)
					/*///////////////////////////////////////////////////////////////////////
					 *----------------------- TODO 用户交互页面 ----------------------------
					 *-作用:实时显示用户交互界面，上面的事件交互码，这里就应该执行什么映射码
					 *-指定的界面显示，除非特殊情况，不然不能再界面交互后改变其交互码，否则
					 *-此次显示界面里的交互选项将无效。比如学号绑定成功后的界面，只是单纯的
					 *-显示，并没有用户交互选项，所以可以在交互页面显示这里附加上蹭课或者其他
					 *-交互页面。
					 *///////////////////////////////////////////////////////////////////////
					/*
					 * 蹭课主页
					 */
					if ($action == "wechat_main"){			
						
						$content = WINDOWS::$type['wechat_main'];

					}
					/*
					 * 当前活动
					 */
					else if ($action == "activity_main"){

						$content = WINDOWS::$type['activity_main'];
						$action = "show_more_activity";
						$content = sprintf($content, URL::$LOCAL, urlencode($action));				//连接到页面
						
					}
					/*
					 *查看活动
					 */
					else if($action == "activity_show_main"){   						//查看活动的菜单
						$content = WINDOWS::$type['activity_show_main'];
					}
					else if ($action == "activity_show"){								//用户输入的活动列表

						//$content = WINDOWS::$type['activity_show'].WINDOWS::$type['activity_main'];
						$sender_type = "picText";			//图文方式发送
						//从数据库中找出活动然后以二维数组的方式返回.

						/*$picText_list[0]['Title'] = "活动主题";
						$picText_list[0]['Description'] = "今晚谁要一起去吃宵夜";
						$picText_list[0]['PicUrl'] = "http://szunbbs.sinaapp.com/wechat/pic/activity_show.jpg";
						$picText_list[0]['Url'] = "www.baidu.com";	*/
						$picText_list = getActivityList();
						
						$code = "13";						//特殊:事件监听处于activity_main
						$wechat_user_db->set_interact_code($fromUsername,$code);
						
					}else if($action == "activity_douban"){								//查看豆瓣活动
						$sender_type = "picText";
						$picText_list = getDoubanActivity();
						$code = "13";	  					//特殊:事件监听处于activity_show_main
						$wechat_user_db->set_interact_code($fromUsername,$code);
					}
					/*
					 * 绑定学号
					 */
					else if ($action == "bindToStudent"){

						$content = WINDOWS::$type['bindToStudent'];

					}else if ($action == "bindToStudentSuccess"){
					/* 这里觉得非常有必要说明一下，由于绑定成功后是直接显示主界面的选项，所以用户根本就没有跟"绑定成功"这个界面交互，交互的   
					 * 只是借用，还是跟主界面交互，所以这里有必要实时强制为监听蹭课主页面消息，故而上面的事件交互码判断就可以不用加绑定学号  
					 * 成功这项了
					 */
						$content = WINDOWS::$type['bindToStudentSuccess'].WINDOWS::$type['wechat_main'];	
						
						$code = "0";						//特殊:显示学号绑定成功后(包含主页面交互)，事件监听也应该同时处于蹭课主页面状态
						$wechat_user_db->set_interact_code($fromUsername,$code);

					}else if ($action == "bindNameCheck"){
					
						$content = WINDOWS::$type['bindNameCheck'];

					}else if ($action == "bindToStudentFail"){
						
						$content = WINDOWS::$type['bindToStudentFail'];
					}
					/*
					 * 我的课程
					 */
					else if ($action == "my_lesson"){
					
						$content = WINDOWS::$type['my_lesson'];
						$content = sprintf($content, URL::$LOCAL, "show_lesson" , getStudentNoWithOpenId($fromUsername));					//传递GET类型show_lesson,学号

					}else if ($action == "lesson_check_with_name"){
					
						$content = WINDOWS::$type['lesson_check_with_name'];

					}else if ($action == "lesson_check_with_time"){
					
						$content = WINDOWS::$type['lesson_check_with_time'];

					}else if ($action == "lesson_check_success"){

						$content = $content.WINDOWS::$type['lesson_check_success'];

					}else if ($action == "lesson_check_fail"){
						
						$content = WINDOWS::$type['lesson_check_fail'].WINDOWS::$type['my_lesson'];
						$code = "30";
						$wechat_user_db->set_interact_code($fromUsername,$code);	//显示主页面并监听
						
					}
					/*
					 * 添加活动
					 */
					else if($action == "activity_apply_main"){					//主界面

						$content = WINDOWS::$type['activity_apply_main'];
					}
					else if($action == "activity_apply_subject"){				//主题

						$content = WINDOWS::$type['activity_apply_subject'];
					}
					else if($action == "activity_apply_type"){					//类型

						$content = WINDOWS::$type['activity_apply_type'];
					}
					else if($action == "activity_apply_time"){					//时间

						$content = WINDOWS::$type['activity_apply_time'];
					}
					else if($action == "activity_apply_content"){				//详情

						$content = WINDOWS::$type['activity_apply_content'];
					}
					else if($action == "activity_apply_place"){					//地点

						$content = WINDOWS::$type['activity_apply_place'];
					}
					else if($action == "activity_apply_join_type"){				//报名方式

						$content = WINDOWS::$type['activity_apply_join_type'];
					}
					else if($action == "activity_apply_other"){					//其他

						$content = WINDOWS::$type['activity_apply_other'];
					}
					else if($action == "activity_apply_submit"){				//提交

						$content = WINDOWS::$type['activity_apply_submit'].WINDOWS::$type['activity_main'];
						$code = "10";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}else if($action == "activity_apply_fail"){
						
						$activity_apply_content = array(
							0 => "主题",
							1 => "分类",
							2 => "时间",
							3 => "详情",
							4 => "地点",
							5 => "报名方式",
							6 => "备注");
						$content = sprintf(WINDOWS::$type['activity_apply_fail'], $activity_apply_content[$null_code]);
						$content = $content.WINDOWS::$type['activity_apply_main'];
						$code = "120";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听

					}
					else if($action == "invalid"){
						$content = $content.WINDOWS::$type['invalid'].WINDOWS::$type['activity_apply_main'];
						$code = "120";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
					/*
					 * 开开房
					 */
					else if ($action == "room_apply_main"){
						$content = WINDOWS::$type['room_apply_main'];
					}
					else if ($action == "room_apply_main_add"){
						$content = WINDOWS::$type['room_apply_main_add'];
					}else if ($action == "room_apply_send_QR_Code"){
						$content = WINDOWS::$type['room_apply_send_QR_Code'];			//主交互界面
					}
					else if ($action == "room_apply_main_show"){
						//$content = WINDOWS::$type['room_apply_main_show'].WINDOWS::$type['room_apply_main'];
						$picText_list = $picText_list;
						$sender_type = "picText";					//图文方式显示
						$code = "46";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听;
					}
					else if ($action == "room_apply_main_delete_list"){
						$content = WINDOWS::$type['room_apply_main_delete_list'].$content;
					}
					else if ($action == "room_apply_main_delete"){
						$content = WINDOWS::$type['room_apply_main_delete'].WINDOWS::$type['room_apply_main'];
						$code = "40";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听;
					}
					else if ($action == "room_apply_main_delete_fail"){
						$content = WINDOWS::$type['room_apply_main_delete_fail'].WINDOWS::$type['room_apply_main'];
						$code = "40";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听;
					}
					/*
					 * 公文通
					 */
					else if ($action == "news_main"){
						$sender_type = "picText";			//图文方式发送
						
						$picText_list = getGwtList();
						//$content = $picText_list[0]['Title'];
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
					/*
					 * 号码百事通
					 */
					/*else if ($action == "telephone_main"){
						$content = WINDOWS::$type['develop'].WINDOWS::$type['wechat_main'];
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}*/
					else if ($action == "wechat_zoon"){
						$content = WINDOWS::$type['wechat_zoon'].$content.WINDOWS::$type['wechat_main'];
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
					/*
					 * 天气
					 */
					else if ($action == "weather_main"){
						$content = WINDOWS::$type['weather_main'];
					}
					else if ($action == "weather_local"){
						//$content = WINDOWS::$type['develop'].WINDOWS::$type['weather_main'];
						$entity = mb_convert_encoding("深圳","UTF-8","gbk");;
						$url = "http://apix.sinaapp.com/weather/?appkey=".$toUsername."&city=".urlencode($entity); 
						$output = file_get_contents($url);
						$content = json_decode($output, true);
						
						$code = "73";															//天气查询成功
						$wechat_user_db->set_interact_code($fromUsername,$code);

						if (is_array($content)){
							$sender_type = "picText";			//图文方式
							$picText_list = $content;
						}else {
							$content = "请输入正确的城市名".WINDOWS::$type['weather_main'];
							$code = "70";
							$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
						}
					}
					else if ($action == "weather_other"){
						$content = WINDOWS::$type['weather_other'];
					}
					else if ($action == "weather_show"){
						if (is_array($content)){
							$sender_type = "picText";			//图文方式
							$picText_list = $content;
						}else {
							$content = "请输入正确的城市名".WINDOWS::$type['weather_main'];
							$code = "70";
							$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
						}
					}
					/*
					 * 快递查询
					 */
					else if ($action == "express_main"){
						$content = WINDOWS::$type['express_main'];
					}
					else if ($action == "express_number"){
						$content =  WINDOWS::$type['express_number'];
					}
					else if ($action == "express_submit_success"){
						$content =  $content.WINDOWS::$type['wechat_main'];
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
					/*
					 * 周边生活
					 */
					else if ($action == "localLife_main"){
						$content = WINDOWS::$type['develop'].WINDOWS::$type['wechat_main'];
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
					/*
					 * 旧版入口界面
					 */
					else if ($action == "cenker_old_version"){
						$cenker_old_version->responseMsg("main");				//运行旧版本主界面代码
						exit;
					}
					
					/*
					 * 其他
					 */
					else{
						$content = WINDOWS::$type['no_define'].WINDOWS::$type['wechat_main'];		//主交互界面
						$code = "0";
						$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
					}
				}
					/*/////////////////////////////////////////////////////////////////////////
					 * -------------------------- THE END ---------------------------------- 
					 */////////////////////////////////////////////////////////////////////////
                else {
                	$content = WINDOWS::$type['no_define'].WINDOWS::$type['wechat_main'];		//主交互界面	
				}		//endif(!empty( $keyword ) || $keyword == "0")
				
            }
			/*/////////////////////////////////////////////////////////////////
			 *						End(文本事件)                              
			 *////////////////////////////////////////////////////////////////

			/*/////////////////////////////////////////////////////////////////
			 *							图片事件                              
			 */////////////////////////////////////////////////////////////////
			else if($recMsgType == "image"){					
				
				if ($action == "room_apply_send_QR_Code"){

					$pic=$postObj->PicUrl;	
					if (($url=img_parse($pic)) === false){

						$code = "44";

					}else{
					
						$index = "room_apply_room_name";			//获取临时表中的数据
						$room_name = getTempDataWithIndex($fromUsername, $index);				//存入临时表中
						insert_room_record($fromUsername, $room_name, $url);
						$code = "43";
					}
				
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}else {
					$code = "901";
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}

				$icode = $wechat_user_db->get_interact_code($fromUsername);
				
				$action = CONSTANTS::$code_list[$icode];									//获取用户交互串(保证不同用户的不同需求)
				/*///////////////////////////////////////////////////////////////////////
				 *----------------------- TODO 用户交互页面 ----------------------------
				 *-作用:实时显示用户交互界面，上面的事件交互码，这里就应该执行什么映射码
				 *-指定的界面显示，除非特殊情况，不然不能再界面交互后改变其交互码，否则
				 *-此次显示界面里的交互选项将无效。比如学号绑定成功后的界面，只是单纯的
				 *-显示，并没有用户交互选项，所以可以在交互页面显示这里附加上蹭课或者其他
				 *-交互页面。
				 *///////////////////////////////////////////////////////////////////////
				if($action == "room_apply_send_QR_Code_success"){

					$content = WINDOWS::$type['room_apply_send_QR_Code_success'].$content.WINDOWS::$type['wechat_main'];	//主交互界面
					$code = "0";
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}else if ($action == "room_apply_send_QR_Code_fail"){
					$content = WINDOWS::$type['room_apply_send_QR_Code_fail'];
					$code = "42";
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}else{
					$content = WINDOWS::$type['no_define'].WINDOWS::$type['wechat_main'];			//主交互界面
					$code = "0";
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}

			}
			/*/////////////////////////////////////////////////////////////////
			 *-							END图片事件                            
			 */////////////////////////////////////////////////////////////////
			else if($recMsgType == "event"){			//事件
				
				if ($postObj->Event == "subscribe"){	//订阅消息
					$content = WINDOWS::$type['welcome'].WINDOWS::$type['wechat_main'];			//主交互界面
					$code = "0";
					$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听
				}

			}else{

				$content = WINDOWS::$type['no_define'].WINDOWS::$type['wechat_main'];			//主交互界面
				$code = "0";
				$wechat_user_db->set_interact_code($fromUsername,$code);//显示当前活动主页面，并监听

			}			//endif ($recMsgType == "text"){

			$msgObj = new wechat_msghandle();
			/* ////////////////////////////////////////////////////////////////////////////
			 * --------------  指定发送类别，并将指定的数据通过sender发送出去 ------------
					------------------------------------------
									  @.eg 发送图文  
					$sender_type = "picText";			//图文方式发送   
					$picText_list[0]['Title'] = "活动主题";             
					$picText_list[0]['Description'] = "今晚谁要一起去吃宵夜";   
					$picText_list[0]['PicUrl'] = "http://szunbbs.sinaapp.com/wechat/pic/activity_show.jpg";
					$picText_list[0]['Url'] = "www.baidu.com";         
					 ------------------- end ------------------
					-------------------------------------------
									@.eg  发送文本
					$content = "hello world";
					--------------------- end ------------------
			 */////////////////////////////////////////////////////////////////////////////
			if ($sender_type == "picText"){				//发送图文
				$msgObj->sendPictureMsg($fromUsername, $toUsername, $picText_list);
			}
			else{										//默认发送文本
				$msgObj->sendTextMsg($fromUsername, $toUsername, mb_convert_encoding($content, "UTF-8", "gbk"));
			}			//endif ($sender_type == "picText"){	

			/* ///////////////////////////////////////////////////////////////////////////
			 * ----------------------------- The End ------------------------------------
			 *////////////////////////////////////////////////////////////////////////////
        }else {
        	echo "";
        	exit;
        }				//endif (!empty($postStr))
    }
	
}
?>