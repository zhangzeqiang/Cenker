<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<?php
/*if ( !defined('ROOT_PATH') ) {
	define("ROOT_PATH", substr(dirname(__FILE__), 0, -7) );
}*/
class myLog{

	private $log_file_name = "log.txt";
	private $log_dir;
	private $OUTPUT;
	private $mode; 
	private $file;

	function __construct(){
		
		date_default_timezone_set('PRC');
		$this->output = 1;
		$this->mode = $this->output;

	}
	public function setMode($mode){
		$this->mode = $mode;		
	}
	private function _file_exists(){}
	function add($text){
		if ($this->mode == $this->output){
			$time = date('Y-m-d H:i:s', time());		//获取操作时间
			echo $time."------".$text."<br>";
		}
	}
	function getFile(){}
	function newLog($file_name){}
	function __destruct(){}
}
?>