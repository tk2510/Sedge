<html>
<body>

<?php
/*
Author: ng1091
Date: 2013-08-24
Description: 创建数据库和数据表
*/


$con = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin"); // 连接数据库，用户名sedgeadmin，密码sedge123，newlink标识sedgeadmin
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$sql = "CREATE DATABASE `sedge` DEFAULT CHARACTER SET 'UTF8' COLLATE utf8_general_ci;";  // 创建数据库 sedge
if (!mysql_query($sql,$con)) {
	echo "Create db failed!<br>";
	die(mysql_error());
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



/* 创建 <ng_user_class> */
$sql = "CREATE TABLE `ng_user_class` (
		`user_id` int(11) unsigned NOT NULL,
		`class_id` int(11) unsigned NOT NULL,
		`status` int(11) unsigned NOT NULL default '0',
		INDEX (`status`),
		PRIMARY KEY (`user_id`,`class_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_class> */
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
		`comment_count` int(11)  NOT NULL default '0',
		`read_count` int(11)  NOT NULL default '0',
		`hand_count` int(11)  NOT NULL default '0',
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


/* 创建 <ng_rec> */
$sql = "CREATE TABLE `ng_rec` (
		`rec_id` int(11) unsigned NOT NULL auto_increment,
		`user_id` int(11) unsigned NOT NULL,
		`comment_id` int(11) unsigned NOT NULL,
		`type` tinyint unsigned NOT NULL default '0',
		`date` int(10) NOT NULL default '0',
		INDEX (`date`),
		INDEX (``user_id`,`comment_id`),
		PRIMARY KEY (`rec_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


	///////////////////////////////////////////////////////////////JB
/* 创建 <ng_submit> */
$sql = "CREATE TABLE `ng_submit` (
		`post_id` int(11) unsigned NOT NULL,
		`user_id` int(11) unsigned NOT NULL,
		`submit_date` int(10) NOT NULL default '0',
		`submit_url` varchar(255) NOT NULL,
		`submit_key` varchar(255) NOT NULL default '0', 
		`submit_IP` int unsigned NOT NULL default '0', 
		`submit_count` int NOT NULL default '1',
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
	

	
mysql_close($con);

echo "Established OK";
?>

</body>
</html>