<?php
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
 */
require_once("../class/database.php");

function getColor(){
	$rand_num = rand(0,19);

	$color_list = array(
		0 => "#84C1FF",1 => "#FFCBB3",2 => "#6FB7B7",3 => "#7AFEC6",4 => "#CDCD9A",5 => "#D9B3B3",6 => "#84C1FF",7 => "#C7C7E2",
		8 => "#C7C7E2",9 => "#FFAAD5",10 => "#DAB1D5",11 => "#DAB1D5",12 => "#BBFFBB",13 => "#D9B3B3",14 => "#84C1FF",15 => "#DCB5FF",
		16 => "#6FB7B7",17 => "#6FB7B7",18 => "#FFAAD5",19 => "#FFB5B5"
	);
	return $color_list[$rand_num];
}

function getRoomAndTimeWithStudentNO($student_no){
	$db = new saeDatabase();
	$sql = "select room,time,lesson.name from room_time_lesson,stu_tea_lesson,lesson
	where stu_tea_lesson.lesson_id = room_time_lesson.lesson_id and room_time_lesson.lesson_id = lesson.id and student_no=".$student_no;		
	$result = $db->select($sql);
	$db = null;
	return $result;
	/*
	select room,time,lesson.name from room_time_lesson,stu_tea_lesson,lesson
where stu_tea_lesson.lesson_id = room_time_lesson.lesson_id and room_time_lesson.lesson_id = lesson.id and student_no="2011130019"
	*/
}
function getStudentName($student_no){
	$db = new saeDatabase();
	$sql = "select name from student where id=".$student_no;		
	$result = $db->select($sql);
	$db = null;
	return $result;
}
?>