<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


/* 创建 <ng_comment> */
$sql = "CREATE TABLE `ng_comment` (
		`comment_id` int(11) unsigned NOT NULL auto_increment,
		`comment_post_id` int(11) unsigned NOT NULL default '0',
		`comment_user_id` int(11) unsigned NOT NULL default '0',
		`comment_date` int(10) NOT NULL default '0',
		`comment_content` text NOT NULL default '',
		`comment_parent` int(11) unsigned NOT NULL default '0',
		`comment_good` int unsigned NOT NULL default '0',
		`comment_bad` int unsigned NOT NULL default '0',
		INDEX (`comment_post_id`),
		INDEX (`comment_user_id`),
		INDEX (`comment_date`),
		INDEX (`comment_parent`),
		PRIMARY KEY (`comment_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

/* 创建 <ng_noti> */
$sql = "CREATE TABLE `ng_noti` (
		`noti_id` int(11) unsigned NOT NULL auto_increment,
		`comment_id` int(11) unsigned NOT NULL,
		`user_id` int(11) unsigned NOT NULL,
		`noti_read` bool NOT NULL default '0',
		`noti_type` tinyint unsigned NOT NULL default '0',
		INDEX (`comment_id`),
		INDEX (`user_id`),
		INDEX (`noti_type`),
		INDEX (`read`),
		PRIMARY KEY (`noti_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


?>
