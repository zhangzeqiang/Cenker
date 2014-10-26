<?php
include "config.inc.php";
$con=mysql_connect(DB_HOST,DB_USR,DB_PASSWORD);
mysql_select_db(DB_DATABASE,$con);
mysql_query("set names utf8;");

//获取状态
function get_act($open_id)
{
	$sql="select action from status where openid='$open_id'";
	$res=mysql_query($sql);
	if($result=mysql_fetch_array($res))
	{
		return $result['action'];
	} 
	else 
	{
		$sql="insert into status(openid,action) values ('$open_id',0) ";
		mysql_query($sql);
	    return 0;
	}
}

//更新状态
function up_act($open_id,$sta)
{
	$sql="update status set action=$sta where openid='$open_id'";
	if(mysql_query($sql))
	return true;
	else 
	return false;
}

//插入临时数据
function in_tmp_data($open_id,$name,$data)
{
	$sql="insert into temp_data(openid,myindex,data) values ('$open_id','$name','$data')";
	if(mysql_query($sql))
	return true;
	else return false;
}

//获取临时数据
function get_tmp_data($open_id)
{
	
     $sql="select * from temp_data where openid='$open_id'";
     $res=mysql_query($sql);
     $arr=array();
     while($result=mysql_fetch_array($res))
     {
     	$arr[$result['myindex']]=$result['data'];
     	unset_tmp_data($open_id,$result['myindex']);
     }
     return $arr;
}

//清空临时数据表
function unset_tmp_data($open_id,$name)
{
	$sql="delete from temp_data where openid='$open_id' and myindex='$name'";
    if(mysql_query($sql))
    return true;
    else 
    return false;
}

//获取房间图文数组
function get_room()
{
	$sql="select name,url,time from room_record  order by time desc limit 0,7";
	$res=mysql_query($sql);
	$arr=array();
	$i=1;
	$arr[0] = array("Title"=>
"请点击房间进入（回11开房，回12退房）", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNpHymibmqzO3ABMfpT5l4CEichKIKj84fEMv3IatRpzkGNIk4picAnbxfvwmBL70iaKdiaxDXEuW77Jdzg/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200223062&idx=1&sn=b1943ba4b53477727de28d8039b23c7e#rd");
	while($result=mysql_fetch_array($res))
	{
		$arr[$i]=array("Title"=>$result['name'],"Description"=>"","PicUrl"=>"",'Url'=>$result['url']);
		$i++;		
	}
	$arr[$i] = array("Title"=>
          "点击查看更多房间", "Description"=>"", "PicUrl"=>"", "Url" =>"http://szuck.szucal.com/weixin/kaifang.php");
	return $arr;
}
//查看更多房间
function more_room()
{
	$sql="select name,url,time from room_record  order by time desc limit 0,7";
	$res=mysql_query($sql);
	$arr=array();
	$i=8;
	$arr[0] = array("Title"=>
"请点击房间进入（回11开房，回12退房,回13查看更多房间）", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNpHymibmqzO3ABMfpT5l4CEichKIKj84fEMv3IatRpzkGNIk4picAnbxfvwmBL70iaKdiaxDXEuW77Jdzg/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200223062&idx=1&sn=b1943ba4b53477727de28d8039b23c7e#rd");
	while($result=mysql_fetch_array($res))
	{
		$arr[$i]=array("Title"=>$result['name'],"Description"=>"","PicUrl"=>"",'Url'=>$result['url']);
		$i++;		
	}
	
	$arr[$i] = array("Title"=>
          "点击查看更多房间", "Description"=>"", "PicUrl"=>"", "Url" =>"http://szuck.szucal.com/weixin/kaifang.php");
	return $arr;
}

//获取所有房间数据
function get_all_room(){
	$sql="select name,url,time from room_record  order by time desc";
	$res=mysql_query($sql);
	
	
}
//插入房间信息
function in_room($openid,$name,$url)
{
	$time=time();
	$sql="insert into room_record(openid,name,url)values ('$openid','$name','$url')";
	if(mysql_query($sql))
	return true;
	else 
	return false;
}
//清空房间数据
function cancel_room($openid)
{
	$sql="delete from room_record where openid='$openid'";
   if(mysql_query($sql))
   return true;
   else return false;
}
?>