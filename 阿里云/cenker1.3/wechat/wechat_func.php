<?php
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
 */
require_once("../class/database.php");
require_once("interface.php");

function getStudentNoWithOpenId($db,$openid){

	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getStudentNoWithOpenId ... ...");

	$sql = "select student_no from wechat_user where openid = '$openid'";
	$result = $db->select($sql);

	//foreach($result as $row){
		return $result[0]['student_no'];
	//}
}
/*
 * 根据用户id和索引，在临时表中建立一条记录
 */
function setTempDataWithIndex($db, $openid, $index, $data){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":setTempDataWithIndex ... ...");

	//如果之前临时表已经有临时数据了，这样操作会直接更新数据并返回true,如果之前没数据，则直接插入，并返回false
	$sql = "select count(*) from temp_data where openid='%s' and myindex='%s'";
	$sql = sprintf($sql, $openid, $index);
	
	$data = mb_convert_encoding($data, "gbk", "UTF-8");
	$result = $db->select($sql);
	
	if ($result[0]['count(*)']){
		//临时表索引已经有数据，更新数据
		$sql = "update temp_data set data='%s' where openid='%s' and myindex='%s'";
		$sql = sprintf($sql, $data, $openid, $index);
		$db->query($sql);

		return true;
	}else{
		//临时表索引没有数据，则插入记录
		$sql = "insert into temp_data(openid, myindex, data) values('%s','%s','%s')";
		$sql = sprintf($sql, $openid, $index, $data);
		$db->query($sql);

		return false;
	}
	
}
/*
 * 根据用户id和索引获取临时表中对应字段的数据
 */
function getTempDataWithIndex($db,$openid, $index){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getTempDataWithIndex ... ...");

	$sql = "select count(*),data from temp_data where openid='%s' and myindex='%s'";
	$sql = sprintf($sql, $openid, $index);

	$result = $db->select($sql);
	
	if (!$result[0]['count(*)']){
		//如果临时表中没有数据，返回false
		return false;
	}else{
		//如果临时表中有数据，则返回$data
		$data = mb_convert_encoding($result[0]['data'], "UTF-8", "gbk");
		return $data;
		//return $result[0]['data'];
	}

}
/*
 * 根据学号获取学生姓名
 */
function getNameWithStudentNo($db,$student_no){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getNameWithStudentNo ... ...");

	$sql = "select count(*),name from student where id='%s'";
	$sql = sprintf($sql, $student_no);

	$result = $db->select($sql);

	if (!$result[0]['count(*)']){
		//如果临时表中没有数据，返回false
		return false;
	}else{
		//如果临时表中有数据，则返回$data
		$data = mb_convert_encoding($result[0]['name'], "UTF-8", "gbk");
		return $data;
	}
}
/*
 * 获取并删除临时表中对应索引和用户id的数据
 */
function getAndDeleteTempWithIndex($db,$openid, $index){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getAndDeleteTempWithIndex ... ...");

	//调用getTempDataWithIndex之后判断返回是否为false,如果为false则返回false,如果有值则删除记录并返回true
	$result = getTempDataWithIndex($db,$openid, $index);
	if ($result === false){					//全等于，并且类型也相等
		return false;
	}else{
		$sql = "delete from temp_data where openid='%s' and myindex ='%s'";
		$sql = sprintf($sql, $openid, $index);
		$db->query($sql);
		return $result;
	}
}
/*
 * 根据传来的数组字符串进行相应临时表中数据的验证处理，如果验证通过则将数据插入数据库，并返回true,
 * 验证不通过则返回false
 */
