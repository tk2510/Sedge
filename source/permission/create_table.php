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

$sql = "CREATE DATABASE `sedge`";  // 创建数据库 sedge
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
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`user_id` int(11) unsigned NOT NULL,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` int(11) unsigned,
		INDEX (`user_id`),
		INDEX (`meta_key`),
		PRIMARY KEY (`meta_id`)
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
		INDEX (`user_id`),
		INDEX (`meta_key`),
		PRIMARY KEY (`meta_id`)
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
		INDEX (`option_name`),
		PRIMARY KEY (`option_id`)
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
		`class_modified` int(10),
		`class_parent` int(11) unsigned NOT NULL default '0',
		`class_level` int NOT NULL default '0', 
		`class_count` int(11)  NOT NULL default '0',
		`comment_count` int(11)  NOT NULL default '0',
		`read_count` int(11)  NOT NULL default '0',
		`hand_count` int(11)  NOT NULL default '0',
		`class_status` varchar(20),
		`class_type` varchar(255),
		`class_size` int(11) NOT NULL default '0',
		`class_user_IP` varchar(100), 
		INDEX (`class_name`(255)),
		INDEX (`class_parent`),
		INDEX (`class_level`),
		PRIMARY KEY (`ID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_post> */
$sql = "CREATE TABLE `ng_post` (
		`ID` int(11) unsigned NOT NULL auto_increment,
		`post_user` int(11) unsigned NOT NULL,
		`post_date` int(10) NOT NULL,
		`post_deadline` int(10) NOT NULL,
		`post_title` text NOT NULL,
		`post_subhead` text NOT NULL default '',
		`post_content` longtext NOT NULL default '',
		`post_teacher` varchar(24) NOT NULL default '',
		`post_visible_id` int(11) unsigned NOT NULL,
		`post_visible` tinyint unsigned NOT NULL default 0,
		`comment_status` varchar(20) NOT NULL default 'open',
		`post_password` varchar(64),
		`post_modified` int(10),
		`post_parent` int(11) unsigned NOT NULL default '0',
		`comment_count` int(11)  NOT NULL default '0',
		`read_count` int(11)  NOT NULL default '0',
		`hand_count` int(11)  NOT NULL default '0',
		`post_status` varchar(20),
		`post_type` varchar(255),
		`post_size` int(11) NOT NULL default '0',
		`post_user_IP` varchar(100), 
		INDEX (`post_title`(255)),
		INDEX (`post_teacher`),
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


/* 创建 <ng_postmeta> */
$sql = "CREATE TABLE `ng_postmeta` (
		`meta_id` int(11) unsigned NOT NULL auto_increment,
		`post_id` int(11) unsigned NOT NULL,
		`meta_key` varchar(255) NOT NULL,
		`meta_value` longtext,
		INDEX (`post_id`),
		INDEX (`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_comment> */
$sql = "CREATE TABLE `ng_comment` (
		`comment_id` int(11) unsigned NOT NULL auto_increment,
		`comment_post_id` int(11) unsigned NOT NULL,
		`comment_user_id` int(11) unsigned NOT NULL,
		`comment_user_IP` varchar(100),
		`comment_date` int(10),
		`comment_content` text NOT NULL,
		`comment_agent` varchar(255),
		`comment_parent` int(11) unsigned NOT NULL default '0',
		`comment_good` int unsigned NOT NULL default '0',
		`comment_bad` int unsigned NOT NULL default '0',
		INDEX (`comment_post_id`),
		INDEX (`comment_date`),
		INDEX (`comment_parent`),
		PRIMARY KEY (`comment_id`)
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
		INDEX (`comment_id`),
		INDEX (`meta_key`),
		PRIMARY KEY (`meta_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}


/* 创建 <ng_commentmet_extra> */
$sql = "CREATE TABLE `ng_comment_extra` (
		`extra_id` int(11) unsigned NOT NULL auto_increment,
		`comment_id` int(11) unsigned NOT NULL,
		`comment_user_id` int(11) unsigned NOT NULL,
		`extra_value` tinyint unsigned NOT NULL default '0',
		INDEX (`comment_id`),
		INDEX (`comment_user_id`),
		PRIMARY KEY (`extra_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if (!mysql_query($sql,$con)) {
	echo "Failed!<br>";
	die(mysql_error());
}

	
/* 创建 <ng_submit> */
$sql = "CREATE TABLE `ng_submit` (
		`submit_id` int(11) unsigned NOT NULL auto_increment,
		`submit_user` int(11) unsigned NOT NULL,
		`submit_date` int(10) NOT NULL,
		`submit_url` varchar(255) NOT NULL,
		`submit_IP` varchar(100),
		`submit_count` int NOT NULL default '0',
		`submit_size` int(11) NOT NULL default '0',
		INDEX (`submit_user`),
		INDEX (`submit_date`),
		PRIMARY KEY (`submit_id`)
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
		`login_IP` varchar(100),
		`login_agent` varchar(255),
		INDEX (`login_user`),
		INDEX (`login_date`),
		PRIMARY KEY (`log_id` desc)
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
		INDEX (`meta_key`),
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