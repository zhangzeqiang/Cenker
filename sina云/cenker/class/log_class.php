<!--------------------------------------------------------------------
--@Author:���ڴ�ѧ��԰����2014�������Ա
--@Time:21/5/2014
--@��Ȩ����
--@˵��:ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
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
			$time = date('Y-m-d H:i:s', time());		//��ȡ����ʱ��
			echo $time."------".$text."<br>";
		}
	}
	function getFile(){}
	function newLog($file_name){}
	function __destruct(){}
}
?>