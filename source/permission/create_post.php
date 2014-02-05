<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge



/* 创建 <ng_post> */
$sql = "CREATE TABLE `ng_post` (
		`ID` int(11) unsigned NOT NULL auto_increment,
		`post_user` int(11) unsigned NOT NULL default 0,
		`post_class` int(11) unsigned NOT NULL,
		`post_date` int(10) NOT NULL default 0,
		`post_modified` int(10) NOT NULL default 0,
		`post_deadline` int(10) NOT NULL default 0,
		`post_status` tinyint unsigned NOT NULL default 0,
		`comment_status` tinyint unsigned NOT NULL default 0,
		`post_parent` int(11) unsigned NOT NULL default '0',
		`comment_count` int(11) unsigned NOT NULL default '0',
		`read_count` int(11) unsigned NOT NULL default '0',
		`hand_count` int(11) unsigned NOT NULL default '0',
		`post_type` varchar(255) NOT NULL default '0',
		`post_size` int(11) NOT NULL default '0',
		`post_visible` tinyint unsigned NOT NULL default 0,
		`post_title` text NOT NULL,
		`post_subhead` text NOT NULL default '',
		`post_password` varchar(64) NOT NULL default '',
		`post_content` longtext NOT NULL default '',
		INDEX (`post_title`(255)),
		INDEX (`post_parent`),
		INDEX (`post_user`),
		INDEX (`post_date`),
		INDEX (`post_deadline`),
		PRIMARY KEY (`ID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}
	
?>
