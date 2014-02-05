<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"comment_post_id" => 1,
	"comment_user_id" => 1,
	'comment_content' => '不错~~',
);

$user[] = array(
	"comment_post_id" => 1,
	"comment_user_id" => 2,
	'comment_content' => 'good....',
);

$user[] = array(
	"comment_post_id" => 1,
	"comment_user_id" => 3,
	'comment_content' => 'Orz',
);

$user[] = array(
	"comment_post_id" => 2,
	"comment_user_id" => 1,
	'comment_content' => '不错~~',
);

$user[] = array(
	"comment_post_id" => 2,
	"comment_user_id" => 3,
	'comment_content' => 'nice',
);

// var_dump($user);

$class = new Comment;


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


