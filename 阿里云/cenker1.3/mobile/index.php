<?php
	if (isset($_GET["action"])){
		//echo $_GET["action"];
		$action = urldecode($_GET["action"]);					//$action发过来的值不能是中文，否则微信发过来的URL编码不能成功转化回来

		if ($action == "show_lesson"){

			$sno=$_GET["student_no"];
			if ($sno!=false){
				$student_no = $_GET["student_no"];
				$action = urlencode($action);					//编码$action后转发到show_lesson.php
				header("Location:show_lesson.php?action=".$action."&student_no=".$student_no);
			}else{
				echo "<meta charset='gbk'>";
				echo "<p font='20px'>请先绑定学号<p>";
			}

		}else if($action =="show_lesson_with_name"){

			if(isset($_GET['lesson_name'])){
				$lesson_name=$_GET['lesson_name'];
				header("Location:show_lesson_with_name.php?lesson_name=".$lesson_name);
			}

		}else if($action =="show_lesson_with_time"){

			if(isset($_GET['lesson_time'])){
				$lesson_time=$_GET['lesson_time'];
				header("Location:show_lesson_with_time.php?lesson_time=".$lesson_time);
			}

		}else if($action == "show_activity"){
			
			if (isset($_GET['id'])){
				//跳转到活动页面
				$action = urlencode($action);
				$id = $_GET['id'];
				header("Location:show_activity.php?action=".$action."&id=".$id);
			}
		}else if($action == "show_douban_activity"){
			if(isset($_GET['id'])){
				//跳转到豆瓣活动页面
				$action = urlencode($action);
				$id = $_GET['id'];
				header("Location:show_douban_activity.php?action=".$action."&id=".$id);
			}
		}else if($action == "activity_apply_main"){
				header("Location:apply_activity.php");
		}else if($action == "show_more_activity"){
				header("Location:show_more.php");
		}else if($action == "more_douban"){
				header("Location:show_more_douban.php");
		}
		else if($action == "gwt"){
			
			if (isset($_GET['id'])){
				//跳转到活动页面
				$action = urlencode($action);
				$id = $_GET['id'];
				header("Location:gwt.php?action=".$action."&id=".$id);
			}
		}
		else if($action == "gwt_more"){
			
				header("Location:gwt_more.php");
			
		}
	}
?>
	