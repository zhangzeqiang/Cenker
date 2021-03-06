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
<style type="text/css">
#main{
	width:100%;
}
.middle{
position:absolute;
display:block;
left:40%;
}
body { margin:0; padding:0;  font-family: "宋体"; font-size: 14px; line-height:1.5 ; color:#1F1F1F;  } 

#topheader { 
margin:5px auto;
padding-top:10px;
width:100%;
height:60px;
background:#f2f6f9;
text-align:center;
color:#c70e5c;
font-weight:bold;}
#content { 
margin:5px auto; 
height:auto;
width:100%;
padding-top:10px;
padding-bottom:10px;
white-space:normal; 
background:#f2f6f9;
}
#footer { 
margin:5px auto; 
width:100%;
text-align:center;
height:auto; 
background:#f2f6f9;
color:#757575;}
.time{
color:#757575;
font-size:12px;
}
</style>
<?php require_once("../class/database.php"); ?>
</head>


<body>
<header>
	<div class="logo fl"><img src="./images/home2.png"></div>
    <div class="middle">活动详情</div>
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
	$id=$_GET['id'];
	$sql="select * from gongwentong where id='%s' ";
	$sql=sprintf($sql,$id);
	$db=new saeDatabase();
	$result=$db->select($sql);  //$result是一个二维数组
	
	$title=mb_convert_encoding($result[0]['title'],"UTF-8","gbk");
	$content=mb_convert_encoding($result[0]['content'],"UTF-8","gbk");
	$time=mb_convert_encoding($result[0]['time'],"UTF-8","gbk");
	$college_id=mb_convert_encoding($result[0]['college_id'],"UTF-8","gbk");
	$type=mb_convert_encoding($result[0]['type'],"UTF-8","gbk");
?>
 
<div id="content"><?php echo $content; ?> </div>


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
