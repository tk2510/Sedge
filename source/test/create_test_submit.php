<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"post_id" => 1,
	"user_id" => 1,
	"submit_date" => time(),
	"submit_url" => "www.ng.com",
);


$user[] = array(
	"post_id" => 1,
	"user_id" => 2,
	"submit_date" => time(),
	"submit_url" => "www.ngc.com",
);


$user[] = array(
	"post_id" => 1,
	"user_id" => 3,
	"submit_date" => time(),
	"submit_url" => "www.ngc.com",
);

$user[] = array(
	"post_id" => 2,
	"user_id" => 4,
	"submit_date" => time(),
	"submit_url" => "www.ngc.com",
);




// var_dump($user);

$class = new Submit;


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


