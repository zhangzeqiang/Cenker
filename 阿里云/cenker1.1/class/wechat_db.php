<?php
/*
 * @开发团队:深圳大学荔园晨风
 * @完成时间:24/5/2014 
 * @版权所有,使用此代码时请注明为深大荔园晨风技术组开发
 */
//require_once("database.php");
/**
 * Constants define.
 */
class WECHAT_USR_LESSON_DB_CONSTANTS{
	
	public static $table = array(
		'teacher' => "teacher",
		'lesson' => "lesson",
		'college' => "college",
		'major_class' => "class",
		'class_lesson' => "class_lesson",
		'room_time_lesson' => "room_time_lesson",
		'student' => "student",
		'stu_tea_lesson' => "stu_tea_lesson",

		'wechat_user' => "wechat_user",						//微信用户表
		'wechat_user_interact' => "wechat_user_interact"		//微信用户交互码表
	);
	public static $default_code = '0';						//必须和数据库wechat_user_interact 表中code的默认值一样			
}
/**
 * 
 */
class wechat_usr_lesson_db{
	
	private $mysql;
	private $cLog;
	private $db;
	private $timeDifference;					//有效时间差

	function __construct($db){
	
		$this->mysql = $db->get_con();
		$this->cLog = $db->get_cLog();
		$this->db = $db;
		date_default_timezone_set('PRC');		//设置时区

		$this->timeDifference = array(
			'year' => '0',
			'month' => '1',
			'day' => '0',

			'hour' => '2',
			'minute' => '0',
			'second' => '0'
		);
		$this->cLog->add(__FILE__.":new wechat_usr_lesson_db");
	}
	public function query($sql){
		
		$this->db->query($sql);
	}
	public function select($sql){
		
		return $this->db->select($sql);
	}
	/**
	 * get wechat_usr_interact code.
	 * statement:check (begin_time,end_time) if exceed the time limit then update code to 0
	 *			 or return the code in table.
	 * @param $openid wechat_user id.
	 * @return code.
	 */
	public function get_interact_code($openid){
		$this->cLog->add(__FILE__.":get_interact_code begin... ...");

		//判断用户表记录是否已经存在
		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
		$result = self::select($sql);
		//foreach ($result as $row){
			if (!$result[0]['count(*)']){						//用户记录不存在
				//插入用户记录
				self::default_usr_info($openid);
				self::default_usr_interact_info($openid);
			}else{										//用户记录存在
				//判断用户交互表中码值的有效时间,如果已经过期，则更新码值为默认值
				$sql = "select end_time from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid);
				$result = self::select($sql);

				//foreach($result as $row){
					$end_time = $result[0]['end_time'];
					$timecompare = (strtotime($end_time)>strtotime(date('y-m-d h:i:s')))?true:false;
					if (!$timecompare){				//有效期已过
						self::default_usr_interact_info($openid);
					}
				//}
			}
			//获取code
			$sql = "select code from %s where openid='%s'";
			$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid);
			$result = self::select($sql);
			//foreach($result as $row){

		$this->cLog->add(__FILE__.":get_interact_code finish... ...");
				
