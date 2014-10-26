<?php
/*
 * @�����Ŷ�:���ڴ�ѧ��԰����
 * @���ʱ��:24/5/2014 
 * @��Ȩ����,ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
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

		'wechat_user' => "wechat_user",						//΢���û���
		'wechat_user_interact' => "wechat_user_interact"		//΢���û��������
	);
	public static $default_code = '0';						//��������ݿ�wechat_user_interact ����code��Ĭ��ֵһ��			
}
/**
 * 
 */
class wechat_usr_lesson_db{
	
	private $mysql;
	private $cLog;
	private $db;
	private $timeDifference;					//��Чʱ���

	function __construct($db){
	
		$this->mysql = $db->get_con();
		$this->cLog = $db->get_cLog();
		$this->db = $db;
		date_default_timezone_set('PRC');		//����ʱ��

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

		//�ж��û����¼�Ƿ��Ѿ�����
		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
		$result = self::select($sql);
		//foreach ($result as $row){
			if (!$result[0]['count(*)']){						//�û���¼������
				//�����û���¼
				self::default_usr_info($openid);
				self::default_usr_interact_info($openid);
			}else{										//�û���¼����
				//�ж��û�����������ֵ����Чʱ��,����Ѿ����ڣ��������ֵΪĬ��ֵ
				$sql = "select end_time from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid);
				$result = self::select($sql);

				//foreach($result as $row){
					$end_time = $result[0]['end_time'];
					$timecompare = (strtotime($end_time)>strtotime(date('y-m-d h:i:s')))?true:false;
					if (!$timecompare){				//��Ч���ѹ�
						self::default_usr_interact_info($openid);
					}
				//}
			}
			//��ȡcode
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
		//�ж��û����¼�Ƿ��Ѿ�����
		$this->cLog->add(__FILE__.":set_interact_code begin... ...");

		$sql = "select count(*) from %s where openid='%s'";
		$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
		$result = self::select($sql);
		
		//foreach ($result as $row){
			if (!$result[0]['count(*)']){						//�û���¼������
				//�����û���¼
				self::default_usr_info($openid);
			}	
			//�鿴�û�������¼�Ƿ����
			$sql = "select count(*) from %s where openid='%s'";
			$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $openid);
			$result = self::select($sql);
			//foreach($result as $row){

				$time['begin_time'] = date('y-m-d h:i:s');
				$time['end_time'] = date('y-m-d h:i:s', strtotime($time_limit));

				if (!$result[0]['count(*)']){					//����û�������¼�����ڣ�������¼
					$sql = "insert into %s(openid, code, begin_time, end_time) values('%s', '%s', '%s','%s')";
					$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid,$code,$time['begin_time'],$time['end_time']);
					self::query($sql);
	
				}else{									//������¼���ڣ�����½�����¼������
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
			if (!$result[0]['count(*)']){						//��������ڼ�¼�������
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
			if (!$result[0]['count(*)']){						//�����¼�����ڣ������
				$sql = "insert into %s(openid, begin_time, end_time) values('%s','%s','%s')";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$openid,$time['begin_time'],$time['end_time']);
				self::query($sql);
			}else{										//��¼������ֱ�Ӹ���
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
				//���û���Ϣ�����ڣ������ѧ�Ű󶨣��Ȳ����û���
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:could not find record in wechat_user.");
				self::default_usr_info($list['openid']);				
				
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:insert record to wechat_user.");
				//���뽻�������Ϣ
				//���������Ѿ����ڣ�����½�������Ϣ
				$sql = "select count(*) from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['openid']);

				$row = self::select($sql);
				
				//foreach($user_interact_info as $row){

					if ($row[0]['count(*)']){
						//��������ʽ�Ѿ����ڣ���ɾ����¼
						$sql = "delete from %s where openid='%s'";
						$sql = sprintf($sql,WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'],$list['openid']);
						self::query($sql);
					}
					//���뽻����ʽ
					self::default_usr_interact_info($list['openid']);

				//}
				
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:update record to wechat_user_interact.");

				return true;				//�����¼�ɹ����룬�򷵻�true
			}else {	
				//���û���Ϣ����,�жϽ������Ƿ����
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:find record in wechat_user.");

				//�����û���Ϣ
				$sql = "update %s set student_no='%s' where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user'], $list['student_no'], $list['openid']);
				self::query($sql);
			
				$this->cLog->add(__FILE__.":wechat_usr_lesson_db:update record to wechat_user_interact and wechat_user.");

				//���½�������Ϣ
				//�鿴�������Ƿ����
				$sql = "select count(*) from %s where openid='%s'";
				$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['openid']);
				$row = self::select($sql);
				
				//foreach($user_interact_info as $row){
					if (!$row[0]['count(*)']){			
						//���������¼�����ڣ�����뽻����ʽ
						//���뽻����ʽ
						self::default_usr_interact_info($list['openid']);

					}else{
						//���½�������Ϣ
						if ($list['code']){
							$time = self::getTimes();
							$sql = "update %s set code='%s',begin_time='%s',end_time='%s',other='%s' where openid='%s'";
							$sql = sprintf($sql, WECHAT_USR_LESSON_DB_CONSTANTS::$table['wechat_user_interact'], $list['code'],$time['begin_time'],$time['end_time'],$list['other'],$list['openid']);
							self::query($sql);
						}
					}
				//}
				return false;					//�����¼�Ѿ����ڣ��򷵻�false
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