<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库连接</title>
</head>

<body>
<?php
/*****************************
*数据库连接
*****************************/
$conn = @mysql_connect("localhost","root","");
if (!$conn){
	die("连接数据库失败：" . mysql_error());
}
mysql_select_db("shijia", $conn);
//字符转换，读库
mysql_query("set character set utf8");
//写库
mysql_query("set names utf8");
?>
</body>
</html>