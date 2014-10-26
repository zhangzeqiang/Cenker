<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php require_once("../class/database.php"); ?>
	<style>
		*{padding:0px;margin: 0px;}
		div,table{width:100%;}
	</style>
</head>
<body>

	<div>
		<table border="1px solid">
			
			<?php 
			echo "<tr><td>课程名称</td><td>课程地点</td><td>课程时间</td><td>课程介绍</td></tr>";
			$time=urldecode($_GET['lesson_time']);
			//$time="Advanced Listening";
			$sql="select name,room,time from room_time_lesson x,lesson y where time='%s' and x.lesson_id=y.id";
			$sql=sprintf($sql,$time);
			$db = new saeDatabase();
			$result=$db->select($sql);
			$count=count($result)+0;

			for($i=0;$i<$count;$i++){
				echo "<tr>";
                $name=mb_convert_encoding($result[$i]['name'],"UTF-8","gbk");
				$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");

				$introduction="";//待导入

				echo "<td width='25%'>";
				echo $name;
				echo "</td>";
				echo "<td width='15%'>";
				echo $room;
				echo "</td>";
				echo "<td width='15%'>";
				echo $time;
				echo "</td>";
				echo "<td witdh='45%'>";
				echo $introduction;
				echo "</td>";

				echo "</tr>";
			}
			?>
		</table>
	</div>
</body>
</html>