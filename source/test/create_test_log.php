<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"login_user" => 1,
	"login_date" => time(),
);

$user[] = array(
	"login_user" => 2,
	"login_date" => time(),
);

$user[] = array(
	"login_user" => 1,
	"login_date" => time(),
);

$user[] = array(
	"login_user" => 4,
	"login_date" => time(),
	"login_agent" => "IE 10!!!",
);



// var_dump($user);

$class = new Log;


foreach($user as $key => $value){
	echo $key;
	
	if($class->insert($value))
	{
		echo ' class insert ok!<br>';
	}
	else
	{
		echo ' class insert failed:<br>';
		var_dump($value);
		echo '<br>';
		die(mysql_error());	
	}
}

?>


