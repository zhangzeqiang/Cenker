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
body { margin:0; padding:0;  font-family: "宋体"; font-size: 14px; line-height:1.5 ; color:#1F1F1F;  } 
a:hover { color:#1F1F1F; }
#main{
	width:100%;
}
.middle{
position:absolute;
display:block;
left:40%;
}
#content { 
margin:auto;
margin:6px 10px; 
height:auto;
width:auto;
padding:10px 5px;
white-space:normal; 
background:#f2f6f9;

}
.one{
color:#ACD6FF;
//color:#33CCA6;
font-weight:bold;
}
.two{
//color:#38C0AF;
color:#FFFFFF;
font-weight:bold;
}

</style>
</head>


<body>
<header>
	<div class="logo fl"><img src="./images/home2.png"></div>
    <div class="middle">公文通小站</div>
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
<article id="main">
	 
</article>


<?php
	 require_once("../class/database.php");
	 require_once("../wechat/interface.php");
    $db=new saeDatabase();
	$type=$_GET['type'];
	$type=isset($_GET['type'])?$_GET['type']:null;
	
    
?>
	<div id="content" style="text-align:center;background-color:#ACD6FF;">
		<!--document.write("<a href='http://1.cengker.sinaapp.com/mobile/gwt_more.php?type=" + encodeURI(encodeURI("学术")) + "'>学术</a>");-->
		<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt_more.php?type=学术' class="two">学术</a>
		<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt_more.php?type=校园' class="two">校园</a>
		<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt_more.php?type=教务' class="two">教务</a>
		<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt_more.php?type=行政' class="two">行政</a>
		<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt_more.php?type=学工' class="two">学工</a>
	
	</div>
	
<?php
	if($type!=null){
		$sql="select * from gongwentong where type=N'$type'";
		$result=$db->select($sql);
		$count=count($result)+0;

}else{
		$sql="select * from gongwentong";
		$result=$db->select($sql);
		$count=count($result)+0;
	}
	for($i=0;$i<$count;$i++){
		$id=mb_convert_encoding($result[$i]['id'],"UTF-8","gbk");
		$title=mb_convert_encoding($result[$i]['title'],"UTF-8","gbk");
		$content=mb_convert_encoding($result[$i]['content'],"UTF-8","gbk");
		$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
		$college_id=mb_convert_encoding($result[$i]['college_id'],"UTF-8","gbk");
		$type=mb_convert_encoding($result[$i]['type'],"UTF-8","gbk");
	?>
	<a href='<?php echo URL::$LOCAL; ?>/mobile/gwt.php?id=<?php echo $id;?>'>
	<?php
	if($type=="学工"){$type="学工";}
	else if($type=="校园"){$type="校园";}
	else if($type=="教务"){$type="教务";}
	else if($type=="学术"){$type="学术";}
	else if($type=="行政"){$type="行政";}
	?>
		 <div id="content"> 
		 <span class="one" ><?php echo "[".$type."]"?> </span>
		 <?php echo $title;?>
		 </div>	 
		<?php
	
	}
?>
</a>



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