function activity_apply_submit_handle($db,$openid, array $activity_apply_list){
	//$db = new saeDatabase();	
	$db->get_cLog()->add(__FILE__.":activity_apply_submit_handle ... ...");

	$count = count($activity_apply_list);
	for ($i=0;$i<$count;$i++){
		if ($activity_apply_list[$i] != "activity_apply_join_type" 
			&& $activity_apply_list[$i] != "activity_apply_other"){				//除了这两个字段外全部不能为空
			$index = $activity_apply_list[$i];
			//从临时数据表中查看，如果为空则返回false
			$data = getTempDataWithIndex($db,$openid, $index);
			if ($data === false){
				return $i;						//返回第一个查到的空字段索引号
			}
		}	
	}
	//将所有数据存入数据库
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_subject')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$subject=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_type')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$type=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_time')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$time=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_content')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$content=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_place')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$place=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_join_type')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$join_type=$data;
	}
	if (($data = getTempDataWithIndex($db,$openid,'activity_apply_other')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$other=$data;
	}
	
	$sql = "insert into wechat_activity(subject,type,time,content,place,join_type,other,openid) 
			values('%s','%s','%s','%s','%s','%s','%s','%s')";
	$sql = sprintf($sql,$subject,$type,$time,$content,$place,$join_type,$other,$openid);
	$db->query($sql);
	
	//删除临时表数据
	for ($i=0;$i<$count;$i++){
		
		$index = $activity_apply_list[$i];
		//从临时数据表中查看，如果为空则返回false
		$data = getAndDeleteTempWithIndex($db,$openid, $index);
	}
	return $count;							//表示符合条件
}

