<?php

	/* Length Limit of <ng_users> */
	$users_len['user_login'] = 10;
	$users_len['user_pass'] = 10;
	$users_len['user_status'] = 10;
	$users_len['user_school'] = 10;
	$users_len['user_stuid'] = 10;
	$users_len['user_nickname'] = 10;
	$users_len['user_name'] = 10;
	
	/* <ng_users>中的字段 */
	$users_field = array(
		'user_login',
		'user_pass',
		'user_passkey',
		'user_registered',
		'user_status',
		'user_school',
		'user_stuid',
		'user_nickname',
		'user_name',
	);
	
	/* Random Key used in generate password */
	$random_key['user_passkey'] = '10912011.1080p.BluRay.x264-SECTOR7[PublicHD.ORG].srt';
	
	
	/* pass为一次md5, key为 random_key . passkey
	*/
	function get_pass_hash($pass, $key)
	{
		$pass = $pass . $key;
		$pass = MD5($pass);
		return $pass;
	}
	
	function is_none($str)
	{
		return strlen($str) == 0;
	}
	
	function len_limit($str, $lim)
	{
		return strlen($str) > $lim;
	}

?>