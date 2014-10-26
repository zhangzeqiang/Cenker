<?php 
/*--------------------------------------------------------------------
 *--@Author:深圳大学荔园晨风2014技术组成员
 *--@Time:21/5/2014
 *--@版权所有
 *--@说明:使用此代码时请注明为深大荔园晨风技术组开发
 */
/* 过滤函数 */ 

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string){
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}

/**
 * 返回经stripslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_stripslashes($string) {
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
	return $string;
}
//整型过滤函数 
function get_int($number) 
{ 
    return intval($number); 
} 
function get_float($number)
{
    return floatval($number); 
}
//字符串型过滤函数 
function get_str($string) 
{ 
   if (!get_magic_quotes_gpc()){   
	   return $string= is_array($string) ? array_map('get_str', $string) : addslashes($string);
    }  
	else
	{
		return $string;
	}
}
function show_str($string)
{
	return stripslashes($string);
}

function strip_sql($string)
{
	$search_arr = array("/ union /i","/ select /i","/ update /i","/ outfile /i","/ or /i");
    $replace_arr = array('&nbsp;union&nbsp;','&nbsp;select&nbsp;','&nbsp;update&nbsp;','&nbsp;outfile&nbsp;','&nbsp;or&nbsp;');
	return is_array($string) ? array_map('strip_sql', $string) : preg_replace($search_arr, $replace_arr, $string);
}
function strip_js($string, $js = 1)
{
	$string = str_replace(array("\n","\r","\""),array('','',"\\\""),$string);
	return $js==1 ? "document.write(\"".$string."\");\n" : $string;
}

function str_safe($string)
{
	$searcharr = array("/(javascript|jscript|js|vbscript|vbs|about):/i","/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i","/<script([^>]*)>/i","/<iframe([^>]*)>/i","/<frame([^>]*)>/i","/<link([^>]*)>/i","/@import/i");
	$replacearr = array("\\1\n:","on\n\\1","&lt;script\\1&gt;","&lt;iframe\\1&gt;","&lt;frame\\1&gt;","&lt;link\\1&gt;","@\nimport");
	$string = preg_replace($searcharr,$replacearr,$string);
	$string = str_replace("&#","&\n#",$string);
	return $string;
}
/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}
/* 常用函数 */ 
//格式化文本域内容

function removeBr($string)
{
	// preg_replace("/[\s]{2,}/","",$str).'<br>';
//去除多余的空格和换行符，只保留一个
return preg_replace("/([\s]{2,})/","\\1",$string);

	
}
function trim_textarea($string)
{
	$string = nl2br(str_replace(' ','&nbsp;',$string));
	return $string;
}

function show_textarea($string)
{
	return str_replace('<br />','',$string);

}


//获取IP地址
function getIP() { 
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) 
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
	else if (@$_SERVER["HTTP_CLIENT_IP"]) 
	$ip = $_SERVER["HTTP_CLIENT_IP"]; 
	else if (@$_SERVER["REMOTE_ADDR"]) 
	$ip = $_SERVER["REMOTE_ADDR"]; 
	else if (@getenv("HTTP_X_FORWARDED_FOR"))
	$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (@getenv("HTTP_CLIENT_IP")) 
	$ip = getenv("HTTP_CLIENT_IP"); 
	else if (@getenv("REMOTE_ADDR")) 
	$ip = getenv("REMOTE_ADDR"); 
	else 
	$ip = "Unknown"; 
	return $ip; 
}

//获取当前时间
function gettime()
{
	return date('Y-m-d H:i:s',time());
}

//获取毫秒
function getMillisecond()
{
    list($s1, $s2) = explode(' ', microtime());
	return $s1;
	//return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);	
}

//短日期
function short_time($time)
{
	return date('Y-m-d',strtotime($time));
}

function to_long_time($time)
{
   return date('Y-m-d H:i:s',$time);
}

function get_filename()
{
   return date('ymdHis',time()).round(getMillisecond()*10000);
}

//获取URL地址
function gethost()
{
	return 'http://'.$_SERVER['HTTP_HOST'];
}

function fileext($filename)
{
	return trim(substr(strrchr($filename, '.'), 1));
}


