<?php

function register()
{
	include('_main.php');
	
	$err = '';
	/* 默认值 */
	$para['user_status'] = 0;
	$para['user_school'] = 'whu';
	$para['user_nickname']= '';
	$para['user_name']= '';
	
	/*　判空　*/
	if(strlen($_POST['user_login']) == 0 && strlen($_POST['user_stuid']) == 0)
	{
		$err = '邮箱和学号不能同时为空';
		return $err;
	}
	if(strlen($_POST['user_pass']) == 0)
	{
		$err = '密码不能为空';
		return $err;
	}
	
	/* 判空 & 填充 */
	if(strlen($_POST['user_login']) == 0)
	{
		$para['user_login'] = 'none';
	}
	if(strlen($_POST['user_stuid']) == 0)
	{
		$para['user_stuid'] = '';
	}
	if(strlen($_POST['user_status']) != 0)
	{
		$para['user_status'] = $_POST['user_status'];
	}
	if(strlen($_POST['user_school']) != 0)
	{
		$para['user_school'] = $_POST['user_school'];
	}
	if(strlen($_POST['user_nickname']) != 0)
	{
		$para['user_nickname'] = $_POST['user_nickname'];
	}
	if(strlen($_POST['user_name']) != 0)
	{
		$para['user_name'] = $_POST['user_name'];
	}
	
	/* 限长*/
	if(strlen($_POST['user_login']) > $users_len['user_login'])
	{
		$err = '邮箱长度超出限制';
		return $err;
	}
	if(strlen($_POST['user_pass']) > $users_len['user_pass'])
	{
		$err = '密码长度超出限制';
		return $err;
	}
	if(strlen($_POST['user_status']) > $users_len['user_status'])
	{
		$err = 'status error';
		return $err;
	}
	if(strlen($_POST['user_school']) > $users_len['user_school'])
	{
		$err = '学校长度超出限制';
		return $err;
	}
	if(strlen($_POST['user_stuid']) > $users_len['user_stuid'])
	{
		$err = '学号长度超出限制';
		return $err;
	}
	if(strlen($_POST['user_nickname']) > $users_len['user_nickname'])
	{
		$err = '昵称长度超出限制';
		return $err;
	}
	if(strlen($_POST['user_name']) > $users_len['user_name'])
	{
		$err = '姓名长度超出限制';
		return $err;
	}
	
	
	/* 正则 */
	if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $_POST['user_login']))
	{
		$err = '邮箱不正确';
		return $err;
	}
	// password
	
	
	/* 生成 */
	$para['user_registered'] = time();
	
	$temp = MD5(time());
	$temp = $temp . $random_key['user_passkey'];
	$temp = MD5($temp);
	$para['user_passkey'] = $temp;
	
	// echo 'pass:' , $_POST['user_pass'] , '<br>';
	$para['user_pass'] = get_pass_hash(MD5($_POST['user_pass']), $random_key['user_passkey']. $para['user_passkey']);	
	
	
	/* 封装 写入db */
	foreach($users_field as $value)
	{
		if(!isset($para[$value])) {
			$para[$value] = $_POST[$value];
		}
	}

	print_r($para); // debug
	
	include('dal/__insert.php'); // 底层函数
	if(insert($para,'ng_users'))
	{
		// 注册成功
		// return 1;
		return '注册成功';
	}
	else
	{
		$err = '注册失败';
		return $err;
	}

}


$str = register();
echo $str;


/*

//注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 6){
	exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email)){
			     　　　　//匹配email地址 
	exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($name) > 10) {
	exit('错误：姓名长度不符合规定.<a href="javascript:history.back(-1);">返回</a>');
}
*/



?>