<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


$sql = "CREATE TABLE `ng_class` (
		`ID` int(11) unsigned NOT NULL auto_increment,
		`class_user` int(11) unsigned NOT NULL,
		`class_date` int(10) NOT NULL,
		`class_name` text NOT NULL,
		`class_subhead` text NOT NULL default '',
		`class_content` longtext NOT NULL default '',
		`class_modified` int(10) NOT NULL default '0',
		`class_parent` int(11) unsigned NOT NULL default '0',
		`class_level` int NOT NULL default '0', 
		`class_count` int(11)  NOT NULL default '0',
		`comment_count` int(11)  NOT NULL default '0',
		`read_count` int(11)  NOT NULL default '0',
		`hand_count` int(11)  NOT NULL default '0',
		`class_status` int(11) NOT NULL default '0',
		`class_type` varchar(255) NOT NULL default '',
		`class_size` int(11) NOT NULL default '0',
		`class_user_IP` int unsigned NOT NULL default '0', 
		INDEX (`class_name`(255)),
		INDEX (`class_subhead`(255)),
		INDEX (`class_parent`),
		INDEX (`class_level`),
		INDEX (`class_status`),
		PRIMARY KEY (`ID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

?>
