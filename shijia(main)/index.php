<?php
include_once('conn.php');
    $appid = "";  
    $secret = "";  //这两样东西都可以在微信公众平台的后台找到，不过需要管理员的最高权限才能知道
    $code = $_GET["code"];  
    $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';  
    function https_request($url, $data = null) //url 请求函数
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    $output = https_request($get_token_url);
    $json_obj = json_decode($output);
    $array = get_object_vars($json_obj);
      
    //根据openid和access_token查询用户信息  
    $access_token = $array['access_token'];  
    $openid = $array['openid'];  

    $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';  
    $output = https_request($get_user_info_url);
    $user_obj = json_decode($output);
    $user_array = get_object_vars($user_obj); 

    $get_user_token ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
    $output2= https_request($get_user_token);
    $output2 = json_decode($output2);
    $array2 = get_object_vars($output2);//转换成数组
    $access_token2= $array2['access_token'];

    $get_user_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token2.'&openid='.$openid.'&lang=zh_CN';
    $output3= https_request($get_user_url);
    $output3 = json_decode($output3);
    $array3 = get_object_vars($output3);//转换成数组
    $subscribe= $array3['subscribe'];//输出subscribe 根据其值判断是否关注了公众号  

	if ($subscribe == 1){//判断是否关注，不关注无法上传（因为没有openid）
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<title>十佳大学生候选人资料上传</title>
<script>
function InputCheck(student)
{
	if (student.upfile.value == "")
	{
		alert("未选择图片");
		student.upfile.focus();
		return(false);
	}
	if (student.name.value == "")
	{
		alert("用户名不能为空！");
		student.name.focus();
		return(false);
	}
	if (student.academy.value == "")
	{
		alert("学院不能为空！");
		student.academy.focus();
		return(false);
	}
	if (student.class.value == "")
	{
		alert("专业班级不能为空！");
		student.class.focus();
		return(false);
	}
	if (student.schoolid.value == "")
	{
		alert("学号不能为空！");
		student.schoolid.focus();
		return(false);
	}
	if (student.summary.value == "")
	{
		alert("个人简介不能为空！");
		student.summary.focus();
		return(false);
	}

}
</script>
</head>
<body>
<div class="container-fluid" style="text-align:center;">
	<h1>十佳大学生候选人信息登记</h1>
</div>
<form class="form-horizontal container-fluid" action="insert.php" enctype="multipart/form-data" method="post" name="student" onsubmit="return InputCheck(this)">
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">照片：</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<input id="exampleInputFile"type="file" name="upfile" /> 
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">姓名：</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<input class="form-control" name="name" type="text" />
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">学院：</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<input class="form-control" name="academy" type="text" />
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">专业班级：</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<input class="form-control" name="class" type="text" />
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">学号：</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<input class="form-control" name="schoolid" type="text" />
		<input name="openid" type="hidden" value="<?php echo $openid; ?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 col-md-2 col-lg-2">个人简介:</label>

	<div class="col-sm-10 col-md-10 col-lg-10">
		<textarea class="form-control" name="summary" rows="15"></textarea>
	</div>
</div>

	<input class="btn btn-primary btn-lg btn-block" name="tijiao" type="submit" value="提交">
</form>
</body>
</html>
<?php
	}
?>