<?php
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
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
		
		date_default_timezone_set('PRC');				//设置中国时区
		$this->OUTPUT = 1;
		$this->log_dir = dirname(dirname(__FILE__))."/Log/";
		$this->mode = 0;		//利用$mode，当mode和OUTPUT匹配时才会输出日志,方便选择是否开启Log日志
		//echo $log_dir;

		if (!is_dir($this->log_dir)){		//新建目录
			mkdir($this->log_dir);
		}
		self::_file_exists();		//新建文件

		$this->_file = $this->log_dir.$this->log_file_name;
	}
	public function setMode($mode){
		$this->mode = $mode;		
	}
	private function _file_exists(){
		
		if (!file_exists($this->_file)){		//新建文件
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
			$time = date('Y-m-d H:i:s', time());		//获取操作时间
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
		self::_file_exists();		//新建文件

	}
	function __destruct(){

	}
}
?>