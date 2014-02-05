<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


/* 创建 <ng_rec> */
$sql = "CREATE TABLE `ng_rec` (
		`rec_id` int(11) unsigned NOT NULL auto_increment,
		`user_id` int(11) unsigned NOT NULL,
		`comment_id` int(11) unsigned NOT NULL,
		`type` tinyint unsigned NOT NULL default '0',
		`date` int(10) NOT NULL default '0',
		INDEX (`date`),
		INDEX (`user_id`,`comment_id`),
		PRIMARY KEY (`rec_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


?>
