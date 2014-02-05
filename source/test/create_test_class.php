<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"class_user" => 1,
	"class_name" => "计算机学院",
	"class_content" => "WHU计算机学院是......",
	"class_date" => time(),
	"class_parent" => 0,
	"class_level" => 0,
);


$user[] = array(
	"class_user" => 1,
	"class_name" => "计算机科学与技术",
	"class_content" => "WHU计算机学院是......",
	"class_date" => time(),
	"class_parent" => 1,
	"class_level" => 1,
);


$user[] = array(
	"class_user" => 1,
	"class_name" => "2011级",
	"class_content" => "WHU计算机学院是......",
	"class_date" => time(),
	"class_parent" => 2,
	"class_level" => 2,
);

$user[] = array(
	"class_user" => 1,
	"class_name" => "算法设计与分析",
	"class_content" => "算法设计与分析是一门......",
	"class_subhead" => "章文",
	"class_date" => time(),
	"class_parent" => 0,
	"class_level" => 3,
);



// var_dump($user);

$class = new iClass;


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


