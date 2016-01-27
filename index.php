<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>十佳大学生候选人资料上传</title>
</head>
<body>
<?php
	include_once("conn.php");
	if(!isset($_POST['tijiao']))
	{
?>
<form action="upfile.php" enctype="multipart/form-data" method="post" name="uploadfile">
	照片：<input type="file" name="upfile" /><br> 
	<input type="submit" value="上传" />
</form> 
<form action="index.php" method="post" enctype="multipart/form-data"  name="student">
	<p>姓名：</p><input name="name" type="text" /><br />
	<p>学院：</p><input name="academy" type="text" /><br />
	<p>专业班级：</p><input name="class" type="text" /><br />
	<p>学号：</p><input name="schoolid" type="text" /><br />
	<p>个人简介:</p><textarea name="summary"></textarea>
	<p><input name="tijiao" type="submit" value="提交"></p>
</form>




<!--上传文件源码-->

<!--以上为html部分，以下为php部分-->

<!--上传文件源码end-->






<?php
	}
	else
	{
		$name=$_POST['name'];
		$academy=$_POST['academy'];
		$class=$_POST['class'];
		$schoolid=$_POST['schoolid'];
		$summary=$_POST['summary'];
		$check_query=mysql_query("select * from `student` where schoolid='$schoolid' limit 1");
		/*if(isset($check_query)&&mysql_fetch_array($check_query))
		{
			echo '错误：学号 ',$schoolid,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
		}else*/
		if(empty($check_query) || !mysql_fetch_array($check_query))
		{
			mysql_query("insert into `student` (id,name,academy,class,schoolid,summary) value ('','$name','$academy','$class','$schoolid','$summary')") or die('失败');
			echo"信息提交成功，点击<a href='#'>此处</a>修改信息";
		}
	}
?>
</body>
</html>