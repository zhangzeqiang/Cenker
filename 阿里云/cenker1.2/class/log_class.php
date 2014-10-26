<?php
/*--------------------------------------------------------------------
 *--@Author:���ڴ�ѧ��԰����2014�������Ա
 *--@Time:21/5/2014
 *--@��Ȩ����
 *--@˵��:ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
 */
/*if ( !defined('ROOT_PATH') ) {
	define("ROOT_PATH", substr(dirname(__FILE__), 0, -7) );
}*/
class myLog{

	private $log_file_name = "log.txt";
	private $log_dir;
	private $OUTPUT;
	private $mode; 
	private $_file;

	function __construct(){
		
		date_default_timezone_set('PRC');				//�����й�ʱ��
		$this->OUTPUT = 1;
		$this->log_dir = dirname(dirname(__FILE__))."/Log/";
		$this->mode = 0;		//����$mode����mode��OUTPUTƥ��ʱ�Ż������־,����ѡ���Ƿ���Log��־
		//echo $log_dir;

		if (!is_dir($this->log_dir)){		//�½�Ŀ¼
			mkdir($this->log_dir);
		}
		self::_file_exists();		//�½��ļ�

		$this->_file = $this->log_dir.$this->log_file_name;
	}
	public function setMode($mode){
		$this->mode = $mode;		
	}
	private function _file_exists(){
		
		if (!file_exists($this->_file)){		//�½��ļ�
			if ($this->_file == ""){
				$this->_file = $this->log_dir.$this->log_file_name;
			}
			$fp=fopen($this->_file, "a");
			if (!$fp){
				//echo "error";
				return false;
			}
			fclose($fp);
		}
		return true;
	}
	function add($text){
		
		if ($this->mode == $this->OUTPUT){
			self::_file_exists();
			$time = date('Y-m-d H:i:s', time());		//��ȡ����ʱ��
			$fp=fopen($this->_file, "a");
			fwrite($fp, $time."------".$text."\n");
			fclose($fp);
		}

	}
	function getFile(){
		return $this->_file;
	}
	function newLog($file_name){

		$this->log_file_name = $file_name;
		$this->_file = $this->log_dir.$this.log_file_name;
		self::_file_exists();		//�½��ļ�

	}
	function __destruct(){

	}
}
?>