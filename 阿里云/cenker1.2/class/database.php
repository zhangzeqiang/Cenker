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
require_once("log_class.php");				//��־��

/**
 * constant define.
 */
class DEFAULT_DATABASE_INFO_CONSTANTS{
	public static $db_info = array(
	SERVERNAME => "localhost",
	USERNAME => "root",
	PASSWD => "szucenker",
	DBNAME => "cenker"
	);
}
class SaeMysql{
	private $conn;
	public function __construct($DBHOST = "localhost",$DBUSER = "root",
		$DBPWD = "szucenker",$DBNAME = "cenker"){
		
		$conn=mysql_connect($DBHOST,$DBUSER,$DBPWD);
		if (!$conn){
			die('Could not connect: '.mysql_error());
		}
		mysql_select_db($DBNAME);//ѡ�����ݿ�
		//echo "construct!\n";
		$this->conn = $conn;
	}
	public function setCharset($charset="GBK"){
		mysql_set_charset($charset, $this->conn);
	}
	public function errno(){
		return 0;
	}
	public function errmsg(){
		return 0;
	}
	public function getData($sql=""){
		$result = mysql_query($sql)or die(mysql_error());
		$i = 0;
		while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
	public function runSql($sql=""){
		mysql_query($sql)or die(mysql_error());
	}
	public function closeDb(){
		//echo "destruct\n";
		if (is_resource($this->conn)) {
			mysql_close($this->conn);	
		}
	}
	public function __destruct(){
		/*if (is_resource($this->conn)) {
			mysql_close($this->conn);	
		}*/
	}
}
class saeDatabase{

	private $cLog;
	private $mysql;
	function __construct($charset="GBK"){
		$this->cLog = new myLog();
		$this->cLog->setMode(0);
		
		//ʹ��sae�ӿ����ӵ����ݿ�
		$this->mysql = new SaeMysql();
		$this->mysql->setCharset($charset);		//�����ַ���

		$this->cLog->add(__FILE__.":open database");
	}
	/**
	 * @return:�ɹ��������飬ʧ��ʱ����false
	 * @author:John
	 */
	public function select($sql){
		$result = $this->mysql->getData($sql);
		if ($this->mysql->errno() != 0){
			die( "Error:" . $this->mysql->errmsg());
		}
		$this->cLog->add(__FILE__.":go to select data.");
		return $result;
	}
	/**
	 * @return:����Sql��䣬�����ؽ����
	 */
	public function query($sql){
		$this->mysql->runSql($sql);
		if ($this->mysql->errno() != 0){
			die( "Error:".$this->mysql->errmsg());
		}
		
		$this->cLog->add(__FILE__.":go to query data.");
	}
	function __destruct(){

		$this->mysql->closeDb();
		$this->cLog->add(__FILE__.":close database");

	}
	public function get_con(){
		return $this->mysql;
	}
	public function get_cLog(){
		return $this->cLog;
	}
}

?>