function sizecount($filesize) {
	if ($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
	} elseif ($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 .' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize.' Bytes';
	}
	return $filesize;
}
//获取随机数
function random($length, $chars = '0123456789abcdefghijklmnopqrstuvwsyz')
{
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++)
	{
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

//截取多余字符
function substr_cut($string, $length, $dot = ' ...')
{
	global $CONFIG;
	$string=strip_tags($string);
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>'), $string);
	$strcut = '';
	if(strtolower($CONFIG['charset']) == 'utf-8')
	{
		$n = $tn = $noc = 0;
		while($n < $strlen)
		{
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) break;
		}
		if($noc > $length) $n -= $tn;
		$strcut = substr($string, 0, $n);
	}
	else
	{
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		for($i = 0; $i < $maxi; $i++)
		{
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	$strcut = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
	return $strcut.$dot;
}
/* 验证格式函数 */ 
//判断Email格式
function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function is_tel($email) {
	return strlen($email) > 10 && preg_match("/^\d{11,12}$/", $email);
}

function is_username($username) {
	return strlen($username) >= 5 && preg_match("/^\w{5,16}$/", $username);
}

function is_password($password) {
	return strlen($password) >= 6 && preg_match("/^\w{6,16}$/", $password);
}

function is_pay_password($str)
{
	return strlen($str) == 6 && preg_match("/^\d{6}$/", $str);
}
//判断日期格式
function isdate($date, $sep='-') 
{
	if(empty($date)) return FALSE;
	if(strlen($date) > 10)  return FALSE;
	list($year, $month, $day) = explode($sep, $date);
	return @checkdate($month, $day, $year);
}

function numberval($number, $precision = 2)
{
	if(!is_numeric($number) || substr_count($number, '.') > 1) return FALSE;
	return sprintf('%.'.$precision.'f', round(floatval($number), $precision));
}

function strongmd5($str)
{
	return md5(md5($str).'river');
}

function insertSql($table,$array)
	{
	    $sql='insert into '.$table.'(';
	    foreach($array as $key=>$val){
			  $sql.=$key.",";
	    }
		$sql=substr($sql,0,-1);
	   $sql.=')values(';
	    foreach($array as $key=>$val){
			  $sql.='\''.get_str($val)."',";
	    }
	  $sql=substr($sql,0,-1);
	   $sql.=')';
	   return $sql;
	   
	}
	function updateSql($table,$array,$str)
	{
	    $sql='update '.$table.' set ';
		foreach($array as $key=>$val)
		{
			$sql.=$key.'=\''.get_str($val).'\',';
		}
		$sql=substr($sql,0,-1);
	    $sql.=" where ".$str;
	    return $sql;
	}
	
function request_uri()
{
    if (isset($_SERVER['REQUEST_URI']))
    {
        $uri = $_SERVER['REQUEST_URI'];
    }
    else
    {
        if (isset($_SERVER['argv']))
        {
            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
        }
        else
        {
            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
        }
    }
    return $uri;
}

function unlinkFile($aimUrl) { 
   if (file_exists($aimUrl)) { 
        unlink($aimUrl); 
        return true; 
   } else { 
       return false; 
   } 
} 

function del_file($url) { 
   if (file_exists($url)) { 
        @unlink($url); 
        return true; 
   } else { 
       return false; 
   } 
}


function get_url_content($url)
{
	global $CONFIG;
	try
	{
		$url=$CONFIG['url'].'/'.$url;
	    $contents = @file_get_contents($url);
	    //如果出现中文乱码使用下面代码
        //$getcontent = iconv(”gb2312″, “utf-8″,file_get_contents($url));
	}
	catch(Exception $e)
	{
		$contents='';
	}
    return $contents;

}


//输入框
function show_input($str)
{
	$str=str_replace("\"","&#34;",$str);
    $str=str_replace("'","&#39;",$str);
	return $str;
}

//文件操作
//写文件
function write_file($path,$str)
{
	 $handle=fopen($path,"w");//不存在就创建;,创建页面
     fwrite($handle,$str);
     fclose($handle);
}
//读文件
function read_file($path)
{
	$fp=fopen($path,"r");//只读打开模板;
    $str=fread($fp,filesize($path));//读取模板内容
	fclose($fp);
	return $str;
}

//获取复选框的值
function get_checkbox_value($par)
{
	if(isset($_POST[$par]))
	{
		$arr=$_POST[$par];
		$ret='';
		foreach($arr as $a_v)
        {
           $ret .= $a_v.',';	 
        }
		$ret=trim($ret,',');
		return $ret;
	}
	else
	{
		return '';
	}
}

// 显示图片
function show_upload($name='picture',$id='picture',$pic='',$pic_width='',$pic_height='',$spec='',$type='',$path='')
{
	echo '<input name="'.$name.'" id="'.$id.'" value="'.$pic.'" type="hidden" size="30" maxlength="50" /><iframe align="absmiddle" src="upload_pic.php?pic='.$id.'&picshow='.$id.'_show&type='.$type.'" frameborder=0 scrolling=no style="width:310px; height:22px; border:0px; padding:0px; margin:0px"></iframe>'.$spec.'<br />';
	$pic_w=$pic_width==''?'':'width="'.$pic_width.'"';
	$pic_h=$pic_height==''?'':'height="'.$pic_height.'"';
	if($pic=='')
	   echo '<img id="'.$id.'_show" '.$pic_w.' '.$pic_h.' src="" style="display:none" />';
	else
	   echo '<img id="'.$id.'_show" '.$pic_w.' '.$pic_h.' src="'.$path.$pic.'" />';
}
//上传文件
function show_upload2($name='fileurl',$id='fileurl',$pic='',$spec='',$type='')
{
	echo '<input name="'.$name.'" id="'.$id.'" value="'.$pic.'" style="border:1px solid #ccc;height:14px;line-height:14px;" type="text" size="30" /> <iframe align="absmiddle" src="upload_pic.php?pic='.$id.'&type='.$type.'" frameborder=0 scrolling=no style="width:310px; height:22px; border:0px; padding:0px; margin:0px"></iframe>'.$spec.'';	
}

function day_diff($time_begin,$time_end='')
{
	if($time_end=='')
	{
		$time_end=gettime();
	}
	$time1=strtotime($time_begin);
	$time2=strtotime($time_end);
	return (int)(($time2-$time1)/(24*3600));
}

?>