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
.table_form{
 background:#ACD6FF;
}
.all{
margin-left:10px;
margin-right:10px;
}
</style>

<script type="text/javascript">
function sure(){
    var title=form.title.value;
    var classify=form.classify.value;
    var content=form.content.value;
    var time=form.time.value;
    var location=form.location.value;

    if(title==""){
       alert("活动主题不能为空");
        form.title.focus();
    }
    else if(classify==0){
        alert("活动分类不能为空");
        form.classify.focus();
    }
    else if(time==""){
        alert("活动时间不能为空");
        form.time.focus();
    }
    else if(content==""){
        alert("活动详情不能为空");
        form.content.focus();
    }
     else if(location==""){
        alert("活动地点不能为空");
        form.location.focus();
    }
    else{
        form.submit();
    }
}
function send(){
    var yes="<input type='file' name='file'/>";
    show.innerHTML=yes;
}
function checkOpen(){
    show.innerHTML="";
}
</script>
</head>


<body>
<header>
	<div class="logo fl"><img src="./images/home2.png"></div>
    <div class="middle">发起活动</div>
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
<div class="all">
	<hr style="border:dashed 1px #ffffff;height:6px;">
	<div class="table_form">
		<b>Tips:</b><br>
		<font color="#8E8E8E"><b>必填:活动主题、活动分类、活动时间、活动详情、活动地点;</b></font><br>
		<font color="#ADADAD"><b>可选:报名方式、备注;</b></font>
		
	</div>
	<hr style="border:dashed 1px #ffffff;height:6px;">
	 <form action="apply_from.php" method="post" name="form" enctype="multipart/form-data">
	  <div>
			<table border="1" height="100%" width="90%">
					<tr >
						<td align="center" colspan="2"><input type="text" style="height:100%" size="45" name="title" placeholder="活动主题"/></td>
					</tr>
					<tr>
						<td align="left" colspan="2">
						<select name="classify">
							<option value="0">活动分类</option>
							<option value="1">兼职</option>
							<option value="2">体育</option>
							<option value="3">交友</option>
							<option value="4">推广</option>
							<option value="5">其他</option>
						</select>                  
					</tr>
					 <tr>
						<td align="center" colspan="2"><input type="text" style="height:100%" size="45" name="time" placeholder="活动时间"/></td>
					</tr>
					<tr>
						<td align="center" colspan="2">
						<textarea cols="40" rows="3" name="content" placeholder="活动详情"></textarea>
					</tr>
					   <tr>
						<td align="center" colspan="2">
						<textarea cols="40" rows="3" name="location" placeholder="活动地点"></textarea>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="text"  style="height:100%" size="45" name="ask" placeholder="报名方式"/></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><textarea cols="40" rows="3" name="other" placeholder="备注"></textarea></td>
					</tr>
					
					<tr>
						<td align="right"><h3>是否开设微群</h3></td>
						<td align="center">
							<table align="center">
								<tr><td align="left"> <input type="radio" name="isOpen" onClick="send()"/>
									 是<font size="2">（需上传群二维码图片）</font></td></tr>
								<tr><td align="left"><input type="radio" name="isOpen" onClick="checkOpen()"/>否</td></tr>
								<tr><td id="show"width="35%" align="center"></td></tr>
							</table>                                 
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="button" onClick="sure()" value="提交"/></td>
					</tr>
			</table>
		</div>
		</form>
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
