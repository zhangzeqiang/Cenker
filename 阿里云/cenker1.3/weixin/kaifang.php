<?php 
include("conn.inc.php");
include("common.func.php");
$pagesize=8;
if(isset($_GET['page'])&&$_GET['page']!=''){
	$page=$_GET['page'];
}
else{
	$page=0;
}
$begin=$page*$pagesize;
$sql="select name,url,time from room_record order by time desc limit $begin,$pagesize;";
$sql_i="select name,url,time from room_record";
$result=mysql_query($sql);
$num=mysql_num_rows(mysql_query($sql_i));
$totalpage=ceil($num/$pagesize);
?>
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
</style>
</head>


<body>
<header>
	<div class="logo fl"><img src="home2.png"></div>
    <div class="middle">房间列表</div>
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
	<section>
	<ul class="news_list">
	<?php 
 while($rs=mysql_fetch_assoc($result)){
	?>	
		<li><a href="<?php echo $rs['url']?>"><?php echo $rs['name']?></a></li>
	<?php }?>
	</section>
		</ul>
<a href="kaifang.php?page="<?php if ($page>0) echo $page-1; ?>">上一页</a>
<a href="kaifang.php?page=<?php if($page<$totalpage-1) echo $page+1;?>">下一页</a>

</article>

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
