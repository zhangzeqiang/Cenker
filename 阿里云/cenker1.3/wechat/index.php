<?php
    /*--------------------------------------------------------------------
	 *--@Author:深圳大学荔园晨风2014技术组成员
	 *--@Time:21/5/2014
	 *--@版权所有
	 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
	 */
    /* 
     * define your token
     */
    if (!isset($_GET["echostr"])) {
		require_once("wechat_entry.php");
		$wechatObj = new wechatCallback();
        $wechatObj->responseMsg();
    }else{
		define("TOKEN", "john");
		$wechatObj = new wechatCallbackapiTest();
		$wechatObj->valid();
    }

	class wechatCallbackapiTest
	{
		public function valid()
		{
			$echoStr = $_GET["echostr"];

			//valid signature , option
			if($this->checkSignature()){
				echo $echoStr;
				exit;
			}
		}	
		private function checkSignature()
		{
			$signature = $_GET["signature"];
			$timestamp = $_GET["timestamp"];
			$nonce = $_GET["nonce"];	
					
			$token = TOKEN;
			$tmpArr = array($token, $timestamp, $nonce);
			sort($tmpArr);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );
			
			if( $tmpStr == $signature ){
				return true;
			}else{
				return false;
			}
		}
	}
?>