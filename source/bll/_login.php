
<?php
/*
Author: Ng1091
Date: 2013-10-31
Description: 登录验证，传入$user、$pass，验证登录信息是否正确并返回结果。
*/

function login($user, $pass)
{
	include('_main.php');
	$err = '';


	/*　判空　*/
	if(is_none($user))
	{
		$err = '登录名不能为空';
		return $err;
	}
	if(is_none($pass))
	{
		$err = '密码不能为空';
		return $err;
	}
	
	/* 正则 */
	
	// 判断是邮箱还是学号
	
	$login_type = 'user_login';
	$login_type = 'user_stuid';
	
	
	
	
	/* 限长*/
	if(len_limit($user, $users_len[$login_type])
	{
		$err = '登录名超出长度限制';
		return $err;
	}

	/* 验证　& 登录 */
	// 取得passkey
	include('dal/__select.php'); // 底层函数

	$passkey = select('user_passkey', 'ng_users', "$login_type='$user' limit 1");
	
	$row = mysql_fetch_array($passkey);
	$passkey = $row[0];
	
	if(is_none($pass_key)
	{
		$err = 'get pass_key error';
		return $err;
	}
	
	$pass =  get_pass_hash(MD5($pass), $random_key['user_passkey']. $passkey);
	
	
	

	if(select('uid', 'ng_users', "$login_type='$user' and user_pass='$pass' limit 1"))
	{
		// 登录成功
		// 加入会话 
		
		return '登录成功';
	}
	else
	{
		$err = '登录失败,用户名或密码错误';
		return $err;
	}
}


// 传入参数 login & pass
$str = login($_POST['login'],$_POST['pass']);
echo $str;

?>
	