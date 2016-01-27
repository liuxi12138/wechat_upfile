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
	header("Location:index.html");
}
else
{
	$name=$_POST['name'];
	$academy=$_POST['academy'];
	$class=$_POST['class'];
	$schoolid=$_POST['schoolid'];
	$summary=$_POST['summary'];
	$openid=$_POST['openid'];
	$check_query=mysql_query("select * from `student` where schoolid='$schoolid' limit 1");
	if(empty($check_query) || !mysql_fetch_array($check_query))//判断数据库是否有重复数据
	{
		if(!empty($_FILES['upfile']['tmp_name'])&&is_uploaded_file($_FILES['upfile']['tmp_name']))
		{ 
			//以上为需要插入数据库的部分数据，下方为文件上传
			$upfile=$_FILES["upfile"]; 
			//获取数组里面的值 
			$filename=$upfile["name"];//上传文件的文件名 
			$filetype=$upfile["type"];//上传文件的类型 
			$filesize=$upfile["size"];//上传文件的大小 
			$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径 
			//判断是否为图片 
			switch ($filetype)
			{ 
				case 'image/pjpeg':
					$okType=true; 
					$type="jpg";
				break; 
				case 'image/jpeg':
					$okType=true; 
					$type="jpg";
				break; 
				case 'image/gif':
					$okType=true; 
					$type="gif";
				break; 
				case 'image/png':
					$okType=true; 
					$type="png";
				break; 
			} 

			if($okType)
			{ 
				/** 
				* 0:文件上传成功<br/> 
				* 1：超过了文件大小，在php.ini文件中设置<br/> 
				* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/> 
				* 3：文件只有部分被上传<br/> 
				* 4：没有文件被上传<br/> 
				* 5：上传文件大小为0 
				*/ 
				$error=$upfile["error"];//上传后系统返回的值 
				/*
				echo "================<br/>"; 
				echo "上传文件名称是：".$filename."<br/>"; 
				echo "上传文件类型是：".$filetype."<br/>"; 
				echo "上传文件大小是：".$filesize."<br/>"; 
				echo "上传后系统返回的值是：".$error."<br/>"; 
				echo "上传文件的临时存放路径是：".$tmp_name."<br/>"; 

				echo "开始移动上传文件<br/>"; 
				*/
				//把上传的临时文件移动到up目录下面 
				$name = iconv('utf-8','gb2312',$name);
				move_uploaded_file($tmp_name,'up/'.$name.$schoolid.'.'.$type); 
				$name = iconv('gb2312','utf-8',$name);
				$destination="up/".$name.$schoolid.".".$type; 
				//echo $destination;
				//echo "================<br/>"; 
				
				//echo "上传信息：<br/>"; 
				if($error==0)
				{ 
					echo "图片上传成功，"; 
					/*
					echo "<br>图片预览:<br>"; 
					echo "<img src=".$destination.">"; 
					*///图片预览
					//echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">"; 
				}
				elseif ($error==1)
				{ 
					echo "超过了文件大小，在php.ini文件中设置"; 
				}
				elseif ($error==2)
				{ 
					echo "超过了文件的大小MAX_FILE_SIZE选项指定的值"; 
				}
				elseif ($error==3)
				{ 
					echo "图片只有部分被上传"; 
				}
				elseif ($error==4)
				{ 
					echo "没有图片被上传"; 
				}
				else
				{ 
					echo "上传图片大小为0"; 
				} 
			}
			else
			{ 
				echo "请上传jpg,gif,png等格式的图片！"; 
			} 
				//以下为数据库操作
			mysql_query("insert into `student` (id,img,name,academy,class,schoolid,summary,openid) value ('','$destination','$name','$academy','$class','$schoolid','$summary','$openid')") or die('插入失败');
			echo"信息提交成功，点击<a href='show.php?schoolid=".$_POST['schoolid']."'>此处</a>浏览信息";
		}
	} 
	else//判断数据库是否有重复数据，完
	{
		echo "已存在该学号,请点击<a href='index.html'>返回</a>，重新输入";
	}
}
?>
</body>
</html>