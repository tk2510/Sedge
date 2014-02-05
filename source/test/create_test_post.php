<?php
/*
Author: ng1091
Date: 2014-02-01
Description: 用于向数据库中添加记录，便于测试
*/

require_once('../bll/dal/__DB.php');


$user[] = array(
	"post_class" => 4,
	"post_deadline" => time(),
	'post_type' => 'zip',
	'post_title' => "算法编程作业",
	'post_subhead' => "第1次",
	'post_content' => "第一章课后习题...",
);

$user[] = array(
	"post_class" => 4,
	"post_deadline" => time(),
	'post_type' => 'zip',
	'post_title' => "算法编程作业",
	'post_subhead' => "第2次",
	'post_content' => "第二章课后习题...",
);


$user[] = array(
	"post_class" => 3,
	"post_deadline" => time(),
	'post_type' => 'doc',
	'post_title' => "全校征文活动",
	'post_subhead' => "2011级",
	'post_content' => "一等奖blabla...",
);


// var_dump($user);

$class = new Post;


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


