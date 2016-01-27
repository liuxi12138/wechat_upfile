<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>十佳大学生候选人资料上传</title>
</head>
<body>
<?php
include_once("conn.php");
if(!isset($_GET['schoolid']))
{
	header("Location:index.html");
}
else
{
	//echo'SELECT * FROM `student` WHERE schoolid="'.$_GET['schoolid'].'";';
	$query=mysql_query("SELECT * FROM `student` WHERE schoolid='".$_GET['schoolid']."';");

	$student=mysql_fetch_array($query);
?>
<div class="container-fluid">
	<div class="row">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td>图片：</td>
				<td><?php echo "<img src='".$student['img']."'>" ?></td>
			</tr>
			<tr>
				<td>姓名：</td>
				<td><?php echo $student['name']?></td>
			</tr>
			<tr>
				<td>学院：</td>
				<td><?php echo $student['academy']?></td>
			</tr>
			<tr>
				<td>专业班级：</td>
				<td><?php echo $student['class']?></td>
			</tr>
			<tr>
				<td>学号：</td>
				<td><?php echo $student['schoolid']?></td>
			</tr>
			<tr>
				<td>个人简介：</td>
				<td><?php echo $student['summary']?></td>
			</tr>
		</table>
		<style type="text/css">
			table{
				margin:0 auto;
				text-align: center;
			}
			table td{
				width:300px;
				height:auto;
				border:1px solid #000;
				font-size: 30px;
				font-family: "微软雅黑";
				line-height: 50px;
			}
			table img{
				width:295px;
				height:413px;
			}
		</style>
	<?php
		/*echo "<div><label class='col-sm-12'>图片：</label><img src='".$student['img']."'><div>";
		echo "<div><label class='col-sm-2'>姓名：</label><div class='col-sm-10'>".$student['name']."</div></div>";
		echo "<div><label class='col-sm-2'>学院：</label><div class='col-sm-10'>".$student['academy']."</div></div>";
		echo "<div><label class='col-sm-2'>专业班级：</label><div class='col-sm-10'>".$student['class']."</div></div>";
		echo "<div><label class='col-sm-2'>学号：</label><div class='col-sm-10'>".$student['schoolid']."</div></div>";
		echo "<div><label class='col-sm-2'>个人简介：</label><div class='col-sm-10'>".$student['summary']."</div></div>";*/
	}
	?>
	</div>
</div>
</body>
</html>