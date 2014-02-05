<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"user_id" => 1,
	"class_id" => 4,
	"status" => 0,
);


$user[] = array(
	"user_id" => 1,
	"class_id" => 3,
	"status" => 1,
);


$user[] = array(
	"user_id" => 2,
	"class_id" => 4,
	"status" => 0,
);

$user[] = array(
	"user_id" => 3,
	"class_id" => 1,
	"status" => 1,
);

$user[] = array(
	"user_id" => 3,
	"class_id" => 2,
	"status" => 1,
);

$user[] = array(
	"user_id" => 3,
	"class_id" => 3,
	"status" => 1,
);

$user[] = array(
	"user_id" => 3,
	"class_id" => 4,
	"status" => 0,
);



// var_dump($user);

$class = new User_Class;


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


