<?php
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
 */
/*
 * 处理微信消息
 */
class wechat_msghandle
{
    /*
     * 发送串类型
     */
    //文本
    private $textTpl;
    
    //图片
    private $imageTpl;
    
    //语音
    private $soundTpl;
    
    //视频
    private $videoTpl;
    
    //音乐
    private $musicTpl;
    
    //图文
    private $picTextTpl;
    
	//图文中的item
	private $picTextTpl_item;
    function __construct(){
    	$this->textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
        $this->imageTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>
                    </xml>";
        $this->soundTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    </xml>";
        $this->videoTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    </Video> 
                    </xml>";
        $this->musicTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Music>
                    </xml>";
		/*
		 * 图文常量串定义
		 */
        $this->picTextTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>%s</ArticleCount>	
                        %s
                        </xml> ";
        $this->picTextTpl_item = "
                        <item>
                        <Title><![CDATA[%s]]></Title> 
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>";								//图文item
        
    }
    
    public function sendTextMsg($fromUsername, $toUsername, $content){
        
        $time = time();
        $resultStr = sprintf($this->textTpl, $fromUsername, $toUsername, $time, $content);
        
    	echo $resultStr;
    }
    
    public function sendPictureMsg($fromUsername, $toUsername, array $Title_Description_PicUrl_Url_list){
        
        $time = time();
		$item_count = count($Title_Description_PicUrl_Url_list);

		$i = 0;
		$item_list = "";
		for ($i=0;$i<$item_count;$i++){					//获取item集
			 $per_item = sprintf($this->picTextTpl_item, $Title_Description_PicUrl_Url_list[$i]['Title'], $Title_Description_PicUrl_Url_list[$i]['Description'],
				$Title_Description_PicUrl_Url_list[$i]['PicUrl'], $Title_Description_PicUrl_Url_list[$i]['Url']);
			 $item_list = $item_list.$per_item;
		}

		$item_list = "<Articles>".$item_list."</Articles>";
    	$resultStr = sprintf($this->picTextTpl, $fromUsername, $toUsername, $time, $item_count, $item_list);
        
    	echo $resultStr;
    }
    
}
?>