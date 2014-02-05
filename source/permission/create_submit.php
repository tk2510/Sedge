<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


/* 创建 <ng_submit> */
$sql = "CREATE TABLE `ng_submit` (
		`post_id` int(11) unsigned NOT NULL,
		`user_id` int(11) unsigned NOT NULL,
		`submit_date` int(10) NOT NULL default '0',
		`submit_url` varchar(255) NOT NULL,
		`submit_key` varchar(255) NOT NULL default '0', 
		`submit_IP` int unsigned NOT NULL default '0', 
		`submit_count` int NOT NULL default '0',
		`submit_size` int(11) NOT NULL default '0',
		INDEX (`submit_date`),
		INDEX (`submit_size`),
		INDEX (`submit_IP`),
		PRIMARY KEY (`post_id`,`user_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

?>