				return $result[0]['code'];
			//}
		//}
	}
	/**
	 * set wechat_usr_interact code.
	 * 
	 */
	public function set_interact_code($openid, $code, $time_limit='now +24 hours'){
		//判断用户表记录是否已经存在
		$this->cLog->add(__FILE__.":set_interact_code begin... ...");

		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
		$result = self::select($sql);
		
		//foreach ($result as $row){
			if (!$result[0]['count(*)']){						//用户记录不存在
				//插入用户记录
				self::default_usr_info($openid);
			}	
			//查看用户交互记录是否存在
			$sql = "select count(*) from %s where openid='%s'";
			$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
			$result = self::select($sql);
			//foreach($result as $row){

				$time['begin_time'] = date('y-m-d h:i:s');
				$time['end_time'] = date('y-m-d h:i:s', strtotime($time_limit));

				if (!$result[0]['count(*)']){					//如果用户交互记录不存在，则插入记录
					$sql = "insert into %s(openid, code, begin_time, end_time) values('%s', '%s', '%s','%s')";
					$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid,$code,$time['begin_time'],$time['end_time']);
					self::query($sql);
	
				}else{									//交互记录存在，则更新交互记录表内容
					$sql = "update %s set code='%s',begin_time='%s',end_time='%s' where openid='%s'";
					$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$code,$time['begin_time'],$time['end_time'],$openid);
					self::query($sql);

				}
			//}
				
		//}
		$this->cLog->add(__FILE__.":set_interact_code end... ...");
	}
	/**
	 * get begin_time and end_time.
	 * @return array $time('begin_time','end_time')
	 */ 
	private function getTimes(){
		
		$this->cLog->add(__FILE__.":getTimes begin... ...");

		$time['begin_time'] = date('y-m-d h:i:s',time());

		$begin_time = $time['begin_time'];

		if ($this->timeDifference['year'] != '0'){
			$year = $this->timeDifference['year']." years";
		}
		if ($this->timeDifference['month'] != '0'){
			$month = $this->timeDifference['month']." month";
		}
		if ($this->timeDifference['day'] != '0'){
			$day = $this->timeDifference['day']." day";
		}
		if ($this->timeDifference['hour'] != '0'){
			$hour = $this->timeDifference['hour']." hour";
		}
		if ($this->timeDifference['minute'] != '0'){
			$minute = $this->timeDifference['minute']." minute";
		}
		if ($this->timeDifference['second'] != '0'){
			$second = $this->timeDifference['second']." second";
		}
		$t = "$begin_time %s %s %s %s %s %s";
		$t = sprintf($t, $year, $month, $day, $hour, $minute, $second);
		
		$time['end_time'] = date('y-m-d h:i:s', strtotime($t));
		$this->cLog->add(__FILE__.":getTimes end ... ...");
		return $time;
	}
	/**
	 * set time difference.
	 * @param array $time('year','month','day','hour','minute','second')
	 * @return void
	 */
	public function setTimeDifference(array $time){
		
		$this->timeDifference['year'] = $time['year'];
		$this->timeDifference['month'] = $time['month'];
		$this->timeDifference['day'] = $time['day'];
		$this->timeDifference['hour'] = $time['hour'];
		$this->timeDifference['minute'] = $time['minute'];
		$this->timeDifference['second'] = $time['second'];
	}
	/**
	 * set default wechat_user whith openid.
	 * @param $openid.
	 */
	private function default_usr_info($openid){
		
		$this->cLog->add(__FILE__.":default_usr_info begin... ...");

		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user'], $openid);
		$result = self::select($sql);
		//foreach($result as $row){
			if (!$result[0]['count(*)']){						//如果不存在记录，则插入
				$sql = "insert into %s(openid) values('%s')";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user'],$openid);
				self::query($sql);
			}
		//}
		$this->cLog->add(__FILE__.":default_usr_info end... ...");
	}
	/**
	 * set default wechar_user_interact with $openid.
	 * @param $openid.
	 */
	private function default_usr_interact_info($openid){
		
		$this->cLog->add(__FILE__.":default_usr_interact_info begin... ...");

		$code = WECHAT_USR_LESSON_DB_CONSTANTS::$default_code;
		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
		$result = self::select($sql);
		//foreach($result as $row){
			$time = $this->getTimes();
			if (!$result[0]['count(*)']){						//如果记录不存在，则插入
				$sql = "insert into %s(openid, begin_time, end_time) values('%s','%s','%s')";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid,$time['begin_time'],$time['end_time']);
				self::query($sql);
			}else{										//记录存在则直接更新
				$sql = "update %s set code='%s', begin_time='%s', end_time='%s' where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$code,$time['begin_time'],$time['end_time'],$openid);
				self::query($sql);
			}
		//}
		$this->cLog->add(__FILE__.":default_usr_interact_info end... ...");
	}
	/**
	 * bind wechat_user with studentno
	 * notice:if the record with openid in wechat_user not exists, add default_usr_info and set the wechat_usr_interact one to default state(code = 0).
	 * notice:else if the code is not null, update the wechat_user record and wechat_usr_interact one with the info in $list. 
	 * @param array $list('openid','studentno','code','other')
	 * @return the record with openid in wechat_user not exists(insert =>) return true
	 * else (update =>) return false.
	 */
	public function bindingWithStudentNO(array $list){
		
		$this->cLog->add(__FILE__.":bindingWithStudentNO begin... ...");

		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user'], $list['openid']);
		$row = self::select($sql);
		$this->cLog->add(__FILE__.":wechat_usr_lesson_db:search in wechat_user.");
		
		//foreach($user_info as $row){
			if (!$row[0]['count(*)']){
				//若用户信息不存在，则忽略学号绑定，先插入用户表
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:could not find record in wechat_user.");
				self::default_usr_info($list['openid']);				
				
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:insert record to wechat_user.");
				//插入交互码表信息
				//若表内容已经存在，则更新交互表信息
				$sql = "select count(*) from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['openid']);

				$row = self::select($sql);
				
				//foreach($user_interact_info as $row){

					if ($row[0]['count(*)']){
						//若交互方式已经存在，则删除记录
						$sql = "delete from %s where openid='%s'";
						$sql = sprintf($sql,WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$list['openid']);
						self::query($sql);
					}
					//插入交互方式
					self::default_usr_interact_info($list['openid']);

				//}
				
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:update record to wechat_user_interact.");

				return true;				//如果记录成功插入，则返回true
			}else {	
				//若用户信息存在,判断交互表是否存在
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:find record in wechat_user.");

				//更新用户信息
				$sql = "update %s set student_no='%s' where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user'], $list['student_no'], $list['openid']);
				self::query($sql);
			
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:update record to wechat_user_interact and wechat_user.");

				//更新交互表信息
				//查看交互表是否存在
				$sql = "select count(*) from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['openid']);
				$row = self::select($sql);
				
				//foreach($user_interact_info as $row){
					if (!$row[0]['count(*)']){			
						//若交互表记录不存在，则插入交互方式
						//插入交互方式
						self::default_usr_interact_info($list['openid']);

					}else{
						//更新交互表信息
						if ($list['code']){
							$time = self::getTimes();
							$sql = "update %s set code='%s',begin_time='%s',end_time='%s',other='%s' where openid='%s'";
							$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['code'],$time['begin_time'],$time['end_time'],$list['other'],$list['openid']);
							self::query($sql);
						}
					}
				//}
				return false;					//如果记录已经存在，则返回false
			}
		//}
		$this->cLog->add(__FILE__.":bindingWithStudentNO end... ...");
	}
	//public function 
	function __destruct(){
		
		$this->cLog->add(__FILE__.":close wechat_usr_lesson_db");

	}
}
?>