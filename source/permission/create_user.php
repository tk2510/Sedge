<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


/* 创建 <ng_user> */
$sql = "CREATE TABLE `ng_user` (
		`ID` int(11) unsigned NOT NULL auto_increment,
		`user_login` varchar(100) NOT NULL default 'none',
		`user_pass` varchar(64) NOT NULL,
		`user_passkey` varchar(64) NOT NULL default 'key',
		`user_registered` int(10) NOT NULL,
		`user_status` int(11) NOT NULL default '0',
		`user_school` varchar(10) NOT NULL default 'whu',
		`user_stuid` varchar(50) NOT NULL default '',
		`user_nickname` varchar(24) NOT NULL default '',
		`user_gender` tinyint(1) default '0',
		`user_name` varchar(24) NOT NULL default '',
		INDEX (`user_login`),
		INDEX (`user_stuid`),
		PRIMARY KEY (`ID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

?>
