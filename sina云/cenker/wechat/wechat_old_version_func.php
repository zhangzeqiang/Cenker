<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<?php

//include('ticket.php');
/*
    方倍工作室
    CopyRight 2014 All Rights Reserved
*/
class cenker_old_version_class
{
	private $postObj;
	private $postStr;
	function __construct($postStr){
		$this->postStr = $postStr;
	}
	//回复信息
    public function responseMsg($mode = "normal")
    {
		$postStr = $this->postStr;
        if (!empty($postStr)){
            $this->logger("R ".$postStr);
            $this->postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$postObj = $this->postObj;
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj, $mode);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknow msg type: ".$RX_TYPE;
                    break;
            }
			if ($result === true){
				return true;
			}
            $this->logger("T ".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
		return false;
    }
/*	public function oringroom()
	{
				
				$content = "这是个文本消息";
				
				return $result;
	}
	public function addroom()
	{
		
	}
*/
	 private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
               $content[] = array("Title"=>"关注深大蹭客", "Description"=>"", "PicUrl"=>"", "Url" =>"");
				$content[] = array("Title"=>"
				【1】蹭课指南					
				【2】活动推荐		
				【3】领福利				
				【4】蹭旅游
				【5】常用电话
				【6】外卖菜单
				【7】调戏蹭客君
				【8】音乐
				【9】天气
				【10】快递
				【11】新版
                更多福利，敬请期待！", "Description"=>"", "PicUrl"=>"", "Url" =>"");
                                $content[] = array("Title"=>"回复对应数字查看使用方法
                发送0返回本菜单", "Description"=>"", "PicUrl"=>"", "Url" =>"");

                break;
        }
        $result = $this->transmitNews($object, $content);
        return $result;
    }

