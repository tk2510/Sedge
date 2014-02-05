<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge


/* 创建 <ng_log> */
$sql = "CREATE TABLE `ng_log` (
		`log_id` int(11) unsigned NOT NULL auto_increment,
		`login_user` int(11) unsigned NOT NULL,
		`login_date` int(10) NOT NULL,
		`login_IP` int unsigned NOT NULL default '0',
		`login_agent` varchar(255) NOT NULL default '',
		INDEX (`login_user`),
		INDEX (`login_date`),
		INDEX (`login_IP`),
		PRIMARY KEY (`log_id` desc)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

?>
