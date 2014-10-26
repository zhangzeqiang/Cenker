<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<!DOCTYPE HTML>

<html>
<head>
<meta charset="UTF-8"> 
<meta content="width=device-width,user-scalable=no" name="viewport"> 
<title>深大蹭客</title>
<link href="css/index.css" rel="stylesheet" type="text/css">
<link href="css/public.css" rel="stylesheet" type="text/css">
<script src="js/zepto.js" language="javascript" type="text/javascript" ></script>
<!--触摸屏效果滑动组件-->
<script type="text/javascript" src="./js/touch.js"></script>
<script type="text/javascript" src="./js/zepto.extend.js"></script>
<script type="text/javascript" src="./js/zepto.ui.js"></script>
<script type="text/javascript" src="./js/slider.js"></script>
<!--触摸屏效果滑动组件end-->
<style>
#main{
	width:100%;
}
.middle{
position:absolute;
display:block;
left:40%;
}
.content{
margin-left:30px;
}
.classify{
background-color:#ACD6FF;
}
.all{
margin-left:10px;
margin-right:10px;
}
</style>
</head>


<body>
<header>
	<div class="logo fl"><img src="./images/home2.png"></div>
    <div class="middle">豆瓣活动</div>
	<div class="tool_btn fr">
        <a href="javascript:;" class="souban" id="soubanButton">导航</a>
    </div>
</header>
	<div style="display:none" class="hongye_style">
		<div class="course">
				<ul>
					<li><a href="">导航一</a></li>
					<li><a href="">导航二</a></li>
					<li><a href="">导航三</a></li>
					<li><a href="">导航四</a></li>
					<li><a href="">导航五</a></li>
					<li><a href="">导航六</a></li>
					<li><a href="">导航七</a></li>
					<li><a href="">导航八</a></li>
					<li><a href="">导航九</a></li>
					<li><a href="">导航十</a></li>
					<li><a href="">导航十一</a></li>
					<li><a href="">导航十二</a></li>


				</ul>
		</div>
	</div>
	<script>
		$("#soubanButton").click(function(){
				$(".hongye_style").toggle();
			})
	</script>

<script>
    //创建slider组件
    $('#fla').slider();
</script>
    <div class="clr"></div>

<?php
	 require_once("../class/database.php");
	 require_once("../wechat/interface.php");
    $db=new saeDatabase();
	$type=$_GET['type'];
	$type=isset($_GET['type'])?$_GET['type']:null;
    
?>
<div class="all">
	<hr style="border:dashed 1px #ffffff;height:6px;">
	<div class="classify">
		<div class="content">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=music'><font size="4px" color="#ffffff">音乐</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=drama'><font size="4px" color="#ffffff">戏剧</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=salon'><font size="4px" color="#ffffff">讲座</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=party'><font size="4px" color="#ffffff">聚会</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=film'><font size="4px" color="#ffffff">电影</font></a>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=exhibition'><font size="4px" color="#ffffff">展览</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=commonweal'><font size="4px" color="#ffffff">公益</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=travel'><font size="4px" color="#ffffff"> 旅行</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?type=others'><font size="4px" color="#ffffff"> 其他</font></a>
				<a href='<?php echo URL::$LOCAL; ?>/mobile/show_more_douban.php?'><font size="4px" color="#ffffff">全部</font></a>
			</font>
		</div>
	</div>
	<hr style="border:dashed 1px #ffffff;height:6px;">
	<?php
		if($type!=null){
			$sql="select id,type,subject,starttime,endtime,place,in_number,content from douban where type='$type'";
			$result=$db->select($sql);
			$count=count($result)+0;

	}else{
			$sql="select id,type,subject,starttime,endtime,place,in_number,content from douban";
			$result=$db->select($sql);
			$count=count($result)+0;
		}
		for($i=0;$i<$count;$i++){
			$id=mb_convert_encoding($result[$i]['id'],"UTF-8","gbk");
			$type=mb_convert_encoding($result[$i]['type'],"UTF-8","gbk");
			$subject=mb_convert_encoding($result[$i]['subject'],"UTF-8","gbk");
			//$starttime=mb_convert_encoding($result[$i]['starttime'],"UTF-8","gbk");
			//$endtime=mb_convert_encoding($result[$i]['endtime'],"UTF-8","gbk");
			$place=mb_convert_encoding($result[$i]['place'],"UTF-8","gbk");
			//$in_number=mb_convert_encoding($result[$i]['in_number'],"UTF-8","gbk");
			//$content=mb_convert_encoding($result[$i]['content'],"UTF-8","gbk");

		if($type=="music"){$type="<font color='#4F9D9D' size='5px'><b>音乐</b></font>";}
		else if($type=="drama"){$type="<font color='#02DF82' size='5px'><b>戏剧</b></font>";}
		else if($type=="salon"){$type="<font color='#2828FF' size='5px'><b>讲座</b></font>";}
		else if($type=="party"){$type="<font color='#E1E100' size='5px'><b>聚会</b></font>";}
		else if($type=="film"){$type="<font color='#FF5809' size='5px'><b>电影</b></font>";}
		else if($type=="exhibition"){$type="<font color='#FF79BC' size='5px'><b>展览</b></font>";}
		else if($type=="commonweal"){$type="<font color='#FF00FF' size='5px'><b>公益</b></font>";}
		else if($type=="travel"){$type="<font color='#E6CAFF' size='5px'><b>旅行</b></font>";}
		else if($type=="others"){$type="<font color='#A6A600' size='5px'><b>其他</b></font>";}
		?>
	<table border="0" style="width:100%;height:100%;background-color:#ECF5FF">		
		<tr valign="baseline"><td width="15%" align="center"></td><td><?php echo $type; ?></td></tr>
		<tr valign="baseline"><td width="15%" align="center"><font size='4px'><b>主题:</b></font></td><td><?php echo $subject; ?></td></tr>
		<tr valign="baseline"><td width="15%" align="center"><font size='4px'><b>地点:</b></font></td><td><?php echo $place; ?></td></tr>
		<tr><td width="15%"></td>
		<td style="padding-left:5cm;"><a href='<?php echo URL::$LOCAL; ?>/mobile/douban.php?id=<?php echo $id;?>'><font color="#BEBEBE"><b>查看详情</b></font></a></td>
		</tr>
		<!--
		<tr valign="baseline"><td width="20%"><b>开始时间:</b></td><td><?php //echo $starttime; ?></td></tr>
		<tr valign="baseline"><td width="20%"><b>结束时间:</b></td><td><?php //echo $endtime; ?></td></tr>
		<tr valign="baseline"><td width="20%"><b>预计人数:</b></td><td><?php //echo $in_number; ?></td></tr>-->
	</table>
	<hr style="border:dashed 1px #ffffff;height:6px;">
	<?php	} ?>
</div>
</body>
<script>
	Zepto(function($){
		// 导航切换效果
		$("#CatNav a").click(function(){
			$("#CatNav a").removeClass('on');
			$(this).addClass('on');
			$(".CatNavList").css('display', 'none');
			$(".CatNavList" + $(this).index()).css('display', 'block');
		});

        $("#newsList").slider({
            autoPlay    : false, 
            showDot     : false,
			loop        : true,//是否循环
            slideend    : function(a, page){
                $("#CatNav a").removeClass('on');
                $("#CatNav a").eq(page).addClass('on');
            }
        });

	})
</script>
<link rel="stylesheet" type="text/css" href="css/slider.css" />
</html>
