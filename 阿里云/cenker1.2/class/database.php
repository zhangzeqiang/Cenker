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
require_once("log_class.php");				//日志类

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
		mysql_select_db($DBNAME);//选择数据库
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
		
		//使用sae接口连接到数据库
		$this->mysql = new SaeMysql();
		$this->mysql->setCharset($charset);		//设置字符集

		$this->cLog->add(__FILE__.":open database");
	}
	/**
	 * @return:成功返回数组，失败时返回false
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
	 * @return:运行Sql语句，不返回结果集
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