    private function receiveText($object, $mode)
    {
        $keyword = trim($object->Content);
		if ($mode == "main"){
			$sign_str = "0";
		}else {
			$sign_str = mb_substr($keyword,0,2,'utf-8');
		}
        switch ($sign_str)
        {
            case "文本":{
                $content = "这是个文本消息";
			}break;	
			case "1":{
                $content[0] = array("Title"=>
                                    "一周蹭课指南
                今天你蹭课了吗", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[1] = array("Title"=>
                                    
                                    "星期一（点击查看每天指南←_←）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080360&idx=1&sn=617876c7935161d4ad20e5267a85b674#rd");
                $content[2] = array("Title"=>"星期二（长期更新蹭课指南 (^３^)）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=2&sn=b9eede2f6003079dc0890a76c897977e#rd");
                $content[3] = array("Title"=>"星期三（征收各种课程推荐 =^ω^=）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=3&sn=95939f6684feb309f205bf41ddc93ab4#rd");
                $content[4] = array("Title"=>"星期四（请投稿至深大蹭客(≥3≤)）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=4&sn=8ae55357ef4cd1b87e61524bff92297a#rd");
                $content[5] = array("Title"=>"星期五（承诺分分钟让亲上头条≧v≦）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=5&sn=8aa61f097b20ed5356a71edf9e1fff1b#rd");
			}break;	
			case "2":{
                $content[] = array("Title"=>"请选择你感兴趣的活动", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[] = array("Title"=>"【深大蹭客】每周日蹭ukulele乐器公开课", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNpaVqzuh7wOKtl4quLZyiaAYvuoeH59ciasOXaEiap3C3ibXbI4Y9cm8T1EeksSQQ27HbNm7pdm7BOxHw/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200151855&idx=1&sn=9ec630ffd4f91358cf4554b3cfed1ea8#rd");
                $content[] = array("Title"=>"『蹭公益』探访志愿者招募", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNoVIqdpNuuVxBLbubJuTS3khOjiajrFEWtUsWtI2EjlcXiag6Wb1eSYxSicdySzbt0n2QQo6AicxM3yEQ/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200137674&idx=1&sn=4587de8e0eba8477b550eaaeae884c62#rd");
                $content[] = array("Title"=>"【蹭音乐会】免费领取美丽星期天门票", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200126875&idx=1&sn=dbba955f05ff486b1f7db94005cd7455#rd");
                $content[] = array("Title"=>"【蹭瑜珈】霎哈嘉瑜伽冥想公益班（长期有效）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200126875&idx=3&sn=2f39788379223b98ea02b43cdd7aa423#rd");
                // $content[] = array("Title"=>"", "Description"=>"", "PicUrl"=>"", "Url" =>"");
			}break;
			case "6":{
				$content[] = array("Title"=>"深大周边外卖电话", "Description"=>"", "PicUrl"=>"", "Url" =>"");
				$content[] = array("Title"=>"卡其士：632564
                E果饭卷：61976
                Twinkle炸鸡店：624245
                阿姨炒粉：692780
                潮粉王：668941
                潮州卤水店：64937
                诚记烧昧：629175
                初味手抓拼：626518
                串串香：640607
                春甜花花：26965580
                东北饺子馆：654454
                东篱小径：26720252
                毒上喜：633859
                疯狂烤翅：678910
                港厨：656565
                格式pizza：635112
                贡茶：86630575
                桂庙牛当道：663317
                亨利屋焗饭：691149
                嘉味园：635557
                景旺：619968
                聚友烤鱼馆：614333
                筷意：679310
                老地方盖浇饭：695816
                乐凯撒比萨：86287885
                乐万家：613858
                龙哥重庆小吃：660567
                妈妈厨房：641555
                麦豆缘：642611
                米修捞捞面：638054
                蜜蜜香：632845
                品味：623982
                前田盯汉堡：86285781
                蓉香苑：26988947
                如是好奶茶：660690
                赛百昧：86174140
                三井寿：652744
                三品螺蛳粉：636353
                沙县小吃：623073
                汕头肠粉：628410
                时间币：663377
                淘客：623982
                瓦罐汤：695827
                舞茶道：613983
                鲜奶颂：664791
                心怡甜品：13691947713
                叶子深大店：689230
                营养煲：69999
                宇盛韩式拌饭：657373
                御茶香：610382
                湛江新主意：26720859
                张妈台式锅烧：638108
                真味道：696097
                真味粉面：630124
                孖宝：644666
                【南区适用】
                稻花香：699598
                鼎厨：79999
                好邻居：28544667
                金贝子：788888
                食全食美：26603741
                一日三餐：625476
                来源：@深大吃货协会", "Description"=>"", "PicUrl"=>"", "Url" =>"");
			}break;
			case "5":{
				$content[] = array("Title"=>"行政部门电话", "Description"=>"可点击【查看全文】阅读所有行政部门的电话！
                党委办公室:26536105
                组织/统战部:26536209
                宣传部:26536197
                武装部:26536225/5313
                监察审计室:26532116
                纪委办:26534925
                工 会:26536186
                ·计划生育办公室:26536151
                共青团委员会:26537157
                校长办公室:26536190
                ·综合档案室:26536138
                ·文秘室:26732366
                教务部:26536118
                ·教务/考务:26536175/5153
                ·课室管理室:26537128
                ·学籍室:26536174
                ·教研室:26536178
                ·实践教学管理室:26535431
                ·教材中心:26537102
                社会科学部:26536137
                科学技术部:26536230/6623
                学生部:26538326", "PicUrl"=>"", "Url" =>"http://szuck.szucal.com/mess/phone.php");
			}break;
			case"3":{
                
                $content[] = array("Title"=>"蹭客福利", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[] = array("Title"=>"【五一福利】蹭旅游之风强势来袭，关注转发抢免费名额", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNqYZyrIVSS52s9DNytErHCXhrvTm9dXdcfLVvqpC9ibeicQBGCsFg1iaqeC73bmVUla6PRBSgtuwTEfw/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200155306&idx=1&sn=a037b26f6029b5ab964a39e3f7f3fd4c#rd");
            }break;
			case"4":{
			
                $content[] = array("Title"=>"蹭旅游", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[] = array("Title"=>"【五一福利】蹭旅游之风强势来袭，关注转发抢免费名额", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNqYZyrIVSS52s9DNytErHCXhrvTm9dXdcfLVvqpC9ibeicQBGCsFg1iaqeC73bmVUla6PRBSgtuwTEfw/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200155306&idx=1&sn=a037b26f6029b5ab964a39e3f7f3fd4c#rd");
			}break;
			case "7":{
			
                $content[]= array("Title"=>
                "回复：留言+留言内容 （臣妾的健康成长就拜托大人您啦）", "Description"=>"", "PicUrl"=>"", "Url" =>"");
			}break;
			case"留言":{
			 
                $content[] = array("Title"=>"感谢调戏
                臣妾将会尽快回复大人哟", "Description"=>"", "PicUrl"=>"", "Url" =>"");
			}break;
			case"福利":{
                $content[] = array("Title"=>"蹭客福利", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[] = array("Title"=>"【五一福利】蹭旅游之风强势来袭，关注转发抢免费名额", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNqYZyrIVSS52s9DNytErHCXhrvTm9dXdcfLVvqpC9ibeicQBGCsFg1iaqeC73bmVUla6PRBSgtuwTEfw/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200155306&idx=1&sn=a037b26f6029b5ab964a39e3f7f3fd4c#rd");
			}break;
			case"课":{
				$content[0] = array("Title"=>
                "一周蹭课指南
                今天你蹭课了吗", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
			  	$content[1] = array("Title"=>
			  
				"星期一（点击查看每天指南←_←）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080360&idx=1&sn=617876c7935161d4ad20e5267a85b674#rd");
			   	$content[2] = array("Title"=>"星期二（长期更新蹭课指南 (^３^)）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=2&sn=b9eede2f6003079dc0890a76c897977e#rd");
			    $content[3] = array("Title"=>"星期三（征收各种课程推荐 =^ω^=）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=3&sn=95939f6684feb309f205bf41ddc93ab4#rd");
				$content[4] = array("Title"=>"星期四（请投稿至深大蹭客(≥3≤)）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=4&sn=8ae55357ef4cd1b87e61524bff92297a#rd");
				$content[5] = array("Title"=>"星期五（承诺分分钟让亲上头条≧v≦）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200080400&idx=5&sn=8aa61f097b20ed5356a71edf9e1fff1b#rd");
			}break;
			case"活动":{
                $content[] = array("Title"=>"请选择你感兴趣的活动", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNr1eBRjhcMfklaeibxn7QLwibQ2645ibic41EtKh6Y6nMJ7ddRicGjC1yejJNkcB6KLZrTyanKZPiaZslHw/0", "Url" =>"");
                $content[] = array("Title"=>"『蹭公益』探访志愿者招募", "Description"=>"", "PicUrl"=>"http://mmbiz.qpic.cn/mmbiz/sxFRYRbzXNoVIqdpNuuVxBLbubJuTS3khOjiajrFEWtUsWtI2EjlcXiag6Wb1eSYxSicdySzbt0n2QQo6AicxM3yEQ/0", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200137674&idx=1&sn=4587de8e0eba8477b550eaaeae884c62#rd");
                $content[] = array("Title"=>"【蹭音乐会】免费领取美丽星期天门票", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200126875&idx=1&sn=dbba955f05ff486b1f7db94005cd7455#rd");
                $content[] = array("Title"=>"【蹭瑜珈】霎哈嘉瑜伽冥想公益班（长期有效）", "Description"=>"", "PicUrl"=>"", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200126875&idx=3&sn=2f39788379223b98ea02b43cdd7aa423#rd");
                // $content[] = array("Title"=>"", "Description"=>"", "PicUrl"=>"", "Url" =>"");

			}break;
            case "图文":
            case "单图文":{
                $content[] = array("Title"=>"图片", "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://mp.weixin.qq.com/s?__biz=MzA5NDQ1ODcwOQ==&mid=200126875&idx=1&sn=dbba955f05ff486b1f7db94005cd7455#rd");
			}break;
            case "多图文":{
                $content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
			}break;
			case "8":
            case "音乐":{
                $content = array("Title"=>"最炫民族风", "Description"=>"歌手：凤凰传奇", "MusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3", "HQMusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3");
			}break;
			case "9":
            case "天气":{
				//$content=mb_substr($keyword,0,2,'utf-8');
				$entity = str_replace("天气","",$keyword);
                $url = "http://apix.sinaapp.com/weather/?appkey=".$object->ToUserName."&city=".urlencode($entity); 
                $output = file_get_contents($url);
                $content = json_decode($output, true);
			}break;
			case "10":
			case "快递":{
				$entity = str_replace("快递","",$keyword);
				$url = "http://apix.sinaapp.com/expressauto/?appkey=".$object->ToUserName."&number=".$entity;
				$output = file_get_contents($url);
                $content = json_decode($output, true);
			}break;
			case "新版本":
			case "新版":
			case "11":{
				return true;
			}break;
			case "0":
            default:{
            	$content[] = array("Title"=>"关注深大蹭客", "Description"=>"", "PicUrl"=>"", "Url" =>"");
				$content[] = array("Title"=>"
				【1】蹭课指南					
				【2】活动推荐		
				【3】领福利				
				【4】蹭旅游
				【5】常用电话
				【6】外卖菜单
				【7】调戏蹭客君
				【8】音乐
				【9】天气
				【10】快递
				【11】新版
                更多福利，敬请期待！", "Description"=>"", "PicUrl"=>"", "Url" =>"");
                                $content[] = array("Title"=>"回复对应数字查看使用方法
                发送0返回本菜单", "Description"=>"", "PicUrl"=>"", "Url" =>"");
			}break;
        }
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

	//接收位置消息
    private function receiveLocation($object)
    {
        $content = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    private function receiveVoice($object)
    {
        if (empty($object->Recognition)){
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }else{
            $content = "你刚才说的是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }

        return $result;
    }
	

    private function receiveVideo($object)
    {
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }

    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        </xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
        <MediaId><![CDATA[%s]]></MediaId>
        </Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[image]]></MsgType>
        $item_str
        </xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
        <MediaId><![CDATA[%s]]></MediaId>
        </Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[voice]]></MsgType>
        $item_str
        </xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
        <MediaId><![CDATA[%s]]></MediaId>
        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
    	</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[video]]></MsgType>
        $item_str
        </xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    	</item>
		";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <Content><![CDATA[]]></Content>
        <ArticleCount>%s</ArticleCount>
        <Articles>
        $item_str</Articles>
        </xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <MusicUrl><![CDATA[%s]]></MusicUrl>
        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
        </Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[music]]></MsgType>
        $item_str
        </xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 10000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }
	
    function traceHttp(){
    	logger();
    }
}


?>