function getActivityList($db){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getActivityList ... ...");

	$sql = "select subject,id from wechat_activity order by date desc";
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//限制九条最多
			if ($i == 0){		//第一条活动item
				$data = mb_convert_encoding("活动主题", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/activity_show.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['subject'], "UTF-8", "gbk");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'show_activity';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("查看更多", "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'show_more_activity';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action;
	return $picText_list;
}
/*
 *豆瓣活动。图文信息--单个活动展示+查看更多
 */
function getDoubanActivity($db){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getDoubanActivity ... ...");

	$sql = "select subject,id from douban order by endtime desc";
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//限制九条最多
			if ($i == 0){		//第一条活动item
				$data = mb_convert_encoding("豆瓣活动", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/douban.png";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['subject'], "UTF-8", "gbk");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'show_douban_activity';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("查看更多", "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'more_douban';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action;
	return $picText_list;
}
/*
 * 将微信二维码转化成url链接
 */
function img_parse($img_url){

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://zxing.org/w/decode?u=".$img_url);//设置请求url地址 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //是否显示内容
    $rule="%<pre[^>]*>(.*?)</pre>%si";
	$content=curl_exec($ch);
    preg_match($rule,$content,$rs);
	curl_close($ch);
	$res=strstr($rs[1],"http://weixin.qq.com/g/");
	if($res===false)
		return false;
	else
		return $rs[1];

}
/*
 * 根据课程名查询
 */
function get_lesson_with_name($db,$name){
		//$db = new saeDatabase();
		$db->get_cLog()->add(__FILE__.":get_lesson_with_name ... ...");

		$name=mb_convert_encoding($name,"gbk","UTF-8");
		$sql="select room,time,name from room_time_lesson x,lesson y where x.lesson_id=y.id and y.name like'%".$name."%'";
//		$sql="select room,time from room_time_lesson where lesson_id in(select id from lesson where name like'%".$name."%')";
//		$sql=sprintf($sql,$name);


		$result=$db->select($sql);

		$count=count($result)+0;
		insert_wechat_user_instruct($db,"count",$count);
		
		if($count>0){
			if($count<=10){
				for($i=0;$i<$count;$i++){
					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$lname=$result[$i]['name'];
					$time=$result[$i]['time'];
					$content=$content."\n".$lname."\n".$room."  ".$time;	
				}
			}else{
				for($i=0;$i<10;$i++){
					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$lname=$result[$i]['name'];
					$time=$result[$i]['time'];
					$content=$content."\n".$lname."\n".$room."  ".$time;	
				}
					$content=$content."
					"."<a href='".URL::$LOCAL."/mobile/index.php?action=%s&lesson_name=%s'>查看更多</a>";
					$action="show_lesson_with_name";
					$action = urlencode($action);
					$lesson_name=$name;
					$lesson_name=mb_convert_encoding($lesson_name,"UTF-8","gbk");
					$lesson_name = urlencode($lesson_name);
					$content=sprintf($content,$action,$lesson_name);
			}
		}else{
			$content=false;
		}
		//echo $content;
		return $content;
}
/*
 * 根据时间查询
 */
function get_lesson_with_time($db,$time){
		//$db = new saeDatabase();
		$db->get_cLog()->add(__FILE__.":get_lesson_with_time ... ...");

		$time=mb_convert_encoding($time,"gbk","UTF-8");
		$time=str_replace("，",",",$time);
		//select name,room,time from room_time_lesson x,lesson y where time='周一1,2' and x.lesson_id=y.id;

		$sql="select name,room,time from room_time_lesson x,lesson y where time='%s' and x.lesson_id=y.id";
		$sql=sprintf($sql,$time);
		$result=$db->select($sql);
		$count=count($result)+0;
		insert_wechat_user_instruct($db,"count",$count);
		if($count>0){
			if($count<=10){
				for($i=0;$i<$count;$i++){
					$name=$result[$i]['name'];
				//	$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$time=$result[$i]['time'];
					$content=$content."\n".$name."\n".$room."  ".$time;	
				}
			}else{
				insert_wechat_user_instruct($db,"in","in");
				for($i=0;$i<10;$i++){
					$name=$result[$i]['name'];
					$room=$result[$i]['room'];
//					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$time=$result[$i]['time'];
					$content=$content."\n".$name."\n".$room."  ".$time;	
				}
					$content=$content."
					"."<a href='".URL::$LOCAL."/mobile/index.php?action=%s&lesson_time=%s'>查看更多</a>";
					$action="show_lesson_with_time";
					$action = urlencode($action);
					$lesson_time=$time;
					$lesson_time=mb_convert_encoding($lesson_time,"UTF-8","gbk");
					$lesson_time = urlencode($lesson_time);
					$content=sprintf($content,$action,$lesson_time);
			}
		}else{
			$content=false;
		}
		return $content;
}
function insert_room_record($db,$openid, $name, $url, $intro="无"){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":insert_room_record ... ...");

	$name=mb_convert_encoding($name,"gbk","UTF-8");
	$sql = "select count(*) from room_record where openid='%s' and name='%s'";
	$sql = sprintf($sql, $openid, $name);

	$result = $db->select($sql);
	$count = $result[0]['count(*)'];

	if ($count > 0){				//已经存在数据则忽略
		return false;
	}else{							//不存在数据则插入
		$sql = "insert into room_record(openid,name,url,intro) values('%s','%s','%s','%s')";
		$sql = sprintf($sql, $openid, $name, $url, $intro);
		$db->query($sql);
		return true;
	}
}
function get_room_record($db,$openid,$cur_page = 1,$page_name="room_record_cur_page"){
	//$db = new saeDatabase();
	$PER_MAX_SIZE = 7;
	$db->get_cLog()->add(__FILE__.":get_room_record ... ...");
	//获取记录数
	$sql = "select count(*) from room_record";
	$result = $db->select($sql);
	$record_count = $result[0]['count(*)'];
	if ($PER_MAX_SIZE > $record_count){
		$PER_MAX_SIZE = $record_count;
	}
	$max_page = (($record_count%$PER_MAX_SIZE)?($record_count/$PER_MAX_SIZE):(floor($record_count/$PER_MAX_SIZE)+1))-1;

	if ($cur_page < 1){
		$cur_page = 1;
	}else if ($cur_page >= $max_page){
		$cur_page = $max_page;
	}else{
	}
	//将当前页数放入数据库中
	setTempDataWithIndex($db, $openid, $page_name, $cur_page);

	$cur_record = ($PER_MAX_SIZE>$record_count)?$record_count:$PER_MAX_SIZE;
	
	$sql = "select name,url from room_record limit ".($cur_page-1)*$PER_MAX_SIZE.", ".$cur_record;
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//限制九条最多
			if ($i == 0){		//第一条活动item
				$data = mb_convert_encoding("开房查询", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/wechat_room.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['name'], "UTF-8", "gbk");
				$url = $subject_list[$i-1]["url"];
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['Url'] = $url;
			}
			
		}else{
			break;
		}
	}
	$data = "上页     第%s页      下页     共%s页
【1】返回蹭课";
	$data = sprintf($data,$cur_page,$max_page);
	
	$data = mb_convert_encoding($data, "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id='getmore'";
	return $picText_list;
}
function get_my_room_record($db,$openid){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":get_my_room_record ... ...");

	$sql = "select id,name,url from room_record where openid='%s' order by id";
	$sql = sprintf($sql, $openid);
	$subject_list = $db->select($sql);

	$count = count($subject_list);

	for($i=0;$i<$count;$i++){
		
		if ($i < 8){	//限制九条最多
			$content = $content."【".$i."】<a href='".$subject_list[$i]['url']."'>".$subject_list[$i]['name']."</a>\n";
		}else{
			break;
		}
	}
	return $content;
}
function delete_room_with_orderNum($db,$openid,$roomid){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":delete_room_with_orderNum ... ...");

	$sql = "select id from room_record where openid='%s' order by id";
	$sql = sprintf($sql, $openid);
	$subject_list = $db->select($sql);

	$count = count($subject_list);

	for($i=0;$i<$count;$i++){
		
		if ($i < 8){	//限制九条最多
			if ($i == $roomid){			//对应下标的记录删除
				$id = $subject_list[$i]['id'];
				$sql = "delete from room_record where id='%s'";
				$sql = sprintf($sql, $id);
				$db->query($sql);
				return true;
			}
		}else{
			break;
		}
	}
	return false;
}
/*
 * 插入用户命令记录
 */
