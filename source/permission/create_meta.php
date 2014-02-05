<?php

$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("sedge", $con); // 选择数据库 sedge



/* 创建 <ng_option> */
$sql = "CREATE TABLE `ng_option` (
		`option_id` int(11) unsigned NOT NULL auto_increment,
		`option_name` varchar(255) NOT NULL,
		`option_value` longtext,
		UNIQUE (`option_name`),
		PRIMARY KEY (`option_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_usermeta> */
$sql = "CREATE TABLE `ng_usermeta` (
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`user_id` int(11) unsigned NOT NULL,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext,
		INDEX (`meta_key`),
		UNIQUE KEY `UK_usermeta` (`user_id`,`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}



/* 创建 <ng_postmeta> */
$sql = "CREATE TABLE `ng_postmeta` (
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`post_id` int(11) unsigned NOT NULL,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext,
		INDEX (`meta_key`),
		UNIQUE KEY `UK_postmeta` (`post_id`,`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_commentmeta> */
$sql = "CREATE TABLE `ng_commentmeta` (
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`comment_id` int(11) unsigned NOT NULL,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext,
		INDEX (`meta_key`),
		UNIQUE KEY `UK_commentmeta` (`comment_id`,`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

/* 创建 <ng_meta> */
$sql = "CREATE TABLE `ng_meta` (
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext,
		UNIQUE (`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}
	
?>
