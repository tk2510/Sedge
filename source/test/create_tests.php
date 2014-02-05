<?php
/*
Author: ng1091
Date: 2013-11-09
Description: 用于向数据库中添加记录，便于测试
*/

include('../bll/dal/__insert.php');


$user[] = array(
	"user_login" => "weitao201@163.com",
	"user_pass" => "123456",
	"user_passkey" => "mypasskey",
	"user_registered" => time(),
	"user_stuid" => "2011301500236",
	"user_nickname" => "Ng",
	"user_gender" => 0,
	"user_name" => "Lihua",
);

$user[] = array(
	"user_login" => "lilei@163.com",
	"user_pass" => "654321",
	"user_passkey" => "llpasskey",
	"user_registered" => time(),
	"user_stuid" => "2011301500789",
	"user_nickname" => "LL",
	"user_gender" => 0,
	"user_name" => "李雷",
);

$user[] = array(
	"user_login" => "hanmm@163.com",
	"user_pass" => "123123",
	"user_passkey" => "hpasskey",
	"user_registered" => time(),
	"user_stuid" => "2011301500699",
	"user_nickname" => "HMM",
	"user_gender" => 1,
	"user_name" => "韩梅梅",
);

// var_dump($user);

foreach($user as $key => $value){
	echo $key;
	if(insert($value, 'ng_user'))
	{
		echo ' user insert ok!<br>';
	}
	else
	{
		echo ' user insert failed:<br>';
		var_dump($value);
		echo '<br>';
		die(mysql_error());
		
	}
}


$user_meta[] = array(
	"user_id" => 1,
	"meta_key" => "绑定手机",
	"meta_value" => "13100000000",
);

$user_meta[] = array(
	"user_id" => 1,
	"meta_key" => "个性签名",
	"meta_value" => "万古长空 一朝风月",
);

$user_meta[] = array(
	"user_id" => 2,
	"meta_key" => "绑定手机",
	"meta_value" => "18600000000",
);

$user_meta[] = array(
	"user_id" => 2,
	"meta_key" => "个性签名",
	"meta_value" => "嘿！我可是李雷！",
);

$user_meta[] = array(
	"user_id" => 3,
	"meta_key" => "绑定手机",
	"meta_value" => "18900000000",
);

$user_meta[] = array(
	"user_id" => 3,
	"meta_key" => "个性签名",
	"meta_value" => "I''m fine, thank you!",
);

foreach($user_meta as $key => $value){
	echo $key;
	if(insert($value, 'ng_usermeta'))
	{
		echo ' usermeta insert ok!<br>';
	}
	else
	{
		echo ' usermeta insert failed:<br>';
		var_dump($value);
		echo '<br>';
		die(mysql_error());	
	}
}

?>