function insert_wechat_user_instruct($db,$openid,$content){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":insert_wechat_user_instruct ... ...");

	$sql="insert into wechat_user_instruct(openid,content) values ('%s','%s')";

	$content = mb_convert_encoding($content,"gbk","UTF-8");
	$sql=sprintf($sql,$openid,$content);
	$db->query($sql);
	return true;
}
/*
 * 通过interface.php中的activity_apply_type界面字符串得到类型
 */
function get_type_with_activity_apply_type(){

	$type_str = WINDOWS::$type['activity_apply_type'];
	$type_str = str_replace("【", ";", $type_str);
	$type_str = str_replace("】", ";", $type_str);
	$type_list = explode(";",$type_str);
	$count = count($type_list);

	for ($i=0,$j=0;$i<$count;$i++){
		if ($i!==0){
			/*$num = $i%2;
			if ($num === 0){*/
				$my_type_list[$j++]=mb_convert_encoding($type_list[1],"UTF-8","gbk");
			//}
		}
	}
	return $my_type_list;
}
/*
 * 公文通图文获取
 */
function getGwtList($db){
	//$db = new saeDatabase();
	$db->get_cLog()->add(__FILE__.":getGwtList ... ...");

	$sql = "select title,id from gongwentong order by time desc";
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//限制九条最多
			if ($i == 0){		//第一条活动item
				$data = mb_convert_encoding("公文通", "UTF-8", "gbk");
				//$data = "公文通";
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/gongwentong.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "http://www.szu.edu.cn";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['title'], "UTF-8", "gbk");
				//$data = $subject_list[$i-1]['title'];
				$data=str_replace("<b>","","$data");
				$data=str_replace("</b>","","$data");
				$data=str_replace("<font color=black>","","$data");
				$data=str_replace("</font>","","$data");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'gwt';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("查看更多", "UTF-8", "gbk");
	//$data = "查看更多";
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'gwt_more';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id='getmore'";
	return $picText_list;
}
function getTelPhoneWithName($db, $name){
	$sql = "select * from telphone where name like'%".$name."%'";
	$subject_list = $db->select($sql);
	$count = count($subject_list);
	if ($count <= 0){
		return false;
	}
	/*$content = "";
	for ($i=0;$i<$count;$i++){
		$subject_list[$i]['id'] = mb_convert_encoding($subject_list[$i]['id'], "UTF-8", "gbk");
		$subject_list[$i]['name'] = mb_convert_encoding($subject_list[$i]['name'], "UTF-8", "gbk");
		$subject_list[$i]['note'] = mb_convert_encoding($subject_list[$i]['note'], "UTF-8", "gbk");
		$subject_list[$i]['addr'] = mb_convert_encoding($subject_list[$i]['addr'], "UTF-8", "gbk");
		$subject_list[$i]['phone'] = mb_convert_encoding($subject_list[$i]['phone'], "UTF-8", "gbk");
	}*/
	return $subject_list;
}
?>